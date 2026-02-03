<?php
/**
 * Template Name: Contact Us
 * Форма обратной связи с капчей и отправкой на почту.
 */

// Обработка отправки формы
$form_message = '';
$form_error  = '';

if ( isset( $_POST['contact_form_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['contact_form_nonce'] ) ), 'contact_form_submit' ) ) {
	$name    = isset( $_POST['contact_name'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_name'] ) ) : '';
	$email   = isset( $_POST['contact_email'] ) ? sanitize_email( wp_unslash( $_POST['contact_email'] ) ) : '';
	$message = isset( $_POST['contact_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['contact_message'] ) ) : '';
	$captcha_answer = isset( $_POST['contact_captcha'] ) ? (int) $_POST['contact_captcha'] : 0;
	$captcha_key   = isset( $_POST['contact_captcha_key'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_captcha_key'] ) ) : '';

	$errors = array();
	if ( strlen( $name ) < 2 ) {
		$errors[] = 'Введите имя (не менее 2 символов).';
	}
	if ( ! is_email( $email ) ) {
		$errors[] = 'Введите корректный email.';
	}
	if ( strlen( $message ) < 10 ) {
		$errors[] = 'Сообщение должно быть не короче 10 символов.';
	}

	$expected = $captcha_key ? get_transient( 'contact_captcha_' . $captcha_key ) : false;
	if ( $expected === false || (int) $expected !== $captcha_answer ) {
		$errors[] = 'Неверный ответ на вопрос (капча).';
	}
	if ( $captcha_key ) {
		delete_transient( 'contact_captcha_' . $captcha_key );
	}

	if ( empty( $errors ) ) {
		$to      = getenv( 'CONTACT_FORM_TO' ) ?: get_option( 'admin_email' );
		$subject = 'Заявка с формы обратной связи: ' . get_bloginfo( 'name' );
		$body    = "Имя: $name\nEmail: $email\n\nСообщение:\n$message";
		$headers = array( 'Content-Type: text/plain; charset=UTF-8', 'Reply-To: ' . $email );

		$sent = wp_mail( $to, $subject, $body, $headers );
		if ( $sent ) {
			$form_message = 'Спасибо! Ваше сообщение отправлено.';
		} else {
			$form_error = 'Не удалось отправить сообщение. Попробуйте позже или напишите нам на email.';
		}
	} else {
		$form_error = implode( ' ', $errors );
	}
}

// Генерация капчи для формы
$captcha_num1 = wp_rand( 1, 10 );
$captcha_num2 = wp_rand( 1, 10 );
$captcha_key  = 'c' . wp_rand( 10000, 99999 );
set_transient( 'contact_captcha_' . $captcha_key, $captcha_num1 + $captcha_num2, 600 );
?>
<?php get_header(); ?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">
<style>
.contact-form-custom {
	font-family: "Source Sans 3", sans-serif;
}
.contact-form-custom .form-label {
	font-family: "Source Sans 3", sans-serif;
	margin-bottom: 0.35em;
}
.contact-form-custom .form-control {
	font-family: "Source Sans 3", sans-serif;
}
.contact-form-custom .form-field-wrap {
	margin-bottom: 0.75rem;
}
.contact-form-custom .form-field-wrap--submit {
	margin-bottom: 0;
	margin-top: 0.5rem;
}
.contact-form-custom .btn-contact-submit {
	background-color: #8a5a97;
	color: #fff;
	border: none;
	padding: 0.5rem 1.25rem;
	font-family: "Source Sans 3", sans-serif;
	font-weight: 600;
	cursor: pointer;
	border-radius: 4px;
}
.contact-form-custom .btn-contact-submit:hover {
	background-color: #7a4a87;
	color: #fff;
}
</style>

<div class="gurantee-section breadcrum-banner mobile-margin-ess essent_oilBanner-wrap">
	<div class="gurantee-section-bg"
		style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/photo/Essential-Oils-Organic-NatureInBottle.jpeg');">
		<div class="gurantee-content">
			<h2><?php the_title(); ?></h2>
			<p>
				<?php the_content(); ?>
			</p>
		</div>
	</div>
</div>


<section class="contactus-sect">
	<div class="container">
		<div class="row">
			<div class="col-md-4 contact-leftside">
				<div class="call-box">
					<h4>Позвонить нам:</h4>
					<div class="call-info">
						<b>
							<?php the_field('phone')?>
							<!--<span class="toll-mark">(TOLLFREE)</span>-->
						</b>
					</div>
				</div>

				<div class="email-box">
					<h4>Написать нам:</h4>
					<div class="email-info">
						<b>
							<a href="mailto:<?php the_field('email')?>"><?php the_field('email')?></a>
						</b>
					</div>
				</div>

				<div class="chat-box">
					<h4>Чат с нами:</h4>
					<div class="chat-info">
						<span>
							<img src="<?php echo get_template_directory_uri(); ?>/images/photo/Whatsapp_Icon.png"
								alt="WhatsApp">
							<a href="https://wa.me/18887555274" target="_blank">Message us on Whatsapp</a>
						</span>
					</div>
				</div>


			</div>

			<div class="col-md-8 contact-rightside">

				<?php if ( $form_message ) : ?>
					<div class="alert alert-success d-flex1 align-items-center stext" role="alert">
						<?php echo esc_html( $form_message ); ?>
					</div>
				<?php endif; ?>
				<?php if ( $form_error ) : ?>
					<div class="alert alert-danger d-flex1 align-items-center stext" role="alert">
						<?php echo esc_html( $form_error ); ?>
					</div>
				<?php endif; ?>

				<form method="post" action="" class="contact-form-custom row" id="contact-form-custom">
					<?php wp_nonce_field( 'contact_form_submit', 'contact_form_nonce' ); ?>
					<div class="col-md-6 form-field-wrap">
						<label for="contact_name" class="form-label">Имя <span class="text-danger">*</span></label>
						<input type="text" name="contact_name" id="contact_name" class="form-control" required
							value="<?php echo isset( $_POST['contact_name'] ) ? esc_attr( sanitize_text_field( wp_unslash( $_POST['contact_name'] ) ) ) : ''; ?>">
					</div>
					<div class="col-md-6 form-field-wrap">
						<label for="contact_email" class="form-label">Email для обратной связи <span class="text-danger">*</span></label>
						<input type="email" name="contact_email" id="contact_email" class="form-control" required
							value="<?php echo isset( $_POST['contact_email'] ) ? esc_attr( sanitize_email( wp_unslash( $_POST['contact_email'] ) ) ) : ''; ?>">
					</div>
					<div class="col-12 form-field-wrap">
						<label for="contact_message" class="form-label">Сообщение <span class="text-danger">*</span></label>
						<textarea name="contact_message" id="contact_message" class="form-control" rows="5" required minlength="10"><?php echo isset( $_POST['contact_message'] ) ? esc_textarea( wp_unslash( $_POST['contact_message'] ) ) : ''; ?></textarea>
					</div>
					<div class="col-12 form-field-wrap">
						<label for="contact_captcha" class="form-label">Сколько будет <?php echo (int) $captcha_num1; ?> + <?php echo (int) $captcha_num2; ?>? <span class="text-danger">*</span></label>
						<input type="hidden" name="contact_captcha_key" value="<?php echo esc_attr( $captcha_key ); ?>">
						<input type="number" name="contact_captcha" id="contact_captcha" class="form-control" required min="0" max="100" placeholder="Ответ">
					</div>
					<div class="col-12 form-field-wrap form-field-wrap--submit">
						<button type="submit" class="btn btn-contact-submit">Отправить</button>
					</div>
				</form>

			</div>

		</div>

		<div class="row">
			<div class="flag-wrapper">

				<div class="flag-card">
					<img src="<?php echo get_template_directory_uri(); ?>/images/photo/united-states.png" alt="">
					<h3>Telegram</h3>
				</div>

				<div class="flag-card">
					<img src="<?php echo get_template_directory_uri(); ?>/images/photo/european-union.png" alt="">
					<h3>Whatsapp</h3>
				</div>


				<div class="flag-card">
					<img src="<?php echo get_template_directory_uri(); ?>/images/photo/india.png" alt="">
					<h3>Email</h3>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
get_footer();
<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.sass).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */
get_header();
?>
<?php 
global $more;
while( have_posts() ) : the_post();
	$more = 1; // отображаем полностью всё содержимое поста
	//the_title(); // эта функция выводит заголовок
	the_content(); // выводим контент
endwhile;

?>
<?php
get_footer();
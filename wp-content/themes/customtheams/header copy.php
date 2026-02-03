<div class="loaderDiv loader" style="display:none;">
		<div class="dimmer">
			<div class="spinner">
				<div class="rect1"></div>
				<div class="rect2"></div>
				<div class="rect3"></div>
				<div class="rect4"></div>
				<div class="rect5"></div>
			</div>
		</div>
	</div> <!-- Top Bar section start -->
	<div class="top-bar">
		<div class="container">
			<div class="top-bar-grid">
				<div class="top-bar-grid-left">
					<div>
						<img src="https://www.natureinbottle.com/images/international-products.png" alt=""
							title=""><span>International Shipping</span>
					</div>
					<div>
						<img src="https://www.natureinbottle.com/images/lowest-pricing.png" alt=""
							title=""><span>Guaranteed Lowest Prices</span>
					</div>
					<div>
						<img src="https://www.natureinbottle.com/images/best-quality.png" alt="" title=""><span>Best
							Quality Premium Products</span>
					</div>
				</div>
				<div class="top-bar-grid-right">
					<div class="language-container">
						<div class="select-language google_trns_hidden_mob">
							<div id="google_translate_element"></div>
						</div>
					</div>
					<div class="dropdown">
						<button onclick="myFunction()" class="dropbtn">
							<img src="https://www.natureinbottle.com/upload/flag/thumb/USD_1546709833.png" alt=""
								title="">USD &nbsp;($)
							<span class="arrow-create"></span>
						</button>
						<div id="myDropdown" class="dropdown-content">
							<a href="javascript:void(0)" onclick="setCurrency('AUD')">
								<img src="https://www.natureinbottle.com/upload/flag/thumb/AUD_1546709561.png" alt=""
									title=""> AUD &nbsp;(A$) </a>
							<a href="javascript:void(0)" onclick="setCurrency('CAD')">
								<img src="https://www.natureinbottle.com/upload/flag/thumb/CAD.png" alt="" title=""> CAD
								&nbsp;(C$) </a>
							<a href="javascript:void(0)" onclick="setCurrency('DKK')">
								<img src="https://www.natureinbottle.com/upload/flag/thumb/DKK_1546709591.png" alt=""
									title=""> DKK &nbsp;(kr.) </a>
							<a href="javascript:void(0)" onclick="setCurrency('EUR')">
								<img src="https://www.natureinbottle.com/upload/flag/thumb/EUR.png" alt="" title=""> EUR
								&nbsp;(&#8364;) </a>
							<a href="javascript:void(0)" onclick="setCurrency('HKD')">
								<img src="https://www.natureinbottle.com/upload/flag/thumb/HKD.png" alt="" title=""> HKD
								&nbsp;(HK$) </a>
							<a href="javascript:void(0)" onclick="setCurrency('INR')">
								<img src="https://www.natureinbottle.com/upload/flag/thumb/INR_1558166801.png" alt=""
									title=""> INR &nbsp;(&#8377;) </a>
							<a href="javascript:void(0)" onclick="setCurrency('JPY')">
								<img src="https://www.natureinbottle.com/upload/flag/thumb/JPY.jpeg" alt="" title="">
								JPY &nbsp;(&#165;) </a>
							<a href="javascript:void(0)" onclick="setCurrency('NZD')">
								<img src="https://www.natureinbottle.com/upload/flag/thumb/NZD.png" alt="" title=""> NZD
								&nbsp;(NZ$) </a>
							<a href="javascript:void(0)" onclick="setCurrency('NOK')">
								<img src="https://www.natureinbottle.com/upload/flag/thumb/NOK.png" alt="" title=""> NOK
								&nbsp;(kr) </a>
							<a href="javascript:void(0)" onclick="setCurrency('GBP')">
								<img src="https://www.natureinbottle.com/upload/flag/thumb/GBP_1546709764.png" alt=""
									title=""> GBP &nbsp;(&#163;) </a>
							<a href="javascript:void(0)" onclick="setCurrency('SGD')">
								<img src="https://www.natureinbottle.com/upload/flag/thumb/SGD.png" alt="" title=""> SGD
								&nbsp;(S$) </a>
							<a href="javascript:void(0)" onclick="setCurrency('SEK')">
								<img src="https://www.natureinbottle.com/upload/flag/thumb/SEK.png" alt="" title=""> SEK
								&nbsp;(kr) </a>
							<a href="javascript:void(0)" onclick="setCurrency('CHF')">
								<img src="https://www.natureinbottle.com/upload/flag/thumb/CHF.png" alt="" title=""> CHF
								&nbsp;(SFr.) </a>
							<a href="javascript:void(0)" onclick="setCurrency('USD')">
								<img src="https://www.natureinbottle.com/upload/flag/thumb/USD_1546709833.png" alt=""
									title=""> USD &nbsp;($) </a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<input type="hidden" id="totalproduct" value="0" />
	<div class="logo-section ">
		<div class="container">
			<div class="logo-search-account-container">
				<div class="logo-container">
					<a href="<?php home_url();?>">
						<img src="<?= get_template_directory_uri();?>/images/logo.png" alt="" title="">
					</a>
				</div>
				<div class="search-section">
					<form action="https://www.natureinbottle.com/home/searchlist" method="post">
						<input type="search" name="searchtext" id="myInput" value=""
							placeholder="Search natureinbottle.com">
						<button type="submit" name="searchSubmit"><i class="fa fa-search"
								aria-hidden="true"></i></button>
					</form>
				</div>
				<div class="loginCart-section">
					<div class="login">
						<a href="https://www.natureinbottle.com/user/login"><img
								src="https://www.natureinbottle.com/images/status.png" alt="" title="">Login</a>
					</div>
					<div class="cart">
						<a href="https://www.natureinbottle.com/user/shopping_cart">
							<img src="https://www.natureinbottle.com/images/cart-w.png" alt="" title=""><b
								class="posOnIcon">0</b> Items
						</a>
					</div>
				</div>
			</div>
			<div class="mobile-search-3bar">
				<div class="mobileNewSearch">
					<form action="https://www.natureinbottle.com/home/searchlist" method="post">
						<input type="text" name="searchtext" id="myInput" value=""
							placeholder="Search natureinbottle.com"><i class="fa fa-search" aria-hidden="true"></i>
					</form>
				</div>
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-megadropdown-tabs"
					onclick="openNav();" aria-expanded="true">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<button type="button" class="navbar-toggle closeToggle" data-toggle="collapse"
					data-target="#bs-megadropdown-tabs" onclick="openNav();" aria-expanded="true">
					<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
				</button>
			</div>
		</div>
	</div>
	<div class="menu-mobile-nav mobile-nav-hide">
		<ul class="top-menu-section">
			<li>
				<a href="https://www.natureinbottle.com/productlist/essentialoils/30">
					Essential Oils </a>
			</li>
			<li>
				<a href="https://www.natureinbottle.com/productlist/carrieroils/29">
					Carrier oils </a>
			</li>
			<li>
				<a href="https://www.natureinbottle.com/productlist/absolutes/33">
					Absolutes </a>
			</li>
			<li>
				<a href="https://www.natureinbottle.com/productlist/ayurvedicherbaloil/34">
					Ayurvedic Herbal Oils </a>
			</li>
			<li>
				<a href="https://www.natureinbottle.com/productlist/infusedmaceratedoils/42">
					Infused & Macerated Oils </a>
			</li>
			<li>
				<a href="https://www.natureinbottle.com/productlist/hydrosolsfloralwater/31">
					Hydrosols & Floral Waters </a>
			</li>
			<li>
				<a href="https://www.natureinbottle.com/productlist/naturalfragranceoils/51">
					Natural Fragrance Oils </a>
			</li>
			<li>
				<a href="https://www.natureinbottle.com/productlist/chakrablends/49">
					Chakra Blends </a>
			</li>
		</ul>
		<ul class="bottom-menu-section">
			<li><a href="https://www.natureinbottle.com/puurepromise">P.U.U.R.E. PROMISE</a></li>
			<li><a href="https://www.natureinbottle.com/faq">FAQ</a></li>
			<li><a href="https://www.natureinbottle.com/user/custom-blend">CUSTOM BLEND</a></li>
			<li><a href="https://www.natureinbottle.com/catalog">Product Catalog</a></li>
			<li><a href="https://www.natureinbottle.com/contactus">Contact Us</a></li>
		</ul>
	</div>
	<div class="navigation">
		<div class="container">
			
			<?php
			
	$args = array_merge( [
		'container'       => 'div',
		'container_id'    => 'top-navigation-primary',
		'container_class' => 'top-navigation',
		'menu_class'      => 'menu main-menu menu-depth-0 menu-even',
		'echo'            => false,
		'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth'           => 10,
		'walker'          => new My_Walker_Nav_Menu()
	], $args );

	echo wp_nav_menu( $args );
;?>
		</div>
		<div class="container" style="display:none">
			<ul>
				<li><a href="<?php home_url();?>">Home</a></li>
				<li>
					<a href="#">
						Shop <span class="caret"></span>
					</a>
					<div class="dropdown-menu mega-dropdown-menu">
						<div class="container">
							<div class="tab-content">
								<div class="tab-pane active">
									<ul class="nav-list list-inline top_menu_icon_text content">
										<li class="box">
											<a href="https://www.natureinbottle.com/productlist/essentialoils/30">
												<img src="https://www.natureinbottle.com/upload/pages/Essential-Oils-NIB-Icon_1657478748.jpeg"
													alt="Essential Oils" title="Essential Oils">
												<span class="top_menu_text">
													Essential Oils </span>
											</a>
										</li>
										<li class="box">
											<a href="https://www.natureinbottle.com/productlist/carrieroils/29">
												<img src="https://www.natureinbottle.com/upload/pages/CARRIER-OIL-COLD-PRESSED.jpeg"
													alt="Carrier oils" title="Carrier oils">
												<span class="top_menu_text">
													Carrier oils </span>
											</a>
										</li>
										<li class="box">
											<a href="https://www.natureinbottle.com/productlist/absolutes/33">
												<img src="https://www.natureinbottle.com/upload/pages/Absolutes-NIB-Icon.jpg"
													alt="Absolutes" title="Absolutes">
												<span class="top_menu_text">
													Absolutes </span>
											</a>
										</li>
										<li class="box">
											<a href="https://www.natureinbottle.com/productlist/ayurvedicherbaloil/34">
												<img src="https://www.natureinbottle.com/upload/pages/Ayurvedic-Herbal-Oils.png"
													alt="Ayurvedic Herbal Oils" title="Ayurvedic Herbal Oils">
												<span class="top_menu_text">
													Ayurvedic Herbal Oils </span>
											</a>
										</li>
										<li class="box">
											<a
												href="https://www.natureinbottle.com/productlist/infusedmaceratedoils/42">
												<img src="https://www.natureinbottle.com/upload/pages/InfusedandMaceratedOilsIcons2.jpeg"
													alt="Infused & Macerated Oils" title="Infused & Macerated Oils">
												<span class="top_menu_text">
													Infused & Macerated Oils </span>
											</a>
										</li>
										<li class="box">
											<a
												href="https://www.natureinbottle.com/productlist/hydrosolsfloralwater/31">
												<img src="https://www.natureinbottle.com/upload/pages/HydrosolsFloralWaterIcon.png"
													alt="Hydrosols & Floral Waters" title="Hydrosols & Floral Waters">
												<span class="top_menu_text">
													Hydrosols & Floral Waters </span>
											</a>
										</li>
										<li class="box">
											<a
												href="https://www.natureinbottle.com/productlist/naturalfragranceoils/51">
												<img src="https://www.natureinbottle.com/upload/pages/fragrance-oils_1647774974.jpeg"
													alt="Natural Fragrance Oils" title="Natural Fragrance Oils">
												<span class="top_menu_text">
													Natural Fragrance Oils </span>
											</a>
										</li>
										<li class="box">
											<a href="https://www.natureinbottle.com/productlist/chakrablends/49">
												<img src="https://www.natureinbottle.com/upload/pages/Navigation-2f2bbe667686_121120240843441731401024.jpg"
													alt="Chakra Blends" title="Chakra Blends">
												<span class="top_menu_text">
													Chakra Blends </span>
											</a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</li>
				<li><a href="https://www.natureinbottle.com/puurepromise">P.U.U.R.E. PROMISE</a></li>
				<li><a href="https://www.natureinbottle.com/user/custom-blend">CUSTOM BLEND</a></li>
				<li><a href="https://www.natureinbottle.com/contactus">Contact Us</a></li>
			</ul>
		</div>
	</div>
	<style>
		.gurantee-content h2 {
			font-family: 'DIN Pro';
			font-size: 36px;
			line-height: 45px;
			font-weight: 700;
		}
		@media only screen and (min-width: 300px) and (max-width: 991px) {
			.home-review-grid {
				grid-template-columns: repeat(1, 1fr);
			}
		}
	</style>
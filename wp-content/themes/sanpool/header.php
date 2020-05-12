<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<script src="https://kit.fontawesome.com/b0102dcf34.js" defer crossorigin="anonymous"></script>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<div id="page_wrapper">
			<header>
				<div class="fixed-top bg-primary shadow">
					<div class="container">
						<nav class="navbar navbar-expand-xl">
							<a class="navbar-brand" href="<?php echo HOME_URI; ?>">
								<picture>
									<img src="<?php echo THEME_IMAGES; ?>/sanpool-logo.png" alt="Logo">
								</picture>
							</a>
							<button class="navbar-toggler position-relative hamburger hamburger--spin" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Navigation umschalten">
								<span class="hamburger-box">
									<span class="hamburger-inner"></span>
								</span>
							</button>
							<?php
							$args = array(
								'theme_location' => 'mainmenu',
								'depth' => 2,
								'container' => 'div',
								'container_class' => 'collapse navbar-collapse',
								'container_id' => 'mainmenu',
								'menu_class' => 'navbar-nav ml-auto position-relative',
								'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
								'walker' => new WP_Bootstrap_Navwalker(),
							);
							wp_nav_menu($args);
							?>
						</nav>
					</div>
				</div>
			</header>
			<?php
			get_sidebar('infoicons');
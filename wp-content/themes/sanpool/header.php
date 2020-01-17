<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<script src="https://kit.fontawesome.com/b0102dcf34.js" crossorigin="anonymous"></script>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<header>
			<div class="fixed-top">
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
					<div class="collapse navbar-collapse" id="mainmenu">
						<ul class="navbar-nav ml-auto position-relative">
							<li class="nav-item active">
								<a class="nav-link" href="<?php echo HOME_URI; ?>">Kurse <span class="sr-only">(Aktuell)</span></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">Kooperation</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">Über SanPool</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">Ersatzausweis</a>
							</li>
						</ul>
					</div>
				</nav>
			</div>
		</header>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<ul id="infoButtons">
						<li><div class="inner"><i class="fas fa-user fa-2x"></i></div></li>
						<li><div class="inner"><i class="fas fa-globe-europe fa-2x"></i></div></li>
						<li class="active"><div class="inner"><i class="fas fa-store fa-2x"></i></div></li>
						<li><div class="inner"><i class="fas fa-envelope fa-2x"></i></div></li>
					</ul>
				</div>
			</div>
		</div>
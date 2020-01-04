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
			<?php
			$addClass = '';
			if(is_front_page()) {
				$addClass = 'container ';
			}
			?>
			<div class="<?php echo $addClass; ?>fixed-top">
				<nav class="navbar navbar-expand-lg">
					<a class="navbar-brand" href="<?php echo HOME_URI; ?>">
						<picture>
							<img src="<?php echo THEME_IMAGES; ?>/sanpool-logo.png" alt="Logo">
						</picture>
					</a>
					<button class="navbar-toggler position-relative" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Navigation umschalten">
						<i class="fas fa-bars fa-lg text-white"></i>
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
		<div class="waveWrapper waveAnimation">
			<div class="waveWrapperInner bgTop">
				<div class="wave waveTop" style="background-image: url('<?php echo THEME_IMAGES; ?>/helpers/wave-top.png')"></div>
			</div>
			<div class="waveWrapperInner bgMiddle">
				<div class="wave waveMiddle" style="background-image: url('<?php echo THEME_IMAGES; ?>/helpers/wave-mid.png')"></div>
			</div>
			<div class="waveWrapperInner bgBottom">
				<div class="wave waveBottom" style="background-image: url('<?php echo THEME_IMAGES; ?>/helpers/wave-bot.png')"></div>
			</div>
		</div>
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
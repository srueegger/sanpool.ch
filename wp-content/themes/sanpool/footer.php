		<?php
		$addClass = '';
		if(is_front_page()) {
			$addClass = 'container';
		}
		?>
		<footer class="mt-5">
			<div class="<?php echo $addClass; ?>">
				<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
					<div class="collapse navbar-collapse" id="navbarText">
						<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
							<a class="nav-link" href="#">Kontakt <span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Impressum</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Datenschutzerklärung</a>
						</li>
						</ul>
						<span class="navbar-text">
							<i class="far fa-copyright"></i> <?php echo date('Y'); ?> SanPool - Schule für Gesundheit
						</span>
					</div>
				</nav>
			</div>
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>
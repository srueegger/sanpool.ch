		<footer class="mt-3">
			<div>
				<nav class="navbar navbar-expand-xl navbar-dark bg-dark">
					<?php
					$args = array(
						'theme_location' => 'footermenu',
						'depth' => 1,
						'container' => 'div',
						'container_class' => 'navbar-collapse',
						'container_id' => 'footermenu',
						'menu_class' => 'navbar-nav mr-auto',
						'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
						'walker' => new WP_Bootstrap_Navwalker(),
					);
					wp_nav_menu($args);
					?>
				</nav>
			</div>
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>
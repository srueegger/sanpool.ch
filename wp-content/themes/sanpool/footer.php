			</div>
			<footer id="siteFooter">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-12 col-lg-6">
							<a href="<?php echo HOME_URI; ?>" target="_self">
								<picture>
									<img src="<?php echo THEME_IMAGES; ?>/sanpool-logo.png" class="footer-logo" alt="">
								</picture>
							</a>
							<?php
							the_field( 'footer_address', 'option' );
							the_field( 'footer_contacts', 'option' );
							?>
						</div>
						<div class="col-12 col-lg-6">
							<div class="footer-spacer"></div>
							<p><?php the_field( 'footer_claim', 'option' ); ?></p>
							<div class="contact-info">
								<?php the_field( 'footer_bigtxt', 'option' ); ?>
							</div>
						</div>
						<div class="col-12 col-lg-12 footer-menu">
							<ul>
								<?php
								$locations = get_nav_menu_locations();
								$menu_id = $locations['footermenu'];
								$footer_menu = wp_get_nav_menu_items($menu_id);
								foreach($footer_menu as $menu) {
									$link_target = $menu->target ? $menu->target : '_self';
									echo '<li><a href="'.$menu->url.'" target="'.$link_target.'">'.$menu->title.'</a></li>';
								}
								?>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		<?php wp_footer(); ?>
	</body>
</html>
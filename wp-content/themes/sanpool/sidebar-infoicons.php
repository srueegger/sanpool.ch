<?php
/* Diese Datei zeigt die fixierten Icons am rechten Bildschirmrand an. */
$menuLocations = get_nav_menu_locations();
$menuItems = wp_get_nav_menu_items($menuLocations['iconmenu']);
if(!empty($menuItems)) {
	?>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<ul id="infoButtons">
					<?php
					foreach($menuItems as $menuItem) {
						$target = '_self';
						if($menuItem->target != '') {
							$target = $menuItem->target;
						}
						?>
						<li class="<?php the_field('iconmenu_color', $menuItem); ?>">
							<div class="inner">
								<i class="<?php the_field('iconmenu_icon', $menuItem); ?> fa-fw"></i>
							</div>
							<span class="info-text">
								<a href="<?php echo esc_url( $menuItem->url ); ?>" target="<?php echo $target; ?>">
									<?php echo esc_attr( $menuItem->title ); ?>
								</a>
							</span>
						</li>
						<?php
					}
					?>
				</ul>
			</div>
		</div>
	</div>
	<?php
}
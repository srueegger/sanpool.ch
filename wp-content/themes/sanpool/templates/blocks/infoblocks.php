<?php
/* Diese Datei rendert die Info Blocks */
$id = 'infoblocks-' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'infoblocks';
if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>">
	<div class="container">
		<div class="row">
			<?php
			if(have_rows('block_infoblocks_infos')) {
				while(have_rows('block_infoblocks_infos')) {
					the_row();
					$typ = get_sub_field( 'typ' );
					$image = get_sub_field( 'image' );
					$link = get_sub_field( 'link' );
					$overlay_seen_container_no_animation = '';
					if(!$link) {
						$overlay_seen_container_no_animation = ' no-animation';
					}
					$class_array = array(
						'mb-kachel-card',
						'col-12',
						'col-md-6'
					);
					$raster = get_sub_field( 'raster' );
					$print_raster = 'col-lg-' . $raster;
					if($raster == 0) {
						$print_raster = 'col-lg';
					}
					array_push($class_array, $print_raster);
					$background_color_style = '';
					if($typ) {
						$background_color_style = ' style="background-color: ' . get_sub_field( 'bgcolor' ) . ';"';
					}
					?>
					<div class="<?php echo implode( ' ', $class_array ); ?>">
						<div<?php echo $background_color_style; ?> class="card h-100">
							<?php
							if(!$typ) {
								?>
								<div class="image-container">
									<picture>
										<source srcset="<?php echo $image['sizes']['infoblock-2x']; ?> 2x, <?php echo $image['sizes']['infoblock']; ?> 1x" />
										<img loading="lazy" src="<?php echo $image['sizes']['infoblock']; ?>" class="card-img-top" alt="<?php echo $image['alt']; ?>">
									</picture>
								</div>
								<?php
							}
							?>
							<div class="overlay-seen-container<?php echo $overlay_seen_container_no_animation; ?>">
								<div class="inner">
									<h4 class="text-white custom-text-shadow"><?php the_sub_field( 'titel' ) ?></h4>
									<?php
									if($link) {
										/* Icon nur anzeigen, wenn ein Link vorhanden ist */
										?>
										<div class="text-center mt-3">
											<span class="fa-stack fa-2x text-white">
												<i class="fal fa-circle fa-stack-2x"></i>
												<i class="fas fa-plus fa-stack-1x fa-inverse"></i>
											</span>
										</div>
										<?php
									}
									?>
								</div>
							</div>
							<?php if( $link ) {
								/* Overlay Container nur anzeigen wenn ein Link vorhanden ist */
								?>
								<div class="overlay-container full">
									<div class="inner">
										<?php the_sub_field( 'txt' ); ?>
										<div class="text-center mt-3">
											<a href="<?php echo $link ?>" target="_self">
												<span class="fa-stack fa-2x text-white">
													<i class="fal fa-circle fa-stack-2x"></i>
													<i class="fas fa-plus fa-stack-1x fa-inverse"></i>
												</span>
											</a>
										</div>
									</div>
								</div>
								<?php
							}
							?>
						</div>
					</div>
					<?php
				}
			}
			?>
		</div>
	</div>
</div>
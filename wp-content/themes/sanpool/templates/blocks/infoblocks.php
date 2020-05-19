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
		<div class="row justify-content-center">
			<?php
			$total_blocks = count( get_field('block_infoblocks_infos') );
			if(have_rows('block_infoblocks_infos')) {
				while(have_rows('block_infoblocks_infos')) {
					the_row();
					$image = get_sub_field('image');
					$class_array = array(
						'mb-3',
						'col-12',
						'col-md-6'
					);
					/* Desktop Grösse berechnen bei Total 4 einträgen */
					if($total_blocks == 4 && get_row_index() <= 3) {
						array_push($class_array, 'col-lg-4');
					}
					if($total_blocks == 4 && get_row_index() > 3) {
						array_push($class_array, 'col-lg-12');
					}
					/* Desktop Grösse berechnen bei Total 5 einträgen */
					if($total_blocks == 5 && get_row_index() <= 3) {
						array_push($class_array, 'col-lg-4');
					}
					if($total_blocks == 5 && get_row_index() > 3) {
						array_push($class_array, 'col-lg-6');
					}
					?>
					<div class="<?php echo implode( ' ', $class_array ); ?>">
						<div class="card">
							<div class="image-container">
								<picture>
									<source srcset="<?php echo $image['sizes']['infoblock-2x']; ?> 2x, <?php echo $image['sizes']['infoblock']; ?> 1x" />
									<img loading="lazy" src="<?php echo $image['sizes']['infoblock']; ?>" class="card-img-top" alt="<?php echo $image['alt']; ?>">
								</picture>
							</div>
							<div class="overlay-seen-container">
								<div class="inner">
									<h4 class="text-white"><?php echo $image['title']; ?></h4>
									<div class="text-center mt-3">
										<span class="fa-stack fa-2x text-white">
											<i class="fal fa-circle fa-stack-2x"></i>
											<i class="fas fa-plus fa-stack-1x fa-inverse"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="overlay-container">
								<div class="inner">
									<p><?php echo $image['caption']; ?></p>
									<div class="text-center mt-3">
										<a href="<?php the_sub_field('link'); ?>" target="_self">
											<span class="fa-stack fa-2x text-white">
												<i class="fal fa-circle fa-stack-2x"></i>
												<i class="fas fa-plus fa-stack-1x fa-inverse"></i>
											</span>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php
				}
			}
			?>
		</div>
	</div>
</div>
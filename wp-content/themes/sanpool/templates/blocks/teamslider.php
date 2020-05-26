<?php
/* Diese Datei rendert den Teamslider Block */
$id = 'teamslider-' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'teamslider';
if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
	$className .= ' align' . $block['align'];
}
?>
</div></div></div>
<div class="container course-container">
	<div class="row">
		<div class="col-12 mb-4">
			<h2 class="h1 text-primary"><?php the_field('block_teamslider_title'); ?></h2>
		</div>
		<div class="col-12">
			<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>">
				<?php
					/* Alle Teammitglieder ausgeben */
					$args = array(
						'numberposts' => -1,
						'post_status' => 'publish',
						'post_type' => 'sp_team',
						'suppress_filters' => false
					);
					$team = get_posts($args);
					if(!empty($team)) {
						echo '<div class="teamSlider owl-carousel owl-theme">';
						global $post;
						foreach($team as $post) {
							setup_postdata( $post );
							$image = get_field('team_image', get_the_ID());
							?>
							<div class="item">
								<div class="card">
									<div class="image-container">
										<picture>
											<img src="<?php echo $image['url']; ?>" class="card-img-top img-team-cat" alt="<?php echo $image['alt']; ?>">
										</picture>
									</div>
									<div class="card-body">
										<h5 class="card-title"><?php the_title(); ?></h5>
										<p class="card-text"><?php the_field('team_funktion', get_the_ID()); ?></p>
									</div>
								</div>
							</div>
							<?php
						}
						wp_reset_postdata();
						echo '</div>';
					}
				?>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row justify-content-center">
		<div class="col-12 col-lg-10">
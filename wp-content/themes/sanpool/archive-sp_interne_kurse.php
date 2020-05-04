<?php
/* Template zeigt die Kurskategorien an */
get_header();
?>
<main>
	<div class="container">
		<div class="row">
			<div class="col-12 mt-4">
				<h1>Kurse</h1>
			</div>
			<div class="col-12 mt-5">
				<?php
				$args = array(
					'taxonomy' => 'sp_kurskategorien',
					'hide_empty' => false
				);
				$terms = get_terms($args);
				if(!empty($terms)) {
					echo '<div class="row">';
					foreach($terms as $term) {
						/* Kursstatus auslesen */
						$status = get_field('kurskategorie_status', $term);
						/* Einzelne Kategorie als Card ausgeben */
						$image = get_field('kurskategorie_image', $term);
						/* Kurskategorie nur anzeigen wenn der Status "aktiv (1)" ist */
						if($status == 1) {
							?>
							<div class="col-12 col-md-6 col-lg-4 mb-4">
								<div class="card h-100">
									<div class="image-container">
										<picture>
											<source srcset="<?php echo $image['sizes']['kurs-box-2x']; ?> 2x, <?php echo $image['sizes']['kurs-box']; ?> 1x" />
											<img loading="lazy" src="<?php echo $image['sizes']['kurs-box']; ?>" class="card-img-top img-kurs-cat" alt="<?php echo $image['alt']; ?>">
										</picture>
									</div>
									<div class="card-body">
										<h2 class="h5 card-title"><?php echo $term->name; ?></h2>
										<p class="card-text"><?php the_field('kurskategorie_shortdesc', $term); ?></p>
									</div>
									<div class="card-footer">
										<a href="<?php echo get_term_link($term, 'sp_kurskategorien'); ?>" class="btn btn-primary w-100">Details / Termine</a>
									</div>
								</div>
							</div>
							<?php
						}
					}
					echo '</div>';
				} else {
					echo '<p>Es wurden keine Kurskategorien gefunden</p>';
				}
				?>
			</div>
		</div>
	</div>
	<div class="container-fluid course-container mt-3">
		<div class="row">
			<div class="col-12 my-4">
				<h2 class="h1 text-primary">Unsere nächste Kurse</h2>
			</div>
			<div class="col-12">
				<?php
				/* Kurse laden und in einem Loop ausgeben */
				$date_now = date('Ymd');
				$args = array(
					'numberposts' => -1,
					'post_status' => 'publish',
					'post_type' => 'sp_interne_kurse',
					'order' => 'ASC',
					'orderby' => 'meta_value',
					'meta_key' => 'kurse_beginn',
					'meta_query' => array(
						'relation' => 'AND',
						array(
							'key' => 'kurse_beginn',
							'compare' => '>=',
							'value' => $date_now,
							'type' => 'DATE',
						),
						array(
							'key' => 'kurse_storniert',
							'value' => 0,
							'compare' => '=',
							'type' => 'NUMERIC'
						)
					)
				);
				$kurse = get_posts($args);
				if(!empty($kurse)) {
					echo '<div class="courseSlider owl-carousel owl-theme">';
					global $post;
					foreach($kurse as $post) {
						setup_postdata( $post );
						get_template_part( 'templates/kurs', 'loop' );
					}
					wp_reset_postdata();
					echo '</div>';
				}
				?>
			</div>
		</div>
	</div>
</main>
<?php
get_footer();
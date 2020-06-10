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
							/* Richtige Felder je Sprache ausgeben */
							if(ICL_LANGUAGE_CODE == 'de') {
								$title = $term->name;
								$shortdesc = get_field( 'kurskategorie_shortdesc', $term );
							} else {
								$lang = ICL_LANGUAGE_CODE;
								$title = get_field( 'kurskategorie_title_'.$lang, $term );
								$shortdesc = get_field( 'kurskategorie_shortdesc_'.$lang, $term );
							}
							$term_link = get_term_link($term, 'sp_kurskategorien');
							if(ICL_LANGUAGE_CODE != 'de') {
								$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
								$domain = $_SERVER['HTTP_HOST'];
								$lng_base_url = $protocol.$domain;
								$term_link = $lng_base_url . '/' . ICL_LANGUAGE_CODE . '/kurskategorie/' . $term->slug . '/';
							}
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
										<h2 class="h5 card-title"><?php echo $title; ?></h2>
										<p class="card-text"><?php echo $shortdesc; ?></p>
									</div>
									<div class="card-footer">
										<a href="<?php echo $term_link; ?>" class="btn btn-primary w-100"><?php echo apply_filters( 'wpml_translate_single_string', 'Details / Termine', 'sp-theme', 'Details / Termine' ); ?></a>
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
	<div class="container course-container mt-3">
		<div class="row justify-content-center">
			<div class="col-10 my-4">
				<h2 class="h1 text-primary"><?php echo apply_filters( 'wpml_translate_single_string', 'Unsere nächste Kurse', 'sp-theme', 'Unsere nächste Kurse' ); ?></h2>
			</div>
			<div class="col-10">
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
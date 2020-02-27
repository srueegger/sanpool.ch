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
						/* Einzelne Kategorie als Card ausgeben */
						$image = get_field('kurskategorie_image', $term);
						?>
						<div class="col-4 mb-4">
							<div class="card h-100">
								<div class="image-container">
									<picture>
										<img data-src="<?php echo $image['url']; ?>" class="card-img-top lazy img-kurs-cat" alt="<?php echo $image['alt']; ?>">
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
				<div class="courseSlider owl-carousel owl-theme">
					<?php
					for($i = 1; $i <= 6; $i++) {
						get_template_part( 'templates/kurs', 'loop' );
					}
					?>
				</div>
			</div>
		</div>
	</div>
</main>
<?php
get_footer();
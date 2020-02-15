<?php
/* Kurs Kategorie Detailansicht */
get_header();
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$image = get_field('kurskategorie_image', $term);
?>
<main>
	<div>
		<div class="row no-gutters">
			<div class="col-12">
				<picture>
					<img src="<?php echo $image['url']; ?>" class="lazy kurs-term-image" alt="<?php echo $image['alt']; ?>">
				</picture>
			</div>
		</div>
		<div class="container">
			<div class="row mt-4">
				<div class="col-12">
					<h1><?php echo $term->name; ?></h1>
					<h2 class="mt-2 mb-4 h3"><?php the_field('kurskategorie_subtitle', $term); ?></h2>
					<?php the_field('kurskategorie_longdesc', $term); ?>
				</div>
				<?php
				/* Akkordeon anzeigen - sofern es Inhalte gibt */
				if(have_rows('kurskategorie_infos', $term)) {
					?>
					<div class="col-12 mt-3">
						<div class="accordion sanpool-accordion" id="accordion-term-<?php echo $term->term_id; ?>">
							<?php
							while(have_rows('kurskategorie_infos', $term)) {
								the_row();
								$rowIndex = get_row_index();
								$expanded = 'false';
								$show = '';
								$iconclose = 'block';
								$iconopen = 'none';
								if($rowIndex == 1) {
									$expanded = 'true';
									$show = ' show';
									$iconclose = 'none';
									$iconopen = 'block';
								}
								?>
								<div class="card">
									<div class="card-header" id="heading-<?php echo $rowIndex; ?>">
										<h2 class="mb-0" data-toggle="collapse" data-target="#collapse-<?php echo $rowIndex; ?>" aria-expanded="<?php echo $expanded; ?>" aria-controls="collapse-<?php echo $rowIndex; ?>">
											<?php the_sub_field('title'); ?>
											<span class="icon float-right">
												<i style="display: <?php echo $iconclose; ?>;" class="far fa-angle-down fa-1x iconclosed"></i>
												<i style="display: <?php echo $iconopen; ?>;" class="far fa-times fa-1x iconopened"></i>
											</span>
										</h2>
									</div>
									<div id="collapse-<?php echo $rowIndex; ?>" class="collapse<?php echo $show; ?>" aria-labelledby="heading-<?php echo $rowIndex; ?>" data-parent="#accordion-term-<?php echo $term->term_id; ?>">
										<div class="card-body">
											<?php the_sub_field('txt'); ?>
										</div>
									</div>
								</div>
								<div class="clearfix"></div>
								<?php
							}
							?>
						</div>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>
</main>
<?php
get_footer();
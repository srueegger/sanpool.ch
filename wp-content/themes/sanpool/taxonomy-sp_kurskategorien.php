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
					<img loading="lazy" src="<?php echo $image['url']; ?>" class="kurs-term-image" alt="<?php echo $image['alt']; ?>">
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
		<div class="kurse-table-container my-5">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="kurse-table">
							<div class="kurse-table__head">
								<div class="kurse-table__head--item kurse-table__head--item--1">Status</div>
								<div class="kurse-table__head--item kurse-table__head--item--2">Bezeichnung</div>
								<div class="kurse-table__head--item kurse-table__head--item--3">Sprache</div>
								<div class="kurse-table__head--item kurse-table__head--item--4">von - bis</div>
								<div class="kurse-table__head--item kurse-table__head--item--5">Ort</div>
								<div class="kurse-table__head--item kurse-table__head--item--6">Anmelden</div>
							</div>
							<div class="kurse-table__body">
								<?php
								/* Kurse die zum Taxonomy gehören abrufen und ausgeben */
								$date_now = date('Ymd');
								$args = array(
									'numberposts' => -1,
									'post_status' => 'publish',
									'post_type' => 'sp_interne_kurse',
									'order' => 'ASC',
									'orderby' => 'meta_value_num',
									'meta_key' => 'kurse_beginn',
									'tax_query' => array(
										array(
											'taxonomy' => $term->taxonomy,
											'field' => 'term_id',
											'terms' => $term->term_id
										)
										),
									'meta_query' => array(
										array(
											'key' => 'kurse_beginn',
											'compare' => '>=',
											'value' => $date_now,
											'type' => 'DATE',
										)
									)
								);
								$kurse = get_posts($args);
								if(!empty($kurse)) {
									/* Es sind Kurse vorhanden - Kurse ausgeben */
									global $post;
									foreach($kurse as $post) {
										setup_postdata( $post );
										/* Status ermitteln:
											Status 0 = Plätze verfügbar
											Status 1 = Ausgebucht
											Status 2 = Storniert
										*/
										//$status = get_field('kurse_status');
										$lng = get_field( 'kurse_lng' );
										$status['value'] = 0;
										$status_print = '';
										if($status['value'] == 0) {
											$status_print = '<span data-toggle="tooltip" data-placement="top" title="'.$status['label'].'" class="kurs-status"><i class="fas fa-check-circle fa-fw fa-lg text-success"></i></span>';
										}elseif($status['value'] == 1) {
											$status_print = '<span data-toggle="tooltip" data-placement="top" title="'.$status['label'].'" class="kurs-status"><i class="fas fa-minus-circle fa-fw fa-lg text-warning"></i></span>';
										}elseif($status['value'] == 2) {
											$status_print = '<span data-toggle="tooltip" data-placement="top" title="'.$status['label'].'" class="kurs-status"><i class="fas fa-times-circle fa-fw fa-lg text-danger"></i></span>';
										}
										?>
										<div class="kurse-table__body--row">
											<div class="kurse-table__body--item kurse-table__body--item--1"><?php echo $status_print; ?></div>
											<div class="kurse-table__body--item kurse-table__body--item--2"><?php the_title(); ?></div>
											<div class="kurse-table__body--item kurse-table__body--item--3"><?php echo strtoupper( $lng['value'] ); ?></div>
											<div class="kurse-table__body--item kurse-table__body--item--4"><?php the_field('kurse_beginn'); ?> - <?php the_field('kurse_kursende'); ?></div>
											<div class="kurse-table__body--item kurse-table__body--item--5"><?php the_field('kurse_ort'); ?></div>
											<div class="kurse-table__body--item kurse-table__body--item--6"><a href="<?php the_permalink(); ?>" class="btn btn-primary">Anmelden</a></div>
										</div>
										<?php
									}
									wp_reset_postdata();
								} else {
									/* Es sind keine Kurse vorhanden Fehlermeldung ausgeben */
									echo '<div class="kurse-table__body--row"><div class="kurse-table__body--item kurse-table__body--item--fullwidth">Es sind zurzet keine Kurse in dieser Kategorie vorhanden.</div></div>';
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php
get_footer();
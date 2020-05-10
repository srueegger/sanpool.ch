<?php
/* Kurs Kategorie Detailansicht */
get_header();
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$image = get_field('kurskategorie_image', $term);
$total_anzahl_teilnehmer = get_field('kurskategorie_teilnehmer', $term);
/* Die Schwelle liegt bei 75% */
$total_anzahl_teilnehmer_schwelle = $total_anzahl_teilnehmer / 100 * 75;
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
								<div class="kurse-table__head--item kurse-table__head--item--2">Kurs-Nr.</div>
								<div class="kurse-table__head--item kurse-table__head--item--3">Sprache</div>
								<div class="kurse-table__head--item kurse-table__head--item--4">Datum (von - bis)</div>
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
										$lng = get_field( 'kurse_lng' );
										/* Bisherige Kursteilnehmer ermitteln */
										$search_criteria = array();
										$search_criteria['status'] = 'active';
										$search_criteria['field_filters'][] = array( 'key' => '1', 'value' => get_the_ID() );
										$bisherige_teilnehmer = GFAPI::count_entries(1, $search_criteria); //Form ID, Suchkriterien
										/* Status ermitteln:
											Wenn mehr als 75% der Plätze verfügbar sind:
											_Grünes Icon und Text Plätze verfügbar
											Wenn weniger als 75% der Plätze verfügbar sind:
											_Gelb/Oranges Icon und Text "Wenig Plätze verfügbar"
											Wenn keine Plätze verfügbar sind:
											_Rotes Icon (Dreieck) keine Plätze verfügbar
										*/
										$subscribe_button = '<button data-postid="'.get_the_ID().'" data-kursnummer="'.get_the_title().'" type="button" class="btn btn-primary w-100 js_subscribe_course">Anmelden</button>';
										/* Genügend freie Plätze */
										if($bisherige_teilnehmer < $total_anzahl_teilnehmer_schwelle && $bisherige_teilnehmer < $total_anzahl_teilnehmer) {
											$status_print = '<span data-toggle="tooltip" data-placement="top" title="Plätze verfügbar" class="kurs-status"><i class="fas fa-check-circle fa-fw fa-lg text-success"></i></span>';
											/* Wenig Plätze verfügbar */
										} elseif($bisherige_teilnehmer >= $total_anzahl_teilnehmer_schwelle && $bisherige_teilnehmer < $total_anzahl_teilnehmer) {
											$status_print = '<span data-toggle="tooltip" data-placement="top" title="Wenig Plätze verfügbar" class="kurs-status"><i class="fas fa-check-circle fa-fw fa-lg text-warning"></i></span>';
											/* Kurs ist ausgebucht */
										} elseif($bisherige_teilnehmer > $total_anzahl_teilnehmer_schwelle && $bisherige_teilnehmer >= $total_anzahl_teilnehmer) {
											$status_print = '<span data-toggle="tooltip" data-placement="top" title="Kurs ist ausgebucht" class="kurs-status"><i class="fas fa-exclamation-triangle fa-fw fa-lg text-danger"></i></span>';
											/* Button disabeln */
											$subscribe_button = '<button type="button" class="btn btn-primary w-100" disabled>Anmeldung</button>';
										}
										?>
										<div class="kurse-table__body--row">
											<div class="kurse-table__body--item kurse-table__body--item--1"><?php echo $status_print; ?></div>
											<div class="kurse-table__body--item kurse-table__body--item--2"><?php the_title(); ?></div>
											<div class="kurse-table__body--item kurse-table__body--item--3"><?php echo strtoupper( $lng['value'] ); ?></div>
											<div class="kurse-table__body--item kurse-table__body--item--4"><?php the_field('kurse_beginn'); ?> - <?php the_field('kurse_kursende'); ?></div>
											<div class="kurse-table__body--item kurse-table__body--item--5"><?php the_field('kurse_ort'); ?></div>
											<div class="kurse-table__body--item kurse-table__body--item--6"><?php echo $subscribe_button; ?></div>
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
		<div id="courseSubscribe" class="container">
			<div class="inner">
				<div class="row">
					<div class="col-12">
						<h2>Anmeldung für Kurs: <span id="subscribe-kursnr"></span></h2>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<?php echo do_shortcode( '[gravityform id="1" title="false" description="false" ajax="true"]' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php
get_footer();
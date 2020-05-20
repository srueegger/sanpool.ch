<?php
/* Kurs Kategorie Detailansicht */
get_header();
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$image = get_field('kurskategorie_image', $term);
$total_anzahl_teilnehmer = get_field('kurskategorie_teilnehmer', $term);
/* Die Schwelle liegt bei xx Prozent */
$the_percent = get_field( 'course_setting_percent_range', 'option' );
$total_anzahl_teilnehmer_schwelle = $total_anzahl_teilnehmer / 100 * $the_percent;
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
					<h1 class="category-title"><?php echo $term->name; ?></h1>
					<h2 class="mt-2 mb-4 h3"><?php the_field('kurskategorie_subtitle', $term); ?></h2>
					<?php the_field('kurskategorie_longdesc', $term); ?>
				</div>
				<?php
				/* Akkordeon anzeigen - sofern es Inhalte gibt */
				if(have_rows('kurskategorie_infos', $term)) {
					$identifier = 'accordion-term-'.$term->term_id;
					?>
					<div class="col-12 mt-3">
						<div class="accordion sanpool-accordion" id="<?php echo $identifier; ?>">
							<?php
							while(have_rows('kurskategorie_infos', $term)) {
								the_row();
								$rowIndex = get_row_index();
								$title = get_sub_field('title');
								$txt = get_sub_field('txt');
								sp_render_accordeon_content($identifier, $rowIndex, $title, $txt);
							}
							?>
						</div>
					</div>
					<?php
				}
				?>
			</div>
		</div>
		<div class="kurse-table-container mt-5">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="kurse-table">
							<div class="kurse-table__head">
								<div class="kurse-table__head--item kurse-table__head--item--1">Status</div>
								<div class="kurse-table__head--item kurse-table__head--item--2">Kurs-Nr.</div>
								<div class="kurse-table__head--item kurse-table__head--item--3">Sprache</div>
								<div class="kurse-table__head--item kurse-table__head--item--4">Datum (von - bis)</div>
								<div class="kurse-table__head--item kurse-table__head--item--5">Wochentage</div>
								<div class="kurse-table__head--item kurse-table__head--item--6">Ort</div>
								<div class="kurse-table__head--item kurse-table__head--item--7">Anmelden</div>
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
										$subscribe_button = '<button data-postid="'.get_the_ID().'" data-kursnummer="'.get_the_title().'" type="button" class="btn btn-primary js_subscribe_course">Anmelden</button>';
										/* Genügend freie Plätze */
										if($bisherige_teilnehmer < $total_anzahl_teilnehmer_schwelle && $bisherige_teilnehmer < $total_anzahl_teilnehmer) {
											$status_print = '<span data-toggle="tooltip" data-placement="top" title="Plätze verfügbar" class="kurs-status"><i class="fas fa-check-circle fa-fw text-success"></i></span>';
											/* Wenig Plätze verfügbar */
										} elseif($bisherige_teilnehmer >= $total_anzahl_teilnehmer_schwelle && $bisherige_teilnehmer < $total_anzahl_teilnehmer) {
											$status_print = '<span data-toggle="tooltip" data-placement="top" title="Wenig Plätze verfügbar" class="kurs-status"><i class="fas fa-check-circle fa-fw text-warning"></i></span>';
											/* Kurs ist ausgebucht */
										} elseif($bisherige_teilnehmer > $total_anzahl_teilnehmer_schwelle && $bisherige_teilnehmer >= $total_anzahl_teilnehmer) {
											$status_print = '<span data-toggle="tooltip" data-placement="top" title="Kurs ist ausgebucht" class="kurs-status"><i class="fas fa-exclamation-triangle fa-fw text-danger"></i></span>';
											/* Button disabeln */
											$subscribe_button = '<button type="button" class="btn btn-primary" disabled>Anmeldung</button>';
										}
										?>
										<div class="kurse-table__body--row">
											<div class="kurse-table__body--item kurse-table__body--item--1"><?php echo $status_print; ?></div>
											<div class="kurse-table__body--item kurse-table__body--item--2"><?php the_title(); ?></div>
											<div class="kurse-table__body--item kurse-table__body--item--3"><i class="fal fa-comment-dots fa-fw mr-2"></i><?php echo strtoupper( $lng['value'] ); ?></div>
											<div class="kurse-table__body--item kurse-table__body--item--4"><i class="fal fa-calendar-check fa-fw mr-2"></i><span class="<?php echo get_the_ID(); ?>-date"><?php the_field('kurse_beginn'); ?> - <?php the_field('kurse_kursende'); ?></span></div>
											<div class="kurse-table__body--item kurse-table__body--item--5">
												<?php
												$wochentage = get_field('kurse_wochentage');
												if(!empty($wochentage)) {
													foreach($wochentage as $wochentag) {
														echo '<span data-toggle="tooltip" data-placement="bottom" title="'.$wochentag['label'].'">'.strtoupper( $wochentag['value'] ).'</span>';
													}
												}
												?>
											</div>
											<div class="kurse-table__body--item kurse-table__body--item--6"><i class="fal fa-map-marker-alt fa-fw mr-2"></i><?php the_field('kurse_ort'); ?></div>
											<div class="kurse-table__body--item kurse-table__body--item--7"><?php echo $subscribe_button; ?></div>
										</div>
										<?php
									}
									wp_reset_postdata();
								} else {
									/* Es sind keine Kurse vorhanden Fehlermeldung ausgeben */
									echo '<div class="kurse-table__body--row"><div class="kurse-table__body--item kurse-table__body--item--fullwidth">'.get_field( 'course_setting_nocourses', 'option' ).'</div></div>';
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
						<h2>Anmeldung für Kurs: <span id="subscribe-kursnr"></span> - <span id="subscribe-category"></span> - <span id="subscribe-date"></span></h2>
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
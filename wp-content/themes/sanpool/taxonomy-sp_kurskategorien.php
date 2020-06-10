<?php
/* Kurs Kategorie Detailansicht */
get_header();
$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
$image = get_field('kurskategorie_image', $term);
$total_anzahl_teilnehmer = get_field('kurskategorie_teilnehmer', $term);
/* Die Schwelle liegt bei xx Prozent */
$the_percent = get_field( 'course_setting_percent_range', 'option' );
$total_anzahl_teilnehmer_schwelle = $total_anzahl_teilnehmer / 100 * $the_percent;
/* Übersetzungen */
$title = $term->name;
$subtitle = get_field( 'kurskategorie_subtitle', $term );
$description = get_field( 'kurskategorie_longdesc', $term );
$cat_infos = 'kurskategorie_infos';
if(ICL_LANGUAGE_CODE != 'de') {
	$title = get_field( 'kurskategorie_title_' . ICL_LANGUAGE_CODE, $term );
	$subtitle = get_field( 'kurskategorie_subtitle_' . ICL_LANGUAGE_CODE, $term );
	$description = get_field( 'kurskategorie_longdesc_fr', $term );
	$cat_infos = 'kurskategorie_infos_' . ICL_LANGUAGE_CODE;
}
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
					<h1 class="category-title"><?php echo $title; ?></h1>
					<h2 class="mt-2 mb-4 h3"><?php echo $subtitle; ?></h2>
					<?php echo $description; ?>
				</div>
				<?php
				/* Akkordeon anzeigen - sofern es Inhalte gibt */
				if( have_rows( $cat_infos, $term ) ) {
					$identifier = 'accordion-term-'.$term->term_id;
					?>
					<div class="col-12 mt-3">
						<div class="accordion sanpool-accordion" id="<?php echo $identifier; ?>">
							<?php
							while( have_rows( $cat_infos, $term) ) {
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
								<div class="kurse-table__head--item kurse-table__head--item--1"><?php echo apply_filters( 'wpml_translate_single_string', 'Status', 'sp-theme', 'Status' ); ?></div>
								<div class="kurse-table__head--item kurse-table__head--item--2"><?php echo apply_filters( 'wpml_translate_single_string', 'Kurs-Nr.', 'sp-theme', 'Kurs-Nr.' ); ?></div>
								<div class="kurse-table__head--item kurse-table__head--item--3"><?php echo apply_filters( 'wpml_translate_single_string', 'Sprache', 'sp-theme', 'Sprache' ); ?></div>
								<div class="kurse-table__head--item kurse-table__head--item--4"><?php echo apply_filters( 'wpml_translate_single_string', 'Datum (von - bis)', 'sp-theme', 'Datum (von - bis)' ); ?></div>
								<div class="kurse-table__head--item kurse-table__head--item--5"><?php echo apply_filters( 'wpml_translate_single_string', 'Wochentage', 'sp-theme', 'Wochentage' ); ?></div>
								<div class="kurse-table__head--item kurse-table__head--item--6"><?php echo apply_filters( 'wpml_translate_single_string', 'Ort', 'sp-theme', 'Ort' ); ?></div>
								<div class="kurse-table__head--item kurse-table__head--item--7"><?php echo apply_filters( 'wpml_translate_single_string', 'Anmelden', 'sp-theme', 'Anmelden' ); ?></div>
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
									/* Es sind Kurse vorhanden - Kurse ausgeben */
									global $post;
									foreach($kurse as $post) {
										setup_postdata( $post );
										$lng = get_field( 'kurse_lng' );
										/* Bisherige Kursteilnehmer ermitteln */
										$bisherige_teilnehmer = sp_count_subs_by_course_id( get_the_ID(), false );
										/* Status ermitteln:
											Wenn mehr als 75% der Plätze verfügbar sind:
											_Grünes Icon und Text Plätze verfügbar
											Wenn weniger als 75% der Plätze verfügbar sind:
											_Gelb/Oranges Icon und Text "Wenig Plätze verfügbar"
											Wenn keine Plätze verfügbar sind:
											_Rotes Icon (Dreieck) Kurs ist ausgebucht
										*/
										$subscribe_button = '<button data-postid="'.get_the_ID().'" data-kursnummer="'.get_the_title().'" type="button" class="btn btn-primary js_subscribe_course">
										' . apply_filters( 'wpml_translate_single_string', 'Anmelden', 'sp-theme', 'Anmelden' ) . '</button>';
										/* Genügend freie Plätze */
										if($bisherige_teilnehmer < $total_anzahl_teilnehmer_schwelle && $bisherige_teilnehmer < $total_anzahl_teilnehmer) {
											$status_print = '<span data-toggle="tooltip" data-placement="top" title="' . apply_filters( 'wpml_translate_single_string', 'Plätze verfügbar', 'sp-theme', 'Plätze verfügbar' ) . '" class="kurs-status"><i class="fas fa-check-circle fa-fw text-success"></i></span>';
											/* Wenig Plätze verfügbar */
										} elseif($bisherige_teilnehmer >= $total_anzahl_teilnehmer_schwelle && $bisherige_teilnehmer < $total_anzahl_teilnehmer) {
											$status_print = '<span data-toggle="tooltip" data-placement="top" title="' . apply_filters( 'wpml_translate_single_string', 'Wenig Plätze verfügbar', 'sp-theme', 'Wenig Plätze verfügbar' ) . '" class="kurs-status"><i class="fas fa-check-circle fa-fw text-warning"></i></span>';
											/* Kurs ist ausgebucht */
										} elseif($bisherige_teilnehmer > $total_anzahl_teilnehmer_schwelle && $bisherige_teilnehmer >= $total_anzahl_teilnehmer) {
											$status_print = '<span data-toggle="tooltip" data-placement="top" title="' . apply_filters( 'wpml_translate_single_string', 'Kurs ist ausgebucht', 'sp-theme', 'Kurs ist ausgebucht' ) . '" class="kurs-status"><i class="fas fa-exclamation-triangle fa-fw text-danger"></i></span>';
											/* Button disabeln */
											$subscribe_button = '<button type="button" class="btn btn-primary" disabled>' . apply_filters( 'wpml_translate_single_string', 'Anmelden', 'sp-theme', 'Anmelden' ) . '</button>';
										}
										?>
										<div class="kurse-table__body--row">
											<div class="kurse-table__body--item kurse-table__body--item--1"><?php echo $status_print; ?></div>
											<div class="kurse-table__body--item kurse-table__body--item--2"><?php the_title(); ?></div>
											<div class="kurse-table__body--item kurse-table__body--item--3"><i class="fal fa-comment-dots fa-fw mr-2"></i><?php echo apply_filters( 'wpml_translate_single_string', strtoupper( $lng['value'] ), 'sp-theme', strtoupper( $lng['value'] ) ); ?></div>
											<div class="kurse-table__body--item kurse-table__body--item--4"><i class="fal fa-calendar-check fa-fw mr-2"></i><span class="<?php echo get_the_ID(); ?>-date"><?php the_field('kurse_beginn'); ?> - <?php the_field('kurse_kursende'); ?></span></div>
											<div class="kurse-table__body--item kurse-table__body--item--5">
												<?php
												$wochentage = get_field('kurse_wochentage');
												if(!empty($wochentage)) {
													foreach($wochentage as $wochentag) {
														echo '<span data-toggle="tooltip" data-placement="bottom" title="' . apply_filters( 'wpml_translate_single_string',  $wochentag['label'], 'sp-theme', $wochentag['label'] ) . '">'. apply_filters( 'wpml_translate_single_string', strtoupper( $wochentag['value'] ), 'sp-theme', strtoupper( $wochentag['value'] ) ) .'</span>';
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
						<h2><?php echo apply_filters( 'wpml_translate_single_string', 'Anmeldung für Kurs:', 'sp-theme', 'Anmeldung für Kurs:' ); ?> <span id="subscribe-kursnr"></span> - <span id="subscribe-category"></span> - <span id="subscribe-date"></span></h2>
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
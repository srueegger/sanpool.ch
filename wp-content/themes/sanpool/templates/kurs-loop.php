<?php
/* Kategorie des Kurses ermitteln - Ein Kurs kann nur in eine Kategorie sein - daher von der ersten Kategorie ausgehen */
$terms = wp_get_post_terms( get_the_ID(), 'sp_kurskategorien' );
$image = get_field( 'kurskategorie_image', $terms[0] );
$course_date = get_field( 'kurse_beginn', get_the_ID() );
$course_date_i18n = date_i18n( 'd.m.Y', strtotime($course_date) );
$course_lang = get_field( 'kurse_lng', get_the_ID() );
/* Sprachabhängige Felder ermitteln */
if(ICL_LANGUAGE_CODE == 'de') {
	$title = $terms[0]->name;
	$shortdesc = get_field( 'kurskategorie_shortdesc', $terms[0] );
} else {
	$lng = ICL_LANGUAGE_CODE;
	$title = get_field( 'kurskategorie_title_'.$lng, $terms[0] );
	$shortdesc = get_field( 'kurskategorie_shortdesc_'.$lng, $terms[0] );
}
$course_link = get_term_link( $terms[0], 'sp_kurskategorien' ) . '#' . get_the_ID() . ';' . urldecode(get_the_title());
if(ICL_LANGUAGE_CODE != 'de') {
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	$domain = $_SERVER['HTTP_HOST'];
	$lng_base_url = $protocol.$domain;
	$course_link = $lng_base_url . '/' . ICL_LANGUAGE_CODE . '/kurskategorie/' . $terms[0]->slug . '/#' . get_the_ID() . ';' . urldecode(get_the_title());
}
?>
<div class="item">
	<div class="card h-100">
		<div class="image-container">
			<picture>
				<source srcset="<?php echo $image['sizes']['infoblock-2x']; ?> 2x, <?php echo $image['sizes']['infoblock']; ?> 1x" />
				<img loading="lazy" src="<?php echo $image['sizes']['infoblock']; ?>" class="card-img-top" alt="<?php echo $image['alt']; ?>">
			</picture>
		</div>
		<div class="card-body">
			<h5 class="card-title"><?php echo $title; ?></h5>
			<p class="card-text mb-0"><?php echo $shortdesc; ?></p>
			<hr>
			<div class="row text-center">
				<div class="col">
					<div class="mb-2"><i class="fal fa-calendar-check fa-2x"></i></div>
					<div><?php echo $course_date_i18n; ?></div>
				</div>
				<div class="col">
					<div class="mb-2"><i class="fal fa-map-marker-alt fa-2x"></i></div>
					<div><?php the_field( 'kurse_ort', get_the_ID() ); ?></div>
				</div>
				<div class="col">
					<div class="mb-2"><i class="fal fa-comment-dots fa-2x"></i></div>
					<div><?php echo $course_lang['label']; ?></div>
				</div>
				<a href="<?php echo $course_link ?>" target="_self">
					<div class="overlay-container">
						<div class="inner">
							<h6 class="h3 text-white"><?php echo apply_filters( 'wpml_translate_single_string', 'Jetzt buchen', 'sp-theme', 'Jetzt buchen' ); ?></h6>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>
</div>
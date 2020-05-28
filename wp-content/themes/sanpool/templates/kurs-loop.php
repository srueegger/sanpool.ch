<?php
/* Kategorie des Kurses ermitteln - Ein Kurs kann nur in eine Kategorie sein - daher von der ersten Kategorie ausgehen */
$terms = wp_get_post_terms( get_the_ID(), 'sp_kurskategorien' );
$image = get_field( 'kurskategorie_image', $terms[0] );
$course_date = get_field( 'kurse_beginn', get_the_ID() );
$course_date_i18n = date_i18n( 'd.m.Y', strtotime($course_date) );
$course_lang = get_field( 'kurse_lng', get_the_ID() );
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
			<h5 class="card-title"><?php echo $terms[0]->name; ?></h5>
			<p class="card-text mb-0"><?php the_field( 'kurskategorie_shortdesc', $terms[0] ); ?></p>
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
				<a href="<?php echo get_term_link( $terms[0], 'sp_kurskategorien' ); ?>#<?php echo get_the_ID(); ?>;<?php echo urldecode(get_the_title()); ?>" target="_self">
					<div class="overlay-container">
						<div class="inner">
							<h6 class="h3 text-white">Jetzt buchen</h6>
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>
</div>
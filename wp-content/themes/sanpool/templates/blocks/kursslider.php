<?php
/* Diese Datei rendert die Info Icons */
$id = 'sp-kursslider-' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'sp-kursslider';
if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>">
	<div class="container course-container mt-3">
		<div class="row justify-content-center">
			<div class="col-10 my-4">
				<h2 class="h1 text-primary px-15"><?php the_field('block_kursslider_title'); ?></h2>
			</div>
			<div class="col-10">
				<?php
				/* Kurse laden und in einem Loop ausgeben */
				$date_now = date('Ymd');
				$categories = get_field( 'block_kursslider_cats' );
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
							'compare' => '>',
							'value' => $date_now,
							'type' => 'DATE',
						),
						array(
							'key' => 'kurse_storniert',
							'value' => 0,
							'compare' => '=',
							'type' => 'NUMERIC'
						)
					),
					'tax_query' => array(
						array(
							'taxonomy' => 'sp_kurskategorien',
							'field' => 'term_id',
							'terms' => $categories
						)
					)
				);
				$kurse = get_posts($args);
				if(!empty($kurse)) {
					echo '<div class="courseSlider owl-carousel owl-theme px-15">';
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
</div>
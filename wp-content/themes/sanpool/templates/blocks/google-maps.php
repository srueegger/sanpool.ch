<?php
/* Diese Datei rendert den "Zahlen und Fakten" Block */
$id = 'google-maps-' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'google-maps-block';
if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
	$className .= ' align' . $block['align'];
}
?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>">
	<?php
	if(have_rows( 'block_gm_locations' )) {
		echo '<div class="sanpool-map" data-zoom="14">';
		while(have_rows( 'block_gm_locations' )) {
			the_row();
			$location = get_sub_field( 'location' );
			echo '<div class="marker" data-lat="'.esc_attr( $location['lat'] ).'" data-lng="'.$location['lng'].'">';
			the_sub_field( 'description' );
			echo '</div>';
		}
		echo '</div>';
	}
	?>
</div>
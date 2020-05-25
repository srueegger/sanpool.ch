<?php
/* Diese Datei rendert den "Zahlen und Fakten" Block */
$id = 'google-maps-' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}
?>
<div id="<?php echo esc_attr( $id ); ?>">
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
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
		echo '<div class="container"><div class="row"><div class="col-12"><ul class="list-inline" id="mapMarkersLinks"></ul></div></div></div>';
		echo '<div class="sanpool-map" data-zoom="16">';
		while(have_rows( 'block_gm_locations' )) {
			the_row();
			$location = get_sub_field( 'location' );
			echo '<div class="marker" data-locationname="'.get_sub_field( 'name' ).'" data-lat="'.esc_attr( $location['lat'] ).'" data-lng="'.$location['lng'].'">';
			the_sub_field( 'description' );
			echo '</div>';
		}
		echo '</div>';
	}
	?>
</div>
<?php
/***************************************
 * Add Bootstrap Classes to Gravityforms Submit Button
 ***************************************/
function sp_add_custom_css_classes( $button, $form ) {
	$dom = new DOMDocument();
	$dom->loadHTML( $button );
	$input = $dom->getElementsByTagName( 'input' )->item(0);
	$classes = "btn btn-primary btn-lg";
	$input->setAttribute( 'class', $classes );
	return $dom->saveHtml( $input );
}
add_filter( 'gform_submit_button', 'sp_add_custom_css_classes', 10, 2 );


/***************************************
 * PLZ vor Ort im Adressfeld anzeigens
 ***************************************/
function sp_address_format( $format ) {
	return 'zip_before_city';
}
add_filter( 'gform_address_display_format', 'sp_address_format' );

/***************************************
 * Gravityform Export with Semicolon
 ***************************************/
function sp_change_separator( $separator, $form_id ) {
	return ';';
}
add_filter( 'gform_export_separator', 'sp_change_separator', 10, 2 );
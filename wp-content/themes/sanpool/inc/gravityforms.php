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

/***************************************
 * Beim Absenden des Kurs Buchen Formulars prüfen ob Kurs überhaupt noch gebucht werden darf / Anmeldeformular muss zwingend ID 1 aufweisen - kann sonst auf Wunsch nachträglich noch dynamisiert werden
 ***************************************/
function sp_check_gf_submission_subscribers_number( $validation_result ) {
	$form = $validation_result['form'];
	$kurs_post_id = rgpost( 'input_1' );
	/* Prüfen wie viele Anmeldungen es auf dieser Kurs ID schon gibt */
	$bisherige_teilnehmer = sp_count_subs_by_course_id( $kurs_post_id, false );
	/* Prüfen wie viele Personen maximal angemeldet sein dürfen */
	/* Kategorie ID des Kurses ermitteln */
	$terms = get_the_terms( $kurs_post_id, 'sp_kurskategorien' );
	$term_id = $terms[0]->term_id;
	$maximal_teilnehmer = get_field( 'kurskategorie_teilnehmer', 'term_' . $term_id );
	/* Prüfung vornehmen */
	if($bisherige_teilnehmer >= $maximal_teilnehmer) {
		/* Anmeldung muss verhindert werden, die maximale Teilnehmer Anzahl wurde erreicht */
		$validation_result['is_valid'] = false; /* Formvalidierung wird auf falsch gesetzt - damit kann das Formular nicht abgesendet werden, die Anmeldedaten werden nicht gespeichert */
		/* Entsprechende Fehlermeldung anzeigen */
		add_filter( 'gform_validation_message_1', function ( $message, $form ) {
			$message = '<div class="validation_error"><p class="mb-0">' . get_field( 'course_setting_sublimit', 'option' ) . '</p></div>';
			return $message;
		}, 10, 2 );
	}
	$validation_result['form'] = $form;
    return $validation_result;
}
add_filter( 'gform_validation_1', 'sp_check_gf_submission_subscribers_number' ); /* Diese Validierung funktioniert nur beim formular mit der ID 1 */
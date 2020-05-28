<?php
/***************************************
 *	 Register alls Strings for the WebPage
 ***************************************/
$sanpool_theme = wp_get_theme();
$text_domain = esc_attr( $sanpool_theme->get( 'TextDomain' ) );
/* archive-sp_interne_kurse.php */
do_action( 'wpml_register_single_string', $text_domain, 'Unsere nächste Kurse', 'Unsere nächste Kurse' );
/* taxonomy-sp_kurskategorien.php */
do_action( 'wpml_register_single_string', $text_domain, 'Status', 'Status' );
do_action( 'wpml_register_single_string', $text_domain, 'Kurs-Nr.', 'Kurs-Nr.' );
do_action( 'wpml_register_single_string', $text_domain, 'Sprache', 'Sprache' );
do_action( 'wpml_register_single_string', $text_domain, 'Datum (von - bis)', 'Datum (von - bis)' );
do_action( 'wpml_register_single_string', $text_domain, 'Wochentage', 'Wochentage' );
do_action( 'wpml_register_single_string', $text_domain, 'Ort', 'Ort' );
do_action( 'wpml_register_single_string', $text_domain, 'Anmelden', 'Anmelden' );
do_action( 'wpml_register_single_string', $text_domain, 'Anmeldung für Kurs:', 'Anmeldung für Kurs:' );
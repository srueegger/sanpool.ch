<?php
/***************************************
 *	 Register alls Strings for the WebPage
 ***************************************/
$sanpool_theme = wp_get_theme();
$text_domain = esc_attr( $sanpool_theme->get( 'TextDomain' ) );
/* archive-sp_interne_kurse.php */
do_action( 'wpml_register_single_string', $text_domain, 'Unsere nächste Kurse', 'Unsere nächste Kurse' );
do_action( 'wpml_register_single_string', $text_domain, 'Details / Termine', 'Details / Termine' );
do_action( 'wpml_register_single_string', $text_domain, 'Kurse', 'Kurse' );
/* taxonomy-sp_kurskategorien.php */
do_action( 'wpml_register_single_string', $text_domain, 'Status', 'Status' );
do_action( 'wpml_register_single_string', $text_domain, 'Kurs-Nr.', 'Kurs-Nr.' );
do_action( 'wpml_register_single_string', $text_domain, 'Sprache', 'Sprache' );
do_action( 'wpml_register_single_string', $text_domain, 'Datum (von - bis)', 'Datum (von - bis)' );
do_action( 'wpml_register_single_string', $text_domain, 'Wochentage', 'Wochentage' );
do_action( 'wpml_register_single_string', $text_domain, 'Ort', 'Ort' );
do_action( 'wpml_register_single_string', $text_domain, 'Anmelden', 'Anmelden' );
do_action( 'wpml_register_single_string', $text_domain, 'Anmeldung für Kurs:', 'Anmeldung für Kurs:' );
do_action( 'wpml_register_single_string', $text_domain, 'Plätze verfügbar', 'Plätze verfügbar' );
do_action( 'wpml_register_single_string', $text_domain, 'Wenig Plätze verfügbar', 'Wenig Plätze verfügbar' );
do_action( 'wpml_register_single_string', $text_domain, 'Kurs ist ausgebucht', 'Kurs ist ausgebucht' );
do_action( 'wpml_register_single_string', $text_domain, 'Anmelden', 'Anmelden' );
do_action( 'wpml_register_single_string', $text_domain, 'DE', 'DE' );
do_action( 'wpml_register_single_string', $text_domain, 'FR', 'FR' );
do_action( 'wpml_register_single_string', $text_domain, 'MO', 'MO' );
do_action( 'wpml_register_single_string', $text_domain, 'DI', 'DI' );
do_action( 'wpml_register_single_string', $text_domain, 'MI', 'MI' );
do_action( 'wpml_register_single_string', $text_domain, 'DO', 'DO' );
do_action( 'wpml_register_single_string', $text_domain, 'FR', 'FR' );
do_action( 'wpml_register_single_string', $text_domain, 'SA', 'SA' );
do_action( 'wpml_register_single_string', $text_domain, 'SO', 'SO' );
do_action( 'wpml_register_single_string', $text_domain, 'Montag', 'Montag' );
do_action( 'wpml_register_single_string', $text_domain, 'Dienstag', 'Dienstag' );
do_action( 'wpml_register_single_string', $text_domain, 'Mittwoch', 'Mittwoch' );
do_action( 'wpml_register_single_string', $text_domain, 'Donnerstag', 'Donnerstag' );
do_action( 'wpml_register_single_string', $text_domain, 'Freitag', 'Freitag' );
do_action( 'wpml_register_single_string', $text_domain, 'Samstag', 'Samstag' );
do_action( 'wpml_register_single_string', $text_domain, 'Sonntag', 'Sonntag' );
/* Kursslider */
do_action( 'wpml_register_single_string', $text_domain, 'Jetzt buchen', 'Jetzt buchen' );
do_action( 'wpml_register_single_string', $text_domain, 'Deutsch', 'Deutsch' );
do_action( 'wpml_register_single_string', $text_domain, 'Französisch', 'Französisch' );
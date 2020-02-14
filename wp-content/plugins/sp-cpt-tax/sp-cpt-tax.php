<?php
/**
 * Plugin Name: SanPool Custom Post Types
 * Plugin URI: https://rueegger.me
 * Description: Dieses Plugin managt die Custom Post Types für die SanPool Webseite
 * Author: Samuel Rüegger
 * Version: 1.0.1
 * Author URI: https://rueegger.me
 */

function cptui_register_my_cpts() {

	/**
	 * Post Type: Kurse.
	 */

	$labels = [
		"name" => __( "Kurse", "sp-theme" ),
		"singular_name" => __( "Kurs", "sp-theme" ),
		"menu_name" => __( "Kurse", "sp-theme" ),
		"all_items" => __( "Alle Kurse", "sp-theme" ),
		"add_new" => __( "Neuer Kurs", "sp-theme" ),
		"add_new_item" => __( "Neuer Kurs hinzufügen", "sp-theme" ),
		"edit_item" => __( "Kurs bearbeiten", "sp-theme" ),
		"view_item" => __( "Kurs ansehen", "sp-theme" ),
		"view_items" => __( "Kurse ansehen", "sp-theme" ),
		"search_items" => __( "Kurse suchen", "sp-theme" ),
		"not_found" => __( "Keine Kurse gefunden", "sp-theme" ),
		"not_found_in_trash" => __( "Keine Kurse im Papierkorb gefunden", "sp-theme" ),
		"item_published" => __( "Kurs veröffentlicht", "sp-theme" ),
	];

	$args = [
		"label" => __( "Kurse", "sp-theme" ),
		"labels" => $labels,
		"description" => "Diese Pos Type managt die Kurse von SanPool",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "sp_kurse",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => [ "slug" => "kurse", "with_front" => true ],
		"query_var" => true,
		"menu_icon" => "dashicons-star-filled",
		"supports" => [ "title", "custom-fields", "author", "page-attributes" ],
	];

	register_post_type( "sp_kurse", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );

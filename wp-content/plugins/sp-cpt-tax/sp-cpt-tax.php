<?php
/**
 * Plugin Name: SanPool Custom Post Types
 * Plugin URI: https://rueegger.me
 * Description: Dieses Plugin managt die Custom Post Types für die SanPool Webseite
 * Author: Samuel Rüegger
 * Version: 1.3
 * Author URI: https://rueegger.me
 */

function cptui_register_my_cpts() {

	/**
	 * Post Type: Kurse.
	 */

	$labels = [
		"name" => __( "Kurse", "sp-theme" ),
		"singular_name" => __( "Kurs", "sp-theme" ),
		"menu_name" => __( "Interne Kurse", "sp-theme" ),
		"all_items" => __( "Alle interne Kurse", "sp-theme" ),
		"add_new" => __( "Neuer interner Kurs", "sp-theme" ),
		"add_new_item" => __( "Neuer interner Kurs hinzufügen", "sp-theme" ),
		"edit_item" => __( "Interner Kurs bearbeiten", "sp-theme" ),
		"view_item" => __( "Interner Kurs ansehen", "sp-theme" ),
		"view_items" => __( "Interne Kurse ansehen", "sp-theme" ),
		"search_items" => __( "Interne Kurse suchen", "sp-theme" ),
		"not_found" => __( "Keine interne Kurse gefunden", "sp-theme" ),
		"not_found_in_trash" => __( "Keine interner Kurse im Papierkorb gefunden", "sp-theme" ),
		"item_published" => __( "Interner Kurs veröffentlicht", "sp-theme" ),
	];

	$args = [
		"label" => __( "Kurse", "sp-theme" ),
		"labels" => $labels,
		"description" => "Diese Pos Type managt die Kurse von SanPool",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"has_archive" => true,
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

	register_post_type( "sp_interne_kurse", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );


function cptui_register_my_taxes() {

	/**
	 * Taxonomy: Kurskategorien.
	 */

	$labels = [
		"name" => __( "Kurskategorien", "sp-theme" ),
		"singular_name" => __( "Kurskategorie", "sp-theme" ),
		"menu_name" => __( "Kurskategorien", "sp-theme" ),
		"all_items" => __( "Alle Kurskategorien", "sp-theme" ),
		"edit_item" => __( "Kurskategorie bearbeiten", "sp-theme" ),
		"view_item" => __( "Kurskategorie ansehen", "sp-theme" ),
		"add_new_item" => __( "Neue Kurskategorie", "sp-theme" ),
		"search_items" => __( "Kurskategorien suchen", "sp-theme" ),
		"not_found" => __( "Keine Kurskategorien gefunden", "sp-theme" ),
	];

	$args = [
		"label" => __( "Kurskategorien", "sp-theme" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => [ 'slug' => 'kurskategorie', 'with_front' => true, ],
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "sp_kurskategorien",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
		];
	register_taxonomy( "sp_kurskategorien", [ "sp_interne_kurse" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes' );

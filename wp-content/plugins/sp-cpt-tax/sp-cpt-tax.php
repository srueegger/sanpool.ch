<?php
/**
 * Plugin Name: SanPool Custom Post Types
 * Plugin URI: https://rueegger.me
 * Description: Dieses Plugin managt die Custom Post Types für die SanPool Webseite
 * Author: Samuel Rüegger
 * Version: 1.4
 * Author URI: https://rueegger.me
 */

function cptui_register_my_cpts() {

	/**
	 * Post Type: Kurse
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
		"description" => "Diese Post Type managt die Kurse von SanPool.",
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
		"rewrite" => array( 'slug' => 'kurse', 'with_front' => true ),
		"query_var" => true,
		"menu_icon" => "dashicons-star-filled",
		"supports" => [ "title", "custom-fields", "page-attributes" ],
	];

	register_post_type( "sp_interne_kurse", $args );

	/**
	 * Post Type: Kursleiter
	 */

	$labels = [
		"name" => __( "Kursleiter", "sp-theme" ),
		"singular_name" => __( "Kursleiter", "sp-theme" ),
		"menu_name" => __( "Kursleiter", "sp-theme" ),
		"all_items" => __( "Alle Kursleiter", "sp-theme" ),
		"add_new" => __( "Neuer Kursleiter", "sp-theme" ),
		"add_new_item" => __( "Neuer Kursleiter hinzufügen", "sp-theme" ),
		"edit_item" => __( "Kursleiter bearbeiten", "sp-theme" ),
		"view_item" => __( "Kursleiter ansehen", "sp-theme" ),
		"view_items" => __( "Kursleiter ansehen", "sp-theme" ),
		"search_items" => __( "Kursleiter suchen", "sp-theme" ),
		"not_found" => __( "Keine Kursleiter gefunden", "sp-theme" ),
		"not_found_in_trash" => __( "Keine Kursleiter im Papierkorb gefunden", "sp-theme" ),
		"item_published" => __( "Kursleiter veröffentlicht", "sp-theme" ),
	];

	$args = [
		"label" => __( "Kursleiter", "sp-theme" ),
		"labels" => $labels,
		"description" => "Diese Post Type managt die Kursleiter von SanPool.",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => false,
		"query_var" => true,
		"menu_icon" => "dashicons-universal-access-alt",
		"supports" => [ "title", "custom-fields", "author", "page-attributes" ],
	];

	register_post_type( "sp_kursleiter", $args );
	
	/**
	 * Post Type: Team
	 */

	$labels = [
		"name" => __( "Team", "sp-theme" ),
		"singular_name" => __( "Team", "sp-theme" ),
		"menu_name" => __( "Team", "sp-theme" ),
		"all_items" => __( "Alle Teammitglieder", "sp-theme" ),
		"add_new" => __( "Neues Teamitglied", "sp-theme" ),
		"add_new_item" => __( "Neues Teammitglied hinzufügen", "sp-theme" ),
		"edit_item" => __( "Teammitglied bearbeiten", "sp-theme" ),
		"view_item" => __( "Teammitglied ansehen", "sp-theme" ),
		"view_items" => __( "Teammitglieder ansehen", "sp-theme" ),
		"search_items" => __( "Teammitglieder suchen", "sp-theme" ),
		"not_found" => __( "Kein Teammitglied gefunden", "sp-theme" ),
		"not_found_in_trash" => __( "Keine Teammitglieder im Papierkorb gefunden", "sp-theme" ),
		"item_published" => __( "Teammitglied veröffentlicht", "sp-theme" ),
	];

	$args = [
		"label" => __( "Teammitglied", "sp-theme" ),
		"labels" => $labels,
		"description" => "Diese Post Type managt die Teammitglied von SanPool.",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"show_in_rest" => true,
		"has_archive" => false,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"delete_with_user" => false,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => false,
		"query_var" => true,
		"menu_icon" => "dashicons-groups",
		"supports" => [ "title", "custom-fields", "author", "page-attributes" ],
	];

	register_post_type( "sp_team", $args );
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
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "sp_kurskategorien",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
		];
	register_taxonomy( "sp_kurskategorien", [ "sp_interne_kurse" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes' );


/* Add Custom Admin Columns to CPT */
function sp_add_admin_columns_interne_kurse($columns) {
	print_r($columns);
	$columns['sp_interne_kurse_subs'] = 'Anzahl Anmeldungen';
	return $columns;
}
add_filter( 'manage_sp_interne_kurse_posts_columns', 'sp_add_admin_columns_interne_kurse' );

/* Add Content to the new Admin Columns */
function sp_add_content_to_admin_columns_interne_kurse( $column, $post_id ) {
	if($column == 'sp_interne_kurse_subs') {
		/* Anzahl Teilnehmer ermitteln */
		echo '<a href="'.HOME_URI.'/wp-admin/admin.php?page=gf_entries&view=entries&id=1&orderby=0&order=ASC&s='.$post_id.'&field_id=1&operator=is" target="_self">'.sp_count_subs_by_course_id( $post_id, false ).'</a>';
	}
}
add_action( 'manage_sp_interne_kurse_posts_custom_column' , 'sp_add_content_to_admin_columns_interne_kurse', 10, 2 );
<?php
/***************************************
 *	 CREATE GLOBAL VARIABLES
 ***************************************/
define( 'HOME_URI', home_url() );
define( 'THEME_URI', get_template_directory_uri() );
define( 'THEME_IMAGES', THEME_URI . '/dist-assets/images' );
define( 'DEV_CSS', THEME_URI . '/dev-assets/css' );
define( 'DEV_JS', THEME_URI . '/dev-assets/js' );
define( 'DIST_CSS', THEME_URI . '/dist-assets/css' );
define( 'DIST_JS', THEME_URI . '/dist-assets/js' );
define( 'FILES_DIR', THEME_URI . '/dist-assets/files' );


/***************************************
 * Include helpers
 ***************************************/
require_once 'inc/bootstrap-navwalker.php';
require_once 'inc/custom-gutenberg-blocks.php';
require_once 'inc/gravityforms.php';
require_once 'inc/string-translations.php';
require_once 'inc/ajax-calls.php';

/***************************************
 * 		Theme Support and Options
 ***************************************/
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
add_theme_support( 'title-tag' );
add_theme_support( 'menus' );
add_theme_support( 'align-wide' );
add_theme_support( 'responsive-embeds' );
/* Gtenberg Colors */
add_theme_support( 'editor-color-palette', array(
	array(
		'name'  => 'Blau',
		'slug'  => 'blue',
		'color'	=> '#0090cc',
	),
	array(
		'name'  => 'Hellgrau',
		'slug'  => 'lightgray',
		'color' => '#dee2e6',
	),
	array(
		'name'  => 'Dunkelgrau',
		'slug'  => 'darkgray',
		'color' => '#212529',
	),
	array(
		'name'	=> 'Schwarz',
		'slug'	=> 'black',
		'color'	=> '#000000',
	),
	array(
		'name'	=> 'Weiss',
		'slug'	=> 'white',
		'color'	=> '#ffffff',
	)
) );
add_filter('show_admin_bar', '__return_false');

/***************************************
 * Custom Image Size
 ***************************************/
add_image_size( 'kurs-box', 350, 9999, false );
add_image_size( 'kurs-box-2x', 700, 9999, false );
add_image_size( 'fullwidth', 1920, 9999, false );
add_image_size( 'fullwidth-2x', 3840, 9999, false );
add_image_size( 'infoblock', 447, 9999, false );
add_image_size( 'infoblock-2x', 894, 9999, false );

/***************************************
 * Add Wordpress Menus
 ***************************************/
function register_sp_menu() {
	register_nav_menu( 'mainmenu', 'Hauptmenü' );
	register_nav_menu( 'footermenu', 'Footermenü' );
	register_nav_menu( 'iconmenu', 'Iconmenü' );
	register_nav_menu( 'socialmenu', 'Social Media Menü' );
}
add_action( 'after_setup_theme', 'register_sp_menu' );

/***************************************
 * 		Enqueue scripts and styles.
 ***************************************/
function sp_startup_scripts() {
	/* Google Fonts */
	wp_enqueue_style( 'sp-fonts', 'https://fonts.googleapis.com/css?family=Oswald:400,500,700&display=swap', null, false );
	/* Google Maps */
	wp_enqueue_script( 'sp-google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyClyTgPGOjbFlQsNCJ6xo_WSv5975VHXSo&language=de-CH&region=CH', null, null, true );
	if (WP_DEBUG) {
		$modificated_css = date( 'YmdHis', filemtime( get_stylesheet_directory() . '/dev-assets/css/theme.css' ) );
		$modificated_js = date( 'YmdHis', filemtime( get_stylesheet_directory() . '/dev-assets/js/theme.js' ) );
		wp_register_style( 'sp-style', DEV_CSS . '/theme.css', array('sp-fonts'), $modificated_css );
		wp_register_script( 'sp-script', DEV_JS . '/theme.js', array('jquery', 'sp-google-maps'), $modificated_js, true );
	} else {
		$modificated_css = date( 'YmdHis', filemtime( get_stylesheet_directory() . '/dist-assets/css/theme.min.css' ) );
		$modificated_js = date( 'YmdHis', filemtime( get_stylesheet_directory() . '/dist-assets/js/theme.min.js' ) );
		wp_register_style( 'sp-style', DIST_CSS . '/theme.min.css', array('sp-fonts'), $modificated_css );
		wp_register_script( 'sp-script', DIST_JS . '/theme.min.js', array('jquery', 'sp-google-maps'), $modificated_js, true );
	}
	$global_vars = array(
		'ajax_url' => admin_url('admin-ajax.php')
	);
	wp_localize_script( 'sp-script', 'global_vars', $global_vars );
	wp_enqueue_style( 'sp-style' );
	wp_enqueue_script( 'sp-script' );
}
add_action( "wp_enqueue_scripts", "sp_startup_scripts" );

/***************************************
 * 	CSS und JS Dateien für den Administrationsbereich hinzufügen
 ***************************************/
function sp_admin_style_and_script() {
	$modificated_css = date( 'YmdHis', filemtime( get_stylesheet_directory() . '/dist-assets/css/admin.css' ) );
	wp_enqueue_style('sp-admin-style', DIST_CSS . '/admin.css', null, $modificated_css);
}
add_action('admin_enqueue_scripts', 'sp_admin_style_and_script');

/***************************************
 * 		sp ACF Init
 ***************************************/
function sp_acf_init() {
	/* Optionsseite für Footer Einstellungen erstellen */
	$args = array(
		'page_title' => 'Footer Inhalte definieren',
		'menu_title' => 'Footer',
		'menu_slug' => 'sp-footer-settings',
		'parent_slug' => 'themes.php',
	);
	acf_add_options_sub_page($args);
	/* Optionsseite für Kurseinstellungen erstellen */
	$args = array(
		'page_title' => 'Kurseinstellungen',
		'menu_title' => 'Einstellungen',
		'menu_slug' => 'sp-course-settings',
		'parent_slug' => 'edit.php?post_type=sp_interne_kurse',
	);
	/* Google Maps API KEY */
	acf_update_setting( 'google_api_key', 'AIzaSyClyTgPGOjbFlQsNCJ6xo_WSv5975VHXSo' );
	/* Menü verbergen */
	if(!WP_DEBUG) {
		//add_filter('acf/settings/show_admin', '__return_false');
	}
}
add_action( 'acf/init', 'sp_acf_init' );

/***************************************
 * Remove Menus from Backend
 ***************************************/
function sp_remove_menus() {
	remove_menu_page( 'edit.php' );
	remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'sp_remove_menus' );

/***************************************
 * 	 Container entfernen bei Gutenberg Blocks die Align full oder width sind.
 ***************************************/
function sp_wrap_alignment_full( $block_content, $block ) {
	if ( isset( $block['attrs']['align'] ) && in_array( $block['attrs']['align'], array( 'full' ) ) ) {
		/* Fullwidth Block */
		$return_code = '</div></div></div><div>';
		$return_code .= $block_content;
		$return_code .= '</div><div class="container"><div class="row"><div class="col-12">';
		return $return_code;
	}elseif (isset( $block['attrs']['align'] ) && in_array( $block['attrs']['align'], array( 'wide' ) )) {
		/* Wide Block */
		$return_code = '</div></div></div><div class="container-fluid"><div class="row"><div class="col-12">';
		$return_code .= $block_content;
		$return_code .= '</div></div></div><div class="container"><div class="row"><div class="col-12">';
		return $return_code;
	} else {
		return $block_content;
	}
}
add_filter( 'render_block', 'sp_wrap_alignment_full', 10, 2 );

/***************************************
 * 	 Diese Funktion rendert den Inhalt eines Accordeons
 ***************************************/
function sp_render_accordeon_content($identifier, $rowIndex, $title, $txt) {
	$identifier = esc_attr( $identifier );
	$rowIndex = esc_attr( $rowIndex );
	$title = esc_attr( $title );
	?>
	<div class="card">
		<div class="card-header" id="heading-<?php echo $rowIndex; ?>">
			<h2 class="mb-0 text-white" data-toggle="collapse" data-target="#collapse-<?php echo $rowIndex; ?>" aria-expanded="false" aria-controls="collapse-<?php echo $rowIndex; ?>">
				<?php echo $title; ?>
				<span class="icon float-right">
					<i style="display: block;" class="far fa-angle-down fa-1x iconclosed"></i>
					<i style="display: none;" class="far fa-times fa-1x iconopened"></i>
				</span>
			</h2>
		</div>
		<div id="collapse-<?php echo $rowIndex; ?>" class="collapse faq" aria-labelledby="heading-<?php echo $rowIndex; ?>" data-parent="#<?php echo $identifier; ?>">
			<div class="card-body">
				<?php echo $txt; ?>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<?php
}

/***************************************
 * 	 Kursleiter Feld dynamisch füllen
 ***************************************/
function sp_acf_load_kursleiter_field_choices( $field ) {
	// reset choices
	$field['choices'] = array();
	/* Inhalte laden */
	$args = array(
		'numberposts' => -1,
		'post_status' => 'publish',
		'post_type' => 'sp_kursleiter',
	);
	$kursleiter = get_posts($args);
	if(!empty($kursleiter)) {
		foreach($kursleiter as $leiter) {
			$field[ 'choices' ][ $leiter->ID ] = get_the_title( $leiter->ID );
		}
	}
	return $field;
}
add_filter('acf/load_field/name=kurse_leiter', 'sp_acf_load_kursleiter_field_choices');

/***************************************
 * 	 Prüfen ob schon ein Kurs mit diesem Titel gespeichert wurde.
 ***************************************/
function sp_disallow_posts_with_same_title($messages) {
	global $post;
	global $wpdb ;
	$title = $post->post_title;
	$post_id = $post->ID ;
	$wtitlequery = "SELECT post_title FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'sp_interne_kurse' AND post_title = '{$title}' AND ID != {$post_id} " ;

	$wresults = $wpdb->get_results( $wtitlequery) ;

	if ( $wresults ) {
		$error_message = 'Dieser Titel wurde schon einmal verwendet! Kurs wurde als Entwurf gespeichert.';
		add_settings_error('post_has_links', '', $error_message, 'error');
		settings_errors( 'post_has_links' );
		$post->post_status = 'draft';
		wp_update_post($post);
		return;
	}
	return $messages;

}
add_action('post_updated_messages', 'sp_disallow_posts_with_same_title');

/***************************************
 * 	 Anzahl Teilnehmer eines Kurses ermitteln
 ***************************************/
function sp_count_subs_by_course_id( $post_id, $echo = true ) {
	$post_id = esc_attr( $post_id );
	$search_criteria = array();
	$search_criteria['status'] = 'active';
	$search_criteria['field_filters'][] = array( 'key' => '1', 'value' => $post_id );
	$bisherige_teilnehmer = GFAPI::count_entries(1, $search_criteria); //Form ID
	if($echo) {
		echo $bisherige_teilnehmer;
	} else {
		return $bisherige_teilnehmer;
	}
}

/***************************************
 * 	 Create a Custom Language Switcher
 ***************************************/
function sp_languages_list_switcher() {
	global $sitepress;
	$languages = apply_filters( 'wpml_active_languages', NULL, array( 'skip_missing' => 0, 'link_empty_to' => HOME_URI ) );
	echo '<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" class="menu-item wpml-ls-item wpml-ls-current-language wpml-ls-menu-item wpml-ls-first-item menu-item-type-wpml_ls_menu_item menu-item-object-wpml_ls_menu_item menu-item-has-children dropdown nav-item"><a title="'.strtoupper(ICL_LANGUAGE_CODE).'" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-toggle nav-link"><span class="wpml-ls-display">'.strtoupper(ICL_LANGUAGE_CODE).'</span></a>';
	echo '<ul class="dropdown-menu" role="menu">';
	if(!empty($languages) && !is_tax( 'sp_kurskategorien' )){
		/* Display Current Language */
		foreach($languages as $language) {
			/* Aktive Sprache nicht ausgeben */
			if($language['code'] != ICL_LANGUAGE_CODE) {
				echo '<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" class="menu-item wpml-ls-item wpml-ls-menu-item menu-item-type-wpml_ls_menu_item menu-item-object-wpml_ls_menu_item nav-item"><a title="'.strtoupper($language['code']).'" href="'.$language['url'].'" class="dropdown-item"><span class="wpml-ls-display">'.strtoupper($language['code']).'</span></a></li>';
			}
		}
	} else {
		$lng_array = array(
			'de',
			'fr',
			'it'
		);
		$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		$domain = $_SERVER['HTTP_HOST'];
		$lng_base_url = $protocol.$domain;
		/* Bugfix für die Kurse Archiv-Seite */
		if( is_post_type_archive( 'sp_interne_kurse' ) ) {
			foreach($lng_array as $lng) {
				/* Aktive Sprache ausblenden */
				if($lng != ICL_LANGUAGE_CODE) {
					/* URL manuell erstellen */
					if($lng == 'de') {
						$lng_url = $lng_base_url . '/kurse/';
					} else {
						$lng_url = $lng_base_url . '/' . $lng . '/kurse/';
					}
					/* Link ausgeben */
					echo '<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" class="menu-item wpml-ls-item wpml-ls-menu-item menu-item-type-wpml_ls_menu_item menu-item-object-wpml_ls_menu_item nav-item"><a title="'.strtoupper($lng).'" href="'.$lng_url.'" class="dropdown-item"><span class="wpml-ls-display">'.strtoupper($lng).'</span></a></li>';
				}
			}
		}
		/* Bugfix für Kurskategorie Übesichten */
		if( is_tax( 'sp_kurskategorien' ) ) {
			$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
			foreach($lng_array as $lng) {
				/* Aktive Sprache ausblenden */
				if($lng != ICL_LANGUAGE_CODE) {
					/* URL manuell erstellen */
					if($lng == 'de') {
						$lng_url = $lng_base_url . '/kurskategorie/'.$term->slug.'/';
					} else {
						$lng_url = $lng_base_url . '/' . $lng . '/kurskategorie/'.$term->slug.'/';
					}
					/* Link ausgeben */
					echo '<li itemscope="itemscope" itemtype="https://www.schema.org/SiteNavigationElement" class="menu-item wpml-ls-item wpml-ls-menu-item menu-item-type-wpml_ls_menu_item menu-item-object-wpml_ls_menu_item nav-item"><a title="'.strtoupper($lng).'" href="'.$lng_url.'" class="dropdown-item"><span class="wpml-ls-display">'.strtoupper($lng).'</span></a></li>';
				}
			}
		}
	}
	echo '</ul></li>';
}

/***************************************
 * 	 Kursstatus berechnen
 ***************************************/
function sp_calculate_kurs_status( $bisherige, $total, $schwelle ) {
	if($bisherige < $schwelle && $bisherige < $total) {
		$status_print = '<span data-toggle="tooltip" data-placement="top" title="' . apply_filters( 'wpml_translate_single_string', 'Plätze verfügbar', 'sp-theme', 'Plätze verfügbar' ) . '" class="kurs-status"><i class="fas fa-check-circle fa-fw text-success"></i></span>';
		/* Wenig Plätze verfügbar */
	} elseif($bisherige >= $schwelle && $bisherige < $total) {
		$status_print = '<span data-toggle="tooltip" data-placement="top" title="' . apply_filters( 'wpml_translate_single_string', 'Wenig Plätze verfügbar', 'sp-theme', 'Wenig Plätze verfügbar' ) . '" class="kurs-status"><i class="fas fa-check-circle fa-fw text-warning"></i></span>';
		/* Kurs ist ausgebucht */
	} elseif($bisherige > $schwelle && $bisherige >= $total) {
		$status_print = '<span data-toggle="tooltip" data-placement="top" title="' . apply_filters( 'wpml_translate_single_string', 'Kurs ist ausgebucht', 'sp-theme', 'Kurs ist ausgebucht' ) . '" class="kurs-status"><i class="fas fa-exclamation-triangle fa-fw text-danger"></i></span>';
	}
	return $status_print;
}

/***************************************
 * 	 Kursstatus berechnen
 ***************************************/
function sp_hexToRgb($hex, $alpha = false) {
	$hex      = str_replace('#', '', $hex);
	$length   = strlen($hex);
	$rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
	$rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
	$rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
	if ( $alpha ) {
	   $rgb['a'] = $alpha;
	}
	return $rgb;
}
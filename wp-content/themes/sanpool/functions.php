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

/***************************************
 * 		Theme Support and Options
 ***************************************/
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );
add_theme_support( 'title-tag' );
add_theme_support( 'menus' );
add_filter('show_admin_bar', '__return_false');

/***************************************
 * Custom Image Size
 ***************************************/

/***************************************
 * Add Wordpress Menus
 ***************************************/
function register_sp_menu() {
	register_nav_menu( 'mainmenu', 'Hauptmenü' );
}
add_action( 'after_setup_theme', 'register_sp_menu' );

/***************************************
 * 		Enqueue scripts and styles.
 ***************************************/
function sp_startup_scripts() {
	wp_enqueue_style( 'sp-fonts', 'https://fonts.googleapis.com/css?family=Oswald:400,500,700&display=swap', null, false );
	if (WP_DEBUG) {
		$modificated_css = date( 'YmdHis', filemtime( get_stylesheet_directory() . '/dev-assets/css/theme.css' ) );
		$modificated_js = date( 'YmdHis', filemtime( get_stylesheet_directory() . '/dev-assets/js/theme.js' ) );
		wp_register_style( 'sp-style', DEV_CSS . '/theme.css', array('sp-fonts'), $modificated_css );
		wp_register_script( 'sp-script', DEV_JS . '/theme.js', array('jquery'), $modificated_js, true );
	} else {
		$modificated_css = date( 'YmdHis', filemtime( get_stylesheet_directory() . '/dist-assets/css/theme.min.css' ) );
		$modificated_js = date( 'YmdHis', filemtime( get_stylesheet_directory() . '/dist-assets/js/theme.min.js' ) );
		wp_register_style( 'sp-style', DIST_CSS . '/theme.min.css', array('sp-fonts'), $modificated_css );
		wp_register_script( 'sp-script', DIST_JS . '/theme.min.js', array('jquery'), $modificated_js, true );
	}
	$global_vars = array(
		'home_url' => HOME_URI,
		'ajax_url' => admin_url('admin-ajax.php'),
		'ajax_secure' => wp_create_nonce('sp-check-ajax-secure'),
	);
	//wp_localize_script( 'sp-script', 'global_vars', $global_vars );
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
	 $args = array(
		'page_title' => 'Einstellungen für JTI Datenbank',
		'menu_title' => 'Datenbank Einstellungen',
		'menu_slug' => 'sp-db-settings',
		'parent_slug' => 'options-general.php',
	);
	acf_add_options_sub_page($args);
}
//add_action( 'acf/init', 'sp_acf_init' );

/***************************************
 * Remove Menus from Backend
 ***************************************/
function sp_remove_menus() {
	remove_menu_page( 'edit.php' );
	remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'sp_remove_menus' );

/***************************************
 * 	 E-Mails per SMTP senden
 ***************************************/
function sp_send_smtp( $phpmailer ) {
	$phpmailer->isSMTP();
	$phpmailer->Host = get_field( 'sys_smtp_host', 'option' );
	$phpmailer->SMTPAuth = true;
	$phpmailer->Port = get_field( 'sys_smtp_port', 'option' );
	$phpmailer->Username = get_field( 'sys_smtp_username', 'option' );
	$phpmailer->Password = get_field( 'sys_smtp_password', 'option' );
	$phpmailer->SMTPSecure = get_field( 'sys_smtp_secure', 'option' );
	$phpmailer->From = get_field( 'sys_smtp_frommail', 'option' );
	$phpmailer->FromName = get_field( 'sys_smtp_fromname', 'option' );
	$phpmailer->CharSet = 'utf-8';
}
//add_action( 'phpmailer_init', 'sp_send_smtp' );
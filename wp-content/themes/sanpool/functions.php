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
	/* Optionsseiten erstellen */
	 $args = array(
		'page_title' => 'Footer Inhalte definieren',
		'menu_title' => 'Footer',
		'menu_slug' => 'sp-footer-settings',
		'parent_slug' => 'themes.php',
	);
	acf_add_options_sub_page($args);
	/* Menü verbergen */
	if(!WP_DEBUG) {
		add_filter('acf/settings/show_admin', '__return_false');
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

/***************************************
 * 	 Container entfernen bei Gutenberg Blocks die Align full oder width sind.
 ***************************************/
function sp_wrap_alignment_full( $block_content, $block ) {
	if ( isset( $block['attrs']['align'] ) && in_array( $block['attrs']['align'], array( 'full' ) ) ) {
		/* Fullwidth Block */
		$return_code = '</div></div></div><div>';
		$return_code .= $block_content;
		$return_code .= '</div><div class="container"><div class="row"><div class="col-12 col-lg-10">';
		return $return_code;
	}elseif (isset( $block['attrs']['align'] ) && in_array( $block['attrs']['align'], array( 'wide' ) )) {
		/* Wide Block */
		$return_code = '</div></div></div><div class="container-fluid"><div class="row justify-content-center"><div class="col-12 col-lg-10">';
		$return_code .= $block_content;
		$return_code .= '</div></div></div><div class="container"><div class="row"><div class="col-12 col-lg-10">';
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
			<h2 class="mb-0" data-toggle="collapse" data-target="#collapse-<?php echo $rowIndex; ?>" aria-expanded="false" aria-controls="collapse-<?php echo $rowIndex; ?>">
				<?php echo $title; ?>
				<span class="icon float-right">
					<i style="display: block;" class="far fa-angle-down fa-1x iconclosed"></i>
					<i style="display: none;" class="far fa-times fa-1x iconopened"></i>
				</span>
			</h2>
		</div>
		<div id="collapse-<?php echo $rowIndex; ?>" class="collapse" aria-labelledby="heading-<?php echo $rowIndex; ?>" data-parent="#<?php echo $identifier; ?>">
			<div class="card-body">
				<?php echo $txt; ?>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
	<?php
}
<?php
/* Neue Custom Gutenberg Blocks registrieren */
function sp_register_acf_block_types() {
	/* Zahlen und Fakten Block */
	acf_register_block_type(array(
		'name' => 'sp_numbers_and_facts',
		'title' => 'Zahlen und Fakten',
		'description' => 'Dieser Block zeichnet den Zahlen und Fakten Bereich.',
		'render_template' => 'templates/blocks/numbers-and-facts.php',
		'category' => 'layout',
		'icon' => 'chart-bar',
		'keywords' => array( 'zahlen', 'fakten', 'numbers' ),
		'mode' => 'edit'
	));

	/* Teamslider Block */
	acf_register_block_type(array(
		'name' => 'sp_teamslider',
		'title' => 'Teamslider',
		'description' => 'Dieser Block zeichnet den Teamslider.',
		'render_template' => 'templates/blocks/teamslider.php',
		'category' => 'layout',
		'icon' => 'groups',
		'keywords' => array( 'team', 'slider', 'personen' ),
		'mode' => 'edit'
	));

	/* Bild / Video Slider */
	acf_register_block_type(array(
		'name' => 'sp_image_video_slider',
		'title' => 'Bild und Videoslider',
		'description' => 'Dieser Block zeichnet einen Bild und Video Slider.',
		'render_template' => 'templates/blocks/imageandvideoslider.php',
		'category' => 'layout',
		'icon' => 'slides',
		'keywords' => array( 'slider', 'bild', 'image', 'video' ),
		'mode' => 'edit'
	));

	/* Infoblöcke */
	acf_register_block_type(array(
		'name' => 'sp_infoblocks',
		'title' => 'Infoblöcke',
		'description' => 'Dieser Block zeichnet die Infoblöcke.',
		'render_template' => 'templates/blocks/infoblocks.php',
		'category' => 'layout',
		'icon' => 'info',
		'keywords' => array( 'info', 'bild', 'image' ),
		'mode' => 'edit'
	));

	/* Infoicons */
	acf_register_block_type(array(
		'name' => 'sp_infoicons',
		'title' => 'Infoicons',
		'description' => 'Dieser Block zeichnet die Infoicons.',
		'render_template' => 'templates/blocks/infoicons.php',
		'category' => 'layout',
		'icon' => 'info',
		'keywords' => array( 'info', 'icons' ),
		'mode' => 'edit'
	));

	/* Kursslider */
	acf_register_block_type(array(
		'name' => 'sp_kursslider',
		'title' => 'Kursslider',
		'description' => 'Dieser Block zeigt alle aktuellen Kurse in einem Slider an',
		'render_template' => 'templates/blocks/kursslider.php',
		'category' => 'layout',
		'icon' => 'images-alt',
		'keywords' => array( 'kurse', 'slider', 'carousel', 'angebote' ),
		'mode' => 'edit'
	));

	/* FAQ Block */
	acf_register_block_type(array(
		'name' => 'sp_faq',
		'title' => 'FAQ',
		'description' => 'Dieser Block zeigt ein typisches FAQ Layout an',
		'render_template' => 'templates/blocks/faq.php',
		'category' => 'layout',
		'icon' => 'list-view',
		'keywords' => array( 'faq', 'accordeon' ),
		'mode' => 'edit'
	));
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
	add_action('acf/init', 'sp_register_acf_block_types');
}
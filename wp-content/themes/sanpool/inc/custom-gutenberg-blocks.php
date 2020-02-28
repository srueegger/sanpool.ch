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
}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
	add_action('acf/init', 'sp_register_acf_block_types');
}
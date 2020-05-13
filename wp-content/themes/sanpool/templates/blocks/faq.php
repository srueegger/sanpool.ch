<?php
/* Diese Datei rendert den "Zahlen und Fakten" Block */
$id = 'faq-' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'faq';
if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
	$className .= ' align' . $block['align'];
}
?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>">
	<?php
	if(have_rows('block_faq_entries')) {
		$identifier = 'faq-accordeon-'.$id;
		echo '<div class="accordion sanpool-accordion" id="'.$identifier.'">';
		while(have_rows('block_faq_entries')) {
			the_row();
			$rowIndex = get_row_index();
			$title = get_sub_field('title');
			$txt = get_sub_field('txt');
			sp_render_accordeon_content($identifier, $rowIndex, $title, $txt);
		}
		echo '</div>';
	}
	?>
</div>
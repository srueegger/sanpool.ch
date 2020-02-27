<?php
/* Diese Datei rendert den "Zahlen und Fakten" Block */
$id = 'numbers-and-facts-' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'numbers-and-facts bg-primary';
if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
	$className .= ' align' . $block['align'];
}
?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>">
	<div class="container">
		<div class="row justify-content-center">
			<?php
			while(have_rows('numbers_and_facts')) {
				the_row();
				?>
				<div class="col">
					<div class="number"><?php the_sub_field('number'); ?></div>
					<div class="fact"><?php the_sub_field('fact'); ?></div>
				</div>
				<?php
			}
			?>
		</div>
	</div>
</div>
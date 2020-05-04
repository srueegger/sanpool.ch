
<?php
/* Diese Datei rendert die Info Icons */
$id = 'infoicons-' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'infoicons';
if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>">
	<div class="container-fluid bg-primary py-4">
		<div class="row">
			<div class="col-12 text-center">
				<h2 class="h1 text-white"><?php the_field('block_infoicon_title'); ?></h2>
			</div>
		</div>
		<?php
		if(have_rows('block_infoicons_icons')) {
			echo '<div class="row mt-3">';
			while(have_rows('block_infoicons_icons')) {
				the_row();
				?>
				<div class="col-6 col-md-4 col-xl-2 mb-3 mb-xl-0">
					<div class="shortlink-item text-center">
						<div class="iconbox">
							<span class="fa-stack fa-4x">
								<i class="fal fa-square fa-stack-2x"></i>
								<i class="<?php the_sub_field('icon'); ?> fa-stack-1x"></i>
							</span>
						</div>
						<div class="textbox mt-3">
							<h5><?php the_sub_field('txt'); ?></h5>
						</div>
					</div>
				</div>
				<?php
			}
			echo '</div>';
		}
		?>
	</div>
</div>
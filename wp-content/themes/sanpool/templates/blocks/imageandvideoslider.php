<?php
/* Diese Datei rendert den Bild und Video Slider Block */
$id = 'teamslider-' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'teamslider';
if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
	$className .= ' align' . $block['align'];
}
?>
<div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $className ); ?>">
	<?php
	/* Prüfen ob der Slider einträge hat - PHP while mit have_rows führt zu üblen Fehlermeldungen wenn keine Inhalte vorhanden sind */
	if(have_rows('block_image_and_video_slider_slides')) {
		echo '<div class="headerSlider owl-carousel owl-theme">';
		while(have_rows('block_image_and_video_slider_slides')) {
			the_row();
			/* Slider Inhalt ausgeben */
			echo '<div class="item">';
			if(!get_sub_field('is_video')) {
				/* Bild Slider ausgeben */
				$image = get_sub_field('img');
				$titel = $image['title'];
				$txt = $image['caption'];
				?>
				<picture>
					<source srcset="<?php echo $image['sizes']['fullwidth-2x']; ?> 2x, <?php echo $image['sizes']['fullwidth']; ?> 1x" />
					<img loading="lazy" src="<?php echo $image['sizes']['fullwidth']; ?>" alt="<?php echo $image['alt']; ?>">
				</picture>
				<?php
			} else {
				/* Video Slider ausgeben */
				$video = get_sub_field('video');
				$embed_code = wp_oembed_get($video);
				$titel = get_sub_field('video_title');
				$txt = get_sub_field('video_txt');
				echo '<div class="video-container">';
				echo $embed_code;
				echo '</div>';
			}
			/* Text Container anzeigen */
			echo '<div class="text-container"><div class="inner">';
			echo '<h2>'.$titel.'</h2>';
			echo '<p>'.$txt.'</p>';
			/* Button hinzufügen - falls vorhanden */
			$btn = get_sub_field('btn');
			if($btn) {
				$btn_target = $btn['target'] ? $btn['target'] : '_self';
				echo '<a href="'.$btn['url'].'" target="'.$btn_target.'" class="btn btn-primary mt-3">'.$btn['title'].'<i class="far fa-chevron-right ml-3"></i></a>';
			}
			echo '</div></div></div>';
		}
		echo '</div>';
	}
	?>
</div>
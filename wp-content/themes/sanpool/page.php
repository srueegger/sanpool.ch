<?php
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post();
?>
<main id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container">
		<div class="row justify-content-center">
			<?php
			$page_body_top_margin = '';
			if(!get_field('page_has_title')) {
				/* Titel auf der Seite wird angezeigt */
				$page_body_top_margin = ' mt-5';
				?>
				<div class="col-12 col-lg-10 mt-4">
					<?php the_title('<h1>', '</h1>'); ?>
				</div>
				<?php
			}
			?>
			<div class="col-12 col-lg-10<?php echo $page_body_top_margin; ?>">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</main>
<?php
endwhile; endif;
get_footer();
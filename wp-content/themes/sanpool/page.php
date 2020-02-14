<?php
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post();
?>
<main id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-12 col-lg-9 mt-4">
				<?php the_title('<h1>', '</h1>'); ?>
			</div>
			<div class="col-12 col-lg-9 mt-5">
				<?php the_content(); ?>
			</div>
		</div>
	</div>
</main>
<?php
endwhile; endif;
get_footer();
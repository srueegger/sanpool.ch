
<?php
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post();
?>
<main id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="headerSlider owl-carousel owl-theme">
					<div class="item">
						<picture>
							<source srcset="https://picsum.photos/2220/1310 2x, https://picsum.photos/1110/655 1x" />
							<img src="https://picsum.photos/1110/655" alt="">
						</picture>
						<div class="text-container">
							<div class="inner">
								<h2>Der Titel</h2>
								<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et</p>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="video-container">
							<?php
							$embedCode = wp_oembed_get('https://www.youtube.com/watch?v=UG_Ks_wRTpo');
							echo $embedCode;
							?>
						</div>
						<div class="text-container">
							<div class="inner">
								<h2>Der Titel</h2>
								<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et</p>
							</div>
						</div>
					</div>
					<div class="item">
						<picture>
							<source srcset="https://picsum.photos/2220/1310 2x, https://picsum.photos/1110/655 1x" />
							<img src="https://picsum.photos/1110/655" alt="">
						</picture>
						<div class="text-container">
							<div class="inner">
								<h2>Der Titel</h2>
								<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="smallSpacer mt-5">
			<div class="row justify-content-center">
				<div class="col-12 col-lg-4">
					<div class="card layout1">
						<div class="image-container"><img src="https://picsum.photos/1110/655" class="card-img-top" alt="..."></div>
						<div class="card-body">
							<h5 class="card-title">Ein Titel</h5>
							<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
							<a href="#" class="btn btn-primary">Go somewhere</a>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-4">
					<div class="card layout2">
						<div class="image-container"><img src="https://picsum.photos/1110/655" class="card-img-top" alt="..."></div>
						<div class="card-body">
							<h5 class="card-title">Ein Titel</h5>
							<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
							<a href="#" class="btn btn-primary">Go somewhere</a>
						</div>
					</div>
				</div>
				<div class="col-12 col-lg-4">
					<div class="card layout3">
						<div class="image-container"><img src="https://picsum.photos/1110/655" class="card-img-top" alt="..."></div>
						<div class="card-body">
							<h5 class="card-title">Ein Titel</h5>
							<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
							<a href="#" class="btn btn-primary">Go somewhere</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container mt-5">
		<div class="row justify-content-center">
			<div class="col-9">
				<blockquote class="blockquote text-center">
					<p class="mb-0"><span class="character">"</span>SanPool isch sbeschte wos je hets gits!</p>
					<footer class="blockquote-footer text-right">Samuel Rüegger <cite title="Source Title">Web-Entwickler</cite></footer>
				</blockquote>
			</div>
		</div>
	</div>
	<div class="container mt-5">
		<div class="row">
			<div class="col-12">
				<div class="courseSlider owl-carousel owl-theme">
					<div class="item">
						<div class="card">
							<div class="image-container"><img src="https://picsum.photos/1110/655" class="card-img-top" alt="..."></div>
							<div class="card-body">
								<h5 class="card-title">Nothilfekurse</h5>
								<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
								<hr>
								<div class="row">
									<div class="col-6">
										<i class="far fa-clock"></i> 10 Stunden
									</div>
									<div class="col-6 text-right">
										<i class="far fa-user fa-lg"></i> / <i class="far fa-users fa-lg"></i>
									</div>
								</div>
								<hr>
								<a href="#" class="btn btn-primary">Go somewhere</a>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="card">
							<div class="image-container"><img src="https://picsum.photos/1110/655" class="card-img-top" alt="..."></div>
							<div class="card-body">
								<h5 class="card-title">Reanimatonskurse</h5>
								<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
								<hr>
								<div class="row">
									<div class="col-6">
										<i class="far fa-clock"></i> 10 Stunden
									</div>
									<div class="col-6 text-right">
										<i class="far fa-user fa-lg"></i> / <i class="far fa-users fa-lg"></i>
									</div>
								</div>
								<hr>
								<a href="#" class="btn btn-primary">Go somewhere</a>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="card">
							<div class="image-container"><img src="https://picsum.photos/1110/655" class="card-img-top" alt="..."></div>
							<div class="card-body">
								<h5 class="card-title">Ein Titel</h5>
								<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
								<hr>
								<div class="row">
									<div class="col-6">
										<i class="far fa-clock"></i> 10 Stunden
									</div>
									<div class="col-6 text-right">
										<i class="far fa-user fa-lg"></i> / <i class="far fa-users fa-lg"></i>
									</div>
								</div>
								<hr>
								<a href="#" class="btn btn-primary">Go somewhere</a>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="card">
							<div class="image-container"><img src="https://picsum.photos/1110/655" class="card-img-top" alt="..."></div>
							<div class="card-body">
								<h5 class="card-title">Ein Titel</h5>
								<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
								<hr>
								<div class="row">
									<div class="col-6">
										<i class="far fa-clock"></i> 10 Stunden
									</div>
									<div class="col-6 text-right">
										<i class="far fa-user fa-lg"></i> / <i class="far fa-users fa-lg"></i>
									</div>
								</div>
								<hr>
								<a href="#" class="btn btn-primary">Go somewhere</a>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="card">
							<div class="image-container"><img src="https://picsum.photos/1110/655" class="card-img-top" alt="..."></div>
							<div class="card-body">
								<h5 class="card-title">Ein Titel</h5>
								<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
								<hr>
								<div class="row">
									<div class="col-6">
										<i class="far fa-clock"></i> 10 Stunden
									</div>
									<div class="col-6 text-right">
										<i class="far fa-user fa-lg"></i> / <i class="far fa-users fa-lg"></i>
									</div>
								</div>
								<hr>
								<a href="#" class="btn btn-primary">Go somewhere</a>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="card">
							<div class="image-container"><img src="https://picsum.photos/1110/655" class="card-img-top" alt="..."></div>
							<div class="card-body">
								<h5 class="card-title">Ein Titel</h5>
								<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
								<hr>
								<div class="row">
									<div class="col-6">
										<i class="far fa-clock"></i> 10 Stunden
									</div>
									<div class="col-6 text-right">
										<i class="far fa-user fa-lg"></i> / <i class="far fa-users fa-lg"></i>
									</div>
								</div>
								<hr>
								<a href="#" class="btn btn-primary">Go somewhere</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php 
endwhile; endif;
get_footer();
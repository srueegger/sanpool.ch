<?php
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post();
?>
<main id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div>
		<div class="row no-gutters">
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
								<a href="#" class="btn btn-primary mt-3">Mehr<i class="far fa-chevron-right ml-3"></i></a>
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
								<a href="#" class="btn btn-primary mt-3">Mehr<i class="far fa-chevron-right ml-3"></i></a>
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
								<a href="#" class="btn btn-primary mt-3">Mehr<i class="far fa-chevron-right ml-3"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="mt-5">
			<div class="row justify-content-center">
				<div class="col-12 col-md-6 col-lg-3">
					<div class="card">
						<div class="image-container">
							<picture>
								<img src="https://picsum.photos/255/353" class="card-img-top" alt="...">
							</picture>
						</div>
						<div class="overlay-seen-container">
							<div class="inner">
								<h4 class="text-white">Hallo Welt</h4>
								<div class="text-center mt-3">
									<span class="fa-stack fa-2x text-white">
										<i class="fal fa-circle fa-stack-2x"></i>
										<i class="fas fa-plus fa-stack-1x fa-inverse"></i>
									</span>
								</div>
							</div>
						</div>
						<div class="overlay-container">
							<div class="inner">
								<p>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
								<div href="#" class="text-center mt-3">
									<a href="#"><span class="fa-stack fa-2x text-white">
										<i class="fal fa-circle fa-stack-2x"></i>
										<i class="fas fa-plus fa-stack-1x fa-inverse"></i>
									</span></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 col-lg-3">
					<div class="card">
						<div class="image-container">
							<picture>
								<img src="https://picsum.photos/255/353" class="card-img-top" alt="...">
							</picture>
						</div>
						<div class="overlay-seen-container">
							<div class="inner">
								<h4 class="text-white">Hallo Welt</h4>
								<div class="text-center mt-3">
									<span class="fa-stack fa-2x text-white">
										<i class="fal fa-circle fa-stack-2x"></i>
										<i class="fas fa-plus fa-stack-1x fa-inverse"></i>
									</span>
								</div>
							</div>
						</div>
						<div class="overlay-container">
							<div class="inner">
								<p>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
								<div href="#" class="text-center mt-3">
									<a href="#"><span class="fa-stack fa-2x text-white">
										<i class="fal fa-circle fa-stack-2x"></i>
										<i class="fas fa-plus fa-stack-1x fa-inverse"></i>
									</span></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 col-lg-3">
					<div class="card">
						<div class="image-container">
							<picture>
								<img src="https://picsum.photos/255/353" class="card-img-top" alt="...">
							</picture>
						</div>
						<div class="overlay-seen-container">
							<div class="inner">
								<h4 class="text-white">Hallo Welt</h4>
								<div class="text-center mt-3">
									<span class="fa-stack fa-2x text-white">
										<i class="fal fa-circle fa-stack-2x"></i>
										<i class="fas fa-plus fa-stack-1x fa-inverse"></i>
									</span>
								</div>
							</div>
						</div>
						<div class="overlay-container">
							<div class="inner">
								<p>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
								<div href="#" class="text-center mt-3">
									<a href="#"><span class="fa-stack fa-2x text-white">
										<i class="fal fa-circle fa-stack-2x"></i>
										<i class="fas fa-plus fa-stack-1x fa-inverse"></i>
									</span></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-6 col-lg-3">
					<div class="card">
						<div class="image-container">
							<picture>
								<img src="https://picsum.photos/255/353" class="card-img-top" alt="...">
							</picture>
						</div>
						<div class="overlay-seen-container">
							<div class="inner">
								<h4 class="text-white">Hallo Welt</h4>
								<div class="text-center mt-3">
									<span class="fa-stack fa-2x text-white">
										<i class="fal fa-circle fa-stack-2x"></i>
										<i class="fas fa-plus fa-stack-1x fa-inverse"></i>
									</span>
								</div>
							</div>
						</div>
						<div class="overlay-container">
							<div class="inner">
								<p>Some quick example text to build on the card title and make up the bulk of the card's content.</p>
								<div href="#" class="text-center mt-3">
									<a href="#"><span class="fa-stack fa-2x text-white">
										<i class="fal fa-circle fa-stack-2x"></i>
										<i class="fas fa-plus fa-stack-1x fa-inverse"></i>
									</span></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid py-5 mt-5 bg-primary">
		<div class="row">
			<div class="col-12 my-4 text-center">
				<h2 class="h1 text-white">Hallo, wie können wir weiterhelfen?</h2>
			</div>
		</div>
		<div class="row mt-3">
			<div class="col-6 col-md-4 col-lg-2">
				<div class="shortlink-item text-center">
					<div class="iconbox">
						<span class="fa-stack fa-4x">
							<i class="fal fa-square fa-stack-2x text-white"></i>
							<i class="far fa-chalkboard-teacher fa-stack-1x text-white"></i>
						</span>
					</div>
					<div class="textbox mt-3">
						<h5>Instruktor werden</h5>
					</div>
				</div>
			</div>
			<div class="col-6 col-md-4 col-lg-2">
				<div class="shortlink-item text-center">
					<div class="iconbox">
						<span class="fa-stack fa-4x">
							<i class="fal fa-square fa-stack-2x text-white"></i>
							<i class="far fa-shopping-cart fa-stack-1x text-white"></i>
						</span>
					</div>
					<div class="textbox mt-3">
						<h5>SanPool Shop</h5>
					</div>
				</div>
			</div>
			<div class="col-6 col-md-4 col-lg-2">
				<div class="shortlink-item text-center">
					<div class="iconbox">
						<span class="fa-stack fa-4x">
							<i class="fal fa-square fa-stack-2x text-white"></i>
							<i class="far fa-id-card fa-stack-1x text-white"></i>
						</span>
					</div>
					<div class="textbox mt-3">
						<h5>Ersatzausweis</h5>
					</div>
				</div>
			</div>
			<div class="col-6 col-md-4 col-lg-2">
				<div class="shortlink-item text-center">
					<div class="iconbox">
						<span class="fa-stack fa-4x">
							<i class="fal fa-square fa-stack-2x text-white"></i>
							<i class="far fa-check fa-stack-1x text-white"></i>
						</span>
					</div>
					<div class="textbox mt-3">
						<h5>Akkreditierung</h5>
					</div>
				</div>
			</div>
			<div class="col-6 col-md-4 col-lg-2">
				<div class="shortlink-item text-center">
					<div class="iconbox">
						<span class="fa-stack fa-4x">
							<i class="fal fa-square fa-stack-2x text-white"></i>
							<i class="far fa-mailbox fa-stack-1x text-white"></i>
						</span>
					</div>
					<div class="textbox mt-3">
						<h5>Kontakt</h5>
					</div>
				</div>
			</div>
			<div class="col-6 col-md-4 col-lg-2">
				<div class="shortlink-item text-center">
					<div class="iconbox">
						<span class="fa-stack fa-4x">
							<i class="fal fa-square fa-stack-2x text-white"></i>
							<i class="far fa-terminal fa-stack-1x text-white"></i>
						</span>
					</div>
					<div class="textbox mt-3">
						<h5>Instruktor werden</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid mt-5">
		<div class="row">
			<div class="col-12 my-4">
				<h2 class="h1 text-primary">Unsere nächste Kurse</h2>
			</div>
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
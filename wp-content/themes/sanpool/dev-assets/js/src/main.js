(function($) {
	'use strict';

	/* Bilder per mit der Klasse ".lazy" per LazyLoad laden */
	var lazyLoadInstance = new LazyLoad({
		elements_selector: '.lazy'
	});

	/* Slider vom Header Slider Blocks */
	$('.headerSlider').owlCarousel({
		loop: true,
		margin: 0,
		items: 1,
		nav: false,
		dots: true,
		lazyLoad: false,
		animateOut: 'slideOutDown',
		animateIn: 'flipInX',
		autoplay: false
	});

	/* Kurs Cards Slider */
	$('.courseSlider').owlCarousel({
		loop: true,
		autplay: false,
		navText: ['<i class="far fa-angle-left text-primary fa-10x"></i>', '<i class="far fa-angle-right text-primary fa-10x"></i>'],
		responsive: {
			0 : {
				items: 1,
				margin: 0,
				nav: false,
				dots: true
			},
			768 : {
				items: 2,
				margin: 10
			},
			992 : {
				items: 3,
				margin: 25,
			},
			1200 : {
				dots: false,
				nav: true,
				margin: 25
			}
		}
	});

	/* InfoButtons ein und ausfahren */
	$('#infoButtons li').on('click', function() {
		$(this).toggleClass('active');
	});

	/* Hamburger Button animinieren */
	$('.hamburger').on('click', function() {
		$(this).toggleClass('is-active');
	});

	/* Beim SanPool Accordion die Icons bei Klick auf Header auswechseln */
	$('.sanpool-accordion').on('hide.bs.collapse', function () {
		/* Alle Icons als Pfeil darstellen */
		$('.iconclosed').show();
		$('.iconopened').hide();
	});
	$('.sanpool-accordion').on('shown.bs.collapse', function () {
		/* Ermitteln welcher Header das offen ist */
		$('h2[aria-expanded="true"] .iconclosed').hide();
		$('h2[aria-expanded="true"] .iconopened').show();
	});

	/* Alle Tooltips aktivieren */
	$('[data-toggle="tooltip"]').tooltip();

})(jQuery);
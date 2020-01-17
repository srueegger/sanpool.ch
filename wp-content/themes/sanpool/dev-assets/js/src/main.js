(function($) {
	'use strict';

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
		navText: ['<i class="fas fa-angle-left text-primary fa-4x"></i>', '<i class="fas fa-angle-right text-primary fa-4x"></i>'],
		responsive: {
			0 : {
				items: 1,
				margin: 0,
				nav: false,
				dots: true
			},
			768 : {
				items: 3,
				margin: 25,
				dots: false,
				nav: true
			}
		}
	});

	/* InfoButtons ein und ausfahren */
	$('#infoButtons li').on('click', function() {
		$(this).toggleClass('active');
	});

})(jQuery);
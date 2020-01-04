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
		dots: false,
		autplay: false,
		navText: ['<i class="fas fa-angle-left text-white fa-4x"></i>', '<i class="fas fa-angle-right text-white fa-4x"></i>'],
		responsive: {
			0 : {
				items: 1,
				nav: false,
				dots: true,
				margin: 0
			},
			768 : {
				items: 3,
				nav: true,
				dots: false,
				margin: 25
			}
		}
	});

	/* InfoButtons ein und ausfahren */
	$('#infoButtons li').on('click', function() {
		$(this).toggleClass('active');
	});

})(jQuery);
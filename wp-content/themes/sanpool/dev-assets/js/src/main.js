(function($) {
	'use strict';

	/* Globale Variabeln */
	var map;
	var active_info_window;

	/* Slider vom Header Slider Blocks */
	var headerSlider = $('.headerSlider').owlCarousel({
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
	var sanpool_owl_carousel = $('.courseSlider, .teamSlider').owlCarousel({
		loop: true,
		autplay: false,
		nav: true,
		dots: true,
		navText: ['<i class="far fa-angle-left text-primary fa-8x"></i>', '<i class="far fa-angle-right text-primary fa-8x"></i>'],
		responsive: {
			0 : {
				items: 1,
				margin: 0,
			},
			768 : {
				items: 2,
				margin: 10
			},
			992 : {
				items: 3,
				margin: 25,
				nav: true,
				dots: false
			}
		}
	});

	/* Bugfix um OWL Navigation immer anzuzeigen */
	$('.courseSlider, .teamSlider').find('.owl-nav').removeClass('disabled');
	sanpool_owl_carousel.on('changed.owl.carousel', function(event) {
		$(this).find('.owl-nav').removeClass('disabled');
	});

	/* InfoButtons ein und ausfahren - Mobile Bugfix da es kein CSS Hover gibt */
 	$('#infoButtons li').on('click touchstart', function() {
		$(this).toggleClass('active');
		var goto_url = $(this).data('goto');
		console.log('URL: ' + goto_url);
		window.location.href = goto_url;
	});

	/* Hamburger Button animinieren */
	$('.hamburger').on('click', function() {
		$(this).toggleClass('is-active');
	});

	$('.collapse.faq').collapse({
		toggle: false
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

	/* Zahlen und Fakten Block - Zahlen animiert hochzählen */
	$('.numbers-and-facts .number').each(function () {
		$(this).prop('Counter',0).animate({
			Counter: $(this).text()
		}, {
			duration: 4000,
			easing: 'swing',
			step: function (now) {
				$(this).text(Math.ceil(now));
			}
		});
	});

	/* Funktion um das Kurs-Anmeldeformular vorzubereiten und anzuzeigen */
	function sp_prepare_and_show_subscribe_form(post_id, kurs_nr, lng) {
		/* Falls Formular eingeblendet ist Formular ausblenden */
		var form = $('#courseSubscribe .inner');
		var course_table_container = $('.kurse-table-container');
		form.removeClass('show');
		course_table_container.removeClass('mb-5');
		/* Weitere Daten ermitteln */
		var category_name = $('.category-title').text();
		var course_date = $('.' + post_id + '-date').text();
		var course_location = $('.' + post_id + '-location').text();
		/* Titel und unsichtbare Werte eintragen */
		$('#subscribe-kursnr').text(kurs_nr);
		$('#subscribe-category').text(category_name);
		$('#subscribe-date').text(course_date);
		$('#subscribe-lng').text(lng);
		$('#input_1_1').val(post_id);
		$('#input_1_2').val(kurs_nr);
		$('#input_1_17').val(course_date);
		$('#input_1_18').val(course_location);
		$('#input_1_19').val(lng);
		$('#input_1_20').val(category_name).trigger('change');
		course_table_container.addClass('mb-5');
		/* Formular anzeigen */
		form.addClass('show');
		/* Zum Formular scrollen */
		var header_height = $('header .fixed-top').outerHeight();
		$('html, body').animate({ 
			scrollTop: ($('#courseSubscribe').offset().top - header_height
		)}, 'slow');
	}

	/* Bei Klick auf "Anmelden-Button" Formular anzeigen */
	$('.js_subscribe_course').on('click', function() {
		/* Wichtige Variabeln ermitteln */
		var post_id = $(this).data('postid');
		var kurs_nr = $(this).data('kursnummer');
		var lng = $(this).data('lng');
		sp_prepare_and_show_subscribe_form(post_id, kurs_nr, lng);
	});

	/* Prüfen ob man auf einer Kurskategorie Seite ist, falls ja muss geprüft werden ob über dne Hastag Parameter mitgegeben wurden, falls ja muss die Funktion für die Kursanmeldung aufgerufen werden */
	if($('body').hasClass('tax-sp_kurskategorien') && window.location.hash) {
		/* Wir befinden uns auf der Kurskategorie Seite und es gibt einen Hash  */
		var hash = window.location.hash;
		/* Hastag entfernen */
		hash = hash.substring(1, hash.length);
		hash = hash.split(';');
		var post_id = hash[0];
		var kurs_nr = decodeURI(hash[1]);
		var lng = hash[2];
		/* Funktion starten */
		sp_prepare_and_show_subscribe_form(post_id, kurs_nr, lng);
	}

	/* Für den Parallax Footer muss die Höhe des Footers beim #page_wrapper als margin-bottom hinzugefügt werden */
	/* Funktion beim Seitenstart initialisieren */
	sp_add_margin_for_footer();
	/* Wenn Seitenfenster vergrössert oder verkleinert wird, muss die Funktion ebenfalls aufgerufen werden */
	$(window).on('resize', function(){
		sp_add_margin_for_footer();
	});

	/* Funktion die die Höhe des Footers misst und als Margin hinzufügt */
	function sp_add_margin_for_footer() {
		var footer_height = $('#siteFooter').outerHeight();
		$('#page_wrapper').css('margin-bottom', footer_height);
	}

	/* Video im Header Slider automatisch abspielen, wenn entsprechender Slide angezeigt wird */
	/* Alle Videos pausieren */
	headerSlider.on('translate.owl.carousel',function() {
		$('.owl-item video').each(function() {
			$(this).get(0).pause();
		});
	});
	/* Video bei azeige starten */
	headerSlider.on('translated.owl.carousel',function() {
		var video = $('.owl-item.active video');
		if(video.length) {
			video.get(0).play();
		}
	});

	/* Google Maps auf der Webseite initialissieren */
	function initMap( $el ) {

		// Find marker elements within map.
		var $markers = $el.find('.marker');
	
		// Create gerenic map.
		var mapArgs = {
			zoom : $el.data('zoom') || 16,
			mapTypeId : google.maps.MapTypeId.ROADMAP,
			styles: [
				{
					"featureType": "all",
					"stylers": [
						{
							"saturation": 0
						},
						{
							"hue": "#e7ecf0"
						}
					]
				},
				{
					"featureType": "road",
					"stylers": [
						{
							"saturation": -70
						}
					]
				},
				{
					"featureType": "transit",
					"stylers": [
						{
							"visibility": "off"
						}
					]
				},
				{
					"featureType": "poi",
					"stylers": [
						{
							"visibility": "off"
						}
					]
				},
				{
					"featureType": "water",
					"stylers": [
						{
							"visibility": "simplified"
						},
						{
							"saturation": -60
						}
					]
				}
			]
		};
		var map = new google.maps.Map( $el[0], mapArgs );
	
		// Add markers.
		map.markers = [];
		$markers.each(function(index){
			initMarker( $(this), map, index );
		});
	
		/* Open First Marker by Default */
		google.maps.event.trigger(map.markers[0], 'click');
	
		// Return map instance.
		return map;
	}

	/* Draw Markers on the Map */
	function initMarker( $marker, map, row_index ) {

		// Get position from marker.
		var lat = $marker.data('lat');
		var lng = $marker.data('lng');
		var location_name = $marker.data('locationname');
		var latLng = {
			lat: parseFloat( lat ),
			lng: parseFloat( lng )
		};
	
		// Create marker instance.
		var marker = new google.maps.Marker({
			position : latLng,
			map: map,
			title: location_name
		});
	
		// Append to reference for later use.
		map.markers.push( marker );

		var add_button_active_class = '';
		if(row_index == 0) {
			add_button_active_class = ' active';
		}

		var add_button = '<li class="list-inline-item"><h3 class="sanpool-marker-link' + add_button_active_class + '" data-markerid="' + row_index + '">' + location_name + '</h3></li>';
		$('#mapMarkersLinks').append(add_button);
	
		// If marker contains HTML, add it to an infoWindow.
		if( $marker.html() ){
	
			// Create info window.
			var infowindow = new google.maps.InfoWindow({
				content: $marker.html()
			});
	
			// Show info window when marker is clicked.
			google.maps.event.addListener(marker, 'click', function() {
				if (active_info_window) {
					active_info_window.close();
				}
				map.setCenter(marker.getPosition());
				infowindow.open( map, marker );
				active_info_window = infowindow;
			});
		}
	}


	/* Alle vorhanden Google Maps KArten auf der Webseite laden */
	$('.sanpool-map').each(function() {
		map = initMap( $(this) );
	});

	/* Bei Klick auf einen Marker Link, entsprechendes Info Modal öffnen und zum Bereich zoomen */
	$(document).on('click', '.sanpool-marker-link', function() {
		var marker_id = $(this).data('markerid');
		$('.sanpool-marker-link').removeClass('active');
		$(this).addClass('active');
		google.maps.event.trigger(map.markers[marker_id], 'click');
	});

	/* Aktionen durchführen, wenn Formulare erfolgreich abgesendet wurden */
	$(document).on('gform_confirmation_loaded', function(event, formId) {
		/* Status vom Kurs neu berechnen */
		if(formId == 1) {
			/* Formular 1 entsprich Kursanmeldenformular */
			console.log(event);
		}
	});
})(jQuery);
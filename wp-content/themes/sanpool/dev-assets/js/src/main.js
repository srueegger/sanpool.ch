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
	$('.courseSlider, .teamSlider').owlCarousel({
		loop: true,
		autplay: false,
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
				navText: ['<i class="far fa-angle-left text-primary fa-10x"></i>', '<i class="far fa-angle-right text-primary fa-10x"></i>'],
				margin: 25,
				items: 4
			}
		}
	});

	/* InfoButtons ein und ausfahren */
	/* Mobile muss da noch eine bessere Lösung gefunden werden */
/* 	$('#infoButtons li').on('click', function() {
		$(this).toggleClass('active');
	}); */

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
	function sp_prepare_and_show_subscribe_form(post_id, kurs_nr) {
		/* Falls Formular eingeblendet ist Formular ausblenden */
		var form = $('#courseSubscribe .inner');
		var course_table_container = $('.kurse-table-container');
		form.removeClass('show');
		course_table_container.removeClass('mb-5');
		/* Weitere Daten ermitteln */
		var category_name = $('.category-title').text();
		var course_date = $('.' + post_id + '-date').text();
		/* Titel und unsichtbare Werte eintragen */
		$('#subscribe-kursnr').text(kurs_nr);
		$('#subscribe-category').text(category_name);
		$('#subscribe-date').text(course_date);
		$('#input_1_1').val(post_id);
		$('#input_1_2').val(kurs_nr);
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
		sp_prepare_and_show_subscribe_form(post_id, kurs_nr);
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
		/* Funktion starten */
		sp_prepare_and_show_subscribe_form(post_id, kurs_nr);
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
})(jQuery);

$(document).ready(function(){

	console.log("HELL YEAH ART CORPUS");

	var isMobile = window.matchMedia("only screen and (max-width: 640px)").matches;

    if(!isMobile) {
		// Homepage Slick slideshow 
		$('.homeslideshow').slick({
			'arrows': false,
			'pauseOnHover': false,
			'lazyload': true,
			'autoplay': true,
	  		'autoplaySpeed': 3000,
	  		'infinite': true,
	  		'fade': true,
	  		'dots': false
		});
	}

	/**
	 * Masonry Gallery
	 */
	$artistGrid = $('.grid').masonry({
  		itemSelector: '.grid-item'
	});
	// Trigger layout Masonry after each image loads
	$artistGrid.imagesLoaded().progress( function() {
	  $artistGrid.masonry('layout');
	});


	$pageGrid = $('.post .gallery, .page .gallery').masonry({
  		itemSelector: 'figure'
	});
	$pageGrid.imagesLoaded().progress( function() {
	  $pageGrid.masonry('layout');
	});

	/**
	 * Light Gallery
	 * Used to open full page images 
	 */
	$artistGallery = $('.grid').lightGallery({
		'download': false
	});

	$pageGallery = $('.gallery').lightGallery({
		'download': false,
		'selector': 'a'
	});


	/**
	 * Unveil; lazy loading images
	 */
	$('.lazyload').unveil(200, function() {
		$(this).addClass("lazyload-loaded");
	});
	

	/**
	 * Google Maps
	 */
	function mapInitialize() {

		// Shop position
		// @48.8653514,2.3482692
		var mapCenter = { lat: 48.8653514, lng: 2.3482692 };

	    // Custom map style, from SnazzyMaps
	    var styleArray = [{"featureType":"all","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"landscape.natural","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.highway","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.highway.controlled_access","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"saturation":"-100"},{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"transit.station.rail","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"transit.station.rail","elementType":"labels.icon","stylers":[{"hue":"#ff0000"},{"saturation":"-100"},{"weight":"1"},{"invert_lightness":true}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}];

	    // Create a map object and specify the DOM element for display.
	    var map = new google.maps.Map(document.getElementById('footermap'), {
	        center: mapCenter,
	        scrollwheel: false,
	        mapTypeControl: false,
	        panControl: false,
	        draggable: !isMobile,
	        styles: styleArray,
	        zoom: 15
	    });

	    var markerImg = {
			url: baseURL + '/img/svg/pin.svg',
			size: new google.maps.Size(26, 36),
		    origin: new google.maps.Point(0, 0),
		    anchor: new google.maps.Point(13, 34)
		}
		var marker = new google.maps.Marker({
		  position: mapCenter,
		  map: map,
		  icon: markerImg,
		  title: 'Art Corpus'
		});
	}
	if(document.getElementById('footermap') !== null) {
		google.maps.event.addDomListener(window, 'load', mapInitialize);
	}


	/**
	 * Custom file upload buttons
	 */
	$('.input-file-container input[type="file"] ').on('change', function(event) {
		// Extract filename
		var fullPath = this.value;
		var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
	    var filename = fullPath.substring(startIndex);
	    if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
	        filename = filename.substring(1);
	    }
	    $('.input-file-feedback').html(filename);
	});


	/**
	 * Set Cookie
	 * @param String 	cName 		Cookie Name
	 * @param String 	cValue		Cookie Value
	 * @param int 		expiredays	Duration days
	 */
	function setCookie(cName, cValue, expiredays) {
	    var d = new Date();
	    d.setTime(d.getTime() + (expiredays*24*60*60*1000));
	    var expires = "expires="+ d.toUTCString();
	    document.cookie = cName + "=" + cValue + "; " + expires + "; path=/";
	}

	/**
	 * Get Cookie
	 * @param  String	cName 	Cookie Name
	 * @return String 			Cookie Value
	 */
	function getCookie(cName) {
	    var name = cName + "=";
	    var ca = document.cookie.split(';');
	    for(var i = 0; i <ca.length; i++) {
	        var c = ca[i];
	        while (c.charAt(0)==' ') {
	            c = c.substring(1);
	        }
	        if (c.indexOf(name) == 0) {
	            return c.substring(name.length,c.length);
	        }
	    }
	    return "";
	}

	/**
	 * Images Disclaimer
	 */
	
	var disclaimerCookieName = "disclaimer";
	if(getCookie(disclaimerCookieName) == "") {
		// Disclaimer is hidden by default. Show only if disclaimer cookie is not found. 
		$('#disclaimer').show();
	}
	$('#disclaimer #disclaimer-accept').click(function(event) {
		event.preventDefault();
		$('#disclaimer').hide();
		// Set cookie to "1" for one day
		setCookie(disclaimerCookieName, "1", 1);
	});


	/**
	 * Cookies Disclaimer
	 */
	var cookiesDisclaimerCookieName = "cookiesdisclaimer";
	if(getCookie(cookiesDisclaimerCookieName) == "") {
		// Disclaimer is hidden by default. Show only if disclaimer cookie is not found. 
		$('#cookies-disclaimer').show();
	}
	$('#cookies-disclaimer #cookies-accept').click(function(event) {
		event.preventDefault();
		$('#cookies-disclaimer').hide();
		// Set cookie to "1" for one day
		setCookie(cookiesDisclaimerCookieName, "1", 396); // Set cookie for 13 months
	});

});
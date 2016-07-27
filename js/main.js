
$(document).ready(function(){

	console.log("HELL YEAH ART CORPUS");

	// Homepage Slick slideshow 
	$('.homeslideshow').slick({
		'arrows': false,
		'pauseOnHover': false,
		'lazyload': true,
		'autoplay': true,
  		'autoplaySpeed': 2000,
  		'infinite': true,
  		'fade': true,
  		'dots': true
	});

	/**
	 * Masonry Gallery
	 */
	$grid = $('.grid').masonry({
  		itemSelector: '.grid-item'
	});
	// Trigger layout Masonry after each image loads
	$grid.imagesLoaded().progress( function() {
	  $grid.masonry('layout');
	});

	/**
	 * Light Gallery
	 * Used to open full page images 
	 */
	$gallery = $('.grid').lightGallery({
		'download': false
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
	google.maps.event.addDomListener(window, 'load', mapInitialize);


});
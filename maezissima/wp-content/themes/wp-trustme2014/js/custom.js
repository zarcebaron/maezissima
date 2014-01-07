(function ($) {
   $(document).ready(function(){
	  /* $('.home #top-block-bg').each(function(){
		var $obj = $(this);
		 
			$(window).scroll(function() {
				var yPos = -($(window).scrollTop() / $obj.data('speed')); 
		 
				var bgpos = '50% '+ yPos + 'px';
		 
				$obj.css('background-position', bgpos );
		 
			}); 
		});*/

		//var num = 310; //number of pixels before modifying styles
		$(window).bind('scroll', function () {
			if ($(window).scrollTop() > 306) {
				$('#mainmenu-block-bg').addClass('fixed');
				$('#content').addClass('pad');				
			} else {
				$('#mainmenu-block-bg').removeClass('fixed');
				$('#content').removeClass('pad');								
			}
		});		

	});
	 
	onResize = (function() {
		var wi = $(window).width();
		 if (wi <= 600){
			$("#top-block-bg").removeClass();
			}	 
		else if (wi <= 1024){
			$("#top-block-bg").removeClass();
			$("#top-block-bg").toggleClass('w1024');
			}	
		else if (wi <= 1440){
			$("#top-block-bg").removeClass();
			$("#top-block-bg").toggleClass('w1440');
			}
		else if (wi <= 1920){
			$("#top-block-bg").removeClass();
			$("#top-block-bg").toggleClass('w1920');
			}
		else {
			$("#top-block-bg").removeClass();
			$("#top-block-bg").toggleClass('large');
			}
	});
	$(document).ready(onResize);
	$(window).bind('resize', onResize);
	
	hideBoxes = (function() {
		var wi = $(window).width();
 
		 if (wi <= 1190){
			$(".facebook-box").parent().css('display','none');	
			}	
		else {
			$(".facebook-box").parent().css('display','block');
			}
	});
	$(document).ready(hideBoxes);
	$(window).bind('resize', hideBoxes);	
	
	hideFeat = (function() {
		var wi = $(window).width();
 
		 if (wi <= 700){
			$("#feat-banner").parent().parent().parent().parent().css('display','none');	
			}	
		else {
			$("#feat-banner").parent().parent().parent().parent().css('display','block');
			}
	});
	$(document).ready(hideFeat);
	$(window).bind('resize', hideFeat);	
 
	/*
	*  render_map
	*
	*  This function will render a Google Map onto the selected jQuery element
	*
	*  @type	function
	*  @date	8/11/2013
	*  @since	4.3.0
	*
	*  @param	$el (jQuery element)
	*  @return	n/a
	*/
	 
	function render_map( $el ) {
	 
		// var
		var $markers = $el.find('.marker');
	 
		// vars
		var args = {
			zoom		: 16,
			center		: new google.maps.LatLng(0, 0),
			mapTypeId	: google.maps.MapTypeId.ROADMAP
		};
	 
		// create map	        	
		var map = new google.maps.Map( $el[0], args);
	 
		// add a markers reference
		map.markers = [];
	 
		// add markers
		$markers.each(function(){
	 
			add_marker( $(this), map );
	 
		});
	 
		// center map
		center_map( map );
	 
	}
	 
	/*
	*  add_marker
	*
	*  This function will add a marker to the selected Google Map
	*
	*  @type	function
	*  @date	8/11/2013
	*  @since	4.3.0
	*
	*  @param	$marker (jQuery element)
	*  @param	map (Google Map object)
	*  @return	n/a
	*/
	 
	function add_marker( $marker, map ) {
	 
		// var
		var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );
	 
		// create marker
		var marker = new google.maps.Marker({
			position	: latlng,
			map			: map
		});
	 
		// add to array
		map.markers.push( marker );
	 
		// if marker contains HTML, add it to an infoWindow
		if( $marker.html() )
		{
			// create info window
			var infowindow = new google.maps.InfoWindow({
				content		: $marker.html()
			});
	 
			// show info window when marker is clicked
			google.maps.event.addListener(marker, 'click', function() {
	 
				infowindow.open( map, marker );
	 
			});
		}
	 
	}
	 
	/*
	*  center_map
	*
	*  This function will center the map, showing all markers attached to this map
	*
	*  @type	function
	*  @date	8/11/2013
	*  @since	4.3.0
	*
	*  @param	map (Google Map object)
	*  @return	n/a
	*/
	 
	function center_map( map ) {
	 
		// vars
		var bounds = new google.maps.LatLngBounds();
	 
		// loop through all markers and create bounds
		$.each( map.markers, function( i, marker ){
	 
			var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );
	 
			bounds.extend( latlng );
	 
		});
	 
		// only 1 marker?
		if( map.markers.length == 1 )
		{
			// set center of map
			map.setCenter( bounds.getCenter() );
			map.setZoom( 16 );
		}
		else
		{
			// fit to bounds
			map.fitBounds( bounds );
		}
	 
	}
	 
	/*
	*  document ready
	*
	*  This function will render each map when the document is ready (page has loaded)
	*
	*  @type	function
	*  @date	8/11/2013
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/
	 
	$(document).ready(function(){
	 
		$('.acf-map').each(function(){
	 
			render_map( $(this) );
	 
		});
	 
	});
	/* ENDS RENDER MAP*/	
	    	
}(jQuery));

// *********************************************

jQuery.noConflict()(function($){
	$(document).ready(function() {

	$('a[data-rel]').each(function() {
	    $(this).attr('rel', $(this).data('rel'));
	});		

		$("a[rel^='prettyPhoto']").prettyPhoto({
			animationSpeed: 'normal', /* fast/slow/normal */
			opacity: 0.80, /* Value between 0 and 1 */
			showTitle: true, /* true/false */
			theme:'light_square'
		});

		$('p:empty').remove();
	
$result = '<a href="' + $('.widget-title h3 .rsswidget').attr('href') + '" class="rsswidget">'+ $('.widget-title h3 a').html() +'</a><a class="rsswidget" href="'+$('.widget-title h3 .rsswidget + .rsswidget').attr('href')+'">'+$('.widget-title h3 .rsswidget + .rsswidget').text()+'</a>';

$('.widget-title h3 .rsswidget + .rsswidget').after('RSSFEED ').remove();
$('.widget-title h3 .rsswidget').remove();

$(".widget-title h3, .footer-widget-title h3, .nav-tabs > li > a").html(function(i, text){
  return text.replace(/\w+\s/, function(match){
    return '<span class="colored-title">' + match + '</span>';

}); });         

$(".widget-title h3, .footer-widget-title h3, .nav-tabs > li > a").html(function(i, text){
  return text.replace(/\D+\s/, function(match){
    return '<span class="colored-title">' + match + '</span>';

}); }); 


$(".widget-title h3, .footer-widget-title h3").html(function(i, text){
  return text.replace('RSSFEED', function(match){
    return $result;

}); });	


$('.entry-post-category a, .small-comments-ico a, .left-col li a, .right-col li a, .comments-ico a, a.big-thumb-link, li.cat-item a, #social-counter a, .related-posts-single li a, .meta-author a, .category-item a, .widget .tagcloud a[class|="tag-link"], .tagcloud a[class|="tag-link"], .user-ico a, #respond a, .prev-arrow, .next-arrow').tooltip({
	track: true,
	delay: 0,
	showURL: false,
	fade: 200,
	deeplinking: false	
});
		

		

	});
});


	
		
jQuery.noConflict()(function($){
	$(document).ready(function() {
		
			// Create the dropdown bases
			$("<select />").appendTo(".navigation");
				
			// Create default option "Go to..."
			$("<option />", {
			   "selected": "selected",
			   "value"   : "",
			   "text"    : "Ir para..."
			}).appendTo(".navigation select");
				
				
			// Populate dropdowns with the first menu items
			$(".navigation li a").each(function() {
			 	var el = $(this);
			 	$("<option />", {
			     	"value"   : el.attr("href"),
			    	"text"    : el.text()
			 	}).appendTo(".navigation select");
			});
			
			//make responsive dropdown menu actually work			
	      	$(".navigation select").change(function() {
	        	window.location = $(this).find("option:selected").val();
	      	});
	      	
		});
		});


		
/***************************************************
			SuperFish Menu
***************************************************/	
// initialise plugins
	jQuery.noConflict()(function(){
		jQuery('ul.sf-menu').superfish({
			delay:400,
//			pathClass:  'current-menu-item',
//			speed: 'fast',
	        autoArrows:  false,                           // disable generation of arrow mark-up 
            dropShadows: false  			
//			animation:   {opacity:'show'}			
			
		});
		
	});




/*******************************
			FitVids
********************************/
jQuery.noConflict()(function($){
  $(document).ready(function(){
    // Target your .container, .wrapper, .post, etc.
//    $(".single-video-post, .single-media-thumb").fitVids({ customSelector: "iframe[src^='http://www.dailymotion.com']"});
  });
});

jQuery.noConflict()(function($){
	$(window).load(function() {
	
	var $window = $(window)
	// make code pretty
    window.prettyPrint && prettyPrint()
	
	});
});
(function ($) {
   $(document).ready(function(){
	   $('.home #top-block-bg').each(function(){
		var $obj = $(this);
		 
			$(window).scroll(function() {
				var yPos = -($(window).scrollTop() / $obj.data('speed')); 
		 
				var bgpos = '50% '+ yPos + 'px';
		 
				$obj.css('background-position', bgpos );
		 
			}); 
		});

		//var num = 310; //number of pixels before modifying styles
		$(window).bind('scroll', function () {
			if ($(window).scrollTop() > 162) {
				$('#mainmenu-block-bg').addClass('fixed');
				$('#content').addClass('pad');				
			} else {
				$('#mainmenu-block-bg').removeClass('fixed');
				$('#content').removeClass('pad');								
			}
		});		
				
		$(window).bind('scroll', function () {
			if ($(window).scrollTop() > 309) {
				$('.home #mainmenu-block-bg').addClass('fixed');
				$('.home #content').addClass('pad');					
			} else {
				$('.home #mainmenu-block-bg').removeClass('fixed');
				$('.home #content').removeClass('pad');												
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
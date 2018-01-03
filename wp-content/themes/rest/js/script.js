jQuery(document).ready(function(){
	"use strict"; 

/*
* Header
*/
var heightwind = jQuery(window).height();

	jQuery(window).scroll(function() {
		if (jQuery(this).scrollTop() > heightwind){ 
			jQuery(".hide-header").addClass('showhedaer'); 
		}else{
			jQuery(".hide-header").removeClass('showhedaer'); 

		}
	});

/*
* Animation
*/
 var wow = new WOW(
  {
    boxClass:     'wow',      // animated element css class (default is wow)
    animateClass: 'animation-activex', // animation css class (default is animated)
    offset:       0,          // distance to the element when triggering the animation (default is 0)
    mobile:       true,       // trigger animations on mobile devices (default is true)
    live:         true,       // act on asynchronously loaded content (default is true)
    callback:     function(box) {
      // the callback is fired every time an animation is started
      // the argument that is passed in is the DOM node being animated
    },
    scrollContainer: null // optional scroll container selector, otherwise use window
  }
);
wow.init();
 

 

}); // end redy function
/*
* 
*/

jQuery('.buton-close-maps').click(function(){

	jQuery(".content-maps").removeClass('hide-cont'); 
	jQuery(".map-overlay-walp").removeClass('hide-overlay'); 
	jQuery("#map").removeClass('show-maps'); 
	jQuery("#map").css({'top': 0});
	jQuery(".buton-close-maps").css({'display': 'none'});
});

/*
* map
*/
jQuery('.but-maps').click(function(){

	jQuery(".content-maps").addClass('hide-cont'); 
	jQuery(".map-overlay-walp").addClass('hide-overlay'); 
	jQuery("#map").addClass('show-maps');
	var offsetTop = jQuery('#map').offset().top;
	var result = offsetTop - jQuery(window).scrollTop();
	jQuery("#map").css({'top': - result});
	jQuery(".buton-close-maps").css({'display': 'block'});


});

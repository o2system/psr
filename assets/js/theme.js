(function($) {
	"use strict";

    var $window = $(window);

	new WOW().init();

	/*FLEXSLIDER*/
	if (jQuery().flexslider) {

        $('.flexslider.banner').flexslider({
            animation: "fade",
            slideshowSpeed: 7000,
            animationSpeed: 1500,
            controlNav: false,
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>'
        });
    }

    // Remove Flex Slider Navigation for Smaller Screens Like IPhone Portrait
    $('.flexslider.banner').hover(function () {
        $(this).children('.flex-direction-nav').stop(true, true).fadeIn();
    }, function () {
        $(this).children('.flex-direction-nav').stop(true, true).fadeOut();
    });

	//Highlight
    hljs.initHighlightingOnLoad();

})(jQuery);
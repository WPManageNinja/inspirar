jQuery(document).ready( function($) {
	'use strict';

	// main menu background color change
    var navBg = $('.agency-menu');
  	$(window).scroll(function () {
        if ($(window).scrollTop() > 115) {
            navBg.addClass('inspirar-bg-primary')
                 .removeClass('menu-transparent');
        }
        if ($(window).scrollTop() < 116) {
            navBg.addClass('menu-transparent')
                 .removeClass('inspirar-bg-primary');
        }

    });


    $('.mobile-menu').meanmenu();

    //=================== Adminer add class ====================
    $('#wpadminbar').addClass('mobile');
});
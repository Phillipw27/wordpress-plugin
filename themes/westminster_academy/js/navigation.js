/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens.
 */
( function($) {
	var container, button, menu;

	container = document.getElementById( 'site-navigation' );
	if ( ! container )
		return;

	button = container.getElementsByTagName( 'h1' )[0];
	if ( 'undefined' === typeof button )
		return;

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	if ( -1 === menu.className.indexOf( 'nav-menu' ) )
		menu.className += ' nav-menu';

	jQuery('.no-touch #site-navigation h1').on('click', function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) )
			container.className = container.className.replace( ' toggled', '' );
		else
			container.className += ' toggled';
	});

	jQuery('.touch #site-navigation h1').on('touchstart', function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) )
			container.className = container.className.replace( ' toggled', '' );
		else
			container.className += ' toggled';
	});

	var sublink = jQuery('.submenu a');

	var tabwrapper = $('.tab-wrapper');
	tabwrapper.not(':first-child').hide();
	sublink.first().addClass('selected');

    sublink.on('click', function(e) {
        e.preventDefault();

        sublink.removeClass('selected');
        jQuery(this).addClass('selected');

       	var goTo = jQuery(jQuery(this).attr('href')); // selects element that was clicked
        //var offset = goTo.offset(); //grabs position of element
      	
      	// NEED TO CHECK FOR SCROLL STILL!!!!!!!
        // $('.submenu-scroll').scrollTo( goTo, 800 )

        // jQuery('html,body').animate({scrollTop: jQuery('.submenu').offset().top - 60}, 800);

        // show content on click
        tabwrapper.hide();
        goTo.parents('.tab-wrapper').show();
        return false;
    });	

	

 	var maxHeight = -1;
 	var screenWidth = (window.innerWidth > 0) ? window.innerWidth : screen.width;

	sublink.each(function() {
		maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
	});

	sublink.each(function() {
	 	$(this).height(maxHeight);
	});

    var timer;
    $(window).resize(function() {
        clearTimeout(timer);
        id = setTimeout(resizing, 100);
    });

    // MIN HEIGHT /// 
/*
    var wHeight = $(window).height();
    var featuredImageHeight = $('#featured-image').height();
    var subtract = $('header#masthead').innerHeight() + $('footer#colophon').innerHeight() + featuredImageHeight + 15;
    var minHeight = wHeight - subtract;
    $('.no-touch #main-content').css('min-height', minHeight);
*/
    

    // fire function after resize
    function resizing() {
    	maxHeight = -1;
		sublink.each(function() {
			$(this).attr('style', ''); 
			maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
		});

		sublink.each(function() {
		 	$(this).height(maxHeight);
		});   

		var wHeight = $(window).height();
    	var subtract = $('header#masthead').innerHeight() + $('footer#colophon').innerHeight() + 15;
    	var minHeight = wHeight - subtract;
    	$('.no-touch #main-content').css('min-height', minHeight);
    }

 //    setTimeout(function() {
 //    $('.dp_pec_wrapper .selectric .label').text('Sort by');
	// }, 1000);

    // hide notification if you click the box away form the link
    
    setTimeout(function() {
        $('#notification-area').addClass('slide-in');
    }, 1500);
    
    $('.close-note').on('click', function(e) {
    	$('#notification-area').removeClass('slide-in');
        if ($('.mobile').length > 0) {
            $('#notification-area').remove();
        }
    });

} )(jQuery);

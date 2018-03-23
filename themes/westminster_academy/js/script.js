// Theme script.js
/* ============================================================================ */
// Copyright (c) 2014 Scott Siemens (http://scottsiemens.com)
// version 0.1
// Licensed under the MIT License (LICENSE.txt).

// RBC - Responsive Body Class Helpers

// ClasseNames triggered
// desktop - 1024px and up
// tablet - 1023px - 775px
// mobile - 774px and down
// no-touch
// touch
/* ============================================================================ */

(function ($) {    
    
    function rbc() {
        // probably need this eh? 
        var rBody = $('body');

        // get width properly for device or browser
        var rWidth = (window.innerWidth > 0) ? window.innerWidth : screen.width;

        // get touch information
        function is_touch() {
        	return 'ontouchstart' in window 
            || 'onmsgesturechange' in window;
        }

        // does this device have touch? 
        var rTouch  = is_touch();
        var rDevice = (rTouch === true) ? 'touch' : 'no-touch';

        // pick out class names based on width
        var rPhase = (rWidth < 774) ? 'mobile' : (rWidth > 1023) ? 'desktop' : 'tablet';

        // sets classes function
        function rClass(rPhase, rDevice) {
        	
        	// we remove for resize case
        	rBody.removeClass('desktop tablet mobile');

        	// add classes to body tag
        	rBody.addClass(rPhase);
        	rBody.addClass(rDevice);
        }

        rClass(rPhase, rDevice);
    }

    setTimeout(function() {
    	rbc();
    }, 1);

    // capture resize
    var rTimer;
    $(window).resize(function() {
        clearTimeout(rTimer);
        id = setTimeout(rResizing, 100);
    });

    // fire function after resize
    function rResizing() {
        rbc();
    }
    
    $('#site-navigation a[href="#nolink"]').on('click', function(e) {
        e.preventDefault();
        
        return false; 
    });

})(jQuery);

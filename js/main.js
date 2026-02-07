/**
 * Main JavaScript file for Julius Theme
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        // Mobile Menu Toggle
        $('.mobile-menu-toggle').on('click', function() {
            $('.mobile-menu').toggleClass('hidden');
            
            // Toggle icon between menu and close
            const svg = $(this).find('svg');
            if ($('.mobile-menu').hasClass('hidden')) {
                // Show menu icon
                svg.html('<line x1="4" x2="20" y1="12" y2="12"></line><line x1="4" x2="20" y1="6" y2="6"></line><line x1="4" x2="20" y1="18" y2="18"></line>');
            } else {
                // Show close icon
                svg.html('<path d="M18 6 6 18"></path><path d="m6 6 12 12"></path>');
            }
        });

        // Close mobile menu when clicking outside
        $(document).on('click', function(event) {
            if (!$(event.target).closest('header').length) {
                $('.mobile-menu').addClass('hidden');
                // Reset to menu icon
                $('.mobile-menu-toggle svg').html('<line x1="4" x2="20" y1="12" y2="12"></line><line x1="4" x2="20" y1="6" y2="6"></line><line x1="4" x2="20" y1="18" y2="18"></line>');
            }
        });

        // Close mobile menu on window resize to desktop size
        $(window).on('resize', function() {
            if ($(window).width() >= 768) {
                $('.mobile-menu').addClass('hidden');
                $('.mobile-menu-toggle svg').html('<line x1="4" x2="20" y1="12" y2="12"></line><line x1="4" x2="20" y1="6" y2="6"></line><line x1="4" x2="20" y1="18" y2="18"></line>');
            }
        });

        console.log('Julius Theme loaded');
    });

})(jQuery);

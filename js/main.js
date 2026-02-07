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

        // Hero Slider
        let currentSlide = 0;
        const slides = $('.hero-slide');
        const indicators = $('.hero-indicator');
        const totalSlides = slides.length;
        let autoplayInterval;

        function showSlide(index) {
            // Ensure index is within bounds
            if (index >= totalSlides) {
                index = 0;
            } else if (index < 0) {
                index = totalSlides - 1;
            }

            currentSlide = index;

            // Hide all slides
            slides.removeClass('opacity-100').addClass('opacity-0');
            
            // Show current slide
            slides.eq(currentSlide).removeClass('opacity-0').addClass('opacity-100');

            // Update indicators
            indicators.each(function(i) {
                if (i === currentSlide) {
                    $(this).removeClass('bg-white/50 w-3').addClass('bg-primary w-8');
                } else {
                    $(this).removeClass('bg-primary w-8').addClass('bg-white/50 w-3');
                }
            });
        }

        function nextSlide() {
            showSlide(currentSlide + 1);
        }

        function prevSlide() {
            showSlide(currentSlide - 1);
        }

        function startAutoplay() {
            autoplayInterval = setInterval(nextSlide, 5000); // Change slide every 5 seconds
        }

        function stopAutoplay() {
            clearInterval(autoplayInterval);
        }

        // Next button
        $('.hero-next').on('click', function() {
            stopAutoplay();
            nextSlide();
            startAutoplay();
        });

        // Previous button
        $('.hero-prev').on('click', function() {
            stopAutoplay();
            prevSlide();
            startAutoplay();
        });

        // Indicator buttons
        indicators.on('click', function() {
            stopAutoplay();
            const slideIndex = $(this).data('slide');
            showSlide(slideIndex);
            startAutoplay();
        });

        // Start autoplay if slides exist
        if (slides.length > 0) {
            startAutoplay();

            // Pause on hover
            $('.hero-slider').on('mouseenter', stopAutoplay);
            $('.hero-slider').on('mouseleave', startAutoplay);
        }

        console.log('Julius Theme loaded');
    });

})(jQuery);

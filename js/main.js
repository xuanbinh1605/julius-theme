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

        // Floating Social Icons Ripple Animation
        $('.julius-float-icon').each(function() {
            const $icon = $(this);
            
            // Create ripple animation on interval
            setInterval(function() {
                const $ripple = $icon.find('.julius-ripple');
                
                // Reset animation by removing and re-adding class
                $ripple.removeClass('julius-ripple-animate');
                
                // Force reflow to restart animation
                void $ripple[0].offsetWidth;
                
                // Add animation class
                $ripple.addClass('julius-ripple-animate');
            }, 3000); // Ripple every 3 seconds
        });
        
        // Add scale effect on hover
        $('.julius-float-icon').on('mouseenter', function() {
            $(this).find('img').css('transform', 'scale(1.1)');
        }).on('mouseleave', function() {
            $(this).find('img').css('transform', 'scale(1)');
        });

        // Service Booking Form
        $('.julius-booking-form').on('submit', function(e) {
            e.preventDefault();
            
            const $form = $(this);
            const $button = $form.find('button[type="submit"]');
            const $response = $form.find('.booking-response');
            const originalButtonText = $button.html();
            
            // Disable button and show loading
            $button.prop('disabled', true).html('<svg class="animate-spin w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Sending...');
            
            // Get form data
            const formData = $form.serialize();
            
            // Send AJAX request
            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        // Show success message
                        $response.html('<div class="bg-primary/10 border border-primary/30 text-primary rounded-md p-3 text-sm">' + response.data.message + '</div>');
                        
                        // Reset form
                        $form[0].reset();
                        
                        // Scroll to response
                        $('html, body').animate({
                            scrollTop: $response.offset().top - 100
                        }, 500);
                    } else {
                        // Show error message
                        $response.html('<div class="bg-destructive/10 border border-destructive/30 text-destructive rounded-md p-3 text-sm">' + response.data.message + '</div>');
                    }
                },
                error: function() {
                    $response.html('<div class="bg-destructive/10 border border-destructive/30 text-destructive rounded-md p-3 text-sm">An error occurred. Please try again later.</div>');
                },
                complete: function() {
                    // Re-enable button
                    $button.prop('disabled', false).html(originalButtonText);
                    
                    // Hide message after 5 seconds
                    setTimeout(function() {
                        $response.fadeOut(function() {
                            $(this).html('').show();
                        });
                    }, 5000);
                }
            });
        });

        // Services Archive - Category Filter
        $('.julius-category-filter').on('click', function(e) {
            e.preventDefault();
            
            const $button = $(this);
            const categoryId = $button.data('category');
            const $container = $('#julius-services-container');
            
            // Update active button state
            $('.julius-category-filter').removeClass('bg-primary text-primary-foreground').addClass('bg-secondary/50 text-foreground hover:bg-secondary');
            $button.removeClass('bg-secondary/50 text-foreground hover:bg-secondary').addClass('bg-primary text-primary-foreground');
            
            // Show loading state
            $container.html('<div class="text-center py-12"><svg class="animate-spin w-8 h-8 mx-auto text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg><p class="mt-4 text-muted-foreground">Loading services...</p></div>');
            
            // Send AJAX request
            $.ajax({
                url: juliusAjax.ajaxurl,
                type: 'POST',
                data: {
                    action: 'julius_filter_services',
                    category_id: categoryId,
                    nonce: juliusAjax.nonce
                },
                success: function(response) {
                    if (response.success) {
                        // Update container with filtered services
                        $container.html(response.data.html);
                        
                        // Smooth scroll to services
                        $('html, body').animate({
                            scrollTop: $container.offset().top - 150
                        }, 300);
                    } else {
                        $container.html('<div class="text-center py-12"><p class="text-muted-foreground">' + (response.data.message || 'No services found.') + '</p></div>');
                    }
                },
                error: function() {
                    $container.html('<div class="text-center py-12"><p class="text-destructive">An error occurred. Please refresh the page.</p></div>');
                }
            });
        });

        // Gallery Lightbox
        let galleryImages = [];
        let currentImageIndex = 0;

        // Initialize gallery images
        function initGalleryLightbox() {
            galleryImages = [];
            $('[data-gallery-image]').each(function(index) {
                galleryImages.push({
                    url: $(this).data('gallery-image'),
                    alt: $(this).data('gallery-alt')
                });
                
                // Add click handler
                $(this).on('click', function() {
                    currentImageIndex = index;
                    openLightbox();
                });
            });
        }

        function openLightbox() {
            const $lightbox = $('#julius-gallery-lightbox');
            const $lightboxImage = $('#julius-lightbox-image');
            const $currentCounter = $('#julius-lightbox-current');
            const $totalCounter = $('#julius-lightbox-total');
            const $header = $('header');
            
            if (galleryImages.length === 0) return;
            
            // Hide header and disable scrolling
            $header.css('transform', 'translateY(-100%)');
            $('body').css('overflow', 'hidden');
            
            // Set image and counter
            $lightboxImage.attr('src', galleryImages[currentImageIndex].url);
            $lightboxImage.attr('alt', galleryImages[currentImageIndex].alt);
            $currentCounter.text(currentImageIndex + 1);
            $totalCounter.text(galleryImages.length);
            
            // Show lightbox
            $lightbox.removeClass('hidden').css('display', 'flex');
        }

        function closeLightbox() {
            const $lightbox = $('#julius-gallery-lightbox');
            const $header = $('header');
            
            // Show header and enable scrolling
            $header.css('transform', 'translateY(0)');
            $('body').css('overflow', '');
            
            $lightbox.addClass('hidden').css('display', 'none');
        }

        function showNextImage() {
            currentImageIndex = (currentImageIndex + 1) % galleryImages.length;
            openLightbox();
        }

        function showPrevImage() {
            currentImageIndex = (currentImageIndex - 1 + galleryImages.length) % galleryImages.length;
            openLightbox();
        }

        // Lightbox controls
        $('#julius-lightbox-close').on('click', closeLightbox);
        $('#julius-lightbox-next').on('click', showNextImage);
        $('#julius-lightbox-prev').on('click', showPrevImage);
        
        // Close on background click
        $('#julius-gallery-lightbox').on('click', function(e) {
            if (e.target === this) {
                closeLightbox();
            }
        });
        
        // Keyboard navigation
        $(document).on('keydown', function(e) {
            const $lightbox = $('#julius-gallery-lightbox');
            if (!$lightbox.hasClass('hidden')) {
                if (e.key === 'Escape') {
                    closeLightbox();
                } else if (e.key === 'ArrowRight') {
                    showNextImage();
                } else if (e.key === 'ArrowLeft') {
                    showPrevImage();
                }
            }
        });

        // Initialize gallery on page load
        initGalleryLightbox();

        console.log('Julius Theme loaded');
    });

})(jQuery);

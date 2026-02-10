/**
 * Booking Form AJAX Handler
 * Note: Service page booking form uses inline validation in single-service.php
 * This file only handles the contact page form to avoid conflicts
 */
(function($) {
    'use strict';
    
    $(document).ready(function() {
        // Contact page booking form
        $('.julius-contact-form').on('submit', function(e) {
            e.preventDefault();
            
            var $form = $(this);
            var $button = $form.find('button[type="submit"]');
            var $responseContainer = $form.find('.contact-response');
            
            // Remove existing messages
            $responseContainer.html('').removeClass('success error');
            
            // Disable button
            $button.prop('disabled', true).text('Sending...');
            
            // AJAX request
            $.ajax({
                url: $form.attr('action'),
                type: 'POST',
                data: $form.serialize(),
                success: function(response) {
                    if (response.success) {
                        // Success
                        $responseContainer
                            .addClass('success')
                            .html('<div class="contact-message contact-success"><p>' + response.data.message + '</p></div>')
                            .slideDown();
                        
                        // Clear form
                        $form[0].reset();
                        
                        // Hide message after 8 seconds
                        setTimeout(function() {
                            $responseContainer.slideUp(function() {
                                $(this).html('').removeClass('success');
                            });
                        }, 8000);
                    } else {
                        // Error
                        $responseContainer
                            .addClass('error')
                            .html('<div class="contact-message contact-error"><p>' + response.data.message + '</p></div>')
                            .slideDown();
                        
                        // Hide message after 8 seconds
                        setTimeout(function() {
                            $responseContainer.slideUp(function() {
                                $(this).html('').removeClass('error');
                            });
                        }, 8000);
                    }
                },
                error: function() {
                    $responseContainer
                        .addClass('error')
                        .html('<div class="contact-message contact-error"><p>Something went wrong. Please try again later.</p></div>')
                        .slideDown();
                    
                    setTimeout(function() {
                        $responseContainer.slideUp(function() {
                            $(this).html('').removeClass('error');
                        });
                    }, 8000);
                },
                complete: function() {
                    // Re-enable button
                    $button.prop('disabled', false).text('Send Message');
                }
            });
        });
    });
    
})(jQuery);

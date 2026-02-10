/**
 * Newsletter AJAX Handler
 */
(function($) {
    'use strict';
    
    $(document).ready(function() {
        // Handle newsletter form submission
        $('.julius-newsletter-form').on('submit', function(e) {
            e.preventDefault();
            
            var $form = $(this);
            var $button = $form.find('button[type="submit"]');
            var $emailInput = $form.find('input[type="email"]');
            var $messageContainer = $form.find('.newsletter-message');
            var email = $emailInput.val();
            
            // Remove existing messages
            if ($messageContainer.length === 0) {
                $form.append('<div class="newsletter-message"></div>');
                $messageContainer = $form.find('.newsletter-message');
            }
            $messageContainer.removeClass('success error').html('');
            
            // Disable button
            $button.prop('disabled', true).text('Subscribing...');
            
            // AJAX request
            $.ajax({
                url: juliusNewsletter.ajaxurl,
                type: 'POST',
                data: {
                    action: 'julius_newsletter_subscribe',
                    nonce: juliusNewsletter.nonce,
                    email: email
                },
                success: function(response) {
                    if (response.success) {
                        // Success
                        $messageContainer
                            .addClass('success')
                            .html('<p>' + response.data.message + '</p>')
                            .slideDown();
                        
                        // Clear form
                        $emailInput.val('');
                        
                        // Hide message after 5 seconds
                        setTimeout(function() {
                            $messageContainer.slideUp(function() {
                                $(this).html('').removeClass('success');
                            });
                        }, 5000);
                    } else {
                        // Error
                        $messageContainer
                            .addClass('error')
                            .html('<p>' + response.data.message + '</p>')
                            .slideDown();
                        
                        // Hide message after 5 seconds
                        setTimeout(function() {
                            $messageContainer.slideUp(function() {
                                $(this).html('').removeClass('error');
                            });
                        }, 5000);
                    }
                },
                error: function() {
                    $messageContainer
                        .addClass('error')
                        .html('<p>Something went wrong. Please try again later.</p>')
                        .slideDown();
                    
                    setTimeout(function() {
                        $messageContainer.slideUp(function() {
                            $(this).html('').removeClass('error');
                        });
                    }, 5000);
                },
                complete: function() {
                    // Re-enable button
                    $button.prop('disabled', false).text('Subscribe');
                }
            });
        });
    });
    
})(jQuery);

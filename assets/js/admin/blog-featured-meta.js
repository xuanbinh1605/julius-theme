/**
 * Blog Featured Article Meta Box
 */
(function($) {
    'use strict';

    $(document).ready(function() {
        var $checkbox = $('input[name="julius_featured_article"]');
        var originalState = $checkbox.is(':checked');

        $checkbox.on('change', function() {
            var $this = $(this);
            var isChecked = $this.is(':checked');

            // Only check if user is trying to mark as featured
            if (isChecked) {
                // Check if there's already a featured article
                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        action: 'julius_check_featured_article',
                        nonce: juliusBlogFeatured.nonce,
                        current_post_id: $('#post_ID').val()
                    },
                    success: function(response) {
                        if (response.success && response.data.has_featured) {
                            // Show confirmation modal
                            var featuredPost = response.data.featured_post;
                            var message = 'There is already a featured article:\n\n"' + featuredPost.title + '"\n\n' +
                                        'Marking this article as featured will automatically unmark the previous one.\n\n' +
                                        'Do you want to continue?';

                            if (!confirm(message)) {
                                // User cancelled, uncheck the box
                                $this.prop('checked', false);
                            }
                        }
                    },
                    error: function() {
                        // On error, keep it checked (fail gracefully)
                        console.log('Error checking featured article status');
                    }
                });
            }
        });
    });

})(jQuery);

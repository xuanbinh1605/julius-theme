/**
 * Blog Author Avatar Upload Handler
 *
 * @package Julius_Theme
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        var mediaUploader;
        
        // Upload avatar button
        $(document).on('click', '.julius-upload-author-avatar-button', function(e) {
            e.preventDefault();
            
            var button = $(this);
            var previewContainer = $('#author_avatar_preview');
            var avatarInput = $('#author_avatar');
            var removeButton = $('.julius-remove-author-avatar-button');
            
            // If the media uploader already exists, reopen it
            if (mediaUploader) {
                mediaUploader.open();
                return;
            }
            
            // Create a new media uploader
            mediaUploader = wp.media({
                title: 'Select or Upload Author Avatar',
                button: {
                    text: 'Use this image'
                },
                multiple: false
            });
            
            // When an image is selected
            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                
                // Set the avatar ID
                avatarInput.val(attachment.id);
                
                // Display the avatar preview (circular)
                var imageUrl = attachment.sizes && attachment.sizes.thumbnail 
                    ? attachment.sizes.thumbnail.url 
                    : attachment.url;
                    
                previewContainer.html('<img src="' + imageUrl + '" style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover; display: block; margin-bottom: 10px;">');
                
                // Show remove button
                removeButton.show();
            });
            
            // Open the media uploader
            mediaUploader.open();
        });
        
        // Remove avatar button
        $(document).on('click', '.julius-remove-author-avatar-button', function(e) {
            e.preventDefault();
            
            // Clear the avatar ID
            $('#author_avatar').val('');
            
            // Clear the preview
            $('#author_avatar_preview').html('');
            
            // Hide remove button
            $(this).hide();
        });
    });

})(jQuery);

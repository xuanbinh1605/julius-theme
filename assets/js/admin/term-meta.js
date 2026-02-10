/**
 * Term Meta Image Upload Handler
 *
 * @package Julius_Theme
 */

(function($) {
    'use strict';

    $(document).ready(function() {
        var mediaUploader;
        
        // Upload image button
        $(document).on('click', '.julius-upload-image-button', function(e) {
            e.preventDefault();
            
            var button = $(this);
            var previewContainer = $('#category_featured_image_preview');
            var imageInput = $('#category_featured_image');
            var removeButton = $('.julius-remove-image-button');
            
            // If the media uploader already exists, reopen it
            if (mediaUploader) {
                mediaUploader.open();
                return;
            }
            
            // Create a new media uploader
            mediaUploader = wp.media({
                title: 'Select or Upload Featured Image',
                button: {
                    text: 'Use this image'
                },
                multiple: false
            });
            
            // When an image is selected
            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                
                // Set the image ID
                imageInput.val(attachment.id);
                
                // Display the image preview
                var imageUrl = attachment.sizes && attachment.sizes.medium 
                    ? attachment.sizes.medium.url 
                    : attachment.url;
                    
                previewContainer.html('<img src="' + imageUrl + '" style="max-width: 200px; height: auto; display: block; margin-bottom: 10px;">');
                
                // Show remove button
                removeButton.show();
            });
            
            // Open the media uploader
            mediaUploader.open();
        });
        
        // Remove image button
        $(document).on('click', '.julius-remove-image-button', function(e) {
            e.preventDefault();
            
            // Clear the image ID
            $('#category_featured_image').val('');
            
            // Clear the preview
            $('#category_featured_image_preview').html('');
            
            // Hide remove button
            $(this).hide();
        });
    });

})(jQuery);

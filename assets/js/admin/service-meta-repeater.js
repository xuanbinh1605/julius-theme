jQuery(document).ready(function($) {
    'use strict';

    /**
     * Pricing Options Repeater
     */
    $('#add-pricing-option').on('click', function() {
        var html = '<div class="repeater-item" style="margin-bottom: 15px; padding: 15px; border: 1px solid #ddd; background: #f9f9f9;">' +
            '<div style="display: flex; gap: 10px; align-items: flex-start;">' +
            '<div style="flex: 1;">' +
            '<label><strong>Option Name</strong></label>' +
            '<input type="text" name="pricing_option_name[]" value="" class="widefat" placeholder="e.g., Basic Package, Premium Package">' +
            '</div>' +
            '<div style="width: 200px;">' +
            '<label><strong>Price</strong></label>' +
            '<input type="text" name="pricing_option_price[]" value="" class="widefat" placeholder="e.g., $50, 500,000 VND">' +
            '</div>' +
            '<button type="button" class="button remove-pricing-option" style="margin-top: 22px;">Remove</button>' +
            '</div>' +
            '</div>';
        $('#pricing-options-container').append(html);
    });

    $(document).on('click', '.remove-pricing-option', function() {
        $(this).closest('.repeater-item').remove();
    });

    /**
     * Benefits Repeater
     */
    $('#add-benefit').on('click', function() {
        var html = '<div class="repeater-item" style="margin-bottom: 10px; padding: 10px; border: 1px solid #ddd; background: #f9f9f9;">' +
            '<div style="display: flex; gap: 10px; align-items: center;">' +
            '<input type="text" name="service_benefits[]" value="" class="widefat" placeholder="Enter a benefit">' +
            '<button type="button" class="button remove-benefit">Remove</button>' +
            '</div>' +
            '</div>';
        $('#benefits-container').append(html);
    });

    $(document).on('click', '.remove-benefit', function() {
        $(this).closest('.repeater-item').remove();
    });

    /**
     * What's Included Repeater
     */
    $('#add-included').on('click', function() {
        var html = '<div class="repeater-item" style="margin-bottom: 10px; padding: 10px; border: 1px solid #ddd; background: #f9f9f9;">' +
            '<div style="display: flex; gap: 10px; align-items: center;">' +
            '<input type="text" name="service_whats_included[]" value="" class="widefat" placeholder="Enter what\'s included">' +
            '<button type="button" class="button remove-included">Remove</button>' +
            '</div>' +
            '</div>';
        $('#included-container').append(html);
    });

    $(document).on('click', '.remove-included', function() {
        $(this).closest('.repeater-item').remove();
    });
});

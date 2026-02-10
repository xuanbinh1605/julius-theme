/**
 * Blog Search Autocomplete
 */
(function($) {
    'use strict';

    let searchTimeout;
    const $searchForm = $('.blog-search-form');
    const $searchInput = $searchForm.find('input[name="s"]');
    const $autocompleteDropdown = $('<div class="search-autocomplete-dropdown"></div>');
    
    // Append dropdown after search form
    $searchForm.append($autocompleteDropdown);
    
    // Hide dropdown initially
    $autocompleteDropdown.hide();

    // Handle search input
    $searchInput.on('input', function() {
        const query = $(this).val().trim();
        
        // Clear existing timeout
        clearTimeout(searchTimeout);
        
        // Hide dropdown if query is too short
        if (query.length < 2) {
            $autocompleteDropdown.hide();
            return;
        }
        
        // Show loading state
        $autocompleteDropdown.html('<div class="search-loading">Searching...</div>').show();
        
        // Debounce search request
        searchTimeout = setTimeout(function() {
            performSearch(query);
        }, 300);
    });
    
    // Perform AJAX search
    function performSearch(query) {
        $.ajax({
            url: juliusSearch.ajaxurl,
            type: 'POST',
            data: {
                action: 'julius_blog_search',
                nonce: juliusSearch.nonce,
                query: query
            },
            success: function(response) {
                if (response.success && response.data.results.length > 0) {
                    displayResults(response.data.results);
                } else {
                    $autocompleteDropdown.html('<div class="search-no-results">No results found</div>').show();
                }
            },
            error: function() {
                $autocompleteDropdown.html('<div class="search-error">Error performing search</div>').show();
            }
        });
    }
    
    // Display search results
    function displayResults(results) {
        let html = '<div class="search-results">';
        
        results.forEach(function(result) {
            html += '<a href="' + result.url + '" class="search-result-item">';
            html += '<div class="search-result-image">';
            html += '<img src="' + result.thumbnail + '" alt="' + result.title + '">';
            html += '</div>';
            html += '<div class="search-result-content">';
            html += '<div class="search-result-header">';
            if (result.category) {
                html += '<span class="search-result-category">' + result.category + '</span>';
            }
            html += '</div>';
            html += '<h4 class="search-result-title">' + result.title + '</h4>';
            html += '<p class="search-result-excerpt">' + result.excerpt + '</p>';
            html += '<span class="search-result-date">' + result.date + '</span>';
            html += '</div>';
            html += '</a>';
        });
        
        html += '</div>';
        
        $autocompleteDropdown.html(html).show();
    }
    
    // Hide dropdown when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.blog-search-form').length) {
            $autocompleteDropdown.hide();
        }
    });
    
    // Show dropdown when input is focused and has value
    $searchInput.on('focus', function() {
        if ($(this).val().trim().length >= 2 && $autocompleteDropdown.find('.search-results').length > 0) {
            $autocompleteDropdown.show();
        }
    });
    
    // Prevent form submission on Enter if dropdown is visible (optional)
    $searchForm.on('submit', function(e) {
        // Allow form submission to search page
    });

})(jQuery);

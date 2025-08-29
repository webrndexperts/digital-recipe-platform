jQuery(document).ready(function ($) {
    $('#drp-search-input').on('keyup', function () {
        let search = $(this).val();
        $('#drp-loader').show();

        $.ajax({
            url: drp_ajax.url,
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'drp_recipe_search',
                search: search,
                _ajax_nonce: drp_ajax.nonce
            },
            success: function (response) {
                if (response.success) {
                    $('#drp-results').html(response.data.html);
                } else {
                    $('#drp-results').html('<p>Error loading results.</p>');
                }
                $('#drp-loader').hide();
            }
        });
    });
});

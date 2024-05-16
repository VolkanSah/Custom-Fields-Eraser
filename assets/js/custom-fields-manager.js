jQuery(document).ready(function($) {
    function loadCustomFields() {
        $.ajax({
            url: cfmData.ajaxUrl,
            type: 'POST',
            data: {
                action: 'load_custom_fields',
                security: cfmData.nonce
            },
            success: function(response) {
                $('#custom-fields-table tbody').empty();
                $.each(response.data, function(index, field) {
                    $('#custom-fields-table tbody').append('<tr><td>' + field.meta_key + '</td><td><a href="#" class="delete-custom-field button button-danger" data-meta-key="' + field.meta_key + '">Delete</a></td></tr>');
                });
                $('.delete-custom-field').click(function(e) {
                    e.preventDefault();
                    var metaKey = $(this).data('meta-key');
                    deleteCustomField(metaKey);
                });
            },
            error: function(xhr, status, error) {
                console.error('Error loading custom fields: ' + error);
            }
        });
    }

    function deleteCustomField(metaKey) {
        $.ajax({
            url: cfmData.ajaxUrl,
            type: 'POST',
            data: {
                action: 'delete_custom_field',
                meta_key: metaKey,
                security: cfmData.nonce
            },
            success: function(response) {
                if (response.success) {
                    loadCustomFields();
                    alert(response.data.message);
                } else {
                    alert(response.data.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error deleting custom field: ' + error);
            }
        });
    }

    loadCustomFields();
});

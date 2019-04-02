$(document).on('change', '[name="add_channel_id"], [name="edit_channel_id"]', function () {
    var channel_id = $(this).val();
    $.ajax({
        url: $('#base_url').val() + 'MANAGERS/link/get_campaign',
        type: "POST",
        data: {
            channel_id: channel_id
        },
        success: function (data) {
            $(".ajax_campaign").html(data);
            $(".ajax_adset").html('');
            $(".ajax_ad").html('');
        },
        complete: function () {
            $('.selectpicker').selectpicker({});
        }
    });
});
$(document).on('change', '[name="add_campaign_id"]', function () {
    var campagin_id = $(this).val();
    $.ajax({
        url: $('#base_url').val() + 'MANAGERS/link/get_adset',
        type: "POST",
        data: {
            campagin_id: campagin_id
        },
        success: function (data) {
            $(".ajax_adset").html(data);
            $(".ajax_ad").html('');
        },
        complete: function () {
            $('.selectpicker').selectpicker({});
        }
    });
});

$(document).on('change', '[name="add_adset_id"]', function () {
    var adset_id = $(this).val();
    $.ajax({
        url: $('#base_url').val() + 'MANAGERS/link/get_ad',
        type: "POST",
        data: {
            adset_id: adset_id
        },
        success: function (data) {
            $(".ajax_ad").html(data);
        },
        complete: function () {
            $('.selectpicker').selectpicker({});
        }
    });
});


$(document).on('change', '[name="add_landingpage_id"]', function () {
    var landingpage_id = $(this).find(":selected").data('url');
    var preview_iframe = `<iframe width="100%" height="500px" src="${landingpage_id}"></iframe>`;
    $(".modal-replace-preview-landingpage").html(preview_iframe);
    $(".modal-preview-landingpage").modal('show');
});

$(document).on('click', 'a.add-item-fetch', function (e) {
    e.preventDefault();
    var url = $("#url-add-item-fetch").val();
    $.ajax({
        url: url,
        type: "POST",
        beforeSend: () => $(".popup-wrapper").show(),
        success: function (data) {
            $("div.replace_content_add_item_fetch_modal").html(data);
        },
        complete: function () {
            $(".add_item_modal_fetch").modal({backdrop: 'static', keyboard: false});
            $(".popup-wrapper").hide();
        }
    });
});


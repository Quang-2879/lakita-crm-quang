$(document).on('click', 'a.add_item', function (e) {
    e.preventDefault();
    var url = $("#url_add_item").val();
    $.ajax({
        url: url,
        type: "POST",
        success: function (data) {
            $("div.replace_content_add_item_modal").html(data);
        },
        complete: function () {
            $(".add_item_modal").modal("show");
        }
    });
});


  $(function () {
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
    $('.add_item_modal').on('shown.bs.modal', function () {
        if ($(".table-1").height() > $(".table-2").height())
        {
            $(".table-2").height($(".table-1").height());
        } else
        {
            $(".table-1").height($(".table-2").height());
        }
    });
});


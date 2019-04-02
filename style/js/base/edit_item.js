  $(function () {
    $(document).on('click', 'a.edit_item', function (e) {
        e.preventDefault();
        var item_id = $(this).attr("item_id");
        var url = $("#url_edit_item").val();
        $.ajax({
            url: url,
            type: "POST",
            data: {
                item_id: item_id
            },
            success: function (data) {
                $("div.replace_content_edit_item_modal").html(data);
            },
            complete: function () {
                $(".edit_item_modal").modal("show");
            }
        });
    });
    $('.edit_item_modal').on('shown.bs.modal', function () {
        if ($(".table-1").height() > $(".table-2").height())
        {
            $(".table-2").height($(".table-1").height());
        } else
        {
            $(".table-1").height($(".table-2").height());
        }
    });
});
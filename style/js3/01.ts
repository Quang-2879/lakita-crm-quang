$(function () {
    $(document).on('click', 'a.edit_contact', function (e) {
        e.preventDefault();
        $(".checked").removeClass("checked");
        $(this).parent().parent().addClass("checked");
        var contact_id = $(this).attr("contact_id");
        var url = $("#base_url").val() + "common/show_edit_contact_modal";
        $.ajax({
            url: url,
            type: "POST",
            data: {
                contact_id: contact_id
            },
            success: function (data) {
                //console.log(data);
                $("div.replace_content").html(data);
            },
            complete: function () {
                $(".edit_contact_modal").modal("show");
            }
        });
    });
    $('.edit_contact_modal').on('shown.bs.modal', function () {
        if ($(".table-1").height() > $(".table-2").height())
        {
            $(".table-2").height($(".table-1").height());
        } else
        {
            $(".table-1").height($(".table-2").height());
        }
        var clipboard = new Clipboard('.btn-copy');
         $('.datetimepicker').datetimepicker(
                {
                    format: 'DD-MM-YYYY HH:mm'
                });
    });
});$(function () {
    $(document).on('click', 'a.action_view_detail_contact', function (e) {
        e.preventDefault();
        $(".checked").removeClass("checked");
        $(this).parent().parent().addClass("checked");
        var contact_id = $(this).attr("contact_id");
        var url = $("#base_url").val() + "common/view_detail_contact";
        //console.log(url);
        $.ajax({
            url: url,
            type: "POST",
            data: {
                contact_id: contact_id
            },
            success: function (data) {
                // console.log(data);
                $("div.replace_content_view_detail_contact").html(data);
            },
            complete: function () {
                $(".view_detail_contact_modal").modal("show");
            }
        });
    });
    $('.view_detail_contact_modal').on('shown.bs.modal', function () {
        if ($(".table-view-1").height() > $(".table-view-2").height())
        {
            $(".table-view-2").height($(".table-view-1").height());
        } else
        {
            $(".table-view-1").height($(".table-view-2").height());
        }
    });
});

//# sourceMappingURL=01.ts.map
$(function () {
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

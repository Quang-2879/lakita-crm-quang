/* $(document).on('click', 'a.action_view_detail_contact', function (e) {
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
        success: data => $("div.replace_content_view_detail_contact").html(data),
        complete: () => $(".view_detail_contact_modal").modal("show")
    });
});
$('.view_detail_contact_modal').on('shown.bs.modal',  () => {
    if ($(".table-view-1").height() > $(".table-view-2").height())
    {
        $(".table-view-2").height($(".table-view-1").height());
    } else
    {
        $(".table-view-1").height($(".table-view-2").height());
    }
});

$(document).on("click", ".view_contact_phone", () => {
    document.querySelector("#input-copy").select();
    document.execCommand('copy');
    $.notify("Copy thành công vào clipboard", {
            position: "top left",
            className: 'success',
            showDuration: 200,
            autoHideDelay: 2000
        });
});
*/
/*
$(document).on('click', 'a.action_view_detail_contact', function (e) {
    e.preventDefault();
    $(".checked").removeClass("checked");
    $(this).parent().parent().addClass("checked");
    var contact_id = $(this).attr("contact_id");
    var url = $("#base_url").val() + "common/view_detail_contact";
    $.ajax({
        url: url,
        type: "POST",
        data: {
            contact_id: contact_id
        },
        success: data => {
            $(".modal-detail-contact").remove();
            var modalViewContactDetail = "<div class='modal-detail-contact'></div>";
            $(".modal-append-to").append(modalViewContactDetail);
            $(".modal-detail-contact").html(data);
        },
        complete: () => $(".modal-detail-contact .modal").modal("show")
    });
});
*/

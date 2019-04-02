/* 
 * Copyright (C) 2017 Phạm Ngọc Chuyển <chuyenpn at lakita.vn>
 *
 */
/*
$('.tbl_name').on('click', 'span.badge-star', function (e) {
    e.stopPropagation();
    e.preventDefault();
    var contact_phone = $(this).attr("contact_phone");
    var contact_course_code = $(this).attr("contact_course_code");
    var controller = $(this).attr("controller");
    var url = $("#base_url").val() + "common/view_contact_star";
    //console.log(url);
    $.ajax({
        url: url,
        type: "POST",
        data: {
            contact_phone: contact_phone,
            contact_course_code: contact_course_code,
            controller: controller
        },
        success: data => $("div.replace_content_view_contact_star").html(data),
        complete: () => $(".view_contact_star_modal").modal("show")
    });
});
*/

$('.view_contact_star_modal').on('hide.bs.modal', () => setTimeout(() => $("div.replace_content_view_contact_star").html(""), 1000));
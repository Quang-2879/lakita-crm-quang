$(document).on('click', 'a.edit_bill', function (e) {
    e.preventDefault();
    var bill_id = $(this).attr("bill_id");
    var url = $("#base_url").val() + "CODS/check_L8/show_edit_bill";
    $.ajax({
        url: url,
        type: "POST",
        data: {
            bill_id: bill_id
        },
        success: data => {
            console.log(data);
            $("div.replace_content_edit_bill_modal").html(data);
        },
        complete: () => $(".edit_bill_modal").modal("show")
    });
});

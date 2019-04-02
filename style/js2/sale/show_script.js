
$(document).on('change', 'select.select_script', function () {
    //console.log($(this));
    var url = $("#base_url").val() + "sale/show_script_modal";
    if ($(this).val() != 0) {
        $.ajax({
            url: url,
            type: "POST",
            data: {
                script_id: $(this).val()
            },
            success: data => $("div.replace_content_script").html(data),
            complete: () =>$(".script_modal").modal("show")
        });
    }
});

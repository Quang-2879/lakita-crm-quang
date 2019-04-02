$(document).ready(function () {
    $("a.cancel_one_contact").click(function (e) {
        var del = $(this);
        var sale_id = $(this).attr("sale_id");
        var total_contact_for_sale = $(".total_contact_sale_" + sale_id).text();
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $("#base_url").val() + "manager/cancel_one_contact",
            data: {
                contact_id: $(this).attr("contact_id")
            },
            beforeSend: function () {
                //$(".popup-wrapper").show();
            },
            success: function (data) {
                if (data === '1')
                {
                    del.parent().parent().hide();
                    $(".total_contact_sale_" + sale_id).text(total_contact_for_sale - 1);
                } else {
                    alert(data);
                }
            },
            error: function (errorThrown) {
                alert(errorThrown);
            },
            complete: function () {
                //    $(".popup-wrapper").hide();
            }
        });
    });
    $(".cancel_multi_contact").click(function (e) {
        $("#action_contact").attr("action", $("#base_url").val() + "manager/cancel_multi_contact");
        $("#action_contact").submit();
    });
});
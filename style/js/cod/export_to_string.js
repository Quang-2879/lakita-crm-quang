$(function () {
    $('.export_to_string').on('click', function (e) {
        e.preventDefault();
        var myCheckboxes = new Array();
        $("input:checked").each(function () {
            myCheckboxes.push($(this).val());
        });
        $.ajax({
            url: $("#base_url").val() + "cod/export_to_string",
            type: "POST",
            data: {
                contact_id: myCheckboxes
            },
            success: function (data) {
                console.log(data);
                $(".replace_content_2").text(data);
            },
            complete: function () {
                $(".export_to_string_modal").modal("show");
            }
        });
    });
});
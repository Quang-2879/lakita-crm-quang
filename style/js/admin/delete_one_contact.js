$(document).ready(function () {
    $(document).on('click', 'a.delete_one_contact_admin', function (e) {
        var del = $(this);
        var contact_id = $(this).attr("contact_id");
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $("#base_url").val() + "admin/delete_one_contact",
            data: {
                contact_id: contact_id
            },
            success: function (data) {
                if (data === '1')
                {
                    del.parent().parent().hide();
                    //location.reload();
                } else {
                    alert(data);
                }
            },
            error: function () {
                alert(errorThrown);
            }
        });
    });
});
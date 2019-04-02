/*
$(document).on('click', 'a.delete_one_contact_admin', e => {
    var r = confirm("Bạn có chắc chắn muốn xóa contact này không?");
    if (r == true) {
        var del = $(e.target);
        var contact_id = $(e.target).attr("contact_id");
        $.ajax({
            type: "POST",
            url: $("#base_url").val() + "admin/delete_one_contact",
            data: {
                contact_id: contact_id
            },
            success: data => {
                console.log(data);
                if (data === '1')
                {
                    del.parent().parent().hide();
                    //location.reload();
                } else {
                    alert(data);
                }
            },
            error: errorThrown => alert(errorThrown)
        });
        return false;
    }
});
$(document).on('click', 'a.delete_forever_one_contact_admin', function (e) {
    var r = confirm("Bạn có chắc chắn muốn xóa contact này không?");
    if (r == true) {
        var del = $(this);
        var contact_id = $(this).attr("contact_id");
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $("#base_url").val() + "admin/delete_forever_one_contact",
            data: {
                contact_id: contact_id
            },
            success: data => {
                if (data === '1')
                {
                    del.parent().parent().hide();
                    //location.reload();
                } else {
                    alert(data);
                }
            },
            error: errorThrown => alert(errorThrown)
        });
    }
});


*/
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(".send_to_mobile").on('click', function (e) {
    e.preventDefault();
    var contact_phone = $(this).attr("contact_phone");
    var contact_name = $(this).attr("contact_name");
    $.ajax({
        url: $("#base_url").val() + 'common/send_phone_to_mobile',
        type: 'post',
        data: {
            contact_phone: contact_phone,
            contact_name: contact_name
        },
        success:  () =>  {
            $.notify('Gửi thành công đến mobile!', {
                position: "top left",
                className: 'success',
                showDuration: 200,
                autoHideDelay: 3000
            });
        }
    });
});

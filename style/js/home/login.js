/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).on('click', '.btn-login', function (e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: $("#base_url").val() + "home/action_login",
        data: $("#form-login").serialize(),
        dataType: 'json',
        success: function (data) {
            if (data.success == 1) {
                $("#send_email_sound")[0].play();
                $(".login_box").hide();
                //$("body").css("background-size", "auto");
                //$(".redirect").show();
                $(".animated").addClass("yt-loader");
                setTimeout(function () {
                    location.assign(atob(data.redirect_page));
                }, 2500);

            } else {
                $("#send_email_error")[0].play();
                $(".login_control").notify('Có lỗi xảy ra! Nội dung: ' + data.message, {
                    position: "top left",
                    className: 'error',
                    showDuration: 200,
                    autoHideDelay: 7000
                });
            }
        },
        error: function () {
            $("#send_email_error")[0].play();
            $.notify('Có lỗi xảy ra! Nội dung: unknown', {
                position: "top left",
                className: 'error',
                showDuration: 200,
                autoHideDelay: 7000
            });
        }
    });
});
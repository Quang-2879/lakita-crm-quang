/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).on('click', '.btn-send-account-lakita', function (e) {
    e.preventDefault();
    if ($("select.cod_status_id").val() != 3 ||"select.cod_status_id").val() != 2 ) {
        $("#send_email_error")[0].play();
        $.notify('Bạn cần chuyển trạng thái giao hàng là "Đã thu Lakita" trước khi thực hiện thao tác này!', {
            position: "top left",
            className: 'error',
            showDuration: 200,
            autoHideDelay: 7000
        });
        return false;
    }
    var contact_id = $(this).attr("contact_id");
    var url = $("#base_url").val() + "send_email/send_account_lakita";
    $.ajax({
        url: url,
        type: "POST",
        data: {
            contact_id: contact_id
        },
        dataType: 'json',
        beforeSend: () => {
            clearInterval(notiContactRecall);
            $(".popup-wrapper").show();
        },
        success: data => {
            console.log(data.success);
            if (data.success == 0) {
                $("#send_email_error")[0].play();
                $.notify('Có lỗi xảy ra! Nội dung: ' + data.message, {
                    position: "top left",
                    className: 'error',
                    showDuration: 200,
                    autoHideDelay: 7000
                });
            } else {
                $("#send_email_sound")[0].play();
                $.notify('Gửi email thành công!', {
                    position: "top left",
                    className: 'success',
                    showDuration: 200,
                    autoHideDelay: 3000
                });
            }
        },
        complete: () => {
            notiContactRecall = setInterval(noti, 10000);
            $(".popup-wrapper").hide();
        },
        error: () => {
            $("#send_email_error")[0].play();
            $.notify('Có lỗi xảy ra trong quá trình gửi email!', {
                position: "top left",
                className: 'error',
                showDuration: 200,
                autoHideDelay: 3000
            });
        }
    });
});


$(document).on('click', '.send-lakita-account-combo-course', function (e) {
    e.preventDefault();
    var url = $('#base_url').val() + "send_email/SendLakitaAccountComboCourse";
    if ($('input.tbl-item-checkbox:checked').length == 0) {
        $.alert({
            theme: 'modern',
            type: 'red',
            title: 'Có lỗi xảy ra!',
            content: 'Vui lòng chọn contact cần gửi email!'
        });
    } else {
        /*
         * 
         * Lấy số tiền
         */
        var numberOfChecked = $('input.tbl-item-checkbox:checked').length;
        var emailArr = [];
        var contactName = '';
        $('input.tbl-item-checkbox:checked').each(function () {
            var contactId = $(this).parent().parent().find('.show-more-table-info').attr("contact-id");
            emailArr.push($.trim($("#" + contactId).find(".extra-view-contact-email").text()));
        });
        contactName = $.trim(contactName);
        contactName = contactName.substring(0, contactName.length - 1);
        var emailUnique = emailArr.unique();
        if (emailUnique.length > 1) {
            $.alert({
                theme: 'modern',
                type: 'red',
                title: 'Có lỗi xảy ra!',
                content: 'Các contact đã chọn không có cùng địa chỉ email. \n\
                Bạn cần sửa lại email để đảm bảo cùng là 1 người!'
            });
        } else if (emailUnique.length == 1 && emailUnique[0] == '') {
            $.alert({
                theme: 'modern',
                type: 'red',
                title: 'Có lỗi xảy ra!',
                content: 'Email rỗng. Vui lòng kiểm tra lại!'
            });
        } else {
            $.confirm({
                theme: 'supervan',
                title: 'Kiểm tra thông tin gửi email và tài khoản ngân hàng',
                content: 'Họ tên: ' + contactName + ', email: ' + emailUnique[0] + ', '
                        + 'combo ' + numberOfChecked + ' khóa học',
                buttons: {
                    confirm: {
                        text: 'Look good!',
                        action: function () {
                            $.ajax({
                                url: url,
                                type: "POST",
                                dataType: 'json',
                                data: $("#action_contact").serialize(),
                                beforeSend: () => {
                                    clearInterval(notiContactRecall);
                                    $(".popup-wrapper").show();
                                },
                                success: data => {
                                    if (data.success == 1) {
                                        $("#send_email_sound")[0].play();
                                        $.notify(data.message, {
                                            position: "top left",
                                            className: 'success',
                                            showDuration: 200,
                                            autoHideDelay: 5000
                                        });
                                    } else {
                                        $("#send_email_error")[0].play();
                                        $.notify('Có lỗi xảy ra! Nội dung: ' + data.message, {
                                            position: "top left",
                                            className: 'error',
                                            showDuration: 200,
                                            autoHideDelay: 7000
                                        });
                                    }
                                },
                                complete: () => {
                                    notiContactRecall = setInterval(noti, 10000);
                                    $(".popup-wrapper").hide();
                                },
                                error: () => {
                                    $("#send_email_error")[0].play();
                                    $.notify('Có lỗi xảy ra trong quá trình gửi email!', {
                                        position: "top left",
                                        className: 'error',
                                        showDuration: 200,
                                        autoHideDelay: 3000
                                    });
                                }
                            });
                        }},
                    cancel: {
                        text: 'Cancel',
                        action: function () {
                        }},
                    somethingElse: {
                        text: 'Khác',
                        btnClass: 'btn-blue',
                        keys: ['enter', 'shift'],
                        action: function () {

                        }
                    }
                }
            });
        }
        console.log(emailArr.unique());
        //show-more-table-info
        /*
         $.ajax({
         url: url,
         type: "POST",
         dataType: 'json',
         data: $('#action_contact').serialize(),
         success: data => {
         if (data.success == 1) {
         $("#send_email_sound")[0].play();
         $.notify(data.message, {
         position: "top left",
         className: 'success',
         showDuration: 200,
         autoHideDelay: 5000
         });
         } else {
         $("#send_email_error")[0].play();
         $.notify('Có lỗi xảy ra! Nội dung: ' + data.message, {
         position: "top left",
         className: 'error',
         showDuration: 200,
         autoHideDelay: 7000
         });
         }
         }
         });
         */
    }
});

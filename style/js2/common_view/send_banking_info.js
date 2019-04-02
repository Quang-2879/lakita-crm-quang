/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).on('click', '.btn-send-banking-info', function (e) {
    e.preventDefault();
    var contact_id = $(this).attr("contact_id");
    var url = $("#base_url").val() + "send_email/send_banking_info";
    $.ajax({
        url: url,
        type: "POST",
        data: {
            contact_id: contact_id,
            name: $(".edit-contact-name").val(),
            email: $(".edit-contact-email").val(),
            price_purchase: $(".edit-contact-price-purchase").val()
        },
        dataType: 'json',
        beforeSend: () => $(".popup-wrapper").show(),
        success: data => {
            if (data.success == 1) {
                $("#send_email_sound")[0].play();
                $.notify('Gửi email thành công!', {
                    position: "top left",
                    className: 'success',
                    showDuration: 200,
                    autoHideDelay: 3000
                });
            } else {
                $("#send_email_error")[0].play();
                $.notify('Có lỗi xảy ra. Nội dung: ' + data.message, {
                    position: "top left",
                    className: 'error',
                    showDuration: 200,
                    autoHideDelay: 3000
                });
            }
        },
        complete: () => $(".popup-wrapper").hide(),
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


$(document).on('click', '.send-banking-info-multi-course', function (e) {
    e.preventDefault();
    var url = $('#base_url').val() + "send_email/send_banking_info";
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
        var sum = 0;
        for (i = 0; i < numberOfChecked; i++) {
            sum += parseInt($($('input.tbl-item-checkbox:checked')[i]).parent().parent().find('.tbl_price_purchase').text());
        }
        sum *= 1000;
        var emailArr = [];
        var contactName = '';
        $('input.tbl-item-checkbox:checked').each(function () {
            var contactId = $(this).parent().parent().find('.show-more-table-info').attr("contact-id");
            contactName = $(this).parent().parent().find('.tbl_name').text();
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
                title: 'Kiểm tra thông tin gửi email',
                content: 'Họ tên: ' + contactName + ', email: ' + emailUnique[0] + ', số tiền: '
                        + sum.toLocaleString() + '. Combo ' + numberOfChecked + ' khóa học',
                buttons: {
                    confirm: {
                        text: 'Look good!',
                        action: function () {
                            $.ajax({
                                url: url,
                                type: "POST",
                                dataType: 'json',
                                data: {
                                    name: contactName,
                                    email: emailUnique[0],
                                    price_purchase: sum,
                                    number_of_course: numberOfChecked
                                },
                                beforeSend: () => $(".popup-wrapper").show(),
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
                                complete: () => $(".popup-wrapper").hide(),
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

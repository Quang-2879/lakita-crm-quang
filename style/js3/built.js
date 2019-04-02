/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

show_number_selected_row = () => {
    var numberOfChecked = $('input.tbl-item-checkbox:checked').length;
    var totalCheckboxes = $('input.tbl-item-checkbox').length;
    /*
     * Lấy tổng giá
     */
    var sum = 0;
    for (i = 0; i < numberOfChecked; i++) {
        sum += parseInt($($('input.tbl-item-checkbox:checked')[i]).parent().parent().find('.tbl_price_purchase').text());
    }
    sum *= 1000;
    $.notify(`Đã chọn: ${numberOfChecked} / ${totalCheckboxes}. tổng tiền = ${sum.toLocaleString()}`, {
        position: "top left",
        className: 'success',
        showDuration: 200,
        autoHideDelay: 3000
    });
};

unselect_not_checked = () => {
    $('input.tbl-item-checkbox').each(
            () => {
        if (!$(this).is(":checked")) {
            $(this).parent().parent().removeClass('checked');
        }
    });
};

unselect_checked = () => {
    $('input.tbl-item-checkbox').each(
            () => {
        if ($(this).is(":checked")) {
            $(this).parent().parent().removeClass('checked');
        }
    });
};
uncheck_checked = () => {
    $('input.tbl-item-checkbox').each(
            () => {
        if ($(this).is(":checked")) {
            $(this).prop("checked", false);
        }
    });
};
uncheck_not_checked = () => {
    $('input.tbl-item-checkbox').each(
            () => {
        if (!$(this).is(":checked")) {
            $(this).prop("checked", false);
        }
    });
};

right_context_menu_display = (controller, contact_id, contact_name, duplicate_id, contact_phone) => {
    $(".load-new-contact-id").attr('data-contact-id', contact_id);
    // $("a.view_duplicate").attr("duplicate_id", duplicate_id);
    $("a.send_to_mobile").attr("contact_name", contact_name).attr("contact_phone", contact_phone);
    
    $("a.btn-export-one-contact-for-send-vnpost").attr('data-contact-id', contact_id);
    /*
     * Nếu chọn nhiều contact thì ẩn menu xem chi tiết contact 
     * và phân 1 contact
     */
    var numberOfChecked = $('input.tbl-item-checkbox:checked').length;
    console.log(numberOfChecked);
    if (numberOfChecked > 1) {
        $(".one-item-selected").addClass("hidden");
        $(".multi-item-selected").removeClass('hidden');
    } else {
        $(".one-item-selected").removeClass("hidden");
        $(".multi-item-selected").addClass('hidden');
    }

    if (controller === 'manager') {
        $(".divide_one_contact_achor").attr('contact_id', contact_id);
        $(".divide_one_contact_achor").attr('contact_name', contact_name);
        /*
         * Nếu contact trùng thì ẩn tính năng bàn giao contact
         */
        if (numberOfChecked < 1) {
            if (duplicate_id > 0) {
                $(".divide_one_contact_achor").addClass('hidden');
            }
            /*
             * Nếu contact không trùng thì ẩn tính năng xem contact trùng
             */
            else {
                $(".divide_one_contact_achor").removeClass('hidden');
            }
        }
    } else if (controller === 'sale' || controller === 'cod' || controller === 'customer_care') {
        $(".transfer_one_contact").attr('contact_id', contact_id);
        $(".transfer_one_contact").attr('contact_name', contact_name);
    }
};

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

const _SO_MAY_SAI_ = 1;
const _KHONG_NGHE_MAY_ = 2;
const _NHAM_MAY_ = 3;
const _DA_LIEN_LAC_DUOC_ = 4;
const _CONTACT_CHET_ = 5;

const _CHUA_CHAM_SOC_ = 0;
const _TU_CHOI_MUA_ = 3;
const _DONG_Y_MUA_ = 4;

check_edit_contact = () => {
    var call_status_id = $("select[name='call_status_id']").val();
    var ordering_status_id = $("select[name='ordering_status_id']").val();
    var date_recall = $(".date_recall").val();
    var course_code = $('select.select_course_code').val();
    var price_purchase = $('[name="price_purchase"]').val();
    var customer_care_call_id = $("select[name='customer_care_call_id']").val();
    if (customer_care_call_id == 0) {
        $.alert({
            theme: 'modern',
            type: 'red',
            title: 'Có lỗi xảy ra!',
            content: 'Bạn cần cập nhật trạng thái gọi!'
        });
        return false;
    }
    if ($("select.edit_payment_method_rgt").val() == 0) {
        $.alert({
            theme: 'modern',
            type: 'red',
            title: 'Có lỗi xảy ra!',
            content: 'Bạn cần cập nhật hình thức thanh toán!'
        });
        return false;
    }
    if (call_status_id == 0) {
        $.alert({
            theme: 'modern',
            type: 'red',
            title: 'Có lỗi xảy ra!',
            content: 'Bạn cần cập nhật trạng thái gọi!'
        });
        return false;
    }
    if (check_rule_call_stt(call_status_id, ordering_status_id) == false) {
        $.alert({
            theme: 'modern',
            type: 'red',
            title: 'Có lỗi xảy ra!',
            content: 'Trạng thái gọi và trạng thái đơn hàng không logic! Bạn cần cập nhật chính xác để dữ liệu của chúng ta được sạch sẽ!'
        });
        return false;
    }
    if (date_recall !== undefined) {
        if (date_recall != '') {
            if (now_greater_than_input_date(date_recall)) {
                $.alert({
                    theme: 'modern',
                    type: 'red',
                    title: 'Có lỗi xảy ra!',
                    content: 'Ngày gọi lại không thể là một ngày trước ngày hôm nay!'
                });
                return false;
            }
            if (check_rule_call_stt_and_date_recall(call_status_id, ordering_status_id, date_recall)) {
                $.alert({
                    theme: 'modern',
                    type: 'red',
                    title: 'Có lỗi xảy ra!',
                    content: 'Nếu contact không liên lạc được hoặc không thể chăm sóc được nữa thì không thể có ngày gọi lại lớn hơn ngày hiện tại!'
                });
                return false;
            }
        }
    }
    if (course_code == '0') {
        $.alert({
            theme: 'modern',
            type: 'red',
            title: 'Có lỗi xảy ra!',
            content: 'Vui lòng chọn mã khóa học!'
        });
        return false;
    }
    if (price_purchase == '') {
        $.alert({
            theme: 'modern',
            type: 'red',
            title: 'Có lỗi xảy ra!',
            content: 'Vui lòng chọn giá tiền mua!'
        });
        return false;
    }
    return true;
};

check_rule_call_stt = (call_status_id, ordering_status_id) => {
    if (call_status_id == _SO_MAY_SAI_ || call_status_id == _KHONG_NGHE_MAY_ || call_status_id == _NHAM_MAY_) {
        if (ordering_status_id != _CHUA_CHAM_SOC_) {
            return false;
        }
    }
    if (call_status_id == _DA_LIEN_LAC_DUOC_) {
        if (ordering_status_id == _CHUA_CHAM_SOC_) {
            return false;
        }
    }
//        if (call_status_id == _CONTACT_CHET_ && (ordering_status_id == _DONG_Y_MUA_ || ordering_status_id == _TU_CHOI_MUA_)) {
//            return false;
//        }
    return true;
};

check_rule_call_stt_and_date_recall = (call_status_id, ordering_status_id, date_recall) => {
    if (stop_care(call_status_id, ordering_status_id) && now_greater_than_input_date(date_recall)) {
        return true;
    }
    return false;
};

stop_care = (call_status_id, ordering_status_id) => {
    if (call_status_id == _SO_MAY_SAI_ || call_status_id == _NHAM_MAY_ || call_status_id == _KHONG_NGHE_MAY_
            || ordering_status_id == _DONG_Y_MUA_ || ordering_status_id == _TU_CHOI_MUA_ || ordering_status_id == _CONTACT_CHET_) {
        return true;
    }
    return false;
};
now_greater_than_input_date = date_string => {
    var date_arr = date_string.split(/-/);
    var year = date_arr[2];
    var month = date_arr[1];
    var day = date_arr[0];
    var now_timestamp = new Date();
    now_timestamp = now_timestamp.getTime();
    var input_timestamp = new Date(year, month - 1, day);
    input_timestamp = input_timestamp.getTime();
    return (now_timestamp > input_timestamp);
};


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

setEqualTableHeight = () => {
    if ($(".table-view-1").height() > $(".table-view-2").height())
    {
        $(".table-view-2").height($(".table-view-1").height());
    } else
    {
        $(".table-view-1").height($(".table-view-2").height());
    }
    if ($(".table-edit-1").height() > $(".table-edit-2").height())
    {
        $(".table-edit-2").height($(".table-edit-1").height());
    } else
    {
        $(".table-view-1").height($(".table-view-2").height());
    }
    if ($(".table-1").height() > $(".table-2").height())
    {
        $(".table-2").height($(".table-1").height());
    } else
    {
        $(".table-1").height($(".table-2").height());
    }
    
     if ($(".table-add-1").height() > $(".table-add-2").height())
    {
        $(".table-add-2").height($(".table-add-1").height());
    } else
    {
        $(".table-add-1").height($(".table-add-2").height());
    }
};
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$.fn.setFixTable = function (_tableID) {
    var cloneHead = $($(this).children()[0]).clone();
    $(this).prepend(cloneHead);
    var fixedHead = $(this).children()[0];
    var originHead = $(this).children()[1];
    $(originHead).addClass("table-head-pos");
    $(fixedHead).addClass("fixed-table").css("display", "none");
    var key = 1;
    $(".table-head-pos>tr>th").each(function () {
        $(this).attr('id', 'th_fix_id_' + key++);
    });
    key = 1;
    $(".fixed-table>tr>th").each(function () {
        $(this).attr('id', 'f_th_fix_id_' + key++);
    });

    $(document).on('scroll', function () {
        if ($(".table-head-pos").length && $("html").scrollTop() > ($(".table-head-pos").offset().top)) {
            $(".fixed-table").css({
                "display": "block"
            });
            $('[id^="th_"]').each(function () {
                var myID = $(this).attr("id");
                var mywidth = $(this).width();
                var myheight = $(this).height();
                $("#f_" + myID).width(mywidth);
                $("#f_" + myID).height(myheight);
            });
        } else {
            $(".fixed-table").css({
                "display": "none"
            });
        }
    });
};



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 * loại bỏ phần tử trùng trong mảng
 */
Array.prototype.unique = function () {
    return this.filter(function (elem, index, self) {
        return index == self.indexOf(elem); // lấy chỉ số đầu tiên
    });
};var url = $("#base_url").val() + "sale/noti_contact_recall";
noti = () => {
    $.ajax({
        url: url,
        type: "POST",
        dataType: 'json',
        success: data => {
            $('#num_noti').html(data.num_noti);
            var content_noti = ``;
            $.each(data.contacts_noti, function () {
                content_noti += `<li class="content_noti">`;
                content_noti += `<a href="#"
                                    title="Chăm sóc contact"
                                    class="ajax-request-modal"
                                    data-contact-id ="${this.id}"
                                    data-modal-name="edit-contact-modal"
                                    data-url="common/show_edit_contact_modal"> ${this.name}  - ${this.phone} - Thời gian gọi lại ${this.date_recall} 
                                    </a>`;
                content_noti += `</li>`;
            });
            $('#noti_contact_recall').html(content_noti);
            if (data.num_noti > 0) {
                var title = '(' + data.num_noti + ')  CONTACT CẦN GỌI LẠI';
                $("title").text(title);
            }
            if (typeof data.sound !== 'undefined') {
                $("#notificate_sound")[0].play();
                notify = new Notification(
                        data.message,
                        {
                            body: 'Click vào đây để xem ngay!',
                            icon: $("#base_url").val() + 'public/images/logo2.png',
                            tag: 'https://crm2.lakita.vn/quan-ly/trang-chu.html',
                            sound: $("#base_url").val() + 'public/mp3/new-contact.mp3',
                            image: data.image
                        }
                );
                var append = ` <div style="position: fixed; right:10px; bottom: 10px; z-index: 999999999; 
                                    background-color: #fff; display: inline-block; width: 30%; border-radius: 5px" class="my-notify">
                                        <div style="position:absolute; right: 5px; top:5px; cursor: pointer" class="close-notify"> 
                                            <i class="fa fa-times-circle" style="font-size: 18px;" aria-hidden="true"></i> 
                                        </div>    
                                        <div style="float:left; width: 35%; padding: 2%">
                                            <img src="https://crm2.lakita.vn/public/images/logo2.png" style="width: 70%"/>
                                        </div>
                                        <div style="float:left; width:65%; padding: 2%">
                                            <h4> ${data.message} </h4>
                                            <div>
                                                <img src="${data.image}" style="width: 90%"/>
                                            </div>
                                        </div>
                                   </div>`;

                $('body').append(append);
                setTimeout(function () {
                    $(".my-notify").remove();
                }, 10000);
            }
        }
    });
};
var notiContactRecall = '';
if($("#input_controller").val() == 'cod' || $("#input_controller").val() == 'sale') {
    notiContactRecall = setInterval(noti, 10000);
}/*
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


*//* 
 * Copyright (C) 2017 Phạm Ngọc Chuyển <chuyenpn at lakita.vn>
 *
 */

/*
 $(document).on('click', 'a.retrieve-contact', function (e) {
 var r = confirm("Bạn có chắc chắn muốn thu hồi contact này không?");
 if (r == true) {
 var del = $(this);
 var contact_id = $(this).attr("contact_id");
 e.preventDefault();
 $.ajax({
 type: "POST",
 url: $("#base_url").val() + "admin/retrieve_contact",
 data: {
 contact_id: contact_id
 },
 success: data => {
 if (data === '1')
 {
 alert('Thu hồi thành công contact');
 //del.parent().parent().hide();
 location.reload();
 } else {
 alert(data);
 }
 },
 error: errorThrown => alert(errorThrown)
 });
 }
 });
 */

$(".action-contact-admin").confirm({
    theme: 'supervan', // 'material', 'bootstrap',
    title: "Bạn có chắc chắn với hành động này?",
    content: '',
    buttons: {
        confirm: {
            text: 'Có',
            action: function () {
                var _this = this.$target;
                var contactID = _this.attr("data-contact-id");
                var url = $("#base_url").val() + _this.attr("data-url");
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        contact_id: contactID
                    },
                    success: data => {
                        if (data === '1')
                        {
                            $.alert({
                                theme: 'modern',
                                title: _this.attr("data-answer"),
                                content: '',
                                 buttons: {
                                     confirm: {
                                         text: 'OK',
                                         action: function(){
                                              location.reload(); 
                                         }
                                     }
                                 }
                            });
                        } else {
                            alert(data);
                        }
                    },
                    error: errorThrown => alert(errorThrown)
                });
            }},
        cancel: {
            text: 'Nope',
            action: function () {
            }}
    }
});
$(document).on('click', '.create-adset-from-fb', function (e) {
    e.preventDefault();
    $(".add-name-from-fb").val($(this).attr("adset-name"));
    $(".add-adset-id-from-fb").val($(this).attr("id-fb"));
    $campaignOption = ' <select class="form-control selectpicker" name="add_campaign_id" tabindex="-98"> ' +
            '<option value="'+ $(this).attr("campaign-crm-id") +'" selected="selected"> '+ $(this).attr("campaign-name-facebook") +'</option>' +
            '</select>';
     $(".select-campaign-fetch").html("");
    $(".select-campaign-fetch").append($campaignOption);
    console.log($(this).attr("id-fb"));
    $(".add_item_from_fb_modal").modal("show");
});
$(document).on('click', 'a.add-item-fetch', function (e) {
    e.preventDefault();
    var url = $("#url-add-item-fetch").val();
    $.ajax({
        url: url,
        type: "POST",
        beforeSend: () => $(".popup-wrapper").show(),
        success: function (data) {
            $("div.replace_content_add_item_fetch_modal").html(data);
        },
        complete: function () {
            $(".add_item_modal_fetch").modal({backdrop: 'static', keyboard: false});
            $(".popup-wrapper").hide();
        }
    });
});

$(document).on('click', '.create-campaign-from-fb', function (e) {
    e.preventDefault();
    $(".add-name-from-fb").val($(this).attr("campaign-name"));
    $(".add-campaign-id-from-fb").val($(this).attr("id-fb"));
    $(".add_item_from_fb_modal").modal("show");
});

$(document).on('click', '.create-campaign-from-fb-2', function (e) {
    e.preventDefault();
    var _this = $(this);
    $.confirm({
        theme: 'supervan', 
        title: 'Bạn có chắc chắn muốn tạo link này không?',
        content: 'Việc tạo link này đồng nghĩa với việc tạo các campaign, adset và ad tương ứng, \n\
                nếu chúng không tồn tại',
        buttons: {
            confirm: {
                text: 'Đồng ý',
                action: function () {
                    if (_this.parent().parent().find('select.select-landing-page').val() == 0) {
                        $.alert({
                            theme: 'modern',
                            type: 'red',
                            title: 'Có lỗi xảy ra!',
                            content: 'Vui lòng chọn landing page!'
                        });
                    } else {
                        $.ajax({
                            url: $("#url-add-item-from-fb-2").val(),
                            type: "POST",
                            beforeSend: () => $(".popup-wrapper").show(),
                            data: {
                                fb_account_id: _this.attr('fb-account-id'),
                                fb_campaign_id: _this.attr('fb-campaign-id'),
                                fb_campaign_name: _this.attr('fb-campaign-name'),
                                fb_adset_id: _this.attr('fb-adset-id'),
                                fb_adset_name: _this.attr('fb-adset-name'),
                                fb_ad_id: _this.attr('fb-ad-id'),
                                fb_ad_name: _this.attr('fb-ad-name'),
                                landing_page_id: _this.parent().parent().find('select.select-landing-page').val()
                            },
                            success: function (data) {
                                $.alert({
                                    theme: 'modern',
                                    title: 'Tạo thành công link',
                                    content: data
                                });
                                _this.text("Đã tạo");
                                _this.removeClass("btn-success");
                                _this.addClass("btn-danger");
                                _this.attr("disabled", "disabled");
                            },
                            complete: function () {
                                $(".popup-wrapper").hide();
                            },
                            error: function (error) {
                                $.alert({
                                    theme: 'modern',
                                    type: 'red',
                                    title: 'Có lỗi xảy ra!',
                                    content: error
                                });
                            }
                        });
                    }

                }},
            cancel: {
                text: 'Nope',
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
});

$(document).on('click', 'a.add_item', function (e) {
    e.preventDefault();
    var url = $("#url_add_item").val();
    $.ajax({
        url: url,
        type: "POST",
        success: function (data) {
            $("div.replace_content_add_item_modal").html(data);
        },
        complete: function () {
            $(".add_item_modal").modal("show");
        }
    });
});

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).on('click', '.adset-detail', function (e) {
    e.preventDefault();
    var url = $(this).attr("data-url");
    var modalName = $(this).attr("data-modal-name");
    $.ajax({
        url: url,
        type: "GET",
        data: {
            adsetId: $(this).attr("adset-id"),
            adsetName: $(this).text()
        },
        success: function (data) {
            $("." + modalName).remove();
            var newModal = `<div class="${modalName}"></div>`;
            $(".modal-append-to").append(newModal);
            $(`.${modalName}`).html(data);
        },
        complete: function () {
            $(`.${modalName} .modal`).modal("show");
        }
    });
});



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).on('click', '.campaign-detail', function (e) {
    e.preventDefault();
    var url = $(this).attr("data-url");
    var modalName = $(this).attr("data-modal-name");
    $.ajax({
        url: url,
        type: "GET",
        data: {
            campaignId: $(this).attr("campaign-id"),
            campaignName: $(this).text()
        },
        success: function (data) {
            $("." + modalName).remove();
            var newModal = `<div class="${modalName}"></div>`;
            $(".modal-append-to").append(newModal);
            $(`.${modalName}`).html(data);
        },
        complete: function () {
            $(`.${modalName} .modal`).modal("show");
        }
    });
});



$("a.delete_multi_item").confirm({
    theme: 'supervan', // 'material', 'bootstrap',
    title: 'Bạn có chắc chắn muốn xóa các dòng đã chọn không?',
    content: 'Hãy nhớ thứ tự xóa là xóa ad => xóa adset => xóa campaign.',
    buttons: {
        confirm: {
            text: 'Xóa',
            action: function () {
                if ($('input.tbl-item-checkbox:checked').length == 0) {
                    $.alert({
                        theme: 'modern',
                        type: 'red',
                        title: 'Có lỗi xảy ra!',
                        content: 'Vui lòng chọn dòng cần xóa!'
                    });
                } else {
                    $("#form_item").attr("action", $("#url_delete_multi_item").val()).attr("method", "POST");
                    $("#form_item").submit();
                }
            }},
        cancel: {
            text: 'Nope',
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


$("a.delete_item").confirm({
    theme: 'supervan', // 'material', 'bootstrap',
    title: 'Bạn có chắc chắn muốn xóa dòng này không?',
    content: 'Hãy nhớ thứ tự xóa là xóa ad => xóa adset => xóa campaign.',
    buttons: {
        confirm: {
            text: 'Xóa',
            action: function () {
                var _this = this.$target;
                var item_id = _this.attr("item_id");
                $.ajax({
                    type: "POST",
                    url: $("#url_delete_item").val(),
                    data: {
                        item_id: item_id
                    },
                    success: function (data) {
                        console.log(data);
                        if (data === '1')
                        {
                            location.reload();
                        } else {
                            alert(data);
                        }
                    },
                    error: function (errorThrown) {
                        alert('Không thể xóa do foreign-key, liên hệ admin để biết thêm chi tiết');
                    }
                });
            }},
        cancel: {
            text: 'Nope',
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
});$(document).on('click', 'a.edit_item', function (e) {
    e.preventDefault();
    var item_id = $(this).attr("item_id");
    var url = $(this).attr("edit-url");
    var modalName = $(this).attr("data-modal-name");
    $.ajax({
        url: url,
        type: "POST",
        data: {
            item_id: item_id
        },
        success: function (data) {
            $("." + modalName).remove();
            var newModal = `<div class="${modalName}"></div>`;
            $(".modal-append-to").append(newModal);
            $(`.${modalName}`).html(data);
        },
        complete: function () {
            $(`.${modalName} .modal`).modal("show");
        }
    });
});


$(document).on('click', 'a.form_plugin', function (e) {
    e.preventDefault();
    var item_id = $(this).attr("item_id");
    var url = $('#base_url').val() + $(this).attr("edit-url");
    var modalName = $(this).attr("data-modal-name");
    
    $.ajax({
        url: url,
        type: "POST",
        data: {
            item_id: item_id
        },
        success: function (data) {
            $("." + modalName).remove();
            var newModal = `<div class="${modalName}"></div>`;
            $(".modal-append-to").append(newModal);
            $(`.${modalName}`).html(data);
        },
        complete: function () {
            $(`.${modalName} .modal`).modal("show");
        }
    });
});


/*
 * Real order
 */
$('th[class^="order_new_"]').on('click', function () {
    var myclass = $(this).attr("class");
    myclass = myclass.split(/ /);
    myclass = myclass[0];
    $('input[class^="order_new_"]').not("input." + myclass).attr('value', '0');
    if ($("input." + myclass).val() === '0')
    {
        $("input." + myclass).attr('value', 'ASC').promise().done(
                function () {
                    $("#form_item").submit();
                }
        );
        return;
    }
    if ($("input." + myclass).val() === 'ASC')
    {
        $("input." + myclass).val('DESC').promise().done(
                function () {
                    $("#form_item").submit();
                }
        );
        return;
    }
    if ($("input." + myclass).val() === 'DESC')
    {
        $("input." + myclass).val('0').promise().done(
                function () {
                    $("#form_item").submit();
                }
        );
        return;
    }
});
/*
 * Real filter
 */
$(".real_filter").on('change', function () {
    $("#form_item").submit();
});

/*
 * Cố định thanh <thead> và phần search của table
 */

$(function () {
    $(".table-fixed-head").setFixTable();
});


$(document).on("change", '.toggle-input [name="edit_active"]', function () {
    var active = ($(this).prop('checked')) ? '1' : '0';
    var item_id = $(this).attr("item_id");
    $.ajax({
        type: "POST",
        url:  $(this).attr("data-url"),
        data: {
            active: active,
            item_id: item_id
        },
        success: function (data) {
            if (data == '1') {
                $.notify('Lưu thành công', {
                    position: "top left",
                    className: 'success',
                    showDuration: 200,
                    autoHideDelay: 2000
                });
            } else {
                alert("Có lỗi xảy ra! Vui lòng liên hệ admin.");
            }
        },
        error: function (errorThrown) {
            alert(errorThrown);
        }
    });
});

$(function () {
    $.each($(".tbl_pricepC3"), function () {
        if (parseInt($(this).text().replace(".", "")) > 50000) {
            $(this).addClass("bg-red");
        }
        ;
    });
     $('.progress .progress-bar').css("width",
                function () {
                    return $(this).attr("aria-valuenow") + "%";
                }
        );
    
});

$(document).on('click', 'a.delete_bill', function (e) {
    var r = confirm("Bạn có chắc chắn muốn xóa dòng đối soát này không?");
    if (r == true) {
        var del = $(this);
        var bill_id = $(this).attr("bill_id");
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $("#base_url").val() + "CODS/check_L8/delete_bill",
            data: {
                bill_id: bill_id
            },
            success: data => {
                console.log(data);
                if (data === '1')
                {
                    del.parent().parent().parent().hide();
                    //location.reload();
                } else {
                    alert(data);
                }
            },
            error: errorThrown => alert(errorThrown)
        });
    }
});
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
$(".btn-export-excel").on('click', function (e) {
    e.preventDefault();
    $("#action_contact").attr("action", $("#base_url").val() + "cod/export_for_print");
    $("#action_contact").submit();
});
$(".btn-export-for-send-vnpost").on('click', function (e) {
    e.preventDefault();
    $("#action_contact").attr("action", $("#base_url").val() + "cod/export_for_send_vnpost");
    $("#action_contact").submit();
});
$(".btn-export-excel-for-viettel").on('click',function (e) {
    e.preventDefault();
    $("#action_contact").attr("action", $("#base_url").val() + "cod/export_for_send_provider");
    $("#action_contact").submit();
});
$('.export_to_string').on('click', function (e) {
    e.preventDefault();
    var modalName = 'export-to-string-modal';
    $.ajax({
        url: $("#base_url").val() + "cod/export_to_string",
        type: "POST",
        data: $("#action_contact").serialize(),
        success: data => {
            $("." + modalName).remove();
            var newModal = `<div class="${modalName}"></div>`;
            $(".modal-append-to").append(newModal);
            $(`.${modalName}`).html(data);
        },
        complete: () => $(`.${modalName} .modal`).modal("show")
    });
});/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(".btn-reset-provider").on('click', function (e) {
    e.preventDefault();
    $("#action_contact").removeClass("form-inline");
    $(".reset_provider_modal").modal("show");
});
$(".btn-reset-provider").on('show.bs.modal', '.modal', function () {
    $("#action_contact").addClass("form-inline");
});

$(document).on('click', '.select_provider', function (e) {
    $("#action_contact").removeClass("form-inline");
    e.preventDefault();
    $(".edit_multi_cod_contact").modal("show");
});

$(".btn-modal_edit-multi-contact").on('click', function (e) {
    e.preventDefault();
    var error = false;

    if (!error) {
        var url = $("#base_url").val() + "common/action_edit_multi_cod_contact";
        /*
         * Lấy các contact chăm sóc để ẩn đi
         */
        var contactIdArray = [];
        $('input[type="checkbox"]').each(
                function () {
                    if ($(this).is(":checked")) {
                        contactIdArray.push($(this).val());
                    }
                });
        $.ajax({
            url: url,
            type: "POST",
            dataType: 'json',
            data: $("#action_contact").serialize(),
            success: function (data) {
                if (data.success == 1) {
                    $("#send_email_sound")[0].play();
                    $.notify(data.message, {
                        position: "top left",
                        className: 'success',
                        showDuration: 200,
                        autoHideDelay: 5000
                    });
                    $.each(contactIdArray, function(){
                        $('tr[contact_id="'+this+'"]').remove();
                    });
                    $(".edit_multi_cod_contact").modal("hide");
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
            complete: function () {

            }
        });
        //$("#action_contact").submit();
    }
});
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).on('click', '.btn-send-account-lakita', function (e) {
    e.preventDefault();
    var contact_id = $(this).attr("contact_id");
    var email_send_lakita = $(".email_send_lakita").val();
    var phone_send_lakita = $(".phone_send_lakita").val();
    var url = $("#base_url").val() + "send_email/send_account_lakita";
    $.ajax({
        url: url,
        type: "POST",
        data: {
            contact_id: contact_id,
            email_send_lakita:email_send_lakita,
            phone_send_lakita:phone_send_lakita
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

$(document).on('click', '.btn-send-account-other-email', function (e) {
    e.preventDefault();
    $('.other-email').show();
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
        var contactIdArray = [];
        $('input[type="checkbox"]').each(
                function () {
                    if ($(this).is(":checked")) {
                        contactIdArray.push($(this).val());
                    }
                });
                          
        $.ajax({
            url: $('#base_url').val() + "common/check_is_one_email",
            type: "POST",
            dataType: 'json',
            data: {contact : contactIdArray},
            beforeSend: () => {
                clearInterval(notiContactRecall);
                $(".popup-wrapper").show();
            },
            success: data =>{
                if(data.num_email != 1){
                     $.alert({
                        theme: 'modern',
                        type: 'red',
                        title: 'Có lỗi xảy ra!',
                        content: 'Các contact đã chọn không có cùng địa chỉ email. \n\
                        Bạn cần sửa lại email để đảm bảo cùng là 1 người!'
                    });
                }else{
                    $.confirm({
                        theme: 'supervan',
                        title: 'Kiểm tra thông tin gửi email và tài khoản ngân hàng',
                        content: 'Email: ' + data.email + ', '
                                + 'combo ' + numberOfChecked + ' khóa học',
                        buttons: {
                            confirm: {
                                text: 'Xác nhận !',
                                action: function () {
                                    $.ajax({
                                        url: url,
                                        type: "POST",
                                        dataType: 'json',
                                        data: {contact_id : contactIdArray},
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

            },
            complete: () => {
                notiContactRecall = setInterval(noti, 10000);
                $(".popup-wrapper").hide();
            },

        });
       
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
$(".send-email-to-viettel").confirm({
    theme: 'supervan', // 'material', 'bootstrap',
    title: 'Bạn có chắc chắn muốn gửi email cho Viettel không?',
    content: 'Hãy đảm bảo rằng các contact được chọn đang là trạng thái "đang giao hàng"!',
    buttons: {
        confirm: {
            text: 'Gửi',
            action: function () {
                if ($('input.tbl-item-checkbox:checked').length == 0) {
                    $.alert({
                        theme: 'modern',
                        type: 'red',
                        title: 'Có lỗi xảy ra!',
                        content: 'Vui lòng chọn contact cần gửi email!'
                    });
                } else {
                    //if ($('select[name="filter_provider_id"]').val() != 1) {//
  //                      $.alert({//
  //                          theme: 'modern',//
 //                           type: 'red',
  //                          title: 'Có lỗi xảy ra!',
    //                        content: 'Vui lòng chọn đơn vị giao hàng là Viettel!'
      //                  });
        //            } else {
                        var _this = this.$target;
                        var form = _this.data("form-id");
                        var action = _this.data("action");
                        var method = _this.data("method");
                        var url = $("#base_url").val() + action;
                        $("#" + form).attr("action", url).attr("method", method).submit();
                   // }
                }
            }},
        cancel: {
            text: 'Nope',
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
});/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


//add-new-contact-modal
$(document).on("click", ".add-new-contact-modal", function (e) {
    e.preventDefault();
    var modalName = 'add-new-contact-modal-show';
    $.ajax({
        url: $(this).attr('href'),
        type: "POST",
        success: data => {
            $("." + modalName).remove();
            var newModal = `<div class="${modalName}"></div>`;
            $(".modal-append-to").append(newModal);
            $(`.${modalName}`).html(data);
        },
        complete: () => $(`.${modalName} .modal`).modal("show")
    });

});

$(document).on('click', '.btn-action-add-new-contact', function (e) {
    e.preventDefault();
    $.ajax({
        url: $(".form_add_new_contact_modal").attr('action'),
        type: "POST",
        data: $(".form_add_new_contact_modal").serialize(),
        dataType: 'json',
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
                $(".popup-wrapper").hide();
                $('.add-new-contact-modal-show .modal').modal("hide");
            } else {
                $('.add-new-contact-modal-show .modal').modal("hide");
                var modalName = 'add-new-contact-modal-show';
                setTimeout(function () {
                    $(".modal-append-to").empty();
                    var newModal = `<div class="${modalName}"></div>`;
                    $(".modal-append-to").append(newModal);
                    $(`.${modalName}`).html(data.content);
                    $(`.add-new-contact-modal-show .modal`).modal("show");
                    $("#send_email_error")[0].play();
                    $.notify('Có lỗi xảy ra! Nội dung: ' + data.message, {
                        position: "top left",
                        className: 'error',
                        showDuration: 200,
                        autoHideDelay: 7000
                    });
                    $(".popup-wrapper").hide();
                }, 1000);
            }

        }
    });
});

/*
 $(document).on('click', 'a.edit_contact', function (e) {
 e.preventDefault();
 $(".checked").removeClass("checked");
 $(this).parent().parent().addClass("checked");
 var contact_id = $(this).attr("contact_id");
 var url = $("#base_url").val() + "common/show_edit_contact_modal";
 $.ajax({
 url: url,
 type: "POST",
 data: {
 contact_id: contact_id
 },
 success: data => {
 $(".modal-view-contact").remove();
 var modalViewContactDetail = "<div class='modal-view-contact'></div>";
 $(".modal-append-to").append(modalViewContactDetail);
 $(".modal-view-contact").html(data);
 },
 complete: () => $(".edit_contact_modal").modal("show")
 });
 }); 
 */
$(document).on('click', '.btn-edit-contact', function (e) {
    e.preventDefault();
    if (check_edit_contact() == false) {
        return false;
    }
    var url = $(this).parents('.form_edit_contact_modal').attr("action");
    var contact_id = $(this).parents('.form_edit_contact_modal').attr("contact_id");
    $.ajax({
        url: url,
        type: "POST",
        dataType: 'json',
        data: $(".form_edit_contact_modal").serialize(),
        beforeSend: () => $(".popup-wrapper").show(),
        success: data => {
            if (data.success == 1) {
                $("#send_email_sound")[0].play();
                $.notify(data.message, {
                    position: "bottom left",
                    className: 'success',
                    showDuration: 200,
                    autoHideDelay: 5000
                });
                $(".edit_contact_modal").modal("hide");
                if((data.role == 10 && data.hide == 1) || data.role == 1 || data.role ==2){
                    $('tr[contact_id="' + contact_id + '"]').remove();
                }
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
        complete: () => $(".popup-wrapper").hide()
    });
});

/*
 * Nếu chọn hình thức thanh toán là COD thì ẩn hình thức thanh toán BANKING, và ngược lại
 */
$(document).on('change', 'select.edit_payment_method_rgt', function (e) {
    if ($(this).val() == 2) {
        $(".tbl_bank").show(1000);
    } else {
        $(".tbl_bank").hide();
    }
    if ($(this).val() == 1) {
        $(".tbl_cod").show(1000);
    } else {
        $(".tbl_cod").hide();
    }
    setEqualTableHeight();
});


$(document).on('change', 'select.note-cod-sample', function () {
    $('[name="note_cod"]').val($(this).val());
});

/*
 $('.edit_contact_modal').on('shown.bs.modal', function () {
 $('.datetimepicker').datetimepicker(
 {
 format: 'DD-MM-YYYY HH:mm'
 });
 if ($("select.edit_payment_method_rgt").val() != 2) {
 $(".tbl_bank").hide();
 }
 if ($("select.edit_payment_method_rgt").val() != 1) {
 $(".tbl_cod").hide();
 }
 });
 */$(function () {
    setTimeout( () => {
        if ($(".filter-tbl-1").height() > $(".filter-tbl-2").height())
        {
            $(".filter-tbl-2").height($(".filter-tbl-1").height());
        } else
        {
            $(".filter-tbl-1").height($(".filter-tbl-2").height());
        }
    }, 300);
});
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
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//
//var nameArr = {
//    id: {
//        name: 'ID Contact',
//        type: 'text'
//    },
//    name: {
//        name: 'Họ và tên',
//        type: 'text'
//    },
//    email: {
//        name: 'Email',
//        type: 'text'
//    },
//    price_purchase: {
//        name: 'Giá tiền mua',
//        type: 'currency'
//    },
//    call_status_id: {
//        name: 'Trạng thái gọi',
//        type: 'array'
//    }
//};
//
//$(document).on('click', 'a.action_view_detail_contact', function (e) {
//    e.preventDefault();
//    var url = $("#base_url").val() + "common/view_detail_contact";
//    var contact_id = $(this).attr("contact_id");
//    $.ajax({
//        url: url,
//        type: "POST",
//        data: {
//            contact_id: contact_id
//        },
//        dataType: "json",
//        success: function (data) {
//            var result = gen_result(data);
//            $("div.replace_content_view_detail_contact").html(result);
//        },
//        complete: function () {
//            $(".view_detail_contact_modal").modal("show");
//        }
//    });
//});
//
//function gen_result(data) {
//    var result = `<div class="row real-search-result-replace">`;
//    result += `<div class="col-md-6">
//                    <table class="table table-striped table-bordered table-hover table-view-1">`;
//    for (var prop in data.view_edit_left) {
//        result += v_row(prop, data);
//    }
//    result += `</table></div>`;
//    result += `</div>`;
//    return result;
//}
//
//function v_row(prop, data) {
//    var result = ``;
//    console.log(prop);
//    console.log(nameArr[prop]);
//    result = `<tr>
//                      <td class="text-right"> ` + nameArr[prop]['name'] + `</td>
//                      <td>`;
//    if (nameArr[prop]['type'] === 'text') {
//        result += data['rows'][prop];
//        result += ` <input type="text" class="form-control datepicker date_recall" name="date_recall" />`;
//    }
//    if (nameArr[prop]['type'] === 'currency') {
//        result += digits(data['rows'][prop]) + ' VNĐ';
//    }
//   
//    result += `       </td>
//              </tr>`;
//
//    return result;
//}
//
//function v_call_status(call_status_id1, call_status_arr) {
//    var result = ``;
//    var name = '' + {call_status_id1} + '';
//    $.each(call_status_arr, function () {
//        if (call_status_id1 === this.id) {
//            result = `<tr>
//                        <td class="text-right"> ` + nameArr.name + `</td>
//                        <td> 
//                            ${this.name}
//                        </td>
//                      </tr>`;
//        }
//    });
//    return result;
//}
//
//function e_call_status(call_status_id, call_status_arr) {
//    console.log(call_status_id);
//    var result = `<tr>
//    <td class="text-right"> Trạng thái gọi </td>
//    <td>  
//        <select class="form-control call_status_id selectpicker" name="call_status_id">`;
//    $.each(call_status_arr, function () {
//        result += ` <option value="${this.id}" ${ (this.id === call_status_id) ? 'selected' : '' }>
//                ${ this.name}
//                </option>`;
//    });
//    result += `</select></td></tr>`;
//    return result;
//}
//
//
//function digits(number){ 
//    return number.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") ; 
//};
/* 
 * Copyright (C) 2017 Phạm Ngọc Chuyển <chuyenpn at lakita.vn>
 *
 */
/*
$('.tbl_name').on('click', 'span.badge-star', function (e) {
    e.stopPropagation();
    e.preventDefault();
    var contact_phone = $(this).attr("contact_phone");
    var contact_course_code = $(this).attr("contact_course_code");
    var controller = $(this).attr("controller");
    var url = $("#base_url").val() + "common/view_contact_star";
    //console.log(url);
    $.ajax({
        url: url,
        type: "POST",
        data: {
            contact_phone: contact_phone,
            contact_course_code: contact_course_code,
            controller: controller
        },
        success: data => $("div.replace_content_view_contact_star").html(data),
        complete: () => $(".view_contact_star_modal").modal("show")
    });
});
*/

$('.view_contact_star_modal').on('hide.bs.modal', () => setTimeout(() => $("div.replace_content_view_contact_star").html(""), 1000));/* $(document).on('click', 'a.action_view_detail_contact', function (e) {
    e.preventDefault();
    $(".checked").removeClass("checked");
    $(this).parent().parent().addClass("checked");
    var contact_id = $(this).attr("contact_id");
    var url = $("#base_url").val() + "common/view_detail_contact";
    //console.log(url);
    $.ajax({
        url: url,
        type: "POST",
        data: {
            contact_id: contact_id
        },
        success: data => $("div.replace_content_view_detail_contact").html(data),
        complete: () => $(".view_detail_contact_modal").modal("show")
    });
});
$('.view_detail_contact_modal').on('shown.bs.modal',  () => {
    if ($(".table-view-1").height() > $(".table-view-2").height())
    {
        $(".table-view-2").height($(".table-view-1").height());
    } else
    {
        $(".table-view-1").height($(".table-view-2").height());
    }
});

$(document).on("click", ".view_contact_phone", () => {
    document.querySelector("#input-copy").select();
    document.execCommand('copy');
    $.notify("Copy thành công vào clipboard", {
            position: "top left",
            className: 'success',
            showDuration: 200,
            autoHideDelay: 2000
        });
});
*/
/*
$(document).on('click', 'a.action_view_detail_contact', function (e) {
    e.preventDefault();
    $(".checked").removeClass("checked");
    $(this).parent().parent().addClass("checked");
    var contact_id = $(this).attr("contact_id");
    var url = $("#base_url").val() + "common/view_detail_contact";
    $.ajax({
        url: url,
        type: "POST",
        data: {
            contact_id: contact_id
        },
        success: data => {
            $(".modal-detail-contact").remove();
            var modalViewContactDetail = "<div class='modal-detail-contact'></div>";
            $(".modal-append-to").append(modalViewContactDetail);
            $(".modal-detail-contact").html(data);
        },
        complete: () => $(".modal-detail-contact .modal").modal("show")
    });
});
*/
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/*
 * Hiển thị menu chuột phải
 */
$(document).on('contextmenu', 'tr.custom_right_menu', function (e) {
    e.preventDefault();
    /*
     * Lấy các thuộc tính của contact
     */
    var contact_id = $(this).attr('contact_id');
    var contact_name = $(this).attr('contact_name');
    var duplicate_id = $(this).attr("duplicate_id");
    var contact_phone = $(this).attr("contact_phone");
    var controller = $("#input_controller").val();
    right_context_menu_display(controller, contact_id, contact_name, duplicate_id, contact_phone);

    /* marketing */
    var item_id = $(this).attr('item_id');
    $(".delete_item, .edit_item, .form_plugin").attr('item_id', item_id);
    var editURL = $(this).attr('edit-url');
    $(".delete_item, .edit_item").attr('edit-url', editURL);

    var menu = $(".menu");
    menu.hide();
    var pageX = e.pageX;
    var pageY = e.pageY;
    menu.css({top: pageY, left: pageX});
    var mwidth = menu.width();
    var mheight = menu.height();
    var screenWidth = $(window).width();
    var screenHeight = $(window).height();
    var scrTop = $(window).scrollTop();
    /*
     * Nếu "tọa độ trái chuột" + "chiều dài menu" > "chiều dài trình duyệt" 
     * thì hiển thị sang bên phải tọa độ click
     */
    if (pageX + mwidth > screenWidth) {
        menu.css({left: pageX - mwidth});
    }
    /*
     * Nếu "tọa độ top chuột" + "chiều cao menu" > "chiều cao trình duyệt" + "chiều dài cuộn chuột"
     * thì hiển thị lên trên tọa độ click
     */
    if (pageY + mheight > screenHeight + scrTop) {
        menu.css({top: pageY - mheight});
    }
    menu.show();
    /*
     * Nếu dòng đó đang không chọn (đã click trái) thì bỏ chọn và bỏ check những dòng đã chọn
     */
    var is_checked_input = $(this).find('input[type="checkbox"]');
    if (!is_checked_input[0].checked) {
        $(".checked").removeClass("checked");
        uncheck_checked();
    } else {
        unselect_not_checked();
    }
    $(this).addClass('checked'); /*.find('[name="contact_id[]"]').prop('checked', true); */
});


/*
 * High light vào các dòng khi click trái để chọn 
 */
$(document).on("click", "td.tbl_name, td.tbl_address", function () {
    if ($(this).parent().hasClass('checked')) {
        $(this).parent().removeClass('checked');
    } else {
        $(this).parent().addClass('checked');
    }
    var input_checkbox = $(this).parent().find('.tbl-item-checkbox');
    if (input_checkbox.is(":checked")) {
        input_checkbox.prop('checked', false);
    } else {
        input_checkbox.prop('checked', true);
    }
    unselect_not_checked();
    show_number_selected_row();
});



$("html").on("click", function (e) {
    $(".menu").hide();
    $(".menu-item").hide();
    // Nếu click ra ngoài bảng thì bỏ chọn các contact
    if (e.target.className.indexOf("form-inline") !== -1 || e.target.className.indexOf("number_paging") !== -1)
    {
        $("input.tbl-item-checkbox").prop('checked', false);
        $('.checked').removeClass('checked');

    }
});

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/*
 * Khi check vào 1 item nào đó sẽ đánh dấu item đó (hiện màu xanh)
 */
/*
$(document).on('change', 'input.tbl-item-checkbox', function (e) {
    if (this.checked) {
        $(this).parent().parent().addClass('checked');
    } else {
        $(this).parent().parent().removeClass('checked');
    }
    // Hiển thị số lượng dòng đã check
    var numberOfChecked = $('input.tbl-item-checkbox:checked').length;
    var totalCheckboxes = $('input.tbl-item-checkbox').length;
    $.notify('Đã chọn: ' + numberOfChecked + '/' + totalCheckboxes, {
        position: "top left",
        className: 'success',
        showDuration: 200,
        autoHideDelay: 1000
    });
});
*/
/*=============================chọn tất cả  ===========================================*/
var checked = true;
$(document).on('click', '.check_all', function () {
    checked = !checked;
    if (checked) {
        $(".list_contact input.tbl-item-checkbox").each(
                function () {
                    $(this).prop("checked", false);
                    $(this).parent().parent().removeClass('checked');
                }
        );
    } else {
        $(".list_contact input.tbl-item-checkbox").each(
                function () {
                    $(this).prop("checked", true);
                    $(this).parent().parent().addClass('checked');
                }
        );
        show_number_selected_row();
    }
});
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/*
 * Hiển thị tên khóa học khi click vào mã khóa học
 */
/*
 $(document).on('click', '.find-course-code', function () {
 var _this = $(this);
 $.ajax({
 url: $("#base_url").val() + "common/find_course_name",
 type: 'POST',
 data: {course_code: $(this).text().trim()},
 success: data => {
 if (_this.parent().attr('class') === 'view_course_code') {
 _this.notify(data, {
 position: "top left",
 className: 'success',
 showDuration: 200,
 autoHideDelay: 4000
 });
 } else {
 _this.notify(data, {
 position: "top center",
 className: 'success',
 showDuration: 200,
 autoHideDelay: 4000
 });
 }
 }
 });
 });
 
 */

$(document).on('click', '.find-course-code', function () {
    var _this = $(this);
    $.ajax({
        url: $("#base_url").val() + "public/json/course.json?ver=" + $("#version-cache").val(),
        type: 'GET',
        dataType: 'json',
        success: data => {
            let find = 0;
            $.each(data.course, (index, item) => {
                if (item.course_code == _this.text().trim()) {
                    _this.notify(item.name_course, {
                        position: "top center",
                        className: 'success',
                        showDuration: 200,
                        autoHideDelay: 4000
                    });
                    find = 1;
                }
            });
            if (!find) {
                _this.notify("KHÔNG TÌM THẤY MÃ KHÓA HỌC NÀY", {
                    position: "top center",
                    className: 'success',
                    showDuration: 200,
                    autoHideDelay: 4000
                });
            }
        }
    });
});

$(".datepicker").datepicker(
        {
            dateFormat: "dd-mm-yy"
        }
);

/*
 * 
 * Tham khảo http://www.daterangepicker.com/#usage
 */
var d = new Date();
var currDate = d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear();
var pastDate = d.getDate() + '-' + d.getMonth() + '-' + d.getFullYear();
$(".daterangepicker").daterangepicker({
    "autoApply": true,
    autoUpdateInput: false,
    locale: {
        format: 'DD/MM/YYYY',
        cancelLabel: 'Clear'
    },
    ranges: {
        'Hôm nay': [moment(), moment()],
        'Hôm qua': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        '7 ngày vừa qua': [moment().subtract(6, 'days'), moment()],
        '30 ngày vừa qua': [moment().subtract(29, 'days'), moment()],
        'Tuần này': [moment().startOf('isoWeek'), moment().endOf('isoWeek')],
        'Tuần trước': [moment().subtract(1, 'weeks').startOf('isoWeek'), moment().subtract(1, 'weeks').endOf('isoWeek')],
        'Tháng này': [moment().startOf('month'), moment().endOf('month')],
        'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    "alwaysShowCalendars": true,
//    "startDate": pastDate,
//    "endDate": currDate
}).on({
    'apply.daterangepicker': function (ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
    },
    'cancel.daterangepicker': function (ev, picker) {
        $(this).val('');
    }
});

$(".daterangepicker2").daterangepicker({
    "timePicker24Hour": true,
     timePicker: true,
    "autoApply": true,
    autoUpdateInput: false,
    locale: {
        format: 'DD/MM/YYYY H:mm',
        cancelLabel: 'Clear'
    },
    ranges: {
        'Hôm nay': [moment(), moment()],
        'Hôm qua': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        '7 ngày vừa qua': [moment().subtract(6, 'days'), moment()],
        '30 ngày vừa qua': [moment().subtract(29, 'days'), moment()],
        'Tuần này': [moment().startOf('isoWeek'), moment().endOf('isoWeek')],
        'Tuần trước': [moment().subtract(1, 'weeks').startOf('isoWeek'), moment().subtract(1, 'weeks').endOf('isoWeek')],
        'Tháng này': [moment().startOf('month'), moment().endOf('month')],
        'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    "alwaysShowCalendars": true,
//    "startDate": pastDate,
//    "endDate": currDate
}).on({
    'apply.daterangepicker': function (ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY H:mm') + ' - ' + picker.endDate.format('DD/MM/YYYY H:mm'));
    },
    'cancel.daterangepicker': function (ev, picker) {
        $(this).val('');
    }
});

/*======================= reset datepicker ========================================================*/
$(".reset_datepicker").click(function (e) {
    e.preventDefault();
    $("#datepicker").val("");
});
$(document).on('focus', '.datepicker', function(){
    $(this).addClass('zindex1');
});
$(document).on('blur', '.datepicker', function(){
    $(this).removeClass('zindex1');
});$(document).on("click", ".view_contact_phone", function () {
    var textCopy = document.getElementById("input-copy-"+$(this).attr('id-copy'));
    console.log(textCopy);
    textCopy.select();
    document.execCommand('copy');
    $.notify("Copy thành công vào clipboard", {
        position: "bottom left",
        className: 'success',
        showDuration: 200,
        autoHideDelay: 2000
    });
});Dropzone.options.dropzoneFileUpload = {
    dictDefaultMessage: "Thả file vào đây hoặc click vào đây để upload",
    acceptedFiles: ".xls, .xlsx",
    maxFilesize: 10,
    init: function () {
        this.on("addedfile",
                function () {
                    $(".popup-wrapper").show();
                }).on("success", function () {
            //console.log(e);
            location.href = $("#redirect-dropzone").val();
        }).on("error", function () {
            $(".popup-wrapper").hide();
        });
    }
};$(document).ready(function () {
    $("input.filter_contact").click(function (e) {
        e.preventDefault();
        $("#action_contact").attr("action", "#").attr("method", "GET");
        $("#action_contact").submit();
    });
    $("input.reset_form").click(function (e) {
        e.preventDefault();
        $('option[value=0]').attr('selected', 'selected');
        $('option[value="empty"]').attr('selected', 'selected');
        $(".datepicker").val('');
        $("input[type='text']").val('');
       // $("#action_contact option:selected").prop("selected", false);
        $('.selectpicker').selectpicker('deselectAll');
    });
    $('select.filter').on('change', function (e) {
        e.preventDefault();
        $("#action_contact").attr("action", "#").attr("method", "GET");
        $("#action_contact").submit();
    });

    /*========================= SORT =================================*/
    $('th[class^="order_"]').click(function () {
        var myclass = $(this).attr("class");
        myclass = myclass.split(/ /);
        myclass = myclass[0];
        $('input[class^="order_"]').not("input." + myclass).attr('value', '0');
        if ($("input." + myclass).val() === '0')
        {
            $("input." + myclass).attr('value', 'ASC').promise().done(
                    function () {
                        $("#action_contact").attr("action", "#").attr("method", "GET");
                        $("#action_contact").submit();
                    }
            );
            return;
        }
        if ($("input." + myclass).val() === 'ASC')
        {
            $("input." + myclass).val('DESC').promise().done(
                    function () {
                        $("#action_contact").attr("action", "#").attr("method", "GET");
                        $("#action_contact").submit();
                    }
            );
            return;
        }
        if ($("input." + myclass).val() === 'DESC')
        {
            $("input." + myclass).val('0').promise().done(
                    function () {
                        $("#action_contact").attr("action", "#").attr("method", "GET");
                        $("#action_contact").submit();
                    }
            );
            return;
        }

    });
});
/* $(function () {
//    $(".real-search").on(
//            {'input': function () {
//                    var type = $(this).attr('type_search');
//                    $.ajax({
//                        url: $("#base_url").val() + "common/real_search",
//                        type: "POST",
//                        beforeSend: function () {
//                            $(".popup-wrapper").show();
//                        },
//                        data: {
//                            type: type,
//                            value: $(this).val()
//                        },
//                        success: function (data) {
//                            //console.log(data);
//                            $(".remove_content").html("");
//                            $(".real-search-replacement").html(data);
//                        }, complete: function () {
//                            $(".popup-wrapper").hide();
//                            $('.modal').on('shown.bs.modal', function () {
//                                $('.selectpicker').selectpicker({});
//                            });
//                        }
//                    });
//                }
//            }
//    );
//});

*/$(function () {

    /*
     * Sửa lại link phân trang nếu có các thao tác lọc, tìm kiếm, sắp xếp
     */
//    if (location.search !== "") {
//        $(".pagination a").each(
//                function () {
//                    var curr_href = $(this).attr("href");
//                    $(this).attr('href', curr_href + location.search);
//                });
//    }

    /*
     * Hiển thị datepicker và selectpicker khi modal edit item đc bật lên
     */



    /*===================================== trờ về trang trước ========================================*/
//    $("input[name='back_location']").val(document.referrer);
//    $(".back_location").click(function () {
//        location.href = document.referrer;
//    });



    /*
     * Thêm hiệu ứng khi hover vào dropdown bootstrap 
     */
    $('.dropdown-hover').hover(function () {
        $(this).find('.dropdown-menu').stop(true, true).fadeIn(200);
        $(this).find('.child_menu').stop(true, true).fadeIn(200);
    }, function () {
        $(this).find('.dropdown-menu').stop(true, true).fadeOut(200);
        $(this).find('.child_menu').stop(true, true).fadeOut(200);
    });

    /*
     * Sửa lại value của thẻ input curr_url
     */
    $("#curr_url").val(location.href);

    /*
     * Nếu click vào nút filter nâng cao thì đổi icon
     */
    $(document).on('click', '.show-more-table-info', function (e) {
        e.stopPropagation();
        let contactId = $(this).attr('contact-id');
        $("#" + contactId).toggle("slow");
        let isHide = $(this).attr('is-hide');
        if (isHide == '1') {
            $(this).attr('is-hide', '0');
            $(this).html('<i class="fa fa-minus-circle" aria-hidden="true"></i>');
        } else {
            $(this).attr('is-hide', '1');
            $(this).html('<i class="fa fa-plus-circle" aria-hidden="true"></i>');
        }
        console.log(1);
    });

    /*
     * Nếu filter nâng cao được mở ra thì điều chỉnh chiều cao 2 cột bằng nhau
     */
    $('#collapse-filter').on('shown.bs.collapse', function () {
        $(this).prev().find(".fa").removeClass("fa-arrow-circle-down").addClass("fa-arrow-circle-up");
        if ($(".filter-tbl-1").height() > $(".filter-tbl-2").height())
        {
            $(".filter-tbl-2").height($(".filter-tbl-1").height());
        } else
        {
            $(".filter-tbl-1").height($(".filter-tbl-2").height());
        }
    });
    $('#collapse-filter').on('hidden.bs.collapse', function () {
        $(this).prev().find(".fa").removeClass("fa-arrow-circle-up").addClass("fa-arrow-circle-down");
    });
    /*
     * Kiểm tra xem có biến search là view_detail_contact không, nếu có sẽ hiển thị chi tiết contact
     */
    let searchParams = new URLSearchParams(window.location.search);
    if (searchParams.has('view_detail_contact')) {
        var contatctID = $.trim(searchParams.get('view_detail_contact'));
        $(".view-detail-contact-by-get-url").remove();
        $('body').append(`<a href="#" 
                               class="ajax-request-modal view-detail-contact-by-get-url"
                               data-contact-id ="${contatctID}"
                               data-modal-name="view-detail-contact-div"
                               data-url="common/view_detail_contact">`);
        $(".view-detail-contact-by-get-url").click();
        $(".view-detail-contact-by-get-url").remove();
    }
});
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

$(".btn-export-one-contact-for-send-vnpost").on('click', function (e) {
    e.preventDefault();
    var data_contact_id = $(this).attr("data-contact-id");
    console.log(data_contact_id);
    $("input[value='"+data_contact_id+"']").prop( "checked", true );
    $("#action_contact").attr("action", $("#base_url").val() + "cod/export_for_send_vnpost");
    $("#action_contact").submit();
});
/*
 * Copyright (C) 2017 Phạm Ngọc Chuyển <chuyenpn at lakita.vn>
 *
 */
/* global Notification */
/*
 var notify = '';
 Notification.requestPermission(function (p) {});
 setInterval(function () {
 $.ajax({
 url: $("#base_url").val() + "cron/listen",
 success: data2 => {
 //console.log(data2);
 if (data2 === '1') {
 $("#notificate")[0].play();
 notify = new Notification(
 'Có một contact mới đăng ký',
 {
 body: 'Click vào đây để xem ngay!',
 icon: $("#base_url").val() + 'public/images/logo2.png',
 tag: 'https://crm2.lakita.vn/quan-ly/trang-chu.html',
 sound: $("#base_url").val() + 'public/mp3/new-contact.mp3',
 image: $("#base_url").val() + 'public/images/contact-us.jpg'
 }
 );
 notify.onclick = function (event) {
 event.preventDefault();
 window.open('https://crm2.lakita.vn/quan-ly/trang-chu.html', '_blank');
 };
 if (($("#input_controller").val() === 'manager' && $("#input_method").val() === 'index')
 || $("#input_controller").val() === 'marketing' && $("#input_method").val() === 'index') {
 setTimeout(function () {
 location.reload();
 }, 4000);
 }
 }
 }
 });
 }, 3000);
 */
Pusher.logToConsole = true;
var pusher = new Pusher('32b339fca68db27aa480', {
    cluster: 'ap1',
    encrypted: true
});
var channel = pusher.subscribe('my-channel');
channel.bind('notice', function (data) {
    $("#notificate")[0].play();
    n = new Notification(
            data.title,
            {
                body: data.message,
                icon: $("#base_url").val() + 'public/images/logo2.png',
                tag: 'https://crm2.lakita.vn/quan-ly/trang-chu.html',
                sound: $("#base_url").val() + 'public/mp3/new-contact.mp3',
                image: data.image,
                "data": data.url || ''
            });
    n.onclick = function (e) {
        window.location.href = e.target.data;
    };
//    var append = ` <div style="position: fixed; right:10px; bottom: 10px; z-index: 999999999; 
//         background-color: #fff; display: inline-block; width: 30%; border-radius: 5px" class="my-notify">
//        <div style="position:absolute; right: 5px; top:5px; cursor: pointer" class="close-notify"> 
//            <i class="fa fa-times-circle" style="font-size: 18px;" aria-hidden="true"></i> 
//        </div>    
//        <div style="float:left; width: 35%; padding: 2%">
//            <img src="https://crm2.lakita.vn/public/images/logo2.png" style="width: 70%"/>
//        </div>
//        <div style="float:left; width:65%; padding: 2%">
//            <h4> ${data.title} </h4>
//            <p> ${data.message} </p>
//            <div>
//                <img src="${data.image}" style="width: 90%"/>
//            </div>
//        </div>
//    </div>`;
//
//    $('body').append(append);
//    setTimeout(function () {
//        $(".my-notify").remove();
//    }, 10000);

    if (($("#input_controller").val() === 'manager' && $("#input_method").val() === 'index')
            || $("#input_controller").val() === 'marketing' && $("#input_method").val() === 'index') {
        setTimeout(function () {
            location.reload();
        }, 4000);
    }
});

channel.bind('callLog', function (data) {


//    var append = ` <div style="position: fixed; right:10px; bottom: 10px; z-index: 999999999; 
//         background-color: #fff; display: inline-block; width: 30%; border-radius: 5px" class="my-notify">
//         <div style="position:absolute; right: 5px; top:5px; cursor: pointer" class="close-notify"> 
//                <i class="fa fa-times-circle" style="font-size: 18px;" aria-hidden="true"></i> 
//         </div>       
//         <div style="float:left; width: 35%; padding: 2%">
//            <img src="https://crm2.lakita.vn/public/images/logo2.png" style="width: 70%"/>
//        </div>
//        <div style="float:left; width:65%; padding: 2%">
//            <h4> ${data.title} </h4>
//            <p> ${data.message} </p>
//            <div>
//                <img src="${data.image}" style="width: 90%"/>
//            </div>
//        </div>
//    </div>`;
//
//    $('body').append(append);
//    setTimeout(function () {
//        $(".my-notify").remove();
//    }, 10000);

    if (data.success == '1') {
        $("#call-log-L6-sound")[0].play();
        n = new Notification(
                data.title,
                {
                    body: data.message,
                    icon: $("#base_url").val() + 'public/images/logo2.png',
                    tag: 'https://crm2.lakita.vn/quan-ly/trang-chu.html',
                    image: data.image
                });
    } else {
        $("#call-log-sound")[0].play();
    }
});

$(document).on("click", ".close-notify", function () {
    $(".my-notify").remove();
});/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 $(document).on({
 mousemove: function () {
 if ($('div.mega-dropdown-menu').is(":visible")) {
 $(".black-over").css('bottom', '0%');
 console.log(1);
 } else {
 $(".black-over").css('bottom', '100%');
 }
 },
 click: function () {
 if ($('div.mega-dropdown-menu').is(":visible")) {
 $(".black-over").css('bottom', '0%');
 console.log(1);
 } else {
 $(".black-over").css('bottom', '100%');
 }
 }
 }, 'body');
 */

$('li.mega-dropdown').mouseover(() => $(".black-over").css('bottom', '0%')).mouseout(() => $(".black-over").css('bottom', '100%'));

/*
 setInterval(function(){
 if ($('div.mega-dropdown-menu').is(":visible")) {
 $(".black-over").css('bottom', '0%');
 } else {
 $(".black-over").css('bottom', '100%');
 }
 },100);
 *//* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 $('.modal').on('hide.bs.modal', function () {
 if ($(this).find(".modal-dialog").attr('class').search('btn-very-lg') != -1) {
 $(this).find(".modal-dialog").attr('class', 'modal-dialog fadeOut animated btn-very-lg');
 } else if ($(this).find(".modal-dialog").attr('class').search('modal-lg') != -1) {
 $(this).find(".modal-dialog").attr('class', 'modal-dialog fadeOut animated modal-lg');
 } else {
 $(this).find(".modal-dialog").attr('class', 'modal-dialog fadeOut animated');
 }
 });
 $('.modal').on('show.bs.modal', function () {
 if ($(this).find(".modal-dialog").attr('class').search('btn-very-lg') != -1) {
 $(this).find(".modal-dialog").attr('class', 'modal-dialog fadeIn animated btn-very-lg');
 } else if ($(this).find(".modal-dialog").attr('class').search('modal-lg') != -1) {
 $(this).find(".modal-dialog").attr('class', 'modal-dialog fadeIn animated modal-lg');
 } else {
 $(this).find(".modal-dialog").attr('class', 'modal-dialog fadeIn animated');
 }
 var zIndex = 1040 + (10 * $('.modal:visible').length);
 $(this).css('z-index', zIndex);
 setTimeout(function () {
 $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
 }, 0);
 });
 */
$(document).on('hide.bs.modal', '.navbar-search-modal', function () {
    $('.navbar-search-modal').remove();
});
$(document).on('hide.bs.modal', '.view-all-contact-courses-modal', function () {
    $('.view-all-contact-courses-modal').remove();
});


$(document).on('hide.bs.modal', '.modal', function () {
    if ($(this).find(".modal-dialog").attr('class').search('btn-very-lg') != -1) {
        $(this).find(".modal-dialog").attr('class', 'modal-dialog fadeOut animated btn-very-lg');
    } else if ($(this).find(".modal-dialog").attr('class').search('modal-lg') != -1) {
        $(this).find(".modal-dialog").attr('class', 'modal-dialog fadeOut animated modal-lg');
    } else {
        $(this).find(".modal-dialog").attr('class', 'modal-dialog fadeOut animated');
    }
});
$(document).on('show.bs.modal', '.modal', function () {
    /*
     * Nạp lại các date picker
     */
    $('.selectpicker').selectpicker({});
    $(".datepicker").datepicker({dateFormat: "dd-mm-yy"});
    $(".reset_datepicker").click(function (e) {
        e.preventDefault();
        $(".datepicker").val("");
        $(".datetimepicker").val('');
    });
    $('.datetimepicker').datetimepicker(
            {
                format: 'DD-MM-YYYY HH:mm'
            });
    
    
    setTimeout(function () {
        setEqualTableHeight();
    }, 1000);
    if ($(this).find(".modal-dialog").attr('class').search('btn-very-lg') != -1) {
        $(this).find(".modal-dialog").attr('class', 'modal-dialog fadeIn animated btn-very-lg');
    } else if ($(this).find(".modal-dialog").attr('class').search('modal-lg') != -1) {
        $(this).find(".modal-dialog").attr('class', 'modal-dialog fadeIn animated modal-lg');
    } else {
        $(this).find(".modal-dialog").attr('class', 'modal-dialog fadeIn animated');
    }
    var zIndex = 1040 + (10 * $('.modal:visible').length);
    $(this).css('z-index', zIndex);
    setTimeout(function () {
        $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
    }, 0);
});



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).on("click", ".ajax-request-modal", function (e) {
    e.stopPropagation();
    e.preventDefault();
    var _this = $(this);
    setTimeout(function () {
     if($(".checked").length) $(".checked").removeClass("checked");
       /*   _this.parent().parent().addClass("checked"); */

        var contact_id = _this.attr("data-contact-id");
        var url = $("#base_url").val() + _this.attr("data-url");
        var modalName = _this.attr("data-modal-name");
        var controller = _this.attr("data-controller");
        $.ajax({
            url: url,
            type: "POST",
            dataType: 'json',
            data: {
                contact_id: contact_id,
                controller: controller
            },
            success: data => {
                console.log(data);
                
                if (data.success == 0) {
                    $("#send_email_error")[0].play();
                    $.notify(data.message, {
                        position: "top left",
                        className: 'error',
                        showDuration: 200,
                        autoHideDelay: 7000
                    });
                    return false;
                } else {
                    $("." + modalName).remove();
                    var newModal = `<div class="${modalName}"></div>`;
                    $(".modal-append-to").append(newModal);
                    $(`.${modalName}`).html(data.message);
                }
            },
            complete: () => $(`.${modalName} .modal`).modal("show")
        });
    }, 100);
});


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).on('click', '.change-form-submit-url', function (e) {
    e.preventDefault();
    var form = $(this).data("form-id");
    var action = $(this).data("action");
    var method = $(this).data("method");
    var url = $("#base_url").val() + action;
    $("#" + form).attr("action", url).attr("method", method).submit(); 
});


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var modalName = "navbar-search-modal";
$(function () {
    var locationHash = location.hash;
    if (locationHash.indexOf("search") > -1) {
        var hashSearch = locationHash.substring(1);
        var searchArr = hashSearch.split("=");
        var searchStr = searchArr[1];
        $(".input-navbar-search").val(searchStr);
        $.ajax({
            url: $("#base_url").val() + $("#input_controller").val() + '/search',
            type: "GET",
            data: {
                search_all: searchStr
            },
            success: data => {
                $("." + modalName).remove();
                var newModal = `<div class="${modalName}"></div>`;
                if ($("#action_contact").length) {
                    $("#action_contact").append(newModal);
                } else {
                    $(".modal-append-to").append(newModal);
                }
                $(`.${modalName}`).html(data);
            },
            complete: () => $(`.${modalName} .navbar-search-modal`).modal("show")
        });
    }
});

$(".btn-navbar-search").click(function (e) {
    e.preventDefault();
    if ($(".input-navbar-search").val() == '') {
        $("#send_email_error")[0].play();
        $.notify('Vui lòng nhập nội dung tìm kiếm!', {
            position: "top left",
            className: 'error',
            showDuration: 200,
            autoHideDelay: 7000
        });
        return false;
    }
    var locationOrigin = location.href.split("#");
    location.href = locationOrigin[0] + '#search=' + $(".input-navbar-search").val();
    $.ajax({
        url: $("#base_url").val() + $("#input_controller").val() + '/search',
        type: "GET",
        data: {
            search_all: $(".input-navbar-search").val()
        },
        success: data => {
            $("." + modalName).remove();
            var newModal = `<div class="${modalName}"></div>`;
            if ($("#action_contact").length) {
                $("#action_contact").append(newModal);
            } else {
                $(".modal-append-to").append(newModal);
            }
            $(`.${modalName}`).html(data);
        },
        complete: () => $(`.${modalName} .navbar-search-modal`).modal("show")
    });
});
/*     <a href="#" class="anchor-navbar-search">6899</a> */
$(".anchor-navbar-search").click(function (e) {
    e.preventDefault();
    $.ajax({
        url: $("#base_url").val() + $("#input_controller").val() + '/search',
        type: "GET",
        data: {
            search_all: $.trim($(this).text())
        },
        success: data => {
            $("." + modalName).remove();
            var newModal = `<div class="${modalName}"></div>`;
            if ($("#action_contact").length) {
                $("#action_contact").append(newModal);
            } else {
                $(".modal-append-to").append(newModal);
            }
            $(`.${modalName}`).html(data);
        },
        complete: () => $(`.${modalName} .navbar-search-modal`).modal("show")
    });
});
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).on('click', '.export-to-excel', function (e) {
    e.preventDefault();
    if ($('input.tbl-item-checkbox:checked').length == 0) {
        $.alert({
            theme: 'modern',
            type: 'red',
            title: 'Có lỗi xảy ra!',
            content: 'Vui lòng chọn contact cần xuất ra file excel!'
        });
    } else {
        $(".popup-wrapper").show();
        setTimeout(function(){ $(".popup-wrapper").hide();}, 3000);
        var form = $(this).data("form-id");
        var action = $(this).data("action");
        var method = $(this).data("method");
        var url = $("#base_url").val() + action;
        $("#" + form).attr("action", url).attr("method", method).submit();
    }
});
$(".export-all-to-excel").remove();
 $(".btn-export-all-contact-to-excel").click(function (e) {
        e.preventDefault();
        var formID = $(this).attr('data-form-id');
        $("#"+formID).append('<input type="text" class="export-all-to-excel" name="export_all" value="yes" />');
        $("#"+formID).attr("action", "#").attr("method", "GET").submit();
        $(".export-all-to-excel").remove();
    });



shortcut.add("Ctrl+s", function () {
    $(".btn-edit-contact").click();
});
shortcut.add("Ctrl+Shift+a", function () {
    $("input.tbl-item-checkbox").prop('checked', true);
    $('.custom_right_menu').addClass('checked');
    show_number_selected_row();
});
shortcut.add("Esc", function () {
    $("input.tbl-item-checkbox").prop('checked', false);
    $('.checked').removeClass('checked');
    $(".menu").hide();
});

shortcut.add("Ctrl+i", function () {
    $(".add_item_modal_fetch").modal('hide');
});$("a.cancel_one_contact").on('click', function (e) {
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
$(".cancel_multi_contact").on('click', function (e) {
    $("#action_contact").attr("action", $("#base_url").val() + "manager/cancel_multi_contact");
    $("#action_contact").submit();
});$("#delete_contact").on('click', function (e) {
    e.preventDefault();
    var r = confirm("Are you sure?");
    if (r === true) {
        $("#action_contact").attr("action", $("#base_url").val() + "manager/delete_contact");
        $("#action_contact").submit();
    }
});

    $(document).on('click', 'a.delete_one_contact', function (e) {
        var del = $(this);
        var contact_id = $(this).attr("contact_id");
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: $("#base_url").val() + "manager/delete_one_contact",
            data: {
                contact_id: contact_id
            },
            success: function (data) {
                if (data === '1')
                {
                    //del.parent().parent().hide();
                    $(".duplicate_" + contact_id).hide();
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

/*=================================== chia contact đã chọn (form modal)================================================*/
$("a.divide_contact").on('click', function (e) {
    e.preventDefault();
    $("#action_contact").removeClass("form-inline");
    $(".divide_multi_contact_modal").modal("show");
});

/*=================================== chia từng contact một (form modal)================================================*/
$(document).on('click', '.divide_one_contact_achor', function (e) {
    e.preventDefault();
    $("#action_contact").removeClass("form-inline");
    var contact_id = $(this).attr("contact_id");
    $(".checked").removeClass("checked");
    $(this).parent().parent().addClass("checked");
    $("#contact_id_input").val(contact_id);
    var contact_name = $(this).attr("contact_name");
    $("span.contact_name").text(contact_name);
    $(".divide_one_contact_modal").modal("show");
});

/*=================================== chia đều contact đã chọn ================================================*/
$(".divide_contact_even").on('click', function (e) {
    e.preventDefault();
    $("#action_contact").attr("action", $("#base_url").val() + "manager/divide_contact_even");
    $("#action_contact").submit();
});

/*===================================== phân contact bằng ajax ==============*/

$(document).on('click', '.btn-divide-one-contact', function (e) {
    e.preventDefault();
    var url = $(this).parents('#divide_one_contact').attr("action");
    var contact_id = $("#contact_id_input").val();
    $.ajax({
        url: url,
        type: "POST",
        dataType: 'json',
        data: $('#divide_one_contact').serialize(),
        success: data => {
            if (data.success == 1) {
                $("#send_email_sound")[0].play();
                $.notify(data.message, {
                    position: "top left",
                    className: 'success',
                    showDuration: 200,
                    autoHideDelay: 5000
                });
                $(".divide_one_contact_modal").modal("hide");
                $('tr[contact_id="' + contact_id + '"]').remove();
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
});


$(document).on('click', '.btn-divide-multi-contact', function (e) {
    e.preventDefault();
    var url = $('#base_url').val() + "manager/divide_contact";
    /*
     * Lấy các contact chăm sóc để ẩn đi
     */
    var contactIdArray = [];
    $('input[type="checkbox"]').each(
            function () {
                if ($(this).is(":checked")) {
                    contactIdArray.push($(this).val());
                }
            });
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
                $(".divide_multi_contact_modal").modal("hide");
                $.each(contactIdArray, function () {
                    $('tr[contact_id="' + this + '"]').remove();
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
});/*
$("a.view_duplicate").on('click', function (e) {
    e.preventDefault();
   // alert(1);
    var duplicate_id = $(this).attr("duplicate_id");
   // console.log(url);
    $.ajax({
        url: $("#base_url").val() + "manager/view_duplicate",
        type: "POST",
        data: {
            duplicate_id: duplicate_id
        },
        success: function (data) {
            // console.log(data);
            $("div.view_duplicate").html("").html(data);
        },
        complete: function () {
            $(".view_duplicate_modal").modal("show");
        }
    });
});

*//*
$(document).on('scroll', function () {
    if ($(".table-head-pos").length) {
        if ($("body").scrollTop() > ($(".table-head-pos").offset().top)
                ) {
            $(".fixed-table").css({
                "display": "block"
            });
        } else {
            $(".fixed-table").css({
                "display": "none"
            });
        }
        $('[class^="staff_"]').each(function () {
            var myClass = $(this).attr("class");
            var mywidth = $(this).width();
            var myheight = $(this).height();
            $(".f_" + myClass).width(mywidth);
            $(".f_" + myClass).height(myheight);
        });
        var offsetLeft = $(".table-head-pos").offset().left + 2;
        $("table thead.fixed-table").css("left", offsetLeft + "px");
    }
});
*/

$("input.reset_form").on('click', function (e) {
    e.preventDefault();
    $('option[value=0]').attr('selected', 'selected');
    $('option[value="empty"]').attr('selected', 'selected');
    $(".datepicker").val('');
    $("input[type='text']").val('');
    // $("#action_contact option:selected").prop("selected", false);
    $('.selectpicker').selectpicker('deselectAll');
});



$(document).on('click', '.btn-edit-contact', function (e) {
    if ($("#input_controller").val() === 'sale') {
//        e.preventDefault();
//        var error = false;
//        var call_status_id = $("select[name='call_status_id']").val();
//       // console.log('call_status_id= ' + call_status_id);
//        var ordering_status_id = $("select[name='ordering_status_id']").val();
//       // console.log('ordering_status_id= ' + ordering_status_id);
//        var date_recall = $(".date_recall").val();
//        var course_code = $('select.select_course_code').val();
//        var price_purchase = $('[name="price_purchase"]').val();
//        if ($("select.edit_payment_method_rgt").val() == 0) {
//            alert("Bạn cần cập nhật hình thức thanh toán!");
//            error = true;
//            return false;
//        }
//        if (call_status_id == 0) {
//            alert("Bạn cần cập nhật trạng thái gọi!");
//            error = true;
//            return false;
//        }
//        if (check_rule_call_stt(call_status_id, ordering_status_id) == false) {
//            alert("Trạng thái gọi và trạng thái đơn hàng không logic!");
//            error = true;
//            return false;
//        }
//        if (date_recall != '') {
//            if (now_greater_than_input_date(date_recall)) {
//                alert("Ngày gọi lại không thể là một ngày trước ngày hôm nay!");
//                error = true;
//                return false;
//            }
//            if (check_rule_call_stt_and_date_recall(call_status_id, ordering_status_id, date_recall)) {
//                alert("Nếu contact không liên lạc được hoặc không thể chăm sóc được nữa thì không thể có ngày gọi lại lớn hơn ngày hiện tại!");
//                error = true;
//                return false;
//            }
//        }
//        if (course_code == '0') {
//            alert("Vui lòng chọn mã khóa học!");
//            error = true;
//            return false;
//        }
//        if (price_purchase == '') {
//            alert("Vui lòng chọn giá tiền mua!");
//            error = true;
//            return false;
//        }
//        if (!error) {
//            $(".form_submit").submit();
//        }
    }
});

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
$(document).on('click', 'a.transfer_contact, a.transfer_one_contact', function (e) {
    e.preventDefault();
    var action = $(this).attr("class").split(" ");
    if (action[0] == "transfer_contact") {
        $("#action_contact").removeClass("form-inline");
        $(".transfer_multi_contact_modal").modal("show");
    } else {
        $(".checked").removeClass("checked");
        $(this).parent().parent().addClass("checked");
        var contact_id = $(this).attr("contact_id");
        var contact_name = $(this).attr("contact_name");
        $("#contact_id_input").val(contact_id);
        $(".contact_name_replacement").text(contact_name);
        $(".transfer_one_contact_modal").modal("show");
    }
});
$(document).on('change', '[name="add_channel_id"], [name="edit_channel_id"]', function () {
    var channel_id = $(this).val();
    $.ajax({
        url: $('#base_url').val() + 'MANAGERS/link/get_campaign',
        type: "POST",
        data: {
            channel_id: channel_id
        },
        success: function (data) {
            $(".ajax_campaign").html(data);
            $(".ajax_adset").html('');
            $(".ajax_ad").html('');
        },
        complete: function () {
            $('.selectpicker').selectpicker({});
        }
    });
});
$(document).on('change', '[name="add_campaign_id"]', function () {
    var campagin_id = $(this).val();
    $.ajax({
        url: $('#base_url').val() + 'MANAGERS/link/get_adset',
        type: "POST",
        data: {
            campagin_id: campagin_id
        },
        success: function (data) {
            $(".ajax_adset").html(data);
            $(".ajax_ad").html('');
        },
        complete: function () {
            $('.selectpicker').selectpicker({});
        }
    });
});

$(document).on('change', '[name="add_adset_id"]', function () {
    var adset_id = $(this).val();
    $.ajax({
        url: $('#base_url').val() + 'MANAGERS/link/get_ad',
        type: "POST",
        data: {
            adset_id: adset_id
        },
        success: function (data) {
            $(".ajax_ad").html(data);
        },
        complete: function () {
            $('.selectpicker').selectpicker({});
        }
    });
});


$(document).on('change', '[name="add_landingpage_id"]', function () {
    var landingpage_id = $(this).find(":selected").data('url');
    var preview_iframe = `<iframe width="100%" height="500px" src="${landingpage_id}"></iframe>`;
    $(".modal-replace-preview-landingpage").html(preview_iframe);
    $(".modal-preview-landingpage").modal('show');
});

/* locnt */

    /* xóa giảng viên */
$(document).ready(function () {
    $(document).on('click', '.btn_delete_teacher', function (e) {
        var r = confirm("Bạn có chắc chắn muốn xóa Giảng viên này không?");
        if (r == true) {
            var del = $(this);
            var teacher_id = $(this).attr("teacher_id");
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: $("#base_url").val() + "MANAGERS/teacher/delete_teacher",
                data: {
                    teacher_id: teacher_id
                },
                success: function (data) {
                  //console.log(data);
                    if (data === '1')
                    {
                        del.parent().parent().parent().hide();
                        //location.reload();
                    } else {
                        alert(data);
                    }
                },
                error: function (errorThrown) {
                    alert(errorThrown);
                }
            });
        }
    });
});
 /* thêm giảng viên mới */
$(function () {
    $(document).on('click', '.btn_manage_teacher', function (e) {
        e.preventDefault();
        var teacher_id = $(this).attr("teacher_id");
        var url = $("#base_url").val() + "MANAGERS/teacher/show_edit_teacher";
        $.ajax({
            url: url,
            type: "POST",
            data: {
                teacher_id: teacher_id
            },
            success: function (data) {
                console.log(data);
                $("div.replace_content_edit_teacher_modal").html(data);
            },
            complete: function () {
                $(".edit_teacher_modal").modal("show");
            }
        });
    });
    $('.edit_teacher_modal').on('shown.bs.modal', function () {
        if ($(".table-1").height() > $(".table-2").height())
        {
            $(".table-2").height($(".table-1").height());
        } else
        {
            $(".table-1").height($(".table-2").height());
        }
    });
});


/* check khi thêm khóa học có phải combo không */
$( document ).ready(function() {
    $(document).on('switchChange.bootstrapSwitch', "[name='add_is_combo']", function (event, state) {
        if ($(this).bootstrapSwitch('state')) {    
            /* nếu có là combo*/
             $(".combo_course").attr('disabled',false);
        }else {
            /* nếu ko là combo*/
             $(".combo_course").attr('disabled',true);
        }
    });
    $(document).on('click', '.btn-success', function (e) {
        if($('#input_controller').val() == 'course' && $('#input_method').val() == 'index'){
            var is_combo = $("[name='add_is_combo']").bootstrapSwitch('state');
            var combo_course = $("[name='add_combo_course[]']").val();
            if(is_combo == true && combo_course == null){
                e.preventDefault();
                $.alert({
                    theme: 'modern',
                    type: 'red',
                    title: 'Có lỗi xảy ra!',
                    content: 'Bạn muốn tạo combo nhưng chưa chọn khóa học!'
                });
            }else if(is_combo == true && combo_course != null && combo_course.length == 1){
                e.preventDefault();
                $.alert({
                    theme: 'modern',
                    type: 'red',
                    title: 'Có lỗi xảy ra!',
                    content: 'Combo phải từ 2 khóa trở lên!'
                });
            }else{
                combo_course == null;
            }
        }
    });
});

/* check khi sửa khóa học có phải combo không */
$( document ).ready(function() {
    $(document).on('switchChange.bootstrapSwitch', "[name='edit_is_combo']", function (event, state) {
        if ($(this).bootstrapSwitch('state')) {    
            /* nếu có là combo*/
             $(".combo_course").attr('disabled',false);
        }else {
            /* nếu ko là combo*/
             $(".combo_course").attr('disabled',true);
        }
    });
    $(document).on('click', '.btn-success', function (e) {
        if($('#input_controller').val() == 'course' && $('#input_method').val() == 'index'){
            var is_combo = $("[name='edit_is_combo']").bootstrapSwitch('state');
            var combo_course = $("[name='edit_combo_course[]']").val();
            if(is_combo == true && combo_course == null){
                e.preventDefault();
                $.alert({
                    theme: 'modern',
                    type: 'red',
                    title: 'Có lỗi xảy ra!',
                    content: 'Bạn muốn tạo combo nhưng chưa chọn khóa học!'
                });
            }else if(is_combo == true && combo_course != null && combo_course.length == 1){
                e.preventDefault();
                $.alert({
                    theme: 'modern',
                    type: 'red',
                    title: 'Có lỗi xảy ra!',
                    content: 'Combo phải từ 2 khóa trở lên!'
                });
            }else{
                combo_course == null;
            }
        }
    });
});


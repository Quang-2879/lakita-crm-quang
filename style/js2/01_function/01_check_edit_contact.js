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



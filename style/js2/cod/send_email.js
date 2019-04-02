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
                    if ($('select[name="filter_provider_id"]').val() != 1) {
                        $.alert({
                            theme: 'modern',
                            type: 'red',
                            title: 'Có lỗi xảy ra!',
                            content: 'Vui lòng chọn đơn vị giao hàng là Viettel!'
                        });
                    } else {
                        var _this = this.$target;
                        var form = _this.data("form-id");
                        var action = _this.data("action");
                        var method = _this.data("method");
                        var url = $("#base_url").val() + action;
                        $("#" + form).attr("action", url).attr("method", method).submit();
                    }
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
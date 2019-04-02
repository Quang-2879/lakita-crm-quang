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
});
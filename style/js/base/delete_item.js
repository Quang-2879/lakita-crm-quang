$(document).ready(function () {
        $(document).on('click', 'a.delete_item', function (e) {
            e.preventDefault();
            var r = confirm("Bạn có chắc chắn muốn xóa dòng này không?");
            if (r === true) {
                var del = $(this);
                var item_id = $(this).attr("item_id");
                e.preventDefault();
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
                            del.parent().parent().parent().hide();
                        } else {
                            alert(data);
                        }
                    },
                    error: function (errorThrown) {
                        alert('Không thể xóa do foreign-key, liên hệ admin để biết thêm chi tiết');
                    }
                });
            }
        });
        $("a.delete_multi_item").click(function (e) {
            e.preventDefault();
            var r = confirm("Bạn có chắc chắn muốn xóa các dòng đã chọn không?");
            if (r === true) {
                $("#form_item").attr("action", $("#url_delete_multi_item").val()).attr("method", "POST");
                $("#form_item").submit();
            }
        });
    });
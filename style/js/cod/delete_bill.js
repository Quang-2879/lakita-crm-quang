$(document).ready(function () {
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
                success: function (data) {
                    console.log(data);
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
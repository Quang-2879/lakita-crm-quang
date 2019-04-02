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


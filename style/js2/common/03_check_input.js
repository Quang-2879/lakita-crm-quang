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

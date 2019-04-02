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



$(function () {
    $(".btn-modal_edit-multi-contact").click(function (e) {
        e.preventDefault();
        var error = false;
        var modal_edit_provider_id = $('.edit_multi_cod_contact [name="provider_id"]').val();
        var modal_edit_cod_status_id = $('.edit_multi_cod_contact [name="cod_status_id"]').val();
        console.log(modal_edit_provider_id);
        if (modal_edit_cod_status_id == 0) {
            alert("Bạn cần chọn trạng thái giao COD!");
            error = true;
            return false;
        }
        if (modal_edit_provider_id == 0) {
            alert("Bạn cần chọn đơn vị giao hàng!");
            error = true;
            return false;
        }
        if (!error) {
            $("#action_contact").submit();
        }
    });
});

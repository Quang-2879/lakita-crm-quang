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

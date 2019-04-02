$(function () {
    /*=================================== chia contact đã chọn (form modal)================================================*/
    $("a.divide_contact").click(function (e) {
        e.preventDefault();
        $("#action_contact").removeClass("form-inline");
        $(".divide_multi_contact_modal").modal("show");
    });

    /*=================================== chia từng contact một (form modal)================================================*/
    $(document).on('click', '.divide_one_contact_achor', function (e) {
        e.preventDefault();
        $("#action_contact").removeClass("form-inline");
        var contact_id = $(this).attr("contact_id");
        $(".checked").removeClass("checked");
        $(this).parent().parent().addClass("checked");
        $("#contact_id_input").val(contact_id);
        var contact_name = $(this).attr("contact_name");
        $("span.contact_name").text(contact_name);
        $(".divide_one_contact_modal").modal("show");
    });

    /*=================================== chia đều contact đã chọn ================================================*/
    $(".divide_contact_even").click(function (e) {
        e.preventDefault();
        $("#action_contact").attr("action", $("#base_url").val() + "manager/divide_contact_even");
        $("#action_contact").submit();
    });
});
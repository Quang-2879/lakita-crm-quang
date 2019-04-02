$(".btn-export-excel").on('click', function (e) {
    e.preventDefault();
    $("#action_contact").attr("action", $("#base_url").val() + "cod/export_for_print");
    $("#action_contact").submit();
});
$(".btn-export-excel-for-viettel").on('click',function (e) {
    e.preventDefault();
    $("#action_contact").attr("action", $("#base_url").val() + "cod/export_for_send_provider");
    $("#action_contact").submit();
});

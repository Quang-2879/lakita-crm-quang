$(document).ready(function () {
    $(".btn-export-excel").click(function (e) {
        e.preventDefault();
        $("#action_contact").attr("action", $("#base_url").val() + "cod/export_for_print");
        $("#action_contact").submit();
    });
    $(".btn-export-excel-for-viettel").click(function (e) {
        e.preventDefault();
        $("#action_contact").attr("action", $("#base_url").val() + "cod/export_for_send_provider");
        $("#action_contact").submit();
    });
});
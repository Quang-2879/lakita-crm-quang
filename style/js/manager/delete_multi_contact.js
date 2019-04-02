$(document).ready(function () {
    $("#delete_contact").click(function (e) {
        e.preventDefault();
        var r = confirm("Are you sure?");
        if (r === true) {
            $("#action_contact").attr("action", $("#base_url").val() + "manager/delete_contact");
            $("#action_contact").submit();
        }
    });
});
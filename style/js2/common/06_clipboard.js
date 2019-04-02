$(document).on("click", ".view_contact_phone", function () {
    var textCopy = document.getElementById("input-copy-"+$(this).attr('id-copy'));
    console.log(textCopy);
    textCopy.select();
    document.execCommand('copy');
    $.notify("Copy thành công vào clipboard", {
        position: "bottom left",
        className: 'success',
        showDuration: 200,
        autoHideDelay: 2000
    });
});
$('.export_to_string').on('click', function (e) {
    e.preventDefault();
    var modalName = 'export-to-string-modal';
    $.ajax({
        url: $("#base_url").val() + "cod/export_to_string",
        type: "POST",
        data: $("#action_contact").serialize(),
        success: data => {
            $("." + modalName).remove();
            var newModal = `<div class="${modalName}"></div>`;
            $(".modal-append-to").append(newModal);
            $(`.${modalName}`).html(data);
        },
        complete: () => $(`.${modalName} .modal`).modal("show")
    });
});
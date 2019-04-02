$(document).on('click', 'a.edit_item', function (e) {
    e.preventDefault();
    var item_id = $(this).attr("item_id");
    var url = $(this).attr("edit-url");
    var modalName = $(this).attr("data-modal-name");
    $.ajax({
        url: url,
        type: "POST",
        data: {
            item_id: item_id
        },
        success: function (data) {
            $("." + modalName).remove();
            var newModal = `<div class="${modalName}"></div>`;
            $(".modal-append-to").append(newModal);
            $(`.${modalName}`).html(data);
        },
        complete: function () {
            $(`.${modalName} .modal`).modal("show");
        }
    });
});
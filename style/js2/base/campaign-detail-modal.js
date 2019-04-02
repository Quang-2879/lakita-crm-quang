/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).on('click', '.campaign-detail', function (e) {
    e.preventDefault();
    var url = $(this).attr("data-url");
    var modalName = $(this).attr("data-modal-name");
    $.ajax({
        url: url,
        type: "GET",
        data: {
            campaignId: $(this).attr("campaign-id"),
            campaignName: $(this).text()
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




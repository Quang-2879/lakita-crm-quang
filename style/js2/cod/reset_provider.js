/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(".btn-reset-provider").on('click', function (e) {
    e.preventDefault();
    $("#action_contact").removeClass("form-inline");
    $(".reset_provider_modal").modal("show");
});
$(".btn-reset-provider").on('show.bs.modal', '.modal', function () {
    $("#action_contact").addClass("form-inline");
});


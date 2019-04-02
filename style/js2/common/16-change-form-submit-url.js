/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).on('click', '.change-form-submit-url', function (e) {
    e.preventDefault();
    var form = $(this).data("form-id");
    var action = $(this).data("action");
    var method = $(this).data("method");
    var url = $("#base_url").val() + action;
    $("#" + form).attr("action", url).attr("method", method).submit(); 
});



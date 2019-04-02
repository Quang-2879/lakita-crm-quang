/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var modalName = "navbar-search-modal";
$(function () {
    var locationHash = location.hash;
    if (locationHash.indexOf("search") > -1) {
        var hashSearch = locationHash.substring(1);
        var searchArr = hashSearch.split("=");
        var searchStr = searchArr[1];
        $(".input-navbar-search").val(searchStr);
        $.ajax({
            url: $("#base_url").val() + $("#input_controller").val() + '/search',
            type: "GET",
            data: {
                search_all: searchStr
            },
            success: data => {
                $("." + modalName).remove();
                var newModal = `<div class="${modalName}"></div>`;
                if ($("#action_contact").length) {
                    $("#action_contact").append(newModal);
                } else {
                    $(".modal-append-to").append(newModal);
                }
                $(`.${modalName}`).html(data);
            },
            complete: () => $(`.${modalName} .navbar-search-modal`).modal("show")
        });
    }
});

$(".btn-navbar-search").click(function (e) {
    e.preventDefault();
    if ($(".input-navbar-search").val() == '') {
        $("#send_email_error")[0].play();
        $.notify('Vui lòng nhập nội dung tìm kiếm!', {
            position: "top left",
            className: 'error',
            showDuration: 200,
            autoHideDelay: 7000
        });
        return false;
    }
    var locationOrigin = location.href.split("#");
    location.href = locationOrigin[0] + '#search=' + $(".input-navbar-search").val();
    $.ajax({
        url: $("#base_url").val() + $("#input_controller").val() + '/search',
        type: "GET",
        data: {
            search_all: $(".input-navbar-search").val()
        },
        success: data => {
            $("." + modalName).remove();
            var newModal = `<div class="${modalName}"></div>`;
            if ($("#action_contact").length) {
                $("#action_contact").append(newModal);
            } else {
                $(".modal-append-to").append(newModal);
            }
            $(`.${modalName}`).html(data);
        },
        complete: () => $(`.${modalName} .navbar-search-modal`).modal("show")
    });
});
/*     <a href="#" class="anchor-navbar-search">6899</a> */
$(".anchor-navbar-search").click(function (e) {
    e.preventDefault();
    $.ajax({
        url: $("#base_url").val() + $("#input_controller").val() + '/search',
        type: "GET",
        data: {
            search_all: $.trim($(this).text())
        },
        success: data => {
            $("." + modalName).remove();
            var newModal = `<div class="${modalName}"></div>`;
            if ($("#action_contact").length) {
                $("#action_contact").append(newModal);
            } else {
                $(".modal-append-to").append(newModal);
            }
            $(`.${modalName}`).html(data);
        },
        complete: () => $(`.${modalName} .navbar-search-modal`).modal("show")
    });
});

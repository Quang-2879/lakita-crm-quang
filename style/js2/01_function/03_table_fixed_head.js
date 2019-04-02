/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$.fn.setFixTable = function (_tableID) {
    var cloneHead = $($(this).children()[0]).clone();
    $(this).prepend(cloneHead);
    var fixedHead = $(this).children()[0];
    var originHead = $(this).children()[1];
    $(originHead).addClass("table-head-pos");
    $(fixedHead).addClass("fixed-table").css("display", "none");
    var key = 1;
    $(".table-head-pos>tr>th").each(function () {
        $(this).attr('id', 'th_fix_id_' + key++);
    });
    key = 1;
    $(".fixed-table>tr>th").each(function () {
        $(this).attr('id', 'f_th_fix_id_' + key++);
    });

    $(document).on('scroll', function () {
        if ($(".table-head-pos").length && $("html").scrollTop() > ($(".table-head-pos").offset().top)) {
            $(".fixed-table").css({
                "display": "block"
            });
            $('[id^="th_"]').each(function () {
                var myID = $(this).attr("id");
                var mywidth = $(this).width();
                var myheight = $(this).height();
                $("#f_" + myID).width(mywidth);
                $("#f_" + myID).height(myheight);
            });
        } else {
            $(".fixed-table").css({
                "display": "none"
            });
        }
    });
};




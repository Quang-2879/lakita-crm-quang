$(function () {
   

    /*
     * Real order
     */
    $('th[class^="order_"]').click(function () {
        var myclass = $(this).attr("class");
        myclass = myclass.split(/ /);
        myclass = myclass[0];
        $('input[class^="order_"]').not("input." + myclass).attr('value', '0');
        if ($("input." + myclass).val() === '0')
        {
            $("input." + myclass).attr('value', 'ASC').promise().done(
                    function () {
                        $("#form_item").submit();
                    }
            );
            return;
        }
        if ($("input." + myclass).val() === 'ASC')
        {
            $("input." + myclass).val('DESC').promise().done(
                    function () {
                        $("#form_item").submit();
                    }
            );
            return;
        }
        if ($("input." + myclass).val() === 'DESC')
        {
            $("input." + myclass).val('0').promise().done(
                    function () {
                        $("#form_item").submit();
                    }
            );
            return;
        }

    });

    /*
     * Real filter
     */
    $(".real_filter").on('change', function () {
        $("#form_item").submit();
    });
});

/*
 * Cố định thanh <thead> và phần search của table
 */
$(document).on('scroll', function () {
    /*
     * Khi cuộn chuột quá vị trí của phần thead thì thead ẩn đi và phần thead-fixed hiện lên
     */
    if ($("body").scrollTop() > ($(".table-head-pos").offset().top)) {
        $(".fixed-table").css({
            "display": "block"
        });
    } else {
        $(".fixed-table").css({
            "display": "none"
        });
    }
    /*
     * Điều chỉnh lại kích cỡ của các th phần thead
     */
    $('[id^="th_"]').each(function () {
        var myID = $(this).attr("id");
        var mywidth = $(this).width();
        var myheight = $(this).height();
        $("#f_" + myID).width(mywidth);
        $("#f_" + myID).height(myheight);
    });
    /*
     * Điều chỉnh lại kích cỡ của các td phần tbody (các ô search)
     */
    $('[id^="td_"]').each(function () {
        var myID = $(this).attr("id");
        var mywidth = $(this).width();
        var myheight = $(this).height();
        $("#f_" + myID).width(mywidth);
        $("#f_" + myID).height(myheight);
    });
    /*
     * Căn chỉnh phần search cho khớp xuống dưới phần head 
     * (vì cùng là position fixed nên top mặc định bằn 0 => bị đè vị trí lên nhau)
     */
    $("tbody.fixed-table").css("top", $("thead.fixed-table").height());

    /*
     * Căn chỉnh lại cho thẳng hàng
     */
    var offsetLeft = $(".table-head-pos").offset().left - 1;
    $(".fixed-table").css("left", offsetLeft + "px");
});
$(document).on('scroll', function () {
    if ($("body").scrollTop() > ($(".table-head-pos").offset().top)
            && $("body").scrollTop() < ($(".gr4-table").offset().top + $(".gr4-table").height() - $(".table-head-pos").height() + 100)) {
        $(".fixed-table").css({
            "display": "block"
        });
    } else {
        $(".fixed-table").css({
            "display": "none"
        });
    }
    $('[class^="staff_"]').each(function () {
        var myClass = $(this).attr("class");
        var mywidth = $(this).width();
        var myheight = $(this).height();
        $(".f_" + myClass).width(mywidth);
        $(".f_" + myClass).height(myheight);
    });
    var offsetLeft = $(".table-head-pos").offset().left + 2;
    $("table thead.fixed-table").css("left", offsetLeft + "px");
}).ready(function(){
     $("input.reset_form").click(function (e) {
        e.preventDefault();
        $('option[value=0]').attr('selected', 'selected');
        $('option[value="empty"]').attr('selected', 'selected');
        $(".datepicker").val('');
        $("input[type='text']").val('');
       // $("#action_contact option:selected").prop("selected", false);
        $('.selectpicker').selectpicker('deselectAll');
    });
});


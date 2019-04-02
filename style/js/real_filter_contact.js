$(document).ready(function () {
    $("input.filter_contact").click(function (e) {
        e.preventDefault();
        $("#action_contact").attr("action", "#").attr("method", "GET");
        $("#action_contact").submit();
    });
    $("input.reset_form").click(function (e) {
        e.preventDefault();
        $('option[value=0]').attr('selected', 'selected');
        $('option[value="empty"]').attr('selected', 'selected');
        $(".datepicker").val('');
        $("input[type='text']").val('');
       // $("#action_contact option:selected").prop("selected", false);
        $('.selectpicker').selectpicker('deselectAll');
    });
    $('select.filter').on('change', function (e) {
        e.preventDefault();
        $("#action_contact").attr("action", "#").attr("method", "GET");
        $("#action_contact").submit();
    });

    /*========================= SORT =================================*/
    $('th[class^="order_"]').click(function () {
        var myclass = $(this).attr("class");
        myclass = myclass.split(/ /);
        myclass = myclass[0];
        $('input[class^="order_"]').not("input." + myclass).attr('value', '0');
        if ($("input." + myclass).val() === '0')
        {
            $("input." + myclass).attr('value', 'ASC').promise().done(
                    function () {
                        $("#action_contact").attr("action", "#").attr("method", "GET");
                        $("#action_contact").submit();
                    }
            );
            return;
        }
        if ($("input." + myclass).val() === 'ASC')
        {
            $("input." + myclass).val('DESC').promise().done(
                    function () {
                        $("#action_contact").attr("action", "#").attr("method", "GET");
                        $("#action_contact").submit();
                    }
            );
            return;
        }
        if ($("input." + myclass).val() === 'DESC')
        {
            $("input." + myclass).val('0').promise().done(
                    function () {
                        $("#action_contact").attr("action", "#").attr("method", "GET");
                        $("#action_contact").submit();
                    }
            );
            return;
        }

    });
});

$(function () {
    setTimeout(function () {
        if ($(".filter-tbl-1").height() > $(".filter-tbl-2").height())
        {
            $(".filter-tbl-2").height($(".filter-tbl-1").height());
        } else
        {
            $(".filter-tbl-1").height($(".filter-tbl-2").height());
        }
    }, 100);
});

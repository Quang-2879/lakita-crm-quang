$(function () {

    /*
     * Sửa lại link phân trang nếu có các thao tác lọc, tìm kiếm, sắp xếp
     */
//    if (location.search !== "") {
//        $(".pagination a").each(
//                function () {
//                    var curr_href = $(this).attr("href");
//                    $(this).attr('href', curr_href + location.search);
//                });
//    }

    /*
     * Hiển thị datepicker và selectpicker khi modal edit item đc bật lên
     */



    /*===================================== trờ về trang trước ========================================*/
//    $("input[name='back_location']").val(document.referrer);
//    $(".back_location").click(function () {
//        location.href = document.referrer;
//    });



    /*
     * Thêm hiệu ứng khi hover vào dropdown bootstrap 
     */
    $('.dropdown-hover').hover(function () {
        $(this).find('.dropdown-menu').stop(true, true).fadeIn(200);
        $(this).find('.child_menu').stop(true, true).fadeIn(200);
    }, function () {
        $(this).find('.dropdown-menu').stop(true, true).fadeOut(200);
        $(this).find('.child_menu').stop(true, true).fadeOut(200);
    });

    /*
     * Sửa lại value của thẻ input curr_url
     */
    $("#curr_url").val(location.href);

    /*
     * Nếu click vào nút filter nâng cao thì đổi icon
     */
    $(document).on('click', '.show-more-table-info', function (e) {
        e.stopPropagation();
        let contactId = $(this).attr('contact-id');
        $("#" + contactId).toggle("slow");
        let isHide = $(this).attr('is-hide');
        if (isHide == '1') {
            $(this).attr('is-hide', '0');
            $(this).html('<i class="fa fa-minus-circle" aria-hidden="true"></i>');
        } else {
            $(this).attr('is-hide', '1');
            $(this).html('<i class="fa fa-plus-circle" aria-hidden="true"></i>');
        }
        console.log(1);
    });

    /*
     * Nếu filter nâng cao được mở ra thì điều chỉnh chiều cao 2 cột bằng nhau
     */
    $('#collapse-filter').on('shown.bs.collapse', function () {
        $(this).prev().find(".fa").removeClass("fa-arrow-circle-down").addClass("fa-arrow-circle-up");
        if ($(".filter-tbl-1").height() > $(".filter-tbl-2").height())
        {
            $(".filter-tbl-2").height($(".filter-tbl-1").height());
        } else
        {
            $(".filter-tbl-1").height($(".filter-tbl-2").height());
        }
    });
    $('#collapse-filter').on('hidden.bs.collapse', function () {
        $(this).prev().find(".fa").removeClass("fa-arrow-circle-up").addClass("fa-arrow-circle-down");
    });
    /*
     * Kiểm tra xem có biến search là view_detail_contact không, nếu có sẽ hiển thị chi tiết contact
     */
    let searchParams = new URLSearchParams(window.location.search);
    if (searchParams.has('view_detail_contact')) {
        var contatctID = $.trim(searchParams.get('view_detail_contact'));
        $(".view-detail-contact-by-get-url").remove();
        $('body').append(`<a href="#" 
                               class="ajax-request-modal view-detail-contact-by-get-url"
                               data-contact-id ="${contatctID}"
                               data-modal-name="view-detail-contact-div"
                               data-url="common/view_detail_contact">`);
        $(".view-detail-contact-by-get-url").click();
        $(".view-detail-contact-by-get-url").remove();
    }
});

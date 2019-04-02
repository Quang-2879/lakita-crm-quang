$(function () {

    $(".datepicker").datepicker(
            {
                dateFormat: "dd-mm-yy"
            }
    );

    /*
     * Sửa lại link phân trang nếu có các thao tác lọc, tìm kiếm, sắp xếp
     */
    if (location.search !== "") {
        $(".pagination a").each(
                function () {
                    var curr_href = $(this).attr("href");
                    $(this).attr('href', curr_href + location.search);
                });
    }

    /*
     * Hiển thị datepicker và selectpicker khi modal edit item đc bật lên
     */
    $('.modal').on('shown.bs.modal', function () {
        $('.selectpicker').selectpicker({});
        $(".datepicker").datepicker({dateFormat: "dd-mm-yy"});
        $(".reset_datepicker").click(function (e) {
            e.preventDefault();
            $(".datepicker").val("");
        });
    });

    /*
     * Khi check vào 1 item nào đó sẽ đánh dấu item đó (hiện màu xanh)
     */
    $(document).on('change', 'input[type="checkbox"]', function () {
        if (this.checked) {
            $(this).parent().parent().addClass('checked');
        } else {
            $(this).parent().parent().removeClass('checked');
        }
        /*
         * Hiển thị số lượng dòng đã check
         */
        var numberOfChecked = $('input:checkbox:checked').length;
        var totalCheckboxes = $('input:checkbox').length;
        $(this).notify('Đã chọn: ' + numberOfChecked + '/' + totalCheckboxes, {
            position: "right middle",
            className: 'success',
            showDuration: 200,
            autoHideDelay: 1000
        });
    });
    /*===================================== trờ về trang trước ========================================*/
    $("input[name='back_location']").val(document.referrer);
    $(".back_location").click(function () {
        location.href = document.referrer;
    });


    /*======================= reset datepicker ========================================================*/
    $(".reset_datepicker").click(function (e) {
        e.preventDefault();
        $("#datepicker").val("");
    });

    /*
     * Chỉnh lại giao diện gốc
     */
    if ($("li.current-page").parent().hasClass("child_menu")) {
        $("li.current-page").parent().css("display", 'none');
    }
    if ($("li.active").parent().hasClass("side-menu")) {
        $(this).removeClass("active");
    }

    /*=============================chọn tất cả  ===========================================*/
    var checked = true;
    $(".check_all").css("cursor", "pointer").click(function () {
        checked = !checked;
        if (checked) {
            $(".list_contact input[type='checkbox']").each(
                    function () {
                        $(this).prop("checked", false);
                        $(this).parent().parent().removeClass('checked');
                    }
            );
        } else {
            $(".list_contact input[type='checkbox']").each(
                    function () {
                        $(this).prop("checked", true);
                        $(this).parent().parent().addClass('checked');
                    }
            );
        }
    });

    /*
     * Thêm hiệu ứng khi ấn vào dropdown bootstrap
     */
    $('.dropdown-toggle').parent().on('show.bs.dropdown', function () {
        $(this).find('.dropdown-menu').first().stop(true, true).slideDown();
    });

    $('.dropdown-toggle').parent().on('hide.bs.dropdown', function () {
        $(this).find('.dropdown-menu').first().stop(true, true).slideUp();
    });

    /*
     * Hiển thị tên khóa học khi click vào mã khóa học
     */
    $(document).on('click', '.find-course-code', function () {
        var _this = $(this);
        $.ajax({
            url: $("#base_url").val() + "common/find_course_name",
            type: 'POST',
            data: {course_code: $(this).text().trim()},
            success: function (data, textStatus, jqXHR) {
                if (_this.parent().attr('class') === 'view_course_code') {
                    _this.notify(data, {
                        position: "top left",
                        className: 'success',
                        showDuration: 200,
                        autoHideDelay: 4000
                    });
                } else {
                    _this.notify(data, {
                        position: "top center",
                        className: 'success',
                        showDuration: 200,
                        autoHideDelay: 4000
                    });
                }
            }
        });
    });

    /*
     * Sửa lại value của thẻ input curr_url
     */
    $("#curr_url").val(location.href);

    /*
     * Hiển thị menu chuột phải
     */
    $("tr.custom_right_menu").on(
            {
                contextmenu: function (e) {
                    e.preventDefault();
                    /*
                     * Lấy các thuộc tính của contact
                     */
                    var contact_id = ($(this).attr('contact_id'));
                    var contact_name = $(this).attr('contact_name');
                    var duplicate_id = $(this).attr("duplicate_id");

                    /*
                     * Nếu contact trùng thì ẩn tính năng bàn giao contact
                     */
                    if (duplicate_id > 0) {
                        $("a.view_duplicate").removeClass("hidden");
                        $("a.view_duplicate").attr("duplicate_id", duplicate_id);
                        $(".divide_one_contact_achor").addClass('hidden');
                    }
                    /*
                     * Nếu contact không trùng thì ẩn tính năng xem contact trùng
                     */
                    else {
                        $(".divide_one_contact_achor").removeClass('hidden');
                        $(".divide_one_contact_achor").attr('contact_id', contact_id);
                        $(".divide_one_contact_achor").attr('contact_name', contact_name);
                        $("a.view_duplicate").addClass("hidden");
                    }
                    $(".action_view_detail_contact").attr('contact_id', contact_id);
                    var menu = $(".menu");
                    menu.hide();
                    var pageX = e.pageX;
                    var pageY = e.pageY;
                    menu.css({top: pageY, left: pageX});
                    var mwidth = menu.width();
                    var mheight = menu.height();
                    var screenWidth = $(window).width();
                    var screenHeight = $(window).height();
                    var scrTop = $(window).scrollTop();
                    /*
                     * Nếu "tọa độ trái chuột" + "chiều dài menu" > "chiều dài trình duyệt" 
                     * thì hiển thị sang bên phải tọa độ click
                     */
                    if (pageX + mwidth > screenWidth) {
                        menu.css({left: pageX - mwidth});
                    }
                    /*
                     * Nếu "tọa độ top chuột" + "chiều cao menu" > "chiều cao trình duyệt" + "chiều dài cuộn chuột"
                     * thì hiển thị lên trên tọa độ click
                     */
                    if (pageY + mheight > screenHeight + scrTop) {
                        menu.css({top: pageY - mheight});
                    }
                    menu.show();
                    /*
                     * Nếu dòng đó đang không chọn (đã click trái) thì bỏ chọn và bỏ check những dòng đã chọn
                     */
                    var is_checked_input = $(this).find('input[type="checkbox"]');
                    if (!is_checked_input[0].checked) {
                        $(".checked").removeClass("checked");
                        uncheck_checked();
                    } else {
                        unselect_not_checked();
                    }
                    $(this).addClass('checked'); /*.find('[name="contact_id[]"]').prop('checked', true); */
                },
                click: function () {
                    if ($(this).hasClass('checked')) {
                        $(this).removeClass('checked');
                    } else {
                        $(this).addClass('checked');
                    }
                    var input_checkbox = $(this).find('[name="contact_id[]"]');
                    if (input_checkbox.is(":checked")) {
                        input_checkbox.prop('checked', false);
                    } else {
                        input_checkbox.prop('checked', true);
                    }
                    unselect_not_checked();
                }
            });
    $("html").on("click", function (e) {
        $(".menu").hide();
        /*
         * Nếu click ra ngoài bảng thì bỏ chọn các contact
         */
        if (e.target.className.indexOf("form-inline") !== -1 || e.target.className.indexOf("number_paging") !== -1)
        {
            $("input[type='checkbox']").prop('checked', false);
            $('.checked').removeClass('checked');
        }

    });
});


function unselect_not_checked() {
    $('input[type="checkbox"]').each(
            function () {
                if (!$(this).is(":checked")) {
                    $(this).parent().parent().removeClass('checked');
                }
            });
}

function unselect_checked() {
    $('input[type="checkbox"]').each(
            function () {
                if ($(this).is(":checked")) {
                    $(this).parent().parent().removeClass('checked');
                }
            });
}
function uncheck_checked() {
    $('input[type="checkbox"]').each(
            function () {
                if ($(this).is(":checked")) {
                    $(this).prop("checked", false);
                }
            });
}
function uncheck_not_checked() {
    $('input[type="checkbox"]').each(
            function () {
                if (!$(this).is(":checked")) {
                    $(this).prop("checked", false);
                }
            });
}



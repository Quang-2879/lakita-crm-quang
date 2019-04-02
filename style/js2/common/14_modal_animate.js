/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/*
 $('.modal').on('hide.bs.modal', function () {
 if ($(this).find(".modal-dialog").attr('class').search('btn-very-lg') != -1) {
 $(this).find(".modal-dialog").attr('class', 'modal-dialog fadeOut animated btn-very-lg');
 } else if ($(this).find(".modal-dialog").attr('class').search('modal-lg') != -1) {
 $(this).find(".modal-dialog").attr('class', 'modal-dialog fadeOut animated modal-lg');
 } else {
 $(this).find(".modal-dialog").attr('class', 'modal-dialog fadeOut animated');
 }
 });
 $('.modal').on('show.bs.modal', function () {
 if ($(this).find(".modal-dialog").attr('class').search('btn-very-lg') != -1) {
 $(this).find(".modal-dialog").attr('class', 'modal-dialog fadeIn animated btn-very-lg');
 } else if ($(this).find(".modal-dialog").attr('class').search('modal-lg') != -1) {
 $(this).find(".modal-dialog").attr('class', 'modal-dialog fadeIn animated modal-lg');
 } else {
 $(this).find(".modal-dialog").attr('class', 'modal-dialog fadeIn animated');
 }
 var zIndex = 1040 + (10 * $('.modal:visible').length);
 $(this).css('z-index', zIndex);
 setTimeout(function () {
 $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
 }, 0);
 });
 */
$(document).on('hide.bs.modal', '.navbar-search-modal', function () {
    $('.navbar-search-modal').remove();
});
$(document).on('hide.bs.modal', '.view-all-contact-courses-modal', function () {
    $('.view-all-contact-courses-modal').remove();
});


$(document).on('hide.bs.modal', '.modal', function () {
    if ($(this).find(".modal-dialog").attr('class').search('btn-very-lg') != -1) {
        $(this).find(".modal-dialog").attr('class', 'modal-dialog fadeOut animated btn-very-lg');
    } else if ($(this).find(".modal-dialog").attr('class').search('modal-lg') != -1) {
        $(this).find(".modal-dialog").attr('class', 'modal-dialog fadeOut animated modal-lg');
    } else {
        $(this).find(".modal-dialog").attr('class', 'modal-dialog fadeOut animated');
    }
});
$(document).on('show.bs.modal', '.modal', function () {
    /*
     * Nạp lại các date picker
     */
    $('.selectpicker').selectpicker({});
    $(".datepicker").datepicker({dateFormat: "dd-mm-yy"});
    $(".reset_datepicker").click(function (e) {
        e.preventDefault();
        $(".datepicker").val("");
        $(".datetimepicker").val('');
    });
    $('.datetimepicker').datetimepicker(
            {
                format: 'DD-MM-YYYY HH:mm'
            });
    if ($("select.edit_payment_method_rgt").val() != 2) {
        $(".tbl_bank").hide();
    }
    if ($("select.edit_payment_method_rgt").val() != 1) {
        $(".tbl_cod").hide();
    }
    setTimeout(function () {
        setEqualTableHeight();
    }, 1000);
    if ($(this).find(".modal-dialog").attr('class').search('btn-very-lg') != -1) {
        $(this).find(".modal-dialog").attr('class', 'modal-dialog fadeIn animated btn-very-lg');
    } else if ($(this).find(".modal-dialog").attr('class').search('modal-lg') != -1) {
        $(this).find(".modal-dialog").attr('class', 'modal-dialog fadeIn animated modal-lg');
    } else {
        $(this).find(".modal-dialog").attr('class', 'modal-dialog fadeIn animated');
    }
    var zIndex = 1040 + (10 * $('.modal:visible').length);
    $(this).css('z-index', zIndex);
    setTimeout(function () {
        $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
    }, 0);
});




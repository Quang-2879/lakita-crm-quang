$(".datepicker").datepicker(
        {
            dateFormat: "dd-mm-yy"
        }
);

/*
 * 
 * Tham khảo http://www.daterangepicker.com/#usage
 */
var d = new Date();
var currDate = d.getDate() + '-' + (d.getMonth() + 1) + '-' + d.getFullYear();
var pastDate = d.getDate() + '-' + d.getMonth() + '-' + d.getFullYear();
$(".daterangepicker").daterangepicker({
    "autoApply": true,
    autoUpdateInput: false,
    locale: {
        format: 'DD/MM/YYYY',
        cancelLabel: 'Clear'
    },
    ranges: {
        'Hôm nay': [moment(), moment()],
        'Hôm qua': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        '7 ngày vừa qua': [moment().subtract(6, 'days'), moment()],
        '30 ngày vừa qua': [moment().subtract(29, 'days'), moment()],
        'Tuần này': [moment().startOf('isoWeek'), moment().endOf('isoWeek')],
        'Tuần trước': [moment().subtract(1, 'weeks').startOf('isoWeek'), moment().subtract(1, 'weeks').endOf('isoWeek')],
        'Tháng này': [moment().startOf('month'), moment().endOf('month')],
        'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    "alwaysShowCalendars": true,
//    "startDate": pastDate,
//    "endDate": currDate
}).on({
    'apply.daterangepicker': function (ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
    },
    'cancel.daterangepicker': function (ev, picker) {
        $(this).val('');
    }
});

$(".daterangepicker2").daterangepicker({
    "timePicker24Hour": true,
     timePicker: true,
    "autoApply": true,
    autoUpdateInput: false,
    locale: {
        format: 'DD/MM/YYYY H:mm',
        cancelLabel: 'Clear'
    },
    ranges: {
        'Hôm nay': [moment(), moment()],
        'Hôm qua': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        '7 ngày vừa qua': [moment().subtract(6, 'days'), moment()],
        '30 ngày vừa qua': [moment().subtract(29, 'days'), moment()],
        'Tuần này': [moment().startOf('isoWeek'), moment().endOf('isoWeek')],
        'Tuần trước': [moment().subtract(1, 'weeks').startOf('isoWeek'), moment().subtract(1, 'weeks').endOf('isoWeek')],
        'Tháng này': [moment().startOf('month'), moment().endOf('month')],
        'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    "alwaysShowCalendars": true,
//    "startDate": pastDate,
//    "endDate": currDate
}).on({
    'apply.daterangepicker': function (ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY H:mm') + ' - ' + picker.endDate.format('DD/MM/YYYY H:mm'));
    },
    'cancel.daterangepicker': function (ev, picker) {
        $(this).val('');
    }
});

/*======================= reset datepicker ========================================================*/
$(".reset_datepicker").click(function (e) {
    e.preventDefault();
    $("#datepicker").val("");
});
$(document).on('focus', '.datepicker', function(){
    $(this).addClass('zindex1');
});
$(document).on('blur', '.datepicker', function(){
    $(this).removeClass('zindex1');
});
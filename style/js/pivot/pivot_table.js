/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function () {
    var sum = $.pivotUtilities.aggregatorTemplates.sum;
    var numberFormat = $.pivotUtilities.numberFormat;
    var intFormat = numberFormat({digitsAfterDecimal: 0});
    var renderers = $.extend(
            $.pivotUtilities.renderers,
            $.pivotUtilities.c3_renderers,
            $.pivotUtilities.d3_renderers,
            $.pivotUtilities.export_renderers
            );

    $.ajax({
        url: $("#base_url").val() + "report/json_pivot_table_2",
        type: "GET",
        data: $("#action_contact").serialize(),
        dataType: "json",
        success: function (mps) {
            console.log(mps);
            $("#output").pivot(mps, {
                renderers: renderers,
                rows: ["Ngày đăng ký"],
                cols: ["TVTS"],
                vals: ["Giá mua khóa học"],
                aggregator: sum(intFormat)(["Giá mua khóa học"])
            });
            $("#output-2").pivot(mps, {
                renderers: renderers,
                rows: ["Ngày đăng ký"],
                cols: ["Mã khóa học"],
                aggregator: sum(intFormat)(["Giá mua khóa học"])
            });
        }
    });
//    $.getJSON(, function (mps) {
//        console.log(mps);
//        $("#output").pivot(mps, {
//            renderers: renderers,
//            rows: ["TVTS"],
//            cols: ["Ngày đăng ký"],
//            vals: ["Giá mua khóa học"],
//            filter: function (record) {
//                return record["L8"] > 0;
//            },
//            aggregator: sum(intFormat)(["Giá mua khóa học"])
//        });
//        $("#output-2").pivot(mps, {
//            renderers: renderers,
//            rows: ["Mã khóa học"],
//            cols: ["Ngày đăng ký"],
//            filter: function (record) {
//                return record["L8"] > 0;
//            },
//            aggregator: sum(intFormat)(["Giá mua khóa học"])
//        });
//    }, false, "fr");

//  $.ajax({
//        url: $("#base_url").val() + "report/json_pivot_table",
//        type: "GET",
//        data: $("#action_contact").serialize(),
//        dataType: "json",
//        success: function (mps) {
//            console.log(mps);
//            $("#output").pivot(mps, {
//                renderers: renderers,
//                rows: ["TVTS"],
//                cols: ["Ngày đăng ký"],
//                vals: ["Giá mua khóa học"],
//                filter: function (record) {
//                    return record["L8"] > 0;
//                },
//                aggregator: sum(intFormat)(["Giá mua khóa học"])
//            });
//            $("#output-2").pivot(mps, {
//                renderers: renderers,
//                rows: ["Mã khóa học"],
//                cols: ["Ngày đăng ký"],
//                filter: function (record) {
//                    return record["L8"] > 0;
//                },
//                aggregator: sum(intFormat)(["Giá mua khóa học"])
//            });
//        }
//    });
});

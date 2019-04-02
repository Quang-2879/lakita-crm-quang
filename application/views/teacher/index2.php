<!DOCTYPE html>
<html>
    <head>
        <title>Pivot Demo</title>
        <!-- external libs from cdnjs -->
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.min.css">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.min.js"></script>
        <!-- PivotTable.js libs from ../dist -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>style/js/common/pivot.css">
        <script type="text/javascript" src="<?php echo base_url(); ?>style/js/common/pivot.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>style/js/common/export_renderers.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>style/js/common/d3_renderers.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>style/js/common/c3_renderers.js"></script>
        <style>
            body {font-family: Verdana;}
            .node {
                border: solid 1px white;
                font: 10px sans-serif;
                line-height: 12px;
                overflow: hidden;
                position: absolute;
                text-indent: 2px;
            }
            .c3-line, .c3-focused {stroke-width: 3px !important;}
            .c3-bar {stroke: white !important; stroke-width: 1;}
            .c3 text { font-size: 12px; color: grey;}
            .tick line {stroke: white;}
            .c3-axis path {stroke: grey;}
            .c3-circle { opacity: 1 !important; }
            .c3-xgrid-focus {visibility: hidden !important;}
        </style>

        <!-- optional: mobile support with jqueryui-touch-punch -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <!-- for examples only! script to show code to user -->
<!--        <script type="text/javascript" src="show_code.js"></script>-->
    </head>
    <body>
        <script type="text/javascript">
            $(function () {
                var sum = $.pivotUtilities.aggregatorTemplates.sum;
                 var count = $.pivotUtilities.aggregatorTemplates.count;
                var numberFormat = $.pivotUtilities.numberFormat;
                var intFormat = numberFormat({digitsAfterDecimal: 0});
                var derivers = $.pivotUtilities.derivers;
                var renderers = $.extend(
                        $.pivotUtilities.renderers,
                        $.pivotUtilities.c3_renderers,
                        $.pivotUtilities.d3_renderers,
                        $.pivotUtilities.export_renderers
                        );
                $.ajax({
                    url: "ViewReport",
                    type: "GET",
                    data: $("#action_contact").serialize(),
                    dataType: "json",
                    success: function (mps) {
                        console.log(mps);
                        $("#output").pivot(mps, {
                            renderers: renderers,
                            rows: ["Mã khóa học", "Giá mua khóa học"],
//                           cols: [sum(intFormat)(["Giá mua khóa học"]), count(intFormat)(["Giá mua khóa học"])],
                             vals: [ count(intFormat)(["Giá mua khóa học"])],
  //                          aggregatorName: [sum(intFormat)(["Giá mua khóa học"]), count(intFormat)(["Giá mua khóa học"])]
                        });
                    }
                });
                /* $.getJSON("<?php echo base_url(); ?>public/mps.json", function (mps) {
                 $("#output").pivotUI(mps, {
                 renderers: renderers,
                 derivedAttributes: {
                 "Age Bin": derivers.bin("Age", 10),
                 "Gender Imbalance": function (mp) {
                 return mp["Gender"] == "Male" ? 1 : -1;
                 }
                 },
                 cols: ["Age Bin"], rows: ["Gender"],
                 rendererName: "Table Barchart"
                 });
                 }); */
            });

            /* $.getJSON("<?php echo base_url(); ?>public/mps.json", function (mps) {
             $("#output").pivotUI(mps, {
             renderers: renderers,
             derivedAttributes: {
             "Age Bin": derivers.bin("Age", 10),
             "Gender Imbalance": function (mp) {
             return mp["Gender"] == "Male" ? 1 : -1;
             }
             },
             cols: ["Age Bin"], rows: ["Gender"],
             rendererName: "Table Barchart"
             });
             }); */


        </script>


        <div id="output" style="margin: 30px;"></div>
    </body>
</html>

<!DOCTYPE html>
<html>
    <head>
        <title>Pivot Demo</title>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="https://cdn.flexmonster.com/flexmonster.js"></script>
    </head>
    <body>
        <script type="text/javascript">
            $(function () {
                $.getJSON("json_pivot_table", function (mps) {

                    var pivot = new Flexmonster({
                        container: "pivot-container",
                        componentFolder: "https://cdn.flexmonster.com/",
                        toolbar: true,
                        report: {
                            dataSource: {
                                data: mps
                            },
                            slice: {
                                rows: [{
                                        uniqueName: "TVTS"
                                    }],
                                columns: [{
                                        uniqueName: "Tháng đăng ký.Month"
                                    }],
                                measures: [
                                    {uniqueName: "C3", aggregation: "count"}
                                ]
                            },
                            "options": {
                                "chart": {
                                    "type": "bar",
                                    "title": "",
                                    "showFilter": true,
                                    "multipleMeasures": false,
                                    "oneLevel": false,
                                    "autoRange": false,
                                    "reversedAxes": false,
                                    "showLegendButton": false,
                                    "showAllLabels": true,
                                    "showMeasures": true,
                                    "showOneMeasureSelection": true,
                                    "showWarning": true,
                                    "activeMeasure": ""
                                }
                            }
                        },
                        licenseKey: "Z7W6-XD655C-28512G-4S5H0U"
                    });
                });
            });

        </script>
        <div id="pivot-container"></div>
        <div id="pivot-container-1"></div>

        <script>
            $(function () {
                setInterval(function () {
                    $('#fm-pivot-view > div[class="fm-ui-element fm-ui fm-noselect"]').hide();
                }, 1000);
            });
        </script>
    </body>
</html>

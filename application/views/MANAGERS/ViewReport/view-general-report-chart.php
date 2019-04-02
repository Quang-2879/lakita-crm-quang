<div class="row">
    <div id="chart_div" style="width: 100%; height: 500px;"></div>
    <div id="chart-div-luy-ke" style="width: 100%; height: 500px;"></div>
    <?php
    foreach ($marketers as $marketer) {
        echo '<div id="chart-div-' . $marketer['username'] . '" style="width: 100%; height: 500px;"></div>';
    }
    ?>

</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {packages: ["corechart"]});
    google.charts.setOnLoadCallback(drawChart);
    google.charts.setOnLoadCallback(drawChartLuyKe);
<?php
foreach ($marketers as $marketer) {
    echo 'google.charts.setOnLoadCallback(drawChart' . $marketer['username'] . ');';
}
?>
    function drawChart() {
        var data = google.visualization.arrayToDataTable
                ([['X', 'Thực đạt', 'KPI', 'Tháng trước'],
                    <?php
                    foreach ($period as $dayName => $type) {
                        echo "['$dayName', ". $type['C3ThisMonth'] . ", " . MARKETING_KPI_PER_DAY. "," . $type['C3LastMonth'] . "],";
                    }
                    ?>
                ]);
        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            {calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"},
            2, 3]);
        var options = {
            title: 'BÁO CÁO MARKETING HÀNG NGÀY',
            vAxis: {title: 'Số C3'},
            hAxis: {title: 'Ngày trong tháng'},
            series: {
                0: {type: 'bars'},
                1: {type: 'lines'},
                2: {type: 'lines'}
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(view, options);
    }

    function drawChartLuyKe() {
        var data = google.visualization.arrayToDataTable
                ([['X', 'Thực đạt', 'KPI', 'Tháng trước'],
                    <?php
                    foreach ($luyKe as $dayName => $number) {
                        echo "['$dayName', " . $number['C3ThisMonth'] . ", " . $number['KPI'] . ", " . $number['C3LastMonth'] ."],";
                    }
                    ?>
                ]);
        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            
            2, 3]);
        var options = {
            title: 'BÁO CÁO MARKETING LŨY KẾ',
            vAxis: {title: 'Số C3'},
            hAxis: {title: 'Ngày trong tháng'},
            series: {
                0: {type: 'bars'},
                1: {type: 'lines'},
                2: {type: 'lines'}
            }
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart-div-luy-ke'));
        chart.draw(view, options);
    }

<?php foreach ($marketers as $marketer) { ?>

        function drawChart<?php echo $marketer['username']; ?>() {
            var data = google.visualization.arrayToDataTable
                    ([['X', 'Thực đạt', 'KPI'],
                        <?php
                        foreach ($marketer['Number'] as $dayName => $number) {
                            echo "['$dayName', " . $number['C3'] . ", " . $number['KPI'] . "],";
                        }
                        ?>
                    ]);
            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                {calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation"},
                2]);
            var options = {
                title: 'BÁO CÁO MARKETING <?php echo mb_strtoupper(html_entity_decode($marketer['name'])); ?>',
                vAxis: {title: 'Số C3'},
                hAxis: {title: 'Ngày trong tháng'},
                series: {
                    0: {type: 'bars'},
                    1: {type: 'lines'}
                }
            };

            var chart = new google.visualization.LineChart(document.getElementById('chart-div-<?php echo $marketer['username'] ?>'));
            chart.draw(view, options);
        }


<?php } ?>

</script>

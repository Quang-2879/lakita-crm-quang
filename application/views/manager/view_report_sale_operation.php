<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<form action="#" method="GET" id="action_contact" class="form-inline">
    <?php $this->load->view('common/content/filter'); ?>
</form>

<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Doanh thu</h3>
            </div>
            <div class="panel-body">
                <?php echo number_format(str_replace('.', '', $total['revenue'])) . ' VNĐ' ?>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Tổng L1</h3>
            </div>
            <div class="panel-body">
                <?php echo $total['L1'] ?>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Tổng L8</h3>
            </div>
            <div class="panel-body">
                <?php echo $total['L8'] ?>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Giá L8</h3>
            </div>
            <div class="panel-body">
                <?php echo $total['priceL8'] ?>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Tỷ lệ L8/L1</h3>
            </div>
            <div class="panel-body">
                <?php echo $total['L8/L1'] ?>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Tỷ lệ L6/L2</h3>
            </div>
            <div class="panel-body">
                <?php echo $total['L6/L2'] ?>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Tỷ lệ L2/L1</h3>
            </div>
            <div class="panel-body">
                <?php echo $total['L2/L1'] ?>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title">Tỷ lệ L8/L6</h3>
            </div>
            <div class="panel-body">
                <?php echo $total['L8/L6'] ?>
            </div>
        </div>
    </div>
</div>

<div id="chart_div" style="width: 100%; height: 500px;"></div>
<div id="chart_l8" style="width: 100%; height: 500px;"></div>
<div id="chart_percent" style="width: 100%; height: 500px;"></div>
<script>
    $(document).ready(function () {

        google.charts.load('current', {'packages': ['line', 'corechart']});
        google.charts.setOnLoadCallback(drawChart);
        google.charts.setOnLoadCallback(drawL8);
        google.charts.setOnLoadCallback(drawPercent);


        function drawChart() {
            var chartDiv = document.getElementById('chart_div');
            var data = new google.visualization.DataTable();
            data.addColumn('date', 'day');
            data.addColumn('number', 'Doanh thu');
            data.addRows([
<?php
foreach ($per_day as $key => $value) {
    $date = explode('/', $key);
    echo "[new Date(" . $date[2] . ", " . $date[1] . "," . $date[0] . ")," . $report3['L7L8'][$key]['value'] . "],";
}
?>
            ]);

            var materialOptions = {
                series: {
                    0: {axis: 'revenue', type: 'bars'}

                },
                axes: {
                    y: {
                        revenue: {label: 'Doanh thu'}
                    }
                }
            };
            function drawMaterialChart() {
                var materialChart = new google.visualization.ComboChart(chartDiv);
                materialChart.draw(data, materialOptions);
            }
            drawMaterialChart();
        }

        function drawL8() {
            var drawL8 = document.getElementById('chart_l8');
            var data = new google.visualization.DataTable();
            data.addColumn('date', 'day');
            data.addColumn('number', 'Số lượng L8');
            data.addColumn('number', 'Số lượng L1');
            data.addRows([
<?php
foreach ($per_day as $key => $value) {
    $date = explode('/', $key);
    echo "[new Date(" . $date[2] . ", " . $date[1] . "," . $date[0] . ")," . $report3['L8'][$key]['value'] . "," . $report3['L1'][$key]['value'] . "],";
}
?>
            ]);

            var materialOptions = {
                series: {
                    0: {axis: 'percent', type: 'bars'},
                    1: {axis: 'percent', type: 'bars'}
                },
                axes: {
                    y: {
                        percent: {label: 'Số lượng'}
                    }
                }
            };
            function drawMaterialChart() {
                var materialChart = new google.visualization.ComboChart(drawL8);
                materialChart.draw(data, materialOptions);
            }
            drawMaterialChart();
        }

        function drawPercent() {
            var chartpercent = document.getElementById('chart_percent');
            var data = new google.visualization.DataTable();
            data.addColumn('date', 'day');
            data.addColumn('number', 'L8/L1');
            data.addColumn('number', 'L6/L2');
            data.addColumn('number', 'L2/L1');
            data.addColumn('number', 'L8/L6');
            data.addRows([
<?php
foreach ($per_day as $key => $value) {
    $date = explode('/', $key);

    echo "[new Date(" . $date[2] . ", " . $date[1] . "," . $date[0] . ")," . $report3['L8/L1'][$key]['value'] . "," . $report3['L6/L2'][$key]['value'] . "," . $report3['L2/L1'][$key]['value'] . "," . $report3['L8/L6'][$key]['value'] . "],";
}
?>
            ]);

            var options = {
                series: {
                    0: {axis: 'percent', type: 'line'}
                },
                axes: {
                    y: {
                        percent: {label: '%'}
                    }
                }
            };
            function drawMaterialChart() {
                var materialChart = new google.visualization.ComboChart(chartpercent);
                materialChart.draw(data, options);
            }
            drawMaterialChart();
        }

    });

</script>
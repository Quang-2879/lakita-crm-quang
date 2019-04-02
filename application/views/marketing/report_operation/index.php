<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<div class="row">

   <div class="col-md-10 col-md-offset-1">

        <h3 class="text-center marginbottom20"> Báo cáo marketing từ ngày <?php echo date('d-m-Y', $startDate); ?> đến ngày <?php echo date('d-m-Y', $endDate); ?></h3>

    </div>

</div>

<form action="#" method="GET" id="action_contact" class="form-inline">

    <?php $this->load->view('common/content/filter'); ?>

</form>



<div class="row">

    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">



    </div>

    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">

        <div class="panel panel-success">

            <div class="panel-heading">

                <h3 class="panel-title">Tổng chi phí</h3>

            </div>

            <div class="panel-body">

                <?php echo number_format(str_replace('.', '', $total['total_Spend'])) . ' VNĐ' ?>

            </div>

        </div>

    </div>

    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">

        <div class="panel panel-success">

            <div class="panel-heading">

                <h3 class="panel-title">Tổng C3</h3>

            </div>

            <div class="panel-body">

                <?php echo $total['total_C3'] ?>

            </div>

        </div>

    </div>

    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">

        <div class="panel panel-success">

            <div class="panel-heading">

                <h3 class="panel-title">Giá C3</h3>

            </div>

            <div class="panel-body">

                <?php echo number_format(str_replace('.', '', $total['total_price_C3'])) . ' VNĐ' ?>

            </div>

        </div>

    </div>

    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">

        <div class="panel panel-success">

            <div class="panel-heading">

                <h3 class="panel-title">Tỷ lệ C3/C2</h3>

            </div>

            <div class="panel-body">

                <?php echo $total['total_C3/C2'] ?>

            </div>

        </div>

    </div>

    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">

        <div class="panel panel-success">

            <div class="panel-heading">

                <h3 class="panel-title">Tỷ lệ C2/C1</h3>

            </div>

            <div class="panel-body">

                <?php echo $total['total_C2/C1'] ?>

            </div>

        </div>

    </div>

</div>



<div id="chart_div" style="width: 100%; height: 500px;"></div>

<div id="chart_priceC3" style="width: 100%; height: 500px;"></div>

<div id="chart_spend_div" style="width: 100%; height: 500px;"></div>

<?php if (isset($channel_id) && $channel_id == array(2)): ?>
    <div id="chart_percent" style="width: 100%; height: 500px;"></div>
<?php endif ?>

<script>

    $(document).ready(function () {



        google.charts.load('current', {'packages': ['line', 'corechart']});

        google.charts.setOnLoadCallback(drawChart);

        <?php if (isset($channel_id) && $channel_id == array(2)): ?>
            <?php echo 'google.charts.setOnLoadCallback(drawPercent);' ?>
        <?php endif ?>

        google.charts.setOnLoadCallback(drawSpendChart);
        google.charts.setOnLoadCallback(drawChartpriceC3);




        function drawChart() {

            var chartDiv = document.getElementById('chart_div');

            var data = new google.visualization.DataTable();

            data.addColumn('date', 'day');

            data.addColumn('number', 'Số lượng contact');

            data.addRows([

<?php

foreach ($per_day as $key => $value) {

    $date = explode('/', $key);

    echo "[new Date(" . $date[2] . ", " . ($date[1] - 1) . "," . $date[0] . ")," . $value['l1'] . "],";

}

?>

            ]);



            var materialOptions = {

                title: 'BÁO CÁO MARKETING HÀNG NGÀY',

                series: {

                    0: {axis: 'contact', type: 'bars'},

    

                },

                axes: {

                    y: {

                        contact: {label: 'Số lượng contact'}

                    }

                }

            };

            function drawMaterialChart() {

                var materialChart = new google.visualization.ComboChart(chartDiv);

                materialChart.draw(data, materialOptions);

            }

            drawMaterialChart();

        }



        function drawPercent() {

            var chart_percent = document.getElementById('chart_percent');

            var data = new google.visualization.DataTable();

            data.addColumn('date', 'day');

            data.addColumn('number', 'tỷ lệ C3/C2(%)');

            data.addColumn('number', 'tỷ lệ C2/C1(%)');

            data.addRows([

<?php

foreach ($per_day as $key => $value) {

    $date = explode('/', $key);

    echo "[new Date(" . $date[2] . ", " . ($date[1]-1) . "," . $date[0] . ")," . $value['c3/c2'] . "," . $value['c2/c1'] . "],";

}

?>

            ]);



            var materialOptions = {

                title: 'Biến động các tỉ lệ của Facebook ads',

                series: {

                    0: {axis: 'percent', type: 'line'},

                    1: {axis: 'percent', type: 'line'}

                },

                axes: {

                    y: {

                        percent: {label: 'phần trăm'}

                    }

                }

            };

            function drawMaterialChart() {

                var materialChart = new google.visualization.ComboChart(chart_percent);

                materialChart.draw(data, materialOptions);

            }

            drawMaterialChart();

        }



        function drawSpendChart() {

            var chartDiv = document.getElementById('chart_spend_div');

            var data = new google.visualization.DataTable();

            data.addColumn('date', 'day');

            data.addColumn('number', 'Tổng phí marketing');
            data.addColumn('number', 'Facebook ads');
            data.addColumn('number', 'Email Getresponse');
            data.addColumn('number', 'Google Adwords');

            data.addRows([

<?php

foreach ($per_day as $key => $value) {

    $date = explode('/', $key);



    echo "[new Date(" . $date[2] . ", " . ($date[1]-1) . "," . $date[0] . ")," . $value['spend'] . "," . $value['each_spend']['fb'] . "," . $value['each_spend']['em'] . "," . $value['each_spend']['ga'] . "],";

}

?>

            ]);



            var options = {
                title: 'Chi phí giữa các kênh',

                series: {

                    0: {axis: 'vnd', type: 'bars'},

                    1: {axis: 'vnd', type: 'bars'}



                },

                axes: {

                    y: {

                        vnd: {label: 'VNĐ'}

                    }

                }

            };

            function drawMaterialChart() {

                var materialChart = new google.visualization.ComboChart(chartDiv);

                materialChart.draw(data, options);

            }

            drawMaterialChart();

        }
        
        function drawChartpriceC3() {

            var chartDiv = document.getElementById('chart_priceC3');

            var data = new google.visualization.DataTable();

            data.addColumn('date', 'day');

            data.addColumn('number', 'Giá C3');

            data.addRows([

<?php

foreach ($per_day as $key => $value) {

    $date = explode('/', $key);

    echo "[new Date(" . $date[2] . ", " . ($date[1] - 1) . "," . $date[0] . ")," . $value['priceC3'] . "],";

}

?>

            ]);



            var materialOptions = {

                title: 'Giá C3',

                series: {

                    0: {axis: 'contact', type: 'lines'},

    

                },

                axes: {

                    y: {

                        contact: {label: 'Giá C3'}

                    }

                }

            };

            function drawMaterialChart() {

                var materialChart = new google.visualization.ComboChart(chartDiv);

                materialChart.draw(data, materialOptions);

            }

            drawMaterialChart();

        }



    });



</script>
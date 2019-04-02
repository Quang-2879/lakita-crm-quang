<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<div class="row">

   <div class="col-md-10 col-md-offset-1">

        <h3 class="text-center marginbottom20"> Báo cáo COD từ ngày <?php echo date('d-m-Y', $startDate); ?> đến ngày <?php echo date('d-m-Y', $endDate); ?></h3>

    </div>

</div>

<form action="#" method="GET" id="action_contact" class="form-inline">

    <?php $this->load->view('common/content/filter'); ?>

</form>






<div id="chart_div" style="width: 100%; height: 500px;"></div>

<script>

    $(document).ready(function () {



        google.charts.load('current', {'packages': ['line', 'corechart']});

        google.charts.setOnLoadCallback(drawChart);







        function drawChart() {

            var chartDiv = document.getElementById('chart_div');

            var data = new google.visualization.DataTable();

            data.addColumn('date', 'day');

            data.addColumn('number', 'tỷ lệ hủy đơn viettel (%)');
            data.addColumn('number', 'tỷ lệ hủy đơn khác (%)');
            data.addColumn('number', 'tỷ lệ hủy đơn chuyển khoản (%)');
            data.addColumn('number', 'tỷ lệ hủy đơn trung bình (%)');
            data.addRows([

<?php

foreach ($per_day as $key => $value) {

    $date = explode('/', $key);

    echo "[new Date(" . $date[2] . ", " . ($date[1] - 1) . "," . $date[0] . ")," . $value['viettel'] . "," . $value['khac'] . "," . $value['chuyen_khoan'] . "," . $value['avg'] . "],";

}

?>

            ]);

            var materialOptions = {

                title: 'BÁO CÁO COD HÀNG NGÀY',
                animation : true,
                series: {
                    0: {axis: 'contact', type: 'line'},
                    1: {axis: 'contact', type: 'line'},
                    2: {axis: 'contact', type: 'line'},
                    3: {axis: 'contact', type: 'line', lineWidth: 4,lineDashStyle: [2, 2, 20, 2, 20, 2]},
                },

                axes: {

                    y: {

                        contact: {label: 'tỷ lệ hủy đơn theo đơn vị vận chuyển'}

                    }

                }

            };

            function drawMaterialChart() {

                var materialChart = new google.visualization.LineChart(chartDiv);

                materialChart.draw(data, materialOptions);

            }

            drawMaterialChart();

        }



    






    });



</script>
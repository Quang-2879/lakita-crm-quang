<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    google.charts.load('current', {'packages': ['line', 'corechart']});
</script>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h3 class="text-center marginbottom20"> Báo cáo vòng đời khoác học từ ngày <?php echo date('d-m-Y', $startDate); ?> đến ngày <?php echo date('d-m-Y', $endDate); ?></h3>
    </div>
</div>

<form action="#" method="GET" id="action_contact" class="form-inline">
    <?php $this->load->view('common/content/filter'); ?>
</form>

<?php foreach ($Report as $key => $value) { ?>
    <div id="chart_<?php echo $key; ?>" style="width: 100%; height: 300px;"></div>
    <script>
    $(document).ready(function () {
        google.charts.setOnLoadCallback(drawChart<?php echo $key; ?>);
        
        function drawChart<?php echo $key; ?>() {
            var chartDiv<?php echo $key; ?> = document.getElementById('chart_<?php echo $key; ?>');
            var data<?php echo $key; ?> = new google.visualization.DataTable();
            data<?php echo $key; ?>.addColumn('date', 'day');
            data<?php echo $key; ?>.addColumn('number', 'Số lượng contact L7+L8');
            data<?php echo $key; ?>.addRows([
<?php
foreach ($value as $key1 => $value1) {
    $date = explode('/', $key1);
    echo "[new Date(" . $date[2] . ", " . $date[1] . "," . $date[0] . ")," . $value1 . "],";
}
?>
            ]);

            var materialOptions = {
                title: 'Vòng đời khoác học <?php echo $key; ?>',
                series: {
                    0: {axis: 'contact', type: 'line', color : '<?php echo '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT); ?>'},
    
                },
                axes: {
                    y: {
                        contact: {label: 'Số lượng contact'}
                    }
                }
            };
            function drawMaterialChart() {
                var materialChart = new google.visualization.ComboChart(chartDiv<?php echo $key; ?>);
                materialChart.draw(data<?php echo $key; ?>, materialOptions);
            }
            drawMaterialChart();
        }
            
            
            
    });
    </script>
<?php } ?>


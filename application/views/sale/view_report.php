<form action="#" method="POST" id="action_contact" class="form-inline">
    <?php $this->load->view('common/content/filter'); ?>
</form>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load("current", {packages: ['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    google.charts.setOnLoadCallback(drawChart2);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ["Element", "Số contact", {role: "style"}],
            ["L1", <?php echo $L1; ?>, "#2252ab"],
            ["L2", <?php echo $L2; ?>, "#2252ab"],
            ["L6", <?php echo $L6; ?>, "#2252ab"],
            ["L7L8", <?php echo $L7L8; ?>, "#2252ab"]
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            {calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"},
            2]);

        var options = {
            title: "Tổng số contact",
            width: 1000,
            height: 400,
            bar: {groupWidth: "50%"},
            legend: {position: "none"}
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
        chart.draw(view, options);
    }
    function drawChart2() {
        var data = google.visualization.arrayToDataTable([
            ["Element", "%", {role: "style"}],
            ["L2/L1", <?php echo $L2pL1 = ($L1 > 0) ? round(($L2 / $L1) * 100) : 0; ?>, "<?php echo ($L2pL1 > 89) ? "#2C944A" : "red"; ?>"],
            ["L6/L2", <?php echo $L6pL2 = ($L2 > 0) ? round(($L6 / $L2) * 100) : 0; ?>, "<?php echo ($L6pL2 > 79) ? "#2C944A" : "red"; ?>"],
            ["L8/L6", <?php echo $L7L8pL6 = ($L6 > 0) ? round(($L7L8 / $L6) * 100) : 0; ?>, "<?php echo ($L7L8pL6 > 79) ? "#2C944A" : "red"; ?>"],
            ["L7L8/L1", <?php echo $L7L8pL1 = ($L1 > 0) ? round(($L7L8 / $L1) * 100) : 0; ?>, "<?php echo ($L7L8pL1 > 59) ? "#2C944A" : "red"; ?>"]
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            {calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"},
            2]);

        var options = {
            title: "Tỉ lệ",
            width: 1000,
            height: 400,
            bar: {groupWidth: "50%"},
            legend: {position: "none"}
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values2"));
        chart.draw(view, options);
    }
</script>
<div class="row">
    <div id="columnchart_values" class="google_chart"></div>
    <div id="columnchart_values2" class="google_chart"></div>
</div>

<!-- HuyNV -->
<hr>
<div class="row">
   <div class="col-md-10 col-md-offset-1">
        <h3 class="text-center marginbottom20"> Báo cáo tư vấn tuyển sinh từ ngày <?php echo date('d-m-Y', $startDate); ?> đến ngày <?php echo date('d-m-Y', $endDate); ?></h3>
    </div>
</div>
<form action="#" method="GET" id="action_contact" class="form-inline">
    <?php $this->load->view('common/content/filter'); ?>
</form>
<table class="table table-bordered table-striped view_report gr4-table table-fixed-head">
    <thead>
        <tr>
            <th style="background: none" class="staff_0"></th>
            <?php
            foreach ($staffs as $value) {
                    if ($value['L1_'] > 0 || $value['CON_CUU_DUOC'] > 0 || $value['L6'] > 0 ) {
                    ?>
                    <th class="staff_<?php echo $value['id']; ?>">
                        <?php echo $value['name']; ?>
                    </th>
                    <?php
                }
            }
            ?>
            <th class="staff_sum">
                Tổng
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        $report = array(
            array('L1_', 'L1_', $L1_),
            array('Chưa gọi', 'CHUA_GOI', $CHUA_GOI),
            array('LC', 'LC', $LC),
            array('L2_', 'L2_', $L2_),
            array('Còn cứu được', 'CON_CUU_DUOC', $CON_CUU_DUOC),
            array('Từ chối mua', 'TU_CHOI_MUA', $TU_CHOI_MUA),
            array('L6_', 'L6_', $L6_),
            array('L6 chưa giao hàng (COD)', 'CHUA_GIAO_HANG_COD', $CHUA_GIAO_HANG_COD),
            array('L6 chưa giao hàng (chuyển khoản + khác)', 'CHUA_GIAO_HANG_TRANSFER', $CHUA_GIAO_HANG_TRANSFER),
            array('Đang giao hàng', 'DANG_GIAO_HANG', $DANG_GIAO_HANG),
            array('Đã thu COD', 'DA_THU_COD', $DA_THU_COD),
            array('Hủy đơn', 'HUY_DON', $HUY_DON),
            array('L8', 'L8', $L8),
        );
        foreach ($report as $values) {
            list($name, $value2, $total) = $values;
            ?>
            <tr>
                <td> <?php echo $name; ?> </td>
                <?php
                foreach ($staffs as $value) {
                    if ($value['L1_'] > 0 || $value['CON_CUU_DUOC'] > 0 || $value['L6_'] > 0 ) {
                        ?>
                        <td>
                            <?php echo $value[$value2]; ?>
                        </td>
                        <?php
                    }
                }
                ?>
                <td>
                    <?php echo $total; ?>
                </td>
            </tr>
            <?php
        }
        ?>
        <?php
        $report2 = array(
            array('L2_/L1_', 'L2_', 'L1_', ($L1_ != 0) ? round(($L2_ / $L1_) * 100, 2) : 'không thể chia cho 0', 90),
            array('L6_/L2_', 'L6_', 'L2_', ($L2_ != 0) ? round(($L6_ / $L2_) * 100, 2) : 'không thể chia cho 0', 80),
            array('L8/L6_', 'L8', 'L6_', ($L6_ != 0) ? round(($L8 / $L6_) * 100, 2) : 'không thể chia cho 0', 80),
            array('L8/L1_', 'L8', 'L1_', ($L1_ != 0) ? round(($L8 / $L1_) * 100, 2) : 'không thể chia cho 0', 60),
            array('L7L8_/L1_', 'L7L8_', 'L1_', ($L1_ != 0) ? round(( ($DA_THU_COD + $L8) / $L1_) * 100, 2) : 'không thể chia cho 0', 60),
            array('L8/L2_', 'L8', 'L2_', ($L2_ != 0) ? round(($L8 / $L2_) * 100, 2) : 'không thể chia cho 0', 60),
            array('Hủy đơn/L6_', 'HUY_DON', 'L6_', ($L6_ != 0) ? round(($HUY_DON / $L6_) * 100, 2) : 'không thể chia cho 0', 0),
            array('LC/L1_', 'LC', 'L1_', ($L1_ != 0) ? round(($LC / $L1_) * 100, 2) : 'không thể chia cho 0', 0),
            array('0.5/L1_', 'CON_CUU_DUOC', 'L1_', ($L1_ != 0) ? round(($CON_CUU_DUOC / $L1_) * 100, 2) : 'không thể chia cho 0', 0),
        );
        foreach ($report2 as $values) {
            list($name, $tu_so, $mau_so, $total, $limit) = $values;
            ?>
            <tr>
                <td> <?php echo $name; ?> </td>
                <?php
                foreach ($staffs as $value) {
                    if ($value['L1_'] > 0 || $value['CON_CUU_DUOC'] > 0 || $value['L6_'] > 0 ) {
                        ?>
                        <td <?php
                        if ($value[$mau_so] != 0 && round(($value[$tu_so] / $value[$mau_so]) * 100) < $limit && $limit > 0 && $name != 'L7L8_/L1_') {
                            echo 'style="background-color: #a71717;color: #fff;"';
                        } else if ($value[$mau_so] != 0 && round(($value[$tu_so] / $value[$mau_so]) * 100) >= $limit && $limit > 0  && $name != 'L7L8_/L1_') {
                            echo 'style="background-color: #0C812D;color: #fff;"';
                        }

                        if ($name == 'L7L8_/L1_' && $value['L1_'] != 0 && round((($value['DA_THU_COD'] + $value['L8']) / $value['L1_']) * 100) < 60) {
                            echo 'style="background-color: #a71717;color: #fff;"';
                        } elseif ($name == 'L7L8_/L1_' && $value['L1_'] != 0 && round((($value['DA_THU_COD'] + $value['L8']) / $value['L1_']) * 100) > 60) {
                            echo 'style="background-color: #0C812D;color: #fff;"';
                        }
                        ?>>
                        <?php
                            if ($name == 'L7L8_/L1_') {
                                echo ($value['L1_'] != 0) ? round((($value['DA_THU_COD'] + $value['L8']) / $value['L1_']) * 100, 2) . '%' : 'không thể chia cho 0';
                            } else {
                                echo ($value[$mau_so] != 0) ? round(($value[$tu_so] / $value[$mau_so]) * 100, 2) . '%' : 'không thể chia cho 0';
                            }
                            ?>
                        </td>
                                <?php
                            }
                        }
                        ?>
                <td <?php
                if ($total < $limit && $limit > 0) {
                    echo 'style="background-color: #a71717;color: #fff;"';
                } else if ($total >= $limit && $limit > 0) {
                    echo 'style="background-color: #0C812D;color: #fff;"';
                }
                ?>>
                <?php echo $total . '%'; ?>
                </td>
            </tr>
    <?php
}
?>

    </tbody>
</table>
<?php //$this->load->view('common/script/view_detail_contact');  ?>
<?php //$this->load->view('common/content/pagination');  ?>


<!-- END HuyNV -->

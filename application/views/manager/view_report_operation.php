<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h3 class="text-center marginbottom20"> Báo cáo tổng hợp từ ngày <?php echo date('d-m-Y', $startDate); ?> đến ngày <?php echo date('d-m-Y', $endDate); ?></h3>
    </div>
</div>
<div class="row">
    <p>Kpi per day:</p>
    <?php foreach ($kpi as $key => $value){
        echo $key . ' : ' . $value;
        echo '<br>';
    } ?>
</div>
<form action="#" method="GET" id="action_contact" class="form-inline">
    <?php $this->load->view('common/content/filter'); ?>
</form>

<div class="col-lg-1 col-md-1" style="padding-right: 0">
    <table class="table table-bordered table-striped view_report gr4-table"> 
        <thead class="table-head-pos">
            <tr>
                <th style="background: none; height: 35px"  class="staff_0"></th>

            </tr>
            <tr>
                <th style="background: none; height: 53px"  class="staff_0"></th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($Report as $typeReport1 => $valueArr1) {
                ?>
                <tr>
                    <td style="background-color: #0C812D ;color: #FFF; height: 53px;"> <?php echo $typeReport1; ?> </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div class="col-lg-11 col-md-11" style="padding-left: 0">
    <table class="table table-bordered table-striped view_report gr4-table" style="display: block;overflow: scroll"> 
        <thead class="table-head-pos">
            <tr>
                <?php
                foreach ($date as $date1 => $time1) {

                    echo '<th colspan="4" style="min-width: 300px"> ' . $date1 . '</th>';
                }
                ?>
            </tr>
            <tr style="height: 53px">
                <?php
                foreach ($date as $date2 => $time2) {

                    echo '<th>Phát sinh</th><th>Phát sinh /KPI</th><th>Lũy kế</th><th>Lũy kế /KPI/Tháng</th>';
                }
                ?>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($Report as $typeReport => $valueArr) {
                ?>
            <tr style="height: 53px">
                    <?php
                    foreach ($valueArr as $key2 => $value) {
                        if ($typeReport == 'Doanh thu (L7+L8)' || $typeReport == 'Chi phí marketing' || $typeReport == 'Giá C3' || $typeReport == 'ARPU') {
                            if ($value['value'] == 'N/A') {
                                echo '<td>' . $value['value'] . '</td>';
                            } else {
                                echo '<td>' . number_format(str_replace('.', '', $value['value'])) . ' VNĐ</td>';
                            }
                             echo '<td>' . $value['value/kpi'] . '</td>';
                            if ($value['Lũy kế'] == 'N/A') {
                                echo '<td>' . $value['Lũy kế'] . '</td>';
                            } else {
                                echo '<td>' . number_format(str_replace('.', '', $value['Lũy kế'])) . ' VNĐ</td>';
                            }
                           echo '<td style="border-right: 2px solid; border-right-color: #0C812D;">' . $value['Lũy kế /kpi'] . '</td>';
                        } else {
                            echo '<td>' . $value['value'] . '</td><td>' . $value['value/kpi'] . '</td><td>' . $value['Lũy kế'] . '</td><td style="border-right: 2px solid; border-right-color: #0C812D;">' . $value['Lũy kế /kpi'] . '</td>';
                        }
                    }
                    ?>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h3 class="text-center marginbottom20"> Báo cáo chăm sóc khách hàng từ ngày <?php echo date('d-m-Y', $startDate); ?> đến ngày <?php echo date('d-m-Y', $endDate); ?></h3>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Tổng khách đã thanh toán</h3>
            </div>
            <div class="panel-body">
                <?php echo $bought ?>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Tổng khách tự kích hoạt</h3>
            </div>
            <div class="panel-body">
                <?php echo $active_themselves ?>
            </div>
        </div>
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
                if ($value['DUOC_PHAN'] > 0 || $value['CHUA_GOI'] > 0 || $value['DA_GOI'] > 0 || $value['DA_KICH_HOAT'] > 0 || $value['CHUA_KICH_HOAT'] > 0) {
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
            array('Được phân', 'DUOC_PHAN', $DUOC_PHAN),
            array('Chưa gọi', 'CHUA_GOI', $CHUA_GOI),
            array('Đã gọi', 'DA_GOI', $DA_GOI),
            array('Đã kích hoạt', 'DA_KICH_HOAT', $DA_KICH_HOAT),
            array('Chưa kích hoạt', 'CHUA_KICH_HOAT', $CHUA_KICH_HOAT),
        );
        foreach ($report as $values) {
            list($name, $value2, $total) = $values;
            ?>
            <tr>
                <td> <?php echo $name; ?> </td>
                <?php
                foreach ($staffs as $value) {
                    if ($value['DUOC_PHAN'] > 0 || $value['CHUA_GOI'] > 0 || $value['DA_GOI'] > 0 || $value['DA_KICH_HOAT'] > 0 || $value['CHUA_KICH_HOAT'] > 0) {
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
            array('Chưa gọi/Đã phân', 'CHUA_GOI', 'DUOC_PHAN', ($DUOC_PHAN != 0) ? round(($CHUA_GOI / $DUOC_PHAN) * 100, 2) : 'không thể chia cho 0', 50),
            array('Đã gọi/Đã phân', 'DA_GOI', 'DUOC_PHAN', ($DUOC_PHAN != 0) ? round(($DA_GOI / $DUOC_PHAN) * 100, 2) : 'không thể chia cho 0', 50),
            array('Đã kích hoạt/Đã phân', 'DA_KICH_HOAT', 'DUOC_PHAN', ($DUOC_PHAN != 0) ? round(($DA_KICH_HOAT / $DUOC_PHAN) * 100, 2) : 'không thể chia cho 0', 50),
            array('Chưa kích hoạt/Đã phân', 'CHUA_KICH_HOAT', 'DUOC_PHAN', ($DUOC_PHAN != 0) ? round(($CHUA_KICH_HOAT / $DUOC_PHAN) * 100, 2) : 'không thể chia cho 0', 50),
        );
        foreach ($report2 as $values) {
            list($name, $tu_so, $mau_so, $total, $limit) = $values;
            ?>
            <tr>
                <td> <?php echo $name; ?> </td>
                <?php
                foreach ($staffs as $value) {
                    if ($value['DUOC_PHAN'] > 0 || $value['CHUA_GOI'] > 0 || $value['DA_GOI'] > 0 || $value['DA_KICH_HOAT'] > 0 || $value['CHUA_KICH_HOAT'] > 0) {
                        ?>
                        <td <?php
                        if ($value[$mau_so] != 0 && round(($value[$tu_so] / $value[$mau_so]) * 100) < $limit && $limit > 0) {
                            echo 'style="background-color: #0C812D;color: #fff;"';
                        } else if ($value[$mau_so] != 0 && round(($value[$tu_so] / $value[$mau_so]) * 100) >= $limit && $limit > 0) {
                            echo 'style="background-color: #a71717;color: #fff;"';
                        }
                        ?>>
                                <?php
                                echo ($value[$mau_so] != 0) ? round(($value[$tu_so] / $value[$mau_so]) * 100, 2) . '%' : 'không thể chia cho 0';
                                ?>
                        </td>
                        <?php
                    }
                }
                ?>
                <td <?php
                if ($total < $limit && $limit > 0) {
                    echo 'style="background-color: #0C812D;color: #fff;"';
                } else if ($total >= $limit && $limit > 0) {
                    echo 'style="background-color: #a71717;color: #fff;"';
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
<?php //$this->load->view('common/script/view_detail_contact');    ?>
<?php //$this->load->view('common/content/pagination');  ?>



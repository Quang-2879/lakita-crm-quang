<form action="#" method="GET" id="action_contact" class="form-inline">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <table class="table table-striped table-bordered table-hover filter-tbl-1">
<!--                <tr>
                    <td class="text-right"> Ngày phát thành công: </td>
                    <td>  

                        <input type="text" class="form-control daterangepicker" name="filter_date_deliver_success" style="position: static"
                <?php if (filter_has_var(INPUT_GET, 'filter_date_deliver_success')) { ?>
                                       value="<?php echo filter_input(INPUT_GET, 'filter_date_deliver_success'); ?>"
                <?php } ?> 
                               />

                    </td>
                </tr>-->
                <tr>
                    <td class="text-right"> Ngày nhận tiền: </td>
                    <td>  
                        <input type="text" class="form-control daterangepicker" name="filter_custom_date_report" style="position: static"
                        <?php if (filter_has_var(INPUT_GET, 'filter_custom_date_report')) { ?>
                                   value="<?php echo filter_input(INPUT_GET, 'filter_custom_date_report'); ?>"
                               <?php } ?> 
                               />

                    </td>
                </tr>
                <tr>
                    <td class="text-right"> 
                        <input type="submit" class="btn btn-success filter_contact" value="Lọc" /> 
                    </td>
                    <td>  
                        <input type="submit" class="btn btn-danger reset_form" value="Reset" />
                    </td>
                </tr>
            </table>
            <?php $this->load->view('common/content/filter'); ?>
        </div>
    </div>
</form>
<table class="table table-bordered table-striped view_report">
    <thead>
        <tr>
            <th style="background: none"></th>
            <?php
            $report = array('L7', 'L8', 'L7L8');
            foreach ($report as $value) {
                ?>
                <th>
                    <?php echo $value; ?>
                </th>
                <?php
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
        $total_L7L8 = 0;
        foreach ($courses as $value) {
            if ($value['L7L8'] > 0) {
                $total_L7L8 += $value['L7L8'];
                //list($name, $value2, $total) = $values;
                ?>
                <tr>
                    <td>
                        <?php echo $value['course_code']; ?>
                    </td>
                    <?php
                    foreach ($report as $value2) {
                        ?>
                        <td>
                            <?php echo number_format($value[$value2], 0, ",", ".") . " VNĐ"; ?>
                        </td>
                        <?php
                    }
                    ?>
                </tr>
                <?php
            }
        }
        ?>
        <tr>
            <td> Tổng </td>
            <td> <h1> <?php echo number_format($L7, 0, ",", ".") . " VNĐ"; ?></h1></td>
            <td> <h1> <?php echo number_format($L8, 0, ",", ".") . " VNĐ"; ?></h1></td>
            <td colspan="3"> <h1> <?php echo number_format($L7L8, 0, ",", ".") . " VNĐ"; ?></h1></td>
        </tr>
    </tbody>
</table>

<table class="table table-bordered table-striped view_report">
    <thead>
        <tr>
            <th style="background: none"></th>
                <?php
                foreach ($staffs as $value) {
                    if ($value['L7L8'] > 0) {
                        ?>
                    <th>
                        <?php echo $value['name']; ?>
                    </th>
                    <?php
                }
            }
            ?>
            <th>
                Tổng
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        $report = array(
            array('L7', 'L7', $L7_TVTS),
            array('L8', 'L8', $L8_TVTS),
            array('L7+L8', 'L7L8', $L7L8_TVTS)
        );
        foreach ($report as $values) {
            list($name, $value2, $total) = $values;
            ?>
            <tr>
                <td> <?php echo $name; ?> </td>
                <?php
                foreach ($staffs as $value) {
                    if ($value['L7L8'] > 0) {
                        ?>
                        <td>
                            <?php echo number_format($value[$value2], 0, ",", ".") . " VNĐ"; ?>
                        </td>
                        <?php
                    }
                }
                ?>
                <td>
                    <?php echo number_format($total, 0, ",", ".") . " VNĐ"; ?>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
<?php //$this->load->view('common/script/view_detail_contact'); ?>
<?php //$this->load->view('common/content/pagination'); ?>


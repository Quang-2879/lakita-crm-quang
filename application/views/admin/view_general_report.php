<?php
/*
 * Copyright (C) 2017 Phạm Ngọc Chuyển <chuyenpn at lakita.vn>
 *
 */
?>
<form action="#" method="GET" id="action_contact" class="form-inline">
    <div class="row">
        <div class="col-md-6">
            <table class="table table-striped table-bordered table-hover">
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-striped table-bordered table-hover">
                <tr>
                    <td class="text-right"> Ngày nhận contact từ: </td>
                    <td>
                        <input type="text" class="form-control datepicker" name="filter_date_handover_from"
                        <?php if (isset($_GET['filter_date_handover_from'])) { ?>
                                   value="<?php echo $_GET['filter_date_handover_from']; ?>"
                               <?php } ?> />
                    </td>
                </tr>
                <tr>
                    <td class="text-right"> đến: </td>
                    <td>
                        <input type="text" class="form-control datepicker" name="filter_date_handover_end"
                        <?php if (isset($_GET['filter_date_handover_end'])) { ?>
                                   value="<?php echo $_GET['filter_date_handover_end']; ?>"
                               <?php } ?> />
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
        </div>
    </div>
</form>

<div class="row">
    <div class="col-md-3">
        <h2> Xem báo cáo theo </h2>
        <ul class="view_report_by margintop22">
            <li> <a href="<?php echo base_url(); ?>manager/view_general_report/channel"> 
                    <i class="fa fa-facebook" aria-hidden="true" style="color:red"></i> &nbsp; &nbsp; &nbsp; Kênh 
                </a>
            </li>
            <li> <a href="<?php echo base_url(); ?>manager/view_general_report/course"> 
                    <i class="fa fa-industry" aria-hidden="true" style="color:blue"></i> &nbsp; &nbsp;  Loại sản phẩm </a>
            </li>
            <li> <a href="<?php echo base_url(); ?>manager/view_general_report/tvts"> 
                    <i class="fa fa-user" aria-hidden="true" style="color:green"></i> &nbsp; &nbsp; TVTS 
                </a>
            </li>
            <li> <a href="<?php echo base_url(); ?>manager/view_general_report/provider"> 
                    <i class="fa fa-truck" aria-hidden="true" style="color:goldenrod"></i> &nbsp; &nbsp; Đơn vị giao hàng 
                </a>
            </li>
        </ul>
    </div>
    <div class="col-md-9">
        <table class="table table-bordered table-striped view_report">
            <thead>
                <tr>
                    <th style="background: none"></th>
                    <?php
                    $report = array('L8' => 0, 'L2/L1' => '90%', 'L6/L2' => '80%', 'L8/L6' => '90%', 'L8/L1' => '60%');
                    foreach ($report as $key => $value) {
                        ?>
                        <th>
                            <?php echo $key; ?>
                        </th>
                        <?php
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $total_L7L8 = 0;
                foreach ($view as $value) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $value[$name_showing]; ?>
                        </td>
                        <?php
                        foreach ($report as $key2 => $value2) {
                            ?>
                            <td <?php if (intval($value[$key2]) < intval($value2)) echo 'style="background-color: #a71717;color: #fff;"'; ?>
                                <?php echo ' '.$prop.'=' . $value[$view_key] . ' type=' . $key2; ?> class="click_see">
                                <?php echo $value[$key2]; ?>
                            </td>
                            <?php
                        }
                        ?>
                    </tr>
                    <?php
                }
                ?>
                <tr>
                    <td> Tỉ lệ tổng </td>
                    <td> <?php echo $L8; ?> </td>
                    <td <?php if ($L1 != 0 && round(($L2 / $L1) * 100, 2) < 90) echo 'style="background-color: #a71717;color: #fff;"'; ?>>
                        <?php echo ($L1 != 0) ? round(($L2 / $L1) * 100, 2) . '%' : 'Không thể chia cho 0'; ?>
                    </td>
                    <td 
                        <?php if ($L2 != 0 && round(($L6 / $L2) * 100, 2) < 80) echo 'style="background-color: #a71717;color: #fff;"'; ?>
                        <?php echo ' '.$prop.'=total type="L6/L2"'; ?> class="click_see">
                        <?php echo ($L2 != 0) ? round(($L6 / $L2) * 100, 2) . '%' : 'Không thể chia cho 0'; ?>
                    </td>
                    <td <?php if ($L6 != 0 && round(($L8 / $L6) * 100, 2) < 90) echo 'style="background-color: #a71717;color: #fff;"'; ?>
                        <?php echo ' '.$prop.'=total type="L8/L6"'; ?> class="click_see">
                        <?php echo ($L6 != 0) ? round(($L8 / $L6) * 100, 2) . '%' : 'Không thể chia cho 0'; ?>
                    </td>
                    <td <?php if ($L1 != 0 && round(($L8 / $L1) * 100, 2) < 60) echo 'style="background-color: #a71717;color: #fff;"'; ?>>
                        <?php echo ($L1 != 0) ? round(($L8 / $L1) * 100, 2) . '%' : 'Không thể chia cho 0'; ?>
                    </td>
                </tr>
                <tr>
                    <td> Tổng doanh thu </td>
                    <td colspan="4"> <h1> <?php echo number_format($sumL8, 0, ",", ".") . " VNĐ"; ?></h1></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>



<div class="modal fade detail_report_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Thông tin chi tiết </h4>
            </div>
            <div class="modal-body replace_content_report">


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(".click_see").click(
            function () {
                $.ajax({
                    url: "<?php echo base_url(); ?>manager/click_see",
                    type: "POST",
                    data: {
                        course_code: $(this).attr('course_code'),
                        type: $(this).attr('type'),
                        filter_date_handover_from: $('[name="filter_date_handover_from"]').val(),
                        filter_date_handover_end: $('[name="filter_date_handover_end"]').val()
                    },
                    success: function (data) {
                        console.log(data);
                        $("div.replace_content_report").html(data);
                    },
                    complete: function () {
                        $(".detail_report_modal").modal("show");
                    }
                });
            });
</script>

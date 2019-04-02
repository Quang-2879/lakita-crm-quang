<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h3 class="text-center marginbottom20"> Báo cáo thu nhập giảng viên từ <?php echo $startDate; ?>
             đến <?php echo $endDate; ?>

    </div>
</div>
<form action="#" method="GET" id="action_contact" class="form-inline">
    <?php $this->load->view('common/content/filter'); ?>
</form>
<table class="table table-bordered table-striped view_report gr4-table">
    <thead class="table-head-pos">
        <tr>
            <th style="background: none; color: black; font-weight: bold" class="staff_0">Giảng viên</th>
            <th> Thu nhập </th>
        </tr>

    </thead>
    <tbody>
        <?php foreach ($Report as $teacher => $profit) {
            ?>
            <tr>
                <td> <?php echo $teacher; ?> </td>

                <td> <?php echo number_format($profit, 0, ",", ".") . " VNĐ" ?></td>

            </tr>
        <?php } ?>
    </tbody>
</table>
<?php //$this->load->view('common/script/view_detail_contact');    ?>
<?php //$this->load->view('common/content/pagination');   ?>



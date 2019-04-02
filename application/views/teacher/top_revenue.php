<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h3 class="text-center marginbottom20"> Doanh thu theo khóa 
                từ ngày <?php echo date('d-m-Y', $startDate);
                ?> đến ngày <?php echo date('d-m-Y', $endDate); ?></h3>
    </div>
</div>
<form action="#" method="GET" id="action_contact" class="form-inline">
    <?php $this->load->view('common/content/filter'); ?>
</form>
<table class="table table-bordered table-striped view_report gr4-table">
    <thead class="table-head-pos">
        <tr>
            <th style="background: none" class="staff_0"> Khóa Học</th>
            <th> Doanh thu </th>
        </tr>

    </thead>
    <tbody>
        <?php foreach ($course_revenue as $key => $value) {
            ?>
            <tr>
                <td> <?php echo $key; ?> </td>
                <td> <?php echo number_format($value, 0, ",", "."); ?> </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<?php //$this->load->view('common/script/view_detail_contact');   ?>
<?php //$this->load->view('common/content/pagination');  ?>



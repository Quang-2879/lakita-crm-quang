<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h3 class="text-center marginbottom20"> <?php echo $list_title; ?> (<?php echo $total_rows; ?>)</h3>
    </div>
</div>
<form action="#" method="GET" class="form-inline" id="form_item">
    <?php $this->load->view('base/filter_item/index'); ?>
     <div class="number_paging" > 
        Tổng tiền Viettel thu của khách: <?php echo isset($rows) ? number_format(h_sum_money_1($rows), 0, ",", ".") . " VNĐ" : 0; ?>
    </div>
    <div class="number_paging" > 
        Tổng tiền giao cho viettel: <?php echo isset($rows) ? number_format(h_sum_money($rows), 0, ",", ".") . " VNĐ" : 0; ?>
    </div>
    <?php $this->load->view('base/show_table/base_header'); ?>
    <?php $this->load->view('base/show_table/index'); ?>
    Chọn ngày thu Lakita (bỏ trống nếu là ngày hôm nay): 
    <input type="text" class="form-control datepicker" name="date_receive_lakita" />
    <input type="submit" class="btn btn-success input_save" value="Lưu lại"/> </br>
    <div class="number_paging" > 
        Tổng tiền Viettel thu của khách: <?php echo isset($rows) ? number_format(h_sum_money_1($rows), 0, ",", ".") . " VNĐ" : 0; ?>
    </div>
    <div class="number_paging" > 
        Tổng tiền giao cho viettel: <?php echo isset($rows) ? number_format(h_sum_money($rows), 0, ",", ".") . " VNĐ" : 0; ?>
    </div>
    <?php $this->load->view('base/show_table/base_footer'); ?>
    <?php $this->load->view('base/show_table/hidden_input'); ?>
   
</form>
<?php $this->load->view('base/delete_item/index'); ?>
<?php $this->load->view('base/edit_item/index'); ?>
<?php $this->load->view('base/js'); ?>
<?php $this->load->view('cod/check_L8/js'); 

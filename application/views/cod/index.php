<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h3 class="text-center marginbottom35"> Danh sách contact đồng ý mua <sup> <span class="badge bg-red"> <?php echo $total_contact; ?> </span> </sup> </h3>
        <p class="red text-center"> Lưu ý: nếu mã vận đơn trống thì hệ thống tự hiểu là tạo mã vận đơn tự động, ngược lại hệ thống sẽ lấy mã vận đơn bạn điền làm mã vận đơn của contact! </p>
    </div>
</div>
<form action="<?php echo base_url(); ?>common/action_edit_multi_cod_contact" method="POST" id="action_contact" 
      class="form-inline <?php echo ($total_contact > 0) ? '' : 'empty'; ?>">
    <?php $this->load->view('common/content/filter'); ?>
    <?php $this->load->view('common/content/tbl_contact'); ?>
    <?php $this->load->view('cod/modal/reset_provider'); ?> 
    <?php $this->load->view('cod/modal/edit_multi_contact'); ?> <br/>
    <br/>
</form>

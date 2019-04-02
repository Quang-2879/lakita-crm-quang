<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h3 class="text-center marginbottom35"> <?php echo $title_content;?> (<?php echo $total_contact; ?>)</h3>
    </div>
</div>
<form action="<?php echo base_url(); ?>common/action_edit_multi_cod_contact" method="POST" id="action_contact" class="form-inline"> 
    <?php $this->load->view('common/content/filter'); ?>
    <?php $this->load->view('common/content/tbl_contact'); ?>
</form>
<div class="view_duplicate">
    
</div>
<?php $this->load->view('common/content/pagination'); ?>
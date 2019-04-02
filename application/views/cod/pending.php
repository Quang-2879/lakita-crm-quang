<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h3 class="text-center marginbottom35"> Danh sách contact đang giao hàng <sup> <span class="badge bg-red"> <?php echo $total_contact; ?> </span> </sup> </h3>
    </div>
</div>
<form action="<?php echo base_url(); ?>common/action_edit_multi_cod_contact" method="POST" id="action_contact" class="form-inline"> 
    <?php $this->load->view('common/content/filter'); ?>
    <?php $this->load->view('common/content/tbl_contact'); ?> 
    <?php $this->load->view('cod/modal/edit_multi_contact'); ?> 
</form>
<div class="export_to_string1">
    <div class="modal fade export_to_string_modal " tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog btn-very-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Chuỗi đối soát</h4>
                </div>
                <div class="modal-body">
                    <textarea class="replace_content_2 form-control" style="height: 300px; cursor: auto;" disabled="disabled">
                        
                    </textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

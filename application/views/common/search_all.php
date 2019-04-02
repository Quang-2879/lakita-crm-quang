<div class="modal fade navbar-search-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog btn-very-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"> Kết quả tìm kiếm cho từ khóa: "<?php echo $search_all; ?>"</h4>
            </div>
            <div class="modal-body replace-content">
                <?php if (empty($contacts)) { ?>
                    <h1 class="text-center red" style="height: 400px; "> 
                        <img src="https://lakita.vn/public/images/404.png" alt="" width="282" height="250"> <br> 
                        Không tìm thấy kết quả nào ! </h1>
                <?php } else { ?>
                    <form method="POST" action="<?php echo base_url(); ?>manager/divide_contact" class="form_submit form_edit_contact_modal">
                        <?php $this->load->view('common/content/tbl_contact'); ?>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</div>








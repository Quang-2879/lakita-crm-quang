<div class="modal fade edit_contact_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog btn-very-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Chăm sóc contact</h4>
            </div>
            <div class="modal-body replace_content">
                <form method="post" action="<?php echo base_url($action_url); ?>" class="form_submit form_edit_contact_modal" contact_id="<?php echo $contact_id; ?>">
                    <div class="tab_container">
                        <input id="tab1-edit" type="radio" name="tabs" checked>
                        <label for="tab1-edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><span>Chăm sóc contact</span></label>
                        <input id="tab2-edit" type="radio" name="tabs">
                        <label for="tab2-edit"><i class="fa fa-history" aria-hidden="true"></i><span>Lịch sử cuộc gọi</span></label>
                        <section id="content1-edit" class="tab-content">
                            <?php
                            if (!$edited_contact) {
                                echo'<fieldset disabled>';
                            }
                            ?>
                            <div class="row real-search-result-replace">
                                <div class="col-md-6">
                                    <table class="table table-striped table-bordered table-hover table-1 table-edit-1 edit_table">
                                        <?php
                                        if (isset($view_edit_left)) {
                                            foreach ($view_edit_left as $key => $value) {
                                                if ($value == 'view') {
                                                    $this->load->view('common/content/view_contact/' . $key);
                                                }
                                                if ($value == 'edit') {
                                                    $this->load->view('common/content/edit_contact/' . $key);
                                                }
                                            }
                                        }
                                        ?>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table table-striped table-bordered table-hover table-2 table-edit-2 edit_table">
                                        <?php
                                        if (isset($view_edit_right)) {
                                            foreach ($view_edit_right as $key => $value) {
                                                if ($value == 'view') {
                                                    $this->load->view('common/content/view_contact/' . $key);
                                                }
                                                if ($value == 'edit') {
                                                    $this->load->view('common/content/edit_contact/' . $key);
                                                }
                                            }
                                        }
                                        ?>
                                    </table>
                                </div>
                                <div class="clearfix"></div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success btn-lg btn-edit-contact"> <i class="fa fa-floppy-o" aria-hidden="true"></i> &nbsp; Lưu Lại</button>
                                </div>
                            </div>
                            <?php
                            if (!$edited_contact) {
                                echo'</fieldset>';
                            }
                            ?>
                        </section>
                        <section id="content2-edit" class="tab-content">
                            <div>
                                <?php $this->load->view('common/content/call_log'); ?>
                            </div>
                        </section>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>








<div class="modal fade transfer_one_contact_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Chuyển nhượng contact "<span class="contact_name_replacement"></span>"</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url(); ?>customer_care/transfer_one_contact" method="POST" id="transfer_one_contact">
                    <input type="hidden" name="contact_id" id="contact_id_input" />
                    <div class="form-group">
                        <select name="customer_care_id" class="form-control selectpicker">
                            <option value="0"> 
                                Chọn nhân viên CSKH
                            </option>
                            <?php
                            foreach ($staffs as $key => $value) {
                                if ($value['id'] == $this->user_id)
                                    continue;
                                ?>
                                <option value="<?php echo $value['id']; ?>"> 
                                    <?php echo $value['name']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
              
                    <div class="form-group">
                        <input class="btn btn-success btn-block btn-lg" type="submit" value="OK" />
                    </div>
                </form> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
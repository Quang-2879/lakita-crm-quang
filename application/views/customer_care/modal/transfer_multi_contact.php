<!-- Modal -->
<div class="modal fade transfer_multi_contact_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Chuyển nhượng nhiều contact</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <select name="customer_care_id" class="form-control selectpicker">
                        <option value="0"> 
                            Chọn nhân viên CSKH
                        </option>
                        <?php
                        foreach ($staffs as $key => $value) {
                            if($value['id'] == $this->user_id) continue;
                            ?>
                            <option value="<?php echo $value['id']; ?>"> 
                                <?php echo $value['name']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <input class="btn btn-success btn-lg btn-block" type="submit" value="OK" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
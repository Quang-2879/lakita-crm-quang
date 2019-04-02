<!--
/*
* tiền tố đặt tên class các trường edit: modal_edit_{name}
* ví dụ: modal_edit_provider_id
*/
-->
<!-- Modal -->
<div class="modal fade reset_provider_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Chọn đơn vị giao hàng</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <select class="form-control selectpicker" name="provider_id_reset">
                        <option value="0"> Chọn đơn vị giao hàng </option>
                        <?php
                        foreach ($providers as $key => $value) {
                            ?>
                            <option value="<?php echo $value['id']; ?>">
                                <?php echo $value['name']; ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <input class="btn btn-success btn-lg btn-block change-form-submit-url" 
                           data-form-id="action_contact"
                           data-action="cod/ResetBillCode"
                           data-method="POST"
                           type="submit" value="OK" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
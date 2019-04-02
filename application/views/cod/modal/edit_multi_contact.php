<!--
/*
* tiền tố đặt tên class các trường edit: modal_edit_{name}
* ví dụ: modal_edit_provider_id
*/
-->
<!-- Modal -->
<div class="modal fade edit_multi_cod_contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Chọn đơn vị giao hàng</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <select class="form-control selectpicker" name="provider_id">
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
                    <select class="form-control selectpicker" name="cod_status_id">
                        <option value="0"> Chọn trạng thái giao COD </option>
                        <?php
                        foreach ($cod_status as $key => $value) {
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
                    <label>  Ghi chú </label>
                    <textarea class="form-control" rows="3" name="note"></textarea>
                </div>
                <div class="form-group">
                    <input class="btn btn-success btn-lg btn-block btn-modal_edit-multi-contact" type="submit" value="OK" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
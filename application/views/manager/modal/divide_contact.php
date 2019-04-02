<div class="modal fade divide_multi_contact_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Phân các contact đã chọn cho TVTS....</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <select name="sale_id" class="form-control selectpicker">
                        <option value="0">
                            Chọn nhân viên TVTS
                        </option>
                        <?php
                        foreach ($staffs as $key => $value) {
                            ?>
                            <option value="<?php echo $value['id']; ?>">
                                <?php echo $value['name']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>  Ghi chú </label>
                    <textarea class="form-control" rows="3" name="note"></textarea>
                </div>
                <div class="form-group">
                    <input class="btn btn-success btn-lg btn-block btn-divide-multi-contact" type="submit" value="OK" class="form-control"/>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
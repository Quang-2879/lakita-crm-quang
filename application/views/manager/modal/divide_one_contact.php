<div class="modal fade divide_one_contact_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Bàn giao contact "<span class="contact_name"> </span>"</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url(); ?>manager/divide_contact" method="POST" id="divide_one_contact">
                    <input type="hidden" name="contact_id" id="contact_id_input" />
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
                        <input class="btn btn-success btn-block btn-lg btn-divide-one-contact" type="submit" value="OK" />
                    </div>
                </form> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
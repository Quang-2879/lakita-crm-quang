<div class="modal fade show-campaign-adset" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog btn-very-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Danh sách Ad con của adset "<?php echo $adsetName; ?>"</h4>
            </div>
            <div class="modal-body replace_content">
                <?php
                if (empty($ads)) {
                    echo '<h2> Không có Ad con nào của adset này! </h2>';
                } else {
                    ?>
                    <table class="table table-bordered table-striped list_contact list_contact_2 table-fixed-head">
                        <thead>
                            <tr>
                                <th> Hoạt động </th>
                                <th> Tên ad </th>
                                <th> Đã tiêu </th>
                                <th> Số C1 </th>
                                <th> Số C2 </th>
                                <th> Số C3 </th>
                                <th> Giá C3 </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($ads as $ad) { ?>
                                <tr class="custom_right_menu"
                                    item_id="<?php echo $ad['id'] ?>"
                                    edit-url="<?php echo base_url('MANAGERS/ad/show_edit_item') ?>">
                                    <td> <?php $checked = ($ad['active'] == '1') ? 'checked' : ''; ?>
                                        <div class="toggle-input marginbottom20">
                                            <label class="switch">
                                                <input type="checkbox" 
                                                       data-url="<?php echo base_url('MANAGERS/ad/edit_active') ?>" 
                                                       name="edit_active" <?php echo $checked ?> 
                                                       item_id="<?php echo $ad['id'] ?>"/>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td> <?php echo $ad['name'] ?> </td>
                                    <td> <?php echo $ad['spend'] ?> </td>
                                    <td> <?php echo $ad['total_C1'] ?> </td>
                                    <td> <?php echo $ad['total_C2'] ?> </td>
                                    <td> <?php echo $ad['total_C3'] ?> </td>
                                    <td> <?php echo $ad['pricepC3'] ?> </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>








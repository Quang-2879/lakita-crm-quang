<div class="modal fade show-campaign-adset" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog btn-very-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Danh sách Adset con của campaign "<?php echo $campaignName; ?>"</h4>
            </div>
            <div class="modal-body replace_content">
                <?php
                if (empty($adsets)) {
                    echo '<h2> Không có Adset con nào của campaign này! </h2>';
                } else {
                    ?>
                    <table class="table table-bordered table-striped list_contact list_contact_2 table-fixed-head">
                        <thead>
                            <tr>
                                <th> Hoạt động </th>
                                <th> Tên adset </th>
                                <th> Đã tiêu </th>
                                <th> Số C1 </th>
                                <th> Số C2 </th>
                                <th> Số C3 </th>
                                <th> Giá C3 </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($adsets as $adset) { ?>
                                <tr class="custom_right_menu" 
                                    item_id="<?php echo $adset['id'] ?>"
                                    edit-url="<?php echo base_url('MANAGERS/adset/show_edit_item') ?>">
                                    <td> <?php $checked = ($adset['active'] == '1') ? 'checked' : ''; ?>
                                        <div class="toggle-input marginbottom20">
                                            <label class="switch">
                                                <input type="checkbox" 
                                                       data-url="<?php echo base_url('MANAGERS/adset/edit_active') ?>" 
                                                       name="edit_active" <?php echo $checked ?> 
                                                       item_id="<?php echo $adset['id'] ?>"/>
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="adset-detail" 
                                        adset-id="<?php echo $adset['id'] ?>"
                                        data-url="<?php echo base_url('MANAGERS/adset/GetAdsModal') ?>"
                                        data-modal-name="adset-detail-modal"> <?php echo $adset['name'] ?> </td>
                                    <td> <?php echo $adset['spend'] ?> </td>
                                    <td> <?php echo $adset['total_C1'] ?> </td>
                                    <td> <?php echo $adset['total_C2'] ?> </td>
                                    <td> <?php echo $adset['total_C3'] ?> </td>
                                    <td> <?php echo $adset['pricepC3'] ?> </td>
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








<div class="row" style="margin-right: 5px; margin-left: 5px;">
    <div class="col-md-12">
        <table class="table table-striped table-bordered table-hover table-1 table-view-1 heavyTable" style="height: 193px;">
            <thead>
            <th> Tên adset </th>
            <th> ID Adset FB </th>
            <th> Của Campaign nào </th>
            <th> Thao tác </th>
            </thead>
            <tbody>
                <?php foreach ($adsets as $value) { ?>
                    <tr>
                        <td> <?php echo $value['name']; ?> </td>
                        <td> <?php echo $value['id']; ?> </td>
                        <td> <?php echo $value['campaign_name_facebook']; ?></td>
                        <td>  <?php
                            if ($value['exist']) {
                                echo 'Adset này đang tồn tại rồi, bạn không thể thêm mới!';
                            } else {
                                echo '<button class="create-adset-from-fb btn btn-success" '
                                . 'id-fb="' . $value['id'] . '" adset-name="' . $value['name'] . '" '
                                . 'campaign-crm-id="' . $value['campaign_crm_id'] . '" '
                                . 'campaign-name-facebook="' . $value['campaign_name_facebook'] . '"> Tạo mới adset </button>';
                            }
                            ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
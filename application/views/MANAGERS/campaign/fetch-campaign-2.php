<div class="row add-campaign-fb-fetch" style="margin-right: 5px; margin-left: 5px;">
    <div class="col-md-12">
        <table class="table table-striped table-bordered table-hover table-1 table-view-1 heavyTable" style="height: 193px;">
            <thead>
            <th style="width: 25px;"> Tài khoản </th>
            <th style="width: 121px;"> Tên chiến dịch </th>
            <th style="width: 121px;"> Tên adset </th>
            <th style="width: 121px;"> Tên ad </th>
            <th class="text-right"> Chọn landing page</th>
            <th> Thao tác </th>
            </thead>
            <tbody>
                <?php foreach ($campaigns as $value) { ?>
                    <tr>
                        <td> <?php echo $accountFB[$value['account']]; ?></td>
                        <td> <?php echo $value['fb_campaign_name']; ?> </td>
                        <td> <?php echo $value['fb_adset_name']; ?> </td>
                        <td> <?php echo $value['fb_ad_name']; ?> </td>
                        <td>
                            <select class="form-control selectpicker select-landing-page pull-right" name="add_landingpage_id">
                                <option value="0"> Chọn landing page </option>
                                <?php foreach ($landingpages as $key => $value2) {
                                    ?>
                                    <option value="<?php echo $value2['id'] ?>" data-url="<?php echo $value2['url'] ?>"> 
                                        <?php echo $value2['landingpage_code'] . ' - ' . $value2['url']; ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                        <td>  <?php
                            echo '<button class="create-campaign-from-fb-2 btn btn-success" '
                            . 'fb-account-id="' . $value['account'] . '" '
                            . 'fb-campaign-id="' . $value['fb_campaign_id'] . '" fb-campaign-name="' . $value['fb_campaign_name'] . '" '
                            . 'fb-adset-id="' . $value['fb_adset_id'] . '" fb-adset-name="' . $value['fb_adset_name'] . '" '
                            . 'fb-ad-id="' . $value['fb_ad_id'] . '" fb-ad-name="' . $value['fb_ad_name'] . '"> '
                            . 'Tạo link '
                            . '</button>';
                            ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>


<h3 class="text-center"> Phân nháp contact (tổng <?php echo $total_contact; ?> contact)</h3>
<form method="post" action="<?php echo base_url() . 'manager/confirm_divide_contact_even'; ?>" class="marginbottom35" id="action_contact">
    <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
        <ul class="nav nav-tabs" id="myTabs" role="tablist">
            <?php
            foreach ($staffs as $key => $value) {
                ?>
                <li role="presentation" <?php if ($key == 0) echo 'class="active"'; ?>>
                    <a href="#sale_<?php echo $value['id']; ?>" id="a_sale_<?php echo $value['id']; ?>" role="tab" 
                       data-toggle="tab" aria-controls="home" aria-expanded="true"><?php echo $value['name']; ?></a>
                </li>
            <?php } ?>
        </ul>
        <div class="tab-content" id="myTabContent">
            <?php
            foreach ($staffs as $key2 => $value2) {
                ?>
                <div class="tab-pane fade <?php if ($key2 == 0) echo 'active'; ?> in row" 
                     role="tabpanel" id="sale_<?php echo $value2['id']; ?>" aria-labelledby="home-tab">
                    <h3> Tổng cộng có <span class="total_contact_sale_<?php echo $value2['id'];?>"><?php echo count($value2['contacts']); ?> </span> contact mới tạm phân cho nhân viên <?php echo $value2['name'] ?> </h3>
                    <div class="col-md-10 col-md-offset-1">
                        <?php $this->load->view('common/content/tbl_contact', $value2); ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <input type="submit" value="OK" class="btn btn-success btn-lg btn-block" name="submit_ok"/>
        </div>
        <div class="col-md-6">
            <input type="submit" value="Cancel" class="btn btn-success btn-lg btn-block" name="submit_cancel"/>
        </div>
    </div>
</form>




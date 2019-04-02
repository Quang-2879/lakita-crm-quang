<div class="row">
    <h3 class="text-center"> Bạn đã chọn <strong><?php echo count($contacts); ?> </strong> contact để phân. </h3>
    <h3 class="text-center"> Vui lòng chọn nhân viên và số lượng contact tối đa của từng nhân viên </h3>
    <div class="col-md-10 col-md-offset-1">
        <form method="POST" action="<?php echo base_url() . 'manager/draft_divide_contact_even3'; ?>">
            <?php foreach ($staffs as $key => $value) { ?>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6 text-right">
                            <?php echo $value['name']; ?>
                        </div>
                        <div class="col-md-1">
                            <input type="text" class="form-control" name="max_contact[<?php echo $value['id']; ?>]" />
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="form-group text-center">
                <input type="submit" class="btn btn-success btn-lg" value="OK" />
            </div>
        </form>
    </div>
</div>
<h3 class="text-center"> Danh sách cụ thể </h3>
<?php $this->load->view('common/content/tbl_contact'); 

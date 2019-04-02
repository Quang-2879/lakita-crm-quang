<div class="modal fade view_duplicate_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog btn-very-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Danh sách contact bị trùng (<?php echo $total_contact; ?>)</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>
                                ID
                            </th>
                            <th>
                                Họ và tên
                            </th>
                            <th>
                                Số điện thoại
                            </th>
                            <th>
                                Mã khóa học
                            </th>
                            <th>
                                Địa chỉ
                            </th>
                            <th>
                                Ngày đăng ký
                            </th>
                            <th>
                                Trạng thái gọi
                            </th>
                            <th>
                                Trạng thái đơn hàng
                            </th>
                            <th>
                                Tư vấn tuyển sinh
                            </th>
                            <th colspan="2">
                                Thao tác
                            </th>
                        </tr>
                    <tbody>
                        <?php if(isset($primary_contact[0])){?>
                        <tr>
                            <td class="center">
                                <?php echo $primary_contact[0]['id']; ?>
                            </td>
                            <td class="center">
                                <?php echo $primary_contact[0]['name']; ?>
                            </td>
                            <td class="center">
                                <?php echo $primary_contact[0]['phone']; ?>
                            </td>
                            <td class="center">
                                <?php echo $primary_contact[0]['course_code']; ?>
                            </td>
                            <td class="center">
                                <?php echo $primary_contact[0]['address']; ?>
                            </td>
                            <td class="center">
                                <?php echo date('d/m/Y H:i:s', $primary_contact[0]['date_rgt']); ?>
                            </td>
                            <td>
                                <?php
                                foreach ($call_status as $key2 => $value2) {
                                    if ($value2['id'] == $primary_contact[0]['call_status_id']) {
                                        echo $value2['name'];
                                    }
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                foreach ($ordering_status as $key2 => $value2) {
                                    if ($value2['id'] == $primary_contact[0]['ordering_status_id']) {
                                        echo $value2['name'];
                                    }
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                foreach ($staffs as $key2 => $value2) {
                                    if ($value2['id'] == $primary_contact[0]['sale_staff_id']) {
                                        echo $value2['name'];
                                    }
                                }
                                ?>
                            </td>
                            <td class="center">
                                <a href="#" class="divide_one_contact_achor btn btn-success" 
                                   contact_id="<?php echo $primary_contact[0]['id']; ?>" contact_name="<?php echo $primary_contact[0]['name']; ?>"> Bàn giao </a>
                            </td>
                            <td class="center">
                            </td>
                        </tr>
                        <?php }?>
                        <?php
                        foreach ($rows as $key => $value) {
                            ?>
                            <tr class="<?php if ($value['duplicate_id'] != 0) echo 'duplicate duplicate_'.$value['id']; ?>">
                                <td class="center">
                                    <?php echo $value['id']; ?>
                                </td>
                                <td class="center">
                                    <?php echo $value['name']; ?>
                                </td>
                                <td class="center">
                                    <?php echo $value['phone']; ?>
                                </td>
                                <td class="center">
                                    <?php echo $value['course_code']; ?>
                                </td>
                                <td class="center">
                                    <?php echo $value['address']; ?>
                                </td>
                                <td class="center">
                                    <?php echo date('d/m/Y H:i:s', $value['date_rgt']); ?>
                                </td>
                                <td>
                                    <?php
                                    foreach ($call_status as $key2 => $value2) {
                                        if ($value2['id'] == $value['call_status_id']) {
                                            echo $value2['name'];
                                        }
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    foreach ($ordering_status as $key2 => $value2) {
                                        if ($value2['id'] == $value['ordering_status_id']) {
                                            echo $value2['name'];
                                        }
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    foreach ($staffs as $key2 => $value2) {
                                        if ($value2['id'] == $value['sale_staff_id']) {
                                            echo $value2['name'];
                                        }
                                    }
                                    ?>
                                </td>
                                <td class="center">
                                   
                                </td>
                                <td class="center">
                                        <a href="#" class="delete_one_contact btn btn-danger" contact_id="<?php echo $value['id']; ?>"> Xóa </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script>
   $(".divide_one_contact_achor").click(function (e) {
            e.preventDefault();
             $(".view_duplicate_modal").modal("hide");
        });
</script>
<?php //$this->load->view('manager/script/delete_contact'); ?>
<?php //$this->load->view('manager/script/divide_contact'); ?>
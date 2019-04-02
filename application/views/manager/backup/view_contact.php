<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function () {
        window.moveTo(0, 0);
        window.resizeTo(screen.width, screen.height);
        $("#datepicker").datepicker(
                {
                    dateFormat: "dd-mm-yy"
                }
        );
    });
</script>
<div class="container margintop45 marginbottom35 paddingright20">
    <div class="row">
        <h3 class="text-center"> Xem chi tiết </h3>
        <div class="col-md-6">
            <table class="table table-striped table-bordered table-hover">
                <tr>
                    <td class="text-right"> ID contact </td>
                    <td>  <?php echo $rows['id']; ?> </td>
                </tr>
                <tr>
                    <td class="text-right">  Họ và tên </td>
                    <td>  <?php echo $rows['name']; ?> </td>
                </tr>
                <tr>
                    <td class="text-right">  Email </td>
                    <td>  <?php echo $rows['email']; ?> </td>
                </tr>
                <tr>
                    <td class="text-right">   Số điện thoại </td>
                    <td>  <?php echo $rows['phone']; ?> </td>
                </tr>
                <tr>
                    <td class="text-right">   Địa chỉ </td>
                    <td>  <?php echo $rows['address']; ?> </td>
                </tr>
                <tr>
                    <td class="text-right">   Mã khóa học </td>
                    <td>  <?php echo $rows['course_code']; ?> </td>
                </tr>
                <tr>
                    <td class="text-right">   Giá tiền mua </td>
                    <td>  <?php echo $rows['price_purchase']; ?> </td>
                </tr>
                <tr>
                    <td class="text-right">   Ngày đăng ký </td>
                    <td>  <?php echo date(_DATE_FORMAT_, $rows['date_rgt']); ?> </td>
                </tr>
                <tr>
                    <td class="text-right">   Ngày nhận contact </td>
                    <td>  <?php
                        if ($rows['date_handover'] > 0)
                            echo date(_DATE_FORMAT_, $rows['date_handover']);
                        ?> 
                    </td>
                </tr>
                <tr>
                    <td class="text-right">   Ngày gọi gần nhất </td>
                    <td>  <?php
                        if ($rows['date_last_calling'] > 0)
                            echo date(_DATE_FORMAT_, $rows['date_last_calling']);
                        ?> 
                    </td>
                </tr>
                <tr>
                    <td class="text-right">  Ngày chốt đơn </td>
                    <td>  <?php
                        if ($rows['date_confirm'] > 0)
                            echo date(_DATE_FORMAT_, $rows['date_confirm']);
                        ?> 
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-striped table-bordered table-hover">
                <?php if (!empty($transfer_log)) { ?>
                    <tr>
                        <td class="text-right"> Lịch sử chuyển nhượng </td>
                        <td> 
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            STT
                                        </th>   
                                        <th>
                                            Nhân viên 1
                                        </th> 
                                        <th>
                                            Nhân viên 2
                                        </th> 
                                        <th>
                                            Thời gian
                                        </th>   
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($transfer_log as $key => $value) { ?>
                                        <tr>
                                            <td class="center">
                                                <?php echo $key + 1; ?>
                                            </td>
                                            <td class="center">
                                                <?php
                                                foreach ($staffs as $key2 => $value2) {
                                                    if ($value['sale_id_1'] == $value2['id']) {
                                                        echo $value2['name'];
                                                        break;
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td class="center">
                                                <?php
                                                foreach ($staffs as $key2 => $value2) {
                                                    if ($value['sale_id_2'] == $value2['id']) {
                                                        echo $value2['name'];
                                                        break;
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td class="center">
                                                <?php echo date(_DATE_FORMAT_, $value['time']); ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td class="text-right"> Tư vấn tuyển sinh </td>
                    <td>  <?php
                        foreach ($staffs as $key => $value) {
                            if ($value['id'] == $rows['sale_staff_id']) {
                                echo $value['name'];
                                break;
                            }
                        }
                        ?> 
                    </td>
                </tr>
                <tr>
                    <td class="text-right">  Trạng thái gọi </td>
                    <td>  <?php
                        foreach ($call_stt as $key => $value) {
                            if ($value['id'] == $rows['call_status_id']) {
                                echo $value['name'];
                                break;
                            }
                        }
                        ?> 
                    </td>
                </tr>
                <tr>
                    <td class="text-right">   Trạng thái đơn hàng </td>
                    <td>  <?php
                        foreach ($ordering_stt as $key => $value) {
                            if ($value['id'] == $rows['ordering_status_id']) {
                                echo $value['name'];
                                break;
                            }
                        }
                        ?> 
                    </td>
                </tr>
                <tr>
                    <td class="text-right"> Ma trận </td>
                    <td> <?php echo $rows['matrix']; ?>  </td>
                </tr>
                <tr>
                    <td class="text-right"> Ngày khách hẹn gọi lại </td>
                    <td>   <?php if ($rows['date_recall'] > 0) echo date('d-m-Y', $rows['date_recall']); ?>  
                    </td>
                </tr>
                <tr>
                    <td class="text-right"> Ghi chú </td>
                    <td> 
                        <?php if (!empty($note)) { ?>
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            STT
                                        </th>   
                                        <th>
                                            Nội dung
                                        </th> 
                                        <th>
                                            Thời gian
                                        </th> 
                                        <th>
                                            Người viết ghi chú
                                        </th>   
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($note as $key => $value) { ?>
                                        <tr>
                                            <td class="center">
                                                <?php echo $key + 1; ?>
                                            </td>
                                            <td class="center">
                                                <?php echo $value['content']; ?>
                                            </td>	
                                            <td class="center">
                                                <?php echo date(_DATE_FORMAT_, $value['time']); ?>
                                            </td>
                                            <td class="center">
                                                <?php
                                                foreach ($staffs as $key2 => $value2) {
                                                    if ($value['sale_id'] == $value2['id']) {
                                                        echo $value2['name'];
                                                        break;
                                                    }
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        <?php } ?>
                    </td>
                </tr>
                <tr>
                    <?php if ($rows['duplicate_id'] == 0 && $rows['sale_staff_id'] == 0) { ?>
                        <td class="center">
                            <a href="#" class="divide_one_contact_achor btn btn-success" 
                               contact_id="<?php echo $rows['id']; ?>"
                               contact_name="<?php echo $rows['name']; ?>"> Bàn giao contact </a>
                        </td>
                    <?php } ?>
                    <?php if ($rows['duplicate_id'] != 0) { ?>
                        <td>
                            <a href="#" class="view_duplicate btn btn-success" duplicate_id="<?php echo $rows['duplicate_id']; ?>"> Xem contact trùng </a>
                        </td>
                    <?php } ?>
                    <?php if ($rows['duplicate_id'] != 0) { ?>
                        <td class="center">
                            <a href="#" class="delete_one_contact btn btn-danger" contact_id="<?php echo $rows['id']; ?>"> Xóa contact </a>
                        </td>
                    <?php } ?>
                </tr>
            </table>
        </div>
    </div>
    <div class="text-center">
        <button class="back_location btn btn-success"> Quay lại </button> 
    </div>
</div>
</div>
<?php $this->load->view('manager/modal/divide_one_contact'); ?>
<?php $this->load->view('manager/script/divide_contact'); ?>
<?php $this->load->view('manager/script/delete_contact'); ?>
<?php $this->load->view('manager/script/view_duplicate'); ?>

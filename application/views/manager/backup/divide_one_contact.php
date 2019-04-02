<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $(function () {
        $("#datepicker").datepicker(
                {
                    dateFormat: "dd-mm-yy"
                }
        );
    });
</script>
<div class="container margintop45 marginbottom35">
    <div class="col-md-8 col-md-offset-1">
        <h3 class="text-center"> Bàn giao contact cho nhân viên sale</h3>
        <form method="post" action="#">
            <input type="hidden" name="back_location" />
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4 text-right">
                        ID contact
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" placeholder="<?php echo $rows['id']; ?>" disabled />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4 text-right">
                        Họ và tên
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" value="<?php echo $rows['name']; ?>" name="name" disabled/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4 text-right">
                        Email
                    </div>
                    <div class="col-md-8">
                        <input type="email" class="form-control" value="<?php echo $rows['email']; ?>" name="email" disabled/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4 text-right">
                        Số điện thoại
                    </div>
                    <div class="col-md-8">
                        <input type="tel" class="form-control" value="<?php echo $rows['phone']; ?>" name="phone" disabled/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4 text-right">
                        Địa chỉ
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" value="<?php echo $rows['address']; ?>" name="address" disabled/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4 text-right">
                        Mã khóa học
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" value="<?php echo $rows['course_code']; ?>" name="course_code" disabled/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4 text-right">
                        Giá tiền mua
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" value="<?php echo $rows['price_purchase']; ?>" name="price_purchase" disabled/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4 text-right">
                        Ngày đăng ký
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" placeholder="<?php echo date('d/m/Y H:i:s', $rows['date_rgt']); ?>" disabled/>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <div class="row">
                    <div class="col-md-4 text-right">
                        Nhân viên phụ trách contact
                    </div>
                    <div class="col-md-8">
                        <select class="form-control" name="sale_staff_id">
                            <option value="0"> Chọn Nhân viên sale</option>
                            <?php
                            // print_arr($this->CALL_STT);
                            foreach ($staffs as $key => $value) {
                                ?>
                                <option value="<?php echo $value['id']; ?>" <?php if ($value['id'] == $rows['sale_staff_id']) echo 'selected'; ?>>
                                    <?php echo $value['name']; ?>
                                </option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4 text-right">
                        Ma trận
                    </div>
                    <div class="col-md-8">
                        <input type="text" class="form-control" placeholder="<?php echo $rows['matrix']; ?>" disabled/>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <div class="row">
                    <div class="col-md-4 text-right">
                        Ghi chú
                    </div>
                    <div class="col-md-8">
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
                                                <?php echo date('d/m/Y H:i:s', $value['time']); ?>
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
                        <textarea class="form-control" rows="3" name="note"></textarea>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success btn-lg">Submit</button>
            </div>
        </form>
    </div>
</div>
<div class="container margintop45 marginbottom35">
    <?php echo validation_errors(); ?>
    <div class="row">
        <div class="col-md-7 col-md-offset-1">
             <h3 class="text-center marginbottom20"> Thêm mới contact </h3>
            <form method="post" action="<?php echo base_url('manager/add_contact'); ?>">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4 text-right">
                            Họ và tên
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="Họ và tên" name="name" value="<?php echo set_value('name')?>"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4 text-right">
                            Email
                        </div>
                        <div class="col-md-8">
                            <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo set_value('email')?>"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4 text-right">
                            Số điện thoại
                        </div>
                        <div class="col-md-8">
                            <input type="tel" class="form-control" placeholder="Số điện thoại" name="phone" value="<?php echo set_value('phone')?>"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4 text-right">
                            Địa chỉ
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="Địa chỉ" name="address" value="<?php echo set_value('address')?>"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4 text-right">
                            Khóa học
                        </div>
                        <div class="col-md-8">
                            <select class="form-control" name="course_code">
                                <option value="empty"> Chọn khóa học </option>
                                <?php foreach ($courses as $key => $value) { ?>
                                    <option value="<?php echo $value['course_code']; ?>"
                                            <?php if(set_value('course_code') == $value['course_code']) echo "selected"; ?>>
                                        <?php echo $value['course_code']; ?> 
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4 text-right">
                            Nguồn kênh
                        </div>
                        <div class="col-md-8">
                            <select class="form-control" name="source_id">
                                <option value="0"> Chọn nguồn kênh </option>
                                <?php foreach ($sources as $key => $value) { ?>
                                    <option value="<?php echo $value['id']; ?>"
                                             <?php if(set_value('source_id') == $value['id']) echo "selected"; ?>>
                                        <?php echo $value['name']; ?> 
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4 text-right">
                            Hình thức mua
                        </div>
                        <div class="col-md-8">
                            <select class="form-control" name="payment_method_rgt">
                                <option value="1"> COD </option>
                                <option value="2"> Chuyển khoản </option>
                                <option value="3"> ATM </option>
                                <option value="4"> Thanh toán trực tiếp </option>
                                <option value="5"> VISA </option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4 text-right">
                            Giá tiền mua
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" placeholder="Giá tiền" name="price_purchase" value="495000"/>
                        </div>
                    </div>
                </div>
                <!--                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4 text-right">
                                            Ngày đăng ký
                                        </div>
                                        <div class="col-md-8">
                                             <input type="text" class="form-control" id="datepicker" name="date_rgt" />
                                        </div>
                                    </div>
                                </div>-->
                <!--                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-4 text-right">
                                            Ma trận
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" placeholder="Ma trận" name="matrix"/>
                                        </div>
                                    </div>
                                </div>-->
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4 text-right">
                            Ghi chú
                        </div>
                        <div class="col-md-8">
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
</div>

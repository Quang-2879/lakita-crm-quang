<form method="post" action="<?php echo base_url(); ?>MANAGERS/teacher/action_edit_teacher/<?php echo $rows['id']; ?>" class="form_submit">
    <div class="row" style="margin-right: 5px; margin-left: 5px;">
        <div class="col-md-6">
            <table class="table table-striped table-bordered table-hover table-1 table-view-1 heavyTable">

                <tr>
                    <td class="text-right"> Username </td>
                    <td>  
                        <input type="text" class="form-control" name="username" value="<?php echo $rows['username']; ?>" />
                    </td>
                </tr>
                <?php if ($rows['password'] == '') { ?>
                    <tr>
                        <td class="text-right"> Mật khẩu </td>
                        <td>  
                            <input type="password" class="form-control" name="password" value="" />
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right"> Nhập lại mật khẩu </td>
                        <td>  
                            <input type="password" class="form-control" name="re-password" value="" />
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td class="text-right"> Họ tên </td>
                    <td>  
                        <input type="text" class="form-control" name="name" value="<?php echo $rows['name']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td class="text-right"> Email </td>
                    <td>  
                        <input type="text" class="form-control" name="email" value="<?php echo $rows['email']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td class="text-right"> Số điện thoại </td>
                    <td>  
                        <input type="text" class="form-control" name="phone" value="<?php echo $rows['phone']; ?>"  />
                        <input type="hidden" class="form-control" name="role_id" value="1"  />
                    </td>
                </tr>
                <tr>
                    <td class="text-right"> Các khóa học của giảng viên </td>
                    <td>  
                        <select class="form-control selectpicker" name="course[]" multiple>
                            <?php foreach ($courses as $key => $value) { ?>
                                <option value="<?php echo $value['course_code']; ?>"
                                <?php
                                if (in_array($value['course_code'], explode(';', $rows['course']))) {
                                    echo 'selected';
                                }
                                ?>>
                                            <?php echo $value['course_code']; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-striped table-bordered table-hover table-2 table-view-2">
                <tr>
                    <td class="text-right"> Trừ VAT (%) </td>
                    <td>  
                        <div class="form-horizontal">
                            <?php if(!empty($rows['vat'])){
                                $rows['vat'] = explode(';', $rows['vat']);
                            } ?>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Lakita bán :</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="vat1" min="0" step="0.01" value="<?php if(isset($rows['vat'][0])){ echo $rows['vat'][0];}else{ echo 0;}?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Ngoài bán :</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="vat2" min="0" step="0.01" value="<?php if(isset($rows['vat'][1])){ echo $rows['vat'][1];}else{ echo 0;}?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Thầy bán :</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="vat3" min="0" step="0.01" value="<?php if(isset($rows['vat'][2])){ echo $rows['vat'][2];}else{ echo 0;}?>" />
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td class="text-right"> Lợi nhuận (%)</td>
                    <td>
                        <div class="form-horizontal">
                            <?php if(!empty($rows['profit'])){
                                $rows['profit'] = explode(';', $rows['profit']);
                            } ?>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Lakita bán :</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="profit1" min="0" step="0.01" value="<?php if(isset($rows['profit'][0])){ echo $rows['profit'][0];}else{ echo 0;}?>"  />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Ngoài bán :</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="profit2" min="0" step="0.01" value="<?php if(isset($rows['profit'][1])){ echo $rows['profit'][1];}else{ echo 0;}?>"  />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label">Thầy bán :</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="profit3" min="0" step="0.01" value="<?php if(isset($rows['profit'][2])){ echo $rows['profit'][2];}else{ echo 0;}?>"  />
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="text-right"> Trừ phí COD </td>
                    <td>
                        <input type="checkbox" name="cod" value="1" data-off-text="Không" data-on-text="Có" data-handle-width="100" <?php if ($rows['cod'] == 1) { ?>
                                   checked="checked" <?php } ?>>
                    </td>
                <script>
                    $("[name='cod']").bootstrapSwitch();
                </script>
                </tr>

                <tr>
                    <td class="text-right"> Hoạt động </td>
                    <td>  
                        <input type="text" class="form-control" name="active" value="<?php echo $rows['active']; ?>" />
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-success btn-lg">Lưu Lại</button>
    </div>
</form>

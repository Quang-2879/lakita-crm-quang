<form method="post" action="<?php echo base_url(); ?>CODS/check_L8/action_edit_bill/<?php echo $rows['id'];?>" class="form_submit">
    <div class="row" style="margin-right: 5px; margin-left: 5px;">
        <div class="col-md-6">
            <table class="table table-striped table-bordered table-hover table-1 table-view-1 heavyTable">
                <tr>
                    <td class="text-right"> ID Bill </td>
                    <td>  
                        <input type="text" class="form-control" placeholder="<?php echo $rows['id']; ?>" disabled />
                    </td>
                </tr>
                <tr>
                    <td class="text-right"> Số thứ tự </td>
                    <td>  
                        <input type="text" class="form-control" placeholder="<?php echo $rows['stt']; ?>" disabled />
                    </td>
                </tr>
                <tr>
                    <td class="text-right"> Mã Bill </td>
                    <td>  
                        <input type="text" class="form-control" name="code" value="<?php echo $rows['code']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td class="text-right"> Số tiền Viettel thu </td>
                    <td>  
                        <input type="text" class="form-control" name="money" value="<?php echo $rows['money']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td class="text-right"> Số tiền giao cho Viettel </td>
                    <td>  
                        <input type="text" class="form-control" name="price_purchase" value="<?php echo $rows['price_purchase']; ?>" />
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table table-striped table-bordered table-hover table-2 table-view-2">
                 <tr>
                    <td class="text-right"> Họ tên </td>
                    <td>  
                        <input type="text" class="form-control" placeholder="<?php echo $rows['name']; ?>" disabled />
                    </td>
                </tr>
                 <tr>
                    <td class="text-right"> Số điện thoại </td>
                    <td>  
                        <input type="text" class="form-control" placeholder="<?php echo $rows['phone']; ?>" disabled />
                    </td>
                </tr>
                 <tr>
                    <td class="text-right"> Địa chỉ </td>
                    <td>  
                        <input type="text" class="form-control" placeholder="<?php echo $rows['address']; ?>" disabled />
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-success btn-lg btn-edit-contact-1">Lưu Lại</button>
    </div>

</form>

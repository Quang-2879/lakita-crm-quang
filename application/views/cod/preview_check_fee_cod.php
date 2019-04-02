<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h3 class="text-center marginbottom35"> Kết quả đối soát cước vận đơn </h3>
    </div>
</div>
<form action="<?php echo base_url(); ?>cod/confirm_check_fee_cod" method="POST" id="action_contact" class="form-inline"> 
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <table class="table table-striped table-bordered table-hover">
                <tr>
                    <td class="text-right"> Contact đúng thông tin mã vận đơn </td>
                    <td>
                        <select class="form-control correct_cod" name="correct_cod">
                            <option value="0" <?php if (!isset($_GET['correct_cod'])) { ?> selected="selected" <?php } ?>>  </option>
                            <option value="yes" <?php if (isset($_GET['correct_cod']) && $_GET['correct_cod'] == 'yes') echo 'selected'; ?>> Có </option>
                            <option value="no" <?php if (isset($_GET['correct_cod']) && $_GET['correct_cod'] == 'no') echo 'selected'; ?>>  Không </option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="text-right">
                        <input type="submit" class="btn btn-success filter_contact" value="Lọc" />
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <table class="table table-bordered table-striped list_contact">
        <thead>
            <tr>
                <th class="tbl_selection check_all">
                    Chọn
                </th>
                <th>
                    STT
                </th>
                <th class="order_code_cross_check tbl_code_cross_check">
                    <input type="text" class="order_code_cross_check hidden" name="order_code_cross_check"
                           value="<?php echo (isset($_GET['order_code_cross_check'])) ? $_GET['order_code_cross_check'] : '0'; ?>" />
                    Mã Bill
                    <?php
                    if (isset($_GET['order_code_cross_check']) && $_GET['order_code_cross_check'] == 'DESC')
                        echo '<i class="fa fa-arrow-down" aria-hidden="true" style="font-size: 10px;"></i>';
                    else if (isset($_GET['order_code_cross_check']) && $_GET['order_code_cross_check'] == 'ASC')
                        echo '<i class="fa fa-arrow-up" aria-hidden="true" style="font-size: 10px;"></i>';
                    else
                        echo '<i class="fa fa-arrows-v" aria-hidden="true" style="font-size: 10px;"></i>';
                    ?>
                </th>
                <th>
                    Số tiền Viettel thu
                </th>
                
                <th>
                    Họ và tên
                </th>
                <th>
                    Số điện thoại
                </th>
                <th class="tbl_email">
                    Địa chỉ
                </th>

        </thead>
        <tbody>
            <?php
            if (isset($contacts)) {
                foreach ($contacts as $value) {
                    ?>
                    <tr <?php if ($value['is_match'] == 0) echo 'class="duplicate"'; ?>>
                        <td class="center tbl_selection">
                            <input type="checkbox" name="contact_id[]" value="<?php echo $value['contact_id']; ?>" />
                        </td>
                        <td> <?php echo $value['stt'] ?> </td>
                        <td> <?php echo $value['code'] ?> </td>
                        <td> <?php echo $value['money'] ?> </td>
                       
                        <td> <?php echo $value['name'] ?> </td>
                        <td> <?php echo $value['phone'] ?> </td>
                        <td> <?php echo $value['address'] ?> </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
    <input type="submit" class="btn btn-success" value="Lưu cước" />
</form>

<script>
    $('.correct_cod').on('change', function () {
        $("#action_contact").attr("action", "#").attr("method", "GET");
        $("#action_contact").submit();
    });
</script>
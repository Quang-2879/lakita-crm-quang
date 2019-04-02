<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h3 class="text-center marginbottom35"> Kết quả đối soát (L8)</h3>
    </div>
</div>
<form action="<?php echo base_url(); ?>CODS/check_L8/confirm_check_l8" method="POST" id="action_contact" class="form-inline"> 
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
                    <td class="text-right"> Contact đối soát bị trùng </td>
                    <td>
                        <select class="form-control correct_cod" name="is_duplicate">
                            <option value="0" <?php if (!isset($_GET['is_duplicate'])) { ?> selected="selected" <?php } ?>>  </option>
                            <option value="yes" <?php if (isset($_GET['is_duplicate']) && $_GET['is_duplicate'] == 'yes') echo 'selected'; ?>> Có </option>
                            <option value="no" <?php if (isset($_GET['is_duplicate']) && $_GET['is_duplicate'] == 'no') echo 'selected'; ?>>  Không </option>
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
    <div class="number_paging" > 
        Tổng tiền Viettel thu của khách: <?php echo isset($contacts) ? number_format(h_sum_money_1($contacts), 0, ",", ".") . " VNĐ" : 0; ?>
    </div>
    <div class="number_paging" > 
        Tổng tiền giao cho viettel: <?php echo isset($contacts) ? number_format(h_sum_money($contacts), 0, ",", ".") . " VNĐ" : 0; ?>
    </div>
    <a href="#" class="btn btn-danger delete_multi_bill">Xóa các dòng đã chọn  </a>
    <input type="submit" class="btn btn-success" value="Lưu thành Đã thu Lakita" />
    <table class="table table-bordered table-striped list_contact">
        <thead>
            <tr>
                <th class="tbl_selection check_all">
                    Chọn
                </th>
                <th>
                    ID 
                </th>
                <th>
                    STT
                </th>
                <th class="order_code_cross_check tbl_code_cross_check">
                    <input type="text" class="order_code_cross_check hidden" name="order_code_cross_check"
                           value="<?php echo (isset($_GET['order_code_cross_check'])) ? $_GET['order_code_cross_check'] : '0'; ?>" />
                    Mã Bill
                    <?php
                    if (isset($_GET['order_code_cross_check']) && $_GET['order_code_cross_check'] == 'DESC') {
                        echo '<i class="fa fa-arrow-down" aria-hidden="true" style="font-size: 10px;"></i>';
                    } else if (isset($_GET['order_code_cross_check']) && $_GET['order_code_cross_check'] == 'ASC') {
                        echo '<i class="fa fa-arrow-up" aria-hidden="true" style="font-size: 10px;"></i>';
                    } else {
                        echo '<i class="fa fa-arrows-v" aria-hidden="true" style="font-size: 10px;"></i>';
                    }
                    ?>
                </th>
                <th>
                    Số tiền Viettel thu
                </th>
                <th>
                    Số tiền giao cho Viettel
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
                <th>
                    Thao tác
                </th>
        </thead>
        <tbody>
            <?php
            if (isset($contacts)) {
                foreach ($contacts as $value) {
                    $class = '';
                    if ($value['is_match'] == 0) {
                        $class .= " duplicate";
                    }
                    if ($value['duplicate_id'] > 0) {
                        $class .= " duplicate_bill";
                    }
                    ?>
                    <tr class="<?php echo $class; ?>">
                        <td class="center tbl_selection">
                            <input type="checkbox" name="bill_id[]" value="<?php echo $value['id']; ?>" />
                        </td>
                        <td> <?php echo $value['id'] ?> </td>
                        <td> <?php echo $value['stt'] ?> </td>
                        <td> <?php echo $value['code'] ?> </td>
                        <td> <?php echo $value['money'] ?> </td>
                        <td> <?php echo $value['price_purchase'] ?> </td>
                        <td> <?php echo $value['name'] ?> </td>
                        <td> <?php echo $value['phone'] ?> </td>
                        <td> <?php echo $value['address'] ?> </td>
                        <td class="center">
                            <div class="center btn-group">
                                <a href="#"
                                   class="btn btn-danger delete_bill"
                                   bill_id="<?php echo $value['id']; ?>"
                                   title="Xóa dòng đối soát"> 
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                </a>
                                <?php if ($value['phone'] != '') { ?>
                                    <a href="#"
                                       class="btn btn-warning edit_bill"
                                       bill_id="<?php echo $value['id']; ?>"
                                       title="Chỉnh sửa dòng"> 
                                        <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                    </a>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
    <a href="#" class="btn btn-danger delete_multi_bill">Xóa các dòng đã chọn  </a>
    <input type="submit" class="btn btn-success" value="Lưu thành Đã thu Lakita" />
</form>
<div class="number_paging" > 
    Tổng tiền Viettel thu của khách: <?php echo isset($contacts) ? number_format(h_sum_money_1($contacts), 0, ",", ".") . " VNĐ" : 0; ?>
</div>
<div class="number_paging" > 
    Tổng tiền giao cho viettel: <?php echo isset($contacts) ? number_format(h_sum_money($contacts), 0, ",", ".") . " VNĐ" : 0; ?>
</div>
<script>
    $('.correct_cod').on('change', function () {
        $("#action_contact").attr("action", "#").attr("method", "GET");
        $("#action_contact").submit();
    });
    $("a.delete_multi_bill").click(function (e) {
        e.preventDefault();
        $("#action_contact").attr("action", "<?php echo base_url() . 'CODS/check_L8/delete_multi_bill'; ?>");
        $("#action_contact").submit();
    });
</script>
<?php
$this->load->view('cod/check_L8/modal/show_edit_bill');

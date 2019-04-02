<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h3 class="text-center marginbottom35"> Xem trước kết quả đối soát đơn hàng (L7)</h3>
    </div>
</div>
<form action="<?php echo base_url(); ?>cod/confirm_check_l7" method="POST" id="action_contact" class="form-inline"> 
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <table class="table table-striped table-bordered table-hover">
                <tr>
                    <td class="text-right"> Trạng thái giao hàng </td>
                    <td>
                        <select class="form-control ordering_status_id filter" name="filter_draft_cod_status_id">
                            <option value="empty"> Chọn trạng thái giao hàng </option>
                            <?php
                            foreach ($cod_status as $key => $value) {
                                ?>
                                <option value="<?php echo $value['id']; ?>"
                                        <?php if (isset($_GET['filter_draft_cod_status_id']) && $value['id'] == $_GET['filter_draft_cod_status_id']) echo 'selected'; ?>>
                                            <?php echo $value['name']; ?>
                                </option>
                                <?php
                            }
                            ?>
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
                    Mã Bill
                </th>
                <th>
                    Trạng thái
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
                    <tr>
                        <td class="center tbl_selection">
                            <input type="checkbox" name="contact_id[]" value="<?php echo $value['id']; ?>" />
                        </td>
                        <td> <?php echo $value['draft_cross_code_check'] ?> </td>
                        <td>  <?php
                            foreach ($cod_status as $key2 => $value2) {
                                if ($value2['id'] == $value['draft_cod_status_id']) {
                                    echo $value2['name'];
                                    break;
                                }
                            }
                            ?> </td>
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
    <input type="submit" class="btn btn-success" value="Lưu lại" />
</form>
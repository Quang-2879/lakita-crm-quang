<h4 class="text-center"> Lựa chọn những TVTS muốn hiển thị (tại các combo box) </h4>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <form action="#" method="POST">
            <table class="table table-bordered table-striped select-sale-active">
                <?php
                //print_arr($staffs);
                foreach ($staffs as $value) {
                    ?>
                    <tr  <?php if ($value['active'] == '1') echo 'class="checked"'; ?>>
                        <td> 
                            <input type="checkbox" name="sale_id[]" 
                                   value="<?php echo $value['id']; ?>"
                                   <?php if ($value['active'] == '1') echo 'checked="checked"'; ?>
                                   /> 
                        </td>
                        <td> <?php echo $value['name']; ?> </td>
                    </tr>
                <?php }
                ?>
            </table>
            <div class="text-center">
                <input type="submit" class="btn btn-success" value="Lưu lại" />
            </div>
        </form>
    </div>
</div>


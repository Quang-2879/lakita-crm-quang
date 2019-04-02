<div class="row">
    <div class="col-md-6">
        <table class="table table-striped table-bordered table-hover filter-tbl-1">
            <tr>
                <td class="text-right"> Họ tên </td>
                <td>  
                    <input type="text" class="form-control real-search" name="name" type_search="name" value="<?php echo isset($_GET['name']) ? $_GET['name'] : ''; ?>" />
                </td>
            </tr>
            <tr>
                <td class="text-right"> Email </td>
                <td>  
                    <input type="text" class="form-control real-search" name="email" type_search="email" value="<?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?>" />
                </td>
            </tr>
        </table>
    </div>
    <div class="col-md-6">
        <table class="table table-striped table-bordered table-hover filter-tbl-2">
            <tr>
                <td class="text-right"> Điện thoại </td>
                <td>  
                    <input type="text" class="form-control real-search" name="phone" type_search="phone" value="<?php echo isset($_GET['phone']) ? $_GET['phone'] : ''; ?>" />
                </td>
            </tr>
            <tr>
                <td class="text-right"> ID contact </td>
                <td>  
                    <input type="text" class="form-control real-search" name="id_contact" type_search="id_contact" value="<?php echo isset($_GET['id_contact']) ? $_GET['id_contact'] : ''; ?>" />
                </td>
            </tr>
            <tr>
                <td class="text-center" colspan="2"><input type="submit" class="btn btn-success" value="Tìm kiếm" /> </td>
            </tr>
        </table>
    </div>
</div>
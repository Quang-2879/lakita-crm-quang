<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h3 class="text-center marginbottom20"> Danh sách các Kho (<?php echo $total; ?>)</h3>
        </div>
    </div>
    <form action="#" method="GET" class="form-inline" id="form_item">
        <div class="pagination">
            <?php if (isset($pagination_link)): ?>
                <?php echo $pagination_link;  ?>
            <?php endif ?>
        </div>
        <a class="add_item btn btn-primary" href="#"> Thêm 1 dòng mới </a> 
        <a class="btn btn-success" href="<?php echo base_url('warehouse/cost'); ?>" title="Nhập chi phí hàng tháng">Nhập chi phí hàng tháng</a>
        <table class="table table-bordered table-striped list_contact list_contact_2 table-fixed-head"> 
            <thead>
                <tr>
                    <th class="tbl_landingpage_id" id="th_id"> ID Kho</th>
                    <th class="tbl_landingpage_landingpage_code" id="th_landingpage_code"> Tên kho</th>
                    <th>Của Lakita?</th>
                    <th>Người tạo</th>
                    <th>Ngày tạo</th>
                    <th class="tbl_landingpage_active" id="th_active"> Hoạt động</th>
                </tr> 
            </thead>
            <?php if (!empty($warehouses)): ?>
            <?php foreach ($warehouses as $item): ?>
            <tr class="text-center" item_id="<?php echo $item['id']; ?>" edit-url="<?php echo base_url(); ?>warehouse/edit" >
                <td class='tbl_id'><?php echo $item['id']; ?></td>
                <td><?php echo $item['name']; ?></td>
                <td><input disabled="disabled" type="checkbox" name="lakita" <?php if ($item['lakita']) echo 'checked'; ?> ></td>
                <td><?php echo $item['creater']; ?></td>
                <td><?php echo $item['created']; ?></td>
                <td> <div class="toggle-input marginbottom20"> <label class="switch"> <input disabled="disabled" type="checkbox" data-url="<?php echo base_url(); ?>warehouse/edit_active" name="edit_active" item_id="111" <?php if ($item['active']) echo 'checked'; ?>/> <span class="slider round"></span> </label> </div> </td>
            </tr>
            <?php endforeach ?>
            <?php endif ?>
        </table>
        <input type="submit" class="hidden" id="submit_get_form"/>
        <div class="pagination">
            <?php if (isset($pagination_link)): ?>
                <?php echo $pagination_link;  ?>
            <?php endif ?>
        </div>
    </form>  
    <div class="add_item"> 
        <div class="modal fade add_item_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Thêm 1 dòng mới</h4>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="<?php echo base_url('warehouse/create'); ?>" class="form_submit">
                        <!-- https://crm2.lakita.vn/MANAGERS/landingpage/action_add_item -->
                            <table class="table table-striped table-bordered table-hover table-1 table-view-1 heavyTable" style="height: 154px;"> 
                                <tbody>
                                    <tr>
                                        <td class="text-right"> Tên kho </td>
                                        <td> <input type="text" name="name" class="form-control" value=""> </td>
                                    </tr>
                                    <tr> 
                                        <td class="text-right"> Của Lakita? </td>
                                        <td><input type="checkbox" name="lakita" value="">
                                        </td>
                                    </tr>
                                    <tr> 
                                        <td class="text-right"> Hoạt động? </td>
                                        <td><input type="checkbox" name="active" checked>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                                <input type="hidden" name="creater" value="<?php echo $this->session->userdata('name'); ?>">
                            <div class="text-center"> <button type="submit" class="btn btn-success btn-lg">Lưu Lại</button> </div>
                        </form>
                    </div>
                    <div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div> 
        </div>
    </div>     
    <div class="edit_item">
        <div class="modal fade edit_item_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content"> 
                    <div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> <h4 class="modal-title" id="myModalLabel">Sửa thông tin Kho</h4> </div>
                    <div class="modal-body">
                        
                    </div>
                    <div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> </div> </div> </div>
        </div>
    </div>
</div>
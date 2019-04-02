
<div class="add_item">
    <div class="modal fade add_item_modal_fetch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog btn-very-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Thêm 1 dòng mới</h4>
                </div>
                <div class="modal-body replace_content_add_item_fetch_modal">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="add_item">
    <div class="modal fade add_item_from_fb_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog btn-very-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Thêm 1 dòng mới</h4>
                </div>
                <div class="modal-body replace_content_add_item_from_fb_modal">
                    <form method="post" action="<?php echo base_url(); ?>MANAGERS/adset/action_add_item" class="form_submit">
                        <div class="row" style="margin-right: 5px; margin-left: 5px;">
                            <div class="col-md-6">
                                <table class="table table-striped table-bordered table-hover table-add-1">
                                    <tbody>
                                        <tr>
                                            <td class="text-right">
                                                Tên adset 
                                            </td>
                                            <td>
                                                <input type="text" name="add_name" class="form-control add-name-from-fb" value="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right">
                                                Chọn chiến dịch
                                            </td>
                                            <td class="select-campaign-fetch">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right">
                                                Adset ID Facebook </td>
                                            <td>
                                                <input type="text" name="add_adset_id_facebook" class="form-control add-adset-id-from-fb" value="">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-striped table-bordered table-hover table-add-2">
                                    <tbody>
                                        <tr>
                                            <td class="text-right">
                                                Mô tả </td>
                                            <td>
                                                <div class="form-group">
                                                    <textarea class="form-control" rows="5" name="add_desc"> </textarea>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="text-right">
                                                Hoạt động </td>
                                            <td>
                                                <input type="text" name="add_active" class="form-control" value="1">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-lg">Lưu Lại</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

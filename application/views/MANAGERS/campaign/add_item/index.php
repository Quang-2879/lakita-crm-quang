<div class="add_item">
    <div class="modal fade add_item_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog btn-very-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Thêm 1 dòng mới</h4>
                </div>
                <div class="modal-body replace_content_add_item_modal">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="add_item">
    <div class="modal fade add_item_modal_fetch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document" style="width: 1345px;">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <h4 class="modal-title" id="myModalLabel">Danh sách các campaign, adset, ads lấy được từ FB</h4>
                </div>
                <div class="modal-body replace_content_add_item_fetch_modal">

                </div>
                 <div class="modal-footer">
                     <div class="alert alert-danger" role="alert" style="text-align: left"> Ấn Ctrl + I để tắt hộp thoại này </div>
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
                    <form method="post" action="<?php echo base_url(); ?>MANAGERS/campaign/action_add_item" class="form_submit">
                        <div class="row" style="margin-right: 5px; margin-left: 5px;">
                            <div class="col-md-6">
                                <table class="table table-striped table-bordered table-hover table-add-1">
                                    <tbody>
                                        <tr>
                                            <td class="text-right">
                                                Tên chiến dịch 
                                            </td>
                                            <td>
                                                <input type="text" name="add_name" class="form-control add-name-from-fb" value="">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right">
                                                Chọn kênh quảng cáo
                                            </td>
                                            <td>
                                                <select class="form-control selectpicker" name="add_channel_id">
                                                    <option value="2" selected="selected"> Facebook Ads</option>
                                                </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-right">
                                                Campaign ID Facebook </td>
                                            <td>
                                                <input type="text" name="add_campaign_id_facebook" class="form-control add-campaign-id-from-fb" value="">
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

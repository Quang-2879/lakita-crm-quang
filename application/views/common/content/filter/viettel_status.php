<tr class="filter_tu_van">
    <td class="text-right"> Trạng thái Viettel </td>
    <td>
        <select class="form-control filter selectpicker" name="filter_viettel_tracking_status">
            <option value="" <?php if (!isset($_GET['filter_viettel_tracking_status'])) { ?> selected="selected" <?php } ?>>  </option>
            <option value="Nhập phiếu gửi" <?php if (isset($_GET['filter_viettel_tracking_status']) && $_GET['filter_viettel_tracking_status'] == 'Nhập phiếu gửi') echo 'selected'; ?>> 
                Nhập phiếu gửi
            </option>
            <option value="Giao bưu tá đi phát" <?php if (isset($_GET['filter_viettel_tracking_status']) && $_GET['filter_viettel_tracking_status'] == 'Giao bưu tá đi phát') echo 'selected'; ?>>  
                Giao bưu tá đi phát 
            </option>
            <option value="Không liên hệ được người nhận" <?php if (isset($_GET['filter_viettel_tracking_status']) && $_GET['filter_viettel_tracking_status'] == 'Không liên hệ được người nhận') echo 'selected'; ?>>  
                Không liên hệ được người nhận
            </option>
            <option value="Phát thành công" <?php if (isset($_GET['filter_viettel_tracking_status']) && $_GET['filter_viettel_tracking_status'] == 'Phát thành công') echo 'selected'; ?>>  
                Phát thành công
            </option>
            <option value="Chờ duyệt Chuyển hoàn" <?php if (isset($_GET['filter_viettel_tracking_status']) && $_GET['filter_viettel_tracking_status'] == 'Chờ duyệt Chuyển hoàn') echo 'selected'; ?>>  
                Chờ duyệt Chuyển hoàn
            </option>
            <option value="Yêu cầu phát tiếp" <?php if (isset($_GET['filter_viettel_tracking_status']) && $_GET['filter_viettel_tracking_status'] == 'Yêu cầu phát tiếp') echo 'selected'; ?>>  
                Yêu cầu phát tiếp
            </option>
            <option value="Chuyển hoàn bưu cục gốc" <?php if (isset($_GET['filter_viettel_tracking_status']) && $_GET['filter_viettel_tracking_status'] == 'Chuyển hoàn bưu cục gốc') echo 'selected'; ?>>  
                Chuyển hoàn bưu cục gốc
            </option>
        </select>
    </td>
</tr>
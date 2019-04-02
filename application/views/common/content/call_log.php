<table class="table table-striped table-bordered table-hover call-log">
    <thead>
        <tr>
            <th>
                Lần gọi 
            </th>
            <th>
                Thời gian
            </th>
            <th>
                Ai gọi
            </th>
            <th>
                Trạng thái gọi
            </th>
            <th>
                Trạng thái đơn hàng
            </th>
            <th>
                Trạng thái giao hàng
            </th>
            <th>
                Đơn vị giao hàng
            </th>
            <th class="content-change">
                Nội dung thay đổi
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (isset($call_logs)) {
            foreach ($call_logs as $key_call_log => $value_call_log) {
                ?>
                <tr>
                    <td>
                        Lần gọi thứ <?php echo $key_call_log + 1; ?>
                    </td>
                    <td>
                        <?php echo date('d/m/Y H:i:s', $value_call_log['time']); ?>
                    </td>
                    <td>
                        <?php echo $value_call_log['staff_name']; ?>
                    </td>
                    <td>
                        <?php echo $value_call_log['call_status_desc']; ?>
                    </td>
                    <td>
                        <?php echo $value_call_log['ordering_status_desc']; ?>
                    </td>
                    <td>
                        <?php echo $value_call_log['cod_status_desc']; ?>
                    </td>
                    <td>
                        <?php echo $value_call_log['provider_name']; ?>
                    </td>
                    <td>
                        <?php echo html_entity_decode($value_call_log['content_change']); ?>
                    </td>
                </tr>
                <?php
            }
        }
        ?>
    </tbody>
</table>
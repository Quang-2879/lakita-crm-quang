<?php if (!empty($transfer_logs)) { ?>
    <tr>
        <td class="text-right">  Lịch sử chuyển nhượng </td>
        <td>  
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>
                            STT
                        </th>   
                        <th>
                            Nhân viên 1
                        </th> 
                        <th>
                            Nhân viên 2
                        </th> 
                        <th>
                            Thời gian
                        </th>   
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($transfer_logs as $key => $value) { ?>
                        <tr>
                            <td class="center">
                                <?php echo $key + 1; ?>
                            </td>
                            <td class="center">
                                <?php
                                foreach ($staffs as $key2 => $value2) {
                                    if ($value['sale_id_1'] == $value2['id']) {
                                        echo $value2['name'];
                                        break;
                                    }
                                }
                                ?>
                            </td>
                            <td class="center">
                                <?php
                                foreach ($staffs as $key2 => $value2) {
                                    if ($value['sale_id_2'] == $value2['id']) {
                                        echo $value2['name'];
                                        break;
                                    }
                                }
                                ?>
                            </td>
                            <td class="center">
                                <?php echo date(_DATE_FORMAT_, $value['time']); ?>
                            </td>

                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </td>
    </tr>
<?php } ?>
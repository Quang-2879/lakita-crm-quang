<tr>
    <td class="text-right"> Ghi chú </td>
    <td>  
        <?php if (!empty($notes)) { ?>
            <table class="table table-bordered table-striped tbl-note">
                <thead>
                    <tr>
                        <th>
                            STT
                        </th>   
                        <th>
                            Nội dung
                        </th> 
                        <th>
                            Thời gian
                        </th> 
                        <th>
                            Người viết
                        </th>   
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($notes as $key => $value) { ?>
                        <tr>
                            <td class="center">
                                <?php echo $key + 1; ?>
                            </td>
                            <td class="center">
                                <?php echo $value['content']; ?>
                            </td>	
                            <td class="center">
                                <?php echo date(_DATE_FORMAT_, $value['time']); ?>
                            </td>
                            <td class="center">
                                <?php
                                foreach ($staffs as $key2 => $value2) {
                                    if ($value['sale_id'] == $value2['id']) {
                                        echo $value2['name'];
                                        break;
                                    }
                                }
                                ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
        <div class="form-group">
            <label for="note" class="sr-only">Note</label>
            <textarea class="form-control" rows="3" name="note"></textarea>
        </div>
    </td>
</tr>
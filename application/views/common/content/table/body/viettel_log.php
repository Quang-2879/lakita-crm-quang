<?php if(isset($value['vietel_log'])) { ?>
<td class="tbl_viettel_log">  
    <table class="table table-bordered table-striped" style="color:#000; table-layout: fixed !important;">
        <thead>
            <tr>
<!--                <th style="width: 10px;">
                    STT
                </th>   -->
                <th style="height: 30px; width: 18px;">
                    Thời gian
                </th> 
                <th style="height: 30px;">
                    Trạng thái
                </th> 
                <th style="height: 30px;">
                    Bưu cục
                </th>   
            </tr>
        </thead>
        <tbody>
           
            <?php foreach ($value['vietel_log'] as $key3 => $value3) { ?>
                <tr>
<!--                    <td class="center" style="height: 40px;">
                        <?php //echo $key3 + 1; ?>
                    </td>-->
                    <td class="center" style="height: 40px;">
                       <?php echo date(_DATE_FORMAT_, $value3['date_info']); ?>
                    </td>
                    <td class="center" style="height: 40px;">
                        <?php echo $value3['status'];?>
                    </td>
                    <td class="center" style="height: 40px;">
                        <?php echo $value3['destination']; ?>
                    </td>
                </tr>
            <?php } ?>
                 <tr>
                <td colspan="3" class="text-center"> <h2>  <?php echo $value['viettel_tracking_status'];?> </h2> </td>
            </tr>
        </tbody>
    </table>
</td>
<?php } ?>
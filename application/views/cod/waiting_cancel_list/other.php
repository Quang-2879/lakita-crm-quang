<h1> Danh sách contact đang giao hàng khác  (<?php echo count($contact_other); ?>)</h1>
<?php if (empty($contact_other)) { ?>
   
<?php } else { ?>
    <table border="1" cellpadding="0" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th style="background: #0C812D; color: #fff"> 
                    ID 
                </th>
                <th style="background: #0C812D; color: #fff">
                    Họ tên
                </th>
                <th style="background: #0C812D; color: #fff">
                    Số điện thoại
                </th>
                <th style="background: #0C812D; color: #fff">
                    Địa chỉ
                </th>
              
                <th style="background: #0C812D; color: #fff">
                    Mã bill
                </th>
                <th style="background: #0C812D; color: #fff">
                    Trạng thái
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($contact_other as $value) {
                ?>
                <tr>
                    <td>
                        <?php echo $value['id']; ?>
                    </td>
                    <td>
                        <a href="<?php echo 'https://crm2.lakita.vn/home/index?view_detail_contact='.$value['id']?>"><?php echo $value['name']; ?> </a>
                    </td>
                    <td>
                        <?php echo $value['phone']; ?>
                    </td>
                    <td>
                        <?php echo $value['address']; ?>
                    </td>
                
                      <td>
                        <a href="https://www.viettelpost.com.vn/Tracking?KEY=<?php echo $value['code_cross_check']; ?>" target="_blank">
                            <?php echo $value['code_cross_check']; ?>
                        </a>
                    </td>               

                    <td>
                        <?php echo $value['status_viettel']; ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
<?php
}

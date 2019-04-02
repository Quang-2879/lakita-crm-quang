<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>

<form method="post" action="export_for_send_vnpost2">
    <table>
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
                    Mã khóa học
                </th>
                <th style="background: #0C812D; color: #fff">
                    Giá tiền mua
                </th>
                <th style="background: #0C812D; color: #fff">
                    Mã vận đơn
                </th>
                <th style="background: #0C812D; color: #fff">
                    Địa chỉ
                </th>
                <th style="background: #0C812D; color: #fff">
                    Thành phố
                </th>
                <th style="background: #0C812D; color: #fff">
                    Quận
                </th> 
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contact_export as $value) { ?>
                <tr>
                    <td>
                        <?php echo $value['id']; ?>
                    </td>
                    <td>
                        <?php echo $value['name']; ?>
                    </td>

                    <td>
                        <?php echo $value['phone']; ?>
                    </td>
                    <td>
                        <?php echo $value['course_code']; ?>
                    </td>
                    <td>
                        <?php echo $value['price_purchase']; ?>
                    </td>
                    <td>
                        <?php echo $value['code_cross_check']; ?>
                    </td>
                    <td>
                        <?php echo $value['address']; ?>
                    </td>

                    <td>
                        <select name="<?php echo $value['id'] . '[]'; ?>" required="required" class="city" id="city_<?php echo $value['id']; ?>">
                            <option value="">
                            </option>
                            <?php foreach ($city as $c_value) {?>
                            <option value="<?php echo $c_value['matp'].'-'.$c_value['name']; ?>">
                                <?php echo $c_value['name']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </td>
                    <td>
                        <select name="<?php echo $value['id'] . '[]'; ?>" required="required" class="city_<?php echo $value['id']; ?>" >
                            
                        </select>
                    </td>
                </tr>

            <?php } ?>
        </tbody>
    </table>
    <input type="submit" value="Gửi">
</form>


<script>
    $('.city').change(function(){
        var city = $(this).attr('id');
        var city_id = $('#'+city + ' :selected').val();
        console.log(city_id);
        $.ajax({
            url: "https://crm2.lakita.vn/cod/find_district",
            type: 'POST',
            data: {city_id: city_id},
            success: function (data) {
                $('.'+city).empty();
                $('.'+city).append(data);
                console.log(data);
            }
        });
        
});
</script>
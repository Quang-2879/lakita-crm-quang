<td class="center tbl_email">
    <?php 
        if(!empty($value['id_lakita'])){
            $account = file_get_contents('https://lakita.vn/api/get_email_lakita?id_lakita='.$value['id_lakita']);
            echo $account;
        }
    ?>
</td>
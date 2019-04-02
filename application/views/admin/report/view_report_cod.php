<?php
/*
 * Copyright (C) 2017 Phạm Ngọc Chuyển <chuyenpn at lakita.vn>
 *
 */
?>
<h1> <?php echo $course_code;?> </h1> 
<table class="table table-bordered table-striped view_report gr4-table">
    <thead>
        <tr>
            <th style="background: none; border: none;" class="f_staff_0"></th>
            <?php
            foreach ($providers as $value) {
                if ($value['L6'] > 0) {
                    ?>
                    <th class="f_staff_<?php echo $value['id']; ?>">
                        <?php echo $value['name']; ?>
                    </th>
                    <?php
                }
            }
            ?>
            <th class="f_staff_sum">
                Tổng
            </th>
        </tr>
    </thead>
   
    <tbody>
        <?php
        $report = array(
            array('L6', 'L6', $L6),
            array('L8', 'L8', $L8),
        );
        foreach ($report as $values) {
            list($name, $value2, $total) = $values;
            ?>
            <tr>
                <td> <?php echo $name; ?> </td>
                <?php
                foreach ($providers as $value) {
                    if ($value['L6'] > 0) {
                        ?>
                        <td>
                            <?php echo $value[$value2]; ?>
                        </td>
                        <?php
                    }
                }
                ?>
                <td>
                    <?php echo $total; ?>
                </td>
            </tr>
            <?php
        }
        ?>
            
             <?php
        $report2 = array(
            array('L8/L6', 'L8', 'L6', ($L6 != 0) ? round(($L8 / $L6) * 100, 2) : 'không thể chia cho 0', 90),
        );
        foreach ($report2 as $values) {
            list($name, $tu_so, $mau_so, $total, $limit) = $values;
            ?>
            <tr>
                <td> <?php echo $name; ?> </td>
                <?php
                foreach ($providers as $value) {
                    if ($value['L6'] > 0) {
                        ?>
                        <td <?php
                        if ($value[$mau_so] != 0 && round(($value[$tu_so] / $value[$mau_so]) * 100) < $limit && $limit > 0) {
                            echo 'style="background-color: #a71717;color: #fff;"';
                        } else if ($value[$mau_so] != 0 && round(($value[$tu_so] / $value[$mau_so]) * 100) >= $limit && $limit > 0) {
                            echo 'style="background-color: #0C812D;color: #fff;"';
                        }
                        ?>>
                                <?php echo ($value[$mau_so] != 0) ? round(($value[$tu_so] / $value[$mau_so]) * 100, 2) . '%' : 'không thể chia cho 0'; ?>
                        </td>
                        <?php
                    }
                }
                ?>
                <td <?php
                if ($total < $limit && $limit > 0) {
                    echo 'style="background-color: #a71717;color: #fff;"';
                } else if ($total >= $limit && $limit > 0) {
                    echo 'style="background-color: #0C812D;color: #fff;"';
                }
                ?>>
                        <?php echo $total . '%'; ?>
                </td>
            </tr>
            <?php
        }
        ?>
            
    </tbody>
</table>
<?php //$this->load->view('common/script/view_detail_contact');  ?>
<?php //$this->load->view('common/content/pagination'); ?>



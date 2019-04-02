<?php
foreach ($rows as $row) {
    ?>
    <tr class="<?php echo (isset($row['warning_class'])) ? $row['warning_class'] : ''; ?>">
        <td class="center tbl_selection">
            <input type="checkbox" name="item_id[]" value="<?php echo $row['id']; ?>" />
        </td>
        <?php
        foreach ($head_tbl as $columm_name => $column_type) {
            if (isset($column_type['display']) && $column_type['display'] == 'none') {
                continue;
            }
            if (!isset($column_type['type'])) {
                echo "<td> {$row[$columm_name]} </td>";
            } else {
                switch ($column_type['type']) {
                    case 'currency': {
                            echo '<td>' . number_format($row[$columm_name], 0, ",", ".") . '</td>';
                            break;
                        }
                    case 'datetime': {
                            echo '<td>' . date('H:i:s d/m/Y', $row[$columm_name]) . '</td>';
                            break;
                        }
                    case 'custom' : {
                            $data['row'] = $row;
                            $this->load->view($this->view_path . '/show_table/' . $columm_name, $data);
                            break;
                        }
                }
            }
        }
        ?>
    </tr>
<?php }
?>
</tr>

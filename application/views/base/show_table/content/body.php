<?php
foreach ($rows as $row) {
    ?>
    <tr class="<?php echo (isset($row['warning_class'])) ? $row['warning_class'] : ''; ?> custom_right_menu"
        item_id="<?php echo $row['id']; ?>"
        edit-url="<?php echo base_url().$this->controller_path.'/show_edit_item'?>"
        >
        <td class="center tbl_selection">
            <input type="checkbox" name="item_id[]" value="<?php echo $row['id']; ?>" class="tbl-item-checkbox"/>
        </td>
        <?php
        foreach ($head_tbl as $columm_name => $column_type) {
            if (isset($column_type['display']) && $column_type['display'] == 'none') { //không hiển thị
                continue;
            }
            if (!isset($column_type['type'])) { //text
                echo "<td class='tbl_" . $columm_name . "'> {$row[$columm_name]} </td>";
            } else {
                switch ($column_type['type']) {
                    
                    case 'currency':
                        $num = is_numeric($row[$columm_name]) ? number_format($row[$columm_name], 0, ",", ".") : $row[$columm_name];
                        echo '<td class="tbl_' . $columm_name . '">' . $num . '</td>';
                        break;

                    case 'datetime':
                        echo '<td class="tbl_' . $columm_name . '">' . date('H:i:s d/m/Y', $row[$columm_name]) . '</td>';
                        break;
                    case 'binary':
                        $checked = ($row['active'] == '1') ? 'checked' : '';
                        echo '<td>
                                <div class="toggle-input marginbottom20">
                                    <label class="switch">
                                        <input disabled="disabled" type="checkbox" 
                                        data-url="'.base_url($this->controller_path . '/edit_active').'" name="edit_active" item_id="'. $row['id'] .'" '. $checked .'/>
                                        <span class="slider round"></span>
                                     </label>
                                </div>
                            </td>';
                        break;
                    case 'custom' :
                        $data['row'] = $row;
                        $this->load->view($this->view_path . '/show_table/' . $columm_name, $data);
                        break;
                }
            }
        }
        ?>
                    <!--        <td class="center tbl_action">
                        <div class="btn-group">
                            <a href="#"
                               class="btn btn-danger delete_item"
                               item_id="<?php echo $row['id']; ?>"
                               title="Xóa dòng"> 
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </a>
                            <a href="#"
                               class="btn btn-warning edit_item"
                               item_id="<?php echo $row['id']; ?>"
                               title="Chỉnh sửa dòng"> 
                                <i class="fa fa-pencil-square" aria-hidden="true"></i>
                            </a>
                        </div>
                    </td>-->
    </tr>
<?php }
?>
</tr>

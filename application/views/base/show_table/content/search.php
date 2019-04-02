<!--
<tbody class="table-head-pos">
    <tr>
        <td class="search_more" id="td_selection"> 
            <input type="text" class="search_more" disabled="disabled"/> 
        </td>
        <?php
        foreach ($head_tbl as $key => $value) {
            if (isset($value['display']) && $value['display'] == 'none') {
                continue;
            }
            $name_search = 'find_' . $key;
            $f_name_search = 'search_' . $key;
            $placehoder = $value['name_display'];
            ?>
            <td class="search_more" id="<?php echo 'td_' . $key; ?>"> 
                <input type="text" name="<?php echo $name_search; ?>" class="search_more" placeholder="<?php echo $placehoder; ?>"
                       value="<?php
                       echo ((filter_has_var(INPUT_GET, $name_search) && filter_input(INPUT_GET, $name_search) != '') ? filter_input(INPUT_GET, $name_search) :
                               ((filter_has_var(INPUT_GET, $f_name_search)) ? filter_input(INPUT_GET, $f_name_search) : ''));
                       ?>" /> 
            </td>
        <?php } ?>
        <td class="search_more" id="td_action"> 
            <input type="text" class="search_more" disabled="disabled"/> 
        </td>
    </tr>
</tbody>-->
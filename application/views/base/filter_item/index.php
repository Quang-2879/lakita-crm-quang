<div class="row">
    <div class="col-md-6">
        <table class="table table-striped table-bordered table-hover filter-contact filter-tbl-1">
            <?php
            // print_arr($this->list_filter['left_filter']);
            if (isset($this->list_filter['left_filter']) && !empty($this->list_filter['left_filter'])) {
                foreach ($this->list_filter['left_filter'] as $key => $value) {
                    switch ($value['type']) {
                        case 'datetime' :
                            $data['key'] = $key;
                            $this->load->view('base/filter_item/datetime', $data);
                            break;

                        case 'binary' :
                            $data['key'] = $key;
                            $this->load->view('base/filter_item/binary', $data);
                            break;

                        case 'arr_multi' :
                            $data['key'] = $key;
                            $data['value'] = $value;
                            $this->load->view('base/filter_item/arr_multi', $data);
                            break;

                        case 'custom':
                            $data['key'] = $key;
                            $data['value'] = $value;
                            $this->load->view($this->view_path . '/filter_item/' . $key, $data);
                            break;
                    }
                }
            }
            ?>
        </table>
    </div>
    <div class="col-md-6">
        <table class="table table-striped table-bordered table-hover many-content filter-contact filter-tbl-2">
            <?php
            // print_arr($this->list_filter['left_filter']);
            if (isset($this->list_filter['right_filter']) && !empty($this->list_filter['right_filter'])) {
                foreach ($this->list_filter['right_filter'] as $key => $value) {
                    switch ($value['type']) {
                        case 'datetime' :
                            $data['key'] = $key;
                            $this->load->view('base/filter_item/datetime', $data);
                            break;

                        case 'binary' :
                            $data['key'] = $key;
                            $this->load->view('base/filter_item/binary', $data);
                            break;

                        case 'arr_multi' :
                            $data['key'] = $key;
                            $data['value'] = $value;
                            $this->load->view('base/filter_item/arr_multi', $data);
                            break;

                        case 'custom':
                            $this->load->view($this->view_path . '/filter_item/' . $key);
                            break;
                    }
                }
            }
            ?>
            <tr class="filter_number_records">
                <td class="text-right"> Số dòng hiển thị trong 1 trang</td>
                <td>
                    <input type="text" class="form-control" name="filter_number_records"
                    <?php if (filter_has_var(INPUT_GET, 'filter_number_records')) { ?>
                               value="<?php echo filter_input(INPUT_GET, 'filter_number_records'); ?>"
                           <?php } ?> />
                </td>
            </tr>
            <tr>
                <td class="text-right">
                    <input type="submit" class="btn btn-success" value="Lọc" />
                </td>
                <td>
                    <input type="submit" class="btn btn-danger reset_form" value="Reset" />
                </td>
            </tr>
        </table>
    </div>
</div>

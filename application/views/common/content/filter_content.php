<div class="col-md-6">

    <table class="table table-bordered table-hover filter-contact filter-tbl-1">

        <?php

        if (isset($left_col) && count($left_col)) {

            foreach ($left_col as $value) {

                $this->load->view('common/content/filter/' . $value);

            }

        }

        ?>

    </table>

</div>

<div class="col-md-6">

    <table class="table table-bordered table-hover filter-contact filter-tbl-2">

        <?php

        if (isset($right_col) && count($right_col)) {
            foreach ($right_col as $value) {

                $this->load->view('common/content/filter/' . $value);

            }

        }

        ?>

        <tr class="filter_number_records">

            <td class="text-right"> Số contact hiển thị trong 1 trang</td>

            <td>

                <input type="text" class="form-control" name="filter_number_records"

                <?php if (isset($_GET['filter_number_records'])) { ?>

                           value="<?php echo $_GET['filter_number_records']; ?>"

                       <?php } ?> />

            </td>

        </tr>

        <tr>

            <td class="text-right">

                <input type="submit" class="btn btn-success filter_contact" value="Lọc" />

            </td>

            <td>

                <input type="submit" class="btn btn-danger reset_form" value="Reset" />

            </td>

        </tr>

    </table>

</div>
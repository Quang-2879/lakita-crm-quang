<table class="table table-bordered table-striped list_contact table-fixed-head">
    <?php
    $data['head_tbl'] = $this->list_view;
    $this->load->view('marketing/show_table/content/head', $data);
    //$this->load->view('marketing/show_table/content/search', $data);
    $this->load->view('marketing/show_table/content/body', $data);
    ?>
</table>
<input type="submit" class="hidden" id="submit_get_form"/>


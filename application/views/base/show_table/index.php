<table class="table table-bordered table-striped list_contact list_contact_2 table-fixed-head">
    <?php
    $data['head_tbl'] = $this->list_view;
    $this->load->view('base/show_table/content/head', $data);
   // $this->load->view('base/show_table/content/search', $data);
    $this->load->view('base/show_table/content/body', $data);
    ?>
</table>
<input type="submit" class="hidden" id="submit_get_form"/>


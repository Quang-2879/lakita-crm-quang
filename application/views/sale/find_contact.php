<form action="#" method="GET" id="action_contact" class="form-inline">
    <div class="row margintop80">
        <h3 class="paddingleft35 marginbottom35"> <strong> Tìm kiếm contact theo các trường sau:</strong> </h3>
        <?php $this->load->view('common/content/search_contact'); ?>
        <div class="real-search-replacement">
            <a href="form.html" class="transfer_contact btn btn-success"> Chuyển nhượng các contact đã chọn </a> <br>
            <?php $this->load->view('common/content/tbl_contact'); ?>
            <?php if (isset($contacts)) { ?>
                <h3> Tìm thấy <?php echo count($contacts); ?> contact </h3>
            <?php } ?>
            <a href="form.html" class="transfer_contact btn btn-success"> Chuyển nhượng các contact đã chọn </a> <br>
        </div>
    </div>
</form>
<div class="remove_content">
    <?php if (count($_GET) > 0) { ?>
        <?php $this->load->view('sale/modal/transfer_one_contact'); ?>
        <script src="<?php echo base_url(); ?>style/js/common_view/edit_contact.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>style/js/sale/check_edit_contact.js"></script>
        <script src="<?php echo base_url(); ?>style/js/common_view/view_detail_contact.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>style/js/sale/transfer_contact.js"></script>
        <script>
            $(function () {
                $(".real-search-result-replace").html("");
            });
        </script>
    <?php } ?>
</div>
<script src="<?php echo base_url(); ?>style/js/real_search.js"></script>



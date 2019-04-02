<form action="#" method="GET" id="action_contact" class="form-inline">
    <div class="row margintop80">
        <h3 class="paddingleft35 marginbottom35"> <strong> Tìm kiếm contact theo các trường sau:</strong> </h3>
        <?php $this->load->view('common/content/search_contact'); ?>
        <div class="real-search-replacement">
            <?php $this->load->view('common/content/tbl_contact'); ?>
            <?php if (isset($contacts)) { ?>
                <h3> Tìm thấy <?php echo count($contacts); ?> contact </h3>
            <?php } ?>
        </div>
        <?php $this->load->view('manager/modal/divide_contact'); ?>
    </div>
</form>
<div class="remove_content">
    <?php if (count($_GET) > 0) { ?>
        <?php $this->load->view('manager/modal/divide_one_contact'); ?>
        <script src="<?php echo base_url(); ?>style/js/manager/divide_contact.js"></script>
        <script src="<?php echo base_url(); ?>style/js/manager/delete_one_contact.js"></script>
        <script src="<?php echo base_url(); ?>style/js/manager/delete_multi_contact.js"></script>
        <script src="<?php echo base_url(); ?>style/js/manager/view_duplicate.js"></script>
        <script src="<?php echo base_url(); ?>style/js/common_view/view_detail_contact.js" type="text/javascript"></script>
        <script>
            $(function () {
                $(".real-search-result-replace").html("");
            });
        </script>
    <?php } ?>
</div>


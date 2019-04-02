<?php $this->load->view('common/content/tbl_contact'); ?>
<?php if (isset($contacts)) { ?>
    <h3> Tìm thấy <?php echo count($contacts); ?> contact </h3>
<?php } ?>
<div class="real-search-result-replace">
    <?php if ($controller == 'manager') { ?>
        <?php $this->load->view('manager/modal/divide_one_contact'); ?>
        <script src="<?php echo base_url(); ?>style/js/manager/divide_contact.js"></script>
        <script src="<?php echo base_url(); ?>style/js/manager/delete_one_contact.js"></script>
        <script src="<?php echo base_url(); ?>style/js/manager/delete_multi_contact.js"></script>
        <script src="<?php echo base_url(); ?>style/js/manager/view_duplicate.js"></script>
        <script src="<?php echo base_url(); ?>style/js/common_view/view_detail_contact.js" type="text/javascript"></script>
    <?php } else if ($controller == 'sale') { ?>
        <?php $this->load->view('sale/modal/transfer_one_contact'); ?>
        <script src="<?php echo base_url(); ?>style/js/common_view/edit_contact.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>style/js/sale/check_edit_contact.js"></script>
        <script src="<?php echo base_url(); ?>style/js/common_view/view_detail_contact.js" type="text/javascript"></script>
        <script src="<?php echo base_url(); ?>style/js/sale/transfer_contact.js"></script>
    <?php } ?>
    <script>
        $('.modal').on('hidden.bs.modal', function () {
            $("#action_contact").addClass("form-inline");
        });
    </script>
</div>


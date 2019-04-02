<?php $this->load->view('common/content/tbl_contact'); ?>
<?php if (isset($contacts)) { ?>
    <h3> Tìm thấy <?php echo count($contacts); ?> contact </h3>
<?php } ?>
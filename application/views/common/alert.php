<?php
if ($this->session->tempdata('message')) {
    $msg_success = $this->session->tempdata('msg_success');
    $alert_type = '';
    if (isset($msg_success) && $msg_success == 0) {
        $alert_type = 'alert-red';
    } else {
        $alert_type = 'alert-success';
    }
    ?>
    <div class="alert <?php echo $alert_type; ?>" role="alert">
        <h2> <?php echo $this->session->tempdata('message'); ?> </h2>
    </div>
<?php
} 

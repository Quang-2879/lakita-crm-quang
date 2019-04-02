<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Responsive email</title>
        <style type="text/css">
            body {margin: 10px 0; padding: 0 10px; background: #F9F2E7; font-size: 13px;}
            table {border-collapse: collapse;}
            td {font-family: arial, sans-serif; color: #333333; padding: 10px; border: 1px solid #ddd;}
            th{padding: 10px; border: 1px solid #ddd;}
        </style>
    </head>
    <body>
        <h1> Có tổng số <?php echo $total_contacts; ?> contacts đang giao hàng trong đó:  </h1>
        <?php $this->load->view('cod/waiting_cancel_list/waiting_cancel'); ?>
        <?php $this->load->view('cod/waiting_cancel_list/success'); ?>
        <?php $this->load->view('cod/waiting_cancel_list/cancel'); ?>
        <?php $this->load->view('cod/waiting_cancel_list/other'); ?>
        <?php $this->load->view('cod/waiting_cancel_list/not_send'); ?>
    </body>
</html>



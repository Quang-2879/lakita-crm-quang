<?php if ($controller == 'sale') { ?>
    <td class="center action">
        <?php if ($value['duplicate_id'] != 0) { ?>
            <a href="#" class="view_duplicate btn btn-duplicate" 
               duplicate_id="<?php echo $value['duplicate_id']; ?>"> Xem </a>
           <?php } ?>
        <a href="<?php echo base_url(); ?>sale/edit_contact/<?php echo $value['id'] ?>"
           class="edit_contact btn btn-success" contact_id="<?php echo $value['id'] ?>"> Chăm sóc</a>
        <a href="#" contact_id="<?php echo $value['id']; ?>"
           contact_name="<?php echo $value['name']; ?>"
           class="transfer_one_contact btn btn-primary" > Chuyển nhượng </a>
        <a href="<?php echo base_url(); ?>sale/view_contact/<?php echo $value['id'] ?>"
           class="btn btn-info action_view_detail_contact"
           contact_id="<?php echo $value['id']; ?>"> Chi tiết </a>
    </td>
<?php } ?>
<?php if ($controller == 'manager') { ?>
    <td class="text-center action">
        <?php if ($value['duplicate_id'] != 0) { ?>
            <a href="#" class="view_duplicate btn btn-duplicate" 
               duplicate_id="<?php echo $value['duplicate_id']; ?>"> Xem </a>
           <?php } ?>
           <?php if (!isset($cancel_contact)) { ?>
            <a href="#" class="divide_one_contact_achor btn btn-success"
               contact_id="<?php echo $value['id']; ?>"
               contact_name="<?php echo $value['name']; ?>"> Bàn giao </a>
           <?php } ?>
           <?php if (isset($cancel_contact)) { ?>
            <a href="#" class="btn btn-success cancel_one_contact" 
               contact_id="<?php echo $value['id']; ?>"
               sale_id = "<?php echo $id; ?>"> Bỏ chọn contact </a>
           <?php } ?>
        <a href="#"
           class="btn btn-info action_view_detail_contact"
           contact_id="<?php echo $value['id']; ?>"> Chi tiết </a>
    </td>
<?php } ?>
<?php if ($controller == 'cod') { ?>
    <td class="center action">
        <a href="<?php echo base_url(); ?>sale/edit_contact/<?php echo $value['id'] ?>"
           class="edit_contact btn btn-success" contact_id="<?php echo $value['id'] ?>"> Chăm sóc </a>
        <a href="<?php echo base_url(); ?>sale/view_contact/<?php echo $value['id'] ?>"
           class="btn btn-info action_view_detail_contact"
           contact_id="<?php echo $value['id']; ?>"> Chi tiết </a>
    </td>
<?php } ?>
<?php if ($controller == 'admin') { ?>
    <td class="text-center action">  
        <a href="#" class="action-contact-admin btn btn-warning" 
           data-contact-id ="<?php echo $value['id']; ?>"
           data-answer="Thu hồi thành công contact!"
           data-url="admin/retrieve_contact"> Thu hồi </a>
        <a href="#" class="action-contact-admin btn btn-danger" 
           data-contact-id ="<?php echo $value['id']; ?>"
           data-answer="Xóa contact thành công (thùng rác)!"
           data-url="admin/delete_one_contact"> Thùng rác </a>
        <a href="#" class="action-contact-admin btn btn-danger" 
           data-contact-id ="<?php echo $value['id']; ?>"
           data-answer="Xóa contact thành công (xóa hẳn)!"
           data-url="admin/delete_forever_one_contact"> Xóa hẳn</a>
    </td>
<?php } ?>

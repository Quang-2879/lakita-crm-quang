<?php if($value['id'] > 0) { ?>
<td class="center">
    <div class="btn-group">
        <a href="#"
           class="btn btn-danger btn_delete_teacher"
           teacher_id="<?php echo $value['id']; ?>"
           title="Xóa giảng viên"> 
            <i class="fa fa-trash-o" aria-hidden="true"></i>
        </a>
        <a href="#"
           class="btn btn-warning btn_manage_teacher"
           teacher_id="<?php echo $value['id']; ?>"
           title="Chỉnh sửa giảng viên"> 
            <i class="fa fa-pencil-square" aria-hidden="true"></i>
        </a>
    </div>
</td>
<?php } 
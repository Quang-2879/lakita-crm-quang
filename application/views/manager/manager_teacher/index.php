<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h3 class="text-center marginbottom20"> Danh sách các Giảng viên (<?php echo $total_teacher; ?>)</h3>
    </div>
</div>
<div class="pagination">
    <?php echo isset($pagination) ? $pagination : ''; ?>
    <!-- ==================== Đặt tên class muốn hiển thị modal ở đây =======================-->
    <button class="btn btn-success btn_manage_teacher" teacher_id="0"> Thêm giảng viên mới </button>
    <!-- ===================================================================================-->
</div>
<div class="number_paging"> 
    <?php echo 'Hiển thị ' . $this->begin_paging . ' - ' . $this->end_paging . ' của ' . $this->total_paging . ' giảng viên'; ?>
</div>
<form action="#" method="GET" class="form-inline">
    <table class="table table-bordered list_contact">
        <thead>
            <tr>
                <?php
                if (isset($table)) {
                    foreach ($table as $value) {
                        $this->load->view('manager/manager_teacher/show_teacher/head/' . $value);
                    }
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                if (isset($table)) {
                    foreach ($table as $value) {
                        $this->load->view('manager/manager_teacher/show_teacher/search/' . $value);
                    }
                }
                ?> 
            </tr>
            <?php
            if (isset($teacher)) {
                foreach ($teacher as $key => $value) {
                    $class = ($value['active'] == 1) ? '' : 'course_inactive';
                    ?>
                    <tr class="<?php echo $class; ?>">
                        <?php
                        $data['value'] = $value;
                        foreach ($table as $value2) {
                            $this->load->view('manager/manager_teacher/show_teacher/body/' . $value2, $data);
                        }
                        ?>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
    <input type="submit" class="btn btn-success" value="Tìm" />
</form>
<div class="number_paging"> 
    <?php echo 'Hiển thị ' . $this->begin_paging . ' - ' . $this->end_paging . ' của ' . $this->total_paging . ' giảng viên'; ?>
</div>
<div class="pagination">
    <?php echo isset($pagination) ? $pagination : ''; ?>
    <!-- ==================== Đặt tên class muốn hiển thị modal ở đây =======================-->
    <button class="btn btn-success btn_manage_teacher" tvts_id="0"> Thêm giảng viên mới </button>
    <!-- ============================================================ =======================-->
</div>
<?php
$this->load->view('manager/manager_teacher/modal/edit_teacher');

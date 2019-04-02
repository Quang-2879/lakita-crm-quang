<?php
if (!(isset($contacts) && count($contacts) == 0 && empty($_GET))) {
    if (empty($_GET)) {
        ?>
        <div class="row text-right">
            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#collapse-filter">
                Lọc nâng cao <i class="fa fa-arrow-circle-down" aria-hidden="true"></i>
            </button>
        </div>
        <div class="row collapse" id="collapse-filter">
        <?php $this->load->view('common/content/filter_content'); ?>
        </div>
        <?php } else { ?>
        <div class="row">
        <?php $this->load->view('common/content/filter_content'); ?>
        </div>
    <?php }
}
?>




<div class="container">

    <div class="row">

        <div class="col-md-10 col-md-offset-1">
            
            <h1 class="text-center text-uppercase red margintop20"> <?php echo $progressType ?> <?php echo round($C3Team / $C3Total * 100, 1) ?>% (<?php echo $C3Team . '/' . $C3Total ?>)</h1>
                

            <!-- Skill Bars -->

            <?php foreach ($marketers as $marketer) { ?>

                <div class="row">

                    <div class="col-md-4 text-right text-uppercase margintop5">

                        <?php echo $marketer['name'] . ' (' . $marketer['totalC3'] . '/' . $marketer['targets'] . ')'; ?>
                        <?php 
                            // if ($marketer['kpi'] > 0) {
                            //     echo ': KPI ' . $marketer['kpi'] . ' (' . $marketer['kpi']/date('t') . '/Ngày)';
                            // }
                         ?>

                    </div>

                    <div class="col-md-6">

                        <div class="progress skill-bar ">

                            <div class="progress-bar <?php echo getProgressBarClass($marketer['progress']); ?>" role="progressbar" aria-valuenow="<?php echo $marketer['progress'] ?>" aria-valuemin="0" aria-valuemax="100">

                                <span class="skill text-uppercase"> 

                                    <?php // echo $marketer['name'] . ' (' . $marketer['totalC3'] . '/' . $marketer['targets'] . ')'; ?> 

                                    <?php echo $marketer['progress'] ?>% 

                                </span>

                            </div>

                        </div>

                    </div>

                </div>


            <?php } ?>

        </div>

    </div>

</div>


<div class="container">

    <div class="row">

        <h2 class="text-center"> Số L6 của bạn hôm nay: <?php echo isset($this->L['L6']) ? $this->L['L6'] : '__'; ?></h2>

        <h2 class="text-center"> Số L7 của bạn hôm nay: <?php echo isset($this->L['L7']) ? $this->L['L7'] : '__';; ?> </h2>

        <h2 class="text-center"> Số L6 của bạn tháng này: <?php echo isset($this->L['L6All']) ? $this->L['L6All'] : '__'; ?></h2>

        <h2 class="text-center"> Số L7 của bạn tháng này: <?php echo isset($this->L['L7All']) ? $this->L['L7All'] : '__'; ?> </h2>

    </div>

</div>


<div class="row">

    <div class="col-md-10 col-md-offset-1">

        <h3 class="text-center marginbottom20"> <?php echo $list_title; ?> (<?php echo $total_rows; ?>)</h3>

    </div>

</div>


<form action="#" method="GET" class="form-inline" id="form_item">

    <!-- Các trường filter trong bảng-->

    <?php $this->load->view('base/filter_item/index'); ?>


    <?php $this->load->view('marketing/show_table/base_header'); ?>


    <?php $this->load->view('marketing/show_table/index'); ?>


    <?php $this->load->view('marketing/show_table/base_footer'); ?>


    <?php $this->load->view('base/show_table/hidden_input'); ?>


</form>

<?php $this->load->view('base/delete_item/index'); ?>

<?php $this->load->view('base/edit_item/index'); ?>



<?php

$this->load->view('base/js');


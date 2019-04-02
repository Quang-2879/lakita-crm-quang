<?php if(isset($progressType)) { ?>

<div class="container">

    <div class="row">

        <div class="col-md-10 col-md-offset-1">

            <h1 class="text-center text-uppercase red margintop20 marginbottom20"> <?php echo $progressType?> </h1>

            <?php foreach ($progress as $team) { ?>

                <div class="row">

                    <div class="col-md-4 text-right text-uppercase margintop5">

                        <?php echo $team['name'] . ' (' . $team['count'] . '/' . $team['kpi'] . ') (' . $team['type'] . ')'; ?> 

                    </div>

                    <div class="col-md-6">

                        <div class="progress skill-bar ">

                            <div class="progress-bar <?php echo getProgressBarClass($team['progress']); ?>" role="progressbar" aria-valuenow="<?php echo $team['progress'] ?>" aria-valuemin="0" aria-valuemax="100">

                                <span class="skill text-uppercase"> 

                                    <?php// echo $marketer['name'] . ' (' . $marketer['totalC3'] . '/' . $marketer['targets'] . ')'; ?> 

                                    <?php echo $team['progress'] ?>% 

                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            <?php } ?>

        </div>

    </div>

</div>

<?php } ?>



<div class="row">

    <div class="col-md-10 col-md-offset-1">

        <h3 class="text-center marginbottom20"> <?php echo $titleListContact; ?> <sup> <span class="badge bg-red"> <?php echo $total_contact; ?> </span> </sup></h3>

    </div>

</div>

<form action="<?php echo base_url() . $actionForm; ?>" method="POST" id="action_contact" 

      class="form-inline <?php echo ($total_contact > 0) ? '' : 'empty'; ?>">

    <?php $this->load->view('common/content/filter'); ?>

    <?php $this->load->view('common/content/tbl_contact'); ?>

    <?php

    if (isset($informModal)) {

        foreach ($informModal as $modal) {

            //  $this->load->view('manager/modal/divide_contact');

            $this->load->view($modal);

        }

    }

    ?>

</form>



<?php

if (isset($outformModal)) {

    foreach ($outformModal as $modal) {

        //  $this->load->view('manager/modal/divide_contact');

        $this->load->view($modal);

    }

}

?>

<?php

//$this->load->view('manager/modal/divide_one_contact');


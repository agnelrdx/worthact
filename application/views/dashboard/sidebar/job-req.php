<?php defined('BASEPATH') OR exit('No direct script access allowed'); if($this->session->userdata('timezone') != 'Asia/Calcutta' || $this->session->userdata('timezone') != 'Asia/Kolkata') { ?>

<div class="panel panel-flat post-num meter">
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-4">
                <div class="text-size-huge text-regular text-semibold no-padding no-margin m-t-5 m-b-10">
                    <img src="<?= base_url('assets/img/team.png'); ?>" alt="upload" />
                </div>
            </div>
            <div class="col-xs-8">
                <h3>Upload your CV in Jobs</h3>
                <h4 class="upgrade">Register at WorthAct's Job portal and explore the opportunities out there.<br /><a data-ripple href="<?= base_url('dashboard/jobs') ?>" class='upload_cv trans'>Upload now.</a></h4>
            </div>
        </div>
    </div>
</div>
<?php } ?>
   
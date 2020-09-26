<?php defined('BASEPATH') OR exit('No direct script access allowed'); if($this->session->userdata('timezone') != 'Asia/Calcutta' || $this->session->userdata('timezone') != 'Asia/Kolkata') { ?>

<a href="<?= base_url('dashboard/jobs') ?>">
    <div class="panel panel-flat post-num meter">
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-4">
                    <div class="text-size-huge text-regular text-semibold no-padding no-margin m-t-5 m-b-10">
                        <img src="<?= base_url('assets/img/job_ad.png'); ?>" alt="upload" />
                    </div>
                </div>
                <div class="col-xs-8">
                    <h3>Want to hire someone?</h3>
                    <h4 class="upgrade">Publish your job ad now and bring in the brightest talent to your company.</h4>
                </div>
            </div>
        </div>
    </div>
</a>
<?php } ?>
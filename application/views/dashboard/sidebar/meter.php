<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="panel panel-flat post-num meter">
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-5">
                <div class="text-size-huge text-regular text-semibold no-padding no-margin m-t-5 m-b-10">
                    <?php if($this->complete_meter == 1) : ?>
                    <span class="stage-1">25%</span>
                    <?php endif; ?>
                    <?php if($this->complete_meter == 2) : ?>
                    <span class="stage-2">50%</span>
                    <?php endif; ?>
                    <?php if($this->complete_meter == 3) : ?>
                    <span class="stage-3">75%</span>
                    <?php endif; ?>
                    <?php if($this->complete_meter == 4) : ?>
                    <span class="stage-4">100%</span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-xs-7">
                <?php if($this->complete_meter == 4) : ?>
                <h4>Your profile is complete.</h4>
                <?php else : ?>
                <h4>Improve your network by updating your details.</h4>
                <?php endif; ?>
                <?php if($this->complete_meter == 1) : ?>
                <a class="trans" data-page="<?= $this->uri->segment(2) ?>" data-toggle="modal" data-target="#update_propic"> Add a profile pic</a>
                <?php endif; ?>
                <?php if($this->complete_meter == 2) : ?>
                <a class="trans" href="<?= base_url('dashboard/profile_update/2#social_links'); ?>">Add your social profile links</a>
                <?php endif; ?>
                <?php if($this->complete_meter == 3) : ?>
                <a class="trans" href="<?= base_url('dashboard/worthact_initiatives') ?>">Do something for the betterment of the world!</a>
                <?php endif; ?>
                <?php if($this->complete_meter == 4) : ?>
                <p>Nice work! Keep posting more</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
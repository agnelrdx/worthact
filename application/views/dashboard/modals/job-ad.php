<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="job_ad" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4>Lorem Ipsum is simply dummy text of the printing and typesetting industry</h4>
                <img src="<?= base_url('assets/img/job_ad.png') ?>" alt="job portal" />
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>
                <a data-ripple class="upload" href="<?= base_url('dashboard/joblisting') ?>">Upload Now</a>
                <div class="cancel">
                    <label data-toggle="tooltip" data-placement="top" title="You can always upload your CV by visiting our job portal." class="checkbox-inline checkbox-right">
                        <input id="hide_cvpopup" type="checkbox">Hide this popup from showing again ?
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
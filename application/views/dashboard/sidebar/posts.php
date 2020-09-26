<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="panel panel-flat post-num">
    <div class="panel-body p-b-10">
        <div class="row">
            <div class="col-md-8 col-xs-8">
                <div class="text-size-huge text-regular text-semibold no-padding no-margin m-t-5 m-b-10"><?= $this->hook->user_post_count($this->session->userdata('user_id')); ?></div>
                <span class="text-muted">Your WorthAct Initiatives</span>
            </div>
            <div class="col-md-4 col-xs-4"><i class="fa fa-pencil icon-4x icon-light"></i></div>
        </div>
    </div>
</div>
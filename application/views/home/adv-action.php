<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container about">	
    <div class="row content-div">
        <div class="col-sm-12">
            <?php if($type == 'approve') : ?>
            <h2 class="text-center">\(^ ^)/ Ad successfully approved...!!! \(^ ^)/</h2>
            <?php endif; if($type == 'reject') : ?>
            <h2 class="text-center">('_') Ad successfully deleted...!!! ('_')</h2>
            <?php endif; if($type == 'upgrade') : ?>
            <h2 class="text-center">('_') User upgraded successfully...!!! ('_')</h2>
            <?php endif; if($type == 'deny') : ?>
            <h2 class="text-center">('_') Upgrade request deleted...!!! ('_')</h2>
            <?php endif; ?>
            <div class="pm-member m-t-5"><a data-ripple class="shadow" href="<?= base_url()?>">Continue</a></div>
        </div>
    </div>
</div>
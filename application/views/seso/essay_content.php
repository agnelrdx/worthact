<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Essay</h4>
</div>
<div class="modal-body">
    <h5>Topic - <?php if($item->essay_topic == 1) { echo 'Eco-friendly lifestyle, to support our planet'; } else if($item->essay_topic == 2) { echo 'Domestic eco-friendly rain water harvesting'; } else { echo 'Waste management at home'; } ?></h5>
    <h5>Title - <?= $item->essay_title; ?></h5>
    <?php if($item->essay_banner != ''): ?>
    <div class="media shadow">
        <img src="<?= base_url('assets/userdata/dashboard/seso/'.$item->essay_banner); ?>" alt="banner" />
    </div>
    <?php endif; ?>
    <div class="content">
        <?= $item->essay_content ?>
    </div>
</div>
<div class="modal-footer">
    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
    <button data-ripple class="btn btn-primary">ShortList</button>
</div>
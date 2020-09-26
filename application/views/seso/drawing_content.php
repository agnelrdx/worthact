<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">Drawing</h4>
</div>
<div class="modal-body">
    <h5>Topic - <?php if($item->drawing_topic == 1) { echo 'Eco-friendly lifestyle, to support our planet'; } else if($item->drawing_topic == 2) { echo 'Domestic eco-friendly rain water harvesting'; } else { echo 'Waste management at home'; } ?></h5>
    <?php if($item->drawing_title != ''): ?><h5>Title - <?= $item->drawing_title; ?></h5><?php endif; if($item->sketch != ''): $img_arr = explode(',', $item->sketch); if(count($img_arr) > 1) : ?>
    <div class="media shadow">
        <div id="timeline_post_carousel_<?= $item->list_id; ?>" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <?php $count = 0; foreach ($img_arr as $arr) : ?>
                <div class='item <?= ($count === 0)? 'active' : ''; ?>'>
                    <a title="<?= $item->drawing_title ?>" class="fancybox" rel="group_<?= $item->list_id ?>" href="<?= base_url("assets/userdata/dashboard/seso/".$arr); ?>">
                        <img src='<?= base_url("assets/userdata/dashboard/seso/".$arr); ?>' alt='<?= ($item->drawing_title != '')? $item->drawing_title : ''; ?>'>
                    </a>    
                </div>
                <?php $count++; endforeach; ?>
            </div>
            <a class="left carousel-control" href="#timeline_post_carousel_<?= $item->list_id; ?>" role="button" data-slide="prev"><i class="ion-chevron-left"></i></a>
            <a class="right carousel-control" href="#timeline_post_carousel_<?= $item->list_id; ?>" role="button" data-slide="next"><i class="ion-chevron-right"></i></a>
        </div>
    </div>
    <?php else : ?>
    <div class="media shadow">
        <a title="<?= $item->drawing_title ?>" class="fancybox" href="<?= base_url("assets/userdata/dashboard/seso/".$img_arr[0]); ?>">
            <img class="shadow" src="<?= base_url("assets/userdata/dashboard/seso/".$img_arr[0]); ?>" alt="<?php if($item->drawing_title != '') { echo $item->drawing_title; } ?>" />
        </a>  
    </div>
    <?php endif; endif; ?>
</div>
<div class="modal-footer">
    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
    <button data-ripple class="btn btn-primary">ShortList</button>
</div>
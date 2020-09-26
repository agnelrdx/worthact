<?php defined('BASEPATH') OR exit('No direct script access allowed'); if($block_global != 'blah') : ?>

<div title="<?= $block_global->link ?>" class="ad adv_ad adv_video shadow <?= ($block_global->link != '' && $block_global->video == '')? 'adv_link' : '' ?>" data-href="<?= $block_global->link; ?>">
    <div class="ad_post_head">
        <a href="<?= base_url('dashboard/profile/'.$user->main_id) ?>"><img class="shadow" src="<?= base_url(($user->propic != '') ? "assets/userdata/dashboard/propic/".$user->propic : "assets/img/user_placeholder.png"); ?>" alt="<?= ($user->type_id == 1) ? ucfirst($user->firstname).' '.ucfirst($user->lastname) : ucfirst($user->name); ?>" /></a>
        <a class="title" href="<?= base_url('dashboard/profile/'.$user->main_id) ?>"><h5 class="trans"><?= ($user->type_id == 1) ? ucfirst($user->firstname).' '.ucfirst($user->lastname) : ucfirst($user->name); ?></h5></a>
        <a class='parent_user no_pointer trans'>Sponsored Ad</a>
        <div class="right">
            <span><i class="ion-ios-clock"></i><?= date('h:i A', $block_global->time); ?>&nbsp;&nbsp;<?= $block_global->date ?></span>
        </div>
    </div>
    <div class="media-block clearfix">
        <?php if($block_global->slider != '') :  $img_arr = explode(',', $block_global->slider); ?>
        <div id="timeline_post_carousel_<?= $block_global->id; ?>_adv" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <?php $count = 0; foreach ($img_arr as $arr) : ?>
                <div class='item shadow <?= ($count === 0)? 'active' : ''; ?>'>
                    <img src='<?= base_url('assets/userdata/dashboard/adv/slider/'.$arr); ?>' alt='<?= ucfirst($block_global->heading); ?>'>
                </div>
                <?php $count++; endforeach; ?>
            </div>
        </div>
        <?php endif; if($block_global->image != '') : ?>
        <img class="shadow" src="<?= base_url('assets/userdata/dashboard/adv/image/'.$block_global->image); ?>" alt="<?= $block_global->heading ?>" />    
        <?php endif; if($block_global->video != '') : ?>
        <video preload="auto" src="<?= base_url('assets/userdata/dashboard/adv/video/'.$block_global->video); ?>" class="shadow"></video>
        <?php endif; ?>
    </div>
    <div class="content">
        <h3 class="title"><?= ucfirst($block_global->heading); ?></h3>
        <?php if($block_global->description != '') : ?>
        <div class="para">
            <p><?= $block_global->description ?></p>
        </div>
        <?php endif; ?>
    </div>
    <?php if($block_global->video != '' && $block_global->link != ''): ?><a class="adv_anchor" data-ripple href="<?= $block_global->link ?>" target="_blank"><?= ($block_global->action_text == '')? 'Know More' : $block_global->action_text; ?></a><?php endif; ?>
</div>
<?php endif; if($block_local != 'blah') : ?>
<div title="<?= $block_local->link ?>" class="ad adv_ad adv_video shadow <?= ($block_local->link != '' && $block_local->video == '')? 'adv_link' : '' ?>" data-href="<?= $block_local->link; ?>">
    <div class="ad_post_head">
        <a href="<?= base_url('dashboard/profile/'.$user->main_id) ?>"><img class="shadow" src="<?= base_url(($user->propic != '') ? "assets/userdata/dashboard/propic/".$user->propic : "assets/img/user_placeholder.png"); ?>" alt="<?= ($user->type_id == 1) ? ucfirst($user->firstname).' '.ucfirst($user->lastname) : ucfirst($user->name); ?>" /></a>
        <a class="title" href="<?= base_url('dashboard/profile/'.$user->main_id) ?>"><h5 class="trans"><?= ($user->type_id == 1) ? ucfirst($user->firstname).' '.ucfirst($user->lastname) : ucfirst($user->name); ?></h5></a>
        <a class='parent_user no_pointer trans'>Sponsored Ad</a>
        <div class="right">
            <span><i class="ion-ios-clock"></i><?= date('h:i A', $block_local->time); ?>&nbsp;&nbsp;<?= $block_local->date ?></span>
        </div>
    </div>
    <div class="media-block clearfix">
        <?php if($block_local->slider != '') :  $img_arr = explode(',', $block_local->slider); ?>
        <div id="timeline_post_carousel_<?= $block_local->id; ?>_adv" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <?php $count = 0; foreach ($img_arr as $arr) : ?>
                <div class='item shadow <?= ($count === 0)? 'active' : ''; ?>'>
                    <img src='<?= base_url('assets/userdata/dashboard/adv/slider/'.$arr); ?>' alt='<?= ucfirst($block_local->heading); ?>'>
                </div>
                <?php $count++; endforeach; ?>
            </div>
        </div>
        <?php endif; if($block_local->image != '') : ?>
        <img class="shadow" src="<?= base_url('assets/userdata/dashboard/adv/image/'.$block_local->image); ?>" alt="<?= $block_local->heading ?>" />    
        <?php endif; if($block_local->video != '') : ?>
        <video preload="auto" src="<?= base_url('assets/userdata/dashboard/adv/video/'.$block_local->video); ?>" class="shadow"></video>
        <?php endif; ?>
    </div>
    <div class="content">
        <h3 class="title"><?= ucfirst($block_local->heading); ?></h3>
        <?php if($block_local->description != '') : ?>
        <div class="para">
            <p><?= $block_local->description ?></p>
        </div>
        <?php endif; ?> 
    </div>
    <?php if($block_local->video != '' && $block_local->link != ''): ?><a class="adv_anchor" data-ripple href="<?= $block_local->link ?>" target="_blank"><?= ($block_local->action_text == '')? 'Know More' : $block_local->action_text; ?></a><?php endif; ?>
</div>
<?php endif; ?>

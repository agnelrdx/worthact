<?php defined('BASEPATH') OR exit('No direct script access allowed'); if($block6_global != 'blah') : ?>

<div title="<?= $block6_global->link ?>" class="panel panel-flat adv_block block_200 <?= ($block6_global->link != '' && $block6_global->video == '')? 'adv_link' : '' ?>" data-href="<?= $block6_global->link; ?>">
    <div class="panel-body">
        <div class="media">
            <?php if($block6_global->image != '') : ?>
            <img shadow src="<?= base_url('assets/userdata/dashboard/adv/image/'.$block6_global->image); ?>" class="img-responsive" alt="<?= $block6_global->heading ?>" />
            <?php endif; if($block6_global->slider != '') : $img_arr = explode(',', $block6_global->slider); ?>
            <div id="adv_carousel_<?= $block6_global->id; ?>" class="carousel slide carousel-fade" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <?php $count = 0; foreach ($img_arr as $arr) : ?>
                    <div class="item <?= ($count === 0)? 'active' : ''; ?>">
                        <img src='<?= base_url('assets/userdata/dashboard/adv/slider/'.$arr); ?>' alt='<?= $block6_global->heading ?>' />    
                    </div>
                    <?php $count++; endforeach; ?>
                </div>
                <a class="left carousel-control" href="#adv_carousel_<?= $block6_global->id; ?>" role="button" data-slide="prev"><i class="ion-chevron-left"></i></a>
                <a class="right carousel-control" href="#adv_carousel_<?= $block6_global->id; ?>" role="button" data-slide="next"><i class="ion-chevron-right"></i></a>
            </div>
            <?php endif; if($block6_global->video != '') : ?>
            <video src="<?= base_url('assets/userdata/dashboard/adv/video/'.$block6_global->video); ?>"></video>
            <?php endif; ?>
        </div>
        <div class="desc">
            <h4><?= $block6_global->heading ?></h4>
            <?php if($block6_global->description != '') : ?><p><?= $block6_global->description; ?></p><?php endif; ?>
            <?php if($block6_global->video != '' && $block1_local->link != ''): ?><a data-ripple href="<?= $block6_global->link ?>" target="_blank"><?= ($block6_global->action_text == '')? 'Know More' : $block6_global->action_text; ?></a><?php endif; ?>
        </div>    
    </div>
</div>

<?php endif; if($block6_local != 'blah') : ?>
<div title="<?= $block6_local->link ?>" class="panel panel-flat adv_block block_200 <?= ($block6_local->link != '' && $block6_local->video == '')? 'adv_link' : '' ?>" data-href="<?= $block6_local->link; ?>">
    <div class="panel-body">
        <div class="media">
            <?php if($block6_local->image != '') : ?>
            <img src="<?= base_url('assets/userdata/dashboard/adv/image/'.$block6_local->image); ?>" class="img-responsive shadow" alt="<?= $block6_local->heading ?>" />
            <?php endif; if($block6_local->slider != '') : $img_arr = explode(',', $block6_local->slider); ?>
            <div id="adv_carousel_<?= $block6_local->id; ?>" class="carousel slide carousel-fade" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <?php $count = 0; foreach ($img_arr as $arr) : ?>
                    <div class="item <?= ($count === 0)? 'active' : ''; ?>">
                        <img class="img-responsive shadow" src='<?= base_url('assets/userdata/dashboard/adv/slider/'.$arr); ?>' alt='<?= $block6_local->heading ?>' />    
                    </div>
                    <?php $count++; endforeach; ?>
                </div>
                <a class="left carousel-control" href="#adv_carousel_<?= $block6_local->id; ?>" role="button" data-slide="prev"><i class="ion-chevron-left"></i></a>
                <a class="right carousel-control" href="#adv_carousel_<?= $block6_local->id; ?>" role="button" data-slide="next"><i class="ion-chevron-right"></i></a>
            </div>
            <?php endif; if($block6_local->video != '') : ?>
            <video src="<?= base_url('assets/userdata/dashboard/adv/video/'.$block6_local->video); ?>"></video>
            <?php endif; ?>
        </div>
        <div class="desc">
            <h4><?= $block6_local->heading ?></h4>
            <?php if($block6_local->description != '') : ?><p><?= $block6_local->description; ?></p><?php endif; ?>
            <?php if($block6_local->video != '' && $block6_local->link != ''): ?><a data-ripple href="<?= $block6_local->link ?>" target="_blank"><?= ($block6_local->action_text == '')? 'Know More' : $block6_local->action_text; ?></a><?php endif; ?>
        </div>    
    </div>
</div>
<?php endif; ?>

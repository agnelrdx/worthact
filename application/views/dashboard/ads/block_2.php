<?php defined('BASEPATH') OR exit('No direct script access allowed'); if($block2_global != 'blah') : ?>

<div title="<?= $block2_global->link ?>" class="panel panel-flat adv_block block_200 <?= ($block2_global->link != '' && $block2_global->video == '')? 'adv_link' : '' ?>" data-href="<?= $block2_global->link; ?>">
    <div class="panel-body">
        <div class="media">
            <?php if($block2_global->image != '') : ?>
            <img src="<?= base_url('assets/userdata/dashboard/adv/image/'.$block2_global->image); ?>" class="img-responsive shadow" alt="<?= $block2_global->heading ?>" />
            <?php endif; if($block2_global->slider != '') : $img_arr = explode(',', $block2_global->slider); ?>
            <div id="adv_carousel_<?= $block2_global->id; ?>" class="carousel slide carousel-fade" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <?php $count = 0; foreach ($img_arr as $arr) : ?>
                    <div class="item <?= ($count === 0)? 'active' : ''; ?>">
                        <img class="img-responsive shadow" src='<?= base_url('assets/userdata/dashboard/adv/slider/'.$arr); ?>' alt='<?= $block2_global->heading ?>' />    
                    </div>
                    <?php $count++; endforeach; ?>
                </div>
                <a class="left carousel-control" href="#adv_carousel_<?= $block2_global->id; ?>" role="button" data-slide="prev"><i class="ion-chevron-left"></i></a>
                <a class="right carousel-control" href="#adv_carousel_<?= $block2_global->id; ?>" role="button" data-slide="next"><i class="ion-chevron-right"></i></a>
            </div>
            <?php endif; if($block2_global->video != '') : ?>
            <video src="<?= base_url('assets/userdata/dashboard/adv/video/'.$block2_global->video); ?>"></video>
            <?php endif; ?>
        </div>
        <div class="desc">
            <h4><?= $block2_global->heading ?></h4>
            <?php if($block2_global->description != '') : ?><p><?= $block2_global->description; ?></p><?php endif; ?>
            <?php if($block2_global->video != '' && $block2_global->link != ''): ?><a data-ripple href="<?= $block2_global->link ?>" target="_blank"><?= ($block2_global->action_text == '')? 'Know More' : $block2_global->action_text; ?></a><?php endif; ?>
        </div>    
    </div>
</div>

<?php endif; if($block2_local != 'blah') : ?>
<div title="<?= $block2_local->link ?>" class="panel panel-flat adv_block block_200 <?= ($block2_local->link != '' && $block2_local->video == '')? 'adv_link' : '' ?>" data-href="<?= $block2_local->link; ?>">
    <div class="panel-body">
        <div class="media">
            <?php if($block2_local->image != '') : ?>
            <img src="<?= base_url('assets/userdata/dashboard/adv/image/'.$block2_local->image); ?>" class="img-responsive shadow" alt="<?= $block2_local->heading ?>" />
            <?php endif; if($block2_local->slider != '') : $img_arr = explode(',', $block2_local->slider); ?>
            <div id="adv_carousel_<?= $block2_local->id; ?>" class="carousel slide carousel-fade" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <?php $count = 0; foreach ($img_arr as $arr) : ?>
                    <div class="item <?= ($count === 0)? 'active' : ''; ?>">
                        <img class="img-responsive shadow" src='<?= base_url('assets/userdata/dashboard/adv/slider/'.$arr); ?>' alt='<?= $block2_local->heading ?>' />    
                    </div>
                    <?php $count++; endforeach; ?>
                </div>
                <a class="left carousel-control" href="#adv_carousel_<?= $block2_local->id; ?>" role="button" data-slide="prev"><i class="ion-chevron-left"></i></a>
                <a class="right carousel-control" href="#adv_carousel_<?= $block2_local->id; ?>" role="button" data-slide="next"><i class="ion-chevron-right"></i></a>
            </div>
            <?php endif; if($block2_local->video != '') : ?>
            <video src="<?= base_url('assets/userdata/dashboard/adv/video/'.$block2_local->video); ?>"></video>
            <?php endif; ?>
        </div>
        <div class="desc">
            <h4><?= $block2_local->heading ?></h4>
            <?php if($block2_local->description != '') : ?><p><?= $block2_local->description; ?></p><?php endif; ?>
            <?php if($block2_local->video != '' && $block2_local->link != ''): ?><a data-ripple href="<?= $block2_local->link ?>" target="_blank"><?= ($block2_local->action_text == '')? 'Know More' : $block2_local->action_text; ?></a><?php endif; ?>
        </div>    
    </div>
</div>
<?php endif; ?>

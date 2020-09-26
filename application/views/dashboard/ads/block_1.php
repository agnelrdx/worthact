<?php defined('BASEPATH') OR exit('No direct script access allowed'); if($block1_global != 'blah') : ?>

<div title="<?= $block1_global->link ?>" class="panel panel-flat adv_block block_200 <?= ($block1_global->link != '' && $block1_global->video == '')? 'adv_link' : '' ?>" data-href="<?= $block1_global->link; ?>">
    <div class="panel-body">
        <div class="media">
            <?php if($block1_global->image != '') : ?>
            <img src="<?= base_url('assets/userdata/dashboard/adv/image/'.$block1_global->image); ?>" class="img-responsive shadow" alt="<?= $block1_global->heading ?>" />
            <?php endif; if($block1_global->slider != '') : $img_arr = explode(',', $block1_global->slider); ?>
            <div id="adv_carousel_<?= $block1_global->id; ?>" class="carousel slide carousel-fade" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <?php $count = 0; foreach ($img_arr as $arr) : ?>
                    <div class="item <?= ($count === 0)? 'active' : ''; ?>">
                        <img class="img-responsive shadow" src='<?= base_url('assets/userdata/dashboard/adv/slider/'.$arr); ?>' alt='<?= $block1_global->heading ?>' />    
                    </div>
                    <?php $count++; endforeach; ?>
                </div>
                <a class="left carousel-control" href="#adv_carousel_<?= $block1_global->id; ?>" role="button" data-slide="prev"><i class="ion-chevron-left"></i></a>
                <a class="right carousel-control" href="#adv_carousel_<?= $block1_global->id; ?>" role="button" data-slide="next"><i class="ion-chevron-right"></i></a>
            </div>
            <?php endif; if($block1_global->video != '') : ?>
            <video src="<?= base_url('assets/userdata/dashboard/adv/video/'.$block1_global->video); ?>"></video>
            <?php endif; ?>
        </div>
        <div class="desc">
            <h4><?= $block1_global->heading ?></h4>
            <?php if($block1_global->description != '') : ?><p><?= $block1_global->description; ?></p><?php endif; ?>
            <?php if($block1_global->video != '' && $block1_global->link != ''): ?><a data-ripple href="<?= $block1_global->link ?>" target="_blank"><?= ($block1_global->action_text == '')? 'Know More' : $block1_global->action_text; ?></a><?php endif; ?>
        </div>    
    </div>
</div>

<?php endif; if($block1_local != 'blah') : ?>
<div title="<?= $block1_local->link ?>" class="panel panel-flat adv_block block_200 <?= ($block1_local->link != '' && $block1_local->video == '')? 'adv_link' : '' ?>" data-href="<?= $block1_local->link; ?>">
    <div class="panel-body">
        <div class="media">
            <?php if($block1_local->image != '') : ?>
            <img src="<?= base_url('assets/userdata/dashboard/adv/image/'.$block1_local->image); ?>" class="img-responsive shadow" alt="<?= $block1_local->heading ?>" />
            <?php endif; if($block1_local->slider != '') : $img_arr = explode(',', $block1_local->slider); ?>
            <div id="adv_carousel_<?= $block1_local->id; ?>" class="carousel slide carousel-fade" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <?php $count = 0; foreach ($img_arr as $arr) : ?>
                    <div class="item <?= ($count === 0)? 'active' : ''; ?>">
                        <img class="img-responsive shadow" src='<?= base_url('assets/userdata/dashboard/adv/slider/'.$arr); ?>' alt='<?= $block1_local->heading ?>' />    
                    </div>
                    <?php $count++; endforeach; ?>
                </div>
                <a class="left carousel-control" href="#adv_carousel_<?= $block1_local->id; ?>" role="button" data-slide="prev"><i class="ion-chevron-left"></i></a>
                <a class="right carousel-control" href="#adv_carousel_<?= $block1_local->id; ?>" role="button" data-slide="next"><i class="ion-chevron-right"></i></a>
            </div>
            <?php endif; if($block1_local->video != '') : ?>
            <video src="<?= base_url('assets/userdata/dashboard/adv/video/'.$block1_local->video); ?>"></video>
            <?php endif; ?>
        </div>
        <div class="desc">
            <h4><?= $block1_local->heading ?></h4>
            <?php if($block1_local->description != '') : ?><p><?= $block1_local->description; ?></p><?php endif; ?>
            <?php if($block1_local->video != '' && $block1_local->link != ''): ?><a data-ripple href="<?= $block1_local->link ?>" target="_blank"><?= ($block1_local->action_text == '')? 'Know More' : $block1_local->action_text; ?></a><?php endif; ?>
        </div>    
    </div>
</div>
<?php endif; ?>

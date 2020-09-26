<?php defined('BASEPATH') OR exit('No direct script access allowed'); if($block5_global != 'blah') : ?>

<div title="<?= $block5_global->link ?>" class="panel panel-flat adv_block block_200 <?= ($block5_global->link != '' && $block5_global->video == '')? 'adv_link' : '' ?>" data-href="<?= $block5_global->link; ?>">
    <div class="panel-body">
        <div class="media">
            <?php if($block5_global->image != '') : ?>
            <img src="<?= base_url('assets/userdata/dashboard/adv/image/'.$block5_global->image); ?>" class="img-responsive shadow" alt="<?= $block5_global->heading ?>" />
            <?php endif; if($block5_global->slider != '') : $img_arr = explode(',', $block5_global->slider); ?>
            <div id="adv_carousel_<?= $block5_global->id; ?>" class="carousel slide carousel-fade" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <?php $count = 0; foreach ($img_arr as $arr) : ?>
                    <div class="item <?= ($count === 0)? 'active' : ''; ?>">
                        <img class="img-responsive shadow" src='<?= base_url('assets/userdata/dashboard/adv/slider/'.$arr); ?>' alt='<?= $block5_global->heading ?>' />    
                    </div>
                    <?php $count++; endforeach; ?>
                </div>
                <a class="left carousel-control" href="#adv_carousel_<?= $block5_global->id; ?>" role="button" data-slide="prev"><i class="ion-chevron-left"></i></a>
                <a class="right carousel-control" href="#adv_carousel_<?= $block5_global->id; ?>" role="button" data-slide="next"><i class="ion-chevron-right"></i></a>
            </div>
            <?php endif; if($block5_global->video != '') : ?>
            <video src="<?= base_url('assets/userdata/dashboard/adv/video/'.$block5_global->video); ?>"></video>
            <?php endif; ?>
        </div>
        <div class="desc">
            <h4><?= $block5_global->heading ?></h4>
            <?php if($block5_global->description != '') : ?><p><?= $block5_global->description; ?></p><?php endif; ?>
            <?php if($block5_global->video != '' && $block5_global->link != ''): ?><a data-ripple href="<?= $block5_global->link ?>" target="_blank"><?= ($block5_global->action_text == '')? 'Know More' : $block5_global->action_text; ?></a><?php endif; ?>
        </div>    
    </div>
</div>

<?php endif; if($block5_local != 'blah') : ?>
<div title="<?= $block5_local->link ?>" class="panel panel-flat adv_block block_200 <?= ($block5_local->link != '' && $block5_local->video == '')? 'adv_link' : '' ?>" data-href="<?= $block5_local->link; ?>">
    <div class="panel-body">
        <div class="media">
            <?php if($block5_local->image != '') : ?>
            <img src="<?= base_url('assets/userdata/dashboard/adv/image/'.$block5_local->image); ?>" class="img-responsive" alt="<?= $block5_local->heading ?>" />
            <?php endif; if($block5_local->slider != '') : $img_arr = explode(',', $block5_local->slider); ?>
            <div id="adv_carousel_<?= $block5_local->id; ?>" class="carousel slide carousel-fade" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <?php $count = 0; foreach ($img_arr as $arr) : ?>
                    <div class="item <?= ($count === 0)? 'active' : ''; ?>">
                        <img class="img-responsive shadow" src='<?= base_url('assets/userdata/dashboard/adv/slider/'.$arr); ?>' alt='<?= $block5_local->heading ?>' />    
                    </div>
                    <?php $count++; endforeach; ?>
                </div>
                <a class="left carousel-control" href="#adv_carousel_<?= $block5_local->id; ?>" role="button" data-slide="prev"><i class="ion-chevron-left"></i></a>
                <a class="right carousel-control" href="#adv_carousel_<?= $block5_local->id; ?>" role="button" data-slide="next"><i class="ion-chevron-right"></i></a>
            </div>
            <?php endif; if($block5_local->video != '') : ?>
            <video src="<?= base_url('assets/userdata/dashboard/adv/video/'.$block5_local->video); ?>"></video>
            <?php endif; ?>
        </div>
        <div class="desc">
            <h4><?= $block5_local->heading ?></h4>
            <?php if($block5_local->description != '') : ?><p><?= $block5_local->description; ?></p><?php endif; ?>
            <?php if($block5_local->video != '' && $block5_local->link != ''): ?><a data-ripple href="<?= $block5_local->link ?>" target="_blank"><?= ($block5_local->action_text == '')? 'Know More' : $block5_local->action_text; ?></a><?php endif; ?>
        </div>    
    </div>
</div>
<?php endif; ?>

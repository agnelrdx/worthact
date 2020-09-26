<?php defined('BASEPATH') OR exit('No direct script access allowed'); if(count($lists) > 0) : foreach ($lists as $list) : ?>

<div class="col" data-id="<?= $list->list_id ?>">
    <div class="inner shadow">
        <div class="row">
            <div class="col-xs-2 block photo">
                <div class="propic">
                    <img src="<?= ($list->propic == '')? base_url('assets/img/user_placeholder.png') : base_url('assets/userdata/dashboard/propic/'.$list->propic) ?>" alt="user" />
                </div>
            </div>
            <div class="col-xs-10 block data">
                <div class="details">
                    <h4><?= ucfirst(strtolower($list->firstname)) . ' ' . ucfirst(strtolower($list->lastname)) ?></h4>
                    <p>Age: <?= $list->age ?></p>
                    <p>School: <?= $list->school ?></p>
                    <p>Class: <?= $list->class ?></p>
                    <p class="last">Parent Contact: <?= $list->contact ?></p>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="action clearfix">
                <?php if($list->essay_topic != ''): ?><a onclick="load_seso_essay(<?= $list->list_id ?>)" data-ripple>View Essay</a><?php endif; ?>
                <?php if($list->drawing_topic != ''): ?><a onclick="load_seso_drawing(<?= $list->list_id ?>)" data-ripple>View Drawing</a><?php endif; ?>
                <img src="<?= base_url('assets/img/reload.svg') ?>" id="box_loader" alt="loader" />
            </div>
        </div>
    </div>
</div>
<?php endforeach; endif;
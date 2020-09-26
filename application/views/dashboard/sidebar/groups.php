<?php defined('BASEPATH') OR exit('No direct script access allowed'); if(count($this->near_groups) > 0) : ?>

<div class="people-more panel panel-flat reduced grp-more">
    <div class="panel-heading">
        <h5 class="panel-title"><a class="trans" href="<?= base_url('dashboard/related/group') ?>">Groups to explore</a></h5>
    </div>
    <div class="panel-body">
        <div class="row">
            <?php foreach ($this->near_groups as $grp) : ?>
            <div class="col-xs-3 col">
                <a href="<?= base_url('dashboard/group/'.$grp->main_id) ?>"><img alt="<?= $grp->title ?>" src="<?= base_url(($grp->banner != '') ? "assets/userdata/dashboard/group/banner/".$grp->banner : "assets/img/placeholder.png"); ?>" class="img-rounded img-responsive" data-toggle="tooltip" title="<?= $grp->title ?>" data-placement="bottom"></a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="col-xs-4 col-outer" data-id="<?= $user->main_id; ?>">
    <div class="row row-inner">
        <div class="first">
            <a href="<?= base_url('dashboard/profile/'.$user->main_id) ?>">
                <img alt="" src="<?= base_url(($user->propic != '') ? "assets/userdata/dashboard/propic/".$user->propic : "assets/img/".$this->hook->get_placeholder($user->main_id)); ?>" class="img-responsive">
            </a>
        </div>
        <div class="col">
            <a href="<?= base_url('dashboard/profile/'.$user->main_id) ?>"><h5 class="text-semibold no-margin-bottom"><?= ($user->type_id == 1) ? ucfirst(strtolower($user->firstname)).' '.ucfirst(strtolower($user->lastname)) : ucfirst(strtolower($user->name)); ?></h5></a>
        </div>
    </div>
</div>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="col-sm-6 col-outer" data-id="<?= $user->main_id; ?>">
    <div class="row row-inner">
        <div class="col-xs-4 first">
            <a href="<?= base_url('dashboard/profile/'.$user->main_id) ?>">
                <img alt="" src="<?= base_url(($user->propic != '') ? "assets/userdata/dashboard/propic/".$user->propic : "assets/img/".$this->hook->get_placeholder($user->main_id)); ?>" class="img-responsive">
                <?php if($user->user_level == 1) { echo "<img title='Premium' class='premium_badge' src='".base_url('assets/img/badge.png')."' alt='badge' />"; } ?>
            </a>
        </div>
        <div class="col-xs-7 col">
            <a href="<?= base_url('dashboard/profile/'.$user->main_id) ?>"><h5 class="text-semibold no-margin-bottom"><?= ($user->type_id == 1) ? ucfirst(strtolower($user->firstname)).' '.ucfirst(strtolower($user->lastname)) : ucfirst(strtolower($user->name)); ?></h5></a>
            <p class="text-muted"><?php if(($user->user_city != '' && $user->user_state != '') || ($user->or_city != '' && $user->or_state != '')) { echo ($user->type_id == 1)? ucfirst(strtolower($user->user_city)).' '.ucfirst(strtolower($user->user_state)).', ' : ucfirst(strtolower($user->or_city)).' '.ucfirst(strtolower($user->or_state)).' ,'; } ?><?= ($user->type_id == 1)? $user->user_country_name : $user->org_country_name ?></p>
        </div>														
        <div class="col-xs-1 col drop">
            <ul class="icons-list">																
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="ion-navicon-round"></i></a>
                    <?php if($type == 0) : ?>
                    <ul class="dropdown-menu dropdown-menu-right">													
                        <li><a onclick="set_leave_conn(<?= $user->main_id; ?>, 1)">Remove</a></li>												
                        <li><a onclick="set_block_conn(<?= $user->main_id; ?>, 1)">Block</a></li>												
                        <li><a href="<?= base_url('dashboard/profile/'.$user->main_id) ?>">View Profile</a></li>
                    </ul>
                    <?php elseif($type == 1) : ?>
                    <ul class="dropdown-menu dropdown-menu-right">													
                        <li><a onclick="delete_req(<?= $user->main_id; ?>, 8)">Unfollow</a></li>												
                        <li><a onclick="set_block_conn(<?= $user->main_id; ?>, 1)">Block</a></li>												
                        <li><a href="<?= base_url('dashboard/profile/'.$user->main_id) ?>">View Profile</a></li>
                    </ul>
                    <?php elseif($type == 2) : ?>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a onclick="set_unblock_conn(<?= $user->main_id; ?>, 3)">Unblock</a></li>												
                    </ul>
                    <?php elseif($type == 3) : ?>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="<?= base_url('dashboard/profile/'.$user->main_id) ?>">View Profile</a></li>												
                    </ul>
                    <?php elseif($type == 4) : ?>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a onclick="set_remove_grp_mem(<?= $user->main_id; ?>, 1)">Remove</a></li>
                        <li><a href="<?= base_url('dashboard/profile/'.$user->main_id) ?>">View Profile</a></li>												
                    </ul>
                    <?php elseif($type == 5) : ?>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a onclick="accept_grp_member(<?= $user->main_id; ?>)">Accept Request</a></li>
                        <li><a onclick="remove_grp_member(<?= $user->main_id; ?>, 2)">Delete Request</a></li>
                        <li><a href="<?= base_url('dashboard/profile/'.$user->main_id) ?>">View Profile</a></li>												
                    </ul>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

if($type === 'created') : if(count($groups) > 0) : foreach($groups as $group) : ?>
<div class="col-sm-6 col-outer">
    <div class="row row-inner">
        <div class="col-xs-4 first">
            <a href="<?= base_url('dashboard/group/'.$group->id) ?>"><img alt="" src="<?= base_url(($group->banner != '') ? "assets/userdata/dashboard/group/banner/".$group->banner : "assets/img/placeholder.png"); ?>" class="img-responsive"></a>
        </div>
        <div class="col-xs-7 col">
            <a href="<?= base_url('dashboard/group/'.$group->id) ?>"><h5 class="text-semibold no-margin-bottom"><?= $group->title; ?></h5></a>
        </div>														
        <div class="col-xs-1 col drop">
            <ul class="icons-list">																
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="ion-navicon-round"></i></a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a onclick="update_group(<?= $group->id; ?>)" data-toggle="modal">Edit</a></li>
                        <li><a onclick="delete_group(<?= $group->id; ?>)" data-toggle="modal" data-target="#delete_group">Delete</a></li>
                        <li><a onclick="invite_grp_mem(<?= $group->id; ?>)" data-toggle="modal">Invite</a></li>
                        <li><a href="<?= base_url('dashboard/group/'.$group->id) ?>">View Group</a></li>												
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php endforeach; endif; endif;

if($type === 'joined') : if(count($groups) > 0) : echo '<input type="text" placeholder="Search..." onkeyup="filter_search(\'homegrp\')" id="home_grp" class="search_conn trans" />'; foreach($groups as $group) : ?>
<div class="col-sm-6 col-outer">
    <div class="row row-inner">
        <div class="col-xs-4 first">
            <a href="<?= base_url('dashboard/group/'.$group->main_id) ?>"><img alt="" src="<?= base_url(($group->banner != '') ? "assets/userdata/dashboard/group/banner/".$group->banner : "assets/img/placeholder.png"); ?>" class="img-responsive"></a>
        </div>
        <div class="col-xs-7 col">
            <a href="<?= base_url('dashboard/group/'.$group->main_id) ?>"><h5 class="text-semibold no-margin-bottom"><?= $group->title; ?></h5></a>
        </div>														
        <div class="col-xs-1 col drop">
            <ul class="icons-list">																
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="ion-navicon-round"></i></a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a data-toggle="modal" data-target="#leave_group" onclick="set_leave_group(<?= $group->main_id; ?>, 2)">Leave</a></li>
                        <li><a href="<?= base_url('dashboard/group/'.$group->main_id) ?>">View Group</a></li>												
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php endforeach; else : echo "<h4 class='no_result'>No groups to show..!! <a class='trans' href='" . base_url('dashboard/search') . "'>Click here</a> to search for groups.</h4>"; endif; endif;

if($type === 'profile_grp') : if(count($groups) > 0) : foreach($groups as $group) : ?>
<div class="col-sm-6 col-outer">
    <div class="row row-inner">
        <div class="col-xs-4 first">
            <a href="<?= ($g_type === 'created') ? base_url('dashboard/group/'.$group->id) : base_url('dashboard/group/'.$group->main_id); ?>"><img alt="" src="<?= base_url(($group->banner != '') ? "assets/userdata/dashboard/group/banner/".$group->banner : "assets/img/placeholder.png"); ?>" class="img-responsive"></a>
        </div>
        <div class="col-xs-7 col">
            <a href="<?= ($g_type === 'created') ? base_url('dashboard/group/'.$group->id) : base_url('dashboard/group/'.$group->main_id); ?>"><h5 class="text-semibold no-margin-bottom"><?= $group->title; ?></h5></a>
        </div>														
        <div class="col-xs-1 col drop">
            <ul class="icons-list">																
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown"><i class="ion-navicon-round"></i></a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="<?= ($g_type === 'created') ? base_url('dashboard/group/'.$group->id) : base_url('dashboard/group/'.$group->main_id); ?>">View Group</a></li>												
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php endforeach; endif; endif; ?>
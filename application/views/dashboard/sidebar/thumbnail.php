<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="thumbnail">
    <div class="list-group list-group-lg list-group-borderless list-group-home">
        <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" style="display: none;">        
        <a data-ripple="" onclick="load_trendingfeed()" href="#newsfeed" data-toggle="tab" class="list-group-item trans selected"><i class="ion-android-globe"></i> SOS Feed</a>
        <a data-ripple="" onclick="load_gallery('img')" href="#gallery_img" data-toggle="tab" class="list-group-item trans"><i class="ion-image"></i> Photos</a>
        <a data-ripple="" onclick="load_gallery('vd')" href="#gallery_vd" data-toggle="tab" class="list-group-item trans"><i class="ion-play"></i> Videos</a>
        <?php if($this->info->type_id == 1): ?>
        <a data-ripple="" onclick="load_connection('all')" href="#allfriends" data-toggle="tab" class="list-group-item trans"><i class="ion-android-person"></i> Connections</a>
        <a data-ripple="" onclick="load_followers()" href="#allfollowers" data-toggle="tab" class="list-group-item trans"><i class="ion-android-checkbox-outline"></i> Following</a>
        <?php endif; if($this->info->user_level == 1): ?>
        <a data-ripple="" onclick="load_group('created')" href="#groups" data-toggle="tab" class="list-group-item trans"><i class="ion-person-stalker"></i> Groups Created</a>
        <?php endif; ?>
        <a data-ripple="" onclick="load_group('joined')" href="#joinedgroups" data-toggle="tab" class="list-group-item trans"><i class="ion-person-stalker"></i> Groups Joined</a>
    </div>
    <?php $this->load->view('dashboard/modals/propic'); ?>
</div>
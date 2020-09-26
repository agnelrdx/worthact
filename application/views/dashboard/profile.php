<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container profile">
    <div class="row">
        <?php if(!$this->agent->is_mobile()) : ?>
        <div class="col-sm-3 row-left">
            <div class="panel panel-flat profile-list">					
                <div class="list-group list-group-lg list-group-borderless">
                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader-profile" alt="loader" />
                    <a data-ripple onclick="load_profile_timeline(<?= $profile_id; ?>)" class="list-group-item trans selected"><i class="ion-android-globe"></i> Timeline</a>
                    <a data-ripple onclick="load_profile_blog(<?= $profile_id; ?>)" class="list-group-item trans"><i class="ion-android-create"></i> Blog</a>
                    <a data-ripple onclick="load_profile_gallery_image(<?= $profile_id; ?>)" class="list-group-item trans"><i class="ion-image"></i> Photos</a>
                    <a data-ripple onclick="load_profile_gallery_video(<?= $profile_id; ?>)" class="list-group-item trans"><i class="ion-play"></i> Videos</a>
                    <?php if($user->type_id != 1) : ?>
                    <a data-ripple onclick="load_profile_job(<?= $profile_id; ?>)" class="list-group-item trans"><i class="ion-briefcase"></i> Jobs</a>
                    <?php endif; if($user->type_id == 1) : if($profile_id == $this->session->userdata('user_id') || $privacy->connection == 0 || ($privacy->connection == 1 && $type == 'friend')) : ?>
                    <a data-ripple onclick="load_profile_connection(<?= $profile_id; ?>)" class="list-group-item trans"><i class="ion-android-person"></i> Connections</a>
                    <?php endif; endif; if($user->user_level == 1) : ?>
                    <a data-ripple onclick="load_profile_c_groups(<?= $profile_id; ?>)" class="list-group-item trans"><i class="ion-person-stalker"></i> Groups Created</a>
                    <?php endif; ?>
                    <a data-ripple onclick="load_profile_j_groups(<?= $profile_id; ?>)" class="list-group-item trans"><i class="ion-person-stalker"></i> Groups Joined</a>
                    <a data-ripple onclick="load_profile_post(<?= $profile_id; ?>)" class="list-group-item trans"><i class="ion-clipboard"></i> SOS Feed</a>
                </div>
            </div>
            
            <?php $this->load->view('dashboard/ads/block_1', $this->adv) ?>
            
            <?php $this->load->view('dashboard/sidebar/app'); ?>
            
            <?php $this->load->view('dashboard/sidebar/connection') ?>
            
            <?php $this->load->view('dashboard/sidebar/groups') ?>
            
            <?php $this->load->view('dashboard/sidebar/invite-fb'); ?>
            
            <?php $this->load->view('dashboard/ads/block_2', $this->adv) ?>
        </div>
        <?php else : ?>
        <div class="col-sm-3 row-left">
            <div class="panel panel-flat profile-list">					
                <div class="list-group list-group-lg list-group-borderless">
                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader-profile" alt="loader" />
                    <a data-ripple onclick="load_profile_timeline(<?= $profile_id; ?>)" class="list-group-item trans selected"><i class="ion-android-globe"></i> Timeline</a>
                    <a data-ripple onclick="load_profile_post(<?= $profile_id; ?>)" class="list-group-item trans"><i class="ion-clipboard"></i> WorthAct Initiatives</a>
                    <?php if($user->user_level == 1) : ?>
                    <a data-ripple onclick="load_profile_blog(<?= $profile_id; ?>)" class="list-group-item trans"><i class="ion-android-create"></i> Blog</a>
                    <?php endif; ?>
                    <a data-ripple onclick="load_profile_gallery_image(<?= $profile_id; ?>)" class="list-group-item trans"><i class="ion-image"></i> Photos</a>
                    <a data-ripple onclick="load_profile_gallery_video(<?= $profile_id; ?>)" class="list-group-item trans"><i class="ion-play"></i> Videos</a>
                    <?php if($user->type_id == 1) : if($profile_id == $this->session->userdata('user_id') || $privacy->connection == 0 || ($privacy->connection == 1 && $type == 'friend')) : ?>
                    <a data-ripple onclick="load_profile_connection(<?= $profile_id; ?>)" class="list-group-item trans"><i class="ion-android-person"></i> Connections</a>
                    <?php endif; endif; if($user->user_level == 1) : ?>
                    <a data-ripple onclick="load_profile_c_groups(<?= $profile_id; ?>)" class="list-group-item trans"><i class="ion-person-stalker"></i> Groups Created</a>
                    <a data-ripple onclick="load_profile_j_groups(<?= $profile_id; ?>)" class="list-group-item trans"><i class="ion-person-stalker"></i> Groups Joined</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <div class="col-sm-6 row-center">
            <div class="banner-top panel panel-flat">
                <div class="panel-body">
                    <div class="twPc-div">
                        <div class="twPc-bg twPc-block" <?php if($user->userwall != '' && $this->info->type_id == 1) : ?>style="background-image: url(<?= base_url('assets/userdata/dashboard/banner/'.$user->userwall) ?>);"<?php endif; if($user->orgwall != '' && $this->info->type_id != 1) : ?>style="background-image: url(<?= base_url('assets/userdata/dashboard/banner/'.$user->orgwall) ?>);"<?php endif; ?>></div>
                        <div>
                            <div class="twPc-button">
                                <?php if($profile_id != $this->session->userdata('user_id') && $this->info->type_id == 1) {
                                    if($type == 'friend') {
                                        if($privacy->connection_deny == 1) {
                                            echo '<div class="conn-action">
                                                <button data-ripple class="btn shadow btn_right"><i class="ion-android-done-all"></i> Connected</button>
                                                <div class="dropdown clearfix"> 
                                                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ion-android-more-vertical"></i></button> 
                                                    <ul class="dropdown-menu dropdown-menu-right"> 
                                                        <li><a onclick="set_leave_conn('.$profile_id.', 6)">Remove Connection</a></li>
                                                        <li><a onclick="set_block_conn('.$profile_id.', 2)">Block</a></li>
                                                    </ul> 
                                                </div>
                                              </div>';
                                        } else {
                                            echo '<div class="conn-action">
                                                <button data-ripple class="btn shadow btn_right"><i class="ion-android-done-all"></i> Connected</button>
                                                <div class="dropdown clearfix"> 
                                                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ion-android-more-vertical"></i></button> 
                                                    <ul class="dropdown-menu dropdown-menu-right"> 
                                                        <li><a onclick="set_leave_conn('.$profile_id.', 1)">Remove Connection</a></li>
                                                        <li><a onclick="set_block_conn('.$profile_id.', 2)">Block</a></li>
                                                    </ul> 
                                                </div>
                                              </div>';
                                        }
                                    }
                                    if($type == 'following') {
                                        echo '<div class="conn-action">
                                                <button data-ripple class="btn shadow btn_right"><i class="ion-android-done-all"></i> Following</button>
                                                <div class="dropdown clearfix"> 
                                                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ion-android-more-vertical"></i></button> 
                                                    <ul class="dropdown-menu dropdown-menu-right"> 
                                                        <li><a onclick="delete_req('.$profile_id.', 4)">Unfollow</a></li>
                                                    </ul> 
                                                </div>
                                              </div>';
                                    }
                                    if($type == 'cancel') {
                                        echo '<button onclick="cancel_req('.$profile_id.', 1)" data-ripple class="btn shadow"><i class="ion-android-close"></i> Cancel Request</button>';
                                    }
                                    if($type == 'accept') {
                                        if($privacy->connection_deny == 1) {
                                            echo '<div class="conn-action">
                                                <button onclick="accept_req('.$profile_id.', 3)" data-ripple class="btn shadow btn_right"><i class="ion-android-done"></i> Accept Request</button>
                                                <div class="dropdown clearfix"> 
                                                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ion-android-more-vertical"></i></button> 
                                                    <ul class="dropdown-menu dropdown-menu-right"> 
                                                        <li><a onclick="delete_req('.$profile_id.', 5)" >Decline</a></li>
                                                        <li><a onclick="set_block_conn('.$profile_id.', 2)">Block</a></li>
                                                    </ul> 
                                                </div>
                                              </div>';
                                        } else {
                                            echo '<div class="conn-action">
                                                <button onclick="accept_req('.$profile_id.', 2)" data-ripple class="btn shadow btn_right"><i class="ion-android-done"></i> Accept Request</button>
                                                <div class="dropdown clearfix"> 
                                                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ion-android-more-vertical"></i></button> 
                                                    <ul class="dropdown-menu dropdown-menu-right"> 
                                                        <li><a onclick="delete_req('.$profile_id.', 1)" >Decline</a></li>
                                                        <li><a onclick="set_block_conn('.$profile_id.', 2)">Block</a></li>
                                                    </ul> 
                                                </div>
                                              </div>';
                                        } 
                                    }
                                    if($type === 'not_valid') {
                                        if($privacy->connection_deny == 1) {
                                            echo '<button onclick="follow_user('.$profile_id.', 1)" data-ripple class="btn shadow"><i class="ion-plus"></i> Follow</button>';
                                        } else {
                                            echo '<button onclick="send_req('.$profile_id.', 1)" data-ripple class="btn shadow"><i class="ion-plus"></i> Connect</button>';
                                        }                                      
                                    }
                                } else {
                                    echo '<div style="margin-top: 60px;"></div>';
                                } ?>
                            </div>
                            <div class="twPc-avatarLink"  <?php if($profile_id == $this->session->userdata('user_id') || $this->info->type_id != 1) { echo 'style="margin-top: -50px;"';  } ?>>
                                <?php if($user->propic != '') : ?>
                                <a class="fancybox" href="<?= base_url(($user->propic != '') ? "assets/userdata/dashboard/propic/" . $user->propic : "assets/img/".$this->hook->get_placeholder($profile_id)); ?>" title="<?= ($user->type_id == 1) ? ucfirst(strtolower($user->firstname)) . ' ' . ucfirst(strtolower($user->lastname)) : ucfirst(strtolower($user->name)); ?>">
                                    <img alt="<?= ($user->type_id == 1) ? ucfirst($user->firstname) . ' ' . ucfirst($user->lastname) : ucfirst($user->name); ?>" src="<?= base_url(($user->propic != '') ? "assets/userdata/dashboard/propic/" . $user->propic : "assets/img/".$this->hook->get_placeholder($profile_id)); ?>" class="twPc-avatarImg shadow">
                                    <?php if($user->user_level == 1) { echo "<img title='Premium' class='premium_badge' src='".base_url('assets/img/badge.png')."' alt='badge' />"; } ?>
                                </a>
                                <?php else : ?>
                                <img alt="<?= ($user->type_id == 1) ? ucfirst($user->firstname) . ' ' . ucfirst($user->lastname) : ucfirst($user->name); ?>" src="<?= base_url(($user->propic != '') ? "assets/userdata/dashboard/propic/" . $user->propic : "assets/img/".$this->hook->get_placeholder($profile_id)); ?>" class="twPc-avatarImg shadow">
                                <?php if($user->user_level == 1) { echo "<img title='Premium' class='premium_badge' src='".base_url('assets/img/badge.png')."' alt='badge' />"; } ?>
                                <?php endif; ?>
                            </div>
                            <div class="twPc-divUser">
                                <div class="twPc-divName ">
                                    <a href="<?= base_url('dashboard/profile/' . $user->main_id); ?>"><?= ($user->type_id == 1) ? ucfirst(strtolower($user->firstname)) . ' ' . ucfirst(strtolower($user->lastname)) : ucfirst(strtolower($user->name)); ?></a>
                                </div>
                                <span></span>
                            </div>

                            <div class="twPc-divStats">
                                <ul class="twPc-Arrange">
                                    <li class="twPc-ArrangeSizeFit">
                                        <span class="twPc-StatLabel twPc-block">WorthAct Initiatives</span>
                                        <span class="twPc-StatValue"><?= $this->hook->user_post_count($profile_id); ?></span>
                                    </li>
                                    <?php if($user->type_id == 1) : ?>
                                    <li class="twPc-ArrangeSizeFit">
                                        <span class="twPc-StatLabel twPc-block">Connections</span>
                                        <span class="twPc-StatValue"><?= $c_count; ?></span>
                                    </li>
                                    <?php endif; if($privacy->connection_deny == 1) : ?>
                                    <li class="twPc-ArrangeSizeFit">
                                        <span class="twPc-StatLabel twPc-block">Followers</span>
                                        <span class="twPc-StatValue"><?= $f_count; ?></span>
                                    </li>
                                    <?php endif; ?>
                                    <li class="twPc-ArrangeSizeFit">
                                        <span class="twPc-StatLabel twPc-block">Groups</span>
                                        <span class="twPc-StatValue"><?= $g_count; ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php if($this->agent->is_mobile()) { $this->load->view('dashboard/sidebar/profile'); } ?>
            
            <div class="panel panel-flat profile-main">
                <div class="panel-heading">
                    <h4 class="panel-title profile-head"></h4>
                </div>					
                <div class="panel-body profile-body">
                    <div id="timeline">
                        <div class="row main"></div>
                    </div>
                    
                    <div id="listing" class="listing">
                        <div class="row main">
                            <div class="col-sm-12" id="listing_table"></div>
                        </div>
                    </div>
                    
                    <div id="joblist-tab" class="job-listing">
                        <div id="listing_table"></div>
                    </div>
                    
                    <div id="gallery">
                        <div id="pro_img">
                            <div id="grid" class="col-sm-12"></div>
                        </div>
                        <div id="pro_vd">
                            <div id="grid" class="col-sm-12"></div>
                        </div>
                    </div>
                    
                    <div id="blog">
                        <div id="grid" class="col-sm-12"></div>
                    </div>
                    
                    <?php if($user->type_id == 1) : if( $profile_id == $this->session->userdata('user_id') || $privacy->connection == 0 || ($privacy->connection == 1 && $type == 'friend')) : ?>
                    <div id="connection">
                        <input type="text" placeholder="Search..." onkeyup="filter_search('profileconn')" id="profile_conn" class="trans search" />
                        <div class="row main"></div>
                    </div>
                    <?php endif; endif; ?>
                    
                    <div id="pro_groups">
                        <input type="text" placeholder="Search..." onkeyup="filter_search('profilegrp')" id="profile_grp" class="trans search" />

                        <div id="progrp_c">
                            <div class="row main created"></div>
                        </div>
                        <div id="progrp_j">
                            <div class="row main joined"></div>
                        </div>
                    </div>
                    
                    <a onclick="load_more_profile(<?= $profile_id; ?>)" style="display: block" id="load_more">Load More <img src="<?= base_url('assets/img/reload.svg'); ?>" id="loader" alt="loader" /></a>
                </div>
            </div>
        </div>
        
        <?php if(!$this->agent->is_mobile()) : ?>
        <div class="col-sm-3 row-right">
            <?php $this->load->view('dashboard/sidebar/profile') ?>
            
            <?php $this->load->view('dashboard/ads/block_5', $this->adv) ?>
            
            <?php $this->load->view('dashboard/sidebar/user-activity') ?>
            
            <?php $this->load->view('dashboard/ads/block_6', $this->adv) ?>
        </div>
        <?php else : ?>
        <div class="col-sm-3 row-right">
            <?php $this->load->view('dashboard/sidebar/connection'); ?>
            
            <?php $this->load->view('dashboard/sidebar/groups') ?>
            
            <?php $this->load->view('dashboard/sidebar/invite-fb'); ?>
        </div>
        <?php endif; ?>
        
        <div id="gallery_post" class="modal fade"></div>
            
        <?php $this->load->view('dashboard/modals/timeline-indexform'); ?>
            
        <?php $this->load->view('dashboard/modals/add-delete-post'); ?>
        
        <?php $this->load->view('dashboard/modals/likes'); ?>
        
        <?php $this->load->view('dashboard/modals/share'); ?>
    </div>
</div>
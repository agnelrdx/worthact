<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container group">
    <div class="row">
        <?php if(!$this->agent->is_mobile()) : ?>
        <div class="col-sm-3 row-left">
            <?php if($group->user_id == $this->session->userdata('user_id') || $type == 'approved') : ?>
            <div class="panel panel-flat profile-list">					
                <div class="list-group list-group-lg list-group-borderless">
                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader-profile" alt="loader" />
                    <a data-ripple onclick="load_grp_timeline(<?= $group_id; ?>)" class="list-group-item trans"><i class="ion-android-globe"></i> Timeline</a>
                    <a data-ripple onclick="load_group_members(<?= $group_id; if($group->user_id == $this->session->userdata('user_id')) { echo ",'multiple'"; } ?>)" class="list-group-item trans"><i class="ion-person-stalker"></i> Members</a>
                    <?php if($group->user_id == $this->session->userdata('user_id')) : ?>
                    <a data-ripple onclick="invite_grp_mem(<?= $group_id ?>)" data-toggle="modal" class="list-group-item trans"><i class="ion-plus-round"></i> Invite</a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
            
            <?php $this->load->view('dashboard/sidebar/groups') ?>
            
            <?php $this->load->view('dashboard/sidebar/thoughts'); ?>
            
            <?php $this->load->view('dashboard/sidebar/app'); ?>
            
            <?php $this->load->view('dashboard/sidebar/recent-activity') ?>
            
            <?php $this->load->view('dashboard/sidebar/connection') ?>
        </div>
        <?php else : ?>
        <div class="col-sm-3 row-left">
            <?php if($group->user_id == $this->session->userdata('user_id') || $type == 'approved') : ?>
            <div class="panel panel-flat profile-list">					
                <div class="list-group list-group-lg list-group-borderless">
                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader-profile" alt="loader" />
                    <a data-ripple onclick="load_grp_timeline(<?= $group_id; ?>)" class="list-group-item trans"><i class="ion-android-globe"></i> Timeline</a>
                    <a data-ripple onclick="load_group_members(<?= $group_id; if($group->user_id == $this->session->userdata('user_id')) { echo ",'multiple'"; } ?>)" class="list-group-item trans"><i class="ion-person-stalker"></i> Members</a>
                    <?php if($group->user_id == $this->session->userdata('user_id')) : ?>
                    <a data-ripple onclick="invite_grp_mem(<?= $group_id ?>)" data-toggle="modal" class="list-group-item trans"><i class="ion-plus-round"></i> Invite</a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <div class="col-sm-6 row-center">
            <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="twPc-div">
                        <div class="twPc-bg twPc-block">
                            <div class="banner-block">
                                <img src="<?= base_url(($group->banner != '') ? "assets/userdata/dashboard/group/banner/" . $group->banner : "assets/img/placeholder.png"); ?>" alt="<?= $group->title; ?>" />
                            </div>
                            <h3 class="title"><a href="<?= base_url('dashboard/group/'.$group->id) ?>"><?= $group->title; ?></a></h3>
                            <div class="twPc-button">
                                <?php if($group->user_id != $this->session->userdata('user_id')) {
                                    if($type == 'approved') {
                                        echo '<div class="group-action">
                                                <button data-ripple class="btn shadow btn_right"><i class="ion-android-done-all"></i> Joined</button>
                                                <div class="dropdown clearfix"> 
                                                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ion-android-more-vertical"></i></button> 
                                                    <ul class="dropdown-menu dropdown-menu-right"> 
                                                        <li><a data-toggle="modal" data-target="#leave_group" onclick="set_leave_group('.$group_id.', 1)">Leave</a></li>
                                                    </ul> 
                                                </div>
                                              </div>';
                                    }
                                    if($type == 'pending') {
                                        echo '<button onclick="cancel_grp('.$group_id.', 1)" data-ripple class="btn shadow"><i class="ion-android-close"></i> Cancel Request</button>';
                                    }
                                    if($type === 'not_valid') {
                                        echo '<button onclick="join_group('.$group_id.', 1)" data-ripple class="btn shadow"><i class="ion-plus"></i> Join</button>';
                                    }
                                    if($type === 'accept') {
                                        echo '<div class="group-action">
                                                <button onclick="accept_group('.$group_id.', 1)" data-ripple class="btn shadow btn_right"><i class="ion-android-done"></i> Accept Invitation</button>
                                                <div class="dropdown clearfix"> 
                                                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ion-android-more-vertical"></i></button> 
                                                    <ul class="dropdown-menu dropdown-menu-right"> 
                                                        <li><a onclick="cancel_grp('.$group_id.', 1)" >Decline</a></li>
                                                    </ul> 
                                                </div>
                                              </div>';
                                    }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php if($group->user_id != $this->session->userdata('user_id') && $type !== 'approved') : ?>
            <div class="no-content shadow">
                <h5 class="panel-title">No content to show. Join the group to post and see all the contents.</h5>
            </div>
            <?php else : ?>
            <div class="panel panel-flat profile-main">
                <div class="panel-heading">
                    <h4 class="panel-title profile-head"></h4>
                </div>					
                <div class="panel-body profile-body">
                    <div id="timeline">
                        <form id="timeline_grp" class="timeline_form">
                            <div class="form-group clearfix">
                                <img src="<?= base_url(($this->info->propic != '') ? "assets/userdata/dashboard/propic/" . $this->info->propic : "assets/img/".$this->placeholder) ?>" alt="<?= ($this->session->userdata('user_type') == 1) ? ucfirst(strtolower($this->info->firstname)) . ' ' . ucfirst(strtolower($this->info->lastname)) : ucfirst(strtolower($this->info->name)); ?>">
                                <textarea name="grp_message" class="form-control grp_message" rows="3" cols="1" placeholder="Say something to the group!"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <ul class="icons-list icons-list-extended mt-10">
                                        <li data-toggle="tooltip" data-placement="top" title="Share Photos"><a data-toggle="modal" data-target="#timeline_grp_photo"><i class="ion-image position-left"></i></a></li>
                                        <li data-toggle="tooltip" data-placement="top" title="Share Video"><a data-toggle="modal" data-target="#timeline_grp_video"><i class="ion-ios-videocam position-left"></i></a></li>
                                        <li data-toggle="tooltip" data-placement="top" title="Share File"><a data-toggle="modal" data-target="#timeline_grp_file"><i class="ion-document position-left"></i></a></li>
                                        <li id="load_map" data-toggle="tooltip" data-placement="top" title="Share Location"><a data-toggle="modal" data-target="#timeline_grp_location"><i class="ion-ios-location position-left"></i></a></li>
                                    </ul>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader-home" alt="loader" />
                                    <button data-ripple type="submit" class="btn btn-sm shadow">Post <i class="ion-android-share"></i></button>
                                </div>
                            </div>
			</form>
                        <div class="row main"></div>
                    </div>
                    
                    <div id="members">
                        <div id="pro_groups">
                        <input type="text" placeholder="Search..." onkeyup="filter_search('grpmembers')" id="grp_members" class="trans search" />
                            <div class="tabbable">
                                <?php if($group->user_id == $this->session->userdata('user_id')) : ?>
                                <ul class="nav nav-tabs">
                                    <li class="active"><a class="trans" href="#grp_j" data-toggle="tab" aria-expanded="true">Joined</a></li>
                                    <li class=""><a class="trans" href="#grp_n" data-toggle="tab" aria-expanded="false">New</a></li>
                                </ul>
                                <?php endif; ?>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="grp_j">
                                        <div class="row main"></div>
                                        <p>No members to show..!!</p>
                                    </div>
                                    <?php if($group->user_id == $this->session->userdata('user_id')) : ?>
                                    <div class="tab-pane" id="grp_n">
                                        <div class="row main"></div>
                                        <p>No members to show..!!</p>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <a onclick="loadmore_grp_timeline(<?= $group_id; ?>)" style="display: block" id="load_more">Load More <img src="<?= base_url('assets/img/reload.svg'); ?>" id="loader" alt="loader" /></a>
                </div>
            </div>
            <?php $this->load->view('dashboard/modals/timeline-grpform'); $this->load->view('dashboard/modals/likes'); endif; ?>
        </div>
        
        <?php if(!$this->agent->is_mobile()) : ?>
        <div class="col-sm-3 row-right">
            <?php $this->load->view('dashboard/sidebar/group-info') ?>
            
            <?php $this->load->view('dashboard/sidebar/invite-fb'); ?>
        </div>
        <?php else : ?>
        <div class="col-sm-3 row-right">
            <?php $this->load->view('dashboard/sidebar/group-info') ?>
            
            <?php $this->load->view('dashboard/sidebar/groups') ?>
            
            <?php $this->load->view('dashboard/sidebar/connection'); ?>
            
            <?php $this->load->view('dashboard/sidebar/invite-fb'); ?>
        </div>
        <?php endif; ?>
        
        <?php if($group->user_id == $this->session->userdata('user_id')) : ?>
        <div id="invite_grp_mem" class="modal fade">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <form id="invite_grp_mem_form">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Invite Friends</h4>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                            <button data-ripple class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button data-ripple type="submit" class="btn btn-primary">Invite</button>
                            <div class="alert alert-danger" role="alert"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container home">				
    <div class="row">
        <?php if(!$this->agent->is_mobile()) : ?>
        <div class="col-sm-3 row-left">
            <?php $this->load->view('dashboard/sidebar/thumbnail'); ?>
            
            <?php $this->load->view('dashboard/sidebar/connection'); ?>
            
            <?php $this->load->view('dashboard/sidebar/groups') ?>
            
            <?php $this->load->view('dashboard/ads/block_1', $this->adv) ?>
            
            <?php $this->load->view('dashboard/sidebar/invite-fb'); ?>
            
            <?php $this->load->view('dashboard/sidebar/posts'); ?>
            
            <?php $this->load->view('dashboard/ads/block_2', $this->adv) ?>
        </div>
        <?php else : ?>
        <div class="col-sm-3 row-left">
            <?php $this->load->view('dashboard/sidebar/thumbnail'); ?>
        </div>
        <?php endif; ?>

        <div class="col-sm-6 row-center">            
            <div class="panel-flat">
                <div class="home-body">
                    <div class="tabbable">
                        <div class="tab-content">
                            <?php if (strtotime('+ 14 days', $this->info->time) > time()) : ?>
                            <div class="clearfix">
                                <?php $this->load->view('dashboard/admin-post'); ?>
                            </div>
                            <?php endif; ?>
                            
                            <div class="tab-pane active newsfeed-body" id="newsfeed">
                                <div class="news_feed_form">
                                    <form id="timeline_main" class="timeline_form shadow">
                                        <div class="form-group clearfix">
                                            <img src="<?= base_url(($this->info->propic != '') ? "assets/userdata/dashboard/propic/" . $this->info->propic : "assets/img/".$this->placeholder) ?>" alt="<?= ($this->session->userdata('user_type') == 1) ? ucfirst($this->info->firstname) . ' ' . ucfirst($this->info->lastname) : $this->info->name; ?>">
                                            <textarea name="timeline_message" class="form-control timeline_message" rows="3" cols="1" placeholder="Share your thought!"></textarea>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <ul class="icons-list icons-list-extended mt-10">
                                                    <li data-toggle="tooltip" data-placement="top" title="Share Photos"><a data-toggle="modal" data-target="#timeline_photo"><i class="ion-image position-left"></i></a></li>
                                                    <li data-toggle="tooltip" data-placement="top" title="Share Video"><a data-toggle="modal" data-target="#timeline_video"><i class="ion-ios-videocam position-left"></i></a></li>
                                                    <li data-toggle="tooltip" data-placement="top" title="Share File"><a data-toggle="modal" data-target="#timeline_file"><i class="ion-document position-left"></i></a></li>
                                                    <li id="load_map" data-toggle="tooltip" data-placement="top" title="Share Location"><a data-toggle="modal" data-target="#timeline_location"><i class="ion-ios-location position-left"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="col-xs-6 text-right">
                                                <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader-home" alt="loader" />
                                                <button data-ripple type="submit" class="btn btn-sm shadow">Post <i class="ion-android-share"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                                <div id="timeline">
                                    <h5 class="trend_title"></h5>
                                    <div class="row main"><?= $feed ?></div>
                                </div>
                                
                                <a onclick="loadmore_newsfeed('<?= (1 == 1)? 'trend' : 'news'; ?>')" id="load_more">Load More <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" /></a>
                            </div>
                            
                            <?php if($this->info->type_id == 1): ?>
                            <div class="tab-pane connection" id="allfriends">
                                <div class="row main"></div>
                            </div>
                            
                            <div class="tab-pane connection" id="allfollowers">
                                <div class="row main"></div>
                            </div>
                            <?php endif; ?>
                            
                            <div class="tab-pane gallery" id="gallery_img">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4 class="m-b-5">Photos</h4>
                                        <p>Post your  photo/pictures here.</p>
                                        <a class="add_gallery trans shadow" data-ripple data-toggle="modal" data-target="#add_gallery_image">Add Photos</a>
                                    </div>
                                    <div id="grid" class="clearfix"></div>
                                    
                                    <a onclick="load_more_gallery('img')" id="load_more">Load More <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" /></a>
                                </div>
                            </div>
                            
                            <div class="tab-pane gallery" id="gallery_vd">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4 class="m-b-5">Videos</h4>
                                        <p>Post your videos here.</p>
                                        <a class="add_gallery trans shadow" data-ripple data-toggle="modal" data-target="#add_gallery_video">Add Video</a>
                                    </div>
                                    <div id="grid" class="clearfix"></div>
                                    
                                    <a onclick="load_more_gallery('vd')" id="load_more">Load More <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" /></a>
                                </div>
                            </div>
                            
                            <?php if($this->info->user_level == 1): ?>
                            <div class="tab-pane" id="groups">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4 class="m-b-5">Groups</h4>
                                        <p>'Many drops make an Ocean' - Create groups to lead an action intended to bring a positive change in your locality or region or in any part of the world where you wish to make your mark to protect our nature and its precious life. Prioritize, get things done and stay in touch with people who share your interests to exchange ideas, photos, videos, conversations and plans that inspire.</p>
                                        <a class="add_group trans shadow" data-ripple data-toggle="modal" data-target="#add_group">Create Group</a>
                                    </div>
                                    <div class="col-sm-12 main"></div>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <div class="tab-pane" id="joinedgroups">
                                <div class="row">
                                    <div class="col-sm-12 main"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php if(!$this->agent->is_mobile()) : ?>
        <div class="col-sm-3 row-right">
            <?php $this->load->view('dashboard/ads/block_5', $this->adv) ?>
            
            <?php $this->load->view('dashboard/sidebar/thoughts'); ?>
            
            <?php $this->load->view('dashboard/sidebar/app'); ?>
            
            <?php if($this->info->job == 1 && $c_job == 0 && $this->info->type_id == 1) { $this->load->view('dashboard/sidebar/job-req'); } ?>
            
            <?php if($this->info->job == 1 && $c_job == 0 && $this->info->type_id != 1) { $this->load->view('dashboard/sidebar/job'); } ?>
            
            <?php if($this->complete_meter != 5) { $this->load->view('dashboard/sidebar/meter'); } ?>
            
            <?php $this->load->view('dashboard/sidebar/recent-activity'); ?>
            
            <?php $this->load->view('dashboard/ads/block_6', $this->adv) ?>
        </div>
        <?php else : ?>
        <div class="col-sm-3 row-right">
            <?php if($this->complete_meter != 5) { $this->load->view('dashboard/sidebar/meter'); } ?>
            
            <?php $this->load->view('dashboard/sidebar/connection'); ?>
            
            <?php $this->load->view('dashboard/sidebar/groups') ?>
            
            <?php $this->load->view('dashboard/sidebar/invite-fb'); ?>
        </div>
        <?php endif; ?>
        
        <?php $this->load->view('dashboard/modals/add-delete-gallery'); ?>
        
        <?php $this->load->view('dashboard/modals/add-delete-group'); ?>
        
        <?php $this->load->view('dashboard/modals/timeline-indexform'); ?>
        
        <?php $this->load->view('dashboard/modals/share'); ?>
        
        <?php $this->load->view('dashboard/modals/likes'); ?>
    </div>
</div>

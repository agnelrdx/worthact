<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container post listing">				
    <div class="row">
        <?php if(!$this->agent->is_mobile()) : ?>
        <div class="col-sm-3 row-left">
            <?php $this->load->view('dashboard/sidebar/posts') ?>
            
            <?php $this->load->view('dashboard/sidebar/connection') ?>
            
            <?php $this->load->view('dashboard/sidebar/groups') ?>
            
            <?php $this->load->view('dashboard/ads/block_2', $this->adv) ?>
        </div>
        <?php endif; ?>

        <div class="col-sm-6 row-center">
            <?= $this->session->flashdata('msg'); ?>
            
            <div class="panel panel-flat">
                <div class="panel-body post-single" id="listing_table">
                    <?php if($ad->img != '') : ?>
                    <div class="media-block clearfix">
                        <?php $img_arr = explode(',', $ad->img); if(count($img_arr) > 1) : ?>
                        <div id="ad_post_carousel_<?= $ad->main_id; ?>" class="carousel slide carousel-fade" data-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                <?php $count = 0; foreach ($img_arr as $arr) : ?>
                                <div class='item <?= ($count === 0)? 'active' : ''; ?>'>
                                    <a title="<?= $ad->title ?>" class="fancybox" rel="group" href="<?= base_url("assets/userdata/dashboard/ads/".$arr); ?>">
                                        <img class="shadow" src='<?= base_url("assets/userdata/dashboard/ads/".$arr); ?>' alt='<?= ($ad->title != '')? $ad->title : ''; ?>'>
                                    </a>
                                </div>
                                <?php $count++; endforeach; ?>
                            </div>
                            <a class="left carousel-control" href="#ad_post_carousel_<?= $ad->main_id; ?>" role="button" data-slide="prev"><i class="ion-chevron-left"></i></a>
                            <a class="right carousel-control" href="#ad_post_carousel_<?= $ad->main_id; ?>" role="button" data-slide="next"><i class="ion-chevron-right"></i></a>
                        </div>
                        <?php else : ?>
                        <a title="<?= $ad->title ?>" class="fancybox" rel="group" href="<?= base_url("assets/userdata/dashboard/ads/".$img_arr[0]); ?>">
                            <img class="shadow" src="<?= base_url("assets/userdata/dashboard/ads/".$img_arr[0]); ?>" alt="<?php if($ad->title != '') { echo $ad->title; } ?>" />   
                        </a>
                        <?php endif; ?>              
                    </div>
                    <?php endif; if($ad->video != '' && $ad->img == '') : ?>
                    <div class="media-block clearfix">
                        <video src="<?= base_url('assets/userdata/dashboard/ads/' . $ad->video); ?>"></video>
                    </div>
                    <?php endif; ?>
                    <div class="post-desc">
                        <?php $this->hook->user_post_check($ad->main_id); ?>
                        <h4 class="title"><?= ($ad->link != '')? "<a href='".$ad->link."' target='_blank'>".ucfirst($ad->title)."</a>" : ucfirst($ad->title); ?></h4>
                        <div class="post-details">
                            <a class="trans" href="<?= base_url('dashboard/profile/' . $ad->main_user_id) ?>"><span><i class="ion-android-person"></i> <?= ($ad->type_id == 1) ? ucfirst(strtolower($ad->firstname)) . ' ' . ucfirst(strtolower($ad->lastname)) : ucfirst(strtolower($ad->name)); ?></span></a>
                            <a><span><i class="fa fa-info" aria-hidden="true"></i> Type: <?php if($ad->req_type == 1) { echo 'Need'; } else { echo 'Action'; } ?></span></a>
                            <a><span><i class="fa fa-th-large" aria-hidden="true"></i> <?= $ad->main_cat ?></span></a>
                            <a><span><i class="fa fa-map-marker" aria-hidden="true"></i> <?= $ad->loc ?></span></a>
                            <?php if($ad->link != ''): ?><a class="trans" target="_blank" href="<?= $ad->link ?>"><span><i class="fa fa-globe" aria-hidden="true"></i> <?= (strlen($ad->link) > 35)? substr($ad->link, 0, 35).'...' : $ad->link; ?></span></a><?php endif; ?>
                            <?php if($ad->video != '' && $ad->img != ''): ?>
                            <a class="trans" data-target="#ad_video" data-toggle="modal"><span><i class="fa fa-play" aria-hidden="true"></i> Video available</span></a>
                            <?php endif; ?>
                            <a><span><i class="ion-android-calendar"></i> <?= $ad->date; ?></span></a>
                        </div>
                        <div class="post-meta">
                            <?php if($ad->ad_actions != '' && $ad->main_user_id != $this->session->userdata('user_id')) : ?>
                            <div class="btn-group post-single-action">
                                <a id="actionbtn" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-life-bouy" aria-hidden="false"></i>Action</a>
                                <ul class="dropdown-menu dropdown-menu-xs support-menu"> 
                                    <?php $this->hook->post_actions($ad->ad_actions, $ad->main_id); ?>
                                </ul>
                            </div>
                            <?php endif; ?>
                            <a onclick="like_dislike('ad', <?= $ad->main_id ?>)" <?php $this->hook->user_like_status($ad->main_id, 'ad'); ?> data-id="<?= $ad->main_id ?>"><i class="ion-thumbsup"></i> Like (<span><?= $ad->likes ?></span>)</a>
                            <?php if($ad->likes > 0) : ?><a title="View Likes" class="view_like trans" data-type="ad" data-id="<?= $ad->main_id ?>"><i class="ion-arrow-down-b"></i></a><?php endif; ?>
                            <a data-id="<?= $ad->main_id ?>" class="trans comment_count"><i class="ion-ios-chatboxes"></i> Comment (<span><?php $this->hook->comment_count($ad->main_id ,'ad') ?></span>)</a>
                            <?php if($ad->main_user_id != $this->session->userdata('user_id')) : ?>
                            <a class="trans" onclick="set_share_post(<?= $ad->main_id ?>, 'ad')"><i class="ion-refresh"></i> Share</a>
                            <?php endif; ?>
                        </div>
                        <p><?= $ad->description; ?></p>
                        <?php if ($ad->tags != ''): ?>
                        <div class="post-tags">
                            <ul>
                                <?php $tags = explode(',', $ad->tags); foreach ($tags as $tag) : ?>
                                <li class="shadow"><?= ucfirst($tag); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="comment" data-id="<?= $ad->main_id; ?>">
                        <div class="comment-block"></div>
                        <div class="media no-margin">
                            <div class="media-left">
                                <img alt="" src="<?= base_url(($this->info->propic != '') ? "assets/userdata/dashboard/propic/" . $this->info->propic : "assets/img/".$this->placeholder) ?>" class="shadow">
                            </div>
                            <div class="media-body">
                                <div class="form-group has-feedback no-margin">
                                    <div class="input-group">
                                        <input name="comment" type="text" class="form-control input-xs comment_input" data-comment-type="ad" data-type-id="<?= $ad->main_id; ?>"  placeholder="Write a comment...">
                                        <div class="input-group-btn open">
                                            <button class="comment_btn" data-ripple data-type-id="<?= $ad->main_id; ?>"><i class="ion-paper-airplane"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php if(!$this->agent->is_mobile()) : ?>
        <div class="col-sm-3 row-right">
            <?php $this->load->view('dashboard/sidebar/thoughts'); ?>
            
            <?php $this->load->view('dashboard/sidebar/app'); ?>
            
            <?php $this->load->view('dashboard/sidebar/recent-activity') ?>
            
            <?php $this->load->view('dashboard/sidebar/invite-fb'); ?>
            
            <?php $this->load->view('dashboard/ads/block_6', $this->adv) ?>
        </div>
        <?php else : ?>
        <div class="col-sm-3 row-right">
            <?php $this->load->view('dashboard/sidebar/connection'); ?>
            
            <?php $this->load->view('dashboard/sidebar/groups') ?>
            
            <?php $this->load->view('dashboard/sidebar/invite-fb'); ?>
        </div>
        <?php endif; ?>
        
        <div id="modal_actions" class="modal fade">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <form id="add_post_action">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Confirm your WorthAct Initiative</h4>
                        </div>  
                        <div class="modal-body">
                            <p>You have opted in to supporting <strong id="name-txt"></strong> by <strong id="cause-txt"></strong></p>
                            <div class="alert alert-info alert-styled-left">    
                                <span class="text-semibold">You will be able to communicate with the beneficiary once they accept the notification.</span>						
                            </div>
                            <div class="other-support-txt">
                                <h3>Your message to the Beneficiary</h3>
                                <p id="act"><span id="name"></span> is looking for: <span id="act_desc"></span></p>
                                <textarea id="post_action_desc" class="form-control custom-control input-xs"  placeholder="Describe in less than 100 words.."></textarea></span>
                            </div>
                            <div class="desclimer-area">
                                <h3>Disclaimer</h3>
                                <p>WorthAct is a platform we provide members to network, develop and work together for a change in this world. We only promote direct transactions between end users and are not liable for any kind of loss to either parties involved.</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input data-id="" type="hidden" value="" id="post_action_id" />
                            <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                            <button data-ripple class="btn btn-default" data-dismiss="modal">Close</button>
                            <button data-ripple class="btn btn-primary action-confirm-btn">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div id="post_update" class="modal fade" data-page='single'>
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="update_post_form">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Update Ad</h4>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                            <button data-ripple class="btn btn-default" data-dismiss="modal">Close</button>
                            <button data-ripple type="submit" class="btn btn-primary">Update</button>
                            <div id="form_alert_update" class="alert alert-danger" role="alert"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="post_delete" class="modal fade">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <form id="delete_post_form">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Delete Ad</h4>
                        </div>
                        <div class="modal-body">						
                            <p>Are you sure you want to delete this post ?</p>
                            <input type="hidden" value="" id="post_id" />
                            <input type="hidden" value="single" id="post_page" />
                        </div>
                        <div class="modal-footer">
                            <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                            <button data-ripple class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button data-ripple type="submit" class="btn btn-primary">Yes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <?php if($ad->video != ''): ?>
        <div id="ad_video" class="modal fade">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><?= $ad->title ?></h4>
                    </div>
                    <div class="modal-body">
                        <video src="<?= base_url('assets/userdata/dashboard/ads/' . $ad->video); ?>" class="gallery-video"></video>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <?php $this->load->view('dashboard/modals/share'); ?>
        
        <?php $this->load->view('dashboard/modals/likes'); ?>
    </div>
</div>

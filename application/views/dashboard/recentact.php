<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container recent_act">				
    <div class="row">
        <?php if(!$this->agent->is_mobile()) : ?>
        <div class="col-sm-3 row-left">
            <?php $this->load->view('dashboard/sidebar/thoughts'); ?>
            
            <?php $this->load->view('dashboard/sidebar/app'); ?>
            
            <?php $this->load->view('dashboard/sidebar/posts') ?>
            
            <?php $this->load->view('dashboard/sidebar/recent-activity') ?>
        </div>
        <?php endif; ?>
        
        <div class="col-sm-6 row-center">
            <div class="panel panel-flat">
                <div id="timeline">
                    <div class="col-sm-12 timeline_post" data-id="<?= $post->post_time ?>" data-post-id="<?= $post->timeline_post_id; ?>">
                        <div class="inner shadow">
                            <div class="timeline_post_head">
                                <a href="<?= base_url('dashboard/profile/'.$post->post_user_id) ?>"><img class="shadow" src="<?= base_url(($post->propic != '') ? "assets/userdata/dashboard/propic/".$post->propic : "assets/img/".$this->hook->get_placeholder($post->post_user_id)); ?>" alt="<?= ($post->user_type == 1) ? ucfirst($post->firstname).' '.ucfirst($post->lastname) : ucfirst($post->name); ?>" /></a>
                                <a class="title <?php if($post->content_type == 'thought') : ?>pull_down<?php endif; ?>" href="<?= base_url('dashboard/profile/'.$post->post_user_id) ?>"><h5 class="trans"><?= ($post->user_type == 1) ? ucfirst(strtolower($post->firstname)).' '.ucfirst(strtolower($post->lastname)) : ucfirst(strtolower($post->name)); ?></h5></a>
                                <?php if($post->parent_id == '' && $post->content_type != 'action' && $post->content_type != 'thought') : ?><a class='parent_user no_pointer trans'>posted <?= ($post->content_type == 'image')? 'an' : 'a'; ?> <?= ($post->content_type == 'ad')? $this->hook->sos_type($post->ad_id) : $post->content_type ?></a><?php endif; ?>
                                <div class="right">
                                    <span><i class="ion-ios-clock"></i><?= date('h:i A', $post->post_time); ?>&nbsp;&nbsp;<?= $post->post_date ?></span>
                                    <?php $this->hook->user_timeline_post_check($post->timeline_post_id, $post->content_type); ?>
                                </div>
                                <?php if($post->parent_id != '') : $this->hook->shared_user($post->parent_id); endif; if($post->content_type == 'action') : $this->hook->action_url($post->action_id); endif; ?>
                            </div>
                            <?php if($post->share_title != '') : ?>
                            <div class="timeline_post_share_title">
                                <h4><?= ucfirst($post->share_title); ?></h4>
                            </div>
                            <?php endif; if($post->title != '') : ?>
                            <div class="timeline_post_title">
                                <h4><?php if($post->blog_id == '' && $post->ad_id == '') { echo ucfirst($post->title); } ?></h4>
                            </div>
                            <?php endif; ?>
                            <?php if ($post->map != '' || $post->file != '') : ?>
                            <div class="timeline_post_media">
                                <?php if ($post->content_type === 'image') : $img_arr = explode(',', $post->file); if (count($img_arr) > 1) : ?>
                                <div id="timeline_post_carousel_<?= $post->timeline_post_id; ?>" class="carousel slide carousel-fade shadow" data-ride="carousel">
                                    <div class="carousel-inner" role="listbox">
                                            <?php $count = 0;
                                            foreach ($img_arr as $arr) : ?>
                                                        <div class='item <?= ($count === 0) ? 'active' : ''; ?>'>
                                                            <a title="<?= $post->title ?>" class="fancybox" rel="group" href="<?= base_url("assets/userdata/dashboard/timeline/" . $arr); ?>">
                                                                <img src='<?= base_url("assets/userdata/dashboard/timeline/" . $arr); ?>' alt='<?= ($post->title != '') ? $post->title : ''; ?>'>
                                                            </a>
                                                        </div>
                                                <?php $count++;
                                            endforeach; ?>
                                    </div>
                                    <a class="left carousel-control" href="#timeline_post_carousel_<?= $post->timeline_post_id; ?>" role="button" data-slide="prev"><i class="ion-chevron-left"></i></a>
                                    <a class="right carousel-control" href="#timeline_post_carousel_<?= $post->timeline_post_id; ?>" role="button" data-slide="next"><i class="ion-chevron-right"></i></a>
                                </div>
                                <?php else : ?>
                                <a title="<?= $post->title ?>" class="fancybox" rel="group" href="<?= base_url("assets/userdata/dashboard/timeline/" . $img_arr[0]); ?>">
                                    <img class="shadow" src="<?= base_url("assets/userdata/dashboard/timeline/" . $img_arr[0]); ?>" alt="<?php if ($post->title != '') { echo $post->title; } ?>" />
                                </a>    
                                <?php endif; endif; ?>
                                <?php if ($post->content_type === 'video') : ?>
                                <video src="<?= base_url("assets/userdata/dashboard/timeline/" . $post->file); ?>" class="shadow"></video>
                                <?php endif; ?>
                                <?php if ($post->content_type === 'location') : ?>
                                <div id="map_<?= $post->timeline_post_id ?>" class="map shadow"></div>
                                <script>
                                    function Map() {
                                        var myCenter = new google.maps.LatLng(<?= $post->map ?>);
                                        var mapCanvas = document.getElementById("map_<?= $post->timeline_post_id ?>");
                                        var mapOptions = {center: myCenter, zoom: 15};
                                        var map = new google.maps.Map(mapCanvas, mapOptions);
                                        var marker = new google.maps.Marker({position: myCenter});
                                        marker.setMap(map);
                                    }
                                </script>
                                <?php endif; ?>
                                <?php if ($post->content_type === 'file') : ?>
                                <div class="file shadow">
                                    <a href="<?= base_url('dashboard/download/' . $post->file . '/user'); ?>">
                                        <img src="<?= base_url("assets/img/file.png"); ?>" alt="<?= $post->file ?>" />
                                        <h5>Download File</h5>
                                    </a>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                            <?php if($post->content_type === 'action'):  $this->hook->timeline_action($post->action_id);  endif; ?>
                            <?php if ($post->tags != '') : ?>
                            <div class="timeline_post_tags">
                                <?php $tags = explode(',', $post->tags);
                                foreach ($tags as $tag) : ?><span class="cat"><?= $tag ?></span><?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                            <?php if ($post->description != '') : ?>
                            <div class="timeline_post_content">
                                <p><?= $post->description ?></p>
                            </div>
                            <?php endif; ?>
                            <div class="timeline_post_action">
                                <a onclick="like_dislike('<?= $post->content_type ?>', <?= $post->timeline_post_id ?>)" <?php $this->hook->user_like_status($post->timeline_post_id, $post->content_type); ?> data-id="<?= $post->timeline_post_id ?>"><i class="ion-thumbsup"></i> Like (<span><?= $post->likes ?></span>)</a>
                                <?php if($post->likes > 0) : ?> <a title="View Likes" class="view_like trans" data-type="<?= $post->content_type ?>" data-id="<?= $post->timeline_post_id ?>"><i class="ion-arrow-down-b"></i></a> <?php endif; ?>
                                <a data-id="<?= $post->timeline_post_id ?>" onclick="load_comment('<?= $post->content_type ?>', <?= $post->timeline_post_id ?>)" class="trans comment_count"><i class="ion-ios-chatboxes"></i> Comment (<span><?php $this->hook->comment_count($post->timeline_post_id, $post->content_type) ?></span>)</a>
                                <?php if($post->post_user_id != $this->session->userdata('user_id') && $post->content_type != 'action') : ?>
                                <a onclick="set_share_post(<?= $post->timeline_post_id ?>, 'newsfeed')"><i class="ion-refresh"></i> Share</a>
                                <?php endif; ?>
                            </div>
                            <div class="comment" data-id="<?= $post->timeline_post_id; ?>">
                                <div class="comment-block"></div>
                                <div class="media no-margin">
                                    <div class="media-left">
                                        <img alt="" src="<?= base_url(($this->info->propic != '') ? "assets/userdata/dashboard/propic/" . $this->info->propic : "assets/img/".$this->placeholder) ?>" class="shadow">
                                    </div>
                                    <div class="media-body">
                                        <div class="form-group has-feedback no-margin">
                                            <div class="input-group">
                                                <input name="comment" type="text" class="form-control input-xs comment_input" data-comment-type="<?= $post->content_type ?>" data-type-id="<?= $post->timeline_post_id; ?>"  placeholder="Write a comment...">
                                                <div class="input-group-btn open">
                                                    <button class="comment_btn" data-ripple data-type-id="<?= $post->timeline_post_id; ?>"><i class="ion-paper-airplane"></i></button>
                                                </div>
                                            </div>
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
            <?php $this->load->view('dashboard/sidebar/connection') ?>
            
            <?php $this->load->view('dashboard/sidebar/groups') ?>
            
            <?php $this->load->view('dashboard/sidebar/invite-fb'); ?>
        </div>
        <?php else : ?>
        <div class="col-sm-3 row-right">
            <?php $this->load->view('dashboard/sidebar/connection'); ?>
            
            <?php $this->load->view('dashboard/sidebar/groups') ?>
            
            <?php $this->load->view('dashboard/sidebar/invite-fb'); ?>
        </div>
        <?php endif; ?>
        
        <?php $this->load->view('dashboard/modals/share'); ?>
        
        <?php $this->load->view('dashboard/modals/likes'); ?>
        
        <div id="timeline_privacy" class="modal fade timeline_modal_form">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <form id="timeline_post_privacy">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Privacy</h4>
                        </div>
                        <div class="modal-body">						
                            <div class="form-group">
                                <label class="main">Change the privacy of the post.</label>
                                <div class="radio">
                                    <label>
                                        <input class="p_one" type="radio" name="privacy" value="0">
                                        <i class="ion-earth"></i> Public
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input class="p_two" type="radio" name="privacy" value="1">
                                        <i class="ion-person-stalker"></i> Friends
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input class="p_three" type="radio" name="privacy" value="2">
                                        <i class="ion-locked"></i> Only Me
                                    </label>
                                </div>
                                <input type="hidden" value="" name="privacy_post_id" id="privacy_post_id" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                            <button data-ripple class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button data-ripple type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div id="delete_timeline_post" class="modal fade timeline_modal_form">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <form id="delete_timeline_post_form">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Delete Post</h4>
                        </div>
                        <div class="modal-body">						
                            <p>Are you sure you want to delete this post from the timeline ?</p>
                            <input type="hidden" value="" id="delete_post_id" />
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
    </div>
</div>
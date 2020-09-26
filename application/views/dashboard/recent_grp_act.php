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
                                <a href="<?= base_url('dashboard/profile/' . $post->post_user_id) ?>"><img class="shadow" src="<?= base_url(($post->propic != '') ? "assets/userdata/dashboard/propic/" . $post->propic : "assets/img/".$this->hook->get_placeholder($post->post_user_id)); ?>" alt="<?= ($post->user_type == 1) ? ucfirst($post->firstname) . ' ' . ucfirst($post->lastname) : ucfirst($post->name); ?>" /></a>
                                <a href="<?= base_url('dashboard/profile/' . $post->post_user_id) ?>"><h5 class="trans"><?= ($post->user_type == 1) ? ucfirst(strtolower($post->firstname)) . ' ' . ucfirst(strtolower($post->lastname)) : ucfirst(strtolower($post->name)); ?></h5></a>
                                <div class="right">
                                    <span><i class="ion-ios-clock"></i><?= date('h:i A', $post->post_time); ?>&nbsp;&nbsp;<?= $post->post_date ?></span>
                                </div>
                            </div>
                            <?php if ($post->title != '') : ?>
                            <div class="timeline_post_title">
                                <h4><?= ucfirst($post->title); ?></h4>
                            </div>
                            <?php endif; ?>
                            <?php if ($post->map != '' || $post->file != '') : ?>
                            <div class="timeline_post_media">
                                <?php if ($post->content_type == 'image') : $img_arr = explode(',', $post->file); if (count($img_arr) > 1) : ?>
                                <div id="timeline_post_carousel_<?= $post->timeline_post_id; ?>" class="carousel slide carousel-fade shadow" data-ride="carousel">
                                    <div class="carousel-inner" role="listbox">
                                            <?php $count = 0;
                                            foreach ($img_arr as $arr) : ?>
                                                        <div class='item <?= ($count === 0) ? 'active' : ''; ?>'>
                                                            <a title="<?= $post->title ?>" class="fancybox" rel="group" href="<?= base_url("assets/userdata/dashboard/group/content/" . $arr); ?>">
                                                                <img src='<?= base_url("assets/userdata/dashboard/group/content/" . $arr); ?>' alt='<?= ($post->title != '') ? $post->title : ''; ?>'>
                                                            </a>
                                                        </div>
                                                <?php $count++;
                                            endforeach; ?>
                                    </div>
                                    <a class="left carousel-control" href="#timeline_post_carousel_<?= $post->timeline_post_id; ?>" role="button" data-slide="prev"><i class="ion-chevron-left"></i></a>
                                    <a class="right carousel-control" href="#timeline_post_carousel_<?= $post->timeline_post_id; ?>" role="button" data-slide="next"><i class="ion-chevron-right"></i></a>
                                </div>
                                <?php else : ?>
                                <a title="<?= $post->title ?>" class="fancybox" rel="group" href="<?= base_url("assets/userdata/dashboard/group/content/" . $img_arr[0]); ?>">
                                    <img class="shadow" src="<?= base_url("assets/userdata/dashboard/group/content/" . $img_arr[0]); ?>" alt="<?php if ($post->title != '') { echo $post->title; } ?>" />
                                </a>    
                                <?php endif; endif; ?>
                                <?php if ($post->content_type === 'video') : ?>
                                <video src="<?= base_url("assets/userdata/dashboard/group/content/" . $post->file); ?>" class="shadow"></video>
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
                                <a onclick="like_dislike('group', <?= $post->timeline_post_id ?>)" <?php $this->hook->user_like_status($post->timeline_post_id, 'group'); ?> data-id="<?= $post->timeline_post_id ?>"><i class="ion-thumbsup"></i> Like (<span><?= $post->likes ?></span>)</a>
                                <?php if($post->likes > 0) : ?> <a title="View Likes" class="view_like trans" data-type="group" data-id="<?= $post->timeline_post_id ?>"><i class="ion-arrow-down-b"></i></a> <?php endif; ?>
                                <a data-id="<?= $post->timeline_post_id ?>" onclick="load_comment('group', <?= $post->timeline_post_id ?>)" class="trans comment_count"><i class="ion-ios-chatboxes"></i> Comment (<span><?php $this->hook->comment_count($post->timeline_post_id, 'group') ?></span>)</a>
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
                                                <input name="comment" type="text" class="form-control input-xs comment_input" data-comment-type="group" data-type-id="<?= $post->timeline_post_id; ?>"  placeholder="Write a comment...">
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
        
        <?php $this->load->view('dashboard/modals/likes'); ?>
    </div>
</div>
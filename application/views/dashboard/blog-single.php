<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">				
    <div class="row">
        <div class="blog-page">
            <?php if(!$this->agent->is_mobile()) : ?>
            <div class="col-sm-3 row-left">
                <div class="thumbnail blog-add clearfix">
                    <h4>Add a new Blog post</h4>
                    <p>Share and learn about our Earth; express your thoughts with WorthAct blog-spot.</p>
                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                    <a data-ripple href="<?=base_url('dashboard/blog')?>" class="view-blog-md trans pull-left">View All</a>
                    <a data-ripple class="add-blog-md trans pull-right">Add Blog</a>
                </div>
                
                <?php $this->load->view('dashboard/ads/block_1', $this->adv) ?>
                
                <?php $this->load->view('dashboard/sidebar/connection') ?>
                
                <?php $this->load->view('dashboard/sidebar/groups') ?>
                
                <?php $this->load->view('dashboard/sidebar/invite-fb'); ?>
                
                <?php $this->load->view('dashboard/ads/block_2', $this->adv) ?>
            </div>
            <?php else : ?>
            <div class="col-sm-3 row-left">
                <div class="thumbnail blog-add clearfix">
                    <h4>Add a new Blog post</h4>
                    <p>Start or involve yourself to enrich your knowledge by sharing and learning about matters that are important.</p>
                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                    <a data-ripple class="add-blog-md trans">Add Blog</a>
                </div>
            </div>
            <?php endif; ?>

            <div class="col-sm-6 panel-blog-single row-center">
                <?= $this->session->flashdata('msg'); ?>
                
                <div class="panel panel-flat">
                    <?php $file = explode('.', $blog->file); $file_type = end($file); ?>
                    <div class="blog-post-single">
                            <?php if ($file_type != '') : ?>
                            <div class="blog-img-thumb">
                                <?php if ($file_type == 'mp4') : ?>
                                <video src="<?= base_url('assets/userdata/dashboard/blog/' . $blog->file); ?>"></video>
                                <?php endif; if ($file_type == 'png' || $file_type == 'jpg') : ?>
                                <img src="<?= base_url('assets/userdata/dashboard/blog/' . $blog->file); ?>" alt="<?= $blog->title ?>" title="<?= $blog->title ?>" />
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                        <div class="blog-post-desc">
                            <?php $this->hook->user_blog_check($blog->main_id); ?>
                            <h4 class="title"><?= ucfirst(strtolower($blog->title)); ?></h4>
                            <div class="blog-post-meta">
                                <a class="trans" href="<?= base_url('dashboard/profile/' . $blog->main_user_id) ?>"><span><i class="ion-android-person"></i> <?= ($blog->type_id == 1) ? ucfirst(strtolower($blog->firstname)) . ' ' . ucfirst(strtolower($blog->lastname)) : ucfirst(strtolower($blog->name)); ?></span></a>
                                <a onclick="like_dislike('blog_inner', <?= $blog->id ?>)" <?php $this->hook->user_like_status($blog->id, 'blog'); ?>><i class="ion-thumbsup"></i> Like (<span><?= $blog->likes ?></span>)</a> 
                                <?php if($blog->likes > 0) : ?> <a title="View Likes" class="view_like trans" data-type="blog" data-id="<?= $blog->id ?>"><i class="ion-arrow-down-b"></i></a> <?php endif; ?>
                                <a data-id="<?= $blog->id ?>" class="comment_count"><i class="ion-ios-chatboxes"></i> Comment (<span><?php $this->hook->comment_count($blog->id ,'blog') ?></span>)</a>
                                <?php if($blog->main_user_id != $this->session->userdata('user_id')) : ?>
                                <a class="trans" onclick="set_share_post(<?= $blog->main_id ?>, 'blog')"><i class="ion-refresh"></i> Share</a>
                                <?php endif; ?>
                                <a class="none"><span><i class="ion-android-calendar"></i> <?= $blog->date; ?></span></a>
                            </div>
                            <div class="blog-content">
                                <?= $blog->content; ?>
                            </div>
                            <?php if ($blog->tags != ''): ?>
                            <div class="blog-post-tags">
                                <ul>
                                    <?php $tags = explode(',', $blog->tags); foreach ($tags as $tag) : ?>
                                    <li class="shadow"><?= ucfirst($tag); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="comment" data-id="<?= $blog->main_id; ?>">
                            <div class="comment-block"></div>
                            <div class="media no-margin">
				<div class="media-left">
                                    <img alt="" src="<?= base_url(($this->info->propic != '') ? "assets/userdata/dashboard/propic/" . $this->info->propic : "assets/img/".$this->placeholder) ?>" class="shadow">
				</div>
				<div class="media-body">
                                    <div class="form-group has-feedback no-margin">
                                        <div class="input-group">
                                            <input name="comment" type="text" class="form-control input-xs comment_input" data-comment-type="blog" data-type-id="<?= $blog->main_id; ?>"  placeholder="Write a comment...">
                                            <div class="input-group-btn open">
						<button class="comment_btn" data-ripple data-type-id="<?= $blog->main_id; ?>"><i class="ion-paper-airplane"></i></button>
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
                <?php $this->load->view('dashboard/ads/block_5', $this->adv) ?>
                
                <?php if($this->info->user_level == 0) { $this->load->view('dashboard/sidebar/upgrade'); } ?>
                
                <?php $this->load->view('dashboard/sidebar/thoughts'); ?>
                
                <?php $this->load->view('dashboard/sidebar/app'); ?>
                
                <?php $this->load->view('dashboard/sidebar/recent-activity') ?>
                
                <?php $this->load->view('dashboard/ads/block_6', $this->adv) ?>
            </div>
            <?php else : ?>
            <div class="col-sm-3 row-right">
                <?php $this->load->view('dashboard/sidebar/connection'); ?>
            
                <?php $this->load->view('dashboard/sidebar/groups') ?>
            
                <?php $this->load->view('dashboard/sidebar/invite-fb'); ?>
            </div>
            <?php endif; ?>

            <?php $this->load->view('dashboard/modals/add-delete-blog'); ?>
            
            <?php $this->load->view('dashboard/modals/share'); ?>
            
            <?php $this->load->view('dashboard/modals/likes'); ?>
        </div>
    </div>
</div>    
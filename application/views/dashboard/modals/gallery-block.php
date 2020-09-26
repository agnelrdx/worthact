<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="modal-dialog" id="gallery_timeline" data-backdrop="static" data-keyboard="false">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body timeline_post">
            <div class="row">
                <div class="col-sm-7 left">
                    <?php if ($file->content_type == 'video') : ?>
                    <div class="video-block shadow">
                        <video preload="auto" src="<?= base_url('assets/userdata/dashboard/timeline/' . $file->file); ?>" class="gallery-video"></video>
                    </div>
                    <?php endif; ?>
                    <?php if($file->content_type === 'image') : $img_arr = explode(',', $file->file); if(count($img_arr) > 1) : ?>
                    <div id="gallery_image_carousel_<?= $file->id.$file->time ?>" class="carousel slide carousel-fade shadow" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <?php $count = 0; foreach ($img_arr as $arr) : ?><div class='item <?= ($count === 0)? 'active' : ''; ?>'><img src='<?= base_url("assets/userdata/dashboard/timeline/".$arr); ?>' alt='<?= ($file->title != '')? $file->title : ''; ?>'></div><?php $count++; endforeach; ?>
                        </div>
                        <a class="left carousel-control" href="#gallery_image_carousel_<?= $file->id.$file->time ?>" role="button" data-slide="prev"><i class="ion-chevron-left"></i></a>
                        <a class="right carousel-control" href="#gallery_image_carousel_<?= $file->id.$file->time ?>" role="button" data-slide="next"><i class="ion-chevron-right"></i></a>
                    </div>
                    <?php else : ?>
                    <img class="shadow img-responsive" src="<?= base_url("assets/userdata/dashboard/timeline/".$img_arr[0]); ?>" alt="<?php if($file->title != '') { echo $file->title; } ?>" />
                    <?php endif; endif; ?>
                </div>
                <div class="col-sm-5">
                    <h4 class="modal-title"><?= ucfirst($file->title) ?></h4>
                    <p class="content"><?= $file->description; ?></p>
                    <?php if($file->tags != '') : ?>
                    <div class="gallery_post_tags">
                        <?php $tags = explode(',', $file->tags); foreach ($tags as $tag) : ?><span class="cat"><?= $tag ?></span><?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <div class="post_action">
                        <a onclick="gallery_like_dislike('<?= $file->content_type ?>', <?= $file->id ?>)" <?php $this->hook->user_like_status($file->id, $file->content_type); ?> data-id="<?= $file->id ?>"><i class="ion-thumbsup"></i> Like (<span><?= $file->likes ?></span>)</a>
                        <a data-id="<?= $file->id ?>" onclick="load_comment('<?= $file->content_type ?>', <?= $file->id ?>)" class="trans comment_count"><i class="ion-ios-chatboxes"></i> Comment (<span><?php $this->hook->comment_count($file->id , $file->content_type) ?></span>)</a>
                    </div>
                    <div class="comment" data-id="<?= $file->id; ?>">
                        <div class="comment-block"></div>
                        <div class="media no-margin">
                            <div class="media-left">
                                <img alt="" src="<?= base_url(($this->info->propic != '') ? "assets/userdata/dashboard/propic/" . $this->info->propic : "assets/img/".$this->placeholder) ?>" class="shadow">
                            </div>
                            <div class="media-body">
                                <div class="form-group has-feedback no-margin">
                                    <div class="input-group">
                                        <input name="comment" type="text" class="form-control input-xs comment_input" data-comment-type="<?= $file->content_type ?>" data-type-id="<?= $file->id; ?>"  placeholder="Write a comment...">
                                        <div class="input-group-btn open">
                                            <button class="comment_btn" data-ripple data-type-id="<?= $file->id; ?>"><i class="ion-paper-airplane"></i></button>
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




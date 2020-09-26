<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

foreach ($gallery as $file) : ?>
<div class="grid-item col-sm-6" data-id="<?= $file->time ?>">
    <div class="meta">
        <a <?php $this->hook->user_like_status($file->id, $file->content_type); ?>><i class="ion-heart trans"></i> <span><?= $file->likes ?></span></a>
        <?php if($file->likes > 0) : ?> <a title="View Likes" class="view_like trans" data-type="<?= $file->content_type ?>" data-id="<?= $file->id ?>"><i class="ion-arrow-down-b"></i></a> <?php endif; ?>
        <a><i class="ion-ios-chatboxes"></i> Comment (<?php $this->hook->comment_count($file->id ,$file->content_type) ?>)</a>
        <a data-post-id="<?= $file->id ?>" class="view_post trans"><i class="ion-android-expand"></i> View</a>
    </div>
    <?php if ($file->content_type == 'video') : ?>
    <div class="video-block">
        <video src="<?= base_url('assets/userdata/dashboard/timeline/' . $file->file); ?>" class="shadow"></video>
    </div>
    <?php endif; ?>
    <?php if($file->content_type === 'image') : $img_arr = explode(',', $file->file); if(count($img_arr) > 1) : ?>
    <div id="gallery_image_carousel_<?= $file->id ?>" class="carousel slide carousel-fade shadow" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <?php $count = 0; foreach ($img_arr as $arr) : ?>
            <div class='item <?= ($count === 0)? 'active' : ''; ?>'>
                <a title="<?= $file->title ?>" class="fancybox" rel="group" href="<?= base_url("assets/userdata/dashboard/timeline/".$arr); ?>">
                    <img src='<?= base_url("assets/userdata/dashboard/timeline/".$arr); ?>' alt='<?= ($file->title != '')? $file->title : ''; ?>'>
                </a>
            </div>
            <?php $count++; endforeach; ?>
        </div>
        <a class="left carousel-control" href="#gallery_image_carousel_<?= $file->id ?>" role="button" data-slide="prev"><i class="ion-chevron-left"></i></a>
        <a class="right carousel-control" href="#gallery_image_carousel_<?= $file->id ?>" role="button" data-slide="next"><i class="ion-chevron-right"></i></a>
    </div>
    <?php else : ?>
    <a title="<?= $file->title ?>" class="fancybox" rel="group" href="<?= base_url("assets/userdata/dashboard/timeline/".$img_arr[0]); ?>">
        <img class="shadow" src="<?= base_url("assets/userdata/dashboard/timeline/".$img_arr[0]); ?>" alt="<?php if($file->title != '') { echo $file->title; } ?>" />
    </a>
    <?php endif; endif; ?>
    <ul class="fab-menu fab-menu-absolute fab-menu-top-right" data-fab-toggle="hover">
        <li>
            <a class="fab-menu-btn btn bg-success btn-float btn-rounded btn-icon"><i class="ion-android-settings"></i></a>
            <ul class="fab-menu-inner">
                <li>
                    <div class="fab-label-visible delete_gallery" data-fab-label="Delete" data-toggle="modal" <?= ($file->content_type == 'video')? 'data-target="#delete_gallery_video"' : 'data-target="#delete_gallery_image"'; ?> >
                        <a onclick="delete_gallery(<?= $file->id; ?>, '<?= $file->content_type ?>')" data-ripple class="btn btn-default btn-rounded btn-icon btn-float"><i class="ion-trash-a"></i></a>														
                    </div>
                </li>
            </ul>
        </li>
    </ul>
</div>
<?php endforeach; ?>
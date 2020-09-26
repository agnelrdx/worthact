<?php defined('BASEPATH') OR exit('No direct script access allowed'); if(count($ads) > 0) : $adv_count = 1; foreach ($ads as $ad): if($this->session->userdata('adv_count') == '') { if($adv_count == 4) { $this->hook->adv_timeline_module('worthact_initiatives', 'block_3'); }  if($adv_count == 7) { $this->hook->adv_timeline_module('worthact_initiatives', 'block_7'); } } if($this->session->userdata('adv_count') == 1) { if($adv_count == 4) { $this->hook->adv_timeline_module('worthact_initiatives', 'block_4'); }  if($adv_count == 7) { $this->hook->adv_timeline_module('worthact_initiatives', 'block_8'); } } ?>

<div class="ad shadow" data-id="<?= $ad->main_post_time ?>" data-post="<?= $ad->main_post_id; ?>">
    <div class="ad_post_head">
        <a href="<?= base_url('dashboard/profile/'.$ad->main_user_id) ?>"><img class="shadow" src="<?= base_url(($ad->pro_pic != '') ? "assets/userdata/dashboard/propic/".$ad->pro_pic : "assets/img/".$this->hook->get_placeholder($ad->main_user_id)); ?>" alt="<?= ($ad->user_type == 1) ? ucfirst($ad->fname).' '.ucfirst($ad->lname) : ucfirst($ad->company_name); ?>" /></a>
        <a href="<?= base_url('dashboard/profile/'.$ad->main_user_id) ?>"><h5 class="trans"><?= ($ad->user_type == 1) ? ucfirst(strtolower($ad->fname)).' '.ucfirst(strtolower($ad->lname)) : ucfirst(strtolower($ad->company_name)); ?></h5></a>
        <div class="right">
            <span><i class="ion-ios-clock"></i><?= date('h:i A', $ad->main_post_time); ?>&nbsp;&nbsp;<?= $ad->main_post_date ?></span>
            <?php $this->hook->user_post_check($ad->main_post_id); ?>
        </div>
    </div>
    <?php if($ad->img != '') : ?>
    <div class="media-block clearfix">
        <?php $img_arr = explode(',', $ad->img); if(count($img_arr) > 1) : ?>
        <div id="ad_post_carousel_<?= $ad->main_post_id; ?>" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner" role="listbox">
                <?php $count = 0; foreach ($img_arr as $arr) : ?>
                <div class='item <?= ($count === 0)? 'active' : ''; ?>'>
                    <img class="shadow" src='<?= base_url("assets/userdata/dashboard/ads/".$arr); ?>' alt='<?= ($ad->title != '')? $ad->title : ''; ?>'>
                </div>
                <?php $count++; endforeach; ?>
            </div>
            <a class="left carousel-control" href="#ad_post_carousel_<?= $ad->main_post_id; ?>" role="button" data-slide="prev"><i class="ion-chevron-left"></i></a>
            <a class="right carousel-control" href="#ad_post_carousel_<?= $ad->main_post_id; ?>" role="button" data-slide="next"><i class="ion-chevron-right"></i></a>
        </div>
        <?php else : ?>
        <img class="shadow" src="<?= base_url("assets/userdata/dashboard/ads/".$img_arr[0]); ?>" alt="<?php if($ad->title != '') { echo $ad->title; } ?>" />   
        <?php endif; ?>              
    </div>
    <?php endif; ?>
    <div class="content">
        <a href="<?= base_url('dashboard/sos/'.$ad->main_post_id); ?>"><h3 class="title trans"><?= ucfirst($ad->title); ?></h3></a>
        <div class="meta">
            <span><i class="fa fa-user" aria-hidden="true"></i> Type: <?php if($ad->req_type == 1) { echo 'Need'; } else { echo 'Action'; } ?></span>
            <span><i class="fa fa-th-large" aria-hidden="true"></i> <?= $ad->main_cat ?></span>
            <span><i class="fa fa-map-marker" aria-hidden="true"></i> <?= $ad->loc ?></span>
            <?php if($ad->link != '') : ?><span><i class="fa fa-globe" aria-hidden="true"></i> <a class="trans" target="_blank" href="<?= $ad->link ?>"><?= (strlen($ad->link) > 35)? substr($ad->link, 0, 35).'...' : $ad->link; ?></a></span><?php endif; ?>
            <?php if($ad->video != ''): ?>
            <span><i class="fa fa-play" aria-hidden="true"></i> Video available</span>
            <?php endif; ?>
        </div>
        <?php if($ad->tags != ''): $tags = explode(',', $ad->tags); ?>
        <div class="tags">
            <?php foreach($tags as $tag) : echo "<span class='shadow'>$tag</span>"; endforeach; ?>
        </div>
        <?php endif; ?>
        <a class="trans" href="<?= base_url('dashboard/sos/'.$ad->main_post_id); ?>">
            <div class="para">
                <p><?= substr($ad->description, 0, 100); ?>...Read More</p>
            </div>
        </a>    
        <ul class="quick-actions">
            <?php if($ad->ad_actions != '' && $ad->main_user_id != $this->session->userdata('user_id')) : ?>
            <li>
                <div class="btn-group">
                    <a id="actionbtn" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-life-bouy" aria-hidden="false"></i>Action</a>
                    <ul class="dropdown-menu dropdown-menu-xs support-menu"> 
                        <?php $this->hook->post_actions($ad->ad_actions, $ad->main_post_id); ?>
                    </ul> 
                </div>
            </li>
            <?php endif; ?>
            <li>
                <a <?php if($ad->likes > 0) : ?>style="margin-right:0px;"<?php endif; ?> onclick="like_dislike('ad', <?= $ad->main_post_id ?>)" <?php $this->hook->user_like_status($ad->main_post_id, 'ad'); ?> data-id="<?= $ad->main_post_id ?>"><i class="ion-thumbsup"></i> Like (<span><?= $ad->likes ?></span>)</a>
                <?php if($ad->likes > 0) : ?><a title="View Likes" class="view_like trans" data-type="ad" data-id="<?= $ad->main_post_id ?>"><i class="ion-arrow-down-b"></i></a><?php endif; ?>
            </li>
            <li><a data-id="<?= $ad->main_post_id ?>" onclick="load_comment('ad', <?= $ad->main_post_id ?>)" class="trans comment_count"><i class="ion-ios-chatboxes"></i> Comment (<span><?php $this->hook->comment_count($ad->main_post_id , 'ad') ?></span>)</a></li>                                    
            <?php if($ad->main_user_id != $this->session->userdata('user_id')) : ?>
            <li><a class="trans" onclick="set_share_post(<?= $ad->main_post_id ?>, 'ad')"><i class="ion-refresh"></i> Share</a></li>
            <?php endif; ?>
        </ul>
    </div>
    <div class="comment" data-id="<?= $ad->main_post_id; ?>">
        <div class="comment-block"></div>
            <div class="media no-margin">
                <div class="media-left">
                    <img alt="" src="<?= base_url(($this->info->propic != '') ? "assets/userdata/dashboard/propic/" . $this->info->propic : "assets/img/".$this->placeholder) ?>" class="shadow">
                </div>
                <div class="media-body">
                <div class="form-group has-feedback no-margin">
                    <div class="input-group">
                        <input name="comment" type="text" class="form-control input-xs comment_input" data-comment-type="ad" data-type-id="<?= $ad->main_post_id; ?>"  placeholder="Write a comment...">
                        <div class="input-group-btn open">
                            <button class="comment_btn" data-ripple data-type-id="<?= $ad->main_post_id; ?>"><i class="ion-paper-airplane"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $adv_count++; endforeach; if($this->session->userdata('adv_count') == 1) { $this->session->set_userdata('adv_count', 2); } endif; ?>
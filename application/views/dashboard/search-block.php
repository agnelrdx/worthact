<?php defined('BASEPATH') OR exit('No direct script access allowed');

if($type === 'user') : if(count($users) > 0) : foreach($users as $user): ?>
<div class="col-sm-6">
    <div class="block users shadow clearfix" data-id='<?= $user->user_time ?>'>
        <div class="thumb">
            <a href="<?= base_url('dashboard/profile/'.$user->main_id) ?>">
                <img src="<?= base_url(($user->propic != '') ? "assets/userdata/dashboard/propic/".$user->propic : "assets/img/".$this->hook->get_placeholder($user->main_id)); ?>" alt="<?= $user->username; ?>" />
                <?php if($user->user_level == 1) { echo "<img title='Premium' class='premium_badge' src='".base_url('assets/img/badge.png')."' alt='badge' />"; } ?>
            </a>
        </div>
        <div class="content">
            <h5><a href="<?= base_url('dashboard/profile/'.$user->main_id) ?>"><?= ($user->type_id == 1) ? ucfirst(strtolower($user->firstname)).' '.ucfirst(strtolower($user->lastname)) : ucfirst(strtolower($user->name)); ?></a></h5>
            <p class="text-muted"><?php if(($user->user_city != '' && $user->user_state != '') || ($user->city != '' && $user->state != '')) { echo ($user->type_id == 1)? ucfirst(strtolower($user->user_city)).' '.ucfirst(strtolower($user->user_state)).', ' : ucfirst(strtolower($user->city)).' '.ucfirst(strtolower($user->state)).' ,'; } ?><?= ($user->type_id == 1)? $user->user_country : $user->org_country ?></p>
        </div>
        <?php if($this->info->type_id == 1) : ?>
        <ul class="icons-list">
            <li class="dropdown">
                <a class="toggle_action dropdown-toggle toggle_action" aria-expanded="false"><i class="ion-navicon-round"></i></a>
                <ul data-list-id="<?= $user->main_id ?>" class="dropdown-menu frnd-menu dropdown-menu-right">
                    <?php $this->hook->check_connection($user->main_id); ?>
                    <li><a href="<?= base_url('dashboard/profile/'.$user->main_id) ?>">View Profile</a></li>
                </ul>
            </li>
        </ul>
        <?php endif; ?>
    </div>
</div>    
<?php endforeach; endif; endif; if($type === 'post') : if(count($posts) > 0) : foreach($posts as $post): ?>
<a class="datablock" href="<?= base_url('dashboard/sos/'.$post->main_id); ?>" data-id="<?= $post->time; ?>">
    <div class="block shadow clearfix">
        <div class="content">
            <h5><?= ucfirst($post->title); ?></h5>
            <p class="meta">
                <span data-toggle="tooltip" data-placement="top" title="Posted By"><i class="ion-person"></i> <?= ($post->type_id == 1) ? ucfirst(strtolower($post->firstname)).' '.ucfirst(strtolower($post->lastname)) : ucfirst(strtolower($post->name)); ?></span>
                <span><i class="fa fa-info" aria-hidden="true"></i> Type: <?php if($post->req_type == 1) { echo 'Need'; } else { echo 'Action'; } ?></span>
                <span><i class="fa fa-th-large" aria-hidden="true"></i> <?= $post->main_cat ?></span>
                <span><i class="ion-android-pin right" aria-hidden="true"></i><?= $post->country_name ?></span>
                <?php if($post->video != ''): ?>
                <span><i class="fa fa-play" aria-hidden="true"></i> Video available</span>
                <?php endif; ?>
                <span><i class="ion-android-calendar"></i> <?= $post->date; ?></span>
            </p>
            <?= substr($post->description, 0 , 200).'...Read More'; ?>
            <?php if($post->tags != '') : ?>
            <ul>
                <li><?php $tags = explode(',', $post->tags); foreach ($tags as $tag) : ?><span class="cat shadow"><?= $tag ?></span><?php endforeach; ?></li>
            </ul>
            <?php endif; ?>
        </div>
    </div>
</a>    
<?php endforeach; endif; endif; if($type === 'blog') : if(count($blogs) > 0) : foreach($blogs as $blog): ?>
<a class="datablock" href="<?= base_url('dashboard/blog/'.$blog->main_id); ?>" data-id="<?= $blog->time; ?>">
    <div class="block shadow clearfix">
        <div class="content">
            <h5><?= ucfirst($blog->title); ?></h5>
            <p class="meta">
                <span data-toggle="tooltip" data-placement="top" title="Author"><i class="ion-person"></i> <?= ($blog->type_id == 1) ? ucfirst(strtolower($blog->firstname)).' '.ucfirst(strtolower($blog->lastname)) : ucfirst(strtolower($blog->name)); ?></span>
                <span data-toggle="tooltip" data-placement="top" title="Visibility"><i class="ion-clipboard"></i> <?php switch ($blog->privacy) { case 0 : echo 'Public'; break; case 1: echo 'Only Friends'; break; default: echo 'Private'; } ?></span>
                <span data-toggle="tooltip" data-placement="top" title="Posted on"><i class="ion-calendar"></i> <?= date('H:i A', $blog->time); ?>&nbsp;&nbsp;<?= $blog->date ?></span>
            </p>
            <?= substr($blog->content, 0 , 200).'...Read More'; ?>
            <?php if($blog->tags != '') : ?>
            <ul>
                <li><?php $tags = explode(',', $blog->tags); foreach ($tags as $tag) : ?><span class="cat shadow"><?= $tag ?></span><?php endforeach; ?></li>
            </ul>
            <?php endif; ?>
        </div>
    </div>
</a>   
<?php endforeach; endif; endif; if($type === 'group') : if(count($groups) > 0) : foreach($groups as $group): ?>
<div class="col-sm-6">
    <div class="block shadow clearfix group" data-id='<?= $group->group_time ?>'>
        <div class="thumb">
            <a href="<?= base_url('dashboard/group/'.$group->main_id) ?>"><img src="<?= base_url(($group->banner != '') ? "assets/userdata/dashboard/group/banner/".$group->banner : "assets/img/placeholder.png"); ?>" alt="<?= $group->title; ?>" /></a>
        </div>
        <div class="content">
            <a href="<?= base_url('dashboard/group/'.$group->main_id) ?>"><h5><?= ucfirst($group->title);  ?></h5></a>
        </div>
        <ul class="icons-list">
            <li class="dropdown">
                <a class="toggle_action dropdown-toggle toggle_action" aria-expanded="false"><i class="ion-navicon-round"></i></a>
                <ul data-list-id="<?= $group->main_id ?>" class="dropdown-menu grp-menu dropdown-menu-right">
                    <?php $this->hook->check_group($group->main_id); ?>
                    <li><a href="<?= base_url('dashboard/group/'.$group->main_id) ?>">View Group</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>    
<?php endforeach; endif; endif; if($type == 'ajax') : ?>
<div class="list">
    <ul>
        <?php $end_count = 1; $count = 1; if(count($result['user']) > 0) : foreach ($result['user'] as $user) : if($count > 5) { break; } $count++; $end_count++ ?>
        <li>
            <a class="trans" href="<?= base_url('dashboard/profile/'.$user->main_user_id) ?>"><?= ($user->type_id == 1) ? ucfirst(strtolower($user->firstname)).' '.ucfirst(strtolower($user->lastname)) : ucfirst(strtolower($user->name)); ?> <?php if($user->type_id == 1) : ?><span class="badge badge-primary pull-right">User</span><?php endif; ?><?php if($user->type_id == 2) : ?><span class="badge badge-primary pull-right">Org</span><?php endif; ?><?php if($user->type_id == 3) : ?><span class="badge badge-primary pull-right">Company</span><?php endif; ?></a>
        </li>
        <?php endforeach; endif; $count = 1; if(count($result['blog']) > 0) : foreach ($result['blog'] as $blog) : if($count > 3) { break; } $count++; $end_count++ ?>
        <li>
            <a class="trans" href="<?= base_url('dashboard/blog/'.$blog->main_blog_id); ?>"><?= ucfirst($blog->title); ?> <span class="badge badge-primary pull-right">Blog</span></a>
        </li>
        <?php endforeach; endif; $count = 1; if(count($result['ad']) > 0) : foreach ($result['ad'] as $ad) : if($count > 3) { break; } $count++; $end_count++ ?>
        <li>
            <a class="trans" href="<?= base_url('dashboard/sos/'.$ad->main_ad_id); ?>"><?= ucfirst($ad->title); ?> <span class="badge badge-primary pull-right">SOS</span></a>
        </li>
        <?php endforeach; endif; $count = 1; if(count($result['group']) > 0) : foreach ($result['group'] as $group) : if($count > 3) { break; } $count++; $end_count++ ?>
        <li>
            <a class="trans" href="<?= base_url('dashboard/group/'.$group->main_grp_id) ?>"><?= ucfirst($group->title);  ?> <span class="badge badge-primary pull-right">Group</span></a>
        </li>
        <?php endforeach; endif; if($end_count == 1): ?>
        <li class="no_result">No results found.</li>
        <?php endif; ?>
    </ul>
</div>
<?php endif; ?>

<?php defined('BASEPATH') OR exit('No direct script access allowed'); if(!isset($type_not)): if($this->notifications['type_not'] == 'load') : $end_count = 0; ?>

<div class="media-container">											
    <ul class="clearfix">
        <?php $count = 0; if (count($this->notifications['grp_member']) > 0) : foreach ($this->notifications['grp_member'] as $act) : if($count > 2) { break; } $count++; $end_count++; ?>
        <li class="clearfix group" data-id="<?= $act->group_time ?>">
            <a href="<?= base_url('dashboard/group/' . $act->main_grp_id) ?>" class="media-thumb"><img src="<?= base_url(($act->propic != '') ? 'assets/userdata/dashboard/propic/' . $act->propic : 'assets/img/'.$this->hook->get_placeholder($act->main_id)); ?>" alt="<?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?>"></a>
            <a href="<?= base_url('dashboard/group/' . $act->main_grp_id) ?>" class="media-title trans">
                <strong><?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?></strong> wants to join your group. <span class="media-time"><i class="ion-android-time"></i> <?= date('h:i:s a', $act->group_time) . ' ' . date('d M Y', $act->group_time); ?></span>
                <small class="head text-muted">Group Name: <?= ucfirst($act->title); ?></small>
            </a>
        </li>
        <?php endforeach; endif; $count = 0; if (count($this->notifications['accepted_grp']) > 0) : foreach ($this->notifications['accepted_grp'] as $act) : if($this->hook->check_accepted_grp($act->main_grp_id)) : if($count > 2) { break; } $count++; $end_count++; ?>
        <li class="clearfix acc_group" data-id="<?= $act->group_time ?>">
            <a href="<?= base_url('dashboard/group/' . $act->main_grp_id) ?>" class="media-thumb"><img src="<?= base_url(($act->banner != '') ? 'assets/userdata/dashboard/group/banner/' . $act->banner : 'assets/img/placeholder.png'); ?>" alt="<?= $act->title; ?>"></a>
            <a href="<?= base_url('dashboard/group/' . $act->main_grp_id) ?>" class="media-title trans">
                <strong><?= ucfirst($act->title); ?></strong> accepted your group request. <span class="media-time"><i class="ion-android-time"></i> <?= date('h:i:s a', $act->group_time) . ' ' . date('d M Y', $act->group_time); ?></span>
            </a>
        </li>
        <?php endif; endforeach; endif; $count = 0; if (count($this->notifications['invited_grp']) > 0) : foreach ($this->notifications['invited_grp'] as $act) : if($count > 2) { break; } $count++; $end_count++; ?>
        <li class="clearfix inv_group" data-id="<?= $act->group_time ?>">
            <a href="<?= base_url('dashboard/group/' . $act->main_grp_id) ?>" class="media-thumb"><img src="<?= base_url(($act->propic != '') ? 'assets/userdata/dashboard/propic/' . $act->propic : 'assets/img/'.$this->hook->get_placeholder($act->main_id)); ?>" alt="<?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?>"></a>
            <a href="<?= base_url('dashboard/group/' . $act->main_grp_id) ?>" class="media-title trans">
                <strong><?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?></strong> invited you to join a group. <span class="media-time"><i class="ion-android-time"></i> <?= date('h:i:s a', $act->group_time) . ' ' . date('d M Y', $act->group_time); ?></span>
                <small class="head text-muted">Group Name: <?= ucfirst($act->title); ?></small>
            </a>
        </li>
        <?php endforeach; endif; $count = 0; if (count($this->notifications['comment_likes']) > 0) : foreach ($this->notifications['comment_likes'] as $act) : if($count > 5) { break; } $count++; $end_count++; $href = $this->hook->get_comment_href($act->type_id); ?>
        <li class="clearfix cmt_like" data-id="<?= $act->time; ?>">
            <a href="<?= $href ?>" class="media-thumb"><img src="<?= base_url(($act->propic != '') ? 'assets/userdata/dashboard/propic/' . $act->propic : 'assets/img/'.$this->hook->get_placeholder($act->main_id)); ?>" alt="<?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?>" /></a>
            <a href="<?= $href ?>" class="media-title trans">
                <strong><?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?></strong> liked your comment. <span class="media-time"><i class="ion-android-time"></i> <?= date('h:i:s a', $act->time) . ' ' . date('d M Y', $act->time); ?></span>
            </a>
        </li>
        <?php endforeach; endif; $count = 0; if (count($this->notifications['notifications']) > 0) : $href = ''; foreach ($this->notifications['notifications'] as $act) : if($this->hook->check_user_notification($act->type, $act->type_id)):   if($act->type == 'blog') { $href = base_url('dashboard/blog/' . $act->type_id); } elseif($act->type == 'ad') { $href = base_url('dashboard/sos/' . $act->type_id); } else { $href = base_url('dashboard/recent_activities/'.$act->type_id); } if($count > 8) { break; } $count++; $end_count++; if($act->date == '1' && $act->type != 'group') : ?>
        <li class="clearfix other" data-id="<?= $act->time; ?>">
            <a href="<?= $href ?>" class="media-thumb"><img src="<?= base_url(($act->propic != '') ? 'assets/userdata/dashboard/propic/' . $act->propic : 'assets/img/'.$this->hook->get_placeholder($act->main_id)); ?>" alt="<?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?>" /></a>
            <a href="<?= $href ?>" class="media-title trans">
                <strong><?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?></strong> liked your <?php if($act->type == 'file' || $act->type == 'location' || $act->type == 'thought') { echo 'timeline post'; } else { if($act->type == 'ad'){ echo $this->hook->sos_type($act->type_id); } else { echo $act->type.' post.'; } } ?> <span class="media-time"><i class="ion-android-time"></i> <?= date('h:i:s a', $act->time) . ' ' . date('d M Y', $act->time); ?></span>
                <?php $this->hook->activity_title($act->type_id, $act->type); ?>
            </a>
        </li>
        <?php endif; if ($act->date != '1' && $act->type != 'group' && $this->hook->check_comment_notification($act->row_id)) : ?>
        <li class="clearfix other" data-id="<?= $act->time; ?>">
            <a href="<?= $href ?>" class="media-thumb"><img src="<?= base_url(($act->propic != '') ? 'assets/userdata/dashboard/propic/' . $act->propic : 'assets/img/'.$this->hook->get_placeholder($act->main_id)); ?>" alt="<?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?>" /></a>
            <a href="<?= $href ?>" class="media-title trans">
                <strong><?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?></strong> commented on your <?php if($act->type == 'file' || $act->type == 'location' || $act->type == 'thought') { echo 'timeline post'; } else { if($act->type == 'ad'){ echo $this->hook->sos_type($act->type_id); } else { echo $act->type.' post.'; } } ?> <span class="media-time"><i class="ion-android-time"></i> <?= date('h:i:s a', $act->time) . ' ' . date('d M Y', $act->time); ?></span>
                <?php $this->hook->activity_title($act->type_id, $act->type); ?>
            </a>
        </li>
        <?php endif; endif; endforeach; endif; ?>
    </ul>
    <?php if($end_count == 0) : ?>
    <a class="btn btn-link btn-block btn-view-all no-msg"><span><i class="icon-comment"></i> No new notifications</span></a>
    <?php else : ?>
    <a class="btn btn-link btn-block btn-view-all trans" href="<?= base_url('dashboard/notifications') ?>"><span><i class="icon-comment"></i> View all notifications</span></a>
    <?php endif; ?>
</div>
<?php endif; endif;

if(isset($type_not)): if($type_not == 'new') : if (count($grp_member) > 0) :  foreach ($grp_member as $act) : ?>
<li class="clearfix group" data-id="<?= $act->group_time ?>">
    <a href="<?= base_url('dashboard/group/' . $act->main_grp_id) ?>" class="media-thumb"><img src="<?= base_url(($act->propic != '') ? 'assets/userdata/dashboard/propic/' . $act->propic : 'assets/img/'.$this->hook->get_placeholder($act->main_id)); ?>" alt="<?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?>"></a>
    <a href="<?= base_url('dashboard/group/' . $act->main_grp_id) ?>" class="media-title trans">
        <strong><?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?></strong> wants to join your group. <span class="media-time"><i class="ion-android-time"></i> <?= date('h:i:s a', $act->group_time) . ' ' . date('d M Y', $act->group_time); ?></span>
        <small class="head text-muted">Group Name: <?= ucfirst($act->title); ?></small>
    </a>
</li>
<?php endforeach; endif; if(count($accepted_grp) > 0) : foreach ($accepted_grp as $act) : if($this->hook->check_accepted_grp($act->main_grp_id)) : ?>
<li class="clearfix acc_group" data-id="<?= $act->group_time ?>">
    <a href="<?= base_url('dashboard/group/' . $act->main_grp_id) ?>" class="media-thumb"><img src="<?= base_url(($act->banner != '') ? 'assets/userdata/dashboard/group/banner/' . $act->banner : 'assets/img/placeholder.png'); ?>" alt="<?= $act->title; ?>"></a>
    <a href="<?= base_url('dashboard/group/' . $act->main_grp_id) ?>" class="media-title trans">
        <strong><?= ucfirst($act->title); ?></strong> accepted your group request. <span class="media-time"><i class="ion-android-time"></i> <?= date('h:i:s a', $act->group_time) . ' ' . date('d M Y', $act->group_time); ?></span>
    </a>
</li>
<?php endif; endforeach; endif; if (count($invited_grp) > 0) : foreach ($invited_grp as $act) : ?>
<li class="clearfix inv_group" data-id="<?= $act->group_time ?>">
    <a href="<?= base_url('dashboard/group/' . $act->main_grp_id) ?>" class="media-thumb"><img src="<?= base_url(($act->propic != '') ? 'assets/userdata/dashboard/propic/' . $act->propic : 'assets/img/'.$this->hook->get_placeholder($act->main_id)); ?>" alt="<?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?>"></a>
    <a href="<?= base_url('dashboard/group/' . $act->main_grp_id) ?>" class="media-title trans">
        <strong><?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?></strong> invited you to join a group. <span class="media-time"><i class="ion-android-time"></i> <?= date('h:i:s a', $act->group_time) . ' ' . date('d M Y', $act->group_time); ?></span>
        <small class="head text-muted">Group Name: <?= ucfirst($act->title); ?></small>
    </a>
</li>
<?php endforeach; endif; if (count($comment_likes) > 0) : foreach ($comment_likes as $act) : $href = $this->hook->get_comment_href($act->type_id); ?>
<li class="clearfix cmt_like" data-id="<?= $act->time; ?>">
    <a href="<?= $href ?>" class="media-thumb"><img src="<?= base_url(($act->propic != '') ? 'assets/userdata/dashboard/propic/' . $act->propic : 'assets/img/'.$this->hook->get_placeholder($act->main_id)); ?>" alt="<?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?>" /></a>
    <a href="<?= $href ?>" class="media-title trans">
        <strong><?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?></strong> liked your comment. <span class="media-time"><i class="ion-android-time"></i> <?= date('h:i:s a', $act->time) . ' ' . date('d M Y', $act->time); ?></span>
    </a>
</li>
<?php endforeach; endif; if (count($notifications) > 0) : $href = ''; foreach ($notifications as $act) : if($this->hook->check_user_notification($act->type, $act->type_id)): if($act->type == 'blog') { $href = base_url('dashboard/blog/' . $act->type_id); } elseif($act->type == 'ad') { $href = base_url('dashboard/sos/' . $act->type_id); } else { $href = base_url('dashboard/recent_activities/'.$act->type_id); } if($act->date == '1' && $act->type != 'group') : ?>
<li class="clearfix other" data-id="<?= $act->time; ?>">
    <a href="<?= $href ?>" class="media-thumb"><img src="<?= base_url(($act->propic != '') ? 'assets/userdata/dashboard/propic/' . $act->propic : 'assets/img/'.$this->hook->get_placeholder($act->main_id)); ?>" alt="<?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?>"></a>
    <a href="<?= $href ?>" class="media-title trans">
        <strong><?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?></strong> liked your <?php if($act->type == 'file' || $act->type == 'location' || $act->type == 'thought') { echo 'timeline post'; } else { if($act->type == 'ad'){ echo $this->hook->sos_type($act->type_id); } else { echo $act->type.' post.'; } } ?> <span class="media-time"><i class="ion-android-time"></i> <?= date('h:i:s a', $act->time) . ' ' . date('d M Y', $act->time); ?></span>
        <?php $this->hook->activity_title($act->type_id, $act->type); ?>
    </a>
</li>
<?php endif; if ($act->date != '1' && $act->type != 'group' && $this->hook->check_comment_notification($act->row_id)) : ?>
<li class="clearfix other" data-id="<?= $act->time; ?>">
    <a href="<?= $href ?>" class="media-thumb"><img src="<?= base_url(($act->propic != '') ? 'assets/userdata/dashboard/propic/' . $act->propic : 'assets/img/'.$this->hook->get_placeholder($act->main_id)); ?>" alt="<?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?>"></a>
    <a href="<?= $href ?>" class="media-title trans">
        <strong><?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?></strong> commented on your <?php if($act->type == 'file' || $act->type == 'location' || $act->type == 'thought') { echo 'timeline post'; } else { if($act->type == 'ad'){ echo $this->hook->sos_type($act->type_id); } else { echo $act->type.' post.'; } } ?> <span class="media-time"><i class="ion-android-time"></i> <?= date('h:i:s a', $act->time) . ' ' . date('d M Y', $act->time); ?></span>;
        <?php $this->hook->activity_title($act->type_id, $act->type); ?>
    </a>
</li>
<?php endif; endif; endforeach; endif; endif; endif;?>

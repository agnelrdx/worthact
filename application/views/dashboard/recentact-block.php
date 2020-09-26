<?php defined('BASEPATH') OR exit('No direct script access allowed');

if (count($recent_act) > 0) { $href = ''; foreach ($recent_act as $act) : if($act->date != '' && $act->comment != '') : if($act->type == 'blog') { $href = base_url('dashboard/blog/'.$act->type_id); } elseif($act->type == 'ad') { $href = base_url('dashboard/sos/'.$act->type_id); } elseif($act->type == 'group') { $href = base_url('dashboard/group_activities/'.$act->type_id); } else { $href = base_url('dashboard/recent_activities/'.$act->type_id); } if ($act->date == '1') : ?>
<div data-id='<?= $act->time ?>' class='sl-item'>
    <a href="<?= $href; ?>">
        <div class='sl-content'>
            <small class='text-muted'><i class='ion-android-time position-left'></i><?= date('h:i:s a', $act->time) . ' ' . $act->date ?> <?php $this->hook->activity_privacy($act->type_id, $act->type); ?></small>
            <p><?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?> <?= ($act->date == 1)? 'liked' : 'disliked'; ?> a <?php if($act->type == 'file' || $act->type == 'location' || $act->type == 'thought') { echo 'timeline post'; } else { if($act->type == 'ad'){ echo $this->hook->sos_type($act->type_id); } else { echo $act->type.' post.'; } } ?></p>
            <?php if(!$act->type == 'comment') { $this->hook->activity_title($act->type_id, $act->type); } ?>
        </div>
    </a>
</div>
<?php else : if($this->hook->check_comment_notification($act->row_id)) : ?>
<div data-id='<?= $act->time ?>' class='sl-item'>
    <a href="<?= $href; ?>">
        <div class='sl-content'>
            <small class='text-muted'><i class='ion-android-time position-left'></i><?= date('h:i:s a', $act->time) . ' ' . $act->date ?> <?php $this->hook->activity_privacy($act->type_id, $act->type); ?></small>
            <p><?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?> commented on a <?php if($act->type == 'file' || $act->type == 'location' || $act->type == 'thought') { echo 'timeline post'; } else { if($act->type == 'ad'){ echo $this->hook->sos_type($act->type_id); } else { echo $act->type.' post.'; } } ?></p>
            <?php $this->hook->activity_title($act->type_id, $act->type); ?>
        </div>
    </a>    
</div>
<?php endif; endif; endif; endforeach; }
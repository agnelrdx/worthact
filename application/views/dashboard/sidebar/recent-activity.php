<?php defined('BASEPATH') OR exit('No direct script access allowed');  if(count($this->recent_act) > 0) : ?>

<div class="panel panel-flat recent-act">
    <div class="panel-heading">
        <h5 class="panel-title">Activity Feed</h5>				
    </div>
    <div class="panel-body nano">						
        <div class="streamline nano-content" <?php if(count($this->recent_act) > 5) { echo "style='height: 310px'"; } ?>> 
            <?php $href = ''; $count = 1; foreach ($this->recent_act as $act) :  if($act->date != '' && $act->comment != '') : if($act->type == 'blog') { $href = base_url('dashboard/blog/' . $act->type_id); } else if($act->type == 'ad') { $href = base_url('dashboard/sos/' . $act->type_id); } else if($act->type == 'comment') { $href = $this->hook->get_comment_href($act->type_id); } else if($act->type == 'group') { $href = base_url('dashboard/group_activities/' . $act->type_id); } else { $href = base_url('dashboard/recent_activities/'. $act->type_id); } ?>
            <?php if($act->date == '1') : $count++; ?>
            <div data-id="<?= $act->time; ?>" class="sl-item">
                <a href="<?= $href; ?>">
                    <div class="sl-content">
                        <small class="text-muted"><i class="ion-android-time position-left"></i><?= date('h:i:s a', $act->time).' '.date('d M Y', $act->time); ?> <?php if(!$act->type == 'comment') { $this->hook->activity_privacy($act->type_id, $act->type); } ?></small>
                        <p><?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : $act->name; ?> liked a <?php if($act->type == 'file' || $act->type == 'location' || $act->type == 'thought') { echo 'timeline post'; } else { if($act->type == 'ad'){ echo $this->hook->sos_type($act->type_id); } else if($act->type == 'comment') { echo 'comment'; } else { echo $act->type.' post.'; } } ?></p>
                        <?php if(!$act->type == 'comment') { $this->hook->activity_title($act->type_id, $act->type); } ?>
                    </div>
                </a>
            </div>
            <?php else : if($this->hook->check_comment_notification($act->row_id)) : $count++; ?>
            <div data-id="<?= $act->time; ?>" class="sl-item">
                <a href="<?= $href; ?>">
                    <div class="sl-content">
                        <small class="text-muted"><i class="ion-android-time position-left"></i><?= date('h:i:s a', $act->time).' '.$act->date; ?> <?php $this->hook->activity_privacy($act->type_id, $act->type); ?></small>
                        <p><?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : $act->name; ?> commented on a <?php if($act->type == 'file' || $act->type == 'location' || $act->type == 'thought') { echo 'timeline post'; } else { if($act->type == 'ad'){ echo $this->hook->sos_type($act->type_id); } else { echo $act->type.' post.'; } } ?></p>
                        <?php $this->hook->activity_title($act->type_id, $act->type); ?>
                    </div>
                </a>    
            </div>
            <?php endif; endif; endif; endforeach; if($count == 1) { echo '<p class="none">No activities to show.</p>'; } ?>
        </div>	
    </div>
</div>
<?php endif; ?>
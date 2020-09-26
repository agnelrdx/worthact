<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container notifications">				
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
                <div class="panel-body">
                    <h4>Your Notifications</h4>
                    <a href="<?= base_url('dashboard/notifications') ?>" class="user_notifications trans"><i class="ion-android-arrow-back"></i> Go Back</a>
                    <div class="notification-block">
                        <div class="streamline">
                            <?php if (count($user_activities) > 0) : $href = ''; foreach ($user_activities as $act) : if($act->type == 'blog') { $href = base_url('dashboard/blog/' . $act->type_id); } elseif($act->type == 'ad') { $href = base_url('dashboard/sos/' . $act->type_id); } else { $href = base_url('dashboard/recent_activities/'.$act->type_id); } if ($act->date == '1' && $act->type != 'group') : ?>
                            <div class="sl-item" data-id="<?= $act->time; ?>">
                                <a href="<?= $href ?>" class="media-thumb"><img src="<?= base_url(($act->propic != '') ? "assets/userdata/dashboard/propic/" . $act->propic : "assets/img/".$this->placeholder); ?>" alt="<?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?>"></a>
                                <a href="<?= $href ?>" class="media-title trans">
                                    <strong>You liked a <?php if($act->type == 'file' || $act->type == 'location' || $act->type == 'thought') { echo 'timeline post'; } else { if($act->type == 'ad'){ echo $this->hook->sos_type($act->type_id); } else { echo $act->type.' post.'; } } ?> <span class="media-time"><i class="ion-android-time"></i> <?= date('h:i:s a', $act->time) . ' ' . date('d M Y', $act->time); ?></span>
                                    <?php if(!$act->type == 'comment') { $this->hook->activity_title($act->type_id, $act->type); } ?>
                                </a>
                            </div>
                            <?php endif; if ($act->date != '1' && $act->type != 'group' && $this->hook->check_comment_notification($act->row_id)) : ?>
                            <div class="sl-item" data-id="<?= $act->time; ?>">
                                <a href="<?= $href ?>" class="media-thumb"><img src="<?= base_url(($act->propic != '') ? "assets/userdata/dashboard/propic/" . $act->propic : "assets/img/".$this->placeholder); ?>" alt="<?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?>"></a>
                                <a href="<?= $href ?>" class="media-title trans">
                                    <strong>You commented on a <?php if($act->type == 'file' || $act->type == 'location' || $act->type == 'thought') { echo 'timeline post'; } else { if($act->type == 'ad'){ echo $this->hook->sos_type($act->type_id); } else { echo $act->type.' post.'; } } ?> <span class="media-time"><i class="ion-android-time"></i> <?= date('h:i:s a', $act->time) . ' ' . date('d M Y', $act->time); ?></span>
                                    <?php $this->hook->activity_title($act->type_id, $act->type); ?>
                                </a>
                            </div>
                            <?php endif; endforeach; endif; ?>
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
        
    </div>
</div>

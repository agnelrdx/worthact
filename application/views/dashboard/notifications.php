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
                    <h4>Notifications</h4>
                    <a href="<?= base_url('dashboard/user_notifications') ?>" class="user_notifications trans">View your activities</a>
                    <div class="notification-block">
                        <div class="streamline">
                            <?php if (count($grp_member) > 0) : foreach ($grp_member as $act) : ?>
                            <div class="sl-item" data-id="<?= $act->group_time ?>">
                                <a href="<?= base_url('dashboard/group/' . $act->main_grp_id) ?>" class="media-thumb"><img src="<?= base_url(($act->propic != '') ? "assets/userdata/dashboard/propic/" . $act->propic : "assets/img/".$this->hook->get_placeholder($act->main_id)); ?>" alt="<?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?>"></a>
                                <a href="<?= base_url('dashboard/group/' . $act->main_grp_id) ?>" class="media-title trans">
                                    <strong><?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?></strong> wants to join your group. <span class="media-time"><i class="ion-android-time"></i> <?= date('h:i:s a', $act->group_time) . ' ' . date('d M Y', $act->group_time); ?></span>
                                    <small class="head text-muted">Group Name: <?= ucfirst($act->title); ?></small>
                                </a>
                            </div>
                            <?php endforeach; endif; if(count($accepted_grp) > 0) : foreach ($accepted_grp as $act) : if($this->hook->check_accepted_grp($act->main_grp_id)) : ?>
                            <div class="sl-item" data-id="<?= $act->group_time ?>">
                                <a href="<?= base_url('dashboard/group/' . $act->main_grp_id) ?>" class="media-thumb"><img src="<?= base_url(($act->banner != '') ? "assets/userdata/dashboard/group/banner/" . $act->banner : "assets/img/placeholder.png"); ?>" alt="<?= $act->title; ?>"></a>
                                <a href="<?= base_url('dashboard/group/' . $act->main_grp_id) ?>" class="media-title trans">
                                    <strong><?= ucfirst($act->title); ?></strong> accepted your group request. <span class="media-time"><i class="ion-android-time"></i> <?= date('h:i:s a', $act->group_time) . ' ' . date('d M Y', $act->group_time); ?></span>
                                </a>
                            </div>
                            <?php endif; endforeach; endif; if (count($invited_grp) > 0) : foreach ($this->notifications['invited_grp'] as $act) : if($count > 4) { break; } $count++; ?>
                            <div class="sl-item" data-id="<?= $act->group_time ?>">
                                <a href="<?= base_url('dashboard/group/' . $act->main_grp_id) ?>" class="media-thumb"><img src="<?= base_url(($act->propic != '') ? 'assets/userdata/dashboard/propic/' . $act->propic : 'assets/img/'.$this->hook->get_placeholder($act->main_id)); ?>" alt="<?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?>"></a>
                                <a href="<?= base_url('dashboard/group/' . $act->main_grp_id) ?>" class="media-title trans">
                                    <strong><?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?></strong> invited you to join a group. <span class="media-time"><i class="ion-android-time"></i> <?= date('h:i:s a', $act->group_time) . ' ' . date('d M Y', $act->group_time); ?></span>
                                    <small class="head text-muted">Group Name: <?= ucfirst($act->title); ?></small>
                                </a>
                            </div>
                            <?php endforeach; endif; if (count($comment_likes) > 0) : foreach ($comment_likes as $act) : $href = $this->hook->get_comment_href($act->type_id); ?>
                            <li class="clearfix cmt_like" data-id="<?= $act->time; ?>">
                                <a href="<?= $href ?>" class="media-thumb"><img src="<?= base_url(($act->propic != '') ? 'assets/userdata/dashboard/propic/' . $act->propic : 'assets/img/'.$this->hook->get_placeholder($act->main_id)); ?>" alt="<?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?>" /></a>
                                <a href="<?= $href ?>" class="media-title trans">
                                    <strong><?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?></strong> liked your comment. <span class="media-time"><i class="ion-android-time"></i> <?= date('h:i:s a', $act->time) . ' ' . date('d M Y', $act->time); ?></span>
                                </a>
                            </li>
                            <?php endforeach; endif; if (count($notifications) > 0) : $href = ''; foreach ($notifications as $act) : if($this->hook->check_user_notification($act->type, $act->type_id)): if($act->type == 'blog') { $href = base_url('dashboard/blog/' . $act->type_id); } elseif($act->type == 'ad') { $href = base_url('dashboard/sos/' . $act->type_id); } else { $href = base_url('dashboard/recent_activities/'.$act->type_id); } if ($act->date == '1' && $act->type != 'group') : ?>
                            <div class="sl-item" data-id="<?= $act->time; ?>">
                                <a href="<?= $href ?>" class="media-thumb"><img src="<?= base_url(($act->propic != '') ? "assets/userdata/dashboard/propic/" . $act->propic : "assets/img/".$this->hook->get_placeholder($act->main_id)); ?>" alt="<?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?>"></a>
                                <a href="<?= $href ?>" class="media-title trans">
                                    <strong><?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?></strong> liked your <?php if($act->type == 'file' || $act->type == 'location' || $act->type == 'thought') { echo 'timeline post'; } else { if($act->type == 'ad'){ echo $this->hook->sos_type($act->type_id); } else { echo $act->type.' post.'; } } ?> <span class="media-time"><i class="ion-android-time"></i> <?= date('h:i:s a', $act->time) . ' ' . date('d M Y', $act->time); ?></span>
                                    <?php $this->hook->activity_title($act->type_id, $act->type); ?>
                                </a>
                            </div>
                            <?php endif; if ($act->date != '1' && $act->type != 'group') : ?>
                            <div class="sl-item" data-id="<?= $act->time; ?>">
                                <a href="<?= $href ?>" class="media-thumb"><img src="<?= base_url(($act->propic != '') ? "assets/userdata/dashboard/propic/" . $act->propic : "assets/img/".$this->hook->get_placeholder($act->main_id)); ?>" alt="<?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?>"></a>
                                <a href="<?= $href ?>" class="media-title trans">
                                    <strong><?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?></strong> commented on your <?php if($act->type == 'file' || $act->type == 'location' || $act->type == 'thought') { echo 'timeline post'; } else { if($act->type == 'ad'){ echo $this->hook->sos_type($act->type_id); } else { echo $act->type.' post.'; } } ?> <span class="media-time"><i class="ion-android-time"></i> <?= date('h:i:s a', $act->time) . ' ' . date('d M Y', $act->time); ?></span>
                                    <?php $this->hook->activity_title($act->type_id, $act->type); ?>
                                </a>
                            </div>
                            <?php endif; endif; endforeach; endif; ?>
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

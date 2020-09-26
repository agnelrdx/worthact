<?php defined('BASEPATH') OR exit('No direct script access allowed'); if(!isset($type_req_not)): if($this->req_notifications['type_req_not'] == 'load') :  $count = 0; ?>
<div class="media-container">											
    <ul class="clearfix">
        <?php if (count($this->req_notifications['new_conn']) > 0) : foreach ($this->req_notifications['new_conn'] as $act) : if($count > 4) { break; } $count++; ?>
        <li class="clearfix conn" data-id="<?= $act->conn_time ?>">
            <a href="<?= base_url('dashboard/profile/' . $act->main_user_id) ?>" class="media-thumb"><img src="<?= base_url(($act->propic != '') ? 'assets/userdata/dashboard/propic/' . $act->propic : 'assets/img/'.$this->hook->get_placeholder($act->main_user_id)); ?>" alt="<?= ($act->user_type == 1) ? ucfirst($act->firstname) . ' ' . ucfirst($act->lastname) : $act->name; ?>"></a>
            <a href="<?= base_url('dashboard/profile/' . $act->main_user_id) ?>" class="media-title trans">
                <strong><?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?></strong> sent you a connection request. <span class="media-time"><i class="ion-android-time"></i> <?= date('h:i:s a', $act->time) . ' ' . date('d M Y', $act->time); ?></span>
            </a>
        </li>
        <?php endforeach; endif; if (count($this->req_notifications['accepted_conn']) > 0) : foreach ($this->req_notifications['accepted_conn'] as $act) : if($count > 4) { break; } $count++; ?>
        <li class="clearfix acc_conn" data-id="<?= $act->conn_time ?>">
            <a href="<?= base_url('dashboard/profile/' . $act->main_user_id) ?>" class="media-thumb"><img src="<?= base_url(($act->propic != '') ? 'assets/userdata/dashboard/propic/' . $act->propic : 'assets/img/'.$this->hook->get_placeholder($act->main_user_id)); ?>" alt="<?= ($act->user_type == 1) ? ucfirst($act->firstname) . ' ' . ucfirst($act->lastname) : $act->name; ?>"></a>
            <a href="<?= base_url('dashboard/profile/' . $act->main_user_id) ?>" class="media-title trans">
                <strong><?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?></strong> accepted your connection request. <span class="media-time"><i class="ion-android-time"></i> <?= date('h:i:s a', $act->time) . ' ' . date('d M Y', $act->time); ?></span>
            </a>
        </li>
        <?php endforeach; endif; ?>
    </ul>
    <?php if($count == 0) : ?>
    <a href="<?= base_url('dashboard/sent_requests') ?>" class="btn btn-link btn-block btn-view-all no-msg"><span><i class="icon-comment"></i>No new requests. View sent requests</span></a>
    <?php else : ?>
    <a class="btn btn-link btn-block btn-view-all trans" href="<?= base_url('dashboard/requests') ?>"><span><i class="icon-comment"></i> View all requests</span></a>
    <?php endif; ?>
</div>
<?php endif; endif; ?>
<?php if(isset($type_req_not)): if($type_req_not == 'new') : if (count($new_conn) > 0) : foreach ($new_conn as $act) : ?>
<li class="clearfix conn" data-id="<?= $act->conn_time ?>">
    <a href="<?= base_url('dashboard/profile/' . $act->main_user_id) ?>" class="media-thumb"><img src="<?= base_url(($act->propic != '') ? 'assets/userdata/dashboard/propic/' . $act->propic : 'assets/img/'.$this->hook->get_placeholder($act->main_user_id)); ?>" alt="<?= ($act->user_type == 1) ? ucfirst($act->firstname) . ' ' . ucfirst($act->lastname) : $act->name; ?>"></a>
    <a href="<?= base_url('dashboard/profile/' . $act->main_user_id) ?>" class="media-title trans">
        <strong><?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?></strong> sent you a connection request. <span class="media-time"><i class="ion-android-time"></i> <?= date('h:i:s a', $act->time) . ' ' . date('d M Y', $act->time); ?></span>
    </a>
</li>
<?php endforeach; endif; if (count($accepted_conn) > 0) :  foreach ($accepted_conn as $act) : ?>
<li class="clearfix acc_conn" data-id="<?= $act->conn_time ?>">
    <a href="<?= base_url('dashboard/profile/' . $act->main_user_id) ?>" class="media-thumb"><img src="<?= base_url(($act->propic != '') ? 'assets/userdata/dashboard/propic/' . $act->propic : 'assets/img/'.$this->hook->get_placeholder($act->main_user_id)); ?>" alt="<?= ($act->user_type == 1) ? ucfirst($act->firstname) . ' ' . ucfirst($act->lastname) : $act->name; ?>"></a>
    <a href="<?= base_url('dashboard/profile/' . $act->main_user_id) ?>" class="media-title trans">
        <strong><?= ($act->user_type == 1) ? ucfirst(strtolower($act->firstname)) . ' ' . ucfirst(strtolower($act->lastname)) : ucfirst(strtolower($act->name)); ?></strong> accepted your connection request. <span class="media-time"><i class="ion-android-time"></i> <?= date('h:i:s a', $act->time) . ' ' . date('d M Y', $act->time); ?></span>
    </a>
</li>
<?php endforeach; endif; endif; endif; ?>

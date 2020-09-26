<div class="container search">				
    <div class="row">
        <?php if(!$this->agent->is_mobile()) : ?>
        <div class="col-sm-3 row-left">
            <?php $this->load->view('dashboard/sidebar/thoughts'); ?>
            
            <?php $this->load->view('dashboard/sidebar/posts') ?>
            
            <?php $this->load->view('dashboard/sidebar/recent-activity') ?>
        </div>
        <?php endif; ?>

        <div class="col-sm-6 row-center">
            <div class="search-list" id="search_list">
                <a class="sent_req_btn trans" href="<?= base_url('dashboard/sent_requests') ?>">View sent request</a>
                <div class="panel-body">
                    <?php if(count($users) > 0 || count($accepted_conn) > 0) : if(count($users) > 0): foreach($users as $user): ?>
                    <div class="block shadow clearfix" data-id='<?= $user->conn_time ?>'>
                        <div class="thumb">
                            <a href="<?= base_url('dashboard/profile/'.$user->main_user_id) ?>">
                                <img class="shadow" src="<?= base_url(($user->propic != '') ? "assets/userdata/dashboard/propic/".$user->propic : "assets/img/".$this->hook->get_placeholder($user->main_user_id)); ?>" alt="<?= ($user->user_type == 1) ? ucfirst($user->firstname).' '.ucfirst($user->lastname) : ucfirst($user->name); ?>" />
                                <?php if($user->level == 1) { echo "<img title='Premium' class='premium_badge' src='".base_url('assets/img/badge.png')."' alt='badge' />"; } ?>
                            </a>
                        </div>
                        <div class="content">
                            <h5><a href="<?= base_url('dashboard/profile/'.$user->main_user_id) ?>"><?= ($user->user_type == 1) ? ucfirst(strtolower($user->firstname)).' '.ucfirst(strtolower($user->lastname)) : ucfirst(strtolower($user->name)); ?></a></h5>
                            <p class="text-muted"><?php if(($user->user_city != '' && $user->user_state != '') || ($user->city != '' && $user->state != '')) { echo ($user->user_type == 1)? ucfirst(strtolower($user->user_city)).' '.ucfirst(strtolower($user->user_state)).', ' : ucfirst(strtolower($user->city)).' '.ucfirst(strtolower($user->state)).' ,'; } ?><?= ($user->user_type == 1)? $user->user_country : $user->org_country ?></p>
                        </div>
                        <div class="dropdown clearfix"> 
                            <button data-ripple class="toggle_action btn btn-default dropdown-toggle pull-right shadow" type="button" aria-haspopup="true" aria-expanded="true"> Action <i class="ion-arrow-down-b"></i></button> 
                            <ul data-list-id="<?= $user->main_user_id ?>" class="dropdown-menu frnd-menu dropdown-menu-right">
                                <?php $this->hook->check_connection($user->main_user_id); ?>
				<li><a href="<?= base_url('dashboard/profile/'.$user->main_user_id) ?>">View Profile</a></li>
                            </ul> 
			</div>
                    </div>
                    <?php endforeach; endif; if(count($accepted_conn) > 0) : foreach($accepted_conn as $user): ?>
                    <div class="block shadow clearfix" data-id='<?= $user->conn_time ?>'>
                        <div class="thumb">
                            <a href="<?= base_url('dashboard/profile/'.$user->main_user_id) ?>">
                                <img class="shadow" src="<?= base_url(($user->propic != '') ? "assets/userdata/dashboard/propic/".$user->propic : "assets/img/".$this->hook->get_placeholder($user->main_user_id)); ?>" alt="<?= ($user->user_type == 1) ? ucfirst($user->firstname).' '.ucfirst($user->lastname) : ucfirst($user->name); ?>" />
                                <?php if($user->level == 1) { echo "<img title='Premium' class='premium_badge' src='".base_url('assets/img/badge.png')."' alt='badge' />"; } ?>
                            </a>
                        </div>
                        <div class="content">
                            <h5><a href="<?= base_url('dashboard/profile/'.$user->main_user_id) ?>"><?= ($user->user_type == 1) ? ucfirst(strtolower($user->firstname)).' '.ucfirst(strtolower($user->lastname)) : ucfirst(strtolower($user->name)); ?></a></h5>
                            <p class="text-muted"><?php if(($user->user_city != '' && $user->user_state != '') || ($user->city != '' && $user->state != '')) { echo ($user->user_type == 1)? ucfirst(strtolower($user->user_city)).' '.ucfirst(strtolower($user->user_state)).', ' : ucfirst(strtolower($user->city)).' '.ucfirst(strtolower($user->state)).' ,'; } ?><?= ($user->user_type == 1)? $user->user_country : $user->org_country ?></p>                      
                        </div>
                        <div class="dropdown clearfix"> 
                            <button data-ripple class="toggle_action btn btn-default dropdown-toggle pull-right shadow" type="button" aria-haspopup="true" aria-expanded="true"> Action <i class="ion-arrow-down-b"></i></button> 
                            <ul data-list-id="<?= $user->main_user_id ?>" class="dropdown-menu frnd-menu dropdown-menu-right">
                                <?php $this->hook->check_connection($user->main_user_id); ?>
				<li><a href="<?= base_url('dashboard/profile/'.$user->main_user_id) ?>">View Profile</a></li>
                            </ul> 
			</div>
                    </div>
                    <?php endforeach; endif; else : ?>
                    <h4 class="zero_request shadow">No notifications to show.</h4>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <?php if(!$this->agent->is_mobile()) : ?>
        <div class="col-sm-3 row-right">
            <?php $this->load->view('dashboard/sidebar/app'); ?>
            
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
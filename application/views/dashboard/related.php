<div class="container search">				
    <div class="row">
        <?php if(!$this->agent->is_mobile()) : ?>
        <div class="col-sm-3 row-left">
            <?php $this->load->view('dashboard/sidebar/thoughts'); ?>
            
            <?php $this->load->view('dashboard/sidebar/posts') ?>
            
            <?php $this->load->view('dashboard/sidebar/recent-activity') ?>
        </div>
        <?php endif; ?>

        <div class="col-sm-6 row-center related">
            <div class="search-list" id="search_list">
                <div class="panel-body">
                    <?php if(count($users) > 0) : echo "<h4>Connect with our Initiators</h4>"; foreach($users as $user): ?>
                    <div class="col-sm-6">
                        <div class="block shadow clearfix" data-id='<?= $user->user_time ?>'>
                            <div class="thumb">
                                <a href="<?= base_url('dashboard/profile/'.$user->main_id) ?>">
                                    <img src="<?= base_url(($user->propic != '') ? "assets/userdata/dashboard/propic/".$user->propic : "assets/img/".$this->hook->get_placeholder($user->main_id)); ?>" alt="<?= ($user->type_id == 1) ? ucfirst($user->firstname).' '.ucfirst($user->lastname) : ucfirst($user->name); ?>" />
                                    <?php if($user->user_level == 1) { echo "<img title='Premium' class='premium_badge' src='".base_url('assets/img/badge.png')."' alt='badge' />"; } ?>
                                </a>
                            </div>
                            <div class="content">
                                <h5><a href="<?= base_url('dashboard/profile/'.$user->main_id) ?>"><?= ($user->type_id == 1) ? ucfirst(strtolower($user->firstname)).' '.ucfirst(strtolower($user->lastname)) : ucfirst(strtolower($user->name)); ?></a></h5>
                                <p class="text-muted"><?php if(($user->user_city != '' && $user->user_state != '') || ($user->city != '' && $user->state != '')) { echo ($user->type_id == 1)? ucfirst(strtolower($user->user_city)).' '.ucfirst(strtolower($user->user_state)).', ' : ucfirst(strtolower($user->city)).' '.ucfirst(strtolower($user->state)).' ,'; } ?><?= ($user->type_id == 1)? $user->user_country : $user->org_country ?></p>
                            </div>
                            <ul class="icons-list">
                                <li class="dropdown">
                                    <a class="dropdown-toggle toggle_action" aria-expanded="false"><i class="ion-navicon-round"></i></a>
                                    <ul data-list-id="<?= $user->main_id ?>" class="dropdown-menu frnd-menu dropdown-menu-right">
                                        <?php $this->hook->check_connection($user->main_id); ?>
                                        <li><a href="<?= base_url('dashboard/profile/'.$user->main_id) ?>">View Profile</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <?php endforeach; endif; ?>
                    
                    <?php  if(count($groups) > 0) : echo "<h4>Groups to explore</h4>"; foreach($groups as $group): ?>
                    <div class="col-sm-6">
                        <div class="block shadow clearfix group" data-id='<?= $group->group_time ?>'>
                            <div class="thumb">
                                <a href="<?= base_url('dashboard/group/'.$group->main_id) ?>"><img src="<?= base_url(($group->banner != '') ? "assets/userdata/dashboard/group/banner/".$group->banner : "assets/img/placeholder.png"); ?>" alt="<?= $group->title; ?>" /></a>
                            </div>
                            <div class="content">
                                <h5><a href="<?= base_url('dashboard/group/'.$group->main_id) ?>"><?= ucfirst($group->title);  ?></a></h5>
                            </div>
                            <ul class="icons-list">
                                <li class="dropdown">
                                    <a class="dropdown-toggle toggle_action" aria-expanded="false"><i class="ion-navicon-round"></i></a>
                                    <ul data-list-id="<?= $group->main_id ?>" class="dropdown-menu grp-menu dropdown-menu-right">
                                        <?php $this->hook->check_group($group->main_id); ?>
                                        <li><a href="<?= base_url('dashboard/group/'.$group->main_id) ?>">View Group</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <?php endforeach; endif; ?>
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
        
        <div id="block_conn" class="modal fade timeline_modal_form">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <form id="block_conn_form">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Block Connection</h4>
                        </div>
                        <div class="modal-body">						
                            <p>Are you sure you want to block this connection ?</p>
                            <input type="hidden" value="" id="block_conn_id" />
                            <input type="hidden" value="" id="block_conn_type" />
                        </div>
                        <div class="modal-footer">
                            <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                            <button data-ripple class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button data-ripple type="submit" class="btn btn-primary">Yes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
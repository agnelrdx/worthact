<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container search">				
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-flat search-panel">
                <div class="panel-body">
                    <h4>Search</h4>
                    <div class="box">
                        <form id="search_form" method="get" action="<?= base_url('dashboard/search') ?>">
                            <div class="input-group shadow">
                                <span class="input-group-btn first">	
                                    <button class="btn trans"><i class="ion-android-search"></i></button>
                                </span>
                                <input id="search_input" value="<?= $this->input->get('key') ?>" type="text" name="key" class="form-control" placeholder="Enter the keywords">
                                <span class="input-group-btn last">
                                    <button class="btn trans" data-ripple type="submit">Search</button>
                                </span>
                            </div>
                        </form>
                        <div class="result"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php if($this->input->get('key') != ''): ?>
        <div class="col-sm-3 row-left">
            <div class="panel panel-flat search-result">
                <div class="panel-body">
                    <h4>Search Result</h4>
                    <ul>
                        <li><a href="<?= base_url('dashboard/search?key='.$this->input->get('key')); ?>" class="trans">Users (<?= count($ucount); ?>)</a></li>
                        <li><a href="<?= base_url('dashboard/search?view=group&key='.$this->input->get('key')); ?>" class="trans">Groups (<?= count($gcount); ?>)</a></li>
                        <li><a href="<?= base_url('dashboard/search?view=blog&key='.$this->input->get('key')); ?>" class="trans">Blogs (<?= count($bcount); ?>)</a></li>
                        <li><a href="<?= base_url('dashboard/search?view=post&key='.$this->input->get('key')); ?>" class="trans">Initiatives (<?= count($pcount); ?>)</a></li>
                    </ul>
                </div>
            </div>
            
            <?php if(!$this->agent->is_mobile()) { $this->load->view('dashboard/sidebar/recent-activity'); } ?>
        </div>
        
        <div class="col-sm-6 row-center">
            <div class="search-list" id="search_list">
                <div class="panel-body search-body">
                    <?php if($this->input->get('view') == 'post') : echo "<h4>Matching Results for '<i>".$this->input->get('key')."</i> ' under Initiatives</h4>"; if(count($posts) > 0) : foreach($posts as $post): ?>
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
                                <p><?= substr($post->description, 0 , 200).'...Read More'; ?></p>
                                <?php if($post->tags != '') : ?>
                                <ul>
                                    <li><?php $tags = explode(',', $post->tags); foreach ($tags as $tag) : ?><span class="cat shadow"><?= $tag ?></span><?php endforeach; ?></li>
                                </ul>
                                <?php endif; ?>
                            </div>
                        </div>
                    </a>   
                    <?php endforeach; endif; endif; ?>
                    
                    <?php if($this->input->get('view') == 'blog') : echo "<h4>Matching Results for '<i>".$this->input->get('key')."</i> ' under blogs</h4>"; if(count($blogs) > 0) : foreach($blogs as $blog): ?>
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
                    <?php endforeach; endif; endif; ?>
                    
                    <?php if($this->input->get('view') == 'group') : echo "<h4>Matching Results for '<i>".$this->input->get('key')."</i> ' under groups</h4>"; if(count($groups) > 0) : foreach($groups as $group): ?>
                    <div class="col-sm-6">
                        <div class="block shadow clearfix group" data-id='<?= $group->group_time ?>'>
                            <div class="thumb">
                                <a href="<?= base_url('dashboard/group/'.$group->main_id) ?>">
                                    <img src="<?= base_url(($group->banner != '') ? "assets/userdata/dashboard/group/banner/".$group->banner : "assets/img/placeholder.png"); ?>" alt="<?= $group->title; ?>" />
                                </a>
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
                    <?php endforeach; endif; endif; ?>
                    
                    <?php if($this->input->get('view') == '') : echo "<h4>Matching Results for '<i>".$this->input->get('key')."</i> ' under all users</h4>"; if(count($users) > 0) : foreach($users as $user): ?>
                    <div class="col-sm-6">
                        <div class="block users shadow clearfix" data-id='<?= $user->user_time ?>'>
                            <div class="thumb">
                                <a href="<?= base_url('dashboard/profile/'.$user->main_id) ?>">
                                    <img src="<?= base_url(($user->propic != '') ? "assets/userdata/dashboard/propic/".$user->propic : "assets/img/".$this->hook->get_placeholder($user->main_id)); ?>" alt="<?= ($user->type_id == 1) ? ucfirst(strtolower($user->firstname)).' '.ucfirst(strtolower($user->lastname)) : ucfirst(strtolower($user->name)); ?>" />
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
                    <?php endforeach; endif; endif; ?>
                </div>
                <?php if($this->input->get('view') == '') : if(count($users) > 0) : echo '<a onclick="load_more_usersearch(\''.$this->input->get('key').'\')" style="display: block" class="clearfix" id="load_more">Load More <img src="'.base_url('assets/img/reload.svg').'" id="loader" alt="loader" /></a>'; endif; endif;  ?> 
                <?php if($this->input->get('view') == 'group') : if(count($groups) > 0) : echo '<a onclick="load_more_groupsearch(\''.$this->input->get('key').'\')" style="display: block" id="load_more" class="clearfix">Load More <img src="'.base_url('assets/img/reload.svg').'" id="loader" alt="loader" /></a>'; endif; endif; ?>
                <?php if($this->input->get('view') == 'blog') : if(count($blogs) > 0) : echo '<a onclick="load_more_blogsearch(\''.$this->input->get('key').'\')" style="display: block" id="load_more">Load More <img src="'.base_url('assets/img/reload.svg').'" id="loader" alt="loader" /></a>'; endif; endif; ?>
                <?php if($this->input->get('view') == 'post') : if(count($posts) > 0) : echo '<a onclick="load_more_postsearch(\''.$this->input->get('key').'\')" style="display: block" id="load_more">Load More <img src="'.base_url('assets/img/reload.svg').'" id="loader" alt="loader" /></a>'; endif; endif; ?>
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
        <?php endif; ?>
    </div>
</div>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container job-listing">
    <div class="row">
        <?php if(!$this->agent->is_mobile()) : ?>
        <div class="col-sm-3 row-left">
            <div class="panel panel-flat j_action">
                <div class="panel-body">
                    <?php if($this->session->userdata('user_type') == '1') : ?>
                    <a class="left" data-ripple href="<?= base_url('dashboard/joblisting/all'); ?>">All Jobs</a>
                    <a class="right" data-ripple href="<?= base_url('dashboard/joblisting/applied'); ?>">Applied Jobs</a>
                    <?php else : ?>
                    <a class="left" data-ripple href="<?= base_url('dashboard/joblisting/all_candidates'); ?>">Candidates</a>
                    <a class="right" data-ripple href="<?= base_url('dashboard/joblisting/manage_jobs'); ?>">Manage Jobs</a>
                    <?php endif; ?>
                </div>
            </div>

            <?php $this->load->view('dashboard/sidebar/thoughts'); ?>
            
            <?php $this->load->view('dashboard/sidebar/app'); ?>
            
            <?php $this->load->view('dashboard/sidebar/connection'); ?>
            
            <?php $this->load->view('dashboard/sidebar/groups') ?>
            
            <?php $this->load->view('dashboard/sidebar/recent-activity'); ?>

            <?php $this->load->view('dashboard/sidebar/invite-fb'); ?>
        </div>
        <?php else : ?>
        <div class="col-sm-3 row-left">
            <?php if($this->session->userdata('user_type') == '1') { $this->load->view('dashboard/sidebar/job-search'); } ?>
            
            <?php if($this->session->userdata('user_type') != '1') { $this->load->view('dashboard/sidebar/joblist-search'); } ?>
        </div>
        <?php endif; ?>
        
        <div class="col-sm-9 row-center">
            <div class="cv shadow">
                <?php echo $this->session->flashdata('msg'); ?>
                <div class="head clearfix">
                    <?php if($user_id == $this->session->userdata('user_id')) : ?><a data-toggle="modal" data-target="#cv_head_update" class="trans update_cv">Edit</a><?php endif; ?>
                    <div class="propic">
                        <img class="shadow" src="<?= ($user_cv != 'null' && $user_cv->propic != '')? base_url('assets/userdata/dashboard/jobs/propic/'.$user_cv->propic) : base_url('assets/img/'.$this->hook->get_placeholder($user_id)); ?>" alt="" />
                        <?php if($user_id == $this->session->userdata('user_id') && $user_cv != 'null') : ?><a data-ripple title="Change Picture" data-toggle="modal" data-target="#update_propic" class="shadow trans cv_propic"><i class="ion-plus-round"></i></a><?php endif; ?>
                    </div>
                    <div class="info">
                        <h2><?= ($user_id == $this->session->userdata('user_id'))? ucfirst(strtolower($this->info->firstname)) . ' ' . ucfirst(strtolower($this->info->lastname)) : ucfirst(strtolower($user_cv->firstname)) . ' ' . ucfirst(strtolower($user_cv->lastname)); ?></h2>
                        <h4><?= ($user_cv != 'null' && $user_cv->current_post != '')? $user_cv->current_post : '<span class="text-muted">DESIGNATION</span>'; ?></h4>
                        <h5>at <?= ($user_cv != 'null' && $user_cv->current_company != '')? ucfirst(strtolower($user_cv->current_company)) : '<span class="text-muted">Company</span>'; ?></h5>
                        <p><span>Location:</span> <?= ($user_cv != 'null' && $user_cv->current_location != '')? $this->hook->cv_location($user_cv->current_location) : '<span class="text-muted">- -</span>'; ?></p>
                        <p><span>Category:</span> <?= ($user_cv != 'null' && $user_cv->category != '')? $user_cv->job_cat_name : '<span class="text-muted">- -</span>'; ?></p>
                        <p><span>Experience:</span> <?php if($user_cv != 'null' && $user_cv->experience != '') { $exp = explode(',', $user_cv->experience); echo current($exp).((current($exp) > 1)? ' Years ' : ' Year ').end($exp).((end($exp) > 1)? ' Months' : ' Month'); } else { echo '<span class="text-muted">- -</span>'; } ?></p>
                        <?php if($user_cv != 'null' && $user_cv->skills != ''): $tags = explode(',', $user_cv->skills); ?><p class="skills"><?php foreach ($tags as $tag) { echo "<span>$tag</span>"; } ?></p><?php endif; ?>
                    </div>
                </div>
                <div class="info">
                    <?php if($user_id == $this->session->userdata('user_id')) : ?><a data-toggle="modal" data-target="#cv_job_update" class="trans update_cv">Edit</a><?php endif; ?>
                    <h2><i class="ion-star"></i> Target Job</h2>
                    <div class="row">
                        <div class="col-sm-4">
                            <h4>Target Job Title:</h4>
                        </div>
                        <div class="col-sm-8">
                            <p><?= ($user_cv != 'null' && $user_cv->job_title != '')? ucfirst(strtolower($user_cv->job_title)) : '<span class="text-muted">- -</span>'; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <h4>Career Level:</h4>
                        </div>
                        <div class="col-sm-8">
                            <p><?= ($user_cv != 'null' && $user_cv->level != '')? $user_cv->level_name : '<span class="text-muted">- -</span>'; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <h4>Target Job Location:</h4>
                        </div>
                        <div class="col-sm-8">
                            <p><?= ($user_cv != 'null' && $user_cv->target_country != '')? $this->hook->cv_location($user_cv->target_country) : '<span class="text-muted">- -</span>'; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <h4>Career Objective:</h4>
                        </div>
                        <div class="col-sm-8">
                            <p><?= ($user_cv != 'null' && $user_cv->objective != '')? $user_cv->objective : '<span class="text-muted">- -</span>'; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <h4>Employment Type:</h4>
                        </div>
                        <div class="col-sm-8">
                            <p><?= ($user_cv != 'null' && $user_cv->type != '')? $user_cv->jobtype_name : '<span class="text-muted">- -</span>'; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <h4>Target Monthly Salary:</h4>
                        </div>
                        <div class="col-sm-8">
                            <p><?= ($user_cv != 'null' && $user_cv->monthly_salary != '')? $user_cv->monthly_salary : '<span class="text-muted">- -</span>'; ?></p>
                        </div>
                    </div>
                    <div class="row last">
                        <div class="col-sm-4">
                            <h4>Last Monthly Salary:</h4>
                        </div>
                        <div class="col-sm-8">
                            <p><?= ($user_cv != 'null' && $user_cv->last_salary != '')? $user_cv->last_salary : '<span class="text-muted">- -</span>'; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <h4>Notice Period:</h4>
                        </div>
                        <div class="col-sm-8">
                            <p><?= ($user_cv != 'null' && $user_cv->notice != '')? $user_cv->notice : '<span class="text-muted">- -</span>'; ?></p>
                        </div>
                    </div>
                </div>
                <div class="info">
                    <?php if($user_id == $this->session->userdata('user_id')) : ?><a data-toggle="modal" data-target="#cv_personal_update" class="trans update_cv">Edit</a><?php endif; ?>
                    <h2><i class="ion-person"></i> Personal Information</h2>
                    <div class="row">
                        <div class="col-sm-4">
                            <h4>Age:</h4>
                        </div>
                        <div class="col-sm-8">
                            <p><?= ($user_cv != 'null' && $user_cv->age != '')? $user_cv->age : '<span class="text-muted">- -</span>'; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <h4>Nationality:</h4>
                        </div>
                        <div class="col-sm-8">
                            <p><?= ($user_cv != 'null' && $user_cv->nationality != '')? ucfirst($user_cv->nationality) : '<span class="text-muted">- -</span>'; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <h4>Residence Country:</h4>
                        </div>
                        <div class="col-sm-8">
                            <p><?= ($user_cv != 'null' && $user_cv->residence_country != '')? $this->hook->cv_location($user_cv->residence_country) : '<span class="text-muted">- -</span>'; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <h4>Visa Status:</h4>
                        </div>
                        <div class="col-sm-8">
                            <p><?= ($user_cv != 'null' && $user_cv->visa != '')? $user_cv->visa : '<span class="text-muted">- -</span>'; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <h4>Marital Status:</h4>
                        </div>
                        <div class="col-sm-8">
                            <p><?= ($user_cv != 'null' && $user_cv->marital != '')? $user_cv->marital : '<span class="text-muted">- -</span>'; ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <h4>Number of Dependents:</h4>
                        </div>
                        <div class="col-sm-8">
                            <p><?= ($user_cv != 'null' && $user_cv->dependents != '')? $user_cv->dependents : '<span class="text-muted">- -</span>'; ?></p>
                        </div>
                    </div>
                    <div class="row last">
                        <div class="col-sm-4">
                            <h4>Driving License Issued From:</h4>
                        </div>
                        <div class="col-sm-8">
                            <p><?= ($user_cv != 'null' && $user_cv->licence_country != '')? $this->hook->cv_location($user_cv->licence_country) : '<span class="text-muted">- -</span>'; ?></p>
                        </div>
                    </div>
                </div>
                <?php if(($user_id == $this->session->userdata('user_id')) || ($this->info->type_id != 1 && $this->info->user_level == 1)) : ?>
                <div class="info list">
                    <?php if($user_id == $this->session->userdata('user_id')) : ?><a data-toggle="modal" data-target="#cv_experience_update" class="trans update_cv">Add</a><?php endif; ?>
                    <h2><i class="ion-briefcase"></i> Experience</h2>
                    <?php if(count($user_cv_exp) > 0) : $count = count($user_cv_exp); $i = 1; foreach ($user_cv_exp as $exp) : $start = explode(',', $exp->start); $end = explode(',', $exp->end); ?>
                    <div data-id="<?= $exp->main_id ?>" class="exp row <?= ($count == $i)? 'last' : ''; ?>">
                        <div class="col-sm-4">
                            <h4 class="date"><?= current($start).' '.end($start) ?> - <?= current($end).' '.end($end) ?></h4>
                        </div>
                        <div class="col-sm-8">
                            <h3><?= ucfirst($exp->title) ?></h3>
                            <h4 class="at">at <?= ucfirst($exp->company) ?></h4>
                            <p><span>Location:</span> <?= $this->hook->cv_location($exp->location) ?></p>
                            <p><span>Category:</span> <?= $exp->job_cat_name ?></p>
                            <p><span>Level:</span> <?= $exp->level_name ?></p>
                            <p><span>Responsibilities:</span> asdasda</p>
                        </div>
                        <?php if($user_id == $this->session->userdata('user_id')) { ?><a class="delete delete_exp trans" title="Delete Experience" data-id="<?= $exp->main_id ?>" data-toggle="modal" data-target="#delete_cv_exp"><i class="ion-close"></i></a><?php } ?>
                    </div>
                    <?php $i++; endforeach; endif; ?>
                </div>
                <div class="info list">
                    <?php if($user_id == $this->session->userdata('user_id')) : ?><a data-toggle="modal" data-target="#cv_education_update" class="trans update_cv">Add</a><?php endif; ?>
                    <h2><i class="ion-university"></i> Education</h2>
                    <?php if(count($user_cv_edu) > 0) : $count = count($user_cv_edu); $i = 1; foreach ($user_cv_edu as $edu) : $yr = explode(',', $edu->completion); ?>
                    <div data-id="<?= $edu->id ?>" class="edu row <?= ($count == $i)? 'last' : ''; ?>">
                        <div class="col-sm-12">
                            <h3><?= ucfirst($edu->title) ?></h3>
                            <h4 class="at">at <?= ucfirst($edu->collage) ?></h4>
                            <p><span>Location:</span> <?= $this->hook->cv_location($edu->location) ?></p>
                            <p><span>Completion:</span> <?= current($yr).' '.end($yr); ?></p>
                            <p><span>Grade:</span> <?= $edu->grade ?></p>
                        </div>
                        <?php if($user_id == $this->session->userdata('user_id')) { ?><a class="delete delete_edu trans" title="Delete Education" data-id="<?= $edu->id ?>" data-toggle="modal" data-target="#delete_cv_edu"><i class="ion-close"></i></a><?php } ?>
                    </div>
                    <?php $i++; endforeach; endif; ?>
                </div>
                <?php if($user_cv != 'null' && $user_cv->cv != ''): ?>
                <div class="info download shadow">
                    <a href="<?= base_url('dashboard/download_cv/'.$user_cv->cv.'/cv'); ?>">
                        <img src="<?= base_url("assets/img/file.png"); ?>" alt="cv download" />
                        <h5>Download Uploaded CV <?php if($user_cv->user_level == 0 && $user_cv->main_user_id != $this->session->userdata('user_id')) { echo ($user_cv->count == 6)? ' <i title="CV is locked. Download limit exceeded on this CV." class="ion-locked text-muted"></i>' : ''; } ?></h5>
                    </a>
                </div>
                <?php endif; else : ?>
                <div class="alert alert-info" role="alert">Upgrade to premium account to view the candidate's experience, education and also to download the CV.</div>
                <?php endif; ?>
            </div>
        </div>
        
        <?php if($this->agent->is_mobile()) : ?>
        <div class="col-sm-3 row-right">
            <?php $this->load->view('dashboard/sidebar/connection'); ?>
            
            <?php $this->load->view('dashboard/sidebar/groups') ?>
            
            <?php $this->load->view('dashboard/sidebar/invite-fb'); ?>
        </div>
        <?php endif; ?>
    </div>
    <?php if($user_id == $this->session->userdata('user_id')) { $this->load->view('dashboard/modals/cv_edit'); } ?>
</div>
<?php defined('BASEPATH') OR exit('No direct script access allowed'); if($type == 'job') : if(count($jobs) > 0) : $adv_count = 1; foreach ($jobs as $job): if($this->session->userdata('adv_count') == '') { if($adv_count == 4) { $this->hook->adv_timeline_module('joblisting', 'block_3'); }  if($adv_count == 7) { $this->hook->adv_timeline_module('joblisting', 'block_7'); } } if($this->session->userdata('adv_count') == 1) { if($adv_count == 4) { $this->hook->adv_timeline_module('joblisting', 'block_4'); }  if($adv_count == 7) { $this->hook->adv_timeline_module('joblisting', 'block_8'); } } ?>

<div class="job shadow" data-id="<?= $job->job_time; ?>" data-job="<?= $job->main_job_id; ?>">
    <div class="user-pic">
        <a href="<?= base_url('dashboard/profile/'.$job->main_user_id) ?>"><img src="<?= base_url(($job->propic != '') ? "assets/userdata/dashboard/propic/" . $job->propic : "assets/img/".$this->hook->get_placeholder($job->main_user_id)) ?>" alt="<?= ($job->user_type == 1) ? ucfirst($job->firstname) . ' ' . ucfirst($job->lastname) : $job->name; ?>" /></a>
        <a href="<?= base_url('dashboard/profile/'.$job->main_user_id) ?>"><h5 class="trans"><?= ($job->user_type == 1) ? ucfirst(strtolower($job->firstname)) . ' ' . ucfirst(strtolower($job->lastname)) : ucfirst(strtolower($job->name)); ?></h5></a>
        <div class="right">
            <span><i class="ion-ios-clock"></i><?= date('h:i A', $job->job_time); ?>&nbsp;&nbsp;<?= $job->job_date; ?></span>
            <?php $this->hook->user_job_post_check($job->main_job_id); ?>
        </div>
    </div>
    <div class="content">
        <h3><?= ucfirst($job->job_title); ?></h3>
        <div class="meta">
            <span><i class="fa fa-th-large" aria-hidden="true"></i> <?= $job->job_cat_name ?></span>
            <span><i class="fa fa-address-card" aria-hidden="true"></i><?= $job->level_name ?></span>
            <span><i class="fa fa-briefcase" aria-hidden="true"></i><?= $job->jobtype_name ?></span>
            <span><i class="fa fa-map-marker" aria-hidden="true"></i><?= $job->country_name ?></span>
            <span><i class="ion-calendar" aria-hidden="true"></i>Job Expiry Date: <?= $job->expiry_date ?></span>
        </div>
        <?php if($job->job_img != '') : ?>
        <div class="job_media">
            <?php $img_arr = explode(',', $job->job_img); if(count($img_arr) > 1) : ?>
            <div id="timeline_post_carousel_<?= $job->main_job_id; ?>" class="carousel slide carousel-fade shadow" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <?php $count = 0; foreach ($img_arr as $arr) : ?>
                    <div class='item <?= ($count === 0)? 'active' : ''; ?>'>
                        <a title="<?= $job->job_title ?>" class="fancybox" rel="group_<?= $job->main_job_id; ?>" href="<?= base_url("assets/userdata/dashboard/jobs/img/".$arr); ?>">
                            <img src='<?= base_url("assets/userdata/dashboard/jobs/img/".$arr); ?>' alt='<?= $job->job_title; ?>'>
                        </a>    
                    </div>
                    <?php $count++; endforeach; ?>
                </div>
                <a class="left carousel-control" href="#timeline_post_carousel_<?= $job->main_job_id; ?>" role="button" data-slide="prev"><i class="ion-chevron-left"></i></a>
                <a class="right carousel-control" href="#timeline_post_carousel_<?= $job->main_job_id; ?>" role="button" data-slide="next"><i class="ion-chevron-right"></i></a>
            </div>
            <?php else : ?>
            <a title="<?= $job->job_title; ?>" class="fancybox" href="<?= base_url("assets/userdata/dashboard/jobs/img/".$img_arr[0]); ?>">
                <img class="shadow" src="<?= base_url("assets/userdata/dashboard/jobs/img/".$img_arr[0]); ?>" alt="<?= $job->job_title; ?>" />
            </a>    
            <?php endif;?>
        </div>
        <?php endif; ?>
        <p class="job-description"><?= $job->job_desc; ?></p>
        <?php if(($this->session->userdata('user_type') == '1') || ($job->main_user_id == $this->session->userdata('user_id'))) : ?>
        <ul class="quick-actions">
            <?php if($this->info->type_id == 1) { $this->hook->check_apply_now($job->main_job_id); } ?>
            <?php if($job->job_contact != '') : ?>
            <li><i class="fa fa-phone"></i><a class="contactbtn" href="tel:<?= $job->job_contact; ?>"><?= $job->job_contact; ?></a></li>
            <?php else : if($job->tel != '') : ?>
            <li><i class="fa fa-phone"></i><a class="contactbtn" href="tel:<?= $job->tel; ?>"><?= $job->tel; ?></a></li>
            <?php endif; endif; if($job->job_email != '') : ?>
            <li><i class="fa fa-envelope" aria-hidden="false"></i><a id="mailnbtn" href="mailto:<?= $job->job_email; ?>"><?= $job->job_email; ?></a></li>
            <?php else : ?>
            <li><i class="fa fa-envelope"></i><a class="contactbtn" href="mailto:<?= $job->email; ?>"><?= $job->email; ?></a></li>
            <?php endif; if($job->job_website != '') : ?>
            <li><i class="ion-ios-world"></i><a href="<?php echo $job->job_website; ?>" id="websitebtn" target="_blank" ><?php echo $job->job_website; ?></a></li>
            <?php else : if($job->user_type != 1 && $job->website != '') : ?>
            <li><i class="ion-ios-world"></i><a href="<?php echo $job->website; ?>" id="websitebtn" target="_blank" ><?php echo $job->website; ?></a></li>
            <?php endif; endif; if($job->main_user_id == $this->session->userdata('user_id')) : ?>
            <li><i class="ion-checkmark-circled"></i><a href="<?= base_url('dashboard/joblisting/applied_candidates/'.$job->main_job_id); ?>" class="contactbtn">Applied Candidates</a></li>
            <li><i class="ion-bookmark"></i><a href="<?= base_url('dashboard/joblisting/shortlisted_candidates/'.$job->main_job_id); ?>" class="contactbtn">Shortlisted Candidates</a></li>
            <?php endif; ?>
        </ul>
        <?php endif; if($job->job_skills != '') : ?>
        <div class="tags">
            <?php $skills = explode(',', $job->job_skills); foreach ($skills as $skill) { ?>
            <span class="skill-span shadow"><?= $skill ?></span><?php } ?>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $adv_count++; endforeach; if($this->session->userdata('adv_count') == 1) { $this->session->set_userdata('adv_count', 2); } endif; if(isset($extra)) { $cat = (isset($job_cat))? $job_cat : ''; $cntry = (isset($country))? $country : ''; $this->hook->load_indeed_jobs($cat, $cntry); } endif; if($type == 'candidate') : if(count($candidates) > 0) : $adv_count = 1; foreach ($candidates as $candidate): if($this->session->userdata('adv_count') == '') { if($adv_count == 4) { $this->hook->adv_timeline_module('joblisting', 'block_3'); }  if($adv_count == 7) { $this->hook->adv_timeline_module('joblisting', 'block_7'); } } if($this->session->userdata('adv_count') == 1) { if($adv_count == 4) { $this->hook->adv_timeline_module('joblisting', 'block_4'); }  if($adv_count == 7) { $this->hook->adv_timeline_module('joblisting', 'block_8'); } } ?>
<div class="job shadow" data-id="<?= $candidate->main_time; ?>" data-job="<?= $candidate->main_id; ?>" data-user-id="<?= $candidate->main_user_id ?>">
    <div class="user-pic">
        <a href="<?= base_url('dashboard/profile/'.$candidate->main_user_id) ?>"><img src="<?= ($candidate->propic != '') ? base_url("assets/userdata/dashboard/jobs/propic/" . $candidate->propic) : $this->hook->get_candidate_propic($candidate->main_user_id) ?>" alt="<?= ucfirst($candidate->firstname) . ' ' . ucfirst($candidate->lastname) ?>" /></a>
        <a href="<?= base_url('dashboard/profile/'.$candidate->main_user_id) ?>"><h5 class="trans"><?= ucfirst(strtolower($candidate->firstname)) . ' ' . ucfirst(strtolower($candidate->lastname)) ?></h5></a>
        <div class="right">
            <span><i class="ion-ios-clock"></i><?= date('h:i A', $candidate->main_time); ?>&nbsp;&nbsp;<?= $candidate->main_date; ?></span>
        </div>
    </div>
    <div class="content">
        <h3><?= ucfirst($candidate->job_title); ?></h3>
        <div class="meta">
            <span><i class="fa fa-th-large" aria-hidden="true"></i> <?= $candidate->job_cat_name ?></span>
            <span><i class="fa fa-address-card" aria-hidden="true"></i><?= $candidate->level_name ?></span>
            <span><i class="fa fa-briefcase" aria-hidden="true"></i><?= $candidate->jobtype_name ?></span>
            <span><i class="fa fa-map-marker" aria-hidden="true"></i><?= $candidate->country_name ?></span>
        </div>
        <p class="job-description"><?= $candidate->objective; ?></p>
        <ul class="quick-actions">
            <?php if($this->uri->segment(2) == 'load_applied_candidates' && $this->uri->segment(3) != '') { $this->hook->check_shortlist_candidate($this->uri->segment(3), $candidate->main_user_id); } ?>
            <?php if($candidate->cv != '' && $this->info->user_level == 1) : ?>
            <li><i class="fa fa-file-text-o"></i><a class="contactbtn" href="<?= base_url('dashboard/download_cv/'.$candidate->cv); ?>">Download CV <?php if($candidate->user_level == 0) { echo ($candidate->count == 6)? '<i data-toggle="tooltip" data-placement="bottom" title="CV is locked. Download limit exceeded on this CV." class="ion-locked"></i>' : ''; } ?></a></li>
            <?php endif; ?>
            <li><i class="fa fa-television"></i><a class="contactbtn" href="<?= base_url('dashboard/cv/'.$candidate->main_user_id); ?>">Digital CV</a></li>
        </ul>
        <?php if($candidate->skills != '') : ?>
        <div class="tags">
            <?php $skills = explode(',', $candidate->skills); foreach ($skills as $skill) { ?>
            <span class="skill-span shadow"><?= $skill ?></span><?php } ?>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $adv_count++; endforeach; if($this->session->userdata('adv_count') == 1) { $this->session->set_userdata('adv_count', 2); } endif; endif; 
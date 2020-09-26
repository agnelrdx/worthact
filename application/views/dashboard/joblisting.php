<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container job-listing">
    <div class="row">
        <?php if(!$this->agent->is_mobile()) : ?>
        <div class="col-sm-3 row-left">
            <?php if($this->session->userdata('user_type') == '1') { $this->load->view('dashboard/sidebar/job-search'); } ?>
            
            <?php if($this->session->userdata('user_type') != '1') { $this->load->view('dashboard/sidebar/candidate-search'); } ?>
            
            <div class="panel panel-flat j_action">
                <div class="panel-body">
                    <?php if(strpos($this->uri->uri_string(), 'jobs') && $this->session->userdata('user_type') == '1') : ?>
                    <a class="left" data-ripple href="<?= base_url('dashboard/joblisting/all'); ?>">All Jobs</a>
                    <a class="right" data-ripple href="<?= base_url('dashboard/joblisting/applied'); ?>">Applied Jobs</a>
                    <?php endif; if(strpos($this->uri->uri_string(), 'all') && $this->session->userdata('user_type') == '1') : ?>
                    <a class="left" data-ripple href="<?= base_url('dashboard/joblisting/applied'); ?>">Applied Jobs</a>
                    <a class="right" data-ripple href="<?= base_url('dashboard/cv/'.$this->session->userdata('user_id')) ?>">View CV</a>
                    <?php endif; if(strpos($this->uri->uri_string(), 'applied') && $this->session->userdata('user_type') == '1') : ?>
                    <a class="left" data-ripple href="<?= base_url('dashboard/joblisting/all'); ?>">All Jobs</a>
                    <a class="right" data-ripple href="<?= base_url('dashboard/cv/'.$this->session->userdata('user_id')) ?>">View CV</a>
                    <?php endif; if(strpos($this->uri->uri_string(), 'all_candidates') && $this->session->userdata('user_type') != '1') : ?>
                    <a class="center" data-ripple href="<?= base_url('dashboard/joblisting/manage_jobs'); ?>">Manage Jobs</a>
                    <?php endif; if(strpos($this->uri->uri_string(), 'manage_jobs') && $this->session->userdata('user_type') != '1') : ?>
                    <a class="left" data-ripple href="<?= base_url('dashboard/joblisting/all_candidates'); ?>">Candidates</a>
                    <a class="right" data-ripple data-toggle="modal" data-target="#post_job">Add Job</a>
                    <?php endif; ?>
                </div>
            </div>

            <?php $this->load->view('dashboard/ads/block_1', $this->adv) ?>
            
            <?php $this->load->view('dashboard/sidebar/offers'); ?>
            
            <?php $this->load->view('dashboard/sidebar/app'); ?>
                        
            <?php $this->load->view('dashboard/sidebar/connection'); ?>
            
            <?php $this->load->view('dashboard/sidebar/groups') ?>
            
            <?php $this->load->view('dashboard/sidebar/invite-fb'); ?>
            
            <?php $this->load->view('dashboard/ads/block_2', $this->adv) ?>
        </div>
        <?php else : ?>
        <div class="col-sm-3 row-left">
            <?php if($this->session->userdata('user_type') == '1') { $this->load->view('dashboard/sidebar/job-search'); } ?>
            
            <?php if($this->session->userdata('user_type') != '1') { $this->load->view('dashboard/sidebar/joblist-search'); } ?>
        </div>
        <?php endif; ?>
        
        <div class="col-sm-9 row-center">
            <img class="load_job_loader" src="<?= base_url('assets/img/reload.svg'); ?>" id="loader_main" alt="loader" />
            <div class="tabbable">
                <?php if($cv_cnt == '0') : ?>
                <div class="alert alert-info create_cv_alert" role="alert"><a href="<?= base_url('dashboard/cv/'.$this->session->userdata('user_id')) ?>" class="trans">Create a CV</a> to apply for all jobs.</div>
                <?php endif; ?>
                <div class="tab-content">
                    <div class="tab-pane active" id="joblist-tab">
                        <div id="listing_table"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php if($this->agent->is_mobile()) : ?>
        <div class="col-sm-3 row-right">
            <div class="panel panel-flat j_action">
                <div class="panel-body">
                    <?php if((strpos($this->uri->uri_string(), 'all') || strpos($this->uri->uri_string(), 'jobs')) && $this->session->userdata('user_type') == '1') : ?>
                    <a class="left" data-ripple href="<?= base_url('dashboard/joblisting/applied'); ?>">Applied Jobs</a>
                    <a class="right" data-ripple href="<?= base_url('dashboard/cv/'.$this->session->userdata('user_id')) ?>">View CV</a>
                    <?php endif; if(strpos($this->uri->uri_string(), 'applied') && $this->session->userdata('user_type') == '1') : ?>
                    <a class="left" data-ripple href="<?= base_url('dashboard/joblisting/all'); ?>">All Jobs</a>
                    <a class="right" data-ripple href="<?= base_url('dashboard/cv/'.$this->session->userdata('user_id')) ?>">View CV</a>
                    <?php endif; if(strpos($this->uri->uri_string(), 'all_candidates') && $this->session->userdata('user_type') != '1') : ?>
                    <a class="center" data-ripple href="<?= base_url('dashboard/joblisting/manage_jobs'); ?>">Manage Jobs</a>
                    <?php endif; if(strpos($this->uri->uri_string(), 'manage_jobs') && $this->session->userdata('user_type') != '1') : ?>
                    <a class="left" data-ripple href="<?= base_url('dashboard/joblisting/all_candidates'); ?>">Candidates</a>
                    <a class="right" data-ripple data-toggle="modal" data-target="#post_job">Add Job</a>
                    <?php endif; ?>
                </div>
            </div>
            
            <?php $this->load->view('dashboard/sidebar/connection'); ?>
            
            <?php $this->load->view('dashboard/sidebar/groups') ?>
            
            <?php $this->load->view('dashboard/sidebar/invite-fb'); ?>
        </div>
        <?php endif; ?>
        
        <?php if($this->session->userdata('user_type') != '1') { $this->load->view('dashboard/modals/job'); } ?>
    </div>
</div>      

   
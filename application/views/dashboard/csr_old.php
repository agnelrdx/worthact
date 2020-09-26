<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container csr">				
    <div class="row">
        
        <?php if(!$this->agent->is_mobile()) : ?>
        <div class="col-sm-3 row-left">
            <?php $this->load->view('dashboard/sidebar/posts') ?>
            
            <?php $this->load->view('dashboard/sidebar/connection') ?>
            
            <?php $this->load->view('dashboard/sidebar/groups') ?>
            
            <?php $this->load->view('dashboard/sidebar/invite-fb'); ?>
        </div>
        <?php endif; ?>

        <div class="col-sm-6 row-center">
            <div class="tabbable">
                <div class="top-nav-tab">
                    <ul class="nav nav-tabs nav-tabs-solid nav-lg shadow">
                        <li class="active"><a href="#3bl" data-toggle="tab">3BL</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Companies<i class="fa fa-angle-down" aria-hidden="true"></i></a>
                            <ul class="list-group dropdown-menu dropdown-menu-right clearfix">
                                <li class="list-group-item">
                                    <a onclick="load_csr_list()" href="#list" data-toggle="tab">Listed</a>
                                </li>
                                <li class="list-group-item">
                                    <a onclick="load_csr_process()" href="#process" data-toggle="tab">On Process</a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="#oppor" data-toggle="tab">CSR Opportunities</a></li>
                        <?php if($this->info->type_id != 1) : ?><li><a href="#works" data-toggle="tab">How it works</a></li><?php endif; ?>
                    </ul>
                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                </div>
                
                <?php if($status == 'null' && $this->info->type_id != 1) : ?>
                <div class="add_block shadow">
                    <p>Get listed as a <span>3BL</span> certified company to boost your status. <a data-ripple href="<?= base_url('dashboard/get_listed') ?>">Submit</a> your applications and get verified now.</p>
                </div>
                <?php endif; ?>

                <div class="tab-content shadow">
                    <div class="tab-pane active" id="3bl">
                        <div class="row">
                            <div class="col-sm-12">
                                <?= $this->session->flashdata('msg'); ?>
                                <?= ($this->session->flashdata('msg') == '' && $status == 0 && $status != 'null')? '<div class="alert alert-info" role="alert">Your application is under the review proceess.</div>' : '' ; ?>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane csr_list" id="list">
                        <div class="main clearfix"></div>
                        <?php if($c_list > 20) : ?>
                        <a onclick="load_more_csr_list()" id="load_more">Load More <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" /></a>
                        <?php endif; ?>
                    </div>
                    <div class="tab-pane csr_list" id="process">
                        <div class="main clearfix"></div>
                        <?php if($c_list > 20) : ?>
                        <a onclick="load_more_csr_process()" id="load_more">Load More <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" /></a>
                        <?php endif; ?>
                    </div>
                    <div class="tab-pane" id="oppor">

                    </div>
                    <div class="tab-pane" id="works">

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
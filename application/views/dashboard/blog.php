<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">				
    <div class="row">
        <div class="blog-page">
            <?php if(!$this->agent->is_mobile()) : ?>
            <div class="col-sm-3 row-left">
                <div class="thumbnail blog-add clearfix">
                    <h4>Add a new Blog post</h4>
                    <p>Share and learn about our Earth; express your thoughts with WorthAct blog-spot.</p>
                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                    <a data-ripple class="add-blog-md trans">Add Blog</a>
                </div>
                
                <?php $this->load->view('dashboard/ads/block_1', $this->adv) ?>
                
                <?php $this->load->view('dashboard/sidebar/connection') ?>
                
                <?php $this->load->view('dashboard/sidebar/groups') ?>
                
                <?php $this->load->view('dashboard/sidebar/invite-fb'); ?>
                
                <?php $this->load->view('dashboard/ads/block_2', $this->adv) ?>
            </div>
            <?php else : ?>
            <div class="col-sm-3 row-left">
                <div class="thumbnail blog-add clearfix">
                    <h4>Add a new Blog post</h4>
                    <p>Start or involve yourself to enrich your knowledge by sharing and learning about matters that are important.</p>
                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                    <a data-ripple class="add-blog-md trans">Add Blog</a>
                </div>
            </div>
            <?php endif; ?>

            <div class="col-sm-6 panel-post-main row-center">
                <?= $this->session->flashdata('msg'); ?>
                <div class="panel-flat">
                    <div class="panel-body panel-post">
                        <div id="grid"></div>
                        <?php if($load_more): ?><a onclick="load_more_blog()" style="display: block" id="load_more">Load More <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" /></a><?php endif; ?>
                    </div>
                </div>    
            </div>
            
            <?php if(!$this->agent->is_mobile()) : ?>
            <div class="col-sm-3 row-right">
                <?php $this->load->view('dashboard/ads/block_5', $this->adv) ?>
                
                <?php $this->load->view('dashboard/sidebar/thoughts'); ?>
                
                <?php $this->load->view('dashboard/sidebar/app'); ?>
                
                <?php $this->load->view('dashboard/sidebar/recent-activity') ?>
                
                <?php $this->load->view('dashboard/ads/block_6', $this->adv) ?>
            </div>
            <?php else : ?>
            <div class="col-sm-3 row-right">
                <?php $this->load->view('dashboard/sidebar/connection'); ?>
            
                <?php $this->load->view('dashboard/sidebar/groups') ?>
            
                <?php $this->load->view('dashboard/sidebar/invite-fb'); ?>
            </div>
            <?php endif; ?>
            
            <?php $this->load->view('dashboard/modals/add-delete-blog'); ?>
            
            <?php $this->load->view('dashboard/modals/likes'); ?>
        </div>
    </div>
</div>    
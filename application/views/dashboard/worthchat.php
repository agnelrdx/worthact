<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container worthchat">				
    <div class="row">
        
        <?php if(!$this->agent->is_mobile()) : ?>
        <div class="col-sm-3 row-left">
            <?php $this->load->view('dashboard/sidebar/app'); ?>
            
            <?php $this->load->view('dashboard/sidebar/posts') ?>
            
            <?php $this->load->view('dashboard/sidebar/connection') ?>
            
            <?php $this->load->view('dashboard/sidebar/groups') ?>
            
            <?php $this->load->view('dashboard/sidebar/invite-fb'); ?>            
        </div> 
        <?php endif; ?>

        <div class="col-sm-9 row-center">
            <div class="panel panel-flat">
                <iframe id="chat_box" src="/wa-live/arrowchat/public/popout/" frameborder="0"></iframe>
            </div>
        </div>
        
        <?php if($this->agent->is_mobile()) : ?>
        <div class="col-sm-3 row-right">
            <?php $this->load->view('dashboard/sidebar/app'); ?>
            
            <?php $this->load->view('dashboard/sidebar/posts') ?>
            
            <?php $this->load->view('dashboard/sidebar/connection') ?>
            
            <?php $this->load->view('dashboard/sidebar/groups') ?>
            
            <?php $this->load->view('dashboard/sidebar/invite-fb'); ?>            
        </div> 
        <?php endif; ?>
    </div>
</div>

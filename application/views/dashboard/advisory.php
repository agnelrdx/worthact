<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container advisory_panel">
    <div class="row">
        <?php if(!$this->agent->is_mobile()) : ?>
        <div class="col-sm-3 row-left">
            <?php $this->load->view('dashboard/sidebar/connection'); ?>
            
            <?php $this->load->view('dashboard/sidebar/groups') ?>
            
            <?php $this->load->view('dashboard/sidebar/invite-fb'); ?>
        </div>
        <?php endif; ?>
        
        <div class="col-sm-6 row-center">
            <div class="panel-flat shadow">
                <div class="panel-heading">
                    <h5 class="panel-title">Advisory</h5>
                </div>
                <div class="panel-body">
                    <div class="block" data-id="1">
                        <div class="thumb shadow">
                            <img src="<?= base_url('assets/img/user_placeholder.png') ?>" alt="" />
                        </div>
                        <div class="info">
                            <h3>Mr. Undertaker</h3>
                            <h5>Marketing Head</h5>
                        </div>
                        <div class="desc clearfix">
                            <p>Fusce hendrerit leo libero, ut dapibus dui tempus in. Mauris bibendum interdum est eget pharetra. Maecenas pretium nisi elit, sed tristique sem consectetur at. Maecenas sapien tellus, condimentum nec efficitur at, accumsan in justo. Quisque finibus elit sem, et consectetur tortor finibus ac. Nulla sit amet vestibulum tortor, a imperdiet nisl. Integer auctor sit amet libero vitae elementum. Praesent euismod ante a libero efficitur, non laoreet felis malesuada. Quisque rutrum tristique vestibulum.</p>
                            <p class="last">Fusce hendrerit leo libero, ut dapibus dui tempus in. Mauris bibendum interdum est eget pharetra. Maecenas pretium nisi elit, sed tristique sem consectetur at. Maecenas sapien tellus, condimentum nec efficitur at, accumsan in justo. Quisque finibus elit sem, et consectetur tortor finibus ac. Nulla sit amet vestibulum tortor, a imperdiet nisl. Integer auctor sit amet libero vitae elementum. Praesent euismod ante a libero efficitur, non laoreet felis malesuada. Quisque rutrum tristique vestibulum.</p>
                            <div class="more">
                                <a class="trans read_more" data-id="1">Read More</a>
                                <a class="trans read_less" data-id="1">Read Less</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php if(!$this->agent->is_mobile()) : ?>
        <div class="col-sm-3 row-right">
            <?php $this->load->view('dashboard/sidebar/thoughts'); ?>
            
            <?php $this->load->view('dashboard/sidebar/app'); ?>
            
            <?php $this->load->view('dashboard/sidebar/posts'); ?>
            
            <?php $this->load->view('dashboard/sidebar/recent-activity'); ?>
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
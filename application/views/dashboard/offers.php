<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container offers">
    <div class="row">
        <img src="<?= base_url('assets/img/offer_inner.jpg'); ?>" class="img-responsive offer-banner"  alt="offer" />
        <div class="col-sm-12 col">
            <div class="row text-center type">
                <div class="col-sm-12">
                    <div class="offer_modal">
                        <div class="modal-content shadow">
                            <div class="modal-header">
                                <h4 class="modal-title text-center">Enroll in 'Wow Offer' and become a winner!</h4>
                                <h4 class="text-center title-two">Winning through WORTHY ACTIONS!</h4>
                            </div>
                            <div class="modal-body top_zero">
                                <p class="entry">Grab your opportunity to win an amazing prize from our wide range of selections. The winner gets to choose a prize from <br />our shelf that showcases DSLR Camera, Playstation, Holiday Package* or an IPhone 7.</p>
                                <h4 class="text-center how main">Enroll Hassle Free</h4>
                                <h5>With the following two simple steps</h5>
                                <div class="row how_action">
                                    <div class="box col-sm-6">
                                        <div <?php if($this->info->user_level == 0) { echo 'class="shadow cursor" id="link_update"'; } else { echo 'class="shadow opp"'; } ?>>
                                            <img src="<?= base_url('assets/img/medal.png') ?>" alt="Plant Trees" />
                                            <p>Upgrade as a premium member <br />(options to upgrade Free)<br />Step 1</p>
                                        </div>
                                    </div>
                                    <div class="box col-sm-6">
                                        <div <?php if(($free_mems + $pre_mems) < 2) { echo 'class="shadow cursor" id="link_camp"'; } else { echo 'class="shadow opp"'; } ?>>
                                            <img src="<?= base_url('assets/img/network.png') ?>" alt="Refer members" />
                                            <p>Successful reference with registration<br /> of two members (premium or free)<br />Step 2</p>
                                        </div>
                                    </div>
                                </div>
                                <h4 class="text-center how">Multiply your chances</h4>
                                <ul>
                                    <li>Additional reference of each pair allots an extra slot in your name.</li>
                                    <li>Minimum two posts per week (SOS Action / Environment Info) allots an extra slot in your name.</li>
                                    <li>Two likes / comments / new connections per week allots an extra slot in your name.</li>
                                </ul>
                                <div class="offer_action text-center">
                                    <?php if($this->info->user_level == 0) : ?>
                                    <h3>To become a premium member with Worthact - <a href="<?= base_url('dashboard/profile_update/3') ?>">click here</a></h3>
                                    <?php endif; ?>
                                </div>
                                <?php if($this->info->user_level == 0 && ($free_mems + $pre_mems < 2)): ?>
                                <div class="alert alert-danger" style="display: block" role="alert">Complete step 1 and step 2 to successfully enroll in WOW Offer.</div>
                                <?php endif; if($this->info->user_level == 0 && ($free_mems + $pre_mems > 1)): ?>
                                <div class="alert alert-danger" style="display: block" role="alert">Congrats..!! You are one step away from enrolling in WOW Offer. Become a premium member using one of the three options listed.</div>
                                <?php endif; if($this->info->user_level == 1 && ($free_mems + $pre_mems < 2)): ?>
                                <div class="alert alert-danger" style="display: block" role="alert">Congrats..!! Now all you have to do is refer 2 members( premium or free ) to enroll in WOW Offer.</div>
                                <?php endif; if($this->info->user_level == 1 && ($free_mems + $pre_mems > 1)): ?>
                                <div class="alert alert-success" style="display: block" role="alert">You have successfully enrolled to WOW offer.</div>
                                <?php endif; ?>
                                <a class="link" data-toggle="modal" data-target="#offer_terms">Terms & Conditions</a>
                                <a id="link_camp" class="link campaign">My Campaign</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('dashboard/modals/offer_terms'); ?>

<?php $this->load->view('dashboard/modals/offer_campaign'); ?>
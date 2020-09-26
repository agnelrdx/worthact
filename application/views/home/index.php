<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<div class="container content">	
    <div class="row">
        <div class="col col-md-6 left">
            <div class="box">
                <?php if(!$this->agent->is_mobile()) : ?>
                <p class="text">Our Earth, with its abundant supply of natural resources that sustain valuable life is drying up rapidly due to population expansion and its eco-destructive practices. The impact is evident and it’s worsening. As a result, life is being driven to extinction and the only strategy for this is <span>"ACT NOW"</span>.</p>
                <p class="text">Do worthy actions, spread the word, influence and inspire others to build a better world… before it is too late…...!!</p>
                <h1 class="title-special text-size-12">"Many a drop make an Ocean" - Join us</h1>
                <?php else : ?>
                <p class="text">Life is being driven to extinction due to the impact of population expansion and its destructive practices.</p>
                <p class="text">Do worthy actions, spread the word, influence and inspire others to build a better world… before it is too late…...!!</p>
                <h1 class="title-special text-size-12">"Many a drop make an Ocean" - ACT NOW</h1>
                <?php endif; ?>
                <a data-ripple class="know-more" href="<?= base_url('home/aim')?>">Know More</a>
            </div>
        </div>
        <div class="col col-md-4 right col-md-offset-2">
            <div class="card">
                <?php if($this->session->userdata('register-email') != '') : ?>
                <div class="validation-email text-center">                
                    <h3>Just one more step...</h3>
                    <p>The key to awesomeness is in your inbox. Simply click the verification link in the email we sent to:</p>
                    <p><span id="resend-id"><?= $this->session->userdata('register-email'); ?></span></p>
                    <div class="resend">
                        <a href="" id="resend-link-home">Re-send verification email</a>
                        <p>If you did not receive an email, please check your spam/junk folder or contact our support</p>
                    </div>
                </div>
                <?php $this->session->unset_userdata('register-email'); else : ?>
                <form id="home-register">
                    <h5>Take your first step to</h5>
                    <h3 class="margin-bottom-25 text-center">Register</h3>
                    <div class="form-group">
                        <select data-placeholder="User type" class="select select-type is-large" name="usertype">
                            <option></option>
                            <?php foreach ($usertypes as $type) : ?>
                            <option value="<?= $type->type_id ?>"><?= $type->type_name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input id="register-email" class="trans"  type="email" name="email" placeholder="Email" required="required" onblur="validate_user_email(this.value)" />
                    </div>    
                    <div class="form-group">
                        <input type="password" class="trans" name="password" placeholder="Password" required="required" />
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="ref" value="<?= $reference ?>" />
                        <button data-ripple class="full-width shadow" type="submit">Get Started</button>
                        <img src="<?= base_url('assets/img/reload-2.svg') ?>" id="loader" alt="loader" />
                    </div>
                    <p class="text-center text-policy">By registering, you agree to WorthAct's <br /><a href="<?= base_url('privacy_policy'); ?>">Privacy Policy</a> and <a href="<?= base_url('terms_and_conditions'); ?>">Terms & Conditions</a></p>
                    <div class="alert alert-danger shadow" role="alert"></div>
                </form>
                <?php endif; ?>
            </div>
        </div>
        
        <?php if($this->session->userdata('enroll') != 1) : ?>
        <div class="modal fade" id="offer_home" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button id="offer_close" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <a href="<?= base_url('seso') ?>"><img src="<?= base_url('assets/img/seso_modal.jpg') ?>" alt="offer" /></a>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

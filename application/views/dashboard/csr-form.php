<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container csr-form">				
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
            <div class="panel panel-flat">
                <div class="panel-body csr-form-body">
                    <h4 class="head">Complete the information below to get listed as 3BL</h4>
                    <p class="help">Please refer to the <a class="trans" href="<?= base_url('dashboard/help') ?>">help</a> section for more information</p>
                    <div class="box">
                        <form id="csr_form_submit">
                            <div class="block">
                                <h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h3>
                                <label class="radio-inline">
                                    <input data-block="1" onchange="csr_upload_check(1)" value="1" type="radio" name="question_1">Yes
				</label>
                                <label class="radio-inline">
                                    <input onchange="csr_upload_check(1)" type="radio" value="0" name="question_1">No
				</label>
                                <div class="form-group" data-block="1">
                                    <label>Upload supporting document</label>
                                    <input type="file" id="csr_form_upload_1" >
                                    <p class="help-block">Only pdf |doc | docx | jpeg | jpg | png formats allowed.</p>
                                </div>
                            </div>
                            <div class="block">
                                <h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h3>
                                <label class="radio-inline">
                                    <input data-block="2" onchange="csr_upload_check(2)" value="1" type="radio" name="question_2">Yes
				</label>
                                <label class="radio-inline">
                                    <input onchange="csr_upload_check(2)" type="radio" value="0" name="question_2">No
				</label>
                                <div class="form-group" data-block="2">
                                    <label>Upload supporting document</label>
                                    <input type="file" id="csr_form_upload_2" >
                                    <p class="help-block">Only pdf |doc | docx | jpeg | jpg | png formats allowed.</p>
                                </div>
                            </div>
                            <div class="block">
                                <h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h3>
                                <label class="radio-inline">
                                    <input data-block="3" onchange="csr_upload_check(3)" value="1" type="radio" name="question_3">Yes
				</label>
                                <label class="radio-inline">
                                    <input onchange="csr_upload_check(3)" type="radio" value="0" name="question_3">No
				</label>
                                <div class="form-group" data-block="3">
                                    <label>Upload supporting document</label>
                                    <input type="file" id="csr_form_upload_3" >
                                    <p class="help-block">Only pdf |doc | docx | jpeg | jpg | png formats allowed.</p>
                                </div>
                            </div>
                            <div class="block">
                                <h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h3>
                                <label class="radio-inline">
                                    <input data-block="4" onchange="csr_upload_check(4)" value="1" type="radio" name="question_4">Yes
				</label>
                                <label class="radio-inline">
                                    <input onchange="csr_upload_check(4)" type="radio" value="0" name="question_4">No
				</label>
                                <div class="form-group" data-block="4">
                                    <label>Upload supporting document</label>
                                    <input type="file" id="csr_form_upload_4" >
                                    <p class="help-block">Only pdf |doc | docx | jpeg | jpg | png formats allowed.</p>
                                </div>
                            </div>
                            <div class="block">
                                <h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h3>
                                <label class="radio-inline">
                                    <input data-block="5" onchange="csr_upload_check(5)" value="1" type="radio" name="question_5">Yes
				</label>
                                <label class="radio-inline">
                                    <input onchange="csr_upload_check(5)" type="radio" value="0" name="question_5">No
				</label>
                                <div class="form-group" data-block="5">
                                    <label>Upload supporting document</label>
                                    <input type="file" id="csr_form_upload_5" >
                                    <p class="help-block">Only pdf |doc | docx | jpeg | jpg | png formats allowed.</p>
                                </div>
                            </div>
                            <div class="block last">
                                <div class="row">
                                    <div class="col-xs-8">
                                        <h3>Submit for review</h3>
                                        <p>After you answer all the questions, you can submit them for review</p>
                                    </div>
                                    <div class="col-xs-4">
                                        <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                                        <button data-ripple type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                                <div class="alert alert-danger" role="alert"></div>
                            </div>
                        </form>
                    </div>
                </div>
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
    </div>
</div>
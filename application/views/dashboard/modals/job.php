<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="post_job" class="modal fade job_modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="add_job_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Job Details</h3>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6 cat_form_box">
                            <div class="form-group">
                                <label>Industry</label>
                                <select class="form-control" id="job_cat_form" name="job_cat">
                                    <option value='0'>Select Industry</option>
                                    <?php foreach ($jobcats as $jobcat) { ?>
                                    <option value="<?php echo $jobcat->id; ?>"><?php echo $jobcat->job_cat_name; ?></option>
                                    <?php } ?> 
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Level</label>
                                <select id="job_user_level" class="form-control" name="job_user_level">
                                    <option value="0">Select level</option>
                                    <?php foreach ($levels as $joblevel) { ?>
                                        <option value="<?php echo $joblevel->id; ?>"><?php echo $joblevel->level_name; ?></option>
                                    <?php } ?> 
                                </select>
                            </div>
                        </div>    
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Type</label>
                                <select id="job_user_type" class="form-control job-cat-list" name="job_user_type">
                                    <option value="0">Select type</option>
                                    <?php foreach ($types as $jobtype) { ?>
                                        <option value="<?php echo $jobtype->id; ?>"><?php echo $jobtype->jobtype_name; ?></option>
                                    <?php } ?> 
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Country</label>
                                <select id="country" name="country" class="form-control country-select">
                                    <option value='0'>Choose Country</option> 
                                    <?php foreach ($countries as $country) { ?>
                                        <option value="<?php echo $country->country_code; ?>"><?php echo $country->country_name; ?></option>
                                    <?php } ?> 
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter post title">
                    </div>
                    
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="job_desc" class="form-control" id="job_desc"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Skills Required</label>
                        <select data-placeholder="Key skills" multiple="multiple" name="tags[]" class="form-control job_tags"></select>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Contact Phone <i class="ion-information-circled" data-toggle="tooltip" data-placement="bottom" title="If no number is entered, contact number from your profile will be shown."></i></label>
                                <input type="tel" name="job_phone" class="form-control" id="job_phone" placeholder="Contact number">
                            </div>
                            <div class="col-sm-6">
                                <label>Contact Email <i class="ion-information-circled" data-toggle="tooltip" data-placement="bottom" title="If no email is entered, email Id from your profile will be shown."></i></label>
                                <input type="email" name="job_email" class="form-control" id="job_email" placeholder="Contact Email">
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Additional link <i class="ion-information-circled" data-toggle="tooltip" data-placement="bottom" title="If no link is entered, website link from your profile will be shown."></i></label>
                                <input type="text" name="job_website" class="form-control" id="job_website" placeholder="Company website">
                            </div>
                            <div class="col-sm-6" id="date_box">
                                <label>Last date to apply</label>
                                <input type="text" name="job_end_date" class="form-control" id="job_end_date" placeholder="Last day to apply">
                            </div>
                        </div>    
                    </div>
                    <?php if($this->info->user_level != 0): ?>
                    <div class="form-group">
                        <label>Banner images</label>
                        <input type="file" name="job_img_up[]" id="job_img_up" multiple="multiple">
                        <p class="help-block">Only jpg | png formats allowed. Hold Ctrl to add multiple images.</p>   
                    </div>
                    <?php else : ?>
                    <div class="form-group">
                        <label>** Upgrade to premium account to add banner images along with your post.</label>
                    </div>    
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                    <button data-ripple class="btn btn-default" data-dismiss="modal">Close</button>
                    <button data-ripple type="submit" class="btn btn-primary">Submit</button>
                    <div class="alert alert-danger" role="alert"></div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="job_update" class="modal fade job_modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="update_job_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Job Post</h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                    <button data-ripple class="btn btn-default" data-dismiss="modal">Close</button>
                    <button data-ripple type="submit" class="btn btn-primary">Update</button>
                    <div class="alert alert-danger" role="alert"></div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="delete_job" class="modal fade job_modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="delete_job_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Job Post</h4>
                </div>
                <div class="modal-body">						
                    <p>Are you sure you want to delete this job post ?</p>
                    <input type="hidden" value="" id="job_delete_id" />
                </div>
                <div class="modal-footer">
                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                    <button data-ripple class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button data-ripple type="submit" class="btn btn-primary">Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>

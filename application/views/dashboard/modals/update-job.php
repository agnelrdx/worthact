<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Industry</label>
            <select class="form-control" id="job_cat" name="job_cat">
                <option value='0'>Select Industry</option>
                <?php foreach ($jobcats as $jobcat) { ?>
                <option <?php if($jobcat->id == $job->job_cat_id) { echo "selected='selected'"; } ?> value="<?php echo $jobcat->id; ?>"><?php echo $jobcat->job_cat_name; ?></option>
                <?php } ?> 
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Level</label>
            <select id="job_user_level" class="form-control" name="job_user_level">
                <option value="0">Select level</option>
                <?php foreach ($joblevels as $joblevel) { ?>
                <option <?php if($joblevel->id == $job->exp_level) { echo "selected='selected'"; } ?> value="<?php echo $joblevel->id; ?>"><?php echo $joblevel->level_name; ?></option>
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
                <?php foreach ($jobtypes as $jobtype) { ?>
                <option <?php if($jobtype->id == $job->employment_type) { echo "selected='selected'"; } ?> value="<?php echo $jobtype->id; ?>"><?php echo $jobtype->jobtype_name; ?></option>
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
                <option <?php if($country->country_code == $job->job_country) { echo "selected='selected'"; } ?> value="<?php echo $country->country_code; ?>"><?php echo $country->country_name; ?></option>
                <?php } ?> 
            </select>
        </div>
    </div>    
</div>

<div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control" value="<?= $job->job_title ?>" name="title" placeholder="Enter post title">
</div>

<div class="form-group">
    <label>Description</label>
    <textarea name="job_desc" class="form-control" id="job_desc"><?= $job->job_desc ?></textarea>
</div>

<div class="form-group">
    <label>Skills Required</label>
    <select value="<?= $job->job_skills ?>" data-placeholder="Key skills" multiple="multiple" name="tags[]" class="form-control job_tags">
        <?php if ($job->job_skills != '') : $tags = explode(',', $job->job_skills); foreach ($tags as $tag) : ?>
        <option value="<?= $tag; ?>" selected="selected"><?= $tag; ?></option>
        <?php endforeach; endif; ?>
    </select>
</div>

<div class="form-group">
    <div class="row">
        <div class="col-sm-6">
            <label>Contact Phone <i class="ion-information-circled" data-toggle="tooltip" data-placement="bottom" title="If no number is entered, contact number from your profile will be shown."></i></label>
            <input type="tel" value="<?= $job->job_contact ?>" name="job_phone" class="form-control" id="job_phone" placeholder="Contact number">
        </div>
        <div class="col-sm-6">
            <label>Contact Email <i class="ion-information-circled" data-toggle="tooltip" data-placement="bottom" title="If no email is entered, email Id from your profile will be shown."></i></label>
            <input type="email" value="<?= $job->job_email ?>" name="job_email" class="form-control" id="job_email" placeholder="Contact email">
        </div>
    </div>
</div>
        
<div class="form-group">
    <div class="row">        
        <div class="col-sm-6">
            <label>Additional link <i class="ion-information-circled" data-toggle="tooltip" data-placement="bottom" title="If no link is entered, website link from your profile will be shown."></i></label>
            <input type="text" value="<?= $job->job_website ?>" name="job_website" class="form-control" id="job_website" placeholder="Company website">
        </div>
        <div class="col-sm-6" id="date_update_box">
            <label>Last date to apply</label>
            <input type="text" value="<?= $job->expiry_date ?>" name="job_end_date" class="form-control" id="job_update_end_date" placeholder="Last day to apply">
        </div>
    </div>    
</div>
<?php if($this->info->user_level != 0): ?>
<div class="form-group">
    <label>Banner images</label>
    <input type="file" name="job_update_img_up[]" id="job_update_img_up" multiple="multiple">
    <p class="help-block">Only jpg | png formats allowed. Hold Ctrl to add multiple images. Add files to replace the previous uploaded images.</p>   
</div>
<?php endif; ?>
<input type="hidden" value="<?= $job->main_job_id ?>" name="job_update_id" />
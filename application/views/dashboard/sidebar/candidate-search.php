<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="panel panel-flat job-search">
    <div class="panel-heading">
        <h5 class="panel-title">Search Candidates</h5>						
    </div>
    <div class="panel-body">
        <form id="candidate_search">
            <div class="form-group country_search_box">
                <select id="country" name="country" class="country-search form-control">
                    <option value=''>Choose Country</option>
                    <?php foreach ($countries as $country) { ?>
                        <option value="<?php echo $country->country_code; ?>"><?php echo $country->country_name; ?></option>
                    <?php } ?> 
                </select>
            </div>
            <div class="form-group cat_box">
                <select id="job_cat" name="job_cat" class="job-cat-list form-control">
                    <option value=''>Choose a job category</option>
                    <?php foreach ($jobcats as $jobcat) { ?>
                        <option value="<?php echo $jobcat->id; ?>"><?php echo $jobcat->job_cat_name; ?></option>
                    <?php } ?> 
                </select>
            </div>
            <div class="form-group search_tag_box">
                <select data-placeholder="Skills" multiple="multiple" name="tags[]" class="form-control job_tags"></select>
            </div>
            <button data-ripple type="submit" class="btn">Search</button>
            <div class="alert alert-danger clearfix" role="alert">asdasd</div>
        </form>        
    </div>     
</div>
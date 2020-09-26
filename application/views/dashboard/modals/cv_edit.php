<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="cv_head_update" class="modal fade timeline_modal_form" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="cv_update_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Basic Info</h4>
                </div>
                <div class="modal-body">						
                    <div class="form-group">
                        <label>Current Post</label>
                        <input type="text" value="<?= ($user_cv != 'null' && $user_cv->current_post != '')? strtoupper($user_cv->current_post) : ''; ?>" class="form-control" name="post" placeholder="Enter current post">
                    </div>
                    <div class="form-group">
                        <label>Current Company</label>
                        <input type="text" value="<?= ($user_cv != 'null' && $user_cv->current_company != '')? ucfirst($user_cv->current_company) : ''; ?>" class="form-control" name="company" placeholder="Enter current company">
                    </div>
                    <div class="form-group">
                        <label>Current Location</label>
                        <select data-placeholder="Select country" name="country" class="form-control country-select">
                            <option value=''></option> 
                            <?php foreach ($countries as $country) { ?>
                                <option <?php if($user_cv != 'null' && $user_cv->current_location == $country->country_code) { echo 'selected'; } ?> value="<?php echo $country->country_code; ?>"><?php echo $country->country_name; ?></option>
                            <?php } ?> 
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select data-placeholder="Select category" name="category" class="form-control country-select">
                            <option value=''></option> 
                            <?php foreach ($categories as $category) { ?>
                                <option <?php if($user_cv != 'null' && $user_cv->category == $category->id) { echo 'selected'; } ?> value="<?php echo $category->id; ?>"><?php echo $category->job_cat_name; ?></option>
                            <?php } ?> 
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Experience</label>
                        <div class="row">
                            <div class="col-sm-6">
                                <select data-placeholder="Select years" name="years" class="form-control experience-select">
                                    <option value=''></option> 
                                    <?php for ($i = 0; $i < 51; $i++) { ?>
                                        <option <?php if($user_cv != 'null' && $user_cv->experience != '') { $exp = explode(',', $user_cv->experience); if(current($exp) == $i) { echo 'selected'; } } ?> value="<?= $i ?>"><?= $i; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <select data-placeholder="Select months" name="months" class="form-control experience-select">
                                    <option value=''></option> 
                                    <?php for ($i = 0; $i < 13; $i++) { ?>
                                        <option <?php if($user_cv != 'null' && $user_cv->experience != '') { $exp = explode(',', $user_cv->experience); if(end($exp) == $i) { echo 'selected'; } } ?> value="<?= $i ?>"><?= $i; ?></option>
                                    <?php } ?> 
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group search_tag_box">
                        <label>Skills</label>
                        <select value="<?= ($user_cv != 'null' && $user_cv->skills != '')? $user_cv->skills : ''; ?>" data-placeholder="Enter your skills" multiple="multiple" name="tags[]" class="form-control job_tags">
                            <?php if ($user_cv != 'null' && $user_cv->skills != '') : $tags = explode(',', $user_cv->skills); foreach ($tags as $tag) : ?>
                            <option value="<?= $tag; ?>" selected="selected"><?= $tag; ?></option>
                            <?php endforeach; endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12 job-cv-div">
                                <label>Upload CV</label>
                                <input type="file" id="job_cv_up" name="job_cv_up" />
                                <p class="help-block">Only pdf | doc | docx | txt formats allowed. <?= ($this->info->user_level == 0)? 'P.S You are on a free account. Your CV will be limited upto 5 downloads.' : ''; ?></p>
                            </div>
                        </div>    
                    </div>
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

<div id="cv_job_update" class="modal fade timeline_modal_form" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="cv_job_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Target Job</h4>
                </div>
                <div class="modal-body">						
                    <div class="form-group">
                        <label>Target Job Title</label>
                        <input type="text" value="<?= ($user_cv != 'null' && $user_cv->job_title != '')? ucfirst($user_cv->job_title) : ''; ?>" class="form-control" name="job_title" placeholder="Enter target job title">
                    </div>
                    <div class="form-group">
                        <label>Career Level</label>
                        <select data-placeholder="Select career level" name="level" class="form-control experience-select">
                            <option value=''></option> 
                            <?php foreach ($levels as $level) { ?>
                                <option <?php if($user_cv != 'null' && $user_cv->level == $level->id) { echo 'selected'; } ?> value="<?= $level->id ?>"><?= $level->level_name ?></option>
                            <?php } ?> 
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Target Job Location</label>
                        <select data-placeholder="Select country" name="target_country" class="form-control country-select">
                            <option value=''></option> 
                            <?php foreach ($countries as $country) { ?>
                                <option <?php if($user_cv != 'null' && $user_cv->target_country == $country->country_code) { echo 'selected'; } ?> value="<?php echo $country->country_code; ?>"><?php echo $country->country_name; ?></option>
                            <?php } ?> 
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Career Objective</label>
                        <textarea class="form-control" name="objective" placeholder="Enter career objective"><?= ($user_cv != 'null' && $user_cv->objective != '')? ucfirst($user_cv->objective) : ''; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Employment Type</label>
                        <select data-placeholder="Select employment type" name="type" class="form-control experience-select">
                            <option value=''></option> 
                            <?php foreach ($types as $type) { ?>
                                <option <?php if($user_cv != 'null' && $user_cv->type == $type->id) { echo 'selected'; } ?> value="<?= $type->id ?>"><?= $type->jobtype_name ?></option>
                            <?php } ?> 
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Target Monthly Salary</label>
                        <input type="text" value="<?= ($user_cv != 'null' && $user_cv->monthly_salary != '')? $user_cv->monthly_salary : ''; ?>" class="form-control" name="monthly_salary" placeholder="Enter target monthly salary">
                    </div>
                    <div class="form-group">
                        <label>Last Monthly Salary</label>
                        <input type="text" value="<?= ($user_cv != 'null' && $user_cv->last_salary != '')? $user_cv->last_salary : ''; ?>" class="form-control" name="last_salary" placeholder="Enter last monthly salary">
                    </div>
                    <div class="form-group">
                        <label>Notice Period</label>
                        <input type="text" value="<?= ($user_cv != 'null' && $user_cv->notice != '')? $user_cv->notice : ''; ?>" class="form-control" name="notice" placeholder="Enter notice period">
                    </div>
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

<div id="cv_personal_update" class="modal fade timeline_modal_form" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="cv_personal_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Personal Information</h4>
                </div>
                <div class="modal-body">						
                    <div class="form-group">
                        <label>Age</label>
                        <input value="<?= ($user_cv != 'null' && $user_cv->age != '')? $user_cv->age : ''; ?>" type="number" class="form-control" name="age" placeholder="Enter age" min="14">
                    </div>
                    <div class="form-group">
                        <label>Nationality</label>
                        <input value="<?= ($user_cv != 'null' && $user_cv->nationality != '')? ucfirst($user_cv->nationality) : ''; ?>" type="text" class="form-control" name="nationality" placeholder="Enter nationality">
                    </div>
                    <div class="form-group">
                        <label>Residence Country</label>
                        <select data-placeholder="Select country" name="residence_country" class="form-control country-select">
                            <option value=''></option> 
                            <?php foreach ($countries as $country) { ?>
                                <option <?php if($user_cv != 'null' && $user_cv->residence_country == $country->country_code) { echo 'selected'; } ?>  value="<?php echo $country->country_code; ?>"><?php echo $country->country_name; ?></option>
                            <?php } ?> 
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Visa Status</label>
                        <select data-placeholder="Select visa status" name="visa" class="form-control country-select">
                            <option value=''></option>
                            <option <?php if($user_cv != 'null' && $user_cv->visa == 'Citizen') { echo 'selected'; } ?> value='Citizen'>Citizen</option>
                            <option <?php if($user_cv != 'null' && $user_cv->visa == 'Residency Visa') { echo 'selected'; } ?> value='Residency Visa'>Residency Visa</option>
                            <option <?php if($user_cv != 'null' && $user_cv->visa == 'Student Visa') { echo 'selected'; } ?> value='Student Visa'>Student Visa</option>
                            <option <?php if($user_cv != 'null' && $user_cv->visa == 'Transit Visa') { echo 'selected'; } ?> value='Transit Visa'>Transit Visa</option>
                            <option <?php if($user_cv != 'null' && $user_cv->visa == 'Visit Visa') { echo 'selected'; } ?> value='Visit Visa'>Visit Visa</option>
                            <option <?php if($user_cv != 'null' && $user_cv->visa == 'No Visa') { echo 'selected'; } ?> value='No Visa'>No Visa</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Marital Status</label>
                        <select data-placeholder="Select marital status" name="marital" class="form-control country-select">
                            <option value=''></option>
                            <option <?php if($user_cv != 'null' && $user_cv->marital == 'Married') { echo 'selected'; } ?> value='Married'>Married</option>
                            <option <?php if($user_cv != 'null' && $user_cv->marital == 'Single') { echo 'selected'; } ?> value='Single'>Single</option>
                            <option <?php if($user_cv != 'null' && $user_cv->marital == 'Unspecified') { echo 'selected'; } ?> value='Unspecified'>Unspecified</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Number of Dependents</label>
                        <input value="<?= ($user_cv != 'null' && $user_cv->dependents != '')? $user_cv->dependents : ''; ?>" type="number" class="form-control" name="dependents" placeholder="Enter number of dependents" min="0">
                    </div>
                    <div class="form-group">
                        <label>Driving License Issued From</label>
                        <select data-placeholder="Select country" name="licence_country" class="form-control country-select">
                            <option value=''></option> 
                            <?php foreach ($countries as $country) { ?>
                                <option <?php if($user_cv != 'null' && $user_cv->licence_country == $country->country_code) { echo 'selected'; } ?> value="<?php echo $country->country_code; ?>"><?php echo $country->country_name; ?></option>
                            <?php } ?> 
                        </select>
                    </div>
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

<div id="cv_experience_update" class="modal fade timeline_modal_form" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="cv_experience_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Experience</h4>
                </div>
                <div class="modal-body">						
                    <div class="form-group">
                        <label>Job Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter title">
                    </div>
                    <div class="form-group">
                        <label>Company</label>
                        <input type="text" class="form-control" name="company" placeholder="Enter company name">
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <select data-placeholder="Select country" name="location" class="form-control country-select">
                            <option value=''></option> 
                            <?php foreach ($countries as $country) { ?>
                                <option value="<?php echo $country->country_code; ?>"><?php echo $country->country_name; ?></option>
                            <?php } ?> 
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select data-placeholder="Select category" name="category" class="form-control country-select">
                            <option value=''></option> 
                            <?php foreach ($categories as $category) { ?>
                                <option value="<?php echo $category->id; ?>"><?php echo $category->job_cat_name; ?></option>
                            <?php } ?> 
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Level</label>
                        <select data-placeholder="Select career level" name="level" class="form-control experience-select">
                            <option value=''></option> 
                            <?php foreach ($levels as $level) { ?>
                                <option value="<?= $level->id ?>"><?= $level->level_name ?></option>
                            <?php } ?> 
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Responsibilities</label>
                        <textarea class="form-control" name="responsibilities" placeholder="Enter responsibilities"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Start Date</label>
                        <div class="row">
                            <div class="col-sm-6">
                                <select data-placeholder="Select month" name="start_month" class="form-control experience-select">
                                    <option value=''></option> 
                                    <?php $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'); foreach ($months as $month) { ?>
                                        <option value="<?= $month ?>"><?= $month; ?></option>
                                    <?php } ?> 
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <select data-placeholder="Select year" name="start_year" class="form-control country-select">
                                    <option value=''></option> 
                                    <?php for ($i = 1965; $i < date('Y') + 1; $i++) { ?>
                                        <option value="<?= $i ?>"><?= $i; ?></option>
                                    <?php } ?> 
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>End Date</label>
                        <div class="row">
                            <div class="col-sm-6">
                                <select data-placeholder="Select month" name="end_month" class="form-control experience-select">
                                    <option value=''></option> 
                                    <?php $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'); foreach ($months as $month) { ?>
                                        <option value="<?= $month ?>"><?= $month; ?></option>
                                    <?php } ?> 
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <select data-placeholder="Select year" name="end_year" class="form-control country-select">
                                    <option value=''></option> 
                                    <?php for ($i = 1965; $i < date('Y') + 1; $i++) { ?>
                                        <option value="<?= $i ?>"><?= $i; ?></option>
                                    <?php } ?> 
                                </select>
                            </div>
                        </div>
                    </div>
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

<div id="cv_education_update" class="modal fade timeline_modal_form" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="cv_education_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Education</h4>
                </div>
                <div class="modal-body">						
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter title">
                    </div>
                    <div class="form-group">
                        <label>Collage</label>
                        <input type="text" class="form-control" name="collage" placeholder="Enter collage">
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <select data-placeholder="Select country" name="location" class="form-control country-select">
                            <option value=''></option> 
                            <?php foreach ($countries as $country) { ?>
                                <option value="<?php echo $country->country_code; ?>"><?php echo $country->country_name; ?></option>
                            <?php } ?> 
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Time of Completion</label>
                        <div class="row">
                            <div class="col-sm-6">
                                <select data-placeholder="Select month" name="end_month" class="form-control experience-select">
                                    <option value=''></option> 
                                    <?php $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'); foreach ($months as $month) { ?>
                                        <option value="<?= $month ?>"><?= $month; ?></option>
                                    <?php } ?> 
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <select data-placeholder="Select year" name="end_year" class="form-control country-select">
                                    <option value=''></option> 
                                    <?php for ($i = 1965; $i < date('Y') + 1; $i++) { ?>
                                        <option value="<?= $i ?>"><?= $i; ?></option>
                                    <?php } ?> 
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Grade</label>
                        <input type="text" class="form-control" name="grade" placeholder="Enter grade">
                    </div>
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

<div id="delete_cv_exp" class="modal fade timeline_modal_form" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="delete_cv_exp_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Experience</h4>
                </div>
                <div class="modal-body">						
                    <p>Are you sure you want to delete this job experience?</p>
                    <input type="hidden" value="" id="exp_id" />
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

<div id="delete_cv_edu" class="modal fade timeline_modal_form" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="delete_cv_edu_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Education</h4>
                </div>
                <div class="modal-body">						
                    <p>Are you sure you want to delete this education?</p>
                    <input type="hidden" value="" id="edu_id" />
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

<div id="update_propic" class="modal fade timeline_modal_form" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm btns-robocrop2">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change Picture</h4>
            </div>
            <div class="modal-body btns-robocrop2">						
                <div class="form-group">
                    <p class="help-block">Only jpg | png formats allowed. Crop the image to flip them.</p>
                    <div class="btn-open btn btn-default btn-sm">
			<span><i class="fa fa-folder-open-o"></i>&nbsp;Open Image</span>  
			<input class="upload" type="file">
                    </div>
                    <button type="button" class="btn-crop btn btn-default btn-sm"><i class="fa fa-scissors"></i>&nbsp;CROP</button>
                    <button type="button" class="btn-flip-x btn btn-default btn-sm"><i class="fa fa-arrow-right"></i>&nbsp;Flip X</button>
                    <button type="button" class="btn-flip-y btn btn-default btn-sm"><i class="fa fa-arrow-up"></i>&nbsp;Flip Y</button>
                </div>    
                <div id="crop"></div>
            </div>
            <div class="modal-footer">
                <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                <button data-ripple class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="submit_cv_propic" data-ripple class="btn btn-primary">Submit</button>
                <div class="alert alert-danger" role="alert"></div>
            </div>
        </div>
    </div>
</div>
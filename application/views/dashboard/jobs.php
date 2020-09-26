<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container job-listing">
    <?php if($this->session->userdata('user_type') == '1') : ?>
    <div class="row">
        <div class="banner col-sm-12">
            <div class="layer">
                <img src="<?= base_url('assets/img/job_banner_user.jpg'); ?>" alt="job" class="img-responsive" />
                <div class="valign">
                    <blockquote>
                    Choose a job you love, and you will never have to work a day in your life.
                    <footer><cite title="Source Title">Confucius</cite></footer>
                    </blockquote>
                    <?php if(!$this->agent->is_mobile()) : ?>
                    <form id="job_search_home" class="row hide_form">
                        <div class="form-group country_search_box col-sm-4">
                            <select data-placeholder="Country" id="country" name="country" class="country-search form-control">
                                <option value=''></option>
                                <?php foreach ($countries as $country) { if(in_array($country->country_name, $c_list)) { ?>
                                    <option value="<?php echo $country->country_code; ?>"><?php echo $country->country_name; ?></option>
                                <?php } } ?> 
                            </select>
                        </div>
                        <div class="form-group cat_box col-sm-4">
                            <select data-placeholder="Job Category" id="job_cat" name="job_cat" class="job-cat-list form-control">
                                <option value=''></option>
                                <?php foreach ($jobcats as $jobcat) { ?>
                                    <option value="<?php echo $jobcat->id; ?>"><?php echo $jobcat->job_cat_name; ?></option>
                                <?php } ?> 
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <button data-ripple type="submit" class="btn">Search Jobs</button>
                        </div>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
            <?php if($this->agent->is_mobile()) : ?>
            <form id="job_search_home" class="row job-search-mob">
                <div class="form-group country_search_box col-sm-4">
                    <select data-placeholder="Country" id="country" name="country" class="country-search form-control">
                        <option value=''></option>
                        <?php foreach ($countries as $country) { ?>
                            <option value="<?php echo $country->country_code; ?>"><?php echo $country->country_name; ?></option>
                        <?php } ?> 
                    </select>
                </div>
                <div class="form-group cat_box col-sm-4">
                    <select data-placeholder="Job Category" id="job_cat" name="job_cat" class="job-cat-list form-control">
                        <option value=''></option>
                        <?php foreach ($jobcats as $jobcat) { ?>
                            <option value="<?php echo $jobcat->id; ?>"><?php echo $jobcat->job_cat_name; ?></option>
                        <?php } ?> 
                    </select>
                </div>
                <div class="col-sm-4">
                    <button data-ripple type="submit" class="btn">Search Jobs</button>
                </div>
            </form>
            <?php endif; ?>
        </div>
    </div>    
    <div class="row">
        <div class="col-sm-12">
            <div class="content text-center">
                <p class="intro">The existing conditions of our Planet and its Environment being highly vulnerable, the responsibility to protect, nurture and refurbish the same falls on each and every one of us.</p>
                <p class="intro">The employment exercise, counting seekers and providers, is one of the core elements in the survival process of human life, that essentially requires a sustainable planet. So, It's indispensable to have a larger perspective of 'Nature Care' in all survival techniques developed by the human race. In other words, no harm shall befall the environment in applying these techniques in the long run. Consequently, the Job portal caters to a class that has acquired wisdom to be 'friends of the environment. </p>
                <p class="intro">WorthACT partners and users are ingrained with that great and firm sense of responsibility. In Worthact, the employers could potentially trace competent candidates who has the right attitude and job seekers could find employers that value people and planet along with their profits. <strong>Upload your CV and be active to get noticed by employers that care.</strong></p>
                <div class="steps clearfix">
                    <h3 class="how">How It Works?</h3>
                    <div class="col-sm-4 col">
                        <div class="box shadow">
                            <img src="<?= base_url('assets/img/cv.png') ?>" alt="cv" />
                            <h4>Create your CV</h4>
                            <p>Create a CV with such details that <br />gets you noticed and shortlisted pronto.</p>
                        </div>
                    </div>
                    <div class="col-sm-4 col">
                        <div class="box shadow">
                            <img src="<?= base_url('assets/img/search.png') ?>" alt="search" />
                            <h4>Search Desired Job</h4>
                            <p>Endless resources from around the <br />globe increases your chances multifold.</p>
                        </div>
                    </div>
                    <div class="col-sm-4 col">
                        <div class="box shadow">
                            <img src="<?= base_url('assets/img/apply.png') ?>" alt="apply" />
                            <h4>Send Your Resume</h4>
                            <p>Upload your CV and be active to get noticed by employers that care.</p>
                        </div>
                    </div>
                </div>
                <div class="trend clearfix">
                    <div class="col-sm-7">
                        <h3>Categories</h3>
                        <div class="row">
                            <div class="col-sm-6 col-xs-6 col">
                                <h4><a class="trans" href="<?= base_url('dashboard/joblisting/1') ?>">Accounting</a></h4>
                                <p>Accounting Clerk, Auditing Clerk, Accounting Assistant, Management Trainee, Cost Accountant</p>
                            </div>
                            <div class="col-sm-6 col-xs-6 col">
                                <h4><a class="trans" href="<?= base_url('dashboard/joblisting/8') ?>">Business Development</a></h4>
                                <p>Sales, Financial, Human Resources, Food Service, Health Care Administration, Marketing</p>
                            </div>
                            <div class="col-sm-6 col-xs-6 col">
                                <h4><a class="trans" href="<?= base_url('dashboard/joblisting/13') ?>">Engineering</a></h4>
                                <p>Aerospace, Electrical, Software, Petroleum, Automotive, Chemical, Civil, Environmental</p>
                            </div>
                            <div class="col-sm-6 col-xs-6 col">
                                <h4><a class="trans" href="<?= base_url('dashboard/joblisting/17') ?>">Fashion</a></h4>
                                <p>Sales/Brand Representative, Design Assistant, Photographer, Modeling, Designer</p>
                            </div>
                            <a class="view_all trans" href="<?= base_url('dashboard/joblisting/all'); ?>">View All</a>
                            <a class="view_all trans" href="<?= base_url('dashboard/joblisting/applied'); ?>">Applied Jobs</a>
                        </div>
                    </div>
                    <div class="col-sm-5 cv shadow" <?php if($c_job == 0) { echo 'style="background: url('.base_url('assets/img/boost.jpg').') center no-repeat;"'; } else { echo 'style="background: url('.base_url('assets/img/team.jpg').') 27% 35% no-repeat;"'; } ?>>
                        <div class="inner">
                            <div class="valign">
                                <?php if($c_job == 0): ?>
                                <h3>Boost your chances now</h3>
                                <a data-ripple href="<?= base_url('dashboard/cv/'.$this->session->userdata('user_id')) ?>">Create CV</a>
                                <?php else : ?>
                                <h3>Manage your CV</h3>
                                <a data-ripple href="<?= base_url('dashboard/cv/'.$this->session->userdata('user_id')) ?>">View CV</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php else : ?>
    <div class="row">
        <div class="banner col-sm-12">
            <div class="layer">
                <img src="<?= base_url('assets/img/job_banner_company.jpg'); ?>" alt="job" class="img-responsive" />
                <div class="valign">
                    <blockquote>
                    Hiring the best is your most important task.
                    <footer><cite title="Source Title">Steve Jobs</cite></footer>
                    </blockquote>
                    <form id="candidate_search_home" class="row">
                        <div class="form-group country_search_box col-sm-4">
                            <select data-placeholder="Country" id="country" name="country" class="country-search form-control">
                                <option value=''></option>
                                <?php foreach ($countries as $country) { ?>
                                    <option value="<?php echo $country->country_code; ?>"><?php echo $country->country_name; ?></option>
                                <?php } ?> 
                            </select>
                        </div>
                        <div class="form-group cat_box col-sm-4">
                            <select data-placeholder="Job Category" id="job_cat" name="job_cat" class="job-cat-list form-control">
                                <option value=''></option>
                                <?php foreach ($jobcats as $jobcat) { ?>
                                    <option value="<?php echo $jobcat->id; ?>"><?php echo $jobcat->job_cat_name; ?></option>
                                <?php } ?> 
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <button data-ripple type="submit" class="btn">Search Candidates</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>    
    <div class="row">
        <div class="col-sm-12">
            <div class="content text-center">
                <p class="intro">The existing conditions of our Planet and its Environment being highly vulnerable, the responsibility to protect, nurture and refurbish the same falls on each and every one of us.</p>
                <p class="intro">The employment exercise, counting seekers and providers, is one of the core elements in the survival process of human life, that essentially requires a sustainable planet. So, It's indispensable to have a larger perspective of 'Nature Care' in all survival techniques developed by the human race. In other words, no harm shall befall the environment in applying these techniques in the long run. Consequently, the Job portal caters to a class that has acquired wisdom to be 'friends of the environment. </p>
                <p class="intro">WorthACT partners and users are ingrained with that great and firm sense of responsibility. In Worthact, the employers could potentially trace competent candidates who has the right attitude and job seekers could find employers that value people and planet along with their profits. <strong>Be active and post your recruitment requirements in 'Jobs' and search for quality candidates.</strong></p>
                <div class="clearfix">
                    <div class="steps col-sm-6">
                        <div class="col-sm-6 col">
                            <div class="box shadow">
                                <img src="<?= base_url('assets/img/candidates.png') ?>" alt="cv" />
                                <h4>Find Candidates</h4>
                                <p>Find and view your next hire that suits your requirement.</p>
                            </div>
                        </div>
                        <div class="col-sm-6 col">
                            <div class="box shadow">
                                <img src="<?= base_url('assets/img/apply.png') ?>" alt="apply" />
                                <h4>Post your jobs</h4>
                                <p>Be active and post your recruitment requirements in 'Jobs'.</p>
                            </div>
                        </div>
                        <a class="view_all trans" href="<?= base_url('dashboard/joblisting/all_candidates'); ?>">View All Candidates</a>
                    </div>
                    <div class="trend col-sm-6 shadow manage_job">
                        <div class="cv">
                            <div class="inner">
                                <div class="valign">
                                    <h3>Manage your job posts</h3>
                                    <a data-ripple href="<?= base_url('dashboard/joblisting/manage_jobs'); ?>">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>   

   

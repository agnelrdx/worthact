<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container profile_update">				
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
                <div class="panel-body">
                    <?= $this->session->flashdata('msg_1'); ?>
                    <?= $this->session->flashdata('msg'); ?>
                    <div class="tabbable">
                        <div class="top-nav-tab">
                            <ul class="nav nav-tabs nav-tabs-solid nav-lg shadow">
                                <li <?php if(!$this->session->flashdata('msg_1') && $step != 2 && $step != 3 && $step != 4) { echo 'class="active"'; } ?>><a href="#settings" data-toggle="tab">Settings</a></li>
                                <li <?php if($this->session->flashdata('msg_1') || $step == 2) { echo 'class="active"'; } ?>><a href="#personal" data-toggle="tab">Info</a></li>
                                <?php if($this->info->type_id == 1) : ?><li <?php if($step == 4) { echo 'class="active"'; } ?>><a onclick="load_connection('blocked')" href="#blocked_conn" data-toggle="tab">Blocked Connections</a></li><?php endif; ?>
                                <?php if($this->info->user_level == 0): ?><li <?php if($step == 3) { echo 'class="active"'; } ?>><a href="#upgrade" data-toggle="tab">Upgrade</a></li><?php endif; ?>
                            </ul>
                            <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader-home" alt="loader" />
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane <?php if(!$this->session->flashdata('msg_1') && $step != 2 && $step != 3 && $step != 4) { echo 'active'; } ?>" id="settings">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="title">
                                            <p>Keep updating your password and security credentials to secure your WorthAct account and to choose who may or may not see your posts, shares and other activities.</p>
                                            <div class="add_info">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="panel panel-flat">
                                                            <div class="panel-heading">
								<h5 class="panel-title">Update Password</h5>				
                                                            </div>
                                                            <div class="panel-body panel-privacy">
                                                                <form id="update_password">
                                                                    <div class="form-group">
                                                                        <label>Enter old password</label>
                                                                        <input type="password" name="pass" class="form-control">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Enter new password</label>
                                                                        <input type="password" name="new_pass" id="new_password" class="form-control">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Re-enter new password</label>
                                                                        <input type="password" name="re_pass" class="form-control">
                                                                    </div>
                                                                    <div class="form-action">
                                                                        <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                                                                        <button type="submit" data-ripple id="update-password" class="btn" data-toggle="tooltip" data-placement="bottom" title="Updating the password will logout from your current session.">Update</button>
                                                                    </div>
                                                                    <div id="form_alert" class="alert alert-danger" role="alert"></div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="panel panel-flat">
                                                            <div class="panel-heading">
                                                                <h5 class="panel-title">Update primary email</h5>	
                                                            </div>
                                                            <div class="panel-body panel-privacy">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group last">
                                                                            <div class="input-group" data-toggle="tooltip" data-placement="bottom" title="Updating email id will logout from your current session. You will have to validate the email id by clicking on the link which will be send to the mentioned email id.">
                                                                                <input type="email" id="new_email" class="form-control trans" placeholder="Enter email" value="<?= $this->info->email; ?>">
                                                                                <span class="input-group-btn"><button id="update-email" data-ripple class="trans btn btn-default" type="button">Update Email ID</button></span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="panel panel-flat">
                                                            <div class="panel-heading">
                                                                <h5 class="panel-title">Profile Picture</h5>	
                                                            </div>
                                                            <div class="panel-body panel-privacy">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <button data-ripple data-toggle="modal" data-target="#update_propic" class="btn btn_propic"><?= ($this->info->propic == '')? 'Add' : 'Update'; ?></button>
                                                                        <?php if($this->info->propic != '') : ?>
                                                                        <button data-ripple data-toggle="modal" data-target="#delete_propic" class="btn btn_propic">Delete</button>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="panel panel-flat">
                                                            <div class="panel-heading">
                                                                <h5 class="panel-title">Profile Banner</h5>	
                                                            </div>
                                                            <div class="panel-body panel-privacy">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <button data-ripple data-toggle="modal" data-target="#update_banner" class="btn btn_propic"><?= ($this->info->wall == '')? 'Add' : 'Update'; ?></button>
                                                                        <?php if($this->info->wall != '') : ?>
                                                                        <button data-ripple data-toggle="modal" data-target="#delete_banner" class="btn btn_propic">Delete</button>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="panel panel-flat panel-privacy">
                                                            <div class="panel-heading">
								<h5 class="panel-title"><?= ($this->info->type_id == 1)? 'Who can see your phone number?' : 'Who can see your tel number and fax?'; ?></h5>				
                                                            </div>
                                                            <div class="panel-body">				
                                                                <label class="radio-inline"><input <?php if($privacy->phone == 0) { echo 'checked="checked"'; } ?> class="privacy-item" value="0" name="phone" type="radio" data-type="phone"><i class="ion-earth"></i> Public</label>
                                                                <label class="radio-inline"><input <?php if($privacy->phone == 1) { echo 'checked="checked"'; } ?> class="privacy-item" value="1" name="phone" type="radio" data-type="phone"><i class="ion-person-stalker"></i> Connections</label>
                                                                <label class="radio-inline"><input <?php if($privacy->phone == 2) { echo 'checked="checked"'; } ?> class="privacy-item" value="2" name="phone" type="radio" data-type="phone"><i class="ion-locked"></i> Only Me</label>	
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <?php if($this->info->type_id == 1): ?>
                                                    <div class="col-sm-12">
                                                        <div class="panel panel-flat panel-privacy">
                                                            <div class="panel-heading">
								<h5 class="panel-title">Who can see your email ID?</h5>				
                                                            </div>
                                                            <div class="panel-body">				
                                                                <label class="radio-inline"><input <?php if($privacy->email == 0) { echo 'checked="checked"'; } ?> class="privacy-item" value="0" data-type="email" type="radio" name="email"><i class="ion-earth"></i> Public</label>
                                                                <label class="radio-inline"><input <?php if($privacy->email == 1) { echo 'checked="checked"'; } ?> class="privacy-item" value="1" data-type="email" type="radio" name="email"><i class="ion-person-stalker"></i> Connections</label>
                                                                <label class="radio-inline"><input <?php if($privacy->email == 2) { echo 'checked="checked"'; } ?> class="privacy-item" value="2" data-type="email" type="radio" name="email"><i class="ion-locked"></i> Only Me</label>	
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                    
                                                    <div class="col-sm-12">
                                                        <div class="panel panel-flat panel-privacy">
                                                            <div class="panel-heading">
								<h5 class="panel-title">Who can see your address?</h5>				
                                                            </div>
                                                            <div class="panel-body">				
                                                                <label class="radio-inline"><input <?php if($privacy->address == 0) { echo 'checked="checked"'; } ?> class="privacy-item" value="0" data-type="address" type="radio" name="address"><i class="ion-earth"></i> Public</label>
                                                                <label class="radio-inline"><input <?php if($privacy->address == 1) { echo 'checked="checked"'; } ?> class="privacy-item" value="1" data-type="address" type="radio" name="address"><i class="ion-person-stalker"></i> Connections</label>
                                                                <label class="radio-inline"><input <?php if($privacy->address == 2) { echo 'checked="checked"'; } ?> class="privacy-item" value="2" data-type="address" type="radio" name="address"><i class="ion-locked"></i> Only Me</label>	
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <?php if($this->info->type_id == 1): ?>
                                                    <div class="col-sm-12">
                                                        <div class="panel panel-flat panel-privacy">
                                                            <div class="panel-heading">
								<h5 class="panel-title">Who can see your date of birth?</h5>				
                                                            </div>
                                                            <div class="panel-body">				
                                                                <label class="radio-inline"><input <?php if($privacy->dob == 0) { echo 'checked="checked"'; } ?> class="privacy-item" value="0" data-type="dob" type="radio" name="dob"><i class="ion-earth"></i> Public</label>
                                                                <label class="radio-inline"><input <?php if($privacy->dob == 1) { echo 'checked="checked"'; } ?> class="privacy-item" value="1" data-type="dob" type="radio" name="dob"><i class="ion-person-stalker"></i> Connections</label>
                                                                <label class="radio-inline"><input <?php if($privacy->dob == 2) { echo 'checked="checked"'; } ?> class="privacy-item" value="2" data-type="dob" type="radio" name="dob"><i class="ion-locked"></i> Only Me</label>	
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                    
                                                    <div class="col-sm-12">
                                                        <div class="panel panel-flat panel-privacy">
                                                            <div class="panel-heading">
								<h5 class="panel-title">Who can see your social links?</h5>				
                                                            </div>
                                                            <div class="panel-body">				
                                                                <label class="radio-inline"><input <?php if($privacy->social == 0) { echo 'checked="checked"'; } ?> class="privacy-item" value="0" data-type="social" type="radio" name="social"><i class="ion-earth"></i> Public</label>
                                                                <label class="radio-inline"><input <?php if($privacy->social == 1) { echo 'checked="checked"'; } ?> class="privacy-item" value="1" data-type="social" type="radio" name="social"><i class="ion-person-stalker"></i> Connections</label>
                                                                <label class="radio-inline"><input <?php if($privacy->social == 2) { echo 'checked="checked"'; } ?> class="privacy-item" value="2" data-type="social" type="radio" name="social"><i class="ion-locked"></i> Only Me</label>	
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <?php if($this->info->type_id == 1): ?>
                                                    <div class="col-sm-12">
                                                        <div class="panel panel-flat panel-privacy">
                                                            <div class="panel-heading">
								<h5 class="panel-title">Deny people from sending you connection request?</h5>				
                                                            </div>
                                                            <div class="panel-body">
                                                                <label class="radio-inline"><input <?php if($privacy->connection_deny == 0) { echo 'checked="checked"'; } ?> class="privacy-item" value="0" data-type="connection_deny" type="radio" name="connection_deny">No</label>
                                                                <label class="radio-inline" data-toggle="tooltip" data-placement="top" title="People can still follow you and can get all your updates."><input <?php if($privacy->connection_deny == 1) { echo 'checked="checked"'; } ?> class="privacy-item" value="1" data-type="connection_deny" type="radio" name="connection_deny">Yes</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <?php if($privacy->connection_deny != 1): ?>
                                                    <div class="col-sm-12 conn_list">
                                                        <div class="panel panel-flat panel-privacy">
                                                            <div class="panel-heading">
								<h5 class="panel-title">Who can see your connection list?</h5>				
                                                            </div>
                                                            <div class="panel-body">				
                                                                <label class="radio-inline"><input <?php if($privacy->connection == 0) { echo 'checked="checked"'; } ?> class="privacy-item" value="0" data-type="connection" type="radio" name="conn"><i class="ion-earth"></i> Public</label>
                                                                <label class="radio-inline"><input <?php if($privacy->connection == 1) { echo 'checked="checked"'; } ?> class="privacy-item" value="1" data-type="connection" type="radio" name="conn"><i class="ion-person-stalker"></i> Connections</label>
                                                                <label class="radio-inline"><input <?php if($privacy->connection == 2) { echo 'checked="checked"'; } ?> class="privacy-item" value="2" data-type="connection" type="radio" name="conn"><i class="ion-locked"></i> Only Me</label>	
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php endif; endif; ?>
                                                    
                                                    <div class="col-sm-12">
                                                        <div class="panel panel-flat panel-privacy">
                                                            <div class="panel-heading">
								<h5 class="panel-title">Disable Job Portal?</h5>				
                                                            </div>
                                                            <div class="panel-body">				
                                                                <label class="radio-inline"><input <?php if($this->info->job == 0) { echo 'checked="checked"'; } ?> class="privacy-item" value="0" data-type="jobportal" type="radio" name="job"> Yes</label>
                                                                <label class="radio-inline"><input <?php if($this->info->job == 1) { echo 'checked="checked"'; } ?> class="privacy-item" value="1" data-type="jobportal" type="radio" name="job"> No</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                            
                            <div class="tab-pane <?php if($this->session->flashdata('msg_1') || $step == 2) { echo 'active'; } ?>" id="personal">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="title">
                                             <?php if ($this->session->userdata('user_type') == '1') : ?>
                                            <p>Update your personal information time to time. Keeping your profile lively may help you to create new connections creating more opportunities and possibilities.</p>
                                            <?php else : ?>
                                            <p>Update <?= $type_name; ?> information frequently. Keeping the profile live helps in finding more connections and partners, thereby creating more opportunities and possibilities.</p>
                                            <?php endif; ?>
                                        </div>
                                        <?php if ($this->session->userdata('user_type') == '1') : ?>
                                        <form id="update_user_info" class="add_info">
                                            <h6 class="form-wizard-title">
                                                <span class="form-wizard-count">1</span>Personal Info 
                                                <small class="display-block">Fill in all the required fields to update them.</small>
                                            </h6>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>First Name</label>
                                                        <input type="text" name="fname" class="form-control" value="<?= $info->firstname ?>" placeholder="Enter your first name">
                                                    </div>
                                                </div>

                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Last Name</label>
                                                        <input type="text" name="lname" class="form-control" value="<?= $info->lastname ?>" placeholder="Enter your last name">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group gender_box">
                                                        <label>Gender</label>
                                                        <select name="gender" class="form-control gender-select">
                                                            <option <?php if($info->gender == 1) { echo 'selected'; } ?> value="1">Male</option>
                                                            <option <?php if($info->gender == 2) { echo 'selected'; } ?> value="2">Female</option>
                                                        </select>
                                                    </div>    
                                                </div>
                            
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Mobile</label>
                                                        <input type="text" name="mobile" value="<?= $info->mobile ?>" placeholder="Enter your mobile number" class="form-control">
                                                    </div>    
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Profession</label>
                                                        <input value="<?= $info->profession ?>" type="text" name="prof" placeholder="What is your profession" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <input type="text" name="address" class="form-control" value="<?= $info->address ?>" placeholder="Enter your address">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>City</label>
                                                        <input type="text" name="city" value="<?= $info->city ?>" class="form-control" placeholder="Enter your city name">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>State</label>
                                                        <input type="text" name="state" value="<?= $info->state ?>" class="form-control" placeholder="Enter your state">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group country_box">
                                                        <label>Country</label>
                                                        <select name="country" class="form-control country-select">
                                                            <?php foreach ($countries as $country) { ?>
                                                            <option <?php if($info->country == $country->country_code) { echo 'selected'; } ?> value="<?php echo $country->country_code; ?>"><?php echo $country->country_name; ?></option>
                                                            <?php } ?> 
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <h6 class="form-wizard-title two">
                                                <span class="form-wizard-count">2</span> Profile Info
                                                <small class="display-block">Fill in all the required fields to update them.</small>
                                            </h6>
                                            
                                            <div class="row">
                                                <div class="col-sm-12 select_box">
                                                    <div class="form-group">
                                                        <label>Area of interest</label>
                                                        <?php $stack = array_values($user_cat); ?>
                                                        <select data-placeholder="Select interest" multiple="multiple" name="interest[]" class="form-control select_area">
                                                            <?php foreach ($cat_main as $cat): ?>
                                                            <option <?php foreach ($stack as $value) { if($cat->id == $value->id) { echo 'selected="selected"'; } } ?> value="<?= $cat->id ?>"><?= $cat->category ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>    
                                            
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group hobbie_box">
                                                        <label>Hobbies</label>
                                                        <select value="<?= $info->hobbies ?>" data-placeholder="Enter hobbies" multiple="multiple" name="hobbies[]" class="form-control hobbies">
                                                            <?php if ($info->hobbies != '') : $tags = explode(',', $info->hobbies); foreach ($tags as $tag) : ?>
                                                                <option value="<?= $tag; ?>" selected="selected"><?= $tag; ?></option>
                                                            <?php endforeach; endif; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Describe about yourself</label>
                                                        <textarea class="form-control" name="desc" placeholder="Give a brief intro about yourself"><?= $info->about ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div id="date_box" class="form-group">
                                                        <label>Birthday</label>
                                                        <input type="text" value="<?= $info->birthday ?>" name="birthday" class="form-control" id="date_input_update" placeholder="When is your birthday" />
                                                    </div>
                                                </div>
                                            </div>    

                                            <div class="row" id="social_links">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Facebook</label>
                                                        <input type="text" value="<?= $info->facebook ?>" name="facebook" placeholder="Facebook link" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Linkedin</label>
                                                        <input type="text" value="<?= $info->linkedin ?>" name="linkedin" placeholder="Linkedin link" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Twitter</label>
                                                        <input type="text" value="<?= $info->twitter ?>" name="twitter" placeholder="Twitter link" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Google plus</label>
                                                        <input type="text" value="<?= $info->google_plus ?>" name="google" placeholder="Google plus link" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-actions">
                                                <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                                                <input class="btn btn-info" data-ripple id="basic-next" name="submit" value="Update" type="submit">
                                            </div>
                                        </form>
                                        <?php else: ?>
                                        <form id="update_org_info" class="add_info">
                                            <h6 class="form-wizard-title">
                                                <span class="form-wizard-count">1</span>Update <?= $type_name; ?> info
                                                <small class="display-block">Fill in all the required fields to update them.</small>
                                            </h6>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label><?= $type_name; ?> Name</label>
                                                        <input type="text" value="<?= $info->name; ?>" name="name" class="form-control" placeholder="Enter your <?= $type_name; ?> name">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label><?= $type_name; ?> Website</label>
                                                        <input type="text" value="<?= $info->website; ?>" name="website" class="form-control" placeholder="Enter your <?= $type_name; ?> website">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Tel</label>
                                                        <input type="text" value="<?= $info->tel; ?>" name="tel" class="form-control" placeholder="Enter tel">
                                                   </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Fax</label>
                                                        <input type="text" value="<?= $info->fax; ?>" name="fax" class="form-control" placeholder="Enter fax">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <input type="text" name="address" class="form-control" value="<?= $info->address; ?>" placeholder="Enter address">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>City</label>
                                                        <input type="text" value="<?= $info->city; ?>" name="city" class="form-control" placeholder="Enter city">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label>State</label>
                                                        <input type="text" value="<?= $info->state; ?>" name="state" class="form-control" placeholder="Enter state">
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group country_box">
                                                        <label>Country</label>
                                                        <select name="country" class="form-control country-select">
                                                            <?php foreach ($countries as $country) { ?>
                                                            <option <?php if($info->country == $country->country_code) { echo 'selected'; } ?> value="<?php echo $country->country_code; ?>"><?php echo $country->country_name; ?></option>
                                                            <?php } ?> 
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
       
                                            <h6 class="form-wizard-title two">
                                                <span class="form-wizard-count">2</span><?= $type_name; ?> Profile 
                                                <small class="display-block">Fill in all the required fields to update them.</small>
                                            </h6>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                     <div class="form-group select_box">
                                                        <label>Area of Function</label>
                                                        <?php $stack = array_values($user_cat); ?>
                                                        <select data-placeholder="Select interest" multiple="multiple" name="interest[]" class="form-control select_area">
                                                            <?php foreach ($cat_main as $cat): ?>
                                                            <option <?php foreach ($stack as $value) { if($cat->id == $value->id) { echo 'selected="selected"'; } } ?> value="<?= $cat->id ?>"><?= $cat->category ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Describe more about your <?= $type_name; ?></label>
                                                        <textarea name="about" class="form-control" placeholder="Give a brief intro about your <?= $type_name; ?>"><?= $info->about; ?></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row" id="social_links">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Facebook</label>
                                                        <input type="text" value="<?= $info->facebook; ?>" name="facebook" placeholder="Facebook link" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Linkedin</label>
                                                        <input type="text" value="<?= $info->linkedin; ?>" name="linkedin" placeholder="Linkedin link" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Twitter</label>
                                                                <input type="text" value="<?= $info->twitter; ?>" name="twitter" placeholder="Twitter link" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>Google plus</label>
                                                        <input type="text" value="<?= $info->google_plus; ?>" name="google" placeholder="Google plus link" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-actions">
                                                <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                                                <input class="btn btn-info" data-ripple id="basic-next" name="submit" value="Update" type="submit">
                                            </div>
                                        </form>
                                        <?php endif; ?>
                                        <div id="form_alert" class="alert alert-danger" role="alert"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <?php if($this->info->type_id == 1) : ?>
                            <div class="tab-pane <?php if($step == 4) { echo 'active'; } ?>" id="blocked_conn">
                                <div class="row">
                                    <div class="main col-sm-12"></div>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <?php if($this->info->user_level == 0): ?>
                            <div class="tab-pane <?php if($step == 3) { echo 'active'; } ?>" id="upgrade">
                                <?php if ($this->session->userdata('user_type') == '3') : ?>
                                <h5>Unlock and experience the full potential of Worthact by upgrading to a premium rank.</h5>
                                <h5 class="features">Features and Possibilities galore</h5>
                                <?php else : ?>
                                <h5>Lots of features and possibilities. Unlock and experience the full potential of Worthact.com by upgrading yourself to a premium member</h5>
                                <h5 class="features">Features</h5>
                                <?php endif; ?>
                                <div class="feature_box">
                                    <?php if ($this->session->userdata('user_type') != '3') : ?>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="box shadow">
                                                <img src="<?= base_url('assets/img/blog.png') ?>" alt="img" />
                                                <h5>Blogs</h5>
                                                <p>Unlimited access to blogs where you can create, share articles and engage in discussions with innovative opinions on relevant topics. Premium features include unlimited character support, more creative features and extra media support.</p>
                                            </div>
                                        </div>
                                        <?php if($this->session->userdata('timezone') != 'Asia/Calcutta' || $this->session->userdata('timezone') != 'Asia/Kolkata') { ?>
                                        <div class="col-sm-6">
                                            <div class="box shadow">
                                                <img src="<?= base_url('assets/img/job.png') ?>" alt="img" />
                                                <h5>Jobs</h5>
                                                <p>Expand your chances to stand out from the crowd with unlimited profile reach! Post details on this portal with all relative information and reduce the gap between Industries and Industry needed resources.</p>
                                            </div>
                                        </div>
                                        <?php } else { ?>
                                        <div class="col-sm-6">
                                            <div class="box shadow">
                                                <img src="<?= base_url('assets/img/gift.png') ?>" alt="img" />
                                                <h5>Offers</h5>
                                                <p>Achance to participate in an unbelievable offer where you win state-of-the-art, stunning prizes just by doing a few good deeds for the Planet and Environment. Upgrade, win and be blessed..!!</p>
                                            </div>
                                        </div>
                                        <?php } ?>
                                        <div class="col-sm-6">
                                            <div class="box shadow">
                                                <img src="<?= base_url('assets/img/team.png') ?>" alt="img" />
                                                <h5>Groups</h5>
                                                <p>Unlimited access to blogs where you can create, share articles and engage in discussions with innovative opinions on relevant topics. Premium features include unlimited character support, more creative features and extra media support.</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="box shadow">
                                                <img src="<?= base_url('assets/img/need.png') ?>" alt="img" />
                                                <h5>Partners for a reason</h5>
                                                <p>You become a valued partner of Worthact in our mission to save the Earth from it's present state of despair. Selecting more topics from initiatives and instigating more worthy actions administers extra energy and vigor to the environment, the planet and it's occupants. You become a healer...!!</p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php else : ?>
                                    <div class="row">
                                        <div class="col-sm-<?= ($this->session->userdata('timezone') != 'Asia/Calcutta' || $this->session->userdata('timezone') != 'Asia/Kolkata')? '6' : '12'; ?>">
                                            <div class="box shadow box_group">
                                                <img src="<?= base_url('assets/img/team.png') ?>" alt="img" />
                                                <h5>CSR</h5>
                                                <p>Invaluable suggestions and directions to incorporate People and Planet along with Profits, and assessing environmental impact and green policies, which in turn increases business value and reputation.</p>
                                            </div>
                                        </div>
                                        <?php if($this->session->userdata('timezone') != 'Asia/Calcutta' || $this->session->userdata('timezone') != 'Asia/Kolkata') { ?>
                                        <div class="col-sm-6">
                                            <div class="box shadow box_group">
                                                <img src="<?= base_url('assets/img/job.png') ?>" alt="img" />
                                                <h5>Jobs</h5>
                                                <p>Your chances to land the right recruit are manifold, with access to an ever increasing database of aspirants. Post your requirements and browse available resources to engage the perfect candidate.</p>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="box shadow box_group">
                                                <img src="<?= base_url('assets/img/social.png') ?>" alt="img" style="width: 125px;" />
                                                <h5>Social Media Exposure</h5>
                                                <p>Your worthy actions and good deeds as a company wiill be given maximum exposure through our pages in all social media sites kindling public interest and respectability.</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="box shadow box_group">
                                                <img src="<?= base_url('assets/img/blog.png') ?>" alt="img" />
                                                <h5>Blogs</h5>
                                                <p>Unlimited access to articles with chances to share write ups, have discussions on relevant topics, unlimited character support, more creative features and media support -- all in the premium package.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="box shadow box_group last">
                                                <img src="<?= base_url('assets/img/page.png') ?>" alt="img" />
                                                <h5>Free Ad Spaces</h5>
                                                <p>Worthact entitles free ad space to partner companies in the site at strategic positions for utmost notability. T&C apply.</p>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="box shadow box_group last">
                                                <img src="<?= base_url('assets/img/world.png') ?>" alt="img" />
                                                <h5>Betterment of the World</h5>
                                                <p>The best and the most valuable part - in fellowship with Worthact, you are getting to play a very vital role in revitalizing and rejuvenating our only home - the Earth.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <div class="panel-flat shadow">
                                        <div class="panel-heading">
                                            <h5 class="panel-title">Upgrade Now</h5>
                                        </div>
                                        <div class="panel-body">
                                            <p class="c-font-lowercase">Well, what are you waiting for? Connect, grow and let's make it a better world!</p>
                                            <h5 class="up">Pay and Upgrade</h5>
                                            <div id="payment-form" data-type="<?= ($this->info->type_id == 3)? 'payment_comp' : 'payment_user'; ?>">
                                                <div class="input-group">
                                                    <?php if($this->session->userdata('timezone') == 'Asia/Calcutta' || $this->session->userdata('timezone') == 'Asia/Kolkata') { ?>
                                                        <form id="payment-india" method="post" action="<?= base_url('dashboard/ccAve_payment') ?>">
                                                            <span class="input-group-addon" id="sizing-addon1">&#8377;</span>
                                                            <?php if($this->info->type_id == 3): ?>
                                                            <input type="number" min="5000" max="10000" class="form-control trans" id="amount" name="amount" placeholder="&#8377;5000" required />
                                                            <?php else : ?>
                                                            <input type="number" min="650" max="10000" class="form-control trans" id="amount" name="amount" placeholder="&#8377;650" required />
                                                        </form>
                                                        <?php endif; } else { ?>
                                                        <span class="input-group-addon" id="sizing-addon1">$</span>
                                                        <?php if($this->info->type_id == 3): ?>
                                                            <input type="number" min="280" max="10000" class="form-control trans" id="amount" name="amount" placeholder="280" required />
                                                        <?php else : ?>
                                                            <input type="number" min="10" max="10000" class="form-control trans" id="amount" name="amount" placeholder="10" required />
                                                        <?php endif; ?>
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group">
                                                    <button data-ripple class="shadow pay btn">Pay Now</button>
                                                </div>
                                                <?= $this->session->flashdata('msg_amount'); ?>
                                                <?php if ($this->session->userdata('user_type') != '3') : ?>
                                                <h4 class="text-center or">OR</h4>
                                                <a class="plant_tree">
                                                    <div class="box">
                                                        <div class="shadow">
                                                            <h5 class="up two">Free upgrade through SOS Actions</h5>
                                                            <img src="<?= base_url('assets/img/plant.png') ?>" alt="Plant Trees" />
                                                            <img src="<?= base_url('assets/img/organ.png') ?>" alt="Pledge your organs" />
                                                            <p>Plant 5 trees at a location of your choice and do a very worthy act by obtaining an Organ Donor card through Organ India, Parashar Foundation to become a premium member for free.</p>
                                                        </div>
                                                    </div>
                                                </a>
                                                <h4 class="text-center or two">OR</h4>
                                                <a class="refer" data-ripple data-toggle="modal" data-target="#offer_campaign">
                                                    <div class="box">
                                                        <div class="shadow">
                                                            <h5 class="up two">Free upgrade through Paid Referrals</h5>
                                                            <img src="<?= base_url('assets/img/network.png') ?>" alt="Refer members" />
                                                            <p>Auto upgrade to premium through successful reference and registration of 2 premium members each paying <?= ($this->session->userdata('timezone') == 'Asia/Calcutta' || $this->session->userdata('timezone') == 'Asia/Kolkata')? 'INR 650.' : '$10.'; ?></p>
                                                        </div>
                                                    </div>
                                                </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            
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
        
        <div id="unblock_conn" class="modal fade timeline_modal_form">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <form id="unblock_conn_form">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Unblock Connection</h4>
                        </div>
                        <div class="modal-body">						
                            <p>Are you sure you want to unblock this connection ?</p>
                            <input type="hidden" value="" id="unblock_conn_id" />
                            <input type="hidden" value="" id="unblock_conn_type" />
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
        
        <div class="modal fade" id="payinfo" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-sm">
                <div class="modal-content"> 
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Pay using</h4>
                    </div>
                    <div class="modal-body">
                        <div class="pay-buttons">
                            <div class="row">
                                <div class="col-sm-6">
                                    <form method="post" action="<?= base_url('dashboard/upgrade') ?>">
                                        <input type="hidden" class="form-control trans amt-paid" id="amount" name="amount" value="" />
                                        <div class="form-group">
                                            <button data-ripple type="submit" class="payment-box paypal shadow"><img src="<?= base_url('assets/img/logo_paypal.png')?>" /></button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-6">
                                    <form method="post" action="<?= base_url('dashboard/ccAve_payment_upgrade') ?>">
                                        <input type="hidden" class="amt-paid" id="amount" name="amount" value="" />
                                        <div class="form-group">
                                            <button data-ripple type="submit" class="payment-box ccavenue shadow"><img src="<?= base_url('assets/img/ccavenue.png')?>" /></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="add_listing" class="modal fade add_listing_two" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form class="add_post_form_two">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Set out your SOS</h4>
                        </div>
                        <div class="modal-body">
                            <h4 class="title_two">If you wish to upgrade to Premium using this option, 1) Plant 5 trees and 2) Express your consent to be an Organ donor.</h4>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="title" placeholder="Enter title">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea placeholder="Enter description" name="post_desc" class="form-control" id="post_desc"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6 country_box_two">
                                        <label>Country</label>
                                        <select data-placeholder="Select country" name="country" class="form-control country-select">
                                            <option></option>
                                            <?php foreach ($countries as $country) { ?>
                                                <option value="<?php echo $country->country_code; ?>"><?php echo $country->country_name; ?></option>
                                            <?php } ?> 
                                        </select>
                                    </div>
                                    <div class="col-sm-6 type_select_box">
                                        <label>Type</label>
                                        <select data-placeholder="Select type" class="form-control type_select" name="type" onchange="show_sos_desc(this.options[this.selectedIndex].value)">
                                            <option></option>
                                            <option value="1">Plant 5 trees</option>
                                            <option value="2">Organ Donor card</option>
                                        </select>
                                    </div>
                                </div>    
                            </div>
                            <div class="sos_type_info"></div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12 post_tags_box">
                                        <label>SOS Tags</label>
                                        <select data-placeholder="Enter tags" multiple="multiple" name="tags[]" class="form-control post_tags"></select>   
                                    </div>
                                </div>    
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>Upload Images</label>
                                        <input type="file" id="post_img_up_two" name="post_img_up[]" multiple="multiple" />
                                        <p class="help-block">Only jpg | png formats allowed. Hold Ctrl to add multiple images.</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Upload Video</label>
                                        <input type="file" id="post_video_up_two" name="post_video_up" />
                                        <p class="help-block">Only mp4 format allowed.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-info" role="alert">
                                <div class="checkbox">
                                    <p>The Promoter reserves the authority to verify and determine the authenticity of all Worthy Actions and tasks mentioned in the Offer irrespective of time taken for the same.</p>
                                    <p>Promoter reserves the right to verify authenticity of tasks performed by the winner and to withhold or cancel the award if found to be not genuine.</p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                            <button class="btn btn-default" data-ripple data-dismiss="modal">Close</button>
                            <button type="submit" data-ripple class="btn btn-primary">Submit</button>
                            <div id="form_alert" class="alert alert-danger" role="alert"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <?php $this->load->view('dashboard/modals/propic'); ?>
        
        <div id="offer_campaign" class="modal fade" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title text-center">Referral Status</h4>
                    </div>
                    <div class="modal-body">
                        <div class="block shadow text-center">
                            <?php if($referral_status == 'nil') : ?>
                            <a id="referral_code" data-ripple>Generate Referral Code</a>
                            <span class="code_generated">Generated Referral Code</span>
                            <span id="print_code">------</span>
                            <p>Please share this code or the reference URL <span id="copy_code" data-clipboard-text="">www.worthact.com?r=<span></span></span></p>
                            <?php else : ?>
                            <span class="code_generated" style="display: inline-block">Generated Referral Code</span>
                            <span id="print_code"><?= $referral_status->ref_code; ?></span>
                            <p style="display: inline-block">Please share this code or the reference URL <span id="copy_code" data-clipboard-text="www.worthact.com?r=<?= $referral_status->ref_code; ?>">www.worthact.com?r=<?= $referral_status->ref_code; ?></span></p>
                            <?php endif; ?>
                        </div>
                        <div class="status text-center">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table">
                                        <tr>
                                            <td class="min top"><p>Free Members:</p></td>
                                            <td class="top"><p><span><?= $free_mems; ?></span></p></td>
                                        </tr>
                                        <tr>
                                            <td class="min top"><p>Premium Members:</p></td>
                                            <td class="top"><p><span><?= $pre_mems; ?></span></p></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div>

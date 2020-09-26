<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="add_listing" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="add_post_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Set out your SOS</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter title">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea placeholder="Enter description" name="post_desc" class="form-control" id="post_desc"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4 country-block">
                                <label>Country</label>
                                <select data-placeholder="Select country" name="country" class="form-control country-select">
                                    <option></option>
                                    <?php foreach ($countries as $country) { ?>
                                        <option value="<?php echo $country->country_code; ?>"><?php echo $country->country_name; ?></option>
                                    <?php } ?> 
                                </select>
                            </div>
                            <div class="col-sm-4 category-box">
                                <label>Category</label>
                                <select data-placeholder="Select category" name="interest" class="form-control select_post_area">
                                    <option></option>
                                    <?php foreach ($allcat as $cat): ?>
                                    <option value="<?= $cat->id ?>"><?= $cat->category ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div> 
                            <div class="col-sm-4 type-box">
                                <label>SOS Type</label>
                                <select data-placeholder="Select type" class="form-control type_select" name="type" onchange="show_support_checklist(this.options[this.selectedIndex].value)">
                                    <option></option>
                                    <option value="1">For those who seek</option>
                                    <option value="2">For paying it Forward</option>
                                </select>   
                            </div>
                        </div>    
                    </div> 
                    <div class="sos_type_info"></div>
                    <div class="form-group checklist">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>What are you looking for?</label>
                                <?php foreach ($supports as $support) : ?>
                                <div class="checkbox">
                                    <label>
                                        <input <?php if($support->id == 8) { echo 'onchange="action_Desc()" class="other_cb"'; } ?> type="checkbox" name="actions[]" value="<?= $support->id ?>"><?= $support->support_title ?>
                                    </label>
				</div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group action_desc">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>What kind of support do you need?</label>
                                <textarea placeholder="Enter action description" name="action_desc" class="form-control"></textarea>
                            </div>
                        </div>    
                    </div>    
                    <div class="form-group contact_info">
                        <div class="row">
                            <div class="col-sm-4">
                                <label>Phone <i class="ion-information-circled" data-toggle="tooltip" data-placement="bottom" title="Your number will be shared to the person who is taking an action for this SOS."></i></label>
                                <input type="text" class="form-control" name="phone" placeholder="Enter your phone">
                            </div>
                            <div class="col-sm-4">
                                <label>Email <i class="ion-information-circled" data-toggle="tooltip" data-placement="bottom" title="Your Email will be shared to the person who is taking an action for this SOS."></i></label>
                                <input type="text" class="form-control" name="email" placeholder="Enter your Email">
                            </div>
                            <div class="col-sm-4">
                                <label>Website / Link</label>
                                <input type="url" class="form-control" name="link" placeholder="Enter Website / Link for additional info">
                            </div>
                        </div>    
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>SOS Tags</label>
                                <select data-placeholder="Enter tags" multiple="multiple" name="tags[]" class="form-control post_tags"></select>   
                            </div>
                        </div>    
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Upload Images</label>
                                <input type="file" id="post_img_up" name="post_img_up[]" multiple="multiple" />
                                <p class="help-block">Only jpg | png formats allowed. Hold Ctrl to add multiple images.</p>
                            </div>
                            <div class="col-sm-6">
                                <label>Upload Video</label>
                                <input type="file" id="post_video_up" name="post_video_up" />
                                <p class="help-block">Only mp4 format allowed.</p>
                            </div>
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

<div id="post_update" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="update_post_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update SOS</h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                    <button data-ripple class="btn btn-default" data-dismiss="modal">Close</button>
                    <button data-ripple type="submit" class="btn btn-primary">Update</button>
                    <div id="form_alert_update" class="alert alert-danger" role="alert"></div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="post_delete" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="delete_post_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete SOS</h4>
                </div>
                <div class="modal-body">						
                    <p>Are you sure you want to delete this SOS?</p>
                    <input type="hidden" value="" id="post_id" />
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

<div id="modal_actions" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="add_post_action">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Confirm your WorthAct</h4>
                </div>  
                <div class="modal-body">
                    <p>You have opted in to supporting <strong id="name-txt"></strong> by <strong id="cause-txt"></strong></p>
                    <div class="alert alert-info alert-styled-left">    
                        <span class="text-semibold">You will be able to communicate with the beneficiary once they accept the notification.</span>						
                    </div>
                    <div class="other-support-txt">
                        <h3>Your message to the Beneficiary</h3>
                        <p id="act"><span id="name"></span> is looking for: <span id="act_desc"></span></p>
                        <textarea id="post_action_desc" class="form-control custom-control input-xs"  placeholder="Describe in less than 100 words.."></textarea></span>
                    </div>
                    <div class="desclimer-area">
                        <h3>Disclaimer</h3>
                        <p>WorthAct is a platform we provide members to network, develop and work together for a change in this world. We only promote direct transactions between end users and are not liable for any kind of loss to either parties involved.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <input data-id="" type="hidden" value="" id="post_action_id" />
                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                    <button data-ripple class="btn btn-default" data-dismiss="modal">Close</button>
                    <button data-ripple class="btn btn-primary action-confirm-btn">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="offer_campaign" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">My Campaign</h4>
            </div>
            <div class="modal-body">
                <div class="block shadow text-center">
                    <?php if($referral_status == 'nil') : ?>
                    <a id="referral_code" data-ripple>Generate Referral Code</a>
                    <span class="code_generated">Generated Referral Code</span>
                    <span id="print_code">------</span>
                    <p>Please share this code or the reference URL <span id="copy_code" data-clipboard-text="">www.worthact.com?r=<span></span></span> while inviting your connections.</p>
                    <?php else : ?>
                    <span class="code_generated" style="display: inline-block">Generated Referral Code</span>
                    <span id="print_code"><?= $referral_status->ref_code; ?></span>
                    <p style="display: inline-block">Please share this code or the reference URL <span id="copy_code" data-clipboard-text="www.worthact.com?r=<?= $referral_status->ref_code; ?>">www.worthact.com?r=<?= $referral_status->ref_code; ?></span> while inviting your connections.</p>
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
                                <?php if($this->info->user_level != 0) : ?>
                                <tr>
                                    <td class="min top"><p>SOS Activities:</p></td>
                                    <td class="top"><p><span><?= $sos; ?></span></p></td>
                                </tr>
                                <tr>
                                    <td class="min top"><p>Website Usage:</p></td>
                                    <td class="top"><p><span><?= $usage; ?>%</span></p></td>
                                </tr>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                </div>
                <?php if($this->info->user_level != 0) : ?><a data-ripple class="sos" data-toggle="modal" data-target="#add_listing" href="">Upload SOS Activity</a><?php endif; ?>
            </div>
        </div>
    </div>    
</div>

<div id="add_listing" class="modal fade add_listing_one" data-backdrop="static" data-keyboard="false">
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
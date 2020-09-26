<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="form-group">
    <label>Title</label>
    <input type="text" class="form-control" value="<?= $ad->title ?>" name="title" placeholder="Enter title">
</div>
<div class="form-group">
    <label>Description</label>
    <textarea placeholder="Enter description" name="post_desc" class="form-control"><?= $ad->description ?></textarea>
</div>
<div class="form-group">
    <div class="row">
        <div class="col-sm-4 country-block">
            <label>Country</label>
            <select data-placeholder="Select country" name="country" class="form-control country-select">
                <option></option>
                <?php foreach ($countries as $country) { ?>
                <option value="<?php echo $country->country_code; ?>" <?php if($country->country_code == $ad->country_code) { echo "selected='selected'"; }  ?>><?php echo $country->country_name; ?></option>
                <?php } ?> 
            </select>
        </div>
        <div class="col-sm-4 category-box">
            <label>Category</label>
            <select data-placeholder="Select category" name="interest" class="form-control select_post_area">
                <option></option>
                <?php foreach ($allcat as $cat): ?>
                <option value="<?= $cat->id ?>" <?php if($cat->id == $ad->cat_id) { echo "selected='selected'"; } ?>><?= $cat->category ?></option>
                <?php endforeach; ?>
            </select>
        </div> 
        <div class="col-sm-4 type-box">
            <label>SOS Type</label>
            <select data-placeholder="Select type" class="form-control type_select" name="type" onchange="show_support_checklist(this.options[this.selectedIndex].value)">
                <option></option>
                <option value="1" <?php if($ad->req_type == 1) { echo "selected='selected'"; }  ?>>For those who seek</option>
                <option value="2" <?php if($ad->req_type == 2) { echo "selected='selected'"; }  ?>>For paying it Forward</option>
            </select>   
        </div>
    </div>    
</div>
<div class="sos_type_info">
    <div class="alert alert-info form-group" role="alert">
        <?php if($ad->req_type == 1) : ?>
        <p>To announce a need or support - Posts/requests/articles by individuals/organisations who require assistance/advice/support from members/officials on any environment project(s) or socially relevant case(s).</p>
        <?php else : ?>
        <p>For those who perform worthy actions - Posts/articles by individuals/organisations who have successfully executed SOS actions on environment or social cases as a source of inspiration to others.</p>
        <?php endif; ?>
    </div>
</div>
<div class="form-group checklist" <?php if($ad->req_type == 1) { echo 'style="display:block"'; $actions = explode(',', $ad->ad_actions); } else { $actions = array(); } ?>>
    <div class="row">
        <div class="col-sm-12">
            <label>What are you looking for?</label>
            <?php foreach ($supports as $support) : ?>
            <div class="checkbox">
                <label>
                    <input <?php if($support->id == 8) { echo 'onchange="update_action_Desc()" class="other_cb"'; } ?> type="checkbox" name="actions[]" value="<?= $support->id ?>" <?php if(in_array($support->id, $actions)) { echo "checked='checked'"; } ?>><?= $support->support_title ?>
                </label>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<div class="form-group action_desc" <?php if(in_array(8, $actions)) { echo 'style="display:block"'; } ?>>
    <div class="row">
        <div class="col-sm-12">
            <label>What kind of support do you need?</label>
            <textarea placeholder="Enter action description" name="action_desc" class="form-control"><?= $ad->action_desc ?></textarea>
        </div>
    </div>    
</div>
<div class="form-group contact_info" <?php if($ad->req_type == 1) { echo 'style="display:block"'; } ?>>
    <div class="row">
        <div class="col-sm-4">
            <label>Phone <i class="ion-information-circled" data-toggle="tooltip" data-placement="bottom" title="Your number will be shared to the person who is taking an action for this SOS"></i></label>
            <input type="text" value="<?= $ad->phone ?>" class="form-control" name="phone" placeholder="Enter your phone">
        </div>
        <div class="col-sm-4">
            <label>Email <i class="ion-information-circled" data-toggle="tooltip" data-placement="bottom" title="Your Email will be shared to the person who is taking an action for this SOS"></i></label>
            <input type="text" value="<?= $ad->email ?>" class="form-control" name="email" placeholder="Enter your Email">
        </div>
        <div class="col-sm-4">
            <label>Website / Link</label>
            <input type="url" value="<?= $ad->link ?>" class="form-control" name="link" placeholder="Enter Website / Link for additional info">
        </div>
    </div>    
</div>
<div class="form-group">
    <div class="row">
        <div class="col-sm-12">
            <label>Post Tags</label>
            <select value="<?= $ad->tags ?>" data-placeholder="Enter tags" multiple="multiple" name="tags[]" class="form-control post_tags">
                <?php if ($ad->tags != '') : $tags = explode(',', $ad->tags); foreach ($tags as $tag) : ?>
                <option value="<?= $tag; ?>" selected="selected"><?= $tag; ?></option>
                <?php endforeach; endif; ?>
            </select>
        </div>
    </div>
</div>    
<div class="form-group">
    <div class="row">
        <div class="col-sm-6">
            <label>Upload Images</label>
            <input type="file" id="post_update_img_up" name="post_img_up[]" multiple="multiple" />
            <p class="help-block">Only jpg | png formats allowed. Add file to replace the previous uploaded file.</p>
        </div>
        <div class="col-sm-6">
            <label>Upload Video</label>
            <input type="file" id="post_update_video_up" name="post_video_up" />
            <p class="help-block">Only mp4 format allowed. Add file to replace the previous uploaded file.</p>
        </div>
    </div>
</div>
<input type="hidden" value="<?= $ad->id ?>" name="post_update_id" />
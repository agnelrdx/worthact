<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="timeline_grp_photo" class="modal fade timeline_modal_form" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="add_grp_photo">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Share Photos</h4>
                </div>
                <div class="modal-body">						
                    <div class="form-group">
                        <label>Caption</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter caption">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="desc" placeholder="Enter description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tags</label>
                        <select data-placeholder="Enter tags" multiple="multiple" name="tags[]" class="form-control grp_tags"></select>
                    </div>
                    <div class="form-group">
                        <label>Upload</label>
                        <input type="file" name="grp_photo_upload[]" id="grp_photo_upload" multiple="multiple">
                        <p class="help-block">Only jpg | png formats allowed. Hold Ctrl to add multiple images.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                    <input type="hidden" value="grp_photo" name="submit_type" />
                    <button data-ripple class="btn btn-default" data-dismiss="modal">Close</button>
                    <button data-ripple type="submit" class="btn btn-primary">Submit</button>
                    <div id="form_alert" class="alert alert-danger" role="alert"></div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="timeline_grp_video" class="modal fade timeline_modal_form" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="add_grp_video">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Share Video</h4>
                </div>
                <div class="modal-body">						
                    <div class="form-group">
                        <label>Caption</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter caption">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="desc" placeholder="Enter description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tags</label>
                        <select data-placeholder="Enter tags" multiple="multiple" name="tags[]" class="form-control grp_tags"></select>
                    </div>
                    <div class="form-group">
                        <label>Upload</label>
                        <input type="file" name="grp_video_upload" id="grp_video_upload">
                        <p class="help-block">Only mp4 format allowed.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                    <input type="hidden" value="grp_video" name="submit_type" />
                    <button data-ripple class="btn btn-default" data-dismiss="modal">Close</button>
                    <button data-ripple type="submit" class="btn btn-primary">Submit</button>
                    <div id="form_alert" class="alert alert-danger" role="alert"></div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="timeline_grp_file" class="modal fade timeline_modal_form" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="add_grp_file">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Share File</h4>
                </div>
                <div class="modal-body">						
                    <div class="form-group">
                        <label>Caption</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter caption">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="desc" placeholder="Enter description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tags</label>
                        <select data-placeholder="Enter tags" multiple="multiple" name="tags[]" class="form-control grp_tags"></select>
                    </div>
                    <div class="form-group">
                        <label>Upload</label>
                        <input type="file" name="grp_file_upload" id="grp_file_upload">
                        <p class="help-block">Only pdf | txt | doc| docx | xlsx | xls | csv | ppt | pptx formats allowed.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                    <input type="hidden" value="grp_file" name="submit_type" />
                    <button data-ripple class="btn btn-default" data-dismiss="modal">Close</button>
                    <button data-ripple type="submit" class="btn btn-primary">Submit</button>
                    <div id="form_alert" class="alert alert-danger" role="alert"></div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="timeline_grp_location" class="modal fade timeline_modal_form" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="add_grp_location">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Share Location</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Caption</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter caption">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="desc" placeholder="Enter description" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tags</label>
                        <select data-placeholder="Enter tags" multiple="multiple" name="tags[]" class="form-control grp_tags"></select>
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <div class="input-group">
                            <input type="text" name="map_input" class="form-control" id="map_input" placeholder="Enter location and click on search">
                            <span class="input-group-btn"><button id="search_map" class="btn btn-default" type="button"><i class="ion-android-search"></i></button></span>
			</div>
                    </div>
                    <input type="hidden" value="" id="map_cordinates" name="cordinates" />
                    <div class="form-group">
                        <div style="width: 100%; height: 200px;" id="map"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                    <input type="hidden" value="grp_location" name="submit_type" />
                    <button data-ripple class="btn btn-default" data-dismiss="modal">Close</button>
                    <button data-ripple type="submit" class="btn btn-primary">Submit</button>
                    <div id="form_alert" class="alert alert-danger" role="alert"></div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="delete_grp_post" class="modal fade timeline_modal_form" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="delete_grp_post_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Post</h4>
                </div>
                <div class="modal-body">						
                    <p>Are you sure you want to delete this post from the group ?</p>
                    <input type="hidden" value="" id="delete_group_id" />
                    <input type="hidden" value="" id="delete_post_id" />
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

<?php if($group->user_id != $this->session->userdata('user_id')) :  ?>
<div id="leave_group" class="modal fade timeline_modal_form" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="leave_grp_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Leave Group</h4>
                </div>
                <div class="modal-body">						
                    <p>Are you sure you want to leave this group ?</p>
                    <input type="hidden" value="" id="leave_group_id" />
                    <input type="hidden" value="" id="leave_group_type" />
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
<?php endif; ?>

<?php if($group->user_id == $this->session->userdata('user_id')) :  ?>
<div id="delete_group_mem" class="modal fade timeline_modal_form" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="delete_group_mem_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Remove Member</h4>
                </div>
                <div class="modal-body">						
                    <p>Are you sure you want to remove this member from the group ?</p>
                    <input type="hidden" value="" id="delete_group_mem_id" />
                    <input type="hidden" value="" id="delete_group_mem_type" />
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
<?php endif; ?>
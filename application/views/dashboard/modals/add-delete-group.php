<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="add_group" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="add_group_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create Group</h4>
                </div>
                <div class="modal-body">						
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter group title">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="desc" class="form-control" placeholder="Enter brief description about your group"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tags</label>
                        <select data-placeholder="Enter tags" multiple="multiple" name="tags[]" class="form-control group_tags"></select>
                    </div>
                    <div class="form-group">
                        <label>Add Banner image</label>
                        <input type="file" name="group_upload" id="group_upload">
                        <p class="help-block">Only jpg | png formats allowed.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                    <button data-ripple class="btn btn-default" data-dismiss="modal">Close</button>
                    <button data-ripple type="submit" class="btn btn-primary">Submit</button>
                    <div id="form_alert" class="alert alert-danger" role="alert"></div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="update_group" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="update_group_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Group</h4>
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

<div id="delete_group" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="delete_group_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Group</h4>
                </div>
                <div class="modal-body">						
                    <p>Are you sure you want to delete this group ?</p>
                    <input type="hidden" value="" id="delete_group_id" />
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

<div id="invite_grp_mem" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="invite_grp_mem_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Invite your Connections</h4>
                </div>
                <div class="modal-body"></div>
                <div class="modal-footer">
                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                    <button data-ripple class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button data-ripple type="submit" class="btn btn-primary">Invite</button>
                    <div class="alert alert-danger" role="alert"></div>
                </div>
            </form>
        </div>
    </div>
</div>

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
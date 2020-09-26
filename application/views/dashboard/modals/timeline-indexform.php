<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="timeline_photo" class="modal fade timeline_modal_form" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="add_timeline_photo">
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
                        <select data-placeholder="Enter tags" multiple="multiple" name="tags[]" class="form-control post_tags"></select>
                    </div>
                    <div class="form-group">
                        <label>Upload</label>
                        <input type="file" name="timeline_photo_upload[]" id="timeline_photo_upload" multiple="multiple">
                        <p class="help-block">Only jpg | png formats allowed. Hold Ctrl to add multiple images.</p>
                    </div>
                    <div class="form-group">
                        <label class="main">Select Privacy</label>
                        <div class="radio">
                            <label>
                                <input checked="checked" type="radio" name="privacy" value="0">
                                <i class="ion-earth"></i> Public
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="privacy" value="1">
                                <i class="ion-person-stalker"></i> Connections
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="privacy" value="2">
                                <i class="ion-locked"></i> Only Me
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                    <input type="hidden" value="timeline_photo" name="submit_type" />
                    <button data-ripple class="btn btn-default" data-dismiss="modal">Close</button>
                    <button data-ripple type="submit" class="btn btn-primary">Submit</button>
                    <div id="form_alert" class="alert alert-danger" role="alert"></div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="timeline_video" class="modal fade timeline_modal_form" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="add_timeline_video">
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
                        <select data-placeholder="Enter tags" multiple="multiple" name="tags[]" class="form-control post_tags"></select>
                    </div>
                    <div class="form-group">
                        <label>Upload</label>
                        <input type="file" name="timeline_video_upload" id="timeline_video_upload">
                        <p class="help-block">Only mp4 format allowed.</p>
                    </div>
                    <div class="form-group">
                        <label class="main">Select Privacy</label>
                        <div class="radio">
                            <label>
                                <input checked="checked" type="radio" name="privacy" value="0">
                                <i class="ion-earth"></i> Public
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="privacy" value="1">
                                <i class="ion-person-stalker"></i> Connections
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="privacy" value="2">
                                <i class="ion-locked"></i> Only Me
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                    <input type="hidden" value="timeline_video" name="submit_type" />
                    <button data-ripple class="btn btn-default" data-dismiss="modal">Close</button>
                    <button data-ripple type="submit" class="btn btn-primary">Submit</button>
                    <div id="form_alert" class="alert alert-danger" role="alert"></div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="timeline_file" class="modal fade timeline_modal_form" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="add_timeline_file">
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
                        <select data-placeholder="Enter tags" multiple="multiple" name="tags[]" class="form-control post_tags"></select>
                    </div>
                    <div class="form-group">
                        <label>Upload</label>
                        <input type="file" name="timeline_file_upload" id="timeline_file_upload">
                        <p class="help-block">Only pdf | txt | doc| docx | xlsx | xls | csv | ppt | pptx formats allowed.</p>
                    </div>
                    <div class="form-group">
                        <label class="main">Select Privacy</label>
                        <div class="radio">
                            <label>
                                <input checked="checked" type="radio" name="privacy" value="0">
                                <i class="ion-earth"></i> Public
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="privacy" value="1">
                                <i class="ion-person-stalker"></i> Connections
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="privacy" value="2">
                                <i class="ion-locked"></i> Only Me
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                    <input type="hidden" value="timeline_file" name="submit_type" />
                    <button data-ripple class="btn btn-default" data-dismiss="modal">Close</button>
                    <button data-ripple type="submit" class="btn btn-primary">Submit</button>
                    <div id="form_alert" class="alert alert-danger" role="alert"></div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="timeline_location" class="modal fade timeline_modal_form" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="add_timeline_location">
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
                        <select data-placeholder="Enter tags" multiple="multiple" name="tags[]" class="form-control post_tags"></select>
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <input type="text" name="map_input" class="form-control" id="map_input" placeholder="Enter location">
                    </div>
                    <input type="hidden" value="" id="map_cordinates" name="cordinates" />
                    <div class="form-group">
                        <div style="width: 100%; height: 200px;" id="map"></div>
                    </div>
                    <div class="form-group">
                        <label class="main">Select Privacy</label>
                        <div class="radio">
                            <label>
                                <input checked="checked" type="radio" name="privacy" value="0">
                                <i class="ion-earth"></i> Public
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="privacy" value="1">
                                <i class="ion-person-stalker"></i> Connections
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="privacy" value="2">
                                <i class="ion-locked"></i> Only Me
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                    <input type="hidden" value="timeline_location" name="submit_type" />
                    <button data-ripple class="btn btn-default" data-dismiss="modal">Close</button>
                    <button data-ripple type="submit" class="btn btn-primary">Submit</button>
                    <div id="form_alert" class="alert alert-danger" role="alert"></div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="timeline_privacy" class="modal fade timeline_modal_form" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="timeline_post_privacy">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Privacy</h4>
                </div>
                <div class="modal-body">						
                    <div class="form-group">
                        <label class="main">Change the privacy of the post.</label>
                        <div class="radio">
                            <label>
                                <input class="p_one" type="radio" name="privacy" value="0">
                                <i class="ion-earth"></i> Public
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input class="p_two" type="radio" name="privacy" value="1">
                                <i class="ion-person-stalker"></i> Connections
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input class="p_three" type="radio" name="privacy" value="2">
                                <i class="ion-locked"></i> Only Me
                            </label>
                        </div>
                        <input type="hidden" value="" name="privacy_post_id" id="privacy_post_id" />
                    </div>
                </div>
                <div class="modal-footer">
                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                    <button data-ripple class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button data-ripple type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="delete_timeline_post" class="modal fade timeline_modal_form" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="delete_timeline_post_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Post</h4>
                </div>
                <div class="modal-body">						
                    <p>Are you sure you want to delete this post from the timeline ?</p>
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

<div id="leave_conn" class="modal fade timeline_modal_form" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="leave_conn_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Remove Connection</h4>
                </div>
                <div class="modal-body">						
                    <p>Are you sure you want to remove this connection ?</p>
                    <input type="hidden" value="" id="leave_conn_id" />
                    <input type="hidden" value="" id="leave_conn_type" />
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

<div id="block_conn" class="modal fade timeline_modal_form" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="block_conn_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Block Connection</h4>
                </div>
                <div class="modal-body">						
                    <p>Are you sure you want to block this connection ?</p>
                    <input type="hidden" value="" id="block_conn_id" />
                    <input type="hidden" value="" id="block_conn_type" />
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

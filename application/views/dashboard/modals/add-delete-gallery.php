<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="add_gallery_image" class="modal fade timeline_modal_form" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="add_gallery_image_form">
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
                        <select data-placeholder="Enter tags" multiple="multiple" name="tags[]" class="form-control gallery_tags"></select>
                    </div>
                    <div class="form-group">
                        <label>Upload</label>
                        <input type="file" name="gallery_image_upload[]" id="gallery_image_upload" multiple="multiple">
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

<div id="delete_gallery_image" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="delete_gallery_image_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Image</h4>
                </div>
                <div class="modal-body">						
                    <p>Are you sure you want to delete this image ?</p>
                    <input type="hidden" value="" id="gallery_delete_img_id" />
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

<div id="add_gallery_video" class="modal fade timeline_modal_form" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="add_gallery_video_form">
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
                        <select data-placeholder="Enter tags" multiple="multiple" name="tags[]" class="form-control gallery_tags"></select>
                    </div>
                    <div class="form-group">
                        <label>Upload</label>
                        <input type="file" name="gallery_video_upload" id="gallery_video_upload">
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

<div id="delete_gallery_video" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="delete_gallery_video_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Video</h4>
                </div>
                <div class="modal-body">						
                    <p>Are you sure you want to delete this video ?</p>
                    <input type="hidden" value="" id="gallery_delete_vd_id" />
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

<div id="gallery_post" class="modal fade" data-backdrop="static" data-keyboard="false"></div>
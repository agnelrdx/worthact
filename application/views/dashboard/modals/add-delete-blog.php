<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="modal fade blog_add" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="add_blog_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Blog Post</h4>
                </div>
                <div class="modal-body">						
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" maxlength="150" placeholder="Enter blog title">
                    </div>
                    <div class="form-group">
                        <label>Content</label>
                        <textarea name="editor_blog" class="form-control" id="editor_blog"></textarea>
                        <?php if($this->info->user_level == 0) : ?><p class="text-muted char_limit">P.S You are on a free account. Your content will be limited to 700 letters.</p><?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label>Tags</label>
                        <select data-placeholder="Enter tags" multiple="multiple" name="tags[]" class="form-control blog_tags"></select>
                    </div>
                    <?php if($this->info->user_level != 0) : ?>
                    <div class="form-group">
                        <label>Add Banner image or video</label>
                        <input type="file" name="blog_upload" id="blog_upload">
                        <p class="help-block">Only jpg | png | mp4 formats allowed</p>
                    </div>
                    <?php endif; ?>
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
                    <button data-ripple class="btn btn-default" data-dismiss="modal">Close</button>
                    <button data-ripple type="submit" class="btn btn-primary">Submit</button>
                    <div id="form_alert" class="alert alert-danger" role="alert"></div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modal_update" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="update_blog_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Blog Post</h4>
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

<div id="modal_delete" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="delete_blog_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Blog Post</h4>
                </div>
                <div class="modal-body">						
                    <p>Are you sure you want to delete this blog post?</p>
                    <input type="hidden" value="" id="blog_delete_id" />
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
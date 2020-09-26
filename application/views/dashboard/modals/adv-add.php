<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="adv_add" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="adv_add_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Book your block</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group day_box">
                        <label>Days</label>
                        <select id="day-select" name="days" class="form-control">
                            <option value="">No. of days</option>
                            <?php for($i = 1; $i < 61; $i++) { ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php } ?> 
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="type">Type</label>
                        <label class="radio-inline">
                            <input class="type_button" type="radio" name="type" value="image">Single Image
                        </label>
                        <label class="radio-inline">
                            <input class="type_button" type="radio" name="type" value="slider">Slider
                        </label>
                        <label class="radio-inline">
                            <input class="type_button" type="radio" name="type" value="video">Video
                        </label>
                    </div>
                    <div class="form-group upload image">
                        <label>Upload Images</label>
                        <input type="file" id="adv_img_up" name="adv_img_up" />
                        <p class="help-block">Only jpg | png | gif formats allowed.</p>
                    </div>
                    <div class="form-group upload slider">
                        <label>Upload Images</label>
                        <input type="file" id="adv_slider_up" multiple="multiple" name="adv_slider_up[]" />
                        <p class="help-block">Only jpg | png | gif formats allowed. Hold Ctrl to add multiple images.</p>
                    </div>
                    <div class="form-group upload video">
                        <label>Upload Video</label>
                        <input type="file" id="adv_video_up" name="adv_video_up" />
                        <p class="help-block">Only mp4 format allowed. Video should not exceed more than 2 minutes.</p>
                    </div>
                    <div class="form-group">
                        <label>Heading</label>
                        <input type="text" class="form-control" name="heading" placeholder="Enter ad heading" />
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="adv_desc" placeholder="Write your ad description"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Call to action link</label>
                        <input type="url" class="form-control" name="url" placeholder="Enter link" />
                    </div>
                    <div class="form-group action_name video">
                        <label>Action Button Name</label>
                        <input type="text" class="form-control" name="action_name" placeholder="Enter action button name" />
                    </div>
                    <div class="form-group day_box">
                        <label>Additional comments</label>
                        <textarea class="form-control" name="desc" placeholder="Write your instruction to the dev team"></textarea>
                    </div>
                    <div class="form-group price">
                        <p>Total Amount</p>
                        <h2>$<span>333</span></h2>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="block_id" name="block_id" value="" />
                    <input type="hidden" id="page" name="page" value="" />
                    <input type="hidden" id="viewport" name="viewport" value="" />
                    <input type="hidden" id="country_code" name="country" value="" />
                    <input type="hidden" id="name" name="name" value="" />
                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                    <button class="btn btn-default" data-ripple data-dismiss="modal">Close</button>
                    <button type="submit" data-ripple class="btn btn-primary">Pay Now</button>
                    <div class="alert alert-danger" role="alert"></div>
                </div>
            </form>
        </div>
    </div>
</div>

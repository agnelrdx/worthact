<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="share_post" class="modal fade timeline_modal_form" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="share_post_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Share Post</h4>
                </div>
                <div class="modal-body">						
                    <p>Are you sure you want to share this to your timeline ?</p>
                    <div class="form-group">
                        <textarea id="share_post_title" placeholder="Type something about this..." class="form-control"></textarea>
                    </div>
                    <input type="hidden" value="" id="share_post_id" />
                    <input type="hidden" value="" id="share_post_type" />
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
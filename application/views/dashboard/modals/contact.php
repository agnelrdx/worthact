<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="modal fade" id="contact" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="contact_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Keep in touch</h4>
                </div>
                <div class="modal-body">
                    <p>Our helpline is always open to receive any inquiry or feedback. Please feel free to drop us an email from the form below and we will get back to you very soon.</p>
                    <div class="form-group">
                        <input name="sub" id="contact_sub" type="text" placeholder="Your Subject" class="form-control input-md trans"> 
                    </div>
                    <div class="form-group">
                        <textarea name="msg" id="contact_msg" placeholder="Write comment here ..." class="form-control input-md trans"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <img src="<?= base_url('assets/img/reload.svg'); ?>" alt="loader" id="loader" />
                    <button data-ripple type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button data-ripple type="submit" class="btn btn-primary submit">Send</button>
                </div>
                <div class="alert alert-danger" role="alert"></div>
            </form>
        </div>
    </div>
</div>
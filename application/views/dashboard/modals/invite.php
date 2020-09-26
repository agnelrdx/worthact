<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="modal fade" id="invite_email" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="invite_email_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Bring in Your Friends, Contacts</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Enter email id</label>
                        <select data-placeholder="Enter email ids" multiple="multiple" name="email[]" class="form-control invite_tags"></select>
                    </div>
                    <div class="form-group">
                        <label>Invite Type</label>
                        <select data-placeholder="Select Type" name="type" class="form-control invite_type" onchange="show_invite_box(this.options[this.selectedIndex].value)">
                            <option></option>
                            <option value="1">Default Template</option>
                            <option value="2">Personal Template</option>
                        </select>
                    </div>
                    <div class="preview_box">
                        <a class="trans fancybox" href="<?= base_url('assets/img/preview.jpg'); ?>">Show Preview</a>
                    </div>    
                    <div class="form-group invite_box">
                        <label>Message</label>
                        <textarea name="msg" class="form-control invite_msg" placeholder="Draft your personal invitation message here"></textarea>
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
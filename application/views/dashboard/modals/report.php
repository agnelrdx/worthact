<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="modal fade" id="report" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="report_form">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Report</h4>
                </div>
                <div class="modal-body">
                    <p>Found any issues ?? Report a problem or a bug now.</p>
                    <div class="form-group">
                        <input class="trans form-control" id="report_sub" type="text" name="sub" placeholder="Subject" />
                    </div>
                    <div class="form-group">
                        <textarea placeholder="Give a brief description of what you find wrong." id="report_msg" name="msg" class="form-control"></textarea>
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
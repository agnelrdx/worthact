<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="panel panel-flat invite-fb">
    <div class="panel-heading">
        <h5 class="panel-title">Spread the Word</h5>
    </div>
    <div class="panel-body">
        <a data-ripple class="btn-fb-invite" href="#" onclick="FacebookInviteFriends();"><i class="fa fa-facebook-official"></i> Send invite</a>
        <a data-ripple class="email" data-toggle="modal" data-target="#invite_email"><i class="fa fa-envelope"></i> Send Email</a>
    </div>
    
    <?php $this->load->view('dashboard/modals/invite'); ?>
</div>


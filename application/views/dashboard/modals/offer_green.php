<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div id="offer_green" class="modal fade offer_modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center">Join us and Win amazing prizes for the good deeds you do!</h4>
                <h4 class="text-center title-two">The best time to save our earth is now!!</h4>
            </div>
            <div class="modal-body">
                <p class="style">Give mother earth a break and we give you a wonderful family vacation!</p>
                <h4 class="text-center how">How?</h4>
                <ul>
                    <li>Only premium members will be eligible for the enrollment and the final draw.</li>
                    <li>Free members must qualify from the promotion 1 to enroll for the promotion 2 or simply subscribe to the premium membership.</li>
                    <li>Each member must enact one <a href="<?= base_url('dashboard/worthact_initiatives') ?>">SOS Action</a> of their interests each month.</li>
                </ul>
                <div class="offer_action text-center">
                    <?php if($this->info->user_level == 0) : ?>
                    <a data-ripple class="shadow" href="<?= base_url('dashboard/profile_update/3') ?>">Upgrade to Premium Member</a>
                    <?php else : if($enroll_status == 'nil' || $enroll_status->offer_green != 'enrolled') : ?>
                    <a class="offer_enroll" data-offer="2">Enroll Now</a>
                    <?php endif; endif; ?>
                </div>
                <div class="alert alert-success" role="alert"></div>
                <?php if($enroll_status != 'nil' && $enroll_status->offer_green == 'enrolled'): ?>
                <div class="alert alert-success" style="display: block" role="alert">You have successfully enrolled to this offer.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>    
</div>
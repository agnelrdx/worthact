<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container user-accounts">
    <div class="row">
        <div class="col-sm-6 col-left">
            <div class="caption-div">
                <h2 class="text-normal text-size-5 margin-bottom-35">A world full of love, care n compassion.</h2>
                <h2 class="text-normal text-size-5 margin-bottom-35">It starts from me and you.</h2>
                <h1 class="title-special text-size-12">Let us make this world wonderful....</h1>
            </div>
            <div class="payment-div">
                <div id="payment-form" data-type="<?= ($this->info->type_id == 3)? 'payment_comp' : 'payment_user'; ?>">
                    <div class="input-group">
                        <?php if($this->session->userdata('timezone') == 'Asia/Calcutta' || $this->session->userdata('timezone') == 'Asia/Kolkata') { ?>
                            <form id="payment-india" method="post" action="<?= base_url('dashboard/ccAve_payment') ?>">
                                <span class="input-group-addon" id="sizing-addon1">&#8377;</span>
                                <?php if($this->info->type_id == 3): ?>
                                <input type="number" min="5000" max="10000" class="form-control trans" id="amount" name="amount" placeholder="&#8377;5000" required />
                                <?php else : ?>
                                <input type="number" min="650" max="10000" class="form-control trans" id="amount" name="amount" placeholder="&#8377;650" required />
                            </form>    
                            <?php endif; } else { ?>
                            <span class="input-group-addon" id="sizing-addon1">$</span>
                            <?php if($this->info->type_id == 3): ?>
                                <input type="number" min="280" max="10000" class="form-control trans" id="amount" name="amount" placeholder="280" required />
                            <?php else : ?>
                                <input type="number" min="10" max="10000" class="form-control trans" id="amount" name="amount" placeholder="10" required />
                            <?php endif; ?>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <button data-ripple class="shadow pay btn">Pay & Support</button>
                    </div>
                    <p><a onclick="account_warning_message()">Skip and proceed</a></p>
                    <?= $this->session->flashdata('msg'); ?>
                </div>
                <p id="payfaq"><a class="trans" href="<?=base_url('dashboard/payment_faq')?>">Payment FAQs</a></p>
            </div>
        </div>
        <div class="col-sm-6 col-right">
            <div class="video-div">
                <video width="640" height="360" id="player1" preload="none">
                    <source type="video/youtube" src="https://www.youtube.com/watch?v=Y2Uthq_0Iv4" />
                </video>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="payinfo" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content"> 
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Pay using</h4>
            </div>
            <div class="modal-body">
                <div class="pay-buttons">
                    <div class="row">
                        <div class="col-sm-6">
                            <form method="post" action="<?= base_url('dashboard/payment') ?>">
                                <input type="hidden" class="form-control trans amt-paid" id="amount" name="amount" value="" />
                                <div class="form-group">
                                    <button data-ripple type="submit" class="payment-box paypal shadow"><img src="<?= base_url('assets/img/logo_paypal.png')?>" /></button>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-6">
                            <form method="post" action="<?= base_url('dashboard/ccAve_payment') ?>">
                                <input type="hidden" class="amt-paid" id="amount" name="amount" value="" />
                                <div class="form-group">
                                    <button data-ripple type="submit" class="payment-box ccavenue shadow"><img src="<?= base_url('assets/img/ccavenue.png')?>" /></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

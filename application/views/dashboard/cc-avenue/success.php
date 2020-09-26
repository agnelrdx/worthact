<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">
    <div class="row paypal-success">
        <div class="col-sm-12">
            <div class="thankyou">
                <?php if($order_status == 'Success') : ?><h1 class="title-special text-size-12">Thank You!</h1><?php endif; ?>
                <h2 class="text-normal text-size-5 margin-bottom-35">WorthAct appreciates your support.</h2>
                <h2 class="text-normal text-size-5 margin-bottom-35">Together for a better world.</h2>
            </div>

            <div class="payment-details col-sm-4 col-sm-offset-4 shadow">
                <div class="msg">
                    <p class="one">Dear Member,</p>
                    <?php if($order_status == 'Success') : ?>
                    <p>Your payment has been processed. You will receive a confirmation email once the transaction is complete.</p>
                    <?php else : ?>
                    <p>Sorry, your payment is <?= strtolower($order_status); ?>. No charges were made. Please try again. We appreciate your support.</p>
                    <?php endif; ?>
                </div>
                <div class="transaction-detail shadow">
                    <span>Tracking ID : 
                        <strong><?php echo $tracking_id; ?></strong>
                    </span><br/>
                    <span>Amount Paid : 
                        <strong>&#8377; <?php echo $amount; ?></strong>
                    </span><br/>
                    <span>Payment Status : 
                        <strong><?php echo $order_status; ?></strong>
                    </span><br/>
                </div>
                <?php if($order_status == 'Success') : ?>
                <a class="shadow btn-proceed" href="<?php echo base_url('dashboard'); ?>">Proceed</a>
                <?php else : ?>
                <a class="shadow btn-proceed" href="<?php echo base_url('dashboard/profile_update/3#payment-form'); ?>">Retry</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">
    <div class="row paypal-success">
        <div class="col-sm-12">
            <div class="thankyou">
                <h1 class="title-special text-size-12">Success!</h1>
                <h2 class="text-normal text-size-5 margin-bottom-35">You have successfully booked your ad block.</h2>
            </div>

            <div class="payment-details col-sm-4 col-sm-offset-4 shadow">
                <div class="msg">
                    <p class="one">Dear Member,</p>
                    <p>Your payment has been processed. Our team will review your ad request and it will be published in 24hrs once approved. You will receive a confirmation email once the transaction is complete also when the ad is approved.</p>
                </div>
                <div class="transaction-detail shadow">
                    <span>Transaction ID : 
                        <strong><?php echo $this->input->post('txn_id'); ?></strong>
                    </span><br/>
                    <span>Amount Paid : 
                        <strong>$<?php echo $this->input->post('payment_gross') . ' ' . $this->input->post('mc_currency'); ?></strong>
                    </span><br/>
                    <span>Payment Status : 
                        <strong><?php echo $this->input->post('payment_status'); ?></strong>
                    </span><br/>
                </div>
                <a class="shadow btn-proceed" href="<?php echo base_url('dashboard'); ?>">Proceed</a>
            </div>
        </div>
    </div>
</div>

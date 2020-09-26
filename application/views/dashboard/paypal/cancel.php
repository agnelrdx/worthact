<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">
    <div class="row paypal-cancel">
        <div class="col-sm-12">
            <div class="oops">
                <h1 class="title-special text-size-12">Oops!</h1>
                <h2 class="text-normal text-size-5 margin-bottom-35">We are sorry! Your last transaction was canceled.</h2>
                <?php if($type == '') : ?>
                <a class="shadow btn-proceed" href="<?php echo base_url('dashboard/accounts'); ?>">Retry</a>
                <?php endif; if($type == 'upgrade') : ?>
                <a class="shadow btn-proceed" href="<?php echo base_url('dashboard/profile_update/3#payment-form'); ?>">Retry</a>
                <?php endif; if($type == 'adv') : $this->session->unset_userdata('adv_price'); $this->session->unset_userdata('adv_days_price'); $this->session->unset_userdata('adv_type_price'); $this->session->unset_userdata('block_id'); ?>
                <a class="shadow btn-proceed" href="<?php echo base_url('dashboard/create_advertise'); ?>">Retry</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

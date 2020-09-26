<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container about">	
    <div class="row content-div">
        <div class="bg_color clearfix">
            <div class="col-sm-12">
                <h2>WorthAct Premium Membership</h2>
                <?php if($this->session->userdata('timezone') == 'Asia/Kolkata' || $this->session->userdata('timezone') == 'Asia/Calcutta'): ?>
                <p>Registration and utilization of WorthAct platform is absolutely free. However, we provide option for an individual to become a premium member with a nominal one time subscription fee of INR650 and companies can subscribe the premium account with a fee of INR5000/year.</p>
                <?php else : ?>
                <p>Registration and utilization of WorthAct platform is absolutely free. However, we provide option for an individual to become a premium member with a nominal one time subscription fee of $10 or equivalent local currency. And companies can subscribe the premium account with a fee $280/year or equivalent local currency.</p>
                <?php endif; ?>
                <p>The WorthAct platform is designed exclusively with social and environmental upliftment in mind, premium membership is provided to recognize those who are out there to act on certain initiatives to bring a positive change in this world, with a very minimal amount.</p>
                <p>To such premium companies and individuals who believe in action than talks, we give the leverage of features such as free space for advertisements, free marketing through social media pages, writing blogs, worth chats, creation of groups for worthy actions, to participate in the campaigns and offers, public profile pages and more yet to come.</p>
                <p>Join our hands to make the world better again!</p>
                <div class="pm-member"><a data-ripple class="shadow" href="<?= base_url()?>">Register Now</a></div> 
            </div>
        </div>
    </div>
</div>
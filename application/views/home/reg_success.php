<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container content">
    <div class="row">
        <div class="col-md-6 left">
            <blockquote>
                <h2 class="quo">"Humans only have another 100 years on earth..."</h2>
                <footer><cite title="Stephen Hawking">Stephen Hawking</cite></footer>
            </blockquote>
            <h2>If everyone of us decides to act for sustainability, our planet Earth would survive...<span>ACT NOW</span></h2>
        </div>
        <div class="col col-md-4 right col-md-offset-2">
            <div class="login-block">
                <div class="card shadow">
                    <div class="validation-email text-center">
                        <!--<h3>Just one more step...</h3>
                        <p>The key to awesomeness is in your inbox. Simply click the verification link in the email we sent to:</p>
                        <p><span id="resend-id"><?= $this->session->userdata('register-email'); ?></span></p>
                        <div class="resend">
                            <a href="" id="resend-link-home">Re-send verification email</a>
                            <p>If you did not receive an email, please check your spam/junk folder or contact our support</p>
                        </div>-->
                        <h3>Thank you for registration</h3>
                        <p>You may please login to <span>"ACT NOW"</span></p>
                        <div class="resend">
                            <a href="<?= base_url('login') ?>">Login</a>
                        </div>
                    </div>
                </div>
                <p class="copy">&copy; <?= date('Y') ?> worthact.com. All rights reserved.</p>
            </div>
        </div>
    </div>
</div>
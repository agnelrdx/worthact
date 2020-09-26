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
                    <?php if($key != '') : ?>
                    <form id="resetpwd-form">
                        <h3 class="margin-bottom-25 text-center">Reset Password</h3>
                        <p><input type="password" class="trans" id="password" name="password" placeholder="Enter new password"  required /></p>
                        <p><input data-key="<?= $key; ?>" type="password" class="trans" id="password_re" name="password_re" placeholder="Re-enter new password"  required /></p>
                        <div class="form-group">
                            <button data-ripple type="submit" class="shadow">Submit</button>
                            <img src="<?= base_url('assets/img/reload-2.svg') ?>" id="loader" alt="loader" />
                        </div>
                        <div class="alert alert-danger" role="alert"></div>
                    </form>
                    <?php else : ?>
                    <form id="login-form">
                        <h3 class="margin-bottom-25 text-center">Log In</h3>
                        <p><input type="email" class="trans" id="login_email_box" name="email" placeholder="Email"  required /></p>
                        <p><input type="password" class="trans" id="login_pass_box" name="password" placeholder="Password"  required /></p>
                        <div class="inline-middle clearfix">
                            <div class="col col-xs-6 left">
                                <label for="remember" class="form-label">
                                    <input type="checkbox" class="checkbox" id="remember" name="remember" checked="checked" />
                                    <span>Stay signed in</span>
                                </label>
                            </div>
                            <div class="col col-xs-6 right">
                                <a href="" data-toggle="modal" data-target="#reset_pass">Forgot password?</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <button data-ripple type="submit" class="shadow">Log in</button>
                            <img src="<?= base_url('assets/img/reload-2.svg') ?>" id="loader" alt="loader" />
                        </div>
                        <p>New here? <a href="<?= base_url(); ?>">Create an account</a></p>
                        <div class="alert <?php if($status == '') { echo 'alert-danger'; } else { echo 'alert-success'; } ?>" <?php if($status == 'success') { echo 'style="display: block;"'; } ?> role="alert"><?php if($status == 'success') { echo 'Password successfully updated. Login now.'; } ?></div>
                        <?= $this->session->flashdata('msg'); ?>
                    </form>
                    <?php endif; ?>
                </div>
                <p class="copy">&copy; <?= date('Y') ?> worthact.com. All rights reserved.</p>
            </div>
        </div>
        <div class="modal fade" id="reset_pass" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="reset-form">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Reset Password</h4>
                        </div>
                        <div class="modal-body">
                            <label>Enter email id linked to your account.</label>
                            <input type="email" name="reset_email" id="reset-email" class="trans" placeholder="Email" />
                        </div>
                        <div class="modal-footer">
                            <img src="<?= base_url('assets/img/reload.svg'); ?>" alt="loader" id="img-loader" />
                            <button data-ripple type="button" class="btn btn-default trans" data-dismiss="modal">Close</button>
                            <button data-ripple type="submit" class="btn submit trans">Submit</button>
                        </div>
                        <div class="alert" role="alert"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
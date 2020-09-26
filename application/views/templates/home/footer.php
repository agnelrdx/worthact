<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
</div>
            <footer class="footer invert-colors">
		<div class="container">
                    <div class="row">
			<div class="col-sm-9">
                            <ul class="footer-nav">
                                <li>&copy; <?= date('Y') ?> All rights reserved.</li>
                                <li><a href="<?= base_url(); ?>" class="trans">Home</a></li>
                                <li><a href="<?= base_url('about'); ?>" class="trans">About</a></li>
                                <li><a onclick="careers()" class="trans">Careers</a></li>
                                <li><a href="<?= base_url('worthact_initiatives'); ?>" class="trans">WorthAct Initiatives</a></li>
                                <li><a href="<?= base_url('premium_membership'); ?>" class="trans">Payments</a></li>
                                <li><a href="" data-toggle="modal" data-target="#contact" class="trans">Contact Us</a></li>
                                <li><a href="<?= base_url('privacy_policy'); ?>" class="trans">Privacy Policy</a></li>
                                <li><a href="<?= base_url('terms_and_conditions'); ?>" class="trans">Terms & Conditions</a></li>
                            </ul>
			</div>
                        <div class="col-sm-3">
                            <ul class="social-icons">
                                <li><a href="https://www.facebook.com/worthactofficial/" class="fa fa-facebook trans" target="_blank"></a></li>
                                <li><a href="https://plus.google.com/+worthact" class="fa fa-google-plus trans" target="_blank"></a></li>
                                <li><a href="https://twitter.com/worthact" class="fa fa-twitter trans" target="_blank"></a></li>
                                <li><a href="https://www.linkedin.com/company/worthact" class="fa fa-linkedin trans" target="_blank"></a></li>
                                <li><a href="https://www.youtube.com/worthact" class="fa fa-youtube trans" target="_blank"></a></li>
                                <li><a href="https://www.instagram.com/worthact/" class="fa fa-instagram trans" target="_blank"></a></li>
                                <li><a href="http://blog.worthact.com/" class="fa fa-rss-square trans" target="_blank"></a></li>
                            </ul>
			</div>
                        
                    </div>
		</div>
            </footer>
            <div class="modal fade" id="reset_pass" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
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
            <div class="modal fade" id="contact" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="contactus">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title" id="myModalLabel">Contact Us</h4>
                            </div>
                            <div class="modal-body">
                                <?php if($this->session->userdata('timezone') == 'Asia/Kolkata' || $this->session->userdata('timezone') == 'Asia/Calcutta'): ?>
                                <div class="address text-center">
                                    <h4>Address</h4>
                                    <p>WorthACT Enterprise pvt. Ltd.,</p>
                                    <p>Sasthamangalam, Trivandrum - 695010</p>
                                    <p>Email: <a class="trans" href="mailto: getintouch@worthact.com">getintouch@worthact.com</a></p>
                                </div>
                                <?php endif; ?>
                                <p>Got any queries or comments? Write to us.</p>
                                <div class="form-group">
                                    <input class="trans form-control" id="contact_name" type="text" name="name" placeholder="Full Name" />
                                </div>
                                <div class="form-group">
                                    <input class="trans form-control" id="contact_email" type="email" name="email" placeholder="Email" />
                                </div>
                                <div class="form-group">
                                    <input class="trans form-control" id="contact_subject" type="text" name="subject" placeholder="Subject" />
                                </div>
                                <div class="form-group">
                                    <textarea placeholder="Message" id="contact_msg" name="msg" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <img src="<?= base_url('assets/img/reload.svg'); ?>" alt="loader" id="img-loader" />
                                <button data-ripple type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                <button data-ripple type="submit" class="btn btn-primary submit">Send</button>
                            </div>
                            <div class="alert alert-danger" role="alert"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php if(isset($url_js)) : foreach ($url_js as $url_scripts) { echo "<script src='$url_scripts' type='text/javascript'></script>"; } endif; ?>
        <script src="<?= base_url('assets/js/plugins.js'); ?>" type='text/javascript'></script>
        <script src="<?= base_url('assets/js/moment.js'); ?>" type='text/javascript'></script>
        <script src="<?= base_url('assets/js/moment-timezone-with-data.js'); ?>" type='text/javascript'></script>
        <script src="<?= base_url('assets/js/tzdetect.js'); ?>" type='text/javascript'></script>
        <script src="<?= base_url('assets/js/sweetalert2.js'); ?>" type='text/javascript'></script> 
        <?php if(isset($js)) : foreach ($js as $scripts) { echo "<script src='".base_url()."assets/js/$scripts'></script>"; } endif; ?>
        <script src="<?= base_url('assets/js/wa_custom.js'); ?>" type='text/javascript'></script> 
        <?php if(isset($customJs)) : ?>
        <script type="text/javascript">
            <?= $customJs; ?>
        </script>
        <?php endif; ?>
    </body>
</html>

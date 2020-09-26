<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
        
        </section>
        
        <!-- FOOTER -->
        <footer class="footer-container">
            <div class="container">
                <div class="row">
                    <div class="col-sm-9 clearfix">
                        <div class="footer-left pull-left">
                            <ul>
                                <li><span class="copyright">© <?= date('Y'); ?> WorthAct All Rights Reserved.</span></li>
                                <li><a href="<?= base_url('dashboard/about') ?>">About Us</a></li>
                                <li><a href="<?= base_url('dashboard/careers') ?>">Careers</a></li>
                                <li><a data-toggle="modal" data-target="#contact" href="#">Contact Us</a></li>
                                <li><a href="<?= base_url('dashboard/help') ?>">Help</a></li>
                                <li><a href="<?= base_url('dashboard/privacy_policy') ?>">Privacy Policy</a></li>
                                <li><a href="<?= base_url('dashboard/terms_and_conditions') ?>">Terms & Conditions</a></li>
                            </ul>
                        </div>
                        <div class="footer-left pull-left">
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
                <?php $this->load->view('dashboard/modals/contact'); ?>
                
                <?php $this->load->view('dashboard/modals/report'); ?>
            </div>
        </footer>
        
        <script src="<?= base_url('assets/js/dashboard_plugins.js'); ?>" type='text/javascript'></script>
        <?php if(isset($js)) : foreach ($js as $scripts) { echo "<script type='text/javascript' src='".base_url()."assets/js/$scripts'></script>"; } endif; ?>
        <script src="<?= base_url('assets/js/wa_custom.js'); ?>" type='text/javascript'></script>
        <?php if(isset($customJs)) : ?>
        <script type="text/javascript">
            <?= $customJs; ?>
        </script>
        <?php endif; ?>
        <?php if($this->uri->segment(2) != 'adv_success' && $this->uri->segment(2) != 'ccAve_payment_done' && $this->uri->segment(2) != 'payu_payment_done' && $this->uri->segment(2) != 'upgrade_success' && $this->uri->segment(2) != 'success' && $this->uri->segment(2) != 'cancel' && $this->uri->segment(2) != 'help' && $this->uri->segment(2) != 'payment_faq' && $this->uri->segment(2) != 'general_faq' && $this->info->is_complete > 0 && $this->uri->segment(2) != 'worthchat' && $this->info->type_id == 1 && !$this->agent->is_mobile()) : ?>
        <script type="text/javascript" src="/wa-live/arrowchat/external.php?type=djs" charset="utf-8"></script>
        <script type="text/javascript" src="/wa-live/arrowchat/external.php?type=js" charset="utf-8"></script>
        <?php endif; ?>
        <?php if($this->uri->segment(2) == 'accounts' || $this->uri->segment(2) == 'help' || $this->uri->segment(2) == 'payment_faq' || $this->uri->segment(2) == 'general_faq') {?>
        <script type='text/javascript'>
        (function(){ var widget_id = '8XJhmoyGH6';var d=document;var w=window;function l(){
        var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
        </script>
        <?php } ?>
    </body>
</html>

<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!doctype html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>WorthAct</title>

        <link rel="shortcut icon" href="<?= base_url('assets/img/favicon.png'); ?>" />
        <?php if (isset($url_css)) : foreach ($url_css as $url_styles) { echo "<link href='$url_styles' rel='stylesheet' type='text/css'>"; } endif; ?>
        <?php if(isset($url_js)) : foreach ($url_js as $url_scripts) { echo "<script src='$url_scripts' type='text/javascript'></script>"; } endif; ?>
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
        <?php if (isset($css)) : foreach ($css as $styles) { echo '<link href="' . base_url("assets/css/$styles") . '" rel="stylesheet" type="text/css">'; } endif; ?>
        <link rel="stylesheet" href="<?= base_url('assets/css/dashboard_plugins.css'); ?>" type='text/css'>
        <link rel="stylesheet" href="<?= base_url('assets/css/dashboard_custom.css'); ?>" type='text/css'>
        <?php if(isset($customCSS)) : ?>
        <style type="text/css">
            <?= $customCSS; ?>
        </style>
        <?php endif; ?>
        <script type="text/javascript">
            window.base_url = "<?= base_url() ?>";
        </script>
        <?php if($this->info->is_complete > 0 && $this->uri->segment(2) != 'help') : if($this->uri->segment(2) != 'csr' && $this->uri->segment(2) != '' && $this->uri->segment(2) != 'adv_success' && $this->uri->segment(2) != 'ccAve_payment_done' && $this->uri->segment(2) != 'payu_payment_done' && $this->uri->segment(2) != 'upgrade_success' && $this->uri->segment(2) != 'success' && $this->uri->segment(2) != 'cancel' && $this->uri->segment(2) != 'payment_faq' && $this->uri->segment(2) != 'general_faq' && $this->uri->segment(2) != 'about' && $this->uri->segment(2) != 'careers' && $this->uri->segment(2) != 'privacy_policy' && $this->uri->segment(2) != 'terms_and_conditions') : ?>
        <script src="https://connect.facebook.net/en_US/all.js"></script>
        <script>
            if (top.location!= self.location) {
                top.location = self.location
            }
            FB.init({
                appId:'220651215058434', cookie:true, status:true, xfbml:true
            });
            function FacebookInviteFriends() {
                FB.ui({ method: 'send',name: 'WorthAct - For a better world',link: 'https://worthact.com', description: 'A platform to network with noble individuals who can share and unveil the endless possibilities to make this world a better place again.', picture: base_url+'asset/img/logo-orange.png' });
            }
        </script>
        <?php endif; if($this->uri->segment(2) != 'adv_success' && $this->uri->segment(2) != 'ccAve_payment_done' && $this->uri->segment(2) != 'payu_payment_done' && $this->uri->segment(2) != 'upgrade_success' && $this->uri->segment(2) != 'success' && $this->uri->segment(2) != 'cancel' && $this->uri->segment(2) != 'help' && $this->uri->segment(2) != 'payment_faq' && $this->uri->segment(2) != 'general_faq' && $this->info->is_complete > 0 && $this->uri->segment(2) != 'worthchat' && $this->info->type_id == 1 && !$this->agent->is_mobile()): ?>
        <link type="text/css" rel="stylesheet" id="arrowchat_css" media="all" href="/wa-live/arrowchat/external.php?type=css" charset="utf-8" />
        <?php endif; endif; ?>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-99969913-1', 'auto');
            ga('send', 'pageview');
        </script>
        <script>
            (function(h,o,t,j,a,r){
                h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
                h._hjSettings={hjid:521185,hjsv:5};
                a=o.getElementsByTagName('head')[0];
                r=o.createElement('script');r.async=1;
                r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
                a.appendChild(r);
            })(window,document,'//static.hotjar.com/c/hotjar-','.js?sv=');
        </script>
    </head>

    <body class="material-menu" id="top">
        <?php if($this->info->email_valid == 0): ?>
        <div class="email_valid">
            Please verify your email id to complete the sign-up process..!! <a data-ripple id="resend-link-home">Click here</a>
        </div>
        <?php endif; ?>
        <header class="main-nav clearfix navbar-fixed-top <?= ($this->info->email_valid == 0)? 'fix_top' : '' ?>">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="navbar-left pull-left">
                            <div class="clearfix">
                                <div class="left-branding pull-left logo">
                                    <a href="<?= base_url('dashboard') ?>"><img src="<?= base_url('assets/img/logo-orange.png') ?>" alt="worthact" /></a>
                                </div>				
                            </div>
                        </div>
                        
                        <div class="navbar-right pull-right">
                            <div class="clearfix">
                                <ul class="pull-right top-right-icons">
                                    <?php if($this->info->is_complete > 0) : ?>
                                    <li class="txt-menu"><a <?php if ( $this->uri->uri_string() == 'dashboard' || strpos($this->uri->uri_string(), 'sos') || strpos($this->uri->uri_string(), 'worthact_initiatives') ) { echo 'class="active"'; } ?> href="<?= base_url('dashboard') ?>"><?= ($this->info->type_id == 3)? 'CSR' : 'Initiatives';  ?></a></li>
                                    <?php if($this->info->type_id == 3) :  ?>
                                    <li class="txt-menu"><a <?php if ( $this->uri->uri_string() == 'dashboard/initiatives' ) { echo 'class="active"'; } ?> href="<?= base_url('dashboard/initiatives') ?>">Initiatives</a></li>
                                    <?php else :  ?>
                                    <li class="txt-menu"><a <?php if ( $this->uri->uri_string() == 'dashboard/csr' ) { echo 'class="active"'; } ?> href="<?= base_url('dashboard/csr') ?>">CSR</a></li>
                                    <?php endif;  ?>
                                    <li class="txt-menu"><a <?php if ( $this->uri->uri_string() == 'dashboard/timeline' ) { echo 'class="active"'; } ?> href="<?= base_url('dashboard/timeline') ?>">Timeline</a></li>
                                    <li class="txt-menu"><a <?php if (strpos($this->uri->uri_string(), 'blog')) { echo 'class="active"'; } ?>href="<?= base_url('dashboard/blog') ?>">Blog</a></li>
                                    <?php if($this->info->job == 1) { ?><li class="txt-menu"><a <?php if ( $this->uri->uri_string() == 'dashboard/jobs' || strpos($this->uri->uri_string(), 'joblisting') || strpos($this->uri->uri_string(), 'cv') ) { echo 'class="active"'; } ?>href="<?= base_url('dashboard/jobs') ?>">Jobs</a></li><?php } ?>
                                    <?php if($this->info->type_id != 3 && ($this->session->userdata('timezone') == 'Asia/Calcutta' || $this->session->userdata('timezone') == 'Asia/Kolkata')) { ?><li class="txt-menu"><a <?php if ( $this->uri->uri_string() == 'dashboard/worthact_seso' ) { echo 'class="active"'; } ?> href="<?= base_url('dashboard/seso') ?>">SESO</a></li><?php } ?>
                                    <li class="search"><a <?php if ( $this->uri->uri_string() == 'dashboard/search' ) { echo 'class="active"'; } ?> href="<?= base_url('dashboard/search') ?>" title="Search"><i class="ion-android-search"></i></a></li>
                                    <?php if($this->info->type_id == 1) : ?><li class="worthchat"><a <?php if ( $this->uri->uri_string() == 'dashboard/worthchat' ) { echo 'class="active"'; } ?> href="<?= base_url('dashboard/worthchat') ?>" title="WorthChat"><i class="ion-android-chat"></i></a></li><?php endif; ?>
                                    <?php if($this->info->type_id == 1) :  ?>
                                    <li class="dropdown req_notifications">
                                        <a href="" class="btn-notification dropdown-toggle <?php if ( $this->uri->uri_string() == 'dashboard/requests' || $this->uri->uri_string() == 'dashboard/sent_requests' ) { echo 'active'; } ?>" data-toggle="dropdown" title="Connection Requests">
                                            <span class="bubble" <?php if($this->hook->check_req_notification_alert() > 0) { echo 'style="display: block"'; } ?>><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                                            <i class="ion-person-stalker"></i>
                                        </a>
                                        <div class="dropdown-menu">
                                            <?php $this->load->view('dashboard/request-block'); ?>
                                        </div>
                                    </li>
                                    <?php endif; ?>
                                    <li class="dropdown notifications">
                                        <a href="" class="btn-notification dropdown-toggle <?php if ( $this->uri->uri_string() == 'dashboard/notifications' || $this->uri->uri_string() == 'dashboard/user_notifications' ) { echo 'active'; } ?>" data-toggle="dropdown" title="Notifications">
                                            <span class="bubble" <?php if($this->hook->check_notification_alert() > 0) { echo 'style="display: block"'; } ?>><i class="fa fa-exclamation-circle" aria-hidden="true"></i></span>
                                            <i class="ion-android-notifications"></i>
                                        </a>
                                        <div class="dropdown-menu">
                                            <?php $this->load->view('dashboard/notification-block'); ?>
                                        </div>
                                    </li>
                                    <li>
                                        <button type="button" class="navbar-toggle dash-collapse" data-toggle="collapse" data-target="#dash-nav">
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>
                                            <span class="icon-bar"></span>                        
                                        </button>
                                    </li>
                                    <?php endif; ?>
                                    <li class="dropdown user-dropdown">
                                        <a href="" class="btn-user dropdown-toggle hidden-xs" data-toggle="dropdown" title="Profile">
                                            <img src="<?= base_url(($this->info->propic != '') ? 'assets/userdata/dashboard/propic/'.$this->info->propic : 'assets/img/'.$this->placeholder); ?>" class="user" alt=""/>
                                            <i class="ion-arrow-down-b"></i>
                                        </a>
                                        <div class="dropdown-menu clearfix">	
                                            <div class="dropdown-img text-center">
                                                <a href="<?= base_url('dashboard/profile/'.$this->session->userdata('user_id')) ?>">
                                                    <img src="<?= base_url(($this->info->propic != '') ? 'assets/userdata/dashboard/propic/'.$this->info->propic : 'assets/img/'.$this->placeholder); ?>" class="shadow" alt=""/>
                                                </a>    
                                            </div>
                                            <div class="dropdown-content">
                                                <?php if($this->info->is_complete < 1) : ?>
                                                <h5>Hi !</h5>
                                                <?php else : ?>
                                                <h5><?= ($this->session->userdata('user_type') == 1) ? ucfirst(strtolower($this->info->firstname)) . ' ' . ucfirst(strtolower($this->info->lastname)) : ucfirst(strtolower($this->info->name)); ?></h5>
                                                <?php endif; ?>
                                                <p><?= $this->info->email; ?></p>
                                                <p><a href="<?= base_url('dashboard/profile/'.$this->session->userdata('user_id')) ?>" class="first">My Profile</a> <a href="<?= base_url('dashboard/help') ?>">Help</a> <a class="last" data-toggle="modal" data-target="#report">Report</a></p>
                                            </div>
                                            <div class="dropdown-btn text-center clearfix">
                                                <?php if($this->info->is_complete > 0)  : ?>
                                                <a href="<?= base_url('dashboard/profile_update'); ?>" data-ripple class="pull-left btn btn-sm btn-info"><i class="ion-android-settings"></i> Settings</a>
                                                <?php endif; ?>
                                                <a id="logout" data-ripple class="pull-right btn btn-sm btn-info"><i class="ion-log-out"></i> Logout</a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="collapse navbar-collapse" id="dash-nav">
                            <ul class="nav navbar-nav primary-navigation">
                                <li><a href="<?= base_url('dashboard') ?>"><?= ($this->info->type_id == 3)? 'CSR' : 'Initiatives';  ?></a></li>
                                <?php if($this->info->type_id == 3) :  ?>
                                <li><a href="<?= base_url('dashboard/initiatives') ?>">Initiatives</a></li>
                                <?php else : ?>
                                <li><a href="<?= base_url('dashboard/csr') ?>">CSR</a></li>
                                <?php endif;  ?>
                                <li><a href="<?= base_url('dashboard/timeline') ?>">Timeline</a></li>
                                <li><a href="<?= base_url('dashboard/blog') ?>">Blog</a></li>
                                <?php if($this->info->job == 1) { ?><li><a href="<?= base_url('dashboard/jobs') ?>">Jobs</a></li><?php } ?>
                                <?php if($this->info->type_id != 3 && ($this->session->userdata('timezone') == 'Asia/Calcutta' || $this->session->userdata('timezone') == 'Asia/Kolkata')) { ?><li><a href="<?= base_url('dashboard/seso') ?>">SESO</a></li><?php } ?> 
                                <li><a href="<?= base_url('dashboard/profile/'.$this->session->userdata('user_id')) ?>">My Profile</a></li>
                                <li><a href="<?= base_url('dashboard/profile_update') ?>">Settings</a></li>
                                <li><a id="logout_m">Logout</a></li>
                            </ul>
                        </div>
                        <?php if($this->info->user_level == 0 && $this->info->is_complete > 0) : ?>
                        <a href="<?= base_url('dashboard/profile_update/3'); ?>">
                            <div class="upgrade_box" data-toggle="tooltip" data-placement="left" title="Upgrade to premium">
                                <img src="<?= base_url('assets/img/medal.png') ?>" alt="upgrade"/>
                            </div>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </header>
        
        <section class="main-container <?= ($this->info->email_valid == 0)? 'pad_fix' : '' ?>">

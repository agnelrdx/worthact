<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!doctype html>
<html lang="en">
    
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="keywords"                  content="<?= $keywords ?>"
        <meta name="description"               content="<?= $description ?>"
        <meta property="og:url"                content="http://worthact.com" />
        <meta property="og:type"               content="website" />
        <meta property="og:title"              content="For a better world" />
        <meta property="og:description"        content="A platform to network with noble individuals who can share and unveil the endless possibilities to make this world a better place again." />
        <meta property="og:image"              content="https://s27.postimg.org/mmb1xhamr/worthact.png" />
        <meta property="og:image:width"        content="450"/>
        <meta property="og:image:height"       content="298"/>
        <meta property="fb:app_id"             content="220651215058434" />
        <title><?= $title; ?></title>
        <link rel="shortcut icon" href="<?= base_url('assets/img/favicon.png'); ?>" />
        <?php if(isset($url_css)) : foreach ($url_css as $url_styles) { echo "<link href='$url_styles' rel='stylesheet' type='text/css'>"; } endif; ?>
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Cookie" rel="stylesheet">
        <?php if(isset($css)) : foreach ($css as $styles) { echo '<link href="' . base_url("assets/css/$styles") . '" rel="stylesheet" type="text/css">'; } endif; ?>
        <link rel="stylesheet" href="<?= base_url('assets/css/plugins.css'); ?>" type='text/css'>
        <link rel="stylesheet" href="<?= base_url('assets/css/wa_custom.css'); ?>" type='text/css'>
        <script type="text/javascript">
            window.base_url = "<?= base_url() ?>";
            
            /* Analytics */
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-99969913-1', 'auto');
            ga('send', 'pageview');
        </script>
        <script>
            !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
            n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
            document,'script','https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '1493822443972077');
            fbq('track', 'PageView');
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

    <body>
        
        <div class="main-container">
            <?php if(!$this->agent->is_mobile()) : ?>
            <ul class="cb-slideshow">
                <li><span></span></li>
                <li><span></span></li>
                <li><span></span></li>
                <li><span></span></li>
                <li><span></span></li>
                <li><span></span></li>
            </ul>
            <?php endif; if($this->uri->segment(1) == '') : ?>
            <?php endif; ?>
            <nav class="navbar navbar-inverse nav-overlay navbar-fixed-top">
                <div class="container-fluid">
                    <div class="navbar-header nav-head">
                        <?php if($this->uri->segment(1) != '') : ?>
                        <a class="mob-login-btn mob-reg-btn" data-ripple href="<?= base_url() ?>">Register</a>
                        <?php endif; ?>
                        <a class="mob-login-btn" data-ripple href="<?= base_url('login') ?>">Login</a>
                        <div class="logo col-xs-6">
                            <a href="<?= base_url(); ?>" style=""><img src="<?= base_url('assets/img/logo-orange.png'); ?>" alt="WorthAct" /></a>
                        </div>
                    </div>
                    <?php if($this->uri->segment(1) != 'login') : ?>
                    <div id="wa-nav">
                        <form id="login-header-form">    
                            <ul class="nav navbar-nav primary-navigation">
                                <li class="first">
                                    <a class="forgot_pass" href="" data-toggle="modal" data-target="#reset_pass">Forgot password?</a>
                                    <?php $links = array('terms_and_conditions','privacy_policy','login','about','worthact_initiatives', 'afforestation', 'animal_care', 'cancer_care','drought_resistance','eco-friendly_homes','organ_donation','prevent_pollution','rural_development','waste_management','preserve_water', 'women_child_welfare');
                                    if(in_array($this->uri->segment(1), $links)) : ?><a class="forgot_pass" href="<?= base_url(); ?>">Register Now</a><?php endif; ?>
                                </li>
                                <li class="form-group">
                                    <input type="email" class="trans" id="login_email" name="login_email" placeholder="Email"  required />
                                </li>
                                <li class="form-group">
                                    <input type="password" class="trans" id="login_pass" name="login_pass" placeholder="Password"  required />
                                </li>
                                <li class="form-group">
                                    <button data-ripple type="submit" class="shadow">Login</button>
                                    <img src="<?= base_url('assets/img/reload.svg') ?>" id="loader" alt="loader" />
                                </li>
                            </ul>
                            <div class="alert alert-danger" role="alert"></div>
                        </form>    
                    </div>
                    <?php endif; ?>        
                </div>
            </nav>

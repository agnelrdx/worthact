<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta property="og:url"                content="http://worthact.com" />
        <meta property="og:type"               content="website" />
        <meta property="og:title"              content="For a better world" />
        <meta property="og:description"        content="A platform to network with noble individuals who can share and unveil the endless possibilities to make this world a better place again." />
        <meta property="og:image"              content="https://s27.postimg.org/mmb1xhamr/worthact.png" />
        <meta property="og:image:width"        content="450"/>
        <meta property="og:image:height"       content="298"/>
        <meta property="fb:app_id"             content="220651215058434" />
        <title>WorthAct - DSA Report</title>
        <link rel="shortcut icon" href="<?= base_url('assets/img/favicon.png'); ?>" />
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Cookie" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url('assets/css/plugins.css'); ?>" type='text/css'>
        <link rel="stylesheet" href="<?= base_url('assets/css/editor.css'); ?>" type='text/css'>
        <link rel="stylesheet" href="<?= base_url('assets/css/wa_custom.css'); ?>" type='text/css'>
        <script type="text/javascript">
            window.base_url = "<?= base_url() ?>";
        </script>
    </head>

    <body>
        <div class="container mailer_template dsa">
            <div class="row">
                <div class="col-sm-12">
                    <a href="<?= base_url() ?>"><img class="logo" src="<?= base_url('assets/img/logo-bold.png'); ?>" alt="worthact" /></a>
                    <h1 class="text-center header">DSA Report</h1>
                </div>
            </div>
            <?php $id = ($this->session->userdata('user_id') != '') ? $this->session->userdata('user_id') : -999; $ids = array(1, 2, 3, 7, 8, 602); if (in_array($id, $ids)) : ?>
            <div class="row">
                <div class="col-sm-12">
                    <div class="outer shadow">
                        <div class="code">
                            <h4><span class="left">Referral Code :</span><span class="right">wa1pg7</span></h4>
                            <h4 class="none"><span class="left">Referral URL :</span><span class="right">www.worthact.com?r=wa1pg7</span></h4>
                        </div>
                        <div class="stat">
                            <h3>STATISTICS</h3>
                            <div>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Free Members</a></li>
                                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Premium Members</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade in active" id="home">
                                        <?php if(count($free_mems) > 0) : foreach ($free_mems as $mem) : ?>
                                        <div class="user shadow clearfix">
                                            <div class="propic">
                                                <img src="<?= ($mem->propic == '')? ($mem->type_id != 1)? base_url('assets/img/company_placeholder.png') : base_url('assets/img/user_placeholder.png') : base_url('assets/userdata/dashboard/propic/'.$mem->propic) ?>" alt="user" />
                                            </div>
                                            <div class="cont">
                                                <p>Email : <?= $mem->email ?></p>
                                                <p>Type : <?= ($mem->type_id != 1)? ($mem->type_id != 2)? 'Company' : 'Organization' : 'User'; ?></p>
                                                <p class="last">Date of Join : <?= $mem->date ?></p>
                                            </div>
                                        </div>
                                        <?php endforeach; else : ?>
                                        <div class="alert alert-danger" role="alert">No Free members joined.</div>
                                        <?php endif; ?>
                                    </div>
                                    <div role="tabpanel" class="tab-pane fade" id="profile">
                                        <?php if(count($pre_mems) > 0) : foreach ($pre_mems as $mem) : ?>
                                        <div class="user shadow clearfix">
                                            <div class="propic">
                                                <img src="<?= ($mem->propic == '')? ($mem->type_id != 1)? base_url('assets/img/company_placeholder.png') : base_url('assets/img/user_placeholder.png') : base_url('assets/userdata/dashboard/propic/'.$mem->propic) ?>" alt="user" />
                                            </div>
                                            <div class="cont">
                                                <p>Email : <?= $mem->email ?></p>
                                                <p>Type : <?= ($mem->type_id != 1)? ($mem->type_id != 2)? 'Company' : 'Organization' : 'User'; ?></p>
                                                <p class="last">Date of Join : <?= $mem->date ?></p>
                                            </div>
                                        </div>
                                        <?php endforeach; else : ?>
                                        <div class="alert alert-danger" role="alert">No Premium members joined.</div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php else : ?>
            <h3 class="text-center">You are not authorised to access this page. Please login to WorthACT <br />with the right credentials and try again.</h3>
            <a class="login shadow" data-ripple href="<?= base_url('login') ?>">Login Now</a>
            <?php endif; ?>
        </div>
    </body>
    
    <script src="<?= base_url('assets/js/plugins.js'); ?>" type='text/javascript'></script>
    <script src="<?= base_url('assets/js/sweetalert2.js'); ?>" type='text/javascript'></script>
    <script src="<?= base_url('assets/js/editor.js'); ?>" type='text/javascript'></script>
    <script src="<?= base_url('assets/js/wa_custom.js'); ?>" type='text/javascript'></script> 
</html>    
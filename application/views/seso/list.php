<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <title>:: SESO ShortList - WorthACT ::</title>
        <meta name="description" content="Double your chances and become a winner.">
        <meta name="keywords" content="offers,iphone,ps4,campaign,free,sos,worthact,win,prizes,promotion,limited,bumper,wow">
        <meta name="author" content="worthact">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta property="og:url"                content="http://worthact.com" />
        <meta property="og:type"               content="website" />
        <meta property="og:title"              content="For a better world" />
        <meta property="og:description"        content="A platform to network with noble individuals who can share and unveil the endless possibilities to make this world a better place again." />
        <meta property="og:image"              content="https://s27.postimg.org/mmb1xhamr/worthact.png" />
        <meta property="og:image:width"        content="450"/>
        <meta property="og:image:height"       content="298"/>
        <meta property="fb:app_id"             content="220651215058434" />
        <link rel="shortcut icon" href="<?= base_url('assets/img/favicon.png'); ?>" />
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,700,700i,900" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url('assets/css/plugins.css'); ?>" type='text/css'>
        <link rel="stylesheet" href="<?= base_url('assets/css/wa_custom.css'); ?>" type='text/css'>
        <script type="text/javascript">
            window.base_url = "<?= base_url() ?>";
        </script>
    </head>
    <body>
        <div class="container-fluid seso_list">
            <div class="row">
                <div class="col-sm-12">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a class="navbar-brand" href="<?= base_url() ?>"><img class="img-responsive" src="<?= base_url('assets/img/logo-bold.png') ?>" alt="worthact" /></a>
                            </div>

                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Group <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#" onclick="load_seso_grp(1)">Group 1</a></li>
                                            <li><a href="#" onclick="load_seso_grp(2)">Group 2</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="#">Shortlisted</a></li>
                                    <li><a href="#">Winners</a></li>
                                    <li><img id="load" class="img-responsive" src="<?= base_url('assets/img/reload.svg') ?>" alt="worthact" /></li>
                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <li><h4>SESO Judges Panel</h4></li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <div id="listing" class="row result">
                <div class="col-sm-12 box"></div>
            </div>
            <div id="essay_content" class="modal fade" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content"></div>
                </div>
            </div>
            <div id="drawing_content" class="modal fade" data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content"></div>
                </div>
            </div>
        </div>
        <script src="<?= base_url('assets/js/plugins.js'); ?>" type='text/javascript'></script>
        <script src="<?= base_url('assets/js/plugins.js'); ?>" type='text/javascript'></script>
        <script src="<?= base_url('assets/js/wa_custom.js'); ?>" type='text/javascript'></script>
        <script>
            $(document).ready(function() {
                $(".dropdown-toggle").dropdown();
            });
        </script>    
    </body>
</html>    
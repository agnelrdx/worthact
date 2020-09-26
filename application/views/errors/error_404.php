<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!doctype html>
<html lang="en">
    <head>
        <title>WorthAct - 404</title>
        <link rel="shortcut icon" href="<?= base_url('assets/img/favicon.png'); ?>" />
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>" type='text/css'>
        <link rel="stylesheet" href="<?= base_url('assets/css/font-awesome.min.css'); ?>" type='text/css'>
        <link rel="stylesheet" href="<?= base_url('assets/css/wa_custom.css'); ?>" type='text/css'>
        <script type="text/javascript">
            window.base_url = "<?= base_url() ?>";
        </script>
    </head>
    
    <body>
        <div class="container-fluid text-center page404">
            <img src="<?= base_url('assets/img/404.png'); ?>" class="error_img img-responsive" alt="">
            <h1>Woops. Looks like this page doesn't exist</h1>
            <span><a href="<?= base_url() ?>">Go back</a></span>
        </div>
    </body>
</html>

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
        <title>WorthAct - Mailer Template</title>
        <link rel="shortcut icon" href="<?= base_url('assets/img/favicon.png'); ?>" />
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Cookie" rel="stylesheet">
        <link rel="stylesheet" href="<?= base_url('assets/css/plugins.css'); ?>" type='text/css'>
        <link rel="stylesheet" href="<?= base_url('assets/css/editor.css'); ?>" type='text/css'>
        <link rel="stylesheet" href="<?= base_url('assets/css/wa_custom.css'); ?>" type='text/css'>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
        <script type="text/javascript">
            window.base_url = "<?= base_url() ?>";
        </script>
    </head>

    <body ng-app ng-init="name='Dear XYZ,'">
        <div class="container mailer_template">
            <div class="row">
                <div class="col-sm-12">
                    <a href="<?= base_url() ?>"><img class="logo" src="<?= base_url('assets/img/logo-bold.png'); ?>" alt="worthact" /></a>
                    <h1 class="text-center header">Mailer Template</h1>
                </div>
            </div>
            <?php $id = ($this->session->userdata('user_id') != '')? $this->session->userdata('user_id') : -999; $ids = array(1, 2, 3, 7, 8, 602); if(in_array($id, $ids)) : ?>
            <div class="row">
                <div class="col-sm-6">
                    <form id="mail_temp" class="shadow" method="post" action="<?= base_url('mailer/send_mail') ?>">
                        <div class="form-group">
                            <label>To Email ID</label>
                            <input name="to" type="email" class="form-control" placeholder="Enter Email ID" required="required">
                        </div>   
                        <div class="form-group">
                            <label>From Email ID</label>
                            <p><?php if($this->session->userdata('user_id') == 2) { echo 'manojs@worthact.com'; } else if($this->session->userdata('user_id') == 602) { echo 'rajeshkumar@worthact.com'; } else { echo $this->session->userdata('user_email'); } ?></p>
                        </div>
                        <div class="form-group">
                            <label>Subject</label>
                            <input name="subject" type="text" class="form-control" placeholder="Enter Subject" required="required">
                        </div>
                        <div class="form-group">
                            <label>Name</label>
                            <input name="name" type="text" class="form-control" placeholder="Enter Name" required="required" ng-model="name">
                        </div>
                        <div class="form-group msg_block">
                            <label>Message</label>
                            <div class="checkbox">
                                <label>
                                    <input value="comp" class="type" type="radio" name="type"> To Companies
                                </label>
                                <label>
                                    <input value="school" class="type" type="radio" name="type"> To Schools
                                </label>
                            </div>
                            <textarea name="msg" id="editor" class="form-control" placeholder="Enter your Message" required="required"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Regards Text</label>
                            <input name="regards" type="text" class="form-control" placeholder="Eg: Thanks & regards," required="required" ng-model="regards" />
                        </div>
                        <button type="submit" data-ripple class="btn btn-default shadow">Submit</button>
                        <?= $this->session->flashdata('msg'); ?>
                    </form>
                </div>
                <div class="col-sm-6 preview">
                    <div class="block">
                        <table border='0' cellspacing='0' cellpadding='0' align='center' data-module='header'>
                            <tbody>
                                <tr>
                                    <td height='150' style='background: rgba(64, 66, 87, 0.65) url(https://preview.ibb.co/fybvAv/philosophy_bg.jpg) 0 0 no-repeat; background-size: cover;'>
                                        <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='height:100%;background-color:rgba(64, 66, 87, 0.73);'>
                                            <tbody>
                                                <tr>
                                                    <td valign='center' data-bgcolor='Header'>
                                                        <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;font-size: 32px; color: #FFFFFF;'>
                                                            <tbody>
                                                                <tr>
                                                                    <td align='center'>
                                                                        <img height='55' src='<?= base_url('assets/img/logo-orange.png') ?>' border='0' style='display: block;' data-crop='false'>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>	
                                    </td>
                                </tr>
                                <tr style='background: #ececec;'>
                                    <td style='padding:20px 25px 20px' class='scale-center-both'>
                                        <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 15px;line-height: 24px;font-size: 14px;' ng-bind="name"></span>,</p>
                                        <style>#editor_msg p { font-family:Verdana,Georgia,Times,serif;margin:0 0 15px;line-height: 24px;font-size: 14px; } </style>
                                        <div style='font-family:Verdana,Georgia,Times,serif;margin:0 0 15px;line-height: 24px;font-size: 14px;' ng-bind="msg" id="editor_msg">
                                            <p>"A Business is an organisation or an economic system where consumers are supplied with goods and services for profit." Imagine if divinity is added to it in equal measure...</p>
                                            <p>Worthact's intention and purpose is to add that extra touch to organisations, institutions and individuals in making them go the extra mile by incorporating Corporate Social Responsibility and Worthy Actions to businesses and individuals respectively. Worthact Initiatives, of Worthact Enterprise Pvt Ltd is a platform designed exclusively to provide a corridor for companies, organisations and individuals to interact, instruct and exchange ideas and proposals to make our Earth a better place to live in.</p>
                                            <p>We are looking to embrace dignified and noble organisations as partners to play indispensable, crucial roles to introduce future generations to a superior, self-sufficient planet. Register with us as a Company to explore various Opportunities and Possibilities to extend support to our planet in revitalising and rejuvenating her resources.</p>
                                            <p>Sincerely hoping to partner with you on such a righteous cause. For further discussions and clarifications kindly grant us an audience out of your busy schedule as soon as possible. Meanwhile, also please find time to visit us at www.worthact.com to get the feel of Worthact.</p>
                                            <p>Anticipating an approval and looking forward to hear from you, with fondest regards.</p>
                                        </div>
                                        <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 15px;line-height: 24px;font-size: 14px;' ng-bind="regards"></p>
                                        <?php if($this->session->userdata('user_id') == 1) : ?>
                                        <div class='mn sig'>
                                            <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 19px;font-size: 14px;'><b>Manoj Nair</b></p>
                                            <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>Founder, WorthACT Initiatives</p>
                                            <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>Dubai, UAE | Trivandrum, India</p>
                                            <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>+971501974301, 00919656696590</p>
                                            <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>manojnair@worthact.com</p>
                                        </div>
                                        <?php endif; if($this->session->userdata('user_id') == 2) : ?>
                                        <div class='ms sig'>
                                            <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 19px;font-size: 14px;'><b>Manoj S</b></p>
                                            <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>GM - Operations</p>
                                            <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>Dubai, UAE | Trivandrum, India</p>
                                            <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>00919400997744</p>
                                            <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>manojs@worthact.com</p>
                                        </div>
                                        <?php endif; if($this->session->userdata('user_id') == 602) : ?>
                                        <div class='r sig'>
                                            <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 19px;font-size: 14px;'><b>Rajesh Kumar</b></p>
                                            <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>Senior Manager - Sales & Business Development</p>
                                            <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>Dubai, UAE | Trivandrum, India</p>
                                            <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>+91 9497730012</p>
                                            <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>rajeshkumar@worthact.com</p>
                                        </div>
                                        <?php endif; if($this->session->userdata('user_id') == 7 || $this->session->userdata('user_id') == 8) : ?>
                                        <div class='test sig'>
                                            <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 19px;font-size: 14px;'><b>Test Dummy</b></p>
                                            <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>Software Engineer</p>
                                            <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>Dubai, UAE | Trivandrum, India</p>
                                            <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>123</p>
                                            <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>bla@worthact.com</p>
                                        </div>
                                        <?php endif; ?>
                                        <a href='<?= base_url(); ?>' style='font-family:Verdana,Georgia,Times,serif;background-color:#fe5e3a;display:block;padding:10px 10px;margin:20px auto 5px;width:100%;max-width:125px;font-size:14px;color:#ffffff;text-decoration:none;border-radius:2px;text-align:center' target='_blank'>Visit Now</a>
                                    </td>
                                </tr>
                                <tr style='background: #ececec;'>
                                    <td align='center'>
                                        <div style='max-width:400px'>
                                            <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='<?= base_url('assets/img/facebook.png') ?>' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='<?= base_url('assets/img/google_plus.png') ?>' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://twitter.com/worthact'><img alt='twitter' src='<?= base_url('assets/img/twitter.png') ?>' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='<?= base_url('assets/img/linkedin.png') ?>' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='<?= base_url('assets/img/youtube.png') ?>' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.instagram.com/worthact'><img alt='instagram' src='<?= base_url('assets/img/instagram.png') ?>' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>  
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table border='0' cellpadding='0' cellspacing='0' align='center' style='width:100%;max-width:546px;margin-top: 10px;margin-bottom:50px'>
                            <tbody><tr>
                                    <td>
                                        <div style='color:#ababab;font-family:Verdana,Arial;font-size:12px;line-height:17px;text-align:center'>
                                            © All Rights Reserved 2017 <a href='http://www.worthact.com' style='border-bottom:dotted 1px #b3bac1;text-decoration:none;color:inherit' target='_blank' data-saferedirecturl='https://www.google.com/url?hl=en&amp;q=http://www.worthact.com&amp;source=gmail&amp;ust=1495540957205000&amp;usg=AFQjCNFqcl9n57SQncF8zPtE5ZJse6FJQg'>Team WorthAct</a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="dummy_text">
                    <div class="comp">
                        <p>Happy and proud to introduce WorthAct - an e-platform for environment protection and CSR.</p>
                        <p>"A Business is an organisation or an economic system where consumers are supplied with goods and services for profit." Imagine if divinity is added to it in equal measure...</p>
                        <p>Worthact's intention and purpose is to add that extra touch to organisations, institutions and individuals in making them go the extra mile by incorporating Corporate Social Responsibility and Worthy Actions to businesses and individuals respectively. Worthact Initiatives, of Worthact Enterprise Pvt Ltd is a platform designed exclusively to provide a corridor for companies, organisations and individuals to interact, instruct and exchange ideas and proposals to make our Earth a better place to live in.</p>
                        <p>We are looking to embrace dignified and noble organisations as partners to play indispensable, crucial roles to introduce future generations to a superior, self-sufficient planet. Register with us as a Company to explore various Opportunities and Possibilities to extend support to our planet in revitalising and rejuvenating her resources.</p>
                        <p>Sincerely hoping to partner with you on such a righteous cause. For further discussions and clarifications kindly grant us an audience out of your busy schedule as soon as possible. Meanwhile, also please find time to visit us at www.worthact.com to get the feel of Worthact.</p>
                        <p>Anticipating an approval and looking forward to hear from you, with fondest regards.</p>
                    </div>
                    <div class="school">
                        <p>We are happy and proud to introduce you to WorthAct, an online Global Platform to create awareness and instigate actions to build a better, healthier World and Environment.</p>
                        <p>We are on our first steps in our mission to mould a selfless world where humans co-exist with other beings in tune with the Nature and Planet. We believe “it is easier to build strong children than to repair broken men”. Children should be pioneers to a change for the better and hence we decided to launch WorthAct's  mission activities with our young friends.</p>
                        <p>Keeping that in mind, to instill in every young mind a love and care for the Environment, we have devised a Competition including Essay writing and Painting centered around topics related to Environment Protection and Eco-Friendly Lifestyle. The bonus part is that the Parents will indirectly take notice and do some introspection on the subject.</p>
                        <p>The Competition is online and we propose to include talented students from Class 9 to Class 12. Cash prizes will be awarded to Winners and participation certificates presented to all eligible entries. The School with most participation wins a trophy highlighting Eco-Friendly awareness promotion</p>
                        <p>We request you to partner with us in this noble mission and encourage as many students as possible to participate in this Competition from your esteemed Institution. More details can be had from www.worthact.com where each participant has to register and upload their entries. Special attention should be given in reading and understanding the Terms and Conditions for eligible participation in the Competition.</p>
                        <p>Let's join forces to present a better World, a superior existence to our progeny.</p>   
                    </div>
                </div>
            </div>
            <?php else : ?>
            <h3 class="text-center">You are not authorised to use the Mailer Template. Please login to WorthACT <br />with the right credentials and try again.</h3>
            <a class="login shadow" data-ripple href="<?= base_url('login') ?>">Login Now</a>
            <?php endif; ?>
        </div>
    </body>

    <script src="<?= base_url('assets/js/plugins.js'); ?>" type='text/javascript'></script>
    <script src="<?= base_url('assets/js/sweetalert2.js'); ?>" type='text/javascript'></script>
    <script src="<?= base_url('assets/js/editor.js'); ?>" type='text/javascript'></script>
    <script src="<?= base_url('assets/js/wa_custom.js'); ?>" type='text/javascript'></script> 
</html>    
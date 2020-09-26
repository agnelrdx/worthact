<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Email_m extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function account_register($email, $key, $type) {
        $msg_one = "<!doctype html>
                    <html xmlns='https://www.w3.org/1999/xhtml'>
                        <head>
                            <meta https-equiv='Content-Type' content='text/html; charset=UTF-8' />
                            <meta name='format-detection' content='telephone=no'> 
                            <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'>
                            <meta https-equiv='X-UA-Compatible' content='IE=EDGE' />
                            <title>WorthAct - Registration</title>
                            <style type='text/css'>
                                @media all and (max-width: 400px) {
                                    .feature-column { width:100% !important; display: block; }
                                    .feature-text { margin-bottom: 50px; }
                                }
                                @media all and (max-width: 500px) {
                                    .feature-column { padding: 0px 10px !important; }
                                    .width-500-100 { width: 100% !important; }
                                    .mbot-30 { margin-bottom: 30px !important; }
                                    .leftright-text { padding-right: 0px !important; padding-left: 0px !important; }
                                }
                            </style>
                        </head>
                        <body leftmargin='0' topmargin='0' marginwidth='0' marginheight='0' yahoo='fix' style='font-family: Verdana, Georgia, Times, serif; background-color:#FFFFFF; ' bgcolor='FFFFFF'>
                            <table width='100%' border='0' cellpadding='0' cellspacing='0' align='center'>
                                <tr>
                                    <td style='padding: 50px 0px 50px 0px;'>
                                        <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;min-width:320px;background-color: #FFFFFF;'>
                                            <tr>
                                                <td style='background-color: #404257'>
                                                    <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;'>
                                                        <tr>
                                                            <td style='padding: 15px 15px 0;'><img style='width: 150px;' src='".base_url('assets/img/logo-orange.png')."'></td>
                                                        </tr>
                                                        <tr>
                                                            <td align='center' style='padding:15px;'>
                                                                <div style='font-size:26px; color: #ffffff;line-height: 40px;'>Your first step to become the change is just a click away !  </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td align='center' style='padding: 5px 15px 40px;'>
                                                                <div style='font-size:18px;color: #ffffff;line-height: 25px;'>Activate your account and explore</div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style='padding:20px 20px 5px;border: 1px solid #DDD;border-top: none;'>
                                                    <table>
                                                        <tr>
                                                            <td><p style='margin-top:0px;margin-bottom: 10px; color: #666;font-size:16px;'>Dear Green Partner,</p></td>
                                                        </tr>
                                                        <tr>
                                                            <td><p style='line-height: 27px; color: #666; margin-top: 0;font-size:16px;margin-bottom:0'>Welcome to Worthact. Thank you for joining us as a noble associate in working towards the rejuvenation of our Planet. We are proud to connect with like minded and conscientious establishments like you to better the environment and society we live in. A warm welcome again, to spread the good spirit and initiate more worthy actions.</p></td>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <a href='".base_url('home/confirm_email/' . $key)."' style='background-color:#fe5e3a;display:block;padding: 15px 10px;margin:15px auto 20px;width:100%;max-width:125px;font-size:16px;color: #ffffff;text-decoration: none;border-radius:2px;text-align:center;' class=''>Get Started</a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style='padding: 10px 20px 20px;border: 1px solid #DDD;border-top: none;' align='center'>
                                                    <div style='display:inline;margin: 0 auto;'>
                                                        <h4 style='color: #6a6a6a; font-size: 16px;font-weight: lighter; line-height: 27px;margin: 5px 0 20px;'>As a Partner, here are some of the benefits you will enjoy</h4>
                                                        <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;table-layout: fixed;'>
                                                            <tr>
                                                                <td style='padding: 0px 20px;' align='center' class='feature-column'>
                                                                    <table border='0' cellpadding='0' cellspacing='0'  align='center'>
                                                                        <tr><td align='center'>
                                                                                <img src='".base_url('assets/img/team.png')."' style='margin-bottom: 10px;'>
                                                                                     <div style='font-size:14px;line-height: 22px;color: #68B975;' class='feature-text'>Guidance on CSR possibilities through WorthACT platform.</div>
                                                                            </td></tr>
                                                                    </table>
                                                                </td>
                                                                <td style='padding: 0px 20px;' align='center' class='feature-column'>
                                                                    <table border='0' cellpadding='0' cellspacing='0'  align='center'>
                                                                        <tr><td align='center'>
                                                                                <img src='".base_url('assets/img/page.png')."' style='margin-bottom: 10px;'>
                                                                                     <div style='font-size:14px;line-height: 22px;color: #ff7373;' class='feature-text'>Free advertisement for the company on WorthACT platform.</div>
                                                                            </td></tr>
                                                                    </table>
                                                                </td>
                                                                <td style='padding: 0px 20px;' align='center' class='feature-column'>
                                                                    <table border='0' cellpadding='0' cellspacing='0'  align='center'>
                                                                        <tr><td align='center'>
                                                                                <img src='".base_url('assets/img/need.png')."' style='margin-bottom: 10px;'>
                                                                                     <div style='font-size:14px;line-height: 22px;color: #957bb7;' class='feature-text'>Assistance on Serving the planet for a better world.</div>
                                                                            </td></tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;table-layout: fixed; margin-top: 30px'>
                                                            <tr>
                                                                <td style='padding: 0px 20px;' align='center' class='feature-column'>
                                                                    <table border='0' cellpadding='0' cellspacing='0'  align='center'>
                                                                        <tr><td align='center'>
                                                                                <img src='".base_url('assets/img/apply.png')."' style='margin-bottom: 10px;'>
                                                                                     <div style='font-size:14px;line-height: 22px;color: #68B975;' class='feature-text'>Privilege to be <br />listed in WorthACT's list of companies that follow <br />triple bottom line framework.</div>
                                                                            </td></tr>
                                                                    </table>
                                                                </td>
                                                                <td style='padding: 0px 20px;' align='center' class='feature-column'>
                                                                    <table border='0' cellpadding='0' cellspacing='0'  align='center'>
                                                                        <tr><td align='center'>
                                                                                <img src='".base_url('assets/img/job.png')."' style='margin-bottom: 10px;'>
                                                                                     <div style='font-size:14px;line-height: 22px;color: #ff7373;' class='feature-text'>Free access to WorthACT's sprouting job portal data base for recruitment solutions.</div>
                                                                            </td></tr>
                                                                    </table>
                                                                </td>
                                                                <td style='padding: 0px 20px;' align='center' class='feature-column'>
                                                                    <table border='0' cellpadding='0' cellspacing='0'  align='center'>
                                                                        <tr><td align='center'>
                                                                                <img src='".base_url('assets/img/megaphone.png')."' style='margin-bottom: 10px;'>
                                                                                     <div style='font-size:14px;line-height: 22px;color: #957bb7;' class='feature-text'>Promoting the company's environmental & social activities through all the Worthact ad medias.</div>
                                                                            </td></tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style='padding: 15px 10px 0px;border: 1px solid #DDD;border-top:none;' align='center'>
                                                    <div style='max-width:400px;'>
                                                        <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                                        <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                                        <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                                        <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                                        <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                                        <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;'>
                                            <tr>
                                                <td style='padding: 10px 0;'>
                                                    <div style='color: #ababab;font-family:Verdana,Arial;font-size: 12px;line-height:17px; text-align: center'>
                                                        © All Rights Reserved ".date('Y')."' <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </body>
                    </html>";
        $msg_two = "<!doctype html>
                <html xmlns='https://www.w3.org/1999/xhtml'>
                <head>
                <meta https-equiv='Content-Type' content='text/html; charset=UTF-8' />
                <meta name='format-detection' content='telephone=no'> 
                <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'>
                <meta https-equiv='X-UA-Compatible' content='IE=EDGE' />
                <title>WorthAct - Registration</title>
                <style type='text/css'>
                    @media all and (max-width: 400px) {
                        .feature-column { width:100% !important; display: block; }
                        .feature-text { margin-bottom: 50px; }
                    }
                    @media all and (max-width: 500px) {
                        .feature-column { padding: 0px 10px !important; }
                        .width-500-100 { width: 100% !important; }
                        .mbot-30 { margin-bottom: 30px !important; }
                        .leftright-text { padding-right: 0px !important; padding-left: 0px !important; }
                    }
                </style>
                </head>
                <body leftmargin='0' topmargin='0' marginwidth='0' marginheight='0' yahoo='fix' style='font-family: Verdana, Georgia, Times, serif; background-color:#FFFFFF; ' bgcolor='FFFFFF'>
                    <table width='100%' border='0' cellpadding='0' cellspacing='0' align='center'>
                        <tr>
                            <td style='padding: 50px 0px 50px 0px;'>
                                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;min-width:320px;background-color: #FFFFFF;'>
                                    <tr>
                                        <td style='background-color: #404257'>
                                            <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;'>
                                                <tr>
                                                    <td style='padding: 15px 15px 0;'><img style='width: 150px;' src='".base_url('assets/img/logo-orange.png')."'></td>
                                                </tr>
                                                <tr>
                                                    <td align='center' style='padding:15px;'>
                                                        <div style='font-size:26px; color: #ffffff;line-height: 40px;'>Your first step to become the change is just a click away !  </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align='center' style='padding: 5px 15px 40px;'>
                                                        <div style='font-size:18px;color: #ffffff;line-height: 25px;'>Activate your account and explore</div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='padding:20px 20px 5px;border: 1px solid #DDD;border-top: none;'>
                                            <table>
                                                <tr>
                                                    <td><p style='margin-top:0px;margin-bottom: 10px; color: #666;font-size:16px;'>Dear Member,</p></td>
                                                </tr>
                                                <tr>
                                                    <td><p style='line-height: 27px; color: #666; margin-top: 0;font-size:16px;margin-bottom:0'>Welcome to WorthAct initiatives. Thank you for signing up with us to do something selfless for the betterment of the world. We are happy to join hands with people who are conscientious and determined to better the environment and society we live in, and help us network with more like minded personals.</p></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <a href='".base_url('home/confirm_email/' . $key)."' style='background-color:#fe5e3a;display:block;padding: 15px 10px;margin:15px auto 20px;width:100%;max-width:125px;font-size:16px;color: #ffffff;text-decoration: none;border-radius:2px;text-align:center;' class=''>Get Started</a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='padding: 10px 20px 20px;border: 1px solid #DDD;border-top: none;' align='center'>
                                            <div style='display:inline;margin: 0 auto;'>
                                                <h4 style='color: #6a6a6a; font-size: 16px;font-weight: lighter; line-height: 27px;margin: 5px 0 20px;'>As a member these are some of the benefits you'll enjoy</h4>
                                                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;table-layout: fixed;'>
                                                    <tr>
                                                        <td style='padding: 0px 20px;' align='center' class='feature-column'>
                                                            <table border='0' cellpadding='0' cellspacing='0'  align='center'>
                                                                <tr><td align='center'>
                                                                        <img src='".base_url('assets/img/connect.png')."' style='margin-bottom: 10px;'>
                                                                            <div style='font-size:14px;line-height: 22px;color: #68B975;' class='feature-text'>Search for aspirants,<br>connect and get connected.</div>
                                                                    </td></tr>
                                                            </table>
                                                        </td>
                                                        <td style='padding: 0px 20px;' align='center' class='feature-column'>
                                                            <table border='0' cellpadding='0' cellspacing='0'  align='center'>
                                                                <tr><td align='center'>
                                                                        <img src='".base_url('assets/img/explore.png')."' style='margin-bottom: 10px;'>
                                                                            <div style='font-size:14px;line-height: 22px;color: #ff7373;' class='feature-text'>Explore about groups<br>and news feeds</div>
                                                                    </td></tr>
                                                            </table>
                                                        </td>
                                                        <td style='padding: 0px 20px;' align='center' class='feature-column'>
                                                            <table border='0' cellpadding='0' cellspacing='0'  align='center'>
                                                                <tr><td align='center'>
                                                                        <img src='".base_url('assets/img/media.png')."' style='margin-bottom: 10px;'>
                                                                            <div style='font-size:14px;line-height: 22px;color: #957bb7;' class='feature-text'>Upload medias such<br>as images and videos</div>
                                                                    </td></tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style='padding: 15px 10px 0px;border: 1px solid #DDD;border-top:none;' align='center'>
                                            <div style='max-width:400px;'>
                                                <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                                <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                                <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                                <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                                <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                                <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;'>
                                    <tr>
                                        <td style='padding: 10px 0;'>
                                            <div style='color: #ababab;font-family:Verdana,Arial;font-size: 12px;line-height:17px; text-align: center'>
                                                © All Rights Reserved ".date('Y')."' <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </body>
                </html>";
        $email_sub = "Account Activation - WorthAct";
        if($type == 3) {
            $this->send_email($msg_one, $email_sub, $email);
        } else {
            $this->send_email($msg_two, $email_sub, $email);
        }
    }
    
    public function activation_key($email, $key) {
        $msg = "<table style='border-collapse:collapse;line-height:24px;margin:80px auto 0;padding:0;width:100%;font-size:17px;color:#373737;width: 546px' border='0' cellpadding='0' cellspacing='0'>
                <tbody>
                    <tr>
                        <td width='546' height='150' style='background: rgba(64, 66, 87, 0.65) url(".base_url('assets/img/plant.jpg').") 0 0 no-repeat; background-size: cover;border-radius: 4px 4px 0 0;'>
                            <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='height:100%;background-color:rgba(64, 66, 87, 0.73);border-radius: 4px 4px 0 0;'>
                                <tbody>
                                    <tr>
                                        <td valign='center' data-bgcolor='Header'>
                                            <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;font-size: 32px; color: #FFFFFF;'>
                                                <tbody>
                                                    <tr>
                                                        <td align='center'>
                                                            <img height='55' src='".base_url('assets/img/logo-orange.png')."' border='0' style='display: block;' data-crop='false'>
                                                            <h4 style='text-align: center; font-size: 22px;color: #fff;margin: 15px 0 0'>Verify your Email</h4>     
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
                    <tr>
                        <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse' valign='top'>
                            <table style='border-collapse:collapse;background:#ececec;border-radius:0 0 4px 4px;margin-bottom:10px' align='center' border='0' cellpadding='32' cellspacing='0'>
                                <tbody>
                                    <tr>
                                        <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse;padding: 25px 35px 10px;' valign='top' width='546'>
                                            <div style='max-width:600px;margin:0 auto'>
                                                <div style='background:#ececec;'>
                                                    <p style='font-size: 16px;line-height: 22px;color: #666'>Dear Member,</p>
                                                    <p style='font-size:16px;line-height:32px;margin: 0 0 30px;color: #666'>Please verify the ownership of the email address by clicking the button below, it may take a couple of seconds only.</p>
                                                    <table style='border-collapse:collapse;width:100%'>
                                                        <tbody>
                                                            <tr style='width:100%; text-align: center;'>
                                                                <td><span style='display:inline-block;border-radius:2px;'><a href='".base_url('home/confirm_email/' . $key)."' style='color:white;font-weight:normal;text-decoration:none;font-size: 16px;padding: 12px 30px;background: #fe5e3a;border-radius: 2px;' target='_blank' data-saferedirecturl='".base_url('home/confirm_email/' . $key)."'>Verify Email</a> </span> </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <p style='font-size:0.9rem;line-height:20px;margin: 20px auto 1rem;color:#aaa;text-align:center;max-width:100%;word-break:break-word'>Need the raw link?
                                                        <a href='".base_url('home/confirm_email/' . $key)."' style='color:#439fe0;font-weight:bold;text-decoration:none;word-break:break-word' target='_blank' data-saferedirecturl='".base_url('home/confirm_email/' . $key)."'>".base_url('home/confirm_email/' . $key)."</a></p>
                                                    <p style='text-align: center;font-size:12px;line-height:24px;margin:0 0 15px;color: #666'>Why verify ? To ensure no spams in the websites. If you face any trouble with the verify button copy paste the provided link to your browser address bar.</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                </tbody>
            </table>
            <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 10px;'>
                <tr>
                    <td>
                        <div style='color: #ababab;font-family:Verdana,Arial;font-size: 12px;line-height:17px; text-align: center'>
                            © All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a>
                        </div>
                    </td>
                </tr>
            </table>
            <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                <tr>
                    <td align='center'>
                        <div style='max-width:400px'>
                            <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                            <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                            <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                            <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                            <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                            <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                        </div>
                    </td>
                </tr>
            </table>";
        $email_sub = "Verify Email - WorthAct";
        $this->send_email($msg, $email_sub, $email);
    }
    
    public function password_reset($email, $key, $name) {
        $msg = "<table style='border-collapse:collapse;line-height:24px;margin:80px auto 0;padding:0;width:100%;font-size:17px;color:#373737;width: 546px' border='0' cellpadding='0' cellspacing='0'>
                <tbody>
                    <tr>
                        <td width='546' height='150' style='background: rgba(64, 66, 87, 0.65) url(".base_url('assets/img/plant.jpg').") 0 0 no-repeat; background-size: cover;border-radius: 4px 4px 0 0;'>
                            <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='height:100%;background-color:rgba(64, 66, 87, 0.73);border-radius: 4px 4px 0 0;'>
                                <tbody>
                                    <tr>
                                        <td valign='center' data-bgcolor='Header'>
                                            <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;font-size: 32px; color: #FFFFFF;'>
                                                <tbody>
                                                    <tr>
                                                        <td align='center'>
                                                            <img height='55' src='".base_url('assets/img/logo-orange.png')."' border='0' style='display: block;' data-crop='false'>
                                                                 <h4 style='text-align: center; font-size: 22px;color: #fff;margin: 15px 0 0'>Reset Password</h4>     
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
                    <tr>
                        <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse' valign='top'>
                            <table style='border-collapse:collapse;background:#ececec;border-radius:0 0 4px 4px;margin-bottom:10px' align='center' border='0' cellpadding='32' cellspacing='0'>
                                <tbody>
                                    <tr>
                                        <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse;padding: 25px 35px 10px;' valign='top' width='546'>
                                            <div style='max-width:600px;margin:0 auto'>
                                                <div style='background:#ececec;'>
                                                    <p style='font-size: 16px;line-height: 22px;color: #666'>Dear $name,</p>
                                                    <p style='font-size:16px;line-height:32px;margin: 0 0 30px;color: #666'>We got a request to change password.</p>
                                                    <table style='border-collapse:collapse;width:100%'>
                                                        <tbody>
                                                            <tr style='width:100%; text-align: center;'>
                                                                <td><span style='display:inline-block;border-radius:2px;'><a href='".base_url('login?key=' . $key)."' style='color:white;font-weight:normal;text-decoration:none;font-size: 16px;padding: 12px 30px;background: #fe5e3a;border-radius: 2px;' target='_blank' data-saferedirecturl='href='".base_url('login?key=' . $key)."''>Reset Password</a> </span></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <p style='font-size:0.9rem;line-height:20px;margin: 20px auto 1rem;color:#aaa;text-align:center;max-width:100%;word-break:break-word'>Need the raw link?
                                                        <a href='".base_url('login?key=' . $key)."' style='color:#439fe0;font-weight:bold;text-decoration:none;word-break:break-word' target='_blank' data-saferedirecturl='".base_url('login?key=' . $key)."'>".base_url('login?key=' . $key)."</a></p>
                                                    <p style='text-align: center;font-size:14px;line-height:24px;margin:0 0 15px;color: #666'>If you didn't mean to reset your password, then you can just ignore this email. Your password will not change. For any queries, reach us at <a href='mailto:getintouch@worthact.com'>getintouch@worthact.com</a></p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                </tbody>
            </table>
            <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 10px;'>
                <tr>
                    <td>
                        <div style='color: #ababab;font-family:Verdana,Arial;font-size: 12px;line-height:17px; text-align: center'>
                            © All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a>
                        </div>
                    </td>
                </tr>
            </table>
            <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                <tr>
                    <td align='center'>
                        <div style='max-width:400px'>
                            <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                            <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                            <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                            <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                            <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                            <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                        </div>
                    </td>
                </tr>
            </table>";
        $email_sub = "Reset Password - WorthAct";
        $email_to = $email;
        $this->send_email($msg, $email_sub, $email_to);
    }
    
    public function profile_password_reset($email) {
        $name = ucfirst($this->info->username);
        $msg = "<table style='border-collapse:collapse;line-height:24px;margin:80px auto 0;padding:0;width:100%;font-size:17px;color:#373737;width: 546px' border='0' cellpadding='0' cellspacing='0'>
                <tbody>
                    <tr>
                        <td width='546' height='150' style='background: rgba(64, 66, 87, 0.65) url(".base_url('assets/img/plant.jpg').") 0 0 no-repeat; background-size: cover;border-radius: 4px 4px 0 0;'>
                            <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='height:100%;background-color:rgba(64, 66, 87, 0.73);border-radius: 4px 4px 0 0;'>
                                <tbody>
                                    <tr>
                                        <td valign='center' data-bgcolor='Header'>
                                            <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;font-size: 32px; color: #FFFFFF;'>
                                                <tbody>
                                                    <tr>
                                                        <td align='center'>
                                                            <img height='55' src='".base_url('assets/img/logo-orange.png')."' border='0' style='display: block;' data-crop='false'>
                                                                 <h4 style='text-align: center; font-size: 22px;color: #fff;margin: 15px 0 0'>Password Changed</h4>     
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
                    <tr>
                        <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse' valign='top'>
                            <table style='border-collapse:collapse;background:#ececec;border-radius:0 0 4px 4px;margin-bottom:10px' align='center' border='0' cellpadding='32' cellspacing='0'>
                                <tbody>
                                    <tr>
                                        <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse;padding: 25px 35px 10px;' valign='top' width='546'>
                                            <div style='max-width:600px;margin:0 auto'>
                                                <div style='background:#ececec;'>
                                                    <p style='font-size: 16px;line-height: 22px;color:#666;'>Dear $name,</p>
                                                    <p style='font-size:16px;line-height:32px;margin: 0 0 30px;color:#666;'>The password for your WorthAct Account under '".$email."' was recently changed.</p>
                                                    <p style='text-align: center;font-size:14px;line-height:24px;margin:0 0 15px;color:#666;'>Don't recognize this activity? Visit our <a href='https://www.worthact.com'>WorthAct</a> and click on the forgot password link to recover your account. For any queries, reach us at <a href='mailto:getintouch@worthact.com'>getintouch@worthact.com</a></p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                </tbody>
            </table>
            <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 10px;'>
                <tr>
                    <td>
                        <div style='color: #ababab;font-family:Verdana,Arial;font-size: 12px;line-height:17px; text-align: center'>
                            © All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a>
                        </div>
                    </td>
                </tr>
            </table>
            <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                <tr>
                    <td align='center'>
                        <div style='max-width:400px'>
                            <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                            <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                            <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                            <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                            <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                            <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                        </div>
                    </td>
                </tr>
            </table>";
        $email_sub = "Password Changed - WorthAct";
        $this->send_email($msg, $email_sub, $email);
    }
    
    public function profile_email_update($email, $key) {
        $name = ucfirst($this->info->username);
        $msg = "<table style='border-collapse:collapse;line-height:24px;margin:80px auto 0;padding:0;width:100%;font-size:17px;color:#373737;width: 546px' border='0' cellpadding='0' cellspacing='0'>
                <tbody>
                    <tr>
                        <td width='546' height='150' style='background: rgba(64, 66, 87, 0.65) url(".base_url('assets/img/plant.jpg').") 0 0 no-repeat; background-size: cover;border-radius: 4px 4px 0 0;'>
                            <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='height:100%;background-color:rgba(64, 66, 87, 0.73);border-radius: 4px 4px 0 0;'>
                                <tbody>
                                    <tr>
                                        <td valign='center' data-bgcolor='Header'>
                                            <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;font-size: 32px; color: #FFFFFF;'>
                                                <tbody>
                                                    <tr>
                                                        <td align='center'>
                                                            <img height='55' src='".base_url('assets/img/logo-orange.png')."' border='0' style='display: block;' data-crop='false'>
                                                                 <h4 style='text-align: center; font-size: 22px;color: #fff;margin: 15px 0 0'>Verify your Email</h4>     
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
                    <tr>
                        <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse' valign='top'>
                            <table style='border-collapse:collapse;background:#ececec;border-radius:0 0 4px 4px;margin-bottom:10px' align='center' border='0' cellpadding='32' cellspacing='0'>
                                <tbody>
                                    <tr>
                                        <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse;padding: 25px 35px 10px;' valign='top' width='546'>
                                            <div style='max-width:600px;margin:0 auto'>
                                                <div style='background:#ececec;'>
                                                    <p style='font-size: 16px;line-height: 22px;color:#666;'>Dear $name,</p>
                                                    <p style='font-size:16px;line-height:32px;margin: 0 0 30px;color:#666;'>Please verify the ownership of the email address by clicking the button below, it may take a couple of seconds only.</p>
                                                    <table style='border-collapse:collapse;width:100%'>
                                                        <tbody>
                                                            <tr style='width:100%; text-align: center;'>
                                                                <td><span style='display:inline-block;border-radius:2px;'><a href='".base_url('home/confirm_email/' . $key)."' style='color:white;font-weight:normal;text-decoration:none;font-size: 16px;padding: 12px 30px;background: #fe5e3a;border-radius: 2px;' target='_blank' data-saferedirecturl='".base_url('home/confirm_email/' . $key)."'>Verify Email</a> </span> </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <p style='font-size:0.9rem;line-height:20px;margin: 20px auto 1rem;color:#aaa;text-align:center;max-width:100%;word-break:break-word'>Need the raw link?
                                                        <a href='".base_url('home/confirm_email/' . $key)."' style='color:#439fe0;font-weight:bold;text-decoration:none;word-break:break-word' target='_blank' data-saferedirecturl='".base_url('home/confirm_email/' . $key)."'>".base_url('home/confirm_email/' . $key)."</a></p>
                                                    <p style='text-align: center;font-size:14px;line-height:24px;margin:0 0 15px;color:#666;'>Why verify ? To ensure no spams in the websites. If you face any trouble with the verify button copy paste the provided link to your browser address bar. For any queries, reach us at <a href='mailto:getintouch@worthact.com'>getintouch@worthact.com</a></p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                </tbody>
            </table>
            <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 10px;'>
                <tr>
                    <td>
                        <div style='color: #ababab;font-family:Verdana,Arial;font-size: 12px;line-height:17px; text-align: center'>
                            © All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a>
                        </div>
                    </td>
                </tr>
            </table>
            <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                <tr>
                    <td align='center'>
                        <div style='max-width:400px'>
                            <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                            <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                            <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                            <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                            <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                            <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                        </div>
                    </td>
                </tr>
            </table>";
        $email_sub = "Verify Email - WorthAct";
        $this->send_email($msg, $email_sub, $email);
    }
    
    public function payment_invoice($email, $amount, $txn_id) {
        $date = date('M d, Y');
        $msg = "<table cellpadding='0' cellspacing='0' border='0' align='center' width='100%' bgcolor='#FFFFFF' style='font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;border-collapse:collapse!important'>
                <tbody>
                    <tr>
                        <td align='center' style='padding-right:5px;padding-left:5px;padding-top: 50px;border-collapse:collapse'>
                            <table cellpadding='0' cellspacing='0' border='0' bgcolor='#FFFFFF' style='border-collapse:collapse!important'>
                                <tbody>
                                    <tr>
                                        <td align='center' width='760' valign='top' style='border-collapse:collapse'>
                                            <table width='92%' cellpadding='0' cellspacing='0' border='0' align='center' style='border-collapse:collapse!important'>
                                                <tbody>
                                                    <tr>
                                                        <td align='center' style='border-collapse:collapse'>
                                                            <img src='".base_url('assets/img/logo-bold.png')."' style='outline:none;text-decoration:none;border:none;' height='50' width='160'>
                                                            <h1 style='display:block;font-family:Helvetica Neue,Helvetica,Arial,sans-serif;font-size:24px;font-weight:bold;line-height:100%;margin:10px 0px 10px;text-align:center;color:#f15e3e'>
                                                                Thank you for your Support! </h1>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align='center' style='font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:14px;line-height:160%;border-collapse:collapse;'>
                                                            <strong>Your bank will show a charge for ".$amount." from WorthAct</strong></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align='center' style='padding-right:5px;padding-left:5px;border-collapse:collapse'>
                            <table cellpadding='0' cellspacing='0' border='0' style='background-color:rgb(255,255,255);border-collapse:collapse!important;margin-top:5px'>
                                <tbody>
                                    <tr>
                                        <td width='760' align='center' style='border-collapse:collapse'>
                                            <table width='92%' cellpadding='0' cellspacing='0' border='0' style='border-right:1px solid rgb(156,180,197);border-left:1px solid rgb(156,180,197);border-collapse:collapse!important'>
                                                <tbody>
                                                    <tr>
                                                        <td align='left' valign='middle' bgcolor='#404257' style='padding-left:15px;border:1px solid #404257;color:#fff;font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:13px;background-color:#404257;border-collapse:collapse'>
                                                            <h2 style='display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:16px;font-weight:bold;line-height:100%;margin:10px 0px;text-align:left;color:#fff'>
                                                                Payment Confirmation and Customer Receipt </h2>
                                                        </td>
                                                        <td align='right' valign='middle' bgcolor='#404257' style='background-color:#404257;padding-top:5px;padding-right:15px;padding-bottom:5px;white-space:nowrap;border:1px solid #404257;color:#fff;font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:13px;line-height:150%;border-collapse:collapse'>
                                                            Order $txn_id
                                                            <p style='margin-top:4px;margin-bottom:4px;font-family:&quot;color: #333333; Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:11px;line-height:100%'>
                                                                Placed $date </p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <table width='92%' cellpadding='0' cellspacing='0' border='0' style='background-color:rgb(247,247,247);border-width:1px;border-style:solid;border-color:rgb(156,180,197);border-collapse:collapse!important'>
                                                <tbody>
                                                    <tr>
                                                        <td width='50%' align='left' valign='top' style='font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:12px;line-height:130%;padding-top:15px;padding-left:20px;padding-bottom:15px;background-color:rgb(247,247,247);border-collapse:collapse'>
                                                            <p style='color:rgb(47,73,89);font-weight:bold;font-size:13px;margin:0px 0px 10px'>
                                                                BILLING INFO</p>
                                                            <table width='100%' cellpadding='0' cellspacing='0' style='font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:12px;line-height:130%;background-color:rgb(247,247,247);border-collapse:collapse!important'>
                                                                <tbody>
                                                                    <tr>
                                                                        <td style='border-collapse:collapse'><a href='mailto:".$email."' style='color:rgb(48,93,140)' target='_blank'>".$email."</a></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                        <td width='50%' align='right' valign='top' style='padding-top:15px;padding-right:20px;padding-bottom:15px;background-color:rgb(247,247,247);border-collapse:collapse'>
                                                            <table width='100%' cellpadding='0' cellspacing='0' border='0' style='font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:12px;line-height:130%;background-color:rgb(247,247,247);border-collapse:collapse!important'>
                                                                <tbody>
                                                                    <tr>
                                                                        <td align='right' valign='top' style='padding-right:5px;border-collapse:collapse'>
                                                                            Subtotal:</td>
                                                                        <td align='right' valign='top' style='border-collapse:collapse'>".$amount." </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align='right' valign='top' style='padding-right:5px;border-collapse:collapse'>
                                                                            Tax: </td>
                                                                        <td align='right' valign='top' style='border-collapse:collapse'>$0.00 </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width='78%' align='right' valign='top' style='padding-right:5px;border-collapse:collapse'>
                                                                            <strong>Total:</strong></td>
                                                                        <td width='22%' align='right' valign='top' style='border-collapse:collapse'><strong>".$amount."
                                                                            </strong></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align='right' valign='top' style='padding-right:5px;border-collapse:collapse'>
                                                                            Payment:</td>
                                                                        <td align='right' valign='top' style='border-collapse:collapse'>Completed</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
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
                    <tr>
                        <td align='center' style='padding-right:5px;padding-left:5px;border-collapse:collapse'>
                            <table cellpadding='0' cellspacing='0' border='0' style='background-color:rgb(255,255,255);border-collapse:collapse!important;margin-top: 10px;'>
                                <tbody>
                                    <tr>
                                        <td width='760' align='center' style='border-collapse:collapse'>
                                            <table width='92%' cellpadding='0' cellspacing='0' border='0' align='center' bgcolor='#eee' style='border-collapse:collapse!important'>
                                                <tbody>
                                                    <tr>
                                                        <td align='left' valign='top' style='color:rgb(51,51,51);font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:12px;font-weight:normal;line-height:160%;padding-top:10px;padding-right:15px;padding-left:15px;border-collapse:collapse'>
                                                            <h4 style='display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:16px;font-weight:bold;line-height:100%;margin:10px 0px;text-align:left;color:rgb(51,51,51)!important'>
                                                                TECHNICAL SUPPORT</h4>
                                                            <strong style='font-size: 12px;'>If you have any queries regarding the payment, please visit <a href='https://www.worthact.com'>worthact.com</a> and submit a ticket for technical support.<br>
                                                                </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align='left' valign='top' style='font-size: 12px;color:rgb(51,51,51);font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:12px;font-weight:normal;line-height:160%;padding-top:10px;padding-right:15px;padding-left:15px;border-collapse:collapse'>
                                                                        <strong style='font-size: 12px;'>PLEASE DO NOT REPLY DIRECTLY TO THIS EMAIL. This email has been automatically generated. If you have questions, please visit <a href='https://www.worthact.com'>worthact.com</a> and submit a ticket for technical support.</strong><br>
                                                                        <br>
                                                                        Thank You,<br>
                                                                        Team WorthAct<br>
                                                                        <br>
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
                    <tr>
                        <td align='center' style='padding-right:5px;padding-left:5px;border-collapse:collapse'>
                            <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom:10px'>
                                <tr>
                                    <td style='padding:10px 10px 0px 10px;'>
                                        <div style='color: #ababab;font-family:Verdana,Arial;font-size: 12px;line-height:17px; text-align: center'>
                                            © All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                                <tr>
                             <td align='center'>
                             <div style='max-width:400px'>
                                <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                             </div>
                             </td>
                             </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style='border-collapse:collapse'></td>
                    </tr>
                </tbody>
            </table>";
        $email_sub = "Payment Confirmation - WorthAct";
        $this->send_email($msg, $email_sub, $email);
    }
    
    public function payment_adv_invoice($email, $amount, $txn_id) {
        $date = date('M d, Y');
        $msg = "<table cellpadding='0' cellspacing='0' border='0' align='center' width='100%' bgcolor='#FFFFFF' style='font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;border-collapse:collapse!important'>
                <tbody>
                    <tr>
                        <td align='center' style='padding-right:5px;padding-left:5px;padding-top: 50px;border-collapse:collapse'>
                            <table cellpadding='0' cellspacing='0' border='0' bgcolor='#FFFFFF' style='border-collapse:collapse!important'>
                                <tbody>
                                    <tr>
                                        <td align='center' width='760' valign='top' style='border-collapse:collapse'>
                                            <table width='92%' cellpadding='0' cellspacing='0' border='0' align='center' style='border-collapse:collapse!important'>
                                                <tbody>
                                                    <tr>
                                                        <td align='center' style='border-collapse:collapse'>
                                                            <img src='".base_url('assets/img/logo-bold.png')."' style='outline:none;text-decoration:none;border:none;' height='50' width='160'>
                                                            <h1 style='display:block;font-family:Helvetica Neue,Helvetica,Arial,sans-serif;font-size:24px;font-weight:bold;line-height:100%;margin:10px 0px 10px;text-align:center;color:#f15e3e'>
                                                                Thank you for your booking! </h1>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td align='center' style='font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:14px;line-height:160%;border-collapse:collapse;'>
                                                            <strong>Your bank will show a charge for ".$amount." from WorthAct</strong></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align='center' style='padding-right:5px;padding-left:5px;border-collapse:collapse'>
                            <table cellpadding='0' cellspacing='0' border='0' style='background-color:rgb(255,255,255);border-collapse:collapse!important;margin-top:5px'>
                                <tbody>
                                    <tr>
                                        <td width='760' align='center' style='border-collapse:collapse'>
                                            <table width='92%' cellpadding='0' cellspacing='0' border='0' style='border-right:1px solid rgb(156,180,197);border-left:1px solid rgb(156,180,197);border-collapse:collapse!important'>
                                                <tbody>
                                                    <tr>
                                                        <td align='left' valign='middle' bgcolor='#404257' style='padding-left:15px;border:1px solid #404257;color:#fff;font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:13px;background-color:#404257;border-collapse:collapse'>
                                                            <h2 style='display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:16px;font-weight:bold;line-height:100%;margin:10px 0px;text-align:left;color:#fff'>
                                                                Payment Confirmation and Customer Receipt </h2>
                                                        </td>
                                                        <td align='right' valign='middle' bgcolor='#404257' style='background-color:#404257;padding-top:5px;padding-right:15px;padding-bottom:5px;white-space:nowrap;border:1px solid #404257;color:#fff;font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:13px;line-height:150%;border-collapse:collapse'>
                                                            Order $txn_id
                                                            <p style='margin-top:4px;margin-bottom:4px;font-family:&quot;color: #333333; Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:11px;line-height:100%'>
                                                                Placed $date </p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <table width='92%' cellpadding='0' cellspacing='0' border='0' style='background-color:rgb(247,247,247);border-width:1px;border-style:solid;border-color:rgb(156,180,197);border-collapse:collapse!important'>
                                                <tbody>
                                                    <tr>
                                                        <td width='50%' align='left' valign='top' style='font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:12px;line-height:130%;padding-top:15px;padding-left:20px;padding-bottom:15px;background-color:rgb(247,247,247);border-collapse:collapse'>
                                                            <p style='color:rgb(47,73,89);font-weight:bold;font-size:13px;margin:0px 0px 10px'>
                                                                BILLING INFO</p>
                                                            <table width='100%' cellpadding='0' cellspacing='0' style='font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:12px;line-height:130%;background-color:rgb(247,247,247);border-collapse:collapse!important'>
                                                                <tbody>
                                                                    <tr>
                                                                        <td style='border-collapse:collapse'><a href='mailto:".$email."' style='color:rgb(48,93,140)' target='_blank'>".$email."</a></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                        <td width='50%' align='right' valign='top' style='padding-top:15px;padding-right:20px;padding-bottom:15px;background-color:rgb(247,247,247);border-collapse:collapse'>
                                                            <table width='100%' cellpadding='0' cellspacing='0' border='0' style='font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:12px;line-height:130%;background-color:rgb(247,247,247);border-collapse:collapse!important'>
                                                                <tbody>
                                                                    <tr>
                                                                        <td align='right' valign='top' style='padding-right:5px;border-collapse:collapse'>
                                                                            Subtotal:</td>
                                                                        <td align='right' valign='top' style='border-collapse:collapse'>".$amount." </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align='right' valign='top' style='padding-right:5px;border-collapse:collapse'>
                                                                            Tax: </td>
                                                                        <td align='right' valign='top' style='border-collapse:collapse'>$0.00 </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td width='78%' align='right' valign='top' style='padding-right:5px;border-collapse:collapse'>
                                                                            <strong>Total:</strong></td>
                                                                        <td width='22%' align='right' valign='top' style='border-collapse:collapse'><strong>".$amount."
                                                                            </strong></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align='right' valign='top' style='padding-right:5px;border-collapse:collapse'>
                                                                            Payment:</td>
                                                                        <td align='right' valign='top' style='border-collapse:collapse'>Completed</td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
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
                    <tr>
                        <td align='center' style='padding-right:5px;padding-left:5px;border-collapse:collapse'>
                            <table cellpadding='0' cellspacing='0' border='0' style='background-color:rgb(255,255,255);border-collapse:collapse!important;margin-top: 10px;'>
                                <tbody>
                                    <tr>
                                        <td width='760' align='center' style='border-collapse:collapse'>
                                            <table width='92%' cellpadding='0' cellspacing='0' border='0' align='center' bgcolor='#eee' style='border-collapse:collapse!important'>
                                                <tbody>
                                                    <tr>
                                                        <td align='left' valign='top' style='color:rgb(51,51,51);font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:12px;font-weight:normal;line-height:160%;padding-top:10px;padding-right:15px;padding-left:15px;border-collapse:collapse'>
                                                            <h4 style='display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:16px;font-weight:bold;line-height:100%;margin:10px 0px;text-align:left;color:rgb(51,51,51)!important'>
                                                                TECHNICAL SUPPORT</h4>
                                                            <strong style='font-size: 12px;'>If you have any queries regarding the payment, please visit <a href='https://www.worthact.com'>worthact.com</a> and submit a ticket for technical support.<br>
                                                                </td>
                                                                </tr>
                                                                <tr>
                                                                    <td align='left' valign='top' style='font-size: 12px;color:rgb(51,51,51);font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;font-size:12px;font-weight:normal;line-height:160%;padding-top:10px;padding-right:15px;padding-left:15px;border-collapse:collapse'>
                                                                        <strong style='font-size: 12px;'>PLEASE DO NOT REPLY DIRECTLY TO THIS EMAIL. This email has been automatically generated. If you have questions, please visit <a href='https://www.worthact.com'>worthact.com</a> and submit a ticket for technical support.</strong><br>
                                                                        <br>
                                                                        Thank You,<br>
                                                                        Team WorthAct<br>
                                                                        <br>
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
                    <tr>
                        <td align='center' style='padding-right:5px;padding-left:5px;border-collapse:collapse'>
                            <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom:10px'>
                                <tr>
                                    <td style='padding:10px 10px 0px 10px;'>
                                        <div style='color: #ababab;font-family:Verdana,Arial;font-size: 12px;line-height:17px; text-align: center'>
                                            © All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                                <tr>
                             <td align='center'>
                             <div style='max-width:400px'>
                                <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                             </div>
                             </td>
                             </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style='border-collapse:collapse'></td>
                    </tr>
                </tbody>
            </table>";
        $email_sub = "Payment Confirmation - WorthAct";
        $this->send_email($msg, $email_sub, $email);
    }
    
    public function beneficiary_email($email, $ad, $user, $action, $desc) {
        if($user->type_id == 1) {
            $address = ($user->user_address != '' && $user->user_city != '' && $user->user_state != '')? $user->user_address.' '.$user->user_city.' '.$user->user_state.' '.$user->user_country_name : 'nil';
            $phone = ($user->mobile != '')? $user->mobile : 'nil';
            
        } else {
            $address = ($user->or_address != '' && $user->or_city != '' && $user->or_state != '')? $user->or_address.' '.$user->or_city.' '.$user->or_state.' '.$user->org_country_name : 'nil';
            $phone = ($user->tel != '')? $user->tel : 'nil';
        }
        $msg = "<table cellpadding='0' cellspacing='0' width='600' style='margin:50px auto 0;'>
                    <tr>
                        <td style='background-color:white;border:1px solid #CCC;'>
                            <table cellpadding='0' cellspacing='0' width='600'>
                                <tr>
                                    <td style='width:170px;background-color:#f15e3e;vertical-align: top;'>
                                        <table cellpadding='0' cellspacing='0' width='100%'>
                                            <tr>
                                                <td>
                                                    <img src='".base_url(($user->propic != '')? 'assets/userdata/dashboard/propic/'.$user->propic : 'assets/img/'.$this->hook->get_placeholder($user->main_id))."' style='display:block;height:170px;'>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style='padding:15px 10px 13px 10px;'>
                                                    <div style='font-family:Century Gothic,Verdana,Arial;font-size:19px;color:#EEE;line-height:19px;text-align:center;'>
                                                        ".(($user->type_id == 1) ? ucfirst(strtolower($user->firstname)) . ' ' . ucfirst(strtolower($user->lastname)) : ucfirst(strtolower($user->name)))."
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style='vertical-align:top;font-family:Verdana, Helvetica Neue,Helvetica,Arial,sans-serif;font-size:13px;padding:20px 25px 20px 25px;background-color:#FAFAFA;'>
                                        <img src='".base_url('assets/img/logo-bold.png')."' style='outline:none;text-decoration:none;border:none;' height='50' width='160'>
                                        <div style='margin: 16px 0px 3px 0px;color:#555;font-size: 16px;line-height:27px;text-align:center;'><b>".(($user->type_id == 1) ? ucfirst(strtolower($user->firstname)) . ' ' . ucfirst(strtolower($user->lastname)) : ucfirst(strtolower($user->name)))." has opted for an action on your SOS - $ad->title.</b></div>
                                        <div style='margin: 20px 0px 5px 0px;color:#797979;font-size: 14px;line-height:25px;'>You can contact the person via his contact details to communicate further.</div>
                                        <h4 style='font-size: 14px;color:#797979;'>SOS Information</h4>
                                        <p style='font-size: 14px;color:#797979;'>Title: $ad->title</p>
                                        <p style='font-size: 14px;color:#797979;'>Support Type: $action->support_title</p>    
                                        <p style='font-size: 14px;color:#797979;line-height:25px;'>Address: $address</p>
                                        <p style='font-size: 14px;color:#797979;'>Phone: $phone</p>
                                        <p style='font-size: 14px;color:#797979;'>Email: $user->email</p>
                                        <p style='font-size: 14px;color:#797979;'>".(($desc != '')? $desc : '')."</p>    
                                        <p style='line-height:25px;font-size:12px;text-align:center;color:#797979;'>WorthAct is a platform where members meet, exchange and support ideas. We only promote direct fiscal transactions with end users and are not liable for any kind of loss for either parties involved in the transaction.</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom:10px'>
                                <tr>
                                    <td style='padding:10px 10px 0px 10px;'>
                                        <div style='color: #ababab;font-family:Verdana,Arial;font-size: 12px;line-height:17px; text-align: center'>
                                            © All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                    <tr>
                 <td align='center'>
                 <div style='max-width:400px'>
                    <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                 </div>
                 </td>
                 </tr>
                </table>";
        $email_sub = "SOS Action - WorthAct";
        $this->send_email($msg, $email_sub, $email);
    }
    
    public function action_reply_email($user, $action, $ad, $beneficiary_user) {
        $action_desc = ($ad->action_desc != '')? $ad->action_desc : 'None';
        $link = ($ad->link != '')? $ad->link : 'Nil';
        $msg = "<table style='border-collapse:collapse;line-height:24px;margin:80px auto 0;padding:0;width:100%;font-size:17px;color:#373737;width: 546px' border='0' cellpadding='0' cellspacing='0'>
                    <tbody>
                        <tr>
                            <td width='546' height='150' style='background: rgba(64, 66, 87, 0.65) url(".base_url('assets/img/plant.jpg').") 0 0 no-repeat; background-size: cover;border-radius: 4px 4px 0 0;'>
                                <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='height:100%;background-color:rgba(64, 66, 87, 0.73);border-radius: 4px 4px 0 0;'>
                                    <tbody>
                                        <tr>
                                            <td valign='center' data-bgcolor='Header'>
                                                <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;font-size: 32px; color: #FFFFFF;'>
                                                    <tbody>
                                                        <tr>
                                                            <td align='center'>
                                                                <img height='55' src='".base_url('assets/img/logo-orange.png')."' border='0' style='display: block;' data-crop='false'>
                                                                     <h4 style='text-align: center; font-size: 22px;color: #fff;margin: 15px 0 0'>SOS Action</h4>     
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
                        <tr>
                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse' valign='top'>
                                <table style='border-collapse:collapse;background:#ececec;border-radius:0 0 4px 4px;margin-bottom:10px' align='center' border='0' cellpadding='32' cellspacing='0'>
                                    <tbody>
                                        <tr>
                                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse;padding: 25px 35px 25px;' valign='top' width='546'>
                                                <div style='max-width:600px;margin:0 auto'>
                                                    <div style='background:#ececec;'>
                                                        <p style='font-size: 16px;line-height: 22px;color:#666;'><b>Way to go!</b></p>
                                                        <p style='font-size:16px;line-height:28px;margin: 0 0 5px;color:#666;'>You have successfully opted in to do $action->title for a particular SOS post.</p>
                                                        <p style='font-size:16px;line-height:28px;margin: 0 0 5px;color:#666;'>We are happy to support aspirants like you who take part in taking actions than words; you may contact us for any guidance at getintouch@worthact.com.</p>
                                                        <p style='font-size:16px;line-height:28px;margin: 0 0 15px;color:#666;'>You will be able to communicate with the beneficiary once they accept the notification.</p>
                                                        <h4 style='font-size: 16px;color:#797979;margin: 0 0 10px;color:#666;line-height:28px;'>SOS Information</h4>
                                                        <p style='font-size: 14px;margin: 0 0 15px;color:#666;line-height:24px;'>Title: $ad->title</p>
                                                        <p style='font-size: 14px;margin: 0 0 15px;color:#666;line-height:24px;'>Support Type: $action->support_title</p>
                                                        <p style='font-size: 14px;margin: 0 0 15px;color:#666;line-height:24px;'>Support Description: $action_desc</p>
                                                        <p style='font-size: 14px;margin: 0 0 15px;color:#666;line-height:24px;'>Phone: $ad->phone</p>
                                                        <p style='font-size: 14px;margin: 0 0 15px;color:#666;line-height:24px;'>Email: $ad->email</p>
                                                        <p style='font-size: 14px;margin: 0 0 15px;color:#666;line-height:24px;'>Webiste / Link: $link</p>
                                                        <p style='font-size: 14px;margin: 0 0 15px;color:#666;line-height:24px;'>Alternative Email: $beneficiary_user</p>
                                                        <p style='font-size:16px;line-height:28px;margin: 0 0 5px;color:#666;'>Kind Regards,</p>
                                                        <p style='font-size:16px;line-height:28px;margin:0;color:#666;'>WorthAct Initiatives</p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                    </tbody>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom:10px'>
                    <tr>
                        <td>
                            <div style='color: #ababab;font-family:Verdana,Arial;font-size: 12px;line-height:17px; text-align: center'>
                                © All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a>
                            </div>
                        </td>
                    </tr>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                    <tr>
                        <td align='center'>
                            <div style='max-width:400px'>
                                <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                            </div>
                        </td>
                    </tr>
                </table>";
        $email = $user->email;
        $email_sub = "SOS Action - WorthAct";
        $this->send_email($msg, $email_sub, $email);
    }
    
    public function invitation($email, $type, $msg) {
        $name = ($this->info->type_id == 1) ? ucfirst(strtolower($this->info->firstname)) . ' ' . ucfirst(strtolower($this->info->lastname)) : ucfirst(strtolower($this->info->name));
        $msg_general = "<!DOCTYPE html>
                        <html>
                            <head>
                                <meta https-equiv='Content-Type' content='text/html; charset=utf-8' />
                                <meta charset='utf-8'>
                                <title>$name invited you to visit WorthAct</title>
                            </head>
                            <body>
                                <div style='width:100%;'>
                                    <center>
                                        <table cellpadding='0' cellspacing='0' border='0' width='600' style='margin-bottom:1px;margin-top: 50px;'>
                                            <tr>
                                                <td style='text-align:left;vertical-align:middle;height:30px;padding-top:5px;'><a href='https://www.worthact.com'><img src='".base_url('assets/img/logo-bold.png')."' style='display:block;width:160px;height:50px;margin: 0 auto 15px;' alt='WorthAct'></a></td>
                                            </tr>
                                        </table>
                                        <table cellpadding='0' cellspacing='0' border='0' width='600' style='border: 1px solid #DDD;'>
                                            <tr>
                                                <td style='background-color: #fe5e3a;vertical-align:middle;  height: 150px;'>
                                                    <table cellpadding='0' cellspacing='0' width='100%'>
                                                        <tr>
                                                            <td style='padding:17px 0px 17px 20px;width:100px;'>
                                                                <img src='".base_url(($this->info->propic != '') ? 'assets/userdata/dashboard/propic/'.$this->info->propic : 'assets/img/'.$this->placeholder)."' style='display:block;border-radius:100%;border: 3px solid #ff7978;width:100px;height:100px;margin-right: 20px;' alt='$name'>
                                                            </td>
                                                            <td style='padding:20px 0px 20px 11px;vertical-align:middle;'>
                                                                <div style='font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;color:#FFF;font-size: 14px;text-align:left;line-height:27px;margin-right: 25px;'><b>$name</b> invited you to join WorthAct.</div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style='background-color: #F3F3F3;border-top:1px solid #E5E5E5;'>
                                            <center>
                                                <div style='padding:0 25px;font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;font-size:14px;color:#5f5f5f;margin:20px 0px 25px 0px;text-align:center;line-height: 23px;'>There comes a time in everyone's life where we want to do something for the environment and society, but mostly such good thoughts end up in vain. Is it worth?</div>
                                                <table cellpadding='0' cellspacing='0' width='100%' style='margin-bottom:20px;'>
                                                    <tr>
                                                        <td>
                                                            <div style='padding:0 25px;font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;font-size:14px;color:#5f5f5f;line-height: 23px;'>
                                                                We are excited to share our first step to take matters into our own hands to save our only earth by bringing changes in lives of each and everyone joining with us.<br /><br />
                                                                With an ever improving platform to explore and connect with organizations and environmental professionals, it's an open world to bring out the tree-huggers inside each one of us into action. We want you to expand our network and exchange more ideas and services for a better world.<br /><br />
                                                                To experience the change click below 
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <a href='https://www.worthact.com' target='_blank' style='font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;display:block;width:120px;background-color:#fe5e3a;padding:12px 10px;color:#FFF;text-decoration:none;text-align:center;border-radius:2px;font-size:12px;font-weight: bold;margin:0px 0px 25px 0px;'>Check Now</a>
                                            </center>
                                            </td>
                                            </tr>
                                            <tr>
                                                <td style='padding: 15px 10px 0px;border-top:1px solid #DDD;background-color: #F3F3F3;' align='center'>
                                                    <div style='max-width:400px;'>
                                                        <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                                        <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                                        <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                                        <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                                        <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                                        <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <table cellpadding='0' cellspacing='0' width='600'>
                                            <tr>
                                                <td style='padding: 15px 0px 10px 0px;'>
                                                    <div style='color: #787878;font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;font-size: 12px;text-align:center;line-height:12px;'>
                                                        This message was sent to you on behalf of $name's request.
                                                        <div style='margin-top:10px;'>© All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                                            <tr>
                                         <td align='center'>
                                         <div style='max-width:400px'>
                                            <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                         </div>
                                         </td>
                                         </tr>
                                        </table>
                                    </center>
                                </div>
                            </body>
                        </html>";
        $msg_personal = "<!DOCTYPE html>
                        <html>
                            <head>
                                <meta https-equiv='Content-Type' content='text/html; charset=utf-8' />
                                <meta charset='utf-8'>
                                <title>$name invited you to visit WorthAct</title>
                            </head>
                            <body>
                                <div style='width:100%;'>
                                    <center>
                                        <table cellpadding='0' cellspacing='0' border='0' width='600' style='margin-bottom:1px;margin-top: 50px;'>
                                            <tr>
                                                <td style='text-align:left;vertical-align:middle;height:30px;padding-top:5px;'><a href='https://www.worthact.com'><img src='".base_url('assets/img/logo-bold.png')."' style='display:block;width:160px;height:50px;margin: 0 auto 15px;' alt='WorthAct'></a></td>
                                            </tr>
                                        </table>
                                        <table cellpadding='0' cellspacing='0' border='0' width='600' style='border: 1px solid #DDD;'>
                                            <tr>
                                                <td style='background-color: #fe5e3a;vertical-align:middle;  height: 150px;'>
                                                    <table cellpadding='0' cellspacing='0' width='100%'>
                                                        <tr>
                                                            <td style='padding:17px 0px 17px 20px;width:100px;'>
                                                                <img src='".base_url(($this->info->propic != '') ? 'assets/userdata/dashboard/propic/'.$this->info->propic : 'assets/img/'.$this->placeholder)."' style='display:block;border-radius:100%;border: 3px solid #ff7978;width:100px;height:100px;margin-right: 20px;' alt='$name'>
                                                            </td>
                                                            <td style='padding:20px 0px 20px 11px;vertical-align:middle;'>
                                                                <div style='font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;color:#FFF;font-size: 14px;text-align:left;line-height:27px;margin-right: 25px;'><b>$name</b> invited you to join WorthAct.</div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style='background-color: #F3F3F3;border-top:1px solid #E5E5E5;'>
                                            <center>
                                                <table cellpadding='0' cellspacing='0' width='100%' style='margin-bottom:20px;'>
                                                    <tr>
                                                        <td>
                                                            <div style='padding:25px 25px 0;font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;font-size:14px;color:#5f5f5f;line-height: 23px;'>
                                                                Hey, <br /><br />
                                                                $msg
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <a href='https://www.worthact.com' target='_blank' style='font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;display:block;width:120px;background-color:#fe5e3a;padding:12px 10px;color:#FFF;text-decoration:none;text-align:center;border-radius:2px;font-size:12px;font-weight: bold;margin:0px 0px 25px 0px;'>Check Now</a>
                                            </center>
                                            </td>
                                            </tr>
                                            <tr>
                                                <td style='padding: 15px 10px 0px;border-top:1px solid #DDD;background-color: #F3F3F3;' align='center'>
                                                    <div style='max-width:400px;'>
                                                        <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                                        <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                                        <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                                        <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                                        <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                                        <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <table cellpadding='0' cellspacing='0' width='600'>
                                            <tr>
                                                <td style='padding: 15px 0px 10px 0px;'>
                                                    <div style='color: #787878;font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;font-size: 12px;text-align:center;line-height:12px;'>
                                                        This message was sent to you on behalf of $name's request.
                                                        <div style='margin-top:10px;'>© All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                                            <tr>
                                         <td align='center'>
                                         <div style='max-width:400px'>
                                            <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                         </div>
                                         </td>
                                         </tr>
                                        </table>
                                    </center>
                                </div>
                            </body>
                        </html>";
        $email_sub = "Invitation - WorthAct";
        if($type == 1) {
            $this->send_email($msg_general, $email_sub, $email);
        } else {
            $this->send_email($msg_personal, $email_sub, $email);
        }
    }

    public function contact($email, $name, $sub, $msg) {
        $msg = "<table style='border-collapse:collapse;line-height:24px;margin:0;padding:0;width:100%;font-size:17px;color:#373737;' border='0' cellpadding='0' cellspacing='0' width='100%'>
                <tbody>
                <tr>
                <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse' valign='top'>
                <table style='border-collapse:collapse' border='0' cellpadding='0' cellspacing='0' width='100%'>
                    <tbody>
                        <tr>
                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse;padding:50px 16px 12px' valign='bottom'>
                                <div style='text-align:center'> <a href='httpss://www.worthact.com' style='color:#439fe0;font-weight:bold;text-decoration:none;word-break:break-word' target='_blank' data-saferedirecturl='https://www.worthact.com'> <img src='".base_url('assets/img/logo-bold.png')."' style='outline:none;text-decoration:none;border:none' height='50' width='160'></a> </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </td>
                </tr>
                <tr>
                <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse' valign='top'>
                <table style='border-collapse:collapse;background:#ececec;border-radius:4px;margin-bottom:10px' align='center' border='0' cellpadding='32' cellspacing='0'>
                    <tbody>
                        <tr>
                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse;padding: 25px 35px 25px;' valign='top' width='546'>
                                <div style='max-width:600px;margin:0 auto'>
                                    <div style='background:#ececec;'>
                                        <h4 style='text-align: center; font-size: 22px;color:#666;'>Contact Message</h4>
                                        <p style='font-size: 16px;line-height: 22px;color:#666;'><strong>Name:</strong> $name</p>
                                        <p style='font-size:16px;line-height:22px;color:#666;'><strong>Email:</strong> $email</p>
                                        <p style='font-size:16px;line-height:22px;color:#666;'><strong>Subject:</strong> $sub</p>
                                        <p style='font-size:16px;line-height:22px;margin: 0 0 10px;color:#666;'><strong>Message:</strong> $msg</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </td>
                </tr>
                <tr>
                </tbody>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom:10px'>
                <tr>
                <td>
                <div style='color: #ababab;font-family:Verdana,Arial;font-size: 12px;line-height:17px; text-align: center'>
                © All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a>
                </div>
                </td>
                </tr>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                    <tr>
                 <td align='center'>
                 <div style='max-width:400px'>
                    <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                 </div>
                 </td>
                 </tr>
                </table>";
        $email_sub = "Contact Form Submission - WorthAct";
        $to = "getintouch@worthact.com";
        $this->send_email($msg, $email_sub, $to);
    }
    
    public function report($email, $name, $sub, $msg) {
        $msg = "<table style='border-collapse:collapse;line-height:24px;margin:0;padding:0;width:100%;font-size:17px;color:#373737;' border='0' cellpadding='0' cellspacing='0' width='100%'>
                <tbody>
                <tr>
                <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse' valign='top'>
                <table style='border-collapse:collapse' border='0' cellpadding='0' cellspacing='0' width='100%'>
                    <tbody>
                        <tr>
                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse;padding:50px 16px 12px' valign='bottom'>
                                <div style='text-align:center'> <a href='httpss://www.worthact.com' style='color:#439fe0;font-weight:bold;text-decoration:none;word-break:break-word' target='_blank' data-saferedirecturl='https://www.worthact.com'> <img src='".base_url('assets/img/logo-bold.png')."' style='outline:none;text-decoration:none;border:none' height='50' width='160'></a> </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </td>
                </tr>
                <tr>
                <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse' valign='top'>
                <table style='border-collapse:collapse;background:#ececec;border-radius:4px;margin-bottom:10px' align='center' border='0' cellpadding='32' cellspacing='0'>
                    <tbody>
                        <tr>
                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse;padding: 25px 35px 25px;' valign='top' width='546'>
                                <div style='max-width:600px;margin:0 auto'>
                                    <div style='background:#ececec;'>
                                        <h4 style='text-align: center; font-size: 22px;color:#666;'>Report Message</h4>
                                        <p style='font-size: 16px;line-height: 22px;color:#666;'><strong>Name:</strong> $name</p>
                                        <p style='font-size:16px;line-height:22px;color:#666;'><strong>Email:</strong> $email</p>
                                        <p style='font-size:16px;line-height:22px;color:#666;'><strong>Subject:</strong> $sub</p>
                                        <p style='font-size:16px;line-height:22px;margin: 0 0 10px;color:#666;'><strong>Message:</strong> $msg</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </td>
                </tr>
                <tr>
                </tbody>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom:10px'>
                <tr>
                <td>
                <div style='color: #ababab;font-family:Verdana,Arial;font-size: 12px;line-height:17px; text-align: center'>
                © All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a>
                </div>
                </td>
                </tr>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                    <tr>
                 <td align='center'>
                 <div style='max-width:400px'>
                    <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                 </div>
                 </td>
                 </tr>
                </table>";
        $email_sub = "Report Form Submission - WorthAct";
        $to = "getintouch@worthact.com";
        $this->send_email($msg, $email_sub, $to);
    }
    
    public function reminder_profile_incomplete($email) {
        $msg = "<table style='border-collapse:collapse;line-height:24px;margin:80px auto 0;padding:0;width:100%;font-size:17px;color:#373737;width: 546px'  border='0' cellpadding='0' cellspacing='0'>
                    <tbody>
                        <tr>
                            <td width='546' height='150' style='background: rgba(64, 66, 87, 0.65) url(".base_url('assets/img/plant.jpg').") 0 0 no-repeat; background-size: cover;border-radius: 4px 4px 0 0;'>
                                <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='height:100%;background-color:rgba(64, 66, 87, 0.73);border-radius: 4px 4px 0 0;'>
                                    <tbody>
                                        <tr>
                                            <td valign='center' data-bgcolor='Header'>
                                                <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;font-size: 32px; color: #FFFFFF;'>
                                                    <tbody>
                                                        <tr>
                                                            <td align='center'>
                                                                <img height='55' src='".base_url('assets/img/logo-orange.png')."' border='0' style='display: block;' data-crop='false'>
                                                                     <h4 style='text-align: center; font-size: 22px;color: #fff;margin: 15px 0 0'>Profile Completion Reminder</h4>     
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
                        <tr>
                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse' valign='top'>
                                <table style='border-collapse:collapse;background:#ececec;border-radius:0 0 4px 4px;margin-bottom:10px' align='center' border='0' cellpadding='32' cellspacing='0'>
                                    <tbody>
                                        <tr>
                                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse;padding: 25px 35px 10px;' valign='top' width='546'>
                                                <div style='max-width:600px;margin:0 auto'>
                                                    <div style='background:#ececec;'>
                                                        <p style='font-size: 16px;line-height: 22px;color: #666'><b>Salute!</b></p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0 0 20px;color: #666'>Your initiation to become a part of WorthAct family is much appreciated. One step at a time, we can do the impossibles!</p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0 0 20px;color: #666'>Many of us have great ideas, but it is the motivation we lack, the little push! This is the push, a reminder for you to complete your <a href='https://www.worthact.com'>profile</a> to reach out more and make things happen.</p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0;color: #666'>Kind Regards,</p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0 0 20px;color: #666'>WorthAct Initiatives</p>
                                                        <p style='text-align: center;font-size:13px;line-height:24px;margin:0 0 15px;color: #777'>For any queries, reach us at <a href='mailto:getintouch@worthact.com'>getintouch@worthact.com</a></p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                    </tbody>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 10px;'>
                    <tr>
                        <td>
                            <div style='color: #ababab;font-family:Verdana,Arial;font-size: 12px;line-height:17px; text-align: center'>
                                © All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a>
                            </div>
                        </td>
                    </tr>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                    <tr>
                        <td align='center'>
                            <div style='max-width:400px'>
                                <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                            </div>
                        </td>
                    </tr>
                </table>";
        $email_sub = "Profile Completion Reminder - WorthAct";
        $email_to = $email;
        $this->send_email($msg, $email_sub, $email_to);
    }
    
    public function reminder_active_free_upgrade($email, $name) {
        $msg = "<table style='border-collapse:collapse;line-height:24px;margin:80px auto 0;padding:0;width:100%;font-size:17px;color:#373737;width: 546px' border='0' cellpadding='0' cellspacing='0'>
                    <tbody>
                        <tr>
                            <td width='546' height='150' style='background: rgba(64, 66, 87, 0.65) url(".base_url('assets/img/plant.jpg').") 0 0 no-repeat; background-size: cover;border-radius: 4px 4px 0 0;'>
                                <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='height:100%;background-color:rgba(64, 66, 87, 0.73);border-radius: 4px 4px 0 0;'>
                                    <tbody>
                                        <tr>
                                            <td valign='center' data-bgcolor='Header'>
                                                <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;font-size: 32px; color: #FFFFFF;'>
                                                    <tbody>
                                                        <tr>
                                                            <td align='center'>
                                                                <img height='55' src='".base_url('assets/img/logo-orange.png')."' border='0' style='display: block;' data-crop='false'>
                                                                     <h4 style='text-align: center; font-size: 22px;color: #fff;margin: 15px 0 0'>Upgrade to Premium Member</h4>     
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
                        <tr>
                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse' valign='top'>
                                <table style='border-collapse:collapse;background:#ececec;border-radius:0 0 4px 4px;margin-bottom:10px' align='center' border='0' cellpadding='32' cellspacing='0'>
                                    <tbody>
                                        <tr>
                                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse;padding: 25px 35px 10px;' valign='top' width='546'>
                                                <div style='max-width:600px;margin:0 auto'>
                                                    <div style='background:#ececec;'>
                                                        <p style='font-size: 16px;line-height: 22px;color: #666'><b>Dear $name,</b></p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0 0 20px;color: #666'>WorthAct team is happy to have you and would like to thank you for showing consistent confidence in our services. Being our loyal member we would like to take this opportunity to interpret about our Premium membership and its privileges that can enhance your network for much prominent accomplishments. Below are some of the benefits you can avail, being a premium member:</p>
                                                        <ul style='margin: 0 0 20px;padding: 0 0 0 15px;'>
                                                            <li style='font-size:16px;line-height:32px;color: #666'>Create awareness by sharing materials similar to your thoughts and ideas.</li>
                                                            <li style='font-size:16px;line-height:32px;color: #666'>Full access to our blog features to express ideas better.</li>
                                                            <li style='font-size:16px;line-height:32px;color: #666'>A Job Portal with an unlimited profile reach.</li>
                                                            <li style='font-size:16px;line-height:32px;color: #666'>Privilege to create groups and discussions.</li>
                                                            <li style='font-size:16px;line-height:32px;color: #666'>Provide guidance and support to the needy through various methods; legal, technological, financial etc.</li>
                                                            <li style='font-size:16px;line-height:32px;color: #666'>Get more involved in making this world better.</li>
                                                        </ul>
                                                        <p style='font-size:16px;line-height:32px;margin: 0;color: #666'>Kind Regards,</p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0 0 20px;color: #666'>WorthAct Initiatives</p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                    </tbody>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 10px;'>
                    <tr>
                        <td>
                            <div style='color: #ababab;font-family:Verdana,Arial;font-size: 12px;line-height:17px; text-align: center'>
                                © All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a>
                            </div>
                        </td>
                    </tr>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                    <tr>
                        <td align='center'>
                            <div style='max-width:400px'>
                                <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                            </div>
                        </td>
                    </tr>
                </table>";
        $email_sub = "Upgrade to Premium Member - WorthAct";
        $email_to = $email;
        $this->send_email($msg, $email_sub, $email_to);
    }
    
    public function reminder_inactive_free_user($email, $name) {
        $msg = "<table style='border-collapse:collapse;line-height:24px;margin:80px auto 0;padding:0;width:100%;font-size:17px;color:#373737;width: 546px'  border='0' cellpadding='0' cellspacing='0' >
                    <tbody>
                        <tr>
                            <td width='546' height='150' style='background: rgba(64, 66, 87, 0.65) url(".base_url('assets/img/plant.jpg').") 0 0 no-repeat; background-size: cover;border-radius: 4px 4px 0 0;'>
                                <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='height:100%;background-color:rgba(64, 66, 87, 0.73);border-radius: 4px 4px 0 0;'>
                                    <tbody>
                                        <tr>
                                            <td valign='center' data-bgcolor='Header'>
                                                <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;font-size: 32px; color: #FFFFFF;'>
                                                    <tbody>
                                                        <tr>
                                                            <td align='center'>
                                                                <img height='55' src='".base_url('assets/img/logo-orange.png')."' border='0' style='display: block;' data-crop='false'>
                                                                     <h4 style='text-align: center; font-size: 22px;color: #fff;margin: 15px 0 0'>We Need You</h4>     
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
                        <tr>
                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse' valign='top'>
                                <table style='border-collapse:collapse;background:#ececec;border-radius:0 0 4px 4px;margin-bottom:10px' align='center' border='0' cellpadding='32' cellspacing='0'>
                                    <tbody>
                                        <tr>
                                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse;padding: 25px 35px 10px;' valign='top' width='546'>
                                                <div style='max-width:600px;margin:0 auto'>
                                                    <div style='background:#ececec;'>
                                                        <p style='font-size: 16px;line-height: 22px;color: #666'><b>Dear $name,</b></p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0 0 20px;color: #666'>We have noticed your profile on WorthAct Initiatives' has been inactive for a while now. Remember all it takes is a tiny pebble to make big ripples in a lake. Below we suggest some of the facilities to make your membership with us more interesting:</p>
                                                        <ul style='margin: 0 0 20px;padding: 0 0 0 15px;'>
                                                            <li style='font-size:16px;line-height:32px;color: #666'>Share posts creating awareness from your region.</li>
                                                            <li style='font-size:16px;line-height:32px;color: #666'>Share your concerns about socio - environmental issues.</li>
                                                            <li style='font-size:16px;line-height:32px;color: #666'>Spread our message to your friends and family through respective social medias available, or through word spread.</li>
                                                            <li style='font-size:16px;line-height:32px;color: #666'>Learn from our updated data or through posts and ads from other members.</li>
                                                        </ul>
                                                        <p style='font-size:16px;line-height:32px;margin: 0 0 20px;color: #666'>We need you and your efforts to make our world a better place.</p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0;color: #666'>Kind Regards,</p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0 0 20px;color: #666'>WorthAct Initiatives</p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                    </tbody>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 10px;'>
                    <tr>
                        <td>
                            <div style='color: #ababab;font-family:Verdana,Arial;font-size: 12px;line-height:17px; text-align: center'>
                                © All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a>
                            </div>
                        </td>
                    </tr>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                    <tr>
                        <td align='center'>
                            <div style='max-width:400px'>
                                <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                            </div>
                        </td>
                    </tr>
                </table>";
        $email_sub = "We Need You - WorthAct";
        $email_to = $email;
        $this->send_email($msg, $email_sub, $email_to);
    }
    
    public function reminder_inactive_pre_user($email, $name) {
        $msg = "<table style='border-collapse:collapse;line-height:24px;margin:80px auto 0;padding:0;width:100%;font-size:17px;color:#373737;width: 546px' border='0' cellpadding='0' cellspacing='0'>
                    <tbody>
                        <tr>
                            <td width='546' height='150' style='background: rgba(64, 66, 87, 0.65) url(".base_url('assets/img/plant.jpg').") 0 0 no-repeat; background-size: cover;border-radius: 4px 4px 0 0;'>
                                <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='height:100%;background-color:rgba(64, 66, 87, 0.73);border-radius: 4px 4px 0 0;'>
                                    <tbody>
                                        <tr>
                                            <td valign='center' data-bgcolor='Header'>
                                                <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;font-size: 32px; color: #FFFFFF;'>
                                                    <tbody>
                                                        <tr>
                                                            <td align='center'>
                                                                <img height='55' src='".base_url('assets/img/logo-orange.png')."' border='0' style='display: block;' data-crop='false'>
                                                                     <h4 style='text-align: center; font-size: 22px;color: #fff;margin: 15px 0 0'>We Need You</h4>     
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
                        <tr>
                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse' valign='top'>
                                <table style='border-collapse:collapse;background:#ececec;border-radius:0 0 4px 4px;margin-bottom:10px' align='center' border='0' cellpadding='32' cellspacing='0'>
                                    <tbody>
                                        <tr>
                                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse;padding: 25px 35px 10px;' valign='top' width='546'>
                                                <div style='max-width:600px;margin:0 auto'>
                                                    <div style='background:#ececec;'>
                                                        <p style='font-size: 16px;line-height: 22px;color: #666'><b>Dear $name,</b></p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0 0 20px;color: #666'>Its been a while! We need you, our earth needs you ! We have noticed your profile on WorthAct Initiatives' has been inactive for a while now and want to give you a nudge in the right direction. To increase your chances to make this world better again, we suggest some of our facilities you can avail:</p>
                                                        <ul style='margin: 0 0 20px;padding: 0 0 0 15px;'>
                                                            <li style='font-size:16px;line-height:32px;color: #666'>Create awareness by sharing materials similar to your thoughts and ideas.</li>
                                                            <li style='font-size:16px;line-height:32px;color: #666'>Creating groups or blogs to form a community who shares similar interests and make an impact on specific subject.</li>
                                                            <li style='font-size:16px;line-height:32px;color: #666'>Connect with professionals or experts and individuals.</li>
                                                            <li style='font-size:16px;line-height:32px;color: #666'>Provide guidance and support to the needy through various methods; legal, technological, financial etc.</li>
                                                            <li style='font-size:16px;line-height:32px;color: #666'>Provide suggestions or advice if any, to improve our platform and its functions.</li>
                                                        </ul>
                                                        <p style='font-size:16px;line-height:32px;margin: 0 0 20px;color: #666'>We need you and your efforts to make our world a better place.</p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0;color: #666'>Kind Regards,</p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0 0 20px;color: #666'>WorthAct Initiatives</p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                    </tbody>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 10px;'>
                    <tr>
                        <td>
                            <div style='color: #ababab;font-family:Verdana,Arial;font-size: 12px;line-height:17px; text-align: center'>
                                © All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a>
                            </div>
                        </td>
                    </tr>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                    <tr>
                        <td align='center'>
                            <div style='max-width:400px'>
                                <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                            </div>
                        </td>
                    </tr>
                </table>";
        $email_sub = "We Need You - WorthAct";
        $email_to = $email;
        $this->send_email($msg, $email_sub, $email_to);
    }
    
    public function reminder_invitation($email) {
        $msg = "<table style='border-collapse:collapse;line-height:24px;margin:80px auto 0;padding:0;width:100%;font-size:17px;color:#373737;width: 546px'  border='0' cellpadding='0' cellspacing='0'>
                    <tbody>
                        <tr>
                            <td width='546' height='150' style='background: rgba(64, 66, 87, 0.65) url(".base_url('assets/img/plant.jpg').") 0 0 no-repeat; background-size: cover;border-radius: 4px 4px 0 0;'>
                                <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='height:100%;background-color:rgba(64, 66, 87, 0.73);border-radius: 4px 4px 0 0;'>
                                    <tbody>
                                        <tr>
                                            <td valign='center' data-bgcolor='Header'>
                                                <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;font-size: 32px; color: #FFFFFF;'>
                                                    <tbody>
                                                        <tr>
                                                            <td align='center'>
                                                                <img height='55' src='".base_url('assets/img/logo-orange.png')."' border='0' style='display: block;' data-crop='false'>
                                                                     <h4 style='text-align: center; font-size: 22px;color: #fff;margin: 15px 0 0'>We Need You</h4>     
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
                        <tr>
                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse' valign='top'>
                                <table style='border-collapse:collapse;background:#ececec;border-radius:0 0 4px 4px;margin-bottom:10px' align='center' border='0' cellpadding='32' cellspacing='0'>
                                    <tbody>
                                        <tr>
                                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse;padding: 25px 35px 10px;' valign='top' width='546'>
                                                <div style='max-width:600px;margin:0 auto'>
                                                    <div style='background:#ececec;'>
                                                        <p style='font-size: 16px;line-height: 22px;color: #666'><b>Hi,</b></p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0 0 20px;color: #666'>We have noticed that you have not yet had the opportunity to accept our invitation. We place great value on your time, and this process should take less than 5 minutes to complete. To start, click on the 'Join' button below! This is just to engage a bit of your participation to make this world better.</p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0 0 20px;color: #666'>All information collected will be used in accordance with WorthAct Initiatives' privacy policy. We appreciate your participation and look forward to hearing from you.</p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0 0 20px;color: #666'>In case you have already registered, please ignore this email.</p>
                                                        <table style='border-collapse:collapse;width:100%'>
                                                            <tbody>
                                                                <tr style='width:100%; text-align: center;'>
                                                                    <td><span style='display:inline-block;border-radius:2px;'><a href='https://www.worthact.com' style='color:white;font-weight:normal;text-decoration:none;font-size: 16px;padding: 12px 35px;background: #fe5e3a;border-radius: 2px;' target='_blank' data-saferedirecturl='https://www.worthact.com'>Join Now</a></span></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <p style='font-size:16px;line-height:32px;margin: 30px 0 20px;color: #666'>We need you and your efforts to make our world a better place.</p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0;color: #666'>Kind Regards,</p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0 0 20px;color: #666'>WorthAct Initiatives</p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                    </tbody>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 10px;'>
                    <tr>
                        <td>
                            <div style='color: #ababab;font-family:Verdana,Arial;font-size: 12px;line-height:17px; text-align: center'>
                                © All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a>
                            </div>
                        </td>
                    </tr>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                    <tr>
                        <td align='center'>
                            <div style='max-width:400px'>
                                <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                            </div>
                        </td>
                    </tr>
                </table>";
        $email_sub = "We Need You - WorthAct";
        $email_to = $email;
        $this->send_email($msg, $email_sub, $email_to);
    }
    
    public function job_portal_reminder($email, $name) {
        $msg = "<table  style='border-collapse:collapse;line-height:24px;margin:80px auto 0;padding:0;width:100%;font-size:17px;color:#373737;width: 546px' border='0' cellpadding='0' cellspacing='0'>
                    <tbody>
                        <tr>
                            <td width='546' height='150' style='background: rgba(64, 66, 87, 0.65) url(".base_url('assets/img/plant.jpg').") 0 0 no-repeat; background-size: cover;border-radius: 4px 4px 0 0;'>
                                <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='height:100%;background-color:rgba(64, 66, 87, 0.73);border-radius: 4px 4px 0 0;'>
                                    <tbody>
                                        <tr>
                                            <td valign='center' data-bgcolor='Header'>
                                                <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;font-size: 32px; color: #FFFFFF;'>
                                                    <tbody>
                                                        <tr>
                                                            <td align='center'>
                                                                <img height='55' src='".base_url('assets/img/logo-orange.png')."' border='0' style='display: block;' data-crop='false'>
                                                                     <h4 style='text-align: center; font-size: 22px;color: #fff;margin: 15px 0 0'>Register your CV with us</h4>     
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
                        <tr>
                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse' valign='top'>
                                <table style='border-collapse:collapse;background:#ececec;border-radius:0 0 4px 4px;margin-bottom:10px' align='center' border='0' cellpadding='32' cellspacing='0'>
                                    <tbody>
                                        <tr>
                                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse;padding: 25px 35px 10px;' valign='top' width='546'>
                                                <div style='max-width:600px;margin:0 auto'>
                                                    <div style='background:#ececec;'>
                                                        <p style='font-size: 16px;line-height: 22px;color: #666'><b>Dear $name,</b></p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0 0 20px;color: #666'>With WorthAct Initiatives' gradual growth, we wish to assist our valuable members to find their dream jobs. Upload your CV and make job hunting easier. Sign-up to our jobs portal and get the latest vacancies delivered the second they are added to our system.</p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0 0 20px;color: #666'>Registering your details with Worthact Initiatives' Job portal is easy and only takes a couple of minutes.</p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0 0 20px;color: #666'>Have any queries? Please do not hesitate to contact us. PS: If you are not interested in Job related emails, go to settings and disable job portal.</p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0;color: #666'>Kind Regards,</p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0 0 20px;color: #666'>WorthAct Initiatives</p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                    </tbody>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 10px;'>
                    <tr>
                        <td>
                            <div style='color: #ababab;font-family:Verdana,Arial;font-size: 12px;line-height:17px; text-align: center'>
                                © All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a>
                            </div>
                        </td>
                    </tr>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                    <tr>
                        <td align='center'>
                            <div style='max-width:400px'>
                                <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                            </div>
                        </td>
                    </tr>
                </table>";
        $email_sub = "Register your CV with us - WorthAct";
        $email_to = $email;
        $this->send_email($msg, $email_sub, $email_to);
    }
    
    public function wi_reminder($email, $name) {
        $msg = "<table style='border-collapse:collapse;line-height:24px;margin:80px auto 0;padding:0;width:100%;font-size:17px;color:#373737;width: 546px' border='0' cellpadding='0' cellspacing='0'>
                    <tbody>
                        <tr>
                            <td width='546' height='150' style='background: rgba(64, 66, 87, 0.65) url(".base_url('assets/img/plant.jpg').") 0 0 no-repeat; background-size: cover;border-radius: 4px 4px 0 0;'>
                                <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='height:100%;background-color:rgba(64, 66, 87, 0.73);border-radius: 4px 4px 0 0;'>
                                    <tbody>
                                        <tr>
                                            <td valign='center' data-bgcolor='Header'>
                                                <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;font-size: 32px; color: #FFFFFF;'>
                                                    <tbody>
                                                        <tr>
                                                            <td align='center'>
                                                                <img height='55' src='".base_url('assets/img/logo-orange.png')."' border='0' style='display: block;' data-crop='false'>
                                                                     <h4 style='text-align: center; font-size: 22px;color: #fff;margin: 15px 0 0'>We need you</h4>     
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
                        <tr>
                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse' valign='top'>
                                <table style='border-collapse:collapse;background:#ececec;border-radius:0 0 4px 4px;margin-bottom:10px' align='center' border='0' cellpadding='32' cellspacing='0'>
                                    <tbody>
                                        <tr>
                                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse;padding: 25px 35px 10px;' valign='top' width='546'>
                                                <div style='max-width:600px;margin:0 auto'>
                                                    <div style='background:#ececec;'>
                                                        <p style='font-size: 16px;line-height: 22px;color: #666'><b>Dear $name,</b></p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0 0 20px;color: #666'>Have you done anything lately for Mother Earth? It is more fruitful when you are giving something back.</p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0 0 20px;color: #666'>We all are wrapped up in our own little worlds being so busy and stretched for time.  Once in a while, when you give someone a warm 'Hello', you could just be making someone's day!  It is the most elemental and universal rule of etiquette that if you take something, you put it back; if you use something, you replace it. While saving and conserving are admirable virtues to be commended and encouraged, being generous and proactively responsive is equally crucial to our survival. Take less. Give more. It is payback time!</p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0 0 20px;color: #666'>Earth is calling for help and you have to hear out! Explore the WorthAct <b style='color:#fe5e3a'>Initiatives</b> and push yourself for the change. Choose the <b style='color:#fe5e3a'>SOS Actions</b> to publish your achievements and be an inspiration.</p>
                                                        <p style='font-size:16px;line-height:32px;margin: 30px 0 20px;color: #666'>We need you and your efforts to make our world a better place.</p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0;color: #666'>Kind Regards,</p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0 0 20px;color: #666'>WorthAct Initiatives</p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                    </tbody>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 10px;'>
                    <tr>
                        <td>
                            <div style='color: #ababab;font-family:Verdana,Arial;font-size: 12px;line-height:17px; text-align: center'>
                                © All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a>
                            </div>
                        </td>
                    </tr>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                    <tr>
                        <td align='center'>
                            <div style='max-width:400px'>
                                <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                            </div>
                        </td>
                    </tr>
                </table>";
        $email_sub = "We need you - WorthAct";
        $email_to = $email;
        $this->send_email($msg, $email_sub, $email_to);
    }
    
    public function connection_email($email) {
        $name = ($this->info->type_id == 1) ? ucfirst(strtolower($this->info->firstname)) . ' ' . ucfirst(strtolower($this->info->lastname)) : ucfirst(strtolower($this->info->name));
        $msg = "<!DOCTYPE html>
                        <html>
                            <head>
                                <meta https-equiv='Content-Type' content='text/html; charset=utf-8' />
                                <meta charset='utf-8'>
                                <title>$name wants to be friends with you on WorthAct</title>
                            </head>
                            <body>
                                <div style='width:100%;'>
                                    <center>
                                        <table cellpadding='0' cellspacing='0' border='0' width='600' style='margin-bottom:1px;margin-top: 50px;'>
                                            <tr>
                                                <td style='text-align:left;vertical-align:middle;height:30px;padding-top:5px;'><a href='https://www.worthact.com'><img src='".base_url('assets/img/logo-bold.png')."' style='display:block;width:160px;height:50px;margin: 0 auto 15px;' alt='WorthAct'></a></td>
                                            </tr>
                                        </table>
                                        <table cellpadding='0' cellspacing='0' border='0' width='600' style='border: 1px solid #DDD;'>
                                            <tr>
                                                <td style='background-color: #fe5e3a;vertical-align:middle;  height: 150px;'>
                                                    <table cellpadding='0' cellspacing='0' width='100%'>
                                                        <tr>
                                                            <td style='padding:17px 0px 17px 20px;width:100px;'>
                                                                <img src='".base_url(($this->info->propic != '') ? 'assets/userdata/dashboard/propic/'.$this->info->propic : 'assets/img/'.$this->placeholder)."' style='display:block;border-radius:100%;border: 3px solid #ff7978;width:100px;height:100px;margin-right: 20px;' alt='$name'>
                                                            </td>
                                                            <td style='padding:20px 0px 20px 11px;vertical-align:middle;'>
                                                                <div style='font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;color:#FFF;font-size: 14px;text-align:left;line-height:27px;margin-right: 25px;'><b>$name</b> wants to connect with you on WorthAct - for a better world.</div>
                                                                <a href='".base_url('dashboard/profile/'.$this->session->userdata('user_id'))."' target='_blank' style='margin-top: 15px;font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;display:block;width:120px;background-color:#6fb943;padding:12px 10px;color:#FFF;text-decoration:none;text-align:center;border-radius:2px;font-size:12px;font-weight: bold;'>Check Now</a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <table cellpadding='0' cellspacing='0' width='600'>
                                            <tr>
                                                <td style='padding: 10px 0px 10px 0px;'>
                                                    <div style='color: #787878;font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;font-size: 12px;text-align:center;line-height:12px;'>
                                                        This message was sent to you on behalf of $name's request.
                                                        <div style='margin-top:10px;'>© All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                                            <tr>
                                         <td align='center'>
                                         <div style='max-width:400px'>
                                            <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                         </div>
                                         </td>
                                         </tr>
                                        </table>
                                    </center>
                                </div>
                            </body>
                        </html>";
        $email_sub = "Connection Request - WorthAct";
        $email_to = $email;
        $this->send_email($msg, $email_sub, $email_to);
    }
    
    public function career($email, $name, $sub, $msg, $attachment) {
        $msg = "<table style='border-collapse:collapse;line-height:24px;margin:0;padding:0;width:100%;font-size:17px;color:#373737;' border='0' cellpadding='0' cellspacing='0' width='100%'>
                <tbody>
                <tr>
                <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse' valign='top'>
                <table style='border-collapse:collapse' border='0' cellpadding='0' cellspacing='0' width='100%'>
                    <tbody>
                        <tr>
                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse;padding:50px 16px 12px' valign='bottom'>
                                <div style='text-align:center'> <a href='httpss://www.worthact.com' style='color:#439fe0;font-weight:bold;text-decoration:none;word-break:break-word' target='_blank' data-saferedirecturl='https://www.worthact.com'> <img src='".base_url('assets/img/logo-bold.png')."' style='outline:none;text-decoration:none;border:none' height='50' width='160'></a> </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </td>
                </tr>
                <tr>
                <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse' valign='top'>
                <table style='border-collapse:collapse;background:#ececec;border-radius:4px;margin-bottom:10px' align='center' border='0' cellpadding='32' cellspacing='0'>
                    <tbody>
                        <tr>
                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse;padding: 25px 35px 25px;' valign='top' width='546'>
                                <div style='max-width:600px;margin:0 auto'>
                                    <div style='background:#ececec;'>
                                        <h4 style='text-align: center; font-size: 22px;color:#666;'>Candidate Details</h4>
                                        <p style='font-size: 16px;line-height: 22px;color:#666;'><strong>Name:</strong> $name</p>
                                        <p style='font-size:16px;line-height:22px;color:#666;'><strong>Email:</strong> $email</p>
                                        <p style='font-size:16px;line-height:22px;color:#666;'><strong>Subject:</strong> $sub</p>
                                        <p style='font-size:16px;line-height:22px;margin: 0 0 10px;color:#666;'><strong>Cover Letter:</strong> $msg</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </td>
                </tr>
                <tr>
                </tbody>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom:10px'>
                <tr>
                <td>
                <div style='color: #ababab;font-family:Verdana,Arial;font-size: 12px;line-height:17px; text-align: center'>
                © All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a>
                </div>
                </td>
                </tr>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                    <tr>
                 <td align='center'>
                 <div style='max-width:400px'>
                    <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                 </div>
                 </td>
                 </tr>
                </table>";
        $email_sub = "Career Form Submission - WorthAct";
        $to = "careers@worthact.com";
        $this->send_email_attachment($msg, $email_sub, $to, $attachment, 'careers');
    }
    
    public function csr_submission($data, $name, $email) {
        $msg = "<table style='border-collapse:collapse;line-height:24px;margin:0;padding:0;width:100%;font-size:17px;color:#373737;' border='0' cellpadding='0' cellspacing='0' width='100%'>
                <tbody>
                <tr>
                <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse' valign='top'>
                <table style='border-collapse:collapse' border='0' cellpadding='0' cellspacing='0' width='100%'>
                    <tbody>
                        <tr>
                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse;padding:50px 16px 12px' valign='bottom'>
                                <div style='text-align:center'> <a href='httpss://www.worthact.com' style='color:#439fe0;font-weight:bold;text-decoration:none;word-break:break-word' target='_blank' data-saferedirecturl='https://www.worthact.com'> <img src='".base_url('assets/img/logo-bold.png')."' style='outline:none;text-decoration:none;border:none' height='50' width='160'></a> </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </td>
                </tr>
                <tr>
                <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse' valign='top'>
                <table style='border-collapse:collapse;background:#ececec;border-radius:4px;margin-bottom:10px' align='center' border='0' cellpadding='32' cellspacing='0'>
                    <tbody>
                        <tr>
                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse;padding: 25px 35px 25px;' valign='top' width='546'>
                                <div style='max-width:600px;margin:0 auto'>
                                    <div style='background:#ececec;'>
                                        <h4 style='text-align: center; font-size: 22px;color:#666;'>CSR Submission Details</h4>
                                        <p style='font-size: 16px;line-height: 22px;color:#666;'><strong>Name:</strong> $name</p>
                                        <p style='font-size:16px;line-height:22px;color:#666;'><strong>Email:</strong> $email</p>
                                        <p style='font-size:16px;line-height:22px;color:#666;'><strong>User Id:</strong> ".$data['user_id']."</p>
                                        <p style='font-size:16px;line-height:22px;margin: 0 0 10px;color:#666;'><strong>Question 1 Ans :</strong> ".$data['q1']."</p>
                                        <p style='font-size:16px;line-height:22px;margin: 0 0 10px;color:#666;'><strong>Question 2 Ans :</strong> ".$data['q2']."</p>
                                        <p style='font-size:16px;line-height:22px;margin: 0 0 10px;color:#666;'><strong>Question 3 Ans :</strong> ".$data['q3']."</p>
                                        <p style='font-size:16px;line-height:22px;margin: 0 0 10px;color:#666;'><strong>Question 4 Ans :</strong> ".$data['q4']."</p>
                                        <p style='font-size:16px;line-height:22px;margin: 0 0 10px;color:#666;'><strong>Question 5 Ans :</strong> ".$data['q5']."</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </td>
                </tr>
                <tr>
                </tbody>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom:10px'>
                <tr>
                <td>
                <div style='color: #ababab;font-family:Verdana,Arial;font-size: 12px;line-height:17px; text-align: center'>
                © All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a>
                </div>
                </td>
                </tr>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                    <tr>
                 <td align='center'>
                 <div style='max-width:400px'>
                    <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                 </div>
                 </td>
                 </tr>
                </table>";
        $email_sub = "CSR Form Submission - WorthAct";
        $to = "csr@worthact.com";
        $this->send_email_attachment($msg, $email_sub, $to, $data['files'], 'csr');
    }
    
    public function adv_submission($block) {
        $user_id = $block->user_id;
        $block_id = $block->block_id;
        if($block->image != '') { $attachment = $block->image; $type = 'adv_image'; }
        if($block->slider != '') { $attachment = $block->slider; $type = 'adv_slider'; }
        if($block->video != '') { $attachment = $block->video; $type = 'adv_video'; }
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'Zeka5gi6zw30H7i7e4BPL97w';
        $secret_iv = 'P55H480ZZeka5gi6zw30H7i7';
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $href_approve =  base_url('home/approve_adv_booking?u_id=' . base64_encode(openssl_encrypt($user_id, $encrypt_method, $key, 0, $iv)) . '&b_id=' . base64_encode(openssl_encrypt($user_id, $encrypt_method, $key, 0, $iv)));
        $href_delete =  base_url('home/delete_adv_booking?u_id=' . base64_encode(openssl_encrypt($user_id, $encrypt_method, $key, 0, $iv)) . '&b_id=' . base64_encode(openssl_encrypt($user_id, $encrypt_method, $key, 0, $iv)));
        $msg = "<table style='border-collapse:collapse;line-height:24px;margin:0;padding:0;width:100%;font-size:17px;color:#373737;' border='0' cellpadding='0' cellspacing='0' width='100%'>
                <tbody>
                <tr>
                <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse' valign='top'>
                <table style='border-collapse:collapse' border='0' cellpadding='0' cellspacing='0' width='100%'>
                    <tbody>
                        <tr>
                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse;padding:50px 16px 12px' valign='bottom'>
                                <div style='text-align:center'> <a href='httpss://www.worthact.com' style='color:#439fe0;font-weight:bold;text-decoration:none;word-break:break-word' target='_blank' data-saferedirecturl='https://www.worthact.com'> <img src='".base_url('assets/img/logo-bold.png')."' style='outline:none;text-decoration:none;border:none' height='50' width='160'></a> </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </td>
                </tr>
                <tr>
                <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse' valign='top'>
                <table style='border-collapse:collapse;background:#ececec;border-radius:4px;margin-bottom:10px' align='center' border='0' cellpadding='32' cellspacing='0'>
                    <tbody>
                        <tr>
                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse;padding: 25px 35px 25px;' valign='top' width='546'>
                                <div style='max-width:600px;margin:0 auto'>
                                    <div style='background:#ececec;'>
                                        <h4 style='text-align: center; font-size: 22px;color:#666;'>Adv Block Submission</h4>
                                        <p style='font-size: 16px;line-height: 22px;color:#666;'><strong>User ID:</strong> $user_id</p>
                                        <p style='font-size:16px;line-height:22px;color:#666;'><strong>Block ID:</strong> $block_id</p>
                                        <p style='font-size:16px;line-height:22px;color:#666;'><strong>Country:</strong> $block->country</p>
                                        <p style='font-size:16px;line-height:22px;color:#666;'><strong>Heading:</strong> $block->heading</p>
                                        <p style='font-size:16px;line-height:22px;color:#666;'><strong>Description:</strong> $block->description</p>
                                        <p style='font-size:16px;line-height:22px;color:#666;'><strong>Link:</strong> <a href='$block->link' target='_blank'>$block->link</a></p>
                                        <p style='font-size:16px;line-height:22px;color:#666;'><strong>Comments:</strong> $block->comments</p>
                                        <p style='font-size:16px;line-height:22px;color:#666;'><strong><a href='$href_approve'>Click here</a></strong> to approve the ad.</p>
                                        <p style='font-size:16px;line-height:22px;color:#666;'><strong><a href='$href_delete'>Click here</a></strong> to delete the ad.</p>    
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </td>
                </tr>
                <tr>
                </tbody>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom:10px'>
                <tr>
                <td>
                <div style='color: #ababab;font-family:Verdana,Arial;font-size: 12px;line-height:17px; text-align: center'>
                © All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a>
                </div>
                </td>
                </tr>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                    <tr>
                 <td align='center'>
                 <div style='max-width:400px'>
                    <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                 </div>
                 </td>
                 </tr>
                </table>";
        $email_sub = "Adv Booking Submission - WorthAct";
        $to = "advertising@worthact.com";
        $this->send_email_attachment($msg, $email_sub, $to, $attachment, $type);
    }
    
    public function notify_adv_approve($user) {
        $msg = "<table style='border-collapse:collapse;line-height:24px;margin:80px auto 0;padding:0;width:100%;font-size:17px;color:#373737;width: 546px' border='0' cellpadding='0' cellspacing='0'>
                    <tbody>
                        <tr>
                            <td width='546' height='150' style='background: rgba(64, 66, 87, 0.65) url(".base_url('assets/img/plant.jpg').") 0 0 no-repeat; background-size: cover;border-radius: 4px 4px 0 0;'>
                                <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='height:100%;background-color:rgba(64, 66, 87, 0.73);border-radius: 4px 4px 0 0;'>
                                    <tbody>
                                        <tr>
                                            <td valign='center' data-bgcolor='Header'>
                                                <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;font-size: 32px; color: #FFFFFF;'>
                                                    <tbody>
                                                        <tr>
                                                            <td align='center'>
                                                                <img height='55' src='".base_url('assets/img/logo-orange.png')."' border='0' style='display: block;' data-crop='false'>
                                                                     <h4 style='text-align: center; font-size: 22px;color: #fff;margin: 15px 0 0'>Advertising Booking Approval</h4>     
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
                        <tr>
                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse' valign='top'>
                                <table style='border-collapse:collapse;background:#ececec;border-radius:4px;margin-bottom:10px' align='center' border='0' cellpadding='32' cellspacing='0'>
                                    <tbody>
                                        <tr>
                                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse;padding: 25px 35px 10px;' valign='top' width='546'>
                                                <div style='max-width:600px;margin:0 auto'>
                                                    <div style='background:#ececec;'>
                                                        <p style='font-size: 16px;line-height: 22px;color: #666'><b>Hi,</b></p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0 0 20px;color: #666'>Congrulations ! Your ad is successfully published to the site. Come back again to publish more ads.</p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0;color: #666'>Kind Regards,</p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0 0 20px;color: #666'>WorthAct Initiatives</p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                    </tbody>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 10px;'>
                    <tr>
                        <td>
                            <div style='color: #ababab;font-family:Verdana,Arial;font-size: 12px;line-height:17px; text-align: center'>
                                © All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a>
                            </div>
                        </td>
                    </tr>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                    <tr>
                        <td align='center'>
                            <div style='max-width:400px'>
                                <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                            </div>
                        </td>
                    </tr>
                </table>";
        $email_sub = "Advertising Booking Approval - WorthAct";
        $email_to = $user->email;
        $this->send_email($msg, $email_sub, $email_to);
    }
    
    public function notify_adv_delete($user) {
        $msg = "<table style='border-collapse:collapse;line-height:24px;margin:80px auto 0;padding:0;width:100%;font-size:17px;color:#373737;width: 546px' border='0' cellpadding='0' cellspacing='0'>
                    <tbody>
                        <tr>
                            <td width='546' height='150' style='background: rgba(64, 66, 87, 0.65) url(".base_url('assets/img/plant.jpg').") 0 0 no-repeat; background-size: cover;border-radius: 4px 4px 0 0;'>
                                <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='height:100%;background-color:rgba(64, 66, 87, 0.73);border-radius: 4px 4px 0 0;'>
                                    <tbody>
                                        <tr>
                                            <td valign='center' data-bgcolor='Header'>
                                                <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;font-size: 32px; color: #FFFFFF;'>
                                                    <tbody>
                                                        <tr>
                                                            <td align='center'>
                                                                <img height='55' src='".base_url('assets/img/logo-orange.png')."' border='0' style='display: block;' data-crop='false'>
                                                                     <h4 style='text-align: center; font-size: 22px;color: #fff;margin: 15px 0 0'>Advertising Booking Rejection</h4>     
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
                        <tr>
                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse' valign='top'>
                                <table style='border-collapse:collapse;background:#ececec;border-radius:0 0 4px 4px;margin-bottom:10px' align='center' border='0' cellpadding='32' cellspacing='0'>
                                    <tbody>
                                        <tr>
                                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse;padding: 25px 35px 10px;' valign='top' width='546'>
                                                <div style='max-width:600px;margin:0 auto'>
                                                    <div style='background:#ececec;'>
                                                        <p style='font-size: 16px;line-height: 22px;color: #666'><b>Hi,</b></p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0 0 20px;color: #666'>We are sorry. Our technical team as rejected your ad submission. Kindly resubmit your ad again.</p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0;color: #666'>Kind Regards,</p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0 0 20px;color: #666'>WorthAct Initiatives</p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                    </tbody>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 10px;'>
                    <tr>
                        <td>
                            <div style='color: #ababab;font-family:Verdana,Arial;font-size: 12px;line-height:17px; text-align: center'>
                                © All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a>
                            </div>
                        </td>
                    </tr>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                    <tr>
                        <td align='center'>
                            <div style='max-width:400px'>
                                <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                            </div>
                        </td>
                    </tr>
                </table>";
        $email_sub = "Advertising Booking Rejection - WorthAct";
        $email_to = $user->email;
        $this->send_email($msg, $email_sub, $email_to);
    }
    
    public function comment_email($email, $type, $type_id) {
        $t = '';
        $name = ($this->info->type_id == 1) ? ucfirst(strtolower($this->info->firstname)) . ' ' . ucfirst(strtolower($this->info->lastname)) : ucfirst(strtolower($this->info->name));
        if($type == 'blog') { $t = $type; $href = base_url('dashboard/blog/'.$type_id); } elseif($type == 'ad') { $t = 'SOS'; $href = base_url('dashboard/sos/'.$type_id); } elseif($type == 'ad_dislike') { $href = base_url('dashboard/sos/'.$type_id); } else { $t = 'timeline'; $href = base_url('dashboard/recent_activities/'.$type_id); }
        $msg = "<!DOCTYPE html>
                        <html>
                            <head>
                                <meta https-equiv='Content-Type' content='text/html; charset=utf-8' />
                                <meta charset='utf-8'>
                                <title>$name commented on your $t post</title>
                            </head>
                            <body>
                                <div style='width:100%;'>
                                    <center>
                                        <table cellpadding='0' cellspacing='0' border='0' width='600' style='margin-bottom:1px;margin-top: 50px;'>
                                            <tr>
                                                <td style='text-align:left;vertical-align:middle;height:30px;padding-top:5px;'><a href='https://www.worthact.com'><img src='".base_url('assets/img/logo-bold.png')."' style='display:block;width:160px;height:50px;margin: 0 auto 15px;' alt='WorthAct'></a></td>
                                            </tr>
                                        </table>
                                        <table cellpadding='0' cellspacing='0' border='0' width='600' style='border: 1px solid #DDD;'>
                                            <tr>
                                                <td style='background-color: #fe5e3a;vertical-align:middle;  height: 150px;'>
                                                    <table cellpadding='0' cellspacing='0' width='100%'>
                                                        <tr>
                                                            <td style='padding:17px 0px 17px 20px;width:100px;'>
                                                                <img src='".base_url(($this->info->propic != '') ? 'assets/userdata/dashboard/propic/'.$this->info->propic : 'assets/img/'.$this->placeholder)."' style='display:block;border-radius:100%;border: 3px solid #ff7978;width:100px;height:100px;margin-right: 20px;' alt='$name'>
                                                            </td>
                                                            <td style='padding:20px 0px 20px 11px;vertical-align:middle;'>
                                                                <div style='font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;color:#FFF;font-size: 14px;text-align:left;line-height:27px;margin-right: 25px;'><b>$name</b> commented on your $t post.</div>
                                                                <a href='$href' target='_blank' style='margin-top: 15px;font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;display:block;width:130px;background-color:#6fb943;padding:12px 10px;color:#FFF;text-decoration:none;text-align:center;border-radius:2px;font-size:12px;font-weight: bold;'>View & Reply Now</a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <table cellpadding='0' cellspacing='0' width='600'>
                                            <tr>
                                                <td style='padding: 0px 0px 10px 0px;'>
                                                    <div style='color: #787878;font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;font-size: 12px;text-align:center;line-height:12px;'>
                                                        <div style='margin-top:10px;'>© All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                                            <tr>
                                         <td align='center'>
                                         <div style='max-width:400px'>
                                            <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                         </div>
                                         </td>
                                         </tr>
                                        </table>
                                    </center>
                                </div>
                            </body>
                        </html>";
        $email_sub = "$name commented on your $t post - WorthAct";
        $email_to = $email;
        $this->send_email($msg, $email_sub, $email_to);
    }
    
    public function invite_group($email, $group) {
        $name = ($this->info->type_id == 1) ? ucfirst(strtolower($this->info->firstname)) . ' ' . ucfirst(strtolower($this->info->lastname)) : ucfirst(strtolower($this->info->name));
        $href = base_url('dashboard/group/' . $group->main_id);
        $msg = "<!DOCTYPE html>
                        <html>
                            <head>
                                <meta https-equiv='Content-Type' content='text/html; charset=utf-8' />
                                <meta charset='utf-8'>
                                <title>$name invited you to join a group</title>
                            </head>
                            <body>
                                <div style='width:100%;'>
                                    <center>
                                        <table cellpadding='0' cellspacing='0' border='0' width='600' style='margin-bottom:1px;margin-top: 50px;'>
                                            <tr>
                                                <td style='text-align:left;vertical-align:middle;height:30px;padding-top:5px;'><a href='https://www.worthact.com'><img src='".base_url('assets/img/logo-bold.png')."' style='display:block;width:160px;height:50px;margin: 0 auto 15px;' alt='WorthAct'></a></td>
                                            </tr>
                                        </table>
                                        <table cellpadding='0' cellspacing='0' border='0' width='600' style='border: 1px solid #DDD;'>
                                            <tr>
                                                <td style='background-color: #fe5e3a;vertical-align:middle;  height: 150px;'>
                                                    <table cellpadding='0' cellspacing='0' width='100%'>
                                                        <tr>
                                                            <td style='padding:17px 0px 17px 20px;width:100px;'>
                                                                <img src='".base_url(($this->info->propic != '') ? 'assets/userdata/dashboard/propic/'.$this->info->propic : 'assets/img/'.$this->placeholder)."' style='display:block;border-radius:100%;border: 3px solid #ff7978;width:100px;height:100px;margin-right: 20px;' alt='$name'>
                                                            </td>
                                                            <td style='padding:20px 0px 20px 11px;vertical-align:middle;'>
                                                                <div style='font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;color:#FFF;font-size: 14px;text-align:left;line-height:27px;margin-right: 25px;'><b>$name</b> invited you to join a group.</div>
                                                                <div style='font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;color:#FFF;font-size: 14px;text-align:left;line-height:27px;margin-right: 25px;'>Group Name: $group->title</div>
                                                                <a href='$href' target='_blank' style='margin-top: 15px;font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;display:block;width:130px;background-color:#6fb943;padding:12px 10px;color:#FFF;text-decoration:none;text-align:center;border-radius:2px;font-size:12px;font-weight: bold;'>View Now</a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <table cellpadding='0' cellspacing='0' width='600'>
                                            <tr>
                                                <td style='padding: 0px 0px 10px 0px;'>
                                                    <div style='color: #787878;font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;font-size: 12px;text-align:center;line-height:12px;'>
                                                        <div style='margin-top:10px;'>© All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                                            <tr>
                                         <td align='center'>
                                         <div style='max-width:400px'>
                                            <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                         </div>
                                         </td>
                                         </tr>
                                        </table>
                                    </center>
                                </div>
                            </body>
                        </html>";
        $email_sub = "$name invited you to join a group - WorthAct";
        $email_to = $email;
        $this->send_email($msg, $email_sub, $email_to);
    }
    
    public function join_group($email, $group) {
        $name = ($this->info->type_id == 1) ? ucfirst(strtolower($this->info->firstname)) . ' ' . ucfirst(strtolower($this->info->lastname)) : ucfirst(strtolower($this->info->name));
        $href = base_url('dashboard/group/' . $group->main_id);
        $msg = "<!DOCTYPE html>
                        <html>
                            <head>
                                <meta https-equiv='Content-Type' content='text/html; charset=utf-8' />
                                <meta charset='utf-8'>
                                <title>$name wants to join your group</title>
                            </head>
                            <body>
                                <div style='width:100%;'>
                                    <center>
                                        <table cellpadding='0' cellspacing='0' border='0' width='600' style='margin-bottom:1px;margin-top: 50px;'>
                                            <tr>
                                                <td style='text-align:left;vertical-align:middle;height:30px;padding-top:5px;'><a href='https://www.worthact.com'><img src='".base_url('assets/img/logo-bold.png')."' style='display:block;width:160px;height:50px;margin: 0 auto 15px;' alt='WorthAct'></a></td>
                                            </tr>
                                        </table>
                                        <table cellpadding='0' cellspacing='0' border='0' width='600' style='border: 1px solid #DDD;'>
                                            <tr>
                                                <td style='background-color: #fe5e3a;vertical-align:middle;  height: 150px;'>
                                                    <table cellpadding='0' cellspacing='0' width='100%'>
                                                        <tr>
                                                            <td style='padding:17px 0px 17px 20px;width:100px;'>
                                                                <img src='".base_url(($this->info->propic != '') ? 'assets/userdata/dashboard/propic/'.$this->info->propic : 'assets/img/'.$this->placeholder)."' style='display:block;border-radius:100%;border: 3px solid #ff7978;width:100px;height:100px;margin-right: 20px;' alt='$name'>
                                                            </td>
                                                            <td style='padding:20px 0px 20px 11px;vertical-align:middle;'>
                                                                <div style='font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;color:#FFF;font-size: 14px;text-align:left;line-height:27px;margin-right: 25px;'><b>$name</b> wants to join your group.</div>
                                                                <div style='font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;color:#FFF;font-size: 14px;text-align:left;line-height:27px;margin-right: 25px;'>Group Name: $group->title</div>
                                                                <a href='$href' target='_blank' style='margin-top: 15px;font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;display:block;width:130px;background-color:#6fb943;padding:12px 10px;color:#FFF;text-decoration:none;text-align:center;border-radius:2px;font-size:12px;font-weight: bold;'>View Now</a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <table cellpadding='0' cellspacing='0' width='600'>
                                            <tr>
                                                <td style='padding: 0px 0px 10px 0px;'>
                                                    <div style='color: #787878;font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;font-size: 12px;text-align:center;line-height:12px;'>
                                                        <div style='margin-top:10px;'>© All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                                            <tr>
                                         <td align='center'>
                                         <div style='max-width:400px'>
                                            <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                         </div>
                                         </td>
                                         </tr>
                                        </table>
                                    </center>
                                </div>
                            </body>
                        </html>";
        $email_sub = "$name wants to join your group - WorthAct";
        $email_to = $email;
        $this->send_email($msg, $email_sub, $email_to);
    }
    
    public function accept_group($email, $group) {
        $name = ($this->info->type_id == 1) ? ucfirst(strtolower($this->info->firstname)) . ' ' . ucfirst(strtolower($this->info->lastname)) : ucfirst(strtolower($this->info->name));
        $href = base_url('dashboard/group/' . $group->main_id);
        $msg = "<!DOCTYPE html>
                        <html>
                            <head>
                                <meta https-equiv='Content-Type' content='text/html; charset=utf-8' />
                                <meta charset='utf-8'>
                                <title>$name accepted your group request</title>
                            </head>
                            <body>
                                <div style='width:100%;'>
                                    <center>
                                        <table cellpadding='0' cellspacing='0' border='0' width='600' style='margin-bottom:1px;margin-top: 50px;'>
                                            <tr>
                                                <td style='text-align:left;vertical-align:middle;height:30px;padding-top:5px;'><a href='https://www.worthact.com'><img src='".base_url('assets/img/logo-bold.png')."' style='display:block;width:160px;height:50px;margin: 0 auto 15px;' alt='WorthAct'></a></td>
                                            </tr>
                                        </table>
                                        <table cellpadding='0' cellspacing='0' border='0' width='600' style='border: 1px solid #DDD;'>
                                            <tr>
                                                <td style='background-color: #fe5e3a;vertical-align:middle;  height: 150px;'>
                                                    <table cellpadding='0' cellspacing='0' width='100%'>
                                                        <tr>
                                                            <td style='padding:17px 0px 17px 20px;width:100px;'>
                                                                <img src='".base_url(($this->info->propic != '') ? 'assets/userdata/dashboard/propic/'.$this->info->propic : 'assets/img/'.$this->placeholder)."' style='display:block;border-radius:100%;border: 3px solid #ff7978;width:100px;height:100px;margin-right: 20px;' alt='$name'>
                                                            </td>
                                                            <td style='padding:20px 0px 20px 11px;vertical-align:middle;'>
                                                                <div style='font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;color:#FFF;font-size: 14px;text-align:left;line-height:27px;margin-right: 25px;'><b>$name</b> accepted your group request.</div>
                                                                <div style='font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;color:#FFF;font-size: 14px;text-align:left;line-height:27px;margin-right: 25px;'>Group Name: $group->title</div>
                                                                <a href='$href' target='_blank' style='margin-top: 15px;font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;display:block;width:130px;background-color:#6fb943;padding:12px 10px;color:#FFF;text-decoration:none;text-align:center;border-radius:2px;font-size:12px;font-weight: bold;'>View Now</a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <table cellpadding='0' cellspacing='0' width='600'>
                                            <tr>
                                                <td style='padding: 0px 0px 10px 0px;'>
                                                    <div style='color: #787878;font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;font-size: 12px;text-align:center;line-height:12px;'>
                                                        <div style='margin-top:10px;'>© All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                                            <tr>
                                         <td align='center'>
                                         <div style='max-width:400px'>
                                            <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                         </div>
                                         </td>
                                         </tr>
                                        </table>
                                    </center>
                                </div>
                            </body>
                        </html>";
        $email_sub = "$name accepted your group request - WorthAct";
        $email_to = $email;
        $this->send_email($msg, $email_sub, $email_to);
    }
    
    public function like_email($email, $type, $type_id) {
        $t = '';
        $name = ($this->info->type_id == 1) ? ucfirst(strtolower($this->info->firstname)) . ' ' . ucfirst(strtolower($this->info->lastname)) : ucfirst(strtolower($this->info->name));
        if($type == 'blog') { $t = $type; $href = base_url('dashboard/blog/'.$type_id); } elseif($type == 'ad') { $t = 'SOS'; $href = base_url('dashboard/sos/'.$type_id); } else { $t = 'timeline'; $href = base_url('dashboard/recent_activities/'.$type_id); }
        $string = ($type == 'ad_dislike')? "disliked your sos post" : "liked your $t post";
        $msg = "<!DOCTYPE html>
                        <html>
                            <head>
                                <meta https-equiv='Content-Type' content='text/html; charset=utf-8' />
                                <meta charset='utf-8'>
                                <title>$name liked on your $t post</title>
                            </head>
                            <body>
                                <div style='width:100%;'>
                                    <center>
                                        <table cellpadding='0' cellspacing='0' border='0' width='600' style='margin-bottom:1px;margin-top: 50px;'>
                                            <tr>
                                                <td style='text-align:left;vertical-align:middle;height:30px;padding-top:5px;'><a href='https://www.worthact.com'><img src='".base_url('assets/img/logo-bold.png')."' style='display:block;width:160px;height:50px;margin: 0 auto 15px;' alt='WorthAct'></a></td>
                                            </tr>
                                        </table>
                                        <table cellpadding='0' cellspacing='0' border='0' width='600' style='border: 1px solid #DDD;'>
                                            <tr>
                                                <td style='background-color: #fe5e3a;vertical-align:middle;  height: 150px;'>
                                                    <table cellpadding='0' cellspacing='0' width='100%'>
                                                        <tr>
                                                            <td style='padding:17px 0px 17px 20px;width:100px;'>
                                                                <img src='".base_url(($this->info->propic != '') ? 'assets/userdata/dashboard/propic/'.$this->info->propic : 'assets/img/'.$this->placeholder)."' style='display:block;border-radius:100%;border: 3px solid #ff7978;width:100px;height:100px;margin-right: 20px;' alt='$name'>
                                                            </td>
                                                            <td style='padding:20px 0px 20px 11px;vertical-align:middle;'>
                                                                <div style='font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;color:#FFF;font-size: 14px;text-align:left;line-height:27px;margin-right: 25px;'><b>$name</b> $string.</div>
                                                                <a href='$href' target='_blank' style='margin-top: 15px;font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;display:block;width:120px;background-color:#6fb943;padding:12px 10px;color:#FFF;text-decoration:none;text-align:center;border-radius:2px;font-size:12px;font-weight: bold;'>View Now</a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <table cellpadding='0' cellspacing='0' width='600'>
                                            <tr>
                                                <td style='padding: 0px 0px 10px 0px;'>
                                                    <div style='color: #787878;font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;font-size: 12px;text-align:center;line-height:12px;'>
                                                        <div style='margin-top:10px;'>© All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                                            <tr>
                                         <td align='center'>
                                         <div style='max-width:400px'>
                                            <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                         </div>
                                         </td>
                                         </tr>
                                        </table>
                                    </center>
                                </div>
                            </body>
                        </html>";
        $email_sub = "$name liked your $t post - WorthAct";
        $email_to = $email;
        $this->send_email($msg, $email_sub, $email_to);
    }
    
    public function comment_like($email, $href) {
        $name = ($this->info->type_id == 1) ? ucfirst(strtolower($this->info->firstname)) . ' ' . ucfirst(strtolower($this->info->lastname)) : ucfirst(strtolower($this->info->name));
        $string = "liked your comment";
        $msg = "<!DOCTYPE html>
                        <html>
                            <head>
                                <meta https-equiv='Content-Type' content='text/html; charset=utf-8' />
                                <meta charset='utf-8'>
                                <title>$name liked on your $t post</title>
                            </head>
                            <body>
                                <div style='width:100%;'>
                                    <center>
                                        <table cellpadding='0' cellspacing='0' border='0' width='600' style='margin-bottom:1px;margin-top: 50px;'>
                                            <tr>
                                                <td style='text-align:left;vertical-align:middle;height:30px;padding-top:5px;'><a href='https://www.worthact.com'><img src='".base_url('assets/img/logo-bold.png')."' style='display:block;width:160px;height:50px;margin: 0 auto 15px;' alt='WorthAct'></a></td>
                                            </tr>
                                        </table>
                                        <table cellpadding='0' cellspacing='0' border='0' width='600' style='border: 1px solid #DDD;'>
                                            <tr>
                                                <td style='background-color: #fe5e3a;vertical-align:middle;  height: 150px;'>
                                                    <table cellpadding='0' cellspacing='0' width='100%'>
                                                        <tr>
                                                            <td style='padding:17px 0px 17px 20px;width:100px;'>
                                                                <img src='".base_url(($this->info->propic != '') ? 'assets/userdata/dashboard/propic/'.$this->info->propic : 'assets/img/'.$this->placeholder)."' style='display:block;border-radius:100%;border: 3px solid #ff7978;width:100px;height:100px;margin-right: 20px;' alt='$name'>
                                                            </td>
                                                            <td style='padding:20px 0px 20px 11px;vertical-align:middle;'>
                                                                <div style='font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;color:#FFF;font-size: 14px;text-align:left;line-height:27px;margin-right: 25px;'><b>$name</b> $string.</div>
                                                                <a href='$href' target='_blank' style='margin-top: 15px;font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;display:block;width:120px;background-color:#6fb943;padding:12px 10px;color:#FFF;text-decoration:none;text-align:center;border-radius:2px;font-size:12px;font-weight: bold;'>View Now</a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <table cellpadding='0' cellspacing='0' width='600'>
                                            <tr>
                                                <td style='padding: 0px 0px 10px 0px;'>
                                                    <div style='color: #787878;font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;font-size: 12px;text-align:center;line-height:12px;'>
                                                        <div style='margin-top:10px;'>© All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                                            <tr>
                                         <td align='center'>
                                         <div style='max-width:400px'>
                                            <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                         </div>
                                         </td>
                                         </tr>
                                        </table>
                                    </center>
                                </div>
                            </body>
                        </html>";
        $email_sub = "$name liked your comment - WorthAct";
        $email_to = $email;
        $this->send_email($msg, $email_sub, $email_to);
    }
    
    public function wa_add_email($email, $title, $post_id, $type) {
        $req_type = ($type == 1)? 'Need' : 'Action';
        $name = ($this->info->type_id == 1) ? ucfirst(strtolower($this->info->firstname)) . ' ' . ucfirst(strtolower($this->info->lastname)) : ucfirst(strtolower($this->info->name));
        $msg = "<!DOCTYPE html>
                        <html>
                            <head>
                                <meta https-equiv='Content-Type' content='text/html; charset=utf-8' />
                                <meta charset='utf-8'>
                                <title>$name has posted a SOS $req_type</title>
                            </head>
                            <body>
                                <div style='width:100%;'>
                                    <center>
                                        <table cellpadding='0' cellspacing='0' border='0' width='600' style='margin-bottom:1px;margin-top: 50px;'>
                                            <tr>
                                                <td style='text-align:left;vertical-align:middle;height:30px;padding-top:5px;'><a href='https://www.worthact.com'><img src='".base_url('assets/img/logo-bold.png')."' style='display:block;width:160px;height:50px;margin: 0 auto 15px;' alt='WorthAct'></a></td>
                                            </tr>
                                        </table>
                                        <table cellpadding='0' cellspacing='0' border='0' width='600' style='border: 1px solid #DDD;'>
                                            <tr>
                                                <td style='background-color: #fe5e3a;vertical-align:middle;  height: 150px;'>
                                                    <table cellpadding='0' cellspacing='0' width='100%'>
                                                        <tr>
                                                            <td style='padding:17px 0px 17px 20px;width:100px;'>
                                                                <img src='".base_url(($this->info->propic != '') ? 'assets/userdata/dashboard/propic/'.$this->info->propic : 'assets/img/'.$this->placeholder)."' style='display:block;border-radius:100%;border: 3px solid #ff7978;width:100px;height:100px;margin-right: 20px;' alt='$name'>
                                                            </td>
                                                            <td style='padding:20px 0px 20px 11px;vertical-align:middle;'>
                                                                <div style='font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;color:#FFF;font-size: 14px;text-align:left;line-height:27px;margin-right: 25px;'><b>$name</b> has posted a SOS $req_type in Worthact Initiatives.</div>
                                                                <div style='font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;color:#FFF;font-size: 14px;text-align:left;line-height:27px;margin-right: 25px;'>Title: $title</div>
                                                                <a href='".base_url('dashboard/sos/'.$post_id)."' target='_blank' style='margin-top: 15px;font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;display:block;width:120px;background-color:#6fb943;padding:12px 10px;color:#FFF;text-decoration:none;text-align:center;border-radius:2px;font-size:12px;font-weight: bold;'>View Now</a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <table cellpadding='0' cellspacing='0' width='600'>
                                            <tr>
                                                <td style='padding: 0px 0px 10px 0px;'>
                                                    <div style='color: #787878;font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;font-size: 12px;text-align:center;line-height:12px;'>
                                                        <div style='margin-top:10px;'>© All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                                            <tr>
                                         <td align='center'>
                                         <div style='max-width:400px'>
                                            <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                         </div>
                                         </td>
                                         </tr>
                                        </table>
                                    </center>
                                </div>
                            </body>
                        </html>";
        $email_sub = "$name has posted a SOS $req_type - WorthAct";
        $email_to = $email;
        $this->send_email($msg, $email_sub, $email_to);
    }
    
    public function submit_cv($email, $job, $attachment) {
        $msg = "<table style='border-collapse:collapse;line-height:24px;margin:80px auto 0;padding:0;width:100%;font-size:17px;color:#373737;width: 546px'  border='0' cellpadding='0' cellspacing='0'>
                    <tbody>
                        <tr>
                            <td width='546' height='150' style='background: rgba(64, 66, 87, 0.65) url(".base_url('assets/img/plant.jpg').") 0 0 no-repeat; background-size: cover;border-radius: 4px 4px 0 0;'>
                                <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='height:100%;background-color:rgba(64, 66, 87, 0.73);border-radius: 4px 4px 0 0;'>
                                    <tbody>
                                        <tr>
                                            <td valign='center' data-bgcolor='Header'>
                                                <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;font-size: 32px; color: #FFFFFF;'>
                                                    <tbody>
                                                        <tr>
                                                            <td align='center'>
                                                                <img height='55' src='".base_url('assets/img/logo-orange.png')."' border='0' style='display: block;' data-crop='false'>
                                                                     <h4 style='text-align: center; font-size: 22px;color: #fff;margin: 15px 0 0'>New Application Submission</h4>     
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
                        <tr>
                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse' valign='top'>
                                <table style='border-collapse:collapse;background:#ececec;border-radius:0 0 4px 4px;margin-bottom:10px' align='center' border='0' cellpadding='32' cellspacing='0'>
                                    <tbody>
                                        <tr>
                                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse;padding: 25px 35px 25px;' valign='top' width='546'>
                                                <div style='max-width:600px;margin:0 auto'>
                                                    <div style='background:#ececec;'>
                                                        <p style='font-size: 16px;line-height: 22px;color: #666'><b>Hi,</b></p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0 0 20px;color: #666'>A candidate has applied for a job you posted. Check our job portal to get a list of all the candidates who have applied for this job.</p>
                                                        <p style='font-size:16px;line-height:22px;color:#666;'><strong>Posted Job Title:</strong> $job->job_title</p>
                                                        <p style='font-size: 16px;line-height: 22px;color:#666;'><strong>Candidate Name:</strong> ".ucfirst(strtolower($this->info->firstname))." ".ucfirst(strtolower($this->info->lastname))."</p>
                                                        <p style='font-size:16px;line-height:22px;color:#666;'><strong>Email:</strong> ".$this->info->email."</p>
                                                        <p style='font-size:16px;line-height:22px;margin: 0 0 10px;color:#666;'><strong>CV:</strong> ".base_url('dashboard/cv/'.$this->session->userdata('user_id'))."</p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0;color: #666'>Kind Regards,</p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0 0 20px;color: #666'>WorthAct Initiatives</p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                    </tbody>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom:10px'>
                    <tr>
                        <td>
                            <div style='color: #ababab;font-family:Verdana,Arial;font-size: 12px;line-height:17px; text-align: center'>
                                © All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a>
                            </div>
                        </td>
                    </tr>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                    <tr>
                        <td align='center'>
                            <div style='max-width:400px'>
                                <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                            </div>
                        </td>
                    </tr>
                </table>";
        $email_sub = "New Application submission - WorthAct";
        $to = $email;
        ($attachment != '')? $this->send_email_attachment($msg, $email_sub, $to, $attachment, 'cv') : $this->send_email($msg, $email_sub, $to); 
    }
    
    public function cv_view_email($email) {
        $name = ucfirst($this->info->name);
        $msg = "<!DOCTYPE html>
                        <html>
                            <head>
                                <meta https-equiv='Content-Type' content='text/html; charset=utf-8' />
                                <meta charset='utf-8'>
                                <title>$name viewed your CV on WorthAct</title>
                            </head>
                            <body>
                                <div style='width:100%;'>
                                    <center>
                                        <table cellpadding='0' cellspacing='0' border='0' width='600' style='margin-bottom:1px;margin-top: 50px;'>
                                            <tr>
                                                <td style='text-align:left;vertical-align:middle;height:30px;padding-top:5px;'><a href='https://www.worthact.com'><img src='".base_url('assets/img/logo-bold.png')."' style='display:block;width:160px;height:50px;margin: 0 auto 15px;' alt='WorthAct'></a></td>
                                            </tr>
                                        </table>
                                        <table cellpadding='0' cellspacing='0' border='0' width='600' style='border: 1px solid #DDD;'>
                                            <tr>
                                                <td style='background-color: #fe5e3a;vertical-align:middle;  height: 150px;'>
                                                    <table cellpadding='0' cellspacing='0' width='100%'>
                                                        <tr>
                                                            <td style='padding:17px 0px 17px 20px;width:100px;'>
                                                                <img src='".base_url(($this->info->propic != '') ? 'assets/userdata/dashboard/propic/'.$this->info->propic : 'assets/img/'.$this->placeholder)."' style='display:block;border-radius:100%;border: 3px solid #ff7978;width:100px;height:100px;margin-right: 20px;' alt='$name'>
                                                            </td>
                                                            <td style='padding:20px 0px 20px 11px;vertical-align:middle;'>
                                                                <div style='font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;color:#FFF;font-size: 14px;text-align:left;line-height:27px;margin-right: 25px;'><b>$name</b> viewed your CV.</div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                        <table cellpadding='0' cellspacing='0' width='600'>
                                            <tr>
                                                <td style='padding: 10px 0px 10px 0px;'>
                                                    <div style='color: #787878;font-family:Verdana,Helvetica Neue,Helvetica,Arial,sans-serif;font-size: 12px;text-align:center;line-height:12px;'>
                                                        This message was sent to you on behalf of $name's request.
                                                        <div style='margin-top:10px;'>© All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                                            <tr>
                                         <td align='center'>
                                         <div style='max-width:400px'>
                                            <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                         </div>
                                         </td>
                                         </tr>
                                        </table>
                                    </center>
                                </div>
                            </body>
                        </html>";
        $email_sub = "$name viewed your CV - WorthAct";
        $email_to = $email;
        $this->send_email($msg, $email_sub, $email_to);
    }
    
    public function wa_submission($ad_one, $ad_two, $email) {
        $file = array('ad_one_img' => $ad_one->img, 'ad_one_video' => $ad_one->video, 'ad_two_img' => $ad_two->img, 'ad_two_video' => $ad_two->video);
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'Zeka5gi6zw30H7i7e4BPL97w';
        $secret_iv = 'P55H480ZZeka5gi6zw30H7i7';
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $href_approve =  base_url('home/free_user_upgrade?u_id=' . base64_encode(openssl_encrypt($this->session->userdata('user_id'), $encrypt_method, $key, 0, $iv)));
        $href_delete =  base_url('home/deny_free_user_upgrade?u_id=' . base64_encode(openssl_encrypt($this->session->userdata('user_id'), $encrypt_method, $key, 0, $iv)));
        $msg = "<table style='border-collapse:collapse;line-height:24px;margin:0;padding:0;width:100%;font-size:17px;color:#373737;' border='0' cellpadding='0' cellspacing='0' width='100%'>
                <tbody>
                <tr>
                <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse' valign='top'>
                <table style='border-collapse:collapse' border='0' cellpadding='0' cellspacing='0' width='100%'>
                    <tbody>
                        <tr>
                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse;padding:50px 16px 12px' valign='bottom'>
                                <div style='text-align:center'> <a href='httpss://www.worthact.com' style='color:#439fe0;font-weight:bold;text-decoration:none;word-break:break-word' target='_blank' data-saferedirecturl='https://www.worthact.com'> <img src='".base_url('assets/img/logo-bold.png')."' style='outline:none;text-decoration:none;border:none' height='50' width='160'></a> </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </td>
                </tr>
                <tr>
                <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse' valign='top'>
                <table style='border-collapse:collapse;background:#ececec;border-radius:4px;margin-bottom:10px' align='center' border='0' cellpadding='32' cellspacing='0'>
                    <tbody>
                        <tr>
                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse;padding: 25px 35px 25px;' valign='top' width='546'>
                                <div style='max-width:600px;margin:0 auto'>
                                    <div style='background:#ececec;'>
                                        <h4 style='text-align: center; font-size: 22px;color:#666;'>Free Upgrade via SOS Submission Details</h4>
                                        <p style='font-size:16px;line-height:22px;color:#666;'><strong>Email:</strong> $email</p>
                                        <p style='font-size:16px;line-height:22px;color:#666;'><strong>User Id:</strong> ".$this->session->userdata('user_id')."</p>
                                        <p style='font-size:16px;line-height:22px;margin: 0 0 10px;color:#666;'><strong>SOS 1 Title :</strong> ".$ad_one->title."</p>
                                        <p style='font-size:16px;line-height:22px;margin: 0 0 10px;color:#666;'><strong>SOS 1 Description :</strong> ".$ad_one->description."</p>
                                        <p style='font-size:16px;line-height:22px;margin: 0 0 10px;color:#666;'><strong>SOS 2 Title :</strong> ".$ad_two->title."</p>
                                        <p style='font-size:16px;line-height:22px;margin: 0 0 10px;color:#666;'><strong>SOS 2 Description :</strong> ".$ad_two->description."</p>
                                        <p style='font-size:16px;line-height:22px;color:#666;'><strong><a href='$href_approve'>Click here</a></strong> to upgrade the user.</p>
                                        <p style='font-size:16px;line-height:22px;color:#666;'><strong><a href='$href_delete'>Click here</a></strong> to delete the upgrade request.</p> 
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </td>
                </tr>
                <tr>
                </tbody>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom:10px'>
                <tr>
                <td>
                <div style='color: #ababab;font-family:Verdana,Arial;font-size: 12px;line-height:17px; text-align: center'>
                © All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a>
                </div>
                </td>
                </tr>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                    <tr>
                 <td align='center'>
                 <div style='max-width:400px'>
                    <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                 </div>
                 </td>
                 </tr>
                </table>";
        $email_sub = "Free Upgrade via SOS Submission - WorthAct";
        $to = "getintouch@worthact.com";
        $this->send_email_attachment($msg, $email_sub, $to, $file, 'sos_upgrade');
    }
    
    public function notify_free_upgrade_success($user) {
        $name = ucfirst($user->username);
        $msg = "<table style='border-collapse:collapse;line-height:24px;margin:80px auto 0;padding:0;width:100%;font-size:17px;color:#373737;width: 546px'  border='0' cellpadding='0' cellspacing='0' >
                    <tbody>
                        <tr>
                            <td width='546' height='150' style='background: rgba(64, 66, 87, 0.65) url(".base_url('assets/img/plant.jpg').") 0 0 no-repeat; background-size: cover;border-radius: 4px 4px 0 0;'>
                                <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='height:100%;background-color:rgba(64, 66, 87, 0.73);border-radius: 4px 4px 0 0;'>
                                    <tbody>
                                        <tr>
                                            <td valign='center' data-bgcolor='Header'>
                                                <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;font-size: 32px; color: #FFFFFF;'>
                                                    <tbody>
                                                        <tr>
                                                            <td align='center'>
                                                                <img height='55' src='".base_url('assets/img/logo-orange.png')."' border='0' style='display: block;' data-crop='false'>
                                                                     <h4 style='text-align: center; font-size: 22px;color: #fff;margin: 15px 0 0'>Free Account Upgrade</h4>     
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
                        <tr>
                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse' valign='top'>
                                <table style='border-collapse:collapse;background:#ececec;border-radius:0 0 4px 4px;margin-bottom:10px' align='center' border='0' cellpadding='32' cellspacing='0'>
                                    <tbody>
                                        <tr>
                                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse;padding: 25px 35px 10px;' valign='top' width='546'>
                                                <div style='max-width:600px;margin:0 auto'>
                                                    <div style='background:#ececec;'>
                                                        <p style='font-size: 16px;line-height: 22px;color: #666'><b>Dear $name,</b></p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0 0 20px;color: #666'>Congrulations ! Your SOS action was successfully verified by our team. You have been upgraded to a premium member for free. Enjoy the new benefits</p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0;color: #666'>Kind Regards,</p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0 0 20px;color: #666'>WorthAct Initiatives</p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                    </tbody>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 10px;'>
                    <tr>
                        <td>
                            <div style='color: #ababab;font-family:Verdana,Arial;font-size: 12px;line-height:17px; text-align: center'>
                                © All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a>
                            </div>
                        </td>
                    </tr>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                    <tr>
                        <td align='center'>
                            <div style='max-width:400px'>
                                <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                            </div>
                        </td>
                    </tr>
                </table>";
        $email_sub = "Free Account Upgrade - WorthAct";
        $email_to = $user->email;
        $this->send_email($msg, $email_sub, $email_to);
    }
    
    public function deny_free_user_upgrade($user) {
        $name = ucfirst($user->username);
        $msg = "<table style='border-collapse:collapse;line-height:24px;margin:80px auto 0;padding:0;width:100%;font-size:17px;color:#373737;width: 546px' border='0' cellpadding='0' cellspacing='0'>
                    <tbody>
                        <tr>
                            <td width='546' height='150' style='background: rgba(64, 66, 87, 0.65) url(".base_url('assets/img/plant.jpg').") 0 0 no-repeat; background-size: cover;border-radius: 4px 4px 0 0;'>
                                <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='height:100%;background-color:rgba(64, 66, 87, 0.73);border-radius: 4px 4px 0 0;'>
                                    <tbody>
                                        <tr>
                                            <td valign='center' data-bgcolor='Header'>
                                                <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;font-size: 32px; color: #FFFFFF;'>
                                                    <tbody>
                                                        <tr>
                                                            <td align='center'>
                                                                <img height='55' src='".base_url('assets/img/logo-orange.png')."' border='0' style='display: block;' data-crop='false'>
                                                                     <h4 style='text-align: center; font-size: 22px;color: #fff;margin: 15px 0 0'>Free Account Upgrade</h4>     
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
                        <tr>
                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse' valign='top'>
                                <table style='border-collapse:collapse;background:#ececec;border-radius:0 0 4px 4px;margin-bottom:10px' align='center' border='0' cellpadding='32' cellspacing='0'>
                                    <tbody>
                                        <tr>
                                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse;padding: 25px 35px 10px;' valign='top' width='546'>
                                                <div style='max-width:600px;margin:0 auto'>
                                                    <div style='background:#ececec;'>
                                                        <p style='font-size: 16px;line-height: 22px;color: #666'><b>Dear $name,</b></p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0 0 20px;color: #666'>We are very sorry. Your SOS action could not be successfully verified and we regret not being able to upgrade you to a premium member. Please try again.</p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0;color: #666'>Kind Regards,</p>
                                                        <p style='font-size:16px;line-height:32px;margin: 0 0 20px;color: #666'>WorthAct Initiatives</p>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                    </tbody>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 10px;'>
                    <tr>
                        <td>
                            <div style='color: #ababab;font-family:Verdana,Arial;font-size: 12px;line-height:17px; text-align: center'>
                                © All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a>
                            </div>
                        </td>
                    </tr>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                    <tr>
                        <td align='center'>
                            <div style='max-width:400px'>
                                <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                            </div>
                        </td>
                    </tr>
                </table>";
        $email_sub = "Free Account Upgrade - WorthAct";
        $email_to = $user->email;
        $this->send_email($msg, $email_sub, $email_to);
    }
    
    public function outside_india($email, $name) {
        $msg = "<table width='546' border='0' cellspacing='0' cellpadding='0' align='center' data-module='header'>
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
                                                                <img height='55' src='".base_url('assets/img/logo-orange.png')."' border='0' style='display: block;' data-crop='false'>
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
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 15px;line-height: 24px;font-size: 14px;'>Dear $name,</p>
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 15px;line-height: 24px;font-size: 14px;'>Greetings..!! Worthact comes to you now with fresh changes, improvements and a whole new feel.  Frequent the site and explore ample opportunities and possibilities to do more worthy actions to guarantee healthy existence on this planet for generations to come.</p>
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:15px 0;line-height: 24px;font-size: 14px;'>We urge you to check out the new enthusiasm and good cheer our site radiates, and the experience you get – when you selflessly do worthy actions for the enhancement of our only home, the Earth and share the same with us in site through SOS posts to spread awareness and goodwill.</p>
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:15px 0 15px;line-height: 24px;font-size: 14px;'>Take count of the honour and nobility acquired through such selfless actions, makes you a winner anyway you percieve, and together we all stand to win a better world, a superior existence.</p>
                                <a href='".base_url()."' style='font-family:Verdana,Georgia,Times,serif;background-color:#fe5e3a;display:block;padding:10px 10px;margin:20px auto 5px;width:100%;max-width:125px;font-size:14px;color:#ffffff;text-decoration:none;border-radius:2px;text-align:center' target='_blank'>Visit Now</a>
                            </td>
                        </tr>
                        <tr style='background: #ececec;'>
                            <td align='center'>
                                <div style='max-width:400px'>
                                        <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                        <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                        <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                        <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                        <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                        <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>  
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
                </table>";
        $email_sub = "Be Active - WorthAct";
        $email_to = $email;
        $this->send_email($msg, $email_sub, $email_to);
    }
    
    public function offers($email, $name) {
        $msg = "<table width='600' border='0' cellspacing='0' cellpadding='0' align='center' data-module='header'>
                    <tbody>
                        <tr>
                            <td height='80'>
                                <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='height:100%;background-color:#ececec;'>
                                    <tbody>
                                        <tr>
                                            <td valign='center' data-bgcolor='Header'>
                                                <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center' style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;font-size: 32px; color: #FFFFFF;'>
                                                    <tbody>
                                                        <tr>
                                                            <td align='center'>
                                                                <img height='40' src='".base_url('assets/img/logo-bold.png')."' border='0' style='display: block;' data-crop='false'>
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
                        <tr>
                            <td>
                                <img src='".base_url('assets/img/offer_inner.jpg')."' border='0' style='display: block;width: 100%' data-crop='false'>
                            </td>
                        </tr>
                        <tr style='background: #ececec;padding: 0 15px;'>
                            <td style='padding:10px 25px 5px' align='center' class='scale-center-both'>
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:0;font-size: 18px; line-height: 32px'>Be Active...Win Prizes</p>
                            </td>
                        </tr>
                        <tr style='background: #ececec;'>
                            <td style='padding:0 25px 20px' class='scale-center-both'>
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 15px;line-height: 24px;font-size: 14px;'>Dear $name,</p>
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 15px;line-height: 24px;font-size: 14px;'>Worthact comes to you now with fresh changes, improvements and a whole new feel with exhilarating offers</p>
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 15px;line-height: 24px;font-size: 14px;'>Explore, and you stand a chance to win amazing prizes for a few good deeds performed, which is innovative and never been introduced before. Do not miss the chance..!!</p>
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:15px 0;line-height: 24px;font-size: 14px;'>We wish you the very best to be a winner and in a way, we all turn out to be winners. You win an amazing prize and together we all stand to win a better world, a superior existence.</p>
                                <a href='' style='font-family:Verdana,Georgia,Times,serif;background-color:#fe5e3a;display:block;padding:10px 10px;margin:0px auto 5px;width:100%;max-width:125px;font-size:14px;color:#ffffff;text-decoration:none;border-radius:2px;text-align:center' target='_blank'>Enroll Now</a>
                            </td>
                        </tr>
                        <tr style='background: #ececec;'>
                            <td align='center'>
                                <div style='max-width:400px'>
                                    <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                    <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                    <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                    <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                    <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                    <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>  
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
                </table>";
        $email_sub = "Be Active Win Prizes - WorthAct";
        $email_to = $email;
        $this->send_email($msg, $email_sub, $email_to);
    }
    
    public function send_mailertemplate($to, $from, $subject, $name, $msg, $regards, $sig_val) {
        $content = "<table width='600' border='0' cellspacing='0' cellpadding='0' align='center' data-module='header'>
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
                                                                        <img height='55' src='".base_url('assets/img/logo-orange.png')."' border='0' style='display: block;' data-crop='false'>
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
                                        <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 15px;line-height: 24px;font-size: 14px;'>$name</p>
                                        <style>#editor_msg p { font-family:Verdana,Georgia,Times,serif;margin:0 0 15px;line-height: 24px;font-size: 14px; } </style>
                                        <div style='font-family:Verdana,Georgia,Times,serif;margin:0 0 15px;line-height: 24px;font-size: 14px;' id='editor_msg'>$msg</div>
                                        <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 15px;line-height: 24px;font-size: 14px;'>$regards</p>
                                        $sig_val
                                        <a href='".base_url()."' style='font-family:Verdana,Georgia,Times,serif;background-color:#fe5e3a;display:block;padding:10px 10px;margin:20px auto 5px;width:100%;max-width:125px;font-size:14px;color:#ffffff;text-decoration:none;border-radius:2px;text-align:center' target='_blank'>Visit Now</a>
                                    </td>
                                </tr>
                                <tr style='background: #ececec;'>
                                    <td align='center'>
                                        <div style='max-width:400px'>
                                            <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                                            <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>  
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
                        </table>";
        $config = array();
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['wordwrap'] = TRUE;
        $this->load->library('email');
        $this->email->initialize($config);
        $this->email->from($from, 'WorthAct');
        $this->email->to($to);
        $this->email->bcc($from);
        $this->email->cc('manojnair@worthact.com');
        $this->email->subject($subject);
        $this->email->message($content);
        $this->email->send();
    }
    
    public function seso_essay($data) {
        $name = ($this->info->type_id == 1) ? ucfirst(strtolower($this->info->firstname)) . ' ' . ucfirst(strtolower($this->info->lastname)) : ucfirst(strtolower($this->info->name));
        $email = $this->info->email;
        $msg = "<table style='border-collapse:collapse;line-height:24px;margin:0;padding:0;width:100%;font-size:17px;color:#373737;' border='0' cellpadding='0' cellspacing='0' width='100%'>
                <tbody>
                <tr>
                <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse' valign='top'>
                <table style='border-collapse:collapse' border='0' cellpadding='0' cellspacing='0' width='100%'>
                    <tbody>
                        <tr>
                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse;padding:50px 16px 12px' valign='bottom'>
                                <div style='text-align:center'> <a href='httpss://www.worthact.com' style='color:#439fe0;font-weight:bold;text-decoration:none;word-break:break-word' target='_blank' data-saferedirecturl='https://www.worthact.com'> <img src='".base_url('assets/img/logo-bold.png')."' style='outline:none;text-decoration:none;border:none' height='50' width='160'></a> </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </td>
                </tr>
                <tr>
                <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse' valign='top'>
                <table style='border-collapse:collapse;background:#ececec;border-radius:4px;margin-bottom:10px' align='center' border='0' cellpadding='32' cellspacing='0'>
                    <tbody>
                        <tr>
                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse;padding: 25px 35px 25px;' valign='top' width='546'>
                                <div style='max-width:600px;margin:0 auto'>
                                    <div style='background:#ececec;'>
                                        <h4 style='text-align: center; font-size: 22px;color:#666;'>SESO Essay Submission</h4>
                                        <p style='font-size: 16px;line-height: 22px;color:#666;'><strong>Name:</strong> $name</p>
                                        <p style='font-size:16px;line-height:22px;color:#666;'><strong>Email:</strong> $email</p>
                                        <p style='font-size: 16px;line-height: 22px;color:#666;'><strong>User ID:</strong> ".$this->session->userdata('user_id')."</p>
                                        <p style='font-size:16px;line-height:22px;margin: 0 0 10px;color:#666;'><strong>Title</strong> ".$data['essay_title']."</p>
                                        <p style='font-size:16px;line-height:22px;margin: 0 0 10px;color:#666;'><strong>Tags</strong> ".$data['essay_tags']."</p>
                                        <p style='font-size:16px;line-height:22px;margin: 0 0 10px;color:#666;'><strong>Content :</strong></p>
                                        <style>.content img { width: 100% } .content p, .content ol li, .content ul li { font-size:16px;line-height:22px;margin: 0 0 10px;color:#666; } </style>
                                        <div class='content' style='font-size:16px;line-height:22px;margin: 0 0 10px;color:#666;'>".$data['essay_content']."</div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </td>
                </tr>
                <tr>
                </tbody>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom:10px'>
                <tr>
                <td>
                <div style='color: #ababab;font-family:Verdana,Arial;font-size: 12px;line-height:17px; text-align: center'>
                © All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a>
                </div>
                </td>
                </tr>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                    <tr>
                 <td align='center'>
                 <div style='max-width:400px'>
                    <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                 </div>
                 </td>
                 </tr>
                </table>";
        $attachment = $data['essay_banner'];
        $email_sub = "SESO Essay Submission - WorthAct";
        $to = "careers@worthact.com";
        $this->send_email_attachment($msg, $email_sub, $to, $attachment, 'seso_essay');
    }
    
    public function seso_drawing($data) {
        $name = ($this->info->type_id == 1) ? ucfirst(strtolower($this->info->firstname)) . ' ' . ucfirst(strtolower($this->info->lastname)) : ucfirst(strtolower($this->info->name));
        $email = $this->info->email;
        $msg = "<table style='border-collapse:collapse;line-height:24px;margin:0;padding:0;width:100%;font-size:17px;color:#373737;' border='0' cellpadding='0' cellspacing='0' width='100%'>
                <tbody>
                <tr>
                <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse' valign='top'>
                <table style='border-collapse:collapse' border='0' cellpadding='0' cellspacing='0' width='100%'>
                    <tbody>
                        <tr>
                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse;padding:50px 16px 12px' valign='bottom'>
                                <div style='text-align:center'> <a href='httpss://www.worthact.com' style='color:#439fe0;font-weight:bold;text-decoration:none;word-break:break-word' target='_blank' data-saferedirecturl='https://www.worthact.com'> <img src='".base_url('assets/img/logo-bold.png')."' style='outline:none;text-decoration:none;border:none' height='50' width='160'></a> </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </td>
                </tr>
                <tr>
                <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse' valign='top'>
                <table style='border-collapse:collapse;background:#ececec;border-radius:4px;margin-bottom:10px' align='center' border='0' cellpadding='32' cellspacing='0'>
                    <tbody>
                        <tr>
                            <td style='font-family:Helvetica Neue,Helvetica,Arial,sans-serif!important;border-collapse:collapse;padding: 25px 35px 25px;' valign='top' width='546'>
                                <div style='max-width:600px;margin:0 auto'>
                                    <div style='background:#ececec;'>
                                        <h4 style='text-align: center; font-size: 22px;color:#666;'>SESO Essay Submission</h4>
                                        <p style='font-size: 16px;line-height: 22px;color:#666;'><strong>Name:</strong> $name</p>
                                        <p style='font-size:16px;line-height:22px;color:#666;'><strong>Email:</strong> $email</p>
                                        <p style='font-size: 16px;line-height: 22px;color:#666;'><strong>User ID:</strong> ".$this->session->userdata('user_id')."</p>
                                        <p style='font-size:16px;line-height:22px;margin: 0 0 10px;color:#666;'><strong>Title</strong> ".$data['drawing_title']."</p>
                                        <p style='font-size:16px;line-height:22px;margin: 0 0 10px;color:#666;'><strong>Tags</strong> ".$data['drawing_tags']."</p>
                                        <p style='font-size:16px;line-height:22px;margin: 0 0 10px;color:#666;'><strong>Description</strong> ".$data['drawing_content']."</p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </td>
                </tr>
                <tr>
                </tbody>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom:10px'>
                <tr>
                <td>
                <div style='color: #ababab;font-family:Verdana,Arial;font-size: 12px;line-height:17px; text-align: center'>
                © All Rights Reserved ".date('Y')." <a href='https://www.worthact.com' target='_blank' style='border-bottom: dotted 1px #b3bac1;text-decoration: none; color: inherit;'>Team WorthAct</a>
                </div>
                </td>
                </tr>
                </table>
                <table border='0' cellpadding='0' cellspacing='0'  align='center' style='width:100%;max-width:600px;margin-bottom: 50px;'>
                    <tr>
                 <td align='center'>
                 <div style='max-width:400px'>
                    <a href='https://www.facebook.com/worthactofficial/'><img alt='facebook' src='".base_url('assets/img/facebook.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://plus.google.com/+worthact'><img alt='google_plus' src='".base_url('assets/img/google_plus.png')."'' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://twitter.com/worthact'><img alt='twitter' src='".base_url('assets/img/twitter.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://www.linkedin.com/company/worthact'><img alt='linkedin' src='".base_url('assets/img/linkedin.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://www.youtube.com/channel/UCHVuqhQQ_nAk4CotqTflAZw'><img alt='youtube' src='".base_url('assets/img/youtube.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                    <a href='https://www.instagram.com/worthact'><img alt='instagram' src='".base_url('assets/img/instagram.png')."' style='width: 40px; margin:0 auto;margin-bottom: 15px; margin-right: 10px;'></a>
                 </div>
                 </td>
                 </tr>
                </table>";
        $attachment = $data['sketch'];
        $email_sub = "SESO Drawing Submission - WorthAct";
        $to = "careers@worthact.com";
        $this->send_email_attachment($msg, $email_sub, $to, $attachment, 'seso_drawing');
    }
    
    public function send_email($email_msg, $email_sub, $email_to) {
        $config = array();
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['wordwrap'] = TRUE;
        $this->load->library('email');
        $this->email->initialize($config);
        $this->email->from('getintouch@worthact.com', 'WorthAct');
        $this->email->to($email_to);
        $this->email->subject($email_sub);
        $this->email->message($email_msg);
        $this->email->send();
    }
    
    public function send_email_attachment($email_msg, $email_sub, $email_to, $attachment, $type) {
        $config = array();
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['wordwrap'] = TRUE;
        $this->load->library('email');
        $this->email->initialize($config);
        $this->email->from('getintouch@worthact.com', 'WorthAct');
        $this->email->to($email_to);
        $this->email->subject($email_sub);
        $this->email->message($email_msg);
        if($type == 'csr' && $attachment != '') {
            $file_arr = explode(',', $attachment);
            foreach ($file_arr as $file) {
                $this->email->attach('./assets/userdata/dashboard/csr/'.$file);
            }
        }
        if($type == 'careers') {
            $this->email->attach('./assets/userdata/dashboard/jobs/cv/'.$attachment);
        }
        if($type == 'seso_essay') {
            $this->email->attach('./assets/userdata/dashboard/seso/'.$attachment);
        }
        if($type == 'adv_image') {
            $this->email->attach('./assets/userdata/dashboard/adv/image/'.$attachment);
        }
        if($type == 'adv_slider') {
            $file_arr = explode(',', $attachment);
            foreach ($file_arr as $file) {
                $this->email->attach('./assets/userdata/dashboard/adv/slider/'.$file);
            }
        }
        if($type == 'seso_drawing') {
            $file_arr = explode(',', $attachment);
            foreach ($file_arr as $file) {
                $this->email->attach('./assets/userdata/dashboard/seso/'.$file);
            }
        }
        if($type == 'adv_video') {
            $this->email->attach('./assets/userdata/dashboard/adv/video/'.$attachment);
        }
        if($type == 'cv') {
            $this->email->attach('./assets/userdata/dashboard/jobs/cv/'.$attachment);
        }
        if($type == 'sos_upgrade') {
            $file_arr_img_one = explode(',', $attachment['ad_one_img']);
            $file_arr_img_two = explode(',', $attachment['ad_two_img']);
            foreach ($file_arr_img_one as $file) {
                $this->email->attach('./assets/userdata/dashboard/ads/'.$file);
            }
            foreach ($file_arr_img_two as $file) {
                $this->email->attach('./assets/userdata/dashboard/ads/'.$file);
            }
            if($attachment['ad_one_video'] != '') {
                $this->email->attach('./assets/userdata/dashboard/ads/'.$file);
            }
            if($attachment['ad_two_video'] != '') {
                $this->email->attach('./assets/userdata/dashboard/ads/'.$file);
            }
        }
        $this->email->send();
    }
    
}

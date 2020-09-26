<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('dashboard_m');
        $this->validate_user();
        $this->set_timezone();
        $this->user_log();
        $this->profile_completion();
        $this->load_hooks();
        $this->adv = $this->adv_sidebar_module();
    }
    
    /* Validate user */
    public function validate_user() {
        if (!($this->session->has_userdata('key') && $this->session->has_userdata('user_id'))) {
            if (!$this->dashboard_m->check_login($this->session->userdata('user_id'), $this->session->userdata('key'))) {
                redirect(base_url());
            }
        }
    }
    
    /* Timezone */
    public function set_timezone() {
        if($this->input->post('timezone')) {
            date_default_timezone_set($this->input->post('timezone'));
            $this->session->set_userdata('timezone', $this->input->post('timezone'));
        }
        if($this->session->userdata('timezone') != '') {
            $timezone = $this->session->userdata('timezone');
            date_default_timezone_set($timezone);
        }
    }
    
    /* User Log */
    public function user_log() {
        if ($this->agent->is_browser()) {
            $agent = $this->agent->browser().'/'.$this->agent->version();
        } elseif ($this->agent->is_robot()) {
            $agent = $this->agent->robot();
        } elseif ($this->agent->is_mobile()) {
            $agent = $this->agent->mobile();
        }
        $platform = $this->agent->platform();
        $device = $agent." ($platform)";
        $this->dashboard_m->save_user_log($this->session->userdata('user_id'), $device);
    }

    /* Profile completion */
    public function profile_completion() {
        $pages = array('activation_key', 'general_faq', 'payment_faq', 'logout', 'accounts', 'success' , 'payment','ccAve_payment','ccAve_payment_done', 'cancel', 'account_update', 'help', 'add_info', 'add_user_info', 'add_org_info', 'report', 'contact', 'set_timezone', 'about', 'privacy_policy', 'terms_and_conditions');
        if (!in_array($this->uri->segment(2), $pages) && $this->uri->segment(2) != '') {
            $val = $this->dashboard_m->profile_complete($this->session->userdata('user_id'));
            if ($val->is_complete == 0 && $val->user_level != '') {
                redirect('dashboard');
            }
            if ($val->is_complete == -1 && $val->user_level == '') {
                redirect('dashboard/accounts');
            } 
        }
    }
    
    /* Load Hooks */
    public function load_hooks() {
        $this->hook = $this;
        $this->placeholder = ($this->session->userdata('user_type') == 1)? 'user_placeholder.png' : 'company_placeholder.png';
        $this->info = $this->dashboard_m->get_info($this->session->userdata('user_id'));
        $this->near_connections = $this->dashboard_m->get_near_connection();
        $this->recent_act = $this->dashboard_m->recent_activities();
        $this->notifications = $this->load_notifications();
        $this->req_notifications = $this->conn_req_notifications();
        $this->thoughts = $this->dashboard_m->get_thoughts();
        $this->complete_meter = $this->dashboard_m->get_profile_completion();
        $this->near_groups = $this->dashboard_m->get_near_groups();
        $this->dashboard_m->free_user_upgrade();
        $this->dashboard_m->free_user_upgrade_sos();
    }
    
    /* Activation Key */
    public function activation_key() {
        $key = $this->dashboard_m->get_activation_key($this->info->email);
        $this->load->model('email_m');
        $this->email_m->activation_key($this->info->email, $key);
        echo 'success';
    }
    
    /* Home */
    public function index() {
        $val = $this->dashboard_m->profile_complete($this->session->userdata('user_id'));
        $data['status'] = '';
        if ($val->is_complete == 0 && $val->user_level != '') {
            $data['type_name'] = $this->dashboard_m->get_type_name($this->session->userdata('user_type'));
            $data['cat_main'] = $this->dashboard_m->get_category();
            $data['countries'] = $this->dashboard_m->get_country_list();
            $data['status'] = 'incomplete';
        }
        if ($val->is_complete == -1 && $val->user_level == '') {
            redirect('dashboard/accounts');
        }
        if($data['status'] == '' && $this->session->userdata('enroll') == 1) {
            $this->session->unset_userdata('enroll');
            redirect('dashboard/offers');
        }
        if($this->session->userdata('sos') == '') { $this->session->set_userdata('sos', 1); }
        if($this->session->userdata('offer_modal') == '') { $this->session->set_userdata('offer_modal', 1); }
        if($this->info->type_id == 3) {
            $data['js'] = array('moment.js', 'moment-timezone-with-data.js', 'tzdetect.js', 'mediaelement-and-player.min.js');
            $data['view'] = 'dashboard/csr';
        } else {
            $data['css'] = array('mediaelementplayer.min.css');
            $data['js'] = array('locationpicker.jquery.min.js', 'mediaelement-and-player.min.js', 'moment.js', 'moment-timezone-with-data.js', 'tzdetect.js', 'linkify.min.js', 'linkify-jquery.min.js', 'shorten.js');
            $data['url_js'] = array('https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCkU8oEqYFaUPjSl-KBwwxKeslJ9NAsMak');
            $data['customJs'] = "$('.newsfeed-body #timeline .main .timeline_post').find('.timeline_post_content p').linkify({ target: '_blank' }); $('.timeline_post_content p').shorten({ 'showChars': 300, 'moreText': 'See More', 'lessText': 'Less' });";
            $data['feed'] = $this->load_trending_feed('home');
            $data['view'] = 'dashboard/index';
        }
        $this->renderPage($data, 'dashboard');
    }
    
    public function initiatives() {
        $data['status'] = '';
        $data['css'] = array('mediaelementplayer.min.css');
        $data['js'] = array('locationpicker.jquery.min.js', 'mediaelement-and-player.min.js', 'moment.js', 'moment-timezone-with-data.js', 'tzdetect.js', 'linkify.min.js', 'linkify-jquery.min.js', 'shorten.js');
        $data['url_js'] = array('https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCkU8oEqYFaUPjSl-KBwwxKeslJ9NAsMak');
        $data['customJs'] = "$('.newsfeed-body #timeline .main .timeline_post').find('.timeline_post_content p').linkify({ target: '_blank' }); $('.timeline_post_content p').shorten({ 'showChars': 300, 'moreText': 'See More', 'lessText': 'Less' });";
        $data['feed'] = $this->load_trending_feed('home');
        $data['view'] = 'dashboard/index';
        $this->renderPage($data, 'dashboard');
    }


    /* Socialize */
    public function timeline() {
        $data['css'] = array('snippets.css', 'mediaelementplayer.min.css');
        $data['url_css'] = array('https://fonts.googleapis.com/css?family=Pompiere');
        $data['js'] = array('locationpicker.jquery.min.js', 'mediaelement-and-player.min.js', 'moment.js', 'moment-timezone-with-data.js', 'tzdetect.js', 'linkify.min.js', 'linkify-jquery.min.js', 'shorten.js');
        $data['url_js'] = array('https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCkU8oEqYFaUPjSl-KBwwxKeslJ9NAsMak');
        $data['c_newsfeed'] = count($this->dashboard_m->get_user_newsfeed());
        if(1 == 1) {
            $data['feed'] = $this->load_trending_feed('home');
            if($data['feed'] != '') { $data['customJs'] = "$('.home #timeline .trend_title').fadeIn(); $('#newsfeed #load_more').css('display', 'block'); load_media(); $('.newsfeed-body #timeline .main .timeline_post').find('.timeline_post_content p').linkify({ target: '_blank' }); $('.timeline_post_content p').shorten({ 'showChars': 300, 'moreText': 'See More', 'lessText': 'Less' });"; }
        } else {
            $data['feed'] = $this->load_news_feed('home');
            if($data['feed'] != '') { $data['customJs'] = "$('#newsfeed #load_more').css('display', 'block'); load_media(); $('.newsfeed-body #timeline .main .timeline_post').find('.timeline_post_content p').linkify({ target: '_blank' }); $('.timeline_post_content p').shorten({ 'showChars': 300, 'moreText': 'See More', 'lessText': 'Less' });"; }
        }
        $data['c_job'] = ($this->info->type_id == 1)? $this->dashboard_m->get_curr_user_cv_count() : $this->dashboard_m->get_curr_user_single_user_job_post_count();
        $data['view'] = 'dashboard/timeline';
        $this->renderPage($data, 'dashboard');
    }

    /* Gallery */
    public function gallery() {
        if($this->input->post('type') === 'img') {
            $data['gallery'] = $this->dashboard_m->get_user_gallery_images();
        }
        if($this->input->post('type') === 'vd') {
            $data['gallery'] = $this->dashboard_m->get_user_gallery_videos();
        }
        $arr['gallery'] = $this->load->view('dashboard/gallery', $data, true);
        echo json_encode($arr);
    }
    
    public function gallery_singleview() {
        if($this->input->post('post_id')) {
            $data['file'] = $this->dashboard_m->gallery_singleview($this->input->post('post_id'));
        }
        $this->load->view('dashboard/modals/gallery-block', $data);
    }
    
    public function load_more_usergallery() {
        if($this->input->post('last_id') && $this->input->post('type') == 'img') {
            $data['gallery'] = $this->dashboard_m->getmore_user_gallery_images($this->input->post('last_id'));
        }
        if($this->input->post('last_id') && $this->input->post('type') == 'vd') {
            $data['gallery'] = $this->dashboard_m->getmore_user_gallery_videos($this->input->post('last_id'));
        }
        $arr['gallery'] = $this->load->view('dashboard/gallery', $data, true);
        echo json_encode($arr);
    }
    
    /* Payment*/
    public function accounts() {
        $val = $this->dashboard_m->profile_complete($this->session->userdata('user_id'));
        if ($val->is_complete == 0 && $val->user_level != '') {
            redirect('dashboard');
        } else {
            if($val->user_level != '') {
                redirect('dashboard');
            } else {    
                $data['view'] = 'dashboard/accounts';
                $data['css'] = array('sweetalert2.css', 'mediaelementplayer.min.css');
                $data['js'] = array('es6-promise.auto.min.js', 'sweetalert2.js', 'moment.js', 'moment-timezone-with-data.js', 'tzdetect.js', 'mediaelement-and-player.min.js');
                $this->renderPage($data, 'dashboard');
            }
        }   
    }
    
    /* Paypal */
    public function payment() {
        $amount = $this->input->post('amount');
        if($this->info->type_id == 3 && $amount < 280) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Invalid amount entered</div>');
            redirect(base_url('dashboard/accounts'));
        }
        if($this->info->type_id != 3 && $amount < 10) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Invalid amount entered</div>');
            redirect(base_url('dashboard/accounts'));
        }
        $this->load->library('paypal_lib');
        $returnURL = base_url().'dashboard/success'; 
        $cancelURL = base_url().'dashboard/cancel'; 
        $notifyURL = base_url().'dashboard/ipn';
        $userID = $this->session->userdata('user_id'); 
        $logo = base_url().'assets/img/logo-orange.png';
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('item_name', 'WA premium membership');
        $this->paypal_lib->add_field('custom', $userID);
        $this->paypal_lib->add_field('item_number',  1); 
        $this->paypal_lib->add_field('amount',  $amount);        
        $this->paypal_lib->image($logo);
        $this->paypal_lib->paypal_auto_form();
    }
    
    public function upgrade() {
        $amount = $this->input->post('amount');
        if($this->info->type_id == 3 && $amount < 280) {
            $this->session->set_flashdata('msg_amount', '<div class="alert alert-danger" role="alert">Invalid amount entered</div>');
            redirect(base_url('dashboard/profile_update/3#payment-form'));
        }
        if($this->info->type_id != 3 && $amount < 10) {
            $this->session->set_flashdata('msg_amount', '<div class="alert alert-danger" role="alert">Invalid amount entered</div>');
            redirect(base_url('dashboard/profile_update/3#payment-form'));
        }
        $this->load->library('paypal_lib');
        $returnURL = base_url().'dashboard/upgrade_success'; 
        $cancelURL = base_url().'dashboard/cancel/upgrade'; 
        $notifyURL = base_url().'dashboard/ipn';
        $userID = $this->session->userdata('user_id'); 
        $logo = base_url().'assets/img/logo-orange.png';
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('item_name', 'WA premium membership');
        $this->paypal_lib->add_field('custom', $userID);
        $this->paypal_lib->add_field('item_number',  1); 
        $this->paypal_lib->add_field('amount',  $amount);        
        $this->paypal_lib->image($logo);
        $this->paypal_lib->paypal_auto_form();
    }
    
    public function upgrade_success() {
        if(count($_POST) < 1 && !isset($_POST['item_number']) && !isset($_POST['txn_id'])) {
            redirect('dashboard');
        } else {
            $paypalInfo = $_POST;
            $data['user_id'] = $value['user_id'] = $this->session->userdata('user_id');
            $data['item_number'] = $value['item_number'] = $paypalInfo["item_number"];
            $data['txn_id'] = $value['txn_id'] = $paypalInfo["txn_id"];
            $data['payment_gross'] = $value['payment_gross'] = $paypalInfo["payment_gross"];
            $data['currency_code'] = $value['currency_code'] = $paypalInfo["mc_currency"];
            $data['payer_email'] = $value['payer_email'] = $paypalInfo["payer_email"];
            $data['payment_status'] = $value['payment_status'] = $paypalInfo["payment_status"];
            $value['date'] = date('d M Y');
            $value['time'] = time();
            $data['type'] = 'upgrade';
                $value['type'] = 'pre';
            if($data['payment_status'] == 'Completed' || $data['payment_status'] == 'Pending') {
                $status = $this->dashboard_m->profile_upgrade($value, 'pre');
                if($status == 'Completed') {
                    $this->load->model('email_m');
                    $amount = $this->input->post('payment_gross').' '.$this->input->post('mc_currency');
                    $this->email_m->payment_invoice($this->info->email, $amount, $data['txn_id']);
                }
                $data['view'] = 'dashboard/paypal/success';
                $this->renderPage($data, 'dashboard');
            }
        }
    }
    
    public function success() {
        if(count($_POST) < 1 && !isset($_POST['item_number']) && !isset($_POST['txn_id'])) {
            redirect('dashboard');
        } else {
            $paypalInfo = $_POST;
            $data['user_id'] = $value['user_id'] = $this->session->userdata('user_id');
            $data['item_number'] = $value['item_number'] = $paypalInfo["item_number"];
            $data['txn_id'] = $value['txn_id'] = $paypalInfo["txn_id"];
            $data['payment_gross'] = $value['payment_gross'] = $paypalInfo["payment_gross"];
            $data['currency_code'] = $value['currency_code'] = $paypalInfo["mc_currency"];
            $data['payer_email'] = $value['payer_email'] = $paypalInfo["payer_email"];
            $data['payment_status'] = $value['payment_status'] = $paypalInfo["payment_status"];
            $value['date'] = date('d M Y');
            $value['time'] = time();
            $data['type'] = 'normal';
            $value['type'] = 'pre';
            if($data['payment_status'] == 'Completed' || $data['payment_status'] == 'Pending') {
                $status = $this->dashboard_m->insert_transaction($value, 'pre');
                if($status == 'Completed') {
                    $this->load->model('email_m');
                    $amount = $this->input->post('payment_gross').' '.$this->input->post('mc_currency');
                    $this->email_m->payment_invoice($this->info->email, $amount, $data['txn_id']);
                }
                $data['view'] = 'dashboard/paypal/success';
                $this->renderPage($data, 'dashboard');
            }
        }
    }
    
    public function cancel($type = ''){
        $data['type'] = $type;
        $data['view'] = 'dashboard/paypal/cancel';
        $this->renderPage($data, 'dashboard');
    }
    
    public function ipn(){
        if(count($_POST) < 1) {
            redirect('dashboard');
        } else {
            $paypalInfo    = $_POST;
            $data['user_id'] = $paypalInfo['custom'];
            $data['product_id']    = $paypalInfo["item_number"];
            $data['txn_id']    = $paypalInfo["txn_id"];
            $data['payment_gross'] = $paypalInfo["payment_gross"];
            $data['currency_code'] = $paypalInfo["mc_currency"];
            $data['payer_email'] = $paypalInfo["payer_email"];
            $data['payment_status']    = $paypalInfo["payment_status"];
            $paypalURL = $this->paypal_lib->paypal_url;        
            $result    = $this->paypal_lib->curlPost($paypalURL,$paypalInfo);
        }
    }
    
    /* Account Update */
    public function account_update() {
        $val = $this->dashboard_m->profile_complete($this->session->userdata('user_id'));
        if ($val->is_complete == -1 && $val->user_level == '') {
            if($this->dashboard_m->update_user_account()) {
                redirect('dashboard');
            }            
        } else {
            redirect('dashboard');
        }
        
    }

    /* Add info */
    public function add_info() {
        if ($this->input->post('submit')) {
            if ($this->session->userdata('user_type') == '1') :
                $this->add_user_info();
            else :
                $this->add_org_info();
            endif;
        } else {
            redirect('Page404');
        }
    }
    
    /* User Info */
   public function add_user_info() {
        if ($this->input->post('gender') == '') {
            echo 'invalid_gender';
            exit();
        }
        if ($this->input->post('country') == '') {
            echo 'invalid_country';
            exit();
        }
        if ($this->input->post('interest') == '') {
            echo 'invalid_interest';
            exit();
        }
        $this->form_validation->set_rules('fname', 'First name', 'trim|required|alpha');
        $this->form_validation->set_rules('lname', 'Last name', 'trim|required|alpha');
        $this->form_validation->set_message('alpha', 'Only alphabets are allowed in %s.');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'user_id' => $this->session->userdata('user_id'),
                'firstname' => $this->input->post('fname'),
                'lastname' => $this->input->post('lname'),
                'country' => $this->input->post('country'),
                'gender' => $this->input->post('gender'),
                'job' => 1
            );
            $this->dashboard_m->add_category($this->input->post('interest'));
            $this->dashboard_m->add_user_info($data, $this->input->post('reference'));
            $this->dashboard_m->add_user_privacy();
            echo 'success';
        } else {
            echo validation_errors();
        }
    }
    
    public function update_user_info() {
        $this->form_validation->set_rules('fname', 'Full name', 'trim|required');
        $this->form_validation->set_rules('lname', 'last name', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('prof', 'Prof', 'trim|required');
        $this->form_validation->set_rules('desc', 'Desc', 'trim|required');
        $this->form_validation->set_rules('gender', 'Gender', 'trim|required');
        $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            if ($this->input->post('interest') != '') {
                $hobbies = ($this->input->post('hobbies') != '') ? implode(',', $this->input->post('hobbies')) : '';
                $data = array(
                    'user_id' => $this->session->userdata('user_id'),
                    'firstname' => $this->input->post('fname'),
                    'lastname' => $this->input->post('lname'),
                    'address' => $this->input->post('address'),
                    'city' => $this->input->post('city'),
                    'state' => $this->input->post('state'),
                    'country' => $this->input->post('country'),
                    'hobbies' => $hobbies,
                    'profession' => $this->input->post('prof'),
                    'about' => $this->input->post('desc'),
                    'gender' => $this->input->post('gender'),
                    'mobile' => $this->input->post('mobile'),
                    'birthday' => $this->input->post('birthday')
                );
                $data_social = array(
                    'user_id' => $this->session->userdata('user_id'),
                    'facebook' => $this->input->post('facebook'),
                    'linkedin' => $this->input->post('linkedin'),
                    'twitter' => $this->input->post('twitter'),
                    'google_plus' => $this->input->post('google')
                );
                $this->dashboard_m->update_category($this->input->post('interest'));
                $this->dashboard_m->update_user_info($data);
                $this->dashboard_m->user_social_info($data_social);
                $this->session->set_flashdata('msg_1', '<div id="form_alert_success" class="alert alert-success" role="alert">Profile info updated successfully.</div>');
                echo 'success';
            } else {
                echo 'error';
            }
        } else {
            echo 'error';
        }
    }
    
    /* Org Info */
    public function add_org_info() {
        if ($this->input->post('country') == '') {
            echo 'invalid_country';
            exit();
        }
        if ($this->input->post('interest') == '') {
            echo 'invalid_interest';
            exit();
        }
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'user_id' => $this->session->userdata('user_id'),
                'name' => $this->input->post('name'),
                'country' => $this->input->post('country'),
                'job' => 1
            );
            $this->dashboard_m->add_category($this->input->post('interest'));
            $this->dashboard_m->add_org_info($data, $this->input->post('reference'));
            $this->dashboard_m->add_org_privacy();
            echo 'success';
        } else {
            echo validation_errors();
        }
    }
    
    public function update_org_info() {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('state', 'State', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('about', 'About', 'trim|required');
        $this->form_validation->set_rules('tel', 'Telephone', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            if ($this->input->post('interest') != '') {
                $data = array(
                    'user_id' => $this->session->userdata('user_id'),
                    'name' => $this->input->post('name'),
                    'website' => $this->input->post('website'),
                    'address' => $this->input->post('address'),
                    'city' => $this->input->post('city'),
                    'state' => $this->input->post('state'),
                    'country' => $this->input->post('country'),
                    'tel' => $this->input->post('tel'),
                    'fax' => $this->input->post('fax'),
                    'about' => $this->input->post('about')
                );
                $data_social = array(
                    'user_id' => $this->session->userdata('user_id'),
                    'facebook' => $this->input->post('facebook'),
                    'linkedin' => $this->input->post('linkedin'),
                    'twitter' => $this->input->post('twitter'),
                    'google_plus' => $this->input->post('google')
                );
                $this->dashboard_m->update_category($this->input->post('interest'));
                $this->dashboard_m->update_org_info($data);
                $this->dashboard_m->user_social_info($data_social);
                $this->session->set_flashdata('msg_1', '<div id="form_alert_success" class="alert alert-success" role="alert">Profile info updated successfully.</div>');
                echo 'success';
            } else {
                echo 'error';
            }
        } else {
            echo 'error';
        }
    }   

    /* Logout */
    public function logout() {
        $this->load->helper('cookie');
        delete_cookie('wa_i');
        delete_cookie('wa_l');
        delete_cookie('wa_t');
        delete_cookie('wa_k');
        session_destroy();
        $this->session->sess_destroy();
        redirect(base_url('login'));
    }

    /* Blog */
    public function blog($id = '', $comment = '') {
        $data['css'] = array('editor.css', 'mediaelementplayer.min.css');
        $data['js'] = array('editor.js', 'mediaelement-and-player.min.js', 'linkify.min.js', 'linkify-jquery.min.js');
        if($id != '') {
            if($this->dashboard_m->check_blog_view($id)) {
                $data['blog'] = $this->dashboard_m->get_user_single_blog($id);
                if($comment != '') {
                    $cmt = $this->dashboard_m->get_comment_row($comment);
                    if($cmt->is_child == 1) {
                        $data['customJs'] = "$('video,audio').mediaelementplayer({ enableAutosize: true }); load_comment_highlight('blog', $id, $comment); load_child_comment_highlight($cmt->parent_id, $comment); $(document).ready(function () { $('.blog-post-single .blog-content p').linkify({ target: '_blank' }); });";
                    } else {
                        $data['customJs'] = "$('video,audio').mediaelementplayer({ enableAutosize: true }); load_comment_highlight('blog', $id, $comment); $(document).ready(function () { $('.blog-post-single .blog-content p').linkify({ target: '_blank' }); });";
                    } 
                } else {
                    $data['customJs'] = "$('video,audio').mediaelementplayer({ enableAutosize: true }); load_comment('blog', $id); $(document).ready(function () { $('.blog-post-single .blog-content p').linkify({ target: '_blank' }); });";
                }
                $data['view'] = 'dashboard/blog-single';
                $this->renderPage($data, 'dashboard');
            } else {
                redirect('dashboard');
            }
        } else {
            $data['customJs'] = "load_blog()";
            $data['load_more'] = FALSE;
            if($this->dashboard_m->get_user_blog_count($this->session->userdata('user_id')) > 10) {
                $data['load_more'] = TRUE;
            }
            $data['view'] = 'dashboard/blog';
            $this->renderPage($data, 'dashboard');
        }
    }
    
    public function user_blog_check($blog_id) {
        if($this->dashboard_m->get_user_single_blog($blog_id)->main_user_id == $this->session->userdata('user_id')) {
            echo '<div class="dropdown clearfix"> 
                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ion-android-more-vertical"></i></button> 
                    <ul class="dropdown-menu dropdown-menu-right"> 
                        <li><a data-toggle="modal" onclick="update_blog('.$blog_id.')">Edit</a></li>
                        <li><a data-toggle="modal" data-target="#modal_delete" onclick="delete_blog('.$blog_id.')">Delete</a></li>
                    </ul> 
                  </div>';
        }
    }
    
    public function load_user_blog() {
        if($this->input->post('last_id')) {
            $data['load_type'] = 'more';
            $data['blogs'] = $this->dashboard_m->get_user_more_blog($this->session->userdata('user_id'), $this->input->post('last_id'));
            $this->load->view('dashboard/blog-block', $data);
        } else {
            $data['load_type'] = 'single';
            $data['blogs'] = $this->dashboard_m->get_user_blog($this->session->userdata('user_id'));
            $this->load->view('dashboard/blog-block', $data);
        }
    }
    
    public function submit_blog_image() {
        $this->load->library('upload');
        if (isset($_FILES['file']['name'])) {
            $config['upload_path'] = './assets/userdata/dashboard/blog';
            $tmp3 = explode('.', $_FILES['file']['name']);
            $ext3 = end($tmp3);
            $file = date("ymd") . time() . '.' . strtolower($ext3) ;
            $config['file_name'] = $file;
            $config['allowed_types'] = 'jpg|png|jpeg';
            $this->upload->initialize($config);
            $this->upload->do_upload('file');
            $this->image_resize($file, 'blog');
            $id = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', mt_rand(1,10))),1,10);
            $arr = array('url' => base_url('assets/userdata/dashboard/blog/'.$file), 'id' => $id);    
            echo stripslashes(json_encode($arr));
        }
    }

    public function submit_blog() {
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        if($this->info->user_level != 0) {
            $this->form_validation->set_rules('editor_blog', 'Content', 'trim|required');
        } else {
            $this->form_validation->set_rules('editor_blog', 'Content', 'trim|required|max_length[700]');
        }
        $this->form_validation->set_rules('privacy', 'Privacy', 'required|integer');
        if ($this->form_validation->run() == TRUE) {
            $tags = ($this->input->post('tags') != '') ? implode(',', $this->input->post('tags')) : '';
            $this->load->library('upload');
            $file = '';
            if (isset($_FILES['file']['name']) && $this->info->user_level != 0) {
                $config['upload_path'] = './assets/userdata/dashboard/blog';
                $tmp3 = explode('.', $_FILES['file']['name']);
                $ext3 = end($tmp3);
                $file = date("ymd") . time() . '.' . strtolower($ext3) ;
                $config['file_name'] = $file;
                $config['allowed_types'] = 'jpg|png|mp4|jpeg';
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('file')) { 
                    echo $this->upload->display_errors(); 
                    exit(); 
                } else {
                    $this->image_resize($file, 'blog');
                }
            }
            $data = array('user_id' => $this->session->userdata('user_id'), 'title' => $this->input->post('title'), 'content' => $this->input->post('editor_blog'), 'tags' => $tags, 'file' => $file, 'date' => date('d M Y'), 'time' => time(), 'privacy' => $this->input->post('privacy'));
            $this->dashboard_m->insert_blog($data, $this->input->post('privacy'));
            echo 'success';
        } else {
            echo validation_errors();
        }
    }
    
    public function delete_editor_image() {
        if($this->input->post('src')) {
            $arr = explode('/', $this->input->post('src'));
            unlink('assets/userdata/dashboard/blog/' . end($arr));
        }
    }
    
    public function update_blog() {
        if($this->input->post('id') != '') {
            $data['blog'] = $this->dashboard_m->get_curr_user_single_user_blog($this->input->post('id'));
            if(isset($data['blog']->title)) {
                $this->load->view('dashboard/modals/update-blog', $data);
            }
        }
        
        if($this->input->post('blog_update_id') != '') {
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            if($this->info->user_level != 0) {
                $this->form_validation->set_rules('editor_blog_update', 'Content', 'trim|required');
            } else {
                $this->form_validation->set_rules('editor_blog_update', 'Content', 'trim|required|max_length[700]');
            }
            $this->form_validation->set_rules('privacy', 'Privacy', 'required|integer');
            if ($this->form_validation->run() == TRUE) {
                $file = '';
                $this->load->library('upload');
                $tags = ($this->input->post('tags') != '') ? implode(',', $this->input->post('tags')) : '';
                if (isset($_FILES['file']['name']) && $this->info->user_level != 0) {
                    $config['upload_path'] = './assets/userdata/dashboard/blog';
                    $tmp3 = explode('.', $_FILES['file']['name']);
                    $ext3 = end($tmp3);
                    $file = date("ymd") . time() . '.' . strtolower($ext3) ;
                    $config['file_name'] = $file;
                    $config['allowed_types'] = 'jpg|png|mp4|jpeg';
                    $this->upload->initialize($config);
                    (!$this->upload->do_upload('file')) ? $this->break_form() : $delete_file = $this->dashboard_m->get_curr_user_single_user_blog($this->input->post('blog_update_id'))->file; ($delete_file != '') ? unlink('assets/userdata/dashboard/blog/' . $delete_file) : '';
                    if($file != '') { $this->image_resize($file, 'blog'); }
                }
                $data = array('title' => $this->input->post('title'), 'content' => $this->input->post('editor_blog_update'), 'tags' => $tags, 'date' => date('d M Y'), 'time' => time(), 'privacy' => $this->input->post('privacy'));
                $this->dashboard_m->update_blog($data, $file, $this->input->post('blog_update_id'));
                $this->session->set_flashdata('msg','<div class="alert alert-success single-alert">Blog post updated successfully.</div>');
                echo 'success';
            } else {
                echo validation_errors();
            }
        }
    }
    
    public function break_form() {
        echo $this->upload->display_errors(); 
        exit();
    }
    
    public function check_blog_view($id) {
        return $this->dashboard_m->check_blog_view($id);
    }

    public function delete_blog() {
        $blog_id = $this->input->post('id');
        if($this->dashboard_m->delete_blog($blog_id)) {
            if($this->input->post('page_type') == 'single') {
                $this->session->set_flashdata('msg','<div class="alert alert-success single-alert">Blog post deleted successfully.</div>');
            } 
            echo 'success';
        }
    }
    
    /* Search */
    public function search() {
        if($this->input->get('key')) {
            $key = $this->input->get('key');
            $data['users'] = $this->dashboard_m->get_user_search($key);
            $data['blogs'] = $this->dashboard_m->get_blog_search($key);
            $data['groups'] = $this->dashboard_m->get_group_search($key);
            $data['posts'] = $this->dashboard_m->get_post_search($key);
            $data['ucount'] = $this->dashboard_m->get_user_search_count($key);
            $data['bcount'] = $this->dashboard_m->get_blog_search_count($key);
            $data['gcount'] = $this->dashboard_m->get_group_search_count($key);
            $data['pcount'] = $this->dashboard_m->get_post_search_count($key);
        }
        $data['view'] = 'dashboard/search';
        $this->renderPage($data, 'dashboard');
    }
    
    public function load_more_usersearch() {
        if($this->input->post('last_id') && $this->input->post('search')) {
            $data['type'] = 'user'; 
            $data['users'] = $this->dashboard_m->get_more_usersearch($this->input->post('search'), $this->input->post('last_id'));
            $this->load->view('dashboard/search-block', $data);
        }
    }
    
    public function load_more_blogsearch() {
        if($this->input->post('last_id') && $this->input->post('search')) {
            $data['type'] = 'blog'; 
            $data['blogs'] = $this->dashboard_m->get_more_blogsearch($this->input->post('search'), $this->input->post('last_id'));
            $this->load->view('dashboard/search-block', $data);
        }
    }
    
    public function load_more_groupsearch() {
        if($this->input->post('last_id') && $this->input->post('search')) {
            $data['type'] = 'group'; 
            $data['groups'] = $this->dashboard_m->get_more_groupsearch($this->input->post('search'), $this->input->post('last_id'));
            $this->load->view('dashboard/search-block', $data);
        }
    }
    
    public function load_more_postsearch() {
        if($this->input->post('last_id') && $this->input->post('search')) {
            $data['type'] = 'post'; 
            $data['posts'] = $this->dashboard_m->get_more_postsearch($this->input->post('search'), $this->input->post('last_id'));
            $this->load->view('dashboard/search-block', $data);
        }
    }
    
    public function ajax_search() {
        if($this->input->post('key')) {
            $data['type'] = 'ajax';
            $data['result'] = $this->dashboard_m->get_ajax_search($this->input->post('key'));
            $this->load->view('dashboard/search-block', $data);
        }
    }

    /* Connection */
    public function connection() {
        $data['type'] = $this->input->post('type');
        if($this->input->post('type') === 'all') {
            $data['conn'] = $this->dashboard_m->get_user_connection();
        }
        if($this->input->post('type') === 'blocked') {
            $data['conn'] = $this->dashboard_m->get_blocked_connection();
        }
        if($this->input->post('type') === 'followers') {
            $data['conn'] = $this->dashboard_m->get_user_followers();
        }
        $arr['con'] = $this->load->view('dashboard/connection', $data, true);
        echo json_encode($arr);
    }
    
    public function send_req() {
        if($this->input->post('req_id')) {
            if($this->dashboard_m->send_connection_req($this->input->post('req_id'))) {
                $this->hook->add_req_notification_alert($this->input->post('req_id'));
                $this->load->model('email_m');
                if($this->dashboard_m->connection_email($this->input->post('req_id')) == 0) {
                    $email = $this->dashboard_m->get_info($this->input->post('req_id'))->email;
                    $this->email_m->connection_email($email);
                    $this->dashboard_m->add_connection_email($this->input->post('req_id'));
                    $name = ($this->info->type_id == 1) ? ucfirst(strtolower($this->info->firstname)) . ' ' . ucfirst(strtolower($this->info->lastname)) : ucfirst(strtolower($this->info->name));
                    $msg = array (
                        'body'  => "$name wants to connect with you on WorthAct",
                        'title' => 'Connection Request'
                    );
                    $this->sendMessage($this->input->post('req_id'), $msg);
                }
                echo 'success';
            } 
        }
    }
    
    public function follow_user() {
        if($this->input->post('req_id')) {
            if($this->dashboard_m->follow_user($this->input->post('req_id'))) {
                echo 'success';
            } 
        }
    }
    
    public function cancel_req() {
        if($this->input->post('cancel_id')) {
            if($this->dashboard_m->cancel_connection_req($this->input->post('cancel_id'))) {
                echo 'success';
            }
        }
    }
    
    public function accept_req() {
        if($this->input->post('accept_id')) {
            if($this->dashboard_m->accept_connection_req($this->input->post('accept_id'))) {
                $this->hook->add_req_notification_alert($this->input->post('accept_id'));
                $name = ($this->info->type_id == 1) ? ucfirst(strtolower($this->info->firstname)) . ' ' . ucfirst(strtolower($this->info->lastname)) : ucfirst(strtolower($this->info->name));
                $msg = array (
                    'body'  => "$name accepted your connection request",
                    'title' => 'Connection Accepted'
                );
                $this->sendMessage($this->input->post('accept_id'), $msg);
                echo 'success';
            }
        }
    }
    
    public function delete_req() {
        if($this->input->post('delete_id')) {
            if($this->dashboard_m->delete_connection_req($this->input->post('delete_id'))) {
                echo 'success';
            }
        }
    }
    
    public function block_connection() {
        if($this->input->post('block_id')) {
            if($this->dashboard_m->block_connection($this->input->post('block_id'))) {
                echo 'success';
            }
        }
    }

    public function check_connection($frnd_id) {
        $val =  $this->dashboard_m->check_connection($frnd_id);
        $privacy = $this->dashboard_m->get_privacy($frnd_id);
        if($val === 'cancel') {
            echo "<li><a onclick='cancel_req($frnd_id, 0)' class='cancel_friend'><i class='ion-android-close'></i>Cancel Request</a><li>";
        }
        if($val === 'not_valid') {
            if($privacy->connection_deny == 1) {
                echo "<li><a onclick='follow_user($frnd_id, 0)' class='add_friend'><i class='ion-plus'></i>Follow</a><li>";
            } else {
                echo "<li><a onclick='send_req($frnd_id, 0)' class='add_friend'><i class='ion-plus'></i>Connect</a><li>";
            }
        }
        if($val === 'accept') {
            echo "<li><a onclick='accept_req($frnd_id, 0)' class='accept_friend'><i class='ion-android-done'></i>Accept Request</a><li>";
            if($privacy->connection_deny == 1) {
                echo "<li><a onclick='delete_req($frnd_id, 7)' class='delete_req'><i class='ion-android-close'></i>Delete Request</a><li>";
            } else {
                echo "<li><a onclick='delete_req($frnd_id, 0)' class='delete_req'><i class='ion-android-close'></i>Delete Request</a><li>";
            }
            echo "<li><a onclick='set_block_conn($frnd_id, 0)' class='block_user'>Block</a><li>";
        }
        if($val === 'friend') {
            echo "<li><a><i class='ion-android-done-all'></i>Connected</a><li>";
        }
        if($val === 'following') {
            echo "<li><a><i class='ion-android-done-all'></i>Following</a><li>";
        }
    }
    
    public function get_connection_details($user_one, $user_two, $type) {
        $data['type'] = $type;
        if($user_one != $this->session->userdata('user_id')) {
            $data['user'] = $this->dashboard_m->get_connection_info($user_one);
        } else {
            $data['user'] = $this->dashboard_m->get_connection_info($user_two);
        }
        if($data['user'] != '') {
            $this->load->view('dashboard/connection-block', $data);
        }
    }
    
    /* Profile */
    public function profile($id) {
        if($id != '' && $this->dashboard_m->check_user($id)) {
            $data['css'] = array('snippets.css', 'mediaelementplayer.min.css');
            $data['js'] = array('mediaelement-and-player.min.js', 'linkify.min.js', 'linkify-jquery.min.js', 'shorten.js');
            $data['url_js'] = array('https://maps.googleapis.com/maps/api/js?key=AIzaSyCP45GqZNtN3dIjgosrYcdtDpUQZUNdf3Q');
            $data['customJs'] = "load_profile_timeline(".$this->uri->segment(3).")";
            $data['profile_id'] = $id;
            $data['type'] = $this->dashboard_m->check_connection($id);
            $data['user'] = $this->dashboard_m->get_connection_info($id);
            $data['cat'] = $this->dashboard_m->get_user_category($id);
            $data['privacy'] = $this->dashboard_m->get_privacy($id);
            $data['c_count'] = $this->dashboard_m->get_user_profile_connection_count($id);
            $data['g_count'] = $this->dashboard_m->get_profile_user_joined_groups_count($id);
            $data['user_activities'] = $this->dashboard_m->user_activities($id);
            if($data['privacy']->connection_deny == 1) { $data['f_count'] = $this->dashboard_m->get_user_profile_followers_count($id); }
            $data['view'] = 'dashboard/profile';
            $this->renderPage($data, 'dashboard');
        } else {
            redirect('dashboard');
        }
    }
    
    public function profile_load() {
        $status = ($this->input->post('id') == $this->session->userdata('user_id')) ? 'same' : $this->dashboard_m->check_connection($this->input->post('id'));
        if($this->input->post('id') && $this->input->post('type') == 'gallery_img') {
            $data['type'] = 'gallery';
            $data['gallery'] = $this->dashboard_m->get_user_profile_gallery($this->input->post('id'), $status, 'image');
        }
        if($this->input->post('id') && $this->input->post('type') == 'gallery_vd') {
            $data['type'] = 'gallery';
            $data['gallery'] = $this->dashboard_m->get_user_profile_gallery($this->input->post('id'), $status, 'video');
        }
        if($this->input->post('id') && $this->input->post('type') == 'blog') {
            $data['type'] = 'blog';
            $data['blogs'] = $this->dashboard_m->get_user_profile_blog($this->input->post('id'), $status);
        }
        if($this->input->post('id') && $this->input->post('type') == 'connection') {
            $data['type'] = '3';
            $conn = $this->dashboard_m->get_user_profile_connection($this->input->post('id'));
            foreach ($conn as $con) {
                $data['user'] = '';
                if($con->user_one != $this->input->post('id')) {
                    $data['user'] = $this->dashboard_m->get_connection_info($con->user_one);
                } else {
                    $data['user'] = $this->dashboard_m->get_connection_info($con->user_two);
                }
                ($data['user'] !== '') ? $this->load->view('dashboard/connection-block', $data) : '';
            }
        }
        if($this->input->post('id') && $this->input->post('type') == 'group_c') {
            $data['type'] = 'profile_grp';
            $data['g_type'] = 'created';
            $data['groups'] = $this->dashboard_m->get_profile_user_created_groups($this->input->post('id'));
            $this->load->view('dashboard/group-block', $data);
        }
        if($this->input->post('id') && $this->input->post('type') == 'group_j') {
            $data['type'] = 'profile_grp';
            $data['g_type'] = 'joined';
            $data['groups'] = $this->dashboard_m->get_profile_user_joined_groups($this->input->post('id'));
            $this->load->view('dashboard/group-block', $data);
        }
        if($this->input->post('id') && $this->input->post('type') == 'timeline') {
            $data['type'] = 'index';
            $data['timeline_posts'] = $this->dashboard_m->get_profile_user_timeline($this->input->post('id'), $status);
        }
        if($this->input->post('id') && $this->input->post('type') == 'post') {
            $data['type'] = '';
            $data['ads'] = $this->dashboard_m->get_profile_listing($this->input->post('id'));
            $this->load->view('dashboard/post-block', $data);
        }
        if($this->input->post('id') && $this->input->post('type') == 'job') {
            $data['type'] = 'job';
            $data['jobs'] = $this->dashboard_m->get_profile_job($this->input->post('id'));
            $this->load->view('dashboard/job-block', $data);
        }
        $this->load->view('dashboard/profile-block', $data);
    }
    
    public function load_more_profileblock() {
        $status = ($this->input->post('user_id') == $this->session->userdata('user_id')) ? 'same' : $this->dashboard_m->check_connection($this->input->post('user_id'));
        if($this->input->post('last_gallery_id') && $this->input->post('user_id') && $this->input->post('type') == 'gallery_img') {
            $data['type'] = 'gallery';
            $data['gallery'] = $this->dashboard_m->get_more_userprofile_gallery($this->input->post('user_id'), $this->input->post('last_gallery_id'), $status, 'image');
        }
        if($this->input->post('last_gallery_id') && $this->input->post('user_id') && $this->input->post('type') == 'gallery_vd') {
            $data['type'] = 'gallery';
            $data['gallery'] = $this->dashboard_m->get_more_userprofile_gallery($this->input->post('user_id'), $this->input->post('last_gallery_id'), $status, 'video');
        }
        if($this->input->post('last_blog_id') && $this->input->post('user_id') && $this->input->post('type') == 'blog') {
            $data['type'] = 'blog';
            $data['blogs'] = $this->dashboard_m->get_more_userprofile_blog($this->input->post('user_id'), $this->input->post('last_blog_id'), $status);
        }
        if($this->input->post('last_timeline_id') && $this->input->post('user_id') && $this->input->post('type') == 'timeline') {
            $data['type'] = 'index';
            $data['timeline_posts'] = $this->dashboard_m->getmore_profile_user_timeline($this->input->post('user_id'), $this->input->post('last_timeline_id'), $status);
        }
        if($this->input->post('last_post_id') && $this->input->post('user_id') && $this->input->post('type') == 'post') {
            $data['type'] = '';
            $data['ads'] = $this->dashboard_m->get_more_profile_listing($this->input->post('user_id'), $this->input->post('last_post_id'));
            $this->load->view('dashboard/post-block', $data);
        }
        if($this->input->post('last_job_id') && $this->input->post('user_id') && $this->input->post('type') == 'job') {
            $data['type'] = 'job';
            $data['jobs'] = $this->dashboard_m->get_more_profile_job($this->input->post('user_id'), $this->input->post('last_job_id'));
            $this->load->view('dashboard/job-block', $data);
        }
        $this->load->view('dashboard/profile-block', $data);
    }
    
    /* Groups */
    public function add_group() {
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('desc', 'Desc', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $tags = ($this->input->post('tags') != '') ? implode(',', $this->input->post('tags')) : '';
            $this->load->library('upload');
            $file = '';
            if (isset($_FILES['file']['name'])) {
                $config['upload_path'] = './assets/userdata/dashboard/group/banner';
                $tmp3 = explode('.', $_FILES['file']['name']);
                $ext3 = end($tmp3);
                $file = date("ymd") . time() . '.' . strtolower($ext3) ;
                $config['file_name'] = $file;
                $config['allowed_types'] = 'jpg|png|jpeg';
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('file')) { $file = ''; }
                if($file != '') { $this->image_resize($file, 'group_banner'); }
            }
            $data = array('user_id' => $this->session->userdata('user_id'), 'title' => $this->input->post('title'), 'description' => $this->input->post('desc'), 'tags' => $tags, 'banner' => $file, 'date' => date('d M Y'), 'time' => time());
            $this->dashboard_m->insert_group($data);
            echo 'success';
        } else {
            echo 'error';
        }
    }
    
    public function load_group() {
        $data['type'] = '';
        if($this->input->post('type') === 'created') {
            $data['type'] = 'created';
            $data['groups'] = $this->dashboard_m->get_user_created_groups();
        }
        if($this->input->post('type') === 'joined') {
            $data['type'] = 'joined';
            $data['groups'] = $this->dashboard_m->get_user_joined_groups();
        }
        $arr['grp'] = $this->load->view('dashboard/group-block', $data, true);
        echo json_encode($arr);
    }
    
    public function load_group_members() {
        $data['type'] = ($this->dashboard_m->check_user_group($this->input->post('grp_id')) > 0)? '4' : '3';
        if($this->input->post('grp_id') && $this->input->post('type') == 'joined') {
            $members = $this->dashboard_m->get_joined_group_members($this->input->post('grp_id'));
            foreach ($members as $member) {
                $data['user'] = $this->dashboard_m->get_connection_info($member->user_id);
                $this->load->view('dashboard/connection-block', $data);
            }
        }
        if($this->input->post('grp_id') && $this->input->post('type') == 'new') {
            $data['type'] = 5;
            $members = $this->dashboard_m->get_new_group_members($this->input->post('grp_id'));
            foreach ($members as $member) {
                $data['user'] = $this->dashboard_m->get_connection_info($member->user_id);
                $this->load->view('dashboard/connection-block', $data);
            }
        }
    }
    
    public function accept_grp_member() {
        if($this->input->post('user_id')) {
            $this->dashboard_m->accept_grp_member($this->input->post('user_id'));
            $this->hook->add_notification_alert($this->input->post('user_id'));
            $name = ($this->info->type_id == 1) ? ucfirst(strtolower($this->info->firstname)) . ' ' . ucfirst(strtolower($this->info->lastname)) : ucfirst(strtolower($this->info->name));
            $grp_details = $this->dashboard_m->get_group($this->session->userdata('grp_id'));
            $this->email_m->accept_group($this->dashboard_m->get_info($this->input->post('user_id'))->email, $grp_details);
            $msg = array (
                'body'  => "$name accepted your group request",
                'title' => 'Your request was accepted!'
            );
            $this->sendMessage($this->input->post('user_id'), $msg);    
            echo $this->session->userdata('grp_id');
        }
    }
    
    public function remove_grp_member() {
        if($this->input->post('user_id')) {
            $this->dashboard_m->remove_grp_member($this->input->post('user_id'));
            echo $this->session->userdata('grp_id');
        }
    }

    public function delete_group() {
        if($this->dashboard_m->delete_group($this->input->post('id'))) {
            echo 'success';
        }
    }
    
    public function update_group() {
        if($this->input->post('id') != '') {
            $data['group'] = $this->dashboard_m->get_curr_user_group($this->input->post('id'));
            if(isset($data['group']->title)) {
                $this->load->view('dashboard/modals/update-group', $data);
            }
        }
        if($this->input->post('group_update_id') != '') {
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $this->form_validation->set_rules('desc', 'Desc', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $file = '';
                $this->load->library('upload');
                $tags = ($this->input->post('tags') != '') ? implode(',', $this->input->post('tags')) : '';
                if (isset($_FILES['file']['name'])) {
                    $config['upload_path'] = './assets/userdata/dashboard/group/banner';
                    $tmp3 = explode('.', $_FILES['file']['name']);
                    $ext3 = end($tmp3);
                    $file = date("ymd") . time() . '.' . strtolower($ext3) ;
                    $config['file_name'] = $file;
                    $config['allowed_types'] = 'jpg|png|jpeg';
                    $this->upload->initialize($config);
                    (!$this->upload->do_upload('file')) ? $file = '' : $delete_file = $this->dashboard_m->get_curr_user_group($this->input->post('group_update_id'))->banner; ($delete_file != '') ? unlink('assets/userdata/dashboard/group/banner/' . $delete_file) : '';
                    if($file != '') { $this->image_resize($file, 'group_banner'); }
                }
                $data = array('title' => $this->input->post('title'), 'description' => $this->input->post('desc'), 'tags' => $tags);
                $this->dashboard_m->update_group($data, $file, $this->input->post('group_update_id'));
                echo 'success';
            } else {
                echo 'error';
            }
        }
    }
    
    public function check_group($grp_id) {
        $val =  $this->dashboard_m->check_group($grp_id);
        if($val === 'pending') {
            echo "<li><a onclick='cancel_grp($grp_id, 0)' class='cancel_group'>Cancel Request <i class='ion-android-close'></i></a><li>";
        }
        if($val === 'not_valid') {
            echo "<li><a onclick='join_group($grp_id, 0)' class='join_group'>Join <i class='ion-plus'></i></a><li>";
        }
        if($val === 'approved') {
            echo "<li><a>Joined <i class='ion-android-done-all'></i></a><li>";
        }
        if($val === 'accept') {
            echo "<li><a onclick='accept_group($grp_id, 0)' class='join_group'>Accept <i class='ion-android-done'></i></a><li>
                  <li><a onclick='cancel_grp($grp_id, 3)' class='cancel_group'>Decline <i class='ion-android-close'></i></a><li>";
        }
    }
    
    public function join_group() {
        if($this->input->post('join_id')) {
            if($this->dashboard_m->join_group($this->input->post('join_id'))) {
                $name = ($this->info->type_id == 1) ? ucfirst(strtolower($this->info->firstname)) . ' ' . ucfirst(strtolower($this->info->lastname)) : ucfirst(strtolower($this->info->name));
                $grp_details = $this->dashboard_m->get_group($this->input->post('join_id'));
                $grp_user = $grp_details->main_user_id;
                $this->load->model('email_m');
                $this->hook->add_notification_alert($grp_user);
                $this->email_m->join_group($this->dashboard_m->get_info($grp_user)->email, $grp_details);
                $msg = array (
                    'body'  => "$name wants to join your group",
                    'title' => 'You have got a request!'
                );
                $this->sendMessage($grp_user, $msg);
                echo 'success';
            } 
        }
    }
    
    public function accept_group() {
        if($this->input->post('accept_id')) {
            if($this->dashboard_m->accept_group($this->input->post('accept_id'))) {
                echo 'success';
            } 
        }
    }
    
    public function invite_grp_members() {
        if($this->input->post('id')) {
            $data['conn'] = $this->dashboard_m->get_user_connection();
            $data['grp_id'] = $this->input->post('id');
            $this->load->view('dashboard/modals/invite-grp-mem', $data);
        }
    }
    
    public function send_grp_invitation() {
        if($this->input->post('invites') != '') {
            if($this->dashboard_m->check_user_group($this->input->post('grp_id')) > 0 && $this->input->post('grp_id') != '') {
                $this->load->model('email_m');
                $this->dashboard_m->add_grp_invitations($this->input->post('grp_id'), $this->input->post('invites'));
                $grp_details = $this->dashboard_m->get_group($this->input->post('grp_id'));
                $name = ($this->info->type_id == 1) ? ucfirst(strtolower($this->info->firstname)) . ' ' . ucfirst(strtolower($this->info->lastname)) : ucfirst(strtolower($this->info->name));
                $msg = array (
                    'body'  => "$name invited you to join a group",
                    'title' => 'You have got a Invitation!'
                );
                foreach($this->input->post('invites') as $invite) {
                    if($invite != 0) {
                        $this->hook->add_notification_alert($invite);
                        $this->email_m->invite_group($this->dashboard_m->get_info($invite)->email, $grp_details);
                        $this->sendMessage($invite, $msg);
                    }
                }
                echo 'success';
            } else {
                echo 'Invalid group';
            }
        } else {
            echo 'Select a connection';
        }
    }

    public function invite_user_details($id, $grp_id) {
        $user = $this->dashboard_m->get_connection_info($id);
        if($this->dashboard_m->check_grp_invite_user($id, $grp_id) == 0) {
            $name = ($user->type_id == 1)? ucfirst(strtolower($user->firstname)) . ' ' . ucfirst(strtolower($user->lastname)) : ucfirst(strtolower($user->name));
            echo "<option value='$user->main_id'>$name</option>";
        }        
    }
    
    public function cancel_grp() {
        if($this->input->post('cancel_id')) {
            if($this->dashboard_m->cancel_group_req($this->input->post('cancel_id'))) {
                echo 'success';
            }
        }
    }
    
    public function group($id) {
        if($id != '' && $this->dashboard_m->validate_group($id)) {
            $data['css'] = array('snippets.css', 'mediaelementplayer.min.css');
            $data['js'] = array('locationpicker.jquery.min.js', 'mediaelement-and-player.min.js', 'linkify.min.js', 'linkify-jquery.min.js');
            $data['url_js'] = array('https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCkU8oEqYFaUPjSl-KBwwxKeslJ9NAsMak');
            $data['customJs'] = "load_grp_timeline('$id');";
            $data['group_id'] = $id;         
            $this->session->set_userdata('grp_id', $id);
            $data['type'] = $this->dashboard_m->check_group($id);
            $data['group'] = $this->dashboard_m->get_group($id);
            $data['view'] = 'dashboard/group';
            $this->renderPage($data, 'dashboard');
        } else {
            redirect('dashboard');
        }
    }
    
    public function group_timeline_submit() {
        if($this->input->post('submit_type') === 'grp_photo') {
            if(count($_FILES) !== 0) {
                $tags = ($this->input->post('tags') != '') ? implode(',', $this->input->post('tags')) : '';
                $this->load->library('upload');
                $config['upload_path'] = './assets/userdata/dashboard/group/content';
                for($i = 0; $i < count($_FILES); $i++) {
                    $tmp3 = explode('.', $_FILES['file'.$i]['name']);
                    $ext3 = end($tmp3);
                    $file = date("ymd") . (time()+$i) . '.' . strtolower($ext3) ;
                    $config['file_name'] = $file;
                    $config['allowed_types'] = 'jpg|png|jpeg';
                    $this->upload->initialize($config);
                    if($this->upload->do_upload('file'.$i)){ $tmp_ary[] = $file; }
                }
                $file_str = implode(',', $tmp_ary);
                foreach ($tmp_ary as $arr) {
                    $this->image_resize($arr, 'group_photo');
                }
                $data = array('user_id' => $this->session->userdata('user_id'), 'group_id' => $this->session->userdata('grp_id'), 'content_type' => 'image', 'title' => $this->input->post('title'), 'description' => $this->input->post('desc'), 'tags' => $tags, 'file' => $file_str, 'time' => time(), 'date' => date('d M Y'));
                ($file_str != '') ? $this->dashboard_m->add_grp_content($data) : '';
                echo $this->session->userdata('grp_id');
            } else { echo 'error'; }
        } elseif($this->input->post('submit_type') === 'grp_video') {
            $this->load->library('upload');
            $tags = ($this->input->post('tags') != '') ? implode(',', $this->input->post('tags')) : '';
            if (isset($_FILES['file']['name'])) {
                $config['upload_path'] = './assets/userdata/dashboard/group/content';
                $tmp3 = explode('.', $_FILES['file']['name']);
                $ext3 = end($tmp3);
                $file = date("ymd") . time() . '.' . strtolower($ext3) ;
                $config['file_name'] = $file;
                $config['allowed_types'] = 'mp4';
                $this->upload->initialize($config);
                $data = array('user_id' => $this->session->userdata('user_id'), 'group_id' => $this->session->userdata('grp_id'), 'content_type' => 'video', 'title' => $this->input->post('title'), 'description' => $this->input->post('desc'), 'tags' => $tags, 'file' => $file, 'time' => time(), 'date' => date('d M Y'));
                ($this->upload->do_upload('file')) ? $this->dashboard_m->add_grp_content($data) : '';
                echo $this->session->userdata('grp_id');
            } else { echo 'error'; }
        } elseif($this->input->post('submit_type') === 'grp_file') {
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $this->load->library('upload');
                $tags = ($this->input->post('tags') != '') ? implode(',', $this->input->post('tags')) : '';
                if (isset($_FILES['file']['name'])) {
                    $config['upload_path'] = './assets/userdata/dashboard/group/content';
                    $tmp3 = explode('.', $_FILES['file']['name']);
                    $ext3 = end($tmp3);
                    $file = date("ymd") . time() . '.' . strtolower($ext3) ;
                    $config['file_name'] = $file;
                    $config['allowed_types'] = 'pdf|txt|doc|docx|xlsx|xls|csv|ppt|pptx';
                    $this->upload->initialize($config);
                    $data = array('user_id' => $this->session->userdata('user_id'), 'group_id' => $this->session->userdata('grp_id'), 'content_type' => 'file', 'title' => $this->input->post('title'), 'description' => $this->input->post('desc'), 'tags' => $tags, 'file' => $file, 'time' => time(), 'date' => date('d M Y'));
                    ($this->upload->do_upload('file')) ? $this->dashboard_m->add_grp_content($data) : '';
                    echo $this->session->userdata('grp_id');
                } else { echo 'error'; }
            } else { echo 'error'; }
        } elseif($this->input->post('submit_type') === 'grp_location') {
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $this->form_validation->set_rules('cordinates', 'Cordinates', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $tags = ($this->input->post('tags') != '') ? implode(',', $this->input->post('tags')) : '';
                $data = array('user_id' => $this->session->userdata('user_id'), 'group_id' => $this->session->userdata('grp_id'), 'content_type' => 'location', 'title' => $this->input->post('title'), 'description' => $this->input->post('desc'), 'tags' => $tags, 'map' => $this->input->post('cordinates'), 'time' => time(), 'date' => date('d M Y'));
                $this->dashboard_m->add_grp_content($data);
                echo $this->session->userdata('grp_id');
            } else { echo 'error'; }
        } elseif($this->input->post('submit_type') === 'grp_thought') {
            $this->form_validation->set_rules('grp_message', 'Message', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $data = array('user_id' => $this->session->userdata('user_id'), 'group_id' => $this->session->userdata('grp_id'), 'content_type' => 'thought', 'description' => $this->input->post('grp_message'), 'time' => time(), 'date' => date('d M Y'));
                $this->dashboard_m->add_grp_content($data);
                echo $this->session->userdata('grp_id');
            } else { echo 'error'; }
        } else {
            echo 'error';
        }
    }
    
    public function group_timeline() {
        $data['type'] = 'group';
        if($this->input->post('grp_id')) {
            $data['grp_posts'] = $this->dashboard_m->get_grp_timeline($this->input->post('grp_id'));
        }
        if($this->input->post('grp_id') && $this->input->post('last_id')) {
            $data['grp_posts'] = $this->dashboard_m->getmore_grp_timeline($this->input->post('grp_id'), $this->input->post('last_id'));
        }
        $this->load->view('dashboard/timeline-block', $data);
    }
    
    public function group_timeline_post_check($grp_id, $post_id) {
        if($this->dashboard_m->group_timeline_post_check($grp_id, $post_id) > 0 || $this->dashboard_m->check_user_group($grp_id) > 0) {
            echo '<div class="dropdown clearfix"> 
                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ion-android-more-vertical"></i></button> 
                    <ul class="dropdown-menu dropdown-menu-right"> 
                        <li><a data-toggle="modal" data-target="#delete_grp_post" onclick="set_delete_grp_post('.$grp_id.','.$post_id.')">Delete</a></li>
                    </ul> 
                  </div>';
        }
    }
    
    public function delete_group_timeline_post() {
        if($this->input->post('grp_id') && $this->input->post('post_id')) {
            if($this->dashboard_m->group_timeline_post_check($this->input->post('grp_id'), $this->input->post('post_id')) > 0 || $this->dashboard_m->check_user_group($this->input->post('grp_id')) > 0) {
                $this->dashboard_m->delete_group_timeline_post($this->input->post('post_id'));
                echo 'success';
            }
        }
    }
    
    public function check_accepted_grp($grp_id) {
        return $this->dashboard_m->check_accepted_grp($grp_id);
    }

    /* Like Dislike */
    public function add_like_dislike() {
        $user_id = '';
        if($this->input->post('type') == 'blog') {
            $this->dashboard_m->add_like($this->input->post('blog_id'), 'blog', 'blog');
            $user_id = $this->dashboard_m->get_user_single_blog($this->input->post('blog_id'))->main_user_id;
            $type_id = $this->input->post('blog_id');
            echo 'success';
        }
        if($this->input->post('type') == 'ad') {
            $this->dashboard_m->add_ad_like($this->input->post('ad_id'));
            $user_id = $this->dashboard_m->get_single_post($this->input->post('ad_id'))->main_user_id;
            $type_id = $this->input->post('ad_id');
            echo 'success';
        }
        if($this->input->post('type') == 'ad_dislike') {
            $this->dashboard_m->add_ad_dislike($this->input->post('ad_id'));
            $user_id = $this->dashboard_m->get_single_post($this->input->post('ad_id'))->main_user_id;
            $type_id = $this->input->post('ad_id');
            echo 'success';
        }
        if($this->input->post('type') == 'group') {
            $this->dashboard_m->add_like($this->input->post('group_id'), 'group', 'group_content');
            $user_id = '';
            echo 'success';
        }
        if($this->input->post('type') == 'thought' || $this->input->post('type') == 'location' || $this->input->post('type') == 'file' || $this->input->post('type') == 'image' || $this->input->post('type') == 'video' || $this->input->post('type') == 'action') {
            $this->dashboard_m->add_like($this->input->post('post_id'), $this->input->post('type'), 'timeline');
            $user_id = $this->dashboard_m->get_activity($this->input->post('post_id'))->post_user_id;
            $type_id = $this->input->post('post_id');
            echo 'success';
        }
        if($user_id != $this->session->userdata('user_id') && $user_id != '' && $this->input->post('type') != 'group') {
            $this->hook->add_notification_alert($user_id);
            $this->load->model('email_m');
            $this->email_m->like_email($this->dashboard_m->get_info($user_id)->email, $this->input->post('type'), $type_id);
            $name = ($this->info->type_id == 1) ? ucfirst(strtolower($this->info->firstname)) . ' ' . ucfirst(strtolower($this->info->lastname)) : ucfirst(strtolower($this->info->name));
            $type = ($this->input->post('type') == 'thought' || $this->input->post('type') == 'location' || $this->input->post('type') == 'file' || $this->input->post('type') == 'image' || $this->input->post('type') == 'video')? 'timeline' : $this->input->post('type');
            $msg = array (
                'body'  => "$name liked your $type post",
                'title' => 'You have got a like!'
            );
            $this->sendMessage($user_id, $msg);
        }
    }
    
    public function remove_like_dislike() {
        if($this->input->post('type') === 'blog') {
            $this->dashboard_m->remove_like($this->input->post('blog_id'), 'blog', 'blog');
            echo 'success';
        }
        if($this->input->post('type') === 'ad') {
            $this->dashboard_m->remove_like($this->input->post('ad_id'), 'ad', 'ads');
            echo 'success';
        }
        if($this->input->post('type') === 'ad_dislike') {
            $this->dashboard_m->remove_dislike($this->input->post('ad_id'));
            echo 'success';
        }
        if($this->input->post('type') === 'group') {
            $this->dashboard_m->remove_like($this->input->post('group_id'), 'group', 'group_content');
            echo 'success';
        }
        if($this->input->post('type') === 'thought' || $this->input->post('type') === 'location' || $this->input->post('type') === 'file' || $this->input->post('type') === 'image' || $this->input->post('type') === 'video' || $this->input->post('type') === 'action') {
            $this->dashboard_m->remove_like($this->input->post('post_id'), $this->input->post('type'), 'timeline');
            echo 'success';
        }
    }
    
    public function user_like_status($type_id, $type) {
        if($type === 'blog') {
            if($this->dashboard_m->user_like_status($type_id, 'blog') > 0) {
                echo 'data-status="1" class="blog_like liked trans"';
            } else {
                echo 'data-status="0" class="blog_like trans"';
            }
        }
        if($type === 'ad') {
            if($this->dashboard_m->user_like_status($type_id, 'ad') > 0) {
                echo 'data-status="1" class="post_like liked trans"';
            } else {
                echo 'data-status="0" class="post_like trans"';
            }
        }
        if($type === 'group') {
            if($this->dashboard_m->user_like_status($type_id, 'group') > 0) {
                echo 'data-status="1" class="group_like liked trans"';
            } else {
                echo 'data-status="0" class="group_like trans"';
            }
        }
        if($type === 'thought' || $type === 'location' || $type === 'file' || $type === 'image' || $type === 'video' || $type === 'action') {
            if($this->dashboard_m->user_like_status($type_id, $type) > 0) {
                echo 'data-status="1" class="trans post_like liked"';
            } else {
                echo 'data-status="0" class="trans post_like"';
            }
        }
    }
    
    public function user_dislike_status($type_id) {
        if($this->dashboard_m->user_dislike_status($type_id) > 0) {
            echo 'data-status="1" class="trans post_dislike disliked"';
        } else {
            echo 'data-status="0" class="trans post_dislike"';
        }
    }
    
    public function get_liked_users() {
        $data['type'] = '3';
            $conn = $this->dashboard_m->get_liked_users($this->input->post('id'), $this->input->post('type'));
            if(count($conn) > 0) {
                foreach ($conn as $con) {
                    $data['user'] = $this->dashboard_m->get_connection_info($con->user_id);
                    $this->load->view('dashboard/like-dislike-block', $data);
                }
        }
    }
    
    public function get_disliked_users() {
        $data['type'] = '3';
            $conn = $this->dashboard_m->get_disliked_users($this->input->post('id'), $this->input->post('type'));
            if(count($conn) > 0) {
                foreach ($conn as $con) {
                    $data['user'] = $this->dashboard_m->get_connection_info($con->user_id);
                    $this->load->view('dashboard/like-dislike-block', $data);
                }
        }
    }
    
    public function user_like_comment_status($comment_id) {
        if($this->dashboard_m->user_like_comment_status($comment_id) > 0) {
            echo 'data-status="1" class="trans comment_like liked"';
        } else {
            echo 'data-status="0" class="trans comment_like"';
        }
    }
    
    public function add_comment_like() {
        $user_id = '';
        if($this->input->post('comment_id')) {
            $this->dashboard_m->add_like($this->input->post('comment_id'), 'comment', 'comments');
            $user_id = $this->dashboard_m->get_comment_row($this->input->post('comment_id'))->user_id;
            echo 'success';
        }
        if($user_id != $this->session->userdata('user_id') && $user_id != '') {
            $this->hook->add_notification_alert($user_id);
            $this->load->model('email_m');
            $href = $this->hook->get_comment_href($this->input->post('comment_id'));
            $this->email_m->comment_like($this->dashboard_m->get_info($user_id)->email, $href);
            $name = ($this->info->type_id == 1) ? ucfirst(strtolower($this->info->firstname)) . ' ' . ucfirst(strtolower($this->info->lastname)) : ucfirst(strtolower($this->info->name));
            $msg = array (
                'body'  => "$name liked your comment.",
                'title' => 'You have got a like!'
            );
            $this->sendMessage($user_id, $msg);
        }
    }
    
    public function remove_comment_like() {
        if($this->input->post('comment_id')) {
            $this->dashboard_m->remove_like($this->input->post('comment_id'), 'comment', 'comments');
            echo 'success';
        }
    }

    /* Comment */
    public function add_comment() {
        if($this->input->post('type') && $this->input->post('type_id')) {
            $this->dashboard_m->add_comment($this->input->post('type_id'), $this->input->post('type'), $this->input->post('comment'));
            $user_id = $this->dashboard_m->get_comment_user_id($this->input->post('type_id'), $this->input->post('type'));
            if($user_id != $this->session->userdata('user_id') && $user_id != '' && $this->input->post('type') != 'group') {
                $this->hook->add_notification_alert($user_id);
                $this->load->model('email_m');
                $this->email_m->comment_email($this->dashboard_m->get_info($user_id)->email, $this->input->post('type'), $this->input->post('type_id'));
                $name = ($this->info->type_id == 1) ? ucfirst(strtolower($this->info->firstname)) . ' ' . ucfirst(strtolower($this->info->lastname)) : ucfirst(strtolower($this->info->name));
                $type = ($this->input->post('type') == 'thought' || $this->input->post('type') == 'location' || $this->input->post('type') == 'file' || $this->input->post('type') == 'image' || $this->input->post('type') == 'video')? 'timeline' : $this->input->post('type');
                $msg = array (
                    'body'  => "$name commented on your $type post",
                    'title' => 'You have got a comment!'
                );
                $this->sendMessage($user_id, $msg);
            }
            echo 'success';
        }
    }
    
    public function add_child_comment() {
        if($this->input->post('parent_comment_id')) {
            $this->dashboard_m->add_child_comment($this->input->post('parent_comment_id'), $this->input->post('comment'));
            $user_id = $this->dashboard_m->get_child_comment_user_id($this->input->post('parent_comment_id'));
            if($user_id != $this->session->userdata('user_id') && $user_id != '' && $this->input->post('type') != 'group') {
                $this->hook->add_notification_alert($user_id);
            }
            echo 'success';
        }
    }
    
    public function delete_comment() {
        if($this->input->post('comment_id')) {
            $this->dashboard_m->delete_comment($this->input->post('comment_id'));
            echo 'success';
        }
    }
    
    public function load_comment() {
        $data['comment_type'] = '';
        if($this->input->post('type')) {
            $data['type_id'] = $this->input->post('type_id');
            $data['comments'] = $this->dashboard_m->get_comment($this->input->post('type_id'), $this->input->post('type'));
        }
        if($this->input->post('parent_id') != '') {
            $data['comment_type'] = 'child';
            $data['comments'] = $this->dashboard_m->get_child_comment($this->input->post('parent_id'));
        }
        $this->load->view('dashboard/comment', $data);
    }

    public function check_user_comment($comment_id, $type_id) {
        if($this->dashboard_m->check_user_comment($comment_id)) {
                echo ($type_id != '')? "<div class='delete_comment trans'><a onclick='delete_comment($comment_id, $type_id)'><i class='ion-close-round'></i></a></div>" : "<div class='delete_comment trans'><a onclick='delete_comment($comment_id, -1692)'><i class='ion-close-round'></i></a></div>" ;
        }
    }
    
    public function comment_replies($comment_id) {
        if($this->dashboard_m->get_comment_replies($comment_id) > 0) {
                echo "<a class='trans' onclick='load_child_comment($comment_id)'><i class='ion-ios-chatboxes'></i> Replies</a>"; 
        }
    }
    
    public function comment_count($type_id, $type) {
        echo $this->dashboard_m->get_comment_count($type_id, $type);
    }
    
    public function get_comment_href($id) {
        $type = $this->dashboard_m->get_comment_row($id)->type;
        $type_id = $this->dashboard_m->get_comment_row($id)->type_id;
        if($type == 'group') {
            return base_url('dashboard/group_activities/' . $type_id . '/' . $id);
        } else if($type == 'blog') {
            return base_url('dashboard/blog/' . $type_id . '/' . $id);
        } else if($type == 'ad') {
            return base_url('dashboard/sos/' . $type_id . '/' . $id);
        } else {
            return base_url('dashboard/recent_activities/' . $type_id . '/' . $id);
        }
    }
    
    /* Timeline */
    public function download($file = '', $type = '') {
        $this->load->helper('download');
        if($type == 'group') {
            force_download('./assets/userdata/dashboard/group/content/'.$file, NULL);
        }
        if($type == 'user') {
            force_download('./assets/userdata/dashboard/timeline/'.$file, NULL);
        }
    }
    
    public function timeline_submit() {
        if($this->input->post('submit_type') === 'timeline_photo') {
            $this->form_validation->set_rules('privacy', 'Privacy', 'required');
            if ($this->form_validation->run() == TRUE) {
                if(count($_FILES) !== 0) {
                    $tags = ($this->input->post('tags') != '') ? implode(',', $this->input->post('tags')) : '';
                    $this->load->library('upload');
                    $config['upload_path'] = './assets/userdata/dashboard/timeline/';
                    for($i = 0; $i < count($_FILES); $i++) {
                        $tmp3 = explode('.', $_FILES['file'.$i]['name']);
                        $ext3 = end($tmp3);
                        $file = date("ymd") . (time()+$i) . '.' . strtolower($ext3) ;
                        $config['file_name'] = $file;
                        $config['allowed_types'] = 'jpg|png|jpeg';
                        $this->upload->initialize($config);
                        if($this->upload->do_upload('file'.$i)){ $tmp_ary[] = $file; }
                    }
                    $file_str = implode(',', $tmp_ary);
                    foreach ($tmp_ary as $arr) {
                        $this->image_resize($arr, 'photo');
                    }
                    $data = array('privacy' => $this->input->post('privacy'), 'user_id' => $this->session->userdata('user_id'), 'content_type' => 'image', 'title' => $this->input->post('title'), 'description' => $this->input->post('desc'), 'tags' => $tags, 'file' => $file_str, 'time' => time(), 'date' => date('d M Y'));
                    ($file_str != '') ? $this->dashboard_m->add_timeline_content($data) : '';
                    echo 'success';
                } else { echo 'error'; }
            } else { echo 'error'; }
        } elseif($this->input->post('submit_type') === 'timeline_video') {
            $this->form_validation->set_rules('privacy', 'Privacy', 'required');
            if ($this->form_validation->run() == TRUE) {
                $this->load->library('upload');
                $tags = ($this->input->post('tags') != '') ? implode(',', $this->input->post('tags')) : '';
                if (isset($_FILES['file']['name'])) {
                    $config['upload_path'] = './assets/userdata/dashboard/timeline/';
                    $tmp3 = explode('.', $_FILES['file']['name']);
                    $ext3 = end($tmp3);
                    $file = date("ymd") . time() . '.' . strtolower($ext3) ;
                    $config['file_name'] = $file;
                    $config['allowed_types'] = 'mp4';
                    $this->upload->initialize($config);
                    $data = array('privacy' => $this->input->post('privacy'), 'user_id' => $this->session->userdata('user_id'), 'content_type' => 'video', 'title' => $this->input->post('title'), 'description' => $this->input->post('desc'), 'tags' => $tags, 'file' => $file, 'time' => time(), 'date' => date('d M Y'));
                    ($this->upload->do_upload('file')) ? $this->dashboard_m->add_timeline_content($data) : '';
                    echo 'success';
                } else { echo 'error'; }
            } else { echo 'error'; }
        } elseif($this->input->post('submit_type') === 'timeline_file') {
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $this->form_validation->set_rules('privacy', 'Privacy', 'required');
            if ($this->form_validation->run() == TRUE) {
                $this->load->library('upload');
                $tags = ($this->input->post('tags') != '') ? implode(',', $this->input->post('tags')) : '';
                if (isset($_FILES['file']['name'])) {
                    $config['upload_path'] = './assets/userdata/dashboard/timeline/';
                    $tmp3 = explode('.', $_FILES['file']['name']);
                    $ext3 = end($tmp3);
                    $file = date("ymd") . time() . '.' . strtolower($ext3) ;
                    $config['file_name'] = $file;
                    $config['allowed_types'] = 'pdf|txt|doc|docx|xlsx|xls|csv|ppt|pptx';
                    $this->upload->initialize($config);
                    $data = array('privacy' => $this->input->post('privacy'), 'user_id' => $this->session->userdata('user_id'), 'content_type' => 'file', 'title' => $this->input->post('title'), 'description' => $this->input->post('desc'), 'tags' => $tags, 'file' => $file, 'time' => time(), 'date' => date('d M Y'));
                    ($this->upload->do_upload('file')) ? $this->dashboard_m->add_timeline_content($data) : '';
                    echo 'success';
                } else { echo 'error'; }
            } else { echo 'error'; }
        } elseif($this->input->post('submit_type') === 'timeline_location') {
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $this->form_validation->set_rules('privacy', 'Privacy', 'required');
            $this->form_validation->set_rules('cordinates', 'Cordinates', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $tags = ($this->input->post('tags') != '') ? implode(',', $this->input->post('tags')) : '';
                $data = array('privacy' => $this->input->post('privacy'), 'user_id' => $this->session->userdata('user_id'), 'content_type' => 'location', 'title' => $this->input->post('title'), 'description' => $this->input->post('desc'), 'tags' => $tags, 'map' => $this->input->post('cordinates'), 'time' => time(), 'date' => date('d M Y'));
                $this->dashboard_m->add_timeline_content($data);
                echo 'success';
            } else { echo 'error'; }
        } elseif($this->input->post('submit_type') === 'timeline_thought') {
            $this->form_validation->set_rules('message', 'Message', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $data = array('user_id' => $this->session->userdata('user_id'), 'content_type' => 'thought', 'description' => $this->input->post('message'), 'time' => time(), 'date' => date('d M Y'));
                $this->dashboard_m->add_timeline_content($data);
                echo 'success';
            } else { echo 'error'; }
        } else {
            echo 'error';
        }
    }
    
    public function user_timeline_post_check($post_id, $type) {
        if($this->dashboard_m->user_timeline_post_check($post_id) > 0) {
            echo '<div class="dropdown clearfix"> 
                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ion-android-more-vertical"></i></button> 
                    <ul class="dropdown-menu dropdown-menu-right"> 
                        <li><a data-toggle="modal" data-target="#delete_timeline_post" onclick="set_delete_timeline_post('.$post_id.')">Delete</a></li>
                        <li><a data-toggle="modal" data-target="#timeline_privacy" onclick="get_timeline_post_privacy('.$post_id.')">Privacy</a></li>    
                    </ul> 
                  </div>';
        }
    }
    
    public function timeline_privacy() {
        if($this->input->post('post_id')) {
            echo $this->dashboard_m->get_timeline_privacy($this->input->post('post_id'));
        }
        if($this->input->post('privacy_post_id')) {
            $this->dashboard_m->update_timeline_privacy($this->input->post('privacy'), $this->input->post('privacy_post_id'));
            echo 'success';
        }
    }

    public function delete_user_timeline_post() {
        if($this->input->post('post_id')) {
            if($this->dashboard_m->user_timeline_post_check($this->input->post('post_id')) > 0) {
                $this->dashboard_m->delete_user_timeline_post($this->input->post('post_id'));
                echo 'success';
            }
        }
    }
    
    public function timeline_blog($id) {
        $blog = $this->dashboard_m->get_user_single_blog($id);
        $comments = $this->dashboard_m->get_comment_count($id, 'blog');
        $likes = ($blog->likes != 0)? ($blog->likes > 1)? $blog->likes.' Likes' : $blog->likes.' Like' : '';
        $cmment = ($comments != 0)? ($comments > 1)? $comments.' Comments' : $comments.' Comment' : '';
        $media = '';
        if($blog->file != '') {
            $file = explode('.', $blog->file); 
            $file_type = end($file);
            $media = ($file_type == 'mp4')? "<video src='".base_url('assets/userdata/dashboard/blog/' . $blog->file)."'></video>" : "<img class='shadow' src='".base_url('assets/userdata/dashboard/blog/' . $blog->file)."' alt='$blog->title' title='<?= $blog->title' />";
        }
        $meta = ($likes != 0 || $cmment != 0)? "<p class='gray'><strong>$likes &nbsp;&nbsp;&nbsp;&nbsp; $cmment</strong></p>" : '';
        echo "<div class='timeline_blog'>
                $media
                <a href='".base_url('dashboard/blog/' . $blog->id)."' class='outer'>    
                    <h4>".ucfirst($blog->title)."</h4>
                    ".substr($blog->content, 0, 200)."
                    $meta    
                </a>    
              </div>";
    }
    
    public function timeline_post($id) {
        $post = $this->dashboard_m->get_single_post($id);
        $comments = $this->dashboard_m->get_comment_count($id, 'ad');
        $media = '';
        $likes = ($post->likes != 0)? ($post->likes > 1)? $post->likes.' Likes' : $post->likes.' Like' : '';
        $cmment = ($comments != 0)? ($comments > 1)? $comments.' Comments' : $comments.' Comment' : '';
        if($post->img != '') {
            $img_arr = explode(',', $post->img);
            if(count($img_arr) > 1) {
                $media_center = '';
                $media_left = "<div id='ad_post_carousel_$post->main_id' class='carousel slide carousel-fade' data-ride='carousel'>
                               <div class='carousel-inner' role='listbox'>";
                $count = 0; foreach ($img_arr as $arr) :
                $media_center.= "<div class='item ".(($count === 0)? 'active' : '')."'>
                                 <a title='$post->title' class='fancybox' rel='group' href='".base_url("assets/userdata/dashboard/ads/".$arr)."'>
                                 <img class='shadow' src='".base_url("assets/userdata/dashboard/ads/".$arr)."' alt='".(($post->title != '')? $post->title : '')."'/>
                                 </a>
                                 </div>";
                $count++; endforeach;
                $media_right = "</div>
                                <a class='left carousel-control' href='#ad_post_carousel_$post->main_id' role='button' data-slide='prev'><i class='ion-chevron-left'></i></a>
                                <a class='right carousel-control' href='#ad_post_carousel_$post->main_id' role='button' data-slide='next'><i class='ion-chevron-right'></i></a>
                                </div>";
                $media = $media_left.$media_center.$media_right;
            } else {
                $media = "<img class='shadow' src='".base_url("assets/userdata/dashboard/ads/".$img_arr[0])."' alt='$post->title' />";
            }
        }
        if($post->video != '' && $post->img == '') {
            $media = "<video src='".base_url('assets/userdata/dashboard/ads/' . $post->video)."'></video>";
        }
        $meta = ($likes != 0 || $cmment != 0)? "<p class='gray'><strong>$likes &nbsp;&nbsp;&nbsp;&nbsp; $cmment</strong></p>" : '';
        echo "<div class='timeline_blog ad'>
                $media
                <a href='".base_url('dashboard/sos/' . $post->main_id)."' class='outer'>
                    <h4>".ucfirst($post->title)."</h4>
                    <p>".substr($post->description, 0, 200)."...</p>
                    $meta    
                </a>        
              </div>";
    }
    
    public function timeline_action($id) {
        $action_data = $this->dashboard_m->get_user_action($id);
        $post_data = $this->dashboard_m->get_single_post($action_data->ad_id);
        echo "<a href='".base_url('dashboard/sos/'.$action_data->ad_id)."'><div class='action_block'>
                <div class='col_right'>
                    <h5>".ucfirst($post_data->title)."</h5>
                    ".substr($post_data->description, 0, 200)."...Read More
                </div>
              </div></a>";
    }
    
    /* News Feed */
    public function load_news_feed($load = '') {
        $data['type'] = 'index';
        if($load == 'home') {
            $this->session->set_userdata('adv_count', '');
            $data['timeline_posts'] = $this->dashboard_m->get_user_newsfeed();
            return $this->load->view('dashboard/timeline-block', $data, true);
        } else {
            if($this->input->post('last_id')) {
                if($this->session->userdata('adv_count') == '') { $this->session->set_userdata('adv_count', 1); }
                $data['timeline_posts'] = $this->dashboard_m->getmore_user_newsfeed($this->input->post('last_id'));
            } else {
                $this->session->set_userdata('adv_count', '');
                $data['timeline_posts'] = $this->dashboard_m->get_user_newsfeed();
            }
            $arr['feed'] = $this->load->view('dashboard/timeline-block', $data, true);
            echo json_encode($arr);
        }
    }
    
    /* Trending Feed */
    public function load_trending_feed($load = '') {
        $data['type'] = 'index';
        if($load == 'home') {
            $this->session->set_userdata('adv_count', '');
            $data['timeline_posts'] = $this->dashboard_m->get_trending_feed();
            return $this->load->view('dashboard/timeline-block', $data, true);
        } else {
            if($this->input->post('last_id')) {
                if($this->session->userdata('adv_count') == '') { $this->session->set_userdata('adv_count', 1); }
                $data['timeline_posts'] = $this->dashboard_m->getmore_trending_feed($this->input->post('last_id'));
            } else {
                $this->session->set_userdata('adv_count', '');
                $data['timeline_posts'] = $this->dashboard_m->get_trending_feed();
            }
            $arr['feed'] = $this->load->view('dashboard/timeline-block', $data, true);
            echo json_encode($arr);
        }
    }
    
    /* Recent Activities */
    public function recent_activities($id, $comment = '') {
        if($id != '' && $this->dashboard_m->check_activity_view($id)) {
            $data['css'] = array('mediaelementplayer.min.css');
            $data['js'] = array('mediaelement-and-player.min.js');
            $data['url_js'] = array('https://maps.googleapis.com/maps/api/js?key=AIzaSyCP45GqZNtN3dIjgosrYcdtDpUQZUNdf3Q');
            $data['post'] = $this->dashboard_m->get_activity($id);
            if($comment != '') {
                $cmt = $this->dashboard_m->get_comment_row($comment);
                if($cmt->is_child == 1) {
                    if($data['post']->content_type === 'location') {
                        $data['customJs'] = "load_comment_highlight('".$data['post']->content_type."', $id, $comment); Map(); load_child_comment_highlight($cmt->parent_id, $comment);";
                    } else {
                        $data['customJs'] = "load_comment_highlight('".$data['post']->content_type."', $id, $comment); load_child_comment_highlight($cmt->parent_id, $comment);";
                    } 
                } else {
                    if($data['post']->content_type === 'location') {
                        $data['customJs'] = "load_comment_highlight('".$data['post']->content_type."', $id, $comment); Map();";
                    } else {
                        $data['customJs'] = "load_comment_highlight('".$data['post']->content_type."', $id, $comment);";
                    }
                } 
            } else {
                if($data['post']->content_type === 'location') {
                    $data['customJs'] = "load_comment('".$data['post']->content_type."', $id); Map();";
                } else {
                    $data['customJs'] = "load_comment('".$data['post']->content_type."', $id);";
                }
            }
            $data['view'] = 'dashboard/recentact';
            $this->renderPage($data, 'dashboard');
        } else {
            redirect(base_url('dashboard'));
        }
    }
    
    public function group_activities($id, $comment = '') {
        if($id != '' && $this->dashboard_m->check_grp_activity_view($id) && $this->info->user_level != 0) {
            $data['css'] = array('mediaelementplayer.min.css');
            $data['js'] = array('mediaelement-and-player.min.js');
            $data['url_js'] = array('https://maps.googleapis.com/maps/api/js?key=AIzaSyCP45GqZNtN3dIjgosrYcdtDpUQZUNdf3Q'); 
            $data['post'] = $this->dashboard_m->get_grp_activity($id);
            if($comment != '') {
                $cmt = $this->dashboard_m->get_comment_row($comment);
                if($cmt->is_child == 1) {
                    if($data['post']->content_type === 'location') {
                        $data['customJs'] = "load_comment_highlight('group', $id, $comment); Map(); load_child_comment_highlight($cmt->parent_id, $comment);";
                    } else {
                        $data['customJs'] = "load_comment_highlight('group', $id, $comment); load_child_comment_highlight($cmt->parent_id, $comment);";
                    } 
                } else {
                    if($data['post']->content_type === 'location') {
                        $data['customJs'] = "load_comment_highlight('group', $id, $comment); Map();";
                    } else {
                        $data['customJs'] = "load_comment_highlight('group', $id, $comment);";
                    }
                } 
            } else {
                if($data['post']->content_type === 'location') {
                    $data['customJs'] = "load_comment('group', $id); Map();";
                } else {
                    $data['customJs'] = "load_comment('group', $id);";
                }
            }
            $data['view'] = 'dashboard/recent_grp_act';
            $this->renderPage($data, 'dashboard');
        } else {
            redirect(base_url('dashboard'));
        }
    }
    
    
    public function latest_activities() {
        if($this->session->userdata('user_id') == null) {
            echo 'session_expired';
            exit();
        }
        if($this->input->post('first_id')) {
            $data['recent_act'] = $this->dashboard_m->latest_recent_activities($this->input->post('first_id'));
        }
        if($this->input->post('fetch_all') == 'yes') {
            $data['recent_act'] = $this->dashboard_m->recent_activities();
        }
        $this->load->view('dashboard/recentact-block', $data);
    }
    
    public function activity_title($id, $type) {
        if($type == 'blog') {
            $post = $this->dashboard_m->get_curr_user_single_blog($id);
            echo "<small class='head text-muted'>Title: $post->title</small>";
        } elseif($type == 'ad') {
            $post = $this->dashboard_m->get_single_post($id);
            echo "<small class='head text-muted'>Title: $post->title</small>";
        } elseif($type == 'group') {
            $post = $this->dashboard_m->get_grp_activity($id);
            if($post->title != '') {
                echo "<small class='head text-muted'>Title: $post->title</small>";
            }
        } else {
            $post = $this->dashboard_m->get_activity($id);
            if($post->content_type != 'thought' && $post->title != '') {
                echo "<small class='head text-muted'>Title: $post->title</small>";
            }
        }
    }
    
    public function activity_privacy($id, $type) {
        if($type == 'blog') {
            $post = $this->dashboard_m->get_curr_user_single_blog($id);
            if($post->privacy == 1) {
                echo '<i class="ion-person privacy" data-toggle="tooltip" data-placement="bottom" title="Connection"></i>';
            }
            if($post->privacy == 2) {
                echo '<i class="ion-locked privacy" data-toggle="tooltip" data-placement="bottom" title="Locked"></i>';
            } 
        }
        if ($type != 'ad' && $type != 'blog' && $type != 'group') {
            $post = $this->dashboard_m->get_activity($id);
            if($post->privacy == 1) {
                echo '<i class="ion-person privacy" data-toggle="tooltip" data-placement="bottom" title="Connection"></i>';
            }
            if($post->privacy == 2) {
                echo '<i class="ion-locked privacy" data-toggle="tooltip" data-placement="bottom" title="Locked"></i>';
            }
        }
    }
    
    /* Profile Update */
    public function profile_update($step = '') {
        $data['js'] = array('moment.js', 'daterangepicker.js', 'moment-timezone-with-data.js', 'tzdetect.js', 'clipboard.min.js');
        if($step == 4) { $data['customJs'] = "load_connection('blocked');"; }
        $data['type_name'] = $this->dashboard_m->get_type_name($this->session->userdata('user_type'));
        $data['cat_main'] = $this->dashboard_m->get_category();
        $data['user_cat'] = $this->dashboard_m->get_user_category($this->session->userdata('user_id'));
        $data['info'] = $this->dashboard_m->get_info($this->session->userdata('user_id'));
        $data['privacy'] = $this->dashboard_m->get_privacy($this->session->userdata('user_id'));
        $data['countries'] = $this->dashboard_m->get_country_list();
        $data['referral_status'] = $this->dashboard_m->get_referral_status($this->session->userdata('user_id'));
        $data['free_mems'] = $this->dashboard_m->get_invited_freemems();
        $data['pre_mems'] = $this->dashboard_m->get_invited_premems();
        $data['step'] = $step;
        $data['view'] = 'dashboard/update-info';
        $this->renderPage($data, 'dashboard');
    }

    public function profile_settings_update() {
        $this->load->model('email_m');
        if($this->input->post('pass') && $this->input->post('re_pass')) {
            $salt = $this->dashboard_m->get_salt();
            $salted_pwd =  $this->input->post('pass') . $salt;
            $hashed_pwd = hash('sha256', $salted_pwd);
            $cond = $this->dashboard_m->validate_password($hashed_pwd);
            if($cond > 0) {
                $salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM)).time();
                $salted_pwd = $this->input->post('re_pass') . $salt;
                $hashed_pwd = hash('sha256', $salted_pwd);
                $this->dashboard_m->update_password($salt, $hashed_pwd);
                $this->email_m->profile_password_reset($this->info->email);
                $this->session->sess_destroy();
                echo 'success';
            } else {
                echo 'error';
            }
        }
        if($this->input->post('email')) {
            $cond = $this->dashboard_m->validate_email($this->input->post('email'));
            if($cond > 0) {
                echo 'error';
            } else {
                $salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM)).time();
                $key = sha1(time() . $salt);
                $this->dashboard_m->update_email($this->input->post('email'), $key);
                $this->email_m->profile_email_update($this->input->post('email'), $key);
                $this->session->sess_destroy();
                echo 'success';
            }
        }
        if($this->input->post('type')) {
            $this->dashboard_m->update_privacy($this->input->post('type'), $this->input->post('value'));
            if($this->input->post('type') == 'jobportal') {
                $this->session->set_flashdata('msg', '<div id="form_alert_success" class="alert alert-success" role="alert">Privacy for job portal successfully updated.</div>');
            }
            echo 'success';
        }
    }
    
    /* Related Connections & Groups */
    public function related($type = '') {
        if($type == 'conn' && $this->info->type_id == 1) {
            $data['groups'] = array();
            $data['users'] = $this->dashboard_m->get_all_near_connection(); 
        } else {
            $data['groups'] = array();
            $data['users'] = array();
        }
        if($type == 'group') {
            $data['users'] = array();
            $data['groups'] = $this->dashboard_m->get_all_near_groups(); 
        }
        if($type == 'conn' || $type == 'group') {
            $data['view'] = 'dashboard/related';
            $this->renderPage($data, 'dashboard');
        } else {
            redirect(base_url('dashboard'));
        }
    }
    
    /* Connection Request */
    public function requests() {
        $data['users'] = $this->dashboard_m->get_all_new_connection();
        $data['accepted_conn'] = $this->dashboard_m->get_all_accepted_connection();
        $data['view'] = 'dashboard/requests';
        $this->renderPage($data, 'dashboard');
    }
    
    /* Connection Request */
    public function sent_requests() {
        $data['sent_conn'] = $this->dashboard_m->get_all_sent_connection();
        $data['view'] = 'dashboard/sent-requests';
        $this->renderPage($data, 'dashboard');
    }
    
    /* Notifications */
    public function notifications() {
        $data['notifications'] = $this->dashboard_m->recent_notifications();
        $data['grp_member'] = $this->dashboard_m->get_all_new_group_members();
        $data['accepted_grp'] = $this->dashboard_m->get_all_accepted_groups();
        $data['invited_grp'] = $this->dashboard_m->get_all_invited_groups();
        $data['comment_likes'] = $this->dashboard_m->get_all_comment_likes();
        $data['view'] = 'dashboard/notifications';
        $this->renderPage($data, 'dashboard');
    }
    
    public function user_notifications() {
        $data['user_activities'] = $this->dashboard_m->user_activities($this->session->userdata('user_id'));
        $data['view'] = 'dashboard/notifications-user';
        $this->renderPage($data, 'dashboard');
    }
    
    public function load_notifications() {
        $data['type_not'] = 'load';
        $data['notifications'] = $this->dashboard_m->recent_notifications();
        $data['grp_member'] = $this->dashboard_m->get_all_new_group_members();
        $data['accepted_grp'] = $this->dashboard_m->get_all_accepted_groups();
        $data['invited_grp'] = $this->dashboard_m->get_all_invited_groups();
        $data['comment_likes'] = $this->dashboard_m->get_all_comment_likes();
        return $data;
    }
    
    public function new_notifications() {
        if($this->session->userdata('user_id') == null) {
            echo 'session_expired';
            exit();
        }
        $data['type_not'] = 'new';
        $data['notifications'] = ($this->input->post('other_id') == 'all')? $this->dashboard_m->recent_notifications() : $this->dashboard_m->latest_recent_notifications($this->input->post('other_id'));
        $data['grp_member'] = ($this->input->post('grp_id') == 'all')? $this->dashboard_m->get_all_new_group_members() : $this->dashboard_m->get_latest_all_new_group_members($this->input->post('grp_id'));     
        $data['accepted_grp'] = ($this->input->post('acc_grp_id') == 'all')? $this->dashboard_m->get_all_accepted_groups() : $this->dashboard_m->get_latest_all_accepted_group_members($this->input->post('acc_grp_id'));
        $data['invited_grp'] = ($this->input->post('inv_grp_id') == 'all')? $this->dashboard_m->get_all_invited_groups() : $this->dashboard_m->get_latest_all_invited_group_members($this->input->post('inv_grp_id'));
        $data['comment_likes'] = ($this->input->post('cmt_like_id') == 'all')? $this->dashboard_m->get_all_comment_likes() : $this->dashboard_m->get_latest_all_comment_likes($this->input->post('cmt_like_id'));
        $this->load->view('dashboard/notification-block', $data);
    }
    
    public function conn_req_notifications() {
        $data['type_req_not'] = 'load';
        $data['new_conn'] = $this->dashboard_m->get_all_new_connection();
        $data['accepted_conn'] = $this->dashboard_m->get_all_accepted_connection();
        return $data;
    }
    
    public function new_conn_req_notifications() {
        if($this->session->userdata('user_id') == null) {
            echo 'session_expired';
            exit();
        }
        $data['type_req_not'] = 'new';
        $data['new_conn'] = ($this->input->post('conn_id') == 'all')? $this->dashboard_m->get_all_new_connection() : $this->dashboard_m->get_latest_all_new_connection($this->input->post('conn_id'));
        $data['accepted_conn'] = ($this->input->post('acc_conn_id') == 'all')? $this->dashboard_m->get_all_accepted_connection() : $this->dashboard_m->get_latest_all_accepted_connection($this->input->post('acc_conn_id'));
        $this->load->view('dashboard/request-block', $data);
    }
    
    public function add_notification_alert($id) {
        $this->dashboard_m->add_notification_alert($id);
    }
    
    public function check_notification_alert() {
        return $this->dashboard_m->check_notification_alert();
    }
    
    public function remove_notification_alert() {
        $this->dashboard_m->remove_notification_alert();
        echo 'success';
    }
    
    public function add_req_notification_alert($id) {
        $this->dashboard_m->add_req_notification_alert($id);
    }
    
    public function check_req_notification_alert() {
        return $this->dashboard_m->check_req_notification_alert();
    }
    
    public function remove_req_notification_alert() {
        $this->dashboard_m->remove_req_notification_alert();
        echo 'success';
    }
    
    public function check_user_notification($type, $type_id) {
        $user_id = $this->dashboard_m->get_comment_user_id($type_id, $type);
        if($user_id == $this->session->userdata('user_id')) {
            return true;
        }
    }
    
    public function check_comment_notification($id) {
        return $this->dashboard_m->check_parent_comment($id);
    }

    /* Posts */
    public function worthact_initiatives($open = '') {
        $cat_array = array(1, 2, 3, 4, 5, 6, 7, 9, 10, 11);
        if(in_array($open, $cat_array)) { $data['customJs'] = "load_wi($open)"; }
        if($open == '' || $open == 'create') { $data['customJs'] = "$('.listing .nav-tabs-solid .actions').hide();"; }
        $data['css'] = array('sweetalert2.css', 'mediaelementplayer.min.css');
        $data['js'] = array('es6-promise.auto.min.js', 'sweetalert2.js', 'mediaelement-and-player.min.js');
        $data['allcat'] = $this->dashboard_m->get_category();
        $data['open'] = $open;
        $data['countries'] = $this->dashboard_m->get_country_list();
        $data['supports'] = $this->dashboard_m->get_support_list();
        $data['view'] = 'dashboard/posts';
        $this->renderPage($data, 'dashboard');
    }
    
    public function load_post() {
        if($this->input->post('last_id')) {
            if($this->session->userdata('adv_count') == '') { $this->session->set_userdata('adv_count', 1); }
            $data['ads'] = $this->dashboard_m->get_more_listing($this->input->post('last_id'), $this->input->post('cat_id'), $this->input->post('country'));
        } else {
            $this->session->set_userdata('adv_count', '');
            $data['ads'] = $this->dashboard_m->get_listing($this->input->post('cat_id'), $this->input->post('country'));
        }
        $this->load->view('dashboard/post-block', $data);
    }
    
    public function load_post_related_users() {
        if($this->input->post('cat_id')) {
            $data['type'] = '3';
            $conn = $this->dashboard_m->get_post_related_user($this->input->post('cat_id'));
            if(count($conn) > 0) {
                foreach ($conn as $con) {
                    $data['user'] = $this->dashboard_m->get_connection_info($con->user_id);
                    $this->load->view('dashboard/connection-block', $data);
                }
            }
        }
    }
    
    public function load_post_related_data() {
        if($this->input->post('cat_id')) {
            $page = array('boo', 'afforestation', 'animal-care', 'cancer-care', 'drought-resistance', 'eco-friendly', 'organ-donation', 'water-bodies', 'pollution', 'rural-development', 'waste', 'women');
            for($i = 0; $i < 12; $i++) {
                if($this->input->post('cat_id') == $i) {
                    $data['type'] = 'facts';
                    $arr['facts'] = $this->load->view('dashboard/sr/'.$page[$i], $data, true);
                    $data['type'] = 'poss';
                    $arr['poss'] = $this->load->view('dashboard/sr/'.$page[$i], $data, true);
                }
            }
            echo json_encode($arr);
        }
    }

    public function user_post_check($post_id) {
        if($this->dashboard_m->user_post_check($post_id) > 0) {
            echo '<div class="dropdown clearfix"> 
                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ion-android-more-vertical"></i></button> 
                    <ul class="dropdown-menu dropdown-menu-right"> 
                        <li><a data-toggle="modal" onclick="update_post('.$post_id.')">Edit</a></li>
                        <li><a data-toggle="modal" data-target="#post_delete" onclick="set_delete_post('.$post_id.')">Delete</a></li>
                    </ul> 
                  </div>';
        }
    }
    
    public function post_actions($actions = '', $post_id = '') {
        if($this->input->post('action_id') != '') {
            $action_id = $this->dashboard_m->add_post_action($this->input->post('post_id'), $this->input->post('action_id'), $this->input->post('desc'));
            $ad = $this->dashboard_m->get_single_post($this->input->post('post_id'));
            $beneficiary_user = $this->dashboard_m->get_connection_info($ad->main_user_id);
            $user = $this->dashboard_m->get_connection_info($this->session->userdata('user_id'));
            $action = $this->dashboard_m->get_support_name($this->input->post('action_id'));
            $this->load->model('email_m');
            $description = ($this->input->post('desc') != '')? $this->input->post('desc') : '';
            $this->email_m->beneficiary_email($beneficiary_user->email, $ad, $user, $action, $description);
            $this->email_m->action_reply_email($user, $action, $ad, $beneficiary_user->email);
            if($action_id != '') {
                $data = array('user_id' => $this->session->userdata('user_id'), 'content_type' => 'action', 'action_id' => $action_id, 'time' => time(), 'date' => date('d M Y'));
                $this->dashboard_m->add_timeline_content($data);
            }
            echo 'success';
        }
        if($actions != '' && $post_id != '') {
            $action = explode(',', $actions);
            foreach($action as $act) : $row = $this->dashboard_m->get_support_name($act); 
            $title = '"'.$row->support_title.'"';
                echo "<li><a onclick='set_post_action($act, $post_id, $title)' class='actions'>$row->support_title</a></li>";            
            endforeach;
        }
        if($this->input->post('post_id') != '') {
            $post_id = $this->input->post('post_id');
            $user = $this->dashboard_m->get_connection_info($this->dashboard_m->get_single_post($post_id)->main_user_id);
            $action_desc = ($this->dashboard_m->get_single_post($post_id)->action_desc != '')? '"'.$this->dashboard_m->get_single_post($post_id)->action_desc.'"' : '';
            $username = ($user->type_id == 1)? '"'.ucfirst(strtolower($user->firstname)).' '.ucfirst(strtolower($user->lastname)).'"' : '"'.ucfirst(strtolower($user->name)).'"';
            $arr = array('username' => $username, 'act_desc' => $action_desc);    
            echo json_encode($arr);
        }
    }
    
    public function delete_post() {
        if($this->input->post('id')) {
            $this->dashboard_m->delete_post($this->input->post('id'));
            if($this->input->post('page_type') == 'single') {
                $this->session->set_flashdata('msg','<div class="alert alert-success alert-single">You have successfully deleted the post.</div>');
            }
            echo 'success';
        }
    }
    
    public function update_post() {
        if($this->input->post('id') != '') {
            $data['ad'] = $this->dashboard_m->get_curr_user_single_user_post($this->input->post('id'));
            if(isset($data['ad']->title)) {
                $data['allcat'] = $this->dashboard_m->get_category();
                $data['countries'] = $this->dashboard_m->get_country_list();
                $data['supports'] = $this->dashboard_m->get_support_list();
                $this->load->view('dashboard/modals/update-post', $data);
            }
        }
        
        if($this->input->post('post_update_id') != '') {
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $this->form_validation->set_rules('post_desc', 'Description', 'trim|required');
            $this->form_validation->set_rules('country', 'Country', 'trim|required');
            $this->form_validation->set_rules('interest', 'Interest', 'trim|required');
            $this->form_validation->set_rules('type', 'Type', 'trim|required');
            if($this->input->post('type') == 1) {
                $this->form_validation->set_rules('actions[]', 'Actions', 'trim|required');
                $this->form_validation->set_rules('phone', 'Phone', 'trim|required|numeric|min_length[10]');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
                $this->form_validation->set_rules('link', 'Website / Link', 'trim|valid_url');
                if(in_array('8', $this->input->post('actions'))) {
                    $this->form_validation->set_rules('action_desc', 'Action Description', 'trim|required');
                }
            }
            if ($this->form_validation->run() == TRUE) {
                $file_str = $vid_name = '';
                $this->load->library('upload');
                /* Image Upload */
                if (isset($_FILES['file0'])) {
                    if(count($_FILES) !== 0) {
                        for($i=0; $i<count($_FILES); $i++) {
                            if (isset($_FILES['file'.$i])) {
                                $config_img['upload_path'] = './assets/userdata/dashboard/ads/';
                                $config_img['allowed_types'] = 'jpg|png|jpeg';
                                $tmp1 = explode('.', $_FILES['file'.$i]['name']);
                                $ext1 = end($tmp1);
                                $img_name = date("ymd") . (time()+$i) . '.' . strtolower($ext1);
                                $config_img['file_name'] = $img_name;
                                $this->upload->initialize($config_img);
                                if($this->upload->do_upload('file'.$i)){ $tmp_ary[] = $img_name; }
                            }
                        }
                        $file_str = implode(',', $tmp_ary);
                        foreach ($tmp_ary as $arr) {
                            $this->image_resize($arr, 'post');
                        }
                        if(count($tmp_ary) > 0) {
                            $delete_file = $this->dashboard_m->get_curr_user_single_user_post($this->input->post('post_update_id'))->img;
                            if($delete_file != '') {
                                $img_arr = explode(',', $delete_file);
                                foreach($img_arr as $i) {
                                    unlink('assets/userdata/dashboard/ads/' . $i);
                                }
                            }
                        }
                    }
                }
                /* Video Upload */
                if (isset($_FILES['Video']['name'])) {
                    $config_vid['upload_path'] = './assets/userdata/dashboard/ads/';
                    $tmp2 = explode('.', $_FILES['Video']['name']);
                    $ext2 = end($tmp2);
                    $vid_name = date("ymd") . time() . '.' . strtolower($ext2);
                    $config_vid['file_name'] = $vid_name;
                    $config_vid['allowed_types'] = 'mp4';
                    $this->upload->initialize($config_vid);
                    if ($this->upload->do_upload('Video')) { 
                        $delete_file = $this->dashboard_m->get_curr_user_single_user_post($this->input->post('post_update_id'))->video;
                        if($delete_file != '') {
                            unlink('assets/userdata/dashboard/ads/' . $delete_file);
                        }
                    }
                }
                if($this->input->post('type') == 1) { $action_desc = (in_array('8', $this->input->post('actions')))? $this->input->post('action_desc') : ''; } else { $action_desc = ''; }
                $actions = ($this->input->post('type') == 1)? implode(',', $this->input->post('actions')) : '';
                $phone = ($this->input->post('type') == 1)? $this->input->post('phone') : '';
                $email = ($this->input->post('type') == 1)? $this->input->post('email') : '';
                $link = ($this->input->post('type') == 1)? $this->input->post('link') : '';
                $tags = ($this->input->post('tags') != '') ? implode(',', $this->input->post('tags')) : '';
                $ad_data = array('title' => $this->input->post('title'), 'description' => $this->input->post('post_desc'), 'ad_actions' => $actions, 'action_desc' => $action_desc, 'req_type' => $this->input->post('type'), 'cat_id' => $this->input->post('interest'),
                    'date' => date('d M Y'), 'time' => time(), 'country_code' => $this->input->post('country'), 'tags' => $tags, 'phone' => $phone, 'email' => $email, 'link' => $link);
                $this->dashboard_m->update_post($ad_data, $file_str, $vid_name, $this->input->post('post_update_id'));
                $this->session->set_flashdata('msg','<div class="alert alert-success alert-single">You have successfully updated the SOS.</div>');
                echo 'success';
            } else {
                echo 'error';
            }
        }
    }

    public function submit_post() {
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('post_desc', 'Description', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('interest', 'Category', 'trim|required');
        $this->form_validation->set_rules('type', 'Type', 'trim|required');
        if($this->input->post('type') == 1) {
            $this->form_validation->set_rules('actions[]', 'Actions', 'trim|required');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|numeric|min_length[10]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('link', 'Website / Link', 'trim|valid_url');
            if(in_array('8', $this->input->post('actions'))) {
                $this->form_validation->set_rules('action_desc', 'Action Description', 'trim|required');
            }
        }
        if ($this->form_validation->run() == TRUE) {
            $file_str = $vid_name = '';
            $this->load->library('upload');
            /* Image Upload */
            if (isset($_FILES['file0'])) {
                 if(count($_FILES) !== 0) {
                    for($i=0; $i<count($_FILES); $i++) {
                        if (isset($_FILES['file'.$i])) {
                            $config_img['upload_path'] = './assets/userdata/dashboard/ads/';
                            $config_img['allowed_types'] = 'jpg|png|jpeg';
                            $tmp1 = explode('.', $_FILES['file'.$i]['name']);
                            $ext1 = end($tmp1);
                            $img_name = date("ymd") . (time()+$i) . '.' . strtolower($ext1);
                            $config_img['file_name'] = $img_name;
                            $this->upload->initialize($config_img);
                            if($this->upload->do_upload('file'.$i)){ $tmp_ary[] = $img_name; }
                        }
                    }
                    $file_str = implode(',', $tmp_ary);
                    foreach ($tmp_ary as $arr) {
                        $this->image_resize($arr, 'post');
                    }
                }
            }
            /* Video Upload */
            if (isset($_FILES['Video']['name'])) {
                $config_vid['upload_path'] = './assets/userdata/dashboard/ads/';
                $tmp2 = explode('.', $_FILES['Video']['name']);
                $ext2 = end($tmp2);
                $vid_name = date("ymd") . time() . '.' . strtolower($ext2);
                $config_vid['file_name'] = $vid_name;
                $config_vid['allowed_types'] = 'mp4';
                $this->upload->initialize($config_vid);
                if (!$this->upload->do_upload('Video')) { $vid_name = ''; }
            }
            if($this->input->post('type') == 1) { $action_desc = (in_array('8', $this->input->post('actions')))? $this->input->post('action_desc') : ''; } else { $action_desc = ''; }
            $actions = ($this->input->post('type') == 1)? implode(',', $this->input->post('actions')) : '';
            $phone = ($this->input->post('type') == 1)? $this->input->post('phone') : '';
            $email = ($this->input->post('type') == 1)? $this->input->post('email') : '';
            $link = ($this->input->post('type') == 1)? $this->input->post('link') : '';
            $tags = ($this->input->post('tags') != '') ? implode(',', $this->input->post('tags')) : '';
            $ad_data = array('user_id' => $this->session->userdata('user_id'), 'title' => $this->input->post('title'), 'description' => $this->input->post('post_desc'), 'ad_actions' => $actions, 'action_desc' => $action_desc, 'req_type' => $this->input->post('type'), 'cat_id' => $this->input->post('interest'),
                'img' => $file_str, 'video' => $vid_name, 'date' => date('d M Y'), 'time' => time(), 'country_code' => $this->input->post('country'), 'tags' => $tags, 'phone' => $phone, 'email' => $email, 'link' => $link);
            $post_id = $this->dashboard_m->insert_ad($ad_data);
            $conn = $this->dashboard_m->get_user_connection();
            if(count($conn > 0)) {
                $this->load->model('email_m');
                $name = ($this->info->type_id == 1) ? ucfirst(strtolower($this->info->firstname)) . ' ' . ucfirst(strtolower($this->info->lastname)) : ucfirst(strtolower($this->info->name));
                foreach ($conn as $c) {
                    ($c->user_one == $this->session->userdata('user_id'))? $this->email_m->wa_add_email($this->dashboard_m->get_info($c->user_two)->email, $this->input->post('title'), $post_id, $this->input->post('type')) : $this->email_m->wa_add_email($this->dashboard_m->get_info($c->user_one)->email, $this->input->post('title'), $post_id, $this->input->post('type'));
                    $msg = array (
                        'body'  => "$name has posted a SOS",
                        'title' => 'SOS alert!'
                    );
                    $this->sendMessage((($c->user_one == $this->session->userdata('user_id'))? $c->user_two : $c->user_one), $msg);
                }
            }
            echo 'success';
        } else {
            echo validation_errors();
        }
    }
    
    public function submit_post_upgrade() {
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('post_desc', 'Description', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('type', 'Type', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $file_str = $vid_name = '';
            $this->load->library('upload');
            /* Image Upload */
            if (isset($_FILES['file0'])) {
                 if(count($_FILES) !== 0) {
                    for($i=0; $i<count($_FILES); $i++) {
                        if (isset($_FILES['file'.$i])) {
                            $config_img['upload_path'] = './assets/userdata/dashboard/ads/';
                            $config_img['allowed_types'] = 'jpg|png|jpeg';
                            $tmp1 = explode('.', $_FILES['file'.$i]['name']);
                            $ext1 = end($tmp1);
                            $img_name = date("ymd") . (time()+$i) . '.' . strtolower($ext1);
                            $config_img['file_name'] = $img_name;
                            $this->upload->initialize($config_img);
                            if($this->upload->do_upload('file'.$i)){ $tmp_ary[] = $img_name; }
                        }
                    }
                    $file_str = implode(',', $tmp_ary);
                    foreach ($tmp_ary as $arr) {
                        $this->image_resize($arr, 'post');
                    }
                }
            }
            /* Video Upload */
            if (isset($_FILES['Video']['name'])) {
                $config_vid['upload_path'] = './assets/userdata/dashboard/ads/';
                $tmp2 = explode('.', $_FILES['Video']['name']);
                $ext2 = end($tmp2);
                $vid_name = date("ymd") . time() . '.' . strtolower($ext2);
                $config_vid['file_name'] = $vid_name;
                $config_vid['allowed_types'] = 'mp4';
                $this->upload->initialize($config_vid);
                if (!$this->upload->do_upload('Video')) { $vid_name = ''; }
            }
            $tags = ($this->input->post('tags') != '') ? implode(',', $this->input->post('tags')) : '';
            $cat_id = ($this->input->post('type') == 1) ? 1 : 6;
            $ad_data = array('user_id' => $this->session->userdata('user_id'), 'title' => $this->input->post('title'), 'description' => $this->input->post('post_desc'), 'ad_actions' => '', 'action_desc' => '', 'req_type' => 2, 'cat_id' => $cat_id,
                'img' => $file_str, 'video' => $vid_name, 'date' => date('d M Y'), 'time' => time(), 'country_code' => $this->input->post('country'), 'tags' => $tags, 'phone' => '', 'email' => '', 'link' => '');
            $post_id = $this->dashboard_m->insert_ad($ad_data);
            $conn = $this->dashboard_m->get_user_connection();
            $this->dashboard_m->ads_upgrade($post_id);
            if(count($conn > 0)) {
                $this->load->model('email_m');
                foreach ($conn as $c) {
                    ($c->user_one == $this->session->userdata('user_id'))? $this->email_m->wa_add_email($this->dashboard_m->get_info($c->user_two)->email, $this->input->post('title'), $post_id, $this->input->post('type')) : $this->email_m->wa_add_email($this->dashboard_m->get_info($c->user_one)->email, $this->input->post('title'), $post_id, $this->input->post('type')) ;
                }
            }
            echo 'success';
        } else {
            echo validation_errors();
        }
    }
    
    public function sos($id, $comment = '') {
        if($id != '' && $this->dashboard_m->get_single_post($id)) {
            $data['ad'] = $this->dashboard_m->get_single_post($id);
            $data['css'] = array('mediaelementplayer.min.css');
            $data['js'] = array('mediaelement-and-player.min.js', 'linkify.min.js', 'linkify-jquery.min.js');
            if($comment != '') {
                $cmt = $this->dashboard_m->get_comment_row($comment);
                if($cmt->is_child == 1) {
                    $data['customJs'] = "load_comment_highlight('ad', $id, $comment); load_child_comment_highlight($cmt->parent_id, $comment); $('video,audio').mediaelementplayer({ enableAutosize: true }); $(document).ready(function () { $('.post-single .title a').html($.emoticons.replace($('.post-single .title a').text())); $('.post-single .post-desc p').html($.emoticons.replace($('.post-single .post-desc p').text())); $('.post-single .post-desc p').linkify({ target: '_blank' }); });";
                } else {
                    $data['customJs'] = "load_comment_highlight('ad', $id, $comment); $('video,audio').mediaelementplayer({ enableAutosize: true }); $(document).ready(function () { $('.post-single .title a').html($.emoticons.replace($('.post-single .title a').text())); $('.post-single .post-desc p').html($.emoticons.replace($('.post-single .post-desc p').text())); $('.post-single .post-desc p').linkify({ target: '_blank' }); });";
                } 
            } else {
                $data['customJs'] = "load_comment('ad', $id); $('video,audio').mediaelementplayer({ enableAutosize: true }); $(document).ready(function () { $('.post-single .title a').html($.emoticons.replace($('.post-single .title a').text())); $('.post-single .post-desc p').html($.emoticons.replace($('.post-single .post-desc p').text())); $('.post-single .post-desc p').linkify({ target: '_blank' }); });";
            }
            $data['allcat'] = $this->dashboard_m->get_category();
            $data['countries'] = $this->dashboard_m->get_country_list();
            $data['view'] = 'dashboard/post-single';
            $this->renderPage($data, 'dashboard');
        } else {
            redirect('dashboard');
        }
    }
    
    public function user_post_count($id) {
        return $this->dashboard_m->user_post_count($id);
    }
    
    public function sos_type($id) {
        $type = $this->dashboard_m->get_single_post($id)->req_type;
        echo ($type == 1)? '<strong>SOS</strong> need' : '<strong>SOS</strong> action';
    }
    
    /* Propic */
    public function update_propic() {
        if ($this->input->post('image') != 'false') {
            $data = $_POST['image'];
            $file = date('ymd') . time() . '.' . 'jpg';
            $path = './assets/userdata/dashboard/propic/'. $file;
            if($this->base64_to_jpeg($data, $path)) {
                $this->dashboard_m->update_propic($file);
                echo 'success';
            } else {
                echo 'No proper image selected.';
            }            
        } else {
            echo 'No proper image selected.';
        }
    }
    
    public function delete_propic() {
        $this->dashboard_m->delete_propic();
        echo 'success';
    }
    
    /* Banner */
    public function update_banner() {
        if ($this->input->post('image') != 'false') {
            $data = $_POST['image'];
            $file = date('ymd') . time() . '.' . 'jpg';
            $path = './assets/userdata/dashboard/banner/'. $file;
            if($this->base64_to_jpeg($data, $path)) {
                $this->dashboard_m->update_banner($file);
                echo $this->session->userdata('user_id');
            } else {
                echo 'No proper image selected.';
            }            
        } else {
            echo 'No proper image selected.';
        }
    }
    
    public function delete_banner() {
        $this->dashboard_m->delete_banner();
        echo $this->session->userdata('user_id');
    }
    
    /* Image Conversation */
    public function base64_to_jpeg($base64_string, $output_file) {
        $ifp = fopen($output_file, 'wb'); 
        if(fwrite($ifp, base64_decode(str_replace('data:image/png;base64,', '', $base64_string)))) {
            fclose($ifp);
            return TRUE; 
        } else {
            return FALSE;
        }
    }
    
    /* Job Listing */
    public function jobs() {
        if($this->info->job == 1) {
            $data['c_job'] = ($this->info->type_id == 1)? $this->dashboard_m->get_curr_user_cv_count() : $this->dashboard_m->get_curr_user_single_user_job_post_count();
            $data['c_list'] = array('Antarctica', 'Argentina', 'Australia', 'Austria', 'Bahrain', 'Belgium', 'Brazil', 'Canada', 'Chile', 'China', 'Colombia', 'Costa Rica', 'Czech Republic', 'Denmark', 'Ecuador', 'Egypt', 'Finland', 'France', 'Germany', 'Greece', 'Hong Kong', 'Hungary', 'India', 'Indonesia', 'Ireland', 'Israel', 'Italy', 'Japan', 'Kuwait', 'Luxembourg', 'Malaysia', 'Mexico', 'Morocco', 'Netherlands', 'New Zealand', 'Nigeria', 'Norway', 'Oman', 'Pakistan', 'Panama', 'Peru', 'Philippines', 'Poland', 'Portugal', 'Qatar', 'Romania', 'Russia', 'Saudi Arabia', 'Singapore', 'South Africa', 'South Korea', 'Spain', 'Sweden', 'Switzerland', 'Taiwan', 'Thailand', 'Turkey', 'Ukraine', 'United Arab Emirates', 'United Kingdom', 'United States', 'Uruguay', 'Venezuela', 'Vietnam');
            $data['countries'] = $this->dashboard_m->get_country_list();
            $data['jobcats'] = $this->dashboard_m->get_job_category();
            $data['view'] = 'dashboard/jobs';
            $this->renderPage($data, 'dashboard');
        }
        else {
            redirect('dashboard');
        }
    }
    
    public function joblisting($type = '', $cat = '', $country = '') {
        if($this->info->job == 1) {
            $data['css'] = array('mediaelementplayer.min.css');
            $data['js'] = array('pnotify.min.js', 'shorten.js', 'moment.min.js', 'daterangepicker.js', 'mediaelement-and-player.min.js');
            if($type == 'all_candidates') { $data['customJs'] = "load_candidates();"; } else if($type == 'all') { $data['customJs'] = "load_jobs();"; } else if($type == 'applied') { $data['customJs'] = "applied_jobs();"; } else if($type == 'manage_jobs') { $data['customJs'] = "manage_jobs();"; }
            if($type == 'jobs' && $cat != '' && $country != '') { $data['customJs'] = "load_job_search($cat, '$country');"; }
            if($type == 'candidates' && $cat != '' && $country != '') { $data['customJs'] = "load_candidates_search($cat, '$country');"; }
            if(is_numeric($type)) { $data['customJs'] = "load_job_cat($type);"; }
            if($type == 'applied_candidates' && $cat != '') { $data['customJs'] = "applied_candidates($cat);"; }
            if($type == 'shortlisted_candidates' && $cat != '') { $data['customJs'] = "shortlisted_candidates($cat);"; }
            $data['cv_cnt'] = ($this->info->type_id == 1)? $this->dashboard_m->get_curr_user_cv_count() : '';
            $data['jobcats'] = $this->dashboard_m->get_job_category();
            $data['c_list'] = array('Antarctica', 'Argentina', 'Australia', 'Austria', 'Bahrain', 'Belgium', 'Brazil', 'Canada', 'Chile', 'China', 'Colombia', 'Costa Rica', 'Czech Republic', 'Denmark', 'Ecuador', 'Egypt', 'Finland', 'France', 'Germany', 'Greece', 'Hong Kong', 'Hungary', 'India', 'Indonesia', 'Ireland', 'Israel', 'Italy', 'Japan', 'Kuwait', 'Luxembourg', 'Malaysia', 'Mexico', 'Morocco', 'Netherlands', 'New Zealand', 'Nigeria', 'Norway', 'Oman', 'Pakistan', 'Panama', 'Peru', 'Philippines', 'Poland', 'Portugal', 'Qatar', 'Romania', 'Russia', 'Saudi Arabia', 'Singapore', 'South Africa', 'South Korea', 'Spain', 'Sweden', 'Switzerland', 'Taiwan', 'Thailand', 'Turkey', 'Ukraine', 'United Arab Emirates', 'United Kingdom', 'United States', 'Uruguay', 'Venezuela', 'Vietnam');
            $data['countries'] = $this->dashboard_m->get_country_list();
            $data['levels'] = $this->dashboard_m->get_job_levels();
            $data['types'] = $this->dashboard_m->get_job_types();
            $data['view'] = 'dashboard/joblisting';
            $this->renderPage($data, 'dashboard');
        } else {
            redirect('dashboard');
        }
    }
    
    public function load_job() {
        $data['type'] = 'job';
        $data['extra'] = 'indeed_jobs';
        if($this->input->post('last_id')) {
            if($this->session->userdata('adv_count') == '') { $this->session->set_userdata('adv_count', 1); }
            $data['jobs'] = $this->dashboard_m->get_more_job_listing($this->input->post('last_id'));
        } else {
            $this->session->set_userdata('adv_count', '');
            $data['jobs'] = $this->dashboard_m->get_job_listing();
        }
        $this->load->view('dashboard/job-block', $data);
    }
    
    public function load_indeed_jobs($cat, $cntry) {
        $country = strtolower($this->info->country);
        $cat_name = ($cat != '')? $this->dashboard_m->get_job_category_name($cat) : '';
        $data['cat'] = $cat;
        $data['country'] = $cntry;
        if($cat_name != '' && $cntry != '') {
            $data['xml'] = simplexml_load_file("http://api.indeed.com/ads/apisearch?publisher=4203345453870824&q=$cat_name&sort=&radius=&st=&jt=&start=&limit=&fromage=&filter=&latlong=1&co=$cntry&chnl=&userip=&useragent=Mozilla/%2F4.0%28Firefox%29&v=2");
        } else if($cat_name != '' && $cntry == '') {
            $data['xml'] = simplexml_load_file("http://api.indeed.com/ads/apisearch?publisher=4203345453870824&q=$cat_name&sort=&radius=&st=&jt=&start=&limit=&fromage=&filter=&latlong=1&co=$country&chnl=&userip=&useragent=Mozilla/%2F4.0%28Firefox%29&v=2");
        } else {
            $data['xml'] = simplexml_load_file("http://api.indeed.com/ads/apisearch?publisher=4203345453870824&q=all&sort=&radius=&st=&jt=&start=&limit=&fromage=&filter=&latlong=1&co=$country&chnl=&userip=&useragent=Mozilla/%2F4.0%28Firefox%29&v=2");
        }
        $this->load->view('dashboard/job-indeed', $data);
    }
    
    public function load_more_indeed_jobs() {
        if($this->input->post('nxt_page')) {
            $country = strtolower($this->info->country);
            $cntry = $this->input->post('country');
            $cat_name = ($this->input->post('cat') != '')? $this->dashboard_m->get_job_category_name($this->input->post('cat')) : '';
            $start = 25 * $this->input->post('nxt_page') + 1;
            if($cat_name != '' && $cntry != '') {
                $data['xml'] = simplexml_load_file("http://api.indeed.com/ads/apisearch?publisher=4203345453870824&q=$cat_name&sort=&radius=&st=&jt=&start=$start&limit=&fromage=&filter=&latlong=1&co=$cntry&chnl=&userip=&useragent=Mozilla/%2F4.0%28Firefox%29&v=2");
            } else if($cat_name != '' && $cntry == '') {
                $data['xml'] = simplexml_load_file("http://api.indeed.com/ads/apisearch?publisher=4203345453870824&q=$cat_name&sort=&radius=&st=&jt=&start=$start&limit=&fromage=&filter=&latlong=1&co=$country&chnl=&userip=&useragent=Mozilla/%2F4.0%28Firefox%29&v=2");
            } else {
                $data['xml'] = simplexml_load_file("http://api.indeed.com/ads/apisearch?publisher=4203345453870824&q=all&sort=&radius=&st=&jt=&start=$start&limit=&fromage=&filter=&latlong=1&co=$country&chnl=&userip=&useragent=Mozilla/%2F4.0%28Firefox%29&v=2");
            }
            $data['cat'] = $this->input->post('cat');
            $data['country'] = $cntry;
            $this->load->view('dashboard/job-indeed', $data);
        }
    }

    public function load_applied_jobs() {
        $data['type'] = 'job';
        if($this->input->post('last_id')) {
            if($this->session->userdata('adv_count') == '') { $this->session->set_userdata('adv_count', 1); }
            $data['jobs'] = $this->dashboard_m->get_more_applied_job_listing($this->input->post('last_id'));
        } else {
            $this->session->set_userdata('adv_count', '');
            $data['jobs'] = $this->dashboard_m->get_applied_job_listing();
        }
        $this->load->view('dashboard/job-block', $data);
    }
    
    public function load_candidates() {
        $data['type'] = 'candidate';
        if($this->input->post('last_id')) {
            if($this->session->userdata('adv_count') == '') { $this->session->set_userdata('adv_count', 1); }
            $data['candidates'] = $this->dashboard_m->get_more_candidates($this->input->post('last_id'));
        } else {
            $this->session->set_userdata('adv_count', '');
            $data['candidates'] = $this->dashboard_m->get_candidates();
        }
        $this->load->view('dashboard/job-block', $data);
    }
    
    public function load_applied_candidates() {
        if($this->input->post('job_id')) {
            $data['type'] = 'candidate';
            $this->session->set_userdata('adv_count', '');
            $data['candidates'] = $this->dashboard_m->get_applied_candidates($this->input->post('job_id'));
            $this->load->view('dashboard/job-block', $data);
        }
    }
    
    public function check_shortlist_candidate($job_id, $cand_id) {
        if($this->dashboard_m->user_job_post_check($job_id) == 1 && $this->dashboard_m->candidate_apply_check($job_id, $cand_id) == 1) {
            echo "<li><i class='ion-checkmark-round'></i><a onclick='shortlist_candidate($job_id, $cand_id)'>Shortlist Candidate</a></li>";
        }
    }
    
    public function shortlist_candidate() {
        if($this->input->post('job_id') && $this->input->post('cand_id') && $this->dashboard_m->user_job_post_check($this->input->post('job_id')) == 1 && $this->dashboard_m->candidate_apply_check($this->input->post('job_id'), $this->input->post('cand_id')) == 1) {
            // mailing function
            $this->dashboard_m->shortlist_candidate($this->input->post('job_id'), $this->input->post('cand_id'));
            echo 'success';
        }
    }
    
    public function load_shortlisted_candidates() {
        if($this->input->post('job_id')) {
            $data['type'] = 'candidate';
            $this->session->set_userdata('adv_count', '');
            $data['candidates'] = $this->dashboard_m->get_shortlisted_candidates($this->input->post('job_id'));
            $this->load->view('dashboard/job-block', $data);
        }
    }
    
    public function load_my_job() {
        $data['type'] = 'job';
        $data['jobs'] = $this->dashboard_m->get_curr_user_single_user_job_posts();
        $this->load->view('dashboard/job-block', $data);
    }
    
    public function user_job_post_check($job_id) {
        if($this->dashboard_m->user_job_post_check($job_id) > 0) {
            echo '<div class="dropdown clearfix"> 
                    <button class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ion-android-more-vertical"></i></button> 
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a data-toggle="modal" onclick="update_job('.$job_id.')">Edit</a></li>
                        <li><a data-toggle="modal" data-target="#delete_job" onclick="set_delete_job_post('.$job_id.')">Delete</a></li> 
                    </ul> 
                  </div>';
        }
    }
    
    public function submit_job() {
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('job_desc', 'Description', 'trim|required');
        $this->form_validation->set_rules('job_cat', 'Job Category', 'trim|required');
        $this->form_validation->set_rules('job_user_level', 'Experience Level', 'trim|required');
        $this->form_validation->set_rules('job_user_type', 'Employment Type', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('job_end_date', 'Expiry Date', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $skills =($this->input->post('tags') != '') ? implode(',', $this->input->post('tags')) : '';
            $file_str = '';
            if(count($_FILES) !== 0 && $this->info->user_level != 0) {
                $this->load->library('upload');
                $config['upload_path'] = './assets/userdata/dashboard/jobs/img';
                for($i = 0; $i < count($_FILES); $i++) {
                    $tmp3 = explode('.', $_FILES['file'.$i]['name']);
                    $ext3 = end($tmp3);
                    $file = date("ymd") . (time()+$i) . '.' . strtolower($ext3) ;
                    $config['file_name'] = $file;
                    $config['allowed_types'] = 'jpg|png|jpeg';
                    $this->upload->initialize($config);
                    if($this->upload->do_upload('file'.$i)){ $tmp_ary[] = $file; }
                }
                $file_str = implode(',', $tmp_ary);
                foreach ($tmp_ary as $arr) {
                    $this->image_resize($arr, 'job');
                }
            }
            if($this->input->post('job_website')!=='') {
                $website = $this->input->post('job_website');
                if(strpos($website,'http')===false) {
                    $website = 'http://'.$this->input->post('job_website');
                }
            }
            $ad_data = array('user_id' => $this->session->userdata('user_id'), 'job_title' => $this->input->post('title'), 'job_desc' => $this->input->post('job_desc'), 'job_skills' => $skills, 'job_contact' => $this->input->post('job_phone'), 
                'job_email' => $this->input->post('job_email'), 'job_website' =>$this->input->post('job_website'), 'job_cat_id' => $this->input->post('job_cat'), 'job_img' => $file_str, 'date' => date('d M Y'), 'time' => time(), 
                'job_country' => $this->input->post('country'), 'exp_level' => $this->input->post('job_user_level'), 'employment_type' => $this->input->post('job_user_type'), 'expiry_date' => $this->input->post('job_end_date'));
            $this->dashboard_m->insert_job($ad_data);
            echo 'success';
        } else {
            echo validation_errors();
        }
    }
    
    public function update_job() {
        if($this->input->post('id') != '') {
            $data['job'] = $this->dashboard_m->get_curr_user_single_user_job_post($this->input->post('id'));            
            if(isset($data['job']->job_title)) {
                $data['jobcats'] = $this->dashboard_m->get_job_category();
                $data['joblevels'] = $this->dashboard_m->get_job_levels();
                $data['jobtypes'] = $this->dashboard_m->get_job_types();
                $data['countries'] = $this->dashboard_m->get_country_list();
                $this->load->view('dashboard/modals/update-job', $data);
            }
        }
        
        if($this->input->post('job_update_id') != '') {
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $this->form_validation->set_rules('job_desc', 'Description', 'trim|required');
            $this->form_validation->set_rules('job_cat', 'Job Category', 'trim|required');
            $this->form_validation->set_rules('job_user_level', 'Experience Level', 'trim|required');
            $this->form_validation->set_rules('job_user_type', 'Employment Type', 'trim|required');
            $this->form_validation->set_rules('country', 'Country', 'trim|required');
            $this->form_validation->set_rules('job_end_date', 'Expiry Date', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $skills =($this->input->post('tags') != '') ? implode(',', $this->input->post('tags')) : '';
                $file_str = '';
                $tmp_ary = array();
                if(count($_FILES) !== 0 && $this->info->user_level != 0) {
                    $this->load->library('upload');
                    $config['upload_path'] = './assets/userdata/dashboard/jobs/img';
                    for($i = 0; $i < count($_FILES); $i++) {
                        $tmp3 = explode('.', $_FILES['file'.$i]['name']);
                        $ext3 = end($tmp3);
                        $file = date("ymd") . (time()+$i) . '.' . strtolower($ext3) ;
                        $config['file_name'] = $file;
                        $config['allowed_types'] = 'jpg|png|jpeg';
                        $this->upload->initialize($config);
                        if($this->upload->do_upload('file'.$i)){ $tmp_ary[] = $file; }
                    }
                    $file_str = implode(',', $tmp_ary);
                    foreach ($tmp_ary as $arr) {
                        $this->image_resize($arr, 'job');
                    }
                    if(count($tmp_ary) > 0) {
                        $delete_file = $this->dashboard_m->get_curr_user_single_user_job_post($this->input->post('job_update_id'))->job_img;
                        if($delete_file != '') {
                            $img_arr = explode(',', $delete_file);
                            foreach($img_arr as $i) {
                                unlink('assets/userdata/dashboard/jobs/img/' . $i);
                            }
                        }
                    }
                }
                $update_data = array('job_title' => $this->input->post('title'), 'job_desc' => $this->input->post('job_desc'), 'job_skills' => $skills, 'job_contact' => $this->input->post('job_phone'), 
                    'job_email' => $this->input->post('job_email'), 'job_website' =>$this->input->post('job_website'), 'job_cat_id' => $this->input->post('job_cat'), 'job_img' => $file_str, 
                    'job_country' => $this->input->post('country'), 'exp_level' => $this->input->post('job_user_level'), 'employment_type' => $this->input->post('job_user_type'), 'expiry_date' => $this->input->post('job_end_date'));
                $this->dashboard_m->update_job($update_data, $file_str, $this->input->post('job_update_id'));
                echo 'success';
            } else {
                echo validation_errors();
            }
        }
    }
    
    public function delete_job() {
        if($this->input->post('id')) {
            $this->dashboard_m->delete_job($this->input->post('id'));
            echo 'success';
        }
    }
    
    public function job_search() {
        $job_cat = $this->input->post('job_cat');
        $job_country = $this->input->post('country');
        $job_skills =  ($this->input->post('tags') != '') ? implode(',', $this->input->post('tags')) : '';
        $data['type'] = 'job';
        $data['extra'] = 'indeed_jobs';
        $data['job_cat'] = $this->input->post('job_cat');
        $data['country'] = $this->input->post('country');
        if($job_cat != '' && $job_country != '') {
            $data['jobs'] = $this->dashboard_m->search_job_listing($job_cat, $job_country, $job_skills);
            $this->load->view('dashboard/job-block', $data);
        }
    }
    
    public function job_cat_search() {
        $job_cat = $this->input->post('job_cat');
        $data['type'] = 'job';
        $data['extra'] = 'indeed_jobs';
        $data['job_cat'] = $job_cat;
        $data['jobs'] = $this->dashboard_m->search_job_cat($job_cat);
        $this->load->view('dashboard/job-block', $data);
    }
    
    public function submit_job_search() {
        $job_cat = $this->input->post('job_cat');
        $job_country = $this->input->post('country');
        $job_skills =  ($this->input->post('tags') != '') ? implode(',', $this->input->post('tags')) : '';
        $data['type'] = 'job';
        if($job_cat != '' && $job_country != '') {
            $data['jobs'] = $this->dashboard_m->search_job_listing($job_cat, $job_country, $job_skills);
            if(count($data['jobs']) > 0) {
                $this->load->view('dashboard/job-block', $data);
            } else {
                echo 'no_result';
            }
        } else {
            echo 'error';
        }
    }
    
    public function cv($user_id) {
        if($user_id != '' && $this->info->job == 1 && ($user_id == $this->session->userdata('user_id') || $this->info->type_id != 1)) {
            if($this->info->type_id != 1) { ($this->dashboard_m->get_user_cv_count($user_id) == 0)? redirect('dashboard') : ''; }
            $data['css'] = array('mediaelementplayer.min.css');
            $data['js'] = array('pnotify.min.js', 'shorten.js', 'moment.min.js', 'daterangepicker.js', 'mediaelement-and-player.min.js');
            $data['levels'] = $this->dashboard_m->get_job_levels();
            $data['types'] = $this->dashboard_m->get_job_types();
            $data['categories'] = $this->dashboard_m->get_job_category();
            $data['countries'] = $this->dashboard_m->get_country_list();
            ($this->dashboard_m->get_user_cv_count($user_id) != 0)? $data['user_cv'] = $this->dashboard_m->get_user_cv($user_id) : $data['user_cv'] = 'null';
            $data['user_cv_exp'] = $this->dashboard_m->get_user_cv_exp($user_id);
            $data['user_cv_edu'] = $this->dashboard_m->get_user_cv_edu($user_id);
            if($this->info->type_id != 1 && $this->dashboard_m->job_email($data['user_cv']->main_user_id, $this->session->userdata('user_id')) == 0) {
                $this->load->model('email_m');
                $email = $this->dashboard_m->get_info($data['user_cv']->main_user_id)->email;
                $this->email_m->cv_view_email($email);
                $this->dashboard_m->add_job_email($data['user_cv']->main_user_id, $this->session->userdata('user_id'));
            }
            $data['user_id'] = $user_id;
            $data['view'] = 'dashboard/cv';
            $this->renderPage($data, 'dashboard');
        }
        else {
            redirect('dashboard');
        }
    }
    
    public function cv_location($code) {
        return $this->dashboard_m->cv_country_name($code);
    }

    public function cv_head_update() {
        $this->form_validation->set_rules('post', 'Current Post', 'trim|required');
        $this->form_validation->set_rules('company', 'Curent Company', 'trim|required');
        $this->form_validation->set_rules('country', 'Country', 'trim|required');
        $this->form_validation->set_rules('category', 'Category', 'trim|required');
        $this->form_validation->set_rules('years', 'Years', 'trim|required');
        $this->form_validation->set_rules('months', 'Months', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $skills =($this->input->post('tags') != '') ? implode(',', $this->input->post('tags')) : '';
            $file = '';
            if (isset($_FILES['file']['name'])) {
                $this->load->library('upload');
                $config['upload_path'] = './assets/userdata/dashboard/jobs/cv';
                $tmp3 = explode('.', $_FILES['file']['name']);
                $ext3 = end($tmp3);
                $file = date("ymd") . time() . '.' . strtolower($ext3) ;
                $config['file_name'] = $file;
                $config['allowed_types'] = 'doc|docx|pdf|txt';
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('file')) { $file = ''; }
            }
            $cv_data = array('user_id' => $this->session->userdata('user_id'), 'current_post' => $this->filter_string($this->input->post('post')), 'current_company' => $this->filter_string($this->input->post('company')), 'current_location' => $this->filter_string($this->input->post('country')), 'category' => $this->filter_string($this->input->post('category')), 
                'experience' => $this->input->post('years').','.$this->input->post('months'), 'skills' => $this->filter_string($skills), 'date' => date('d M Y'), 'time' => time());
            $this->dashboard_m->insert_cv_head($cv_data, $file);
            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">CV updated successfully.</div>');
            echo 'success';
        } else {
            echo validation_errors();
        }
    }
    
    public function cv_job_update() {
        $this->form_validation->set_rules('job_title', 'Target job title', 'trim|required');
        $this->form_validation->set_rules('level', 'Career level', 'trim|required');
        $this->form_validation->set_rules('target_country', 'Target job location', 'trim|required');
        $this->form_validation->set_rules('objective', 'Career objective', 'trim|required');
        $this->form_validation->set_rules('type', 'Employment type', 'trim|required');
        $this->form_validation->set_rules('monthly_salary', 'Target monthly salary', 'trim|required');
        $this->form_validation->set_rules('last_salary', 'Last monthly salary', 'trim|required');
        $this->form_validation->set_rules('notice', 'Notice period', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $cv_data = array('user_id' => $this->session->userdata('user_id'), 'job_title' => $this->filter_string($this->input->post('job_title')), 'level' => $this->filter_string($this->input->post('level')), 'target_country' => $this->filter_string($this->input->post('target_country')), 
                    'objective' => $this->filter_string($this->input->post('objective')), 'type' => $this->filter_string($this->input->post('type')), 'monthly_salary' => $this->filter_string($this->input->post('monthly_salary')), 
                    'last_salary' => $this->filter_string($this->input->post('last_salary')), 'notice' => $this->filter_string($this->input->post('notice')), 'date' => date('d M Y'), 'time' => time());
            $this->dashboard_m->insert_cv_job($cv_data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">CV updated successfully.</div>');
            echo 'success';
        } else {
            echo validation_errors();
        }
    }
    
    public function cv_personal_update() {
        $this->form_validation->set_rules('age', 'Age', 'trim|required');
        $this->form_validation->set_rules('nationality', 'Nationality', 'trim|required');
        $this->form_validation->set_rules('residence_country', 'Residence Country', 'trim|required');
        $this->form_validation->set_rules('visa', 'Visa Status', 'trim|required');
        $this->form_validation->set_rules('marital', 'Marital Status', 'trim|required');
        $this->form_validation->set_rules('dependents', 'Dependents', 'trim|required');
        $this->form_validation->set_rules('licence_country', 'Licence', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $cv_data = array('user_id' => $this->session->userdata('user_id'), 'age' => $this->filter_string($this->input->post('age')), 'nationality' => $this->filter_string($this->input->post('nationality')), 'residence_country' => $this->filter_string($this->input->post('residence_country')), 
                    'visa' => $this->filter_string($this->input->post('visa')), 'marital' => $this->filter_string($this->input->post('marital')), 'dependents' => $this->filter_string($this->input->post('dependents')), 
                    'licence_country' => $this->filter_string($this->input->post('licence_country')), 'date' => date('d M Y'), 'time' => time());
            $this->dashboard_m->insert_cv_personal($cv_data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">CV updated successfully.</div>');
            echo 'success';
        } else {
            echo validation_errors();
        }
    }
    
    public function cv_experience_update() {
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('company', 'Company', 'trim|required');
        $this->form_validation->set_rules('location', 'Location', 'trim|required');
        $this->form_validation->set_rules('category', 'Category', 'trim|required');
        $this->form_validation->set_rules('level', 'Level', 'trim|required');
        $this->form_validation->set_rules('responsibilities', 'Responsibilities', 'trim|required');
        $this->form_validation->set_rules('start_month', 'Start Month', 'trim|required');
        $this->form_validation->set_rules('start_year', 'Start Year', 'trim|required');
        $this->form_validation->set_rules('end_month', 'End Month', 'trim|required');
        $this->form_validation->set_rules('end_year', 'End Year', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $cv_data = array('user_id' => $this->session->userdata('user_id'), 'title' => $this->filter_string($this->input->post('title')), 'company' => $this->filter_string($this->input->post('company')), 'location' => $this->filter_string($this->input->post('location')), 
                    'category' => $this->filter_string($this->input->post('category')), 'level' => $this->filter_string($this->input->post('level')), 'responsibilities' => $this->filter_string($this->input->post('responsibilities')), 
                    'start' => $this->input->post('start_month').','.$this->input->post('start_year'), 'end' => $this->input->post('end_month').','.$this->input->post('end_year'), 'date' => date('d M Y'), 'time' => time());
            $this->dashboard_m->insert_cv_experience($cv_data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">CV updated successfully.</div>');
            echo 'success';
        } else {
            echo validation_errors();
        }
    }
    
    public function cv_education_update() {
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('collage', 'Collage', 'trim|required');
        $this->form_validation->set_rules('location', 'Location', 'trim|required');
        $this->form_validation->set_rules('end_month', 'End Month', 'trim|required');
        $this->form_validation->set_rules('end_year', 'End Year', 'trim|required');
        $this->form_validation->set_rules('grade', 'Grade', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $cv_data = array('user_id' => $this->session->userdata('user_id'), 'title' => $this->filter_string($this->input->post('title')), 'collage' => $this->filter_string($this->input->post('collage')), 'location' => $this->filter_string($this->input->post('location')), 
                    'completion' => $this->input->post('end_month').','.$this->input->post('end_year'), 'grade' => $this->filter_string($this->input->post('grade')), 'date' => date('d M Y'), 'time' => time());
            $this->dashboard_m->insert_cv_education($cv_data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">CV updated successfully.</div>');
            echo 'success';
        } else {
            echo validation_errors();
        }
    }
    
    public function delete_cv_exp() {
        if($this->input->post('id')) {
            $this->dashboard_m->delete_cv_exp($this->input->post('id'));
            echo 'success';
        }
    }
    
    public function delete_cv_edu() {
        if($this->input->post('id')) {
            $this->dashboard_m->delete_cv_edu($this->input->post('id'));
            echo 'success';
        }
    }
    
    public function cv_propic() {
        if ($this->input->post('image')) {
            $data = $_POST['image'];
            $file = date('ymd') . time() . '.' . 'jpg';
            $path = './assets/userdata/dashboard/jobs/propic/'. $file;
            if($this->base64_to_jpeg($data, $path)) {
                $this->dashboard_m->cv_propic($file);
                $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">CV updated successfully.</div>');
                echo 'success';
            } else {
                echo 'Upload failed. Please try again';
            }            
        } else {
            echo 'No proper image selected.';
        }
    }
    
    public function check_apply_now($job_id) {
        $cv = $this->dashboard_m->get_curr_user_cv_count();
        $check = $this->dashboard_m->check_application($job_id);
        if($check == 0 && $cv != 0) {
            echo "<li class='apply_job'><i class='ion-plus-round'></i><a onclick='apply_job($job_id)'>Apply Now</a></li>";
        }
        if($check != 0) {
            echo "<li class='apply_job'><i class='ion-checkmark-circled'></i><a class='no_pointer'>Applied</a></li>";
        }
    }
    
    public function apply_job() {
        if($this->input->post('job_id')) {
            $this->dashboard_m->apply_job($this->input->post('job_id'));
            if($this->info->user_level == 1) {
                $job = $this->dashboard_m->get_single_job_post($this->input->post('job_id'));
                $email = ($job->job_email != '')? $job->job_email : $job->email ;
                $attachment = $this->get_user_cv($this->session->userdata('user_id'))->cv;
                $this->load->modal('email_m');
                $this->email_m->submit_cv($email, $job, $attachment);
            }
            echo 'success';
        }
    }
    
    public function filter_string($string) {
        if($this->info->user_level == 0) {
            $pattern = '/[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+\/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/';
            return preg_replace($pattern, 'blah@blah.com', $string);
        } else {
            return $string;
        }
    }

    public function download_cv($file = '') {
        $this->load->helper('download');
        $req_details = $this->dashboard_m->get_candidate_by_file($file);
        if($req_details->main_user_id == $this->session->userdata('user_id')) {
            force_download('./assets/userdata/dashboard/jobs/cv/'.$file, NULL);
        } else {
            if($req_details->user_level == 0 && $this->info->user_level == 0) {
                if($req_details->cv_count < 6 && $this->info->count < 6) {
                    $count_cv = $req_details->cv_count + 1;
                    $count_user = $this->info->count + 1;
                    $this->dashboard_m->update_cv_count($req_details->main_user_id, $count_cv, $count_user);
                    force_download('./assets/userdata/dashboard/jobs/cv/'.$file, NULL);
                } else {
                    force_download('invalid.txt', 'CV is locked. Download limit exceeded.');
                }
            } else {
                if($req_details->user_level == 0) {
                    if($req_details->cv_count < 6) {
                        $count_cv = $req_details->cv_count + 1;
                        $this->dashboard_m->update_cv_count($req_details->main_user_id, $count_cv, '');
                        force_download('./assets/userdata/dashboard/jobs/cv/'.$file, NULL);
                    } else {
                        force_download('invalid.txt', 'CV is locked. Download limit exceeded.');
                    }
                } else {
                    force_download('./assets/userdata/dashboard/jobs/cv/'.$file, NULL);
                }
            }
        }
    }
    
    public function candidates_search() {
        $cat = $this->input->post('job_cat');
        $country = $this->input->post('country');
        $skills =  ($this->input->post('tags') != '') ? implode(',', $this->input->post('tags')) : '';
        $data['type'] = 'candidate';
        if($cat != '' && $country != '') {
            $data['candidates'] = $this->dashboard_m->search_candidates($cat, $country, $skills);
            if(count($data['candidates']) > 0) {
                $this->load->view('dashboard/job-block', $data);
            } else {
                echo 'no_result';
            }
        } else {
            echo 'error';
        }
    }
    
    public function get_candidate_propic($user_id) {
        $propic = $this->dashboard_m->get_connection_info($user_id)->propic;
        echo ($propic != '')? base_url("assets/userdata/dashboard/propic/" . $propic) : base_url("assets/img/user_placeholder.png");
    }

    /* Share Post */
    public function share_post() {
        if($this->input->post('type') == 'newsfeed') {
            $post = $this->dashboard_m->get_activity($this->input->post('type_id'));
            $parent_id = ($post->parent_id == '')? $post->timeline_post_id : $post->parent_id;
            $data = array(
                'user_id' => $this->session->userdata('user_id'),
                'parent_id' => $parent_id,
                'content_type' => $post->content_type,
                'blog_id' => $post->blog_id,
                'ad_id' => $post->ad_id,
                'title' => $post->title,
                'share_title' => $this->input->post('title'),
                'description' => $post->description,
                'tags' => $post->tags,
                'file' => $post->file,
                'map' => $post->map,
                'time' => time(),
                'date' => date('D M Y'),
                'privacy' => 0
            );
            $this->dashboard_m->share_newsfeed($data);
            echo 'success';
        }
        if($this->input->post('type') == 'blog') {
            $post = $this->dashboard_m->get_blog_activity($this->input->post('type_id'));
            $parent_id = ($post->parent_id == '')? $post->timeline_post_id : $post->parent_id;
            $data = array(
                'user_id' => $this->session->userdata('user_id'),
                'parent_id' => $parent_id,
                'content_type' => $post->content_type,
                'blog_id' => $post->blog_id,
                'ad_id' => $post->ad_id,
                'title' => $post->title,
                'share_title' => $this->input->post('title'),
                'description' => $post->description,
                'tags' => $post->tags,
                'file' => $post->file,
                'map' => $post->map,
                'time' => time(),
                'date' => date('D M Y'),
                'privacy' => 0
            );
            $this->dashboard_m->share_newsfeed($data);
            echo 'success';
        }
        if($this->input->post('type') == 'ad') {
            $post = $this->dashboard_m->get_ad_activity($this->input->post('type_id'));
            $parent_id = ($post->parent_id == '')? $post->timeline_post_id : $post->parent_id;
            $data = array(
                'user_id' => $this->session->userdata('user_id'),
                'parent_id' => $parent_id,
                'content_type' => $post->content_type,
                'blog_id' => $post->blog_id,
                'ad_id' => $post->ad_id,
                'title' => $post->title,
                'share_title' => $this->input->post('title'),
                'description' => $post->description,
                'tags' => $post->tags,
                'file' => $post->file,
                'map' => $post->map,
                'time' => time(),
                'date' => date('D M Y'),
                'privacy' => 0
            );
            $this->dashboard_m->share_newsfeed($data);
            echo 'success';
        }
    }
    
    public function shared_user($parent_id) {
        $post = $this->dashboard_m->get_activity($parent_id);
        $user =  $this->dashboard_m->get_connection_info($post->post_user_id);
        $name =  ($user->type_id == 1)? ucfirst(strtolower($user->firstname)) : ucfirst(strtolower($user->name));
        echo "<a class='parent_user trans' href='".base_url('dashboard/profile/'.$post->post_user_id)."'>shared <strong class='trans'>$name's</strong> $post->content_type</a>";
    }
    
    /* Image Resize */
    public function image_resize($file, $type) {
        $this->load->library('image_lib');
        $config['image_library'] = 'gd2';
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = TRUE;
        if($type == 'banner') { $config['source_image'] = './assets/userdata/dashboard/banner/'.$file; $config['width'] = 555; }
        if($type == 'photo') { $config['source_image'] = './assets/userdata/dashboard/timeline/'.$file; $config['width'] = 555; }
        if($type == 'group_banner') { $config['source_image'] = './assets/userdata/dashboard/group/banner/'.$file; $config['width'] = 515; }
        if($type == 'group_photo') { $config['source_image'] = './assets/userdata/dashboard/group/content/'.$file; $config['width'] = 555; }
        if($type == 'blog') { $config['source_image'] = './assets/userdata/dashboard/blog/'.$file; $config['width'] = 555; }
        if($type == 'post') { $config['source_image'] = './assets/userdata/dashboard/ads/'.$file; $config['width'] = 555; }
        if($type == 'job') { $config['source_image'] = './assets/userdata/dashboard/jobs/img/'.$file; $config['width'] = 555; }
        $this->image_lib->clear();
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
    }
    
    /* Contact Us */
    public function contact() {
        if($this->input->post('sub') && $this->input->post('msg')) {
            $this->form_validation->set_rules('sub', 'Subject', 'trim|required');
            $this->form_validation->set_rules('msg', 'Message', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $this->load->model('email_m');
                $email = $this->info->email;
                $name = ($this->session->userdata('user_type') == 1) ? ucfirst(strtolower($this->info->firstname)) . ' ' . ucfirst(strtolower($this->info->lastname)) : ucfirst(strtolower($this->info->name));
                $this->email_m->contact($email, $name, $this->input->post('sub'), $this->input->post('msg'));
                echo 'success';
            } else {
                echo validation_errors();
            }
            exit();
        }        
        $data['view'] = 'dashboard/contact';
        $this->renderPage($data, 'dashboard');
    }
    
    /* Report */
    public function report() {
        if($this->input->post('sub') && $this->input->post('msg')) {
            $this->form_validation->set_rules('sub', 'Subject', 'trim|required');
            $this->form_validation->set_rules('msg', 'Message', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $this->load->model('email_m');
                $email = $this->info->email;
                $name = ($this->session->userdata('user_type') == 1) ? ucfirst(strtolower($this->info->firstname)) . ' ' . ucfirst(strtolower($this->info->lastname)) : ucfirst(strtolower($this->info->name));
                $this->email_m->report($email, $name, $this->input->post('sub'), $this->input->post('msg'));
                echo 'success';
            } else {
                echo validation_errors();
            }
        }
    }
    
    /* Privacy Policy */
    public function privacy_policy() {
        $data['view'] = 'dashboard/privacy_policy';
        $this->renderPage($data, 'dashboard');
    }
    
    /* Terms */
    public function terms_and_conditions() {
        $data['view'] = 'dashboard/terms';
        $this->renderPage($data, 'dashboard');
    }
    
    public function ads_terms_and_conditions() {
        $data['view'] = 'dashboard/terms-ads';
        $this->renderPage($data, 'dashboard');
    }
    
    /* About */
    public function about() {
        $data['view'] = 'dashboard/about';
        $this->renderPage($data, 'dashboard');
    }
    
    /* Guidelines */
    public function help() {    
        $data['view'] = 'dashboard/guidelines';
        $this->renderPage($data, 'dashboard');       
    }
    
    public function general_faq() {    
        $data['view'] = 'dashboard/general-faq';
        $this->renderPage($data, 'dashboard');       
    }
    
    public function payment_faq() {    
        $data['view'] = 'dashboard/payment-faq';
        $this->renderPage($data, 'dashboard');       
    }
    
    /* Invitation */
    public function invitation() {
        $this->form_validation->set_rules('email[]', 'Email', 'trim|required');
        $this->form_validation->set_rules('type', 'Type', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $count = 0;
            if($this->input->post('type') == 2 && $this->input->post('msg') == '') {
                echo 'Please enter your message.';
                exit();
            }
            $this->load->model('email_m');
            foreach($this->input->post('email') as $email) {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $count++;
                } else {
                    $this->email_m->invitation($email, $this->input->post('type'), $this->input->post('msg'));
                    $this->dashboard_m->add_invitation($email);
                }
            }
            if($count == 0) {
                echo 'success';
            } else {
                echo 'Invalid email id.';
            }
        } else {
            echo validation_errors();
        }
    }
    
    /* Worthchat */
    public function worthchat() {    
        $data['view'] = 'dashboard/worthchat';
        $data['customJs'] = "set_height();";
        $this->renderPage($data, 'dashboard');       
    }
    
    /* Advisory */
    public function advisory() {
        $data['view'] = 'dashboard/advisory';
        $this->renderPage($data, 'dashboard');
    }
    
    /* Careers */
    public function careers() {
        if($this->input->post('subject')) {
            $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
            $this->form_validation->set_rules('cover', 'Cover Letter', 'required');
            if ($this->form_validation->run() == TRUE) {
                if (isset($_FILES['file']['name'])) {
                    $this->load->library('upload');
                    $config['upload_path'] = './assets/userdata/dashboard/jobs/cv/';
                    $tmp3 = explode('.', $_FILES['file']['name']);
                    $ext3 = end($tmp3);
                    $file = date("ymd") . time() . '.' . strtolower($ext3) ;
                    $config['file_name'] = $file;
                    $config['allowed_types'] = 'pdf|doc|docx';
                    $this->upload->initialize($config);
                    $this->upload->do_upload('file');
                    $this->load->model('email_m');
                    $email = $this->info->email;
                    $name = ($this->session->userdata('user_type') == 1) ? ucfirst(strtolower($this->info->firstname)) . ' ' . ucfirst(strtolower($this->info->lastname)) : ucfirst(strtolower($this->info->name));
                    $this->email_m->career($email, $name, $this->input->post('subject'), $this->input->post('cover'), $file);
                    echo 'success';
                } else { echo 'No files attached.'; }
            } else { echo validation_errors(); }
            exit();
        }
        $data['view'] = 'dashboard/careers';
        $this->renderPage($data, 'dashboard');
    }
    
    /* CSR */
    public function csr() {
        $data['css'] = array('mediaelementplayer.min.css');        
        $data['js'] = array('moment.js', 'moment-timezone-with-data.js', 'tzdetect.js', 'mediaelement-and-player.min.js');
        $data['status'] = '';
        $data['view'] = 'dashboard/csr';
        $this->renderPage($data, 'dashboard');
    }
    
    public function csr_old() {
        $data['status'] = $this->dashboard_m->check_csr_status();
        $data['c_list'] = count($this->dashboard_m->get_csr_listing()); 
        $data['c_process'] = count($this->dashboard_m->get_csr_process()); 
        $data['view'] = 'dashboard/csr_old';
        $this->renderPage($data, 'dashboard');
    }
    
    public function submit_csr() {
        if($this->input->post('question_1') == '' || $this->input->post('question_2') == '' || $this->input->post('question_3') == '' || $this->input->post('question_4') == '' || $this->input->post('question_5') == '') {
            echo 'Please answer all the questions.';
            exit();
        } else {
            $this->load->library('upload');
            $this->load->model('email_m');
            $error = 0;
            $invalid = 0;
            $files = array();
            for($i = 1; $i <6; $i++) {
                if($this->input->post("question_$i") == 1) {
                    if (isset($_FILES["file_$i"]['name'])) {
                        $config['upload_path'] = './assets/userdata/dashboard/csr/';
                        $tmp3 = explode('.', $_FILES["file_$i"]['name']);
                        $ext3 = end($tmp3);
                        $file = date("ymd") . time() * $i . '.' . strtolower($ext3) ;
                        $config['file_name'] = $file;
                        $config['allowed_types'] = 'pdf|doc|docx|jpeg|jpg|png';
                        $this->upload->initialize($config);
                        ($this->upload->do_upload("file_$i")) ? $files[] = $file : $invalid++;
                    } else {
                        $error++;
                    }
                }
            }
            if($error > 0) {
                echo 'Please attach the required file to the question.';
                exit();
            }
            if($invalid > 0) {
                echo 'Invalid attachment found. Please check your attached file formats again.';
                exit();
            }
            $file_str = implode(',', $files);
            $data = array('user_id' => $this->session->userdata('user_id'), 'q1' => $this->input->post('question_1'), 'q2' => $this->input->post('question_2'), 'q3' => $this->input->post('question_3'), 'q4' => $this->input->post('question_4'), 'q5' => $this->input->post('question_5'), 'files' => $file_str, 'time' => time(), 'date' => date('d M Y'));
            $this->dashboard_m->submit_csr($data);
            $this->dashboard_m->add_csr_list();
            $this->email_m->csr_submission($data, $this->info->name, $this->info->email);
            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Your application was successfully submitted. You will be notified via email once the review process is completed.</div>');
            echo 'success';
        }
    }
    
    public function get_listed() {
        if($this->dashboard_m->check_csr_status() == 'null' && $this->info->type_id != 1) {
            $data['view'] = 'dashboard/csr-form';
            $this->renderPage($data, 'dashboard');
        } else {
            redirect(base_url('dashboard/csr'));
        }
    }
    
    public function load_csr_list() {
        if($this->input->post('last_id')) {
            $data['companies'] = $this->dashboard_m->get_more_csr_listing($this->input->post('last_id'));
        } else {
            $data['companies'] = $this->dashboard_m->get_csr_listing();
        }
        $this->load->view('dashboard/csr-block', $data);
    }
    
    public function load_csr_process() {
        if($this->input->post('last_id')) {
            $data['companies'] = $this->dashboard_m->get_more_csr_process($this->input->post('last_id'));
        } else {
            $data['companies'] = $this->dashboard_m->get_csr_process();
        }
        $this->load->view('dashboard/csr-block', $data);
    }

    /* Advertise */
    public function advertise() {
        $data['view'] = 'dashboard/advertise';
        $this->renderPage($data, 'dashboard');
    }
    
    public function create_advertise() {
        $data['countries'] = $this->dashboard_m->get_country_list();
        $data['view'] = 'dashboard/create_adv';
        $this->renderPage($data, 'dashboard');
    }
    
    public function get_adv_blocks() {
        if($this->input->post('page') && $this->input->post('view') && $this->input->post('country')) {
            $data = array();
            $blocks = $this->dashboard_m->get_adv_blocks($this->input->post('page'), $this->input->post('view'));  
            $booked_blocks = $this->dashboard_m->get_booked_blocks($this->input->post('page'), $this->input->post('view'), $this->input->post('country'));
            $booked_names = array_keys($booked_blocks);
            foreach ($blocks as $block) {
                if(in_array($block->name, $booked_names)) {
                    $data[] = array('id' => $block->id, 'name' => $block->name, 'page' => $block->page, 'viewport' => $block->viewport, 'price' => $block->price, 'position' => $block->position, 'status' => 1, 'availability' => $booked_blocks[$block->name]);
                } else {
                    $data[] = array('id' => $block->id, 'name' => $block->name, 'page' => $block->page, 'viewport' => $block->viewport, 'price' => $block->price, 'position' => $block->position, 'status' => 0, 'availability' => '');
                }
            }
            echo json_encode($data);
        }
    }
    
    public function get_block_details() {
        $this->session->unset_userdata('adv_price');
        $this->session->unset_userdata('adv_days_price');
        $this->session->unset_userdata('adv_type_price');
        $this->session->unset_userdata('block_id');
        if($this->input->post('id')) {
            $price = $this->dashboard_m->get_block_details($this->input->post('id'))->price;
            $this->session->set_userdata('adv_price', $price);
            $this->session->set_userdata('block_id', $this->input->post('id'));
            echo $price;
        }
    }
    
    public function update_adv_price() {
        if($this->input->post('type') == 'day') {
            $this->session->unset_userdata('adv_days_price');
            $price_days = $this->input->post('num') * 10;
            $this->session->set_userdata('adv_days_price', $price_days);
        }
        if($this->input->post('type') == 'format') {
            $this->session->unset_userdata('adv_type_price');
            if($this->input->post('media_type') == 'image') {
                $this->session->set_userdata('adv_type_price', 10);
            }
            if($this->input->post('media_type') == 'slider') {
                $this->session->set_userdata('adv_type_price', 20);
            }
            if($this->input->post('media_type') == 'video') {
                $this->session->set_userdata('adv_type_price', 30);
            }
        }
        echo $this->session->userdata('adv_price') + $this->session->userdata('adv_days_price') + $this->session->userdata('adv_type_price');
    }
    
    public function book_adv_block() {
        $this->form_validation->set_rules('days', 'Days', 'trim|required');
        $this->form_validation->set_rules('type', 'Type', 'trim|required');
        $this->form_validation->set_rules('heading', 'Heading', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $slider_str = $vid_name = $img_name = '';
            $this->load->library('upload');
            if($this->input->post('type') == 'slider') {
                if (isset($_FILES['slider0'])) {
                    if(count($_FILES) !== 0) {
                        for($i=0; $i<count($_FILES); $i++) {
                            if (isset($_FILES['slider'.$i])) {
                                $config_img['upload_path'] = './assets/userdata/dashboard/adv/slider/';
                                $config_img['allowed_types'] = 'jpg|png|jpeg|gif';
                                $tmp1 = explode('.', $_FILES['slider'.$i]['name']);
                                $ext1 = end($tmp1);
                                $name = date("ymd") . (time()+$i) . '.' . strtolower($ext1);
                                $config_img['file_name'] = $name;
                                $this->upload->initialize($config_img);
                                if($this->upload->do_upload('slider'.$i)){ $tmp_ary[] = $name; }
                            }
                        }
                        $slider_str = implode(',', $tmp_ary);
                    }
                } else {
                    echo 'Please select your slider images.';
                    die();
                }
            }
            if($this->input->post('type') == 'image') {
                if (isset($_FILES['image']['name'])) {
                    $this->load->library('upload');
                    $config['upload_path'] = './assets/userdata/dashboard/adv/image/';
                    $tmp3 = explode('.', $_FILES['image']['name']);
                    $ext3 = end($tmp3);
                    $img_name = date("ymd") . time() . '.' . strtolower($ext3) ;
                    $config['file_name'] = $img_name;
                    $config['allowed_types'] = 'jpg|png|jpeg|gif';
                    $this->upload->initialize($config);
                    if (!$this->upload->do_upload('image')) { echo 'Invalid image uploaded.'; die(); }
                } else {
                    echo 'Please select your image.';
                    die();
                }
            }
            if($this->input->post('type') == 'video') {
                if (isset($_FILES['video']['name'])) {
                    $config_vid['upload_path'] = './assets/userdata/dashboard/adv/video/';
                    $tmp2 = explode('.', $_FILES['video']['name']);
                    $ext2 = end($tmp2);
                    $vid_name = date("ymd") . time() . '.' . strtolower($ext2);
                    $config_vid['file_name'] = $vid_name;
                    $config_vid['allowed_types'] = 'mp4';
                    $this->upload->initialize($config_vid);
                    if (!$this->upload->do_upload('video')) { echo 'Invalid video uploaded.'; die(); }
                } else {
                    echo 'Please select your video.';
                    die();
                }
            }
            $amount = $this->session->userdata('adv_price') + $this->session->userdata('adv_days_price') + $this->session->userdata('adv_type_price');
            $adv_data = array('user_id' => $this->session->userdata('user_id'), 'block_id' => $this->input->post('block_id'), 'availability' => '', 'country' => $this->input->post('country'),
                'action_text' => $this->input->post('action_name'), 'amount' => $amount, 'days' => $this->input->post('days'), 'heading' => $this->input->post('heading'), 'description' => $this->input->post('adv_desc'), 'link' => $this->input->post('url'), 'block_name' => $this->input->post('name'), 'approve' => 0, 'comments' => $this->input->post('desc'), 'viewport' => $this->input->post('viewport'), 'page' => $this->input->post('page'), 'image' => $img_name, 'video' => $vid_name, 'slider' => $slider_str, 'date' => date('d M Y'), 'time' => time());
            $this->dashboard_m->book_adv_block($adv_data);
            echo 'success';
        } else {
            echo validation_errors();
        }
    }
    
    public function payment_adv(){
        $amount = $this->session->userdata('adv_price') + $this->session->userdata('adv_days_price') + $this->session->userdata('adv_type_price');
        $this->load->library('paypal_lib');
        $returnURL = base_url().'dashboard/adv_success'; 
        $cancelURL = base_url().'dashboard/adv_cancel/adv'; 
        $notifyURL = base_url().'dashboard/ipn';
        $userID = $this->session->userdata('user_id'); 
        $logo = base_url().'assets/img/logo-orange.png';
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('cancel_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('item_name', 'WA Ad Booking');
        $this->paypal_lib->add_field('custom', $userID);
        $this->paypal_lib->add_field('item_number',  1); 
        $this->paypal_lib->add_field('amount',  $amount);        
        $this->paypal_lib->image($logo);
        $this->paypal_lib->paypal_auto_form();
    }
    
    public function adv_success(){
        $block_id = $this->session->userdata('block_id');
        $this->session->unset_userdata('adv_price');
        $this->session->unset_userdata('adv_days_price');
        $this->session->unset_userdata('adv_type_price');
        $this->session->unset_userdata('block_id');
        if(count($_POST) < 1 && !isset($_POST['item_number']) && !isset($_POST['txn_id'])) {
            redirect('dashboard/create_advertise');
        } else {
            $paypalInfo = $_POST;
            $data['user_id'] = $value['user_id'] = $this->session->userdata('user_id');
            $data['item_number'] = $value['item_number'] = $paypalInfo["item_number"];
            $data['txn_id'] = $value['txn_id'] = $paypalInfo["txn_id"];
            $data['payment_gross'] = $value['payment_gross'] = $paypalInfo["payment_gross"];
            $data['currency_code'] = $value['currency_code'] = $paypalInfo["mc_currency"];
            $data['payer_email'] = $value['payer_email'] = $paypalInfo["payer_email"];
            $data['payment_status'] = $value['payment_status'] = $paypalInfo["payment_status"];
            $value['date'] = date('d M Y');
            $value['time'] = time();
            $data['type'] = 'normal';
            $value['type'] = 'adv';
            if($data['payment_status'] == 'Completed' || $data['payment_status'] == 'Pending') {
                $status = $this->dashboard_m->insert_transaction($value, 'adv');
                if($status == 'Completed') {
                    $this->load->model('email_m');
                    $amount = $this->input->post('payment_gross').' '.$this->input->post('mc_currency');
                    $this->email_m->payment_adv_invoice($this->info->email, $amount, $data['txn_id']);
                    $block = $this->dashboard_m->get_user_advblock($this->session->userdata('user_id'), $block_id);
                    $this->email_m->adv_submission($block);
                }
                $data['view'] = 'dashboard/paypal/success-adv';
                $this->renderPage($data, 'dashboard');
            }
        }
    }
    
    public function adv_cancel($type = ''){
        $this->dashboard_m->delete_user_advblock($this->session->userdata('user_id'), $this->session->userdata('block_id'));
        $data['type'] = $type;
        $data['view'] = 'dashboard/paypal/cancel';
        $this->renderPage($data, 'dashboard');
    }
    
    public function adv_sidebar_module() {
        $pages_adv = array('worthact_initiatives', 'blog', 'joblisting' , 'profile', 'sos', 'timeline');
        if (in_array($this->uri->segment(2), $pages_adv)) {
            if($this->uri->segment(2) == 'timeline') {
                for($i = 1; $i < 7; $i++) {
                    $adv['block'.$i.'_global'] = $this->dashboard_m->get_page_side_advblocks('home', 'global', 'block_'.$i);
                }
                for($i = 1; $i < 7; $i++) {
                    $adv['block'.$i.'_local'] = $this->dashboard_m->get_page_side_advblocks('home', $this->info->country, 'block_'.$i);
                }
                return $adv;
            } else if($this->uri->segment(2) == 'sos') {
                for($i = 1; $i < 7; $i++) {
                    $adv['block'.$i.'_global'] = $this->dashboard_m->get_page_side_advblocks('worthact_initiatives', 'global', 'block_'.$i);
                }
                for($i = 1; $i < 7; $i++) {
                    $adv['block'.$i.'_local'] = $this->dashboard_m->get_page_side_advblocks('worthact_initiatives', $this->info->country, 'block_'.$i);
                }
                return $adv;
            } else {
                for($i = 1; $i < 7; $i++) {
                    $adv['block'.$i.'_global'] = $this->dashboard_m->get_page_side_advblocks($this->uri->segment(2), 'global', 'block_'.$i);
                }
                for($i = 1; $i < 7; $i++) {
                    $adv['block'.$i.'_local'] = $this->dashboard_m->get_page_side_advblocks($this->uri->segment(2), $this->info->country, 'block_'.$i);
                }
                return $adv;
            }
        }
    }
    
    public function adv_timeline_module($page, $block) {
        $adv['block_global'] = $this->dashboard_m->get_timeline_advblocks($page, 'global', $block);
        $adv['block_local'] = $this->dashboard_m->get_timeline_advblocks($page, $this->info->country, $block);
        if($adv['block_global'] != 'blah') { $adv['user'] = $this->dashboard_m->get_connection_info($adv['block_global']->user_id); }
        if($adv['block_local'] != 'blah') { $adv['user'] = $this->dashboard_m->get_connection_info($adv['block_local']->user_id); }
        if($page == 'home') { $this->load->view('dashboard/ads/block_timeline', $adv); }
        if($page == 'worthact_initiatives') { $this->load->view('dashboard/ads/block_post', $adv); }
        if($page == 'joblisting') { $this->load->view('dashboard/ads/block_job', $adv); }
    }
    
    /* Offers */
    public function offers() {
        if(1 == 2) {
            $data['js'] = array('clipboard.min.js');    
            $data['referral_status'] = $this->dashboard_m->get_referral_status($this->session->userdata('user_id'));
            $data['free_mems'] = $this->dashboard_m->get_invited_freemems();
            $data['pre_mems'] = $this->dashboard_m->get_invited_premems();
            $data['usage'] = $this->dashboard_m->get_user_usage();
            $data['sos'] = $this->user_post_count($this->session->userdata('user_id'));
            $data['allcat'] = $this->dashboard_m->get_category();
            $data['countries'] = $this->dashboard_m->get_country_list();
            $data['supports'] = $this->dashboard_m->get_support_list();
            $data['view'] = 'dashboard/offers';
            $this->renderPage($data, 'dashboard');
        } else {
            redirect(base_url());
        }
    }
    
    public function generate_referral_code() {
        $code = $this->referral_code();
        if($this->dashboard_m->check_referral_code($code) == 0) {
            $this->dashboard_m->insert_user_referral_code($code);
            echo $code;
        } else {
            $this->generate_referral_code();
        }
    }
    
    public function referral_code() {
        $char = 'ABCDEFGHIJKLMNOPQRSTUVXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $string = '';
        $max = strlen($char) - 1;
        for ($i = 0; $i < 5; $i++) {
             $string .= $char[mt_rand(0, $max)];
        }
        return $string;
    }

    /* CCAvenue Payment */
    public function ccAve_payment() {
        $amount = $this->input->post('amount');
        if($this->session->userdata('timezone') == 'Asia/Calcutta' || $this->session->userdata('timezone') == 'Asia/Kolkata') {
            if($this->info->type_id == 3 && $amount < 5000) {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Invalid amount entered</div>');
                redirect(base_url('dashboard/accounts'));
            }
            if($this->info->type_id != 3 && $amount < 650) {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Invalid amount entered</div>');
                redirect(base_url('dashboard/accounts'));
            }
            $data['order_info'] = array("merchant_id" => '130563',
                        "order_id" => 'WAPM'. time(),
                        "currency" => 'INR',
                        "amount" => $amount,
                        "redirect_url" => base_url('dashboard/ccAve_payment_done'),
                        "cancel_url" => base_url('dashboard/cancel'),
                        "language" => 'EN');
            $data['access_code'] = 'AVSZ70ED24BA58ZSAB';
            $data['working_key'] = 'C77C271062C375D07F22A78E1A657043';
            $data['action_url'] = 'https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction';
        } else {
            if($this->info->type_id == 3 && $amount < 280) {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Invalid amount entered</div>');
                redirect(base_url('dashboard/accounts'));
            }
            if($this->info->type_id != 3 && $amount < 10) {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Invalid amount entered</div>');
                redirect(base_url('dashboard/accounts'));
            }
            $data['order_info'] = array("merchant_id" => '44069',
                        "order_id" => 'WAPM'. time(),
                        "currency" => 'USD',
                        "amount" => $amount,
                        "redirect_url" => base_url('dashboard/ccAve_payment_done'),
                        "cancel_url" => base_url('dashboard/cancel'),
                        "language" => 'EN');
            $data['access_code'] = 'AVXZ02ED53BG14ZXGB';
            $data['working_key'] = '122F99FF0BA4535416F5D267C4477FCD';
            $data['action_url'] = 'https://secure.ccavenue.ae/transaction/transaction.do?command=initiateTransaction';
        }
        $this->load->view('dashboard/cc-avenue/ccavRequestHandler',$data);
    }
    
    public function ccAve_payment_upgrade() {
        $amount = $this->input->post('amount');
        if($this->session->userdata('timezone') == 'Asia/Calcutta' || $this->session->userdata('timezone') == 'Asia/Kolkata') {
            if($this->info->type_id == 3 && $amount < 5000) {
                $this->session->set_flashdata('msg_amount', '<div class="alert alert-danger" role="alert">Invalid amount entered</div>');
                redirect(base_url('dashboard/profile_update/3#payment-form'));
            }
            if($this->info->type_id != 3 && $amount < 650) {
                $this->session->set_flashdata('msg_amount', '<div class="alert alert-danger" role="alert">Invalid amount entered</div>');
                redirect(base_url('dashboard/profile_update/3#payment-form'));
            }
            $data['order_info'] = array("merchant_id" => '130563',
                        "order_id" => 'WAPM'. time(),
                        "currency" => 'INR',
                        "amount" => $amount,
                        "redirect_url" => base_url('dashboard/ccAve_payment_done'),
                        "cancel_url" => base_url('dashboard/cancel/upgrade'),
                        "language" => 'EN');
            $data['access_code'] = 'AVSZ70ED24BA58ZSAB';
            $data['working_key'] = 'C77C271062C375D07F22A78E1A657043';
            $data['action_url'] = 'https://secure.ccavenue.com/transaction/transaction.do?command=initiateTransaction';
        } else {
            if($this->info->type_id == 3 && $amount < 280) {
                $this->session->set_flashdata('msg_amount', '<div class="alert alert-danger" role="alert">Invalid amount entered</div>');
                redirect(base_url('dashboard/profile_update/3#payment-form'));
            }
                if($this->info->type_id != 3 && $amount < 10) {
                $this->session->set_flashdata('msg_amount', '<div class="alert alert-danger" role="alert">Invalid amount entered</div>');
                redirect(base_url('dashboard/profile_update/3#payment-form'));
            }
            $data['order_info'] = array("merchant_id" => '44069',
                        "order_id" => 'WAPM'. time(),
                        "currency" => 'USD',
                        "amount" => $amount,
                        "redirect_url" => base_url('dashboard/ccAve_payment_done'),
                        "cancel_url" => base_url('dashboard/cancel/upgrade'),
                        "language" => 'EN');
            $data['access_code'] = 'AVXZ02ED53BG14ZXGB';
            $data['working_key'] = '122F99FF0BA4535416F5D267C4477FCD';
            $data['action_url'] = 'https://secure.ccavenue.ae/transaction/transaction.do?command=initiateTransaction';
        }
        $this->load->view('dashboard/cc-avenue/ccavRequestHandler',$data);
    }
    
    public function ccAve_payment_done() {
        include APPPATH . 'libraries/Crypto.php';
	error_reporting(0);
	$workingKey = ($this->session->userdata('timezone') == 'Asia/Calcutta' || $this->session->userdata('timezone') == 'Asia/Kolkata')? 'C77C271062C375D07F22A78E1A657043' : '122F99FF0BA4535416F5D267C4477FCD';		
	$encResponse = $_POST["encResp"];			
	$rcvdString=decrypt($encResponse,$workingKey);		
	$order_status="";
	$decryptValues=explode('&', $rcvdString);
	$dataSize=sizeof($decryptValues);
	for($i = 0; $i < $dataSize; $i++)  {
            $information=explode('=',$decryptValues[$i]);
            if($i==3) {
                    $order_status=$information[1];
            }
	}
        $data['user_id'] = $value['user_id'] = $this->session->userdata('user_id');
	for($i = 0; $i < $dataSize; $i++) {
            $information=explode('=',$decryptValues[$i]);
            $data[$information[0]] = $information[1];
	}
        $value['order_id'] = $data['order_id'];
        $value['tracking_id'] = $data['tracking_id'];
        $value['amount'] = $data['amount'];
        $value['currency'] = $data['currency'];
        $value['billing_email'] = $data['billing_email'];
        $value['order_status'] = $data['order_status'];
        $value['date'] = date('d M Y');
        $value['time'] = time();
        $value['status_code'] = $data['status_code'];
        $value['status_message'] = $data['status_message'];
        $value['failure_message'] = $data['failure_message'];
        if($order_status == 'Success' || $order_status == 'Failure' || $order_status == 'Aborted' || $order_status == 'Invalid') {
            $status = $this->dashboard_m->insert_transaction_ccave($value);
            if($status == 'Success') {
                $this->load->model('email_m');
                $amount = $data['amount'].' '.$data['currency'];
                $this->email_m->payment_invoice($this->info->email, $amount, $data['tracking_id']);
            }
            $data['view'] = 'dashboard/cc-avenue/success';
            $this->renderPage($data, 'dashboard');
        }
    }
    
    /* Android Notification */
    public function sendMessage($user_id, $msg) {
        $to = $this->dashboard_m->get_tokenkey($user_id);
        if($to != '') {
            define( 'API_ACCESS_KEY', 'AAAA-fq2eDQ:APA91bHUGpafOIBs3QZ-VRBsd0FLLnGecssCn63o4V-1gLIr2XDULCT0tW6RNLtqHHKqE2raw7SRBzpvfJ_Tnr7yU1j7AjEdvuUXBh_OSdcAmAtqWKjcK1fmg-NX9bplXz6J6PCBLUfw' );
            $fields = array (
                'to' => $to,
                'notification' => $msg
            );
            $headers = array (
                'Authorization: key=' . API_ACCESS_KEY,
                'Content-Type: application/json'
            );
            $ch = curl_init();
            curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
            curl_setopt( $ch,CURLOPT_POST, true );
            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
            $result = curl_exec($ch );
            curl_close( $ch );
        }
    }
    
    /* Placeholder */
    public function get_placeholder($user_id) {
        $type = $this->dashboard_m->get_connection_info($user_id)->type_id;
        return ($type == 1)? 'user_placeholder.png' : 'company_placeholder.png';
    }
    
    /* SESO */
    public function seso() {
        if($this->info->type_id != 3 && ($this->session->userdata('timezone') == 'Asia/Calcutta' || $this->session->userdata('timezone') == 'Asia/Kolkata')) {
            $data['css'] = array('editor.css');
            $data['js'] = array('editor.js');
            $data['status'] = $this->dashboard_m->user_seso_status();
            $data['view'] = 'dashboard/seso';
            $this->renderPage($data);
        } else {
            redirect(base_url());
        }
    }

    public function submit_seso_essay() {
        $status = $this->dashboard_m->user_seso_status();
        if($status == 'null') {
            $this->form_validation->set_rules('school', 'School / College name', 'trim|required');
            $this->form_validation->set_rules('class', 'Class', 'trim|required');
            $this->form_validation->set_rules('age', 'Age', 'trim|required');
            $this->form_validation->set_rules('number', 'Number', 'trim|required|numeric|min_length[10]');
        }
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_rules('topic', 'Topic', 'trim|required');
        $this->form_validation->set_rules('editor_blog', 'Content', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $tags = ($this->input->post('tags') != '') ? implode(',', $this->input->post('tags')) : '';
            $this->load->library('upload');
            $file = '';
            if (isset($_FILES['file']['name'])) {
                $config['upload_path'] = './assets/userdata/dashboard/seso';
                $tmp3 = explode('.', $_FILES['file']['name']);
                $ext3 = end($tmp3);
                $file = date("ymd") . time() . '.' . strtolower($ext3) ;
                $config['file_name'] = $file;
                $config['allowed_types'] = 'jpg|png|jpeg';
                $this->upload->initialize($config);
                if (!$this->upload->do_upload('file')) { 
                    echo $this->upload->display_errors(); 
                    exit(); 
                } else {
                    $this->image_resize($file, 'blog');
                }
            }
            if($status == 'null') {
                $data = array('essay_topic' => $this->input->post('topic'), 'contact' => $this->input->post('number'), 'age' => $this->input->post('age'), 'class' => $this->input->post('class'), 'school' => $this->input->post('school'), 'user_id' => $this->session->userdata('user_id'), 'essay_title' => $this->input->post('title'), 'essay_content' => $this->input->post('editor_blog'), 'essay_tags' => $tags, 'essay_banner' => $file, 'essay_date' => date('d M Y'), 'essay_time' => time());
            } else {
                $data = array('essay_topic' => $this->input->post('topic'), 'user_id' => $this->session->userdata('user_id'), 'essay_title' => $this->input->post('title'), 'essay_content' => $this->input->post('editor_blog'), 'essay_tags' => $tags, 'essay_banner' => $file, 'essay_date' => date('d M Y'), 'essay_time' => time());
            }
            $this->dashboard_m->insert_essay($data);
            $this->load->model('email_m');
            $this->email_m->seso_essay($data);
            $this->session->set_flashdata('seso_success', 1);
            echo 'success';
        } else {
            echo validation_errors();
        }
    }
    
    public function submit_seso_drawing() {
        $status = $this->dashboard_m->user_seso_status();
        if($status == 'null') {
            $this->form_validation->set_rules('school', 'School / College name', 'trim|required');
            $this->form_validation->set_rules('class', 'Class', 'trim|required');
            $this->form_validation->set_rules('age', 'Age', 'trim|required');
            $this->form_validation->set_rules('number', 'Number', 'trim|required|numeric|min_length[10]');
        }
        $this->form_validation->set_rules('topic', 'Topic', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            if(count($_FILES) !== 0) {
                $tags = ($this->input->post('tags') != '') ? implode(',', $this->input->post('tags')) : '';
                $this->load->library('upload');
                $this->load->model('email_m');
                $config['upload_path'] = './assets/userdata/dashboard/seso/';
                for($i = 0; $i < count($_FILES); $i++) {
                    $tmp3 = explode('.', $_FILES['file'.$i]['name']);
                    $ext3 = end($tmp3);
                    $file = date("ymd") . (time()+$i) . '.' . strtolower($ext3) ;
                    $config['file_name'] = $file;
                    $config['allowed_types'] = 'jpg|png|jpeg';
                    $this->upload->initialize($config);
                    if($this->upload->do_upload('file'.$i)){ $tmp_ary[] = $file; }
                }
                $file_str = implode(',', $tmp_ary);
                if($status == 'null') {
                    $data = array('drawing_topic' => $this->input->post('topic'), 'contact' => $this->input->post('number'), 'age' => $this->input->post('age'), 'class' => $this->input->post('class'), 'school' => $this->input->post('school'), 'user_id' => $this->session->userdata('user_id'), 'drawing_title' => $this->input->post('title'), 'drawing_content' => $this->input->post('desc'), 'drawing_tags' => $tags, 'sketch' => $file_str, 'drawing_time' => time(), 'drawing_date' => date('d M Y'));
                } else {
                    $data = array('drawing_topic' => $this->input->post('topic'), 'user_id' => $this->session->userdata('user_id'), 'drawing_title' => $this->input->post('title'), 'drawing_content' => $this->input->post('desc'), 'drawing_tags' => $tags, 'sketch' => $file_str, 'drawing_time' => time(), 'drawing_date' => date('d M Y'));
                }
                ($file_str != '') ? $this->dashboard_m->insert_drawing($data) : '';
                ($file_str != '') ? $this->email_m->seso_drawing($data) : '';
                $this->session->set_flashdata('seso_success', 1);
                echo 'success';
            } else { 
                echo 'Please add your drawing.';
            }
        } else {
            echo validation_errors();
        }
    }

    /* Page Render */
    public function renderPage($data, $type = 'dashboard') {
        switch ($type) {
            case 'dashboard' : $this->load->view('templates/layouts/dashboard_layout', $data);
                break;
        }
    }
    
}

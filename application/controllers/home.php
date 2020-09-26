<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('home_m');
        //$this->reminder();
        $this->reset_db();
        if ($this->uri->segment(2) != 'confirm_email' && $this->uri->segment(2) != 'register_offer' && $this->uri->segment(2) != 'insert_token' && $this->uri->segment(2) != 'approve_adv_booking' && $this->uri->segment(2) != 'delete_adv_booking' && $this->uri->segment(2) != 'free_user_upgrade' && $this->uri->segment(2) != 'deny_free_user_upgrade') {
            $this->logged_in();
        }
    }

    /* Home */
    public function index() {
        if($this->input->get('r') != '') {
            $data['reference'] = $this->input->get('r');
        } else {
            $data['reference'] = '';
        }      
        $data['title'] = 'WorthAct - For a better world';
        $data['keywords'] = 'Afforestation,Animal Care,Cancer Care,Organ donation,Drought Resistance,Preservation of water bodies,Prevention of pollution ,Rural Development,Waste management';
        $data['description'] = 'WorthAct initiatives is a humble effort to join forces of conscientious people who work for sustainability of this planet.';
        $data['view'] = 'home/index';
        $data['usertypes'] = $this->home_m->get_usertype();
        $this->renderPage($data);
    }

    /* Login */
    public function login() {
        if ($this->input->post('email') != '') {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('pass', 'Pass', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $user_email = $this->input->post('email');
                $actual_pwd = $this->input->post('pass');
                $salt = $this->home_m->get_salt($user_email);
                if($salt) {
                    $salted_pwd =  $actual_pwd . $salt;
                    $hashed_pwd = hash('sha256', $salted_pwd);
                    $cond = $this->home_m->validate_user($user_email, $hashed_pwd);
                    switch($cond) {
                        case 'success' : echo 'success';
                            break;
                        case 'not_active' : $this->session->set_userdata('register-email', $this->input->post('email')); echo 'not_active';
                            break;
                        case 'invalid' : echo 'invalid';
                            break;
                    }
                } else {
                    echo 'invalid';
                }
            } else {
                echo 'error';
            }
            exit();
        }
        $data['key'] = $this->input->get('key');
        $data['title'] = 'WorthAct - Login';
        $data['keywords'] = 'Afforestation,Animal Care,Cancer Care,Organ donation,Drought Resistance,Preservation of water bodies,Prevention of pollution ,Rural Development,Waste management';
        $data['description'] = 'To create a generation of selfless world conscious about their social responsibility to preserve the natural resources, protect the environment and support the needy through worthy actions.';
        $data['status'] = $this->input->get('status');
        $data['view'] = 'home/login';
        $this->renderPage($data, 'home');
    }
    
    /* login check */
    public function logged_in() {
        if($this->session->has_userdata('key') && $this->session->has_userdata('user_id')) {
            if($this->home_m->check_login($this->session->userdata('user_id'), $this->session->userdata('key'))) {
                redirect(base_url('dashboard'));
            }
        } else if($this->input->cookie('wa_e', TRUE) != '' && $this->input->cookie('wa_i', TRUE) != '' && $this->input->cookie('wa_l', TRUE) != '' && $this->input->cookie('wa_t', TRUE) != '' && $this->input->cookie('wa_k', TRUE) != '') {
            if($this->home_m->check_cookies($this->input->cookie('wa_e', TRUE), $this->input->cookie('wa_i', TRUE), $this->input->cookie('wa_l', TRUE), $this->input->cookie('wa_t', TRUE), $this->input->cookie('wa_k', TRUE))) {
                redirect(base_url('dashboard'));
            }
        }
    }
    
    /* Forgot password */
    public function forgot_pwd() {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        if ($this->form_validation->run() == TRUE) {
            $email = $this->input->post('email');
            $salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM)).time();
            $key = sha1(time() . $salt);
            if($this->home_m->isPresent($email, $key)) {
                $name = $this->home_m->get_username($email);
                $this->load->model('email_m');
                $this->email_m->password_reset($email, $key, $name);
                echo 'success';
            } else {
                echo 'not found';
            }
        } else {
            echo validation_errors();
        }
    }
    
    /* Reset password */
    public function reset_password() {
        $this->form_validation->set_rules('pass', 'Pass', 'trim|required');
        $this->form_validation->set_rules('key', 'Key', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $actual_pwd = $this->input->post('pass');
            $key = $this->input->post('key');
            $salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM)).time();
            $salted_pwd = $actual_pwd . $salt;
            $hashed_pwd = hash('sha256', $salted_pwd);
            if($this->home_m->reset_password($hashed_pwd, $salt, $key)) {
                $this->session->set_flashdata('msg', '<div style="display: block" class="alert alert-info alert-reset">Password successfully updated. Login now.</div>');
                echo 'success';
            } else {
                echo 'invalid';
            }
        } else {
            echo validation_errors();
        }
    }

    /* About */
    public function about() {
        $data['title'] = 'WorthAct - About';
        $data['keywords'] = 'Eco-friendly homes Women Empowerment & Child WelfarePreservation of water bodies,Prevention of pollution ,Rural Development,Waste management, Animal Care';
        $data['description'] = 'Play a major role to influence the societies in large for actions to protect the Environment, preserve the natural resources, support the needy and sustain this planet better.';
        $data['view'] = 'home/about';
        $this->renderPage($data);
    }
    
    /* Aim */
    public function aim() {
        $data['title'] = 'WorthAct - Aim';
        $data['keywords'] = 'Eco-friendly homes Women Empowerment & Child WelfarePreservation of water bodies,Prevention of pollution ,Rural Development,Waste management, Animal Care';
        $data['description'] = 'Play a major role to influence the societies in large for actions to protect the Environment, preserve the natural resources, support the needy and sustain this planet better.';
        $data['view'] = 'home/aim';
        $this->renderPage($data);
    }
    
    /* Privacy Policy */
    public function privacy_policy() {
        $data['title'] = 'WorthAct - Privacy Policy';
        $data['keywords'] = 'worthact,worthact privacy policy,login,sigin';
        $data['description'] = 'This privacy policy applies to worthact.com which is part of Worthact Initiatives Preparations.';
        $data['view'] = 'home/privacy';
        $this->renderPage($data);
    }
    
    /* Terms & Conditions */
    public function terms_and_conditions() {
        $data['title'] = 'WorthAct - Terms & Conditions';
        $data['keywords'] = 'worthact,worthact Terms and Conditions,login,sigin';
        $data['description'] = 'We are happy to have you with us at worthact.com services. By using our services and products you are agreeing to our terms, hence please take a few minutes to read over the User agreement below.';
        $data['view'] = 'home/terms';
        $this->renderPage($data);
    }
    
    /* About */
    public function contact_us() {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('sub', 'Subject', 'trim|required');
        $this->form_validation->set_rules('msg', 'Message', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $this->load->model('email_m');
            $this->email_m->contact($this->input->post('email'), $this->input->post('name'), $this->input->post('sub'), $this->input->post('msg'));
            echo 'success';
        } else {
            echo validation_errors();
        }
    }
    
    /* Worthact Initiatives */
    public function worthact_initiatives() {
        $data['title'] = 'WorthAct - Initiatives';
        $data['keywords'] = 'Afforestation,Animal Care,Cancer,Care Organ donation,Drought Resistance,Preservation of water bodies,Prevention of pollution,Rural Development,Waste management';
        $data['description'] = 'There is room for everyone in this world. The good earth is rich and can provide for everyone. Life that can be beautiful has lost its way by the greed that has poisoned our souls';
        $data['view'] = 'home/wa-initiatives';
        $this->renderPage($data);
    }
    
    public function afforestation() {
        $data['title'] = 'WorthAct - Afforestation - Causes of Afforestation';
        $data['keywords'] = 'afforestation definition,afforestation advantages,afforestation and its importance,afforestation and climate change,afforestation causes,afforestation essay,effects afforestation';
        $data['description'] = 'Have you ever tried imagining how our earth would be, if there were no more trees? Exactly! There would be nothing left to imagine, not only because there would not be any more production of papers or wooden products, but because they serve a vital role in the carbon cycle.';
        $data['view'] = 'home/afforestation';
        $this->renderPage($data);
    }
    
    public function animal_care() {
        $data['title'] = 'WorthAct -  Animal Care - what is animal welfare';
        $data['keywords'] = 'animal care information,what is animal care,animal care centre,animal rescue,animal care trust,animal welfare facts,animal rights,animal protection';
        $data['description'] = 'Animals have always played an important role in the lives of humanity since a very long time. The connection between animals and humans is one of the most fundamental bonds that can ever be experienced.';
        $data['view'] = 'home/animal-care';
        $this->renderPage($data);
    }
    
    public function cancer_care() {
        $data['title'] = 'WorthAct – Cancer Care - Cancer care for life - Free care';
        $data['keywords'] = 'cancer care financial assistance,cancer support team,cancer care services,cancer support foundation,cancer care home,cancer care uae,cancer care india';
        $data['description'] = 'Prevention is better than cure. However, in life many things happen unexpectedly, especially health issues. But with timely consulting and healthy lifestyle, majority of them can be avoided or at least regulated.';
        $data['view'] = 'home/cancer-care';
        $this->renderPage($data);
    }
    
    public function organ_donation() {
        $data['title'] = 'WorthAct - Organ Donation';
        $data['keywords'] = 'organ donation statistics,organ donation stories,organ donation facts,benefits of organ donation,organ donation myths,organ donation essay';
        $data['description'] = 'There is nothing noble than saving another life.';
        $data['view'] = 'home/organ-donation';
        $this->renderPage($data);
    }
    
    public function drought_resistance() {
        $data['title'] = 'WorthAct - Drought Resistance';
        $data['keywords'] = 'drought resistant crops list,naturally drought resistant crops,drought resistant crops in india,drought resistant plants,drought resistant grass';
        $data['description'] = 'Water is the second among fundamental natural resources that should be preserved after oxygen or clean air.';
        $data['view'] = 'home/drought-resistance';
        $this->renderPage($data);
    }
    
    public function preserve_water() {
        $data['title'] = 'WorthAct - Preserve Water';
        $data['keywords'] = 'how to preserve water resources,how to preserve water for long term storage,protection of water bodies,conservation of water bodies,5 ways to preserve nature';
        $data['description'] = 'Many a drop make an ocean, we all are familiar with this proverb. Similarly every bit of help counts.';
        $data['view'] = 'home/water-bodies';
        $this->renderPage($data);
    }
    
    public function rural_development() {
        $data['title'] = 'WorthAct - Rural Development';
        $data['keywords'] = 'rural development course,departments for rural development,rural development india,rural india development,rural development board';
        $data['description'] = 'Studies show that no planning can be successful unless more and more attention is paid to rural development schemes and poverty alleviation programs.';
        $data['view'] = 'home/rural-development';
        $this->renderPage($data);
    }
    
    public function waste_management() {
        $data['title'] = 'WorthAct - Waste Management';
        $data['keywords'] = 'waste mgmt,waste mgt,waste manag,waste and disposal services,waste removal services,solid waste management,waste management locations,chemical waste management';
        $data['description'] = 'Wastes are not created for any purpose in the market. Wastes are created at an early stage from the extraction of raw materials till the disposal of the product';
        $data['view'] = 'home/waste-management';
        $this->renderPage($data);
    }
    
    public function eco_friendly_homes() {
        $data['title'] = 'WorthAct - Eco Friendly Homes';
        $data['keywords'] = 'eco friendly house materials,eco friendly house model,eco friendly houses information,eco friendly house designs,eco friendly house project,what is an eco house';
        $data['description'] = 'Materials used such as concrete and tiles can create wastes that make the air, water and earth polluted and incapable of sustaining life.';
        $data['view'] = 'home/ecofriendly-homes';
        $this->renderPage($data);
    }
    
    public function women_child_welfare() {
        $data['title'] = 'WorthAct - Women Child Welfare';
        $data['keywords'] = 'introduction women child welfare,women and child welfare in india,women welfare in india,child welfare programmes,children and women welfare';
        $data['description'] = 'Women and children are pushed backstage in most of the societies, considering them to be weak and incapable.';
        $data['view'] = 'home/women-child-welfare';
        $this->renderPage($data);
    }

    /* Free Register */
    public function register() {
        if ($this->input->post('usertype') != '') {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user_details.email]');
            $this->form_validation->set_message('is_unique', 'Email id already taken.');
            $this->form_validation->set_rules('usertype', 'User Type', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $actual_pwd = $this->input->post('password');
                $salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM)).time();
                $salted_pwd = $actual_pwd . $salt;
                $hashed_pwd = hash('sha256', $salted_pwd);
                $key = sha1(time() . $salt);
                $data = array(
                    'email' => $this->input->post('email'),
                    'password' => $hashed_pwd,
                    'salt' => $salt,
                    'type_id' => $this->input->post('usertype'),
                    'newsletter' => 1,
                    'is_active' => 1,
                    'status_key' => $key,
                    'is_complete' => -1,
                    'email_valid' => 0,
                    'time' => time(),
                    'date' => date('d M Y')
                );
                $id = $this->home_m->insert_user($data);
                $this->home_m->email_list_counter($this->input->post('email'));
                if($this->input->post('ref') != '') { $this->home_m->insert_reference($id, $this->input->post('ref')); }
                $user_email = $this->input->post('email');
                $salt = $this->home_m->get_salt($user_email);
                if($salt) {
                    $salted_pwd =  $actual_pwd . $salt;
                    $hashed_pwd = hash('sha256', $salted_pwd);
                    $cond = $this->home_m->validate_user($user_email, $hashed_pwd);
                    if($cond == 'success') {
                        echo 'success';
                    } else {
                        echo 'Error occured. Please try again.';
                    }
                }
            } else {
                echo validation_errors();
            }
        } else {
            echo 'type_fail';
        }
    }
    
    public function register_offer() {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[user_details.email]');
        $this->form_validation->set_message('is_unique', 'Email id already taken.');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $actual_pwd = $this->input->post('password');
            $salt = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM)).time();
            $salted_pwd = $actual_pwd . $salt;
            $hashed_pwd = hash('sha256', $salted_pwd);
            $key = sha1(time() . $salt);
            $data = array(
                'email' => $this->input->post('email'),
                'password' => $hashed_pwd,
                'salt' => $salt,
                'type_id' => 1,
                'newsletter' => 1,
                'is_active' => 1,
                'status_key' => $key,
                'is_complete' => -1,
                'email_valid' => 0,
                'time' => time(),
                'date' => date('d M Y')
            );
            $id = $this->home_m->insert_user($data);
            $this->home_m->email_list_counter($this->input->post('email'));
            if($this->input->post('ref') != '') { $this->home_m->insert_reference($id, $this->input->post('ref')); }
            $this->session->set_userdata('enroll', 1);
            $user_email = $this->input->post('email');
            $salt = $this->home_m->get_salt($user_email);
            if($salt) {
                $salted_pwd =  $actual_pwd . $salt;
                $hashed_pwd = hash('sha256', $salted_pwd);
                $cond = $this->home_m->validate_user($user_email, $hashed_pwd);
                if($cond == 'success') {
                    echo 'success';
                } else {
                    echo 'Error occured. Please try again.';
                }
            }           
        } else {
            echo validation_errors();
        }
    }
    
    public function registration_success() {
        $data['title'] = 'WorthAct - For a better world';
        $data['keywords'] = 'Afforestation,Animal Care,Cancer Care,Organ donation,Drought Resistance,Preservation of water bodies,Prevention of pollution ,Rural Development,Waste management';
        $data['description'] = 'WorthAct initiatives is a humble effort to join forces of conscientious people who work for sustainability of this planet.';
        $data['view'] = 'home/reg_success';
        $this->renderPage($data);
    }


    /* Validate Email */
    public function validateemail() {
        $this->form_validation->set_rules('email', 'Email', 'is_unique[user_details.email]');
        if ($this->form_validation->run() == FALSE) {
            echo 'invalid';
        }
    }

    /* Confirmation Email */
    public function confirm_email($key) {
        
        if($key != '' && $this->home_m->confirm_email($key)) {
            
           
            
            redirect(base_url('dashboard'));
        } else {
            redirect(base_url());
        }
    }
    
    /* Timezone */
    public function set_timezone() {
        $timezone = $this->input->post('timezone');
        date_default_timezone_set($timezone);
        $this->session->set_userdata('timezone', $timezone);
        echo $timezone;
    }
    
    /* Reminder */
    public function reminder() {
        $flag = $this->home_m->get_reminder_flag();
        $flag_day = $this->home_m->get_day_flag();
        if($flag == 0) {
            $this->home_m->update_reminder_flag(1);
            $this->load->model('email_m');
            $incomplete_users = $this->home_m->profile_incomplete_list();
            $pro_reminder = $this->home_m->profile_incomplete_reminder();
            if (strtotime('+ 10 days', $pro_reminder->time) < time()) {
                if(count($incomplete_users) > 0) {
                    foreach($incomplete_users as $user) {
                        $this->email_m->reminder_profile_incomplete($user->email);
                    }
                }
                $this->home_m->update_profile_incomplete_reminder();
            }
            $active_free_users = $this->home_m->active_free_users('1', '');
            if (date('d') == 10 || date('d') == 20) {
                if(count($active_free_users) > 0 && $flag_day == 0) {
                    foreach($active_free_users as $user) {
                        if(date('d') == 10 && $this->home_m->active_free_users('', $user->id) > 12) {
                            $this->email_m->reminder_active_free_upgrade($user->email, ucfirst($user->username));
                        }
                        if(date('d') == 20 && $this->home_m->active_free_users('', $user->id) > 22) {
                            $this->email_m->reminder_active_free_upgrade($user->email, ucfirst($user->username));
                        }
                    }
                    $this->home_m->update_day_flag();
                }
            }
            $inactive_free_users = $this->home_m->inactive_free_users('1', '');
            if (date('d') == 11 || date('d') == 21) {
                if(count($inactive_free_users) > 0 && $flag_day == 0) {
                    foreach($inactive_free_users as $user) {
                        if(date('d') == 11 && $this->home_m->inactive_free_users('', $user->id) < 8) {
                            $this->email_m->reminder_inactive_free_user($user->email, ucfirst($user->username));
                        }
                        if(date('d') == 21 && $this->home_m->inactive_free_users('', $user->id) < 14) {
                            $this->email_m->reminder_inactive_free_user($user->email, ucfirst($user->username));
                        }
                    }
                    $this->home_m->update_day_flag();
                }
            }
            $inactive_pre_users = $this->home_m->inactive_pre_users('1', '');
            if (date('d') == 12 || date('d') == 26) {
                if(count($inactive_pre_users) > 0 && $flag_day == 0) {
                    foreach($inactive_pre_users as $user) {
                        if(date('d') == 12 && $this->home_m->inactive_pre_users('', $user->id) < 12) {
                            $this->email_m->reminder_inactive_pre_user($user->email, ucfirst($user->username));
                        }
                        if(date('d') == 26 && $this->home_m->inactive_pre_users('', $user->id) < 22) {
                            $this->email_m->reminder_inactive_pre_user($user->email, ucfirst($user->username));
                        }
                    }
                    $this->home_m->update_day_flag();
                }
            }
            $job_users = $this->home_m->job_rem_users('1', '');
            if (date('d') == 8 || date('d') == 15 || date('d') == 27) {
                if(count($job_users) > 0 && $flag_day == 0) {
                    foreach($job_users as $user) {
                        if($this->home_m->job_rem_users('', $user->main_id) == 0) {
                            $this->email_m->job_portal_reminder($user->email, ucfirst($user->username));
                        }
                    }
                    $this->home_m->update_day_flag();
                }
            }
            $wi_users = $this->home_m->wi_rem_users('1', '');
            if (date('d') == 13 || date('d') == 22) {
                if(count($wi_users) > 0 && $flag_day == 0) {
                    foreach($wi_users as $user) {
                        if($this->home_m->wi_rem_users('', $user->main_id) == 0) {
                            $this->email_m->wi_reminder($user->email, ucfirst($user->username));
                        }
                    }
                    $this->home_m->update_day_flag();
                }
            }
            $invited_users = $this->home_m->invited_users('1', '');
            $invitation_reminder = $this->home_m->invitation_reminder();
            if (strtotime('+ 12 days', $invitation_reminder->time) < time()) {
                if(count($invited_users) > 0) {
                    foreach($invited_users as $user) {
                        if($this->home_m->invited_users('', $user->email_id) == 0) {
                            $this->email_m->reminder_invitation($user->email_id);
                        }
                    }
                }
                $this->home_m->update_invitation_reminder();
            }
            $this->home_m->update_reminder_flag(0);
        }
    }
    
    /* Reset Db */
    public function reset_db() {
        $this->home_m->reset_conn_email_db();
        $this->home_m->reset_day_flag();
    }
    
    /* Premium Membership */
    public function premium_membership() {
        $data['title'] = 'WorthAct - Premium Membership';
        $data['keywords'] = 'premium,membership,premium_membership';
        $data['description'] = 'Registration and utilization of WorthAct platform is absolutely free. However, we provide an option to become a premium member with a nominal fee to avail additional features.';
        $data['view'] = 'home/premium-membership';
        $this->renderPage($data);
    }
    
    /* Advertise */
    public function approve_adv_booking() {
        if($this->input->get('u_id') != '' && $this->input->get('b_id') != '') {
            if($this->home_m->approve_adv_booking($this->home_m->decrypt($this->input->get('u_id')), $this->home_m->decrypt($this->input->get('b_id')))) {
                $this->load->model('email_m');
                $user = $this->home_m->get_connection_info($this->home_m->decrypt($this->input->get('u_id')));
                $this->email_m->notify_adv_approve($user);
                $data['type'] = 'approve';
                $data['title'] = 'WorthAct - For a Better World';
                $data['keywords'] = 'Afforestation,Animal Care,Cancer Care,Organ donation,Drought Resistance,Preservation of water bodies,Prevention of pollution ,Rural Development,Waste management';
                $data['description'] = 'WorthAct initiatives is a humble effort to join forces of conscientious people who work for sustainability of this planet.';
                $data['view'] = 'home/adv-action';
                $this->renderPage($data);
            }
        } else {
            redirect(base_url());
        }
    }
    
    public function delete_adv_booking() {
        if($this->input->get('u_id') != '' && $this->input->get('b_id') != '') {
            if($this->home_m->delete_adv_booking($this->home_m->decrypt($this->input->get('u_id')), $this->home_m->decrypt($this->input->get('b_id')))) {
                $this->load->model('email_m');
                $user = $this->home_m->get_connection_info($this->home_m->decrypt($this->input->get('u_id')));
                $this->email_m->notify_adv_delete($user);
                $data['type'] = 'reject';
                $data['title'] = 'WorthAct - For a Better World';
                $data['keywords'] = 'Afforestation,Animal Care,Cancer Care,Organ donation,Drought Resistance,Preservation of water bodies,Prevention of pollution ,Rural Development,Waste management';
                $data['description'] = 'WorthAct initiatives is a humble effort to join forces of conscientious people who work for sustainability of this planet.';
                $data['view'] = 'home/adv-action';
                $this->renderPage($data);
            }
        } else {
            redirect(base_url());
        }
    }
    
    /* Free Upgrade */
    public function free_user_upgrade() {
        if($this->input->get('u_id') != '') {
            $this->home_m->free_user_upgrade($this->home_m->decrypt($this->input->get('u_id')));
            $this->load->model('email_m');
            $user = $this->home_m->get_connection_info($this->home_m->decrypt($this->input->get('u_id')));
            $this->email_m->notify_free_upgrade_success($user);
            $data['type'] = 'upgrade';
            $data['title'] = 'WorthAct - For a Better World';
            $data['keywords'] = 'Afforestation,Animal Care,Cancer Care,Organ donation,Drought Resistance,Preservation of water bodies,Prevention of pollution ,Rural Development,Waste management';
            $data['description'] = 'WorthAct initiatives is a humble effort to join forces of conscientious people who work for sustainability of this planet.';
            $data['view'] = 'home/adv-action';
        }
    }
    
    public function deny_free_user_upgrade() {
        if($this->input->get('u_id') != '') {
            $this->home_m->deny_free_user_upgrade($this->home_m->decrypt($this->input->get('u_id')));
            $this->load->model('email_m');
            $user = $this->home_m->get_connection_info($this->home_m->decrypt($this->input->get('u_id')));
            $this->email_m->deny_free_user_upgrade($user);
            $data['type'] = 'deny';
            $data['title'] = 'WorthAct - For a Better World';
            $data['keywords'] = 'Afforestation,Animal Care,Cancer Care,Organ donation,Drought Resistance,Preservation of water bodies,Prevention of pollution ,Rural Development,Waste management';
            $data['description'] = 'WorthAct initiatives is a humble effort to join forces of conscientious people who work for sustainability of this planet.';
            $data['view'] = 'home/adv-action';
        }
    }
    
    public function insert_token() {
        $cookie = $this->input->get('c');
        $token = $this->input->get('t');
        $user_id = $this->home_m->decrypt($cookie);
        $this->home_m->insert_user_token($user_id, $token);
    }
    
    public function blast_email_3() {
        $this->load->model('email_m');
        $bla = $this->home_m->wi_rem_users('1', '');
        if(count($bla) > 0) {
            foreach($bla as $user) {
                $this->email_m->outside_india($user->email, $user->username);
            }
        }
        redirect(base_url());
    }
    
    public function renderPage($data, $type = 'home') {
        switch ($type) {
            case 'home' : $this->load->view('templates/layouts/home_layout', $data);
                break;
        }
    }

}

<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home_m extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /* Home */
    public function get_usertype() {
        return $this->db->get('user_types')->result();
    }

    public function get_salt($email) {
        $this->db->select('salt');
        $this->db->from('user_details');
        $this->db->where('email', $email);
        $query = $this->db->get();
        $result = $query->result();
        if ($query->num_rows() > 0) {
            return $result[0]->salt;
        } else {
            return FALSE;
        }
    }

    public function insert_user($data) {
        $this->db->insert('user_details', $data);
        return $this->db->insert_id();
    }
    
    public function email_list_counter($email) {
        if($this->db->get_where('email_list', array('email' => $email))->num_rows() != 0) {
            $val = (int)$this->db->get_where('reminder', array('type' => 7))->row()->time + 1 ;
            $this->db->where('type', 7);
            $this->db->update('reminder', array('time' => $val));
        }
    }

    public function insert_reference($id, $reference_id) {
        $this->db->insert('reference', array('user_id' => $id, 'reference_id' => $reference_id, 'time' => time(), 'date' => date('d M Y')));
    }
    
    public function confirm_email($key) {
        $val = $this->db->get_where('user_details', array('status_key' => $key))->num_rows();
        if ($val === 1) {
            $data = $this->db->get_where('user_details', array('status_key' => $key))->row();
            $session = array('user_email' => $data->email, 'user_id' => $data->id, 'user_type' => $data->type_id, 'key' => $data->salt);
            $this->session->set_userdata($session);
            $this->db->where('status_key', $key);
            $this->db->update('user_details', array('email_valid' => 1, 'status_key' => ''));
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function validate_user($email, $pwd) {
        $this->db->select('*');
        $this->db->from('user_details');
        $this->db->where('email', $email);
        $this->db->where('password', $pwd);
        $query = $this->db->get();
        $result = $query->result();
        if ($query->num_rows() > 0) {
            if($result[0]->is_active == 1) {
                $session = array('user_email' => $result[0]->email, 'user_id' => $result[0]->id, 'user_level' => $result[0]->user_level, 'user_type' => $result[0]->type_id, 'key' => $result[0]->salt);
                $this->session->set_userdata($session);
                $this->set_cookies($result[0]->email, $result[0]->id, $result[0]->user_level, $result[0]->type_id, $result[0]->salt);
                $this->session->unset_userdata('register-email');
                return 'success';
            }
            else {
                return 'not_active';
            }
        } else {
            return 'invalid';
        }
    }
    
    public function set_cookies($user_email, $user_id, $user_level, $user_type, $user_key) {
        $id = $this->encrypt($user_id);
        $level = $this->encrypt($user_level);
        $type = $this->encrypt($user_type);
        $key = $this->encrypt($user_key);
        $email = $this->encrypt($user_email);
        setcookie('wa_i', $id, time() + (10 * 365 * 24 * 60 * 60));
        setcookie('wa_l', $level, time() + (10 * 365 * 24 * 60 * 60));
        setcookie('wa_t', $type, time() + (10 * 365 * 24 * 60 * 60));
        setcookie('wa_k', $key, time() + (10 * 365 * 24 * 60 * 60));
        setcookie('wa_e', $email, time() + (10 * 365 * 24 * 60 * 60));
    }
    
    public function check_login($id, $key) {
        $val = $this->db->get_where('user_details', array('id' => $id, 'salt' => $key))->num_rows();
        if ($val === 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function check_cookies($user_email, $user_id, $user_level, $user_type, $user_key) {
        $id = $this->decrypt($user_id);
        $level = $this->decrypt($user_level);
        $type = $this->decrypt($user_type);
        $key = $this->decrypt($user_key);
        $email = $this->decrypt($user_email);
        $val = $this->db->get_where('user_details', array('id' => $id, 'salt' => $key))->num_rows();
        if ($val === 1) {
            $session = array('user_email' => $email, 'user_id' => $id, 'user_level' => $level, 'user_type' => $type, 'key' => $key);
            $this->session->set_userdata($session);
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function isPresent($email, $key) {
        $val = $this->db->get_where('user_details', array('email' => $email))->num_rows();
        if ($val === 1) {
            $this->db->where('email', $email);
            $this->db->update('user_details', array('pwd_key' => $key));
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function reset_password($hashed_pwd, $salt, $key) {
        $val = $this->db->get_where('user_details', array('pwd_key' => $key))->num_rows();
        if ($val === 1) {
            $this->db->where('pwd_key', $key);
            $this->db->update('user_details', array('password' => $hashed_pwd, 'salt' => $salt, 'pwd_key' => ''));
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function profile_incomplete_reminder() {
        return $this->db->get_where('reminder', array('type' => 0))->row();
    }   
    
    public function update_profile_incomplete_reminder() {
        $this->db->where('type', 0);
        $this->db->update('reminder', array('time' => time()));
    }
    
    public function profile_incomplete_list() {
        $this->db->where_in('is_complete', array('-1', '0'));
        return $this->db->get('user_details')->result();
    }
    
    public function active_free_users($list, $user_id) {
        if($list == 1 && $user_id == '') {
            $this->db->where(array('is_complete >' => '0', 'user_level' => 0));
            return $this->db->get('user_details')->result();
        }
        if($user_id != '' && $list == '') {
            $this->db->like('date', date('M Y'));
            $this->db->where('user_id', $user_id);
            $t_count = $this->db->get('timeline')->num_rows();
            $this->db->like('date', date('M Y'));
            $this->db->where('user_id', $user_id);
            $l_count = $this->db->get('like_dislike')->num_rows();
            $this->db->like('date', date('M Y'));
            $this->db->where('user_id', $user_id);
            $c_count = $this->db->get('comments')->num_rows();
            $a_count = ($this->db->get_where('user_log', array('user_id' => $user_id))->num_rows() > 0)? $this->db->get_where('user_log', array('user_id' => $user_id))->row()->active_days : 0;
            return $t_count + $l_count + $c_count + $a_count;
        }
    }
    
    public function inactive_free_users($list, $user_id) {
        if($list == 1 && $user_id == '') {
            $this->db->where(array('is_complete >' => '0', 'user_level' => 0));
            return $this->db->get('user_details')->result();
        }
        if($user_id != '' && $list == '') {
            $this->db->like('date', date('M Y'));
            $this->db->where('user_id', $user_id);
            $t_count = $this->db->get('timeline')->num_rows();
            $this->db->like('date', date('M Y'));
            $this->db->where('user_id', $user_id);
            $l_count = $this->db->get('like_dislike')->num_rows();
            $this->db->like('date', date('M Y'));
            $this->db->where('user_id', $user_id);
            $c_count = $this->db->get('comments')->num_rows();
            $a_count = ($this->db->get_where('user_log', array('user_id' => $user_id))->num_rows() > 0)? $this->db->get_where('user_log', array('user_id' => $user_id))->row()->active_days : 0;
            return $t_count + $l_count + $c_count + $a_count;
        }
    }
    
    public function inactive_pre_users($list, $user_id) {
        if($list == 1 && $user_id == '') {
            $this->db->where(array('is_complete >' => '0', 'user_level' => 1));
            return $this->db->get('user_details')->result();
        }
        if($user_id != '' && $list == '') {
            $this->db->like('date', date('M Y'));
            $this->db->where('user_id', $user_id);
            $t_count = $this->db->get('timeline')->num_rows();
            $this->db->like('date', date('M Y'));
            $this->db->where('user_id', $user_id);
            $l_count = $this->db->get('like_dislike')->num_rows();
            $this->db->like('date', date('M Y'));
            $this->db->where('user_id', $user_id);
            $c_count = $this->db->get('comments')->num_rows();
            $a_count = ($this->db->get_where('user_log', array('user_id' => $user_id))->num_rows() > 0)? $this->db->get_where('user_log', array('user_id' => $user_id))->row()->active_days : 0;
            return $t_count + $l_count + $c_count + $a_count;
        }
    }
    
    public function wi_rem_users($list, $user_id) {
        if($list == 1 && $user_id == '') {
            $this->db->where(array('ud.is_complete >' => '0'));
            $this->db->select('email, username, ud.id main_id');
            $this->db->from('user_details ud');
            return $this->db->get()->result();
        }
        if($user_id != '' && $list == '') {
            $this->db->like('date', date('M Y'));
            $this->db->where('user_id', $user_id);
            return $this->db->get('ads')->num_rows();
        }
    }
    
    public function job_rem_users($list, $user_id) {
        if($list == 1 && $user_id == '') {
            $this->db->where(array('ud.is_complete >' => '0', 'ui.job' => 1, 'ud.type_id' => 1));
            $this->db->select('email, username, ud.id main_id, is_complete, ui.*');
            $this->db->from('user_details ud');
            $this->db->join('user_info ui', 'ui.user_id = ud.id', 'left');
            return $this->db->get()->result();
        }
        if($user_id != '' && $list == '') {
            $this->db->where('user_id', $user_id);
            return $this->db->get('job_cv')->num_rows();
        }
    }
    
    public function invitation_reminder() {
        return $this->db->get_where('reminder', array('type' => 4))->row();
    }
    
    public function update_invitation_reminder() {
        $this->db->where('type', 4);
        $this->db->update('reminder', array('time' => time()));
    }

    public function invited_users($list, $email) {
        if($list == 1 && $email == '') {
            return $this->db->get('invitations')->result();
        }
        if($email != '' && $list == '') {
            $this->db->like('email', $email);
            return $this->db->get('user_details')->num_rows();
        }
    }
    
    public function reset_conn_email_db() {
        $date = date('d M Y', strtotime('-2 day', time()));
        $this->db->delete('connection_email', array('date' => $date));
        $this->db->delete('job_email', array('date' => $date));
    }
    
    public function reset_day_flag() {
        $days = array(10, 20, 11, 21, 12, 26, 8, 15, 27, 13, 22);
        if(!in_array(date('d'), $days)) {
            $this->db->where('type', 6);
            $this->db->update('reminder', array('time' => 0));
        }
    }

    public function encrypt($string) {
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'Zeka5gi6zw30H7i7e4BPL97w';
        $secret_iv = 'P55H480ZZeka5gi6zw30H7i7';
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        return base64_encode(openssl_encrypt($string, $encrypt_method, $key, 0, $iv));
    }
    
    public function decrypt($string) {
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'Zeka5gi6zw30H7i7e4BPL97w';
        $secret_iv = 'P55H480ZZeka5gi6zw30H7i7';
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        return openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    
    public function get_reminder_flag() {
        return $this->db->get_where('reminder', array('type' => 5))->row()->time;
    }
    
    public function get_day_flag() {
        return $this->db->get_where('reminder', array('type' => 6))->row()->time;
    }
    
    public function update_day_flag() {
        $this->db->where('type', 6);
        $this->db->update('reminder', array('time' => 1));
    }
    
    public function update_reminder_flag($value) {
        $this->db->where('type', 5);
        $this->db->update('reminder', array('time' => $value));
    }
    
    public function approve_adv_booking($user_id, $block_id) {
        if($this->db->get_where('adv_blocks_booked', array('user_id' => $user_id, 'block_id' => $block_id))->num_rows() > 0) {
            $block = $this->db->get_where('adv_blocks_booked', array('user_id' => $user_id, 'block_id' => $block_id))->row();
            $time = time();
            $avail = date('d M Y' ,strtotime("+ $block->days days", $time));
            $avail_timestamp = strtotime("+ $block->days days", $time);
            $this->db->where(array('approve' => 1, 'availability' => $avail, 'availability_timestamp' => $avail_timestamp));
            $this->db->update('adv_blocks_booked', array('user_id' => $user_id, 'block_id' => $block_id));
            return TRUE;
        }
    }
    
    public function delete_adv_booking($user_id, $block_id) {
        if($this->db->get_where('adv_blocks_booked', array('user_id' => $user_id, 'block_id' => $block_id))->num_rows() > 0) {
            $block = $this->db->get_where('adv_blocks_booked', array('user_id' => $user_id, 'block_id' => $block_id))->row();
            if($block->image != '') {
                unlink('assets/userdata/dashboard/adv/image/' . $block->image);
            }
            if($block->video != '') {
                unlink('assets/userdata/dashboard/adv/video/' . $block->video);
            }
            if($block->slider != '') {
                $img_arr = explode(',', $block->slider);
                foreach($img_arr as $i) {
                    unlink('assets/userdata/dashboard/adv/slider/' . $i);
                }
            }
            $this->db->delete('adv_blocks_booked', array('user_id' => $user_id, 'block_id' => $block_id));
            return TRUE;
        }
    }
    
    public function get_connection_info($id) {
        $this->db->where(array('ud.id' => $id, 'ud.is_active' => 1, 'ud.is_complete !=' => 0));
        $this->db->select('ud.id main_id, email, mobile, propic, type_id, user_level, oi.about or_about, oi.address or_address, oi.city or_city, oi.state or_state, oi.country or_country, ui.address user_address, ui.city user_city, ui.state user_state, ui.country user_country, ui.about user_about, co.country_name org_country_name, c.country_name user_country_name, oi.*, ui.*, sl.*, c.*, co.*');
        $this->db->from('user_details ud');
        $this->db->join('user_info ui', 'ui.user_id = ud.id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = ud.id', 'left');
        $this->db->join('social_links sl', 'sl.user_id = ud.id', 'left');
        $this->db->join('countries c', 'c.country_code = ui.country', 'left');
        $this->db->join('countries co', 'co.country_code = oi.country', 'left');
        return $this->db->get()->row();
    }
    
    public function free_user_upgrade($user_id) {
        $this->db->where(array('id' => $user_id));
        $this->db->update('user_details', array('user_level' => 1));
    }
    
    public function deny_free_user_upgrade($user_id) {
        $this->db->delete('ads_upgrade', array('user_id' => $user_id));
    }
    
    public function insert_user_token($user_id,$token_id) {
        $this->db->where('id', $user_id);
        $this->db->update('user_details', array('device_token' => $token_id));
        echo $token_id;
    }
    
    public function get_username($email) {
        $name = $this->db->get_where('user_details', array('email' => $email))->row()->username;
        return ($name != '')? $name : 'Member';
    }
    
    public function insert_mailer_template($data) {
        $this->db->insert('mailer_template', $data);
    }
    
    public function get_seso_grp_list($grp) {
        if($grp == 1) {
            $this->db->where_in('s.class', array(9,10));
            $this->db->select('s.id list_id, ud.id main_id, email, mobile, propic, ui.address user_address, ui.city user_city, ui.state user_state, ui.country user_country, ui.about user_about, c.country_name user_country_name, ui.*, c.*, s.*');
            $this->db->from('seso s');
            $this->db->join('user_details ud', 'ud.id = s.user_id', 'left');
            $this->db->join('user_info ui', 'ui.user_id = s.user_id', 'left');
            $this->db->join('countries c', 'c.country_code = ui.country', 'left');
            return $this->db->get()->result();
        }
        if($grp == 2) {
            $this->db->where_in('s.class', array(11,12));
            $this->db->select('s.id list_id, ud.id main_id, email, mobile, propic, ui.address user_address, ui.city user_city, ui.state user_state, ui.country user_country, ui.about user_about, c.country_name user_country_name, ui.*, c.*, s.*');
            $this->db->from('seso s');
            $this->db->join('user_details ud', 'ud.id = s.user_id', 'left');
            $this->db->join('user_info ui', 'ui.user_id = s.user_id', 'left');
            $this->db->join('countries c', 'c.country_code = ui.country', 'left');
            return $this->db->get()->result();
        }
    }
    
    public function get_seso_content($id) {
        $this->db->where('s.id', $id);
        $this->db->select('s.id list_id, ud.id main_id, email, mobile, propic, ui.address user_address, ui.city user_city, ui.state user_state, ui.country user_country, ui.about user_about, c.country_name user_country_name, ui.*, c.*, s.*');
        $this->db->from('seso s');
        $this->db->join('user_details ud', 'ud.id = s.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = s.user_id', 'left');
        $this->db->join('countries c', 'c.country_code = ui.country', 'left');
        return $this->db->get()->row();
    }
    
    public function get_invited_freemems() {
        $user_id = array();
        $code = 'wa1pg7';
        $this->db->where(array('r.reference_id' => $code, 'ud.user_level' => 0));
        $this->db->select('r.user_id');
        $this->db->from('reference r');
        $this->db->join('user_details ud', 'ud.id = r.user_id', 'left');
        $inv_array = $this->db->get()->result();
        if(count($inv_array > 0)) {
            foreach ($inv_array as $in) {
                $user_id[] = $in->user_id;
            }
        }
        if(count($user_id) > 0) {
            $this->db->where_not_in('id', $user_id);
        }
        $this->db->where(array('reference' => $code, 'user_level' => 0));
        $this->db->from('user_details');
        $invited = $this->db->get()->result();
        return array_merge($inv_array, $invited);
    }
    
    public function get_invited_premems() {
        $user_id = array();
        $code = 'wa1pg7';
        $this->db->where(array('r.reference_id' => $code, 'ud.user_level' => 1));
        $this->db->select('r.user_id');
        $this->db->from('reference r');
        $this->db->join('user_details ud', 'ud.id = r.user_id', 'left');
        $inv_array = $this->db->get()->result();
        if(count($inv_array > 0)) {
            foreach ($inv_array as $in) {
                $user_id[] = $in->user_id;
            }
        }
        if(count($user_id) > 0) {
            $this->db->where_not_in('id', $user_id);
        }
        $this->db->where(array('reference' => $code, 'user_level' => 1));
        $this->db->from('user_details');
        $invited = $this->db->get()->result();
        return array_merge($inv_array, $invited);
    }
    
}

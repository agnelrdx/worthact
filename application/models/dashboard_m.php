<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_m extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function check_login($id, $key) {
        $val = $this->db->get_where('user_details', array('id' => $id, 'salt' => $key))->num_rows();
        if ($val === 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function save_user_log($user_id, $device) {
        if($this->db->get_where('user_log', array('user_id' => $user_id))->num_rows() == 0) {
            $this->db->insert('user_log', array('device' => $device, 'user_id' => $user_id, 'last_active_date' => date('d M Y'), 'last_active_time' => time(), 'last_active_place' => $this->session->userdata('timezone'), 'active_days' => 1));
        } else {
            $log = $this->db->get_where('user_log', array('user_id' => $user_id))->row();
            if($log->last_active_date == date('d M Y')) {
                $this->db->where('user_id', $user_id);
                $this->db->update('user_log', array('device' => $device, 'last_active_date' => date('d M Y'), 'last_active_time' => time(), 'last_active_place' => $this->session->userdata('timezone')));
            } else {
                $days = $log->active_days + 1;
                $this->db->where('user_id', $user_id);
                $this->db->update('user_log', array('device' => $device, 'last_active_date' => date('d M Y'), 'last_active_time' => time(), 'last_active_place' => $this->session->userdata('timezone'), 'active_days' => $days));
            }
        }
    }
    
    public function check_user($id) {
        $cur_id = $this->session->userdata('user_id');
        $val = $this->db->get_where('user_details', array('id' => $id, 'is_complete !=' => 0, 'is_active' => 1))->num_rows();
        if($val == 1) {
            $query = $this->db->query("SELECT * FROM connection WHERE user_one = $id AND user_two = $cur_id AND status = 2 UNION SELECT * FROM connection WHERE user_one = $cur_id AND user_two = $id AND status = 2");
            if ($query->num_rows() == 1) {
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    public function profile_complete($id) {
        return $this->db->get_where('user_details', array('id' => $id))->row();
    }
    
    public function update_user_account() {
        $this->db->where('id', $this->session->userdata('user_id'));
        $this->db->update('user_details', array('is_complete' => 0, 'user_level' => 0));
        return TRUE;
    }

    public function get_type_name($id) {
        return $this->db->get_where('user_types', array('type_id' => $id))->row()->type_name;
    }

    public function add_user_info($data, $reference) {
        if($this->db->get_where('user_info', array('user_id' => $this->session->userdata('user_id')))->num_rows() == 0) {
            $this->db->insert('user_info', $data);
        }
        $this->db->where('id', $this->session->userdata('user_id'));
        $this->db->update('user_details', array('is_complete' => 1, 'username' => $data['firstname'], 'reference' => $reference));
    }

    public function add_org_info($data, $reference) {
        if($this->db->get_where('org_info', array('user_id' => $this->session->userdata('user_id')))->num_rows() == 0) {
            $this->db->insert('org_info', $data);
        }
        $this->db->where('id', $this->session->userdata('user_id'));
        $this->db->update('user_details', array('is_complete' => 1, 'username' => $data['name'], 'reference' => $reference));
    }

    public function add_category($cat) {
        foreach ($cat as $c) {
            $this->db->insert('user_selected_category', array('user_id' => $this->session->userdata('user_id'), 'cat_id' => $c));
        }
    }
    
    public function delete_user_propic() {
        $pic = $this->db->get_where('user_details', array('id' => $this->session->userdata('user_id')))->row()->propic;
        if($pic != '') {
            unlink('assets/userdata/dashboard/propic/' . $pic);
        }
    }
    
    public function update_category($cat) {
        $this->db->delete('user_selected_category', array('user_id' => $this->session->userdata('user_id')));
        foreach ($cat as $c) {
            $this->db->insert('user_selected_category', array('user_id' => $this->session->userdata('user_id'), 'cat_id' => $c));
        }
    }
    
    public function user_social_info($data_social) {
        $row = $this->db->get_where('social_links', array('user_id' => $this->session->userdata('user_id')))->num_rows();
        $meter = $this->db->get_where('user_details', array('id' => $this->session->userdata('user_id')))->row()->is_complete;
        if($row > 0) {
            $this->db->where(array('user_id' => $this->session->userdata('user_id')));
            $this->db->update('social_links', $data_social);
        } else {
            $this->db->insert('social_links', $data_social);
        }
        if($meter == 2) {
            $this->db->where(array('id' => $this->session->userdata('user_id')));
            $this->db->update('user_details', array('is_complete' => 3));
        }
    }
    
    public function update_user_info($data) {
        $this->db->where(array('user_id' => $this->session->userdata('user_id')));
        $this->db->update('user_info', $data);
        $this->db->where('id', $this->session->userdata('user_id'));
        $this->db->update('user_details', array('username' => $data['firstname']));
    }
    
    public function update_org_info($data) {
        $this->db->where(array('user_id' => $this->session->userdata('user_id')));
        $this->db->update('org_info', $data);
        $this->db->where('id', $this->session->userdata('user_id'));
        $this->db->update('user_details', array('username' => $data['name']));
    }
    
    public function add_user_privacy() {
        if($this->db->get_where('privacy', array('user_id' => $this->session->userdata('user_id')))->num_rows() == 0) {
            $this->db->insert('privacy', array('user_id' => $this->session->userdata('user_id'), 'phone' => 2, 'email' => 2, 'address' => 1, 'dob' => 2, 'social' => 1, 'connection' => 0, 'connection_deny' => 0));
        }
    }
    
    public function add_org_privacy() {
        if($this->db->get_where('privacy', array('user_id' => $this->session->userdata('user_id')))->num_rows() == 0) {
            $this->db->insert('privacy', array('user_id' => $this->session->userdata('user_id'), 'phone' => 2, 'email' => 2, 'address' => 1, 'dob' => 0, 'social' => 1, 'connection' => 2, 'connection_deny' => 1));
        }
    }

    public function get_info($id) {
        if ($this->session->userdata('user_type') == 1) {
            $this->db->where('ud.id', $id);
            $this->db->select('email, type_id, time, propic, user_level, email_valid, is_complete, ui.*, sl.*');
            $this->db->from('user_details ud');
            $this->db->join('user_info ui', 'ui.user_id = ud.id', 'left');
            $this->db->join('social_links sl', 'sl.user_id = ud.id', 'left');
            return $this->db->get()->row();
        } else {
            $this->db->where('ud.id', $id);
            $this->db->select('email, type_id, time, propic, user_level, email_valid, is_complete, oi.*, sl.*');
            $this->db->from('user_details ud');
            $this->db->join('org_info oi', 'oi.user_id = ud.id', 'left');
            $this->db->join('social_links sl', 'sl.user_id = ud.id', 'left');
            return $this->db->get()->row();
        }
    }
    
    public function get_activation_key($email) {
        return $this->db->get_where('user_details', array('email' => $email))->row()->status_key;
    }
    
    public function get_connection_info($id) {
        $this->db->where(array('ud.id' => $id, 'ud.is_active' => 1, 'ud.is_complete !=' => 0));
        $this->db->select('ud.id main_id, ui.wall userwall, oi.wall orgwall, email, mobile, propic, type_id, user_level, oi.about or_about, oi.address or_address, oi.city or_city, oi.state or_state, oi.country or_country, ui.address user_address, ui.city user_city, ui.state user_state, ui.country user_country, ui.about user_about, co.country_name org_country_name, c.country_name user_country_name, oi.*, ui.*, sl.*, c.*, co.*');
        $this->db->from('user_details ud');
        $this->db->join('user_info ui', 'ui.user_id = ud.id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = ud.id', 'left');
        $this->db->join('social_links sl', 'sl.user_id = ud.id', 'left');
        $this->db->join('countries c', 'c.country_code = ui.country', 'left');
        $this->db->join('countries co', 'co.country_code = oi.country', 'left');
        return $this->db->get()->row();
    }

    public function get_user_subcategories($id) {
        $this->db->where('u.user_id', $id);  
        $this->db->select('a.id as cat_id, a.category as cat_name');
        $this->db->distinct('u.cat_id');
        $this->db->from('user_selected_category u');
        $this->db->join('ad_category a', 'u.cat_id = a.id', 'inner');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    
    public function insert_blog($data, $privacy) {
        $this->db->insert('blog', $data);
        $blog_id = $this->db->insert_id();
        $blog = $this->db->get_where('blog', array('id' => $blog_id))->row();
        $this->db->insert('timeline', array('user_id' => $this->session->userdata('user_id'), 'content_type' => 'blog', 'blog_id' => $blog_id, 'title' => $blog->title, 'privacy' => $privacy, 'time' => $blog->time, 'date' => $blog->date)); 
    }

    public function get_user_blog($id) {
        $this->db->limit(10);
        $this->db->order_by('time', 'DESC');
        return $this->db->get('blog')->result();
    }

    public function get_user_blog_count($id) {
        return $this->db->get('blog')->num_rows();
    }

    public function get_user_more_blog($id, $last_id) {
        $this->db->limit(10);
        $this->db->order_by('time', 'DESC');
        $this->db->where(array('time <' => $last_id));
        return $this->db->get('blog')->result();
    }
    
    public function check_blog_view($id) {
        $cur_id = $this->session->userdata('user_id');
        $num = $this->db->get_where('blog', array('id' => $id))->num_rows();
        if ($num > 0) {
            $user_id = $this->db->get_where('blog', array('id' => $id))->row()->user_id;
            if ($user_id == $cur_id) { return TRUE; } else {
                $privacy = $this->db->get_where('blog', array('id' => $id))->row()->privacy;
                if($privacy == 0) { return TRUE; } 
                if($privacy == 1) { if($this->db->query("SELECT * FROM connection WHERE user_one = $cur_id AND user_two = $user_id AND status = 1 UNION SELECT * FROM connection WHERE user_one = $user_id AND user_two = $cur_id AND status = 1")->num_rows() > 0) { return TRUE; }}
            } 
        } else {
            return FALSE;
        }
    }
    
    public function get_user_single_blog($id) {
        $this->db->where('b.id', $id);
        $this->db->select('b.id main_id, b.user_id main_user_id, type_id, firstname, lastname, name, b.*');
        $this->db->from('blog b');
        $this->db->join('user_details ud', 'ud.id = b.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = b.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = b.user_id', 'left');
        return $this->db->get()->row();
    }
    
    public function get_curr_user_single_blog($id) {
        $this->db->where(array('b.id' => $id));
        $this->db->select('b.id main_id, type_id, firstname, lastname, name, b.*');
        $this->db->from('blog b');
        $this->db->join('user_details ud', 'ud.id = b.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = b.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = b.user_id', 'left');
        return $this->db->get()->row();
    }
    
    public function get_curr_user_single_user_blog($id) {
        $this->db->where(array('b.id' => $id, 'b.user_id' => $this->session->userdata('user_id')));
        $this->db->select('b.id main_id, type_id, firstname, lastname, name, b.*');
        $this->db->from('blog b');
        $this->db->join('user_details ud', 'ud.id = b.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = b.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = b.user_id', 'left');
        return $this->db->get()->row();
    }

    public function delete_blog($id) {
        if($this->db->get_where('blog', array('id' => $id, 'user_id' => $this->session->userdata('user_id')))->num_rows() > 0) {
           $file = $this->db->get_where('blog', array('id' => $id, 'user_id' => $this->session->userdata('user_id')))->row()->file;
            if($file != '') {
                unlink('assets/userdata/dashboard/blog/' . $file);
            }
            $this->db->delete('blog', array('id' => $id, 'user_id' => $this->session->userdata('user_id')));
            $this->db->delete('timeline', array('blog_id' => $id));
            if($this->db->get_where('comments', array('type' => 'blog', 'type_id' => $id))->num_rows() > 0) {
                $comments = $this->db->get_where('comments', array('type' => 'blog', 'type_id' => $id))->result();
                foreach ($comments as $cmt) {
                    $this->db->delete('like_dislike', array('type' => 'comment', 'type_id' => $cmt->id));
                }
                $this->db->delete('comments', array('type' => 'blog', 'type_id' => $id));
            }            
            $this->db->delete('like_dislike', array('type' => 'blog', 'type_id' => $id));
            return TRUE; 
        } 
    }

    public function update_blog($data, $file, $id) {
        if ($file == '') {
            $this->db->where(array('id' => $id, 'user_id' => $this->session->userdata('user_id')));
            $this->db->update('blog', $data);
        } else {
            $this->db->where(array('id' => $id, 'user_id' => $this->session->userdata('user_id')));
            $this->db->update('blog', $data);
            $this->db->where(array('id' => $id, 'user_id' => $this->session->userdata('user_id')));
            $this->db->update('blog', array('file' => $file));
        }
        $blog = $this->db->get_where('blog', array('id' => $id))->row();
        $this->db->where(array('blog_id' => $id, 'user_id' => $this->session->userdata('user_id')));
        $this->db->update('timeline', array('title' => $blog->title, 'privacy' => $blog->privacy, 'time' => $blog->time, 'date' => $blog->date));
    }

    public function get_user_gallery_images() {
        $this->db->limit(10);
        $this->db->order_by('time', 'DESC');
        return $this->db->get_where('timeline', array('user_id' => $this->session->userdata('user_id'), 'content_type' => 'image'))->result();
    }
    
    public function getmore_user_gallery_images($last_id) {
        $this->db->limit(10);
        $this->db->order_by('time', 'DESC');
        $this->db->where(array('user_id' => $this->session->userdata('user_id'), 'time <' => $last_id, 'content_type' => 'image'));
        return $this->db->get('timeline')->result();
    }
    
    public function get_user_gallery_videos() {
        $this->db->limit(10);
        $this->db->order_by('time', 'DESC');
        return $this->db->get_where('timeline', array('user_id' => $this->session->userdata('user_id'), 'content_type' => 'video'))->result();
    }
    
    public function getmore_user_gallery_videos($last_id) {
        $this->db->limit(10);
        $this->db->order_by('time', 'DESC');
        $this->db->where(array('user_id' => $this->session->userdata('user_id'), 'time <' => $last_id, 'content_type' => 'video'));
        return $this->db->get('timeline')->result();
    }
    
    public function gallery_singleview($post_id) {
        $this->db->where(array('t.id' => $post_id));
        $this->db->select('t.id timeline_post_id, t.user_id post_user_id, t.time post_time, t.date post_date, firstname, lastname, name, propic, ud.type_id user_type, t.*');
        $this->db->from('timeline t');
        $this->db->join('user_details ud', 'ud.id = t.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = t.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = t.user_id', 'left');
        return $this->db->get()->row();
    }

    public function get_user_search($search) {
        $id = $this->session->userdata('user_id');        
        $query = $this->db->query("SELECT propic, user_level, type_id, ud.id main_id, ud.time user_time, ui.user_id user_id, oi.user_id org_id, ui.city user_city, ui.state user_state, c.country_name user_country, co.country_name org_country, ui.*, oi.* FROM user_details ud LEFT JOIN user_info ui on ui.user_id = ud.id LEFT JOIN org_info oi on oi.user_id = ud.id LEFT JOIN countries c on c.country_code = ui.country LEFT JOIN countries co on co.country_code = oi.country WHERE ud.id NOT IN (SELECT user_one FROM connection WHERE user_two = $id AND status = 2 UNION SELECT user_two FROM connection WHERE user_one = $id AND status = 2) AND is_complete > 0 AND is_active = 1 AND ud.id != $id AND (oi.name LIKE '%$search%' OR CONCAT(ui.firstname,' ',ui.lastname) LIKE '%$search%' OR ui.firstname LIKE '%$search%' OR ui.lastname LIKE '%$search%' OR ud.email LIKE '%$search%') ORDER BY ud.time DESC LIMIT 24");
        return $query->result();
    }
    
    public function get_user_search_count($search) {
        $id = $this->session->userdata('user_id');
        $query = $this->db->query("SELECT propic, user_level, type_id, ud.id main_id, ud.time user_time, ui.user_id user_id, oi.user_id org_id, ui.city user_city, ui.state user_state, c.country_name user_country, co.country_name org_country, ui.*, oi.* FROM user_details ud LEFT JOIN user_info ui on ui.user_id = ud.id LEFT JOIN org_info oi on oi.user_id = ud.id LEFT JOIN countries c on c.country_code = ui.country LEFT JOIN countries co on co.country_code = oi.country WHERE ud.id NOT IN (SELECT user_one FROM connection WHERE user_two = $id AND status = 2 UNION SELECT user_two FROM connection WHERE user_one = $id AND status = 2) AND is_complete > 0 AND is_active = 1 AND ud.id != $id AND (oi.name LIKE '%$search%' OR CONCAT(ui.firstname,' ',ui.lastname) LIKE '%$search%' OR ui.firstname LIKE '%$search%' OR ui.lastname LIKE '%$search%' OR ud.email LIKE '%$search%') ORDER BY ud.time DESC");
        return $query->result();
    }
    
    public function get_more_usersearch($search, $last_id) {
        $id = $this->session->userdata('user_id');
        $query = $this->db->query("SELECT propic, user_level, type_id, ud.id main_id, ud.time user_time, ui.user_id user_id, oi.user_id org_id, ui.city user_city, ui.state user_state, c.country_name user_country, co.country_name org_country, ui.*, oi.* FROM user_details ud LEFT JOIN user_info ui on ui.user_id = ud.id LEFT JOIN org_info oi on oi.user_id = ud.id LEFT JOIN countries c on c.country_code = ui.country LEFT JOIN countries co on co.country_code = oi.country WHERE ud.id NOT IN (SELECT user_one FROM connection WHERE user_two = $id AND status = 2 UNION SELECT user_two FROM connection WHERE user_one = $id AND status = 2) AND is_complete > 0 AND is_active = 1 AND ud.time < $last_id AND ud.id != $id AND (oi.name LIKE '%$search%' OR CONCAT(ui.firstname,' ',ui.lastname) LIKE '%$search%' OR ui.lastname LIKE '%$search%' OR ud.email LIKE '%$search%') ORDER BY ud.time DESC LIMIT 24");
        return $query->result();
    }

    public function get_blog_search($search) {
        $id = $this->session->userdata('user_id');
        $this->db->limit(25);
        $this->db->order_by('b.time', 'DESC');
        $this->db->where(array('b.user_id !=' => $id, 'b.privacy !=' => 2));
        $this->db->like('b.title', $search);
        $this->db->select('b.id main_id, type_id, firstname, lastname, name, b.*');
        $this->db->from('blog b');
        $this->db->join('user_details ud', 'ud.id = b.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = b.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = b.user_id', 'left');
        return $this->db->get()->result();
    }
    
    public function get_blog_search_count($search) {
        $id = $this->session->userdata('user_id');
        $this->db->order_by('b.time', 'DESC');
        $this->db->where(array('b.user_id !=' => $id, 'b.privacy !=' => 2));
        $this->db->like('b.title', $search);
        $this->db->select('b.id main_id, type_id, firstname, lastname, name, b.*');
        $this->db->from('blog b');
        $this->db->join('user_details ud', 'ud.id = b.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = b.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = b.user_id', 'left');
        return $this->db->get()->result();
    }
    
    public function get_more_blogsearch($search, $last_id) {
        $id = $this->session->userdata('user_id');
        $this->db->limit(25);
        $this->db->order_by('b.time', 'DESC');
        $this->db->where(array('b.user_id !=' => $id, 'b.time <' => $last_id, 'b.privacy !=' => 2));
        $this->db->like('b.title', $search);
        $this->db->select('b.id main_id, type_id, firstname, lastname, name, b.*');
        $this->db->from('blog b');
        $this->db->join('user_details ud', 'ud.id = b.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = b.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = b.user_id', 'left');
        return $this->db->get()->result();
    }
    
    public function get_post_search($search) {
        $id = $this->session->userdata('user_id');
        $this->db->limit(25);
        $this->db->order_by('a.time', 'DESC');
        $this->db->where(array('a.user_id !=' => $id));
        $this->db->like('a.title', $search);
        $this->db->select('a.id main_id, type_id, firstname, lastname, name, cat.category main_cat, a.*, cat.*, cntry.*');
        $this->db->from('ads a');
        $this->db->join('user_details ud', 'ud.id = a.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = a.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = a.user_id', 'left');
        $this->db->join('ad_category cat', 'cat.id = a.cat_id', 'left');
        $this->db->join('countries cntry', 'cntry.country_code = a.country_code','left');
        return $this->db->get()->result();
    }
    
    public function get_post_search_count($search) {
        $id = $this->session->userdata('user_id');
        $this->db->order_by('a.time', 'DESC');
        $this->db->where(array('a.user_id !=' => $id));
        $this->db->like('a.title', $search);
        $this->db->select('a.id main_id, type_id, firstname, lastname, name, a.*, cat.*, cntry.*');
        $this->db->from('ads a');
        $this->db->join('user_details ud', 'ud.id = a.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = a.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = a.user_id', 'left');
        $this->db->join('ad_category cat', 'cat.id = a.cat_id', 'left');
        $this->db->join('countries cntry', 'cntry.country_code = a.country_code','left');
        return $this->db->get()->result();
    }
    
    public function get_more_postsearch($search, $last_id) {
        $id = $this->session->userdata('user_id');
        $this->db->limit(25);
        $this->db->order_by('a.time', 'DESC');
        $this->db->where(array('a.user_id !=' => $id, 'a.time <' => $last_id));
        $this->db->like('a.title', $search);
        $this->db->select('a.id main_id, type_id, firstname, lastname, name, a.*, cat.*, cntry.*');
        $this->db->from('ads a');
        $this->db->join('user_details ud', 'ud.id = a.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = a.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = a.user_id', 'left');
        $this->db->join('ad_category cat', 'cat.id = a.cat_id', 'left');
        $this->db->join('countries cntry', 'cntry.country_code = a.country_code','left');
        return $this->db->get()->result();
    }
    
    public function get_group_search($search) {
        $id = $this->session->userdata('user_id');
        $this->db->limit(24);
        $this->db->order_by('g.time', 'DESC');
        $this->db->where('g.user_id !=', $id);
        $this->db->like('g.title', $search);
        $this->db->select('g.id main_id, g.time group_time, type_id, firstname, lastname, name, g.*');
        $this->db->from('groups g');
        $this->db->join('user_details ud', 'ud.id = g.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = g.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = g.user_id', 'left');
        return $this->db->get()->result();
    }
    
    public function get_group_search_count($search) {
        $id = $this->session->userdata('user_id');
        $this->db->order_by('g.time', 'DESC');
        $this->db->where('g.user_id !=', $id);
        $this->db->like('g.title', $search);
        $this->db->select('g.id main_id, g.time group_time, type_id, firstname, lastname, name, g.*');
        $this->db->from('groups g');
        $this->db->join('user_details ud', 'ud.id = g.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = g.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = g.user_id', 'left');
        return $this->db->get()->result();
    }
    
    public function get_more_groupsearch($search, $last_id) {
        $id = $this->session->userdata('user_id');
        $this->db->limit(24);
        $this->db->order_by('g.time', 'DESC');
        $this->db->where(array('g.user_id !=' => $id, 'g.time <' => $last_id));
        $this->db->like('g.title', $search);
        $this->db->select('g.id main_id, g.time group_time, type_id, firstname, lastname, name, g.*');
        $this->db->from('groups g');
        $this->db->join('user_details ud', 'ud.id = g.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = g.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = g.user_id', 'left');
        return $this->db->get()->result();
    }
    
    public function get_ajax_search($search) {
        $id = $this->session->userdata('user_id');        
        $query = $this->db->query("SELECT ud.id main_user_id, type_id, ui.*, oi.* FROM user_details ud LEFT JOIN user_info ui on ui.user_id = ud.id LEFT JOIN org_info oi on oi.user_id = ud.id LEFT JOIN countries c on c.country_code = ui.country LEFT JOIN countries co on co.country_code = oi.country WHERE ud.id NOT IN (SELECT user_one FROM connection WHERE user_two = $id AND status = 2 UNION SELECT user_two FROM connection WHERE user_one = $id AND status = 2) AND is_complete > 0 AND is_active = 1 AND ud.id != $id AND (oi.name LIKE '%$search%' OR CONCAT(ui.firstname,' ',ui.lastname) LIKE '%$search%' OR ui.firstname LIKE '%$search%' OR ui.lastname LIKE '%$search%' OR ud.email LIKE '%$search%') ORDER BY ud.time DESC LIMIT 24");
        $result['user'] = $query->result();
        
        $this->db->order_by('b.time', 'DESC');
        $this->db->where(array('b.user_id !=' => $id, 'b.privacy !=' => 2));
        $this->db->like('b.title', $search);
        $this->db->select('b.id main_blog_id, b.*');
        $this->db->from('blog b');
        $result['blog'] = $this->db->get()->result();

        $this->db->order_by('a.time', 'DESC');
        $this->db->where(array('a.user_id !=' => $id));
        $this->db->like('a.title', $search);
        $this->db->select('a.id main_ad_id, a.*');
        $this->db->from('ads a');
        $result['ad'] = $this->db->get()->result();
        
        $this->db->order_by('g.time', 'DESC');
        $this->db->where('g.user_id !=', $id);
        $this->db->like('g.title', $search);
        $this->db->select('g.id main_grp_id, g.*');
        $this->db->from('groups g');
        $result['group'] = $this->db->get()->result();
        
        return $result;
    }

    public function get_user_category($user_id) {
        $this->db->where('u.user_id', $user_id);
        $this->db->select('c.category, c.id');
        $this->db->distinct('u.cat_id');
        $this->db->from('user_selected_category u');
        $this->db->join('ad_category c', 'u.cat_id = c.id', 'inner');
        return $this->db->get()->result();
    }
    
    public function send_connection_req($req_id) {
        $cur_id = $this->session->userdata('user_id');
        $query = $this->db->query("SELECT * FROM connection WHERE user_one = $cur_id AND user_two = $req_id UNION SELECT * FROM connection WHERE user_one = $req_id AND user_two = $cur_id");
        if ($query->num_rows() === 0) {
            $this->db->insert('connection', array('user_one' => $this->session->userdata('user_id'), 'user_two' => $req_id, 'status' => 0, 'date' => date('d M Y'), 'time' => time()));
            return TRUE;
        } else {
            $user_two = $query->row()->user_two;
            if($user_two === $this->session->userdata('user_id')) {
                $this->db->where(array('user_one' => $req_id, 'user_two' => $this->session->userdata('user_id')));
                $this->db->update('connection', array('user_one' => $this->session->userdata('user_id'), 'user_two' => $req_id, 'status' => 0));
                return TRUE;
            }
        }
    }
    
    public function follow_user($req_id) {
        $cur_id = $this->session->userdata('user_id');
        $query = $this->db->query("SELECT * FROM connection WHERE user_one = $cur_id AND user_two = $req_id");
        if ($query->num_rows() === 0) {
            $this->db->insert('connection', array('user_one' => $this->session->userdata('user_id'), 'user_two' => $req_id, 'status' => 3, 'date' => date('d M Y'), 'time' => time()));
            return TRUE;
        }
    }
    
    public function connection_email($req_id) {
        return $this->db->get_where('connection_email', array('user_one' => $this->session->userdata('user_id'), 'user_two' => $req_id))->num_rows();
    }
    
    public function add_connection_email($req_id) {
        $this->db->insert('connection_email', array('user_one' => $this->session->userdata('user_id'), 'user_two' => $req_id, 'date' => date('d M Y'), 'time' => time()));
    }

    public function cancel_connection_req($cancel_id) {
        $cur_id = $this->session->userdata('user_id');
        $query = $this->db->query("SELECT * FROM connection WHERE user_one = $cur_id AND user_two = $cancel_id");
        if ($query->num_rows() > 0) {
            if($query->row()->status != 1 && $query->row()->status != 2) {
                $id = $query->row()->id;
                $this->db->delete('connection', array('id' => $id));
                return TRUE;
            }
        }
    }
    
    public function accept_connection_req($accept_id) {
        $cur_id = $this->session->userdata('user_id');
        $query = $this->db->query("SELECT * FROM connection WHERE user_one = $accept_id AND user_two = $cur_id");
        if ($query->num_rows() > 0) {
            $id = $query->row()->id;
            $this->db->where('id', $id);
            $this->db->update('connection', array('status' => 1));
            $this->db->insert('online_users', array('user_one' => $accept_id, 'user_two' => $cur_id, 'status' => 1));
            $this->db->insert('online_users', array('user_one' => $cur_id, 'user_two' => $accept_id, 'status' => 1));
            return TRUE;
        }
    }
    
    public function delete_connection_req($delete_id) {
        $cur_id = $this->session->userdata('user_id');
        $query = $this->db->query("SELECT * FROM connection WHERE user_one = $delete_id AND user_two = $cur_id UNION SELECT * FROM connection WHERE user_one = $cur_id AND user_two = $delete_id");
        if ($query->num_rows() > 0) {
            $id = $query->row()->id;
            $this->db->delete('connection', array('id' => $id));
            $this->db->delete('online_users', array('user_one' => $delete_id, 'user_two' => $cur_id));
            $this->db->delete('online_users', array('user_two' => $delete_id, 'user_one' => $cur_id));
            return TRUE;
        }
    }
    
    public function block_connection($block_id) {
        $cur_id = $this->session->userdata('user_id');
        $query = $this->db->query("SELECT * FROM connection WHERE user_one = $block_id AND user_two = $cur_id UNION SELECT * FROM connection WHERE user_one = $cur_id AND user_two = $block_id");
        if ($query->num_rows() > 0) {
            $id = $query->row()->id;
            $this->db->where('id', $id);
            $this->db->update('connection', array('status' => 2, 'blocked_by' => $cur_id));
            $this->db->delete('online_users', array('user_one' => $block_id, 'user_two' => $cur_id));
            $this->db->delete('online_users', array('user_two' => $block_id, 'user_one' => $cur_id));
            return TRUE;
        }
    }

    public function check_connection($frnd_id) {
        $cur_id = $this->session->userdata('user_id');
        $query = $this->db->query("SELECT * FROM connection WHERE user_one = $cur_id AND user_two = $frnd_id UNION SELECT * FROM connection WHERE user_one = $frnd_id AND user_two = $cur_id");
        if ($query->num_rows() > 0) {
            switch ($query->row()->status) {
                case 0 : $user_two = $query->row()->user_two; $return = ($user_two === $this->session->userdata('user_id')) ? 'accept' : 'cancel';
                    break;
                case 1 : $return = 'friend';
                    break;
                case 3 : $user_two = $query->row()->user_two; $return = ($user_two === $this->session->userdata('user_id')) ? 'not_valid' : 'following';
                    break;
                case 2 : $return = 'blocked';
            }
            return $return;
        } else {
            return 'not_valid';
        }
    }
    
    public function get_user_connection() {
        $cur_id = $this->session->userdata('user_id');
        return $this->db->query("SELECT * FROM connection WHERE user_one = $cur_id AND status = 1 UNION SELECT * FROM connection WHERE user_two = $cur_id AND status = 1")->result();
    }
    
    public function get_user_followers() {
        $cur_id = $this->session->userdata('user_id');
        return $this->db->query("SELECT * FROM connection WHERE user_one = $cur_id AND status = 3")->result();
    }
    
    public function get_all_new_connection() {
        $this->db->order_by('c.time', 'DESC');
        $this->db->where(array('c.user_two' => $this->session->userdata('user_id'), 'c.status' => 0));
        $this->db->select('ud.id main_user_id, ud.user_level level, c.time conn_time, c.date conn_date, firstname, lastname, profession, ui.city user_city, ui.state user_state, cu.country_name user_country, co.country_name org_country, name, propic, ud.type_id user_type, c.*, ui.*, oi.*');
        $this->db->from('connection c');
        $this->db->join('user_details ud', 'ud.id = c.user_one', 'left');
        $this->db->join('user_info ui', 'ui.user_id = c.user_one', 'left');
        $this->db->join('org_info oi', 'oi.user_id = c.user_one', 'left');
        $this->db->join('countries cu', 'cu.country_code = ui.country', 'left');
        $this->db->join('countries co', 'co.country_code = oi.country', 'left');        
        return $this->db->get()->result();
    }
    
    public function get_all_accepted_connection() {
        $this->db->order_by('c.time', 'DESC');
        $this->db->where(array('c.user_one' => $this->session->userdata('user_id'), 'c.status' => 1));
        $this->db->select('ud.id main_user_id, ud.user_level level, c.time conn_time, c.date conn_date, firstname, lastname, profession, ui.city user_city, ui.state user_state, cu.country_name user_country, co.country_name org_country, name, propic, ud.type_id user_type, c.*, ui.*, oi.*');
        $this->db->from('connection c');
        $this->db->join('user_details ud', 'ud.id = c.user_two', 'left');
        $this->db->join('user_info ui', 'ui.user_id = c.user_two', 'left');
        $this->db->join('org_info oi', 'oi.user_id = c.user_two', 'left');
        $this->db->join('countries cu', 'cu.country_code = ui.country', 'left');
        $this->db->join('countries co', 'co.country_code = oi.country', 'left'); 
        return $this->db->get()->result();
    }
    
    public function get_all_sent_connection() {
        $this->db->order_by('c.time', 'DESC');
        $this->db->where(array('c.user_one' => $this->session->userdata('user_id'), 'c.status' => 0));
        $this->db->select('ud.id main_user_id, ud.user_level level, c.time conn_time, c.date conn_date, firstname, lastname, profession, ui.city user_city, ui.state user_state, cu.country_name user_country, co.country_name org_country, name, propic, ud.type_id user_type, c.*, ui.*, oi.*');
        $this->db->from('connection c');
        $this->db->join('user_details ud', 'ud.id = c.user_two', 'left');
        $this->db->join('user_info ui', 'ui.user_id = c.user_two', 'left');
        $this->db->join('org_info oi', 'oi.user_id = c.user_two', 'left');
        $this->db->join('countries cu', 'cu.country_code = ui.country', 'left');
        $this->db->join('countries co', 'co.country_code = oi.country', 'left'); 
        return $this->db->get()->result();
    }
    
    public function get_latest_all_new_connection($first_id) {
        $this->db->order_by('c.time', 'DESC');
        $this->db->where(array('c.user_two' => $this->session->userdata('user_id'), 'c.status' => 0, 'c.time >' => $first_id));
        $this->db->select('ud.id main_user_id, c.time conn_time, c.date conn_date, firstname, lastname, name, propic, ud.type_id user_type, c.*');
        $this->db->from('connection c');
        $this->db->join('user_details ud', 'ud.id = c.user_one', 'left');
        $this->db->join('user_info ui', 'ui.user_id = c.user_one', 'left');
        $this->db->join('org_info oi', 'oi.user_id = c.user_one', 'left');
        return $this->db->get()->result();
    }
    
    public function get_latest_all_accepted_connection($first_id) {
        $this->db->order_by('c.time', 'DESC');
        $this->db->where(array('c.user_one' => $this->session->userdata('user_id'), 'c.status' => 1, 'c.time >' => $first_id));
        $this->db->select('ud.id main_user_id, c.time conn_time, c.date conn_date, firstname, lastname, name, propic, ud.type_id user_type, c.*');
        $this->db->from('connection c');
        $this->db->join('user_details ud', 'ud.id = c.user_two', 'left');
        $this->db->join('user_info ui', 'ui.user_id = c.user_two', 'left');
        $this->db->join('org_info oi', 'oi.user_id = c.user_two', 'left');
        return $this->db->get()->result();
    }
    
    public function get_blocked_connection() {
        return $this->db->get_where('connection', array('blocked_by' => $this->session->userdata('user_id')))->result();
    }
    
    public function get_near_connection() {
        $id = $this->session->userdata('user_id');
        $country = $this->info->country;
        $query_one = $this->db->query("SELECT propic, user_level, type_id, ud.id main_id, ud.time user_time, ui.user_id user_id, oi.user_id org_id, ui.city user_city, ui.state user_state, ui.country user_country, ui.*, oi.* FROM user_details ud LEFT JOIN user_info ui on ui.user_id = ud.id LEFT JOIN org_info oi on oi.user_id = ud.id WHERE ud.id NOT IN (SELECT user_one FROM connection WHERE user_two = $id UNION SELECT user_two FROM connection WHERE user_one = $id) AND is_complete > 0 AND is_active = 1 AND ud.id != $id AND (ui.country LIKE '%$country%' OR oi.country LIKE '%$country%') ORDER BY RAND() DESC LIMIT 24")->result();
        if(count($query_one) != 0 && count($query_one) == 24) {
            return $query_one;
        } else if(count($query_one) != 0 && count($query_one) < 24) {
            $count = 24 - count($query_one);
            $query_two = $this->db->query("SELECT propic, user_level, type_id, ud.id main_id, ud.time user_time, ui.user_id user_id, oi.user_id org_id, ui.city user_city, ui.state user_state, ui.country user_country, ui.*, oi.* FROM user_details ud LEFT JOIN user_info ui on ui.user_id = ud.id LEFT JOIN org_info oi on oi.user_id = ud.id WHERE ud.id NOT IN (SELECT user_one FROM connection WHERE user_two = $id UNION SELECT user_two FROM connection WHERE user_one = $id) AND is_complete > 0 AND is_active = 1 AND ud.id != $id AND (ui.country NOT LIKE '%$country%' OR oi.country NOT LIKE '%$country%') ORDER BY RAND() DESC LIMIT $count")->result();
            return array_merge($query_one, $query_two);
        } else {
            return $this->db->query("SELECT propic, user_level, type_id, ud.id main_id, ud.time user_time, ui.user_id user_id, oi.user_id org_id, ui.city user_city, ui.state user_state, ui.country user_country, ui.*, oi.* FROM user_details ud LEFT JOIN user_info ui on ui.user_id = ud.id LEFT JOIN org_info oi on oi.user_id = ud.id WHERE ud.id NOT IN (SELECT user_one FROM connection WHERE user_two = $id UNION SELECT user_two FROM connection WHERE user_one = $id) AND is_complete > 0 AND is_active = 1 AND ud.id != $id ORDER BY RAND() DESC LIMIT 24")->result();
        }
    }
    
    public function get_all_near_connection() {
        $id = $this->session->userdata('user_id');
        $country = $this->info->country;
        $query_one = $this->db->query("SELECT propic, user_level, type_id, ud.id main_id, ud.time user_time, ui.user_id user_id, oi.user_id org_id, ui.city user_city, ui.state user_state, c.country_name user_country, co.country_name org_country, ui.*, oi.* FROM user_details ud LEFT JOIN user_info ui on ui.user_id = ud.id LEFT JOIN org_info oi on oi.user_id = ud.id LEFT JOIN countries c on c.country_code = ui.country LEFT JOIN countries co on co.country_code = oi.country WHERE ud.id NOT IN (SELECT user_one FROM connection WHERE user_two = $id UNION SELECT user_two FROM connection WHERE user_one = $id) AND is_complete != 0 AND is_active = 1 AND ud.id != $id AND (ui.country LIKE '%$country%' OR oi.country LIKE '%$country%') ORDER BY ud.time DESC")->result();
        $query_two = $this->db->query("SELECT propic, user_level, type_id, ud.id main_id, ud.time user_time, ui.user_id user_id, oi.user_id org_id, ui.city user_city, ui.state user_state, c.country_name user_country, co.country_name org_country, ui.*, oi.* FROM user_details ud LEFT JOIN user_info ui on ui.user_id = ud.id LEFT JOIN org_info oi on oi.user_id = ud.id LEFT JOIN countries c on c.country_code = ui.country LEFT JOIN countries co on co.country_code = oi.country WHERE ud.id NOT IN (SELECT user_one FROM connection WHERE user_two = $id UNION SELECT user_two FROM connection WHERE user_one = $id) AND is_complete != 0 AND is_active = 1 AND ud.id != $id AND (ui.country NOT LIKE '%$country%' OR oi.country NOT LIKE '%$country%') ORDER BY ud.time DESC")->result();
        return array_merge($query_one, $query_two);
    }
    
    public function get_near_groups() {
        $arr = array();
        $id = $this->session->userdata('user_id');
        $grp_ids = $this->db->get_where('groups', array('user_id' => $this->session->userdata('user_id')))->result();
        if(count($grp_ids) > 0) {
            foreach ($grp_ids as $g) {
                $arr[] = $g->id;
            }
            $grp_id = implode(',', $arr); 
            return $this->db->query("SELECT g.id main_id, g.time group_time, type_id, firstname, lastname, name, g.* FROM groups g LEFT JOIN user_details ud on ud.id = g.user_id LEFT JOIN user_info ui on ui.user_id = g.user_id LEFT JOIN org_info oi on oi.user_id = g.user_id WHERE g.id NOT IN (SELECT group_id FROM group_users WHERE user_id = $id AND status = 1) AND g.id NOT IN ($grp_id) ORDER BY g.time DESC LIMIT 8")->result();
        } else {
            return $this->db->query("SELECT g.id main_id, g.time group_time, type_id, firstname, lastname, name, g.* FROM groups g LEFT JOIN user_details ud on ud.id = g.user_id LEFT JOIN user_info ui on ui.user_id = g.user_id LEFT JOIN org_info oi on oi.user_id = g.user_id WHERE g.id NOT IN (SELECT group_id FROM group_users WHERE user_id = $id AND status = 1) ORDER BY g.time DESC LIMIT 8")->result();
        }
    }
    
    public function get_all_near_groups() {
        $id = $this->session->userdata('user_id');
        return $this->db->query("SELECT g.id main_id, g.time group_time, type_id, firstname, lastname, name, g.* FROM groups g LEFT JOIN user_details ud on ud.id = g.user_id LEFT JOIN user_info ui on ui.user_id = g.user_id LEFT JOIN org_info oi on oi.user_id = g.user_id WHERE g.id NOT IN (SELECT group_id FROM group_users WHERE user_id = $id AND status = 1) AND g.user_id != $id ORDER BY g.time DESC")->result();
    }

    public function get_profile_user_timeline($id, $status) {
        $this->db->limit(10);     
        $this->db->order_by('t.time', 'DESC');
        if($status === 'same') {
            $this->db->where(array('t.user_id' => $id));
        }
        if($status === 'not_valid' || $status === 'accept' || $status === 'cancel' || $status === 'following') {
            $this->db->where(array('t.user_id' => $id, 't.privacy' => 0));
        }
        if($status === 'friend') {
            $this->db->where_in('privacy', array(0,1));
            $this->db->where(array('t.user_id' => $id));
        }
        $this->db->select('t.id timeline_post_id, t.user_id post_user_id, t.time post_time, t.date post_date, firstname, lastname, name, propic, ud.type_id user_type, t.*');
        $this->db->from('timeline t');
        $this->db->join('user_details ud', 'ud.id = t.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = t.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = t.user_id', 'left');
        return $this->db->get()->result();
    }
    
    public function getmore_profile_user_timeline($id, $last_id, $status) {
        $this->db->limit(10);     
        $this->db->order_by('t.time', 'DESC');
        if($status === 'same') {
            $this->db->where(array('t.user_id' => $id, 't.time <' => $last_id));
        }
        if($status === 'not_valid' || $status === 'accept' || $status === 'cancel') {
            $this->db->where(array('t.user_id' => $id, 't.privacy' => 0, 't.time <' => $last_id));
        }
        if($status === 'friend') {
            $this->db->where_in('t.privacy', array(0,1));
            $this->db->where(array('t.user_id' => $id, 't.time <' => $last_id));
        }
        $this->db->select('t.id timeline_post_id, t.user_id post_user_id, t.time post_time, t.date post_date, firstname, lastname, name, propic, ud.type_id user_type, t.*');
        $this->db->from('timeline t');
        $this->db->join('user_details ud', 'ud.id = t.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = t.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = t.user_id', 'left');
        return $this->db->get()->result();
    }
    
    public function get_profile_listing($id) {
        $this->db->limit(5);     
        $this->db->order_by('post.time', 'DESC');
        $this->db->where(array('post.user_id' => $id));
        $this->db->select('post.*, post.id main_post_id, post.time main_post_time, post.date main_post_date, user.id main_user_id, info.firstname fname, info.lastname lname, oi.name company_name, user.propic pro_pic, user.type_id user_type, cntry.country_name loc, cat.category main_cat');
        $this->db->from('ads post');
        $this->db->join('ad_category cat', 'cat.id = post.cat_id', 'left');
        $this->db->join('user_info info', 'info.user_id = post.user_id', 'left');
        $this->db->join('user_details user', 'user.id = post.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = post.user_id', 'left');
        $this->db->join('countries cntry', 'cntry.country_code = post.country_code','left');
        return $this->db->get()->result();
    }
    
    public function get_more_profile_listing($id, $last_id) {
        $this->db->limit(5);     
        $this->db->order_by('post.time', 'DESC');
        $this->db->where(array('post.time <' => $last_id, 'post.user_id' => $id));
        $this->db->select('post.*, post.id main_post_id, post.time main_post_time, post.date main_post_date, user.id main_user_id, info.firstname fname, info.lastname lname, oi.name company_name, user.propic pro_pic, user.type_id user_type, cntry.country_name loc, cat.category main_cat');
        $this->db->from('ads post');
        $this->db->join('ad_category cat', 'cat.id = post.cat_id', 'left');
        $this->db->join('user_info info', 'info.user_id = post.user_id', 'left');
        $this->db->join('user_details user', 'user.id = post.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = post.user_id', 'left');
        $this->db->join('countries cntry', 'cntry.country_code = post.country_code','left');
        return $this->db->get()->result();
    }
    
    public function get_profile_job($id) {
        $this->db->limit(5);     
        $this->db->order_by('jobs.time', 'DESC');
        $this->db->where(array('jobs.user_id' => $id));
        $this->db->select('jobs.*, ui.*, oi.*, jobs.id main_job_id, jobs.user_id main_user_id, ud.type_id user_type, propic, email, jobs.time job_time, jobs.date job_date, job_categories.job_cat_name, job_levels.level_name, job_type.jobtype_name, countries.country_name');
        $this->db->from('jobs');
        $this->db->join('job_categories','job_categories.id = jobs.job_cat_id', 'left');
        $this->db->join('countries','countries.country_code = jobs.job_country', 'left');
        $this->db->join('job_levels','job_levels.id = jobs.exp_level', 'left');
        $this->db->join('job_type','job_type.id = jobs.employment_type', 'left');
        $this->db->join('user_details ud', 'ud.id = jobs.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = jobs.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = jobs.user_id', 'left');
        return $this->db->get()->result();
    }
    
    public function get_more_profile_job($id, $last_id) {
        $this->db->limit(5);     
        $this->db->order_by('jobs.time', 'DESC');
        $this->db->where(array('jobs.time <' => $last_id, 'jobs.user_id' => $id));
        $this->db->select('jobs.*, ui.*, oi.*, jobs.id main_job_id, jobs.user_id main_user_id, ud.type_id user_type, propic, email, jobs.time job_time, jobs.date job_date, job_categories.job_cat_name, job_levels.level_name, job_type.jobtype_name, countries.country_name');
        $this->db->from('jobs');
        $this->db->join('job_categories','job_categories.id = jobs.job_cat_id', 'left');
        $this->db->join('countries','countries.country_code = jobs.job_country', 'left');
        $this->db->join('job_levels','job_levels.id = jobs.exp_level', 'left');
        $this->db->join('job_type','job_type.id = jobs.employment_type', 'left');
        $this->db->join('user_details ud', 'ud.id = jobs.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = jobs.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = jobs.user_id', 'left');
        return $this->db->get()->result();
    }
    
    public function get_user_profile_blog($id, $status) {
        $this->db->limit(10);
        $this->db->order_by('time', 'DESC');
        if($status === 'same') {
            return $this->db->get_where('blog', array('user_id' => $id))->result();
        }
        if($status === 'not_valid' || $status === 'accept' || $status === 'cancel' || $status === 'following') {
            return $this->db->get_where('blog', array('user_id' => $id, 'privacy' => 0))->result();
        }
        if($status === 'friend') {
            $this->db->where_in('privacy', array(0,1));
            return $this->db->get_where('blog', array('user_id' => $id))->result();
        }
    }
    
    public function get_more_userprofile_blog($id, $last_id, $status) {
        $this->db->limit(10);
        $this->db->order_by('time', 'DESC');
        if($status === 'same') {
            return $this->db->get_where('blog', array('user_id' => $id, 'time <' => $last_id))->result();
        }
        if($status === 'not_valid' || $status === 'accept' || $status === 'cancel') {
            return $this->db->get_where('blog', array('user_id' => $id, 'privacy' => 0, 'time <' => $last_id))->result();
        }
        if($status === 'friend') {
            $this->db->where_in('privacy', array(0,1));
            return $this->db->get_where('blog', array('user_id' => $id, 'time <' => $last_id))->result();
        }
    }

    public function get_user_profile_gallery($id, $status, $type) {
        $this->db->limit(10);
        $this->db->order_by('time', 'DESC');
        if($status === 'same') {
            return $this->db->get_where('timeline', array('user_id' => $id, 'content_type' => $type))->result();
        }
        if($status === 'not_valid' || $status === 'accept' || $status === 'cancel' || $status === 'following') {
            return $this->db->get_where('timeline', array('user_id' => $id, 'privacy' => 0, 'content_type' => $type))->result();
        }
        if($status === 'friend') {
            $this->db->where_in('privacy', array(0,1));
            return $this->db->get_where('timeline', array('user_id' => $id, 'content_type' => $type))->result();
        }
    }
    
    public function get_more_userprofile_gallery($id, $last_id, $status, $type) {
        $this->db->limit(10);
        $this->db->order_by('time', 'DESC');
        if($status === 'same') {
            return $this->db->get_where('timeline', array('user_id' => $id, 'time <' => $last_id, 'content_type' => $type))->result();
        }
        if($status === 'not_valid' || $status === 'accept' || $status === 'cancel') {
            return $this->db->get_where('timeline', array('user_id' => $id, 'privacy' => 0, 'time <' => $last_id, 'content_type' => $type))->result();
        }
        if($status === 'friend') {
            $this->db->where_in('privacy', array(0,1));
            return $this->db->get_where('timeline', array('user_id' => $id, 'time <' => $last_id, 'content_type' => $type))->result();
        }
    }
    
    public function get_user_profile_connection($id) {
        return $this->db->query("SELECT * FROM connection WHERE user_one = $id AND status = 1 UNION SELECT * FROM connection WHERE user_two = $id AND status = 1")->result();
    }
    
    public function get_user_profile_connection_count($id) {
        return $this->db->query("SELECT * FROM connection WHERE user_one = $id AND status = 1 UNION SELECT * FROM connection WHERE user_two = $id AND status = 1")->num_rows();
    }
    
    public function get_user_profile_followers_count($id) {
        return $this->db->query("SELECT * FROM connection WHERE user_two = $id AND status = 3")->num_rows();
    }
    
    public function insert_group($data) {
        $this->db->insert('groups', $data);
    }
    
    public function get_user_created_groups() {
        $this->db->order_by('time', 'DESC');
        return $this->db->get_where('groups', array('user_id' => $this->session->userdata('user_id')))->result();
    }
    
    public function get_profile_user_created_groups($id) {
        $this->db->order_by('time', 'DESC');
        return $this->db->get_where('groups', array('user_id' => $id))->result();
    }
    
    public function get_user_joined_groups() {
        $this->db->order_by('g.time', 'DESC');
        $this->db->where(array('gu.user_id' => $this->session->userdata('user_id'), 'status' => 1));
        $this->db->select('g.id main_id, , g.*, gu.*');
        $this->db->from('group_users gu');
        $this->db->join('groups g', 'g.id = gu.group_id', 'left');
        return $this->db->get()->result();
    }
    
    public function get_profile_user_joined_groups($id) {
        $this->db->order_by('g.time', 'DESC');
        $this->db->where(array('gu.user_id' => $id, 'status' => 1));
        $this->db->select('g.id main_id, , g.*, gu.*');
        $this->db->from('group_users gu');
        $this->db->join('groups g', 'g.id = gu.group_id', 'left');
        return $this->db->get()->result();
    }
    
    public function get_profile_user_joined_groups_count($id) {
        $this->db->order_by('g.time', 'DESC');
        $this->db->where(array('gu.user_id' => $id, 'status' => 1));
        $this->db->select('g.id main_id, , g.*, gu.*');
        $this->db->from('group_users gu');
        $this->db->join('groups g', 'g.id = gu.group_id', 'left');
        return $this->db->get()->num_rows();
    }
    
    public function get_curr_user_group($id) {
        return $this->db->get_where('groups', array('id' => $id, 'user_id' => $this->session->userdata('user_id')))->row();
    }

    public function delete_group($id) {
        if($this->db->get_where('groups', array('id' => $id, 'user_id' => $this->session->userdata('user_id')))->num_rows() > 0) {
            $banner = $this->db->get_where('groups', array('id' => $id, 'user_id' => $this->session->userdata('user_id')))->row()->banner;
            if($banner != '') {
                unlink('assets/userdata/dashboard/group/banner/' . $banner);
            }
            $posts = $this->db->get_where('group_content', array('group_id' => $id))->result();
            if(count($posts) > 0) {
                foreach($posts as $post) {
                    if($post->file != '') {
                        $file = explode(',', $post->file);
                        foreach ($file as $f) {
                            unlink('assets/userdata/dashboard/group/content/' . $f);
                        }
                    }
                    $this->db->delete('comments', array('type' => 'group', 'type_id' => $post->id));
                    $this->db->delete('like_dislike', array('type' => 'group', 'type_id' => $post->id));
                }
            }
            $this->db->delete('group_content', array('group_id' => $id));
            $this->db->delete('group_users', array('group_id' => $id));
            $this->db->delete('groups', array('id' => $id, 'user_id' => $this->session->userdata('user_id')));
            return TRUE;
        }  
    }
    
    public function update_group($data, $file, $id) {
        if ($file == '') {
            $this->db->where(array('id' => $id, 'user_id' => $this->session->userdata('user_id')));
            $this->db->update('groups', $data);
        } else {
            $this->db->where(array('id' => $id, 'user_id' => $this->session->userdata('user_id')));
            $this->db->update('groups', $data);
            $this->db->where(array('id' => $id, 'user_id' => $this->session->userdata('user_id')));
            $this->db->update('groups', array('banner' => $file));
        }
    }
    
    public function check_group($grp_id) {
        $cur_id = $this->session->userdata('user_id');
        $query = $this->db->query("SELECT * FROM group_users WHERE group_id = $grp_id AND user_id = $cur_id");
        if ($query->num_rows() > 0) {
            switch ($query->row()->status) {
                case 0 : $return = 'pending';
                    break;
                case 1 : $return = 'approved';
                    break;
                case 2 : $return = 'accept';
                    break;
            }
            return $return;
        } else {
            return 'not_valid';
        }
    }
    
    public function check_user_group($grp_id) {
        return $this->db->get_where('groups', array('id' => $grp_id, 'user_id' => $this->session->userdata('user_id')))->num_rows();
    }
    
    public function join_group($grp_id) {
        $this->db->insert('group_users', array('user_id' => $this->session->userdata('user_id'), 'group_id' => $grp_id, 'status' => 0, 'time' => time(), 'date' => date('d M Y')));
        return TRUE;
    }
    
    public function accept_group($grp_id) {
        $this->db->where(array('group_id' => $grp_id, 'user_id' => $this->session->userdata('user_id')));
        $this->db->update('group_users', array('status' => 1));
        return TRUE;
    }
    
    public function cancel_group_req($grp_id) {
        $cur_id = $this->session->userdata('user_id');
        $query = $this->db->query("SELECT * FROM group_users WHERE user_id = $cur_id AND group_id = $grp_id");
        if ($query->num_rows() > 0) {
            $id = $query->row()->id;
            $this->db->delete('group_users', array('id' => $id));
            return TRUE;
        }
    }
    
    public function validate_group($id) {
        if($this->db->get_where('groups', array('id' => $id))->num_rows() > 0) {
            return TRUE;
        }
    }
    
    public function get_group($id) {
        $this->db->where('g.id', $id);
        $this->db->select('g.id main_id, g.user_id main_user_id, g.time group_time, type_id, firstname, lastname, name, g.*');
        $this->db->from('groups g');
        $this->db->join('user_details ud', 'ud.id = g.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = g.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = g.user_id', 'left');
        return $this->db->get()->row();
    }
    
    public function get_joined_group_members($group_id) {
        return $this->db->get_where('group_users', array('group_id' => $group_id, 'status' => 1))->result();
    }
    
    public function get_new_group_members($group_id) {
        return $this->db->get_where('group_users', array('group_id' => $group_id, 'status' => 0))->result();
    }
    
    public function check_grp_invite_user($user_id, $group_id) {
        $this->db->where_in('status', array(0,1,2));
        $this->db->where(array('group_id' => $group_id, 'user_id' => $user_id,));
        return $this->db->get('group_users')->num_rows();
    }
    
    public function add_grp_invitations($grp_id, $invites) {
        foreach($invites as $invite) {
            if($invite != 0) {
                $this->db->insert('group_users', array('user_id' => $invite, 'group_id' => $grp_id, 'status' => 2, 'invited' => 1, 'time' => time(), 'date' => date('d M Y')));
            }
        }
    }
    
    public function get_all_new_group_members() {
        $grp_id = array();
        $id = $this->session->userdata('user_id');
        $data = $this->db->query("SELECT * FROM groups WHERE user_id = $id")->result();
        foreach($data as $d) {
            $grp_id[] = $d->id;
        }
        if(count($grp_id) > 0) {
            $this->db->order_by('gu.time', 'DESC');
            $this->db->where('gu.status', 0);
            $this->db->where_in('gu.group_id', $grp_id);
            $this->db->select('gu.group_id main_grp_id, gu.time group_time, type_id, firstname, lastname, name, propic, ud.type_id user_type, title');
            $this->db->from('group_users gu');
            $this->db->join('user_details ud', 'ud.id = gu.user_id', 'left');
            $this->db->join('user_info ui', 'ui.user_id = gu.user_id', 'left');
            $this->db->join('org_info oi', 'oi.user_id = gu.user_id', 'left');
            $this->db->join('groups g', 'g.id = gu.group_id', 'left');
            return $this->db->get()->result();
        }
    }
    
    public function get_all_accepted_groups() {
        $id = $this->session->userdata('user_id');
        $this->db->order_by('gu.time', 'DESC');
        $this->db->where(array('gu.status' => 1, 'gu.user_id' => $id));
        $this->db->select('gu.group_id main_grp_id, gu.time group_time, type_id, firstname, lastname, name, propic, ud.type_id user_type, title, banner');
        $this->db->from('group_users gu');
        $this->db->join('user_details ud', 'ud.id = gu.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = gu.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = gu.user_id', 'left');
        $this->db->join('groups g', 'g.id = gu.group_id', 'left');
        return $this->db->get()->result();
    }
    
    public function get_all_invited_groups() {
        $id = $this->session->userdata('user_id');
        $this->db->order_by('gu.time', 'DESC');
        $this->db->where(array('gu.status' => 2, 'gu.user_id' => $id));
        $this->db->select('gu.group_id main_grp_id, gu.time group_time, type_id, firstname, lastname, name, propic, ud.type_id user_type, title, banner');
        $this->db->from('group_users gu');
        $this->db->join('groups g', 'g.id = gu.group_id', 'left');
        $this->db->join('user_details ud', 'ud.id = g.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = g.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = g.user_id', 'left');
        return $this->db->get()->result();
    }
    
    public function get_latest_all_new_group_members($first_id) {
        $grp_id = array();
        $id = $this->session->userdata('user_id');
        $data = $this->db->query("SELECT * FROM groups WHERE user_id = $id")->result();
        foreach($data as $d) {
            $grp_id[] = $d->id;
        }
        if(count($grp_id) > 0) {
            $this->db->order_by('gu.time', 'DESC');
            $this->db->where(array('gu.status' => 0, 'gu.time >' => $first_id));
            $this->db->where_in('gu.group_id', $grp_id);
            $this->db->select('gu.group_id main_grp_id, gu.time group_time, type_id, firstname, lastname, name, propic, ud.type_id user_type, title');
            $this->db->from('group_users gu');
            $this->db->join('user_details ud', 'ud.id = gu.user_id', 'left');
            $this->db->join('user_info ui', 'ui.user_id = gu.user_id', 'left');
            $this->db->join('org_info oi', 'oi.user_id = gu.user_id', 'left');
            $this->db->join('groups g', 'g.id = gu.group_id', 'left');
            return $this->db->get()->result();
        }
    }
    
    public function get_latest_all_accepted_group_members($first_id) {
        $id = $this->session->userdata('user_id');
        $this->db->order_by('gu.time', 'DESC');
        $this->db->where(array('gu.status' => 1, 'gu.time >' => $first_id, 'gu.user_id' => $id));
        $this->db->select('gu.group_id main_grp_id, gu.time group_time, type_id, firstname, lastname, name, propic, ud.type_id user_type, title, banner');
        $this->db->from('group_users gu');
        $this->db->join('user_details ud', 'ud.id = gu.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = gu.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = gu.user_id', 'left');
        $this->db->join('groups g', 'g.id = gu.group_id', 'left');
        return $this->db->get()->result();
    }
    
    public function get_latest_all_invited_group_members($first_id) {
        $id = $this->session->userdata('user_id');
        $this->db->order_by('gu.time', 'DESC');
        $this->db->where(array('gu.status' => 2, 'gu.time >' => $first_id, 'gu.user_id' => $id));
        $this->db->select('gu.group_id main_grp_id, gu.time group_time, type_id, firstname, lastname, name, propic, ud.type_id user_type, title, banner');
         $this->db->from('group_users gu');
        $this->db->join('groups g', 'g.id = gu.group_id', 'left');
        $this->db->join('user_details ud', 'ud.id = g.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = g.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = g.user_id', 'left');
        return $this->db->get()->result();
    }
    
    public function accept_grp_member($user_id) {
        $this->db->where(array('user_id' => $user_id, 'group_id' => $this->session->userdata('grp_id')));
        $this->db->update('group_users', array('status' => 1));
    }
    
    public function remove_grp_member($user_id) {
        $this->db->delete('group_users', array('user_id' => $user_id, 'group_id' => $this->session->userdata('grp_id')));
    }
    
    public function add_grp_content($data) {
        $this->db->insert('group_content', $data);
    }
    
    public function get_grp_content($id) {
        return $this->db->get_where('group_content', array('id' => $id))->row();
    }
    
    public function get_grp_timeline($grp_id) {
        $this->db->limit(10);     
        $this->db->order_by('gc.time', 'DESC');
        $this->db->where(array('gc.group_id' => $grp_id));
        $this->db->select('gc.id timeline_post_id, gc.user_id post_user_id, gc.time post_time, gc.date post_date, firstname, lastname, name, propic, ud.type_id user_type, gc.*');
        $this->db->from('group_content gc');
        $this->db->join('user_details ud', 'ud.id = gc.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = gc.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = gc.user_id', 'left');
        return $this->db->get()->result();
    }
    
    public function getmore_grp_timeline($grp_id, $last_id) {
        $this->db->limit(10);     
        $this->db->order_by('gc.time', 'DESC');
        $this->db->where(array('gc.group_id' => $grp_id, 'gc.time <' => $last_id));
        $this->db->select('gc.id timeline_post_id, gc.user_id post_user_id, gc.time post_time, gc.date post_date, firstname, lastname, name, propic, ud.type_id user_type, gc.*');
        $this->db->from('group_content gc');
        $this->db->join('user_details ud', 'ud.id = gc.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = gc.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = gc.user_id', 'left');
        return $this->db->get()->result();
    }
    
    public function group_timeline_post_check($grp_id, $post_id) {
        return $this->db->get_where('group_content', array('user_id' => $this->session->userdata('user_id'), 'id' => $post_id, 'group_id' => $grp_id))->num_rows();
    }
    
    public function delete_group_timeline_post($post_id) {
        $post = $this->db->get_where('group_content', array('id' => $post_id))->row();
        if($post->file != '') {
            $file = explode(',', $post->file);
            foreach ($file as $f) {
                unlink('assets/userdata/dashboard/group/content/' . $f);
            }
        }
        $this->db->delete('group_content', array('id' => $post_id));
        $this->db->delete('comments', array('type' => 'group', 'type_id' => $post_id));
        $this->db->delete('like_dislike', array('type' => 'group', 'type_id' => $post_id));
    }
    
    public function check_accepted_grp($grp_id) {
        $status = $this->db->get_where('group_users', array('group_id' => $grp_id, 'user_id' => $this->session->userdata('user_id')))->row()->invited;
        if($status == 1) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function user_like_status($type_id, $type) {
        return $this->db->get_where('like_dislike', array('status' => 1, 'type' => $type, 'type_id' => $type_id, 'user_id' => $this->session->userdata('user_id')))->num_rows();
    }
    
    public function user_dislike_status($type_id) {
        return $this->db->get_where('like_dislike', array('status' => 2,'type' => 'ad', 'type_id' => $type_id, 'user_id' => $this->session->userdata('user_id')))->num_rows();
    }
    
    public function user_like_comment_status($comment_id) {
        return $this->db->get_where('like_dislike', array('status' => 1, 'type' => 'comment', 'type_id' => $comment_id, 'user_id' => $this->session->userdata('user_id')))->num_rows();
    }
    
    public function add_like($type_id, $type, $table) {
        $likes = $this->db->get_where($table, array('id' => $type_id))->row()->likes + 1;
        $this->db->where(array('id' => $type_id));
        $this->db->update($table, array('likes' => $likes));
        $this->db->insert('like_dislike', array('user_id' => $this->session->userdata('user_id'), 'type_id' => $type_id, 'status' => 1, 'type' => $type, 'time' => time(), 'date' => date('d M Y')));
    }
    
    public function remove_like($type_id, $type, $table) {
        $likes = $this->db->get_where($table, array('id' => $type_id))->row()->likes - 1;
        $this->db->where(array('id' => $type_id));
        $this->db->update($table, array('likes' => $likes));
        $this->db->delete('like_dislike', array('user_id' => $this->session->userdata('user_id'), 'type_id' => $type_id, 'type' => $type, 'status' => 1));
    }
    
    public function add_ad_like($type_id) {
        $likes = $this->db->get_where('ads', array('id' => $type_id))->row()->likes + 1;
        $this->db->where(array('id' => $type_id));
        $this->db->update('ads', array('likes' => $likes));
        $count = $this->db->get_where('like_dislike', array('status' => 2,'type' => 'ad', 'type_id' => $type_id, 'user_id' => $this->session->userdata('user_id')))->num_rows();
        if($count == 1) {
            $this->db->where(array('user_id' => $this->session->userdata('user_id'), 'type_id' => $type_id, 'type' => 'ad'));
            $this->db->update('like_dislike', array('status' => 1));
            $dislikes = $this->db->get_where('ads', array('id' => $type_id))->row()->dislikes - 1;
            $this->db->where(array('id' => $type_id));
            $this->db->update('ads', array('dislikes' => $dislikes));
        } else {
            $this->db->insert('like_dislike', array('user_id' => $this->session->userdata('user_id'), 'type_id' => $type_id, 'status' => 1, 'type' => 'ad', 'time' => time(), 'date' => date('d M Y')));
        }
    }
    
    public function add_ad_dislike($type_id) {
        $dislikes = $this->db->get_where('ads', array('id' => $type_id))->row()->dislikes + 1;
        $this->db->where(array('id' => $type_id));
        $this->db->update('ads', array('dislikes' => $dislikes));
        $count = $this->db->get_where('like_dislike', array('status' => 1,'type' => 'ad', 'type_id' => $type_id, 'user_id' => $this->session->userdata('user_id')))->num_rows();
        if($count == 1) {
            $this->db->where(array('user_id' => $this->session->userdata('user_id'), 'type_id' => $type_id, 'type' => 'ad'));
            $this->db->update('like_dislike', array('status' => 2));
            $likes = $this->db->get_where('ads', array('id' => $type_id))->row()->likes - 1;
            $this->db->where(array('id' => $type_id));
            $this->db->update('ads', array('likes' => $likes));
        } else {
            $this->db->insert('like_dislike', array('user_id' => $this->session->userdata('user_id'), 'type_id' => $type_id, 'status' => 2, 'type' => 'ad', 'time' => time(), 'date' => date('d M Y')));
        }
    }
    
    public function remove_dislike($type_id) {
        $dislikes = $this->db->get_where('ads', array('id' => $type_id))->row()->dislikes - 1;
        $this->db->where(array('id' => $type_id));
        $this->db->update('ads', array('dislikes' => $dislikes));
        $this->db->delete('like_dislike', array('user_id' => $this->session->userdata('user_id'), 'type_id' => $type_id, 'type' => 'ad', 'status' => 2));
    }
    
    public function get_liked_users($id, $type) {
        return  $this->db->get_where('like_dislike', array('status' => 1,'type' => $type, 'type_id' => $id))->result();
    }
    
    public function get_disliked_users($id, $type) {
        return  $this->db->get_where('like_dislike', array('status' => 2,'type' => $type, 'type_id' => $id))->result();
    }
    
    public function add_comment($type_id, $type, $comment) {
        $this->db->insert('comments', array('type' => $type, 'type_id' => $type_id, 'user_id' => $this->session->userdata('user_id'), 'comment' => $comment, 'time' => time(), 'date' => date('d M Y')));
    }
    
    public function add_child_comment($parent_id, $comment) {
        $parent = $this->db->get_where('comments', array('id' => $parent_id))->row();
        $this->db->insert('comments', array('is_child' => 1, 'parent_id' => $parent_id, 'type' => $parent->type, 'type_id' => $parent->type_id, 'user_id' => $this->session->userdata('user_id'), 'comment' => $comment, 'time' => time(), 'date' => date('d M Y')));
    }
    
    public function get_comment_user_id($type_id, $type) {
        if($type == 'blog') {
            return $this->get_user_single_blog($type_id)->main_user_id;
        } elseif($type == 'ad') {
            return $this->get_single_post($type_id)->main_user_id;
        } elseif($type == 'group') {
            return $this->get_grp_content($type_id)->user_id;
        } elseif($type == 'thought' || $type == 'location' || $type == 'file' || $type == 'image' || $type == 'video' || $type == 'action') {
            return $this->get_activity($type_id)->post_user_id;
        }
    }
    
    public function get_comment_row($id) {
        return  $this->db->get_where('comments', array('id' => $id))->row();
    }
    
    public function get_child_comment_user_id($parent_type_id) {
        return $this->db->get_where('comments', array('id' => $parent_type_id))->row()->user_id;
    }
    
    public function get_comment($type_id, $type) {
        $this->db->order_by('c.time', 'ASC');
        $this->db->where(array('c.type' => $type, 'c.type_id' => $type_id, 'is_child' => 0));
        $this->db->select('c.id comment_id, c.user_id comment_user_id, c.time comment_time, c.type_id comment_type_id, firstname, lastname, name, propic, ud.type_id user_type, c.*');
        $this->db->from('comments c');
        $this->db->join('user_details ud', 'ud.id = c.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = c.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = c.user_id', 'left');
        return $this->db->get()->result();
    }
    
    public function get_child_comment($parent_id) {
        $this->db->order_by('c.time', 'ASC');
        $this->db->where(array('c.parent_id' => $parent_id, 'is_child' => 1));
        $this->db->select('c.id comment_id, c.user_id comment_user_id, c.time comment_time, c.type_id comment_type_id, firstname, lastname, name, propic, ud.type_id user_type, c.*');
        $this->db->from('comments c');
        $this->db->join('user_details ud', 'ud.id = c.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = c.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = c.user_id', 'left');
        return $this->db->get()->result();
    }
    
    public function delete_comment($id) {
        $row =  $this->db->get_where('comments', array('id' => $id))->row();
        if($row->type == 'blog') {
            $user = $this->get_blog_activity($row->type_id)->post_user_id;
        } elseif($row->type == 'ad') {
            $user =  $this->get_ad_activity($row->type_id)->post_user_id;
        } elseif($row->type == 'group') {
            $user =  $this->get_grp_content($row->type_id)->user_id;
        } elseif($row->type == 'thought' || $row->type == 'location' || $row->type == 'file' || $row->type == 'image' || $row->type == 'video' || $row->type == 'action') {
            $user =  $this->get_activity($row->type_id)->post_user_id;
        }
        if($row->user_id == $this->session->userdata('user_id') || $user == $this->session->userdata('user_id')) {
            $this->db->delete('comments', array('id' => $id));
            $val = $this->db->get_where('comments', array('parent_id' => $id))->num_rows();
            if($val > 0) {
                $this->db->delete('comments', array('parent_id' => $id));
            }
            $this->db->delete('like_dislike', array('type_id' => $id, 'type' => 'comment'));
        }
    }
    
    public function check_user_comment($comment_id) {
        $row =  $this->db->get_where('comments', array('id' => $comment_id))->row();
        if($row->type == 'blog') {
            $user = $this->get_blog_activity($row->type_id)->post_user_id;
        } elseif($row->type == 'ad') {
            $user =  $this->get_ad_activity($row->type_id)->post_user_id;
        } elseif($row->type == 'group') {
            $user =  $this->get_grp_content($row->type_id)->user_id;
        } elseif($row->type == 'thought' || $row->type == 'location' || $row->type == 'file' || $row->type == 'image' || $row->type == 'video' || $row->type == 'action') {
            $user =  $this->get_activity($row->type_id)->post_user_id;
        }
        if($row->user_id == $this->session->userdata('user_id') || $user == $this->session->userdata('user_id')) {
            return TRUE;
        }
    }
    
    public function get_comment_replies($comment_id) {
        return $this->db->get_where('comments', array('parent_id' => $comment_id))->num_rows();
    }
    
    public function get_comment_count($type_id, $type) {
        return $this->db->get_where('comments', array('type' => $type, 'type_id' => $type_id, 'is_child' => 0))->num_rows();
    }
    
    public function check_parent_comment($id) {
        $parent_id = $this->db->get_where('comments', array('id' => $id))->row()->is_child;
        if($parent_id == 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function add_timeline_content($data) {
        $this->db->insert('timeline', $data);
        $meter =  $this->db->get_where('user_details', array('id' => $this->session->userdata('user_id')))->row()->is_complete;
        if($meter == 4) {
            $this->db->where(array('id' => $this->session->userdata('user_id')));
            $this->db->update('user_details', array('is_complete' => 5));
        }
    }
    
    public function user_timeline_post_check($post_id) {
        return $this->db->get_where('timeline', array('user_id' => $this->session->userdata('user_id'), 'id' => $post_id))->num_rows();
    }
    
    public function delete_user_timeline_post($post_id) {
        if($this->db->get_where('timeline', array('id' => $post_id, 'user_id' => $this->session->userdata('user_id')))->num_rows() > 0) {
            $post = $this->db->get_where('timeline', array('id' => $post_id, 'user_id' => $this->session->userdata('user_id')))->row();
            if($post->file != '' && $post->parent_id == '') {
                $file = explode(',', $post->file);
                foreach ($file as $f) {
                    unlink('assets/userdata/dashboard/timeline/' . $f);
                }
            }
            if($post->blog_id != '' && $post->content_type == 'blog' && $post->parent_id == '') {
               $file = $this->db->get_where('blog', array('id' => $post->blog_id, 'user_id' => $this->session->userdata('user_id')))->row()->file;
                if($file != '') {
                    unlink('assets/userdata/dashboard/blog/' . $file);
                }
                $this->db->delete('blog', array('id' => $post->blog_id, 'user_id' => $this->session->userdata('user_id')));
                if($this->db->get_where('comments', array('type' => $post->content_type, 'type_id' => $post->blog_id))->num_rows() > 0) {
                    $comments = $this->db->get_where('comments', array('type' => $post->content_type, 'type_id' => $post->blog_id))->result();
                    foreach ($comments as $cmt) {
                        $this->db->delete('like_dislike', array('type' => 'comment', 'type_id' => $cmt->id));
                    }
                    $this->db->delete('comments', array('type' => $post->content_type, 'type_id' => $post->blog_id));
                }
                $this->db->delete('like_dislike', array('type' => $post->content_type, 'type_id' => $post->blog_id));
                $this->db->delete('timeline', array('blog_id' => $post->blog_id));
            }
            if($post->ad_id != '' && $post->content_type == 'ad' && $post->parent_id == '') {
               $images = $this->db->get_where('ads', array('id' => $post->ad_id, 'user_id' => $this->session->userdata('user_id')))->row()->img;
               $videos = $this->db->get_where('ads', array('id' => $post->ad_id, 'user_id' => $this->session->userdata('user_id')))->row()->video;
                if($videos != '') {
                    unlink('assets/userdata/dashboard/ads/' . $videos);
                }
                if($images != '') {
                    $arr = explode(',', $images);
                    foreach($arr as $img) {
                        unlink('assets/userdata/dashboard/ads/' . $img);
                    }
                }
                $this->db->delete('ads', array('id' => $post->ad_id, 'user_id' => $this->session->userdata('user_id')));
                if($this->db->get_where('comments', array('type' => $post->content_type, 'type_id' => $post->ad_id))->num_rows() > 0) {
                    $comments = $this->db->get_where('comments', array('type' => $post->content_type, 'type_id' => $post->ad_id))->result();
                    foreach ($comments as $cmt) {
                        $this->db->delete('like_dislike', array('type' => 'comment', 'type_id' => $cmt->id));
                    }
                    $this->db->delete('comments', array('type' => $post->content_type, 'type_id' => $post->ad_id));
                }
                $this->db->delete('like_dislike', array('type' => $post->content_type, 'type_id' => $post->ad_id));
                $this->db->delete('timeline', array('ad_id' => $post->ad_id));
                $action_data = $this->db->get_where('user_actions', array('ad_id' => $post->ad_id))->result();
                foreach ($action_data as $action) {
                    $action_sub_data = $this->db->get_where('timeline', array('action_id' => $action->id))->result();
                    foreach ($action_sub_data as $action_sub) {
                        $this->db->delete('comments', array('type' => 'action', 'type_id' => $action_sub->id));
                        if($this->db->get_where('comments', array('type' => 'action', 'type_id' => $action_sub->id))->num_rows() > 0) {
                            $comments = $this->db->get_where('comments', array('type' => 'action', 'type_id' => $action_sub->id))->result();
                            foreach ($comments as $cmt) {
                                $this->db->delete('like_dislike', array('type' => 'comment', 'type_id' => $cmt->id));
                            }
                            $this->db->delete('comments', array('type' => 'action', 'type_id' => $action_sub->id));
                        }
                    }
                    $this->db->delete('timeline', array('action_id' => $action->id));
                }
                $this->db->delete('user_actions', array('ad_id' => $post->ad_id));
            }
            if($post->parent_id == '') {
                $ids = $this->db->get_where('timeline', array('parent_id' => $post_id))->result();
                foreach ($ids as $id) {
                    if($this->db->get_where('comments', array('type_id' => $id->id, 'type' => $id->content_type))->num_rows() > 0) {
                        $comments = $this->db->get_where('comments', array('type_id' => $id->id, 'type' => $id->content_type))->result();
                        foreach ($comments as $cmt) {
                            $this->db->delete('like_dislike', array('type' => 'comment', 'type_id' => $cmt->id));
                        }
                        $this->db->delete('comments', array('type_id' => $id->id, 'type' => $id->content_type));
                    }
                    $this->db->delete('like_dislike', array('type_id' => $id->id, 'type' => $id->content_type));
                }
                $this->db->delete('timeline', array('parent_id' => $post_id));
            }
            $this->db->delete('timeline', array('id' => $post_id));
            if($this->db->get_where('comments', array('type' => $post->content_type, 'type_id' => $post_id))->num_rows() > 0) {
                $comments = $this->db->get_where('comments', array('type' => $post->content_type, 'type_id' => $post_id))->result();
                foreach ($comments as $cmt) {
                    $this->db->delete('like_dislike', array('type' => 'comment', 'type_id' => $cmt->id));
                }
                $this->db->delete('comments', array('type' => $post->content_type, 'type_id' => $post_id));
            }
            $this->db->delete('like_dislike', array('type' => $post->content_type, 'type_id' => $post_id));
        }        
    }
    
    public function get_timeline_privacy($post_id) {
        return $this->db->get_where('timeline', array('user_id' => $this->session->userdata('user_id'), 'id' => $post_id))->row()->privacy;
    }
    
    public function update_timeline_privacy($val, $post_id) {
        $post = $this->db->get_where('timeline', array('id' => $post_id, 'user_id' => $this->session->userdata('user_id')))->row();
        if($post->blog_id != '' && $post->content_type == 'blog') {
            $this->db->where(array('id' => $post->blog_id, 'user_id' => $this->session->userdata('user_id')));
            $this->db->update('blog', array('privacy' => $val));
        }
        $this->db->where(array('id' => $post_id, 'user_id' => $this->session->userdata('user_id')));
        $this->db->update('timeline', array('privacy' => $val));
    }
    
    public function get_user_newsfeed() {
        $feed_id = array();
        $id = $this->session->userdata('user_id');
        $frnds = $this->db->query("SELECT * FROM connection WHERE user_one = $id AND status = 1 UNION SELECT * FROM connection WHERE user_two = $id AND status = 1")->result();
        $followers = $this->db->query("SELECT * FROM connection WHERE user_one = $id AND status = 3")->result();
        foreach($frnds as $frnd) {
            if($frnd->user_one != $this->session->userdata('user_id')) {
                $feed_id[] = $frnd->user_one;
            } else {
                $feed_id[] = $frnd->user_two;
            }
        }
        foreach($followers as $frnd) {
            $feed_id[] = $frnd->user_two;
        }
        $feed_id[] = $id;
        $this->db->limit(10);     
        $this->db->order_by('t.time', 'DESC');
        $this->db->where_in('t.user_id', $feed_id);
        $this->db->select('t.id timeline_post_id, t.user_id post_user_id, t.time post_time, t.date post_date, firstname, lastname, name, propic, ud.type_id user_type, t.*');
        $this->db->from('timeline t');
        $this->db->join('user_details ud', 'ud.id = t.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = t.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = t.user_id', 'left');
        return $this->db->get()->result();
    }
    
    public function getmore_user_newsfeed($last_id) {
        $feed_id = array();
        $id = $this->session->userdata('user_id');
        $frnds = $this->db->query("SELECT * FROM connection WHERE user_one = $id AND status = 1 UNION SELECT * FROM connection WHERE user_two = $id AND status = 1")->result();
        $followers = $this->db->query("SELECT * FROM connection WHERE user_one = $id AND status = 3")->result();
        foreach($frnds as $frnd) {
            if($frnd->user_one != $this->session->userdata('user_id')) {
                $feed_id[] = $frnd->user_one;
            } else {
                $feed_id[] = $frnd->user_two;
            }
        }
        foreach($followers as $frnd) {
            $feed_id[] = $frnd->user_two;
        }
        $feed_id[] = $id;
        $this->db->limit(10);     
        $this->db->order_by('t.time', 'DESC');
        $this->db->where_in('t.user_id', $feed_id);
        $this->db->where(array('t.time <' => $last_id));
        $this->db->select('t.id timeline_post_id, t.user_id post_user_id, t.time post_time, t.date post_date, firstname, lastname, name, propic, ud.type_id user_type, t.*');
        $this->db->from('timeline t');
        $this->db->join('user_details ud', 'ud.id = t.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = t.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = t.user_id', 'left');
        return $this->db->get()->result();
    }
    
    public function get_trending_feed() {
        $this->db->limit(10);     
        $this->db->order_by('t.time', 'DESC');
        $this->db->select('t.id timeline_post_id, t.user_id post_user_id, t.time post_time, t.date post_date, firstname, lastname, name, propic, ud.type_id user_type, t.*');
        $this->db->from('timeline t');
        $this->db->join('user_details ud', 'ud.id = t.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = t.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = t.user_id', 'left');
        return $this->db->get()->result();
    }
    
    public function getmore_trending_feed($last_id) {
        $this->db->limit(10);     
        $this->db->order_by('t.time', 'DESC');
        $this->db->where(array('t.time <' => $last_id));
        $this->db->select('t.id timeline_post_id, t.user_id post_user_id, t.time post_time, t.date post_date, firstname, lastname, name, propic, ud.type_id user_type, t.*');
        $this->db->from('timeline t');
        $this->db->join('user_details ud', 'ud.id = t.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = t.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = t.user_id', 'left');
        return $this->db->get()->result();
    }
    
    public function add_notification_alert($id) {
        $rows = $this->db->get_where('notification', array('user_id' => $id, 'type' => 0))->num_rows();
        if($rows == 0) {
            $this->db->insert('notification', array('user_id' => $id, 'type' => 0));
        }
    }
    
    public function check_notification_alert() {
        return $this->db->get_where('notification', array('user_id' => $this->session->userdata('user_id'), 'type' => 0))->num_rows();
    }
    
    public function remove_notification_alert() {
        $this->db->delete('notification', array('user_id' => $this->session->userdata('user_id'), 'type' => 0));
    }
    
    public function add_req_notification_alert($id) {
        $rows = $this->db->get_where('notification', array('user_id' => $id, 'type' => 1))->num_rows();
        if($rows == 0) {
            $this->db->insert('notification', array('user_id' => $id, 'type' => 1));
        }
    }
    
    public function check_req_notification_alert() {
        return $this->db->get_where('notification', array('user_id' => $this->session->userdata('user_id'), 'type' => 1))->num_rows();
    }
    
    public function remove_req_notification_alert() {
        $this->db->delete('notification', array('user_id' => $this->session->userdata('user_id'), 'type' => 1));
    }
    
    public function recent_notifications() {
        $type_id = array();
        $id = $this->session->userdata('user_id');
        $data = $this->db->query("SELECT * FROM timeline WHERE user_id = $id")->result();
        foreach($data as $d) {
            if($d->content_type == 'blog') { $type_id[] = $d->blog_id; } elseif($d->content_type == 'ad') { $type_id[] = $d->ad_id; } else { $type_id[] = $d->id; }
        }
        $ids = implode(',', $type_id);
        if($ids != '') {
            return $this->db->query("SELECT c.id row_id, ud.id main_id, ud.type_id user_type, firstname, propic, lastname, name, c.type, c.date, c.time, c.type_id, c.comment FROM comments c LEFT JOIN user_details ud ON ud.id = c.user_id LEFT JOIN user_info ui ON ui.user_id = c.user_id LEFT JOIN org_info oi ON oi.user_id = c.user_id WHERE c.type_id IN($ids) AND c.user_id != $id UNION SELECT ld.id row_id, ud.id main_id, ud.type_id user_type, firstname, propic, lastname, name, ld.type, ld.status, ld.time, ld.type_id, ld.date FROM like_dislike ld LEFT JOIN user_details ud ON ud.id = ld.user_id LEFT JOIN user_info ui ON ui.user_id = ld.user_id LEFT JOIN org_info oi ON oi.user_id = ld.user_id WHERE ld.type_id IN($ids) AND ld.user_id != $id ORDER BY time DESC")->result();
        }
    }
    
    public function latest_recent_notifications($first_id) {
        $type_id = array();
        $id = $this->session->userdata('user_id');
        $data = $this->db->query("SELECT * FROM timeline WHERE user_id = $id")->result();
        foreach($data as $d) {
            if($d->content_type == 'blog') { $type_id[] = $d->blog_id; } elseif($d->content_type == 'ad') { $type_id[] = $d->ad_id; } else { $type_id[] = $d->id; }
        }
        $ids = implode(',', $type_id);
        if($ids != '') {
            return $this->db->query("SELECT * FROM (SELECT c.id row_id, ud.id main_id, ud.type_id user_type, firstname, propic, lastname, name, c.type, c.date, c.time, c.type_id, c.comment FROM comments c LEFT JOIN user_details ud ON ud.id = c.user_id LEFT JOIN user_info ui ON ui.user_id = c.user_id LEFT JOIN org_info oi ON oi.user_id = c.user_id WHERE c.type_id IN($ids) AND c.user_id != $id UNION SELECT ld.id row_id, ud.id main_id, ud.type_id user_type, firstname, propic, lastname, name, ld.type, ld.status, ld.time, ld.type_id, ld.date FROM like_dislike ld LEFT JOIN user_details ud ON ud.id = ld.user_id LEFT JOIN user_info ui ON ui.user_id = ld.user_id LEFT JOIN org_info oi ON oi.user_id = ld.user_id WHERE ld.type_id IN($ids) AND ld.user_id != $id) AS U WHERE time > $first_id ORDER BY time DESC")->result();
        }
    }
    
    public function get_all_comment_likes() {
        $type_id = array();
        $id = $this->session->userdata('user_id');
        $data = $this->db->query("SELECT * FROM comments WHERE user_id = $id")->result();
        foreach($data as $d) {
            $type_id[] = $d->id;
        }
        $ids = implode(',', $type_id);
        if($ids != '') {
            return $this->db->query("SELECT ld.id row_id, ud.id main_id, ud.type_id user_type, firstname, propic, lastname, name, ld.type, ld.status, ld.time, ld.type_id, ld.date FROM like_dislike ld LEFT JOIN user_details ud ON ud.id = ld.user_id LEFT JOIN user_info ui ON ui.user_id = ld.user_id LEFT JOIN org_info oi ON oi.user_id = ld.user_id WHERE ld.type_id IN($ids) AND ld.user_id != $id AND ld.type = 'comment' ORDER BY time DESC")->result();
        }
    }
    
    public function user_activities($id) {
        return $this->db->query("SELECT c.id row_id, ud.id main_id, ud.type_id user_type, firstname, propic, lastname, name, c.type, c.date, c.time, c.type_id, c.comment FROM user_details ud LEFT JOIN comments c ON c.user_id = ud.id LEFT JOIN user_info ui ON ui.user_id = ud.id LEFT JOIN org_info oi ON oi.user_id = ud.id WHERE ud.id IN($id) UNION SELECT ld.id row_id, ud.id main_id, ud.type_id user_type, firstname, propic, lastname, name, ld.type, ld.status, ld.time, ld.type_id, ld.date FROM user_details ud LEFT JOIN like_dislike ld ON ld.user_id = ud.id LEFT JOIN user_info ui ON ui.user_id = ud.id LEFT JOIN org_info oi ON oi.user_id = ud.id WHERE ud.id IN($id) ORDER BY time DESC")->result();
    }
    
    public function recent_activities() {
        $act_id = array();
        $id = $this->session->userdata('user_id');
        $frnds = $this->db->query("SELECT * FROM connection WHERE user_one = $id AND status = 1 OR status = 3 UNION SELECT * FROM connection WHERE user_two = $id AND status = 1 OR status = 3")->result();
        foreach($frnds as $frnd) {
            if($frnd->user_one != $this->session->userdata('user_id')) {
                $act_id[] = $frnd->user_one;
            } else {
                $act_id[] = $frnd->user_two;
            }
        }
        $ids = implode(',', $act_id);
        if($ids != '') {
            return $this->db->query("SELECT c.id row_id, ud.id main_id, ud.type_id user_type, firstname, lastname, name, c.type, c.date, c.time, c.type_id, c.comment FROM user_details ud LEFT JOIN comments c ON c.user_id = ud.id LEFT JOIN user_info ui ON ui.user_id = ud.id LEFT JOIN org_info oi ON oi.user_id = ud.id WHERE ud.id IN($ids) UNION SELECT ld.id row_id, ud.id main_id, ud.type_id user_type, firstname, lastname, name, ld.type, ld.status, ld.time, ld.type_id, ld.date FROM user_details ud LEFT JOIN like_dislike ld ON ld.user_id = ud.id LEFT JOIN user_info ui ON ui.user_id = ud.id LEFT JOIN org_info oi ON oi.user_id = ud.id WHERE ud.id IN($ids) ORDER BY time DESC")->result();
        }
    }
    
    public function latest_recent_activities($first_id) {
        $act_id = array();
        $id = $this->session->userdata('user_id');
        $frnds = $this->db->query("SELECT * FROM connection WHERE user_one = $id AND status = 1 OR status = 3 UNION SELECT * FROM connection WHERE user_two = $id AND status = 1 OR status = 3")->result();
        foreach($frnds as $frnd) {
            if($frnd->user_one != $this->session->userdata('user_id')) {
                $act_id[] = $frnd->user_one;
            } else {
                $act_id[] = $frnd->user_two;
            }
        }
        $ids = implode(',', $act_id);
        if($ids != '') {
            return $this->db->query("SELECT * FROM (SELECT c.id row_id, ud.id main_id, ud.type_id user_type, firstname, lastname, name, c.type, c.date, c.time, c.type_id, c.comment FROM user_details ud LEFT JOIN comments c ON c.user_id = ud.id LEFT JOIN user_info ui ON ui.user_id = ud.id LEFT JOIN org_info oi ON oi.user_id = ud.id WHERE ud.id IN($ids) UNION SELECT ld.id row_id, ud.id main_id, ud.type_id user_type, firstname, lastname, name, ld.type, ld.status, ld.time, ld.type_id, ld.date FROM user_details ud LEFT JOIN like_dislike ld ON ld.user_id = ud.id LEFT JOIN user_info ui ON ui.user_id = ud.id LEFT JOIN org_info oi ON oi.user_id = ud.id WHERE ud.id IN($ids)) AS U WHERE time > $first_id ORDER BY time DESC")->result();  
        }
    }
    
    public function get_latest_all_comment_likes($first_id) {
        $type_id = array();
        $id = $this->session->userdata('user_id');
        $data = $this->db->query("SELECT * FROM comments WHERE user_id = $id")->result();
        foreach($data as $d) {
            $type_id[] = $d->id;
        }
        $ids = implode(',', $type_id);
        if($ids != '') {
            return $this->db->query("SELECT * FROM (SELECT ld.id row_id, ud.id main_id, ud.type_id user_type, firstname, propic, lastname, name, ld.type, ld.status, ld.time, ld.type_id, ld.date FROM like_dislike ld LEFT JOIN user_details ud ON ud.id = ld.user_id LEFT JOIN user_info ui ON ui.user_id = ld.user_id LEFT JOIN org_info oi ON oi.user_id = ld.user_id WHERE ld.type_id IN($ids) AND ld.user_id != $id AND ld.type = 'comment') AS U WHERE time > $first_id ORDER BY time DESC")->result();
        }
    }
    
    public function check_activity_view($id) {
        $cur_id = $this->session->userdata('user_id');
        $num = $this->db->get_where('timeline', array('id' => $id))->num_rows();
        if ($num > 0) {
            $user_id = $this->db->get_where('timeline', array('id' => $id))->row()->user_id;
            if ($user_id == $cur_id) { return TRUE; } else {
                $privacy = $this->db->get_where('timeline', array('id' => $id))->row()->privacy;
                if($privacy == 0) { return TRUE; } 
                if($privacy == 1) { if($this->db->query("SELECT * FROM connection WHERE user_one = $cur_id AND user_two = $user_id AND status = 1 UNION SELECT * FROM connection WHERE user_one = $user_id AND user_two = $cur_id AND status = 1")->num_rows() > 0) { return TRUE; }}
            } 
        } else {
            return FALSE;
        }
    }
    
    public function check_grp_activity_view($id) {
        $num = $this->db->get_where('group_content', array('id' => $id))->num_rows();
        if ($num > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function get_activity($id) {
        $this->db->where('t.id', $id);
        $this->db->select('t.id timeline_post_id, t.user_id post_user_id, t.time post_time, t.date post_date, firstname, lastname, name, propic, ud.type_id user_type, t.*');
        $this->db->from('timeline t');
        $this->db->join('user_details ud', 'ud.id = t.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = t.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = t.user_id', 'left');
        return $this->db->get()->row();
    }
    
    public function get_blog_activity($id) {
        $this->db->where('t.blog_id', $id);
        $this->db->select('t.id timeline_post_id, t.user_id post_user_id, t.time post_time, t.date post_date, firstname, lastname, name, propic, ud.type_id user_type, t.*');
        $this->db->from('timeline t');
        $this->db->join('user_details ud', 'ud.id = t.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = t.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = t.user_id', 'left');
        return $this->db->get()->row();
    }
    
    public function get_ad_activity($id) {
        $this->db->where('t.ad_id', $id);
        $this->db->select('t.id timeline_post_id, t.user_id post_user_id, t.time post_time, t.date post_date, firstname, lastname, name, propic, ud.type_id user_type, t.*');
        $this->db->from('timeline t');
        $this->db->join('user_details ud', 'ud.id = t.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = t.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = t.user_id', 'left');
        return $this->db->get()->row();
    }
    
    public function get_grp_activity($id) {
        $this->db->where('t.id', $id);
        $this->db->select('t.id timeline_post_id, t.user_id post_user_id, t.time post_time, t.date post_date, firstname, lastname, name, propic, ud.type_id user_type, t.*');
        $this->db->from('group_content t');
        $this->db->join('user_details ud', 'ud.id = t.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = t.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = t.user_id', 'left');
        return $this->db->get()->row();
    }
    
    public function get_salt() {
        return $this->db->get_where('user_details', array('id' => $this->session->userdata('user_id')))->row()->salt;
    }

    public function validate_password($hashed_pwd) {
        return $this->db->get_where('user_details', array('id' => $this->session->userdata('user_id'), 'password' => $hashed_pwd))->num_rows();
    }
    
    public function update_password($salt, $hashed_pwd) {
        $this->db->where('id', $this->session->userdata('user_id'));
        $this->db->update('user_details', array('password' => $hashed_pwd, 'salt' => $salt));
    }
    
    public function validate_email($email) {
        return $this->db->get_where('user_details', array('email' => $email))->num_rows();
    }
    
    public function update_email($email, $key) {
        $this->db->where('id', $this->session->userdata('user_id'));
        $this->db->update('user_details', array('email' => $email, 'is_active' => 0, 'status_key' => $key));
    }

    public function update_privacy($type, $value) {
        if($type == 'jobportal') {
            if($this->info->type_id == 1) {
                $this->db->where('user_id', $this->session->userdata('user_id'));
                $this->db->update('user_info', array('job' => $value)); 
            } else {
                $this->db->where('user_id', $this->session->userdata('user_id'));
                $this->db->update('org_info', array('job' => $value)); 
            }
        } else {
           $this->db->where('user_id', $this->session->userdata('user_id'));
           $this->db->update('privacy', array($type => $value)); 
        }
    }
    
    public function get_privacy($id) {
        return $this->db->get_where('privacy', array('user_id' => $id))->row();
    }

    public function get_category() {
        return $this->db->get('ad_category')->result();
    }
    
    public function get_listing($cat, $country) {
        $this->db->limit(5);     
        $this->db->order_by('post.time', 'DESC');
        if($cat != '') {
            ($country != '')? $this->db->where(array('post.cat_id' => $cat, 'post.country_code' => $country)) : $this->db->where(array('post.cat_id' => $cat));
        } else {
            ($country != '')? $this->db->where(array('post.country_code' => $country)) : '';
        }
        $this->db->select('post.*, post.id main_post_id, post.time main_post_time, post.date main_post_date, user.id main_user_id, info.firstname fname, info.lastname lname, oi.name company_name, user.propic pro_pic, user.type_id user_type, cntry.country_name loc, cat.category main_cat');
        $this->db->from('ads post');
        $this->db->join('ad_category cat', 'cat.id = post.cat_id', 'left');
        $this->db->join('user_info info', 'info.user_id = post.user_id', 'left');
        $this->db->join('user_details user', 'user.id = post.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = post.user_id', 'left');
        $this->db->join('countries cntry', 'cntry.country_code = post.country_code','left');
        return $this->db->get()->result();
    }
    
    public function get_more_listing($last_id, $cat, $country) {
        $this->db->limit(5);     
        $this->db->order_by('post.time', 'DESC');
        if($cat != '') {
            ($country != '')? $this->db->where(array('post.cat_id' => $cat, 'post.country_code' => $country, 'post.time <' => $last_id)) : $this->db->where(array('post.cat_id' => $cat, 'post.time <' => $last_id));
        } else {
            ($country != '')? $this->db->where(array('post.country_code' => $country, 'post.time <' => $last_id)) : $this->db->where(array('post.time <' => $last_id));
        }
        $this->db->select('post.*, post.id main_post_id, post.time main_post_time, post.date main_post_date, user.id main_user_id, info.firstname fname, info.lastname lname, oi.name company_name, user.propic pro_pic, user.type_id user_type, cntry.country_name loc, cat.category main_cat');
        $this->db->from('ads post');
        $this->db->join('ad_category cat', 'cat.id = post.cat_id', 'left');
        $this->db->join('user_info info', 'info.user_id = post.user_id', 'left');
        $this->db->join('user_details user', 'user.id = post.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = post.user_id', 'left');
        $this->db->join('countries cntry', 'cntry.country_code = post.country_code','left');
        return $this->db->get()->result();
    }
    
    public function get_country_list() {
        $this->db->select('country_code, country_name');
        $this->db->from('countries');
        $result = $this->db->get();
        if($result->num_rows()>0) {
            return $result->result();
        } else {
            return FALSE;
        }
    }
    
    public function get_support_list() {
        $this->db->select('id, support_title, support_desc, is_active');
        $this->db->from('support_types');
        $this->db->where('is_active', 1);
        $result = $this->db->get();
        if($result->num_rows()>0) {
            return $result->result();
        } else {
            return FALSE;
        }
    }
    
    public function get_support_name($id) {
        return $this->db->get_where('support_types', array('id' => $id))->row();
    }
    
    public function insert_ad($ad_data) {
        $this->db->insert('ads', $ad_data);
        $post_id = $this->db->insert_id();
        $post = $this->db->get_where('ads', array('id' => $post_id))->row();
        $this->db->insert('timeline', array('user_id' => $this->session->userdata('user_id'), 'content_type' => 'ad', 'ad_id' => $post_id, 'title' => $post->title, 'privacy' => 0, 'time' => $post->time, 'date' => $post->date));
        $meter = $this->db->get_where('user_details', array('id' => $this->session->userdata('user_id')))->row()->is_complete;
        if($meter == 3) {
            $this->db->where(array('id' => $this->session->userdata('user_id')));
            $this->db->update('user_details', array('is_complete' => 4));
        }
        return $post_id;
    }
    
    public function ads_upgrade($post_id) {
        if($this->db->get_where('ads_upgrade', array('user_id' => $this->session->userdata('user_id')))->num_rows() == 0) {
            $this->db->insert('ads_upgrade', array('user_id' => $this->session->userdata('user_id'), 'ad_ids' => $post_id, 'count' => 1, 'status' => 0));
        } else {
            $ad_id = $this->db->get_where('ads_upgrade', array('user_id' => $this->session->userdata('user_id')))->row()->ad_ids;
            $str = $post_id.','.$ad_id;
            $this->db->where(array('user_id' => $this->session->userdata('user_id')));
            $this->db->update('ads_upgrade', array('count' => 2, 'ad_ids' => $str));
        }
    }
    
    public function user_post_check($post_id) {
        return $this->db->get_where('ads', array('user_id' => $this->session->userdata('user_id'), 'id' => $post_id))->num_rows();
    }
    
    public function delete_post($id) {
        if($this->db->get_where('ads', array('id' => $id, 'user_id' => $this->session->userdata('user_id')))->num_rows() > 0) {
            $img = $this->db->get_where('ads', array('id' => $id, 'user_id' => $this->session->userdata('user_id')))->row()->img;
            $video = $this->db->get_where('ads', array('id' => $id, 'user_id' => $this->session->userdata('user_id')))->row()->video;
            if($video != '') {
                unlink('assets/userdata/dashboard/ads/' . $video);
            }
            if($img != '') {
                $img_arr = explode(',', $img);
                foreach($img_arr as $i) {
                    unlink('assets/userdata/dashboard/ads/' . $i);
                }
            }
            $this->db->delete('ads', array('id' => $id, 'user_id' => $this->session->userdata('user_id')));
            $this->db->delete('timeline', array('ad_id' => $id));
            if($this->db->get_where('comments', array('type' => 'ad', 'type_id' => $id))->num_rows() > 0) {
                $comments = $this->db->get_where('comments', array('type' => 'ad', 'type_id' => $id))->result();
                foreach ($comments as $cmt) {
                    $this->db->delete('like_dislike', array('type' => 'comment', 'type_id' => $cmt->id));
                }
                $this->db->delete('comments', array('type' => 'ad', 'type_id' => $id));
            }
            $this->db->delete('like_dislike', array('type' => 'ad', 'type_id' => $id));
            $action_data = $this->db->get_where('user_actions', array('ad_id' => $id))->result();
            foreach ($action_data as $action) {
                $action_sub_data = $this->db->get_where('timeline', array('action_id' => $action->id))->result();
                foreach ($action_sub_data as $action_sub) {
                    if($this->db->get_where('comments', array('type' => 'action', 'type_id' => $action_sub->id))->num_rows() > 0) {
                        $comments = $this->db->get_where('comments', array('type' => 'action', 'type_id' => $action_sub->id))->result();
                        foreach ($comments as $cmt) {
                            $this->db->delete('like_dislike', array('type' => 'comment', 'type_id' => $cmt->id));
                        }
                        $this->db->delete('comments', array('type' => 'action', 'type_id' => $action_sub->id));
                    }
                    $this->db->delete('like_dislike', array('type' => 'action', 'type_id' => $action_sub->id));
                }
                $this->db->delete('timeline', array('action_id' => $action->id));
            }
            $this->db->delete('user_actions', array('ad_id' => $id));
            return TRUE; 
        } 
    }
    
    public function update_post($ad_data, $file_str, $vid_name, $id) {
        $this->db->where(array('id' => $id, 'user_id' => $this->session->userdata('user_id')));
        $this->db->update('ads', $ad_data);
        if ($file_str != '') {
            $this->db->where(array('id' => $id, 'user_id' => $this->session->userdata('user_id')));
            $this->db->update('ads', array('img' => $file_str));
        }
        if($vid_name != '') {
            $this->db->where(array('id' => $id, 'user_id' => $this->session->userdata('user_id')));
            $this->db->update('ads', array('video' => $vid_name));
        }
        $ad = $this->db->get_where('ads', array('id' => $id))->row();
        $this->db->where(array('ad_id' => $id, 'user_id' => $this->session->userdata('user_id')));
        $this->db->update('timeline', array('title' => $ad->title, 'time' => $ad->time, 'date' => $ad->date));
    }
    
    public function get_single_post($id) {
        $this->db->where(array('a.id' => $id));
        $this->db->select('a.id main_id, a.user_id main_user_id, type_id, firstname, propic, lastname, name, cntry.country_name loc, cat.category main_cat, a.*, cat.*, cntry.*');
        $this->db->from('ads a');
        $this->db->join('user_details ud', 'ud.id = a.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = a.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = a.user_id', 'left');
        $this->db->join('ad_category cat', 'cat.id = a.cat_id', 'left');
        $this->db->join('countries cntry', 'cntry.country_code = a.country_code','left');
        return $this->db->get()->row();
    }
    
    public function get_curr_user_single_user_post($id) {
        $this->db->where(array('a.id' => $id, 'a.user_id' => $this->session->userdata('user_id')));
        $this->db->select('a.id main_id, type_id, firstname, propic, lastname, name, a.*');
        $this->db->from('ads a');
        $this->db->join('user_details ud', 'ud.id = a.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = a.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = a.user_id', 'left');
        return $this->db->get()->row();
    }
    
    public function add_post_action($post_id, $act_id, $desc) {
        $insert_id = '';
        $count = $this->db->get_where('user_actions', array('user_id' => $this->session->userdata('user_id'), 'ad_id' => $post_id))->num_rows();
        if($count > 0) {
            $this->db->where(array('user_id' => $this->session->userdata('user_id'), 'ad_id' => $post_id));
            $this->db->update('user_actions', array('action_id' => $act_id, 'action_desc' => $desc, 'timestamp' => time()));
            $action_id = $this->db->get_where('user_actions', array('user_id' => $this->session->userdata('user_id'), 'ad_id' => $post_id))->row()->id;            
            $this->db->where(array('user_id' => $this->session->userdata('user_id'), 'content_type' => 'action', 'action_id' => $action_id));
            $this->db->update('timeline', array('time' => time(), 'date' => date('d M Y')));
        } else {
            $this->db->insert('user_actions', array('user_id' => $this->session->userdata('user_id'), 'ad_id' => $post_id, 'action_id' => $act_id, 'action_desc' => $desc, 'timestamp' => time()));
            $insert_id = $this->db->insert_id();
        }
        $meter = $this->db->get_where('user_details', array('id' => $this->session->userdata('user_id')))->row()->is_complete;
        if($meter == 3) {
            $this->db->where(array('id' => $this->session->userdata('user_id')));
            $this->db->update('user_details', array('is_complete' => 4));
        }
        return $insert_id;
    }
    
    public function get_user_action($id) {
        return $this->db->get_where('user_actions', array('id' => $id))->row();
    }


    public function get_post_related_user($cat_id) {
        $this->db->limit(10);     
        $this->db->order_by('id', 'DESC');
        return $this->db->get_where('user_selected_category', array('cat_id' => $cat_id))->result();
    }
    
    public function user_post_count($id) {
        return $this->db->get_where('ads', array('user_id' => $id))->num_rows();
    }
    
    public function get_thoughts() {
        $this->db->order_by('rand()');
        return $this->db->get('thoughts')->result();
    }
    
    public function get_profile_completion() {
        return $this->db->get_where('user_details', array('id' => $this->session->userdata('user_id')))->row()->is_complete;
    }
    
    public function update_propic($file) {
        $pic = $this->db->get_where('user_details', array('id' => $this->session->userdata('user_id')))->row()->propic;
        $meter = $this->db->get_where('user_details', array('id' => $this->session->userdata('user_id')))->row()->is_complete;
        if($pic != '') {
            unlink('assets/userdata/dashboard/propic/' . $pic);
        }
        $this->db->where(array('id' => $this->session->userdata('user_id')));
        $this->db->update('user_details', array('propic' => $file));
        if($meter == 1) {
            $this->db->where(array('id' => $this->session->userdata('user_id')));
            $this->db->update('user_details', array('is_complete' => 2));
        }
    }
    
    public function update_banner($file) {
        $pic = ($this->session->userdata('user_type') == 1)? $this->db->get_where('user_info', array('user_id' => $this->session->userdata('user_id')))->row()->wall : $this->db->get_where('org_info', array('user_id' => $this->session->userdata('user_id')))->row()->wall;
        if($pic != '') {
            unlink('assets/userdata/dashboard/banner/' . $pic);
        }
        if($this->session->userdata('user_type') == 1) {
            $this->db->where(array('user_id' => $this->session->userdata('user_id')));
            $this->db->update('user_info', array('wall' => $file));
        } else {
            $this->db->where(array('user_id' => $this->session->userdata('user_id')));
            $this->db->update('org_info', array('wall' => $file));
        }
    }
    
    public function delete_propic() {
        $pic = $this->db->get_where('user_details', array('id' => $this->session->userdata('user_id')))->row()->propic;
        if($pic != '') {
            unlink('assets/userdata/dashboard/propic/' . $pic);
        }
        $this->db->where(array('id' => $this->session->userdata('user_id')));
        $this->db->update('user_details', array('propic' => ''));
    }
    
    public function delete_banner() {
        $pic = ($this->session->userdata('user_type') == 1)? $this->db->get_where('user_info', array('user_id' => $this->session->userdata('user_id')))->row()->wall : $this->db->get_where('org_info', array('user_id' => $this->session->userdata('user_id')))->row()->wall;
        if($pic != '') {
            unlink('assets/userdata/dashboard/banner/' . $pic);
        }
        if($this->session->userdata('user_type') == 1) {
            $this->db->where(array('user_id' => $this->session->userdata('user_id')));
            $this->db->update('user_info', array('wall' => ''));
        } else {
            $this->db->where(array('user_id' => $this->session->userdata('user_id')));
            $this->db->update('org_info', array('wall' => ''));
        }
    }
    
    public function get_job_category() {
        return $this->db->get('job_categories')->result();
    }
    
    public function get_job_category_name($cat) {
        return $this->db->get_where('job_categories', array('id' => $cat))->row()->job_cat_name;
    }
    
    public function get_job_levels() {
        return $this->db->get('job_levels')->result();
    }
    
    public function get_job_types() {
        return $this->db->get('job_type')->result();
    }
    
    public function get_job_listing() {
        $this->db->limit(5);     
        $this->db->order_by('jobs.time', 'DESC');
        $this->db->select('jobs.*, oi.*, jobs.id main_job_id, jobs.user_id main_user_id, ud.type_id user_type, propic, email, jobs.time job_time, jobs.date job_date, job_categories.job_cat_name, job_levels.level_name, job_type.jobtype_name, countries.country_name');
        $this->db->from('jobs');
        $this->db->join('job_categories','job_categories.id = jobs.job_cat_id', 'left');
        $this->db->join('countries','countries.country_code = jobs.job_country', 'left');
        $this->db->join('job_levels','job_levels.id = jobs.exp_level', 'left');
        $this->db->join('job_type','job_type.id = jobs.employment_type', 'left');
        $this->db->join('user_details ud', 'ud.id = jobs.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = jobs.user_id', 'left');
        return $this->db->get()->result();
    }
    
    public function get_more_job_listing($last_id) {
        $this->db->limit(5);     
        $this->db->order_by('jobs.time', 'DESC');
        $this->db->where(array('jobs.time <' => $last_id));
        $this->db->select('jobs.*, oi.*, jobs.id main_job_id, jobs.user_id main_user_id, ud.type_id user_type, propic, email, jobs.time job_time, jobs.date job_date, job_categories.job_cat_name, job_levels.level_name, job_type.jobtype_name, countries.country_name');
        $this->db->from('jobs');
        $this->db->join('job_categories','job_categories.id = jobs.job_cat_id', 'left');
        $this->db->join('countries','countries.country_code = jobs.job_country', 'left');
        $this->db->join('job_levels','job_levels.id = jobs.exp_level', 'left');
        $this->db->join('job_type','job_type.id = jobs.employment_type', 'left');
        $this->db->join('user_details ud', 'ud.id = jobs.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = jobs.user_id', 'left');
        return $this->db->get()->result();
    }
    
    public function get_curr_user_single_user_job_post($id) {
        $this->db->where(array('jobs.id' => $id, 'jobs.user_id' => $this->session->userdata('user_id')));
        $this->db->select('jobs.*, oi.*, jobs.id main_job_id, jobs.user_id main_user_id, ud.type_id user_type, propic, email, jobs.time job_time, jobs.date job_date, job_categories.job_cat_name, job_levels.level_name, job_type.jobtype_name, countries.country_name');
        $this->db->from('jobs');
        $this->db->join('job_categories','job_categories.id = jobs.job_cat_id', 'left');
        $this->db->join('countries','countries.country_code = jobs.job_country', 'left');
        $this->db->join('job_levels','job_levels.id = jobs.exp_level', 'left');
        $this->db->join('job_type','job_type.id = jobs.employment_type', 'left');
        $this->db->join('user_details ud', 'ud.id = jobs.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = jobs.user_id', 'left');
        return $this->db->get()->row();
    }
    
    public function get_curr_user_single_user_job_post_count() {
        return $this->db->get_where('jobs', array('user_id' => $this->session->userdata('user_id')))->num_rows();
    }
    
    public function get_curr_user_single_user_job_posts() {     
        $this->db->order_by('jobs.time', 'DESC');
        $this->db->where(array('jobs.user_id' => $this->session->userdata('user_id')));
        $this->db->select('jobs.*, oi.*, jobs.id main_job_id, jobs.user_id main_user_id, ud.type_id user_type, propic, email, jobs.time job_time, jobs.date job_date, job_categories.job_cat_name, job_levels.level_name, job_type.jobtype_name, countries.country_name');
        $this->db->from('jobs');
        $this->db->join('job_categories','job_categories.id = jobs.job_cat_id', 'left');
        $this->db->join('countries','countries.country_code = jobs.job_country', 'left');
        $this->db->join('job_levels','job_levels.id = jobs.exp_level', 'left');
        $this->db->join('job_type','job_type.id = jobs.employment_type', 'left');
        $this->db->join('user_details ud', 'ud.id = jobs.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = jobs.user_id', 'left');
        return $this->db->get()->result();
    }
    
    public function get_single_job_post($id) {     
        $this->db->where(array('jobs.id' => $id));
        $this->db->select('jobs.*, oi.*, jobs.id main_job_id, jobs.user_id main_user_id, ud.type_id user_type, propic, email, jobs.time job_time, jobs.date job_date, job_categories.job_cat_name, job_levels.level_name, job_type.jobtype_name, countries.country_name');
        $this->db->from('jobs');
        $this->db->join('job_categories','job_categories.id = jobs.job_cat_id', 'left');
        $this->db->join('countries','countries.country_code = jobs.job_country', 'left');
        $this->db->join('job_levels','job_levels.id = jobs.exp_level', 'left');
        $this->db->join('job_type','job_type.id = jobs.employment_type', 'left');
        $this->db->join('user_details ud', 'ud.id = jobs.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = jobs.user_id', 'left');
        return $this->db->get()->row();
    }
    
    public function user_job_post_check($post_id) {
        return $this->db->get_where('jobs', array('user_id' => $this->session->userdata('user_id'), 'id' => $post_id))->num_rows();
    }
    
    public function insert_job($job_data) {
        $this->db->insert('jobs', $job_data);
    }
    
    public function delete_job($id) {
        if($this->db->get_where('jobs', array('id' => $id, 'user_id' => $this->session->userdata('user_id')))->num_rows() > 0) {
            $img = $this->db->get_where('jobs', array('id' => $id, 'user_id' => $this->session->userdata('user_id')))->row()->job_img;
            if($img != '') {
                $img_arr = explode(',', $img);
                foreach($img_arr as $i) {
                    unlink('assets/userdata/dashboard/jobs/img/' . $i);
                }
            }
            $this->db->delete('jobs', array('id' => $id, 'user_id' => $this->session->userdata('user_id')));
            $this->db->delete('job_applied', array('job_id' => $id));
            return TRUE; 
        } 
    }
    
    public function update_job($update_data, $file_str, $id) {
        $this->db->where(array('id' => $id, 'user_id' => $this->session->userdata('user_id')));
        $this->db->update('jobs', $update_data);
        if ($file_str != '') {
            $this->db->where(array('id' => $id, 'user_id' => $this->session->userdata('user_id')));
            $this->db->update('jobs', array('job_img' => $file_str));
        }
    }
    
    public function search_job_listing($job_cat, $job_country, $skills) {
        $this->db->order_by('jobs.time', 'DESC');
        if($skills != '') { $this->db->like('jobs.job_skills', $skills); }
        $this->db->where(array('jobs.job_cat_id' => $job_cat, 'jobs.job_country' => $job_country));
        $this->db->select('jobs.*, ui.*, oi.*, jobs.id main_job_id, jobs.user_id main_user_id, ud.type_id user_type, propic, email, jobs.time job_time, jobs.date job_date, job_categories.job_cat_name, job_levels.level_name, job_type.jobtype_name, countries.country_name');
        $this->db->from('jobs');
        $this->db->join('job_categories','job_categories.id = jobs.job_cat_id', 'left');
        $this->db->join('countries','countries.country_code = jobs.job_country', 'left');
        $this->db->join('job_levels','job_levels.id = jobs.exp_level', 'left');
        $this->db->join('job_type','job_type.id = jobs.employment_type', 'left');
        $this->db->join('user_details ud', 'ud.id = jobs.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = jobs.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = jobs.user_id', 'left');
        return $this->db->get()->result();
    }
    
    public function search_job_cat($job_cat) {
        $this->db->order_by('jobs.time', 'DESC');
        $this->db->where(array('jobs.job_cat_id' => $job_cat));
        $this->db->select('jobs.*, ui.*, oi.*, jobs.id main_job_id, jobs.user_id main_user_id, ud.type_id user_type, propic, email, jobs.time job_time, jobs.date job_date, job_categories.job_cat_name, job_levels.level_name, job_type.jobtype_name, countries.country_name');
        $this->db->from('jobs');
        $this->db->join('job_categories','job_categories.id = jobs.job_cat_id', 'left');
        $this->db->join('countries','countries.country_code = jobs.job_country', 'left');
        $this->db->join('job_levels','job_levels.id = jobs.exp_level', 'left');
        $this->db->join('job_type','job_type.id = jobs.employment_type', 'left');
        $this->db->join('user_details ud', 'ud.id = jobs.user_id', 'left');
        $this->db->join('user_info ui', 'ui.user_id = jobs.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = jobs.user_id', 'left');
        return $this->db->get()->result();
    }
    
    public function get_curr_user_cv_count() {
        return $this->db->get_where('job_cv', array('user_id' => $this->session->userdata('user_id')))->num_rows();
    }
    
    public function get_user_cv_count($user_id) {
        return $this->db->get_where('job_cv', array('user_id' => $user_id))->num_rows();
    }
    
    public function insert_cv_head($cv_data, $file) {
        if($this->db->get_where('job_cv', array('user_id' => $this->session->userdata('user_id')))->num_rows() == 0) {
            $this->db->insert('job_cv', $cv_data);
        } else {
            $this->db->where(array('user_id' => $this->session->userdata('user_id')));
            $this->db->update('job_cv', $cv_data);
        }
        if ($file != '') {
            $delete_file = $this->get_user_cv($this->session->userdata('user_id'))->cv;
            if($delete_file != '') {
                unlink('assets/userdata/dashboard/jobs/cv/' . $delete_file);
            }
            $this->db->where(array('user_id' => $this->session->userdata('user_id')));
            $this->db->update('job_cv', array('cv' => $file));
        }
    }
    
    public function insert_cv_job($cv_data) {
        if($this->db->get_where('job_cv', array('user_id' => $this->session->userdata('user_id')))->num_rows() == 0) {
            $this->db->insert('job_cv', $cv_data);
        } else {
            $this->db->where(array('user_id' => $this->session->userdata('user_id')));
            $this->db->update('job_cv', $cv_data);
        }
    }
    
    public function insert_cv_personal($cv_data) {
        if($this->db->get_where('job_cv', array('user_id' => $this->session->userdata('user_id')))->num_rows() == 0) {
            $this->db->insert('job_cv', $cv_data);
        } else {
            $this->db->where(array('user_id' => $this->session->userdata('user_id')));
            $this->db->update('job_cv', $cv_data);
        }
    }
    
    public function insert_cv_experience($cv_data) {
        $this->db->insert('job_cv_experience', $cv_data);
    }
    
    public function insert_cv_education($cv_data) {
        $this->db->insert('job_cv_education', $cv_data);
    }
    
    public function cv_country_name($code) {
        return $this->db->get_where('countries', array('country_code' => $code))->row()->country_name;
    }

    public function get_user_cv($user_id) {
        $this->db->where(array('jc.user_id' => $user_id));
        $this->db->select('jc.*, jc.user_id main_user_id, ui.count, user_level, firstname, lastname, job_cat_name, level_name, jobtype_name');
        $this->db->from('job_cv jc');
        $this->db->join('user_details ud','ud.id = jc.user_id', 'left');
        $this->db->join('user_info ui','ui.user_id = jc.user_id', 'left');
        $this->db->join('job_categories','job_categories.id = jc.category', 'left');
        $this->db->join('job_levels','job_levels.id = jc.level', 'left');
        $this->db->join('job_type','job_type.id = jc.type', 'left');
        return $this->db->get()->row();
    }
    
    public function get_user_cv_exp($user_id) {
        $this->db->where(array('jc.user_id' => $user_id));
        $this->db->select('jc.*, jc.id main_id, job_cat_name, level_name');
        $this->db->from('job_cv_experience jc');
        $this->db->join('job_categories','job_categories.id = jc.category', 'left');
        $this->db->join('job_levels','job_levels.id = jc.level', 'left');
        return $this->db->get()->result();
    }
    
    public function delete_cv_exp($id) {
        $this->db->delete('job_cv_experience', array('id' => $id, 'user_id' => $this->session->userdata('user_id')));
    }
    
    public function get_user_cv_edu($user_id) {
        return $this->db->get_where('job_cv_education', array('user_id' => $user_id))->result();
    }
    
    public function delete_cv_edu($id) {
        $this->db->delete('job_cv_education', array('id' => $id, 'user_id' => $this->session->userdata('user_id')));
    }
    
    public function cv_propic($file) {
        if($this->db->get_where('job_cv', array('user_id' => $this->session->userdata('user_id')))->num_rows() == 0) {
            $this->db->insert('job_cv', array('user_id' => $this->session->userdata('user_id'), 'propic' => $file));
        } else {
            $this->db->where(array('user_id' => $this->session->userdata('user_id')));
            $this->db->update('job_cv', array('propic' => $file));
        }
    }
    
    public function apply_job($job_id) {
        $this->db->insert('job_applied', array('user_id' => $this->session->userdata('user_id'), 'status' => 0, 'job_id' => $job_id, 'date' => date('d M Y'), 'time' => time()));
    }
    
    public function check_application($job_id) {
        return $this->db->get_where('job_applied', array('user_id' => $this->session->userdata('user_id'), 'job_id' => $job_id))->num_rows();
    }
    
    public function get_applied_job_listing() {
        $this->db->limit(5);     
        $this->db->order_by('jobs.time', 'DESC');
        $this->db->where(array('ja.user_id' => $this->session->userdata('user_id')));
        $this->db->select('jobs.*, oi.*, jobs.id main_job_id, jobs.user_id main_user_id, ud.type_id user_type, propic, email, jobs.time job_time, jobs.date job_date, job_categories.job_cat_name, job_levels.level_name, job_type.jobtype_name, countries.country_name');
        $this->db->from('jobs');
        $this->db->join('job_categories','job_categories.id = jobs.job_cat_id', 'left');
        $this->db->join('countries','countries.country_code = jobs.job_country', 'left');
        $this->db->join('job_levels','job_levels.id = jobs.exp_level', 'left');
        $this->db->join('job_type','job_type.id = jobs.employment_type', 'left');
        $this->db->join('user_details ud', 'ud.id = jobs.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = jobs.user_id', 'left');
        $this->db->join('job_applied ja', 'ja.job_id = jobs.id', 'left');
        return $this->db->get()->result();
    }
    
    public function get_more_applied_job_listing($last_id) {
        $this->db->limit(5);     
        $this->db->order_by('jobs.time', 'DESC');
        $this->db->where(array('ja.user_id' => $this->session->userdata('user_id'), 'jobs.time <' => $last_id));
        $this->db->select('jobs.*, oi.*, jobs.id main_job_id, jobs.user_id main_user_id, ud.type_id user_type, propic, email, jobs.time job_time, jobs.date job_date, job_categories.job_cat_name, job_levels.level_name, job_type.jobtype_name, countries.country_name');
        $this->db->from('jobs');
        $this->db->join('job_categories','job_categories.id = jobs.job_cat_id', 'left');
        $this->db->join('countries','countries.country_code = jobs.job_country', 'left');
        $this->db->join('job_levels','job_levels.id = jobs.exp_level', 'left');
        $this->db->join('job_type','job_type.id = jobs.employment_type', 'left');
        $this->db->join('user_details ud', 'ud.id = jobs.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = jobs.user_id', 'left');
        $this->db->join('job_applied ja', 'ja.job_id = jobs.id', 'left');
        return $this->db->get()->result();
    }
    
    public function search_candidates($cat, $country, $skills) {
        $this->db->order_by('jc.time', 'DESC');
        if($skills != '') { $this->db->like('jc.skills', $skills); }
        $this->db->where(array('jc.category' => $cat, 'jc.current_location' => $country, 'jc.job_title !=' => '', 'jc.objective !=' => '', 'jc.nationality !=' => ''));
        $this->db->select('jc.*, ui.*, jc.id main_id, jc.time main_time, jc.date main_date, user_level, jc.user_id main_user_id, job_categories.job_cat_name, job_levels.level_name, job_type.jobtype_name, countries.country_name');
        $this->db->from('job_cv jc');
        $this->db->join('user_details ud','ud.id = jc.user_id', 'left');
        $this->db->join('user_info ui','ui.user_id = jc.user_id', 'left');
        $this->db->join('job_categories','job_categories.id = jc.category', 'left');
        $this->db->join('countries','countries.country_code = jc.current_location', 'left');
        $this->db->join('job_levels','job_levels.id = jc.level', 'left');
        $this->db->join('job_type','job_type.id = jc.type', 'left');
        return $this->db->get()->result();
    }
    
    public function get_candidates() {
        $this->db->limit(5);
        $this->db->order_by('jc.time', 'DESC');
        $this->db->where(array('jc.job_title !=' => '', 'jc.objective !=' => '', 'jc.nationality !=' => ''));
        $this->db->select('jc.*, ui.*, jc.id main_id, jc.time main_time, jc.date main_date, user_level, jc.user_id main_user_id, job_categories.job_cat_name, job_levels.level_name, job_type.jobtype_name, countries.country_name');
        $this->db->from('job_cv jc');
        $this->db->join('user_details ud','ud.id = jc.user_id', 'left');
        $this->db->join('user_info ui','ui.user_id = jc.user_id', 'left');
        $this->db->join('job_categories','job_categories.id = jc.category', 'left');
        $this->db->join('countries','countries.country_code = jc.current_location', 'left');
        $this->db->join('job_levels','job_levels.id = jc.level', 'left');
        $this->db->join('job_type','job_type.id = jc.type', 'left');
        return $this->db->get()->result();
    }
    
    public function get_more_candidates($last_id) {
        $this->db->limit(5);
        $this->db->order_by('jc.time', 'DESC');
        $this->db->where(array('jc.job_title !=' => '', 'jc.objective !=' => '', 'jc.nationality !=' => '', 'jc.time <' => $last_id));
        $this->db->select('jc.*, ui.*, jc.id main_id, jc.time main_time, jc.date main_date, user_level, jc.user_id main_user_id, job_categories.job_cat_name, job_levels.level_name, job_type.jobtype_name, countries.country_name');
        $this->db->from('job_cv jc');
        $this->db->join('user_details ud','ud.id = jc.user_id', 'left');
        $this->db->join('user_info ui','ui.user_id = jc.user_id', 'left');
        $this->db->join('job_categories','job_categories.id = jc.category', 'left');
        $this->db->join('countries','countries.country_code = jc.current_location', 'left');
        $this->db->join('job_levels','job_levels.id = jc.level', 'left');
        $this->db->join('job_type','job_type.id = jc.type', 'left');
        return $this->db->get()->result();
    }

    public function get_candidate_by_file($file) {
        $this->db->where(array('jc.cv' => $file));
        $this->db->select('jc.*, jc.user_id main_user_id, ud.user_level, ui.count cv_count');
        $this->db->from('job_cv jc');
        $this->db->join('user_details ud','ud.id = jc.user_id', 'left');
        $this->db->join('user_info ui','ui.user_id = jc.user_id', 'left');
        return $this->db->get()->row();
    }

    public function update_cv_count($id, $count_cv, $count_user) {
        $this->db->where(array('user_id' => $id));
        $this->db->update('user_info', array('count' => $count_cv));
        if($count_user != '') {
            $this->db->where(array('user_id' => $this->session->userdata('user_id')));
            $this->db->update('org_info', array('count' => $count_user));
        }
    }
    
    public function get_applied_candidates($job_id) {
        $this->db->order_by('jc.time', 'DESC');
        $this->db->where(array('ja.status' => 0, 'ja.job_id' => $job_id, 'jc.job_title !=' => '', 'jc.objective !=' => '', 'jc.nationality !=' => ''));
        $this->db->select('jc.*, ui.*, jc.id main_id, jc.time main_time, jc.date main_date, user_level, jc.user_id main_user_id, job_categories.job_cat_name, job_levels.level_name, job_type.jobtype_name, countries.country_name');
        $this->db->from('job_cv jc');
        $this->db->join('user_details ud','ud.id = jc.user_id', 'left');
        $this->db->join('user_info ui','ui.user_id = jc.user_id', 'left');
        $this->db->join('job_categories','job_categories.id = jc.category', 'left');
        $this->db->join('countries','countries.country_code = jc.current_location', 'left');
        $this->db->join('job_levels','job_levels.id = jc.level', 'left');
        $this->db->join('job_type','job_type.id = jc.type', 'left');
        $this->db->join('job_applied ja', 'ja.user_id = jc.user_id', 'left');
        return $this->db->get()->result();
    }
    
    public function candidate_apply_check($job_id, $cand_id) {
        return $this->db->get_where('job_applied', array('job_id' => $job_id, 'user_id' => $cand_id))->num_rows();
    }
    
    public function shortlist_candidate($job_id, $cand_id) {
        $this->db->where(array('job_id' => $job_id, 'user_id' => $cand_id));
        $this->db->update('job_applied', array('status' => 1));
    }

    public function get_shortlisted_candidates($job_id) {
        $this->db->order_by('jc.time', 'DESC');
        $this->db->where(array('ja.status' => 1, 'ja.job_id' => $job_id, 'jc.job_title !=' => '', 'jc.objective !=' => '', 'jc.nationality !=' => ''));
        $this->db->select('jc.*, ui.*, jc.id main_id, jc.time main_time, jc.date main_date, user_level, jc.user_id main_user_id, job_categories.job_cat_name, job_levels.level_name, job_type.jobtype_name, countries.country_name');
        $this->db->from('job_cv jc');
        $this->db->join('user_details ud','ud.id = jc.user_id', 'left');
        $this->db->join('user_info ui','ui.user_id = jc.user_id', 'left');
        $this->db->join('job_categories','job_categories.id = jc.category', 'left');
        $this->db->join('countries','countries.country_code = jc.current_location', 'left');
        $this->db->join('job_levels','job_levels.id = jc.level', 'left');
        $this->db->join('job_type','job_type.id = jc.type', 'left');
        $this->db->join('job_applied ja', 'ja.user_id = jc.user_id', 'left');
        return $this->db->get()->result();
    }
    
    public function job_email($user_id, $company_id) {
        return $this->db->get_where('job_email', array('user_id' => $user_id, 'company_id' => $company_id))->num_rows();
    }
    
    public function add_job_email($user_id, $company_id) {
        $this->db->insert('job_email', array('user_id' => $user_id, 'company_id' => $company_id, 'date' => date('d M Y'), 'time' => time()));
    }

    public function share_newsfeed($data) {
        $this->db->insert('timeline', $data);
    }
    
    public function insert_transaction($data, $type){
        $status = '';
        if($data['payment_status'] == 'Completed') {
            if($this->db->get_where('payments', array('txn_id' => $data['txn_id']))->num_rows() == 0) {
                $this->db->insert('payments', $data);
                if($type != 'adv') {
                    $this->db->where('id', $this->session->userdata('user_id'));
                    $this->db->update('user_details', array('is_complete' => 0, 'user_level' => 1));
                }
                $status = 'Completed';
            }
        }
        if($data['payment_status'] == 'Pending' && $type != 'adv') {
            $this->db->where('id', $this->session->userdata('user_id'));
            $this->db->update('user_details', array('is_complete' => 0, 'user_level' => 0));
        }
        return $status;
    }
    
    public function insert_transaction_ccave($data){
        $status = '';
        $this->db->insert('payments_ccave', $data);
        if($data['order_status'] == 'Success') {
            if($this->db->get_where('user_details', array('id' => $this->session->userdata('user_id')))->row()->is_complete == '-1') {
                $this->db->where('id', $this->session->userdata('user_id'));
                $this->db->update('user_details', array('is_complete' => 0, 'user_level' => 1));
            } else {
                $this->db->where('id', $this->session->userdata('user_id'));
                $this->db->update('user_details', array('user_level' => 1));
            }
            $status = 'Success';
        } else {
            $this->db->where('id', $this->session->userdata('user_id'));
            $this->db->update('user_details', array('user_level' => 0));
        }
        return $status;
    }
    
    public function profile_upgrade($data, $type){
        $status = '';
        if($this->db->get_where('payments', array('user_id' => $this->session->userdata('user_id'), 'type' => $type))->num_rows() > 0) {
            $this->db->where('user_id', $this->session->userdata('user_id'));
            $this->db->update('payments', $data);
        } else {
            $this->db->insert('payments', $data);
            $status = 'Completed';
        }
        if($data['payment_status'] == 'Completed') {
            $this->db->where('id', $this->session->userdata('user_id'));
            $this->db->update('user_details', array('user_level' => 1));
        }
        return $status;
    }
    
    public function profile_upgrade_ccAve($data){
        $status = '';
        if($this->db->get_where('payments_ccave', array('user_id' => $this->session->userdata('user_id')))->num_rows() > 0) {
            $this->db->where('user_id', $this->session->userdata('user_id'));
            $this->db->update('payments_ccave', $data);
        } else {
            $this->db->insert('payments_ccave', $data);
            $status = 'Success';
        }
        if($data['order_status'] == 'Success') {
            $this->db->where('id', $this->session->userdata('user_id'));
            $this->db->update('user_details', array('user_level' => 1));
        }
        return $status;
    }
    
    public function get_last_id($table_name,$col_name) {
        $this->db->select_max($col_name);
        $result= $this->db->get($table_name);
        if ($result->num_rows() > 0) {
            return $result->num_rows();
        }
        else  {
            return 1;
        }
    }
    
    public function add_invitation($email) {
        $this->db->insert('invitations', array('user_id' => $this->session->userdata('user_id'), 'email_id' => $email, 'time' => time(), 'date' => date('d M Y')));
    }
    
    public function submit_csr($data) {
        $this->db->insert('csr_submission', $data);
    }
    
    public function add_csr_list() {
        $this->db->insert('csr', array('user_id' => $this->session->userdata('user_id'), 'status' => 0, 'time' => time(), 'date' => date('d M Y')));
    }
    
    public function check_csr_status() {
        if($this->db->get_where('csr', array('user_id' => $this->session->userdata('user_id')))->num_rows() > 0) {
            return $this->db->get_where('csr', array('user_id' => $this->session->userdata('user_id')))->row()->status;
        } else {
            return 'null';
        }
    }
    
    public function get_csr_listing() {
        $this->db->limit(1);
        $this->db->order_by('c.time', 'DESC');
        $this->db->where(array('c.status' => 2));
        $this->db->select('c.*, oi.*, propic, c.time csr_time, c.status csr_status');
        $this->db->from('csr c');
        $this->db->join('user_details ud', 'ud.id = c.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = c.user_id', 'left');
        return $this->db->get()->result();
    }
    
    public function get_more_csr_listing($last_id) {
        $this->db->limit(20);
        $this->db->order_by('c.time', 'DESC');
        $this->db->where(array('c.status' => 2, 'c.time <' => $last_id));
        $this->db->select('c.*, oi.*, propic, c.time csr_time, c.status csr_status');
        $this->db->from('csr c');
        $this->db->join('user_details ud', 'ud.id = c.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = c.user_id', 'left');
        return $this->db->get()->result();
    }
    
    public function get_csr_process() {
        $this->db->limit(20);  
        $this->db->order_by('c.time', 'DESC');
        $this->db->where(array('c.status' => 1));
        $this->db->select('c.*, oi.*, propic, c.time csr_time, c.status csr_status');
        $this->db->from('csr c');
        $this->db->join('user_details ud', 'ud.id = c.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = c.user_id', 'left');
        return $this->db->get()->result();
    }
    
    public function get_more_csr_process($last_id) {
        $this->db->limit(20);
        $this->db->order_by('c.time', 'DESC');
        $this->db->where(array('c.status' => 1, 'c.time <' => $last_id));
        $this->db->select('c.*, oi.*, propic, c.time csr_time, c.status csr_status');
        $this->db->from('csr c');
        $this->db->join('user_details ud', 'ud.id = c.user_id', 'left');
        $this->db->join('org_info oi', 'oi.user_id = c.user_id', 'left');
        return $this->db->get()->result();
    }
    
    public function get_adv_blocks($page, $view) {
        return $this->db->get_where('adv_blocks', array('page' => $page, 'viewport' => $view))->result();
    }
    
    public function get_booked_blocks($page, $view, $country) {
        $blocks = array();
        $this->db->select('block_name, availability');
        $res = $this->db->get_where('adv_blocks_booked', array('page' => $page, 'viewport' => $view, 'country' => $country))->result();
        if(count($res) > 0) {
           foreach ($res as $r) {
                $blocks[$r->block_name] = $r->availability;
            } 
        }
        return $blocks;
    }
    
    public function get_block_details($id) {
        return $this->db->get_where('adv_blocks', array('id' => $id))->row();
    }
    
    public function book_adv_block($data) {
        $this->db->insert('adv_blocks_booked', $data);
    }
    
    public function get_user_advblock($user_id, $block_id) {
        return $this->db->get_where('adv_blocks_booked', array('user_id' => $user_id, 'block_id' => $block_id))->row();
    }
    
    public function delete_user_advblock($user_id, $block_id) {
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
        }
    }
    
    public function get_page_side_advblocks($page, $area, $block) {
        if($this->db->get_where('adv_blocks_booked', array('page' => $page, 'country' => $area, 'block_name' => $block, 'approve' => 1, 'availability_timestamp >' => time()))->num_rows() > 0) {
            return $this->db->get_where('adv_blocks_booked', array('page' => $page, 'country' => $area, 'block_name' => $block, 'approve' => 1, 'availability_timestamp >' => time()))->row();
        } else {
            return 'blah';
        }
    }
    
    public function get_timeline_advblocks($page, $area, $block) {
        if($this->db->get_where('adv_blocks_booked', array('page' => $page, 'country' => $area, 'block_name' => $block, 'approve' => 1, 'availability_timestamp >' => time()))->num_rows() > 0) {
            return $this->db->get_where('adv_blocks_booked', array('page' => $page, 'country' => $area, 'block_name' => $block, 'approve' => 1, 'availability_timestamp >' => time()))->row();
        } else {
            return 'blah';
        }
    }
    
    public function check_referral_code($code) {
        $this->db->get_where('offer_referral_code', array('ref_code' => $code))->num_rows();
    }
    
    public function insert_user_referral_code($code) {
        $this->db->insert('offer_referral_code', array('user_id' => $this->session->userdata('user_id'), 'ref_code' => $code));
    }
    
    public function get_referral_status($user_id) {
        if($this->db->get_where('offer_referral_code', array('user_id' => $user_id))->num_rows() != 0) {
            return $this->db->get_where('offer_referral_code', array('user_id' => $user_id))->row();
        } else {
            return 'nil';
        }
    }
    
    public function get_invited_freemems() {
        if($this->db->get_where('offer_referral_code', array('user_id' => $this->session->userdata('user_id')))->num_rows() != 0) {
            $user_id = array();
            $code = $this->db->get_where('offer_referral_code', array('user_id' => $this->session->userdata('user_id')))->row()->ref_code;
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
            $invited = $this->db->get()->num_rows();
            return count($inv_array) + $invited;
        } else {
            return 0;
        }
    }
    
    public function free_user_upgrade() {
        $count = $this->get_invited_premems();
        if($count == 2) {
            if($this->db->get_where('user_details', array('id' => $this->session->userdata('user_id')))->row()->user_level == 0) {
                $this->db->where('id', $this->session->userdata('user_id'));
                $this->db->update('user_details', array('user_level' => 1));
            }
        }
    }
    
    public function free_user_upgrade_sos() {
        if($this->db->get_where('ads_upgrade', array('user_id' => $this->session->userdata('user_id')))->num_rows() != 0) {
            $row = $this->db->get_where('ads_upgrade', array('user_id' => $this->session->userdata('user_id')))->row();
            if($row->count == 2 && $row->status == 0) {
                $ad_ids = explode(',', $row->ad_ids);
                $ad_one = $this->db->get_where('ads', array('id' => $ad_ids[0]))->row();
                $ad_two = $this->db->get_where('ads', array('id' => $ad_ids[1]))->row();
                $this->load->model('email_m');
                $this->email_m->wa_submission($ad_one, $ad_two, $this->info->email);
                $this->db->where('user_id', $this->session->userdata('user_id'));
                $this->db->update('ads_upgrade', array('status' => 1));
            }
        }
    }

    public function get_invited_premems() {
        if($this->db->get_where('offer_referral_code', array('user_id' => $this->session->userdata('user_id')))->num_rows() != 0) {
            $user_id = array();
            $code = $this->db->get_where('offer_referral_code', array('user_id' => $this->session->userdata('user_id')))->row()->ref_code;
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
            $invited = $this->db->get()->num_rows();
            return count($inv_array) + $invited;
        } else {
            return 0;
        }
    }
    
    public function get_user_usage() {
        $this->db->like('date', date('M Y'));
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $t_count = $this->db->get('timeline')->num_rows();
        $this->db->like('date', date('M Y'));
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $l_count = $this->db->get('like_dislike')->num_rows();
        $this->db->like('date', date('M Y'));
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $c_count = $this->db->get('comments')->num_rows();
        $a_count = ($this->db->get_where('user_log', array('user_id' => $this->session->userdata('user_id')))->num_rows() > 0)? $this->db->get_where('user_log', array('user_id' => $this->session->userdata('user_id')))->row()->active_days : 0;
        $count = $t_count + $l_count + $c_count + $a_count;
        switch ($count) {
            case $count == 0 : return 0;
                break;
            case $count < 30 : return 10;
                break;
            case $count < 40 : return 25;
                break;
            case $count < 55 : return 50;
                break;
            case $count < 70 : return 75;
                break;;
            case $count > 70 : return 100;    
        }
    }
    
    public function get_tokenkey($user_id) {
        return $this->db->get_where('user_details', array('id' => $user_id))->row()->device_token;
    }
    
    public function insert_essay($data) {
        if($this->db->get_where('seso', array('user_id' => $this->session->userdata('user_id')))->num_rows() != 0) {
            $this->db->where('user_id', $this->session->userdata('user_id'));
            $this->db->update('seso', $data); 
        } else {
            $this->db->insert('seso', $data);
        }
    }
    
    public function insert_drawing($data) {
        if($this->db->get_where('seso', array('user_id' => $this->session->userdata('user_id')))->num_rows() != 0) {
            $this->db->where('user_id', $this->session->userdata('user_id'));
            $this->db->update('seso', $data); 
        } else {
            $this->db->insert('seso', $data);
        }
    }
    
    public function user_seso_status() {
        if($this->db->get_where('seso', array('user_id' => $this->session->userdata('user_id')))->num_rows() != 0) {
            return $this->db->get_where('seso', array('user_id' => $this->session->userdata('user_id')))->row();
        } else {
            return 'null';
        }
    }
    
}

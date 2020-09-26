<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Seso extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('home_m');
    }
    
    public function index() {
        $this->session->set_userdata('enroll', 1);
        $this->load->view('seso/index');
    }
    
    public function shortlist() {
        $this->load->view('seso/list');
    }
    
    public function load_group() {
        if($this->input->post('grp')) {
            $data['lists'] = $this->home_m->get_seso_grp_list($this->input->post('grp'));
            $this->load->view('seso/list-block', $data);
        }
    }
    
    public function load_seso_essay() {
        if($this->input->post('id')) {
            $data['item'] = $this->home_m->get_seso_content($this->input->post('id'));
            $this->load->view('seso/essay_content', $data);
        }
    }
    
    public function load_seso_drawing() {
        if($this->input->post('id')) {
            $data['item'] = $this->home_m->get_seso_content($this->input->post('id'));
            $this->load->view('seso/drawing_content', $data);
        }
    }
    
}
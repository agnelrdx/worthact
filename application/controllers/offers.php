<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Offers extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        redirect(base_url());
        $this->session->set_userdata('enroll', 1);
        $this->load->view('offers/offers');
    }
    
}
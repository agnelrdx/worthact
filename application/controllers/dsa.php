<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dsa extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('home_m');
    }
    
    public function index() {
        $data['free_mems'] = $this->home_m->get_invited_freemems();
        $data['pre_mems'] = $this->home_m->get_invited_premems();
        $this->load->view('dsa/index' , $data);
    }
    
}
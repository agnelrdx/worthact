<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Mailer extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('home_m');
        $this->load->model('email_m');
    }
    
    public function index() {
        $this->load->view('mail/index');
    }
    
    public function send_mail() {
        $this->form_validation->set_rules('msg', 'Message', 'trim|required');
        if ($this->form_validation->run() == TRUE) {
            $to = $this->input->post('to');
            if($this->session->userdata('user_id') == 2) { 
                $from = 'manojs@worthact.com'; } 
            else if($this->session->userdata('user_id') == 602) { 
                $from = 'rajeshkumar@worthact.com'; } 
            else { 
                $from = $this->session->userdata('user_email'); 
            }
            $subject = $this->input->post('subject');
            $name = $this->input->post('name');
            $msg = $this->input->post('msg');
            $regards = $this->input->post('regards');
            switch ($this->session->userdata('user_id')) {
                case 1:
                    $sig_val = "<div class='mn sig'>
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 19px;font-size: 14px;'><b>Manoj Nair</b></p>
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>Founder, WorthACT Initiatives</p>
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>Dubai, UAE | Trivandrum, India</p>
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>+971501974301, 00919656696590</p>
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>manojnair@worthact.com</p>
                            </div>";
                    break;
                case 2:
                    $sig_val = "<div class='ms sig'>
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 19px;font-size: 14px;'><b>Manoj S</b></p>
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>GM - Operations</p>
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>Dubai, UAE | Trivandrum, India</p>
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>00919400997744</p>
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>manojs@worthact.com</p>
                            </div>";
                    break;
                case 602:
                    $sig_val = "<div class='r sig'>
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 19px;font-size: 14px;'><b>Rajesh Kumar</b></p>
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>Senior Manager - Sales & Business Development</p>
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>Dubai, UAE | Trivandrum, India</p>
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>+91 9497730012</p>
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>rajeshkumar@worthact.com</p>
                            </div>";
                    break;
                case 7:
                    $sig_val = "<div class='r sig'>
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 19px;font-size: 14px;'><b>Test Dummy</b></p>
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>Software Engineer</p>
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>Dubai, UAE | Trivandrum, India</p>
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>007</p>
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>$from</p>
                            </div>";
                    break;
                case 8:
                    $sig_val = "<div class='r sig'>
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 19px;font-size: 14px;'><b>Test Dummy</b></p>
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>Software Engineer</p>
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>Dubai, UAE | Trivandrum, India</p>
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>007</p>
                                <p style='font-family:Verdana,Georgia,Times,serif;margin:0 0 5px;line-height: 16px;font-size: 14px;'>$from</p>
                            </div>";
                    break;
            }
            $data = array('user_id' => $this->session->userdata('user_id'), 'to_mail' => $to, 'from_mail' => $from, 'subject' => $subject, 'name' => $name, 'content' => $msg, 'time' => time(), 'date' => date('d M Y'));
            $this->home_m->insert_mailer_template($data);
            $this->email_m->send_mailertemplate($to, $from, $subject, $name, $msg, $regards, $sig_val);
            $this->session->set_flashdata('msg', '<div class="alert alert-success" role="alert">Email successfully sent.</div>');
            redirect('mailer');
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Message field is required.</div>');
            redirect('mailer');
        }
    }
    
}
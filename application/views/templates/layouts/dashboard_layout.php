<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Load Page Views
 */

$this->load->view('templates/dashboard/header');
$this->load->view($view);
$this->load->view('templates/dashboard/footer');
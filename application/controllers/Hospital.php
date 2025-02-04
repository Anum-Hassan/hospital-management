<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hospital extends CI_Controller {

    public function register() {
        $this->load->view('register'); 
    }
    public function login() {
        $this->load->view('login'); 
    }
    public function index() {
        $this->load->view('index'); 
    }
    public function doctors() {
        $this->load->view('doctors'); 
    }
    public function patients() {
        $this->load->view('patients'); 
    }
    public function appointments() {
        $this->load->view('appointments'); 
    }
    public function laboratoray() {
        $this->load->view('laboratoray'); 
    }
}
?>

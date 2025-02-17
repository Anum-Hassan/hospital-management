<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function index()
   {
        $this->load->view('users-panel/index');
    }
    public function about()
   {
        $this->load->view('users-panel/about');
    }
    public function services()
   {
        $this->load->view('users-panel/services');
    }
    public function features()
   {
        $this->load->view('users-panel/features');
    }
    public function Appointments()
   {
        $this->load->view('users-panel/Appointments');
    }
   
    public function Testimonial()
   {
        $this->load->view('users-panel/Testimonial');
    }
    public function Contacts()
   {
        $this->load->view('users-panel/Contacts');
    }
    public function ourDoctor()
   {
        $this->load->view('users-panel/ourDoctor');
    }
   
}
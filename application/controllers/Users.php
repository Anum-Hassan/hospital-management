<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_Model');
        // $this->load->library('pdf'); // Load PDF library
        $this->load->library('session');
        $this->load->helper('url');

       
    }

   

    public function register()
{
    $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|max_length[20]');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');

    if ($this->form_validation->run() == FALSE) {
        $this->load->view('users-panel/register');
    } else {
        $userData = array(
            'username' => $this->input->post('username'),
            'email'    => $this->input->post('email'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
        );

        $insert = $this->Users_Model->insert_admin($userData);

        if ($insert) {
            $this->session->set_flashdata('success', 'Registered Successfully!');
            redirect('users/login');
        } else {
            $this->session->set_flashdata('error', 'Registration Failed!');
            redirect('users/register');
        }
    }
}

public function login()
{
    if ($this->session->userdata('user_logged_in')) {
        redirect('index');
    }

    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required');

    if ($this->form_validation->run() == FALSE) {
        $this->load->view('users-panel/login');
    } else {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->Users_Model->get_user_by_email($email); // Fetch user data from 'users' table

        if ($user && password_verify($password, $user->password)) { // Verify hashed password
            $user_data = [
                'user_id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'user_logged_in' => TRUE
            ];
            $this->session->set_userdata($user_data);

            $this->session->set_flashdata('success', 'Login successful! Welcome, ' . $user->username);
            redirect('index');
        } else {
            $this->session->set_flashdata('error', 'Invalid email or password.');
            redirect('login');
        }
    }
}

public function logout()
{
    $this->session->unset_userdata('user_logged_in');
    $this->session->unset_userdata('user_id');
    $this->session->unset_userdata('username');
    $this->session->unset_userdata('email');

    $this->session->set_flashdata('success', 'You have been logged out successfully.');
    redirect('users/login');
}

public function Appointments()
{
    if (!$this->session->userdata('user_logged_in')) {
        $this->session->set_flashdata('error', 'Please login to book an appointment.');
        redirect('users/login'); // Redirect to login page
    }

    $this->load->view('users-panel/Appointments'); // Show appointment page if logged in
}

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
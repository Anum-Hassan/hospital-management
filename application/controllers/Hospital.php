<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hospital extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('Hospital_Model');
        $this->load->library('form_validation'); 
        $this->load->library('session'); 
         $this->load->helper('url');
    }

    public function register() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|max_length[20]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[admins.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('register');
        } else {
            $data = array(
                'username' => $this->input->post('username'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                'role' => $this->input->post('role'),
                'image' => $this->_upload_image()
            );

            if ($this->Hospital_Model->insert_admin($data)) {
                $this->session->set_flashdata('success', 'Registration successful!');
                redirect('hospital/login');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong. Try again.');
                redirect('hospital/register');
            }
        }
    }

    private function _upload_image() {
        if (!empty($_FILES['image']['name'])) {
            $config['upload_path'] = './uploads/profile_images/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 2048;
            $config['file_name'] = time() . '_' . $_FILES['image']['name'];

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('image')) {
                return $this->upload->data('file_name');
            } else {
                return null;
            }
        }
        return null;
    }

    public function login() {
        // Agar already login hai to dashboard pe redirect ho jaye
        if ($this->session->userdata('admin_logged_in')) {
            redirect('hospital/dashboard');
        }

        // **Step 1: Form Validation Rules**
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            // **Agar validation fail ho jaye to login page dikhaye**
            $this->load->view('login');
        } else {
            // **Step 2: Form Data Get Karna**
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // **Step 3: Model Function Call Karna**
            $admin = $this->Hospital_Model->check_admin_login($username, $password);

            if ($admin) {
                // **Step 4: Session Set Karna**
                $admin_data = [
                    'admin_id' => $admin->id,
                    'username' => $admin->username,
                    'email' => $admin->email,
                    'role' => $admin->role,
                    'admin_logged_in' => TRUE
                ];
                $this->session->set_userdata($admin_data);

                // **Success Message & Redirect to Dashboard**
                $this->session->set_flashdata('success', 'Login successful! Welcome, ' . $admin->username);
                redirect('hospital/dashboard');
            } else {
                // **Agar password wrong ho to error show kare**
                $this->session->set_flashdata('error', 'Invalid username or password.');
                redirect('hospital/login');
            }
        }
    }

    public function dashboard() {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect('hospital/login'); // If not logged in, redirect to login
        }
        
        $this->load->view('index'); // Dashboard Page Load Karega
    }
    public function doctors()
    {
        $data['doctor_details'] = $this->Hospital_Model->getDoctors();
        $this->load->view('doctors', $data);
    }
    public function addDoctor()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $result = $this->Hospital_Model->insertDoctor([
                'name' => $this->input->post('name'),
                'image' => $this->input->post('image'),
                'specialization' => $this->input->post('specialization'),
                'consultation_fee' => $this->input->post('consultation_fee'),
                'phone' => $this->input->post('phone'),
                'address' => $this->input->post('address')
            ]);

            if ($result) {
                redirect('manage-doctors');
            } else {
                $data['error'] = 'Failed to insert doctor record!';
            }
        }

        $this->load->view('manage-doctors');
    }

    public function patients()
    {
        $this->load->view('patients');
    }
    public function appointments()
    {
        $this->load->view('appointments');
    }
    public function laboratoray()
    {
        $this->load->view('laboratoray');
    }
}

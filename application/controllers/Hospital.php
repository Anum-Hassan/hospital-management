<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hospital extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Hospital_Model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function register()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|max_length[20]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[admins.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('role', 'Role', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('register');
        } else {
            // Image Upload Configuration
            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size']      = 2048;
            $config['file_name']     = time() . '_' . $_FILES["image"]["name"];

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('error', $error);
                redirect('register');
            } else {
                $uploadData = $this->upload->data();
                $imagePath = 'uploads/' . $uploadData['file_name'];

                $userData = array(
                    'username' => $this->input->post('username'),
                    'email'    => $this->input->post('email'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'role'     => $this->input->post('role'),
                    'image'    => $imagePath
                );

                $insert = $this->Hospital_Model->insert_admin($userData);

                if ($insert) {
                    $this->session->set_flashdata('success', 'User Registered Successfully!');
                    redirect('register');
                } else {
                    $this->session->set_flashdata('error', 'User Registration Failed!');
                    redirect('register');
                }
            }
        }
    }

    public function login()
    {
        // Agar already login hai to dashboard pe redirect ho jaye
        if ($this->session->userdata('admin_logged_in')) {
            redirect('dashboard');
        }

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $admin = $this->Hospital_Model->check_admin_login($username, $password);

            if ($admin) {
                $admin_data = [
                    'admin_id' => $admin->id,
                    'username' => $admin->username,
                    'email' => $admin->email,
                    'role' => $admin->role,
                    'admin_logged_in' => TRUE
                ];
                $this->session->set_userdata($admin_data);

                $this->session->set_flashdata('success', 'Login successful! Welcome, ' . $admin->username);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'Invalid username or password.');
                redirect($route['default_controller']);
            }
        }
    }

    public function dashboard()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect($route['default_controller']); // If not logged in, redirect to login
        }

        $this->load->view('index'); // Dashboard Page Load Karega
    }

    public function doctors()
    {
        $data['doctor_details'] = $this->Hospital_Model->getDoctors();
        $this->load->view('doctors', $data);
    }

    private function uploadImage()
    {
        $config['upload_path'] = 'uploads/Doctors/'; // Ensure path has proper directory separator
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048;
        $config['file_name'] = time() . '_' . $_FILES["image"]["name"];

        // Load upload library
        $this->load->library('upload', $config);

        // Check if directory exists, create if not
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, true);
        }

        if (!$this->upload->do_upload('image')) {
            $this->session->set_flashdata('error', 'Image upload failed: ' . $this->upload->display_errors());
            return false;
        }

        // Return the path including the filename on successful upload
        return $config['upload_path'] . $this->upload->data('file_name');
    }

    public function addDoctor()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->form_validation->set_rules('name', 'Doctor Name', 'trim|required');
            $this->form_validation->set_rules('specialization', 'Specialization', 'trim|required');
            $this->form_validation->set_rules('consultation_fee', 'Consultation Fee', 'trim|required|numeric');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|numeric');
            $this->form_validation->set_rules('address', 'Address', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                redirect('manage-doctors');
            } else {
                $uploadedImage = $this->uploadImage();

                if (!$uploadedImage && $_FILES['image']['name']) {
                    $this->session->set_flashdata('error', 'Image upload failed!');
                    redirect('manage-doctors');
                }

                $doctorData = [
                    'name' => $this->input->post('name'),
                    'image' => $uploadedImage,
                    'specialization' => $this->input->post('specialization'),
                    'consultation_fee' => $this->input->post('consultation_fee'),
                    'phone' => $this->input->post('phone'),
                    'address' => $this->input->post('address')
                ];

                if ($this->Hospital_Model->insertDoctor($doctorData)) {
                    $this->session->set_flashdata('success', 'Doctor added successfully!');
                    redirect('doctors');
                } else {
                    $this->session->set_flashdata('error', 'Failed to add doctor record!');
                    redirect('manage-doctors');
                }
            }
        } else {
            $this->load->view('manage-doctors');
        }
    }

    public function editDoctor($id)
    {
        $data['doctor'] = $this->Hospital_Model->getDoctorById($id);

        if (empty($data['doctor'])) {
            show_404(); // Handle invalid doctor ID
        }

        $this->load->view('manage-doctors', $data); // Ensure the view file matches this name
    }

    public function updateDoctor($id)
    {
        $data = [
            'name' => $this->input->post('name'),
            'specialization' => $this->input->post('specialization'),
            'consultation_fee' => $this->input->post('consultation_fee'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address'),
        ];

        // Handle image upload if a new image is uploaded
        if (!empty($_FILES['image']['name'])) {
            $upload_path = $this->uploadImage();
            if ($upload_path) { // Check if upload was successful
                $data['image'] = $upload_path;
            } else {
                $this->session->set_flashdata('error', 'Image upload failed.');
                redirect('doctors');
                return;
            }
        }

        if ($this->Hospital_Model->updateDoctor($id, $data)) {
            $this->session->set_flashdata('success', 'Doctor information updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to update doctor information.');
        }

        redirect('doctors');
    }


    public function deleteDoctor($id)
    {
        if (is_numeric($id) && $this->Hospital_Model->deleteDoctor($id)) {
            $this->session->set_flashdata('delete', 'Doctor record deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete doctor.');
        }
        redirect('doctors');
    }

    public function staff(){
        $this->load->view('staff');
    }
    public function patients(){
        $this->load->view('patients');
    }
}


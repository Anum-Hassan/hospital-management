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

    // Dashboard function
    public function dashboard()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            redirect($route['default_controller']);
        }

        $this->load->view('index');
    }

    // Delete Function for all
    public function deleteRecord($table, $id)
    {
        $this->load->model('Hospital_Model');
        if (!empty($table) && is_numeric($id) && $this->Hospital_Model->deleteRecord($table, $id)) {
            $this->session->set_flashdata('delete', ' Record deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete the record.');
        }
        redirect($table);
    }
    // End delete

    // Start Toggle Status
    public function toggle_status($table, $id)
    {
        $current_status = $this->Hospital_Model->get_current_status($table, $id);
        $new_status = $current_status == 1 ? 0 : 1;
        $this->Hospital_Model->update_status($table, $id, $new_status);

        // Redirect dynamically based on the table name
        $redirect_url = $table == 'doctors' ? 'doctors' : ($table == 'departments' ? 'departments' : 'dashboard');
        redirect($redirect_url);
    }
    // End Toggle status

    // Doctor Functions
    public function doctors()
    {
        $data['doctor_details'] = $this->Hospital_Model->getDoctors();
        $this->load->view('doctors', $data);
    }

    private function uploadImage()
    {
        $config['upload_path'] = 'uploads/Doctors/';
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048;
        $config['file_name'] = time() . '_' . $_FILES["image"]["name"];

        $this->load->library('upload', $config);

        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0755, true);
        }

        if (!$this->upload->do_upload('image')) {
            $this->session->set_flashdata('error', 'Image upload failed: ' . $this->upload->display_errors());
            return false;
        }

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
            show_404();
        }
        $this->load->view('manage-doctors', $data);
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

        if (!empty($_FILES['image']['name'])) {
            $upload_path = $this->uploadImage();
            if ($upload_path) {
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
    // End Doctor Function
    // Start Department Functions
    public function depart()
    {
        $data['depart_details'] = $this->Hospital_Model->getDeparts();
        $this->load->view('departments', $data);
    }

    public function addDepart()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->form_validation->set_rules('name', 'Depart Name', 'trim|required');
            $this->form_validation->set_rules('description', 'Description', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                redirect('manage-departments');
            } else {

                $doctorData = [
                    'name' => $this->input->post('name'),
                    'description' => $this->input->post('description'),
                ];

                if ($this->Hospital_Model->insertDepart($doctorData)) {
                    $this->session->set_flashdata('success', 'Department added successfully!');
                    redirect('departments');
                } else {
                    $this->session->set_flashdata('error', 'Failed to add department record!');
                    redirect('manage-departments');
                }
            }
        } else {
            $this->load->view('manage-departments');
        }
    }

    public function editDepart($id)
    {
        $data['department'] = $this->Hospital_Model->getDepartById($id);
        if (empty($data['department'])) {
            show_404();
        }
        $this->load->view('manage-departments', $data);
    }

    public function updateDepart($id)
    {
        $data = [
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
        ];

        if ($this->Hospital_Model->updateDepart($id, $data)) {
            $this->session->set_flashdata('success', 'Department information updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to update department information.');
        }

        redirect('departments');
    }
    // End Department

    // Start Patient Functions
    public function patients()
    {
        $data['patient_details'] = $this->Hospital_Model->getPatients();
        $this->load->view('patients', $data);
    }

    public function addPatient()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            // Form validation rules
            $this->form_validation->set_rules('user_id', 'User ID', 'trim|numeric');
            $this->form_validation->set_rules('doctor_id', 'Doctor', 'trim|numeric');
            $this->form_validation->set_rules('room_id', 'Room', 'trim|numeric');
            $this->form_validation->set_rules('check_in', 'Check-in Date', 'trim|required');
            $this->form_validation->set_rules('age', 'Age', 'trim|required|numeric');
            $this->form_validation->set_rules('gender', 'Gender', 'trim|required|in_list[male,female,other]');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|numeric');
            $this->form_validation->set_rules('address', 'Address', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                redirect('manage-patients');
            } else {
                $patientData = [
                    'user_id' => $this->input->post('user_id') ?: null,
                    'doctor_id' => $this->input->post('doctor_id') ?: null,
                    'room_id' => $this->input->post('room_id') ?: null,
                    'check_in' => $this->input->post('check_in'),
                    'check_out' => $this->input->post('check_out'),
                    'age' => $this->input->post('age'),
                    'gender' => $this->input->post('gender'),
                    'phone' => $this->input->post('phone'),
                    'address' => $this->input->post('address'),
                ];

                if ($this->Hospital_Model->insertPatient($patientData)) {
                    $this->session->set_flashdata('success', 'Patient added successfully!');
                    redirect('patients');
                } else {
                    $this->session->set_flashdata('error', 'Failed to add patient record!');
                    redirect('manage-patients');
                }
            }
        } else {
            // Fetch only active doctors with status = 1
            $data['doctors'] = $this->Hospital_Model->getActiveDoctors();
            $data['users'] = $this->db->get('users')->result();
            $data['rooms'] = $this->db->get('rooms')->result();
            $this->load->view('manage-patients', $data);
        }
    }

    public function editPatient($id)
    {
        $data['patient'] = $this->Hospital_Model->getPatientById($id);
        if (empty($data['patient'])) {
            show_404();
        }

        // Fetch only active doctors with status = 1
        $data['doctors'] = $this->Hospital_Model->getActiveDoctors();
        $data['users'] = $this->db->get('users')->result();
        $data['rooms'] = $this->db->get('rooms')->result();

        $this->load->view('manage-patients', $data);
    }


    public function updatePatient($id)
    {
        $data = [
            'user_id' => $this->input->post('user_id') ?: NULL,
            'doctor_id' => $this->input->post('doctor_id'),
            'room_id' => $this->input->post('room_id') ?: NULL,
            'check_in' => $this->input->post('check_in'),
            'check_out' => $this->input->post('check_out'),
            'age' => $this->input->post('age'),
            'gender' => $this->input->post('gender'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address')
        ];

        // Update operation and error handling
        if ($this->Hospital_Model->updatePatient($id, $data)) {
            $this->session->set_flashdata('success', 'Patient information updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to update patient information.');
        }

        redirect('patients');
    }

    // End Patient

    // Start patient History
    public function managePatientHistory($patient_id)
    {
        $data['medical_history'] = $this->Hospital_Model->getPatientMedicalHistory($patient_id);
        $data['patient_id'] = $patient_id;
        $this->load->view('manage-medical-history', $data);
    }

    public function addPatientHistory()
    {
        $patient_id = $this->input->post('patient_id');
        $historyData = [
            'patient_id' => $patient_id,
            'condition' => $this->input->post('condition'),
            'diagnosis_date' => $this->input->post('diagnosis_date'),
            'treatment' => $this->input->post('treatment'),
            'medications' => $this->input->post('medications'),
            'notes' => $this->input->post('notes'),
        ];

        if ($this->Hospital_Model->insertPatientHistory($historyData)) {
            $this->session->set_flashdata('success', 'Medical history added successfully!');
        } else {
            $this->session->set_flashdata('error', 'Failed to add medical history.');
        }

        redirect('manage-medical-history/' . $patient_id);
    }

    public function deletePatientHistory($id, $patient_id)
    {
        if ($this->Hospital_Model->deletePatientHistory($id)) {
            $this->session->set_flashdata('success', 'Medical history deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to delete medical history.');
        }

        redirect('manage-medical-history/' . $patient_id);
    }
    // End Patient History

    public function staff()
    {
        $this->load->view('staff');
    }
    public function addStaff()
    {
        $this->load->view('manage-staff');
    }


    public function appt()
    {
        $this->load->view('appointments');
    }
    public function addAppt()
    {
        $this->load->view('manage-appointments');
    }
}

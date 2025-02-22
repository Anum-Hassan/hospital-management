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

        $allowed = ['login', 'register'];
        if (!in_array($this->router->fetch_method(), $allowed)) {
            $this->is_logged_in();
        }

        $user_data = array(
            'username' => $this->session->userdata('username'),
            'image'    => $this->session->userdata('image')
        );

        $this->load->vars($user_data);
    }

    private function is_logged_in()
    {
        if (!$this->session->userdata('admin_logged_in')) {
            $this->session->set_flashdata('error', 'Please login first.');
            redirect('login');
            exit;
        }
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
            $config['upload_path']   = './uploads/profile_images';
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
                $imagePath = 'uploads/profile_images/' . $uploadData['file_name'];

                $userData = array(
                    'username' => $this->input->post('username'),
                    'email'    => $this->input->post('email'),
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'role'     => $this->input->post('role'),
                    'image'    => $imagePath
                );

                $insert = $this->Hospital_Model->insert_admin($userData);

                if ($insert) {
                    $this->session->set_flashdata('success', 'Registered Successfully!');
                    redirect('login');
                } else {
                    $this->session->set_flashdata('error', 'Registration Failed!');
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

        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $admin = $this->Hospital_Model->check_admin_login($email, $password);

            if ($admin) {
                $admin_data = [
                    'admin_id' => $admin->id,
                    'username' => $admin->username,
                    'email' => $admin->email,
                    'role' => $admin->role,
                    'image' => $admin->image,
                    'admin_logged_in' => TRUE
                ];
                $this->session->set_userdata($admin_data);

                $this->session->set_flashdata('success', 'Login successful! Welcome, ' . $admin->username);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'Invalid username or password.');
                redirect('login');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('admin_logged_in');
        $this->session->unset_userdata('admin_id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role');

        $this->session->set_flashdata('success', 'You have been logged out successfully.');
        redirect('login');
    }

    // Dashboard function
    public function dashboard()
    {
        $user_data = array(
            'username' => $this->session->userdata('username'),
            'image'    => $this->session->userdata('image')
        );

        $this->load->model('Hospital_Model');

        $data['doctors'] = $this->Hospital_Model->getActiveDoctors();
        $data['patients'] = $this->Hospital_Model->getPatientCounts();
        $data['rooms'] = $this->Hospital_Model->getRooms();
        $data['pending_appointments'] = $this->Hospital_Model->getPendingAppts();
        $data['approved_appointments'] = $this->Hospital_Model->getApprovedAppts();
        $data['completed_appointments'] = $this->Hospital_Model->getCompletedAppts();
        $data['canceled_appointments'] = $this->Hospital_Model->getCanceledAppts();
        $data['total_profit'] = $this->Hospital_Model->getTotalProfit();
        $data['pending_amount'] = $this->Hospital_Model->getPendingAmount();
        $view_data = array_merge($user_data, $data);

        $this->load->view('index', $view_data);
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

    //Start Doctor Functions
    public function doctors()
    {
        // $this->is_logged_in();
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
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|regex_match[/^[0-9+\-() ]+$/]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('qualification', 'Qualification', 'trim|required');
            $this->form_validation->set_rules('department_id', 'Department', 'trim|required');
            $this->form_validation->set_rules('experience', 'Experience', 'trim|required|numeric|1');
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
                    'qualification' => $this->input->post('qualification'),
                    'department_id' => $this->input->post('department_id'),
                    'experience' => $this->input->post('experience'),
                    'consultation_fee' => $this->input->post('consultation_fee'),
                    'phone' => $this->input->post('phone'),
                    'email' => $this->input->post('email'),
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
            $data['departments'] = $this->Hospital_Model->getDepartments();
            $this->load->view('manage-doctors', $data);
        }
    }

    public function editDoctor($id)
    {
        $data['doctor'] = $this->Hospital_Model->getDoctorById($id);

        if (empty($data['doctor'])) {
            show_404();
        }

        $data['departments'] = $this->Hospital_Model->getDepartments();

        $this->load->view('manage-doctors', $data);
    }


    public function updateDoctor($id)
    {
        $data = [
            'name' => $this->input->post('name'),
            'qualification' => $this->input->post('qualification'),
            'specialization' => $this->input->post('specialization'),
            'consultation_fee' => $this->input->post('consultation_fee'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address'),
            'email' => $this->input->post('email'),
            'department_id' => $this->input->post('department_id'),
            'experience' => $this->input->post('experience'),
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
            $this->form_validation->set_rules('user_id', 'User ID', 'trim|numeric');
            $this->form_validation->set_rules('doctor_id', 'Doctor', 'trim|numeric');
            $this->form_validation->set_rules('room_id', 'Room', 'trim|numeric');
            $this->form_validation->set_rules('check_in', 'Check-in Date', 'trim|required');
            $this->form_validation->set_rules('age', 'Age', 'trim|required|numeric');
            $this->form_validation->set_rules('gender', 'Gender', 'trim|required|in_list[male,female,other]');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|regex_match[/^[0-9+\-() ]+$/]');
            $this->form_validation->set_rules('address', 'Address', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                redirect('manage-patients');
            } else {
                $patientData = [
                    'name' => $this->input->post('name'),
                    'user_id' => $this->input->post('user_id') ?: null,
                    'doctor_id' => $this->input->post('doctor_id') ?: null,
                    'room_id' => $this->input->post('room_id') ?: null,
                    'check_in' => $this->input->post('check_in'),
                    'check_out' => $this->input->post('check_out'),
                    'age' => $this->input->post('age'),
                    'gender' => $this->input->post('gender'),
                    'phone' => $this->input->post('phone'),
                    'address' => $this->input->post('address'),
                    'status' => $this->input->post('status')
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

        $data['doctors'] = $this->Hospital_Model->getActiveDoctors();
        $data['users'] = $this->db->get('users')->result();
        $data['rooms'] = $this->db->get('rooms')->result();

        $this->load->view('manage-patients', $data);
    }


    public function updatePatient($id)
    {
        $data = [
            'name' => $this->input->post('name'),
            'user_id' => $this->input->post('user_id') ?: NULL,
            'doctor_id' => $this->input->post('doctor_id'),
            'room_id' => $this->input->post('room_id') ?: NULL,
            'check_in' => $this->input->post('check_in'),
            'check_out' => $this->input->post('check_out'),
            'age' => $this->input->post('age'),
            'gender' => $this->input->post('gender'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address'),
            'status' => $this->input->post('status')
        ];

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

    // Start Staff
    public function staff()
    {
        $data['staff_details'] = $this->Hospital_Model->getStaff();
        $this->load->view('staff', $data);
    }

    public function addStaff()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->form_validation->set_rules('name', 'Staff Name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[staff.email]');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
            $this->form_validation->set_rules('role', 'Role', 'trim|required');
            $this->form_validation->set_rules('salary', 'Salary', 'trim|required|numeric');
            $this->form_validation->set_rules('address', 'Address', 'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'trim|required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                redirect('manage-staff');
            } else {
                $staffData = [
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'role' => $this->input->post('role'),
                    'salary' => $this->input->post('salary'),
                    'address' => $this->input->post('address'),
                    'status' => $this->input->post('status'),
                ];

                if ($this->Hospital_Model->insertStaff($staffData)) {
                    $this->session->set_flashdata('success', 'Staff member added successfully!');
                    redirect('staff');
                } else {
                    $this->session->set_flashdata('error', 'Failed to add staff record!');
                    redirect('manage-staff');
                }
            }
        } else {
            $this->load->view('manage-staff');
        }
    }

    public function editStaff($id)
    {
        $data['staff'] = $this->Hospital_Model->getStaffById($id);
        if (empty($data['staff'])) {
            show_404();
        }
        $this->load->view('manage-staff', $data);
    }

    public function updateStaff($id)
    {
        $data = [
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'role' => $this->input->post('role'),
            'salary' => $this->input->post('salary'),
            'address' => $this->input->post('address'),
            'status' => $this->input->post('status'),
        ];

        if ($this->Hospital_Model->updateStaff($id, $data)) {
            $this->session->set_flashdata('success', 'Staff information updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to update staff information.');
        }

        redirect('staff');
    }
    // End Staff

    // Start schedule
    public function schedule()
    {
        $data['schedules'] = $this->Hospital_Model->getSchedule();
        $this->load->view('schedule', $data);
    }

    public function addSchedule()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->form_validation->set_rules('doctor_id', 'Doctor', 'trim|numeric');
            $this->form_validation->set_rules('department_id', 'Department', 'trim|numeric');
            $this->form_validation->set_rules('start_time', 'Start Time', 'trim|required');
            $this->form_validation->set_rules('end_time', 'End Time', 'trim|required');
            $this->form_validation->set_rules('days[]', 'Days', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                redirect('manage-schedule');
            } else {
                $days = json_encode($this->input->post('days'));
                $scheduleData = [
                    'doctor_id' => $this->input->post('doctor_id'),
                    'department_id' => $this->input->post('department_id'),
                    'days' => $days,
                    'start_time' => $this->input->post('start_time'),
                    'end_time' => $this->input->post('end_time')
                ];

                if ($this->Hospital_Model->insertSchedule($scheduleData)) {
                    $this->session->set_flashdata('success', 'Schedule added successfully!');
                    redirect('schedule');
                } else {
                    $this->session->set_flashdata('error', 'Failed to add schedule record!');
                    redirect('manage-schedule');
                }
            }
        } else {
            $data['doctors'] = $this->Hospital_Model->getActiveDoctors();
            $data['departments'] = $this->Hospital_Model->getDepartments();
            $this->load->view('manage-schedule', $data);
        }
    }

    public function editSchedule($id)
    {
        $data['schedule'] = $this->Hospital_Model->getScheduleById($id);
        if (empty($data['schedule'])) {
            show_404();
        }

        $data['doctors'] = $this->Hospital_Model->getActiveDoctors();
        $data['departments'] = $this->Hospital_Model->getDepartments();
        $this->load->view('manage-schedule', $data);
    }


    public function updateSchedule($id)
    {
        $days = json_encode($this->input->post('days'));
        $data = [
            'doctor_id' => $this->input->post('doctor_id'),
            'department_id' => $this->input->post('department_id'),
            'start_time' => $this->input->post('start_time'),
            'end_time' => $this->input->post('end_time'),
            'days' => $days,
        ];

        if ($this->Hospital_Model->updateSchedule($id, $data)) {
            $this->session->set_flashdata('success', 'Schedule information updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to update Schedule information.');
        }

        redirect('schedule');
    }
    // End Schedule

    // Start Apointment
    public function appt()
    {
        $data['appointments'] = $this->Hospital_Model->getAppt();
        $data['doctor_details'] = $this->Hospital_Model->getDoctors();
        $this->load->view('appointments', $data);
    }
    public function addAppt()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->form_validation->set_rules('patient_id', 'Patient', 'required|trim|numeric');
            $this->form_validation->set_rules('doctor_id', 'Doctor', 'required|trim|numeric');
            $this->form_validation->set_rules('department_id', 'Department', 'required|trim|numeric');
            $this->form_validation->set_rules('appointment_date', 'Appointment Time', 'trim|required');
            $this->form_validation->set_rules('appointment_time', 'End Time', 'trim|required');
            $this->form_validation->set_rules('status', 'Status', 'required|trim|in_list[pending,Approved,Canceled,Completed]');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                redirect('manage-appointments');
            } else {
                $data = [
                    'patient_id' => $this->input->post('patient_id'),
                    'doctor_id' => $this->input->post('doctor_id'),
                    'department_id' => $this->input->post('department_id'),
                    'appointment_date' => $this->input->post('appointment_date'),
                    'appointment_time' => $this->input->post('appointment_time'),
                    'status' => $this->input->post('status')
                ];

                if ($this->Hospital_Model->insertAppt($data)) {
                    $this->session->set_flashdata('success', 'Appointment added successfully!');
                    redirect('appointments');
                } else {
                    $this->session->set_flashdata('error', 'Failed to add appointment record!');
                    redirect('manage-appointments');
                }
            }
        } else {
            $data['doctors'] = $this->Hospital_Model->getActiveDoctors();
            $data['patients'] = $this->Hospital_Model->getPatients();
            $data['departments'] = $this->Hospital_Model->getDepartments();
            $this->load->view('manage-appointments', $data);
        }
    }

    public function editAppt($id)
    {
        $data['appointment'] = $this->Hospital_Model->getApptById($id);
        if (empty($data['appointment'])) {
            show_404();
        }
        $data['patients'] = $this->Hospital_Model->getPatients();
        $data['doctors'] = $this->Hospital_Model->getActiveDoctors();
        $data['departments'] = $this->Hospital_Model->getDepartments();
        $this->load->view('manage-appointments', $data);
    }


    public function updateAppt($id)
    {
        $data = [
            'patient_id' => $this->input->post('patient_id'),
            'doctor_id' => $this->input->post('doctor_id'),
            'department_id' => $this->input->post('department_id'),
            'appointment_date' => $this->input->post('appointment_date'),
            'appointment_time' => $this->input->post('appointment_time'),
            'status' => $this->input->post('status'),
        ];

        if ($this->Hospital_Model->updateAppt($id, $data)) {
            $this->session->set_flashdata('success', 'Appointment information updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to update Appointment information.');
        }

        redirect('appointments');
    }
    // End Appointment
    // Start Apointment
    public function room()
    {
        $data['room_details'] = $this->Hospital_Model->getRooms();
        $data['doctors'] = $this->Hospital_Model->getActiveDoctors();
        $data['nurses'] = $this->Hospital_Model->getActiveNurses();
        $this->load->view('rooms', $data);
    }

    public function addRoom()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->form_validation->set_rules('room_number', 'Room Number', 'required|trim|numeric');
            $this->form_validation->set_rules('room_type', 'Room Type', 'required|trim');
            $this->form_validation->set_rules('doctor_id', 'Doctor', 'required|trim|numeric');
            $this->form_validation->set_rules('nurse_id', 'Nurse', 'required|trim|numeric');
            $this->form_validation->set_rules('floor_number', 'Floor Number', 'required|trim|numeric');
            $this->form_validation->set_rules('capacity', 'Capacity', 'required|trim|numeric');
            $this->form_validation->set_rules('per_day_fee', 'Per Day Fee', 'required|trim|numeric');
            $this->form_validation->set_rules('status', 'Status', 'required|trim|in_list[Available,Occupied,Under Maintenance]');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                redirect('manage-rooms');
            } else {
                $data = [
                    'room_number' => $this->input->post('room_number'),
                    'room_type' => $this->input->post('room_type'),
                    'assigned_doctor_id' => $this->input->post('doctor_id'),
                    'assigned_nurse_id' => $this->input->post('nurse_id'),
                    'floor_number' => $this->input->post('floor_number'),
                    'capacity' => $this->input->post('capacity'),
                    'per_day_fee' => $this->input->post('per_day_fee'),
                    'status' => $this->input->post('status'),
                ];

                if ($this->Hospital_Model->insertRoom($data)) {
                    $this->session->set_flashdata('success', 'Room added successfully!');
                    redirect('rooms');
                } else {
                    $this->session->set_flashdata('error', 'Failed to add room record!');
                    redirect('manage-rooms');
                }
            }
        } else {
            $data['doctors'] = $this->Hospital_Model->getActiveDoctors();
            $data['nurses'] = $this->Hospital_Model->getActiveNurses();
            $this->load->view('manage-rooms', $data);
        }
    }

    public function editRoom($id)
    {
        $data['room'] = $this->Hospital_Model->getRoomById($id);
        if (empty($data['room'])) {
            show_404();
        }
        $data['doctors'] = $this->Hospital_Model->getActiveDoctors();
        $data['nurses'] = $this->Hospital_Model->getActiveNurses();
        $this->load->view('manage-rooms', $data);
    }

    public function updateRoom($id)
    {
        $data = [
            'room_number' => $this->input->post('room_number'),
            'room_type' => $this->input->post('room_type'),
            'assigned_doctor_id' => $this->input->post('doctor_id'),
            'assigned_nurse_id' => $this->input->post('nurse_id'),
            'floor_number' => $this->input->post('floor_number'),
            'capacity' => $this->input->post('capacity'),
            'per_day_fee' => $this->input->post('per_day_fee'),
            'status' => $this->input->post('status'),
        ];

        if ($this->Hospital_Model->updateRoom($id, $data)) {
            $this->session->set_flashdata('success', 'Room information updated successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to update room information.');
        }

        redirect('rooms');
    }
    // End Rooms

    // Start Prescriptions
    public function pres()
    {
        $data['prescriptions'] = $this->Hospital_Model->getAllPres();
        $data['patients'] = $this->Hospital_Model->getPatients();
        $data['doctors'] = $this->Hospital_Model->getActiveDoctors();
        $this->load->view('prescriptions', $data);
    }

    public function addPres()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->form_validation->set_rules('patient_id', 'Patient', 'required|numeric');
            $this->form_validation->set_rules('doctor_id', 'Doctor', 'required|numeric');
            $this->form_validation->set_rules('diagnosis', 'Diagnosis', 'required|trim');
            $this->form_validation->set_rules('medications', 'Medications', 'required|trim');
            $this->form_validation->set_rules('notes', 'Notes', 'trim');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                redirect('manage-prescriptions');
            } else {
                $data = [
                    'patient_id' => $this->input->post('patient_id'),
                    'doctor_id' => $this->input->post('doctor_id'),
                    'diagnosis' => $this->input->post('diagnosis'),
                    'medications' => $this->input->post('medications'),
                    'notes' => $this->input->post('notes')
                ];

                if ($this->Hospital_Model->insertPres($data)) {
                    $this->session->set_flashdata('success', 'Prescription added successfully!');
                    redirect('prescriptions');
                } else {
                    $this->session->set_flashdata('error', 'Failed to add prescription record!');
                    redirect('manage-prescriptions');
                }
            }
        } else {
            $data['patients'] = $this->Hospital_Model->getPatients();
            $data['doctors'] = $this->Hospital_Model->getActiveDoctors();
            $this->load->view('manage-prescriptions', $data);
        }
    }

    public function editPres($id)
    {
        $data['prescription'] = $this->Hospital_Model->getPres($id);
        if (is_array($data['prescription'])) {
            $data['prescription'] = (object) $data['prescription'];
        }
        if (empty($data['prescription'])) {
            show_404();
        }
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->form_validation->set_rules('patient_id', 'Patient', 'required|numeric');
            $this->form_validation->set_rules('doctor_id', 'Doctor', 'required|numeric');
            $this->form_validation->set_rules('diagnosis', 'Diagnosis', 'required|trim');
            $this->form_validation->set_rules('medications', 'Medications', 'required|trim');
            $this->form_validation->set_rules('notes', 'Notes', 'trim');

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                redirect('manage-prescriptions/' . $id);
            } else {
                $update_data = [
                    'patient_id' => $this->input->post('patient_id'),
                    'doctor_id' => $this->input->post('doctor_id'),
                    'diagnosis' => $this->input->post('diagnosis'),
                    'medications' => $this->input->post('medications'),
                    'notes' => $this->input->post('notes')
                ];

                if ($this->Hospital_Model->updatePres($id, $update_data)) {
                    $this->session->set_flashdata('success', 'Prescription updated successfully!');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update prescription record!');
                }

                redirect('prescriptions');
            }
        }

        $data['patients'] = $this->Hospital_Model->getPatients();
        $data['doctors'] = $this->Hospital_Model->getActiveDoctors();
        $this->load->view('manage-prescriptions', $data);
    }

    public function download_pdf($id)
    {
        require_once APPPATH . 'vendor/autoload.php';
        $data['prescription'] = $this->Hospital_Model->getPres($id);
        if (empty($data['prescription'])) {
            $this->session->set_flashdata('error', 'Invalid Prescription ID.');
            redirect('prescriptions');
        }
        $html = $this->load->view('prescription-pdf', $data, true);
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output('prescription_' . $id . '.pdf', 'D');
    }
    // End Prescription

    // Start Billing
    public function bill()
    {
        $data['billing'] = $this->Hospital_Model->getAllBill();
        $data['patients'] = $this->Hospital_Model->getPatients();
        $data['doctors'] = $this->Hospital_Model->getActiveDoctors();
        $this->load->view('billing', $data);
    }

    public function addBill()
    {
        $data['patients'] = $this->Hospital_Model->getPatients();
        $data['doctors'] = $this->Hospital_Model->getActiveDoctors();

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->form_validation->set_rules('patient_id', 'Patient', 'required');
            $this->form_validation->set_rules('doctor_id', 'Doctor', 'required');
            $this->form_validation->set_rules('room_charges', 'Room Charges', 'required|numeric');
            $this->form_validation->set_rules('doctor_fee', 'Doctor Fee', 'required|numeric');
            $this->form_validation->set_rules('paid_amount', 'Paid Amount', 'required|numeric');

            if ($this->form_validation->run() === FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                $this->load->view('manage-billing', $data);
            } else {
                $insert_data = [
                    'patient_id' => $this->input->post('patient_id'),
                    'doctor_id' => $this->input->post('doctor_id'),
                    'room_charges' => $this->input->post('room_charges'),
                    'doctor_fee' => $this->input->post('doctor_fee'),
                    'paid_amount' => $this->input->post('paid_amount')
                ];

                if ($this->Hospital_Model->insertBill($insert_data)) {
                    $this->session->set_flashdata('success', 'Billing record added successfully!');
                    redirect('billing');
                } else {
                    $this->session->set_flashdata('error', 'Failed to add billing record!');
                    $this->load->view('manage-billing', $data);
                }
            }
        } else {
            $this->load->view('manage-billing', $data);
        }
    }

    public function editBill($id)
    {
        $data['billing'] = $this->Hospital_Model->getBillById($id);

        if (!$data['billing']) {
            show_404();
        }
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->form_validation->set_rules('room_charges', 'Room Charges', 'required|numeric');
            $this->form_validation->set_rules('doctor_fee', 'Doctor Fee', 'required|numeric');
            $this->form_validation->set_rules('paid_amount', 'Paid Amount', 'required|numeric');

            if ($this->form_validation->run() === FALSE) {
                $this->session->set_flashdata('error', validation_errors());
                $this->load->view('manage-billing', $data);
            } else {
                $update_data = [
                    'room_charges' => $this->input->post('room_charges'),
                    'doctor_fee' => $this->input->post('doctor_fee'),
                    'paid_amount' => $this->input->post('paid_amount')
                ];

                if ($this->Hospital_Model->updateBill($id, $update_data)) {
                    $this->session->set_flashdata('success', 'Billing record updated successfully!');
                    redirect('billing');
                } else {
                    $this->session->set_flashdata('error', 'Failed to update billing record!');
                    $this->load->view('manage-billing', $data);
                }
            }
        } else {
            $this->load->view('manage-billing', $data);
        }
    }

    public function generateBillingPdf($id)
    {
        require_once APPPATH . 'vendor/autoload.php';
        $this->load->model('Hospital_Model');

        $data['billing'] = $this->Hospital_Model->getBillById($id);
        if (empty($data['billing'])) {
            $this->session->set_flashdata('error', 'Invalid Billing ID.');
            redirect('billing');
        }

        $html = $this->load->view('billing_pdf', $data, true);
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output('billing_' . $id . '.pdf', 'D');
    }
    // End Billing

    // Start Users
    public function users()
    {
        $data['users'] = $this->Hospital_Model->getUsers();
        $this->load->view('users', $data);
    }
    // End Users

    // Start Contacts
    public function contacts()
    {
        $data['contacts'] = $this->Hospital_Model->getContacts();
        $this->load->view('contacts', $data);
    }
    // End Users

}

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
        $this->load->library('form_validation');
       
    }

   

    public function register()
{
    $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[20]');
    $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');

    if ($this->form_validation->run() == FALSE) {
        $this->load->view('users-panel/register');
    } else {
        $userData = array(
            'name' => $this->input->post('name'),
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
                'name' => $user->name,
                'email' => $user->email,
                'user_logged_in' => TRUE
            ];
            $this->session->set_userdata($user_data);

            $this->session->set_flashdata('success', 'Login successful! Welcome, ' . $user->name);
            redirect('users/index');
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
    $this->load->model('Users_Model');
    $data['departments'] = $this->Users_Model->getDepartments(); 

     

    $this->load->view('users-panel/appointments', $data);// Show appointment page if logged in
}
public function get_doctors()
{
    $department_id = $this->input->post('department_id');
    $this->load->model('Users_Model');
    $doctors = $this->Users_Model->get_doctors_by_department($department_id);
    
    echo json_encode($doctors);
}

public function get_doctor_schedule()
{
    $doctor_id = $this->input->post('doctor_id');
    $this->load->model('Users_Model');
    $schedule = $this->Users_Model->get_doctor_schedule($doctor_id);

    echo json_encode($schedule);
}
public function get_time_slots()
{
    $doctor_id = $this->input->post('doctor_id');
    $selected_day = $this->input->post('day');

    $this->load->model('Users_Model');
    $time_slots = $this->Users_Model->get_time_slots($doctor_id, $selected_day);

    echo json_encode($time_slots);
}


    public function index()
   {
    //for header count
    $data['total_doctors'] = $this->Users_Model->count_doctors();
    $data['total_staff'] = $this->Users_Model->count_staff();
    $data['total_patients'] = $this->Users_Model->count_patients();
    //end header counter
    $data['departments'] = $this->Users_Model->getDepartments();  
    $data['doctors'] = $this->Users_Model->getAllDoctors(); 
        $this->load->view('users-panel/index',$data);
    }
    public function about()
   {
        $this->load->view('users-panel/about');
    }
    public function services() {
        $data['departments'] = $this->Users_Model->getDepartments();  
        $this->load->view('users-panel/services', $data);
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
//contact form
    public function submit_form()
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[50]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('subject', 'Subject', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('message', 'Message', 'trim|required|min_length[5]');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            $this->load->view('users-panel/Contacts');
        } else {
            $contactData = array(
                'name'    => $this->input->post('name'),
                'email'   => $this->input->post('email'),
                'subject' => $this->input->post('subject'),
                'message' => $this->input->post('message')
            );

            if ($this->Users_Model->insert_contact($contactData)) {
                $this->session->set_flashdata('success', 'Your query has been sent successfully.');
            } else {
                $this->session->set_flashdata('error', 'Something went wrong. Please try again.');
            }
            redirect('users/contacts');
        }
    }

    public function ourDoctor()
   {

    $data['doctors'] = $this->Users_Model->getAllDoctors(); 
        $this->load->view('users-panel/ourDoctor', $data);
    }
 
    public function book_appointment()
    {
        $this->load->model('Users_Model');
    
        $user_id = $this->session->userdata('user_id');
        $name = $this->input->post('name');
        $age = $this->input->post('age');
        $gender = $this->input->post('gender');
        $phone = $this->input->post('phone');
        $address = $this->input->post('address');
    
        $department_id = $this->input->post('department_id');
        $doctor_id = $this->input->post('doctor_id');
        $appointment_date = $this->input->post('appointment_date');
        $appointment_time = $this->input->post('appointment_time');
    
        // Check if patient already exists
        $patient = $this->Users_Model->get_patient_by_phone($phone);
        
        if ($patient) {
            // If patient exists, get their ID
            $patient_id = $patient->id;
        } else {
            // If new patient, insert into patients table
            $patient_data = [
                'name' => $name,
                'user_id' => $user_id,
                'doctor_id' => $doctor_id,
                'age' => $age,
                'gender' => $gender,
                'phone' => $phone,
                'address' => $address,
                'status' => 'Active',
                'created_at' => date('Y-m-d H:i:s')
            ];
            $patient_id = $this->Users_Model->insert_patient($patient_data);
        }
    
        // Insert appointment record
        $appointment_data = [
            'patient_id' => $patient_id,
            'doctor_id' => $doctor_id,
            'department_id' => $department_id,
            'appointment_date' => $appointment_date,
            'appointment_time' => $appointment_time,
            'status' => 'Pending',
            'created_at' => date('Y-m-d H:i:s')
        ];
        $appointment_id = $this->Users_Model->insert_appointment($appointment_data);
    
        if ($appointment_id) {
            $this->session->set_flashdata('success', 'Appointment booked successfully.');
        } else {
            $this->session->set_flashdata('error', 'Failed to book appointment.');
        }
    
        redirect('users/appointments'); // Redirect to appointment form
    }
  
    public function getAvailableDays($doctor_id) {
        $this->load->model('Users_model');
        $available_days = $this->Users_model->get_doctor_available_days($doctor_id);
        echo json_encode($available_days);
    }
    
    public function getNextDate($selected_day) {
        $this->load->model('Users_model');
        $next_date = $this->Users_model->calculate_next_date(ucfirst($selected_day));
    
        header('Content-Type: application/json');
        
        if ($next_date) {
            echo json_encode(['next_date' => $next_date]);
        } else {
            echo json_encode(['error' => 'Could not calculate date']);
        }
    }
    
    
    

      // Fetch user appointment history
      public function appointment_history() {
        $user_id = $this->session->userdata('user_id');
    $data['appointments'] = $this->Users_Model->get_appointment_by_id($user_id);

    $this->load->view('users-panel/appointment_history', $data);
    }
    
   
    public function deleteAppointment($appointment_id)
{
    // Fetch appointment details
    $appointment = $this->Users_Model->getAppointmentById($appointment_id);

    if ($appointment && strtolower($appointment['status']) == 'pending') {
        // Delete the appointment if status is pending
        $this->Users_Model->deleteAppointment($appointment_id);
        $this->session->set_flashdata('success', 'Appointment deleted successfully.');
    } else {
        $this->session->set_flashdata('error', 'You can only delete pending appointments.');
    }

    redirect('users/appointment_history'); // Redirect back to appointment history page
}

 
}
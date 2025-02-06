<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hospital extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Hospital_Model');
    }
    public function register()
    {
        $this->load->view('register');
    }
    public function login()
    {
        $this->load->view('login');
    }
    public function dashboard()
    {
        $this->load->view('index');
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

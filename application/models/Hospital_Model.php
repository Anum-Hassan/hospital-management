<?php
class Hospital_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insert_admin($data)
    {
        return $this->db->insert('admins', $data);
    }

    public function check_admin_login($email, $password)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('admins');

        if ($query->num_rows() == 1) {
            $admin = $query->row();

            if (password_verify($password, $admin->password)) {
                return $admin;
            }
        }
        return false;
    }


    // Delete Record for all modules
    public function deleteRecord($table, $id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($table);
    }

    // Start toggle status for all Modules 
    public function get_current_status($table, $id)
    {
        $this->db->select('status');
        $this->db->from($table);
        $this->db->where('id', $id);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->status;
        }
        return null;
    }

    public function update_status($table, $id, $new_status)
    {
        $this->db->where('id', $id);
        $this->db->update($table, ['status' => $new_status]);
    }
    // End Toggle Status

    public function getActiveDoctors()
    {
        return $this->db->get_where('doctors', ['status' => 1])->result();
    }

    public function getPatientCounts()
    {
        return [
            'admitted' => $this->db->where('status', 'admitted')->count_all_results('patients'),
            'discharged' => $this->db->where('status', 'discharged')->count_all_results('patients'),
            'outpatients' => $this->db->where('status', 'outpatient')->count_all_results('patients'),
        ];
    }

    public function get_rooms()
    {
        return $this->db->get('rooms')->result();
    }

    public function getPendingAppts()
    {
        return $this->db->where('status', 'pending')->get('appointments')->result();
    }
    public function getApprovedAppts()
    {
        return $this->db->where('status', 'approved')->get('appointments')->result();
    }
    public function getCompletedAppts()
    {
        return $this->db->where('status', 'completed')->get('appointments')->result();
    }
    public function getCanceledAppts()
    {
        return $this->db->where('status', 'canceled')->get('appointments')->result();
    }

    public function getTotalProfit()
    {
        return $this->db->select_sum('paid_amount')->get('billing')->row()->paid_amount;
    }

    public function getPendingAmount()
    {
        return $this->db->select_sum('pending_amount')->get('billing')->row()->pending_amount;
    }

    // Start Doctor
    public function getDoctors()
    {
        $this->db->select('doctors.*, departments.name as department_name');
        $this->db->from('doctors');
        $this->db->join('departments', 'doctors.department_id = departments.id', 'left');
        return $this->db->get()->result();
    }

    public function getDepartments()
    {
        return $this->db->where('status', 1)->get('departments')->result();
    }

    public function insertDoctor($data)
    {
        $query = $this->db->insert('doctors', $data);
        if (!$query) {
            log_message('error', $this->db->last_query());
            log_message('error', $this->db->error());
            return false;
        }
        return true;
    }

    public function getDoctorById($id)
    {
        $query = $this->db->get_where('doctors', ['id' => $id]);
        return $query->row();
    }

    public function updateDoctor($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('doctors', $data);
    }
    // End Doctor

    // Start Department
    public function getDeparts()
    {
        $query = $this->db->get('departments');
        if (!$query) {
            log_message('error', 'Database error: ' . $this->db->error()['message']);
            return [];
        }
        return $query->result();
    }

    public function insertDepart($data)
    {
        $query = $this->db->insert('departments', $data);
        if (!$query) {
            log_message('error', $this->db->last_query());
            log_message('error', $this->db->error());
            return false;
        }
        return true;
    }
    public function getDepartById($id)
    {
        $query = $this->db->get_where('departments', ['id' => $id]);
        return $query->row();
    }

    public function updateDepart($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('departments', $data);
    }
    // End Department

    // Start Patient
    public function getPatients()
    {
        $this->db->select('patients.*, doctors.name as doctor_name, rooms.room_number as room_number, users.name as user_name');
        $this->db->from('patients');
        $this->db->join('doctors', 'patients.doctor_id = doctors.id', 'left');
        $this->db->join('rooms', 'patients.room_id = rooms.id', 'left');
        $this->db->join('users', 'patients.user_id = users.id', 'left');
        return $this->db->get()->result();
    }

    public function insertPatient($data)
    {
        return $this->db->insert('patients', $data);
    }

    public function getPatientById($id)
    {
        return $this->db->get_where('patients', ['id' => $id])->row();
    }

    public function updatePatient($id, $data)
    {
        // print_r($_POST);
        // exit;
        $this->db->where('id', $id);
        return $this->db->update('patients', $data);
    }
    // End Patient

    // Start Patient History
    public function getPatientMedicalHistory($patient_id)
    {
        $this->db->select('*');
        $this->db->from('patient_medical_history');
        $this->db->where('patient_id', $patient_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function insertPatientHistory($data)
    {
        return $this->db->insert('patient_medical_history', $data);
    }

    public function deletePatientHistory($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('patient_medical_history');
    }
    // End Patient History

    // Start Staff
    public function getStaff()
    {
        $query = $this->db->get('staff');
        if (!$query) {
            log_message('error', 'Database error: ' . $this->db->error()['message']);
            return [];
        }
        return $query->result();
    }

    public function insertStaff($data)
    {
        $query = $this->db->insert('staff', $data);
        if (!$query) {
            log_message('error', $this->db->last_query());
            log_message('error', $this->db->error());
            return false;
        }
        return true;
    }

    public function getStaffById($id)
    {
        $query = $this->db->get_where('staff', ['id' => $id]);
        return $query->row();
    }

    public function updateStaff($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('staff', $data);
    }
    // End Staff

    // Start Patient
    public function getSchedule()
    {
        $this->db->select('schedule.*, doctors.name as doctor_name, departments.name as department_name');
        $this->db->from('schedule');
        $this->db->join('doctors', 'schedule.doctor_id = doctors.id', 'left');
        $this->db->join('departments', 'schedule.department_id = departments.id', 'left');
        return $this->db->get()->result();
    }

    public function insertSchedule($data)
    {
        return $this->db->insert('schedule', $data);
    }

    public function getScheduleById($id)
    {
        return $this->db->get_where('schedule', ['id' => $id])->row();
    }

    public function updateSchedule($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('schedule', $data);
    }
    // End Schedule

    // Start Appointment
    public function getAppt()
    {
        $this->db->select('appointments.*, patients.name AS patient_name, doctors.name AS doctor_name, departments.name AS department_name');
        $this->db->from('appointments');
        $this->db->join('patients', 'appointments.patient_id = patients.id', 'left');
        $this->db->join('doctors', 'appointments.doctor_id = doctors.id', 'left');
        $this->db->join('departments', 'appointments.department_id = departments.id', 'left');
        return $this->db->get()->result();
    }
    public function insertAppt($data)
    {
        return $this->db->insert('appointments', $data);
    }
    public function getApptById($id)
    {
        return $this->db->get_where('appointments', ['id' => $id])->row();
    }

    public function updateAppt($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('appointments', $data);
    }
    // End Appointment

    // Start Rooms
    public function getRooms()
    {
        $this->db->select('rooms.*, doctors.name AS doctor_name, staff.name AS nurse_name');
        $this->db->from('rooms');
        $this->db->join('doctors', 'rooms.assigned_doctor_id = doctors.id', 'left');
        $this->db->join('staff', 'rooms.assigned_nurse_id = staff.id AND staff.role = "nurse"', 'left');
        return $this->db->get()->result();
    }

    public function insertRoom($data)
    {
        return $this->db->insert('rooms', $data);
    }

    public function getRoomById($id)
    {
        $this->db->select('rooms.*, doctors.name AS doctor_name, staff.name AS nurse_name');
        $this->db->from('rooms');
        $this->db->join('doctors', 'rooms.assigned_doctor_id = doctors.id', 'left');
        $this->db->join('staff', 'rooms.assigned_nurse_id = staff.id AND staff.role = "nurse"', 'left');
        $this->db->where('rooms.id', $id);
        return $this->db->get()->row();
    }

    public function updateRoom($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('rooms', $data);
    }

    public function getActiveNurses()
    {
        return $this->db->get_where('staff', ['status' => 'active', 'role' => 'nurse'])->result();
    }
    // End Rooms

    // Start Prescriptions
    public function getAllPres()
    {
        $this->db->select('
            prescriptions.*, patients.name AS patient_name, doctors.name AS doctor_name
        ');
        $this->db->from('prescriptions');
        $this->db->join('patients', 'patients.id = prescriptions.patient_id', 'left');
        $this->db->join('doctors', 'doctors.id = prescriptions.doctor_id', 'left');

        return $this->db->get()->result_array();
    }


    public function insertPres($data)
    {
        return $this->db->insert('prescriptions', $data);
    }

    public function getPres($id)
    {
        $this->db->select('
            prescriptions.*, 
            patients.name AS patient_name, 
            doctors.name AS doctor_name
        ');
        $this->db->from('prescriptions');
        $this->db->join('patients', 'patients.id = prescriptions.patient_id', 'left');
        $this->db->join('doctors', 'doctors.id = prescriptions.doctor_id', 'left');
        $this->db->where('prescriptions.id', $id);
        return $this->db->get()->row_array();
    }


    public function updatePres($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('prescriptions', $data);
    }
    // End Prescriptions

    // Start Billing
    public function getAllBill()
    {
        $this->db->select('billing.*, patients.name AS patient_name, doctors.name AS doctor_name');
        $this->db->from('billing');
        $this->db->join('patients', 'billing.patient_id = patients.id', 'left');
        $this->db->join('doctors', 'billing.doctor_id = doctors.id', 'left');
        return $this->db->get()->result();
    }

    public function insertBill($data)
    {
        return $this->db->insert('billing', $data);
    }

    public function getBillById($id)
    {
        $this->db->select('billing.*, patients.name AS patient_name, doctors.name AS doctor_name');
        $this->db->from('billing');
        $this->db->join('patients', 'billing.patient_id = patients.id', 'left');
        $this->db->join('doctors', 'billing.doctor_id = doctors.id', 'left');
        $this->db->where('billing.id', $id);
        return $this->db->get()->row();
    }

    public function updateBill($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('billing', $data);
    }
    // End Billing

    // Start Users
    public function getUsers()
    {
        $query = $this->db->get('users');
        if (!$query) {
            log_message('error', 'Database error: ' . $this->db->error()['message']);
            return [];
        }
        return $query->result();
    }
    // End Users

    // Start Contacts
    public function getContacts()
    {
        $query = $this->db->get('contacts');
        if (!$query) {
            log_message('error', 'Database error: ' . $this->db->error()['message']);
            return [];
        }
        return $query->result();
    }
    // End Contacts

}

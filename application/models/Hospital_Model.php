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

    public function check_admin_login($username, $password)
    {
        $this->db->where('username', $username);
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

    public function getActiveDoctors()
    {
        return $this->db->get_where('doctors', ['status' => 1])->result();
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
}

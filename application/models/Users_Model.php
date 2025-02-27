<?php
class Users_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function insert_admin($data)
    {
        return $this->db->insert('users', $data);
    }
    public function get_user_by_email($email)
    {
        return $this->db->where('email', $email)->get('users')->row();
    }
    public function getAllDoctors()
{
    $this->db->select('doctors.id, doctors.name AS doctor_name, doctors.image, doctors.specialization, doctors.qualification, doctors.experience, doctors.consultation_fee, doctors.phone, doctors.email, doctors.address, departments.name AS department_name');
    $this->db->from('doctors');
    $this->db->join('departments', 'departments.id = doctors.department_id', 'left');
    $query = $this->db->get();
    return $query->result_array();
}
public function getDepartments() {
    $this->db->select('*');
    $this->db->from('departments');
    $this->db->where('status', 1); // Active departments fetch karne ke liye
    return $this->db->get()->result_array(); 
}
public function get_doctors_by_department($department_id)
{
    $this->db->select('id, name');
    $this->db->from('doctors');
    $this->db->where('department_id', $department_id);
    $this->db->where('status', 1);
    $query = $this->db->get();
    return $query->result_array();
}
public function get_doctor_schedule($doctor_id)
{
    $this->db->select('days, start_time, end_time');
    $this->db->from('schedule');
    $this->db->where('doctor_id', $doctor_id);
    $this->db->where('status', 1);
    $query = $this->db->get();
    $result = $query->row_array();

    if (!empty($result)) {
        // Convert JSON days to an array
        $result['days'] = json_decode($result['days'], true);
    }

    return $result;
}

public function get_time_slots($doctor_id, $selected_day)
{
    $this->db->select('start_time, end_time');
    $this->db->from('schedule');
    $this->db->where('doctor_id', $doctor_id);
    $this->db->where('JSON_CONTAINS(days, \'["' . $selected_day . '"]\')'); // Check if the day exists in JSON
    $this->db->where('status', 1);
    $query = $this->db->get();
    
    return $query->row_array();
}


public function insert_contact($data)
{
    return $this->db->insert('contacts', $data);
}
// for header counter
public function count_doctors()
{
    return $this->db->count_all('doctors'); // Doctors ki total count
}

public function count_staff()
{
    return $this->db->count_all('staff'); // Staff ki total count
}

public function count_patients()
{
    return $this->db->count_all('patients'); // Patients ki total count
}

 // Check if patient exists based on phone number
 public function get_patient_by_phone($phone) {
    return $this->db->get_where('patients', ['phone' => $phone])->row();
}

// Insert new patient
public function insert_patient($data) {
    $this->db->insert('patients', $data);
    return $this->db->insert_id(); // Return inserted patient ID
}

// Insert appointment
public function insert_appointment($data) {
    $this->db->insert('appointments', $data);
    return $this->db->insert_id(); // Return inserted appointment ID
}

public function get_user_appointments($user_id) {
    $this->db->select('
        appointments.id as appointment_id, 
        IFNULL(appointments.appointment_date, CURRENT_DATE()) as appointment_date, 
        appointments.status, 
        doctors.name as doctor_name, 
        departments.name as department_name
    ');
    $this->db->from('appointments');
    $this->db->join('doctors', 'appointments.doctor_id = doctors.id');
    $this->db->join('departments', 'appointments.department_id = departments.id');
    $this->db->join('patients', 'appointments.patient_id = patients.id');
    $this->db->where('patients.user_id', $user_id);
    $query = $this->db->get();
    return $query->result_array();
}
 
public function get_doctor_available_days($doctor_id) {
    $this->db->select('days');
    $this->db->where('doctor_id', $doctor_id);
    $query = $this->db->get('schedule');  

    if ($query->num_rows() > 0) {
        $row = $query->row();
        return explode(',', $row->days); // Assuming days are stored as "Monday,Wednesday,Friday"
    }
    return [];
}

public function calculate_next_date($selected_day) {
    $dayMap = [
        'Sunday'    => 0,
        'Monday'    => 1,
        'Tuesday'   => 2,
        'Wednesday' => 3,
        'Thursday'  => 4,
        'Friday'    => 5,
        'Saturday'  => 6
    ];

    if (!isset($dayMap[$selected_day])) {
        error_log("Invalid Day Selected: " . $selected_day);
        return null; // Invalid day
    }

    $currentDayIndex = date('w'); // Current day index (0 = Sunday, 6 = Saturday)
    $selectedDayIndex = $dayMap[$selected_day];

    if ($selectedDayIndex >= $currentDayIndex) {
        $daysToAdd = $selectedDayIndex - $currentDayIndex;
    } else {
        $daysToAdd = 7 - ($currentDayIndex - $selectedDayIndex);
    }

    $nextDate = date('Y-m-d', strtotime("+$daysToAdd days"));

    // Debugging Log
    error_log("Selected Day: $selected_day | Next Date: $nextDate");

    return $nextDate;
}





public function get_appointment_by_id( $user_id) {
    $this->db->select('
        appointments.id as appointment_id, 
        appointments.appointment_date, 
        appointments.status, 
        doctors.name as doctor_name, 
        departments.name as department_name, 
        patients.name as patient_name
    ');
    $this->db->from('appointments');
    $this->db->join('patients', 'appointments.patient_id = patients.id', 'left'); // Ensure patient data is included
    $this->db->join('doctors', 'appointments.doctor_id = doctors.id', 'left');
    $this->db->join('departments', 'doctors.department_id = departments.id', 'left');
    $this->db->where('patients.user_id', $user_id); // Only fetch logged-in user’s data

    $query = $this->db->get();
    return $query->result_array(); // Return results as an array
}

public function getAppointmentById($appointment_id)
{
    return $this->db->get_where('appointments', ['id' => $appointment_id])->row_array();
}

public function deleteAppointment($appointment_id)
{
    $this->db->where('id', $appointment_id);
    return $this->db->delete('appointments');
}


}



<?php
class Hospital_Model extends CI_Model
{
    public function __construct() {
        parent::__construct();
    }

    public function insert_admin($data) {
        return $this->db->insert('admins', $data);
    }
    public function check_admin_login($username, $password) {
        // **Database me username check kare**
        $this->db->where('username', $username);
        $query = $this->db->get('admins'); // Your admins table

        if ($query->num_rows() == 1) {
            $admin = $query->row(); // Admin ka data fetch kare

            // **Step 1: Hashed Password Check kare**
            if (password_verify($password, $admin->password)) {
                return $admin; // **Agar password match kare to admin ka data return kare**
            }
        }
        return false; // **Agar password match nahi kare to false return kare**
    }

    public function getDoctors() {
        $query = $this->db->get('doctors');
        if (!$query) {
            log_message('error', 'Database error: ' . $this->db->error()['message']);
            return [];
        }
        return $query->result();
    }
    
    public function insertDoctor($data)
    {
        $query = $this->db->insert('doctors', $data);
        if($query){
            return true;
        }else{
            return false;
        }
    }
}
?>
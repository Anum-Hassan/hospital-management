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

    public function getDoctors()
    {
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


    public function deleteDoctor($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('doctors');
    }
}

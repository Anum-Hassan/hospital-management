<?php
class Users_Model extends CI_Model
{
 public function __construct()
    {
        parent::__construct();
    }

    public function insert_admin($data)
    {
        return $this->db->insert('admins', $data);
    }
    public function get_user_by_email($email)
    {
        return $this->db->where('email', $email)->get('users')->row();
    }
    

}
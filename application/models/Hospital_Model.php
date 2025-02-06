<?php
class Hospital_Model extends CI_Model
{
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
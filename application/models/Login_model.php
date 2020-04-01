<?php
class Login_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function auth($data) {
        $query = $this->db->get_where('user', $data);
        if ($query) {
            return $query->row_array();
        }
        return false;
    }

    public function save($data) {
        $this->db->db_debug = FALSE;
        $error = NULL;
        if (!$this->db->insert('user', $data)) {
            $error = $this->db->error();
        }
        return $error;
    }
    
    public function check_exist($field, $variable){
        if($variable){
           $this->db->where($field, $variable); 
           $query = $this->db->get('user');
           if($query->num_rows()>0){
               return true;
           }
        }
        return false;
    }
}

?>
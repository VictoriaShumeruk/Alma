<?php
class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    
    
    public function auth($data) {
        $sql ="SELECT * FROM user WHERE id='".$data['id']."'";
        $query=$this->db->query($sql);
        if ($query) {
            $query = $query->row_array();
//            if (password_verify($data['password'], $query['password'])){
                return $query;
            }
//        }
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
    
    public function get_users(){
        $sql ="SELECT * FROM user";
        $result=$this->db->query($sql);
        return $result->result_array();
    }
        
    function get_user_by_id($data){
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('id', $data);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    
      public function user_form_input(){
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        $data = array(
            'fullname' => $this->input->post('fullname'),
            'id' => $this->input->post('id'),
            'role' => $this->input->post('role'),
            'job' => $this->input->post('job'),
            'phone' => $this->input->post('phone'),
            'email' => $this->input->post('email'),
            'bank_account' => $this->input->post('bank_account'),
            'birth_date' => $this->input->post('birth_date'),
            'password' => $password,
        );   
        return $data;
    }
    
     function update_user($id){
        $data = $this->user_form_input();
        $this->db->where('id', $id);
        $this->db->update('user', $data);
    }
    
    public function delete_user($id){   
        $this->db->where('id', $id);
        $this->db->delete('user');
    }
}

?>
<?php
    class Hosting_model extends CI_Model{
        public function __construct() {
            parent::__construct();
            $this->load->database();
        }   

        public function get_tables($date){
            $this->db->join('clients','tables.phonenumber = clients.phonenumber', 'left');
            $this->db->where('re_date',$date);
            $this->db->order_by('re_time', 'ASC');  
            $query=$this->db->get('tables');

        return $query->result_array();
        }
        
        public function form_insert($data, $dataclient){
            $this->db->db_debug = FALSE;
             $error = NULL;
             $this->db->insert('clients', $dataclient);
             $this->db->insert('tables', $data);

             return $error;
        }
       
        public function get_res_by_id($data){
            $this->db->select('*');
            $this->db->from('tables');
            $this->db->where('id', $data);
            $this->db->join('clients', 'clients.phonenumber = tables.phonenumber', 'left');
            $query = $this->db->get();
            $result = $query->row_array();
            return $result;
        }
      
        
        public function update_res($id, $phone){
              $newDate = date("Y-m-d",strtotime($this->input->post('re_date')));
        $newTime = date("H:i", strtotime($this->input->post('re_time')));
        $data = array(
            'num' => $this->input->post('num'),
            'location' => $this->input->post('location'),
            'diners' => $this->input->post('diners'),
            're_date' => $newDate,
            're_time' => $newTime,
            'phonenumber' => $this->input->post('phonenumber'),

        ); 
        $dataclient = array(
            'phonenumber' => $this->input->post('phonenumber'),
            'fullname' => $this->input->post('fullname'), 


        );
            $this->db->where('phonenumber', $phone);
            $this->db->update('clients', $dataclient);
            $this->db->where('id', $id);
            $this->db->update('tables', $data);
        }
        public function delete_reservation($id){   

           $this->db->where('id', $id);
           return $this->db->delete('tables');

        }
        
}
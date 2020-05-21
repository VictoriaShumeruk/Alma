<?php
    class Hosting_model extends CI_Model{
        public function __construct() {
          parent::__construct();
          $this->load->database();
        }   

        public function get_tables($date){
//            $this->db->join('clients','tables.phonenumber = clients.phonenumber', 'left');
            $this->db->where('re_date',$date);
            $this->db->order_by('re_time', 'ASC');  
            $query=$this->db->get('tables');

        return $query->result_array();
        }
        
        public function form_insert($data){
            $this->db->db_debug = FALSE;
             $error = NULL;
             if (!( $this->db->insert('tables', $data)))  {
                 $error = $this->db->error();
             }
             return $error;
        }
       
        public function get_res_by_id($data){
            $this->db->select('*');
            $this->db->from('tables');
//             $this->db->join('clients', 'clients.phonenumber = tables.phonenumber', 'left');
            $this->db->where('id', $data);
            $query = $this->db->get();
            $result = $query->row_array();
            return $result;
        }
        public function res_form_input(){

            $newDate = date("Y-m-d",strtotime($this->input->post('re_date')));
            $newTime = date("H:i", strtotime($this->input->post('re_time')));
            $data = array(
                'id'=> $this->input->post('id'),
                'num' => $this->input->post('num'),
                'location' => $this->input->post('location'),
                'diners' => $this->input->post('diners'),
                're_date' => $newDate,
                're_time' => $newTime,
                'phonenumber' => $this->input->post('phonenumber'),
                'fullname' => $this->input->post('fullname'),  
                
            );
//        return array($data, $dataclient);
            return $data;
        }
        public function update_res($id){
              $newDate = date("Y-m-d",strtotime($this->input->post('re_date')));
        $newTime = date("H:i", strtotime($this->input->post('re_time')));
        $data = array(
            'num' => $this->input->post('num'),
            'location' => $this->input->post('location'),
            'diners' => $this->input->post('diners'),
            're_date' => $newDate,
            're_time' => $newTime,
            'phonenumber' => $this->input->post('phonenumber'),
            'fullname' => $this->input->post('fullname'),  

        );
//           $data = $this->res_form_input();
//           $this->db->set('$data');
            $this->db->where('id', $id);
            $query = $this->db->update('tables', $data);
            
            


        }
        public function update_client($data) {
            $this->db->set($data);
           
        }
        
}
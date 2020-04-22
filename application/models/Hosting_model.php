<?php
    class Hosting_model extends CI_Model{
      public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('form');
        $this->load->library('form_validation'); 
        $this->load->helper(array('form', 'url'));

      }   
        public function get_tables(){
            $this->db->join('clients','tables.phonenumber = clients.phonenumber', 'left');
            $this->db->where('re_date =','DATE(CURDATE())',FALSE);
            $this->db->order_by('re_time', 'ASC');  
            $query=$this->db->get('tables');

        return $query->result_array();
        }
        
        public function form_insert($data, $dataclient){
      
            $this->db->insert('tables', $data); 
            $this->db->insert('clients', $dataclient);
            
	
        }
          
    }
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
             if (!( ($this->db->insert('tables', $data)) && ($this->db->insert('clients', $dataclient)))) {
                 $error = $this->db->error();
             }
             return $error;
        }
       
        public function get_calendar(){
            require_once __DIR__.'/vendor/autoload.php';
            $client = new Google_Client();
            $client->setApplicationName("Alma");
            $client->setAuthConfig('client_secret.json');
            $client->setAccessType('offline');
            $client->setPrompt('select_account consent');
        }
}
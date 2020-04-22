<?php
class Shifts_model extends CI_Model{
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function saveShifts($data) {    
        $this->db->db_debug = FALSE;
        $error = NULL;
        if (!$this->db->insert_batch('shifts', $data)) {
            $error = $this->db->error();
        }
        return $error; 
    }
    
    public function saveFinalShifts($dataMorning,$dataEvening) {
       
        $this->db->insert('final_shifts', $dataMorning);
        $this->db->insert('final_shifts', $dataEvening);        
    }
                
              
          
//    
//    public function viewShifts_morning(){
//        $this->db->select('final_shifts.sunday');
//        $this->db->from('final_shifts');
//        $this->db->where('time=','בוקר');
//        $query = $this->db->get();
//
//        return $query->result_array();
//    }
//    
//     public function viewShifts_evening(){
//        $this->db->select('final_shifts.sunday');
//        $this->db->from('final_shifts');
//        $this->db->where('time=','ערב');
//         $query = $this->db->get();
//
//        return $query->result_array();
//    }
//   
    public function get_Shifts($day,$time){
        $this->db->select('user.fullname');
        $this->db->from('shifts');
        $this->db->join('user', 'shifts.user_id = user.id', 'left');
        $this->db->where('day=', $day);
        $this->db->where('time=',$time);
        //$this->db->or_where('time=', $double);
        $query = $this->db->get();

        return $query->result_array();
    }
//    
//    public function get_Shifts_morning1($time){
//        $this->db->select('user.fullname');
//        $this->db->from('shifts');
//        $this->db->join('user', 'shifts.user_id = user.id', 'left');
//        $this->db->where_in('thursday',$time);
////        $this->db->or_where('sunday = ','כפולה');
//        $query = $this->db->get();
//
//        return $query->result_array();
//    }
//    
 
//    public function get_Shifts_evening(){
//        $this->db->select('user.fullname');
//        $this->db->from('shifts');
//        $this->db->join('user', 'shifts.user_id = user.id', 'left');
//        $this->db->where('sunday =', 'ערב');
//        $this->db->or_where('sunday=','כפולה');
//        $query = $this->db->get();
//
//        return $query->result_array();
//    }   
}
?>
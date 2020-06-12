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
    
    public function get_workers(){
        $sql ="SELECT * FROM user";
        $result=$this->db->query($sql);
        return $result->result_array();
    }
    
    public function get_worker(){
        $sql ="SELECT DISTINCT user_id FROM shifts WHERE user_id";
        $result=$this->db->query($sql);
        return $result->result_array();
    }
    
    public function get_ex_date(){
        $sql ="SELECT DISTINCT date FROM final_shifts WHERE date";
        $result=$this->db->query($sql);
        return $result->result_array();
    }

    public function saveFinalShifts($data) {
        $this->db->db_debug = FALSE;
        $error = NULL;
        foreach(array_chunk($data, 5) as $chunk){
            if(!$this->db->insert_batch('final_shifts', $chunk));
            $error = $this->db->error();
        }
        return $error; 
    }
        
    public function getStartDate($newDate) {
        $dto = new DateTime();
        $year= substr($newDate, 0, 4);
        $week = substr($newDate, 6);
        $dto->setISODate($year, $week);
        $monday = $dto->format('Y-m-d');
        $dto->modify('-1 days');
        $sunday = $dto->format('Y-m-d');

        return $sunday;          
    }
    
    public function  getWeekDate($current_week){
            $dto = new DateTime();
            $year= substr($current_week, 0, 4);
            $week = substr($current_week, 5);
            $dto->setISODate($year, $week);
            $monday = $dto->format('Y-m-d');
            $dto->modify('-1 days');
            $date = $dto->format('Y-m-d');
            
            return $date;
    }
         
    public function view_Shifts($day,$time,$date){
        $this->db->select('worker_name');
        $this->db->select('user.job');
        $this->db->from('final_shifts');
        $this->db->join('user', 'final_shifts.worker_name = user.fullname', 'left');
        $this->db->where('day=', $day);
        $this->db->where('time=',$time);
        $this->db->where('date=',$date);
        $this->db->order_by('date');
        $query = $this->db->get();

        return $query->result_array();
    }
    
    public function get_both(){
        $this->db->select('user.fullname');
        $this->db->from('shifts');
        $this->db->join('user', 'shifts.user_id = user.id', 'left');
//        $this->db->where('day', $day);
        $this->db->where('time', 'בוקר/ערב');
        $query = $this->db->get();
       
        return $query->result_array();
    }

    public function get_Shifts($day,$time){
        $this->db->select('user.fullname');
        $this->db->select('user.job');
        $this->db->select('day');
         $this->db->select('time');
        $this->db->from('shifts');
        $this->db->join('user', 'shifts.user_id = user.id', 'left');
        $this->db->group_start();
        $this->db->where('day', $day);
        $this->db->where('time', $time);
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('day', $day);
        $this->db->where('time', 'כפולה');
        $this->db->group_end();
//        $this->db->or_group_start();
//        $this->db->where('day', $day);
//        $this->db->where('time', 'בוקר/ערב');
//        $this->db->group_end();

        $query = $this->db->get();
       
        return $query->result_array();
    }
    
    public function get_week_Shifts(){
        $this->db->select('user.fullname');
        $this->db->select('user.job');
        $this->db->select('day');
         $this->db->select('time');
        $this->db->from('shifts');
        $this->db->join('user', 'shifts.user_id = user.id', 'left');

        $query = $this->db->get();
       
        return $query->result_array();
    }
    
//    public function get_jobs(){
//        $this->db->select('job');
//        $this->db->from('user');
//        $this->db->where('worker_name')
//        
//    }

        public function check_exist($field, $variable){
        if($variable){
           $this->db->where($field, $variable); 
           $query = $this->db->get('shifts');
           if($query->num_rows()>0){
               return true;
           }
        }
        return false;
    }
    
    public function holidaysAPI(){
        $urlContents = "https://www.hebcal.com/hebcal/?v=1&cfg=json&maj=on&min=on&mod=on&nx=on&year=now&month=&mf=on&geonameid=6255147&lg=h";
        $data = file_get_contents($urlContents);
        $calArray = json_decode($data, true);
       
        return $calArray;
    }
    
    public function delete_shifts(){   
        $this->db->truncate('shifts');
    }
    
    function get_shifts_by_week($data){
        $this->db->select('*');
        $this->db->from('final_shifts');
        $this->db->where('date', $data);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    
//    public function shifts_form_input(){
//        $data = array();
//        $dates = date('Y-m-d', strtotime("20-05-17"));
//        $dates = array_fill(0, 14,$this->input->post('date[]') );
//        $days = $this->input->post('day[]');
//        $times = $this->input->post('time[]');
//        $worker_names = $this->input->post('worker_name[]');
//        
//        if(is_array($days)){
//        foreach ($days as $key => $day){
//            $data[] =  array (
//                'day' => $day,
//                'time' => $times[$key],
//                'worker_name' => $worker_names[$key],
//                );
//            };
//        }
//        
//        foreach ($data as $worker):
//       
//        $dates = array_fill(0, 14, $date);
//        $worker_names = $this->input->post('worker_name[]');
//        foreach ($dates as $key => $date):
//        $data[] = array(
//            'date' => $date,
//            'worker_name' => $worker_names[$key],
//        );   
//        endforeach;
        
//        return $data;
        
//    }
//    
//    public function update_shifts($date){
//            $worker_name= $this->input->post('worker_name[]');
//            $this->db->set('worker_name', $worker_name);
//            $this->db->where('date', $date);
//            $this->db->update('final_shifts');
        
//        $worker_name= $this->input->post('worker_name[]');
//        $this->db->set('worker_name', $worker_name);
//        $this->db->where('date', $date);
//        $this->db->where('day', $this->input->post('day[]'));
//        $this->db->where('time', $this->input->post('time[]'));
//        $this->db->update('final_shifts');
//        
//        $query = $this->db->get();
//       
//        return $query->result_array();
//    }
       
        
        
//        $data = array();
//        $dates = date('Y-m-d', strtotime("20-05-17"));
////        $dates = array_fill(0, 14, $date );
//        $days = $this->input->post('day[]');
//        $times = $this->input->post('time[]');
//        $worker_names = $this->input->post('worker_name[]');
//        
//        if(is_array($dates)){
//        foreach ($dates as $key => $date){
//            $data[] =  array (
//                'date' => $date,
//                'day' => $days[$key],
//                'time' => $times[$key],
//                'worker_name' => $worker_names[$key],
//                );
//            };
//        }
//        $data = $this->shifts_form_input();
//       $data['worker_name'] = $this->input->post('worker_name[]');
        
//        $worker_name = $this->input->post('worker_name[]');
//        $sql = "UPDATE $final_shifts SET $worker_name WHERE $date = 'date'";
//        $this->db->update('final_shifts');
//        $this->db->set('worker_name');
//        $this->db->where('date', $date);
//        $sql = "UPDATE `final_shifts` SET `worker_name` = 'ויקטוריה ' WHERE `final_shifts`.`date` = '2020-05-17' AND `final_shifts`.`worker_name` = '' AND `final_shifts`.`day` = 'שני' AND `final_shifts`.`time` = 'ערב'";
        
//        $this->db->set
        
        
        
//    }
//    
}
?>
<?php
class Shifts extends CI_Controller {
    
    public function __construct() {
    parent::__construct();
    $this->load->model('Shifts_model');
    error_reporting(E_ALL ^ E_NOTICE);
    }

    public function shiftsMenu() {
        $data['title'] = 'סידור עבודה';
        $this->load->view('templates/header', $data);
        $this->load->view('shifts/shiftsMenu', $data);
        $this->load->view('templates/footer');
    }
    
    public function form_shiftsDate(){ 
        $newDate =$this->input->post('week');
        
        $sunday = $this->Shifts_model->getStartDate($newDate);
        $this->session->set_flashdata('s_date',$sunday);
        $this->session->set_flashdata('week',$newDate);
       
            redirect("/shifts/viewShifts");
    }
    
    public function viewShifts() { 
//        $data['title'] = 'סידור משמרות עבור שבוע:';
        if(($this->session->flashdata('s_date')) != NULL){
            $this->session->keep_flashdata('week');   
            $date = $this->session->flashdata('s_date');
        }
        else{
            $date = date('Y-m-d');
        }
            
        $data['sunday_morning'] = $this->Shifts_model->view_Shifts('ראשון','בוקר',$date);
        $data['sunday_evening'] = $this->Shifts_model->view_Shifts('ראשון','ערב',$date);
        $data['monday_morning'] = $this->Shifts_model->view_Shifts('שני','בוקר',$date);
        $data['monday_evening'] = $this->Shifts_model->view_Shifts('שני','ערב',$date);
        $data['tuesday_morning'] = $this->Shifts_model->view_Shifts('שלישי','בוקר',$date);
        $data['tuesday_evening'] = $this->Shifts_model->view_Shifts('שלישי','ערב',$date);
        $data['wednesday_morning'] = $this->Shifts_model->view_Shifts('רביעי','בוקר',$date);
        $data['wednesday_evening'] = $this->Shifts_model->view_Shifts('רביעי','ערב',$date);
        $data['thursday_morning'] = $this->Shifts_model->view_Shifts('חמישי','בוקר',$date);
        $data['thursday_evening'] = $this->Shifts_model->view_Shifts('חמישי','ערב',$date);
        $data['friday_morning'] = $this->Shifts_model->view_Shifts('שישי','בוקר',$date);
        $data['friday_evening'] = $this->Shifts_model->view_Shifts('שישי','ערב',$date);
        $data['saturday_morning'] = $this->Shifts_model->view_Shifts('שבת','בוקר',$date);
        $data['saturday_evening'] = $this->Shifts_model->view_Shifts('שבת','ערב',$date);

        $this->load->view('templates/header');
        $this->load->view('shifts/viewShifts', $data);
        $this->load->view('templates/footer');
        }    
      
    public function manageShifts() { 
        $data['title'] = 'סידור עבודה';
        
        $data['sunday_morning'] = $this->Shifts_model->get_shifts('ראשון','בוקר');
        $data['sunday_evening'] = $this->Shifts_model->get_shifts('ראשון','ערב');
        $data['monday_morning'] = $this->Shifts_model->get_shifts('שני','בוקר');
        $data['monday_evening'] = $this->Shifts_model->get_shifts('שני','ערב');
        $data['tuesday_morning'] = $this->Shifts_model->get_shifts('שלישי','בוקר');
        $data['tuesday_evening'] = $this->Shifts_model->get_shifts('שלישי','ערב');
        $data['wednesday_morning'] = $this->Shifts_model->get_shifts('רביעי','בוקר');
        $data['wednesday_evening'] = $this->Shifts_model->get_shifts('רביעי','ערב');
        $data['thursday_morning'] = $this->Shifts_model->get_shifts('חמישי','בוקר');
        $data['thursday_evening'] = $this->Shifts_model->get_shifts('חמישי','ערב');
        $data['friday_morning'] = $this->Shifts_model->get_shifts('שישי','בוקר');
        $data['friday_evening'] = $this->Shifts_model->get_shifts('שישי','ערב');
        $data['saturday_morning'] = $this->Shifts_model->get_shifts('שבת','בוקר');
        $data['saturday_evening'] = $this->Shifts_model->get_shifts('שבת','ערב');
        
        $this->load->view('templates/header', $data);
        $this->load->view('shifts/manageShifts', $data);
        $this->load->view('templates/footer');
    
    }

    public function saveFinalShifts(){  
        
        $data = array();
        
        $newDate= $this->input->post('week');
        $sunday = $this->Shifts_model->getStartDate($newDate);
       
        $dates = array_fill(0, 14, $sunday);
        $days = $this->input->post('day[]');
        $times = $this->input->post('time[]');
        $worker_names = $this->input->post('worker_name[]');
        
        if(is_array($dates)){
        foreach ($dates as $key => $date){
            $data[] =  array (
                'date' => $date,
                'day' => $days[$key],
                'time' => $times[$key],
                'worker_name' => $worker_names[$key],
                );
            }
        }
//        echo '<pre>';print_r($data); die;    

        $error = $this->checkShifts_manager($data); 
        
        if ($error){
            $this->session->set_flashdata('error','<b><u>שיבוץ המשמרות נכשל ! </u></b>'.$error.'');
            redirect(base_url("/Shifts/manageShifts"));
        }
        else{
            $this->session->set_flashdata('success', 'שיבוץ המשמרות נשמר בהצלחה !');
            $this->Shifts_model->saveFinalShifts($data);
            redirect(base_url("/Shifts/manageShifts"));
        }
    }
        
    public function checkShifts_manager($data){
        $error= NULL;
        $i =0;
        
        foreach ($data as $shifts):
            
            if(empty($data[$i]['date'])){
                $error.='<br> חובה לבחור שבוע עבורו הסידור';
            }

            if(empty($data[$i]['worker_name'])) {
                $error='<br> חובה לשבץ עובד עבור כל חלק ביום';
            }
            
            $i++;           
        
        endforeach;
        
    return $error;
    }
    
     public function sendShifts() { 
        $data['title'] = 'סידור עבודה';
        
        $data['cur_worker'] = $this->Shifts_model->get_worker();
       
        $this->load->view('templates/header', $data);
        $this->load->view('shifts/sendShifts', $data);
        $this->load->view('templates/footer');     
    }
    
    public function saveShifts(){
        
        $data = array();
        
        $days = $this->input->post('day[]');
        $times = $this->input->post('time[]');
        
        foreach ($days as $key => $day){
            $data[] =  array (
                'user_id' => $_SESSION['id'],
                'day' => $day,
                'time' => $times[$key],
                );
        }
        echo $data;
        $cur_worker = $this->Shifts_model->get_worker();
        $error = $this->checkShifts($cur_worker,$data);
       
        if ($error){
            $data['error'] = $this->session->set_flashdata('error','<b><u>שליחת המשמרות נכשלה ! </u></b>'.$error.'');
                redirect(base_url("/Shifts/sendShifts"));
        }
        else{
//            $this->Shifts_model->saveShifts($data);  
            $this->session->set_flashdata('success', 'המשמרות נשלחו בהצלחה !');
                redirect(base_url("/Shifts/sendShifts"));
                echo $data;
        }
    }
  
    public function checkShifts($cur_worker,$data){
        $error= NULL;
        $i= 0;
      
        foreach ($cur_worker as $worker):
        if ($cur_worker[$i]['user_id'] === $_SESSION['id'] ){
            $error .= '<br>כבר הגשת משמרות לשבוע זה';
        }
        $i++;
        endforeach;
       
        if(in_array("חופש",$data[6]) && in_array("חופש",$data[5]) && in_array("חופש",$data[4])){
            $error .= '<br>חובה להגיש לפחות משמרת אחת בסופ"ש';
          }
          
        $array = [in_array("חופש",$data[0]) , in_array("חופש",$data[1]) , in_array("חופש",$data[2]) , in_array("חופש",$data[3])];
        $res = count(array_filter($array));

        if($res != 1)  {
            $error .= '<br>חובה להגיש לפחות שלוש משמרות באמצע שבוע';
        }

    return $error;

    }  
}
        
?>
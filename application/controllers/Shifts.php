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
        if(($this->session->flashdata('s_date')) != NULL){
            $this->session->keep_flashdata('week');   
            $date = $this->session->flashdata('s_date');
        }
        else{
            $current_week = date('Y-W');
            $date = $this->Shifts_model->getWeekDate($current_week);
        }
        $this->session->set_flashdata('sunday',$date);
        $this->session->keep_flashdata('sunday',$date);
        $year = date('Y');
        $week = date('W');
        $weekTime = $year.'-W'.$week;
        $this->session->set_flashdata('currentWeek',$weekTime);  
        $this->session->keep_flashdata('currentWeek'); 
        $data['calArray'] = $this->Shifts_model->holidaysAPI();
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
        $year = date('Y');
        $week = date('W')+1;
        $weekTime = $year.'-W'.$week;
        $this->session->set_flashdata('currentWeek',$weekTime);  
        $this->session->keep_flashdata('currentWeek'); 
        $date = $this->Shifts_model->getStartDate($weekTime);
        $this->session->set_flashdata('sunday',$date);
        $this->session->keep_flashdata('sunday',$date);
        
        $data['calArray'] = $this->Shifts_model->holidaysAPI();
      
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
        $data['week_shifts'] = $this->Shifts_model->get_week_shifts();
        
//          echo '<pre>';print_r($data['week_shifts']); die;    
        
        $days = Array("ראשון", "שני", "שלישי", "רביעי", "חמישי", "שישי", "שבת");
        $jobs = Array("מלצרות","בר","אירוח","אחמש");
        $times = Array("בוקר","ערב");
        
//        echo '<pre>';print_r($data['week_shifts']); die;    
        
        $flag = true;
        for ($i=0;$i<count($days);$i++){           
            if($flag === false){
                break;
            }
            for ($k=0; $k<count($times);$k++){
                if($flag === false){
                   break;
                }
            
                for($j=0;$j<count($jobs);$j++){
                    $count = 0;

                    foreach ($data['week_shifts'] as $shifts):
                        if((in_array($days[$i],$shifts)) && (in_array($jobs[$j], $shifts)) && ((in_array($times[$k], $shifts)) || (in_array("כפולה", $shifts)))){
                            $count++;   
                            break;
                        }
                    endforeach;
            
                    if($count === 0){
                        $flag = false;
//                        echo "hi";
                        $this->session->set_flashdata('warning','<b><u>ישנם חוסרים בסידור </u></b>');
                        break;
                    }
                }
            }
        }
        $this->load->view('templates/header', $data);
        $this->load->view('shifts/manageShifts', $data);
        $this->load->view('templates/footer');
    
    }

    public function saveFinalShifts(){  
        
        $data = array();
        
        $newDate= $this->input->post('week');
        $sunday = $this->Shifts_model->getStartDate($newDate);
        $count = count($this->input->post('worker_name[]'));
        $dates = array_fill(0, $count , $sunday);
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
        $ex_date = $this->Shifts_model->get_ex_date();
        $count = count($data);

        foreach ($ex_date as $date):
            if(in_array($data[0]['date'],$ex_date[$i])){
                 $error.='<br> סידור לשבוע זה כבר קיים במערכת';
            }
            $i++;
        endforeach;
                
        if (($count >= 66)){ 
                
            for($j=0;$j<count($jobs);$j++){
                $counter =0;

                foreach ($data as $shifts):
                    if((in_array("שבת",$shifts)) && (in_array("אחמש", $shifts)) && (in_array("ערב", $shifts))){
                        $counter++;
                        break;
                    }
                endforeach;

                if($counter == 0){
                    $error.='<br> על מנת לשמור את הסידור צריך למלא לפחות עובד אחד עבור כל חלק ביום';
                    break;
                }
            }
        }else{
            $error.='<br> על מנת לשמור את הסידור צריך למלא לפחות עובד אחד עבור כל חלק ביום';
        }
        
        return $error;
    }
    
     public function sendShifts() { 
        $year = date('Y');
        $week = date('W')+1;
        $weekTime = $year.'-W'.$week;
        $this->session->set_flashdata('currentWeek',$weekTime);  
        $this->session->keep_flashdata('currentWeek'); 
        $date = $this->Shifts_model->getStartDate($weekTime);
        $this->session->set_flashdata('sunday',$date);
        $this->session->keep_flashdata('sunday',$date);
        
        $data['cur_worker'] = $this->Shifts_model->get_worker();
        $data['calArray'] = $this->Shifts_model->holidaysAPI();
       
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

        $cur_worker = $this->Shifts_model->get_worker();
        $error = $this->checkShifts($cur_worker,$data);
       
        if ($error){
            $data['error'] = $this->session->set_flashdata('error','<b><u>שליחת המשמרות נכשלה ! </u></b>'.$error.'');
                redirect(base_url("/Shifts/sendShifts"));
        }
        else{
            $this->Shifts_model->saveShifts($data);  
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

        if($res > 1)  {
            $error .= '<br>חובה להגיש לפחות שלוש משמרות באמצע שבוע';
        }

    return $error;

    }  
    
    public function delete_shifts() {
        $this->Shifts_model->delete_shifts();
        $this->manageShifts(); 
    }
    
}
        
?>
<?php
class Shifts extends CI_Controller {
    
    public function __construct() {
    parent::__construct();
    $this->load->model('Shifts_model');
    }

     public function shiftsMenu() {
        $data['title'] = 'סידור עבודה';
        $this->load->view('templates/header', $data);
        $this->load->view('shifts/shiftsMenu', $data);
        $this->load->view('templates/footer');
    }
    
    public function viewShifts() { 
        $data['title'] = 'סידור עבודה';
        
        $data['sunday_worker_morning']=$this->Shifts_model->viewShifts_morning();
        $data['sunday_worker_evening']=$this->Shifts_model->viewShifts_evening();

        $this->load->view('templates/header', $data);
        $this->load->view('shifts/viewShifts', $data);
        $this->load->view('templates/footer');
    }
    
    public function manageShifts() { 
        
        $data['sunday_morning'] = $this->Shifts_model->get_shifts('ראשון','בוקר');
        $data['sunday_evening'] = $this->Shifts_model->get_shifts('ראשון','ערב');
        $data['sunday_double'] = $this->Shifts_model->get_shifts('ראשון','כפולה');
        $data['monday_morning'] = $this->Shifts_model->get_shifts('שני','בוקר');
        $data['monday_evening'] = $this->Shifts_model->get_shifts('שני','ערב');
        $data['monday_double'] = $this->Shifts_model->get_shifts('שני','כפולה');
        $data['tuesday_morning'] = $this->Shifts_model->get_shifts('שלישי','בוקר');
        $data['tuesday_evening'] = $this->Shifts_model->get_shifts('שלישי','ערב');
        $data['tuesday_double'] = $this->Shifts_model->get_shifts('שלישי','כפולה');
        $data['wednesday_morning'] = $this->Shifts_model->get_shifts('רביעי','בוקר');
        $data['wednesday_evening'] = $this->Shifts_model->get_shifts('רביעי','ערב');
        $data['wednesday_double'] = $this->Shifts_model->get_shifts('רביעי','כפולה');
        $data['thursday_morning'] = $this->Shifts_model->get_shifts('חמישי','בוקר');
        $data['thursday_evening'] = $this->Shifts_model->get_shifts('חמישי','ערב');
        $data['thursday_double'] = $this->Shifts_model->get_shifts('חמישי','כפולה');
        $data['friday_morning'] = $this->Shifts_model->get_shifts('שישי','בוקר');
        $data['friday_evening'] = $this->Shifts_model->get_shifts('שישי','ערב');
        $data['friday_double'] = $this->Shifts_model->get_shifts('שישי','כפולה');
        $data['saturday_morning'] = $this->Shifts_model->get_shifts('שבת','בוקר');
        $data['saturday_evening'] = $this->Shifts_model->get_shifts('שבת','ערב');
        $data['saturday_double'] = $this->Shifts_model->get_shifts('שבת','כפולה');

        $this->load->view('templates/header', $data);
        $this->load->view('shifts/manageShifts', $data);
        $this->load->view('templates/footer');
    }
    
    public function saveFinalShifts(){
        $dataMorning = array(
            'time' => 'בוקר',
            'sunday' => $this->input->post('sunday'),
//            'monday'=>$this->input->post('monday'),
//            'tuesday'=>$this->input->post('tuesday'),
//            'wednesday'=>$this->input->post('wednesday'),
//            'thursday'=>$this->input->post('thursday'),
            'friday'=>$this->input->post('friday'),
//            'saturday'=>$this->input->post('saturday'),
            );
        
        $dataEvening = array(
            'time' => 'ערב',
//            'sunday' => $this->input->post('sunday'),
//            'monday'=>$this->input->post('monday'),
            'tuesday'=>$this->input->post('tuesday'),
//            'wednesday'=>$this->input->post('wednesday'),
//            'thursday'=>$this->input->post('thursday'),
//            'friday'=>$this->input->post('friday'),
            'saturday'=>$this->input->post('saturday'),
            );
        
         $this->Shifts_model->saveFinalShifts($dataMorning,$dataEvening);
    }
        
//       $error = $this->checkShifts_manager($dataMorning,$dataEvening);
//        
//        if ($error){
//            $data['error'] = "<div class='alert alert-danger'><b><u>שיבוץ המשמרות נכשל </u></b>" . $error . "</div>";
//            echo $data['error'];
//        } else{
           
//        }   
//         $this->Shifts_model->saveFinalShifts($dataMorning,$dataEvening); 
//    }
    
    
//    public function checkShifts_manager($dataMorning, $dataEvening){
//        $error= NULL;
//        if (empty($data['sunday'])){
//            $error.='<br>יש למלא את יום ראשון';
//        }
//        if (empty($data['monday'])){
//            $error.='<br>יש למלא את יום שני';
//        }
//        if (empty($data['tuesday'])){
//            $error.='<br>יש למלא את יום שלישי';
//        }
//        if (empty($data['wednesday'])){
//            $error.='<br>יש למלא את יום רביעי';
//        }
//        if (empty($data['thursday'])){
//            $error.='<br>יש למלא את יום חמישי';
//        }
//        if (empty($data['friday'])){
//            $error.='<br>יש למלא את יום שישי';
//        }
//        if (empty($data['saturday'])){
//            $error.='<br>יש למלא את יום שבת';
//        }
//        
//        return $error;
//    }
        
     public function sendShifts() { 
        $data['title'] = 'סידור עבודה';
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
        
        $error = $this->checkShifts($data);
        
        if ($error){
            $data['error'] = "<div class='alert alert-danger'><b><u>שליחת המשמרות נכשלה </u></b>" . $error . "</div>";
            echo $data['error'];
        } else{
            $this->Shifts_model->saveShifts($data);
        }
    }
  
    public function checkShifts($data){
        $error= NULL;
      
//        if (!isset($_POST['time[]'])){
//            $error .= '<br>יש לבחור אופציה בכל אחד מין הימים.';
//        }
//        
        return $error;
    }
}
        
        
        
        
//        if (empty($data['monday'])){
//            $error.='<br>יש למלא את יום שני';
//        }
//        if (empty($data['tuesday'])){
//            $error.='<br>יש למלא את יום שלישי';
//        }
//        if (empty($data['wednesday'])){
//            $error.='<br>יש למלא את יום רביעי';
//        }
//        if (empty($data['thursday'])){
//            $error.='<br>יש למלא את יום חמישי';
//        }
//        if (empty($data['friday'])){
//            $error.='<br>יש למלא את יום שישי';
//        }
//        if (empty($data['saturday'])){
//            $error.='<br>יש למלא את יום שבת';
//        }
//        
//        return $error;
//    }
//        
//}

?>
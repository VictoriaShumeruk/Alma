<?php
class Hosting extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Hosting_model');
    }
    
    public function form_reDate(){
        
        $newDate =$this->input->post('re_date');
        $this->session->set_flashdata('reDate',$newDate);
        $data['tables'] = $this->Hosting_model->get_tables($newDate);
        $this->session->set_flashdata('key',$data);
        redirect(base_url("/hosting/tableMap"));
    }
    
    public function tableMap() {
        if(($this->session->flashdata('key')) != NULL){
            $data = $this->session->flashdata('key');
            $this->session->keep_flashdata('reDate');
            $this->load->view('templates/header');
            $this->load->view('hosting/tableMap', $data);
            $this->load->view('templates/footer');  
        }
        else{
         $current_date = date('Y-m-d');
            $data['tables'] = $this->Hosting_model->get_tables($current_date);
            $this->load->view('templates/header');
            $this->load->view('hosting/tableMap', $data);
            $this->load->view('templates/footer');  }
//       if($this->input->post('choose')){
//            $newDate = date("Y-m-d",strtotime($this->input->post('re_date')));
//            $data['tables'] = $this->Hosting_model->get_tables($newDate);
//
//            $this->load->view('templates/header');
//            $this->load->view('hosting/tableMap');
//            $this->load->view('templates/footer');
//    
        }

  public function validation($data) {
        $error = NULL;
        if (empty($data['fullname'])) {
            $error['fullname']= 'אנא מלא שם פרטי ומשפחה של הלקוח!';
        }

        if (empty($data['dine'])) {
            $error['dine']= 'אנא מלא את מספר הסועדים של ההזמנה!';
        }
        
         if (empty($data['date'])) {
            $error['date']= 'אנא מלא את התאריך של ההזמנה!';
        }
        
         if (empty($data['time'])) {
            $error['time']= 'אנא מלא את שעת ההזמנה!';
        }
        
         if ((empty($data['phone'])) && (!preg_match('/^[0-9]{10}+$/', $data['phone']))) {
            $error['phone']= 'אנא מלא מספר טלפון של הלקוח!';
        }

        if (!preg_match("/^[a-zA-Zא-ת ]*$/", $data['fullname'])) {
            $error['name']= 'ניתן להזין אך ורק אותיות ורווחים!';
        }
        
        $this->session->set_flashdata('error', $error);
    }

    
    
    
    //form to save new reservation
    public function create() {  

//        if($this->form_validation->run()===false){ 
//            $this->session->keep_flashdata('error'); 
//                         
//        } 
//        else { 
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
                'fullname' => $this->input->post('fullname'),
                'phonenumber' => $this->input->post('phonenumber'),
            );
                        
            $this->Hosting_model->form_insert($data, $dataclient);

            echo "הזמנה חדשה התקבלה!";
            redirect(base_url("/hosting/tableMap"));
        }
           
  
}          
?>

<?php
class Hosting extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Hosting_model');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
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
        }
        else{
         $current_date = date('Y-m-d');
            $data['tables'] = $this->Hosting_model->get_tables($current_date);
        }   
            $this->load->view('templates/header');
            $this->load->view('hosting/tableMap', $data);
            $this->load->view('templates/footer');
    }    
    
    //form to save new reservation
    public function create() {  

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
            
            $error = $this->validation($data);
            $error1 = $this->validation1($dataclient);

        if ($error) {
            $data['error'] = $this->session->set_flashdata('error','<b><u>שמירת ההזמנה נכשלה ! </u></b>'.$error.'');
            if ($error1){
            $data['error_name'] = $this->session->set_flashdata('error_name',$error1);}
        redirect(base_url("/hosting/tableMap"));
        } else {        
            $this->Hosting_model->form_insert($data, $dataclient);
            redirect(base_url("/hosting/tableMap"));
            }    
        }
        
        
        public function validation($data) {
      
        $error = NULL;

        if (empty($data['diners'])) {
            $error .= '<br> חובה להזין  את מספר הסועדים.';
        }
        
         if (empty($data['re_date'])) {
            $error .= '<br> חובה להזין את תאריך ההזמנה.';
        }
        
         if (empty($data['phonenumber'])) {
            $error .= '<br> חובה להזין את מספר הטלפון של הלקוח.';
        }
        if(!preg_match('/^[0-9]{10}+$/', $data['phonenumber'])){
            $error .= '<br> מספר הטלפון מכיל תווים לא חוקיים, ניתן להזין רק ספרות';
             }
        return $error;
        
    }
     public function checkNameAndPhone($dataclient){
        $fullname = $this->Hosting_model->check_phone($dataclient['phonenumber']);
        if($dataclient['fullname'] != $fullname){
            return $fullname;
        } 
        else {
            return NULL;
        }
    }
    public function validation1($dataclient){
        $error=NULL;
         if (empty($dataclient['fullname'])) {
            $error .= '<br> חובה להזין את שם הלקוח.';
        }
        if (!preg_match("/^[a-zA-Zא-ת ]*$/", $dataclient['fullname'])) {
            $error .= 'ניתן להזין אך ורק אותיות ורווחים!<br>';
        }
        
        return $error;
    }
   




    public function get_id() {
       $res_id= $this->input->post('id');
       $this->session->set_flashdata('reservation_id',$res_id);
       $this->session->keep_flashdata('reservation_id');
       redirect(base_url("/hosting/editReservation"));
       
    }
    
    public function editReservation() {
        $data['reservation'] = $this->Hosting_model->get_res_by_id($this->session->flashdata('reservation_id'));
        $this->load->view('templates/header');
        $this->load->view('Hosting/editReservation', $data);
        $this->load->view('templates/footer');
    }
    
    public function edit($id) {
      $phone = $this->input->post('phonenumber');
        $this->Hosting_model->update_res($id, $phone);
        redirect(base_url("/hosting/tableMap"));
    
    }
    public function delete_reservation($id){
        $this->Hosting_model->delete_reservation($id);
        redirect(base_url("/hosting/tableMap"));
    }
    
}  

?>

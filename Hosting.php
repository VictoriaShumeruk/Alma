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
                    'fullname' => $this->input->post('fullname'),
            );
//                    
//            $dataclient = array(
//                'fullname' => $this->input->post('fullname'),
//                'phonenumber' => $this->input->post('phonenumber'),
//            );
            
            $error = $this->validation($data);

        if ($error) {
            $data['error'] = $this->session->set_flashdata('error','<b><u>שליחת המשמרות נכשלה ! </u></b>'.$error.'');
//            $ajax_data['error'] = 1; // if error exists then value
//            $ajax_data['validation_error'] = $error;
            redirect(base_url("/hosting/tableMap"));
          
              } else {
//            $ajax_data['error'] = 0; 
            $this->Hosting_model->form_insert($data);
            redirect(base_url("/hosting/tableMap"));
            }
//         return json_encode($ajax_data);       
        }
     
        public function validation($data) {
      
        $error = NULL;
        if (empty($data['fullname'])) {
            $error .= '<br> חובה למלא את השם המלא של הלקוח.';
        }

        if (empty($data['diners'])) {
            $error .= '<br> חובה להזין  את מספר הסועדים.';
        }
        
         if (empty($data['re_date'])) {
            $error .= '<br> חובה להזין את תאריך ההזמנה.';
        }
        
         if (empty($data['re_time'])) {
            $error .= '<br> חובה להזין את שעת ההזמנה.';
        }
        
         if ((empty($data['phonenumber'])) && (!preg_match('/^[0-9]{10}+$/', $data['phonenumber']))) {
            $error .= '<br> חובה להזין את מספר הטלפןו התקין של הלקוח.';
        }
//
//        if (!preg_match("/^[a-zA-Zא-ת ]*$/", $data['fullname'])) {
//            $error['name']= 'ניתן להזין אך ורק אותיות ורווחים!';
//        }
//        
        return $error;
    }
    
    public function get_id() {
       $res_id= $this->input->post('id');
       $this->session->set_flashdata('reservation_id',$res_id);
       $this->session->keep_flashdata('reservation_id');
       redirect(base_url("/hosting/edit_reservation"));
       
    }
    
    public function edit_reservation() {
   print_r($this->db->last_query());
        $data['reservation'] = $this->Hosting_model->get_res_by_id($this->session->flashdata('reservation_id'));
        $this->load->view('templates/header');
        $this->load->view('Hosting/edit_reservation', $data);
        $this->load->view('templates/footer');
    }
    
    public function edit() {
      
////                    
//
//        $dataclient = array(
//            'fullname' => $this->input->post('fullname'),
//            'phonenumber' => $this->input->post('phonenumber'),
//        );
//        $this->output->enable_profiler(TRUE);
         
        $id = $this->session->flashdata('reservation_id');
        $this->Hosting_model->update_res($id);
        redirect(base_url("/hosting/tableMap"));
    
    }
//    public function getClientNameByNumber(){
//        
//    }
}  

?>

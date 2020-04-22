<?php
class Hosting extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Hosting_model');
        $this->load->helper('date');
        $this->load->helper(array('form', 'url'));
    }
    
    public function tableMap() {
        $data['tables'] = $this->Hosting_model->get_tables();
        $this->load->view('templates/header');
        $this->load->view('hosting/tableMap',$data);
        $this->load->view('templates/footer');
        
    }
      public function newReservation() {
        $this->load->view('templates/header');
        $this->load->view('hosting/newReservation');
        $this->load->view('templates/footer');
      }
    
    //form to save new reservation
        public function create() {           
            if($this->input->post('save')){
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
           
            // Show submitted data on view page again.
            $this->Hosting_model->form_insert($data, $dataclient);
         
//            $data['message'] = 'Data Inserted Successfully';
            //Loading View
            echo "Reservation Saved Successfully";
            redirect(base_url("/hosting/tableMap"));
            }
        }
            
}
?>

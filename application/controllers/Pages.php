<?php
class Pages extends CI_Controller {
    
        public function __construct() {
        parent::__construct();
        $this->load->model('Pages_model');
    }
        public function index() { 
        $data['homepage'] = NULL;
        $data['title'] = 'דף הבית' ;
//        $sess_id = $this->session->userdata('user');
//        if(empty($sess_id)) //If the user has not logged in  
//        $data['user'] = null;
//        else
//        $data['user'] = $this->session->all_userdata();

        $this->load->view('templates/header', $data);
        $this->load->view('homepage', $data);
        $this->load->view('templates/footer');
        }
        
        
        public function api(){
        $data['title'] = 'דף הבית' ;
         
        $this->load->view('templates/header', $data);
        $this->load->view('pages/api', $data);
        $this->load->view('templates/footer');
        }
        
        
}

?>
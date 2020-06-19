<?php
class Pages extends CI_Controller {
    
        public function __construct() {
        parent::__construct();
        $this->load->model('Pages_model');
    }
        public function index() { 
        $data['homepage'] = NULL;
        $data['title'] = 'דף הבית' ;

        $this->load->view('templates/header', $data);
        $this->load->view('homepage', $data);
        $this->load->view('templates/footer');
        }
             
        public function music(){
        $data['title'] = 'מוזיקה' ;
         
        $this->load->view('templates/header', $data);
        $this->load->view('pages/music', $data);
        $this->load->view('templates/footer');
        }
        
 }

?>
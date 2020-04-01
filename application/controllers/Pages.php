<?php
class Pages extends CI_Controller {
    
        public function __construct() {
        parent::__construct();
        $this->load->model('Pages_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('session');
    }
        public function index() { 
        $data['homepage'] = NULL;
        $data['title'] = 'דף הבית' ;
        /*$sess_id = $this->session->userdata('user');
        if(empty($sess_id)) //If the user has not logged in  
        $data['user'] = null;
        else
        $data['user'] = $this->session->all_userdata();
*/
        $this->load->view('templates/header', $data);
        $this->load->view('homepage', $data);
        $this->load->view('templates/footer');
    }
}

    
        /*public function who_we_are() { //If the user has  logged in 
        $data['home'] = NULL;
        $data['title'] = '? מי אנחנו';
        $sess_id = $this->session->userdata('user');
        if(empty($sess_id)) //If the user has not logged in  
        $data['user'] = null;
        else
        $data['user'] = $this->session->all_userdata();   
        $this->load->view('templates/header', $data);
        $this->load->view('pages/who_we_are', $data);
        $this->load->view('templates/footer');
    }
	
    
        public function photo_galary() { //If the user has  logged in 
        $data['home'] = NULL;
        $data['title'] = 'גלריית תמונות';
                $sess_id = $this->session->userdata('user');
        if(empty($sess_id)) //If the user has not logged in  
        $data['user'] = null;
        else
        $data['user'] = $this->session->all_userdata();  
        $this->load->view('templates/header', $data);
        $this->load->view('pages/photo_galary', $data);
        $this->load->view('templates/footer');
    }
}

*/
?>
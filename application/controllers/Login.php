<?php
class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->helper('url_helper');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->library('javascript');
    }
        
    public function login() {
        $data['title'] = 'התחברות';
        $data['id'] = NULL;
        $this->load->view('templates/header', $data);
        $this->load->view('login/login', $data);
        $this->load->view('templates/footer');
    }
    
    public function logout() {
        $data = array(
            'id',
            'password'
        );
        $this->session->unset_userdata($data);
        redirect("login/login");
    }


    public function auth() {

        $data = array(
            'id' => $this->input->post('id'),
            'password' => $this->input->post('password'),
        );
        $check = $this->Login_model->auth($data); 
        
        if ($check == false) {
            $data['error'] = array("message" => "משתמש או סיסמא אינם נכונים, נסה שנית ");
            $data['title']='התחברות';
            $data['user']=NULL;
            $this->load->view('templates/header', $data);
            $this->load->view('login/login', $data);
            $this->load->view('templates/footer');       
        }
        else{
            $this->session->set_userdata($data);
            redirect("pages/index");
        }
    }   
   
    public function register() {
        $data['title'] = 'הרשמה';
        $data['user'] = NULL;
        $this->load->view('templates/header', $data);
        $this->load->view('login/register', $data);
        $this->load->view('templates/footer');
    }

    public function save() {
        $data = array(
            'fullname' => $this->input->post('fullname'),
            'id' => $this->input->post('id'),
            'role' => $this->input->post('role'),
            'phone' => $this->input->post('phone'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
        );
       
        $error = $this->validation($data);

        if ($error) {
            $data['error'] = "<div class='alert alert-danger'><b><u>ההרשמה נכשלה </u></b>" . $error . "</div>";
            echo $data['error'];
        } else {
            $data['password'] = $data['password'];
            unset($data['password']);
            $this->Login_model->save($data);
        }
    }
    
    public function validation($data) {
        $error = NULL;
        if (empty($data['fullname'])) {
            $error .= '<br> Name field is required.';
        }

        if (empty($data['password'])) {
            $error .= '<br>Password field is required.';
        }
        
         if (empty($data['id'])) {
            $error .= '<br>Id field is required.';
        }
        
         if (empty($data['role'])) {
            $error .= '<br>Role field is required.';
        }
        
         if (empty($data['phone'])) {
            $error .= '<br>Phone field is required.';
        }

    //        if ($data['password'] != $data['conpassword']) {
    //            $error .= '<br>Your passwords does not match.';
    //        }

        if (!preg_match("/^[a-zA-Zא-ת ]*$/", $data['fullname'])) {
            $error .= '<br>Only letters and white space are alloweded in the name field .';
        }
        
        if(!preg_match('/^[0-9]{10}+$/', $data['phone'])){
            $error .= '<br>Invalid phone number .';
        }
        
        if (!preg_match('/^[0-9]{9}+$/', $data['id'])) {
            $error .= '<br>Id must be only 9 digits .';
        }

        if (empty($data['email'])) {
            $error .= '<br>Email field is required.';
        } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $error .= '<br>Invalid email format.';
        } else if ($this->Login_model->check_exist('email', $data['email'])) {
            $error .= '<br>A user with that email already exist.';
        }
        return $error;
    }

    
    
}
?>
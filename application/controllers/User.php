<?php
class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }
        
    public function login() {
        $data['title'] = 'התחברות';
        $data['user'] = NULL;
        $this->load->view('templates/header', $data);
        $this->load->view('user/login', $data);
        $this->load->view('templates/footer');
    }
    
    public function logout() {
        $data = array(
            'id',
            'password'
        );
        $this->session->unset_userdata($data);
        redirect("user/login");
    }


    public function auth() {

        $data = array(
            'id' => $this->input->post('id'),
            'password' => $this->input->post('password'),
        );
        $check = $this->User_model->auth($data); 
        
        if ($check == false) {
            $data['error'] = "<div class='alert alert-danger'><b>שם משתמש או סיסמא אינם נכונים, נסה שנית  </b></div>";
            $data['title']='התחברות';
            $data['user']=NULL;
            $this->load->view('templates/header', $data);
            $this->load->view('User/login', $data);
            $this->load->view('templates/footer');       
        }
        else{
            $this->session->set_userdata($check);
            redirect("pages/index");
        }
    }   
   
    public function register() {
        $data['title'] = 'הרשמה';
        $data['user'] = NULL;
        $this->load->view('templates/header', $data);
        $this->load->view('user/register', $data);
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
//            $data['password'] = $data['password'];
//            unset($data['password']);
            $this->User_model->save($data);
           
        }
    }
    
    public function validation($data) {
        $error = NULL;
        if (empty($data['fullname'])) {
            $error .= '<br> יש למלא את השם';
        }else if (!preg_match("/^[a-zA-Zא-ת ]*$/", $data['fullname'])) {
            $error .= '<br>רק אותיות ורווחים מותרות בשם .';
        }

        if (empty($data['password'])) {
            $error .= '<br>יש למלא את הסיסמא';
        }
        
         if (empty($data['id'])) {
            $error .= '<br>יש למלא את התז';
        }else if(!preg_match('/^[0-9]{9}+$/', $data['id'])) {
            $error .= '<br>תז חייבת לכלול 9 ספרות';
        }
        
         if (preg_match(('"בחר תפקיד"'), $data['role'])){
            $error .= '<br>יש לבחור תפקיד';
        }
        
         if (empty($data['phone'])) {
            $error .= '<br>יש למלא את מספר הטלפון ';
        }else if (!preg_match('/^[0-9]{10}+$/', $data['phone'])){
            $error .= '<br>מספר טלפון אינו תקין';
        }
        
        if (empty($data['email'])) {
            $error .= '<br>יש למלא את האימייל';
        } else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $error .= '<br>פורמט אימייל אינו תקין';
        } else if ($this->User_model->check_exist('email', $data['email'])) {
            $error .= '<br>האימייל הנוכחי כבר רשום במערכת';
        }
        
        return $error;       
    }
    
    public function userMenu(){
        $data['title'] = 'פרטי עובדים';
        $this->load->view('templates/header', $data);
        $this->load->view('user/userMenu');
        $this->load->view('templates/footer');
    }
    
    public function editUsers(){
        $data['title'] = 'פרטי עובדים';
        $this->load->view('templates/header', $data);
        $this->load->view('user/editUsers');
        $this->load->view('templates/footer');
    }
    
    public function viewUsers(){
        $data['title'] = 'פרטי עובדים';
        $data['workers'] = $this->User_model->get_users();
        
        $this->load->view('templates/header', $data);
        $this->load->view('user/viewUsers');
        $this->load->view('templates/footer');
    }
    
    public function editMyUser(){
        $data['title'] = 'פרטי עובדים';
        $this->load->view('templates/header', $data);
        $this->load->view('user/editMyUser');
        $this->load->view('templates/footer');
    }
    
}
    
?>
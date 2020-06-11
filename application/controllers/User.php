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
        $login_data = array(
            'id' => $this->input->post('id'),
            'password' => $this->input->post('password'),
        );
        $this->load->view('templates/header');
        $data['title']='התחברות';
        if ($this->User_model->check_exist('id', $login_data['id'])) {
            $check = $this->User_model->auth($login_data); 

            if ($check == false) {
                $data['error'] = "<div class='alert alert-danger'><b>שם משתמש או סיסמא אינם נכונים, נסה שנית  </b></div>";               
                $data['user']=NULL;   
            }
            else{
                $this->session->set_userdata($check);
                redirect("pages/index");
            }
        }else{
            $data['error'] = "<div class='alert alert-danger'><b>המשתמש אינו קיים במערכת</b></div>";
        } 
        $this->load->view('User/login', $data);
        $this->load->view('templates/footer');   
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
            'job' => $this->input->post('job'),
            'phone' => $this->input->post('phone'),
            'email' => $this->input->post('email'),
            'bank_account' => $this->input->post('bank_account'),
            'birth_date' => $this->input->post('birth_date'),
            'password' => $this->input->post('password'),
        );
        
        $error = $this->validation($data);

        if ($error) {
            $data['error'] = "<div class='alert alert-danger'><b><u>ההרשמה נכשלה </u></b>" . $error . "</div>";
            echo $data['error'];
        } else {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT); 
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
        }else if ($this->User_model->check_exist('id', $data['id'])) {
            $error .= '<br>תעודת הזהות הנוכחית כבר רשומה במערכת';
        }
        
        if (preg_match(('"בחר סטטוס"'), $data['role'])){
            $error .= '<br>יש לבחור סטטוס';
        }
        
        if (preg_match(('"בחר תפקיד"'), $data['job'])){
            $error .= '<br>יש לבחור תפקיד';
        }
        
         if (empty($data['phone'])) {
            $error .= '<br>יש למלא את מספר הטלפון ';
        }else if (!preg_match('/^[05]{2}[0-9]{8}$/', $data['phone'])){
            $error .= '<br> פורמט טלפון אינו תקין - מספר טלפון חייב להתחיל ב"05" ולכלול 10 ספרות סך הכל ';
        }else if ($this->User_model->check_exist('phone', $data['phone'])) {
            $error .= '<br>מספר הטלפון הנוכחי כבר רשום במערכת';
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
    
    public function viewUsers(){
        $data['title'] = 'פרטי עובדים';
        $data['workers'] = $this->User_model->get_users();
        
        $this->load->view('templates/header', $data);
        $this->load->view('user/viewUsers');
        $this->load->view('templates/footer');
    }
    
    public function edit($id){
        $data['title'] = 'ערוך עובד';
        
        $data['workers'] = $this->User_model->get_user_by_id($id);
        $check = $this->User_model->user_form_input();
        $error = $this->validationEdit($check);
        
        if($error){
            $this->session->set_flashdata('error','<b><u>עדכון העובד נכשל </u></b>'.$error.'');
            redirect("user/viewUsers");
        }
        else{
            $this->User_model->update_user($id);
            $this->session->set_flashdata('success','<b><u>עדכון העובד נשמר בהצלחה </u></b>');
            redirect("user/viewUsers");
        }
    }
    
    public function validationEdit($data) {
        $error = NULL;
               
        if (!preg_match("/^[a-zA-Zא-ת ]*$/", $data['fullname'])) {
            $error .= '<br>רק אותיות ורווחים מותרות בשם .';
        }
   
        if(!preg_match('/^[0-9]{9}+$/', $data['id'])) {
            $error .= '<br>תז חייבת לכלול 9 ספרות';
        }    
        
        if(!preg_match('/^\+?([0-9]{3})\)?[- ]?([0-9]{3})[- ]?([0-9]{6})$/', $data['bank_account'])) {
            $error .= '<br>פורמט חשבון בנק אינו תקין, חובה להכניס מספר בנק, סניף וחשבון עם קו מפריד בניהם';
        }    
        
        if (!preg_match('/^[05]{2}[0-9]{8}$/', $data['phone'])){
            $error .= '<br> פורמט טלפון אינו תקין - מספר טלפון חייב להתחיל ב"05" ולכלול 10 ספרות סך הכל ';
        }
        
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $error .= '<br>פורמט אימייל אינו תקין';
        }
       
        return $error;       
    }
            
    public function delete_user($id) {
        $this->User_model->delete_user($id);
        $this->viewUsers(); 
    }
    
    
}
    
?>
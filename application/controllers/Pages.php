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
        
        public function music2(){
        $data['title'] = 'מוזיקה' ;
         
        $this->load->view('templates/header', $data);
        $this->load->view('pages/music2', $data);
        $this->load->view('templates/footer');
            
        }
        
        
        public function music(){
        $data['title'] = 'מוזיקה' ;
         
        $this->load->view('templates/header', $data);
        $this->load->view('pages/music', $data);
        $this->load->view('templates/footer');
        }
        
//        $params = array('key' => 'df6cd092415291f639da4804ecbdca16');
//        $this->load->library('deezer-api', $params);
//        }
        
//        $app_id     = "412902";
//        $app_secret = "df6cd092415291f639da4804ecbdca16";
//        $my_url     = "http://victoriasu.mtacloud.co.il/Alma/pages/music";
//
//        session_start();
//        $code = $_REQUEST["code"];
//
//        if(empty($code)){
//                $_SESSION['state'] = md5(uniqid(rand(), TRUE)); //CSRF protection
//
//                $dialog_url = "https://connect.deezer.com/oauth/auth.php?app_id=".$app_id
//                        ."&redirect_uri=".urlencode($my_url)."&perms=email,offline_access"
//                        ."&state=". $_SESSION['state'];
//
//                header("Location: ".$dialog_url);
//                exit;
//
//                }
//
//        if($_REQUEST['state'] == $_SESSION['state']) {
//                $token_url = "https://connect.deezer.com/oauth/access_token.php?app_id="
//                .$app_id."&secret="
//                .$app_secret."&code=".$code;
//
//                $response  = file_get_contents($token_url);
//                $params    = null;
//                parse_str($response, $params);
//                $api_url   = "https://api.deezer.com/user/me?access_token="
//                                .$params['access_token'];
//
//                $user = json_decode(file_get_contents($api_url));
//               
//        }
//    session_encode();
//    }

        
        

}

?>
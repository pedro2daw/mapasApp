<?php
    class Security extends CI_Controller {
            public function __construct(){
                parent::__construct();
                $this->load->model('modelUser');
                $this->load->model('modelMapas');
                $this->load->model('modelCalles');
            }
            
            public function security_check()
            {
                if (!isset($this->session->loguedIn)){
                    //echo("<script>alert('No tienes permiso para acceder a este sitio');</script>");
                    $data['viewName'] = 'login';
                    $this->load->view('template', $data);
                    return false;
                }else{
                    return true;
                }
            }
    
            public function createSession() {
                $sessionLogued = array('loguedIn' => TRUE);
                $this->session->set_userdata($sessionLogued);

            }
            public function destroySession() {
                $this->session->sess_destroy();

            }
    }
    

?>
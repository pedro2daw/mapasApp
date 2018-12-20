<?php
    class Security extends CI_Controller {
            public function __construct(){
                parent::__construct();
                $this->load->model('modelUser');
                // $this->load->model('');
                //$this->load->model('');
            }
            
            public function security_check()
            {
                if (!isset($this->session->loguedIn)){
                    //echo("<script>alert('No tienes permiso para acceder a este sitio');</script>");
                    $data['nombreVista'] = 'login';
                    $this->load->view('template', $data);
                    return false;
                }else{
                    return true;
                }
            }
    
            public function create_session() {
                $session_logued = array('loguedIn' => TRUE);
                $this->session->set_userdata($session_logued);

            }
            public function destroy_session() {
                $this->session->sess_destroy();

            }
    }
    

?>
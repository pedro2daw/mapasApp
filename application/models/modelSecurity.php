<?php
class modelSecurity extends CI_Model {

    public function create_session() {
        $sessionLogued = array('loguedIn' => TRUE);
        $this->session->set_userdata($sessionLogued);

    }
    
    public function destroy_session() {
        $this->session->sess_destroy();
    }
} // cierra la class modelCalles
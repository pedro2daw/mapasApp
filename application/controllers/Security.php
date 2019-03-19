<?php
    class Security extends CI_Controller {
            public function __construct(){
                parent::__construct();
                $this->load->model('modelUser');
                $this->load->model('modelPaquetes');
                $this->load->model('modelMapas');
                $this->load->model('modelCalles');
                $this->load->model('modelHotspot');
                $this->load->model('modelInheritance');
                
                if (isset($this->session->userdata['loguedIn'])) {
                    
                } else {
                    redirect(base_url("index.php"));
                }
                
            }
    
    }

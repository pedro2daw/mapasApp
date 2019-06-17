<?php
    class Security extends CI_Controller {
            public function __construct(){
                parent::__construct();
                $this->load->model('ModelUser');
                $this->load->model('ModelBackUp');
                $this->load->model('ModelMapas');
                $this->load->model('ModelCalles');
                $this->load->model('ModelHotspot');
                $this->load->model('ModelInheritance');
                
                if (isset($this->session->userdata['loguedIn'])) {
                    
                } else {
                    redirect(base_url("index.php"));
                }
                
            }    
    }

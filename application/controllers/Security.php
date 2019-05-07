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

            public function export_database(){
                $this->load->dbutil();
                $prefs = array(
                    "format" => "zip",
                    "filename" => "backup_data.sql"
                );

                $backup = & $this->dbutil->backup($prefs);
                $db_name = "mapas" . date("Y-m-d-H-i-s") . ".zip";
                $save = base_url()."assets/".$db_name;
                $this->load->helper("file");
                write_file($save, $backup);
                $this->load->helper("download");
                force_download($db_name, $backup);
            }
    
    }

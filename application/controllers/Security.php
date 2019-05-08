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
                $tabla = $this->input->get_post('tablas');
               
                if ($tabla == "todos"){
                
                        $this->load->dbutil();
                        $prefs = array(
                            "format" => "zip",
                            "filename" => "backup_all_data.sql",
                            "tables" => array("mapas","calles","hotspots","mapas_calles","puntos","usuarios")
                        );

                        $backup = & $this->dbutil->backup($prefs);
                        $db_name = "mapas".$json_tablas . date("Y-m-d-H-i-s") . ".zip";
                        $save = base_url()."assets/".$db_name;
                        $this->load->helper("file");
                        write_file($save, $backup);
                        $this->load->helper("download");
                        force_download($db_name, $backup);

                            $data["viewName"] = "back_up";
                            $this->load->view('template', $data);
                }else{
                        $this->load->dbutil();
                            $prefs = array(
                                "format" => "zip",
                                "filename" => "backup_".$tabla.".sql",
                                "tables" => $tabla
                            );
    
                            $backup = & $this->dbutil->backup($prefs);
                            $db_name = "mapas(".$tabla.")". date("Y-m-d-H-i-s") . ".zip";
                            $save = base_url()."assets/".$db_name;
                            $this->load->helper("file");
                            write_file($save, $backup);
                            $this->load->helper("download");
                            force_download($db_name, $backup);
                            
                            $data["viewName"] = "back_up";
                            $this->load->view('template', $data);
                }
                
            }
                

            public function backup(){
                $data["viewName"] = "back_up";
                $this->load->view('template', $data);
            }

            public function import_data(){
                
            }
    
    }

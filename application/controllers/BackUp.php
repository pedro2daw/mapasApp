<?php

include_once('Security.php');

class BackUp extends Security {

    public function export_database(){
        $tabla = $this->input->get_post('tablas');
        $tables_to_array = json_decode($tabla);
        $rutas = array();
        $names =$tabla;
        $rutas = $tables_to_array;
        
                $this->load->dbutil();
                if($rutas[0] == "todos"){
                    $prefs = array(
                        "format" => "zip",
                        "filename" => "mapas(all_data)",
                        "tables" => array("mapas","calles","hotspots","mapas_calles","puntos","usuarios")                
                    );
                }else{
                    $prefs = array(
                        "format" => "zip",
                        "filename" => "mapas(".$names.")",
                        "tables" => $rutas
                    );
                }
                $backup = & $this->dbutil->backup($prefs);
                $db_name = "mapas_back_up". date("Y-m-d-H-i-s") . ".zip";
                $save = base_url()."assets/".$db_name;
                $this->load->helper("file");
                write_file($save, $backup);
                $this->load->helper("download");
                force_download($db_name, $backup);
    }               
        

    public function back_up(){
        $data["viewName"] = "back_up";
        $this->load->view('template', $data);
    }

    public function import_data(){
        
    }
}
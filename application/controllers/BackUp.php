<?php

include_once('Security.php');

class BackUp extends Security {

    public function back_up(){
        if ($this->ModelUser->getNivel($this->session->userdata("id"))  == 2){ 

        $data["viewName"] = "back_up";
        $this->load->view('template', $data);
        } else {
            $data["viewName"] = "error";
            $this->load->view('template', $data);
        }
    }

    public function export_database(){
        if ($this->ModelUser->getNivel($this->session->userdata("id"))  == 2){ 
        $tabla = $this->input->get_post('tablas');
        $tables_to_array = json_decode($tabla);
        $rutas = array();
        $names =$tabla;
        $rutas = $tables_to_array;
        
                $this->load->dbutil();
                if($rutas[0] == "todos"){
                    $prefs = array(
                        "format" => "sql",
                        "filename" => "mapas(all_data)",
                        "tables" => array("mapas","calles","hotspots","mapas_calles","puntos","usuarios"),
                        'add_drop'      => TRUE,       
                        'add_insert'    => TRUE            
                    );
                }else{
                    $prefs = array(
                        "format" => "sql",
                        "filename" => "mapas(".$names.")",
                        "tables" => $rutas,
                        'add_drop'      => TRUE,       
                        'add_insert'    => TRUE
                    );
                }
                $backup = & $this->dbutil->backup($prefs);
                $db_name = "mapas_back_up". date("Y-m-d-H-i-s") . ".sql";
                $save = base_url()."assets/".$db_name;
                $this->load->helper("file");
                write_file($save, $backup);
                $this->load->helper("download");
                force_download($db_name, $backup);
            } else {
                $data["viewName"] = "error";
                $this->load->view('template', $data);
            }
    }

    public function backup_assets(){
        if ($this->ModelUser->getNivel($this->session->userdata("id"))  == 2){
        $this->ModelBackUp->backupAssets();
    } else {
        $data["viewName"] = "error";
        $this->load->view('template', $data);
    }
    }
        
    public function restore_assets(){
        if ($this->ModelUser->getNivel($this->session->userdata("id"))  == 2){
        if($this->ModelBackUp->restoreAssets()){
            echo "<script>alert('Sql restaurados con exito')</script>";
        }else{
            echo "<script>alert('Error al restaurar sql')</script>";
        }
    } else {
        $data["viewName"] = "error";
        $this->load->view('template', $data);
    }
    }
    

    public function import_data(){
        if ($this->ModelUser->getNivel($this->session->userdata("id"))  == 2){
        if($this->ModelBackUp->restoreSql()){
            echo "<script>alert('Sql restaurados con exito')</script>";
        }else{
            echo "<script>alert('Error al restaurar sql')</script>";
        }
        redirect('BackUp/back_up');
     } else {
        $data["viewName"] = "error";
        $this->load->view('template', $data);
    }
    }
}
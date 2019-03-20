<?php

include_once('Security.php');

class inheritance extends Security {
    
    public function inherit_streets() {
        $Data = json_decode($this->input->get_post("jsonOculto"), true);
        $numero = array();
            
        foreach ($Data as $fila) {
            if ($fila["caso"] == 1) {
                $this->modelInheritance->insert_streets_1($fila["id_mapa"], $fila["id"]);
            }
            
            if ($fila["caso"] == 2) {
                $this->modelInheritance->insert_streets_2($fila["id_mapa"], $fila["nombre"], $fila["tipo"], $fila["id"]);
            }
            
            if ($fila["caso"] == 3) {
            }
        }
        
        $data["msg"] = "0";
        $data['ListaMapas'] = $this->modelMapas->get_all_ordenados();
        $data["viewName"] = "admin_panel";
        $this->load->view('template',$data);
    }
        
}
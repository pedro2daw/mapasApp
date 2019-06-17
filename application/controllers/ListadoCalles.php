<?php

include_once('Security.php');

class ListadoCalles extends Security {
    
    public function get_listado(){
        $this->load->model('ModelCalles');
        
        $data["mapas_calles"] = $this->ModelCalles->get_mapas_calles();
        
        $data["viewName"] = "listado_calles";
        $this->load->view('template', $data);
        
    }
    
}

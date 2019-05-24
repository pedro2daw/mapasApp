<?php

include_once('Security.php');

class ListadoCalles extends Security {
    
    public function get_listado(){
        $this->load->model('modelMapas');
        $this->load->model('modelCalles');
        
        
        
        $data["viewName"] = "listado_calles";
        $this->load->view('template', $data);
    }
    
}

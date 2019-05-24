<?php

include_once('Security.php');

class ListadoCalles extends Security {
    
    public function get_listado(){
        $data["viewName"] = "listado_calles";
        $this->load->view('template',$data);
    }
}

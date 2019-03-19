<?php

include_once('Security.php');

class inheritance extends Security {
    
    public function inherit_streets() {
        $Data = $this->input->get_post("jsonOculto");
        
        $data["listaCalles"] = var_dump($Data);
        $data['viewName'] = "prueba";
        $this->load->view('template', $data);
    }
        
}

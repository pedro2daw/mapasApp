<?php

include_once('Security.php');

class Csv extends Security {
    
    public function index() {
        $data["viewName"] = "importar_calles";
        $this->load->view('template',$data);
    }

    public function upload_file(){
    $calle = basename($this->input->post('csv'));
    $data = fopen($calle, "r");

    echo json_encode($data);
    }
        
}
<?php

class Front extends CI_Controller{
    
    public function index(){
        $this->load->model('modelHotspot');
        $data['ListaHotspots'] = $this->modelHotspot->get_all("9");
        $this->load->view("index.php", $data);
    }
}
<?php

class Front extends CI_Controller{
    
    public function index(){
        $this->load->model('modelHotspot');
        $this->load->model('modelMapas');
        $data['ListaMapas'] = $this->modelMapas->get_all();
        $data['ListaHotspots'] = $this->modelHotspot->get_all('9');
        $this->load->view("index.php", $data);
    }
    
    public function get_all_hotspots($id_mapa) {
        $data['ListaHotspots'] = $this->modelHotspot->get_all($id_mapa);
        $data['viewName'] = "admin_hotspots";
        $this->load->view('template', $data);
    }
}
<?php

class Front extends CI_Controller{
    
    public function index(){
        $this->load->model('modelHotspot');
        $this->load->model('modelMapas');
        $id =$this->modelMapas->get_id_first_map();
        $data['ListaMapas'] = $this->modelMapas->get_all();
        $data['ListaHotspots'] = $this->modelHotspot->get_all($id);
        $this->load->view("index.php", $data);
    }
    
    public function get_all_hotspots($id_mapa) {
        $this->load->model('modelHotspot');
        $puntos = $this->modelHotspot->get_all($id_mapa);
        echo json_encode($puntos);
    }
}
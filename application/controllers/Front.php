<?php

class Front extends CI_Controller{
    
    public function index(){
        $this->load->model('modelHotspot');
        $this->load->model('modelMapas');
        $this->load->model('modelCalles');
        $id =$this->modelMapas->get_id_first_map();
        $data["img_mapas"] = $this->modelCalles->get_maps_img();
        $data["listaCalles"] = $this->modelCalles->get_all_calles_activadas();
        $data['listaMapas'] = $this->modelMapas->get_all();
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
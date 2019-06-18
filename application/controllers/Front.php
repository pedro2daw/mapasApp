<?php

class Front extends CI_Controller {
    
    public function index() {
        $this->load->model('ModelHotspot');
        $this->load->model('ModelMapas');
        $this->load->model('ModelCalles');
        $id = $this->ModelMapas->get_id_first_map();
        $data["img_mapas"] = $this->ModelCalles->get_maps_img();
        $data["listaCalles"] = $this->ModelCalles->get_all_calles_activadas();
        $data['listaMapas'] = $this->ModelMapas->get_all();
        $data['ListaMapas'] = $this->ModelMapas->get_all();
        $data['ListaHotspots'] = $this->ModelHotspot->get_all($id);
        $this->load->view("index.php", $data);
    }
    
    public function get_all_hotspots($id_mapa) {
        $this->load->model('ModelHotspot');
        $puntos = $this->ModelHotspot->get_all($id_mapa);
        echo json_encode($puntos);
    }
    
    public function get_streets_associated_to_coord($x,$y) {
        $this->load->model('ModelCalles');
        //$y = $this->input->post('y');
        //$x = $this->input->post('x');
        $data = $this->ModelCalles->get_streets_associated_to_coord($x,$y);
        $data['msg'] = '0';
        echo json_encode($data);
    }
}

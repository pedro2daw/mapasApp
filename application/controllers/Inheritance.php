<?php

include_once('Security.php');

class inheritance extends Security {
    
    public function view_inheritance($id_mapa, $imgUrl) {
        $url = base64_decode(urldecode($imgUrl));
        $data['id_mapa'] = $id_mapa;
        $data['urlImg'] = $url;
        $data['ListaHotspots'] = $this->modelHotspot->get_all($id_mapa);
        $data['viewName'] = "admin_hotspots";
        $this->load->view('template', $data);
    }
    
    public function select_maps() {
        $data['ListaMapas'] = $this->modelHotspot->get_mapas();
        $data["viewName"] = "select_map";
        $this->load->view('template', $data);
    }

    public function insert_hotspot() {
        $config['upload_path'] = "./assets/img/img_hotspots";
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $this->load->library('upload', $config);
        
        $this->upload->do_upload('imagen');
        
        //if (!$this->upload->do_upload('imagen')) {
        //    echo $this->upload->display_errors();
        //} else {
        //}
        
        /*if (($data['upload_data']['image_width'] > 100) && (($data['upload_data']['image_height'] > 70))) {
            $config['image_library'] = 'gd2';
            $config['source_image'] = base_url("/assets/img/img_hotspots" . $this->input->get_post('imagen'));
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 100;
            $config['height'] = 70;

            $this->load->library('image_lib', $config);

            $this->image_lib->resize();  
        }*/
        
        $id = $this->input->get_post('hsId');
        $titulo = $this->input->get_post('titulo');
        $descripcion = $this->input->get_post('descripcion');
        $pos_x = $this->input->get_post('posX');
        $pos_y = $this->input->get_post('posY');
        $imagen = $this->upload->data('file_name');
        $id_mapa = $this->input->get_post('mapId');
        $this->modelHotspot->insert($id, $imagen, $titulo, $descripcion, $pos_x, $pos_y, $id_mapa);
    }
    
    public function delete_hotspot() {
        $id_mapa = $this->input->get_post('id_mapa');
        $id = $this->input->get_post('id');
        $r = $this->modelHotspot->delete($id, $id_mapa);
    }
}
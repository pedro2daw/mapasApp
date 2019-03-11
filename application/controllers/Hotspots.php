<?php

include_once('Security.php');

class Hotspots extends Security {
    
    public function view_hotspots() {
        $data['ListaHotspots'] = $this->modelHotspot->get_all();
        $data["viewName"] = "admin_hotspots";
        $this->load->view('template', $data);
    }

    public function insert_hotspot() {
        $config['upload_path'] = "./assets/img/img_hotspots";
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $this->load->library('upload', $config);
        
        //if (!$this->upload->do_upload('imagen')) {
        //    echo $this->upload->display_errors();
        //} else {
            $this->upload->do_upload('imagen');
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
        $titulo = $this->input->get_post('titulo');
        $descripcion = $this->input->get_post('descripcion');
        $pos_x = $this->input->get_post('posX');
        $pos_y = $this->input->get_post('posY');
        $imagen = $this->upload->data('file_name');
        $id_mapa = 0;
        $this->modelHotspot->insert($imagen, $titulo, $descripcion, $pos_x, $pos_y, $id_mapa);
    }
    
    public function delete_hotspot() {
        $id = $this->input->get_post('id');
        $r = $this->modelHotspot->delete($id);
    }
}

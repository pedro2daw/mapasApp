<?php

include_once('Security.php');

class Hotspots extends Security {
    
    public function view_hotspots() {
        $data['ListaHotspots'] = $this->modelHotspot->get_all();
        $data["viewName"] = "admin_hotspots";
        $this->load->view('template', $data);
    }

    public function insert_hotspot() {
        $config['upload_path'] = base_url("assets/img/laminas/");
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload("imagen")) {
            $data = array('upload_data' => $this->upload->data());
            $data1 = array(
                'titulo' => $this->input->get_post('titulo'),
                'descripcion' => $this->input->get_post('descripcion'),
                'pos_x' => $this->input->get_post('posX'),
                'pos_y' => $this->input->get_post('posY'),
                'imagen' => $data['upload_data']['file_name'],
                'id_mapa' => 0
            );
            $result = $this->modelHotspot->insert($data1);
            if ($result == TRUE) {
                echo "true";
            }
        }
        echo "MAL";
        /*
        $imagen = $this->input->get_post('imagen');
        $config['upload_path'] = base_url("/assets/img/laminas/");
        $config['allowed_types'] = 'jpg|png';
        $this->load->library('upload' ,$config);
        $this->upload->do_upload('imagen');
        $foto = base_url("/assets/img/laminas/") . $this->upload->data('file_name');
        if (($this->upload->data('image_width') > 100) && (($this->upload->data('image_heigth') > 70))) {
            $config['image_library'] = 'gd2';
            $config['source_image'] = $foto;
            $config['create_thumb'] = FALSE;
            $config['maintain_ratio'] = TRUE;
            $config['width'] = 100;
            $config['height'] = 70;

            $this->load->library('image_lib', $config);

            $this->image_lib->resize();  
        }
        $titulo = $this->input->get_post('titulo');
        $descripcion = $this->input->get_post('descripcion');
        $punto_x = $this->input->get_post('punto_x');
        $punto_y = $this->input->get_post('punto_y');*/
    
    }
    
    public function delete_hotspot() {
        $id = $this->input->get_post('id');
        $r = $this->modelHotspot->delete($id);
    }
}

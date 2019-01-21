<?php
class modelMapas extends CI_Model {

    function insert ($titulo, $descripcion, $ciudad, $fecha,$img,$nivel,$ancho,$alto){
        $query = $this->db->query("INSERT INTO mapas VALUES (null,'$titulo','$descripcion','$ciudad','$fecha','$img','$nivel','$ancho','$alto');");
     return $this->db->affected_rows();
    }

    public function checkImg(){
        $config['upload_path'] = './assets/img';
        $config['allowed_types'] = 'jpg|png';
        $config['max_size']     = 1000000;
        $config['max_width'] = 1024000;
        $config['max_height'] = 768000;

        $img_name = false;

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('mapa_img')){
            echo $this->upload->display_errors();
        }else{
            $img_name = $this->upload->data('file_name'); 
        }
        return $img_name;
    }

}
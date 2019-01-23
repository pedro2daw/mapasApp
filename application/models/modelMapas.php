<?php
class modelMapas extends CI_Model {
    // $titulo, $descripcion, $ciudad, $fecha,$img,$nivel,$ancho,$alto

    function insert ($titulo, $descripcion, $ciudad, $fecha, $ruta){
        /*
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            titulo VARCHAR(150) NOT NULL,
            descripcion VARCHAR(250) NOT NULL,
            ciudad VARCHAR(50) NOT NULL,
            fecha SMALLINT NOT NULL,
            imagen VARCHAR(250) NOT NULL,

            nivel SMALLINT NOT NULL,
            ancho TINYINT NOT NULL,
            altura TINYINT NOT NULL
    */
        
        $query = $this->db->query("INSERT INTO mapas (id, titulo, descripcion, ciudad, fecha, imagen) VALUES (null,'$titulo','$descripcion','$ciudad','$fecha','$ruta');"); 
        return $this->db->affected_rows();
    }

    function insert_size($ancho, $alto,$id){
        $query = $this->db->query("UPDATE mapas SET ancho='$ancho', altura='$alto' WHERE id='$id';");
        return $this->db->affected_rows();
    }

    function get_last(){
        $query = $this->db->query("SELECT id FROM mapas order by id desc limit 1");
        $row = $query->row();
       
        if (isset($row)){
         $data = $row->id;       
        }
     return $data;
    }

    function get_img_size ($img_name){
        // list($width, $height, $type, $attr) = getimagesize("$img_name");
        $data = getimagesize($img_name);
        //$arr = array('height' => $height, 'width' => $width);
        return $data;
    }

    public function checkImg($id,$ciudad){
        $config['upload_path'] = './assets/img/mapas/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size']     = 9999999;
        $config['max_width'] = 999999;
        $config['max_height'] = 9999999;
        $config['file_name'] = $id.'_'.$ciudad;
    
        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('img_mapa')){
            echo $this->upload->display_errors();
            $img_name = false;
        }else{
            $img_name = $this->upload->data('file_name'); 
        }
        return $img_name;
    }

}
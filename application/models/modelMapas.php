<?php
class modelMapas extends CI_Model {
    // $titulo, $descripcion, $ciudad, $fecha,$img,$nivel,$ancho,$alto

    function get_all(){
        $query = $this->db->query("SELECT mapas.id as id, mapas.titulo, mapas.descripcion, mapas.ciudad, mapas.fecha, mapas.imagen, paquetes.nombre, mapas.id_paquete as 'id_paquete', paquetes.id as 'id_tpaquetes' from mapas INNER JOIN paquetes ON mapas.id_paquete = paquetes.id"); 
        $data = array();
            if ($query->num_rows() > 0){
                foreach ($query->result_array() as $row){
                    $data[] = $row;
                }
            }
        return $data;
    }

    function get_paquete($id){
        $query = $this->db->query("SELECT paquetes.nombre, paquetes.id FROM mapas INNER JOIN paquetes ON mapas.id_paquete = paquetes.id"); 
        $data = $query->result_array();
        return array_column($data,'nombre','id');
    }


    function insert ($titulo, $descripcion, $ciudad, $fecha, $ruta, $id_paquete){
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
        
        $query = $this->db->query("INSERT INTO mapas (id, titulo, descripcion, ciudad, fecha, imagen, id_paquete,fecha_subida) VALUES (null,'$titulo','$descripcion','$ciudad','$fecha','$ruta','$id_paquete',NOW());"); 
        return $this->db->affected_rows();
    }

    /*
    function mapas_paquetes ($id){        
        $query = $this->db->query("SELECT id, id_paquete from mapas WHERE id_paquete = $id;"); 
        
    } */

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

    function format ($string){
        $unwanted_array = array('Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
                            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
                            'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
                            'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
                            'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y');

        //Convierte caracteres y los reemplaza
        $str = strtolower(strtr( $string, $unwanted_array));
        return $str;
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
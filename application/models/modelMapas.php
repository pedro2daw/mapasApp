<?php
class ModelMapas extends CI_Model {
    // $titulo, $descripcion, $ciudad, $fecha,$img,$nivel,$ancho,$alto

    function get_all(){
        $query = $this->db->query("SELECT mapas.id as id, mapas.titulo, mapas.ciudad, mapas.fecha, mapas.imagen, mapas.ancho as 'ancho', mapas.altura as 'alto', mapas.desviacion_x as desviacion_x, mapas.desviacion_y as desviacion_y from mapas "); 
        $data = array();
            if ($query->num_rows() > 0){
                foreach ($query->result_array() as $row){
                    $data[] = $row;
                }
            }
        return $data;
    }

    function get_all_ordenados(){
        $query = $this->db->query("SELECT mapas.id as id, mapas.titulo, mapas.ciudad, mapas.fecha, mapas.imagen, mapas.ancho as 'ancho', mapas.altura as 'alto', mapas.desviacion_x as desviacion_x, mapas.desviacion_y as desviacion_y, mapas.principal as principal from mapas ORDER BY ancho DESC ,altura;"); 
        $data = array();
            if ($query->num_rows() > 0){
                foreach ($query->result_array() as $row){
                    $data[] = $row;
                }
            }
        return $data;
    }
/*
    function get_paquete($id){
        $query = $this->db->query("SELECT paquetes.nombre, paquetes.id FROM mapas INNER JOIN paquetes ON mapas.id_paquete = paquetes.id"); 
        $data = $query->result_array();
        return array_column($data,'nombre','id');
    }
*/
    function insert ($titulo, $fecha, $ruta){
        // 0 ES ERROR
        $valid = 0;
        $this->db->trans_start();
        $query = $this->db->query("INSERT INTO mapas (id, titulo, fecha, imagen, fecha_de_subida) VALUES (null,'$titulo','$fecha','$ruta',NOW());"); 

        if ($this->db->trans_status() === FALSE || $ruta == false){
            $this->db->trans_rollback();
            var_dump($titulo, $fecha, $ruta);

                    $query = $this->db->query("INSERwwwwT INTO mapas (id, titulo, fecha, imagen, fecha_de_subida) VALUES (null,'$titulo','$fecha','$ruta',NOW());"); 

        } else {
            $valid = 1;
            $this->db->trans_commit();
        }
        $this->db->trans_complete();

        return $valid;
    }

    /*
    function mapas_paquetes ($id){        
        $query = $this->db->query("SELECT id, id_paquete from mapas WHERE id_paquete = $id;"); 
        
    } */

    function insert_size($ancho, $alto,$id){
        $query = $this->db->query("UPDATE mapas SET ancho='$ancho', altura='$alto' WHERE id='$id';");
        return $this->db->affected_rows();
    }

    
    function update($id, $titulo, $fecha, $ruta, $ancho, $alto, $x , $y, $opc){
        
        // SI HAY IMAGEN nueva TIENE QUE BORRAR la antigua y las desviaciones:
        $status = 0;
        $this->db->trans_start();
        if ($opc == true){
            $query2 = $this->db->query("SELECT imagen from mapas WHERE id = '$id';");
            $fileToDelete = implode($query2->result_array()[0]);
            unlink($fileToDelete);
            $x = 'null';
            $y = 'null';
        }
        $query = $this->db->query("DELETE FROM mapas WHERE id = '$id';"); 
        $query = $this->db->query("INSERT INTO mapas (id, titulo, fecha, imagen, fecha_de_subida, ancho, altura, desviacion_x, desviacion_y) VALUES ($id,'$titulo','$fecha','$ruta',NOW(),'$ancho','$alto',$x,$y);"); 
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        } else {
            $status = 1 ;
        }
        return $status;
    }

    function delete($id){
        $query2 = $this->db->query("SELECT imagen from mapas WHERE id = '$id';");
        $fileToDelete = implode($query2->result_array()[0]);
        unlink($fileToDelete);
        
        $query = $this->db->query("DELETE FROM mapas WHERE id = '$id';"); 
        return $this->db->affected_rows();
    }


    function get_next_id(){
        $query = $this->db->query("SHOW TABLE STATUS LIKE 'mapas';");
        $next_auto_increment = $query->result_array()[0]['Auto_increment'];

     return $next_auto_increment;
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
            // echo $this->upload->display_errors();
            $img_name = false;
        }else{
            $img_name = $this->upload->data('file_name'); 
        }
        return $img_name;
    }

    public function update_img($id,$ciudad){
        $config['upload_path'] = './assets/img/mapas/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size']     = 9999999;
        $config['max_width'] = 999999;
        $config['max_height'] = 9999999;
        $config['file_name'] = $id.'_'.$ciudad;
    
        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('upd_img')){
            echo $this->upload->display_errors();
            $img_name = false;
        }else{
            $img_name = $this->upload->data('file_name'); 
        }
        return $img_name;
    }

    public function checkImgDefault(){
        $config['upload_path'] = './assets/img/mapas/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size']     = 9999999;
        $config['max_width'] = 999999;
        $config['max_height'] = 9999999;
        

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('upd_img')){
            // echo $this->upload->display_errors();
            $img_name = false;
        }else{
            $img_name = $this->upload->data('file_name'); 
        }
        return $img_name;
    }

    public function superponer($desv_x,$desv_y,$rutas){

        $length_array = count($rutas);

        

        for ($i = 0; $i < $length_array; $i++){
            $rutas_insert = ($rutas[$i]["imagen"]);
            $this->db->query("UPDATE mapas
                                SET desviacion_x = $desv_x[$i],
                                    desviacion_y = $desv_y[$i]
                                WHERE imagen = '$rutas_insert';
            ");
        }
        return $this->db->affected_rows();
    }

    public function update_principal($id_principal){
        $this->db->query("UPDATE mapas SET principal = false");

        $update = $this->db->query("UPDATE mapas SET principal = true, desviacion_x = null, desviacion_y = null WHERE id = $id_principal");

    }
    
    public function get_id_first_map() {
        $query = $this->db->query("SELECT id FROM mapas ORDER BY id ASC ");
        $id;
        if (!is_null($query->row())) {
            $first = $query->row();
            $id = $first->id;
        } else {
            $id = false;
        };
        
        return $id;
    }
    
    public function get_maps_aux() { 
        $mapas_aux = $this->db->query("SELECT imagen, titulo FROM mapas WHERE principal = false ORDER BY ancho DESC ,altura");
        return $mapas_aux->result_array(); 
    } 
    
    public function get_mapa_main() { 
        $mapa_main = $this->db->query("SELECT imagen, titulo FROM mapas WHERE principal = true"); 
        return $mapa_main->result_array();    
    }

}
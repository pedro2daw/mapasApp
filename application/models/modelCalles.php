<?php
class modelCalles extends CI_Model {

    public function get_all(){
        $query = $this->db->query("SELECT * FROM calles");
        $data = array();
            if ($query->num_rows() > 0){
                foreach ($query->result_array() as $row){
                    $data[] = $row;
                }
            }
        return $data;
    }
    public function get_maps(){
        $query = $this->db->query("SELECT id AS id_mapa,titulo FROM mapas");

        $data = array();
        if ($query->num_rows() > 0){
            foreach($query->result_array() as $row){
                $data[] = $row;
            }
        }
        return array_column($data,'titulo','id_mapa');
    }

    public function get_img($id){

        $ruta = $this->db->query("SELECT imagen FROM mapas WHERE id = $id");

        return $ruta->result_array()[0];
    }

    public function insert_street($calle_nueva){
        var_dump($calle_nueva);
        for($i = 0; $i < count($calle_nueva) ; $i++){
            $nombre = $calle_nueva[$i]['nombre'];
            $tipo = $calle_nueva[$i]['via'];

            $this->db->query("INSERT INTO calles (id,nombre,tipo)
                        VALUES (null,'$nombre','$tipo');");
        }
        
        return $this->db->affected_rows();
    }

    public function update_street($id,$nombre,$tipo){
        $this->db->query("DELETE FROM calles WHERE id = '$id';");
        $this->db->query("INSERT INTO calles (id,nombre,tipo) VALUES ('$id','$nombre','$tipo');");
        return $this->db->affected_rows();
    }
    public function delete_street($id){
        $this->db->query("DELETE FROM calles WHERE id = '$id';");
        return $this->db->affected_rows();
    }


    public function get_last (){       
        $query = $this->db->query("SELECT * FROM calles ORDER BY id DESC limit 1");
        return $query->result_array()[0];
    }

    public function get($id){       
        $query = $this->db->query("SELECT * FROM calles WHERE id = '$id';");
        return $query->result_array()[0];
    }

    public function insert_coords($x,$y,$id_calle,$mapas_selected,$mapas_unselected){
        // si no es null:
        if (isset($mapas_selected)){
        for($i = 0; $i < count($mapas_selected) ; $i++){
            $mapa = $mapas_selected[$i];
            $this->db->query("INSERT INTO mapas_calles VALUES($mapa,null, '$id_calle');");
        }
        $this->db->query("INSERT INTO puntos VALUES (null,$x,$y,$id_calle)");
         return $this->db->affected_rows();
        }

        // si no es null:
        if (isset($mapas_unselected)){
            $length = count($mapas_unselected);
            $query = $this->db->query("SELECT * FROM (SELECT * from calles order by id desc limit $length) alias order by id asc;");
            $id_calles_renombradas = array();
            if ($query->num_rows() > 0){
                foreach ($query->result_array() as $row){
                    $id_calles_renombradas[] = $row;
                }
            }
            for($i = 0; $i < count($mapas_unselected) ; $i++){
                $mapa = $mapas_unselected[$i];
                var_dump($mapa);
                $id_calle = $id_calles_renombradas[$i]['id'];
                $this->db->query("INSERT INTO mapas_calles VALUES($mapa,null, '$id_calle');");
                $this->db->query("INSERT INTO puntos VALUES(null,$x,$y,$id_calle)");
                return $this->db->affected_rows();
            }
        }
        return $this->db->affected_rows();
    }

    public function get_next_id(){
        $get_status = $this->db->query("SHOW TABLE STATUS LIKE 'calles';");
        $next_auto_increment = $get_status->result_array()[0]['Auto_increment'];
        return $next_auto_increment;
    }

    public function get_maps_img(){
        $mapas = $this->db->query("SELECT id, titulo, imagen, desviacion_x, desviacion_y FROM mapas ORDER BY ancho DESC ,altura");
        return $mapas->result_array();
    }
} // cierra la class modelCalles
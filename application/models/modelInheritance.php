<?php 
class modelInheritance extends CI_Model{

    public function get_calles_mapa($nombre_mapa) {
        $id_mapa = $this->db->select("id")->from("mapas")->where("titulo", $nombre_mapa)->order_by("id","desc")->limit(1)->get()->row("id");
        
        $query = $this->db->query("SELECT id_calle FROM mapas_calles WHERE id_map = '$id_mapa';");
        $id_calles = array();
        if ($query->num_rows() > 0){
            foreach ($query->result_array() as $row){
                $id_calles[] = $row;
            }
        }
        
        $data = array();
        foreach ($id_calles as $calles) {
            $query = $this->db->select("*")->from("calles")->where("id", $calles["id_calle"])->get();
            foreach ($query->result_array() as $row) {
                $data[] = $row;
            }
        }
        
        return $data;
    }
    
    public function insert_streets_1($id_mapa, $id_calle) {
        $query = $this->db->query("INSERT INTO mapas_calles (id_map, id_calle) VALUES ('$id_mapa', '$id_calle');");
        return $this->db->affected_rows();
    }
    
    public function insert_streets_2($id_mapa, $nombre, $tipo, $id_calle) {
        //Sacar coordenadas punto de la calle antigua (puntos)
        $query = $this->db->query("SELECT punto_x, punto_y FROM puntos WHERE id_calle = '$id_calle';");
        $data = array();
        foreach ($query->result_array() as $row) {
                $data[] = $row;
        }
        
        //Insertar calle nueva (calles)
        $this->db->query("INSERT INTO calles (nombre, tipo) VALUES ('$nombre', '$tipo');");
        
        //Sacar id de la calle nueva (calles)
        $insertId = $this->db->insert_id();
        
        //Insertar nuevo punto con la calle nueva, mismas coordenadas (puntos)
        $punto_x = $data[0]["punto_x"];
        $punto_y = $data[0]["punto_y"];
        $this->db->query("INSERT INTO puntos (punto_x, punto_y, id_calle) VALUES ('$punto_x', '$punto_y', '$insertId');");
        
        //Insertar relacion calle nueva y id mapa nuevo (mapas_calles)
        $this->db->query("INSERT INTO mapas_calles (id_map, id_calle) VALUES ('$id_mapa', '$insertId');");
    }
    
} // cierra class modelUser

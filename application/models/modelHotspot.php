<?php 
class modelHotspot extends CI_Model{
    
    public function get_all() {
        $query = $this->db->query("SELECT * FROM hotspots;"); 
        $data = array();
            if ($query->num_rows() > 0){
                foreach ($query->result_array() as $row){
                    $data[] = $row;
                }
            }
        return $data;
    }
    
    public function insert($data) {
        $imagen = $data["imagen"];
        $titulo = $data["titulo"];
        $descripcion = $data["descripcion"];
        $punto_x = $data["pos_x"];
        $punto_y = $data["pos_y"];
        $id_mapa = 0;
        $query = $this->db->query("INSERT INTO hotspots (imagen, titulo, descripcion, punto_x, punto_y, id_mapa) VALUES ('$imagen', '$titulo', '$descripcion', '$punto_x', '$punto_y', '$id_mapa');");
        return $this->db->affected_rows();
    }
    
    public function delete($id) {
        $query = $this->db->query("DELETE FROM hotspots WHERE id = $id;");
        return $this->db->affected_rows();
    }
    
} // cierra class modelUser

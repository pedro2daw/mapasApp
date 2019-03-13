<?php
class modelHotspot extends CI_Model {
    
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
    
    public function insert($imagen, $titulo, $descripcion, $punto_x, $punto_y, $id_mapa) {
        $id = $this->get_last_id() + 1;
        $query = $this->db->query("INSERT INTO hotspots (id, imagen, titulo, descripcion, punto_x, punto_y, id_mapa) VALUES ('$id', '$imagen', '$titulo', '$descripcion', '$punto_x', '$punto_y', '$id_mapa');");
        return $this->db->affected_rows();
    }
    
    public function delete($id) {
        $query = $this->db->query("DELETE FROM hotspots WHERE id = $id;");
        return $this->db->affected_rows();
    }
    
    public function get_last_id() {
        $query = $this->db->query("SELECT id FROM hotspots;"); 
        $row = $query->last_row();
        return $row->id;
    }
    
} // cierra class modelUser

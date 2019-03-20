<?php
class modelHotspot extends CI_Model {
    
    public function get_all($id_mapa) {
        $query = $this->db->query("SELECT * FROM hotspots WHERE id_mapa = $id_mapa;"); 
        $data = array();
            if ($query->num_rows() > 0){
                foreach ($query->result_array() as $row){
                    $data[] = $row;
                }
            }
        return $data;
    }
    
    public function get_mapas() {
        $query = $this->db->query("SELECT id, titulo, imagen FROM mapas;");
        $data = array();
            if ($query->num_rows() > 0){
                foreach ($query->result_array() as $row){
                    $data[] = $row;
                }
            }
        return $data;
    }
    
    public function insert($id, $imagen, $titulo, $descripcion, $punto_x, $punto_y, $id_mapa) {
        $query = $this->db->query("INSERT INTO hotspots (id, imagen, titulo, descripcion, punto_x, punto_y, id_mapa) VALUES ('$id', '$imagen', '$titulo', '$descripcion', '$punto_x', '$punto_y', '$id_mapa');");
        return $this->db->affected_rows();
    }
    
    public function delete($id, $id_mapa) {
        $query2 = $this->db->query("SELECT imagen FROM hotspots WHERE id = '$id' AND id_mapa = '$id_mapa';");    
        
        $fileToDelete = implode($query2->result_array()[0]);
        unlink("./assets/img/img_hotspots/" . $fileToDelete);
        
        $query = $this->db->query("DELETE FROM hotspots WHERE id = $id AND id_mapa = $id_mapa;");
        
        return $this->db->affected_rows();
    }
    
    public function get_nombre_mapa($id) {
        $query = $this->db->query("SELECT titulo FROM mapas WHERE id = '$id';");
        $row = $query->last_row();
        
        return $row->titulo;
    }
    
} // cierra class modelUser

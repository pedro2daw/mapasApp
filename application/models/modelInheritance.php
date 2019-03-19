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
    
    public function insert_streets() {
        
    }
    
} // cierra class modelUser

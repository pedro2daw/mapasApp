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
    public function get_slides(){
        $query = $this->db->query("SELECT id AS id_slide,nombre FROM laminas");

        $data = array();
        if ($query->num_rows() > 0){
            foreach($query->result_array() as $row){
                $data[] = $row;
            }
        }
        return array_column($data,'nombre','id_slide');
    }
} // cierra la class modelCalles
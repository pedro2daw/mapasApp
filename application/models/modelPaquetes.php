<?php
class modelPaquetes extends CI_Model {
    
    function get_all(){
        $query = $this->db->query("SELECT * FROM paquetes;"); 
        $data = array();
            if ($query->num_rows() > 0){
                foreach ($query->result_array() as $row){
                    $data[] = $row;
                }
            }
        return $data;
    }

    function get_name() {
        $query = $this->db->query("SELECT id,nombre FROM paquetes;"); 
        $data = array();
            if ($query->num_rows() > 0){
                foreach ($query->result_array() as $row){
                    $data[] = $row;
                }
            }
        
        return array_column($data,'nombre','id');
    }
}
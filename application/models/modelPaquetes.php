<?php
class modelPaquetes extends CI_Model {
    
    function get_all(){
        $query = $this->db->query("SELECT * FROM paquetes ORDER BY fecha_subida DESC;"); 
        $data = array();
            if ($query->num_rows() > 0){
                foreach ($query->result_array() as $row){
                    $data[] = $row;
                }
            }
        return $data;
    }
}
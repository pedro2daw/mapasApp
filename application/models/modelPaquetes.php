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

    function insert ($nombre, $descripcion){
    /*
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(250) NOT NULL,
    fecha_subida DATETIME NOT NULL,
    descripcion VARCHAR(250) NOT NULL
    */
        $query = $this->db->query("INSERT INTO paquetes (id, nombre, descripcion,fecha_subida) VALUES (null,'$nombre','$descripcion',NOW());"); 
        return $this->db->affected_rows();
    }

    function get_last(){
        $query = $this->db->query("SELECT id FROM paquetes order by id desc limit 1");
        $row = $query->row();
       
        if (isset($row)){
         $data = $row->id;       
        }
     return $data;
    }

}
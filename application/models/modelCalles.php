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

    public function insert_street($nombre,$tipo,$aInicio,$aFin,$id_mapa){
        $control_variable = false;
        
        $this->db->query("INSERT INTO calles
                        VALUES (null,'$nombre','$tipo',$aInicio,$aFin,$id_mapa)
        ");
        return $this->db->affected_rows();
    }

    public function insert_coords($xCoord,$yCoord,$next_id_street){
        $length_array = count($xCoord);

        for($i = 0;$i < $length_array;$i++){
            $this->db->query("INSERT INTO puntos 
            VALUES(null,$xCoord[$i],$yCoord[$i],$next_id_street)");
        }
        return $this->db->affected_rows();
    }

    public function get_next_id(){
        $get_status = $this->db->query("SHOW TABLE STATUS LIKE 'calles';");
        $next_auto_increment = $get_status->result_array()[0]['Auto_increment'];
        return $next_auto_increment;
    }

    public function delete_street($id){
        $delete_street = $this->db->query("DELETE FROM calles WHERE id = $id;");
        $delete_coords = $this->db->query("DELETE FROM puntos WHERE id_calle = $id;");

        return $this->db->affected_rows();
    }

    public function get_maps_img(){
        $mapas = $this->db->query("SELECT imagen FROM mapas ORDER BY ancho DESC ,altura");

        return $mapas->result_array();
    }
} // cierra la class modelCalles
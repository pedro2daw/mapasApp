<?php
class modelCalles extends CI_Model {
   // select calles.id as id_calle, calles.nombre as nombre ,calles.tipo as tipo, puntos.id as id_punto, puntos.punto_x as x, puntos.punto_y as y, mapas.id as id_mapa , mapas.titulo as titulo   from calles inner join puntos on calles.id = puntos.id_calle inner join mapas_calles on calles.id = mapas_calles.id_calle inner join mapas on mapas.id = mapas_calles.id_map
    public function get_all(){
        $query = $this->db->query("SELECT calles.id as id, calles.nombre as nombre, calles.tipo as tipo,  puntos.id as id_punto, puntos.punto_x as x, puntos.punto_y as y FROM calles LEFT JOIN puntos on calles.id = id_calle ORDER BY calles.id asc");
        $data = array();
            if ($query->num_rows() > 0){
                foreach ($query->result_array() as $row){
                    $data[] = $row;
                }
            }
        return $data;
    }

    public function update_coord($x, $y, $x_old, $y_old){
        $query = $this->db->query("UPDATE puntos SET punto_x = $x , punto_y = $y WHERE punto_x = $x_old and punto_y = $y_old;");

        return $this->db->affected_rows();
    }
    // Calles que acaban de ser añadidas y aún no están en ningún mapa ni tienen un punto asignado:
    public function get_not_inserted(){
        $query = $this->db->query("SELECT calles.id as id, calles.nombre as nombre, calles.tipo as tipo FROM calles WHERE id NOT IN (select id_calle from puntos);");
        $data = array();
            if ($query->num_rows() > 0){
                foreach ($query->result_array() as $row){
                    $data[] = $row;
                }
            }
        return $data;
    }

    // Calles que acaban de ser añadidas y aún no están en ningún mapa ni tienen un punto asignado:
    public function get_inserted(){
        $query = $this->db->query("SELECT calles.id as id, calles.nombre as nombre, calles.tipo as tipo, puntos.punto_x as x , puntos.punto_y as y FROM calles INNER JOIN puntos on calles.id = id_calle;");
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

    public function insert_street($calle_nueva){
        $this->db->trans_start();
        for($i = 0; $i < count($calle_nueva) ; $i++){
            $nombre = $calle_nueva[$i]['nombre'];
            $tipo = $calle_nueva[$i]['via'];
            $this->db->query("INSERT INTO calles (id,nombre,tipo) VALUES (null,'$nombre','$tipo');");
            $error = $this->db->error();
    
        }
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE)
        {
            var_dump($error);
            
            
            // var_dump('error en la(s) consulta(s)');
            $this->db->trans_rollback();
            $status = 0;
            return $status;
        } else {
            $this->db->trans_commit();
            $status = 1;
            return $status;
        }
        return $status;
    }

    public function update_street($id,$nombre,$tipo){
        $this->db->trans_start();
            $this->db->query("DELETE FROM calles WHERE id = '$id';");
            $this->db->query("INSERT INTO calles (id,nombre,tipo) VALUES ('$id','$nombre','$tipo');");
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
            // var_dump('error en la(s) consulta(s)');

            $this->db->trans_rollback();
            $status = 0;
            return $status;
        } else {
            $this->db->trans_commit();
            $status = 1;
            return $status;
        }
       
    }
    public function delete_street($id){
        $this->db->trans_start();

        $this->db->query("DELETE FROM calles WHERE id = '$id';");
        $this->db->query("DELETE FROM puntos WHERE id_calle = '$id';");
        $this->db->query("DELETE FROM mapas_calles WHERE id_calle = '$id';");

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
            // var_dump('error en la(s) consulta(s)');

            $this->db->trans_rollback();
            $status = 0;
            return $status;
        } else {
            $this->db->trans_commit();
            $status = 1;
            return $status;
        }
    }


    public function get_last (){       
        $query = $this->db->query("SELECT * FROM calles ORDER BY id DESC limit 1");
        return $query->result_array()[0];
    }

    public function get($id){       
        $query = $this->db->query("SELECT calles.id as id,calles.nombre as nombre,calles.tipo as tipo, puntos.punto_x as x, puntos.punto_y as y FROM calles LEFT JOIN mapas_calles on calles.id = mapas_calles.id_calle LEFT join puntos on calles.id = puntos.id_calle where calles.id = '$id';");
        return $query->result_array()[0];
    }

    public function last_inserted_calles($length){
        
        // mas uno para que me traiga la que he añadido mediante el botón también.
        
        for ($i = 0; $i < $length ; $i++){
            $query = $this->db->query("SELECT calles.id as id,calles.nombre as nombre, calles.tipo as tipo, puntos.punto_x as x, puntos.punto_y as y, puntos.id as id_punto FROM calles inner join puntos on calles.id = id_calle order by calles.id desc limit $length ");
        } 
        $id_calles_renombradas = array();
            if ($query->num_rows() > 0){
                foreach ($query->result_array() as $row){
                    $id_calles_renombradas[] = $row;
                }
            }

        return $id_calles_renombradas;
            
    }

    public function insert_coords($x,$y,$id_calle,$mapas_selected,$mapas_unselected){
        $this->db->trans_start();
        if (isset($mapas_selected)){
        for($i = 0; $i < count($mapas_selected) ; $i++){
            $mapa = $mapas_selected[$i];
            $this->db->query("INSERT INTO mapas_calles VALUES($mapa,null, '$id_calle');");
        }
        $this->db->query("INSERT INTO puntos VALUES (null,$x,$y,$id_calle)");
         // return $this->db->affected_rows();
        }

        // si no es null:
        if (isset($mapas_unselected)){
            $length = count($mapas_unselected);
            $query = $this->db->query("SELECT * FROM (SELECT * from calles order by id desc limit $length) alias order by id asc;");
            $id_calles_renombradas = array();
            if ($query->num_rows() > 0){
                foreach ($query->result_array() as $row){
                    $id_calles_renombradas[] = $row;
                }
            }
            for($i = 0; $i < count($mapas_unselected) ; $i++){
                $mapa = $mapas_unselected[$i];
                $id_calle = $id_calles_renombradas[$i]['id'];
                $this->db->query("INSERT INTO mapas_calles VALUES($mapa,null,'$id_calle');");
                $this->db->query("INSERT INTO puntos VALUES(null,$x,$y,$id_calle)");
            }
        }
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
            // var_dump('error en la(s) consulta(s)');

            $this->db->trans_rollback();
            $status = 0;
            return $status;
        } else {
            $this->db->trans_commit();
            $status = 1;
            return $status;
        }
        
    }

    // gets calles asociadas a ese punto y en que mapa
    public function get_streets_associated_to_coord($x,$y){
        $query = $this->db->query("SELECT calles.id as id_calle, calles.nombre as nombre ,calles.tipo as tipo, puntos.id as id_punto, puntos.punto_x as x, puntos.punto_y as y, mapas.id as id_mapa , mapas.titulo as titulo   from calles inner join puntos on calles.id = puntos.id_calle inner join mapas_calles on calles.id = mapas_calles.id_calle inner join mapas on mapas.id = mapas_calles.id_map where puntos.punto_x = $x and puntos.punto_y = $y;");
        $data = array();
            if ($query->num_rows() > 0){
                foreach ($query->result_array() as $row){
                    $data[] = $row;
                }
            }
        return $data;
    }

    public function get_next_id(){
        $get_status = $this->db->query("SHOW TABLE STATUS LIKE 'calles';");
        $next_auto_increment = $get_status->result_array()[0]['Auto_increment'];
        return $next_auto_increment;
    }

    public function get_maps_img(){
        $mapas = $this->db->query("SELECT id, titulo, imagen, desviacion_x, desviacion_y FROM mapas ORDER BY ancho DESC ,altura");
        return $mapas->result_array();
    }
} // cierra la class modelCalles
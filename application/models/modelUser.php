<?php 
class modelUser extends CI_Model{

// ------- COMPRUEBO EL LOGIN CON LOS PARAMETROS DEL CONTROLADOR -------------------- //
    public function checkLogin($name,$pass) {
        $query = $this->db->query("SELECT id FROM usuarios WHERE username='$name' AND passwd='$pass'");

        return $query->num_rows();
    }
// ------- COMPRUEBO EL LOGIN CON LOS PARAMETROS DEL CONTROLADOR -------------------- //
    
    public function get_all() {
        $query = $this->db->query("SELECT id, username, nivel FROM usuarios;"); 
        $data = array();
            if ($query->num_rows() > 0){
                foreach ($query->result_array() as $row){
                    $data[] = $row;
                }
            }
        return $data;
    }
    
    public function get_id($name, $passwd) {
        $query = $this->db->query("SELECT id FROM usuarios WHERE username = '$name'AND passwd = '$passwd';"); 
        foreach ($query->result_array() as $row) {
            $id = $row['id'];
        }
        return $id;
    }
    
    public function insert($usuario, $contrasena, $nivel) {        
        $query = $this->db->query("INSERT INTO usuarios (username, passwd, nivel) VALUES ('$usuario','$contrasena', '$nivel');"); 
        
        return $this->db->affected_rows();
    }
    
    public function update($usuario, $contrasena, $nivel, $id) {
        $query = $this->db->query("UPDATE usuarios SET username = '$usuario', passwd = '$contrasena', nivel = '$nivel' WHERE id = $id;"); 
        
        return $this->db->affected_rows();
    }
    
    public function delete($id) {
        $query = $this->db->query("DELETE FROM usuarios WHERE id = $id;");
        
        return $this->db->affected_rows();
    }

    public function getNivel($id) {
        $query = $this->db->query("SELECT nivel FROM usuarios WHERE id = '$id';"); 
        $nivel = 0;
        foreach ($query->result_array() as $row) {
            $nivel = $row['nivel'];
        }
        
        return $nivel;
    }
    
} // cierra class modelUser
?>

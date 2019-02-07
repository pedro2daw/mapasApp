<?php 
class modelUser extends CI_Model{

// ------- COMPRUEBO EL LOGIN CON LOS PARAMETROS DEL CONTROLADOR -------------------- //
    public function checkLogin($name,$pass){
        $query = $this->db->query("SELECT id FROM usuarios WHERE username='$name' AND passwd='$pass'");

        return $query->num_rows();
    }
    
    function get_all(){
        $query = $this->db->query("SELECT * FROM usuarios;"); 
        $data = array();
            if ($query->num_rows() > 0){
                foreach ($query->result_array() as $row){
                    $data[] = $row;
                }
            }
        return $data;
    }
    
    function insert ($usuario, $contrasena){        
        $query = $this->db->query("INSERT INTO usuarios (username, passwd) VALUES ('$usuario','$contrasena';"); 
        return $this->db->affected_rows();
        
    }
// ------- COMPRUEBO EL LOGIN CON LOS PARAMETROS DEL CONTROLADOR -------------------- //

} // cierra class modelUser
?>

<?php 
class modelUser extends CI_Model{

// ------- COMPRUEBO EL LOGIN CON LOS PARAMETROS DEL CONTROLADOR -------------------- //
    public function checkLogin($name,$pass){
        $query = $this->db->query("SELECT id FROM usuarios WHERE usuario='$name' AND pass='$pass'");

        return $query->num_rows();
    }
// ------- COMPRUEBO EL LOGIN CON LOS PARAMETROS DEL CONTROLADOR -------------------- //

} // cierra class modelUser
?>

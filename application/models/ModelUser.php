<?php 
class ModelUser extends CI_Model{

// ------- COMPRUEBO EL LOGIN CON LOS PARAMETROS DEL CONTROLADOR -------------------- //
    public function checkLogin($name,$pass) {
        $checkHash = false;
        $query = $this->db->query("SELECT passwd FROM usuarios WHERE username = '$name';"); 
        foreach ($query->result_array() as $row) {
            $hash = $row['passwd'];
        }
        
            if (isset($hash)) {
                $checkHash = password_verify($pass, $hash);
                if ($checkHash == 1){
                    $checkHash = true;
            } 
        }
        return $checkHash;
    }
// ------- COMPRUEBO EL LOGIN CON LOS PARAMETROS DEL CONTROLADOR -------------------- //
    
    public function check_user($usuario) {
        $query = $this->db->query("SELECT username FROM usuarios WHERE username = '$usuario';");
        
        return $this->db->affected_rows();
    }
    
    public function get($id) {
        $query = $this->db->query("SELECT id, username, nivel FROM usuarios WHERE id = '$id';"); 
        return $query->result_array();
    }
    
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
    
    public function get_id($name) {
        $query = $this->db->query("SELECT id FROM usuarios WHERE username = '$name';"); 
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
        if ($contrasena != ""){
            $query = $this->db->query("UPDATE usuarios SET username = '$usuario', passwd = '$contrasena', nivel = '$nivel' WHERE id = $id;"); 
            $affected_rows = $this->db->affected_rows();
        }else {
            $query = $this->db->query("UPDATE usuarios SET username = '$usuario', nivel = '$nivel' WHERE id = $id;"); 
            $affected_rows = $this->db->affected_rows();
        }
        var_dump($affected_rows);
        return $affected_rows;
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



    public function hash_pass($pass) {
        if ($pass != ''){
            $pass = password_hash($pass, PASSWORD_DEFAULT);
        }

        var_dump($pass);
        return $pass;
    }
    
} // cierra class ModelUser

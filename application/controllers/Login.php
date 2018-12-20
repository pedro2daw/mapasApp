<?php

include_once('Security.php');

class Login extends Security{
     
// ------- CARGO LA VISTA DEL LOGIN POR DEFECTO ------------ //        
    public function index(){
        $data["nombreVista"] = "login";
        $this->load->view('template',$data);
    }
// ------- CARGO LA VISTA DEL LOGIN POR DEFECTO ------------ //

// ------- COMPRUEBO EL LOGIN REALIZADO -------------------- //
    public function checkLogin(){
        $data["nombreVista"] = "login";
        $nombre = $this->input->get_post("nombre");
        $pass = $this->input->get_post("password");
        $this->load->model('modelUser');
        $resultado = $this->modelUser->checkLogin($nombre,$pass);

        if($resultado == 0){
            $data["msg"] = "<h5 class='error'>Usuario o contraseña incorrectos</h5>";
            $this->load->view('template',$data);
        }
        else{
            echo("YEEEESS");
        }
    }
// ------- COMPRUEBO EL LOGIN REALIZADO -------------------- //
}




?>
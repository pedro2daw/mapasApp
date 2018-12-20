<?php

include_once('Security.php');

class Login extends Security{
     
// ------- CARGO LA VISTA DEL LOGIN POR DEFECTO ------------ //        
    public function index(){
        $data["viewName"] = "login";
        $this->load->view('template',$data);
    }
// ------- CARGO LA VISTA DEL LOGIN POR DEFECTO ------------ //

// ------- COMPRUEBO EL LOGIN REALIZADO -------------------- //
    public function checkLogin(){
        $data["viewName"] = "login";
        $name = $this->input->get_post("name");
        $pass = $this->input->get_post("password");
        $this->load->model('modelUser');
        $r = $this->modelUser->checkLogin($name,$pass);

        if($r == 0){
            $data["msg"] = "<h5 class='error'>Usuario o contraseña incorrectos</h5>";
            $this->load->view('template',$data);
        }
        else{
            echo(" Funciona ##########completar ");
        }
    }
// ------- COMPRUEBO EL LOGIN REALIZADO -------------------- //
}
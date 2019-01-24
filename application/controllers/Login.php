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
        $name = $this->input->get_post("name");
        $pass = $this->input->get_post("password");
        $this->load->model('modelUser');
        $r = $this->modelUser->checkLogin($name,$pass);

        if($r == 0){
            $data["msg"] = "<h5 class='error'>Usuario o contraseña incorrectos</h5>";
            $data["viewName"] = "login";
            $this->load->view('template',$data);
        }
        else{
            $this->load->model('modelMapas'); // * ####### ELIIMNAR CON EL CONSTRUCTOR */
            $data['ListaMapas'] = $this->modelMapas->get_all();
            $data["viewName"] = "admin_panel";
            $this->load->view('template',$data);
        }
    }
// ------- COMPRUEBO EL LOGIN REALIZADO -------------------- //
}

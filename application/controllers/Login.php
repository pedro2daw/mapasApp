<?php

include_once('Security.php');

class Login extends CI_Controller {
     
// ------- CARGO LA VISTA DEL LOGIN POR DEFECTO ------------ //        
    public function index(){
        $this->load->model('ModelSecurity');
        $this->load->model('ModelUser');
        
        $this->load->model('ModelMapas');
        $this->load->model('ModelCalles');
        $data["noHeader"] = false;
        $data["viewName"] = "login";
        if ($this->session->flashdata('data') != null){
            $a = $this->session->flashdata('data');
            $data['msg'] = $a['msg'];
            $data['noHeader'] = $a['noHeader'];
        }

        $this->load->view('template',$data);
    }
    
    public function logout() {
        $this->load->model('ModelSecurity');
        $this->load->model('ModelUser');
        
        $this->load->model('ModelMapas');
        $this->load->model('ModelCalles');

        if ($this->session->flashdata('data') != null){
            $a = $this->session->flashdata('data');
            $data['msg'] = $a['msg'];
        }
        $data["noHeader"] = false;
        $data["viewName"] = "login";
        $this->ModelSecurity->destroy_session();
        $this->load->view('template',$data);
    }
// ------- CARGO LA VISTA DEL LOGIN POR DEFECTO ------------ //

// ------- COMPRUEBO EL LOGIN REALIZADO -------------------- //
    public function checkLogin(){
        $this->load->model('ModelSecurity');
        $this->load->model('ModelUser');
        
        $this->load->model('ModelMapas');
        $this->load->model('ModelCalles');
        $name = $this->input->get_post("name");
        $pass = $this->input->get_post("password");
        $r = $this->ModelUser->checkLogin($name,$pass);

        if($r == 0){
            $data["noHeader"] = false;
            $data["msg"] = "2";
            $this->session->set_flashdata('data',$data);
            redirect('Login/index');
        }
        else{
            $id = $this->ModelUser->get_id($name);
            $this->ModelSecurity->create_session();
            $this->session->set_userdata("id", $id);
            $data['ListaMapas'] = $this->ModelMapas->get_all_ordenados();
         // var_dump($data['ListaPaquetes']);
            $data["msg"] = null;
            $this->session->set_flashdata('data',$data);
            redirect('Maps/index');
        }
    }
// ------- COMPRUEBO EL LOGIN REALIZADO -------------------- //
}

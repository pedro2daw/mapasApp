<?php

include_once('Security.php');

class Users extends Security {

    public function view_users() {
        /*$nivel = $this->modelUser->getNivel($id);
        if ($nivel == 1) {
            $data["viewName"] = "application/views/errors/cli/error_general.php";
        
            $this->load->view('template', $data);
       }*/
       /*else if ($nivel == 2) {*/
            $data['ListaUsuarios'] = $this->modelUser->get_all();
            $data["viewName"] = "admin_users";
        
            $this->load->view('template', $data);   
       
    }  
    
    public function insert_user(){
        $usuario = $this->input->get_post('usuarioIns');
        $contrasena = $this->input->get_post('contrasenaIns');
        $nivel = $this->input->get_post('nivelIns');
        
        $r = $this->modelUser->insert($usuario, $contrasena, $nivel);
        
        if ($r == 0) {
            $data["msg"] = "1";
            $data['ListaUsuarios'] = $this->modelUser->get_all();
            $data["viewName"] = "admin_users";
            $this->load->view('template', $data);
        } else {
            $data["msg"] = "0";
            $data['ListaUsuarios'] = $this->modelUser->get_all();
            $data["viewName"] = "admin_users";
            $this->load->view('template', $data);
        }
       
    }
    
    public function delete_user($id) {
        $r = $this->modelUser->delete($id);
        
        if ($r != 0) {
            $data["msg"] = "0";
            $data['ListaUsuarios'] = $this->modelUser->get_all();
            $data["viewName"] = "admin_users";
            $this->load->view('template', $data);
        } else {
            $data["msg"] = "1";
            $data['ListaUsuarios'] = $this->modelUser->get_all();
            $data["viewName"] = "admin_users";
            $this->load->view('template', $data);
        }
    }
    
    public function update_user() {
        $id = $this->input->get_post('idMod');
        $usuario = $this->input->get_post('usuarioMod');
        $contrasena = $this->input->get_post('contrasenaMod');
        $nivel = $this->input->get_post('nivelMod');
        
        $r = $this->modelUser->update($usuario, $contrasena, $nivel, $id);
        
        if ($r == 0) {
            $data["msg"] = "1";
            $data['ListaUsuarios'] = $this->modelUser->get_all();
            $data["viewName"] = "admin_users";
            $this->load->view('template', $data);
        } else {
            $data["msg"] = "0";
            $data['ListaUsuarios'] = $this->modelUser->get_all();
            $data["viewName"] = "admin_users";
            $this->load->view('template', $data);
        }
    }
    
}

<?php

include_once('Security.php');

class Users extends Security {
    
    public function view_users() {
        $id = $this->session->userdata("id");
        $nivel = $this->modelUser->getNivel($id);
        if ($nivel == 1) {
            $data["viewName"] = "error";
        
            $this->load->view('template', $data);
        } else if ($nivel == 2) {
            $data['ListaUsuarios'] = $this->modelUser->get_all();
            $data["viewName"] = "admin_users";
        
            $this->load->view('template', $data);   
       
        }
    }
    
    public function check_user($usuario) {
        $r = $this->modelUser->check_user($usuario);
        $data;
        
        if ($r == 0) {
            $data = "0";
        }
        else $data = "1";
        
        echo $data;
    }
    
    public function insert_user(){
        $usuario = $this->input->get_post('usuarioIns');
        $contrasena = $this->input->get_post('contrasenaIns');
        $hash = $this->modelUser->hash_pass($contrasena);
        $nivel = $this->input->get_post('nivelIns');
        
        $r = $this->modelUser->insert($usuario, $hash, $nivel);
        
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
        if ($id != $this->session->userdata("id")) {
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
        } else {
            $data["msg"] = "2";
            $data['ListaUsuarios'] = $this->modelUser->get_all();
            $data["viewName"] = "admin_users";
            $this->load->view('template', $data);
        }
    }
    
    public function update_user() {
        $id = $this->input->get_post('idMod');
        $usuario = $this->input->get_post('usuarioMod');
        $contrasena = $this->input->get_post('contrasenaMod');
        $hash = $this->modelUser->hash_pass($contrasena);
        $nivel = $this->input->get_post('nivelMod');
        
        $r = $this->modelUser->update($usuario, $hash, $nivel, $id);
        
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

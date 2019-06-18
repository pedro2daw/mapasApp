<?php

include_once('Security.php');

class Users extends Security {
    
    public function view_users() {
        $id = $this->session->userdata("id");
        $data["DatosUsuario"] = $this->ModelUser->get($id);
        $nivel = $this->ModelUser->getNivel($id);
        $data["nivel"] = $this->ModelUser->getNivel($id);
        if ($nivel == 1) {
            $data["viewName"] = "admin_usuario";
            if ($this->session->flashdata('data') != null){
                $a = $this->session->flashdata('data');
                $data['msg'] = $a['msg'];
                   
        }
        } else if ($nivel == 2) {
            $data['ListaUsuarios'] = $this->ModelUser->get_all();
            $data["viewName"] = "admin_users";
            if ($this->session->flashdata('data') != null){
                $a = $this->session->flashdata('data');
                $data['msg'] = $a['msg'];

        }
        }
        $this->load->view('template', $data);   

    }
    
    public function check_user($usuario) {
        $r = $this->ModelUser->check_user($usuario);
        $data;
        
        if ($r == 0) {
            $data = "0";
        }
        else $data = "1";
        
        echo $data;
    }
    
    public function insert_user(){
        if ($this->ModelUser->getNivel($this->session->userdata("id"))  == 2){ 
        $usuario = $this->input->get_post('usuarioIns');
        $contrasena = $this->input->get_post('contrasenaIns');
        $hash = $this->ModelUser->hash_pass($contrasena);
        $nivel = $this->input->get_post('nivelIns');
        
        $r = $this->ModelUser->insert($usuario, $hash, $nivel);
        
        if ($r == 0) {
            //error
            $data["msg"] = "1";
            $this->session->set_flashdata('data',$data);
            redirect('Users/view_users');
        } else {
            //bien
            $data["msg"] = "0";
            $this->session->set_flashdata('data',$data);
            redirect('Users/view_users');
        }
        
        } else {
            $data["viewName"] = "error";
            $this->load->view('template', $data);
        }
     
    }
    
    // INSERT INTO usuarios VALUES (2,2,'$2y$10$EGrnGxX1lP7RRmb107gtcOfOUv674kRAD9cAaLCp.g7cufwutJ.3y',1)

    public function delete_user($id) {
        $nivel = $this->ModelUser->getNivel($id);
        // PERMITE BORRAR: Si el id es distinto al id usuario de la sesion  o SI ES IGUAL Y EL USUARIO ES DE NIVEL 1 (se da de baja)
        if ( ($id != $this->session->userdata("id")) || (($id == $this->session->userdata("id")) && ($nivel == 1)) ) {
            $r = $this->ModelUser->delete($id);
            if ($r != 0) {
                // exito
                    if (($id == $this->session->userdata("id")) && ($nivel == 1)){
                        $data["msg"] = "4";
                        $this->session->set_flashdata('data',$data);
                        redirect('Login/logout');
                    } else {
                        $data["msg"] = "0";
                        $this->session->set_flashdata('data',$data);
                        redirect('Users/view_users');
                    }
                } else {
                    // error
                    $data["msg"] = "1";
                    $this->session->set_flashdata('data',$data);
                    redirect('Users/view_users');
                }
        } else {
            $data["msg"] = "2";
            $this->session->set_flashdata('data',$data);
            redirect('Users/view_users');
        }
    }
    
    public function update_user() {
        $id = $this->input->get_post('idMod');
        $usuario = $this->input->get_post('usuarioMod');
        $contrasena = $this->input->get_post('contrasenaMod');
        $hash = $this->ModelUser->hash_pass($contrasena);
        $nivel = $this->input->get_post('nivelMod');  
        if (($id == $this->session->userdata("id")) && ($this->ModelUser->getNivel($id) == 1)){
            $nivel = $this->ModelUser->getNivel($id);  
        }
        
        $r = $this->ModelUser->update($usuario, $hash, $nivel, $id);
        
        if ($r == 0) {
            $data["msg"] = "1";
            $this->session->set_flashdata('data',$data);
            redirect('Users/view_users');
        } else {
            $data["msg"] = "0";
            $this->session->set_flashdata('data',$data);
            redirect('Users/view_users');
        }
    }
}

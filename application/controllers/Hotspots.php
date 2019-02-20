<?php

include_once('Security.php');

class Hotspots extends Security {
    
    public function view_hotspots() {
        $data['ListaHotspots'] = $this->modelHotspot->get_all();
        $data["viewName"] = "admin_hotspots";
        $this->load->view('template', $data);
    }

    public function insert_hotspot(){
        $usuario = $this->input->get_post('usuarioIns');
        $contrasena = $this->input->get_post('contrasenaIns');
        $hash = $this->modelUser->hash_pass($contrasena);
        $nivel = $this->input->get_post('nivelIns');
        
        if ($r == 0) {
            $data["msg"] = "1";
            $data['ListaHotspots'] = $this->modelHotspot->get_all();
            $data["viewName"] = "admin_hotspots";
            $this->load->view('template', $data);
        } else {
            $data["msg"] = "0";
            $data['ListaHotpsots'] = $this->modelHotspot->get_all();
            $data["viewName"] = "admin_hotspots";
            $this->load->view('template', $data);
        }
       
    }
    
    public function delete_hotspot($id) {
            $r = $this->modelUser->delete($id);
            if ($r != 0) {
                $data["msg"] = "0";
                $data['ListaHotspots'] = $this->modelHotspot->get_all();
                $data["viewName"] = "";
                $this->load->view('template', $data);
            } else {
                $data["msg"] = "1";
                $data['ListaHotspots'] = $this->modelHotspot->get_all();
                $data["viewName"] = "admin_users";
                $this->load->view('template', $data);
            }
    }
}

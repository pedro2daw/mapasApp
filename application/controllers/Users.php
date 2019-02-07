<?php

include_once('Security.php');

class Users extends Security {

    public function view_users() {
        $data['ListaUsuarios'] = $this->modelUser->get_all(); 
        $data["viewName"] = "admin_users";
        
        $this->load->view('template', $data);
    }

    public function insert_user(){
        $usuario = $this->input->get_post('usuario');
        $contrasena = $this->input->get_post('contrasena');
        $nivel = $this->input->get_post('nivel');
        
        $r = $this->modelUser->insert($usuario, $contrasena, $nivel);
        
        if ($r == 0) {
            $data["msg"] = "1";
            $data["viewName"] = "admin_users";
            $this->load->view('template', $data);
        } else {
            $data["msg"] = "0";
            $data["viewName"] = "admin_users";
            $this->load->view('template', $data);
        }
        /*} else {
            $descripcion_paquete = $this->input->get_post('descripcion_paquete');
            $r = $this->modelPaquetes->insert($nombre_paquete_nuevo, $descripcion_paquete);
            if ($r == 0) {
                $data["msg"] = "1";
                        $data["viewName"] = "admin_panel";
                        $this->load->view('template', $data);
            } else {
                $paquete_nuevo = $this->modelPaquetes->get_last();
                $r = $this->modelMapas->insert($titulo, $descripcion, $ciudad, $fecha, $ruta, $paquete_nuevo);
                $data['mapas_paquetes'] = $this->modelMapas->mapas_paquetes($paquete_nuevo);
            }
        }
        // BD Que mapas contiene un paquete de mapas para saber la fecha de los mapas y compararlos y ordenarlos automatica/.    
        // NIVEL LO ORDENARÁ AUTOMATICAMENTE POR LA FECHA
       if ($r == 0) {
                $data["msg"] = "1";
                        $data["viewName"] = "admin_panel";
                        $this->load->view('template', $data);

        } else {
                $data['img_size'] = $this->modelMapas->get_img_size($ruta);
                
                $ancho = $data['img_size'][0];
                $alto = $data['img_size'][1];

                $r2 = $this->modelMapas->insert_size($ancho,$alto,$ultimoId);

            if ($r2 == 0){
                $data["msg"] = "1";
                        $data["viewName"] = "admin_panel";
                        $this->load->view('template', $data);

            } else {
                // CAMBIAR MSG POR ERROR, FALSE, o 0 o 1 Y LUEGO CONTROLAR ESTO EN PHP EN LA VISTA.
                $data["msg"] = "0";
                $data['ListaMapas'] = $this->modelMapas->get_all();
                $data['ListaPaquetes'] = $this->modelPaquetes->get_name();
                $data["viewName"] = "admin_panel";
                $this->load->view('template', $data);
            }*/
        }
    
    public function delete_user() {
        $r = $this->modelUser->delete();
    }
    
    public function mod_user() {
        
    }
    
}

<?php

include_once('Security.php');

class Maps extends Security {

    public function index(){
        $data['ListaMapas'] = $this->modelMapas->get_all();
        $data['ListaPaquetes'] = $this->modelPaquetes->get_name();
        $data["viewName"] = "admin_panel";
        $this->load->view('template',$data);
    }

    public function insert(){
        $titulo = $this->input->get_post('titulo');
        $descripcion = $this->input->get_post('descripcion');
        $ciudad =$this->input->get_post('ciudad');
        $fecha = $this->input->get_post('fecha');
        $nivel = $this->input->get_post('nivel');
        // Obtenemos el ultimo id para cambiar el nombre del archivo subido:
        $ultimoId = $this->modelMapas->get_next_id();
        var_dump($ultimoId);
        // Formateamos la ciudad para que sea minuscula y elimine las tildes:
        $ciudad_format = $this->modelMapas->format($ciudad);
        $img_name = $this->modelMapas->checkImg($ultimoId,$ciudad_format);
        $ruta = "assets/img/mapas/".$img_name; 

        $paquete_seleccionado = $this->input->get_post('select_paquetes');
        $nombre_paquete_nuevo = $this->input->get_post('nombre_paquete');
       
        if ($paquete_seleccionado != '1'){
            $r = $this->modelMapas->insert($titulo, $descripcion, $ciudad, $fecha, $ruta, $paquete_seleccionado);
        } else {
            $descripcion_paquete = $this->input->get_post('descripcion_paquete');
            $r = $this->modelPaquetes->insert($nombre_paquete_nuevo, $descripcion_paquete);
            if ($r == 0) {
                $data["msg"] = "1";
                $data['ListaMapas'] = $this->modelMapas->get_all();
                $data['ListaPaquetes'] = $this->modelPaquetes->get_name();
                $data["viewName"] = "admin_panel";
                $this->load->view('template',$data);
            } else {
                $paquete_nuevo = $this->modelPaquetes->get_last();
                $r = $this->modelMapas->insert($titulo, $descripcion, $ciudad, $fecha, $ruta, $paquete_nuevo);
            }
        }

       if ($r == 0) {
                $data["msg"] = "1";
                $data['ListaMapas'] = $this->modelMapas->get_all();
                $data['ListaPaquetes'] = $this->modelPaquetes->get_name();
                $data["viewName"] = "admin_panel";
                $this->load->view('template',$data);
        } else {
                $data['img_size'] = $this->modelMapas->get_img_size($ruta);
                $ancho = $data['img_size'][0];
                $alto = $data['img_size'][1];
                $r2 = $this->modelMapas->insert_size($ancho,$alto,$ultimoId);
            if ($r2 == 0){
                $data["msg"] = "1";
                $data['ListaMapas'] = $this->modelMapas->get_all();
                $data['ListaPaquetes'] = $this->modelPaquetes->get_name();
                $data["viewName"] = "admin_panel";
                $this->load->view('template',$data);
            } else {
                $data["msg"] = "0";
                $data['ListaMapas'] = $this->modelMapas->get_all();
                $data['ListaPaquetes'] = $this->modelPaquetes->get_name();
                $data["viewName"] = "admin_panel";
                $this->load->view('template',$data);
            }
        }
    }     

    public function update() {
        $id = $this->input->get_post('id_update');
        $titulo = $this->input->get_post('upd_titulo');
        $ciudad = $this->input->get_post('upd_ciudad');
        $fecha = $this->input->get_post('upd_fecha');
        $paquete = $this->input->get_post('upd_paquete');
        $ruta_original = $this->input->get_post('ruta_original');
        // Formateamos la ciudad para que sea minuscula y elimine las tildes:
        $ciudad_format = $this->modelMapas->format($ciudad);
        $ancho = $this->input->get_post('upd_ancho');
        $alto = $this->input->get_post('upd_alto');


        $img_name = $this->modelMapas->update_img($id,$ciudad_format);
        $ruta = "assets/img/mapas/".$img_name; 

        // Si no hay una imagen seleccionada, se inserta una nueva.
        if (!$img_name){
            $img_name = $this->modelMapas->checkImgDefault();
            $ruta = $ruta_original;
            $opc = false;
            $r = $this->modelMapas->update($id, $titulo, $ciudad, $fecha, $ruta, $paquete, $ancho, $alto,$opc);
            if ($r == 0){
                // ERROR
                $data["msg"] = "1";
                $data['ListaMapas'] = $this->modelMapas->get_all();
                $data['ListaPaquetes'] = $this->modelPaquetes->get_name();
                $data["viewName"] = "admin_panel";
                $this->load->view('template',$data);
            } else {
                $data["msg"] = "0";
                $data['ListaMapas'] = $this->modelMapas->get_all();
                $data['ListaPaquetes'] = $this->modelPaquetes->get_name();
                $data["viewName"] = "admin_panel";
        
                $this->load->view('template',$data);
            }
        } else {
            $opc = true;
            $r = $this->modelMapas->update($id, $titulo, $ciudad, $fecha, $ruta, $paquete, $ancho, $alto,$opc);

            if ($r == 0){
                // ERROR
                $data["msg"] = "1";
                $data['ListaMapas'] = $this->modelMapas->get_all();
                $data['ListaPaquetes'] = $this->modelPaquetes->get_name();
                $data["viewName"] = "admin_panel";
                $this->load->view('template',$data);
            } else {
                $data['img_size'] = $this->modelMapas->get_img_size($ruta);
                
                $ancho = $data['img_size'][0];
                $alto = $data['img_size'][1];
                
                $r2 = $this->modelMapas->insert_size($ancho,$alto,$id);

                if ($r2 == 0){
                    // ERROR 
                    $data["msg"] = "1";
                    
                    $data['ListaMapas'] = $this->modelMapas->get_all();
                    $data['ListaPaquetes'] = $this->modelPaquetes->get_name();
                    $data["viewName"] = "admin_panel";
        
                    $this->load->view('template',$data);
                } else {
                    $data["msg"] = "0";
                    $data['ListaMapas'] = $this->modelMapas->get_all();
                    $data['ListaPaquetes'] = $this->modelPaquetes->get_name();
                    $data["viewName"] = "admin_panel";
        
                    $this->load->view('template',$data);
                }
            }
        }   
    }     

    public function delete_map($id) {
        $r = $this->modelMapas->delete($id);

        if ($r == 0){
            // ERROR 
            $data["msg"] = "1";
            $data['ListaMapas'] = $this->modelMapas->get_all();
            $data['ListaPaquetes'] = $this->modelPaquetes->get_name();
            $data["viewName"] = "admin_panel";

            $this->load->view('template',$data);
        } else {
            $data["msg"] = "0";
            $data['ListaMapas'] = $this->modelMapas->get_all();
            $data['ListaPaquetes'] = $this->modelPaquetes->get_name();
            $data["viewName"] = "admin_panel";

            $this->load->view('template',$data);
        }
    }
}


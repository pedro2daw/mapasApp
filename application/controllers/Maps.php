<?php

include_once('Security.php');

class Maps extends Security {

    public function index(){
        $this->datos();
    }

    public function insert(){
        $titulo = $this->input->get_post('titulo');
        $descripcion = $this->input->get_post('descripcion');
        $ciudad =$this->input->get_post('ciudad');
        $fecha = $this->input->get_post('fecha');
        $nivel = $this->input->get_post('nivel');
        
        // Obtenemos el ultimo id para cambiar el nombre del archivo subido:
        $ultimoId = $this->modelMapas->get_last()+1;

        // Formateamos la ciudad para que sea minuscula y elimine las tildes:
        $ciudad_format = $this->modelMapas->format($ciudad);
        $img_name = $this->modelMapas->checkImg($ultimoId,$ciudad_format);
        $ruta = "assets/img/mapas/".$img_name; 

        
        $paquete_seleccionado = $this->input->get_post('select_paquetes');
        $nombre_paquete_nuevo = $this->input->get_post('nombre_paquete');
        //var_dump("Paquete-seleccionado: ". $paquete_seleccionado . " Paquete nuevo: " .$paquete_nuevo );

        if ($paquete_seleccionado != '1'){
            $r = $this->modelMapas->insert($titulo, $descripcion, $ciudad, $fecha, $ruta, $paquete_seleccionado);
        } else {
            $descripcion_paquete = $this->input->get_post('descripcion_paquete');
            $r = $this->modelPaquetes->insert($nombre_paquete_nuevo, $descripcion_paquete);
            if ($r == 0) {
                $data["msg"] = "1";
                $this->datos();
                $this->load->view('template', $data);
            } else {
                $paquete_nuevo = $this->modelPaquetes->get_last();
                $r = $this->modelMapas->insert($titulo, $descripcion, $ciudad, $fecha, $ruta, $paquete_nuevo);
                /*$data['mapas_paquetes'] = $this->modelMapas->mapas_paquetes($paquete_nuevo);*/
            }
        }

       if ($r == 0) {
                $data["msg"] = "1";
                $this->datos();
                $this->load->view('template', $data);

        } else {
                $data['img_size'] = $this->modelMapas->get_img_size($ruta);
                
                $ancho = $data['img_size'][0];
                $alto = $data['img_size'][1];

                $r2 = $this->modelMapas->insert_size($ancho,$alto,$ultimoId);

            if ($r2 == 0){
                $data["msg"] = "1";
                $this->datos();
                $this->load->view('template', $data);

            } else {
                // CAMBIAR MSG POR ERROR, FALSE, o 0 o 1 Y LUEGO CONTROLAR ESTO EN PHP EN LA VISTA.
                $data["msg"] = "0";
                $this->datos();
                $this->load->view('template', $data);
            }
        }
    }     
    /*
    public function form_update_map() {
        $id = $this->input->post('id');
        $data['paquete'] = $this->modelMapas->get_paquete($id);
        echo json_encode($data['paquete']);
    }
    */
    public function update() {
        $id = $this->input->get_post('id_update');
        $titulo = $this->input->get_post('upd_titulo');
        /* $descripcion = $this->input->get_post('upd_descripcion'); */
        $ciudad = $this->input->get_post('upd_ciudad');
        $fecha = $this->input->get_post('upd_fecha');
        /* $nivel = $this->input->get_post('upd_nivel'); */
        $paquete = $this->input->get_post('upd_paquete');
        $ruta_original = $this->input->get_post('ruta_original');
        // Formateamos la ciudad para que sea minuscula y elimine las tildes:
        $ciudad_format = $this->modelMapas->format($ciudad);
        $img_name = $this->modelMapas->update_img($id,$ciudad_format);
        $ruta = "assets/img/mapas/".$img_name; 

        var_dump($ruta);
        if (!$img_name){
            $img_name = $this->modelMapas->checkImgDefault();
            $ruta = "assets/img/mapas/".$img_name; 
        }

        
    }     


    public function datos(){
        $data['ListaMapas'] = $this->modelMapas->get_all();
        $data['ListaPaquetes'] = $this->modelPaquetes->get_name();
        $data["viewName"] = "admin_panel";
        $this->load->view('template',$data);
    }
    

}


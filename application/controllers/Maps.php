<?php

include_once('Security.php');

class Maps extends Security {

    public function index(){
        $data['ListaMapas'] = $this->ModelMapas->get_all_ordenados();
        $data["viewName"] = "admin_panel";
        if ($this->session->flashdata('data') != null){
            $a = $this->session->flashdata('data');
            $data['msg'] = $a['msg'];
        }
        $this->load->view('template',$data);
    }

    public function insert(){
        $titulo = $this->input->get_post('titulo');
        // $descripcion = $this->input->get_post('descripcion');
        $ciudad = 'Almeria';
        $fecha = $this->input->get_post('fecha');
        // $nivel = $this->input->get_post('nivel');
        // Obtenemos el ultimo id para cambiar el nombre del archivo subido:
        $ultimoId = $this->ModelMapas->get_next_id();
        
        // Formateamos la ciudad para que sea minuscula y elimine las tildes:
        $ciudad_format = $this->ModelMapas->format($ciudad);
        $img_name = $this->ModelMapas->checkImg($ultimoId,$ciudad_format);
        if (!$img_name){
            $ruta = false;
        }else{
            $ruta = "assets/img/mapas/".$img_name;
        }

        //Obtenemos el mapa del que hereda el mapa insertado (o nada en caso de no elegir ninguno)
        $heredar =  $this->input->get_post('herencia');
        
        /*
        $paquete_seleccionado = $this->input->get_post('select_paquetes');
        $nombre_paquete_nuevo = $this->input->get_post('nombre_paquete');
       
        if ($paquete_seleccionado != '1'){
            $r = $this->ModelMapas->insert($titulo, $descripcion, $ciudad, $fecha, $ruta, $paquete_seleccionado);
        } else {
            $descripcion_paquete = $this->input->get_post('descripcion_paquete');
            $r = $this->modelPaquetes->insert($nombre_paquete_nuevo, $descripcion_paquete);
            if ($r == 0) {
                $data["msg"] = "1";
                $data['ListaMapas'] = $this->ModelMapas->get_all_ordenados();
                $data['ListaPaquetes'] = $this->modelPaquetes->get_name();
                $data["viewName"] = "admin_panel";
                $this->load->view('template',$data);
            } else {
                $paquete_nuevo = $this->modelPaquetes->get_last();
                $r = $this->ModelMapas->insert($titulo, $descripcion, $ciudad, $fecha, $ruta, $paquete_nuevo);
            }
        }
        */

        $r = $this->ModelMapas->insert($titulo, $fecha, $ruta);
        
        if ($heredar != "") {
            $data['img_size'] = $this->ModelMapas->get_img_size($ruta);
            $ancho = $data['img_size'][0];
            $alto = $data['img_size'][1];
            $r2 = $this->ModelMapas->insert_size($ancho,$alto,$ultimoId);
            $data["id_mapa"] = $ultimoId;
            $data["listaCalles"] = $this->ModelInheritance->get_calles_mapa($heredar);
            $data["viewName"] = "admin_inheritance";
            $this->load->view('template',$data);
        } else {
            if ($r == 0) {
                $data["msg"] = "1";
                $data['ListaMapas'] = $this->ModelMapas->get_all_ordenados();
                // $data['ListaPaquetes'] = $this->modelPaquetes->get_name();
                $this->session->set_flashdata('data',$data);
                redirect('Maps/index');
            } else {
                $data['img_size'] = $this->ModelMapas->get_img_size($ruta);
                $ancho = $data['img_size'][0];
                $alto = $data['img_size'][1];
                $r2 = $this->ModelMapas->insert_size($ancho,$alto,$ultimoId);
                if ($r2 == 0){
                    $data["msg"] = "1";
                    $data['ListaMapas'] = $this->ModelMapas->get_all_ordenados();
                    // $data['ListaPaquetes'] = $this->modelPaquetes->get_name();
                    $this->session->set_flashdata('data',$data);
                    redirect('Maps/index');
                } else {
                    $data["msg"] = "0";
                    $data['ListaMapas'] = $this->ModelMapas->get_all_ordenados();
                    // $data['ListaPaquetes'] = $this->modelPaquetes->get_name();
                    $this->session->set_flashdata('data',$data);
                    redirect('Maps/index');
                }
            }
        }
        
        
    }

    public function update() {
        $id = $this->input->get_post('id_update');
        $titulo = $this->input->get_post('upd_titulo');
        $ciudad = $this->input->get_post('upd_ciudad');
        $fecha = $this->input->get_post('upd_fecha');
        $x = $this->input->get_post('upd_desv_x');
        $y = $this->input->get_post('upd_desv_y');
        // $paquete = $this->input->get_post('upd_paquete');
        $ruta_original = $this->input->get_post('ruta_original');
        // Formateamos la ciudad para que sea minuscula y elimine las tildes:
        $ciudad_format = $this->ModelMapas->format($ciudad);
        $ancho = $this->input->get_post('upd_ancho');
        $alto = $this->input->get_post('upd_alto');


        $img_name = $this->ModelMapas->update_img($id,$ciudad_format);
        $ruta = "assets/img/mapas/".$img_name; 

        // Si no hay una imagen seleccionada, se inserta la original.
        if (!$img_name){
            $img_name = $this->ModelMapas->checkImgDefault();
            $ruta = $ruta_original;
            $opc = false;
            $r = $this->ModelMapas->update($id, $titulo, $fecha, $ruta, $ancho, $alto, $x , $y, $opc);
            if ($r == 0){
                // ERROR
                $data["msg"] = "1";
                $data['ListaMapas'] = $this->ModelMapas->get_all_ordenados();
                $this->session->set_flashdata('data',$data);
                redirect('Maps/index');
            } else {
                $data["msg"] = "0";
                $data['ListaMapas'] = $this->ModelMapas->get_all_ordenados();
                $this->session->set_flashdata('data',$data);
                redirect('Maps/index');
            }
        } else {
            $opc = true;
            $r = $this->ModelMapas->update($id, $titulo, $fecha, $ruta, $ancho, $alto, $x , $y, $opc);

            if ($r == 0){
                // ERROR
                $data["msg"] = "1";
                $data['ListaMapas'] = $this->ModelMapas->get_all_ordenados();
                $this->session->set_flashdata('data',$data);
                redirect('Maps/index');
            } else {
                $data['img_size'] = $this->ModelMapas->get_img_size($ruta);
                $ancho = $data['img_size'][0];
                $alto = $data['img_size'][1];
                $r2 = $this->ModelMapas->insert_size($ancho,$alto,$id);

                if ($r2 == 0){
                    // ERROR 
                    $data["msg"] = "1";
                    $data['ListaMapas'] = $this->ModelMapas->get_all_ordenados();
                    $this->session->set_flashdata('data',$data);
                    redirect('Maps/index');
                } else {
                    $data["msg"] = "0";
                    $data['ListaMapas'] = $this->ModelMapas->get_all_ordenados();
                    //$data['ListaPaquetes'] = $this->modelPaquetes->get_name();
                    $this->session->set_flashdata('data',$data);
                    redirect('Maps/index');
                }
            }
        }   
    }     

    public function delete_map($id) {
        $r = $this->ModelMapas->delete($id);

        if ($r == 0){
            // ERROR 
            $data["msg"] = "1";
            $data['ListaMapas'] = $this->ModelMapas->get_all_ordenados();
            //$data['ListaPaquetes'] = $this->modelPaquetes->get_name();
            $this->session->set_flashdata('data',$data);
            redirect('Maps/index');
        } else {
            $data["msg"] = "0";
            $data['ListaMapas'] = $this->ModelMapas->get_all_ordenados();
            //$data['ListaPaquetes'] = $this->modelPaquetes->get_name();
            $this->session->set_flashdata('data',$data);
            redirect('Maps/index');
        }
    }

    public function superponer(){
        $x_json = $this->input->get_post('x_coord');
        $y_json = $this->input->get_post('y_coord');
        $rutas_json = $this->input->get_post('array_rutas');

        $desv_x = json_decode($x_json);
        $desv_y = json_decode($y_json);
        $rutas = json_decode($rutas_json,true);
        
        $r = $this->ModelMapas->superponer($desv_x,$desv_y,$rutas);

        if ($r == 0){
            // ERROR 
            $data["msg"] = "1";
            $data['ListaMapas'] = $this->ModelMapas->get_all_ordenados();
            //$data['ListaPaquetes'] = $this->modelPaquetes->get_name();
            $this->session->set_flashdata('data',$data);
            redirect('Maps/index');

        }else {
            $data["msg"] = "0";
            $data['ListaMapas'] = $this->ModelMapas->get_all_ordenados();
            //$data['ListaPaquetes'] = $this->modelPaquetes->get_name();
            $this->session->set_flashdata('data',$data);
            redirect('Maps/index');
        }
    }

    public function update_principal(){
        $id = $this->input->post();

        $id_principal = $id["id_principal"];

        $this->ModelMapas->update_principal($id_principal);
    }

    public function get_maps(){
        $data["mapas_aux"] = $this->ModelMapas->get_maps_aux();
        $data["mapa_main"] = $this->ModelMapas->get_mapa_main();
        $data["viewName"] = "superponer";
        $this->load->view('template', $data);
    }

}

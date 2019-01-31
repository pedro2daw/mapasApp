<?php

include_once('Security.php');

class Maps extends Security {

    public function index(){
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
        $ultimoId = $this->modelMapas->get_last()+1;

        // Formateamos la ciudad para que sea minuscula y elimine las tildes:
        $ciudad_format = $this->modelMapas->format($ciudad);
        $img_name = $this->modelMapas->checkImg($ultimoId,$ciudad_format);
        $ruta = "assets/img/mapas/".$img_name; 

        
        $paquete_seleccionado = $this->input->get_post('select_paquetes');

        $nombre_paquete_nuevo = $this->input->get_post('nombre_paquete');
        //var_dump("Paquete-seleccionado: ". $paquete_seleccionado . " Paquete nuevo: " .$paquete_nuevo );

        /* 
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    descripcion VARCHAR(250) NOT NULL,
    ciudad VARCHAR(50) NOT NULL,
    fecha SMALLINT NOT NULL,
    imagen VARCHAR(250) NOT NULL,
    nivel SMALLINT NOT NULL,
    ancho INT NOT NULL,
    altura INT NOT NULL,
    fecha_de_subida DATETIME NOT NULL,

        id_paquete INT UNSIGNED NOT NULL
        */

        if ($paquete_seleccionado != '1'){
            $r = $this->modelMapas->insert($titulo, $descripcion, $ciudad, $fecha, $ruta, $paquete_seleccionado);
        } else {
            $descripcion_paquete = $this->input->get_post('descripcion_paquete');
            $r = $this->modelPaquetes->insert($nombre_paquete_nuevo, $descripcion_paquete);
            $paquete_nuevo = $this->modelPaquetes->get_last();
            $r = $this->modelMapas->insert($titulo, $descripcion, $ciudad, $fecha, $ruta, $paquete_nuevo);
        }
        // FECHA DE SUBIDA
        // BD Que mapas contiene un paquete de mapas para saber la fecha de los mapas y compararlos y ordenarlos automatica/.    
        // NIVEL LO ORDENARÁ AUTOMATICAMENTE POR LA FECHA
       if ($r == 0) {
                echo "<h4 class='error'> SE HA PRODUCIDO UN ERROR </h4>";
                        $data["viewName"] = "admin_panel";
                        $this->load->view('template', $data);

        } else {
                $data['img_size'] = $this->modelMapas->get_img_size($ruta);
                $ancho = $data['img_size'][0];
                $alto = $data['img_size'][1];

                $r2 = $this->modelMapas->insert_size($ancho,$alto,$ultimoId);

            if ($r2 == 0){
                echo "<h4 class='error'> SE HA PRODUCIDO UN ERROR </h4>";
                        $data["viewName"] = "admin_panel";
                        $this->load->view('template', $data);

            } else {
                echo "<h4 class='success'> SE HA REALIZADO LA OPERACION CON EXITO </h4>";
                $data['ListaMapas'] = $this->modelMapas->get_all();
                $data["viewName"] = "admin_panel";
                $this->load->view('template', $data);
            }
        }
    }   

    
    public function hotspots() {
        $data["viewName"] = "admin_hotspots";
        $this->load->view('template', $data);
    }

    public function form_update_map($id) {
        $data['datosMapa'] = $this->modelMapas->get($id);
    }



}

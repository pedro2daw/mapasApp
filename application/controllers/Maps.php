<?php

include_once('Security.php');

class Maps extends Security{

    public function insert(){
        if ($this->compruebaLogin()){
        $this->load->model('model_mapas');
        $img_name = $this->model_mapas->checkImg();
        $titulo = $this->input->get_post('titulo');
        $descripcion = $this->input->get_post('descripcion');
        $ciudad = $this->input->get_post('ciudad');
        $fecha = $this->input->get_post('fecha');

        $cartel = "assets/img/".$img_name;
        $r = $this->modelPeliculas->insert($nombre, $anyo, $pais, $cartel);

       if ($r == 0) {
                echo "<h4 class='error'> SE HA PRODUCIDO UN ERROR </h4>";

                    $this->load->model('modelPeliculas');
                        $data["moviesList"] = $this->modelPeliculas->getAll();

                        $this->load->model('modelLugares');
                        $data["placesList"] = $this->modelLugares->getAll();

                        $this->load->model('modelLocalizaciones');
                        $data["locationsList"] = $this->modelLocalizaciones->getAll();

                        $data["nombreVista"] = "menu";
                        $this->load->view('templates', $data);
        } else {
                echo "<h4 class='success'> SE HA REALIZADO LA OPERACION CON EXITO </h4>";

                        $this->load->model('modelPeliculas');
                        $data["moviesList"] = $this->modelPeliculas->getAll();

                        $this->load->model('modelLugares');
                        $data["placesList"] = $this->modelLugares->getAll();

                        $this->load->model('modelLocalizaciones');
                        $data["locationsList"] = $this->modelLocalizaciones->getAll();

                        $data["nombreVista"] = "menu";
                        $this->load->view('templates', $data);
            }
        }
    }   
    
    public function hotspots() {
        $data["viewName"] = "admin_hotspots";
        $this->load->view('template', $data);
    }

}

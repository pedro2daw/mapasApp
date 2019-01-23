<?php

//include_once('Security.php');

class Maps extends CI_Controller {

    public function insert(){
    
        
        $titulo = $this->input->get_post('titulo');
        $descripcion = $this->input->get_post('descripcion');
        $ciudad = $this->input->get_post('ciudad');
        $fecha = $this->input->get_post('fecha');
        $nivel = $this->input->get_post('nivel');
        
        // Obtenemos el ultimo id para cambiar el nombre del archivo subido:
        /*$ultimoId = $this->modelMapas->get_last();
        var_dump($ultimoId); */
        $ultimoId = 1;
        
        $img_name = $this->modelMapas->checkImg($ultimoId,$ciudad);
        $mapa = "/assets/img/mapas/".$img_name; 

        $ancho = 100;
        $altura = 100;

        $r = $this->modelMapas->insert($titulo, $descripcion, $ciudad, $fecha, $mapa,$nivel,$ancho,$altura);

       if ($r == 0) {
                echo "<h4 class='error'> SE HA PRODUCIDO UN ERROR </h4>";
                        $data["viewName"] = "admin_panel";
                        $this->load->view('template', $data);
        } else {
                echo "<h4 class='success'> SE HA REALIZADO LA OPERACION CON EXITO </h4>";
                        $data["viewName"] = "admin_panel";
                        $this->load->view('template', $data);
            }
        }   
    
    public function hotspots() {
        $data["viewName"] = "admin_hotspots";
        $this->load->view('template', $data);
    }

}

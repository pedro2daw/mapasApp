<?php
   class Streets extends CI_Controller {

        public function view_form_insert(){
            $data["$maps_avialables"] =  $this->modelMapas->get_all(); // traigo todos los mapas disponibles
            $data["viewName"] = "ins";

        }

   }
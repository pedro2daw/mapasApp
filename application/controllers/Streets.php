<?php
   class Streets extends CI_Controller {

        public function view_admin_streets(){
            $data["$slides_avialables"] =  $this->modelMapas->get_all(); // traigo todos las laminas disponibles
            $data["viewName"] = "admin_streets";

        }

   }
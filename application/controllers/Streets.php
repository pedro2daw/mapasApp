<?php
include_once('Security.php');
   class Streets extends Security {

        public function view_admin_streets(){
            //$data["$slides_avialables"] =  $this->modelMapas->get_slides(); // traigo todos las laminas disponibles // decirle a Tony que me implemente la siguiente
                                                                            // funcion en su controlador de Maps.php:
            /*
            public function get_slides(){
                $query = $this->db->query("SELECT id AS id_slide,nombre FROM laminas");

                $data = array();
                if ($query->num_rows() > 0){
                    foreach($query->result_array() as $row){
                        $data[] = $row:
                    }
                }
                return array_column($data,'nombre','id_slide');
            }
            
            */
            //$data["$maps_avialables"] =  $this->modelMapas->get_all_maps(); // traigo todos las laminas disponibles
            $data["slides_avialables"] = $this->modelCalles->get_slides();
            $data["listaCalles"] = $this->modelCalles->get_all();
            $data["viewName"] = "admin_streets";
            $this->load->view('template', $data);
        }

        public function insert_street(){
            $data['nombre'] = $this->input->get_post('nombre');
            $data['tipo'] = $this->input->get_post('tipo');
            $data['aInicio'] = $this->input->get_post('aInicio');
            $data['aFinal'] = $this->input->get_post('aFinal');
            $data['lamina'] = $this->input->get_post('lamina');
            $data["viewName"] = "insert_coords";
            $this->load->view('template', $data);
        }

   } // cierro la class Streets
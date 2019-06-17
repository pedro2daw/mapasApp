<?php
include_once('Security.php');
   class Streets extends Security {

        public function view_admin_streets(){
            //$data["$slides_avialables"] =  $this->ModelMapas->get_slides(); // traigo todos las laminas disponibles // decirle a Tony que me implemente la siguiente
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
            $data["mapas_disponibles"] = $this->ModelCalles->get_maps();
            $data["listaCalles"] = $this->ModelCalles->get_all();
            $data["viewName"] = "admin_streets";
            $this->load->view('template', $data);
        }
        // este es la funcion del formulario de la clase modal, que nos manda a la insercion de las coordenadas //
        public function insert_coords(){
            $data['nombre'] = $this->input->get_post('nombre');
            $data['tipo'] = $this->input->get_post('tipo');
            $data['aInicio'] = $this->input->get_post('aInicio');
            $data['aFinal'] = $this->input->get_post('aFinal');
            $data['id_mapa'] = $this->input->get_post('mapa');
            $data["ruta_imagen"] = $this->ModelCalles->get_img($data['id_mapa']);
            $data["viewName"] = "insert_coords";
            $this->load->view('template', $data);
        }
        // esta es la funcion que inserta la calle y los puntos de la calle
        public function insert_street(){
            // recuperar los datos de insert_coords
            $nombre = $this->input->get_post('nombre');
            $tipo = $this->input->get_post('tipo');
            $aInicio = $this->input->get_post('aInicio');
            $aFin = $this->input->get_post('aFinal');
            $id_mapa = $this->input->get_post('idMapa');
            $xCoordjson = $this->input->get_post('x_coord');
            $yCoordjson = $this->input->get_post('y_coord');
            // pasar el json a php array
            $xCoord = json_decode($xCoordjson);
            $yCoord = json_decode($yCoordjson);
            //$next_id_street = ModelCalles->get_ids();
            $next_id_street = $this->ModelCalles->get_next_id();

            $resultado = $this->ModelCalles->insert_street($nombre,$tipo,$aInicio,$aFin,$id_mapa);
            $resultado_dos = $this->ModelCalles->insert_coords($xCoord,$yCoord,$next_id_street);

            if ($resultado <= 0 || $resultado_dos <= 0){
                $data["msg"] = "1";
                $data["mapas_disponibles"] = $this->ModelCalles->get_maps();
                $data["listaCalles"] = $this->ModelCalles->get_all();
                $data["viewName"] = "admin_streets";
                $this->load->view('template', $data);
            }else{
                $data["mapas_disponibles"] = $this->ModelCalles->get_maps();
                $data["listaCalles"] = $this->ModelCalles->get_all();
                $data["viewName"] = "admin_streets";
                $this->load->view('template', $data);
            }
        }

        public function delete_street($id){
            $resultado = $this->ModelCalles->delete_street($id);

            if($resultado == 0){
                $data["msg"] = "1";
                $data["mapas_disponibles"] = $this->ModelCalles->get_maps();
                $data["listaCalles"] = $this->ModelCalles->get_all();
                $data["viewName"] = "admin_streets";
                $this->load->view('template', $data);
            }else{
                $data["msg"] = "0";
                $data["mapas_disponibles"] = $this->ModelCalles->get_maps();
                $data["listaCalles"] = $this->ModelCalles->get_all();
                $data["viewName"] = "admin_streets";
                $this->load->view('template', $data);
            }
        }

        public function get_maps(){
            $data["mapas"] = $this->ModelCalles->get_maps_img();
            $data["viewName"] = "superponer";
            $this->load->view('template', $data);
            
        }
   } // cierro la class Streets
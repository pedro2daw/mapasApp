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
            $data["mapas_disponibles"] = $this->modelCalles->get_maps();
            $data["listaCalles"] = $this->modelCalles->get_all();
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
            $data["ruta_imagen"] = $this->modelCalles->get_img($data['id_mapa']);
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
            //$next_id_street = modelCalles->get_ids();
            $next_id_street = $this->modelCalles->get_next_id();

           $resultado = $this->modelCalles->insert_street($nombre,$tipo,$aInicio,$aFin,$id_mapa,$xCoord,$yCoord,$next_id_street);

            if ($resultado == false){
                echo("<h3>ERROR AL INSERTAR LA CALLE<h3>");
                $data["mapas_disponibles"] = $this->modelCalles->get_maps();
                $data["listaCalles"] = $this->modelCalles->get_all();
                $data["viewName"] = "admin_streets";
                $this->load->view('template', $data);
            }else{
                $data["mapas_disponibles"] = $this->modelCalles->get_maps();
                $data["listaCalles"] = $this->modelCalles->get_all();
                $data["viewName"] = "admin_streets";
                $this->load->view('template', $data);
            }
        }

        public function delete_street($id){
            $resultado = $this->modelCalles->delete_street($id);

            if($resultado == 0){
                echo "<h3>Error al eliminar la calle</h3>";
                $data["mapas_disponibles"] = $this->modelCalles->get_maps();
                $data["listaCalles"] = $this->modelCalles->get_all();
                $data["viewName"] = "admin_streets";
                $this->load->view('template', $data);
            }else{
                echo "<h3>Calle eliminada con éxtio</h3>";
                $data["mapas_disponibles"] = $this->modelCalles->get_maps();
                $data["listaCalles"] = $this->modelCalles->get_all();
                $data["viewName"] = "admin_streets";
                $this->load->view('template', $data);
            }
        }

   } // cierro la class Streets
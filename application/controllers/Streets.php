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
            $data["img_mapas"] = $this->modelCalles->get_maps_img();
            $data["listaMapas"] = $this->modelMapas->get_all();
            $data["listaCalles"] = $this->modelCalles->get_all();
            $data["viewName"] = "insert_coords";
            $this->load->view('template', $data);
        }

        public function form_update_map() {
            $data['datosMapa'] = $this->modelMapas->get($id);
            echo json_encode($data['datosMapa']);
        }

        // este es la funcion del formulario de la clase modal, que nos manda a la insercion de las coordenadas //
        public function insert_street(){
            $nombre= $this->input->post('nombre');
            $tipo = $this->input->post('via');

            $r = $this->modelCalles->insert_street($nombre,$tipo);
            if ($r == 0){
                $data["msg"] = "1";
                $data["listaMapas"] = $this->modelMapas->get_all();
                $data["listaCalles"] = $this->modelCalles->get_all();
                
            } else {
                $data = $this->modelCalles->get_last();
                $data['msg'] = '0';
                echo json_encode($data);
            }
        }

        public function update_street() {
            $id = $this->input->post('id');
            $nombre= $this->input->post('nombre');
            $tipo = $this->input->post('via');
            
            $r = $this->modelCalles->update_street($id,$nombre,$tipo);
            if ($r == 0){
                $data["msg"] = "1";
                $data["listaMapas"] = $this->modelMapas->get_all();
                $data["listaCalles"] = $this->modelCalles->get_all();
                
            } else {
                $data = $this->modelCalles->get($id);
                $data['msg'] = '0';
                echo json_encode($data);
            }
        }

        public function delete_street() {
            $id = $this->input->post('id');
            
            $r = $this->modelCalles->delete_street($id);
            if ($r == 0){
                $data["msg"] = "1";
                $data["listaMapas"] = $this->modelMapas->get_all();
                $data["listaCalles"] = $this->modelCalles->get_all();
                
            } else {
                $data['msg'] = '0';
                echo json_encode($data['msg']);
            }   
        }

        public function insert_coords() {
            $x = $this->input->post('x');
            $y = $this->input->post('y');
            $mapas = json_decode($this->input->post('id_mapas'));
            $id_calle = $this->input->post('id_calle');
            
            var_dump($x);
            var_dump($y);
            var_dump($mapas);
            var_dump($id_calle);
            $r = $this->modelCalles->insert_coords($x,$y,$id_calle,$mapas);
            
            if ($r == 0){
                $data["msg"] = "1";
                $data["listaMapas"] = $this->modelMapas->get_all();
                $data["listaCalles"] = $this->modelCalles->get_all();
                
            } else {
                $data['msg'] = '0';
                echo json_encode($data['msg']);
            }   
        }
        
        
        // esta es la funcion que inserta la calle y los puntos de la calle
        /*public function insert_street(){
            // recuperar los datos de insert_coords            
            $xCoordjson = $this->input->get_post('x_coord');
            $yCoordjson = $this->input->get_post('y_coord');
            // pasar el json a php array
            $xCoord = json_decode($xCoordjson);
            $yCoord = json_decode($yCoordjson);
            //$next_id_street = modelCalles->get_ids();
            $next_id_street = $this->modelCalles->get_next_id();

            // $resultado = $this->modelCalles->insert_street($nombre,$tipo,$aInicio,$aFin,$id_mapa);
            $r2 = $this->modelCalles->insert_coords($xCoord,$yCoord,$next_id_street);

            if ($r2 == 0){
                $data["msg"] = "1";
                $data["mapas_disponibles"] = $this->modelCalles->get_maps();
                $data["listaCalles"] = $this->modelCalles->get_all();
                $data["viewName"] = "admin_streets";
                $this->load->view('template', $data);
            }else{
                $data["msg"] = "0";
                $data["mapas_disponibles"] = $this->modelCalles->get_maps();
                $data["listaCalles"] = $this->modelCalles->get_all();
                $data["viewName"] = "admin_streets";
                $this->load->view('template', $data);
            }
        }

        public function delete_street($id){
            $resultado = $this->modelCalles->delete_street($id);

            if($resultado == 0){
                $data["msg"] = "1";
                $data["mapas_disponibles"] = $this->modelCalles->get_maps();
                $data["listaCalles"] = $this->modelCalles->get_all();
                $data["viewName"] = "admin_streets";
                $this->load->view('template', $data);
            }else{
                $data["msg"] = "0";
                $data["mapas_disponibles"] = $this->modelCalles->get_maps();
                $data["listaCalles"] = $this->modelCalles->get_all();
                $data["viewName"] = "admin_streets";
                $this->load->view('template', $data);
            }
        }
*/
        public function get_maps(){
            $data["mapas"] = $this->modelCalles->get_maps_img();
            $data["viewName"] = "superponer";
            $this->load->view('template', $data);
        }

        // A PARTIR DE AQUI ES LO DE LA INSERCION DE CALLES. O ALGO ASI:


   } // cierro la class Streets
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
            $id = $this->session->userdata("id");
            $data['nivel'] = $this->ModelUser->getNivel($id);
            $data["img_mapas"] = $this->ModelCalles->get_maps_img();
            $data["lista_calles_no_insertadas"] = $this->ModelCalles->get_not_inserted();
            $data["listaMapas"] = $this->ModelMapas->get_all_ordenados();
            $data["listaCalles"] = $this->ModelCalles->get_all();
            $data["viewName"] = "insert_coords";
            $this->load->view('template', $data);
        }

        public function form_update_map() {
            $data['datosMapa'] = $this->ModelMapas->get($id);
            echo json_encode($data['datosMapa']);
        }

        // este es la funcion del formulario de la clase modal, que nos manda a la insercion de las coordenadas //
        public function insert_street(){
            
            $calle = $this->input->post('calle_nueva');

            $r = $this->ModelCalles->insert_street($calle);
            if ($r == 0){
                $data["msg"] = "1";
                $data["listaMapas"] = $this->ModelMapas->get_all();
                $data["listaCalles"] = $this->ModelCalles->get_all();
                
            } else {
                $data = $this->ModelCalles->get_last();
                $data['msg'] = '0';
                echo json_encode($data);
            }
        }

        public function update_street() {
            $id = $this->input->post('id');
            $nombre= $this->input->post('nombre');
            $tipo = $this->input->post('via');
            
            $r = $this->ModelCalles->update_street($id,$nombre,$tipo);
            if ($r == 0){
                $data["msg"] = "1";
                $data["listaMapas"] = $this->ModelMapas->get_all();
                $data["listaCalles"] = $this->ModelCalles->get_all();
                
            } else {
                $data = $this->ModelCalles->get($id);
                $data['msg'] = '0';
                echo json_encode($data);
            }
        }

        public function update_coords(){
            $y = $this->input->post('y');
            $x = $this->input->post('x');
            $y_aux = $this->input->post('y_aux');
            $x_aux = $this->input->post('x_aux');
            
            
            $r = $this->ModelCalles->update_coord($x, $y, $x_aux, $y_aux);
            
            if ($r == 0){
                $data["msg"] = "1";
                echo json_encode($data);
            } else {
                $data["calles_relacionadas"] = $this->ModelCalles->get_id_calles_relacionadas($x,$y);
                $data['msg'] = '0';
               
                echo json_encode($data);
            }   
        }

        public function get_streets_associated_to_coord(){
            $y = $this->input->post('y');
            $x = $this->input->post('x');
            $data = $this->ModelCalles->get_streets_associated_to_coord($x,$y);
            if ($data == 0){
                $data["msg"] = "1";
                $data["listaMapas"] = $this->ModelMapas->get_all();
                $data["listaCalles"] = $this->ModelCalles->get_all();
            } else {
                $data['msg'] = '0';
                echo json_encode($data);
            }   
        }

        public function delete_street() {
            $id = $this->input->post('id');
            
            $r = $this->ModelCalles->delete_street($id);
            if ($r == 0){
                $data["msg"] = "1";
                $data["listaMapas"] = $this->ModelMapas->get_all();
                $data["listaCalles"] = $this->ModelCalles->get_all();
                
            } else {
                $data['msg'] = '0';
                echo json_encode($data['msg']);
            }   
        }

        public function insert_coords() {
            $x = $this->input->post('x');
            $y = $this->input->post('y');
            $mapas_selected = json_decode($this->input->post('id_mapas_selected'));
            $mapas_unselected = json_decode($this->input->post('id_mapas_unselected'));
            $length = count($mapas_unselected);
            //$length = $length + count($mapas_selected);
            $calles_nuevas = $this->input->post('nuevos_nombres');
            $id_calle = $this->input->post('id_calle');

            if (isset($calles_nuevas)){
            $r1 = $this->ModelCalles->insert_street($calles_nuevas);
            } 
            $r = $this->ModelCalles->insert_coords($x,$y,$id_calle,$mapas_selected, $mapas_unselected);
            if ($r == 0){
                $data["msg"] = "1";
                $data["listaMapas"] = $this->ModelMapas->get_all();
                $data["listaCalles"] = $this->ModelCalles->get_all();
                
            } else {
                // obtiene las calles que acabamos de insertar, las renombradas.
                if ($length >= 1){
                    $data = $this->ModelCalles->last_inserted_calles($length);
                }
                
                $data['msg'] = '0';
                echo json_encode($data);
            }   
        }

        public function link_coords() {
            $x = $this->input->post('x');
            $y = $this->input->post('y');
            $mapas_selected = json_decode($this->input->post('id_mapas_selected'));
            $mapas_unselected = json_decode($this->input->post('id_mapas_unselected'));
            $length = count($mapas_unselected);
            $calles_nuevas = $this->input->post('nuevos_nombres');
        
            $r1 = $this->ModelCalles->insert_street($calles_nuevas);
            
            $r = $this->ModelCalles->insert_coords($x,$y,$mapas_selected, $mapas_unselected);
            if ($r == 0 && $r == 0){
                $data["msg"] = "1";
                $data["listaMapas"] = $this->ModelMapas->get_all();
                $data["listaCalles"] = $this->ModelCalles->get_all();
            } else {
                if ($length > 0){
                    $data = $this->ModelCalles->last_inserted_calles($length);
                }
                $data['msg'] = '0';
                echo json_encode($data);
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
            //$next_id_street = ModelCalles->get_ids();
            $next_id_street = $this->ModelCalles->get_next_id();

            // $resultado = $this->ModelCalles->insert_street($nombre,$tipo,$aInicio,$aFin,$id_mapa);
            $r2 = $this->ModelCalles->insert_coords($xCoord,$yCoord,$next_id_street);

            if ($r2 == 0){
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
*/
        

        // A PARTIR DE AQUI ES LO DE LA INSERCION DE CALLES. O ALGO ASI:
   } // cierro la class Streets
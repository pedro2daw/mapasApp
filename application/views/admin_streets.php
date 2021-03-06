<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class='box'>
            <?php
            if (isset($msg)){
                switch ($msg) {
                    case 0:
                        echo "<div class='alert alert-success' role='alert'> Se ha realizado la operación con éxito.  </div>";
                        break;
                    case 1:
                        echo "<div class='alert alert-danger' role='alert'> Se ha producido un error.  </div>";  
                        break;
                }
            }
            ?>
            </div> <!-- final del div .box -->
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Vía</th>
                            <th scope="col">Nombre</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php 
                    for($i = 0; $i < count($listaCalles);$i++){
                        $each_street = $listaCalles[$i];
                        echo ("<tr><td class='d-none'>".$each_street["id"]."</td>");
                        echo ("<td>".$each_street["tipo"]."</td>");
                        echo ("<td>".$each_street["nombre"]."</td>");
                        echo("<td>");
                        echo anchor("Streets/update_street/".$each_street['id'],"<span class='far fa-edit'></span>","class='btn btn-info'");
                        echo '<a href="#" title="Modificación de coordenadas" data-toggle="popover" data-trigger="focus" data-content="Si desea actualizar las coordenadas de la calle, elimine la calle e insertela de nuevo"><span class="far fa-question-circle"></span></a> ';
                        echo("</td>");  
                        echo("<td>");
                        echo anchor("Streets/delete_street/".$each_street['id'],"<span class='fas fa-trash-alt'></span>","class='btn btn-danger'");
                        echo("</td></tr>");
                    }
                    ?>      
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
    <!-- *********************** INSERCIÓN DE UNA CALLE ************************** -->
    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#streetModal">
    <i class="fas fa-plus-circle" style="font-size:45px;"></i>
    </button>

    <div class="modal fade bd-example-modal-xl" id="streetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Insertar calle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <!-- ****************** CUERPO DEL CUADRO MODAL STREET *********************** --> 
                <?php echo form_open('Streets/insert_coords');?>
                <div class='form-group'>
                    <label for='nombre'>Nombre de la calle</label>
                    <input type='text' class='form-control' placeholder='Introduce el nombre de la calle' name='nombre' id='nombre' required/> 
                </div>

                <div class='form-group'>
                    <label for='tipo'>Tipo de via</label>
                        <select id='tipo' name='tipo' class='form-control'>
                                <option value='Avenida'>Avenida</option>
                                <option value='Calle'>Calle</option>
                                <option value='Callejon'>Callejón</option>
                                <option value='Camino'>Camino</option>
                                <option value='Carretera'>Carretera</option>
                                <option value='Glorieta'>Glorieta</option>
                                <option value='Pasaje'>Pasaje</option>
                                <option value='Paseo'>Paseo</option>
                                <option value='Plaza'>Plaza</option>
                                <option value='Poligono'>Poligono</option>
                                <option value='Rambla'>Rambla</option>
                                <option value='Residencia'>Residencia</option>
                                <option value='Ronda'>Ronda</option>
                                <option value='Travesia'>Travesía</option>
                                <option value='Urbanizacion'>Urbanización</option>
                                <option value='Via'>Via</option>
                        </select>
                </div>

                <div class='form-group'>
                    <label for='aInicio'>Año de inicio</label>
                    <input type='number' min='1' class='form-control' placeholder='Introduce el año de inicio de la calle' name='aInicio' id='aInicio'/> 
                </div>

                <div class='form-group'>
                    <label for='aFin'>Año final</label>
                    <input type='number' min='1' class='form-control' placeholder='Introduce el año final de la calle' name='aFinal' id='aFinal'/> 
                </div>

                <div class='form-group'>
                    <label for='slide_list'>Selecciona la lámina</label>
                    <?php echo form_dropdown('mapa', $mapas_disponibles,'','class="form-control form-control-md"'); ?>
                        <!-- añadir mas adelante que se seleccione un mapa, y en funcion de ese mapa solo salgan las laminas de ese mapa -->
                </div>
                </div> <!-- modal body -->

                <div class='modal-footer'>
                    <input type='reset' class='btn btn-secondary' value='Reestablecer formulario'/>
                    <input type='submit' class='btn btn-primary' value='Siguiente'/>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>

        <!-- ****************** CUERPO DEL CUADRO MODAL *********************** --> 
        <!-- ****************** INSERCIÓN DE UNA CALLE    *********************** -->

        </div>
    </div>
</div>


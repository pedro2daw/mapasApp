<?php 
echo '
<div class="container-fluid">

        <div class="row" style="margin-top:10px;">
        <div class="col-md-12">
            <nav class="nav nav-pills flex-column flex-sm-row">
                <a class="flex-sm-fill text-sm-center nav-link " '.anchor('Maps/hotspots/','Mapas').'></a>
                <a class="flex-sm-fill text-sm-center nav-link" '.anchor('Maps/hotspots/','Puntos de Interés').'></a>
                <a class="flex-sm-fill text-sm-center nav-link active" '.anchor('Streets/view_admin_streets/','Calles').'></a>
                <a class="flex-sm-fill text-sm-center nav-link" href="#">Configuración</a>
            </nav>
        </div>
        </div>


    <br><br><br><br><br>
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Tipo de vía</th>
                        <th scope="col">Año de inicio</th>
                        <th scope="col">Año final</th>
                        <th scope="col">Lámina a la que pertenece</th>
                    </tr>
                </thead>
                <tbody>
                    
                    
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">';

    echo '
    <!-- *********************** INSERCIÓN DE UNA CALLE ************************** -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#streetModal">
    INSERTAR CALLE
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
        <!-- ****************** CUERPO DEL CUADRO MODAL STREET *********************** --> ';

        echo form_open('Streets/insert_street');
        echo "<div class='form-group'>
                <label for='nombre'>Nombre de la calle</label>
                <input type='text' class='form-control' placeholder='Introduce el nombre de la calle' name='nombre' id='nombre' required/> 
            </div>";

        echo "<div class='form-group'>
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
            </div>";

        echo "<div class='form-group'>
                <label for='aInicio'>Año de inicio</label>
                <input type='number' min='1' class='form-control' placeholder='Introduce el año de inicio de la calle' name='aInicio' id='aInicio'/> 
            </div>";

        echo "<div class='form-group'>
            <label for='aFin'>Año final</label>
            <input type='number' min='1' class='form-control' placeholder='Introduce el año final de la calle' name='aFinal' id='aFinal'/> 
        </div>";


        echo"
            <div class='form-group'>
                <label for='slide_list'>Selecciona la lámina</label>";
                
                form_dropdown('lamina', 'class="form-control"');
                //$slides_avialables
                // añadir mas adelante que se seleccione un mapa, y en funcion de ese mapa solo salgan las laminas de ese mapa
        echo"
            </div>";

    echo "
        </div>
            <div class='modal-footer'>
                    <input type='reset' class='btn btn-secondary' value='Reestablecer formulario' />
                    <input type='submit' class='btn btn-primary' value='Siguiente'/>
                </form> 
            </div>
        </div>
    </div>
    </div>

        <!-- ****************** CUERPO DEL CUADRO MODAL *********************** --> 
        <!-- ****************** INSERCIÓN DE UNA CALLE    *********************** -->";

        echo '</div>';
    echo '</div>';
echo '</div>';


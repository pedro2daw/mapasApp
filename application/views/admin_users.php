<script language="javascript">

    $(document).ready( function (){
        $('.btn-update').click( function () {
            var id = $(this).data('id'); 
            console.log(id);
        });
    });
    
</script>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <?php
        if (isset($msg)){
            switch ($msg) {
                case 0:
                    echo "<h4 class='success'> SE HA REALIZADO LA OPERACION CON EXITO </h4>";
                    break;
                case 1:
                    echo "<h4 class='error'> SE HA PRODUCIDO UN ERROR </h4>";
                    break;
            }
        }
            
        ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <nav class="nav nav-pills flex-column flex-sm-row">
                <?php
                echo anchor('Maps/index/','Mapas','class="flex-sm-fill text-sm-center nav-link"');
                echo anchor('Maps/hotspots/','Puntos de Interés','class="flex-sm-fill text-sm-center nav-link"');
                echo anchor('Streets/view_admin_streets/','Calles','class="flex-sm-fill text-sm-center nav-link"');
                echo anchor('Maps/users/','Configuración','class="flex-sm-fill text-sm-center nav-link active"');
                ?>
            </nav>
        </div>
    </div>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_insert">
        Insertar Mapa
    </button>

    <input type="submit" class="btn btn-primary" value="Superponer Mapas" />


    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Usuario</th>
                        <th scope="col">Contraseña</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                for($i = 0; $i < count($ListaMapas);$i++){
                    $mapa = $ListaMapas[$i];
                    echo ("<tr>");
                    echo ("<td>".$mapa["id"]."</td>");
                    echo ("<td><img src='".base_url($mapa["imagen"])."' class='thumbnail_mapa'></td>");
                    echo ("<td>".$mapa["titulo"]."</td>");
                    echo ("<td>".$mapa["ciudad"]."</td>");
                    echo ("<td>".$mapa["fecha"]."</td>");
                    echo ("<td>".$mapa["descripcion"]."</td>");
                    echo("<td>");
                            echo anchor("Maps/form_update_map/".$mapa['id'],"<span class='far fa-edit'></span>","class='btn-update btn btn-info' data-toggle='modal' data-target='#modal_update' data-id='".$mapa['id']."'");
                    echo("</td>");  
                    echo("<td>");
                            echo anchor("Maps/delete_map/".$mapa['id'],"<span class='fas fa-trash-alt'></span>","class='btn btn-danger'");
                    echo("</td>");
                    echo("</tr>");
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- *********************** INSERCIÓN DE UN USUARIO ************************** -->
    <div class="modal fade" id="modal_insert" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Insertar un mapa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!-- ****************** CUERPO DEL CUADRO MODAL INSERT *********************** -->
                    <?php echo form_open_multipart('Maps/insert','class="ui-filterable"'); ?>

                    <div class='form-group'>
                        <label for='titulo'>Usuario</label>
                        <input type='text' class='form-control' placeholder='Introduce un título' name='titulo' id='titulo' value='1' required />
                    </div>
                    <div class='form-group'>
                        <label for='descripcion'>Contraseña</label>
                        <input type='text' class='form-control' placeholder='Introduce una descripción' name='descripcion' id='descripcion' value='1' required />
                    </div>
                    <div class='form-group'>
                        <label for='fecha'>Nivel</label>
                        <input type='number' class='form-control' placeholder='Nivel' min='0' name='nivel' id='nivel' value='1' required />
                    </div>
                    <br />

                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                        <?php echo form_submit('submit', 'Insertar Usuario',"class='btn btn-primary'"); ?>
                    </div>
                    <?php 
                            echo form_close(); 
                            ?>
                </div>
            </div> <!-- cierra el modal body -->
        </div>
    </div> <!-- modal_insert -->

    <!-- MODAL DEL UPDATE USERS : -->
    <div class="modal fade" id="modal_insert" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Modificar usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!-- ****************** CUERPO DEL CUADRO MODAL UPDATE *********************** -->
                    <?php echo form_open_multipart('Maps/insert','class="ui-filterable"'); ?>

                    <div class='form-group'>
                        <label for='titulo'>Usuario</label>
                        <input type='text' class='form-control' placeholder='Introduce un título' name='titulo' id='titulo' value='1' required />
                    </div>
                    <div class='form-group'>
                        <label for='descripcion'>Contraseña</label>
                        <input type='text' class='form-control' placeholder='Introduce una descripción' name='descripcion' id='descripcion' value='1' required />
                    </div>
                    <div class='form-group'>
                        <label for='fecha'>Nivel</label>
                        <input type='number' class='form-control' placeholder='Nivel' min='0' name='nivel' id='nivel' value='1' required />
                    </div>
                    <br />

                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                        <?php echo form_submit('submit', 'Modificar Usuario',"class='btn btn-primary'"); ?>
                    </div>
                    <?php 
                            echo form_close(); 
                            ?>
                </div>
            </div> <!-- cierra el modal body -->
        </div>
    </div> <!-- modal_insert -->

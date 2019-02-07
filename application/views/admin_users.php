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

    <button type="button" id="boton_usuario" class="btn btn-primary" data-toggle="modal" data-target="#modal_insert">
        Insertar Usuario
    </button>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Contraseña</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                for($i = 0; $i < count($ListaUsuarios);$i++){
                    $usuario = $ListaUsuarios[$i];
                    echo ("<tr>");
                    echo ("<td>".$usuario["id"]."</td>");
                    echo ("<td>".$usuario["username"]."</td>");
                    echo ("<td>".$usuario["passwd"]."</td>");
                    echo ("<td>");
                            echo anchor("Maps/form_update_user/".$usuario['id'],"<span class='far fa-edit'></span>","class='btn-update btn btn-info' data-toggle='modal' data-target='#modal_update' data-id='".$usuario['id']."'");
                    echo ("</td>");  
                    echo ("<td>");
                            echo anchor("Maps/delete_user/".$usuario['id'],"<span class='fas fa-trash-alt'></span>","class='btn btn-danger'");
                    echo ("</td>");
                    echo ("</tr>");
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
                    <h5 class="modal-title" id="exampleModalCenterTitle">Insertar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!-- ****************** CUERPO DEL CUADRO MODAL INSERT *********************** -->
                    <?php echo form_open_multipart('Maps/insert_user','class="ui-filterable"'); ?>
                    
                    <div class='form-group'>
                        <label for='titulo'>Usuario</label>
                        <input type='text' class='form-control' placeholder='Introduce un usuario' name='usuairo' id='usuario' value='1' required />
                    </div>
                    <div class='form-group'>
                        <label for='descripcion'>Contraseña</label>
                        <input type='text' class='form-control' placeholder='Introduce una contraseña' name='contrasena' id='contrasena' value='1' required />
                    </div>
                    <div class='form-group'>
                        <label for='fecha'>Nivel</label>
                        <input type='number' class='form-control' placeholder='Nivel' name='nivel' id='nivel' value='1' min='1' max='2' required />
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

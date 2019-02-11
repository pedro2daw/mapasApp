<script>
    $(document).ready(function(){
        $(".btn-update").on("click", function(){
            var cont = new Array();
            var id = $(this).attr("data-id");
            $(".fila" + id).each( function() {
                cont.push($(this).text());
            });
            var usu = cont[1];
            var contra = cont[2];
            var niv = cont[3];
            $("#usuarioMod").val(usu);
            $("#contrasenaMod").val(contra);
            $("#nivelMod").val(niv);
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
                    echo "<h4 class='success' style='color:red;'> SE HA REALIZADO LA OPERACION CON EXITO </h4>";
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
                echo anchor('Hotspots/view_hotspots/','Puntos de Interés','class="flex-sm-fill text-sm-center nav-link"');
                echo anchor('Streets/view_admin_streets/','Calles','class="flex-sm-fill text-sm-center nav-link"');
                echo anchor('Users/view_users/','Configuración','class="flex-sm-fill text-sm-center nav-link active"');
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
                        <th scope="col">Nivel</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                for($i = 0; $i < count($ListaUsuarios);$i++){
                    $usuario = $ListaUsuarios[$i];
                    echo ("<tr>");
                    echo ("<td class='fila".$usuario["id"]."'>".$usuario["id"]."</td>");
                    echo ("<td class='fila".$usuario["id"]."'>".$usuario["username"]."</td>");
                    echo ("<td class='fila".$usuario["id"]."'>".$usuario["passwd"]."</td>");
                    echo ("<td class='fila".$usuario["id"]."'>".$usuario["nivel"]."</td>");
                    echo ("<td>");
                            echo anchor("Users/update_user/".$usuario['id'],"<span class='far fa-edit'></span>","class='btn-update btn btn-info' data-toggle='modal' id='update_button' data-target='#modal_mod' data-id='".$usuario['id']."'");
                    echo ("</td>");  
                    echo ("<td>");
                            echo anchor("Users/delete_user/".$usuario['id'],"<span class='fas fa-trash-alt'></span>","class='btn btn-danger'");
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
                    <?php echo form_open_multipart('Users/insert_user','class="ui-filterable"'); ?>

                    <div class='form-group'>
                        <label for='usuarioIns'>Usuario</label>
                        <input type='text' class='form-control' placeholder='Introduce un nombre de usuario' name='usuarioIns' id='usuarioIns' required />
                    </div>
                    <div class='form-group'>
                        <label for='contrasenaIns'>Contraseña</label>
                        <input type='text' class='form-control' placeholder='Introduce una contraseña' name='contrasenaIns' id='contrasenaIns' required />
                    </div>
                    <div class='form-group'>
                        <label for='nivelIns'>Nivel</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Nivel permiso</label>
                            </div>
                            <select class="custom-select" id="nivelIns" name="nivelIns">
                                <option value="1" selected>Usuario</option>
                                <option value="2">Administrador</option>
                            </select>
                        </div>
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
    <div class="modal fade" id="modal_mod" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    <?php echo form_open_multipart('Users/update_user','class="ui-filterable"'); ?>

                    <div class='form-group'>
                        <label for='usuarioMod'>Usuario</label>
                        <input type='text' class='form-control' placeholder='Introduce un nombre de usuario nuevo' name='usuarioMod' id='usuarioMod' required />
                    </div>
                    <div class='form-group'>
                        <label for='contrasenaMod'>Contraseña</label>
                        <input type='text' class='form-control' placeholder='Introduce una contraseña nueva' name='contrasenaMod' id='contrasenaMod' required />
                    </div>
                    <div class='form-group'>
                        <label for='nivelMod'>Nivel</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Nivel permiso</label>
                            </div>
                            <select class="custom-select" id="nivelMod" name="nivelMod">
                                <option value="1" selected>Usuario</option>
                                <option value="2">Administrador</option>
                            </select>
                        </div>
                    </div>
                    <?php echo "<input type='hidden' id='idMod' name='idMod' value='" .$usuario['id']. "'>"; ?>
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

    <script>
        $(document).ready(function() {
            $('#enlace_usuarios').toggleClass('active');
            $("#usuarioIns").on("change", function() {
                var usu = $("#usuarioIns").val();
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url(); ?>index.php/Users/check_user/" + usu,
                    success: function(r) {
                        if (r == 0) {
                            $("#submitUsuIns").prop("disabled", false);
                        } else {
                            
                            $("#submitUsuIns").prop("disabled", true);
                        }
                    }
                })
            });
            
            $("#usuarioMod").on("change", function() {
                var usu = $("#usuarioMod").val();
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url(); ?>index.php/Users/check_user/" + usu,
                    success: function(r) {
                        if (r == 0) {
                            $("#submitUsuMod").prop("disabled", false);
                        } else {
                            $("#submitUsuMod").prop("disabled", true);
                        }
                    }
                })
            });
            
        });

    </script>

    <div class="container-fluid">
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
                        case 2:
                            echo "<div class='alert alert-danger' role='alert'> No puedes borrar el usuario que se está usando actualmente.  </div>";  
                            break;
                    }
                }
                ?>
        </div> <!-- final del div .box -->
        <div class="row">
            <div class="col-md-12 botones">
                <button type="button" id="boton_usuario" class="btn btn-primary" data-toggle="modal" data-target="#modal_insert"> Insertar Usuario </button>
            </div>
        </div>

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
                    echo ("<td>*****</td>");
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
                            <input type="submit" name="submit" id="submitUsuIns" value="Insertar Usuario" class="btn btn-primary">
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
                            <input type="submit" name="submit" id="submitUsuMod" value="Insertar Usuario" class="btn btn-primary">
                        </div>
                        <?php 
                            echo form_close(); 
                            ?>
                    </div>
                </div> <!-- cierra el modal body -->
            </div>
        </div> <!-- modal_insert -->

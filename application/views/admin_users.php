    <script>
        $(document).ready(function() {
            $('#enlace_usuarios').toggleClass('active');
            
            $('#tabla_usuarios').DataTable({
        "language": {
            "search": "Buscador:",
            "info": "Mostrando de _START_ - _END_ de _TOTAL_ entrada(s).",
            "emptyTable": "No hay datos disponibles",
            "infoEmpty":      "",
            "loadingRecords": "Cargando...",
            "processing":     "Procesando petición...",
            "zeroRecords":    "No se encuentran coincidencias",
            "lengthMenu":     "Mostrar _MENU_ entradas",
            "paginate": {
                "first":      "<<",
                "last":       ">>",
                "next":       ">",
                "previous":   "<"
            },
        }
    });
    
        // Establecemos un placeholder para el buscador.
        $("input[type='search']").attr('placeholder','Buscar Usuario');
        $("select[name='tabla_usuarios_length']").addClass("form-control form-control-sm");
        // Añadimos la clase form-control para que el buscador tenga el aspecto de bootstrap.
        $("input[type='search']").addClass('form-control');
    

            $(document).on("click",'#btn_update', function(){
                $("#submitUsuMod").prop("disabled", true);
                $(".msg").html("");
                 id  = $(this).data('id');
                 console.log('id' + id);
                 username = $('#user_'+id).text();
                 nivel = $('#nivel_'+id).text();
                $('#nivelMod').val(nivel);
                $("#idMod").val(id);
                $("#usuarioMod").val(username);

                console.log(nivel);
            });

            $("#usuarioIns").on("change", function () {
                var usu = $("#usuarioIns").val();
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url(); ?>index.php/Users/check_user/" + usu,
                    success: function(r) {
                        if (r == 0) {
                            $("#submitUsuIns").prop("disabled", false);
                            $(".msg").html("<p class='success'> Este nombre de usuario es válido. </p>");
                        } else {
                            $(".msg").html("<p class='error'> Este nombre de usuario ya existe en la base de datos. </p>");
                            $("#submitUsuIns").prop("disabled", true);
                        }
                    }
                })
            });

            $("#usuarioMod").on("change", function () {
                var usu = $(this).val();
                $.ajax({
                    type: "post",
                    url: "<?php echo base_url(); ?>index.php/Users/check_user/" + usu,
                    success: function(r) {
                        if (r == 0) {
                            $("#submitUsuMod").prop("disabled", false);
                            $(".msg").html("<p class='success'> Este nombre de usuario es válido. </p>");

                        } else {
                        
                            if (usu == username){
                            $(".msg").html("");
                            } else {
                            console.log('llega');
                            $(".msg").html("<p class='error'> Este nombre de usuario ya existe en la base de datos. </p>");
                            $("#submitUsuMod").prop("disabled", true);
                            }
                        }
                    }
                })
            });

            function enable () {
                $("#submitUsuMod").prop("disabled", false);
            }

            $("#contrasenaMod").on("change", enable);
            $("#nivelMod").on("change", enable);
           
            
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
                <table id='tabla_usuarios' class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Nivel</th>
                            <th scope="col">Modificar</th>
                            <th scope="col">Eliminar</th>
                            <th class="d-none"></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                for($i = 0; $i < count($ListaUsuarios);$i++){
                    $usuario = $ListaUsuarios[$i];
                    echo ("<tr>");
                    echo ("<td class='fila".$usuario["id"]."'>".$usuario["id"]."</td>");
                    echo ("<td id='user_".$usuario["id"]."' class='fila".$usuario["id"]."'>".$usuario["username"]."</td>");
                    if ($usuario["nivel"] == 2){
                        echo ("<td class='fila".$usuario["id"]."'> Administrador </td>");
                    } else {
                        echo ("<td class='fila".$usuario["id"]."'> Usuario Básico </td>");
                    }
                    echo ("<td id='nivel_".$usuario["id"]."'class='d-none fila".$usuario["id"]."'>".$usuario["nivel"]."</td>");
                    echo ("<td>");
                    echo anchor("Users/update_user/".$usuario['id'],"<span class='far fa-edit'></span>","  data-id='".$usuario['id']."'id='btn_update' class='btn-update btn bg-transparent ' data-toggle='modal'  data-target='#modal_mod'");
                    echo ("</td>");  
                    echo ("<td>");
                    echo anchor("Users/delete_user/".$usuario['id'],"<span class='fas fa-trash-alt text-danger'></span>","id='btn_delete' class='btn bg-transparent'");
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
                        <h5 class="modal-title" id="exampleModalCenterTitle">Insertar usuario</h5>
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
                            <div class='msg'> </div>                        
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
                                    <option value="1" selected>Usuario Básico</option>
                                    <option value="2">Administrador</option>
                                </select>
                            </div>
                        </div>
                    
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
                        <?php echo form_open_multipart('Users/update_user','id="form_update" class="ui-filterable"'); ?>

                        <div class='form-group'>
                            <label for='usuarioMod'>Usuario</label>
                            <input type='text' class='form-control' placeholder='Introduce un nombre de usuario nuevo' name='usuarioMod' id='usuarioMod' required />
                            <div class='msg'> </div>
                        </div>
                        <div class='form-group'>
                            <label for='contrasenaMod'>Contraseña</label>
                            <input type='text' class='form-control' placeholder='Introduce una contraseña nueva' name='contrasenaMod' id='contrasenaMod'/>
                        </div>
                        <div class='form-group'>
                            <label for='nivelMod'>Nivel</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Nivel permiso</label>
                                </div>
                                <select class="custom-select" id="nivelMod" name="nivelMod">
                                    <option value="1" selected>Usuario Básico</option>
                                    <option value="2">Administrador</option>
                                </select>
                            </div>
                        </div>
                        <?php echo "<input type='hidden' id='idMod' name='idMod' value=''>"; ?>
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

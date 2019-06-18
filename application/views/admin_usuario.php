    <script>
        $(document).ready(function() {
            $('#enlace_usuarios').toggleClass('active');
            
            $(document).on("click",'#btn_update', function(){
                $("#submitUsuMod").prop("disabled", true);
                $(".msg").html("");
                 id  = $(this).data('id');
                 username = $('#user_'+id).text();
                 nivel = $('#nivel_'+id).text();
                $("#idMod").val(id);
                $("#usuarioMod").val(username);
            });

            $(document).on("click","#btn-delete",function (e){
            var id = $(this).data("id");
            e.preventDefault();
            swal({
                title: "Precaución",
                text: "Va a borrar el mapa seleccionado, esta operación es irreversible. ¿Desea continuar?",
                icon: "warning",
                buttons: ["No, gracias", "Borrar Mapa"],
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    location.href='<?php echo site_url();?>/Maps/delete_map/'+id;
                }
            });
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
            <div id="fondo_form" class="col-md-6 mx-auto">
                    <?php
                        $usuario = $DatosUsuario[0];
                        echo ("<h5 class='fila".$usuario["id"]." d-none'>".$usuario["id"]."</h5>");
                        echo ("<h5> Nombre de usuario: </h5>");
                        echo ("<p id='user_".$usuario["id"]."' class='fila".$usuario["id"]."'>".$usuario["username"]."</p>");
                        echo ("<h5> Rango: </h5>");
                        echo ("<p class='fila".$usuario["id"]." '> Usuario Básico </p>");
                        echo ("<h5 id='nivel_".$usuario["id"]."' class='d-none fila ".$usuario["id"]."'>".$usuario["nivel"]."</h5>");
                        echo "<div class='btn_flex_wrapper'>";
                        echo anchor("Users/update_user/".$usuario['id'],"<span class='far fa-edit'></span> Modificar mis datos ","  data-id='".$usuario['id']."'id='btn_update' class='btn btn-info btn-update ' data-toggle='modal'  data-target='#modal_mod'");
                        echo anchor("Users/delete_user/".$usuario['id'],"<span class='fas fa-trash-alt'></span> Darme de baja","id='btn_delete' class='btn btn-danger vertical-align'");
                        echo "</div>";
                    ?>
            </div>
        </div>

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
                        <?php echo "<input type='hidden' id='idMod' name='idMod' value='".$usuario['id']."'>"; ?>
                        <br/>

                        <div class='modal-footer'>
                            <input type="submit" name="submit" id="submitUsuMod" value="Modificar datos" class="btn btn-primary">
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div> <!-- cierra el modal body -->
            </div>
        </div> <!-- modal_insert -->

<script language="javascript">
    $(document).ready(function() {
        $(function () {
  $('[data-toggle="tooltip"]').tooltip();
})
$('.msg_seleccionar').attr('title','Este mapa no es el principal. Puede seleccionar este mapa como principal.');
$('#msg_principal').attr('title','Plano sobre el que se van a alinear los otros planos secundarios.');

        $('#enlace_mapas').toggleClass('active');
        $('.alert').fadeIn().delay(4000).fadeOut();
        $('.warning').css({
            'background-color': 'orange'
        });

        $(document).on("click",".btn-delete",function (e){
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

        $('.btn-update').click(function() {
            var id = $(this).data('id');
            var img_src = $('#src_imagen_' + id).attr('src');
            var img = $('#imagen_' + id).data('id-imagen');
            var titulo = $('#titulo_' + id).text();
            var ciudad = $('#ciudad_' + id).text();
            var fecha = $('#fecha_' + id).text();
            var id_paquete = $("#id_paquete_" + id).data('id-p');
            var ancho = $('#ancho_' + id).data('ancho');
            var alto = $('#alto_' + id).data('alto');
            var desv_x = $('#desviacion_x_' + id).data('x');
            var desv_y = $('#desviacion_y_' + id).data('y');

            if (desv_x == '' || desv_y == '') {
                $('#upd_desv_x').val('null');
                $('#upd_desv_y').val('null');
            } else {
                $('#upd_desv_x').val(desv_x);
                $('#upd_desv_y').val(desv_y);
            }

            $('#upd_paquete').val(id_paquete);
            $('#upd_titulo').val(titulo);
            $('#upd_ancho').val(ancho);
            $('#upd_alto').val(alto);
            $('#upd_ciudad').val(ciudad);
            $('#upd_fecha').val(fecha);
            $('#upd_imagen').attr('src', img_src);

            //campos hidden:
            $('#id_update').val(id);
            $('#ruta_original').val(img);

            /*
                $.ajax({
                        type: "post",
                        url: "< ?php echo base_url(); ?>index.php/Maps/form_update_map",       
                        dataType: 'text',
                        data: "id="+id,                        
                        success: function(data) {
                            var a = $.parseJSON(data);
                            console.log('SUCCESS: ', a);
                        },
                        error: function(data) {
                            console.log('ERROR: ', data);
                        },
                    });
            */

            $.ajax({
                type: "post",
                url: "< ?php echo base_url(); ?>index.php/Maps/form_update_map",
                dataType: 'text',
                data: "id=" + id,
                success: function(data) {
                    var a = $.parseJSON(data);
                    console.log('SUCCESS: ', a);
                },
                error: function(data) {
                    console.log('ERROR: ', data);
                },
            });
        });
    });

   



</script>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class='box'>
                <?php
                //VARIABLE NIVEL:
                echo "<div id='nivel' class='d-none'>$nivel</div>";
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
    <?php if ($nivel == 2){ ?>
    <div class="row">
        <div class="col-md-12 botones">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_insert"> <span class="far fa-plus-square"></span> Insertar Mapa </button>
            <?php /*echo anchor('Streets/get_maps/','<span class="fas fa-layer-group"></span> Alinear Mapas','class="btn btn-success" id="alinear_button"');*/
                  echo "<span id='msg_alinear' data-toggle='tooltip' data-placement='bottom'> <button id='alinear_button' class='btn btn-success'>Alinear mapas</button> </span>";
            ?>
           
        </div>
    </div>
    <?php } ?>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Imagen</th>
                <?php if ($nivel == 2){ ?>
                        <th scope="col">Marcar como principal</th>
                <?php   } ?>
                        <th scope="col">Titulo</th>
                        <th scope="col">Fecha</th>
                <?php if ($nivel == 2){ ?>
                        <th scope="col">Modificar</th>
                        <th scope="col">Borrar</th>
                <?php   } ?>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    // compruebo si hay algun mapa marcado como principal //
                    $check_principal = false;
                    for ($j = 0; $j < count($ListaMapas); $j++){
                        $mapa_principal = $ListaMapas[$j];
                        if($mapa_principal["principal"] == true){ $check_principal = true;}
                    }
                    // compruebo si hay algun mapa marcado como principal //

                    // compruebo si hay solo un mapa (o ninguno) insertado para deshabilitar el boton de alinear //
                    if ( count($ListaMapas) < 2 || $check_principal == false){
                        echo("
                            <script>
                                $('#alinear_button').attr('disabled','true');
                                $('#msg_alinear').attr('title','Debes seleccionar un mapa como principal antes de alinear los planos.');
                                
                            </script>
                        ");
                    }
                    // compruebo si hay solo un mapa insertado (o ninguno) para deshabilitar el boton de alinear //
                for($i = 0; $i < count($ListaMapas);$i++){
                    
                    $mapa = $ListaMapas[$i];
                    echo ("<tr>");
                    if (($mapa['desviacion_x'] == null || $mapa['desviacion_y'] == null)&& $mapa["principal"] == false && count($ListaMapas)>1 ){
                    echo ("<td class='ids warning'>".$mapa["id"]." 
                    <a tabindex='0'class='btn btn-md btn-danger' role='button' data-toggle='popover' data-trigger='focus' title='Advertencia'  data-content='Debes alinear los mapas de nuevo'><span class='fas fa-exclamation-triangle'></span></a>
                     </td>");
                    } else{
                    echo ("<td class='ids' >".$mapa["id"]."</td>");
                    }
                    echo ("<td class='d-none' id='imagen_".$mapa["id"]."' data-id-imagen='".$mapa['imagen']."'></td>");
                    echo ("<td class='d-none' id=ancho_".$mapa["id"]." data-ancho='".$mapa['ancho']."'></td>");
                    echo ("<td class='d-none' id='alto_".$mapa["id"]."' data-alto='".$mapa['alto']."'></td>");
                    echo ("<td class='d-none' id=desviacion_x_".$mapa["id"]." data-x='".$mapa['desviacion_x']."'></td>");
                    echo ("<td class='d-none' id='desviacion_y_".$mapa["id"]."' data-y='".$mapa['desviacion_y']."'></td>");
                    echo ("<td><img alt ='Modifica el plano e inserta una imagen' src='".base_url($mapa["imagen"])."' class='thumbnail_mapa' id='src_imagen_".$mapa["id"]."'></td>");
                    if ($nivel == 2){ 
                    if (($check_principal == true && $mapa["principal"] == true)){
                        echo ("<td style='text-align:center;'> <span id='msg_principal' data-toggle='tooltip' data-placement='bottom'> <button class='main btn btn-success' value='".$mapa['id']."' disabled> PRINCIPAL </button> </span> </td>");
                    }
                    else if($check_principal==false){
                        echo ("<td style='text-align:center;'>
                        <a tabindex='1' class='btn btn-md btn-warning alert_principal' role='button' data-toggle='popover' data-trigger='focus' title='Advertencia'  data-content='Debes seleccionar un mapa como principal'><span class='fas fa-exclamation-triangle'></span></a>
                        <span class='msg_seleccionar' data-toggle='tooltip' data-placement='bottom'> <button class='main btn btn-success' value='".$mapa['id']."'>Seleccionar</button> </span></td>");
                        
                    }
                    else{
                       echo("<td style='text-align:center;'>
                       <span class='msg_seleccionar' data-toggle='tooltip' data-placement='bottom'> <button class='main btn btn-secundary' value='".$mapa['id']."'>Seleccionar</button> </span> </td>");
                    }
                    }
                    
                    echo ("<td id=titulo_".$mapa["id"].">".$mapa["titulo"]."</td>");
                    echo ("<td id=fecha_".$mapa["id"].">".$mapa["fecha"]."</td>");
                    if ($nivel == 2){ 
                    echo("<td>");
                    echo anchor("Maps/form_update_map/".$mapa['id'],"<span class='far fa-edit'></span>","class='btn btn-info btn-update' data-toggle='modal' data-target='#modal_update' data-id='".$mapa['id']."' class=''");
                    echo("</td>");  
                    echo("<td>");
                    echo anchor("Maps/delete_map/".$mapa['id'],"<span class='fas fa-trash-alt'></span>","class='btn btn-danger btn-delete' data-id='".$mapa['id']."'");
                    echo("</td>");
                    }
                    echo("</tr>");
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- *********************** INSERCIÓN DE UN MAPA ************************** -->
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
                        <label for='titulo'>Título</label>
                        <input type='text' class='form-control' placeholder='Introduce un título' name='titulo' id='titulo' value='Almeria' required />
                    </div>

                    <div class='form-group'>
                        <label for='fecha'>Año</label>
                        <input type='number' class='form-control' placeholder='Fecha (año)' min='0' name='fecha' id='fecha' value='1900' required />
                    </div>

                    <div class='form-group'>
                        <label for='herencia'>Herencia</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Hereda de</label>
                            </div>
                            <select class="custom-select" id="herencia" name="herencia">
                                <option value="" selected></option>
                                <?php
                                    for($i = 0; $i < count($ListaMapas);$i++){                      
                                        $mapa = $ListaMapas[$i];
                                        echo "<option value='" . $mapa["id"] . "'> " . $mapa["titulo"] . " </option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!-- 
                            <div class='form-group'>
                                <label for='fecha'>Nivel</label>
                                <input type='number' class='form-control' placeholder='Nivel' min='0' name='nivel' id='nivel'
                                    value='1' required />
                            </div>
                            
                            <label for='paquete'>Paquete</label>
                            <a href="#" title="Dismissible popover" data-toggle="popover" data-trigger="focus" data-content="Click anywhere in the document to close this popover"><span class="far fa-question-circle"></span></a>
                            <br/>
                            
                            <button id='btn_crearpaquete' type='button' class='btn btn-secondary'>Crear paquete nuevo</button>
                            <button id='btn_selectpaquete' type='button' class='btn btn-secondary'>Seleccionar un paquete existente</button>
                            
                            
                            <div id='crear_paquete' class='form-group'>
                                <label for='nombre_paquete'>Nombre del Paquete Nuevo:</label>
                                <input type='text' class='form-control' placeholder='Introduce un nombre para el paquete nuevo' name='nombre_paquete'
                                        id='nombre_paquete' value=''/>
                                <label for='descripcion_paquete'>Descripción:</label>

                                <div class="md-form">
                                     <textarea type="text" name='descripcion_paquete' id="descripcion_paquete" class="md-textarea form-control" rows="3"></textarea>
                                </div>

                            </div>

                            <div id='seleccionar_paquete' class='form-group'>
                                <label for='select_paquetes'>Selecciona un paquete:</label>
                            < ?php echo form_dropdown('select_paquetes',$ListaPaquetes ,"1" ,'id="select_paquetes" class="form-control"'); ?>
                             </div>
                            -->
                    <div class='form-group'>
                        <label for='mapa_img'>Subir un Mapa</label>

                        <!-- ***************************** SUBIR UNA IMAGEN ******************** -->
                        <div class="custom-file">
                            <input type="file" name="img_mapa" class="custom-file-input" id="img" lang="es" onchange="openFile(event,'1')" required>
                            <label class="custom-file-label" for="img">Seleccionar Archivo</label>
                        </div>
                        <img id='output' class='img-thumbnail'>
                    </div>

                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                        <?php echo form_submit('submit', 'Insertar Mapa',"class='btn btn-primary'"); ?>
                    </div>
                    <?php 
                            echo form_close(); 
                            ?>
                </div>
            </div> <!-- cierra el modal body -->
        </div>
    </div> <!-- modal_insert -->

    <!-- MODAL DEL UPDATE MAPS : -->
    <div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Modificar un mapa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <!-- ****************** CUERPO DEL CUADRO MODAL UPDATE *********************** -->
                    <?php echo form_open_multipart('Maps/update'); ?>
                    <div class='form-group'>
                        <label for='titulo'>Título</label>
                        <input type='text' class='form-control' placeholder='Introduce un título' name='upd_titulo' id='upd_titulo' value='1' required />
                    </div>
                    <!--
                            <div class='form-group'>
                                <label for='descripcion'>Descripción</label>
                                <input type='text' class='form-control' placeholder='Introduce una descripción' name='upd_descripcion'
                                    id='upd_descripcion' value='1' required />
                            </div>
                            
                            <div class='form-group'>
                                <label for='ciudad'>Ciudad</label>
                                <input type='text' class='form-control' placeholder='Introduce una Ciudad' name='upd_ciudad'
                                    id='upd_ciudad' value='1' required />
                            </div>
                            -->
                    <div class='form-group'>
                        <label for='fecha'>Fecha</label>
                        <input type='number' class='form-control' placeholder='Fecha (año)' min='0' name='upd_fecha' id='upd_fecha' value='1' required />
                    </div>
                    <!--
                            <div class='form-group'>
                                <label for='fecha'>Nivel</label>
                                <input type='number' class='form-control' placeholder='Nivel' min='0' name='nivel' id='upd_nivel'
                                    value='1' required />
                            </div>
                            
                            <label for='paquete'>Paquete</label>
                            <a href="#" title="Dismissible popover" data-toggle="popover" data-trigger="focus" data-content="Click anywhere in the document to close this popover"><span class="far fa-question-circle"></span></a>
                            <br/>
                            <div id='seleccionar_paquete' class='form-group'>
                                <label for='select_paquetes'>Selecciona un paquete:</label>
                            < ?php 
                                echo form_dropdown('upd_paquete',$ListaPaquetes ,"",'id="upd_paquete" class="form-control"');
                            ?>
                             </div>
                            -->

                    <!-- CAMPOS HIDDEN -->
                    <input type='hidden' name='id_update' id='id_update' value='' />
                    <input type='hidden' name='ruta_original' id='ruta_original' value='' />
                    <input type='hidden' name='upd_ancho' id='upd_ancho' value='' />
                    <input type='hidden' name='upd_alto' id='upd_alto' value='' />
                    <input type='hidden' name='upd_desv_x' id='upd_desv_x' value='' />
                    <input type='hidden' name='upd_desv_y' id='upd_desv_y' value='' />
                    <div class='form-group'>
                        <label for='mapa_img'>Subir un Mapa</label>

                        <!-- ***************************** SUBIR UNA IMAGEN ******************** -->
                        <div class="custom-file">
                            <input type="file" name="upd_img" class="custom-file-input" id="upd_img" lang="es" onchange="openFile(event,'2')">
                            <label class="custom-file-label" for="upd_img">Seleccionar Archivo</label>
                        </div>
                        <img id='upd_imagen' class='img-thumbnail' src=''>
                    </div>

                    <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                        <?php echo form_submit('submit', 'Modificar Mapa',"class='btn btn-primary'"); ?>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>

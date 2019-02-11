

<script language="javascript">
    $(document).ready( function (){
    $('.btn-update').click( function () {
        var id = $(this).data('id'); 

        var img = $('#imagen_'+id).attr('src');
        var titulo = $('#titulo_'+id).text();
        var ciudad = $('#ciudad_'+id).text();
        var fecha = $('#fecha_'+id).text();
        var descripcion = $('#descripcion_'+id).text();


        $('#upd_titulo').val(titulo);
        $('#upd_descripcion').val(descripcion);
        $('#upd_ciudad').val(ciudad);
        $('#upd_fecha').val(fecha);
        $('#upd_imagen').attr('src',img);


                   /* $.ajax({
                        type: "post",
                        url: "<?php echo base_url(); ?>index.php/Maps/form_update_map",       
                        dataType: 'text',
                        data: "id="+id,                        
                        success: function(data) {
                            var a = $.parseJSON(data);
                            var titulo = a.titulo;
                            var descripcion = a.descripcion;
                            var ciudad = a.ciudad;
                            var fecha = a.fecha;
                            var img = "<?php echo base_url(); ?>"+a.imagen;
                        
                            $('#upd_titulo').val(titulo);
                            $('#upd_descripcion').val(descripcion);
                            $('#upd_ciudad').val(ciudad);
                            $('#upd_fecha').val(fecha);
                            $('#upd_imagen').attr('src',img);
                            console.log('SUCCESS: ', a);
                        },
                        error: function(data) {
                            console.log('ERROR: ', data);
                        },
                    });
                    */
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
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">A</a></li>
                    <li class="page-item"><a class="page-link" href="#">B</a></li>
                    <li class="page-item"><a class="page-link" href="#">C</a></li>
                    <li class="page-item"><a class="page-link" href="#">D</a></li>
                    <li class="page-item"><a class="page-link" href="#">E</a></li>
                    <li class="page-item"><a class="page-link" href="#">F</a></li>
                    <li class="page-item"><a class="page-link" href="#">G</a></li>
                    <li class="page-item"><a class="page-link" href="#">H</a></li>
                    <li class="page-item"><a class="page-link" href="#">I</a></li>
                    <li class="page-item"><a class="page-link" href="#">J</a></li>
                    <li class="page-item"><a class="page-link" href="#">K</a></li>
                    <li class="page-item"><a class="page-link" href="#">L</a></li>
                    <li class="page-item"><a class="page-link" href="#">M</a></li>
                    <li class="page-item"><a class="page-link" href="#">N</a></li>
                    <li class="page-item"><a class="page-link" href="#">Ñ</a></li>
                    <li class="page-item"><a class="page-link" href="#">O</a></li>
                    <li class="page-item"><a class="page-link" href="#">P</a></li>
                    <li class="page-item"><a class="page-link" href="#">Q</a></li>
                    <li class="page-item"><a class="page-link" href="#">R</a></li>
                    <li class="page-item"><a class="page-link" href="#">S</a></li>
                    <li class="page-item"><a class="page-link" href="#">T</a></li>
                    <li class="page-item"><a class="page-link" href="#">U</a></li>
                    <li class="page-item"><a class="page-link" href="#">V</a></li>
                    <li class="page-item"><a class="page-link" href="#">W</a></li>
                    <li class="page-item"><a class="page-link" href="#">X</a></li>
                    <li class="page-item"><a class="page-link" href="#">Y</a></li>
                    <li class="page-item"><a class="page-link" href="#">Z</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
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
                        <th scope="col">#</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Ciudad</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Descripción</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                for($i = 0; $i < count($ListaMapas);$i++){
                    $mapa = $ListaMapas[$i];
                    echo ("<tr>");
                    echo ("<td id=id_paquete_".$mapa["id"].">".$mapa["id_paquete"]."</td>");
                    echo ("<td id=nombre_paquete_".$mapa["id"].">".$mapa["nombre"]."</td>");

                    echo ("<td>".$mapa["id"]."</td>");
                    echo ("<td><img src='".base_url($mapa["imagen"])."' class='thumbnail_mapa' id='imagen_".$mapa["id"]."'></td>");
                    echo ("<td id=titulo_".$mapa["id"].">".$mapa["titulo"]."</td>");
                    echo ("<td id=ciudad_".$mapa["id"].">".$mapa["ciudad"]."</td>");
                    echo ("<td id=fecha_".$mapa["id"].">".$mapa["fecha"]."</td>");
                    echo ("<td id=descripcion_".$mapa["id"].">".$mapa["descripcion"]."</td>");
                    echo("<td>");
                            echo anchor("Maps/form_update_map/".$mapa['id'],"<span class='far fa-edit'></span>","class='btn-update btn btn-info' data-toggle='modal' data-target='#modal_update' data-id='".$mapa['id']."' class=''");
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

                        <!-- *********************** INSERCIÓN DE UN MAPA ************************** -->
            <div class="modal fade" id="modal_insert" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                aria-hidden="true">
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
                                <input type='text' class='form-control' placeholder='Introduce un título' name='titulo'
                                    id='titulo' value='1' required />
                            </div>
                            <div class='form-group'>
                                <label for='descripcion'>Descripción</label>
                                <input type='text' class='form-control' placeholder='Introduce una descripción' name='descripcion'
                                    id='descripcion' value='1' required />
                            </div>
                            <div class='form-group'>
                                <label for='ciudad'>Ciudad</label>
                                <input type='text' class='form-control' placeholder='Introduce una Ciudad' name='ciudad'
                                    id='ciudad' value='1' required />
                            </div>
                            <div class='form-group'>
                                <label for='fecha'>Fecha</label>
                                <input type='number' class='form-control' placeholder='Fecha (año)' min='0' name='fecha'
                                    id='fecha' value='1' required />
                            </div>
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
                            <?php 
                                echo form_dropdown('select_paquetes',$ListaPaquetes ,"1" ,'id="select_paquetes" class="form-control"');
                            ?>
                             </div>
                                
                            
                            
                            <div class='form-group'>
                                <label for='mapa_img'>Subir un Mapa</label>

                                <!-- ***************************** SUBIR UNA IMAGEN ******************** -->
                                <div class="custom-file">
                                    <input type="file" name="img_mapa" class="custom-file-input" id="img"
                                        lang="es" onchange="openFile(event,'1')">
                                    <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
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
            <div class="modal fade" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                aria-hidden="true">
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
                                <input type='text' class='form-control' placeholder='Introduce un título' name='titulo'
                                    id='upd_titulo' value='1' required />
                            </div>
                            <div class='form-group'>
                                <label for='descripcion'>Descripción</label>
                                <input type='text' class='form-control' placeholder='Introduce una descripción' name='descripcion'
                                    id='upd_descripcion' value='1' required />
                            </div>
                            <div class='form-group'>
                                <label for='ciudad'>Ciudad</label>
                                <input type='text' class='form-control' placeholder='Introduce una Ciudad' name='ciudad'
                                    id='upd_ciudad' value='1' required />
                            </div>
                            <div class='form-group'>
                                <label for='fecha'>Fecha</label>
                                <input type='number' class='form-control' placeholder='Fecha (año)' min='0' name='fecha'
                                    id='upd_fecha' value='1' required />
                            </div>
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
                            <?php 
                                echo form_dropdown('select_paquetes',$ListaPaquetes ,"$paqueteSeleccionado" ,'id="select_paquetes" class="form-control"');
                            ?>
                             </div>

                            <div class='form-group'>
                                <label for='mapa_img'>Subir un Mapa</label>

                                <!-- ***************************** SUBIR UNA IMAGEN ******************** -->
                                <div class="custom-file">
                                    <input type="file" name="img_mapa" class="custom-file-input" id="upd_img"
                                        lang="es" onchange="openFile(event,'2')">
                                    <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
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

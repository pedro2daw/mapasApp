<?php
/*
var_dump($nombre);
var_dump($tipo);
var_dump($aInicio);
var_dump($aFinal);
var_dump($id_mapa);
var_dump($ruta_imagen);
*/
?>
<script>
    $(document).ready( function (){
    $('.alert').fadeIn().delay(4000).fadeOut();

    $('.calles').click(function(){
        $('.calles').removeClass('selected');
        $(this).toggleClass('selected');
    });

    // ENVIO DE INSERCION DE CALLES:
    $('#form_insert').on('submit',function(e){
    
    var formData = {
    'nombre' : $("#nombre").val(),
    'via' : $("#tipo").val()
    };
    
    
    $.ajax({
        type     : "POST",
        cache    : false,
        url      : "<?php echo base_url(); ?>index.php/Streets/insert_street", //
        data     : formData,
        dataType : 'json',
        encode : true
        })
        // using the done promise callback
        .done(function(data) {
        $('#tabla_calles').append("<tr id='calle_"+data.id+"> <td class='d-none'>"+data.id+"</td> <td class='calles' data-id="+data.id+">"+data.tipo+" "+data.nombre+"</td></tr>");
     });
    // stop the form from submitting the normal way and refreshing the page
     e.preventDefault();
    });
    
    

});

</script>
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
        <div class="col-md-12">
            <?php echo anchor('Streets/view_admin_streets/','Volver al menu', 'class="btn btn-info"')?>
            <button id="show" class="btn btn-info">Mostrar Coordenadas</button>
            <button id="delCoord" class="btn btn-secondary">Borrar última coordenada</button>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#streetModal">
                <span class="fas fa-plus-circle"></span> Insertar Calle </button>
            <!--<button id="saveCoord" class="btn btn-link">Guardar coordenadas</button>-->
        </div>
    </div>

    
    <div class="row">
        <div class="col-md-3">
            <div class="table-responsive">
                <table class="table table-hover" id='tabla_calles'>
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            for($i = 0; $i < count($listaCalles);$i++){
                            $calle = $listaCalles[$i];
                            echo "<tr id=calle_".$calle["id"].">";
                            echo "<td class='d-none'>".$calle["id"]."</td>";
                            echo "<td class='calles' data-id=".$calle["id"].">".$calle["tipo"]." ".$calle["nombre"]."</td>";
                            echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-9 dragscroll" id="prueba">
            <div id="hotspotImg-1" class="responsive-hotspot-wrap">
                <!--<img src="< ########## ? php echo base_url($ruta_imagen);?>" alt="img" id="callejero"> < ? php // añadir la ruta de la imagen traida del formulario -->
            </div>        
        </div>
        
        <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Mapas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <?php 
                            for($i = 0; $i < count($listaMapas);$i++){
                            $mapa = $listaMapas[$i];
                            echo "<tr>";
                            echo "<td class='d-none imagenes' data-imagen_".$i."='".$mapa['imagen']."'> </td>";
                            echo "<td>
                            <figure>
                                <img src='".base_url($mapa["imagen"])."' class='thumbnail_mapa' id='src_imagen_".$mapa["id"]."'>
                                <figcaption>".$mapa["titulo"]."</figcaption>
                            </figure>
                            </td>";
                            echo "<tr>";
                            }
                        ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    </div>
            <h3>Coordenadas</h3>
                <ul id="coord-list">

                </ul>
        <!--
            < ?php
            echo form_open('Streets/insert_street');
            echo "<input type='hidden' value='$nombre' name='nombre'/>
                <input type='hidden' value='$tipo' name='tipo'/>
                <input type='hidden' value='$aInicio' name='aInicio'/>
                <input type='hidden' value='$aFinal' name='aFinal'/>
                <input type='hidden' value='$id_mapa' name='idMapa'/>
                <input type='hidden' value='' name='x_coord' id='x_coord'/>
                <input type='hidden' value='' name='y_coord' id='y_coord'/>
            
                    <input type='reset' class='btn btn-secondary' value='Reestablecer formulario'/>
                    <input type='submit' class='btn btn-info' value='Insertar' id='toJson' />";

            echo form_close();
        
                //echo anchor('Streets/insert_street/'.$nombre.'/'.$tipo.'/'.$aInicio.'/'.$aFinal.'/'.$id_mapa, 'Insertar', 'id="btn-insertar" class="btn btn-success"');
            ?>
            -->


    <div class="row">
    <div class="col-md-12">
    <!-- *********************** INSERCIÓN DE UNA CALLE ************************** -->
    

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
                <?php echo form_open('Streets/insert_street',"id='form_insert'");?>
                <div class='form-group'>
                    <label for='nombre'>Nombre de la calle</label>
                    <input type='text' class='form-control' placeholder='Introduce el nombre de la calle' name='nombre' value='test' id='nombre' required/> 
                </div>

                <div class='form-group'>
                    <label for='tipo'>Tipo de vía</label>
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
                </div> <!-- modal body -->

                <div class='modal-footer'>
                    <input type='reset' class='btn btn-secondary' value='Reestablecer formulario'/>
                    <?php echo form_submit('submit', 'Insertar Mapa',"class='btn btn-primary'"); ?>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>
            <script>
                $("#toJson").click(function(){
                    var jsonx = JSON.stringify(coords_x);
                    var jsony = JSON.stringify(coords_y);

                    $("#x_coord").val(jsonx);
                    $("#y_coord").val(jsony);
                    alert( $("#x_coord").val());
                    /*
                    var url = $("#btn-insertar").attr("href") + "/" + jsonx;
                    $("#btn-insertar").attr("href",url);
                    alert($("#btn-insertar").attr("href"));
                    */
                });                      
            </script>
        </div>
    </div>
</div>




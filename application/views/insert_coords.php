
<script>

// LOS QUE NO TIENEN LOS PUNTOS ESTABLECIDOS:
// SELECT * FROM `calles` WHERE id NOT IN (select id_calle from puntos);

/*
    function changeOpacity(i) : Cambia la opacidad de la imagen con el id  (i) pasado por parámetro.
    Parametros: i = el id de la imagen.
*/
function changeOpacity(i){
        $(document).on("input","#slider_"+i,function(){
         var opacity = $(this).val();
         $(".mapas:eq("+i+")").css("opacity",opacity);
        });
      }

    $(document).ready( function (){
        // Creación dinámica de los input type range que permiten cambiar la opacidad.
        var rutas = <?php echo json_encode($img_mapas); ?>;
        for (i = 0 ; i < rutas.length ; i++ ){
        $("#ranges").append("<input style='float:left; margin-bottom:10px; width:100%;' type='range' id='slider_"+i+"' oninput='changeOpacity("+i+")' value='0' name='points' min='0' max='1' step='0.1'/>");
        }

        // Carga la tabla de calles el plug-in de DataTables.
        $('#tabla_calles').DataTable( {
        "scrollY":        "210px",
        "scrollCollapse": true,
        "paging":         false,
        
        "language": {
            "info": "",
            "infoEmpty":      "",
            "infoFiltered":   "",
            "zeroRecords":    "No se han encontrado resultados"
        }
    });
        // Establecemos un placeholder para el buscador de calles.
        $("input[type='search']").attr('placeholder','Buscar Calle');
        // Eliminamos la etiqueta del input de buscador de calles.
        $('label').contents().first().remove();
        // Añadimos la clase form-control para que el buscador tenga el aspecto de bootstrap.
        $("input[type='search']").addClass('form-control');
        // Cargamos los tooltip de bootstrap:
        $(function () {
         $('[data-toggle="tooltip"]').tooltip();
        });
        // Los botones Update y Delete estarán deshabilitados hasta que se seleccione una calle del listado de calles.
        $('.btn-update').prop('disabled', true);
        $('.btn-delete').prop('disabled', true);

        // Selecciona una calle.
    $(document).on( "click", ".calles",function() {
        id =  $(this).data('id');
        calle = $(this).text();
        nombre = $('#nombre_'+id).text(); 
        tipo = $('#tipo_'+id).text();
        
        console.log("Calle seleccionada " + id);
        $('.calles').removeClass('selected');
        $(this).toggleClass('selected');
        $('.btn-update').prop('disabled', false);
        $('.btn-update').data('id',id);
        $('.btn-delete').prop('disabled', false);
        $('.btn-delete').data('id',id);
    });

    // Inserción de una calle mediante Ajax:
    $('#form_insert').on('submit',function(e){
    var datos_calle_nueva = [{
                                'nombre' : $("#nombre").val(),
                                'via' : $("#tipo").val()
                            }];
    var formData = { 'calle_nueva' : datos_calle_nueva };

    $.ajax({
        type     : "POST",
        cache    : false,
        url      : "<?php echo base_url(); ?>index.php/Streets/insert_street",
        data     : formData,
        dataType : 'json',
        encode : true
        })

        // Si la respuesta de ajax ha sido exitosa mostrará un mensaje de éxito, sino, mostrará un mensaje de error.
        .done(function(data) {
            if (data.msg == '0'){
                $('.box').html('');
                $('.box').append("<div class='alert alert-success' role='alert'> Se ha realizado la operación con éxito.  </div>");
                } else {
                $('.box').html('');
                $('.box').append("<div class='alert alert-danger' role='alert'> Se ha producido un error.  </div>");
            }
            $('.alert').fadeIn().delay(2500).fadeOut();
            $('#modal_insert').modal('toggle');
            $('#tabla_calles').append("<tr id='calle_"+data.id+"'> <td id='tipo_"+data.id+"' class='d-none'>"+data.tipo+"</td><td id='nombre_"+data.id+"' class='d-none'>"+data.nombre+"</td> <td class='calles' data-id="+data.id+">"+data.tipo+" "+data.nombre+"</td> </tr> ");
     });

    // Previene al formulario ejecutarse de manera tradicional y que se refresque la página.
    e.preventDefault();
    });

    // Modificación de una calle mediante Ajax:
    $('.btn-update').click(function () {
        $('#upd_nombre_calle').val(nombre);
        $('#upd_tipo_calle').val(tipo);
        $('#upd_id_calle').val(id);
        $('#form_update').on('submit',function(e){
    
        var formData = {
            'id' : $("#upd_id_calle").val(),
            'nombre' : $("#upd_nombre_calle").val(),
            'via' : $("#upd_tipo_calle").val()
        };

        $.ajax({
            type     : "POST",
            cache    : false,
            url      : "<?php echo base_url(); ?>index.php/Streets/update_street",
            data     : formData,
            dataType : 'json',
            encode : true
            })

            // Si la respuesta de ajax ha sido exitosa mostrará un mensaje de éxito, sino, mostrará un mensaje de error.
            .done(function(data) {
                if (data.msg == '0'){
                    $('.box').html('');
                    $('.box').append("<div class='alert alert-success' role='alert'> Se ha realizado la operación con éxito.  </div>");
                    $('.btn-update').prop('disabled', true);
                    $('.btn-delete').prop('disabled', true);
                } else {
                    $('.box').html('');
                $('.box').append("<div class='alert alert-danger' role='alert'> Se ha producido un error.  </div>");
                }
                $('.alert').fadeIn().delay(2500).fadeOut();
                $('#modal_update').modal('toggle');
                $('#calle_'+data.id).html("<td id='tipo_"+data.id+"' class='d-none'>"+data.tipo+"</td><td id='nombre_"+data.id+"' class='d-none'>"+data.nombre+"</td> <td class='calles' data-id="+data.id+">"+data.tipo+" "+data.nombre+"</td>");
            });

    // Previene al formulario ejecutarse de manera tradicional y que se refresque la página.
    e.preventDefault();
        });
    });
    
    // Borrar una calle mediante ajax:
    $('.btn-delete').click(function(e){
        
        var next = confirm('¿Estás seguro que quieres borrar ' + calle +'?');
        var id = $(this).data('id'); 
        //console.log(id);
        
        if (next){
            $.ajax({
        type     : "POST",
        cache    : false,
        url      : "<?php echo base_url(); ?>index.php/Streets/delete_street",
        data     : 'id='+id,
        dataType : 'text'
        })

        // Si la respuesta de ajax ha sido exitosa mostrará un mensaje de éxito, sino, mostrará un mensaje de error.
        .done(function(data) {
            var msg = $.parseJSON(data);
            if (msg == '0'){
                $('.box').html('');
                $('.box').append("<div class='alert alert-success' role='alert'> Se ha realizado la operación con éxito.  </div>");
                $('.btn-update').prop('disabled', true);
                $('.btn-delete').prop('disabled', true);
            } else {
                $('.box').html('');
                $('.box').append("<div class='alert alert-danger' role='alert'> Se ha producido un error.  </div>");
            }
            $('.alert').fadeIn().delay(2500).fadeOut();
            $('#calle_'+id).html("");
         });
        }
    
    // Previene al formulario ejecutarse de manera tradicional y que se refresque la página.
    e.preventDefault();
    });

    
    $(document).on('change','.cb_mapas', function() {
        var id =  $(this).data('id');
        $('#cb_hidden_'+id).toggle(function(){
            $('.renamed_calle').val('');
        });
    });

    /*
    Botón de inserción de un punto para las calles.
    Seleccionamos una calle del listado de calles.
    Indicamos un punto en el mapa con doble click.
    Indicamos en qué mapas está esa calle con los checkbox.
    Si des-seleccionamos un checkbox podemos indicar que no existe en ese mapa o que ha sido renombrada.
    Si no existe no realizará ninguna acción.
    Si ha sido renombrada, se realizará la inserción de esa nueva calle en el mismo punto.
    */

    $(".btn-insert-coords").on('click', function(){
    var mapas_selected = [];
    var mapas_unselected = [];
    var nuevos_nombres = [];

    /* Recorremos todos los checkbox que NO están chequeados */
    $("input.cb_mapas:checkbox:not(:checked)").each(function() {
        var id_mapa = $(this).val();
        var nombre_nuevo = $('#rename_calle_en_mapa_'+id_mapa).val();
        if (nombre_nuevo != ''){
            nuevos_nombres.push({'nombre' : nombre_nuevo , 'via' : tipo });
            mapas_unselected.push(id_mapa);

        }
    });
    /* Recorremos todos los checkbox que SI están chequeados */
    $('.cb_mapas:checked').each(function() {
    var id = $( this ).val();
    mapas_selected.push(id);
    });

    // Envío de datos mediante ajax:
    console.log('Mapas seleccionados ' + mapas_selected);
    console.log('Calle seleccionada ' + id);

    var id_calle = JSON.stringify(id);
    var json_mapas_selected = JSON.stringify(mapas_selected);
    var json_mapas_unselected = JSON.stringify(mapas_unselected);
    var json_x = JSON.stringify(coords_x[0]);
    var json_y = JSON.stringify(coords_y[0]);

    var formData = {
        'x' : json_x,
        'y' : json_y,
        'id_mapas_selected' : json_mapas_selected,
        'id_mapas_unselected' : json_mapas_unselected,
        'id_calle' : id_calle,
        'nuevos_nombres' : nuevos_nombres
    };
    console.log(formData);

    $.ajax({
        type     : "POST",
        cache    : false,
        url      : "<?php echo base_url(); ?>index.php/Streets/insert_coords",
        data     : formData,
        dataType : 'json',
        encode : true
        })
        .done(function(data) {
            var msg = $.parseJSON(data);
            if (msg == '0'){
                $('.box').html('');
                $('.box').append("<div class='alert alert-success' role='alert'> Se ha realizado la operación con éxito.  </div>");
                $('.btn-update').prop('disabled', true);
                $('.btn-delete').prop('disabled', true);
            } else {
                $('.box').html('');
                $('.box').append("<div class='alert alert-danger' role='alert'> Se ha producido un error.  </div>");
            }
            $('.alert').fadeIn().delay(2500).fadeOut();
        });
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
                    }
                }
        ?>
    </div> <!-- final del div .box -->

    <div class="row">
        <div class="col-md-12">
            <button id="show" class="btn btn-primary">Mostrar Coordenadas</button>
            <button id="delCoord" class="btn btn-secondary">Borrar última coordenada</button>
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal_insert"> <span class="fas fa-plus-circle"></span> Añadir Calle </button>
            <button type='button' class="btn btn-info btn-update" data-toggle='modal' data-target='#modal_update' data-id=''><span class='far fa-edit'></span>Modificar Calle</button>
            <button type='button' class="btn btn-danger btn-delete" data-id='' data-toggle="tooltip" data-placement="bottom" title="Borrar"><span class='fas fa-trash-alt'></span> Borrar Calle</button>
            <button type='button' class="btn btn-info btn-insert-coords" data-id='' data-toggle="tooltip" data-placement="bottom" title="Insertar Coordenadas"><span class='fas fa-trash-alt'></span> Insertar Calle</button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="table-responsive">
                <table class="table table-hover" id='tabla_calles'>
                    <thead>
                        <tr>
                            <th class='d-none' scope="col"></th>
                            <th class='d-none' scope="col"></th>
                            <th scope="col">Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            for($i = 0; $i < count($listaCalles);$i++){
                            $calle = $listaCalles[$i];
                            echo "<tr id=calle_".$calle["id"]." >";
                            echo "<td id='tipo_".$calle["id"]."' class='d-none'>".$calle["tipo"]."</td>";
                            echo "<td id='nombre_".$calle["id"]."' class='d-none'>".$calle["nombre"]."</td>";
                            echo "<td class='calles' data-id=".$calle["id"].">".$calle["tipo"]." ".$calle["nombre"]."</td>";
                            echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div> <!-- fin table-responsive -->

            <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Mapas</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            for($i = 0; $i < count($listaMapas);$i++){
                            $mapa = $listaMapas[$i];
                            echo "<tr data_mapa_id=".$mapa['id']." id=mapa_".$mapa["id"].">";
                            echo "<td>  <label for='mapa_".$mapa["id"]."'>".$mapa['titulo']."</label> <div id='cb_hidden_".$mapa["id"]."' class='cb_hidden'> <label for='mapa_".$mapa["id"]."'>¿Esta calle tiene otro nombre en este mapa? <br/> Deje este campo en blanco si no existe esa calle en este mapa.</label> <input id='rename_calle_en_mapa_".$mapa['id']."' type='text' class='form-control renamed_calle' placeholder='Nombre en este mapa'/> </div> </td>";
                            echo "<td>  <input name='mapa_".$mapa["id"]."' type='checkbox' data-id=".$mapa['id']." class='cb_mapas' id='cb_mapa_".$mapa['id']."' value='".$mapa['id']."' checked> </td>";
                            echo "</tr>";
                            }                            
                        ?>
                    </tbody>
            </table>
            <div id='ranges'>
            </div>
        </div> <!-- fin col md-3 -->

        <div class="col-md-9 dragscroll" id="prueba">
            <div id="hotspotImg-1" class="responsive-hotspot-wrap">
            <?php
                echo "<img class='mapas' id='callejero' data-id='".$i."' data-x='".$img_mapas[0]['desviacion_x']."' data-y='".$img_mapas[0]['desviacion_y']."' style=' top:".$img_mapas[0]['desviacion_y']."px ; left:".$img_mapas[0]['desviacion_x']."px ; z-index:999' src=".base_url($img_mapas[0]['imagen'])." alt='".$img_mapas[0]['titulo']."'>";
            for ($i = 1 ; $i < count($img_mapas) ; $i++){
                $img = $img_mapas[$i];
                echo "<img class='mapas' id='img_".$i."' data-id='".$i."' data-x='".$img['desviacion_x']."' data-y='".$img['desviacion_y']."' src=".base_url($img['imagen'])." alt='".$img['titulo']."' style=' top:".$img['desviacion_y']."px ; left:".$img['desviacion_x']."px ; z-index:".$i."'>";
            }
            ?>
            </div>        
        </div> <!-- fin col md-9 -->
    </div> <!-- fin row -->

    <!-- </div> -->
    <!--  Cuadro modal de inserción de una calle  -->
    <div class="row">
        <div class="col-md-12">
            <div class="modal fade bd-example-modal-xl" id="modal_insert" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Insertar calle</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body">
                        <!-- Cuerpo del cuadro modal: Formulario de Inserción -->
                            <?php echo form_open('Streets/insert_street',"id='form_insert'");?>
                            <div class='form-group'>
                                <label for='nombre'>Nombre de la calle</label>
                                <input type='text' class='form-control' placeholder='Introduce el nombre de la calle' name='nombre' value='' id='nombre' required/> 
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
                        </div> <!-- fin modal footer -->
                    </div> <!-- fin modal content -->
                </div>
            </div>
        </div> <!-- fin col md-12 -->
    </div> <!-- fin row -->
    

    <!--  Cuadro modal de modificación de una calle  -->
    <div class="modal fade bd-example-modal-xl" id="modal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Modificar calle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> 
                <!-- Cuerpo del cuadro modal: Formulario de Modificación -->
                <div class="modal-body">
                    <?php echo form_open('Streets/update_street',"id='form_update'");?>
                    <div class='form-group'>
                        <label for='nombre'>Nombre de la calle</label>
                        <input type='text' class='form-control' placeholder='Introduce el nombre de la calle' name='upd_nombre_calle' value='test' id='upd_nombre_calle' required/> 
                    </div>
                    <input type='hidden' name='upd_id_calle' value='' id='upd_id_calle'/>
                    <div class='form-group'>
                        <label for='upd_tipo_calle'>Tipo de vía</label>
                            <select id='upd_tipo_calle' name='upd_tipo_calle' class='form-control'>
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
                </div> <!-- fin modal body -->
                <div class='modal-footer'>
                    <input type='reset' class='btn btn-secondary' value='Reestablecer formulario'/>
                    <?php echo form_submit('submit', 'Aplicar cambios',"class='btn btn-primary'"); ?>
                    <?php echo form_close();?>
                </div> <!-- fin modal footer -->
            </div> <!-- fin modal content -->
        </div>
    </div>
</div> <!-- fin container fluid -->





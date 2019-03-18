
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

         $("#img_"+i).css("opacity",opacity);
        });
      }

    $(document).ready( function (){

        $(document).on("input","#slider_callejero",function(){
         var opacity = $(this).val();

         $("#img_callejero").css("opacity",opacity);
        });

/* Creación dinámica de los input type range que permiten cambiar la opacidad.
        var rutas = < ?php echo json_encode($img_mapas); ?>;
        for (i = 0 ; i < rutas.length ; i++ ){
        $("#ranges").append("<input style='float:left; margin-bottom:10px; width:100%;' type='range' id='slider_"+i+"' oninput='changeOpacity("+i+")' value='0' name='points' min='0' max='1' step='0.1'/>");
        }
    */
        // Carga la tabla de calles el plug-in de DataTables.
        $('#tabla_calles').DataTable( {
        "scrollY":        "210px",
        "scrollCollapse": true,
        "paging":         false,
        
        "language": {
            "info": "",
            "infoEmpty":      "",
            "infoFiltered":   "",
            "zeroRecords":    "No se encuentran datos"     /* No hay data disponible */
        },
        "columns": [
           { "data": "Tipo" , className: "d-none"  },
           { "data": "Nombre",className: "d-none" },
           { "data": "Punto",className: "d-none" },
           { "data": "Calle" },
       ]
    });
    table = $('#tabla_calles').DataTable();

        // Establecemos un placeholder para el buscador de calles.
        $("input[type='search']").attr('placeholder','Buscar Calle');
        // Eliminamos la etiqueta del input de buscador de calles.
        $('label').contents().first().remove();
        // Añadimos la clase form-control para que el buscador tenga el aspecto de bootstrap.
        $("input[type='search']").addClass('form-control');
        /*
        $("input[type='search']").click( function () {
            $(this).val('').change();           
             });
             */
        // Cargamos los tooltip de bootstrap:
        $(function () {
         $('[data-toggle="tooltip"]').tooltip();
        });
        // Los botones Update y Delete estarán deshabilitados hasta que se seleccione una calle del listado de calles.
        $('.btn-update').prop('disabled', true);
        $('.btn-delete').prop('disabled', true);
        $('.btn-insert-coords').prop('disabled', true);
        $('.cb_mapas').prop('disabled', true);

        $(document).on( "mouseover", ".hot-spot-1",function(e) {
            $('.hot-spot-1').css('cursor', 'pointer');

        });

        $(document).on( "click", ".hot-spot-1",function(e) {

            

            $('#lista_puntos').html('');
            var x = $(this).attr('x');
            var y = $(this).attr('y');
            
            console.log(x + " "+ y);

    var formData = {
        'x' : x,
        'y' : y
        };
    // console.log(formData);

    $.ajax({
        type     : "POST",
        cache    : false,
        url      : "<?php echo base_url(); ?>index.php/Streets/get_streets_associated_to_coord",
        data     : formData,
        dataType : 'json',
        encode : true
        })
        .done(function(data) {
            var msg = data.msg;
            console.log(data);
            var count = Object.keys(data).length;
            $('#modal_puntos').modal('toggle');

            if (msg == '0'){
                for (i = 0; i < count -1 ; i++){
                    $('#lista_puntos').append("<li>" + data[i].tipo + " " + data[i].nombre + " se encuentra en el mapa " + data[i].titulo + "</li>")
                }
            } else {
                }
            
});
e.preventDefault();

});

$('#tabla_calles tbody').on( 'click', 'tr', function () {
   row = table.row( this ).index();
} );


    // Selecciona una calle.
    $(document).on( "click", ".calles",function() {

        // Borra el punto en el mapa:
        var top = $('#prueba').scrollTop();
        var left = $('#prueba').scrollLeft();
        console.log(" ******************* ");
        console.log("top y left "+ top + " " +left );

        $(".hot-spot-1").remove();
        id =  $(this).data('id');
        console.log('id: ' + id);
        calle = $(this).text();
        nombre = $('#nombre_'+id).text(); 
        tipo = $('#tipo_'+id).text();
        x = $('#punto_'+id).data('x');
        y = $('#punto_'+id).data('y');
        
        if (x == null || y == null){
        console.log('Debes insertar un punto');
        } else {
                                        console.log('la x y la y del hotspot: ' + x + " " +y + " zoom: " +zoom);
                                        console.log('la x y la y del hotspot:  DIVIDIDA ' + x/zoom + " " +y/zoom + " zoom: " +zoom);

            $('#img_callejero').after("<div id='id_hot-spot-1'class='hot-spot-1' x='" + x / zoom + "'y='" + y / zoom + "'style='z-index:1000 ; top:" + y+ "px;left:" + x+ "px; display:block;'></div>");
        }
        var offset = $(this).offset();

        
        $('#prueba').scrollTop(y - ($('#prueba').height() /2) ); 
        $('#prueba').scrollLeft(x - ($('#prueba').width() /2)); 
        console.log(offset);


        console.log("Calle seleccionada: " + id);
        console.log('Punto X: ' + x);
        console.log('Punto Y: ' + y);
        $('.calles').removeClass('selected');
        $(this).toggleClass('selected');
        $('.btn-update').prop('disabled', false);
        $('.btn-update').data('id',id);
        $('.btn-delete').prop('disabled', false);
        $('.btn-delete').data('id',id);
        $('.btn-insert-coords').prop('disabled', false);
        $('.cb_mapas').prop('disabled', false);

    });

    $('.btn-anadir').on('click',function(){
        $(".hot-spot-1").remove();
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
    var rowNode = table.row.add( {
        "Tipo": "",
        "Nombre": "",
        "Punto": "",
        "Calle": data.nombre
    } ).draw().node();
      $(rowNode).attr({id: 'calle_'+data.id});
      $(rowNode).find('td').eq(0).attr({id: 'tipo_'+data.id}).text(data.tipo);
      $(rowNode).find('td').eq(1).attr({id: 'nombre_'+data.id}).text(data.nombre);
      $(rowNode).find('td').eq(2).attr({'id': 'punto_'+data.id , 'data-x' : 'null', 'data-y' : 'null' }).text(data.nombre);
      $(rowNode).find('td').eq(3).attr({'id': 'id_calle_warning_'+data.id, 'data-id': data.id}).addClass('calles warning');


                // $("#id_calle_warning_"+data.id).addClass('warning');
                $('.box').html('');
                $('.box').append("<div class='alert alert-success' role='alert'> Se ha realizado la operación con éxito.  </div>");
                // $('#tabla_calles').append("<tr class='d-none' id='calle_"+data.id+"'> <td id='tipo_"+data.id+"' class='d-none'>"+data.tipo+"</td><td  id='nombre_"+data.id+"' class='d-none'>"+data.nombre+"</td> <td id='id_calle_warning_"+data.id+"' class='calles warning' data-id="+data.id+">"+data.tipo+" "+data.nombre+"</td> </tr> ");
                } else {
                $('.box').html('');
                $('.box').append("<div class='alert alert-danger' role='alert'> Se ha producido un error.  </div>");
            }
            $('.alert').fadeIn().delay(2500).fadeOut();
            $('#nombre').val(' ');
            $('#modal_insert').modal('toggle');
            
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
                console.log('si llega al done');
                if (data.msg == '0'){
                    console.log(data);
                    $('.box').html('');
                    $('.box').append("<div class='alert alert-success' role='alert'> Se ha realizado la operación con éxito. </div>");
                    $('.btn-update').prop('disabled', true);
                    $('.btn-delete').prop('disabled', true);
                    
                    table.row('#calle_'+id).remove().draw();
                    var rowNode = table.row.add( {
                            "Tipo": "",
                            "Nombre": "",
                            "Punto": "",
                            "Calle": data.nombre
                        } ).draw().node();
                        $(rowNode).attr({id: 'calle_'+data.id});
                        $(rowNode).find('td').eq(0).attr({id: 'tipo_'+data.id}).text(data.tipo);
                        $(rowNode).find('td').eq(1).attr({id: 'nombre_'+data.id}).text(data.nombre);
                        
            
                    if (x != null){
                        $(rowNode).find('td').eq(2).attr({'id': 'punto_'+data.id , 'data-x' : data.x, 'data-y' : data.y });
                        $(rowNode).find('td').eq(3).attr({'data-id': data.id}).addClass('calles').text(data.tipo + " " + data.nombre );

                        //$('#calle_'+data.id).html("<td id='tipo_"+data.id+"' class='d-none'>"+data.tipo+"</td><td id='nombre_"+data.id+"' class='d-none'>"+data.nombre+"</td> <td class='calles' data-id="+data.id+">"+data.tipo+" "+data.nombre+"</td>");
                       //$('#calle_'+id).append("<td id='punto_"+id+"' class='d-none' data-x='"+x+"' data-y='"+y+"'> </td>");
                    } else {
                        $(rowNode).find('td').eq(2).attr({'id': 'punto_'+data.id , 'data-x' : null, 'data-y' : null });
                        $(rowNode).find('td').eq(3).attr({'data-id': data.id}).addClass('calles warning').text(data.tipo + " " + data.nombre );
                    // $('#calle_'+data.id).html("<td id='tipo_"+id+"' class='d-none'>"+data.tipo+"</td><td id='nombre_"+data.id+"' class='d-none'>"+data.nombre+"</td> <td id='id_calle_warning_"+id+"' class='calles warning' data-id="+data.id+">"+data.tipo+" "+data.nombre+"</td>");
                    }

                } else {
                $('.box').html('');
                $('.box').append("<div class='alert alert-danger' role='alert'> Se ha producido un error.  </div>");
                }
                $('.alert').fadeIn().delay(2500).fadeOut();
                $('#modal_update').modal('toggle');
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
                $('#calle_'+id).html("");
                $(".hot-spot-1").remove();
            } else {
                $('.box').html('');
                $('.box').append("<div class='alert alert-danger' role='alert'> Se ha producido un error.  </div>");
            }
            $('.alert').fadeIn().delay(2500).fadeOut();
            
         });
        }
    
    // Previene al formulario ejecutarse de manera tradicional y que se refresque la página.
    e.preventDefault();
    });

    
    $(document).on('change','.cb_mapas', function() {
        var id =  $(this).data('id');
        $('#cb_hidden_'+id).toggle(function(){
            $('#rename_calle_en_mapa_'+id).val('');
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

    $(".btn-insert-coords").on('click', function(e){
    var mapas_selected = [];
    var mapas_unselected = [];
    var checkboxes_unselected = [];
    var nuevos_nombres = [];
    
    /* Recorremos todos los checkbox que NO están chequeados */
    $("input.cb_mapas:checkbox:not(:checked)").each(function() {
        var id_mapa = $(this).val();
        var nombre_nuevo = $('#rename_calle_en_mapa_'+id_mapa).val();
        if (nombre_nuevo != ''){
            nuevos_nombres.push({'nombre' : nombre_nuevo , 'via' : tipo });
            mapas_unselected.push(id_mapa);
            var cont = cont + 1;
        }
        checkboxes_unselected.push(cont);
    });
    /* Recorremos todos los checkbox que SI están chequeados */
    $('.cb_mapas:checked').each(function() {
    var id = $( this ).val();
    mapas_selected.push(id);
    });
    
    // Comprobación para la inserción de coordenadas:
    // Si el número total de checkboxes es igual al número de checkboxes no seleccionados y tampoco se han insertado nuevos nombres en los inputs se realizará la condición if.
    if( $('.cb_mapas').length == checkboxes_unselected.length && nuevos_nombres.length == 0 ){
        alert('Seleccione al menos un mapa.');
    } else {
    if (! $('#id_calle_warning_'+id).hasClass('warning')){
        alert('La calle seleccionada ya tiene las coordenadas establecidas, seleccione una en color naranja.');
    } else {
    if (coords_x.length  == 0){
        alert('Debes indicar la localización de esta calle en mapa haciendo doble click.');
    } else {
    var next = confirm('Vas a establecer coordenadas para ' + tipo +" "+ nombre +'.');
    if (next){
    // Envío de datos mediante ajax:
    console.log('Mapas seleccionados ' + mapas_selected);
    console.log('Calle seleccionada ' + id);

    var id_calle = JSON.stringify(id);
    var json_mapas_selected = JSON.stringify(mapas_selected);
    var json_mapas_unselected = JSON.stringify(mapas_unselected);
    var json_x = JSON.stringify(coords_x[0]) /  zoom -5 ;
    var json_y = JSON.stringify(coords_y[0]) / zoom -5;

    var formData = {
        'x' : json_x,
        'y' : json_y,
        'id_mapas_selected' : json_mapas_selected,
        'id_mapas_unselected' : json_mapas_unselected,
        'id_calle' : id_calle,
        'nuevos_nombres' : nuevos_nombres
    };
    // console.log(formData);

    $.ajax({
        type     : "POST",
        cache    : false,
        url      : "<?php echo base_url(); ?>index.php/Streets/insert_coords",
        data     : formData,
        dataType : 'json',
        encode : true
        })
        .done(function(data) {
            var msg = data.msg;
            console.log(data);
            console.log(msg);
 
            if (msg == '0'){
                $("#id_calle_warning_"+id).removeClass('warning');
                var count = Object.keys(data).length;
           
                var x = data[0].x;
                var y = data[0].y;
                console.log(x);
                console.log(y);

                for (i = 0; i < count -2 ; i++){ 
                   var rowNode = table.row.add( {
                            "Tipo": "",
                            "Nombre": "",
                            "Punto": "",
                            "Calle": data[i].nombre
                        } ).draw().node();
                        $(rowNode).attr({id: 'calle_'+data[i].id});
                        $(rowNode).find('td').eq(0).attr({id: 'tipo_'+data[i].id}).text(data[i].tipo);
                        $(rowNode).find('td').eq(1).attr({id: 'nombre_'+data[i].id}).text(data[i].nombre);
                        $(rowNode).find('td').eq(2).attr({'id': 'punto_'+data[i].id , 'data-x' : data[i].x, 'data-y' : data[i].y });
                        $(rowNode).find('td').eq(3).attr({'data-id': data[i].id}).addClass('calles').text(data.tipo + " " + data.nombre );
                    // $('#tabla_calles').append("<tr id='calle_"+data[i].id+"'> <td id='tipo_"+data[i].id+"' class='d-none'>"+data[i].tipo+"</td><td  id='nombre_"+data[i].id+"' class='d-none'>"+data[i].nombre+"</td> <td id='punto_"+data[i].id+"' class='d-none' data-x='"+data[i].x+"' data-y='"+data[i].y+"'> <td class='calles' data-id="+data[i].id+">"+data[i].tipo+" "+data[i].nombre+"</td> </tr> ");
                }

                // Si la calle se añade y se inserta sin refrescar:
                if ($('#punto_'+id) == null){
                $('#calle_'+id).append("<td id='punto_"+id+"' class='d-none' data-x='"+x+"' data-y='"+y+"'> </td>");
                } else {
                // Si la calle se añade, se refresca y se inserta posteriormente:
                // No se realiza el append y tiene que updatear una row punto_id
                $('#calle_'+id).html("<td id='tipo_"+data[i].id+"' class='d-none'>"+data[i].tipo+"</td><td  id='nombre_"+data[i].id+"' class='d-none'>"+data[i].nombre+"</td> <td id='punto_"+data[i].id+"' class='d-none' data-x='"+data[i].x+"' data-y='"+data[i].y+"'> <td class='calles' data-id="+data[i].id+">"+data[i].tipo+" "+data[i].nombre+"</td>");
                }
                $('.box').html('');
                $('.box').append("<div class='alert alert-success' role='alert'> Se ha realizado la operación con éxito. </div>");
                $('.btn-update').prop('disabled', true);
                $('.btn-delete').prop('disabled', true);
                // VACIAMOS EL ARRAY DE COORDENADAS:
                coords_x = [];
                coords_y = [];
            } else {
                $('.box').html('');
                $('.box').append("<div class='alert alert-danger' role='alert'> Se ha producido un error.  </div>");
            }
            $('.alert').fadeIn().delay(2500).fadeOut();
});
}// fin if mapas
}// fin if warning
}// fin confirm
}// fin if puntos
e.preventDefault();

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
        <div class="col-md-12 botones">
            <button type="button" class="btn btn-primary btn-anadir" data-toggle="modal" data-target="#modal_insert"> <span class="far fa-plus-square"></span> Añadir Calle</button>
            <button type='button' class="btn btn-info btn-update" data-toggle='modal' data-target='#modal_update' data-id=''><span class='far fa-edit'></span> Modificar Calle</button>
            <button type='button' class="btn btn-danger btn-delete" data-id='' data-toggle="tooltip" data-placement="bottom" title="Borrar"><span class='fas fa-trash-alt'></span> Borrar Calle</button>
            <button type='button' class="btn btn-success btn-insert-coords" data-id='' data-toggle="tooltip" data-placement="bottom" title="Insertar Coordenadas"><span class='fas fa-map-marked-alt'></span> Insertar Coordenadas</button>
            <button id="delCoord" class="btn btn-secondary"> <span class="fas fa-broom"></span> Borrar último punto</button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="table-responsive">
                <table class="table table-hover" id='tabla_calles'>
                    <thead>
                        <tr>
                            
                            <th class='d-none' scope="col">Tipo</th>
                            <th class='d-none' scope="col">Nombre</th>
                            <th class='d-none' scope="col">Punto</th>
                            <th scope="col">Calle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            for($i = 0; $i < count($listaCalles);$i++){
                            $calle = $listaCalles[$i];
                            echo "<tr id=calle_".$calle["id"]." >";
                            echo "<td id='tipo_".$calle["id"]."' class='d-none'>".$calle["tipo"]."</td>";
                            echo "<td id='nombre_".$calle["id"]."' class='d-none'>".$calle["nombre"]."</td>";
                            if (isset($calle["id_punto"])){
                                echo "<td id='punto_".$calle["id"]."' class='d-none' data-x='".$calle['x']."' data-y='".$calle['y']."'></td>";
                                echo "<td class='calles' data-id=".$calle["id"].">".$calle["tipo"]." ".$calle["nombre"]."</td>";
                            } else {
                                echo "<td id='punto_".$calle["id"]."' class='d-none warning_puntos' data-x='null' data-y='null'></td>";
                                echo "<td id=id_calle_warning_".$calle["id"]." class='calles warning' data-id=".$calle["id"].">".$calle["tipo"]." ".$calle["nombre"]."</td>";
                            }
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
                            if ($i == 0){
                            echo "<td>  <label for='mapa_".$mapa["id"]."'>".$mapa['titulo']."</label> <input id='slider_callejero' style='float:left; margin-bottom:10px; width:100%;' type='range' value='0.5' name='points' min='0' max='1' step='0.1'/> <div id='cb_hidden_".$mapa["id"]."' class='cb_hidden'> <label for='mapa_".$mapa["id"]."'>¿Esta calle tiene otro nombre en este mapa? <br/> Deje este campo en blanco si no existe esa calle en este mapa.</label> <input id='rename_calle_en_mapa_".$mapa['id']."' type='text' class='form-control renamed_calle' placeholder='Nombre en este mapa'/> </div> </td>";    
                            }else {
                            echo "<td>  <label for='mapa_".$mapa["id"]."'>".$mapa['titulo']."</label> <input style='float:left; margin-bottom:10px; width:100%;' type='range' id='slider_".$mapa["id"]."' oninput='changeOpacity(".$mapa["id"].")' value='0' name='points' min='0' max='1' step='0.1'/> <div id='cb_hidden_".$mapa["id"]."' class='cb_hidden'> <label for='mapa_".$mapa["id"]."'>¿Esta calle tiene otro nombre en este mapa? <br/> Deje este campo en blanco si no existe esa calle en este mapa.</label> <input id='rename_calle_en_mapa_".$mapa['id']."' type='text' class='form-control renamed_calle' placeholder='Nombre en este mapa'/> </div> </td>";
                            }
                            echo "<td>  <input name='mapa_".$mapa["id"]."' type='checkbox' data-id=".$mapa['id']." class='cb_mapas' id='cb_mapa_".$mapa['id']."' value='".$mapa['id']."' checked> </td>";
                            echo "</tr>";
                            
                            }                            
                        ?>
                    </tbody>
            </table>

            <!-- <div id='ranges'>
            
            </div> -->

        </div> <!-- fin col md-3 -->

        <div class="col-md-9 dragscroll" id="prueba">
            <div id="hotspotImg-1" class="responsive-hotspot-wrap">
            <?php
                for ($i = 0 ; $i < count($img_mapas) ; $i++){
                $img = $img_mapas[$i];
                if ($i == 0){
                    echo "<img class='mapas' id='img_callejero' data-id='".$i."' data-x='".$img_mapas[0]['desviacion_x']."' data-y='".$img_mapas[0]['desviacion_y']."' style=' top:".$img_mapas[0]['desviacion_y']."px ; left:".$img_mapas[0]['desviacion_x']."px ; z-index:999 ; opacity:0.5; ' src=".base_url($img_mapas[0]['imagen'])." alt='".$img_mapas[0]['titulo']."'>";
                }else {
                    echo "<img class='mapas' id='img_".$img['id']."' data-id='".$i."' data-x='".$img['desviacion_x']."' data-y='".$img['desviacion_y']."' src=".base_url($img['imagen'])." alt='".$img['titulo']."' style=' top:".$img['desviacion_y']."px ; left:".$img['desviacion_x']."px ; z-index:".$i."'>";
                }
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
                                <h5 class="modal-title" id="exampleModalCenterTitle">Añadir calle</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        <div class="modal-body">
                        <!-- Cuerpo del cuadro modal: Formulario de Inserción -->
                            <?php echo form_open('Streets/insert_street',"id='form_insert'");?>

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

                            <div class='form-group'>
                                <label for='nombre'>Nombre de la calle</label>
                                <input type='text' class='form-control' placeholder='Introduce el nombre de la calle' name='nombre' value='' id='nombre' required/> 
                            </div>
                            
                        </div> <!-- modal body -->
                            
                        <div class='modal-footer'>
                                <input type='reset' class='btn btn-secondary' value='Reestablecer formulario'/>
                                <?php echo form_submit('submit', 'Añadir calle',"class='btn btn-primary'"); ?>
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
                    <div class='form-group'>
                        <label for='nombre'>Nombre de la calle</label>
                        <input type='text' class='form-control' placeholder='Introduce el nombre de la calle' name='upd_nombre_calle' value='test' id='upd_nombre_calle' required/> 
                    </div>
                    <input type='hidden' name='upd_id_calle' value='' id='upd_id_calle'/>
                    
                </div> <!-- fin modal body -->
                <div class='modal-footer'>
                    <input type='reset' class='btn btn-secondary' value='Reestablecer formulario'/>
                    <?php echo form_submit('submit', 'Aplicar cambios',"class='btn btn-primary'"); ?>
                    <?php echo form_close();?>
                </div> <!-- fin modal footer -->
            </div> <!-- fin modal content -->
        </div>
    </div>


        <!-- Modal puntos -->
    <div class="modal fade" id="modal_puntos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nombres de esta calle en los mapas:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul id='lista_puntos'>
                    <ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

</div> <!-- fin container fluid -->





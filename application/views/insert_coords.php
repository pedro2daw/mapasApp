
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

    function lista_mapas_calles () {
            var x = $(this).attr('x');
            var y = $(this).attr('y');
            var formData = {
                'x' : x,
                'y' : y
                };

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
        }


    $(document).ready( function (){
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});

        $('#delCoord').hide();

        modificar = null;
        x_aux = null;
        y_aux = null;
        // En enlace calles del menu:
        $('#enlace_calles').toggleClass('active');
        // Botones:
        $('.custom-checkbox').addClass('disabledbutton');
        $("#delCoord").hide();
        // El step:
        $("li").eq('0').toggleClass('active',true);
        $("li").eq('1').toggleClass('active',false);
        $("li").eq('2').toggleClass('active',false);
        $("li").eq('3').toggleClass('active',false);
        // El modal que se muestra si no hay mapas insertados.
        $("#check_mapas").modal('toggle');        
        // Los botones que estarán deshabilitados hasta que se seleccione una calle del listado de calles:
        // UPDATE:

        $('.btn-update').hide();
        // DELETE
        $('.btn-delete').hide();
        // INSERTAR COORDENADAS:
        $('.btn-insert-coords').hide();
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
            { "data": "Tipo" , className: "d-none", "searchable": true  },
            { "data": "Nombre",className: "d-none", "searchable": true },
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
        $('.btn-continuar').hide();
        // Cambia la opacidad del mapa principal.
        $(document).on("input","#slider_callejero",function(){
         var opacity = $(this).val();
         $("#img_callejero").css("opacity",opacity);
        });


    $('#tabla_calles tbody').on( 'click', 'tr', function () {
    row = table.row( this ).index();
    });
 //aqui
    $(document).on("click",".hot-spot-1", function (e){
            $('#lista_puntos').html("");
            lista_mapas_calles();
            var length = $(".warning").length;
            if(length == 0){
                $(".btn-insertar-con-punto").prop("disabled",true);
                $("#msg_insertar_con_punto").attr('title','Todas las calles insertadas tienen un punto asignado. Añada una calle nueva para asignar este punto.');
            } else {
              $(".btn-insertar-con-punto").prop("disabled",false);
              $("#msg_insertar_con_punto").attr('title','Puede establecer este punto para una calle que no tiene un punto asignado.');  
            }
            e.preventDefault();
    });
insertar_con_punto = false;
    $(".btn-insertar-con-punto").click(function(){
        insertar_con_punto = true;
        $("#modal_puntos").modal('toggle');
        x_aux = x;
        y_aux = y;
        $('.btn-update').hide();
        // DELETE
        $('.btn-delete').hide();
        // INSERTAR COORDENADAS:
        $('.btn-insert-coords').hide();
        $('.btn-anadir').hide();

                    $("li").eq('0').toggleClass('active',true);
                    $("li").eq('1').toggleClass('active',false);
                    $("li").eq('2').toggleClass('active',false);
                    $("li").eq('3').toggleClass('active',false);

                    swal("Seleccione en el listado la calle sin punto asignado que quiera enlazar a este punto",{
                    icon: "info"
                });

    });

    $(".btn-modificar-punto").click(function(){
        $("#modal_puntos").modal('toggle');
        modificar = true;
        x_aux = x;
        y_aux = y;
        $('.btn-update').hide();
        // DELETE
        $('.btn-delete').hide();
        $('.btn-anadir').hide();
        // INSERTAR COORDENADAS:
        $('.btn-insert-coords').hide();

        $("li").eq('0').toggleClass('active',false);
        $("li").eq('1').toggleClass('active',true);
        $("li").eq('2').toggleClass('active',false);
        $("li").eq('3').toggleClass('active',false);

    });

    $(".btn-anadir").click(function(){
        
    });

    $(".btn-generar-informe").click(function(){
        $(".btn-generar-informe").addClass("d-none");
        $("#save").removeClass("d-none");
        $("#observaciones").removeClass("d-none");
        $("#archivo").removeClass("d-none");
        $("#cabecera").removeClass("d-none");

         
        //to canvas
        
    });

    

    $("#save").on("click",function(){
        var ul_test = 
        $("#lista_puntos").find("li").filter(function(){
            return $(this).find("ul").length === 0;
        }).map(function(i,e){
            return $(this).text();
        }).get().join("\n");
        ;
        var observaciones = $("#observaciones").val();
        var informe = "Historial de calles :\n\n"+ ul_test + "\n\nObservaciones : \n\n"+ observaciones;
        //alert(informe);
        var nombre_fichero = $("#nombre_archivo").val();
        if(nombre_fichero == ""){
            swal({
                title: "Advertencia",
                text: "Debes introducir un nombre para el fichero",
                icon: "info",
                button: "Aceptar",
                dangerMode: true,
                })
        }else{
        var blob = new Blob([informe],{type: "charset=utf-8"});
            saveAs(blob,"informe_"+nombre_fichero+".doc");

        $('#lista_puntos').html("");
        $(".btn-generar-informe").removeClass("d-none");
        $("#save").addClass("d-none");
        $("#observaciones").addClass("d-none");
        $("#observaciones").val("");
        $("#archivo").addClass("d-none");
        $("#nombre_archivo").val("");
        $(function(){
            $("#modal_puntos").modal('toggle');
        });
        }
    });

    $("#close").click(function(){
        $('#lista_puntos').html("");
        $(".btn-generar-informe").removeClass("d-none");
        $("#save").addClass("d-none");
        $("#observaciones").addClass("d-none");
        $("#observaciones").val("");
        $("#archivo").addClass("d-none");
        $("#nombre_archivo").val("");
    });

    // TEST PARA CAPTURA DE PANTALLA //
    $(document).ready(function(){
        $("#camera").click(function(){
        html2canvas($("body"),{
					onrendered: function(canvas){
						$("#div_captura").append(canvas);
						
						
					}
        });
    });

    })
    
    // TEST PARA CAPTURA DE PANTALLA //

    // Selecciona una calle.
    $(document).on( "click", ".calles",function() {

        
        $('#table_mapas').removeClass('blue-grey lighten-5 border');
        var_this = this;
        $(".hot-spot-1").remove();
        $('.calles').removeClass('selected');
        $(this).toggleClass('selected');
        get_data();
        $('.custom-checkbox').addClass('disabledbutton');
        $('.cb_hidden').hide();
        $('.cb_mapas').each(function(){
                    $(this).prop('checked',true);    
                });
        // Borra el punto en el mapa:
        var top = $('#prueba').scrollTop();
        var left = $('#prueba').scrollLeft();

        

        console.log(" ******************************* ");
        console.log("top y left "+ top + " " +left + "zoom" + zoom + "X " + x + " Y " + y);

        $("#delCoord").hide();
            $('.btn-update').data('id',id);
            $('.btn-insert').show();
            $('.btn-update').show();
            $('.btn-anadir').show();
            $('.btn-delete').show();
            $('.btn-delete').data('id',id);  



        if (x_aux != null){
            console.log(x_aux);
            x = x_aux;
            y = y_aux;
        } 
        // Si añado un punto en el mapa para una calle sin punto asignado y selecciono otra calle (con punto) del listado. El mapa debe resetearse y ocutarse el boton de continuar.
            if ((x == null || y == null) && $(this).hasClass("warning")){
            $("li").eq('0').toggleClass('active',false);
            $("li").eq('1').toggleClass('active',true);
            $("li").eq('2').toggleClass('active',false);
            $("li").eq('3').toggleClass('active',false);
            $(document).on( "mouseover", ".hot-spot-1", function (e){
                $(this).css({'cursor':'cursor'  , 'pointer-events': 'none' });
            });
            
            } else {
                // Si añado un punto en el mapa para una calle sin punto asignado y selecciono otra calle (con punto) del listado. El mapa debe resetearse y ocutarse el boton de continuar.
                $('.btn-continuar').hide();


                // Si existe x_aux y la clase es warning se esta utilizando el punto. Se esta añadiendo esta calle al historial de calles.
                if (x_aux != null && $(this).hasClass("warning") && insertar_con_punto ){
                    $("li").eq('0').toggleClass('active',false);
                    $("li").eq('1').toggleClass('active',false);
                    $("li").eq('2').toggleClass('active',true);
                    $("li").eq('3').toggleClass('active',false);
                    $('.custom-checkbox').removeClass('disabledbutton');
                    $('.btn-continuar').show();
                    $('.btn-anadir').hide();
                    $('.btn-update').hide();
                    // DELETE
                    $('.btn-delete').hide();
                    // INSERTAR COORDENADAS:
                    $('.btn-insert-coords').hide();
                    $("#delCoord").show();

                } else {
                    // Sino, es una calle con coordenadas ya insertadas.
                    // Si la x auxiliar está inicializada y la clase no es warning ha seleccionado una calle con los puntos ya establecidos y se notificará al usuario.
                    if (x_aux != null && !$(this).hasClass("warning") && insertar_con_punto){
                        swal({
                            title: "Precaución",
                            text: "Seleccione una calle SIN puntos establecidos, por favor. (Una calle en naranja o añada una ahora).",
                            icon: "warning"
                            });
                    $('.btn-continuar').hide();
                    }
                    // Se está modificando el punto y se ha seleeccionado otra calle. Notificación de cancelación del proceso.
                    

                    $("li").eq('0').toggleClass('active',false);
                    $("li").eq('1').toggleClass('active',false);
                    $("li").eq('2').toggleClass('active',false);
                    $("li").eq('3').toggleClass('active',false);
                }

                
                   
           
            $(document).on( "mouseover", ".hot-spot-1", function (e){
            $(this).css({'cursor':'pointer'  , 'pointer-events': 'auto'});
            });

           
            console.log("Calle seleccionada: " + id);
            console.log('Punto X: ' + x);
            console.log('Punto Y: ' + y);

            $('#img_callejero').after("<div id='id_hot-spot-1'class='hot-spot-1' x='" + x + "'y='" + y  + "'style='z-index:1000 ; top:" + y + "px;left:" + x + "px; display:block;'></div>");
            
            if (zoom == 1){
                $('#prueba').scrollTop((y - ($('#prueba').height() /2) -5 )  * zoom ); 
                $('#prueba').scrollLeft((x - ($('#prueba').width() /2) -5 )  * zoom );
            } else if ( zoom > 1){
                // Se acerca:
                $('#prueba').scrollTop((y - ($('#prueba').height() /2)  -5  + 110)  * zoom ); 
                $('#prueba').scrollLeft((x - ($('#prueba').width() /2) -5  + 110)  * zoom );
            } else {
                // Se aleja
                $('#prueba').scrollTop((y - ($('#prueba').height())  -5 )  * zoom ); 
                $('#prueba').scrollLeft((x - ($('#prueba').width()) -5 )  * zoom );
            }

            /*
            */
            }
 if (x_aux != null  && !insertar_con_punto){
  
                        swal({
                            title: "Precaución",
                            text: "Ha cancelado el proceso de modificación del punto al seleccionar otra calle.",
                            icon: "warning"
                            });
                     $('.btn-insert-coords').hide();
                     x_aux = null;
                     y_aux = null;
                }

            
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
    $('.calles').removeClass('selected');
    
    if (data.msg == '0'){   
        var rowNode = table.row.add( {
            "Tipo": data.tipo,
            "Nombre": "",
            "Punto": "",
            "Calle": data.nombre
        } ).draw().node();
        $(rowNode).attr({id: 'calle_'+data.id});
        $(rowNode).find('td').eq(0).attr({id: 'tipo_'+data.id}).text(data.tipo);
        $(rowNode).find('td').eq(1).attr({id: 'nombre_'+data.id}).text(data.nombre);
        $(rowNode).find('td').eq(2).attr({'id': 'punto_'+data.id , 'data-x' : 'null', 'data-y' : 'null' });
        $(rowNode).find('td').eq(3).attr({'id': 'id_calle_warning_'+data.id, 'data-id': data.id}).addClass('calles warning selected').text(data.tipo + " " + data.nombre );


                // $("#id_calle_warning_"+data.id).addClass('warning');
                $('.box').html('');
                $('.box').append("<div class='alert alert-success' role='alert'> Se ha realizado la operación con éxito.  </div>");
                // $('#tabla_calles').append("<tr class='d-none' id='calle_"+data.id+"'> <td id='tipo_"+data.id+"' class='d-none'>"+data.tipo+"</td><td  id='nombre_"+data.id+"' class='d-none'>"+data.nombre+"</td> <td id='id_calle_warning_"+data.id+"' class='calles warning' data-id="+data.id+">"+data.tipo+" "+data.nombre+"</td> </tr> ");
               
                $("li").eq('0').toggleClass('active',false);
                $("li").eq('1').toggleClass('active',true);
                $("li").eq('2').toggleClass('active',false);
                $("li").eq('3').toggleClass('active',false);

                $('.btn-update').show();
                $('.btn-delete').show();
                
                } else {
                $('.box').html('');
                $('.box').append("<div class='alert alert-danger' role='alert'> Se ha producido un error. </div>");
            }
            $('.alert').fadeIn().delay(2500).fadeOut();
            

            $('#modal_insert').modal('toggle');
            $(".hot-spot-1").remove();
            
     });

    // Previene al formulario ejecutarse de manera tradicional y que se refresque la página.
    var nombre = $('#nombre')[0];
                $('#nombre').val('');
                nombre.setCustomValidity("");

    e.preventDefault();
    });

    // Modificación de una calle mediante Ajax:
    $('.btn-update').click(function () {
        get_data();

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
                    $('.btn-update').show();
                    $('.btn-delete').show();
                    
                    table.row('#calle_'+id).remove().draw();
                    var rowNode = table.row.add( {
                            "Tipo": "",
                            "Nombre": "",
                            "Punto": "",
                            "Calle": data.nombre
                        } ).draw().node();
                        $(rowNode).attr({id: 'calle_'+data.id}).addClass(data.x +" "+ data.y);
                        $(rowNode).find('td').eq(0).attr({id: 'tipo_'+data.id}).text(data.tipo);
                        $(rowNode).find('td').eq(1).attr({id: 'nombre_'+data.id}).text(data.nombre);
                        
            
                    if (x != null){
                        $(rowNode).find('td').eq(2).attr({'id': 'punto_'+data.id , 'data-x' : data.x, 'data-y' : data.y });
                        $(rowNode).find('td').eq(3).attr({'data-id': data.id}).addClass('calles selected').text(data.tipo + " " + data.nombre );

                        //$('#calle_'+data.id).html("<td id='tipo_"+data.id+"' class='d-none'>"+data.tipo+"</td><td id='nombre_"+data.id+"' class='d-none'>"+data.nombre+"</td> <td class='calles' data-id="+data.id+">"+data.tipo+" "+data.nombre+"</td>");
                       //$('#calle_'+id).append("<td id='punto_"+id+"' class='d-none' data-x='"+x+"' data-y='"+y+"'> </td>");
                    } else {
                        $(rowNode).find('td').eq(2).attr({'id': 'punto_'+data.id , 'data-x' : null, 'data-y' : null });
                        $(rowNode).find('td').eq(3).attr({'id': 'id_calle_warning_'+data.id , 'data-id': data.id}).addClass('calles warning selected').text(data.tipo + " " + data.nombre );
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
        get_data();
            swal({
                title: "Precaución",
                text: "Va a borrar"+ calle +", esta operación es irreversible. ¿Desea continuar?",
                icon: "warning",
                buttons: ["Cancelar", "Borrar"],
                dangerMode: true,
                })
                .then((next) => {
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
                    $('.btn-update').hide();
                    $('.btn-delete').hide();
                    //$('#calle_'+id).html("");
                    table.row('#calle_'+id).remove().draw();
                        
                    
                    $(".hot-spot-1").remove();

            $("li").eq('0').toggleClass('active',true);
            $("li").eq('1').toggleClass('active',false);
            $("li").eq('2').toggleClass('active',false);
            $("li").eq('3').toggleClass('active',false);

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
    });

    
    $(document).on('change','.cb_mapas', function() {
        var id =  $(this).data('id');
        $('#cb_hidden_'+id).toggle(function(){
            $('#rename_calle_en_mapa_'+id).val('');
        });
    });


    $(document).on('click','.btn-continuar', function() {
        $("li").eq('0').toggleClass('active',false);
        $("li").eq('1').toggleClass('active',false);
        $("li").eq('2').toggleClass('active',false);
        $("li").eq('3').toggleClass('active',true);
        $('.btn-insert-coords').show();
        $('.btn-continuar').hide();
        $('.custom-checkbox').addClass('disabledbutton');
        $('.cb_hidden').hide();
        $('#table_mapas').removeClass('blue-grey lighten-5 border');

    });

    $(document).on('click','.btn-modificar-punto', function() {
        $("#modal_puntos").modal('toggle');

        if ($(".warning").length == 0){
            console.log($(".warning").length);
            $(".btn-insertar-con-punto").prop("disabled",true);
        } else {
            $(".btn-insertar-con-punto").prop("disabled",false);
        }
        $(".hot-spot-1").remove();
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

    function get_data(){
        id = $(".selected").data("id");
        nombre = $('#nombre_'+id).text(); 
        tipo = $('#tipo_'+id).text();
        if (x_aux == null){
            x = $('#punto_'+id).data('x');
            y = $('#punto_'+id).data('y');
        } else {
            x = x_aux;
            y = y_aux;
        }
        calle = tipo + " " + nombre;

        x_def = $('#punto_'+id).data('x');
        y_def = $('#punto_'+id).data('y');
    }

    $(".btn-insert-coords").on('click', function(e){
        get_data();
        console.log('Punto X: ' + x);
        console.log('Punto Y: ' + y);
        console.log('Punto X: auxx' + x_aux);
        console.log('Punto Y: auzx' + y_aux);
        var mapas_selected = [];
        var mapas_unselected = [];
        var checkboxes_unselected = [];
        var nuevos_nombres = [];
    
    /* Recorremos todos los checkbox que NO están chequeados */
    $("input.cb_mapas:checkbox:not(:checked)").each(function() {
        var id_mapa = $(this).val();
        console.log('lemapa'+id_mapa);

        var nombre_nuevo = $('#rename_calle_en_mapa_'+id_mapa).val();
        console.log(nombre_nuevo);
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
    
    swal({
                title: "Precaución",
                text: "Va a establecer un punto para: " + tipo +" "+ nombre +". ¿Desea continuar?",
                icon: "info",
                buttons: ["Cancelar", "Establecer Punto"],
                dangerMode: true,
                })
                .then((next) => {
    if (next){
    // Envío de datos mediante ajax:
    console.log('Mapas seleccionados ' + mapas_selected);
    console.log('Calle seleccionada ' + id);
    var id_calle = JSON.stringify(id);
    var json_mapas_selected = JSON.stringify(mapas_selected);
    var json_mapas_unselected = JSON.stringify(mapas_unselected);

    if (coords_x[0] == null){
        json_x  = JSON.stringify(Math.round(x));
        json_y  = JSON.stringify(Math.round(y));
    } else {
        json_x = JSON.stringify(Math.round(coords_x[0]) /  zoom -5) ;
        json_y = JSON.stringify(Math.round(coords_y[0]) / zoom -5);
        x_new = Math.round(coords_x[0]/  zoom -5);
        y_new = Math.round(coords_y[0]/  zoom -5);
    }
    
if (modificar == null) {

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
                        $(rowNode).attr({id: 'calle_'+data[i].id}).addClass(data.x +" "+ data.y);
                        $(rowNode).find('td').eq(0).attr({id: 'tipo_'+data[i].id}).text(data[i].tipo);
                        $(rowNode).find('td').eq(1).attr({id: 'nombre_'+data[i].id}).text(data[i].nombre);
                        $(rowNode).find('td').eq(2).attr({'id': 'punto_'+data[i].id , 'data-x' : data[i].x, 'data-y' : data[i].y });
                        $(rowNode).find('td').eq(3).attr({'data-id': data[i].id}).addClass('calles').text(data[i].tipo + " " + data[i].nombre );
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
                $('.btn-update').hide();
                $('.btn-delete').hide();
                // VACIAMOS EL ARRAY DE COORDENADAS:
                coords_x = [];
                coords_y = [];
                console.log('inserta');
                $(".hot-spot-1").remove();
                $('.custom-checkbox').addClass('disabledbutton');
                $('.cb_hidden').hide();
               
                $('.btn-anadir').show();
                $('.btn-insert-coords').hide();
                $("li").eq('0').toggleClass('active',true);
                $("li").eq('1').toggleClass('active',false);
                $("li").eq('2').toggleClass('active',false);
                $("li").eq('3').toggleClass('active',false);
/*
                $('.cb_mapas').each(function(){
                    console.log('entra checkboxxx');
                });
                    $(this).prop('checked',true);  
                    */  
                x_aux = null;
                y_aux = null;
                swal("Punto insertado con éxito",{
                    icon: "success"
                });
            } else {
                $('.box').html('');
                $('.box').append("<div class='alert alert-danger' role='alert'> Se ha producido un error.  </div>");
            }
            $('.alert').fadeIn().delay(2500).fadeOut();
});
    }else {
        var formData = {
            'x' : Math.round(json_x),
            'y' : Math.round(json_y),
            'x_aux' : x_aux,
            'y_aux' : y_aux
        };

        
    $.ajax({
        type     : "POST",
        cache    : false,
        url      : "<?php echo base_url(); ?>index.php/Streets/update_coords",
        data     : formData,
        dataType : 'json',
        encode : true
        })
        .done(function(data) {
            var msg = data.msg;
            console.log("X "+x);
            console.log("Y "+y);
            console.log("X_AUX "+x_aux);
            console.log("Y_AUX "+y_aux);
            console.log("X_def "+x_def);
            console.log("Y_def "+y_def);
            console.log("X_new "+x_new);
            console.log("Y_new "+y_new);
            console.log(data);
 
            if (msg == '0'){
                var count = Object.keys(data.calles_relacionadas).length;
                for (var i = 0; i < count ; i++){
                    console.log("i" + i);
                    console.log("count" + count);
                    var id_calle = data.calles_relacionadas[i].id_calle;
                    console.log(id_calle);
                    var nombre = $('#nombre_'+id_calle).text(); 
                    var tipo = $('#tipo_'+id_calle).text();
                    var calle = tipo + " " + nombre;
                    var x_def = $('#punto_'+id_calle).data('x');
                    var y_def = $('#punto_'+id_calle).data('y');
                
                table.row('#calle_'+id_calle).remove().draw();
                var rowNode = table.row.add( {
                            "Tipo": "",
                            "Nombre": "",
                            "Punto": "",
                            "Calle": calle
                        }).draw().node();
                $(rowNode).attr({id: 'calle_'+id_calle}).addClass(x_new, y_new);
                $(rowNode).find('td').eq(0).attr({id: 'tipo_'+id_calle}).text(tipo);
                $(rowNode).find('td').eq(1).attr({id: 'nombre_'+id_calle}).text(nombre);
                $(rowNode).find('td').eq(2).attr({'id': 'punto_'+id_calle , 'data-x' : x_new, 'data-y' : y_new });
                $(rowNode).find('td').eq(3).attr({'data-id': id_calle}).addClass('calles').text(calle);
                }
                $('.box').html('');
                $('.box').append("<div class='alert alert-success' role='alert'> Se ha realizado la operación con éxito. </div>");
                /*
                table.row('#calle_'+id).remove().draw();
                var rowNode = table.row.add( {
                            "Tipo": "",
                            "Nombre": "",
                            "Punto": "",
                            "Calle": calle
                        }).draw().node();
                $(rowNode).attr({id: 'calle_'+data.id}).addClass(data.x +" "+ data.y);
                $(rowNode).find('td').eq(0).attr({id: 'tipo_'+id}).text(tipo);
                $(rowNode).find('td').eq(1).attr({id: 'nombre_'+id}).text(nombre);
                $(rowNode).find('td').eq(2).attr({'id': 'punto_'+id , 'data-x' : x, 'data-y' : y });
                $(rowNode).find('td').eq(3).attr({'data-id': id}).addClass('calles selected').text(calle);
                */
                $('.btn-update').hide();
                $('.btn-delete').hide();
                // VACIAMOS EL ARRAY DE COORDENADAS:
                coords_x = [];
                coords_y = [];
                $(".hot-spot-1").remove();
                $('.custom-checkbox').addClass('disabledbutton');
                $('.cb_hidden').hide();
                $('.btn-anadir').show();
                $('.btn-insert-coords').hide();
                $("li").eq('0').toggleClass('active',true);
                $("li").eq('1').toggleClass('active',false);
                $("li").eq('2').toggleClass('active',false);
                $("li").eq('3').toggleClass('active',false);

            } else {
                $('.box').html('');
                $('.box').append("<div class='alert alert-danger' role='alert'> Se ha producido un error.  </div>");
            }
            x_aux = null;
            y_aux = null;
            $('.alert').fadeIn().delay(2500).fadeOut();
            modificar = null;

            $("#delCoord").hide();


});
}
}
insertar_con_punto = false;
e.preventDefault();
});

    });

});

</script>


<div class="container-fluid">
<?php if( count($listaMapas) > 0 ){ ?>

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

<!-- Horizontal Steppers -->
<div class="row">
  <div class="col-md-12">

    <!-- Stepers Wrapper -->
    <ul class="stepper stepper-horizontal">

      <!-- First Step -->
      <li class="">
        <a href="#!">
          <span class="circle">1</span>
          <span class="label">Seleccionar calle</span>
        </a>
      </li>

      <!-- Second Step -->
      <li class="">
        <a href="#!">
          <span class="circle">2</span>
          <span class="label">Establecer punto en el mapa</span>
        </a>
      </li>

      <!-- Third Step -->
      <li class="">
        <a href="#!">
          <span class="circle">3</i></span>
          <span class="label">Indicar en qué mapas está la calle</span>
        </a>
      </li>

      <!-- Third Step -->
      <li class="">
        <a href="#!">
          <span class="circle">4</i></span>
          <span class="label">Insertar punto</span>
        </a>
      </li>

    </ul>
    <!-- /.Stepers Wrapper -->

  </div>
</div>
<!-- /.Horizontal Steppers -->

    <div class="row">
        <div class="col-md-12 botones">
            <button type="button" class="btn btn-primary btn-anadir" data-toggle="modal" data-target="#modal_insert"> <span class="far fa-plus-square"></span> Añadir Calle</button>
            <button type='button' class="btn btn-info btn-update" data-toggle='modal' data-target='#modal_update' data-id=''><span class='far fa-edit'></span> Modificar Calle</button>
            <button type='button' class="btn btn-danger btn-delete" data-id='' data-toggle="tooltip" data-placement="bottom" title="Borrar"><span class='fas fa-trash-alt'></span> Borrar Calle</button>
            <button type='button' class="btn btn-warning btn-insert-coords" data-id='' data-toggle="tooltip" data-placement="bottom" title="Insertar Punto"><span class='fas fa-map-marked-alt'></span> Confirmar Punto</button>
            <button type="button" class="btn btn-success btn-continuar"> <span class="fas fa-long-arrow-alt-right"></span> Continuar </button>
            <button id="delCoord" class="btn bg-white"> <span class="far fa-times-circle"></span> Cancelar </button>
            <button type="button" class="btn btn-ayuda-calles" data-toggle="modal" data-target="#modal_leyenda"> <span class="fas fa-question-circle"></span></button>
            
            <?php /*echo anchor('Csv/index','CSV',' class="btn btn-warning"');*/ ?>

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
                            if (isset($calle["id_punto"])){
                            echo "<tr id='calle_".$calle["id"]."'class='".$calle['x']." ".$calle['y']."'>";
                            } else {
                            echo "<tr id='calle_".$calle["id"]."'>";
                            }
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

            <div id='table_mapas'>
                <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Mapas</th>
                                <th scope="col"> </th>
                            </tr>
                        </thead>
                        <tbody>
                
                            <?php 
                                for($i = 0; $i < count($listaMapas);$i++){
                                $mapa = $listaMapas[$i];
                                echo "<tr data_mapa_id=".$mapa['id']." id=mapa_".$mapa["id"].">";
                                if ($i == 0){
                                echo "<td>  
                                <input id='slider_callejero' style='float:left; margin-bottom:10px; width:100%;' type='range' value='0.5' name='points' min='0' max='1' step='0.1'/> <div id='cb_hidden_".$mapa["id"]."' class='cb_hidden'> <label for='mapa_".$mapa["id"]."'>¿Esta calle tiene otro nombre en este mapa? <br/> Deje este campo en blanco si no existe esa calle en este mapa.</label> <input id='rename_calle_en_mapa_".$mapa['id']."' type='text' class='form-control renamed_calle' placeholder='Nombre en este mapa'/> </div> 
                                </td>";    
                                }else {
                                echo "<td><input style='float:left; margin-bottom:10px; width:100%;' type='range' value='1'   id='slider_".$mapa["id"]."' oninput='changeOpacity(".$mapa["id"].")' value='0' name='points' min='0' max='1' step='0.1'/> <div id='cb_hidden_".$mapa["id"]."' class='cb_hidden'> <label for='mapa_".$mapa["id"]."'>¿Esta calle tiene otro nombre en este mapa? <br/> Deje este campo en blanco si no existe esa calle en este mapa.</label> <input id='rename_calle_en_mapa_".$mapa['id']."' type='text' class='form-control renamed_calle' placeholder='Nombre en este mapa'/> </div>
                                </td>";
                                }
                                echo "<td> 
                                <div class='custom-control custom-checkbox'>
                                <input type='checkbox' data-id=".$mapa["id"]." name='mapa_".$mapa["id"]."' class='custom-control-input cb_mapas' id='cb_mapa_".$mapa['id']."' value='".$mapa['id']."' checked>
                                <label class='custom-control-label' for='cb_mapa_".$mapa['id']."'> ".$mapa['titulo']."</label>
                                </div>
                                </td>";
                                echo "</tr>";
                                
                                }                            
                            ?>
                        </tbody>
                        
                </table>
                <button id="camera">CAPTURA</button>
            </div>

            <!-- <div id='ranges'>
            
            </div> -->
            

        </div> <!-- fin col md-3 -->

        <div class="col-md-9 dragscroll" id="prueba">
            <div id="hotspotImg-1">
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
                                <?php echo form_submit('submit', 'Añadir calle',"id='submit-anadir' class='btn btn-primary'"); ?>
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

    <div class="modal fade bd-example-modal-xl" id="modal_leyenda" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Leyenda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> 
                <!-- Cuerpo del cuadro modal: Formulario de Modificación -->
                <div class="modal-body">
                    <ul>
                        <li> Calle naranja: No tiene un punto asignado </li>
                        <li> Calle azul: Tiene un punto asignado </li>
                    </ul>
                </div> <!-- fin modal body -->
                <div class='modal-footer'>
                </div> <!-- fin modal footer -->
            </div> <!-- fin modal content -->
        </div>
    </div>


        <!-- Modal puntos -->
    <div class="modal fade" id="modal_puntos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Historial de calles en este punto:</h5>
                    <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul id='lista_puntos'>
                    </ul>
                <div class="form-group d-none" id="archivo">
                    <label for="nombre_archivo">Nombre del informe</label>
                    <input type='text' class='form-control' id='nombre_archivo' name='nombre_archivo' placeholder='Introduce el nombre del archivo' required/>
                </div>

                <div class="form-group">
                    <textarea id='observaciones' class='form-control d-none' aria-label='Observaciones' name='observaciones' rows='4' cols='80' placeholder='Observaciones'></textarea>
                </div>

                <div id="div_captura">DIV</div>
                </div>
                <div class="modal-footer">
                    
<<<<<<< Updated upstream
                    <span id='msg_insertar_con_punto' data-toggle='tooltip' data-placement='bottom'> <button type="button" class="btn btn-primary btn-insertar-con-punto"><span class="fas fa-map-pin"></span>Insertar en este punto</button> </span>
                    <button type="button" class="btn btn-info btn-modificar-punto" ><span class="fas fa-drafting-compass"></span> Modificar punto</button>
=======
                    <button type="button" class="btn btn-primary btn-insertar-con-punto"><span class="fas fa-map-pin"> </span> Asignar calle a este punto</button>
                    <button type="button" class="btn btn-info btn-modificar-punto" ><span class="fas fa-drafting-compass"> </span> Modificar punto</button>
                    <button type="button" class="btn btn-success btn-generar-informe" ><span class="fas fa-pencil-alt"> </span> Redactar informe</button>
                    <button type='button' id='save' class='btn btn-success btn-guardar-informe d-none' ><span class='far fa-save'> </span> Guardar informe</button>
>>>>>>> Stashed changes
                </div>
            </div>
        </div>
    </div>

<?php } else { ?>
    <!-- Modal -->
<div class="modal fade" id="check_mapas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Advertencia</h5>
        
        </button>
      </div>
      <div class="modal-body">
      <span id='error' class="fas fa-exclamation-circle"> </span>
        <h6 class='modal_mensaje_error'> Debes insertar un mapa. </h6>
      </div>
      <div class="modal-footer">
      <?php
      echo anchor('Maps/index/','Insertar un mapa','type="button" class="btn btn-primary"');
        ?>
      </div>
    </div>
  </div>
</div>

<?php } // fin del if de comprobacion si hay mapas insertados. ?>  

</div> <!-- fin container fluid -->





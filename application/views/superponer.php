<?php

//var_dump($mapas);



?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
           // DECLARO LAS VARIABLES Y ARRAYS NECESARIOS 
           desviacion_x = [];
            desviacion_y = [];
            var dominio = "<?php echo base_url();?>";
           var rutas = <?php echo json_encode($mapas); ?>;
            var cont = 0;
            var next = false;
            var aux_next = false;
            var click = {
                x:0,
                y:0
            }
            var tops = [null];
            var lefts = [null];
            // DECLARO LAS VARIABLES Y ARRAYS NECESARIOS 

            // FUNCION PARA MOVER UN MAPA ENCIMA DEL MAPA PRINCIPAL DE FORMA LIBRE
            $(document).ready(function() {
                $('#enlace_mapas').toggleClass('active');
                $(function() {
                    $("#mapa_alt").draggable({
                        start: function(event) {
                        click.x = event.clientX;
                        click.y = event.clientY;
                        },
                        drag: function(event, ui) {
                            // This is the parameter for scale()
                            var original = ui.originalPosition;
                            // jQuery will simply use the same object we alter here
                            ui.position = {
                                left: (event.clientX - click.x + original.left) / zoom_aux,
                                top:  (event.clientY - click.y + original.top ) / zoom_aux
                            };
                        }
                    });
                });
            // FUNCION PARA MOVER UN MAPA ENCIMA DE OTRO DE FORMA LIBRE 

            // FUNCION PARA CAMBIAR LA OPACIDAD DEL MAPA ALTERNATIVO 
            $(document).on("input","#opacity_changer",function(){
                    var opacity = $(this).val();
                    $("#mapa_alt").css("opacity",opacity);
            });
            // FUNCION PARA CAMBIAR LA OPACIDAD DEL MAPA ALTERNATIVO 


            // CARGO LA IMAGEN DEL PLANO PRINCIPAL(Y SECUNDARIOS) Y EL CSS NECESARIO
                $("#mapa_main").attr("src",dominio+rutas[cont]["imagen"]);
                $("#mapa_main").css("z-index","999");
                $("#mapa_alt").attr("src",dominio+rutas[cont+1]["imagen"])
                $("#mapa_alt").css({"position":"absolute","top":"0px","left":"0px"});
            // CARGO LA IMAGEN DEL PLANO PRINCIPAL(Y SECUNDARIOS) Y EL CSS NECESARIO

            // FUNCION QUE CAPTURA EL PUNTO DE REFERENCIA Y LO ALMACENA
            $('#mapa_main').dblclick(function(e) {
                if (cont == 0){
                var offset = $(this).offset();

                x_def = parseInt(e.pageX - offset.left);
                y_def = parseInt(e.pageY - offset.top);
                
                    alert("Has seleccionado el punto " + x_def + " / " + y_def); // quitar este alert
                    next =  confirm("¿Estás seguro que quieres seleccionar ese punto");
                    if(next == true){
                        desviacion_x[0] = (parseInt(e.pageX - offset.left) / zoom_aux);
                        desviacion_y[0] = (parseInt(e.pageY - offset.top) / zoom_aux);

                            console.log(desviacion_x[0]); // quitar esta linea cuando funcione
                            console.log(desviacion_y[0]); // quitar esta linea cuando funcione
                            console.log(" zoom_aux : " + zoom_aux); // quitar esta linea cuando funcione
                    cont++;
                // CARGO LA SIGUIENTE IMAGEN DEL ARRAY RUTAS Y LA MUESTRO PARA SELECCIONAR EL PUNTO DE REFERENCIA
                    console.log("ruta de la imagen " + dominio+rutas[cont]["imagen"]); // quitar esta linea cuando funcione

                    //$("#mapa_alt").attr("src",dominio+rutas[cont]["imagen"]);
                    $("#mapa_alt").css("z-index","1000");
                    //$("#mapa_alt").removeClass("d-none");
                    $("#hotspotImg-2").removeAttr("style");
                    $("#prueba").scrollTop(0);
                    zoom_aux = 1;
                    alert("llega aqui"); // quitar esta linea cuando funcione
                    alert("el contador vale " + cont); // quitar esta linea cuando funcione
                    }
                }else{
                    alert("Ya has seleccionado un punto de referencia en este mapa");
                }
            });

            // FUNCION QUE CAPTURA EL PUNTO DE REFERENCIA Y LO ALMACENA EN EL MAPA ALTERNATIVO
            $('#mapa_alt').dblclick(function(e){
                var top = $("#mapa_alt").css("top");
                    var left = $("#mapa_alt").css("left");
                        tops.push(top);
                        lefts.push(left); 
                /*
                    var offset = $(this).offset();

                    var aux_x_def = parseInt(e.pageX - offset.left);
                    var aux_y_def = parseInt(e.pageY - offset.top);

                    alert("Has seleccionado el punto " + aux_x_def+ " / " + aux_y_def); // quitar este alert
                    aux_next =  confirm("¿Estás seguro que quieres seleccionar ese punto");

                    if(aux_next == true){
                        desviacion_x[cont] = ((x_def - parseInt(e.pageX - offset.left)) /zoom_aux);
                        desviacion_y[cont] = ((y_def - parseInt(e.pageY - offset.top)) /zoom_aux);

                            console.log(desviacion_x[cont]); // quitar esta linea cuando funcione
                            console.log(desviacion_y[cont]); // quitar esta linea cuando funcione
                             // quitar esta linea cuando funcione
                    cont++;
                    }*/
                    cont++;
                    // CARGO LA SIGUIENTE IMAGEN DEL ARRAY RUTAS Y LA MUESTRO PARA SELECCIONAR EL PUNTO DE REFERENCIA
                    if (cont < rutas.length){
                        $("#mapa_alt").attr("src",dominio+rutas[cont]["imagen"]);
                        $("#prueba").scrollTop(0);

                        alert("llega aqui"); // quitar esta linea cuando funcione
                        alert("el contador vale " + cont); // quitar esta linea cuando funcione
                        } else {
                            alert ("ya no hay mas imagenes") // quitar esta linea cuando funcione
                        }
                    alert(cont);
                    alert(rutas.length);

                    if(cont == rutas.length){
                    alert("contar igual a length");
                    $("#previsualizar").removeClass("hidden");
                }
                
            });       
            // FUNCION QUE CAPTURA EL PUNTO DE REFERENCIA Y LO ALMACENA EN EL MAPA ALTERNATIVO
            
            $("#rutas").click(function(){
                alert(desviacion_x);
                alert(desviacion_y);
            });

            // PREVISUALIZACION ANTES DE INSERTAR LAS DESVIACIONES EN LA BASE DE DATOS
            $("#previsualizar").click(function(){
               var div_prev = $("#hotspotImg-2");
               var id_map = "";
                    div_prev.empty();
                        //div_prev.append("<img src='' alt='mapa_main' id='mapa_main' style='position:absolute;'/>");
                        //$("#mapa_main").attr("src",dominio+rutas[0]["imagen"]);
                    
                    for(i = 0; i< rutas.length;i++){
                        div_prev.append("<img src='' class='maps' id='mapa_alt_"+i+"'/>");
                        id_map += "#mapa_alt" + i ;
                        $(id_map).attr("src",dominio+rutas[i]["imagen"]);
                    }

                    $(".maps").css("position","absolute");
                    
                    for(j = 0; j < rutas.length; j++){
                        $(".maps:eq("+j+")").attr("src",dominio+rutas[j]["imagen"]);
                        $(".maps:eq("+j+")").css("z-index", j+1);

                       if(j > 0){
                                $(".maps:eq("+j+")").css("left",lefts[j]);
                                $(".maps:eq("+j+")").css("top",tops[j]);
                                $(".maps:eq("+j+")").css("opacity","0.5");
                           }
                    }

                    $("#previsualizar").addClass("hidden");
                    $("#toJson").removeClass("hidden");
            });
                $("#top_left").click(function(){
                    var top = $("#mapa_alt").css("top");
                    var left = $("#mapa_alt").css("left");
                        tops.push(top);
                        lefts.push(left);    
                });
                // COMPRUEBA CUANDO ES SCROLL HACIA ARRIBA O HACIA ABAJO //
                // COMPRUEBA CUANDO ES SCROLL HACIA ARRIBA O HACIA ABAJO //
        });// este cierra el document ready, antes de este poner todo los demas para que cierre bien del todo
                
               

</script>

<div class="container-fluid">
<div class="box">
    <h3 class="d-inline">SUPERPOSICIÓN DE MAPAS</h3>
    <a href="#" title="Selección de puntos" data-toggle="popover" data-trigger="focus" data-content="PARA SELECCIONAR EL PUNTO DE REFERENCIA, HAZ DOBLE CLICK EN LA IMAGEN DEL MAPA"><span class="far fa-question-circle"></span></a>
</div>
    <div class="row no-gutters">
    
    <div class="col-md-3" id="panel_left">
    <h4>Cambiar opacidad del plano superior</h4>
    <input style='float:left; margin-bottom:10px; width:90%;' type='range' id='opacity_changer' value='0' name='points' min='0' max='1' step='0.1'/>
    <button id="previsualizar" class="hidden btn btn-info">Previsualizar</button>
    <button id="rutas" class="btn btn-info">coordenadas</button>
    <button id="top_left" class="btn btn-info">top_left</button>
    
    <!--<button id="toJson" class="hidden">GUARDAR</button>-->
    <?php 
echo form_open('Maps/superponer');
echo("
    <input type='hidden' value='' name='x_coord' id='x'/>
    <input type='hidden' value='' name='y_coord' id='y'/>
    <input type='hidden' value='' name='array_rutas' id='array_rutas'/>
            <input type='submit' class='btn btn-success hidden' value='SUPERPONER' id='toJson' />
        </form> 
        ");

?>
    </div>
    <div id="prueba" class="col-md-9">
        <div id="hotspotImg-2" class="responsive-hotspot-wrap zoom_aux" >
            <img src="" alt="mapa_main" id="mapa_main" style="position:absolute;">
            <img src="" alt="mapa" id="mapa_alt" class="free_move" style="position:absolute; z-index:998;">
        </div>
    </div>
    <!--<div id="super" class="hidden col-md-9">
    </div>-->
    
</div>
</div>








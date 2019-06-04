<?php

//var_dump($mapas);

?>
<script src="<?php echo base_url()?>assets/js/jquery_ui.js"></script>
<script>
             swal({
                    title: "Alineación de mapas",
                    text: "Para alinear los planos, arrastre el plano secundario que se muestra en pantalla sobre el mapa principal, finalmente haga doble click sobre el plano para fijar la alineación.",
                    icon: "info",
                    button: "Aceptar",
                    dangerMode: true,
                    });
           // DECLARO LAS VARIABLES Y ARRAYS NECESARIOS 
            var dominio = "<?php echo base_url();?>";
            var rutas = <?php echo json_encode($mapas_aux); ?>;
            var ruta_main = <?php echo json_encode($mapa_main) ?>;
                if (rutas.length < 1){
                    alert("Debes de insertar más de unplano para realizar el proceso de alineación");
                    $(location).attr("href", "<?php echo base_url('index.php/Maps/')?>");
                }
            var cont = 0;
            var next = false;
            var click = {
                x:0,
                y:0
            }
            var tops = [];
            var lefts = [];
            // DECLARO LAS VARIABLES Y ARRAYS NECESARIOS 
            
            // FUNCION PARA CAMBIAR LA OPACIDAD DE LOS MAPAS DE LA PREVISUALIZACION
            function changeOpacity(n){
                $(document).on("input","#slider_"+n,function(){
                var opacity = $(this).val();
                $("#mapa_alt_"+n).css("opacity",opacity);
                });
            }
            // FUNCION PARA CAMBIAR LA OPACIDAD DE LOS MAPAS DE LA PREVISUALIZACION

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

            // CARGO LA IMAGEN DEL PLANO PRINCIPAL , EL PIMER PLANO SECUNDARIO Y EL CSS NECESARIO // 
                $("#mapa_main").attr("src",dominio+ruta_main[0]["imagen"]);
                $("#mapa_main").css("z-index","999");
                $("#mapa_alt").attr("src",dominio+rutas[cont]["imagen"])
                $("#mapa_alt").css({"position":"absolute","top":"0px","left":"0px","opacity":"0.5"});
            // CARGO LA IMAGEN DEL PLANO PRINCIPAL , EL PRIMER PLANO SECUNDARIO Y EL CSS NECESARIO //

            // FUNCION QUE CAPTURA EL DESPLAZAMIENTO TOP Y LEFT EN POSITION ABSOLUTE DEL MAPA ALT //
            $('#mapa_alt').dblclick(function(e){
                //next = confirm("¿Quieres seleccionar esta alineación?");

                swal({
                    title: "Alineación de mapas:",
                    text: "¿Quiere seleccionar esta alineación?",
                    icon: "info",
                    buttons: ["No, gracias", "Continuar"],
                    dangerMode: true,
                    })
                    .then((next) => {
                        if(next==true){
                            $("#plano_anterior").show();
                                var top = $("#mapa_alt").css("top");
                                var left = $("#mapa_alt").css("left");
                                // realizo un slice para guardar solo el valor numerico y no su unidad (px)//
                                top = top.slice(0,-2);
                                left = left.slice(0,-2);
                                    tops.push(top);
                                    lefts.push(left); 
                                cont++;
                                // CARGO LA SIGUIENTE IMAGEN DEL ARRAY RUTAS Y LA MUESTRO
                                if (cont < rutas.length){
                                    $("#mapa_alt").attr("src",dominio+rutas[cont]["imagen"]);
                                    $("#prueba").scrollTop(0);
                                    $("#mapa_alt").css({"top":"0px","left":"0px"});

                                    } else {
                                        if(cont == rutas.length){
                                            //$("#previsualizar").removeClass("d-none");
                                            $(".info").addClass("d-none");
                                            $("#plano_anterior").hide();
                                            $("#posicion_inicial").addClass("d-none");
                                            $("#mapa_alt").addClass("d-none");

                                            $("#repetir_proceso").removeClass("d-none");
                var div_prev = $("#hotspotImg-2");
                var id_map = "";
                    div_prev.empty();

                    // cargo la imagen principal //

                    div_prev.append("<img src='"+dominio+ruta_main[0]["imagen"]+"'id='mapa_main_prev' style='position:absolute; top:0px;left:0px;'/>");

                    // cargo la imagen principal //

                    // cargo las planos secundarios //
                    for(i = 0; i< rutas.length;i++){
                        div_prev.append("<img src='' class='maps' id='mapa_alt_"+i+"'/>");
                        id_map += "#mapa_alt" + i ;
                        $(id_map).attr("src",dominio+rutas[i]["imagen"]);
                    }

                    $(".maps").css("position","absolute");
                    
                   
                    for(j = 0; j < rutas.length; j++){
                        $(".maps:eq("+j+")").attr("src",dominio+rutas[j]["imagen"]);
                        $(".maps:eq("+j+")").css("z-index", j+1);
                        $(".maps:eq("+j+")").css("left",lefts[j]+"px");
                        $(".maps:eq("+j+")").css("top",tops[j]+"px");
                        $(".maps:eq("+j+")").css("opacity","0.5");
                           
                    }
                    // cargo los planos secundarios //

                    // cambio los elementos del panel izquierdo //
                    $("#panel_left").append("<h4>Cambiar la opacidad de los planos</h4>");
                    for (n = 0; n < rutas.length;n++){
                        $("#panel_left").append("</br><h5>"+rutas[n]["titulo"]+"</h5>");
                        $("#panel_left").append("<input style='float:left; width:95%; margin-top:2%;' type='range' id='slider_"+n+"' oninput='changeOpacity("+n+");' name='points' min='0' max='1' step='0.1'/>");
                    }

                    //$("#previsualizar").addClass("d-none");
                    $("#toJson").removeClass("d-none");
                    // cambio los elementos del panel izquierdo //
                                            }
                                        }
                        }
                });


                
            });       
            // FUNCION QUE CAPTURA EL DESPLAZAMIENTO TOP Y LEFT EN POSITION ABSOLUTE DEL MAPA ALT
            
            // PREVISUALIZACION ANTES DE INSERTAR LAS DESVIACIONES EN LA BASE DE DATOS
            //$("#previsualizar").click(function(){
                
            //});

            // FUNCION PARA VOLVER A ALINEAR EL PLANO ANTERIOR //
            $("#plano_anterior").click(function(){
                tops.splice(-1,1);
                lefts.splice(-1,1);
                cont--;
                $("#mapa_alt").attr("src",dominio+rutas[cont]["imagen"]);
                $("#mapa_alt").css({"top":"0px","left":"0px;"});
                    if(cont == 0){
                        $("#plano_anterior").hide();
                    }
            }); 
            // FUNCION PARA ALINEAR EL PLANO ANTERIOR

            // FUNCION PARA VOLVER A LA POSISICON INICIAL EL PLANO //
            $("#posicion_inicial").click(function(){
                $("#mapa_alt").css("top","0px");
                $("#mapa_alt").css("left","0px");
            });
            // FUNCION PARA VOLVER A LA POSISICON INICIAL EL PLANO //


            // FUNCION PARA REPETIR EL PROCESO DE ALINEACION
            $("#repetir_proceso").click(function(){

                swal({
                title: "Precaución",
                text: "¿Está seguro de que quiere repetir el proceso?",
                icon: "warning",
                buttons: ["No, gracias", "Repetir proceso"],
                dangerMode: true,
                })
                .then((next) => {
                    if (next == true){
                        location.href = "<?php  echo site_url('Maps/get_maps'); ?>";
                    }
            });     
            });
            // FUNCION PARA REPETIR EL PROCESO DE ALINEACION    
           
            // FUNCION PARA INSERTAR LA ALINEACION DE LOS MAPAS
            $("#toJson").click(function(){                
                var jsonX = JSON.stringify(lefts);
                var jsonY = JSON.stringify(tops);
                
                $("#x").val(jsonX);
                $("#y").val(jsonY);

                var jsonRutas = JSON.stringify(rutas);
                $("#array_rutas").val(jsonRutas);

            });
            // FUNCION PARA INSERTAR LA ALINEACION DE LOS MAPAS

            });// AQUI SE CIERRA EL BLOQUE DEL DOCUEMENT READY //
                
               

</script>

<div class="container-fluid">
<div class="box">
    <h3 class="d-inline">ALINEACIÓN DE MAPAS</h3>
    <a href="#" title="Alineación de planos" data-toggle="popover" data-trigger="focus" data-content="Arrastre el plano secundario que se muestra en pantalla sobre el mapa principal para alinear los mapas, finalmente haga doble click sobre el plano para fijar la alineación."><span class="far fa-question-circle"></span></a>
</div>
    <div class="row no-gutters">
    
    <div class="col-md-3" id="panel_left">
    <h4 class="info">Cambiar opacidad del plano superior</h4>
    <input style='float:left; margin-bottom:10px; width:90%;' type='range' id='opacity_changer' class="info" value='0.5' name='points' min='0' max='1' step='0.1'/>
    <button id="plano_anterior" class="btn btn-danger">Alinear plano anterior</button>
    <button id="posicion_inicial" class="btn btn-warning">Revertir a la posicion inicial</button>

    <?php  echo form_open('Maps/superponer'); ?>
    <input type='hidden' value='' name='x_coord' id='x'/>
    <input type='hidden' value='' name='y_coord' id='y'/>
    <input type='hidden' value='' name='array_rutas' id='array_rutas'/>
            <input type='submit' class='btn btn-success d-none' value='Finalizar' id='toJson' />
        </form> 
        
    <button id="repetir_proceso" class="d-none btn btn-warning">Repetir proceso de alineación</button>
    </div>
    <div id="prueba" class="col-md-9" >
        <div id="hotspotImg-2" class="responsive-hotspot-wrap zoom_aux" >
            <img src="" alt="mapa_main" id="mapa_main" style="position:absolute;">
            <img src="" alt="mapa" id="mapa_alt" class="free_move" style="position:absolute; z-index:1000;">
        </div>
    </div>
    
</div>
</div>








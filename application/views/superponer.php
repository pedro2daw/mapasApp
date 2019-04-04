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
            var cont = 1;
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
                $("#mapa_main").attr("src",dominio+rutas[cont-1]["imagen"]);
                $("#mapa_main").css("z-index","999");
                $("#mapa_alt").attr("src",dominio+rutas[cont]["imagen"])
                $("#mapa_alt").css({"position":"absolute","top":"0px","left":"0px","opacity":"0.5"});
            // CARGO LA IMAGEN DEL PLANO PRINCIPAL(Y SECUNDARIOS) Y EL CSS NECESARIO

            // FUNCION QUE CAPTURA EL DESPLAZAMIENTO TOP Y LEFT EN POSITION ABSOLUTE DEL MAPA ALT
            $('#mapa_alt').dblclick(function(e){
                $("#plano_anterior").removeAttr("disabled");
                    var top = $("#mapa_alt").css("top");
                    var left = $("#mapa_alt").css("left");
                    // realizo un slice para guardar solo el valor numerico y no su unidad (px)//
                    top = top.slice(0,-2);
                    left = left.slice(0,-2);
                        //alert(top + " el valor del top"); 
                        //alert(left + " el valor del left");
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
                                //alert("contar igual a length");
                                $("#previsualizar").removeClass("d-none");
                                $(".info").addClass("d-none");
                                $("#plano_anterior").addClass("d-none");
                                $("#mapa_alt").addClass("d-none");
                                }
                            }
                    alert(cont);
                    alert(rutas.length);
            });       
            // FUNCION QUE CAPTURA EL DESPLAZAMIENTO TOP Y LEFT EN POSITION ABSOLUTE DEL MAPA ALT
            

            // PREVISUALIZACION ANTES DE INSERTAR LAS DESVIACIONES EN LA BASE DE DATOS
            $("#previsualizar").click(function(){
                $(".info").addClass("d-none");
                $("#plano_anterior").addClass("d-none");
                $("#repetir_proceso").removeClass("d-none");
                var div_prev = $("#hotspotImg-2");
                var id_map = "";
                    div_prev.empty();
                    
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
                                $(".maps:eq("+j+")").css("left",lefts[j]+"px");
                                $(".maps:eq("+j+")").css("top",tops[j]+"px");
                                $(".maps:eq("+j+")").css("opacity","0.5");
                           }
                    }

                    $("#previsualizar").addClass("d-none");
                    $("#toJson").removeClass("d-none");
            });

            // FUNCION PARA ALINEAR EL PLANO ANTERIOR
            $("#plano_anterior").click(function(){
                //alert("tops y lefts antes de splice" + tops + " /// " + lefts);
                tops.splice(-1,1);
                lefts.splice(-1,1);
                //alert("tops y lefts despues de splice" + tops + " /// " + lefts);
                cont--;
                $("#mapa_alt").attr("src",dominio+rutas[cont]["imagen"]);
                $("#mapa_alt").css({"top":"0px","left":"0px;"});
                //alert("contador = " + cont);
                if(cont == 1){
                    alert("entra aqui inside");
                    $("#plano_anterior").prop("disabled",true);
                    $("#plano_siguiente").prop("disabled",true);
                }
            }); 
            // FUNCION PARA ALINEAR EL PLANO ANTERIOR

            // FUNCION PARA REPETIR EL PROCESO DE ALINEACION
            $("#repetir_proceso").click(function(){
                next =  confirm("¿Estás seguro que quieres repetir el proceso?");
                if (next == true){
                    //alert("es true");
                    location.href = "<?php  echo site_url('Streets/get_maps'); ?>";
                }
            });
            // FUNCION PARA REPETIR EL PROCESO DE ALINEACION    

            // FUNCION PARA INSERTAR LA ALINEACION DE LOS MAPAS
            $("#toJson").click(function(){
                rutas.splice(0,1);
                tops.splice(0,1);
                lefts.splice(0,1);
                
                var jsonX = JSON.stringify(lefts);
                var jsonY = JSON.stringify(tops);
                
                $("#x").val(jsonX);
                $("#y").val(jsonY);
                    //alert(jsonX);
                    //alert(jsonY);

                var jsonRutas = JSON.stringify(rutas);
                    //alert(jsonRutas + " valores de las rutas para insertar");
                $("#array_rutas").val(jsonRutas);

            });
            // FUNCION PARA INSERTAR LA ALINEACION DE LOS MAPAS

            });// este cierra el document ready, antes de este poner todo los demas para que cierre bien del todo
                
               

</script>

<div class="container-fluid">
<div class="box">
    <h3 class="d-inline">SUPERPOSICIÓN DE MAPAS</h3>
    <a href="#" title="Selección de puntos" data-toggle="popover" data-trigger="focus" data-content="Alinea el mapa con el plano principal y haz doble click para alinear el mapa"><span class="far fa-question-circle"></span></a>
</div>
    <div class="row no-gutters">
    
    <div class="col-md-3" id="panel_left">
    <h4 class="info">Cambiar opacidad del plano superior</h4>
    <input style='float:left; margin-bottom:10px; width:90%;' type='range' id='opacity_changer' class="info" value='0.5' name='points' min='0' max='1' step='0.1'/>
    <button id="plano_anterior" class="btn btn-danger" disabled>Alinear plano anterior</button>
    <br><br>
    <button id="previsualizar" class="d-none btn btn-info">Previsualizar</button>
    <!--<button id="rutas" class="btn btn-info">coordenadas</button>
    <button id="top_left" class="btn btn-info">top_left</button>-->
    
    <!--<button id="toJson" class="hidden">GUARDAR</button>-->
    <?php 
echo form_open('Maps/superponer');
echo("
    <input type='hidden' value='' name='x_coord' id='x'/>
    <input type='hidden' value='' name='y_coord' id='y'/>
    <input type='hidden' value='' name='array_rutas' id='array_rutas'/>
            <input type='submit' class='btn btn-success d-none' value='Alinear' id='toJson' />
        </form> 
        ");

?>
    <button id="repetir_proceso" class="d-none btn btn-warning">Repetir proceso de alineación</button>
    </div>
    <div id="prueba" class="col-md-9" >
        <div id="hotspotImg-2" class="responsive-hotspot-wrap zoom_aux" >
            <img src="" alt="mapa_main" id="mapa_main" style="position:absolute;">
            <img src="" alt="mapa" id="mapa_alt" class="free_move" style="position:absolute; z-index:1000;">
        </div>
    </div>
    <!--<div id="super" class="hidden col-md-9">
    </div>-->
    
</div>
</div>








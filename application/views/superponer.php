<?php

//var_dump($mapas);



?>

<script>
            desviacion_x = [];
            desviacion_y = [];
            var dominio = "<?php echo base_url();?>";
            var rutas = <?php echo json_encode($mapas); ?>;
            var cont = 0;
            var next = false;
            $(document).ready(function() {
                $("#foto").attr("src",dominio+rutas[cont]["imagen"]);

                $('#foto').dblclick(function(e) {
                var offset = $(this).offset();

                var x_def = parseInt(e.pageX - offset.left);
                var y_def = parseInt(e.pageY - offset.top);
                
                
                if(cont == 0){
                
                    alert("Has seleccionado el punto " + x_def + " / " + y_def);
                    next =  confirm("¿Estás seguro que quieres seleccionar ese punto");
                    if(next == true){
                    desviacion_x[0] = (parseInt(e.pageX - offset.left));
                    desviacion_y[0] = (parseInt(e.pageY - offset.top));
                    cont++;
                    $("#foto").attr("src",dominio+rutas[cont]["imagen"]);
                    $("#mapa").scrollTop(0);
                    }                
                }else{
                    
                alert("Has seleccionado el punto " + x_def + " / " + y_def);
                next =  confirm("¿Estás seguro que quieres seleccionar ese punto");
                        if (next == true){
                            desviacion_x.push(desviacion_x[0]-(parseInt(e.pageX - offset.left)));
                            desviacion_y.push(desviacion_y[0]-(parseInt(e.pageY - offset.top)));
                            cont++;
                            if (cont < rutas.length){
                            $("#foto").attr("src",dominio+rutas[cont]["imagen"]);
                            $("#mapa").scrollTop(0);
                            }
                        }
                }
                
                if(cont == rutas.length){
                     $("#superponer").removeClass("hidden");
                    
                    }
                

            });

            $("#superponer").click(function(){
                $("#super").removeClass("hidden");
                $("#super").css("cursor","grab");
                $("#mapa").addClass("hidden");

                for(i = 0; i < rutas.length; i++){
                    $("#super").append("<img src='"+rutas[i]+"' class='maps' id='imagen_"+i+"' /> ");
                    $("#toJson").before("<input style='float:left; margin-bottom:10px; width:100%;' type='range' id='slider_"+i+"' oninput='changeOpacity("+i+")' value='0' name='points' min='0' max='1' step='0.1'/>");
                }

                $(".maps").css("position","absolute");

                    for ( j = 0; j < rutas.length  ; j++){ // quitar el  menos uno
                        $(".maps:eq("+j+")").attr("src",dominio+rutas[j]["imagen"]);
                        $(".maps:eq("+j+")").css("z-index", j+1);
                
                            if(j > 0){
                                $(".maps:eq("+j+")").css("left",desviacion_x[j]+"px");
                                $(".maps:eq("+j+")").css("top",desviacion_y[j]+"px");
                                $(".maps:eq("+j+")").css("opacity","0");
                            }
                            
                    }
            $("#superponer").addClass("hidden");
            $("#toJson").removeClass("hidden");

            alert("X antes de splice" + desviacion_x);
            alert("Y antes de splice" + desviacion_y);
            desviacion_x.splice(0,1);
            desviacion_y.splice(0,1);
            });
                $("#coord").click(function(){
                    alert(desviacion_x);
                    alert(desviacion_y);
                });

            $("#toJson").click(function(){

                var jsonX = JSON.stringify(desviacion_x);
                var jsonY = JSON.stringify(desviacion_y);

                $("#x").val(jsonX);
                $("#y").val(jsonY);

                rutas.splice(0,1);

                var jsonRutas = JSON.stringify(rutas);

                $("#array_rutas").val(jsonRutas);

            });

            });
            function changeOpacity(i){
                    $(document).on("input","#slider_"+i,function(){
                        var opacity = $(this).val();
                        console.log(opacity);
                        console.log( $("#imagen_"+i));
                        $("#imagen_"+i).css("opacity",opacity);
                    });
                }

</script>

<div class="container-fluid">
<div class="box">
    <h3 class="d-inline">SUPERPOSICIÓN DE MAPAS</h3>
    <a href="#" title="Selección de puntos" data-toggle="popover" data-trigger="focus" data-content="PARA SELECCIONAR EL PUNTO DE REFERENCIA, HAZ DOBLE CLICK EN LA IMAGEN DEL MAPA"><span class="far fa-question-circle"></span></a>
</div>
    <div class="row no-gutters">
    
    <div class="col-md-3" id="panel_left">
    <button id="superponer" class="hidden btn btn-info">Previsualizar</button>
    
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
    <div id="mapa" class="dragscroll col-md-9">
            <img src="" alt="mapa" id="foto">
        </div>
    <div id="super" class="dragscroll hidden col-md-9">
    </div>
    
</div>
</div>








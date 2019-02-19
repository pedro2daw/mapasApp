<?php
var_dump($nombre);
var_dump($tipo);
var_dump($aInicio);
var_dump($aFinal);
var_dump($id_mapa);
var_dump($ruta_imagen);
?>
<div class="container-fluid">
        <div class="row" style="margin-top:10px;">
                <div class="col-md-3">
                    <h3>COORDENADAS</h3>
                        <ul id="coord-list">
                        </ul>
                        
                </div>
                <div class="col-md-9 dragscroll" id="prueba">
                        <h3 class="text-center">Selecciona las coordenadas haciendo doble-click</h3>
                        <div id="hotspotImg-1" class="responsive-hotspot-wrap">
                            <img src="<?php echo base_url($ruta_imagen);?>" alt="img" id="callejero"> <?php // añadir la ruta de la imagen traida del formulario ?>
                        </div>
                            
                </div>
            <div class="col-md"><?php echo anchor('Streets/view_admin_streets/','Volver al menu', 'class="btn btn-danger"')?>
                        <button id="show" class="btn btn-info">show coords</button>
                        <button id="delCoord" class="btn btn-warning">Borrar ultima coordenada</button>
                        <!--<button id="saveCoord" class="btn btn-link">Guardar coordenadas</button>-->
                        <br><br>
                        <?php
        echo form_open('Streets/insert_street');
        echo("
            <input type='hidden' value='$nombre' name='nombre'/>
            <input type='hidden' value='$tipo' name='tipo'/>
            <input type='hidden' value='$aInicio' name='aInicio'/>
            <input type='hidden' value='$aFinal' name='aFinal'/>
            <input type='hidden' value='$id_mapa' name='idMapa'/>
            <input type='hidden' value='' name='x_coord' id='x_coord'/>
            <input type='hidden' value='' name='y_coord' id='y_coord'/>
            
                    <input type='reset' class='btn btn-secondary' value='Reestablecer formulario'/>
                    <input type='submit' class='btn btn-success' value='Insertar' id='toJson' />
                </form> 
                ");
            //echo anchor('Streets/insert_street/'.$nombre.'/'.$tipo.'/'.$aInicio.'/'.$aFinal.'/'.$id_mapa, 'Insertar', 'id="btn-insertar" class="btn btn-success"');?>
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
                                alert($("#btn-insertar").attr("href"));*/
                            });
                                
                        </script>
            </div>
        </div>
</div>




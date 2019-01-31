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
                        <ul id="coords">
                        </ul>
                        
                </div>
                <div class="col-md-9 dragscroll" id="prueba">
                        <h3 class="text-center">Selecciona las coordenadas haciendo doble-click</h3>
                        <div id="hotspotImg" class="responsive-hotspot-wrap">
                            <img src="<?php echo base_url($ruta_imagen);?>" alt="img" id="slide"> <?php // añadir la ruta de la imagen traida del formulario ?>
                        </div>
                            
                </div>
            <div class="col-md"><?php echo anchor('Streets/view_admin_streets/','Volver al menu', 'class="btn btn-danger"')?>
                        <button id="show" class="btn btn-info">show coords</button>
                        <button id="delCoord" class="btn btn-warning">Borrar ultima coordenada</button>
                        <?php echo anchor('Streets/insert_street/'.$nombre.'/'.$tipo.'/'.$aInicio.'/'.$aFinal.'/'.$id_mapa, 'Insertar', 'class="btn btn-success"');?>
            </div>
        </div>
</div>




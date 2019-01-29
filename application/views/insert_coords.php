<?php
/*var_dump($nombre);
var_dump($tipo);
var_dump($aInicio);
var_dump($aFinal);*/
var_dump($id_mapa);
?>
<div class="container-fluid">
        <div class="row" style="margin-top:10px;">
                <div class="col-md-3">
                    <h3>COORDENADAS</h3>
                        <ul id="coords">
                        </ul>
                        <button id="show">show coords</button>
                        <button id="delCoord">Borrar ultima coordenada</button>
                </div>
                <div class="col-md-9 dragscroll" id="prueba">
                        <h3 class="text-center">Selecciona las coordenadas haciendo doble-click</h3>
                        <div id="hotspotImg" class="responsive-hotspot-wrap">
                            <img src="<?php echo base_url('assets/img/mapas/8_c.png');?>" alt="img" id="slide"> <?php // añadir la ruta de la imagen traida del formulario ?>
                        </div>
                            
                </div>
            <div class="col-md"><?php echo anchor('Streets/view_admin_streets/','Volver al menu', 'class="btn btn-danger"')?></div>
        </div>
</div>




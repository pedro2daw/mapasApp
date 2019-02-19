<?php
/*
var_dump($nombre);
var_dump($tipo);
var_dump($aInicio);
var_dump($aFinal);
var_dump($id_mapa);
var_dump($ruta_imagen);
*/
?>
<script>
    $(document).ready( function (){
    $('.alert').fadeIn().delay(4000).fadeOut();
    
    $('.calles').click(function(){
        $('.calles').removeClass('selected');
        $(this).toggleClass('selected');
            
        });
   
   
});
</script>
<div class="container-fluid">
    <div class="row">
            <div class="col-md-12">
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
            </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php echo anchor('Streets/view_admin_streets/','Volver al menu', 'class="btn btn-info"')?>
            <button id="show" class="btn btn-info">Mostrar Coordenadas</button>
            <button id="delCoord" class="btn btn-secondary">Borrar última coordenada</button>
            <!--<button id="saveCoord" class="btn btn-link">Guardar coordenadas</button>-->
        </div>
    </div>

    
    <div class="row">
        <div class="col-md-3">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            for($i = 0; $i < count($listaCalles);$i++){
                            $calle = $listaCalles[$i];
                            echo "<tr id=calle_".$calle["id"].">";
                            echo "<td class='d-none'>".$calle["id"]."</td>";
                            echo "<td class='calles' data-id=".$calle["id"].">".$calle["tipo"]." ".$calle["nombre"]."</td>";
                            echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="col-md-9 dragscroll" id="prueba">
            <div id="hotspotImg-1" class="responsive-hotspot-wrap">
                <img src="<?php echo base_url($ruta_imagen);?>" alt="img" id="callejero"> <?php // añadir la ruta de la imagen traida del formulario ?>
            </div>        
        </div>
        
        <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Mapas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <?php 
                            for($i = 0; $i < count($listaMapas);$i++){
                            $mapa = $listaMapas[$i];
                            echo "<tr>";
                            echo "<td>
                            <figure>
                                <img src='".base_url($mapa["imagen"])."' class='thumbnail_mapa' id='src_imagen_".$mapa["id"]."'>
                                <figcaption>".$mapa["titulo"]."</figcaption>
                            </figure>
                            </td>";
                            echo "<tr>";
                            }
                        ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    </div>
            <h3>Coordenadas</h3>
                <ul id="coord-list">

                </ul>
        
            <?php
            echo form_open('Streets/insert_street');
            echo "<input type='hidden' value='$nombre' name='nombre'/>
                <input type='hidden' value='$tipo' name='tipo'/>
                <input type='hidden' value='$aInicio' name='aInicio'/>
                <input type='hidden' value='$aFinal' name='aFinal'/>
                <input type='hidden' value='$id_mapa' name='idMapa'/>
                <input type='hidden' value='' name='x_coord' id='x_coord'/>
                <input type='hidden' value='' name='y_coord' id='y_coord'/>
            
                    <input type='reset' class='btn btn-secondary' value='Reestablecer formulario'/>
                    <input type='submit' class='btn btn-info' value='Insertar' id='toJson' />";

            echo form_close();
        
                //echo anchor('Streets/insert_street/'.$nombre.'/'.$tipo.'/'.$aInicio.'/'.$aFinal.'/'.$id_mapa, 'Insertar', 'id="btn-insertar" class="btn btn-success"');
            ?>
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
                    alert($("#btn-insertar").attr("href"));
                    */
                });
                                    
            </script>
        </div>
    </div>
</div>




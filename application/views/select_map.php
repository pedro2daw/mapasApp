<script>
$(document).ready(function () {
        $('#enlace_hotspots').toggleClass('active');
});
</script>

<h2 id="titulo-selec-mapa">Elige el mapa para insertar los puntos</h2>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Titulo</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                <?php

                for($i = 0; $i < count($ListaMapas);$i++){
                    
                    $mapa = $ListaMapas[$i];
                    $url=urlencode(base64_encode($mapa["imagen"]));
                    echo ("<tr>");
                    echo ("<td class='ids' >".$mapa["id"]."</td>");
                    echo ("<td class='d-none' id='imagen_".$mapa["id"]."' data-id-imagen='".$mapa['imagen']."'></td>");
                    echo ("<td><img src='".base_url($mapa["imagen"])."' class='thumbnail_mapa' id='src_imagen_".$mapa["id"]."'></td>");
                    echo ("<td id=titulo_".$mapa["id"].">".$mapa["titulo"]."</td>");
                    echo("<td>");
                    echo anchor("Hotspots/view_hotspots/".$mapa['id']. "/" .$url,"<span class='fas fa-long-arrow-alt-right'></span>","class='btn-update btn btn-info' data-id='".$mapa['id']."' class=''");
                    echo("</td>");
                    echo("</tr>");
                } 
                ?>
                </tbody>
            </table>
        </div>
    </div>
<?php
var_dump($nombre);
echo'
<div class="container-fluid">

    <div class="row" style="margin-top:10px;">
            <div class="col-md-3">
                <h3>COORDENADAS</h3>
                    <ul id="coords">
                    </ul>
                    <button id="show">show coords</button>
                    <button id="delCoord">Borrar ultima coordenada</button>
            </div>
            <div class="col-md-9 dragscroll" id="dialog">
                <h3 class="text-center">Selecciona las coordenadas haciendo doble-click</h3>
                <img src="'.base_url('assets/img/mapas/almeria/8_c.png').'" alt="img" id="map">
                
            </div>
    </div>
</div>'; // cierra div container




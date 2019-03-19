<!DOCTYPE html>
<html lang='es'>

<head>
    <title>Superposición de Mapas</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- jQuery -->
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- LOS ICONOS FONTAWESOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!-- DATATABLES: -->
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>



    <!-- ESTILOS PROPIOS:-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/assets/style/estilo.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/assets/style/estiloHotspots.css" />
    <!-- JS PROPIOS: -->
    <script src=<?php echo base_url("assets/js/Mapas.js");?>></script>
    <script src=<?php echo base_url("assets/js/demo.js");?>></script>
    <script src=<?php echo base_url("assets/js/jquery.hotspot.js");?>></script>
    <script type="text/javascript" src="https://cdn.rawgit.com/asvd/dragscroll/master/dragscroll.js"></script>
    <script>
        coords_x = [];
        coords_y = [];
        $(document).ready(function() {
            $('.alert').fadeIn().delay(2500).fadeOut();
            $('#img_callejero').dblclick(function(e) {
                var offset = $(this).offset();
                coords_x.push(parseInt(e.pageX - offset.left));
                coords_y.push(parseInt(e.pageY - offset.top));
                var x_def = parseInt(e.pageX - offset.left);
                var y_def = parseInt(e.pageY - offset.top);
                var x_temp = parseInt((e.pageX - offset.left) - 5);
                var y_temp = (parseInt(e.pageY - offset.top) - 5);
                $("#coord-list").append("<li class='coords'> X : " + x_def + " / Y : " + y_def + "</li>");
                            console.log('la x y la y del hotspot: ' + x_temp + " " +y_temp + " zoom: " +zoom);

                $(this).after("<div class='hot-spot-1 ' x='" + x_temp + "'y='" + y_temp + "'style='z-index:1000 ; top:" + y_temp  / zoom  + "px;left:" + x_temp  / zoom + "px; display:block;'></div>");
            });
            $("#show").click(function() {
                alert("Las coordenadas del eje x son: " + coords_x);
                alert("Las coordenadas del eje y son: " + coords_y);
            });
            $("#delCoord").click(function() {
                $("#coord-list li:last-child").remove();
                index_x = coords_x.length - 1;
                index_y = coords_y.length - 1;
                coords_x.splice(index_x, 1);
                coords_y.splice(index_y, 1);
                $(".hot-spot-1:first").remove();
            });
        });

    </script>
    <style>        
        #tablaHerencia {
            margin: 1%;
            margin-top: 3%;
        }
        
        #titulo-selec-mapa {
            margin-top: 20px;
            margin-bottom: 10px;
            margin-left: 20px;
            font-weight: 600;
        }
        
        #slide {
            display: flex;
            min-height: 0;
            min-width: 0;
        }

        #hotspotImg {
            overflow: auto;
            display: grid;
            width: 1000px;
            height: 550px;
            cursor: crosshair;
            margin: 0 auto;
            margin-top: 2%;
        }

        #prueba {
            height: 600px;
            overflow: auto;
            cursor: crosshair;
        }

        #hotspotImg-1 {
            background-color: #ededed;
            background-size: cover;
            background-position: center center;
            position: relative;
        }

/* La animacion */
@keyframes pulsacion {
   
    0% {
    transform: scale(1);
    
    opacity:0.2;
    }
    45% {
        transform: scale(1.75);
        opacity:0.9;
    }
}
        #hotspotImg-1 .hot-spot-1 {
            position: absolute;
            width: 20px;
            height: 20px;
            opacity: 0.85;
            text-align: center;
            background-color: #d01685;
            border-radius: 100%;
            animation: pulsacion 2s infinite;
            
        }

        #hotspotImg-1:hover .hot-spot-1:hover {
            
            background-color:#99004d;
         
            
        }

        #botonHotspots {
            width: 150px;
            margin: 0 auto;
            margin-top: 2%;
        }

        .fa-sign-out-alt {
            width: 30px;
            color: #0056b3;
        }

        /* pongo este estilo para probar , cuando funcione lo pongo en archivo externo */
        #mapa,
        #super {
            overflow: auto;
            width: 1000px !important;
            height: 550px !important;
            cursor: crosshair;
            border: 1px solid black;
            display:grid;
            /*margin: 0 auto;*/
            /*margin-bottom: 10px;
            margin-top: 15px;*/
            position: relative !important;
            /*float: right;*/
        }

        #mapa:active:hover,
        #super:active:hover {
            cursor: grabbing;
        }

        .hidden {
            display: none !important;
        }

        /* pongo este estilo para probar , cuando funcione lo pongo en archivo externo */

    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <nav class="nav nav-pills flex-column flex-sm-row">
                    <?php
                if (isset($this->session->userdata["id"])) {
                    $id = $this->session->userdata["id"];
                    $nivel = $this->modelUser->getNivel($id);
                    if (isset($noHeader)) {
                        if ($noHeader == false) {
                        }
                        else {
                            if ($nivel == 2) {
                                echo anchor('Maps/index/','Mapas','class="flex-sm-fill text-sm-center nav-link"');
                                echo anchor('Hotspots/select_maps/','Puntos de Interés','class="flex-sm-fill text-sm-center nav-link"');
                                echo anchor('Streets/view_admin_streets/','Calles','class="flex-sm-fill text-sm-center nav-link"');
                                echo anchor('Users/view_users/','Admin Usuarios','class="flex-sm-fill text-sm-center nav-link"');
                                echo anchor('Login/logout',' ','class="flex-sm-fill text-sm-center nav-link fas fa-sign-out-alt fa-2x active"');
                            }
                            else if ($nivel == 1) {
                                echo anchor('Maps/index/','Mapas','class="flex-sm-fill text-sm-center nav-link"');
                                echo anchor('Hotspots/select_maps/','Puntos de Interés','class="flex-sm-fill text-sm-center nav-link"');
                                echo anchor('Streets/view_admin_streets/','Calles','class="flex-sm-fill text-sm-center nav-link"');
                                echo anchor('Login/logout',' ','class="flex-sm-fill text-sm-center nav-link fas fa-sign-out-alt fa-2x active"');
                            }
                        }
                    }
                    else {
                        if ($nivel == 2) {
                            echo anchor('Maps/index/','Mapas','class="flex-sm-fill text-sm-center nav-link"');
                            echo anchor('Hotspots/select_maps/','Puntos de Interés','class="flex-sm-fill text-sm-center nav-link"');
                            echo anchor('Streets/view_admin_streets/','Calles','class="flex-sm-fill text-sm-center nav-link"');
                            echo anchor('Users/view_users/','Admin Usuarios','class="flex-sm-fill text-sm-center nav-link"');
                            echo anchor('Login/logout',' ','class="flex-sm-fill text-sm-center nav-link fas fa-sign-out-alt fa-2x active"');
                        }
                        else if ($nivel == 1) {
                            echo anchor('Maps/index/','Mapas','class="flex-sm-fill text-sm-center nav-link"');
                            echo anchor('Hotspots/select_maps/','Puntos de Interés','class="flex-sm-fill text-sm-center nav-link"');
                            echo anchor('Streets/view_admin_streets/','Calles','class="flex-sm-fill text-sm-center nav-link"');
                            echo anchor('Login/logout',' ','class="flex-sm-fill text-sm-center nav-link fas fa-sign-out-alt fa-2x active"');
                        }
                    }
                }
                
                ?>
                </nav>
            </div>
        </div>
    </div>

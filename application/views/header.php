<!DOCTYPE html>
<html lang='es'>

<head>
    <title>Superposición de Mapas</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/style/bootstrap/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/style/css_datatables.css">
    <!-- jQuery -->
    <script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/js/code.jquery.comjquery-3.3.1.js"></script>
    <!-- LOS ICONOS FONTAWESOME -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/style/all.css" crossorigin="anonymous">
    <script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/js/all.js"></script>
    <!-- DATATABLES: -->
    <script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/js/script_datatables.js"></script>
    <link href="<?php echo base_url()?>assets/style/mdbootstrap4.7.6cssmdb.min.css" rel="stylesheet">

    <!-- ESTILOS PROPIOS:-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/assets/style/estilo.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/assets/style/estiloHotspots.css" />
    <!-- JS PROPIOS: -->

    <script src=<?php echo base_url("assets/js/Mapas.js");?>></script>
    <script src=<?php echo base_url("assets/js/demo.js");?>></script>
    <script src=<?php echo base_url("assets/js/jquery.hotspot.js");?>></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/dragscroll.js"></script>
    
    <script>
        coords_x = [];
        coords_y = [];
        $(document).ready(function() {
            // Click solo una vez.
            // Mapa ya dibujado el punto.
           
            $('.alert').fadeIn().delay(2500).fadeOut();
            $('#img_callejero').dblclick(function(e) {
                if ($('.hot-spot-1').val() == null && $('.selected').val() != null) {
                    $("#delCoord").prop('disabled', false);
                    $("li").eq('0').toggleClass('active', false);
                    $("li").eq('1').toggleClass('active', false);
                    $("li").eq('2').toggleClass('active', true);
                    $("li").eq('3').toggleClass('active', false);
                    var offset = $(this).offset();
                    coords_x.push(parseInt(e.pageX - offset.left));
                    coords_y.push(parseInt(e.pageY - offset.top));
                    var x_def = parseInt(e.pageX - offset.left);
                    var y_def = parseInt(e.pageY - offset.top);
                    var x_temp = parseInt((e.pageX - offset.left) - 5);
                    var y_temp = (parseInt(e.pageY - offset.top) - 5);
                    $("#coord-list").append("<li class='coords'> X : " + x_def + " / Y : " + y_def + "</li>");
                    console.log('la x y la y del hotspot: ' + x_temp + " " + y_temp + " zoom: " + zoom);
                    $(this).after("<div class='hot-spot-1 ' x='" + x_temp + "'y='" + y_temp + "'style='z-index:1000 ; top:" + y_temp / zoom + "px;left:" + x_temp / zoom + "px; display:block;'></div>");
                    $('.custom-checkbox').removeClass('disabledbutton');
                    $('.btn-continuar').prop('disabled', false);

                    $('.btn-update').prop('disabled', true);
                    $('.btn-delete').prop('disabled', true);
                    $('.btn-anadir').prop('disabled', true);
                }
            });


            $("#delCoord").click(function() {
                $('.btn-continuar').prop('disabled', true);
                $('.cb_hidden').prop('checked', true);
                $('.custom-checkbox').removeClass('disabledbutton');
                $("li").eq('0').toggleClass('active', false);
                $("li").eq('1').toggleClass('active', true);
                $("li").eq('2').toggleClass('active', false);
                $("li").eq('3').toggleClass('active', false);
                $("li").eq('3').toggleClass('active', false);
                $(this).prop('disabled', true);
                $("#coord-list li:last-child").remove();
                index_x = coords_x.length - 1;
                index_y = coords_y.length - 1;
                coords_x.splice(index_x, 1);
                coords_y.splice(index_y, 1);
                $(".hot-spot-1:first").remove();

                $('.cb_mapas').each(function(){
                    console.log('entra checkboxxx');
                    $(this).prop('checked',true);    
                });
                $('.cb_hidden').hide();

                $('.btn-update').prop('disabled', false);
                $('.btn-delete').prop('disabled', false);
                $('.btn-anadir').prop('disabled', false);
                $('.cb_hidden').hide();

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
            width: 1000px !important;
            height: 600px !important;
            overflow: auto;
            /*cursor: crosshair;*/
            display: grid !important;
        }

        #hotspotImg-1,
        #hotspotImg-2 {
            background-size: cover;
            background-position: center center;
            position: relative;
        }

        /* La animacion */
        @keyframes pulsacion {

            0% {
                transform: scale(1);

                opacity: 0.2;
            }

            45% {
                transform: scale(1.75);
                opacity: 0.9;
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
            background-color: #99004d;
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
        /*#mapa,
        #super {
            overflow: auto;
            width: 1000px !important;
            height: 550px !important;
            cursor: crosshair;
            border: 1px solid black;
            display:grid !important;
            /*margin: 0 auto;*/
        /*margin-bottom: 10px;
            margin-top: 15px;*/
        position: relative !important;
        /*float: right;
        }*/

        /*#mapa:active:hover,
        #super:active:hover {
            cursor: grabbing;
        }*/

        .hidden {
            display: none !important;
        }

        #mapa_alt:hover {
            cursor: grab;
        }

        #mapa_alt:active:hover {
            cursor: grabbing;
        }

        /* pongo este estilo para probar , cuando funcione lo pongo en archivo externo */

    </style>
</head>

<body>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/mdbootstrap4.7.6.js"></script>

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
                                echo anchor('Maps/index/','Mapas','id="enlace_mapas" class="flex-sm-fill text-sm-center nav-link "');
                                echo anchor('Hotspots/select_maps/','Puntos de Interés',' id="enlace_hotspots" class="flex-sm-fill text-sm-center nav-link"');
                                echo anchor('Streets/view_admin_streets/','Calles',' id="enlace_calles" class="flex-sm-fill text-sm-center nav-link"');
                                echo anchor('Users/view_users/','Admin Usuarios',' id="enlace_usuarios" class="flex-sm-fill text-sm-center nav-link"');
                                echo anchor('Login/logout','Logout',' class="flex-sm-fill text-sm-center nav-link"');
                            }
                            else if ($nivel == 1) {
                                echo anchor('Maps/index/','Mapas','id="enlace_mapas" class="flex-sm-fill text-sm-center nav-link "');
                                echo anchor('Hotspots/select_maps/','Puntos de Interés',' id="enlace_hotspots" class="flex-sm-fill text-sm-center nav-link"');
                                echo anchor('Streets/view_admin_streets/','Calles',' id="enlace_calles" class="flex-sm-fill text-sm-center nav-link"');
                                echo anchor('Login/logout','Logout','class="flex-sm-fill text-sm-center nav-link"');
                            }
                        }
                    }
                    else {
                        if ($nivel == 2) {
                            echo anchor('Maps/index/','Mapas','id="enlace_mapas" class="flex-sm-fill text-sm-center nav-link "');
                            echo anchor('Hotspots/select_maps/','Puntos de Interés',' id="enlace_hotspots" class="flex-sm-fill text-sm-center nav-link"');
                            echo anchor('Streets/view_admin_streets/','Calles',' id="enlace_calles" class="flex-sm-fill text-sm-center nav-link"');
                            echo anchor('Users/view_users/','Admin Usuarios',' id="enlace_usuarios" class="flex-sm-fill text-sm-center nav-link"');
                            echo anchor('Login/logout','Logout',' class="flex-sm-fill text-sm-center nav-link"');
                        }
                        else if ($nivel == 1) {
                            echo anchor('Maps/index/','Mapas','id="enlace_mapas" class="flex-sm-fill text-sm-center nav-link "');
                            echo anchor('Hotspots/select_maps/','Puntos de Interés',' id="enlace_hotspots" class="flex-sm-fill text-sm-center nav-link"');
                            echo anchor('Streets/view_admin_streets/','Calles',' id="enlace_calles" class="flex-sm-fill text-sm-center nav-link"');
                            echo anchor('Login/logout','Logout','class="flex-sm-fill text-sm-center nav-link"');
                        }
                    }
                }
                
                ?>
                </nav>
            </div>
        </div>
  

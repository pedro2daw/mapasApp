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
    <link rel='shortcut icon' type='image/png' href='<?php echo base_url()?>/assets/img/icono/i2.png'/>
    <!-- HTML2CANVAS -->
    <script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/js/canvas2image.js"></script>
    <script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/js/html2canvas.js"></script>
    <!-- ESTILOS PROPIOS:-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/assets/style/estilo.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/assets/style/estiloHotspots.css" />
    <!-- JS PROPIOS: -->
    <script src=<?php echo base_url("assets/js/sweetalert.min.js");?>></script>
    <script src=<?php echo base_url("assets/js/Mapas.js");?>></script>
    <script src=<?php echo base_url("assets/js/demo.js");?>></script>
    <script src=<?php echo base_url("assets/js/jquery.hotspot.js");?>></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/dragscroll.js"></script>
    <script src=<?php echo base_url("assets/js/back_up.js");?>></script>
    <script src=<?php echo base_url("assets/js/FileSaver.js");?>></script>
    <script src=<?php echo base_url("assets/js/jspdf.js");?>></script>
    <script src=<?php echo base_url("assets/js/jspdf-autotable.js");?>></script>
    
    <script>
        coords_x = [];
        coords_y = [];
        var principal = false;
        $(document).ready(function() {
            $(".se-pre-con").fadeOut("slow");;
            // Click solo una vez.
            // Mapa ya dibujado el punto.

            // FUNCION DE EVENTO PARA SELECCIONAR EL PLANO PRINCIPAL //
            $(".main").click(function() {
                swal({
                    title: "¿Deseas seleccionar este plano como principal?",
                    text: "El plano principal es el que se toma de referencia al realizar la alineación de los mapas.",
                    icon: "info",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((principal) => {
                        if (principal == true) {
                            var principal_value = $(this).val();
                            var num_mapas = $(".thumbnail_mapa").length;
                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url(); ?>index.php/Maps/update_principal/",
                                data: {
                                    "id_principal": principal_value
                                },
                                success: function(data) {
                                    $(".alert_principal").addClass("d-none");
                                    
                                    swal("", "Se ha actualizado el mapa principal", "success");
                                    if (num_mapas > 1) {
                                        //alert("Debes alinear los planos de nuevo. Se procederá a redirigir al proceso de alineación");
                                        //var redirect = confirm("Debes alinear los planos. ¿Quieres realizar ahora el proceso de alineacion?");

                                        swal({
                                            title: "Debes alinear los planos.",
                                            text: "¿Quieres realizar ahora el proceso de alineacion?",
                                            icon: "info",
                                            buttons: true,
                                            dangerMode: true,
                                            })
                                            .then((redirect) => {
                                                if (redirect) {
                                                $(location).attr("href", "<?php echo base_url('index.php/Maps/get_maps')?>");
                                                } else {         
                                                    $(location).attr("href", "<?php echo base_url('index.php/Maps/')?>");
                                                }
                                        });
                                    }
                                    else $(location).attr("href", "<?php echo base_url('index.php/Maps/')?>");
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    console.log("error:" + errorThrown);
                                }
                            });
                        }                        
                });
            });

            // FUNCION DE EVENTO PARA SELECCIONAR EL PLANO PRINCIPAL //
            $("#alinear_button").click(function() {
                $(location).attr("href", "<?php echo base_url('index.php/Maps/get_maps/') ?>");
            });

            $('.alert').fadeIn().delay(2500).fadeOut();
            $('#img_callejero').dblclick(function(e) {
                if ($('.hot-spot-1').val() == null && $('.selected').val() != null) {
                    $("#delCoord").show();
                    $("li").eq('0').toggleClass('active', false);
                    $("li").eq('1').toggleClass('active', false);
                    $("li").eq('3').toggleClass('active', false);
                    var offset = $(this).offset();
                    coords_x.push(parseInt(e.pageX - offset.left));
                    coords_y.push(parseInt(e.pageY - offset.top));
                    var x_def = parseInt(e.pageX - offset.left);
                    var y_def = parseInt(e.pageY - offset.top);
                    var x_temp = parseInt((e.pageX - offset.left) - 5);
                    var y_temp = parseInt((e.pageY - offset.top) - 5);
                    
                    console.log('la x y la y del hotspot: ' + x_temp + " " + y_temp + " zoom: " + zoom);
                    $(this).after("<div class='hot-spot-1 ' x='" + x_temp + "'y='" + y_temp + "'style='z-index:1000 ; top:" + y_temp / zoom + "px;left:" + x_temp / zoom + "px; display:block;'></div>");
                    $('.btn-update').hide();
                    $('.btn-delete').hide();
                    $('.btn-anadir').hide();
                    
                    if (modificar != null) {
                        $('.btn-insert-coords').show();
                        $("li").eq('2').toggleClass('active', false);
                        $("li").eq('3').toggleClass('active', true);
                        $('#table_mapas').removeClass('border');
                    } else {
                        $('.custom-checkbox').removeClass('disabledbutton');
                        $('.nombre_calles').hide();
                        $('.esta-en-mapa').text("Correcto en:");
                        $('.checkbox_calles').show();
                        
                        $('.btn-continuar').show();
                        $('#delCoord').show();
                        $("li").eq('2').toggleClass('active', true);
                        $('#table_mapas').addClass('border');
                    }
                }
            });

            $("#delCoord").click(function() {
                // Si estamos añadiendo al historial de calles existentes:
                if (x_aux != null){
                    x_aux = null;
                    y_aux = null;
                    insertar_con_punto = false;
                }
                $('.cb_hidden').slideUp();

                $('#table_mapas').removeClass('border');
                $('#delCoord').hide();
                if (modificar != null && $(".selected").hasClass("warning")) {
                    x_aux = null;
                    y_aux = null;
                    modificar = null;
                    $('.btn-update').show();
                    $('.btn-delete').show();
                    $('.btn-anadir').show();
                    $('.cb_hidden').hide();
                }

                $('.custom-checkbox').addClass('disabledbutton');
                $('.btn-continuar').hide();
                $('.nombre_calles').show();
                $('.esta-en-mapa').text("");

                $('.checkbox_calles').hide();
                $('.cb_hidden').prop('checked', true);
                $("li").eq('0').toggleClass('active', false);
                $("li").eq('1').toggleClass('active', true);
                $("li").eq('2').toggleClass('active', false);
                $("li").eq('3').toggleClass('active', false);
                $("li").eq('3').toggleClass('active', false);
                $(this).hide();
                $("#coord-list li:last-child").remove();
                index_x = coords_x.length - 1;
                index_y = coords_y.length - 1;
                coords_x.splice(index_x, 1);
                coords_y.splice(index_y, 1);
                $(".hot-spot-1:first").remove();

                $('.cb_mapas').each(function() {
                    console.log('entra checkboxxx');
                    $(this).prop('checked', true);
                });
                

               $('.btn-insert-coords').hide(); 
            });

            $('.thumbnail_mapa').on("error", function () {
                this.src = ResolveUrl("");
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

        #mapa_alt:active {
            cursor: grabbing;
        }

        /* pongo este estilo para probar , cuando funcione lo pongo en archivo externo */
        
        /* Estilo tabla calles */
        #mostrarOcultar {
            width: 600px;
            margin: 0 auto;
            margin-top: 40px;
        }
        
        #botonesTabla {
            width: 300px;
            margin: 0 auto;
            margin-top: 40px;
        }
        
        /* Estilo tabla calles */
        
    </style>
</head>

<div class="se-pre-con"></div>
<body>
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/mdbootstrap4.7.6.js"></script>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <nav class="nav nav-pills flex-column flex-sm-row menu">
                    <?php
                    $path =  "<img src='".base_url("/assets/img/icono/i2.png")."' id='favicon'>";
                    
                if (isset($this->session->userdata["id"])) {
                    $id = $this->session->userdata["id"];
                    $nivel = $this->ModelUser->getNivel($id);
                    
                    if (isset($noHeader)) {
                        if ($noHeader == false) {
                        }
                        else {
                            if ($nivel == 2) {
                                echo anchor('Maps/index/',$path,' class="flex-sm-fill text-sm-center nav-link "');
                                echo anchor('Maps/index/','Mapas','id="enlace_mapas" class="flex-sm-fill text-sm-center nav-link "');
                                echo anchor('Hotspots/select_maps/','Puntos de Interés',' id="enlace_hotspots" class="flex-sm-fill text-sm-center nav-link"');
                                echo anchor('Streets/view_admin_streets/','Calles',' id="enlace_calles" class="flex-sm-fill text-sm-center nav-link"');
                                echo anchor('Users/view_users/','Admin Usuarios',' id="enlace_usuarios" class="flex-sm-fill text-sm-center nav-link"');
                                echo anchor('BackUp/back_up','Backup','id="enlace_back" class="flex-sm-fill text-sm-center nav-link"');
                                echo anchor('ListadoCalles/get_listado','Listado de calles','id="enlace_listado" class="flex-sm-fill text-sm-center nav-link"');
                                echo anchor('Login/logout','Logout',' class="flex-sm-fill text-sm-center nav-link"');
                               // echo anchor('Security/export_database','Backup','class="flex-sm-fill text-sm-center nav-link"');
                               
                            }
                            else if ($nivel == 1) {
                                echo anchor('Maps/index/',$path,' class="flex-sm-fill text-sm-center nav-link "');
                                echo anchor('Maps/index/','Mapas','id="enlace_mapas" class="flex-sm-fill text-sm-center nav-link "');
                                echo anchor('Hotspots/select_maps/','Puntos de Interés',' id="enlace_hotspots" class="flex-sm-fill text-sm-center nav-link"');
                                echo anchor('Streets/view_admin_streets/','Calles',' id="enlace_calles" class="flex-sm-fill text-sm-center nav-link"');
                                echo anchor('Login/logout','Logout','class="flex-sm-fill text-sm-center nav-link"');
                            }
                        }
                    }
                    else {
                        if ($nivel == 2) {
                            echo anchor('Maps/index/',$path,'class="flex-sm-fill text-sm-center nav-link "');
                            echo anchor('Maps/index/','Mapas','id="enlace_mapas" class="flex-sm-fill text-sm-center nav-link "');
                            echo anchor('Hotspots/select_maps/','Puntos de Interés',' id="enlace_hotspots" class="flex-sm-fill text-sm-center nav-link"');
                            echo anchor('Streets/view_admin_streets/','Calles',' id="enlace_calles" class="flex-sm-fill text-sm-center nav-link"');
                            echo anchor('Users/view_users/','Admin Usuarios',' id="enlace_usuarios" class="flex-sm-fill text-sm-center nav-link"');
                            echo anchor('BackUp/back_up','Backup','id="enlace_back" class="flex-sm-fill text-sm-center nav-link"');
                            echo anchor('ListadoCalles/get_listado','Listado de calles','id="enlace_listado" class="flex-sm-fill text-sm-center nav-link"');
                            echo anchor('Login/logout','Logout',' class="flex-sm-fill text-sm-center nav-link"');
                            //echo anchor('Security/export_database','Backup','class="flex-sm-fill text-sm-center nav-link"');
                            
                        }
                        else if ($nivel == 1) {
                            echo anchor('Maps/index/',$path,' class="flex-sm-fill text-sm-center nav-link "');
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

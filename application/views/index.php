<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mapas Developers</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url()?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <!--<link href="<?php echo base_url()?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="<?php echo base_url()?>/assets/vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url()?>/assets/css/freelancer.min.css" rel="stylesheet">

    <!-- FONTAWESOME -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/style/all.css" crossorigin="anonymous">
    <script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/js/all.js"></script>

    <!-- HOTSPOTS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/assets/style/estiloHotspots.css" />
    <script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/js/code.jquery.comjquery-3.3.1.js"></script>
    <script src="<?php echo base_url()?>assets/js/jquery.hotspot.js"></script>

    <!-- DATATABLES: -->
    <script type="text/javascript" language="javascript" src="<?php echo base_url()?>assets/js/script_datatables.js"></script>
    <link href="<?php echo base_url()?>assets/style/mdbootstrap4.7.6cssmdb.min.css" rel="stylesheet">

    <script type="text/javascript" src="<?php echo base_url()?>assets/js/dragscroll.js"></script>
    
    <script type="text/javascript" src="<?php echo base_url()?>assets/wheelzoom.js"></script>

    <style>
        .copyright {
            background-color: #595959 !important;
        }

        .navbar-toggler {
            background-color: #7f7f7f !important;
        }

        .nav-link.active {
            color: white !important;
        }

        .footer {
            background-color: #7f7f7f !important;
        }

        .masthead {
            padding: 100px !important;
        }

        .navbar {
            background-color: #595959 !important;
        }

        .active {
            background-color: #7f7f7f !important;
        }

        a.nav-link:hover {
            color: white !important;
        }

        #mapa {
            background-color: #cccccc !important;
        }

        .masthead {
            background-color: white !important;
            color: #2c3e50 !important;
        }

        #sobreNosotros {
            background-color: white !important;
            color: #2c3e50 !important;
        }

        #sobreNosotros h2 {
            color: #2c3e50 !important;
        }

        #contacto {
            background-color: #cccccc !important;
        }

        #sendMessageButton {
            background-color: #800000 !important;
            border: 1px solid #800000 !important;
        }

        #tabla {
            overflow: auto;
            display: grid;
            width: 100%;
            height: 450px !important;
        }

        #tabla2 {
            overflow: auto;
            display: grid;
            width: 100%;
            height: 450px !important;
        }

        #puntosInteres {
            display: none;
        }

        #slide {
            display: flex;
            min-height: 0;
            min-width: 0;
        }

        .mapas {
            position: absolute;
        }

        .mapas:first-child {
            left: 0px;
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

    </style>



    <script>
        $(document).ready(function() {
            zoom = 1;
            zoom1 = 1;
            // Carga de los puntos insertados desde la BD
            $('#hotspotImg').hotSpot({

                // default selectors
                mainselector: '#hotspotImg',
                selector: '.hot-spot',
                imageselector: '.img-responsive',
                tooltipselector: '.tooltip',

                // or 'click'
                bindselector: 'hover'

            });

            $("#radioCalles").on("click", function() {
                $("#selectMapa").prop("disabled", true);
                $("#puntosCalles").css("display", "");
                $("#puntosInteres").css("display", "none");
            });

            $("#radioPuntos").on("click", function() {
                $("#selectMapa").prop("disabled", false);
                $("#puntosInteres").css("display", "block");
                $("#puntosCalles").css("display", "none");
            });

            $("#selectMapa").on("change", function() {
                var srcMapa = $(this).find(':selected').data('src-mapa');
                var idMapa = $(this).find(':selected').data('id-mapaselect');
                $("#slide").attr("src", srcMapa);

                $.ajax({
                    url: "<?php echo base_url(); ?>index.php/Front/get_all_hotspots/" + idMapa,
                    type: 'post',
                    success: function(data) {
                        $(".hot-spot").remove();
                        var obj = JSON.parse(data.toString());
                        $.each(obj, function(key, value) {
                            $("#slide").after("<div id='" + value.id + "' class='hot-spot' data-posx='" + value.punto_x + "' data-posy='" + value.punto_y + "' style='top: " + value.punto_y + "px; left: " + value.punto_x + "px; display: block;'><div class='circle'></div><div class='tooltip' style='margin-left: -135px; display: none;'><div class='img-row'><img src='" + "<?php echo base_url("/assets/img/img_hotspots/") ?>" + value.imagen + "' width='100'></div><div class='text-row'><h4>" + value.titulo + "</h4><p>" + value.descripcion + "</p></div></div></div>");

                        });
                        $('#hotspotImg').hotSpot({

                            // default selectors
                            mainselector: '#hotspotImg',
                            selector: '.hot-spot',
                            imageselector: '.img-resposive',
                            tooltipselector: '.tooltip',

                            // or 'click'
                            bindselector: 'hover'

                        });
                    }
                });

            });


            $("#hotspotImg").on("wheel", function(e) {
                var width = $("#hotspotImg").first().width();
                console.log('zoom ' + zoom);

                var e0 = e.originalEvent,
                    delta = e0.wheelDelta || -e0.detail;

                this.scrollTop += (delta < 0 ? 1 : -1) * 30;
                e.preventDefault();
                actWdth = $("#hotspotImg img").width() * zoom;
                if (e.originalEvent.deltaY < 0) {

                    // Tony: SE PODRA HACER 10 VECES MAS PEQUEÑO
                    if (actWdth < width * 10) {
                        zoom += 0.04;
                    }
                    $("#hotspotImg").css("transition", "transform 1s");
                    $("#hotspotImg").css("transform-origin", "top left");
                    $("#hotspotImg").css("transform", "scale(" + (zoom) + ")");
                } else {
                    // Tony: Se podrá hacer zoom hacia afuera hasta que el width de la imagen sea mayor que el width del div + 200
                    if (actWdth > width + 200) {
                        zoom -= 0.04;
                    }
                    $("#hotspotImg").css("transition", "transform 1s");
                    $("#hotspotImg").css("transform-origin", "top left");
                    $("#hotspotImg").css("transform", "scale(" + (zoom) + ")");
                }
            });

            //Funciones calles

            // Carga la tabla de calles el plug-in de DataTables.
            $('#tabla_calles').DataTable({
                "scrollY": "210px",
                "scrollCollapse": true,
                "paging": false,

                "language": {
                    "info": "",
                    "infoEmpty": "",
                    "infoFiltered": "",
                    "zeroRecords": "No se encuentran datos" /* No hay data disponible */
                },
                "columns": [{
                        "data": "Tipo",
                        className: "d-none"
                    },
                    {
                        "data": "Nombre",
                        className: "d-none"
                    },
                    {
                        "data": "Punto",
                        className: "d-none"
                    },
                    {
                        "data": "Calle"
                    },
                ]
            });
            table = $('#tabla_calles').DataTable();
            // Establecemos un placeholder para el buscador de calles.
            $("input[type='search']").attr('placeholder', 'Buscar Calle');
            // Eliminamos la etiqueta del input de buscador de calles.
            $('#tabla_calles_filter label').contents().first().remove();
            // Añadimos la clase form-control para que el buscador tenga el aspecto de bootstrap.
            $("input[type='search']").addClass('form-control');
            $('.btn-continuar').hide();
            // Cambia la opacidad del mapa principal.
            $(document).on("input", "#slider_callejero", function() {
                var opacity = $(this).val();
                $("#img_callejero").css("opacity", opacity);
            });

            $("#hotspotImg-1").on("wheel", function(e) {
                var width = $("#hotspotImg-1").first().width();
                console.log('zoom ' + zoom1);

                var e0 = e.originalEvent,
                    delta = e0.wheelDelta || -e0.detail;

                this.scrollTop += (delta < 0 ? 1 : -1) * 30;
                e.preventDefault();
                actWdth = $("#hotspotImg-1 img").width() * zoom1;
                if (e.originalEvent.deltaY < 0) {

                    // Tony: SE PODRA HACER 10 VECES MAS PEQUEÑO
                    if (actWdth < width * 10) {
                        zoom1 += 0.04;
                    }
                    $("#hotspotImg-1").css("transition", "transform 1s");
                    $("#hotspotImg-1").css("transform-origin", "top left");
                    $("#hotspotImg-1").css("transform", "scale(" + (zoom1) + ")");
                } else {
                    // Tony: Se podrá hacer zoom hacia afuera hasta que el width de la imagen sea mayor que el width del div + 200
                    if (actWdth > width + 200) {
                        zoom1 -= 0.04;
                    }
                    $("#hotspotImg-1").css("transition", "transform 1s");
                    $("#hotspotImg-1").css("transform-origin", "top left");
                    $("#hotspotImg-1").css("transform", "scale(" + (zoom1) + ")");
                }
            });

            modificar = null;
            x_aux = null;
            y_aux = null;

            function get_data() {
                id = $(".selected").data("id");
                nombre = $('#nombre_' + id).text();
                tipo = $('#tipo_' + id).text();
                if (x_aux == null) {
                    x = $('#punto_' + id).data('x');
                    y = $('#punto_' + id).data('y');
                } else {
                    x = x_aux;
                    y = y_aux;
                }
                calle = tipo + " " + nombre;
            }

            $(document).on("click", ".calles", function() {
                $('#table_mapas').removeClass('blue-grey lighten-5 border');
                var_this = this;
                $(".hot-spot-1").remove();
                $('.calles').removeClass('selected');
                $(this).toggleClass('selected');
                get_data();
                $('.custom-checkbox').addClass('disabledbutton');

                $('.nombre_calles').show();
                $('.esta-en-mapa').text("");

                $('.checkbox_calles').hide();

                $('.cb_hidden').hide();
                $('.cb_mapas').each(function() {
                    $(this).prop('checked', true);
                });
                // Borra el punto en el mapa:
                var top = $('#tabla2').scrollTop();
                var left = $('#tabla2').scrollLeft();
                console.log(" ******************************* ");
                console.log("top y left " + top + " " + left + "zoom" + zoom1 + "X " + x + " Y " + y);

                $("#delCoord").hide();
                $('.btn-update').data('id', id);
                $('.btn-insert').show();
                $('.btn-update').show();
                $('.btn-anadir').show();
                $('.btn-delete').show();
                $('.btn-delete').data('id', id);



                if (x_aux != null) {
                    console.log(x_aux);
                    x = x_aux;
                    y = y_aux;
                }
                // Si añado un punto en el mapa para una calle sin punto asignado y selecciono otra calle (con punto) del listado. El mapa debe resetearse y ocutarse el boton de continuar.
                if ((x == null || y == null) && $(this).hasClass("warning")) {
                    $("li").eq('0').toggleClass('active', false);
                    $("li").eq('1').toggleClass('active', true);
                    $("li").eq('2').toggleClass('active', false);
                    $("li").eq('3').toggleClass('active', false);
                    $(document).on("mouseover", ".hot-spot-1", function(e) {
                        $(this).css({
                            'cursor': 'cursor',
                            'pointer-events': 'none'
                        });
                    });
                    $('.btn-continuar').hide();

                } else {
                    // Si añado un punto en el mapa para una calle sin punto asignado y selecciono otra calle (con punto) del listado. El mapa debe resetearse y ocutarse el boton de continuar.
                    $('.btn-continuar').hide();


                    // Si existe x_aux y la clase es warning se esta utilizando el punto. Se esta añadiendo esta calle al historial de calles.
                    if (x_aux != null && $(this).hasClass("warning") && insertar_con_punto) {
                        $("li").eq('0').toggleClass('active', false);
                        $("li").eq('1').toggleClass('active', false);
                        $("li").eq('2').toggleClass('active', true);
                        $("li").eq('3').toggleClass('active', false);
                        $('.custom-checkbox').removeClass('disabledbutton');
                        $('.nombre_calles').hide();
                        $('.esta-en-mapa').text("Correcto en:");

                        $('.checkbox_calles').show();
                        $('.btn-continuar').show();
                        $('.btn-anadir').hide();
                        $('.btn-update').hide();
                        // DELETE
                        $('.btn-delete').hide();
                        // INSERTAR COORDENADAS:
                        $('.btn-insert-coords').hide();
                        $("#delCoord").show();

                    } else {
                        // Sino, es una calle con coordenadas ya insertadas.
                        // Si la x auxiliar está inicializada y la clase no es warning ha seleccionado una calle con los puntos ya establecidos y se notificará al usuario.
                        if (x_aux != null && !$(this).hasClass("warning") && insertar_con_punto) {
                            swal({
                                title: "Precaución",
                                text: "Seleccione una calle SIN puntos establecidos, por favor. (Una calle en naranja o añada una ahora).",
                                icon: "warning"
                            });
                            $('.btn-continuar').hide();
                        }
                        // Se está modificando el punto y se ha seleeccionado otra calle. Notificación de cancelación del proceso.


                        $("li").eq('0').toggleClass('active', false);
                        $("li").eq('1').toggleClass('active', false);
                        $("li").eq('2').toggleClass('active', false);
                        $("li").eq('3').toggleClass('active', false);
                    }




                    $(document).on("mouseover", ".hot-spot-1", function(e) {
                        $(this).css({
                            'cursor': 'pointer',
                            'pointer-events': 'auto'
                        });
                    });


                    console.log("Calle seleccionada: " + id);
                    console.log('Punto X: ' + x);
                    console.log('Punto Y: ' + y);

                    $('#img_callejero').after("<div id='id_hot-spot-1'class='hot-spot-1' x='" + x + "'y='" + y + "'style='z-index:1000 ; top:" + y + "px;left:" + x + "px; display:block; width:20px; height:20px;'></div>");

                    if (zoom1 == 1) {
                        $('#tabla2').scrollTop((y - ($('#tabla2').height() / 2) - 5) * zoom1);
                        $('#tabla2').scrollLeft((x - ($('#tabla2').width() / 2) - 5) * zoom1);
                    } else if (zoom1 > 1) {
                        // Se acerca:
                        $('#tabla2').scrollTop((y - ($('#tabla2').height() / 2) - 5 + 110) * zoom1);
                        $('#tabla2').scrollLeft((x - ($('#tabla2').width() / 2) - 5 + 110) * zoom1);
                    } else {
                        // Se aleja
                        $('#tabla2').scrollTop((y - ($('#tabla2').height()) - 5) * zoom1);
                        $('#tabla2').scrollLeft((x - ($('#tabla2').width()) - 5) * zoom1);
                    }

                    /*
                     */
                }
                if (x_aux != null && !insertar_con_punto) {

                    swal({
                        title: "Precaución",
                        text: "Ha cancelado el proceso de modificación del punto al seleccionar otra calle.",
                        icon: "warning"
                    });
                    $('.btn-insert-coords').hide();
                    x_aux = null;
                    y_aux = null;
                }




            });

            $('#tabla_calles tbody').on('click', 'tr', function() {
                row = table.row(this).index();
            });
            //aqui
            $(document).on("click", ".hot-spot-1", function(e) {
                $('#lista_puntos').html("");
                lista_mapas_calles();
                var length = $(".warning").length;
                if (length == 0) {
                    $(".btn-insertar-con-punto").prop("disabled", true);
                    $("#msg_insertar_con_punto").attr('title', 'Todas las calles insertadas tienen un punto asignado. Añada una calle nueva para asignar este punto.');
                } else {
                    $(".btn-insertar-con-punto").prop("disabled", false);
                    $("#msg_insertar_con_punto").attr('title', 'Puede establecer este punto para una calle que no tiene un punto asignado.');
                }
                e.preventDefault();
            });



        });

        function lista_mapas_calles() {
            var x = $(this).attr('x');
            var y = $(this).attr('y');

            $.ajax({
                cache: false,
                url: "<?php echo base_url("Front/get_streets_associated_to_coord/"); ?>" + x + "/" + y,
                dataType: 'json',
                encode: true
            }).done(function(data) {
                var msg = data.msg;
                console.log(data);
                var count = Object.keys(data).length;
                $('#modal_puntos').modal('toggle');

                if (msg == '0') {
                    for (i = 0; i < count - 1; i++) {
                        $('#lista_puntos').append("<li>" + data[i].tipo + " " + data[i].nombre + " está en el mapa " + data[i].titulo + "</li>")
                    }
                } else {}

            });
        }

    </script>

</head>

<body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">Inicio</a>
            <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#mapa">Mapa</a>
                    </li>
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#sobreNosotros">Sobre nosotros</a>
                    </li>
                    <li class="nav-item mx-0 mx-lg-1">
                        <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contacto">Contactanos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="masthead bg-primary text-white text-center">
        <div class="container">
            <img class="img-fluid mb-5 d-block mx-auto" src="<?php echo base_url()?>/assets/img/profile.png" alt="Logo de mapa">
            <h1 class="text-uppercase mb-0">Mapas Developers</h1>
            <hr class="star-dark">
            <h2 class="font-weight-light mb-0">Esta app permite sobreponer mapas de distintas epocas e insertarle calles y puntos de interes como se puede ver mas abajo.</h2>
        </div>
    </header>

    <!-- Portfolio Grid Section -->
    <section class="mapa" id="mapa">
        <div class="container">
            <h2 class="text-center text-uppercase text-secondary mb-0">Mapa</h2>
            <hr class="star-dark mb-5">
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="radioCalles" value="option1" checked>
                        <label class="form-check-label" for="radioCalles">
                            Calles
                        </label>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="radioPuntos" value="option2">
                        <label class="form-check-label" for="radioPuntos">
                            Puntos de interés
                        </label>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <select class="form-control" id="selectMapa" disabled>
                            <?php
                            foreach ($ListaMapas as $mapa) {
                            echo "<option data-src-mapa='" .base_url($mapa["imagen"]). "' data-id-mapaselect='" .$mapa["id"]. "'>" .$mapa["titulo"]. "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>

            <!-- INICIO MAPA CALLES -->

            <div id="puntosCalles" class="row">
                <div class="col-md-3">
                    <div class="table-responsive">
                        <table class="table table-hover" id='tabla_calles'>
                            <thead>
                                <tr>

                                    <th class='d-none' scope="col">Tipo</th>
                                    <th class='d-none' scope="col">Nombre</th>
                                    <th class='d-none' scope="col">Punto</th>
                                    <th scope="col">Calle</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                            for($i = 0; $i < count($listaCalles);$i++){
                            $calle = $listaCalles[$i];
                            echo "<tr id=calle_".$calle["id"]." >";
                            echo "<td id='tipo_".$calle["id"]."' class='d-none'>".$calle["tipo"]."</td>";
                            echo "<td id='nombre_".$calle["id"]."' class='d-none'>".$calle["nombre"]."</td>";
                            if (isset($calle["id_punto"])){
                                echo "<td id='punto_".$calle["id"]."' class='d-none' data-x='".$calle['x']."' data-y='".$calle['y']."'></td>";
                                echo "<td class='calles' data-id=".$calle["id"].">".$calle["tipo"]." ".$calle["nombre"]."</td>";
                            } else {
                                echo "<td id='punto_".$calle["id"]."' class='d-none warning_puntos' data-x='null' data-y='null'></td>";
                                echo "<td id=id_calle_warning_".$calle["id"]." class='calles warning' data-id=".$calle["id"].">".$calle["tipo"]." ".$calle["nombre"]."</td>";
                            }
                            echo "</tr>";
                            }
                        ?>
                            </tbody>
                        </table>
                    </div> <!-- fin table-responsive -->

                    <div id='table_mapas'>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Mapas</th>
                                    <th scope="col"> </th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php 
                                for($i = 0; $i < count($listaMapas);$i++){
                                $mapa = $listaMapas[$i];
                                echo "<tr data_mapa_id=".$mapa['id']." id=mapa_".$mapa["id"].">";
                                if ($i == 0){
                                echo "<td><label>".$mapa['titulo']."</label>
                                <input id='slider_callejero' style='float:left; margin-bottom:10px; width:100%;' type='range' value='1' name='points' min='0' max='1' step='0.1'/> <div id='cb_hidden_".$mapa["id"]."' class='cb_hidden'></div> 
                                </td>";    
                                }else {
                                echo "<td><label>".$mapa['titulo']."</label><input style='float:left; margin-bottom:10px; width:100%;' type='range' value='1'   id='slider_".$mapa["id"]."' oninput='changeOpacity(".$mapa["id"].")' value='0' name='points' min='0' max='1' step='0.1'/> <div id='cb_hidden_".$mapa["id"]."' class='cb_hidden'></div>
                                </td>";
                                }
                                }                            
                            ?>
                            </tbody>

                        </table>
                    </div>

                </div> <!-- fin col md-3 -->
                <div id="tabla2" class="col-md-9 dragscroll">
                    <div class="col-md" id="prueba">
                        <div id="hotspotImg-1">

                            <?php
                            for ($i = 0 ; $i < count($img_mapas) ; $i++){
                                $img = $img_mapas[$i];
                                if ($i == 0){
                                    echo "<img class='mapas' id='img_callejero' data-id='".$i."' data-x='".$img_mapas[0]['desviacion_x']."' data-y='".$img_mapas[0]['desviacion_y']."' style=' top:".$img_mapas[0]['desviacion_y']."px ; left:".$img_mapas[0]['desviacion_x']."px ; z-index:0; opacity:1; ' src=".base_url($img_mapas[0]['imagen'])." alt='".$img_mapas[0]['titulo']."'>";
                                }else {
                                    echo "<img class='mapas' id='img_".$img['id']."' data-id='".$i."' data-x='".$img['desviacion_x']."' data-y='".$img['desviacion_y']."' src=".base_url($img['imagen'])." alt='".$img['titulo']."' style=' top:".$img['desviacion_y']."px ; left:".$img['desviacion_x']."px ; z-index:".$i."'>";
                                }
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>

            <!-- FIN MAPA CALLES -->

            <!-- INICIO MAPA PUNTOS DE INTERES -->

            <div id="puntosInteres" class="row">
                <div id="tabla" class="col-sm dragscroll">
                    <div id="hotspotImg" class="responsive-hotspot-wrap">

                        <img src="<?php echo base_url($ListaMapas[0]["imagen"])?>" id="slide" data-id-mapa="<?php echo $ListaMapas[0]["id"]?>" class="img-responsive span4 proj-div" />

                        <?php 
                            foreach ($ListaHotspots as $hotspot) {
                                echo "<div id='" .$hotspot["id"]. "' class='hot-spot' data-posx='" .$hotspot["punto_x"]. "' data-posy='" .$hotspot["punto_y"]. "' style='top: " .$hotspot["punto_y"]. "px; left: " .$hotspot["punto_x"]. "px; display: block;'>
                                    <div class='circle'></div>
                                    <div class='tooltip' style='margin-left: -135px; display: none;'>
                                        <div class='img-row'><img src='" .base_url("/assets/img/img_hotspots/".$hotspot["imagen"]). "' width='100'></div>
                                        <div class='text-row'>
                                            <h4>" .$hotspot["titulo"]. "</h4>
                                            <p>" .$hotspot["descripcion"]. "</p>
                                        </div>
                                    </div>
                                </div>";
                            }

                        ?>

                    </div>
                </div>
            </div>

            <!-- FIN MAPA PUNTOS DE INTERES -->

        </div>
    </section>

    <!-- About Section -->
    <section class="bg-primary text-white mb-0" id="sobreNosotros">
        <div class="container">
            <h2 class="text-center text-uppercase text-white">Sobre nosotros</h2>
            <hr class="star-dark mb-5">
            <div class="row">
                <div class="col-lg-4 ml-auto">
                    <p class="lead">Somos tres estudiantes del grado superior de desarrollo de aplicaciones web del IES Celia Viñas y este es nuestro proyecto final para el segundo año del curso.</p>
                </div>
                <div class="col-lg-4 mr-auto">
                    <p class="lead">El proyecto consiste en un programa que nos permite superponer mapas de distintas épocas e insertar el nombre y la posición de las calles para facilitar el trabajo de encontrar una calle actual en el pasado o viceversa. También nos permite insertar puntos de interés para marcar sucesos o edificios importantes.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contacto">
        <div class="container">
            <h2 class="text-center text-uppercase text-secondary mb-0">Vacio</h2>
            <hr class="star-dark mb-5">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <p>Texto de ejemplo</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer text-center">
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <h4 class="text-uppercase mb-4">Contacto</h4>
                    <p class="lead mb-0">Pedro López:
                        <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                            <i class="fab fa-fw fa-github"></i>
                        </a>
                    </p>
                    <p class="lead mb-0">Eduard Adrian Voicu:
                        <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                            <i class="fab fa-fw fa-github"></i>
                        </a>
                    </p>
                    <p class="lead mb-0">Antonio Jiménez:
                        <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                            <i class="fab fa-fw fa-github"></i>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </footer>


    <!-- Modal puntos -->
    <div class="modal fade" id="modal_puntos" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Historial de calles en este punto:</h5>
                    <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul id='lista_puntos'>
                    </ul>
                    <div class="form-group d-none" id="archivo">
                        <label for="nombre_archivo">Nombre del informe</label>
                        <input type='text' class='form-control' id='nombre_archivo' name='nombre_archivo' placeholder='Introduce el nombre del archivo' required />
                    </div>

                    <div class="form-group">
                        <textarea id='observaciones' class='form-control d-none' aria-label='Observaciones' name='observaciones' rows='4' cols='80' placeholder='Observaciones'></textarea>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- fin container fluid -->


    <div class="copyright py-4 text-center text-white">
        <div class="container">
            <small>Copyright &copy; Mapas Developers 2019</small>
        </div>
    </div>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-to-top d-lg-none position-fixed ">
        <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo base_url()?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="<?php echo base_url()?>/assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?php echo base_url()?>/assets/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="<?php echo base_url()?>/assets/js/jqBootstrapValidation.js"></script>
    <script src="<?php echo base_url()?>/assets/js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="<?php echo base_url()?>/assets/js/freelancer.min.js"></script>

</body>

</html>

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
    <script type="text/javascript" src="<?php echo base_url()?>assets/js/dragscroll.js"></script>

    <style>
        .copyright {
            background-color: #800000 !important;
        }

        .navbar-toggler {
            background-color: #cc0000 !important;
        }

        .nav-link.active {
            color: #cc0000 !important;
        }

        .footer {
            background-color: #d33529 !important;
        }

        .masthead {
            padding: 100px !important;
        }

        .navbar {
            background-color: #d33529 !important;
        }

        .active {
            background-color: #800000 !important;
        }

        a.nav-link:hover {
            color: #cc0000 !important;
        }

        #mapa {
            background-image: url(<?php echo base_url()?>assets/img/papyrus.jpg);
            background-repeat: no-repeat;
            background-size: cover;
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
            background-image: url(<?php echo base_url()?>/assets/img/papyrus.jpg);
            background-repeat: no-repeat;
            background-size: cover;
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
            overflow: scroll;
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

    </style>

    <script>
        $(document).ready(function() {
            zoom = 1;
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
                $("#puntosCalles").css("display", "block");
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
                            $("#slide").after("<div id='" + value.id + "' class='hot-spot' data-posx='" + value.punto_x + "' data-posy='" + value.punto_y + "' style='top: " + value.punto_y + "px; left: " + value.punto_x + "px; display: block;'><div class='circle'></div><div class='tooltip' style='margin-left: -135px; display: none;'><div class='img-row'><img src='" + "<?php echo base_url("/assets/img/img_hotspots/") ?>" +  value.imagen + "' width='100'></div><div class='text-row'><h4>" + value.titulo + "</h4><p>" + value.descripcion + "</p></div></div></div>");
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

        });

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
                <div id="tabla2" class="col-sm">
                    <div id="hotspotImg-1" class="responsive-hotspot-wrap dragscroll">

                        <img src="<?php echo base_url($ListaMapas[0]["imagen"])?>" id="slide-1" data-id-mapa="<?php echo $ListaMapas[0]["id"]?>" class="img-responsive span4 proj-div" />

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

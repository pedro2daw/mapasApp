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
    <link href="<?php echo base_url()?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="<?php echo base_url()?>/assets/vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url()?>/assets/css/freelancer.min.css" rel="stylesheet">

    <style>
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

        #hotspotImg-1 {
            overflow: scroll;
            width: 100%;
            height: 450px !important;
        }

    </style>
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
            <img class="img-fluid mb-5 d-block mx-auto" src="<?php echo base_url()?>/assets/img/profile.png" alt="">
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
                <div id="tabla" class="col-md-3">
                    <div class="table-responsive">
                        <div id="tabla_calles_wrapper" class="dataTables_wrapper no-footer">
                            <div id="tabla_calles_filter" class="dataTables_filter"><label><input type="search" class="form-control" placeholder="Buscar Calle" aria-controls="tabla_calles"></label></div>
                            <div class="dataTables_scroll">
                                <div class="dataTables_scrollHead" style="overflow: hidden; position: relative; border: 0px none; width: 100%;">
                                    <div class="dataTables_scrollHeadInner" style="box-sizing: content-box; width: 307.25px; padding-right: 17px;">
                                        <table class="table table-hover dataTable no-footer" role="grid" style="margin-left: 0px; width: 307.25px;">
                                            <thead>
                                                <tr role="row">
                                                    <th class="d-none sorting_asc" scope="col" tabindex="0" aria-controls="tabla_calles" rowspan="1" colspan="1" style="width: 0px;" aria-sort="ascending" aria-label="Tipo: activate to sort column descending">Tipo</th>
                                                    <th class="d-none sorting" scope="col" tabindex="0" aria-controls="tabla_calles" rowspan="1" colspan="1" style="width: 0px;" aria-label="Nombre: activate to sort column ascending">Nombre</th>
                                                    <th class="d-none sorting" scope="col" tabindex="0" aria-controls="tabla_calles" rowspan="1" colspan="1" style="width: 0px;" aria-label="Punto: activate to sort column ascending">Punto</th>
                                                    <th scope="col" class="sorting" tabindex="0" aria-controls="tabla_calles" rowspan="1" colspan="1" style="width: 271.25px;" aria-label="Calle: activate to sort column ascending">Calle</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                                <div class="dataTables_scrollBody" style="position: relative; overflow: auto; max-height: 210px; width: 100%;">
                                    <table class="table table-hover dataTable no-footer" id="tabla_calles" role="grid" aria-describedby="tabla_calles_info" style="width: 100%;">
                                        <thead>
                                            <tr role="row" style="height: 0px;">
                                                <th class="d-none sorting" scope="col" aria-controls="tabla_calles" rowspan="1" colspan="1" style="width: 0px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;">
                                                    <div class="dataTables_sizing" style="height: 0px; overflow: hidden;">Tipo</div>
                                                </th>
                                                <th class="d-none sorting" scope="col" aria-controls="tabla_calles" rowspan="1" colspan="1" style="width: 0px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;">
                                                    <div class="dataTables_sizing" style="height: 0px; overflow: hidden;">Nombre</div>
                                                </th>
                                                <th class="d-none sorting" scope="col" aria-controls="tabla_calles" rowspan="1" colspan="1" style="width: 0px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;">
                                                    <div class="dataTables_sizing" style="height: 0px; overflow: hidden;">Punto</div>
                                                </th>
                                                <th scope="col" class="sorting" aria-controls="tabla_calles" rowspan="1" colspan="1" style="width: 271.25px; padding-top: 0px; padding-bottom: 0px; border-top-width: 0px; border-bottom-width: 0px; height: 0px;">
                                                    <div class="dataTables_sizing" style="height: 0px; overflow: hidden;">Calle</div>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr id="calle_1" role="row" class="odd">
                                                <td id="tipo_1" class="d-none d-none sorting_1">Avenida</td>
                                                <td id="nombre_1" class="d-none d-none">Test</td>
                                                <td id="punto_1" class="d-none d-none" data-x="102" data-y="136"></td>
                                                <td class="calles" data-id="1">Avenida Test</td>
                                            </tr>
                                            <tr id="calle_2" role="row" class="even">
                                                <td id="tipo_2" class="d-none d-none sorting_1">Avenida</td>
                                                <td id="nombre_2" class="d-none d-none">Otro</td>
                                                <td id="punto_2" class="d-none d-none" data-x="102" data-y="136"></td>
                                                <td class="calles" data-id="2">Avenida Otro</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="dataTables_info" id="tabla_calles_info" role="status" aria-live="polite"></div>
                        </div>
                    </div> <!-- fin table-responsive -->

                    <!-- <div id='ranges'>
            
            </div> -->

                </div> <!-- fin col md-3 -->

                <div class="col-md-9 dragscroll" id="prueba">
                    <div id="hotspotImg-1">
                        <img class="mapas" id="img_callejero" data-id="0" data-x="" data-y="" style=" top:px ; left:px ; z-index:999 ; opacity:0.5; " src="<?php echo base_url()?>/assets/img/grande.png" alt="grande"><img class="mapas" id="img_10" data-id="1" data-x="0" data-y="543" src="<?php echo base_url()?>/assets/img/mediano.png" alt="mediano" style=" top:543px ; left:0px ; z-index:1"><img class="mapas" id="img_11" data-id="2" data-x="0" data-y="982" src="<?php echo base_url()?>/assets/img/pequenio.png" alt="pequeño" style=" top:982px ; left:0px ; z-index:2"> </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="bg-primary text-white mb-0" id="sobreNosotros">
        <div class="container">
            <h2 class="text-center text-uppercase text-white">Sobre nosotros</h2>
            <hr class="star-dark mb-5">
            <div class="row">
                <div class="col-lg-4 ml-auto">
                    <p class="lead">Freelancer is a free bootstrap theme created by Start Bootstrap. The download includes the complete source files including HTML, CSS, and JavaScript as well as optional LESS stylesheets for easy customization.</p>
                </div>
                <div class="col-lg-4 mr-auto">
                    <p class="lead">Whether you're a student looking to showcase your work, a professional looking to attract clients, or a graphic artist looking to share your projects, this template is the perfect starting point!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contacto">
        <div class="container">
            <h2 class="text-center text-uppercase text-secondary mb-0">Contactanos</h2>
            <hr class="star-dark mb-5">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                    <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                    <form name="sentMessage" id="contactForm" novalidate="novalidate">
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Nombre</label>
                                <input class="form-control" id="name" type="text" placeholder="Nombre" required="required" data-validation-required-message="Please enter your name.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Email</label>
                                <input class="form-control" id="email" type="email" placeholder="Email" required="required" data-validation-required-message="Please enter your email address.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Teléfono</label>
                                <input class="form-control" id="phone" type="tel" placeholder="Teléfono" required="required" data-validation-required-message="Please enter your phone number.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                                <label>Mensaje</label>
                                <textarea class="form-control" id="message" rows="5" placeholder="Mensaje" required="required" data-validation-required-message="Please enter a message."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <br>
                        <div id="success"></div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-xl" id="sendMessageButton">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">Location</h4>
                    <p class="lead mb-0">2215 John Daniel Drive
                        <br>Clark, MO 65243</p>
                </div>
                <div class="col-md-4 mb-5 mb-lg-0">
                    <h4 class="text-uppercase mb-4">Around the Web</h4>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                                <i class="fab fa-fw fa-facebook-f"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                                <i class="fab fa-fw fa-google-plus-g"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                                <i class="fab fa-fw fa-twitter"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                                <i class="fab fa-fw fa-linkedin-in"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn btn-outline-light btn-social text-center rounded-circle" href="#">
                                <i class="fab fa-fw fa-dribbble"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4 class="text-uppercase mb-4">About Freelancer</h4>
                    <p class="lead mb-0">Freelance is a free to use, open source Bootstrap theme created by
                        <a href="http://startbootstrap.com">Start Bootstrap</a>.</p>
                </div>
            </div>
        </div>
    </footer>

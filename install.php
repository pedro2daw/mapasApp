<?php
/*
  Este archivo es parte de la aplicación web Celia360.

  Celia 360 es software libre: usted puede redistribuirlo y/o modificarlo
  bajo los términos de la GNU General Public License tal y como está publicada por
  la Free Software Foundation en su versión 3.

  Celia 360 se distribuye con el propósito de resultar útil,
  pero SIN NINGUNA GARANTÍA de ningún tipo.
  Véase la GNU General Public License para más detalles.

  Puede obtener una copia de la licencia en <http://www.gnu.org/licenses/>.
 */
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Install CMS Celia Tour</title>
        <!-- Fuente externa -->
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <!-- Estilos del formulario de instalación -->
        <style>
            .container{
                margin: auto;
                max-width: 1300px;
            }
            .bg-secondary {
                background-color: #4E5D6C;
            }
            .col-md-6{
                width: 50%;
            }
            .col-md-12{
                width: 100%;
            }
            .mx-auto{
                margin: auto!important;
            }
            h1, h4, p, label, span{
                color: white;
                font-family:"Lato";
            }
            input, label{
                display: block;
            }
            .text-center{
                text-align: center;
            }
            label{
                margin-bottom: 10px;
                font-size: 1.25rem;
                margin-top: 10px;
            }
            .form-group{
                margin-bottom: 1rem;
                margin: auto;
                width: 90%;
            }
            .btn-primary {
                color: #fff;
                background-color: #DF691A;
                border: none;
                width: auto;
                padding: 0.375rem 0.75rem;
                font-size: 1rem;
            }
            .mt-3{
                margin-top: 15px; 
            }
            .pb-3{
                padding-bottom: 15px; 
            }
            body{
                background-color: #2B3E50;
            }
            .text-justify{
                text-align: justify;
            }
            p{
                margin: 20px;
            }
            input {
                width: 100%;
                display: block;
                margin: auto;
                padding: 0.375rem;
            }
            h1{
                font-size: 2.5rem;
            }
            h4{
                font-size: 1.5rem;
            }

            .text-white {
                color: white;
            }

           
            a:visited {
                color: white;
            }

            #success {
                border: round;
                display: block;
                margin: 0 auto;
                background-color: yellowgreen;
                width: 50%;
                padding: 10%;
            }
        </style>         
    </head>
    <body>

        <?php
        
        ini_set("display_errors", 0);
       
      if (isset($_REQUEST["host"])) {
            // Procesar el formulario
            $host = $_REQUEST["host"];
            $userdb = $_REQUEST["nameuse"];
            $passdb = $_REQUEST["passbd"];
            $nombredb = $_REQUEST["namebd"];
            $baseurl = $_REQUEST["base"];
            $username = $_REQUEST["username"];
            $pass = $_REQUEST["pass"];
            $pass2 = $_REQUEST["pass2"];
            $emailadmin = $_REQUEST["emailadmin"];
            //Comprobamos que las dos contraseñas sean iguales
            if (strcmp($pass, $pass2) !== 0) {
            echo 'Las dos contraseñas no son iguales, son consideradas mayúsculas y minúsculas';
            }else{

            // Creamos la estructura de la BD
			$db = new mysqli($host, $userdb, $passdb, $nombredb);
            
            $pass = password_hash("1", PASSWORD_DEFAULT);
            $db->query("CREATE TABLE `calles` (
                                        `id` int(10) UNSIGNED NOT NULL,
                                        `nombre` varchar(100) DEFAULT NULL,
                                        `tipo` varchar(25) NOT NULL,
                                        `ano_inicio` smallint(6) NOT NULL,
                                        `ano_fin` smallint(6) NOT NULL,
                                        `id_mapa` int(10) UNSIGNED DEFAULT NULL
                                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
            $db->query("CREATE TABLE `ci_sessions` (
                                            `id` varchar(128) NOT NULL,
                                            `ip_address` varchar(45) NOT NULL,
                                            `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
                                            `data` blob NOT NULL
                                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
    
            $db->query("CREATE TABLE `hotspots` (
                                        `id` int(10) UNSIGNED NOT NULL,
                                        `imagen` varchar(250) NOT NULL,
                                        `titulo` varchar(50) NOT NULL,
                                        `descripcion` varchar(600) NOT NULL,
                                        `punto_x` int(10) UNSIGNED NOT NULL,
                                        `punto_y` int(10) UNSIGNED NOT NULL,
                                        `id_mapa` int(10) UNSIGNED DEFAULT NULL
                                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
                                                    $db->query("ALTER TABLE `celda_pd`
                                                                ADD PRIMARY KEY (`id_celda`);");

            $db->query("CREATE TABLE `mapas` (
                                        `id` int(10) UNSIGNED NOT NULL,
                                        `titulo` varchar(150) NOT NULL,
                                        `descripcion` varchar(250) NOT NULL,
                                        `ciudad` varchar(50) NOT NULL,
                                        `fecha` smallint(6) NOT NULL,
                                        `imagen` varchar(250) NOT NULL,
                                        `nivel` smallint(6) NOT NULL,
                                        `ancho` int(11) NOT NULL,
                                        `altura` int(11) NOT NULL,
                                        `fecha_de_subida` datetime NOT NULL,
                                        `id_paquete` int(10) UNSIGNED NOT NULL,
                                        `desviacion_x` decimal(10,0) DEFAULT NULL,
                                        `desviacion_y` decimal(10,0) DEFAULT NULL,
                                        `principal` tinyint(1) NOT NULL DEFAULT '0'
                                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

            $db->query("CREATE TABLE `mapas_calles` (
                                            `id_map` int(10) UNSIGNED DEFAULT NULL,
                                            `id_lamina` int(10) UNSIGNED DEFAULT NULL,
                                            `id_calle` int(10) UNSIGNED DEFAULT NULL
                                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
                                                        $db->query("ALTER TABLE `escenas`ADD PRIMARY KEY (`id_escena`);");

			$db->query("CREATE TABLE `puntos` (
                                        `id` bigint(20) UNSIGNED NOT NULL,
                                        `punto_x` int(10) UNSIGNED NOT NULL,
                                        `punto_y` int(10) UNSIGNED NOT NULL,
                                        `id_calle` int(10) UNSIGNED DEFAULT NULL
                                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
            
            $db->query("CREATE TABLE `usuarios` (
                                        `id` smallint(5) UNSIGNED NOT NULL,
                                        `username` varchar(30) NOT NULL,
                                        `passwd` varchar(255) NOT NULL,
                                        `nivel` smallint(5) UNSIGNED DEFAULT '1'
                                        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
        
            $db->query("ALTER TABLE `calles` ADD PRIMARY KEY (`id`);");

			$db->query("ALTER TABLE `ci_sessions` ADD KEY `ci_sessions_timestamp` (`timestamp`);");
            

            $db->query("ALTER TABLE `mapas` ADD PRIMARY KEY (`id`)");

			//$db->query("ALTER TABLE `paquetes`ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nombre` (`nombre`);");

            $db->query("ALTER TABLE `puntos` ADD PRIMARY KEY (`id`);");

            $db->query("ALTER TABLE `usuarios`ADD PRIMARY KEY (`id`);");

            $db->query("ALTER TABLE `calles` MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;");

            $db->query("ALTER TABLE `mapas` MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;");

            $db->query("ALTER TABLE `puntos` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;");

			$db->query("ALTER TABLE `usuarios` MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11; COMMIT;");
            
            $db->query("DELETE FROM `usuarios` WHERE id = 1;");
            $db->query("INSERT INTO `usuarios` (`id`, `username`, `passwd`, `nivel`) VALUES (1, 'admin', '$pass', 2);");

            // Creamos el archivo de configuración
            $nombre_archivo = ".env.development";

            if (file_exists($nombre_archivo)) {
                $mensaje = "El Archivo " . $nombre_archivo . " se ha modificado.";
            } else {
                $mensaje = "El Archivo " . $nombre_archivo . " se ha creado.";
            }

            echo $mensaje;

            if ($archivo = fopen($nombre_archivo, "w")) {
                fwrite($archivo, "DB_HOSTNAME='" . $host . "'\n 
        								DB_USERNAME='" . $userdb . "'\n 
        								DB_PASSWORD='" . $passdb . "'\n 
        								DB_DATABASE='" . $nombredb . "'\n 
        								BASE_URL='" . $baseurl . "'\n 
        								SESSION_DIR='/tmp'");
            } else {
                echo "El programa de instalación no ha podido crear el archivo de configuración. Debe crearlo usted manualmente en el directorio raíz de su aplicación.<br>"
                . "El archivo debe ser de texto plano y tener el nombre .env.develpment. Su contenido debe ser el siguiente (cópielo y péguelo para evitar errores):<br><br>"
                . "DB_HOSTNAME='" . $host . "'<br> 
        								DB_USERNAME='" . $userdb . "'<br> 
        								DB_PASSWORD='" . $passdb . "'<br>
        								DB_DATABASE='" . $nombredb . "<br> 
        								BASE_URL='" . $baseurl . "'<br>
        								SESSION_DIR='/tmp'<br><br><br>
                Cuando haya creado el archivo puede visitar <a href='$baseurl/usuario'>$baseurl/usuario</a> para comenzar a administrar su visita virtual. Pida ayuda a su administrador de sistemas si no sabe cómo hacer todo esto.";
            }

            fclose($archivo);

			//creación de directorios 
			
			if (!file_exists('assets/img')) {
                mkdir('assets/img');
            }

            if (!file_exists('assets/img/icono')) {
                mkdir('assets/img/icono');
            }

            if (!file_exists('assets/img/mapas')) {
                mkdir('assets/img/mapas');
            }

            
			/*
            echo "<br><br><span class='text-white'>La instalación ha finalizado. <br>
            <strong>IMPORTANTE: elimine ahora el archivo de instalación (install.php) del servidor para evitar posibles ataques a su base de datos.</strong>.<br>"
            . "Visite <a href='$baseurl/Login'> el formulario de Login (click) </a> para comenzar a administrar la aplicación.</span><br>";
            */

            echo "<div id='success'><span class='text-white'>
                        ¡Enhorabuena! <br> </br>
                        La instalación ha finalizado. <br>
                        Visite <a href='$baseurl/Login'> el formulario de Login (click)</a> para comenzar a administrar la aplicación.
                </span></div>";
            
            
            // unlink("install.php");
         }
     }
         // fin del if
        else {
            // Mostramos formulario
            ?>

<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto bg-secondary">
            <form action="install.php">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-center">Instalaci&oacute;n de MapasApp</h1>
                        <p class="text-justify">
                        Este programa de instalación le ayudará a desplegar la aplicación CeliaTour/Celia360 en su servidor. Si no sabe como proceder, le recomendamos que se ponga en contacto con su administrador de sistemas.
                        </p>
                        <h4 class="text-center">Configuración del host</h4>
                        <div class="form-group">
                            <label for="host">Nombre del host</label>
                            <input type='text' name='host' id="host" value='localhost' value='localhost' required >
                        </div>
                        <div class="form-group">
                            <label for="namebd">Nombre de la base de datos</label>
                            <input type='text' id="namebd" name='namebd' value='mapas' required>
                        </div>
                        <div class="form-group">
                            <label for="nameuse">Usuario de la base de datos</label>
                            <input type='text' name='nameuse' id="nameuse" value='root' required>
                        </div>
                        <div class="form-group">
                            <label for="passbd">Contraseña de la base de datos</label>
                            <input type='password' name='passbd' id="passbd">            
                        </div>
                        <div class="form-group">
                            <label for="base">Base URL del sitio</label>
                            <input type='text' name='base' id="base" placeholder="http://ejemplo.com" value='http://[::1]/mapasApp' required>            
                        </div>
                    </div>
                </div>
                <!-- 
                <div class="row">
                    <div class="col-md-12">
                        <h4 class="text-center">Configuración del usuario administrador</h4>
                        <div class="form-group">
                            <label for="username">Nombre de usuario administrador</label>
                            <input type='text' name='username' id="username" required>
                        </div>
                        <div class="form-group">
                            <label for="pass">Contrase&ntilde;a</label>
                            <input type='password' id="pass" name='pass' required>
                        </div>
                        <div class="form-group">
                            <label for="pass2">Repita Contrase&ntilde;a</label>
                            <input type='password' id="pass2" name='pass2' required>  
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type='text' name='emailadmin' id="email" required>
                        <div>
                    </div>
                </div>
                -->
                <div class="row mt-3 pb-3">
                    <div class="col-md-12">
                        <input type='submit' value='Aceptar' class="btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>

</div><!-- Final de container -->

            <?php
        }
        ?>

    </body>
</html>

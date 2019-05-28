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
            h1, h4, p, label{
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

			$db->query("ALTER TABLE `paquetes`ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `nombre` (`nombre`);");

            $db->query("ALTER TABLE `puntos` ADD PRIMARY KEY (`id`);");

            $db->query("ALTER TABLE `usuarios`ADD PRIMARY KEY (`id`);");

            $db->query("ALTER TABLE `calles` MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;");

            $db->query("ALTER TABLE `mapas` MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;");

            $db->query("ALTER TABLE `puntos` MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;");

			$db->query("ALTER TABLE `usuarios` MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;");
            

            $db->query("CREATE TABLE `pisos` (
				`piso` int(1) NOT NULL,
				`url_img` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
				`punto_inicial` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
				`titulo_piso` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
				`escena_inicial` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
				`top_zona` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
				`left_zona` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL
			  ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;");
            $db->query("ALTER TABLE `pisos`
                        ADD PRIMARY KEY (`piso`),
                        ADD KEY `piso` (`piso`);");

            $db->query("CREATE TABLE `puntos_mapa` (
                            `id_punto_mapa` int(11) NOT NULL,
                            `nombre` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
                            `left_mapa` double NOT NULL,
                            `top_mapa` double NOT NULL,
                            `id_escena` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
                            `piso` int(1) NOT NULL
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;");
            $db->query("ALTER TABLE `puntos_mapa`
                        ADD PRIMARY KEY (`id_punto_mapa`),
						ADD KEY `piso` (`piso`);");

			$db->query("ALTER TABLE `puntos_mapa` MODIFY COLUMN `id_punto_mapa` INT(11) AUTO_INCREMENT;");
           

            $db->query("CREATE TABLE `usuarios` (
                            `id_usuario` int(11) NOT NULL,
                            `nombre_usuario` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
                            `nombre` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
                            `apellido` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
                            `password` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
                            `email` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
                            `tipo_usuario` int(255) NOT NULL
                            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;");
            $db->query("ALTER TABLE `usuarios`
						ADD PRIMARY KEY (`id_usuario`);");

			$db->query("ALTER TABLE `usuarios` MODIFY COLUMN `id_usuario` INT(11) AUTO_INCREMENT;");
            
            // Creamos el archivo de configuración
            $nombre_archivo = ".env.development";

            if (file_exists($nombre_archivo)) {
                $mensaje = "El Archivo " . $nombre_archivo . " se ha modificado.";
            } else {
                $mensaje = "El Archivo " . $nombre_archivo . " se ha creado.";
            }

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
			
			if (!file_exists('assets/audio')) {
                mkdir('assets/audio');
            }

            if (!file_exists('assets/biblio')) {
                mkdir('assets/biblio');
            }

            if (!file_exists('assets/imagenes')) {
                mkdir('assets/imagenes');
            }

            if (!file_exists('assets/imagenes/biblioteca')) {
                mkdir('assets/imagenes/destacados');
            }

            if (!file_exists('assets/imagenes/destacados')) {
                mkdir('assets/imagenes/destacados');
            }

            if (!file_exists('assets/imagenes/escenas')) {
                mkdir('assets/imagenes/escenas');
            }

            if (!file_exists('assets/imagenes/generales')) {
                mkdir('assets/imagenes/generales');
            }

            if (!file_exists('assets/imagenes/iconos')) {
                mkdir('assets/imagenes/iconos');
            }

            if (!file_exists('assets/imagenes/imagenes-hotspots')) {
                mkdir('assets/imagenes/imagenes-hotspots');
            }

            if (!file_exists('assets/imagenes/portada')) {
                mkdir('assets/imagenes/portada');
            }

            if (!file_exists('assets/imagenes/mapa')) {
                mkdir('assets/imagenes/mapa');
            }

            if (!file_exists('assets/imagenes/previews')) {
                mkdir('assets/imagenes/previews');
            }

            if (!file_exists('assets/imagenes/previews-guiada')) {
                mkdir('assets/imagenes/previews-guiada');
            }

            if (!file_exists('assets/imagenes/svg')) {
                mkdir('assets/imagenes/svg');
			}
			
			if (!file_exists('assets/imagenes/panoramasSecundarios')) {
                mkdir('assets/imagenes/panoramasSecundarios');
            }

            if (!file_exists('assets/bibliocss')) {
                mkdir('assets/bibliocss');
            }

            if (!file_exists('assets/css')) {
                mkdir('assets/css');
            }

            if (!file_exists('assets/documentos-panel')) {
                mkdir('assets/documentos-panel');
            }

            if (!file_exists('assets/extras')) {
                mkdir('assets/extras');
            }

            if (!file_exists('assets/fonts')) {
                mkdir('assets/fonts');
            }

            if (!file_exists('assets/js')) {
                mkdir('assets/js');
            }

            if (!file_exists('assets/lib')) {
                mkdir('assets/lib');
            }

            if (!file_exists('assets/php')) {
                mkdir('assets/php');
			}
			
            echo "<br><br><span class='text-white'>La instalación ha finalizado. <strong>IMPORTANTE: elimine ahora el archivo de instalación (install.php) del servidor para evitar posibles ataques a su base de datos.</strong>.<br>"
            . "Visite <a href='$baseurl/usuario'>$baseurl/usuario</a> para comenzar a introducir los datos de su visita virtual.</span><br>";
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
                        <h1 class="text-center">Instalaci&oacute;n de Celia 360</h1>
                        <p class="text-justify">
                        Este programa de instalación le ayudará a desplegar la aplicación CeliaTour/Celia360 en su servidor. Si no sabe como proceder, le recomendamos que se ponga en contacto con su administrador de sistemas.
                        </p>
                        <h4 class="text-center">Configuración del host</h4>
                        <div class="form-group">
                            <label for="host">Nombre del host</label>
                            <input type='text' name='host' id="host" required>
                        </div>
                        <div class="form-group">
                            <label for="namebd">Nombre de la base de datos</label>
                            <input type='text' id="namebd" name='namebd' required>
                        </div>
                        <div class="form-group">
                            <label for="nameuse">Usuario de la base de datos</label>
                            <input type='text' name='nameuse' id="nameuse" required>
                        </div>
                        <div class="form-group">
                            <label for="passbd">Contraseña de la base de datos</label>
                            <input type='password' name='passbd' id="passbd">            
                        </div>
                        <div class="form-group">
                            <label for="base">Base URL del sitio</label>
                            <input type='text' name='base' id="base" placeholder="http://ejemplo.com" required>            
                        </div>
                    </div>
                </div>
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

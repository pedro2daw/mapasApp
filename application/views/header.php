<!DOCTYPE html>
<html lang='es'>

<head>
    <title>Superposición de Mapas</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <!-- ESTILOS -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/assets/style/estilo.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/assets/style/estiloHotspots.css"/> 
    <!-- SCRIPT JS -->
    <script src=<?php echo base_url("assets/js/Mapas.js"); ?>></script>
    <script src=<?php echo base_url("assets/js/demo.js"); ?>></script>
    <script src=<?php echo base_url("assets/js/jquery.hotspot.js"); ?>></script>
    <!-- LOS ICONOS FONTAWESOME -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    
    <!-- jQuery Mobile  
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script type="text/javascript" src="https://cdn.rawgit.com/asvd/dragscroll/master/dragscroll.js"></script>
    <!--<script>
        x_coords = [];
        y_coords = [];
    $(document).ready(function() {
        $('#slide').dblclick(function(e) {
        var offset = $(this).offset();
        x_coords.push(parseInt(e.pageX - offset.left));
        y_coords.push(parseInt(e.pageY - offset.top));
            var x_def = parseInt(e.pageX - offset.left);
            var y_def = parseInt(e.pageY - offset.top);
                var x_temp = parseInt((e.pageX - offset.left)-5);
                var y_temp = (parseInt(e.pageY - offset.top)-5);
        $("#coords").append("<li class='coords'> X : " + x_def + " / Y : " + y_def + "</li>");
            $("#slide").after("<div class='hot-spot' x='"+x_temp+"'y='"+y_temp+"'style='top:"+y_temp+"px;left:"+x_temp+"px; display:block;'></div>");
        });
        $("#show").click(function() {
                alert("Las coordenadas del eje x son: " + x_coords);
                alert("Las coordenadas del eje y son: " + y_coords);
        });
        $("#delCoord").click(function() {
                $("#coords li:last-child").remove();
                index_x = x_coords.length - 1;
                index_y = y_coords.length - 1;
                x_coords.splice(index_x, 1);
                y_coords.splice(index_y, 1);
                $(".hot-spot:first").remove();
        });
    });
    </script>
    <style>
        #prueba {
            overflow: auto;
            height: 550px;
            cursor: crosshair;
        }
        #hotspotImg {
            background-color: #ededed;
            background-size: cover;
            background-position: center center;
            position: relative;
        }
        #hotspotImg .hot-spot {
            position: absolute;
            width: 10px;
            height: 10px;
            text-align: center;
            background-color: blue;
            border-radius: 100%;
         }
    </style>-->
    <style>
        #hotspotImg {
            overflow: auto;
            width: 1000px;
            height: 550px;
            cursor: crosshair;
        }
    </style>
</head>

<body>
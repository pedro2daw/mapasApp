<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset="utf-8" />
        <title>Superposición de Mapas</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
        <!-- <link rel="stylesheet" type="text/css" href="< ##################  ?php echo base_url()?>/assets/style/estilo.css" /> -->
        <!-- Required meta tags -->
        <!-- AJAX -->
        <script
			  src="https://code.jquery.com/jquery-3.3.1.js"
			  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
			  crossorigin="anonymous"></script>
        <!-- SCRIPT JS -->
        <script src=<?php echo base_url("assets/js/Mapas.js"); ?>></script>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <script type="text/javascript" src="https://cdn.rawgit.com/asvd/dragscroll/master/dragscroll.js"></script>
        <script>
        
        x_coords = [];
        y_coords = [];
       
    $(document).ready(function() {
    $('#map').dblclick(function(e) {
        var offset = $(this).offset();
        x_coords.push(parseInt(e.pageX - offset.left));
        y_coords.push(parseInt(e.pageY - offset.top));
        var x_temp = e.pageX - offset.left;
        var y_temp = e.pageY - offset.top;
        $("#coords").append("<li class='coords'> X : " + x_temp + " / Y : " + y_temp + "</li>");
    
    });
    $("#map").mousedown(function(){
            $("div").css("cursor","grabbing");
        });

        $("#map").mouseup(function(){
            $("div").css("cursor","crosshair");
        });

        $("#show").click(function(){
        alert("Las coordenadas del eje x son: " + x_coords);
        alert("Las coordenadas del eje y son: " + y_coords);
    });

    $("#delCoord").click(function(){
        $("#coords li:last-child").remove();
        index_x = x_coords.length-1;
        index_y = y_coords.length-1;
        alert(index_x);
        x_coords.splice(index_x,1);
        y_coords.splice(index_y,1);
    });

    });
        
    </script>
<style>
    #dialog{
        margin: 0 auto;
        overflow: auto;
        /*width: 1000px;*/
        height: 550px;
        cursor: crosshair;
        border: 1px solid black;
        float: right;
    }
</style>
</head>
<body>
    

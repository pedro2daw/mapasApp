$(document).ready(function () {
    var posX,
        posY;
    var id = 0;
    
    // Obtencion de las coordenadas del mapa
    $('.img-responsive').click(function (e) {
        x_coords = [];
        y_coords = [];
        ys = [];
        var offset = $(this).offset();
        x_coords.push(parseInt(e.pageX - offset.left));
        y_coords.push(parseInt(e.pageY - offset.top));
        $("#posX").val(x_coords[0]);
        $("#posY").val(y_coords[0]);
        posX = x_coords[0];
        posY = y_coords[0];
    });
    
    // El modal para insertar puntos sale con el doble click
    $('#slide').dblclick(function () {
        $('#myModal').modal('toggle');
    });
    
    // Eliminacion de los puntos de interes
    $('.circle').on("contextmenu", function(e){
        var id_hs = $(this).attr('id');
        $("#" + id_hs).remove();
        return false;
    });
    
    // Insercion de puntos de interes
    $("#insert").click(function () {
        var src = "1.jpg";
        var titulo = $("#titulo").val();
        var contenido = $("#descripcion").val();

        $("#slide").after("<div id='" + id + "' class='hot-spot' style='top:" + posY + "px;left:" + posX + "px'><div class='circle'></div><div class='tooltip'><div class='img-row'><img src='" + src + "' width='100'></div><div class='text-row'><h4> " + titulo + " </h4><p>" + contenido + "</p></div></div></div>");
        $(this).attr("data-dismiss", "modal");
        $('#hotspotImg').hotSpot({

            mainselector: '#hotspotImg',
            selector: '#' + id,
            imageselector: '.img-responsive',
            tooltipselector: '.tooltip',

            bindselector: 'hover'
        });
        id++;
    });
    
    // Reset de los campos del modal
    $('#exampleModalCenter').on('hidden.bs.modal', function (e) {
        $(this).find('form')[0].reset();
    });

});

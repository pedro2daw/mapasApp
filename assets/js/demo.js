$(document).ready(function () {
    var posX,
        posY;
    var id = 0;
    var src;

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
    $('div').on("contextmenu", ".hot-spot", function (e) {
        var id_hs = this.id;
        $("#" + id_hs).remove();
        return false;
    });
    
    // Obtencion del src de la imagen del punto
    $('#imagen').change(function (e) {
        src = "http://localhost/mapasApp/assets/img/mapas/" + e.target.files[0].name;
    });

    // Insercion de puntos de interes
    $("#insert").click(function () {
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

    // Guardado de los puntos insertados en un array
    puntos = [];

    // Reset de los campos del modal
    $('#exampleModalCenter').on('hidden.bs.modal', function (e) {
        $(this).find('form')[0].reset();
    });

});

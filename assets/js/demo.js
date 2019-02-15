$(document).ready(function () {
    var posX,
        posY;
    var id = 0;
    var src;
    var zoom = 1;

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
        if (confirm("¿Seguro que quieres borrar el punto?")) {
            $("#" + id_hs).remove();
        } else {}
        return false;
    });

    // Obtencion del src de la imagen del punto
    $('#imagen').change(function (e) {
        src = "http://localhost/mapasApp/assets/img/laminas/" + e.target.files[0].name;
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
    $('#myModal').on('hidden.bs.modal', function (e) {
        $(this).find('form')[0].reset();
    });

    // Rellena los campos del modal
    $(".btn-update").on("click", function () {
        var cont = new Array();
        var id = $(this).attr("data-id");
        $(".fila" + id).each(function () {
            cont.push($(this).text());
        });
        var usu = cont[1];
        var niv = cont[2];
        $("#usuarioMod").val(usu);
        $("#nivelMod").val(niv);
    });

    // Guardar puntos en la BD por ajax
    function realizaProceso(valorCaja1, valorCaja2) {
        var parametros = {
            "valorCaja1": valorCaja1,
            "valorCaja2": valorCaja2
        };
        $.ajax({
            data: parametros,
            url: 'ejemplo_ajax_proceso.php',
            type: 'post',
            beforeSend: function () {
                $("#resultado").html("Procesando, espere por favor...");
            },
            success: function (response) {
                $("#resultado").html(response);
            }
        });
    }
    
    // Aumentar tamaño del mapa manteniendo la posicion de los puntos
    $("#mas").on("click", function () {
        $("#slide").css("transform-origin", "top left");
        $("#slide").css("transform", "scale(" + (zoom + 0.1) + ")");
    });
    
    // Disminuir tamaño del mapa manteniendo la posicion de los puntos
    $("#menos").on("click", function () {
        $("#slide").css("transform-origin", "top left");
        $("#slide").css("transform", "scale(" + (zoom - 0.1) + ")");
    });

});

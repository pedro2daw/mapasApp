$(document).ready(function () {
    var posX,
        posY;
    var id = parseInt($(".hot-spot").last().attr("id")) + 1;
    var src;
    zoom = 1;
    var actWdth,
        id_mapa;

    // Obtencion de las coordenadas del mapa
    $('.img-responsive').click(function (e) {
        x_coords = [];
        y_coords = [];
        ys = [];
        var offset = $(this).offset();
        x_coords.push(parseInt(e.pageX - offset.left));
        y_coords.push(parseInt(e.pageY - offset.top));
        $("#posX").val(parseInt(x_coords[0] / zoom));
        $("#posY").val(parseInt(y_coords[0] / zoom));
        if (isNaN(id)) {
            id = 1;
        }
        $("#hsId").val(id);
        id_mapa = $("#slide").data("id-mapa");
        $("#mapId").val(id_mapa);
        posX = x_coords[0];
        posY = y_coords[0];
    });

    // El modal para insertar puntos sale con el doble click
    $('#slide').dblclick(function () {
        $('#myModal').modal('toggle');
    });

    // Obtencion del src de la imagen del punto (cuidado con URL absoluta)
    $('#imagen').change(function (e) {
        src = "http://localhost/mapasApp/assets/img/img_hotspots/" + e.target.files[0].name;
    });
    // Insercion de puntos de interes
    $("#insert").click(function () {
        var titulo = $("#titulo").val();
        var contenido = $("#descripcion").val();
        if (isNaN(id)) {
            id = 1;
        }

        $("#slide").after("<div id='" + id + "' class='hot-spot' data-posx='" + posX / zoom + "' data-posy='" + posY / zoom + "' style='top:" + posY + "px;left:" + posX + "px'><div class='circle'></div><div class='tooltip'><div class='img-row'><img id='insImg' src='" + src + "' width='100'></div><div class='text-row'><h4> " + titulo + " </h4><p>" + contenido + "</p></div></div></div>");
        $(this).attr("data-dismiss", "modal");

        $("#hiddImg").data("img", src);

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

    // Aumentar tamaño del mapa de los puntos de interes manteniendo la posicion de los puntos
    $("#slide").on("wheel", function (e) {
        var e0 = e.originalEvent,
            delta = e0.wheelDelta || -e0.detail;

        this.scrollTop += (delta < 0 ? 1 : -1) * 30;
        e.preventDefault();
        actWdth = $("#slide").width() * zoom;
        if (e.originalEvent.deltaY < 0) {
            if (actWdth < 4000) {
                zoom += 0.04;
            }
            $("#slide").css("transition", "transform 1s");
            $("#slide").css("transform-origin", "top left");
            $("#slide").css("transform", "scale(" + (zoom) + ")");
        } else {
            if (actWdth > 1100) {
                zoom -= 0.04;
            }
            $("#slide").css("transition", "transform 1s");
            $("#slide").css("transform-origin", "top left");
            $("#slide").css("transform", "scale(" + (zoom) + ")");
        }

        $(".hot-spot").each(function () {
            coordX = $(this).data("posx");
            coordY = $(this).data("posy");
            $(this).removeAttr("style");
            $(this).attr("style", "top: " + (coordY * zoom) + "px; left: " + (coordX * zoom) + "px; display: block;");
        });
    });

    //Aumentar el tamaña del mapa con las calles manteniendo los puntos
    $("#hotspotImg-1").on("wheel", function (e) {
        var width = $("#hotspotImg-1").first().width();
        console.log(actWdth + " " + width);

        var e0 = e.originalEvent,
            delta = e0.wheelDelta || -e0.detail;

        this.scrollTop += (delta < 0 ? 1 : -1) * 30;
        e.preventDefault();
        actWdth = $("#hotspotImg-1 img").width() * zoom;
        if (e.originalEvent.deltaY < 0) {
            if (actWdth < width *2) {
                zoom += 0.04;
            }
            $("#hotspotImg-1").css("transition", "transform 1s");
            $("#hotspotImg-1").css("transform-origin", "top left");
            $("#hotspotImg-1").css("transform", "scale(" + (zoom) + ")");
        } else {
            
            if (actWdth > width + 200) {
                zoom -= 0.04;
            }
            $("#hotspotImg-1").css("transition", "transform 1s");
            $("#hotspotImg-1").css("transform-origin", "top left");
            $("#hotspotImg-1").css("transform", "scale(" + (zoom) + ")");
        }
    });

    //Formulario de herencia
    $(".idHerencia").each(function() {
        var id = $(this).val();
        var nombre = $("#herenciaNombre" + id).val();
        $("#tipoHerencia" + id).val($("#herenciaOculto" + id).data("tipo"));
        $("#checkNombre" + id).on("change", function() {
            if (!$("#checkNombre" + id).is(":checked")) {
                $("#herenciaNombre" + id).prop("disabled", false);
                $("#herenciaNombre" + id).val("");
                $("#tipoHerencia" + id).prop("disabled", false);
            } else {
                $("#herenciaNombre" + id).prop("disabled", true);
                $("#herenciaNombre" + id).val(nombre);
                $("#tipoHerencia" + id).prop("disabled", true);
            }
        });
    });

});

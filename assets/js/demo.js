$(document).ready(function () {
    var posX,
        posY;
    var id = parseInt($(".hot-spot").last().attr("id")) + 1;
    var src;
    zoom = 1;
    var actWdth,
        id_mapa;
    var calles = [];
    var data;
    zoom_aux = 1;
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
    
    // Insercion de puntos de interes
    $("#insert").click(function () {
        var titulo = $("#titulo").val();
        var contenido = $("#descripcion").val();
        if (isNaN(id)) {
            id = 1;
        }

        $("#slide").after("<div id='" + id + "' class='hot-spot' data-posx='" + posX / zoom + "' data-posy='" + posY / zoom + "' style='top:" + posY + "px;left:" + posX + "px'><div class='circle'></div><div class='tooltip'><div class='img-row'><img id='insImg' src='' width='100'></div><div class='text-row'><h4> " + titulo + " </h4><p>" + contenido + "</p></div></div></div>");
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
            $(this).attr("style", "top: " + (coordY * zoom) + "px; left: " + (coordX * zoom) + "px; display: block;");
        });
    });

    var hotspot_width = 40;

    /* INTENTO DE ZOOM AL MOUSE 

    var offset = $('#hotspotImg-1').offset();
    var size = {w:$('#hotspotImg-1').width(),h:$('#hotspotImg-1').height()}
    //Aumentar el tamaña del mapa con las calles manteniendo los puntos
    $("#hotspotImg-1").on("wheel", function (e) {
        // X e Y en el tamaño de la pantalla, no cambia. http://output.jsbin.com/oRIDUXE/1/
        var mouse_x = (e.pageX - $('#hotspotImg-1').offset().left) + $("#prueba").scrollLeft();
        var mouse_y = (e.pageY - $('#hotspotImg-1').offset().top) + $("#prueba").scrollTop();

		zoom_point_x = e.pageX - offset.left
		zoom_point_y = e.pageY - offset.top
        var width = $("#hotspotImg-1").first().width();
        // console.log('zoom ' + zoom);
        zoom_target_x = (zoom_point_x - mouse_x)/zoom
	    zoom_target_y = (zoom_point_y - mouse_y)/zoom
        
        console.log("X coords: " + mouse_x + ", Y coords: " + mouse_y);

        // calculate x and y based on zoom
	    mouse_x = -zoom_target_x * zoom + zoom_point_x
	    mouse_y = -zoom_target_y * zoom + zoom_point_y
        console.log("X coords2222222: " + mouse_x + ", Y coords: " + mouse_y);

        var e0 = e.originalEvent,
            delta = e0.wheelDelta || -e0.detail;

        // Make sure the slide stays in its container area when zooming out
	    if(mouse_x>0)
	        mouse_x = 0
	    if(mouse_x+size.w*zoom<size.w)
	    	mouse_x = -size.w*(zoom-1)
	    if(mouse_y>0)
	        mouse_y = 0
	     if(mouse_y+size.h*zoom<size.h)
	    	mouse_y = -size.h*(zoom-1)


        this.scrollTop += (delta < 0 ? 1 : -1) * 30;
        e.preventDefault();
        actWdth = $("#hotspotImg-1 img").width() * zoom;
        if (e.originalEvent.deltaY < 0) {
            // Tony: SE PODRA HACER 10 VECES MAS PEQUEÑO
            if (actWdth  < width *10) {
                zoom += 0.04;
                hotspot_width -= 5;   
            }
        } else {
        // Tony: Se podrá hacer zoom hacia afuera hasta que el width de la imagen sea mayor que el width del div + 200
            if (actWdth > width + 200) {
                zoom -= 0.04;
                hotspot_width += 5;
            }
        }

                console.log("X coords333: " + mouse_x + ", Y coords: " + mouse_y);

$("#hotspotImg-1").css("transition", "transform 1s");
            $("#hotspotImg-1").css("transform-origin", mouse_x + "px " + mouse_y + "px").css("transform", "scale("+zoom+","+zoom+")"); 
            // $("#hotspotImg-1").css('translate('+mouse_x+'px,'+mouse_y+'px)');
            $(".hot-spot-1").css({"width" : hotspot_width , "height" : hotspot_width});
    });

    */ 

   /*
    //Aumentar el tamaña del mapa con las calles manteniendo los puntos */
    $("#hotspotImg-1").on("wheel", function (e) {
        
        var width = $("#hotspotImg-1").first().width();
        // console.log('zoom ' + zoom);

        

        var e0 = e.originalEvent,
            delta = e0.wheelDelta || -e0.detail;

        this.scrollTop += (delta < 0 ? 1 : -1) * 30;
        e.preventDefault();
        actWdth = $("#hotspotImg-1 img").width() * zoom;
        if (e.originalEvent.deltaY < 0) {

            // Tony: SE PODRA HACER 10 VECES MAS PEQUEÑO
            if (actWdth  < width *10) {
                zoom += 0.04;
                hotspot_width -= 10;
                
            }
            $("#hotspotImg-1").css("transition", "transform 1s");
            $("#hotspotImg-1").css("transform-origin", "top left");
            $("#hotspotImg-1").css("transform", "scale(" + (zoom) + ")");
            $(".hot-spot-1").css({"width" : hotspot_width , "height" : hotspot_width});
            
            
        } else {
        // Tony: Se podrá hacer zoom hacia afuera hasta que el width de la imagen sea mayor que el width del div + 200
            if (actWdth > width + 200) {
                zoom -= 0.04;
                hotspot_width += 3;
            }

            $("#hotspotImg-1").css("transition", "transform 1s");
            $("#hotspotImg-1").css("transform-origin", "top left");
            $("#hotspotImg-1").css("transform", "scale(" + (zoom) + ")");
            $(".hot-spot-1").css({"width" : hotspot_width , "height" : hotspot_width});
            
            
                           

        }

        
    });

    // ZOOM PERSONALIZADO PARA LA SUPERPOSICION DE MAPAS
        $("#hotspotImg-2").on("wheel", function (e) {
        var width = $("#hotspotImg-2").first().width();
        

        var e0 = e.originalEvent,
            delta = e0.wheelDelta || -e0.detail;

        this.scrollTop += (delta < 0 ? 1 : -1) * 30;
        e.preventDefault();
        actWdth = $("#hotspotImg-2 img").width() * zoom_aux;
        if (e.originalEvent.deltaY < 0) {

            // Tony: SE PODRA HACER 10 VECES MAS PEQUEÑO
            if (actWdth  < width *10) {
                zoom_aux += 0.04;
                if(zoom_aux > 1){zoom_aux = 1;}
            }
            if(zoom_aux >= 0.44 && zoom_aux < 1){
                    $("#hotspotImg-2").css("transition", "transform 1s");
                    $("#hotspotImg-2").css("transform-origin", "top left");
                    $("#hotspotImg-2").css("transform", "scale(" + (zoom_aux) + ")");
                    console.log('zoom_aux ' + zoom_aux);
                }
        } else {
        // Tony: Se podrá hacer zoom hacia afuera hasta que el width de la imagen sea mayor que el width del div + 200
            if (actWdth > width + 200) {
                zoom_aux -= 0.04;
                if(zoom_aux < 0.44){zoom_aux = 0.44;}
                console.log('zoom_aux ' + zoom_aux);
            }
			
            if(zoom > 0.44 && zoom_aux < 1){
                    $("#hotspotImg-2").css("transition", "transform 1s");
                    $("#hotspotImg-2").css("transform-origin", "top left");
                    $("#hotspotImg-2").css("transform", "scale(" + (zoom_aux) + ")");
                    }
        }
    });
    // ZOOM PERSONALIZADO PARA LA SUPERPOSICION DE MAPAS









    //Formulario de herencia
    $(".idHerencia").each(function () {
        var id_calle = $(this).val();
        var nombre = $("#herenciaNombre" + id_calle).val();

        $("#tipoHerencia" + id_calle).val($("#herenciaOculto" + id_calle).data("tipo"));
        $("#checkNombre" + id_calle).on("change", function () {
            if (!$("#checkNombre" + id_calle).is(":checked")) {
                $("#herenciaNombre" + id_calle).prop("disabled", false);
                $("#herenciaNombre" + id_calle).val("");
                $("#tipoHerencia" + id_calle).prop("disabled", false);
            } else {
                $("#herenciaNombre" + id_calle).prop("disabled", true);
                $("#herenciaNombre" + id_calle).val(nombre);
                $("#tipoHerencia" + id_calle).prop("disabled", true);
                $("#tipoHerencia" + id_calle).val($("#herenciaOculto" + id_calle).data("tipo"));
            }
        });
    });

   $("#submitHerencia1").submit(function () {
        calles = [];
        $(".idHerencia").each(function () {
            var id_calle = $(this).val();
            var nombre = $("#herenciaNombre" + id_calle).val();
            var tipo = $("#tipoHerencia" + id_calle).val();
            var id_mapa = $("#idMapaOculto").data("id-mapa");
            var caso;
            
            if ($("#checkNombre" + id_calle).is(":checked")) {
                caso = 1;
            }
            
            if ((!$("#checkNombre" + id_calle).is(":checked")) && (nombre != "")) {
                caso = 2;
            }
                
            if (nombre == "") {
                caso = 3;
            }
            
            item = {};
            item["id"] = id_calle;
            item["tipo"] = tipo;
            item["nombre"] = nombre;
            item["id_mapa"] = id_mapa;
            item["caso"] = caso;

            calles.push(item);
        });
        data = JSON.stringify(calles);
        $("#jsonOculto").val(data);
        return true;
    });

});

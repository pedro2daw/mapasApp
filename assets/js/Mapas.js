// La preview del mapa en la inserción del mapa:
var openFile = function (event) {
    var input = event.target;

    var reader = new FileReader();
    reader.onload = function () {
        var dataURL = reader.result;
        var output = document.getElementById('output');
        output.src = dataURL;
        output.style.display = 'block';
    };
    reader.readAsDataURL(input.files[0]);
};

// La preview del mapa en la inserción del mapa:
var openFile = function (event, opc) {
    input = event.target;
    reader = new FileReader();
    reader.onload = function () {
        dataURL = reader.result;
        switch (opc) {
            case '1':
                output = document.getElementById('output');
                break;
            case '2':
                output = document.getElementById('upd_imagen');
                break;
        }
        output.src = dataURL;
        output.style.display = 'block';
    };
    reader.readAsDataURL(input.files[0]);
};


// Cuando click en cerrar en el Modal (pop up de insertar...) se resetean los campos y la imagen.
$(document).ready(function () {
    $('[data-toggle="popover"]').popover();
    
    // Si no hay una imagen seleccionada, se oculta la etiqueta <img> de la previsualización
    $("#output").hide();

    // RESETEAR VALUE DE CADA UNO SI LE DAS CLICK AL OTRO 
    $('#exampleModalCenter').on('hidden.bs.modal', function (e) {
        $(this).find('form')[0].reset();
        $('#output').attr('src','');
    });
    
    $("#seleccionar_paquete").hide();
    $("#crear_paquete").hide();
    
    $("#btn_crearpaquete").click(function() {
        $("#seleccionar_paquete").hide();
        $("#crear_paquete").show();
        
        // Cuando click en crear paquete, se pone el valor del select en default.
        $("#select_paquetes").val(1);
        // El campo se vuelve required.
        $("#nombre_paquete").prop('required', true);
        $("#descripcion_paquete").prop("required", true);
        $("#select_paquetes").prop("required", false);
        
    });
    $("#btn_selectpaquete").click(function () {
        $("#seleccionar_paquete").show();
        $("#crear_paquete").hide();
        $("#nombre_paquete").val("");
        // El campo se vuelve required.
        $("#select_paquetes").prop("required", true);
        $("#nombre_paquete").prop("required", false);
        $("#descripcion_paquete").prop("required", false);
    });
    
});
/*
$(function () {
    // Multiple images preview in browser
    var imagesPreview = function (input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function (event) {
                    $($.parseHTML('<img>')).attr({'src': event.target.result,
                        'class': "img-thumbnail"}).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#gallery-photo-add').on('change', function () {
        imagesPreview(this, 'div.gallery');
    });
});
*/
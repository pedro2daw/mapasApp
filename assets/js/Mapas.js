// La preview del mapa en la inserción del mapa:
var openFile = function (event) {
    var input = event.target;

    var reader = new FileReader();
    reader.onload = function () {
        var dataURL = reader.result;
        var output = document.getElementById('output');
        output.src = dataURL;
    };
    reader.readAsDataURL(input.files[0]);
};

// Cuando click en cerrar en el Modal (pop up de insertar...) se resetean los campos y la imagen.
$(document).ready(function () {
    $("#seleccionar_paquete").hide();
    $("#crear_paquete").hide();
    // RESETEAR VALUE DE CADA UNO SI LE DAS CLICK AL OTRO 

    $('#exampleModalCenter').on('hidden.bs.modal', function (e) {
        $(this).find('form')[0].reset();
        $('#output').attr('src','');
    });

    $("#btn_crearpaquete").click(function() {
        $("#seleccionar_paquete").hide();
        $("#crear_paquete").show();
        // Cuando click en crear paquete, se pone el valor del select en default.
        $("#select_paquetes").val(1);
    });
    $("#btn_selectpaquete").click(function () {
        $("#seleccionar_paquete").show();
        $("#crear_paquete").hide();
        $("#nombre_paquete").val("");
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
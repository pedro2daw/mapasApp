<script>
    // Insercion con ajax de los puntos en la BD
    $.ajax({
        type: "post",
        url: "<?php echo base_url(); ?>index.php/Maps/form_update_map",
        dataType: 'text',
        data: "id=" + id,
        success: function (data) {
            var a = $.parseJSON(data);
            console.log('SUCCESS: ', a);
        },
        error: function (data) {
            console.log('ERROR: ', data);
        },
    });
</script>

<div class="container-fluid">

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Insertar Punto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ****************** CUERPO DEL CUADRO MODAL *********************** -->

                    <form>
                        <div class='form-group'>
                            <label for='imagen'>Imagen</label>
                            <input type='file' class='form-control' placeholder='Introduce una imagen' name='imagen' id='imagen' required />
                        </div>
                        <div class='form-group'>
                            <label for='titulo'>Titulo</label>
                            <input type='text' class='form-control' placeholder='Introduce un titulo' name='titulo' id='titulo' required>
                        </div>
                        <div class='form-group'>
                            <label for='descripcion'>Descripción</label>
                            <textarea type='text' class='form-control' placeholder='Introduce una descripción' name='descripcion' id='descripcion' required></textarea>
                        </div>
                        <div class='form-group'>
                            <label for='descripcion'>Posicion X</label>
                            <input type='number' class='form-control' name='descripcion' id='posX' required />
                        </div>
                        <div class='form-group'>
                            <label for='descripcion'>Posicion Y</label>
                            <input type='number' class='form-control' name='descripcion' id='posY' required />
                        </div>
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                            <input type='button' class='btn btn-primary' id="insert" value='Insertar Punto' />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ENTORNO DONDE SE CREA EL PUNTO -->
    <div id="hotspotImg" class="responsive-hotspot-wrap dragscroll">

        <img src="<?php echo base_url("/assets/img/laminas/8_c.png"); ?>" id="slide" class="img-responsive span4 proj-div" data-target="#myModal">

    </div>
    <div id="botonHotspots">
        <button id="mas">+</button>
        <button id="menos">-</button>
        <button id="reset">Reset</button>
    </div>

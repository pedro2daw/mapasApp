<?php
    echo '
    <!-- *********************** INSERCIÓN DE UN MAPA ************************** -->

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Insertar Punto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <!-- ****************** CUERPO DEL CUADRO MODAL *********************** --> ';

            echo form_open('Login/checkLogin');
            echo "<div class='form-group'>
                    <label for='titulo'>Imagen</label>
                    <input type='file' class='form-control' placeholder='Introduce una imagen' name='titulo' id='titulo' required/> 
                </div>
                <div class='form-group'>
                    <label for='descripcion'>Descripción</label>
                    <textarea type='text' class='form-control' placeholder='Introduce una descripción' name='descripcion' id='descripcion' required></textarea>
                </div>
                <div class='form-group'>
                    <label for='descripcion'>Posicion X</label>
                    <input type='number' class='form-control' name='descripcion' id='posX' required/>
                </div>
                <div class='form-group'>
                    <label for='descripcion'>Posicion Y</label>
                    <input type='number' class='form-control' name='descripcion' id='posY' required/>
                </div>
                </div>
                <div class='modal-footer'>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                        <input type='submit' class='btn btn-primary' value='Insertar Punto'/>
                    </form> 
                </div>
            </div>
        </div>
    </div>";
    ?>

<script>
    $(document).ready(function() {
        $('img').click(function(e) {
            x_coords = [];
            y_coords = [];
            ys = [];
            var offset = $(this).offset();
            x_coords.push(e.pageX - offset.left);
            y_coords.push(e.pageY - offset.top);
            $("#posX").val(x_coords[0]);
            $("#posY").val(y_coords[0]);            
    });       
        $('#exampleModalCenter').on('hidden.bs.modal', function (e) {
            $(this).find('form')[0].reset();
        })
    });        
</script>

<div class="span4 proj-div" data-toggle="modal" data-target="#exampleModalCenter">
    <img src="../../assets/img/mapas/almeria/7_c_medium.jpg" />
</div>
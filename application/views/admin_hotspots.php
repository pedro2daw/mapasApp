<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <nav class="nav nav-pills flex-column flex-sm-row">
                <?php
                echo anchor('Maps/index/','Mapas','class="flex-sm-fill text-sm-center nav-link"');
                echo anchor('Maps/hotspots/','Puntos de Interés','class="flex-sm-fill text-sm-center nav-link active"');
                echo anchor('Streets/view_admin_streets/','Calles','class="flex-sm-fill text-sm-center nav-link"');
                echo anchor('Maps/users/','Configuración','class="flex-sm-fill text-sm-center nav-link"');
                ?>
            </nav>
        </div>
    </div>

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
                            <label for='iamgen'>Imagen</label>
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
        <input type="submit" class="btn btn-primary" value="Guardar Puntos" />
    </div>
    
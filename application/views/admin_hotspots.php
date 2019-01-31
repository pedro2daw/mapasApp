<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <nav class="nav nav-pills flex-column flex-sm-row">
                <?php
                echo anchor('Maps/index/','Mapas','class="flex-sm-fill text-sm-center nav-link"');
                echo anchor('Maps/hotspots/','Puntos de Interés','class="flex-sm-fill text-sm-center nav-link active"');
                echo anchor('Streets/view_admin_streets/','Calles','class="flex-sm-fill text-sm-center nav-link"');
                echo anchor('','Configuración','class="flex-sm-fill text-sm-center nav-link"');
                ?>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">A</a></li>
                    <li class="page-item"><a class="page-link" href="#">B</a></li>
                    <li class="page-item"><a class="page-link" href="#">C</a></li>
                    <li class="page-item"><a class="page-link" href="#">D</a></li>
                    <li class="page-item"><a class="page-link" href="#">E</a></li>
                    <li class="page-item"><a class="page-link" href="#">F</a></li>
                    <li class="page-item"><a class="page-link" href="#">G</a></li>
                    <li class="page-item"><a class="page-link" href="#">H</a></li>
                    <li class="page-item"><a class="page-link" href="#">I</a></li>
                    <li class="page-item"><a class="page-link" href="#">J</a></li>
                    <li class="page-item"><a class="page-link" href="#">K</a></li>
                    <li class="page-item"><a class="page-link" href="#">L</a></li>
                    <li class="page-item"><a class="page-link" href="#">M</a></li>
                    <li class="page-item"><a class="page-link" href="#">N</a></li>
                    <li class="page-item"><a class="page-link" href="#">Ñ</a></li>
                    <li class="page-item"><a class="page-link" href="#">O</a></li>
                    <li class="page-item"><a class="page-link" href="#">P</a></li>
                    <li class="page-item"><a class="page-link" href="#">Q</a></li>
                    <li class="page-item"><a class="page-link" href="#">R</a></li>
                    <li class="page-item"><a class="page-link" href="#">S</a></li>
                    <li class="page-item"><a class="page-link" href="#">T</a></li>
                    <li class="page-item"><a class="page-link" href="#">U</a></li>
                    <li class="page-item"><a class="page-link" href="#">V</a></li>
                    <li class="page-item"><a class="page-link" href="#">W</a></li>
                    <li class="page-item"><a class="page-link" href="#">X</a></li>
                    <li class="page-item"><a class="page-link" href="#">Y</a></li>
                    <li class="page-item"><a class="page-link" href="#">Z</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

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
    <div id="hotspotImg" class="responsive-hotspot-wrap">

        <img src="<?php echo base_url(" assets/img/mapas/7_o_medium.jpg"); ?>" id="slide" class="img-responsive span4 proj-div" data-toggle="modal" data-target="#exampleModalCenter">

    </div>

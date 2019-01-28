
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <nav class="nav nav-pills flex-column flex-sm-row">
                <?php
                echo anchor('Maps/hotspots/','Mapas','class="flex-sm-fill text-sm-center nav-link active"');
                echo anchor('Maps/hotspots/','Puntos de Interés','class="flex-sm-fill text-sm-center nav-link"');
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

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_insert">
                Insertar Mapa
    </button>
    <input type="submit" class="btn btn-primary" value="Superponer Mapas" />


    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Ciudad</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Descripción</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                for($i = 0; $i < count($ListaMapas);$i++){
                    $mapa = $ListaMapas[$i];
                    echo ("<tr>");
                    echo ("<td>".$mapa["id"]."</td>");
                    echo ("<td><img src='".base_url($mapa["imagen"])."' class='thumbnail_mapa'></td>");
                    echo ("<td>".$mapa["titulo"]."</td>");
                    echo ("<td>".$mapa["ciudad"]."</td>");
                    echo ("<td>".$mapa["fecha"]."</td>");
                    echo ("<td>".$mapa["descripcion"]."</td>");
                    echo("<td>");
                            echo anchor("Maps/form_update_map/".$mapa['id'],"<span class='far fa-edit'></span>","class='btn btn-info', data-toggle='modal' data-target='#modal_insert'");
                    echo("</td>");  
                    echo("<td>");
                            echo anchor("Maps/delete_map/".$mapa['id'],"<span class='fas fa-trash-alt'></span>","class='btn btn-danger'");
                    echo("</td>");
                    echo("</tr>");
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>

    
    <div class="row">
        <div class="col-md-12">
            
            <!-- *********************** INSERCIÓN DE UN MAPA ************************** -->
            <div class="modal fade" id="modal_insert" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Insertar un mapa</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <!-- ****************** CUERPO DEL CUADRO MODAL INSERT *********************** --> 
                            <?php echo form_open_multipart('Maps/insert','class="ui-filterable"'); ?>

                            <div class='form-group'>
                                <label for='titulo'>Título</label>
                                <input type='text' class='form-control' placeholder='Introduce un título' name='titulo'
                                    id='titulo' value='1' required />
                            </div>
                            <div class='form-group'>
                                <label for='descripcion'>Descripción</label>
                                <input type='text' class='form-control' placeholder='Introduce una descripción' name='descripcion'
                                    id='descripcion' value='1' required />
                            </div>
                            <div class='form-group'>
                                <label for='ciudad'>Ciudad</label>
                                <input type='text' class='form-control' placeholder='Introduce una Ciudad' name='ciudad'
                                    id='ciudad' value='1' required />
                            </div>
                            <div class='form-group'>
                                <label for='fecha'>Fecha</label>
                                <input type='number' class='form-control' placeholder='Fecha (año)' min='0' name='fecha'
                                    id='fecha' value='1' required />
                            </div>
                            <div class='form-group'>
                                <label for='fecha'>Nivel</label>
                                <input type='number' class='form-control' placeholder='Nivel' min='0' name='nivel' id='nivel'
                                    value='1' required />
                            </div>
                            <div class='form-group'>
                                <label for='paquete'>Paquete</label>
                            <!-- arreglar todo esto ASAP -->
                            <input id="inset-autocomplete-input" data-type="search" placeholder="Search cars...">
                             
                            </ul>
                            <?php
                                echo '<ul data-role="listview" data-inset="true" data-filter="true" data-filter-reveal="true" data-input="#inset-autocomplete-input">';
                                for($i = 0; $i < count($ListaPaquetes);$i++){
                                    $paquete = $ListaPaquetes[$i];
                                    echo '<li><a href="'.$paquete['id'].'">'.$paquete['nombre'].'</a></li>';
                                }
                                echo "</ul>";
                                ?>

                            </div>
                            
                            <div class='form-group'>
                                <label for='mapa_img'>Subir un Mapa</label>

                                <!-- ***************************** SUBIR UNA IMAGEN ******************** -->
                                <div class="custom-file">
                                    <input type="file" name="img_mapa" class="custom-file-input" id="customFileLang"
                                        lang="es" onchange="openFile(event)" required>
                                    <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                                </div>
                                <img id='output' class='img-thumbnail'>
                            </div>

                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                                <?php form_submit('submit', 'Insertar Mapa',"class='btn btn-primary'"); ?>
                            </div>
                            <?php form_close(); ?>
                        </div>
                    </div>
                </div>

            </div>

            <!-- MODAL DEL UPDATE MAPS : -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Modificar un mapa</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <!-- ****************** CUERPO DEL CUADRO MODAL UPDATE *********************** --> 
                            <?php echo form_open_multipart('Maps/update'); ?>

                            <div class='form-group'>
                                <label for='titulo'>Título</label>
                                <input type='text' class='form-control' placeholder='Introduce un título' name='titulo'
                                    id='titulo' value='1' required />
                            </div>
                            <div class='form-group'>
                                <label for='descripcion'>Descripción</label>
                                <input type='text' class='form-control' placeholder='Introduce una descripción' name='descripcion'
                                    id='descripcion' value='1' required />
                            </div>
                            <div class='form-group'>
                                <label for='ciudad'>Ciudad</label>
                                <input type='text' class='form-control' placeholder='Introduce una Ciudad' name='ciudad'
                                    id='ciudad' value='1' required />
                            </div>
                            <div class='form-group'>
                                <label for='fecha'>Fecha</label>
                                <input type='number' class='form-control' placeholder='Fecha (año)' min='0' name='fecha'
                                    id='fecha' value='1' required />
                            </div>
                            <div class='form-group'>
                                <label for='fecha'>Nivel</label>
                                <input type='number' class='form-control' placeholder='Nivel' min='0' name='nivel' id='nivel'
                                    value='1' required />
                            </div>
                            <div class='form-group'>
                                <label for='mapa_img'>Subir un Mapa</label>
                                <!-- ***************************** SUBIR UNA IMAGEN ******************** -->
                                <div class="custom-file">
                                    <input type="file" name="img_mapa" class="custom-file-input" id="customFileLang"
                                        lang="es" onchange="openFile(event)" required>
                                    <label class="custom-file-label" for="customFileLang">Seleccionar Archivo</label>
                                </div>
                                <img id='output' class='img-thumbnail' src=''>
                            </div>

                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                                <?php form_submit('submit', 'Insertar Mapa',"class='btn btn-primary'"); ?>
                            </div>
                            <?php form_close(); ?>
                        </div>
                    </div>
                </div>

            </div>

            <!-- FIN MODAL UPDATE MAPAS -->
        </div>
    </div>
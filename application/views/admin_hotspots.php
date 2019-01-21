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
    });
</script>
<div class="span4 proj-div" data-toggle="modal" data-target="#exampleModalCenter">
    <img src="../../assets/mapas/almeria/7_c_medium.jpg" />
</div>
<?php /*
echo '
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <nav class="nav nav-pills flex-column flex-sm-row">
                <a class="flex-sm-fill text-sm-center nav-link active" href="#">Mapas</a>
                <a class="flex-sm-fill text-sm-center nav-link" href="#">Laminas</a>
                <a class="flex-sm-fill text-sm-center nav-link" href="#">Configuración</a>
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

    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Ciudad</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>img</td>
                        <td>Almería Siglo 19</td>
                        <td>Almería</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>img</td>
                        <td>Almería Siglo 18</td>
                        <td>Almería</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td colspan="2">Larry the Bird</td>
                        <td>@twitter</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">';

    echo '
    <!-- *********************** INSERCIÓN DE UN MAPA ************************** -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
    Launch demo modal
    </button>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <!-- ****************** CUERPO DEL CUADRO MODAL *********************** --> ';

        echo form_open('Login/checkLogin');
        echo "<div class='form-group'>
                <label for='titulo'>Título</label>
                <input type='text' class='form-control' placeholder='Introduce un título' name='titulo' id='titulo' required/> 
            </div>
            <div class='form-group'>
                <label for='descripcion'>Descripción</label>
                <input type='text' class='form-control' placeholder='Introduce una descripción' name='descripcion' id='descripcion' required/> 
            </div>
            <div class='form-group'>
                <label for='ciudad'>Ciudad</label>
                <input type='text' class='form-control' placeholder='Introduce una Ciudad' name='ciudad' id='ciudad' required/> 
            </div>
            <div class='form-group'>
                <label for='fecha'>Fecha</label>
                <input type='date' class='form-control' placeholder='Introduce una Fecha' name='fecha' id='fecha' required/> 
            </div>";

            HAY QUE INSERTAR UNA IMAGENNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNNN


            
             <div class='form-group'>
                <label for='fecha'>Fecha</label>
                <input type='date' class='form-control' placeholder='Introduce una Fecha' name='fecha' id='fecha' required/> 
            </div>
            ";

    echo "
        </div>
            <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                    <input type='submit' class='btn btn-primary' value='Insertar Mapa'/>
                </form> 
            </div>
        </div>
    </div>
    </div>

        <!-- ****************** CUERPO DEL CUADRO MODAL *********************** --> 
        <!-- ****************** INSERCIÓN DE UN MAPA    *********************** -->";

    echo '</div>';
    echo '</div>';
echo '</div>';
*/

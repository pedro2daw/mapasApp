<?php 
echo '
<div class="container-fluid">

    <div class="row">
        <div class="col-md-12">';

    echo '
    <!-- *********************** INSERCIÓN DE UNA CALLE ************************** -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#streetModal">
    INSERTAR CALLE
    </button>

    <div class="modal fade" id="streetModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        <!-- ****************** CUERPO DEL CUADRO MODAL STREET *********************** --> ';

        echo form_open('');
        echo "<div class='form-group'>
                <label for='nombre'>Nombre de la calle</label>
                <input type='text' class='form-control' placeholder='Introduce el nombre de la calle' name='nombre' id='nombre' required/> 
            </div>
            <div class='form-group'>
                <label for='slide_list'>Selecciona la lámina</label>
                <select multiple>
                    <option value='1'> ALMERIA </option>
                    <option value='1'> ALMERIA 1945 </option>
                </select>
            </div>";
    echo "
        </div>
            <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                    <input type='submit' class='btn btn-primary' value='Insertar calle'/>
                </form> 
            </div>
        </div>
    </div>
    </div>

        <!-- ****************** CUERPO DEL CUADRO MODAL *********************** --> 
        <!-- ****************** INSERCIÓN DE UNA CALLE    *********************** -->";

    echo '</div>';
    echo '</div>';
echo '</div>';


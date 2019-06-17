<script>
    $(document).ready(function() {
        $('#enlace_mapas').toggleClass('active');
    });
</script>

<div id="tablaHerencia" class="row">
    <div class="col-md-12">  
        <table class="table table-hover">
            <thead>
                <tr>
                    <!-- <th scope="col">#</th> -->
                    <th scope="col">Tipo de vía</th>
                    <th scope="col">Nombre</th>
                    <th class="d-none" scope="col">Se encuentra en el mapa</th>
                </tr>
            </thead>
            <tbody>

                
                <?php
                echo "<input type='hidden' id='baseUrl' data-base-url='" . base_url() . "'/>";
                echo "<input type='hidden' id='idMapaOculto' data-id-mapa='" . $id_mapa . "'/>";
                foreach ($listaCalles as $calles) {
                    echo ("<tr>");
                    /* echo ("<td>" . $calles["id"] . "</td>"); */
                    echo "<input type='hidden' id='idHerencia' class='idHerencia' value='" . $calles["id"] . "'/>";
                    echo "<input type='hidden' id='herenciaOculto" . $calles["id"] . "' data-tipo='" . $calles["tipo"] . "'/>";
                    echo ("<td>
                            <select id='tipoHerencia" . $calles["id"] . "' name='tipoHerencia' class='form-control' disabled>
                                <option value='Avenida'>Avenida</option>
                                <option value='Calle'>Calle</option>
                                <option value='Callejon'>Callejón</option>
                                <option value='Camino'>Camino</option>
                                <option value='Carretera'>Carretera</option>
                                <option value='Glorieta'>Glorieta</option>
                                <option value='Pasaje'>Pasaje</option>
                                <option value='Paseo'>Paseo</option>
                                <option value='Plaza'>Plaza</option>
                                <option value='Poligono'>Poligono</option>
                                <option value='Rambla'>Rambla</option>
                                <option value='Residencia'>Residencia</option>
                                <option value='Ronda'>Ronda</option>
                                <option value='Travesia'>Travesía</option>
                                <option value='Urbanizacion'>Urbanización</option>
                                <option value='Via'>Via</option>
                            </select>
                        </td>");
                    echo ("<div class='form-group'>");
                    echo ("<td><input class='form-control' id='herenciaNombre" . $calles["id"] . "' type='text' placeholder='Renombrar / Dejar vacío si no existía' value='" . $calles["nombre"] . "' disabled /></td>");
                    echo ("</div>");

                    

                    echo ("
                    <td> 
                        <div class='custom-control custom-checkbox'> 
                            <input type='checkbox' name='checkNombre" . $calles["id"] . "' id='checkNombre" . $calles["id"] . "' class='custom-control-input'  value='test' checked />
                            <label class='custom-control-label' for='checkNombre" . $calles["id"] ."'> Se encuentra en el mapa insertado </label>
                            
                        </div> 
                    </td>");
                    echo("</tr>");
                }
                ?>

            </tbody>
        </table>
        <form enctype="multipart/form-data" method="post" id="submitHerencia1" action="<?php echo base_url()?>index.php/Inheritance/inherit_streets">
            <input type="hidden" id="jsonOculto" name="jsonOculto" />
            <input type="submit" id="submitHerencia" value="Enviar" class="btn btn-primary" />
        </form>
    </div>
</div>

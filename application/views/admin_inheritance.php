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
                    <th scope="col">#</th>
                    <th scope="col">Tipo de via</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Check</th>
                </tr>
            </thead>
            <tbody>

                
                <?php
                echo "<input type='hidden' id='baseUrl' data-base-url='" . base_url() . "'/>";
                echo "<input type='hidden' id='idMapaOculto' data-id-mapa='" . $id_mapa . "'/>";
                foreach ($listaCalles as $calles) {
                    echo ("<tr>");
                    echo ("<td>" . $calles["id"] . "</td>");
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
                    echo ("<td><input id='herenciaNombre" . $calles["id"] . "' type='text' value='" . $calles["nombre"] . "' disabled /></td>");
                    echo ("<td><input id='checkNombre" . $calles["id"] . "' type='checkbox' checked /></td>");
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

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
                
                foreach ($listaCalles as $calles) {
                    echo ("<tr>");
                    echo ("<td>" . $calles["id"] . "</td>");
                    echo "<input type='hidden' class='herenciaOculto' data-tipo='" . $calles["tipo"] . "'/>";
                    echo ("<td>
                            <select id='tipoHerencia' name='tipoHerencia' class='form-control' disabled>
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
                    echo ("<td><input class='herenciaNombre' type='text' value='" . $calles["nombre"] . "' disabled /></td>");
                    echo ("<td><input class='checkNombre' type='checkbox' checked /></td>");
                    echo("</tr>");
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#enlace_listado').toggleClass('active');
        var table = $('#example').DataTable({
            "paging": true,

            "language": {
            "search": "Buscador:",
            "info": "Mostrando de _START_ - _END_ de _TOTAL_ entrada(s).",
            "emptyTable": "No hay datos disponibles",
            "infoEmpty":      "",
            "loadingRecords": "Cargando...",
            "processing":     "Procesando petición...",
            "zeroRecords":    "No se encuentran coincidencias",
            "lengthMenu":     "Mostrar _MENU_ entradas",
            "paginate": {
                "first":      "<<",
                "last":       ">>",
                "next":       ">",
                "previous":   "<"
            }
            },
        });
        
        $("input[type='search']").addClass('form-control');
        $("select[name='example_length']").addClass("form-control form-control-sm");
        // Añadimos la clase form-control para que el buscador tenga el aspecto de bootstrap.
        $("input[type='search']").addClass('form-control');

        $('a.toggle-vis').on('click', function(e) {
            e.preventDefault();

            // Get the column API object
            var column = table.column($(this).attr('data-column'));
            // Toggle the visibility
            column.visible(!column.visible());
        });

        $('#botonConvPDF').on('click', function(e) {

            var nombrePDF = $("#nombrePDF").val();

            if (nombrePDF != ""){
                var doc = new jsPDF();
                doc.autoTable({
                });
                doc.autoTable({
                    html: '#example'
                });
                doc.save(nombrePDF + ".pdf");
            } else {
                swal("Introduzca un nombre para el archivo PDF, por favor.");
            }
            
        });

    });

</script>

<div id="mostrarOcultar">
    Mostrar/ocultar columnas:
    <?php
        $arrayIdMap = array();
        $col = 0;
        echo " - ";
        foreach ($mapas_calles as $todo) {
            if (!in_array($todo["idMapa"], $arrayIdMap)) {
                array_push($arrayIdMap, $todo["idMapa"]);
                echo "<a class='toggle-vis' style='color: blue' data-column='" . $col . "'>" . $todo["titulo"] . "</a> - ";
                $col++;
            }
        }
    ?>
</div>

<table id="example" class="display" name="example" style="width:100%">
    <thead>
        <tr>
            <?php
                $arrayIdMap = array();
                foreach ($mapas_calles as $todo) {
                    if (!in_array($todo["idMapa"], $arrayIdMap)) {
                        array_push($arrayIdMap, $todo["idMapa"]);
                        echo "<th>" . $todo["titulo"] . "</th>";
                    }
                }
            ?>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php
            $arrayIDS = $arrayIdMap;
            foreach ($mapas_calles as $key => $todo)  {
                
                if ((sizeof($mapas_calles)-1) > $key) {
                    $nextPuntoX = $mapas_calles[$key + 1]["puntoX"];

                    $nextPuntoY = $mapas_calles[$key + 1]["puntoY"];            
                }
                
                if ((sizeof($mapas_calles)-1) == $key) {
                    $nextPuntoX = -1000000;

                    $nextPuntoY = -1000000;
                }
                
                if (($todo["puntoX"] == $nextPuntoX) && ($todo["puntoY"] == $nextPuntoY)) {
                    foreach ($arrayIDS as $key => $ids) {
                        if (($todo["idMap"] == $ids) && ((is_numeric($arrayIDS[$key])) || ($arrayIDS[$key] == "<td></td>"))) {
                            $arrayIDS[$key] = "<td>" . $todo["tipo"] . " " . $todo["nombre"] . "</td>";
                        }
                        
                        else if (($todo["idMap"] != $ids) && is_numeric($arrayIDS[$key])) {
                            //$arrayIDS[$key] = "<td></td>";            
                        }
                    }
                }
                
                else if (($todo["puntoX"] != $nextPuntoX) && ($todo["puntoY"] != $nextPuntoY)) {
                    foreach ($arrayIDS as $key => $ids) {
                        if (($todo["idMap"] == $ids) && ((is_numeric($arrayIDS[$key])) || ($arrayIDS[$key] == "<td></td>"))) {
                            $arrayIDS[$key] = "<td>" . $todo["tipo"] . " " . $todo["nombre"] . "</td>";
                        }
                        
                        else if (($todo["idMap"] != $ids) && is_numeric($arrayIDS[$key]))  {
                            $arrayIDS[$key] = "<td></td>";
                        }
                    }
                    foreach ($arrayIDS as $ids) {
                        echo $ids;                        
                    }
                    if (($nextPuntoX == -1000000) && ($nextPuntoY == -1000000)) {
                        echo "</tr>";
                    }
                    else {
                        $arrayIDS = $arrayIdMap;
                        echo "</tr><tr>";
                    }
                    
                }
            }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <?php
                $arrayIdMap = array();
                foreach ($mapas_calles as $todo) {
                    if (!in_array($todo["idMapa"], $arrayIdMap)) {
                        array_push($arrayIdMap, $todo["idMapa"]);
                        echo "<th>" . $todo["titulo"] . "</th>";
                    }
                }
            ?>
        </tr>
    </tfoot>
</table>

<div id="botonesTabla">
    <input type="text" class='form-control'  id="nombrePDF" placeholder="Nombre del archivo PDF">
    <input type="button" id="botonConvPDF" class="btn btn-info" value="Convertir a PDF" />
</div>

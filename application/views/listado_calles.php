<script>
    $(document).ready(function() {
        $('#enlace_listado').toggleClass('active');

        var table = $('#example').DataTable({
            "scrollY": "200px",
            "paging": false
        });

        $('a.toggle-vis').on('click', function(e) {
            e.preventDefault();

            // Get the column API object
            var column = table.column($(this).attr('data-column'));
            // Toggle the visibility
            column.visible(!column.visible());
        });

        //Generar un PDF

        /*$(".boton-generar-informe").click(function() {
            $(".btn-generar-informe").addClass("d-none");
            $("#save").removeClass("d-none");
            $("#observaciones").removeClass("d-none");
            $("#archivo").removeClass("d-none");
            $("#cabecera").removeClass("d-none");
            $("#formato").removeClass("d-none");
            swal({
                title: "Información",
                text: "El contenido del informe contendrá el historial de la calle seleccionada y las observaciones que introduzcas (opcional)",
                icon: "info",
                button: "Aceptar",
                dangerMode: false,
            })
        });*/


        $("#botonConvWord").on("click", function() {
            var pdf = new jsPDF();
            pdf.text(20, 20, "Mostrando una Tabla con PHP y MySQL");

            var columns = [ 
                <?php
                $arrayIdMap = array();
                foreach ($mapas_calles as $todo) {
                    if (!in_array($todo["idMapa"], $arrayIdMap)) {
                        array_push($arrayIdMap, $todo["idMapa"]);
                        echo "" . $todo["titulo"] . "";
                    }
                }
                ?>
            ];
            var data = [
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
            ];

            pdf.autoTable(columns, data, {
                margin: {
                    top: 25
                }
            });

            pdf.save('MiTabla.pdf');
        });

        $("#botonConvPDF").on("click", function() {
            var ul_test =
                $("#lista_puntos").find("li").filter(function() {
                    return $(this).find("ul").length === 0;
                }).map(function(i, e) {
                    return $(this).text();
                }).get().join("\n");
            var observaciones = $("#observaciones").val();
            var informe = "Historial de calles :\n\n" + ul_test + "\n\nObservaciones : \n\n" + observaciones;
            //alert(informe);
            var nombre_fichero = $("#nombre_archivo").val();
            if (nombre_fichero == "") {
                swal({
                    title: "Advertencia",
                    text: "Debes introducir el nombre del archivo",
                    icon: "info",
                    button: "Aceptar",
                    dangerMode: true,
                })
            } else {
                var doc = new jsPDF()

                doc.text(informe, 10, 10);
                doc.save(nombre_fichero + ".pdf");

                $('#lista_puntos').html("");
                $(".btn-generar-informe").removeClass("d-none");
                $("#save").addClass("d-none");
                $("#observaciones").addClass("d-none");
                $("#observaciones").val("");
                $("#archivo").addClass("d-none");
                $("#nombre_archivo").val("");
                $(function() {
                    $("#modal_puntos").modal('toggle');
                });
            }

        });



        $("#close").click(function() {
            $('#lista_puntos').html("");
            $(".btn-generar-informe").removeClass("d-none");
            $("#formato").addClass("d-none");
            $("#observaciones").addClass("d-none");
            $("#observaciones").val("");
            $("#archivo").addClass("d-none");
            $("#nombre_archivo").val("");
        });

        function changeOpacity(i) {
            $(document).on("input", "#slider_" + i, function() {
                var opacity = $(this).val();
                $("#img_" + i).css("opacity", opacity);
            });
        }
    });

</script>

<?php 
    //var_dump($mapas_calles);
?>

<div id="mostrarOcultar">
    Mostrar/ocultar columnas:
    <?php
        $arrayIdMap = array();
        $col = 0;
        foreach ($mapas_calles as $todo) {
            if (!in_array($todo["idMapa"], $arrayIdMap)) {
                array_push($arrayIdMap, $todo["idMapa"]);
                echo "<a class='toggle-vis' data-column='" . $col . "'>" . $todo["titulo"] . "</a> - ";
                $col++;
            }
        }
    ?>
</div>

<table id="example" class="display" style="width:100%">
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
    <input type="button" id="botonConvWord" value="Convertir a documento de texto" />
    <input type="button" id="botonConvPDF" value="Convertir a PDF" />
</div>

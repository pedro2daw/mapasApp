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
    });

</script>

<?php 
    //var_dump($mapas_calles);
?>

<div>
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
                            $arrayIDS[$key] = "<td>" . $todo["nombre"] . "</td>";
                        }
                        
                        else if (($todo["idMap"] != $ids) && is_numeric($arrayIDS[$key])) {
                            //$arrayIDS[$key] = "<td></td>";            
                        }
                    }
                }
                
                else if (($todo["puntoX"] != $nextPuntoX) && ($todo["puntoY"] != $nextPuntoY)) {
                    foreach ($arrayIDS as $key => $ids) {
                        if (($todo["idMap"] == $ids) && ((is_numeric($arrayIDS[$key])) || ($arrayIDS[$key] == "<td></td>"))) {
                            $arrayIDS[$key] = "<td>" . $todo["nombre"] . "</td>";
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

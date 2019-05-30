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
        $col = 0;
        foreach ($mapas_calles as $todo) {
                    echo "<a class='toggle-vis' data-column='" . $col . "'>" . $todo["titulo"] . "</a> - ";
                    $col++;
        }
    ?>
</div>

<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <?php
                foreach ($mapas_calles as $todo)  {
                    echo "<th>" . $todo["titulo"] . "</th>";
                }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
            $lastId = -1;
            echo "<tr>";
            foreach ($mapas_calles as $todo)  {
                    echo "<td>" . $todo["tipo"] . " " . $todo["nombre"] . "</td>";
                    $lastId = $todo["idCalle"];
                }
            
            echo "<tr>";
        ?>
    </tbody>
    <tfoot>
        <tr>
            <?php
                foreach ($mapas_calles as $todo)  {
                    echo "<th>" . $todo["titulo"] . "</th>";
                }
            ?>
        </tr>
    </tfoot>
</table>

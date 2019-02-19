<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class='box'>
            <?php
            if (isset($msg)){
                switch ($msg) {
                    case 0:
                        echo "<div class='alert alert-success' role='alert'> Se ha realizado la operación con éxito.  </div>";
                        break;
                    case 1:
                        echo "<div class='alert alert-danger' role='alert'> Se ha producido un error.  </div>";  
                        break;
                }
            }
            ?>
            </div> <!-- final del div .box -->
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-3">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php 
                    for($i = 0; $i < count($listaCalles);$i++){
                        $each_street = $listaCalles[$i];
                        echo "<tr>";
                        echo "<td class='d-none'>".$each_street["id"]."</td>";
                        echo "<td>".$each_street["tipo"]." ".$each_street["nombre"]."</td>";
                        echo "</tr>";
                    }
                    ?>      
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>


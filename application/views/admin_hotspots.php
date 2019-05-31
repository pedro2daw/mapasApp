<script>
    $(document).ready(function () {
        $('#enlace_hotspots').toggleClass('active');
        $("#insert").on("click", function(e) {
            e.preventDefault();
            var form = $('form')[0];
            var formData = new FormData(form);
            var src = "<?php echo base_url(); ?>assets/img/img_hotspots/"
            
            // Insercion con ajax de los puntos en la BD
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/Hotspots/insert_hotspot",
                data: formData,
                processData: false,
                cache: false,
                contentType: false,
                type: 'POST',
                success: function(data) {
                    var bk = src + "" + data;
                    $("#insImg").attr("src", bk);
                    $("#upd_imagen").attr("src", "");
                }
            });
            
        });
        
        $('div').on("contextmenu", ".hot-spot", function (e) {
            e.preventDefault();
            var id_hs = this.id;
            var id_mapa = $("#slide").data("id-mapa");

            swal({
                title: "Borrar punto de interés",
                text: "Va a borrar a borrar este punto de interés, esta operación es irreversible. ¿Desea continuar?",
                icon: "warning",
                buttons: ["Cancelar", "Borrar punto de Interés"],
                dangerMode: true,
                })
                .then((next) => {
            if (next) {
                $("#" + id_hs).remove();
                $.ajax({
                url: "<?php echo base_url(); ?>index.php/Hotspots/delete_hotspot",
                type: 'post',
                data: {id : id_hs,
                       id_mapa : id_mapa},
                success: function () {
                    minID();
                },
                error: function () {
                    console.log('ERROR!');
                },
                
            });
            } else {}
            return false;
        });
       });
        
        // Carga de los puntos insertados desde la BD
        $('#hotspotImg').hotSpot({

          // default selectors
          mainselector: '#hotspotImg',
          selector: '.hot-spot',
          imageselector: '.img-responsive',
          tooltipselector: '.tooltip',

          // or 'click'
          bindselector: 'hover'

        });
    });
</script>

<div class="container-fluid">
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Insertar Punto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- ****************** CUERPO DEL CUADRO MODAL *********************** -->

                    <form enctype="multipart/form-data" id="submit">

                        <div class="custom-file">
                                <label class="custom-file-label" for="customFileLang">Seleccionar Imagen</label>
                                <input type="file" name="imagen" class="custom-file-input" id="imagen" lang="es" onchange="openFile(event,'2')" required>
                                <input type="hidden" name="hsId" id="hsId" value=""/>
                                <input type="hidden" name="mapId" id="mapId" value=""/>
                        </div>
                        <img id='upd_imagen' class='img-thumbnail' src=''>

<!--
                        <div class='form-group'>
                            <label for='imagen'>Imagen</label>
                            <input type='file' class='form-control' placeholder='Introduce una imagen' name='imagen' id='imagen' required />
                            <input type="hidden" name="hsId" id="hsId" value=""/>
                            <input type="hidden" name="mapId" id="mapId" value=""/>
                        </div>
                        -->
                        <div class='form-group'>
                            <label for='titulo'>Titulo</label>
                            <input type='text' class='form-control' placeholder='Introduce un titulo' name='titulo' id='titulo' required>
                        </div>
                        <div class='form-group'>
                            <label for='descripcion'>Descripción</label>
                            <textarea type='text' class='form-control' placeholder='Introduce una descripción' name='descripcion' id='descripcion' required></textarea>
                        </div>
                        
                        <div class='form-group'>
                            <label for='posX'>Posicion X</label>
                            <input type='number' class='form-control' name='posX' id='posX' hidden />
                        </div>
                        <div class='form-group'>
                            <label for='posY'>Posicion Y</label>
                            <input type='number' class='form-control' name='posY' id='posY' hidden />
                        </div>
                        
                        <div class='modal-footer'>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>
                            <input type='submit' class='btn btn-primary' id="insert" value='Insertar Punto' />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ENTORNO DONDE SE CREA EL PUNTO -->
        <div id="hotspotImg" class="responsive-hotspot-wrap dragscroll">

            <img src="<?php echo base_url("$urlImg"); ?>" id="slide" data-id-mapa="<?php echo "$id_mapa" ?>" class="img-responsive span4 proj-div" data-target="#myModal">

            <?php 
            foreach ($ListaHotspots as $hotspot) {
                echo "<div id='" .$hotspot["id"]. "' class='hot-spot' data-posx='" .$hotspot["punto_x"]. "' data-posy='" .$hotspot["punto_y"]. "' style='top: " .$hotspot["punto_y"]. "px; left: " .$hotspot["punto_x"]. "px; display: block;'>
                    <div class='circle'></div>
                    <div class='tooltip' style='margin-left: -135px; display: none;'>
                        <div class='img-row'><img src='" .base_url("/assets/img/img_hotspots/".$hotspot["imagen"]). "' width='100'></div>
                        <div class='text-row'>
                            <h4>" .$hotspot["titulo"]. "</h4>
                            <p>" .$hotspot["descripcion"]. "</p>
                        </div>
                    </div>
                </div>";
            }

            ?>

        </div>

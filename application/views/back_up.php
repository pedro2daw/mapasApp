<script>
    $(document).ready(function(){
        $('#enlace_back').toggleClass('active');
        $("#btn-assets").click(function(){
        $("#btn-assets").removeClass("btn-secundary").addClass("btn-success");
        $("#btn-tablas").removeClass("btn-success").addClass("btn-secundary");
        $("#tablas").hide();
        $("#assets").show();
        });

        $("#btn-tablas").click(function(){
        $("#btn-tablas").removeClass("btn-secundary").addClass("btn-success");
        $("#btn-assets").removeClass("btn-success").addClass("btn-secundary");
        $("#tablas").show();
        $("#assets").hide();
        });

        $("#btn-import-sql").click(function(){
        $("#btn-import-sql").removeClass("btn-secundary").addClass("btn-info");
        $("#btn-import-assets").removeClass("btn-info").addClass("btn-secundary");
        $("#import-sql").show();
        $("#import-assets").hide();
        });

        $("#btn-import-assets").click(function(){
        $("#btn-import-assets").removeClass("btn-secundary").addClass("btn-info");
        $("#btn-import-sql").removeClass("btn-info").addClass("btn-secundary");
        $("#import-sql").hide();
        $("#import-assets").show();
        });

    });
</script>
<div class="container-fluid">

    <div class="row" id="first_row" style="margin-top:2%;">
        <div class="col"></div>
        <div class="col text-center"><h1>Copias de Seguridad</h1></div>
        <div class="col"></div>
    </div><!-- firt_row-->

    <div class="row" id="second_row" style="margin-top:2%;">
        <div class="col"></div>

        <div class="col-md-6">
            <div class="row" id="third_row">    
                <!--<div class="col bg-success hoverable text-center" style="height:250px; border-radius: 20px;">
                    <i class="fas fa-file-download" style="margin-top: 20%; font-size:150px; color:white"></i>
                    <h3 style="color:white; margin-top:3%;">Exportar datos</h3>
                </div>-->
                <div class="col hoverable text-center" style="border-radius:20px;">
                <!-- <a class="btn btn-success" href="<//?php echo base_url(); ?>index.php/Security/export_database" style="height:250px; border-radius:20px; width:250px;"><i class="fas fa-file-download" style="margin-top: 20%; font-size:150px; color:white"></i></a>-->
                <a class="btn btn-success" data-toggle="modal" data-target="#modal_export" style="height:250px; border-radius:20px; width:250px;"><i class="fas fa-file-download" style="margin-top: 20%; font-size:150px; color:white"></i></a>
                    <h3 style="color:black;">Exportar datos</h3>
                </div>

                <div class="col"></div>

                <div class="col hoverable text-center" style="border-radius:20px;">
                    <a class="btn btn-info" data-toggle="modal" data-target="#modal_import" style="height:250px; border-radius:20px; width:250px;"><i class="fas fa-file-upload" style="margin-top: 20%; font-size:150px; color:white"></i></a>
                    <h3 style="color:black;">Importar datos</h3>
                </div>

            </div> <!-- third_row -->
        </div>

        <div class="col"></div>



    </div> <!-- second_row -->
<!-- ************************* modal ***************************-->
<div class="modal fade" id="modal_export" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Exportar contenido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="backup-wrapper">
                    <button type="button" class="btn btn-secundary" id="btn-tablas"> Tablas </button>
                    <button type="button" class="btn btn-secundary" id="btn-assets"> Contenido </button>
                </div>
                <!-- ****************** CUERPO DEL CUADRO MODAL INSERT *********************** -->
                <div id="tablas">
                <h4>Seleccione las tablas a exportar</h4>
                
                <?php
                echo form_open('BackUp/export_database'); ?>
                    <div class='custom-control custom-checkbox'>
                        <input class='custom-control-input' type='checkbox' value='todos' id='todos' name='check_tables'>
                        <label class='custom-control-label' for='todos'>
                        Base de datos completa
                        </label>
                    </div>

                    <div class='custom-control custom-checkbox'>
                        <input class='custom-control-input' type='checkbox' value='calles' id='calles' name='check_tables'>
                        <label class='custom-control-label' for='calles'>
                        Calles
                        </label>
                    </div>

                    <div class='custom-control custom-checkbox'>
                        <input class='custom-control-input' type='checkbox' value='mapas' id='mapas' name='check_tables'>
                        <label class='custom-control-label' for='mapas'>
                        Mapas
                        </label>
                    </div>

                    <div class='custom-control custom-checkbox'>
                        <input class='custom-control-input' type='checkbox' value='mapas_calles' id='mapas_calles' name='check_tables'>
                        <label class='custom-control-label' for='mapas_calles'>
                        Mapas-Calles
                        </label>
                    </div>

                    <div class='custom-control custom-checkbox'>
                        <input class='custom-control-input' type='checkbox' value='puntos' id='puntos' name='check_tables'>
                        <label class='custom-control-label' for='puntos'>
                        Puntos de referencia
                        </label>
                    </div>

                    <div class='custom-control custom-checkbox'>
                        <input class='custom-control-input' type='checkbox' value='hotspots' id='hotspots' name='check_tables'>
                        <label class='custom-control-label' for='hotspots'>
                        Puntos de interés
                        </label>
                    </div>

                    <div class='custom-control custom-checkbox'>
                        <input class='custom-control-input' type='checkbox' value='usuarios' id='usuarios' name='check_tables'>
                        <label class='custom-control-label' for='usuarios'>
                        Usuarios
                        </label>
                    </div>

                        <input type='hidden' value='' name='tablas' id='tablas_export'/>
                        <input type='submit' class='btn btn-success' value='Exportar' id='exportar' disabled />
                    </form>
                     </div>    
                    
                    <div id="assets">
                    <?php echo anchor("BackUp/backup_assets/","Descargar contenido","class='btn btn-success' id='btn-assets'"); ?>
                    </div>

                <div class='modal-footer'>
                    
                </div>
                </div>
            </div> <!-- cierra el modal body -->
        </div>
    </div> <!-- modal_insert -->


    <!-- ************************* modal ***************************-->
<div class="modal fade" id="modal_import" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Seleccione el contenido a importar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <div class="backup-wrapper">
                    <button type="button" class="btn btn-secundary" id="btn-import-sql"> SQL </button>
                    <button type="button" class="btn btn-secundary" id="btn-import-assets"> ASSETS </button>
                </div>


                    <div id="import-sql">
                        <?php echo form_open_multipart('BackUp/import_data'); ?>
                    
                        <div class='custom-file'>
                            <input type='file' name='file_sql' class='custom-file-input' id='file_sql' required>
                            <label class='custom-file-label' for='file_sql'>Seleccionar SQL</label>
                        </div>
                            <input type='submit' class='btn btn-info' value='Importar SQL' id='importar'/>
                        </form>
                    </div>

                    <div id="import-assets">
                        <?php
                            echo form_open_multipart('BackUp/restore_assets'); ?>
                            <div class='custom-file'>
                                <input type='file' name='assetsZip' class='custom-file-input' id='assetsZip' required>
                                <label class='custom-file-label' for='file_sql'>Seleccionar ASSETS</label>
                            </div>

                            
                        <?php
                            echo ("
                                <input type='submit' class='btn btn-info' value='Importar ASSETS' id='importar'/>
                                </form>
                            ");
                        ?>
                    </div>
                </div>
            </div> <!-- cierra el modal body -->
        </div>
    </div> <!-- modal_insert -->




































</div>









</div><!-- cierra el container -->
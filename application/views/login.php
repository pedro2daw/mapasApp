<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>/assets/style/style_login.css" />
<div class="row">
        <div class="col-md-12">
            <div class='box'>
                <?php
                
            if (isset($msg)){
                switch ($msg) {
                    case 2:
                        echo "<div class='alert alert-danger' role='alert'> Usuario o contraseña incorrectos. </div>";
                        break;
                    case 4:
                        echo "<div class='alert alert-success' role='alert'> Usuario borrado con éxito. </div>";
                        break;
                }
            }
            ?>
            </div> <!-- final del div .box -->
        </div>
    </div>

<div id="login"> 
    <div class="row">
        <div class="col-md-4"></div> 
            <div class="col-md-4" id='fondo_form'>
            <!-- <img src='".base_url("/assets/img/icono/i2.png")."' id='favicon'> -->
                    <h4 class='text-center'>Formulario de Login</h4>
                    <?php echo form_open('Login/checkLogin'); ?>
                    <div class='form-group'>
                        Nombre</br>
                        <input type='text' class='form-control' placeholder='Introduce tu nombre' name='name' onblur='check_user();' id='user' required/>
                        <p id='ajax'></p>
                    
                    </div>

                    <div class='form-group'>
                    Contraseña</br>
                        <input type='password' class='form-control' placeholder='Introduce tu contraseña' name='password' required/>
                        </div>
                        <input type='submit' class='btn btn-primary' value='Acceder'/>
                    </form>
                </div>
            <div class='col-md-4'> </div>
    </div>
    <br><br><br>
    

    
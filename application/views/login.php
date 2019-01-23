<?php 
echo('    
<div class="container-fluid" id="login"> 
    <div class="row">
    <div class="col-md-4"></div> 
         <div class="col-md-4">
    ');
    echo("
        <h4 class='text-center'>Formulario de Login</h4>");
        if(isset($msg)) echo $msg;
        echo form_open('Login/checkLogin');
        echo ("<div class='form-group'>");
        echo ("
            Nombre</br>
            <input type='text' class='form-control' placeholder='Introduce tu nombre' name='name' onblur='check_user();' id='user' required/>
            <p id='ajax'></p>
            <!--</br>-->");
        echo(" </div>");

        echo ("<div class='form-group'>");
        echo("Contraseña</br>
            <input type='password' class='form-control' placeholder='Introduce tu contraseña' name='password' required/>
            <!--</br></br></br>-->");
            echo("</div>");
         echo("
            <input type='submit' class='btn btn-primary' value='Acceder'/>
            
        </form>
    
    <br><br><br>
    
    ");
    
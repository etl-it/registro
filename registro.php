<!DOCTYPE html>
<html lang="es">
   <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" href="style.css" />
      <title>Sistema de apertura de aulas</title>

      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <link rel="icon" type="image/png" href="logoetl.png" sizes="16x16"> <!-- Es el icono que sale en la pestaña -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/css/bootstrap-select.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/js/bootstrap-select.min.js"></script>
   </head>
   <body>
			<?php

				 session_start();

         unset($_SESSION['user']);
         unset($_SESSION['pass']);

         $_SESSION['user'] = "";
         $_SESSION['pass'] = "";

      ?>

			<!--
         Esta parte de aqui es el banner de la pagina. Contiene el rectángulo verde, el logo y el link/pestaña de administración.
         -->

			<table style="width: 100%; background-color:#D5F4F3;">
         <tr>
            <td style='text-align:center; font-size:17px;background-color:#D5F4F3;'>
               <a style="text-align:center"><img id="img1" alt="Logo ETL" src=logoetl.png></a>
            </td>
         </tr>
      </table>
      <br>
			<header>
         <nav>
           <ul style= "float: left;list-style-type: none;padding: 0; position: relative; left: 15%;">
              <li ><a  style="text-decoration: none; float: left; position: relative; "  data-toggle="modal" data-target="#modalApertura" >Apertura de Cuenta</a></li>
           </ul>
            <ul>

               <li><a   style="text-decoration: none;"  data-toggle="modal" data-target="#exampleModal" >Administración</a></li>

            </ul>
         </nav>
      </header>

			<!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">

				   <div class="modal-content">
               <div class="modal-header">
                  <h2 style="text-align:center;" class="modal-title" id="exampleModalLabel">Administración</h2>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>

               <div class="modal-body">
                  <form action=registro3.php?mostrar method=post id=myForm1>

								<div class="input-group input-group-lg">
                           <span class="input-group-addon" id="sizing-addon"><i class="glyphicon glyphicon-user"></i></span>
                           <input type="text" class="form-control mb-2" id="inlineFormInput" name="nom" aria-describedby="sizing-addon1" placeholder="Nombre de Usuario" required />
                        </div>
                     <br>
                        <div class="input-group input-group-lg">
                           <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-lock"></i></span>
                           <input type="password" name="pass" class="form-control" placeholder="******" aria-describedby="sizing-addon1" required/>
                        </div>
               

               <div class="modal-footer">
               		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
               		<button  class="btn btn-primary" id="buttonHover1" type="submit">Acceder</button>
               <!--    <button class="btn btn-lg btn-primary btn-block btn-signin" id="buttonHover" style = "width: 600px;" type="submit" onClik=comprobar() >Entrar</button> -->
               </div>
               </form>
               </div>
            </div>
         </div>
      </div>

      <!-- Parte de la apertura de cuentas y cambio de Contraseña -->

      <!-- Modal -->
      <div class="modal fade" id="modalApertura" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">

						<div class="modal-content">
               <div class="modal-header">
                  <h2 style="text-align:center;" class="modal-title" id="exampleModalLabel">Apertura de Cuentas</h2>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>

               <div class="modal-body">
                  <form action=https://www.etl.it.uc3m.es/~etl/cgi-bin/aceptaDatos_v6.cgi method=post>

										 <div class="input-group input-group-lg">
                        <span class="input-group-addon" id="sizing-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" class="form-control mb-2" id="inlineFormInput" name="nia" id='nia' value="" size=7  maxlength="7" onBlur="validarNIA(this)" aria-describedby="sizing-addon1" placeholder="0XXXXXX" required />
                     </div>

                     <div class="input-group input-group-lg">

                      <INPUT type="hidden" NAME="tipo" VALUE="alumno"  >
                     </div>

                     <br>
                     <br>

                     <INPUT TYPE="RADIO" NAME="acc" VALUE="crear" checked> Crear cuenta
                     <INPUT TYPE="RADIO" NAME="acc" VALUE="cambiar"> Cambiar Contrase&ntilde;a
                     <input name = "idioma" VALUE="es" TYPE="hidden">
                     <input name = "registro" VALUE="registro" TYPE="hidden">

               

               <div class="modal-footer">
               		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
               		<button  class="btn btn-primary" id="buttonHover2" type="submit" >Aceptar</button>
               <!--    <button class="btn btn-lg btn-primary btn-block btn-signin" id="buttonHover" style = "width: 600px;" type="submit" onClik=comprobar() >Entrar</button> -->
               
               </div>
               </form>
               </div>
            </div>
         </div>
      </div>

      <form action=registro2.php method=post id=myForm>
         <!-- La lógica de la página esta en registro2.php, registro.php es solo la parte con html, que contiene los formularios, donde recogeremos los datos. -->
         <div style="text-align:center;">

						<br><br>
            <br><br>

						<h1>Sistema de apertura de aulas</h1>

						<?php

						   $link = mysql_connect('localhost', 'registroaulas', '4v3ng3rs', 'aulas')
               					or die('No se pudo conectar: ' . mysql_error());

							 mysql_select_db('aulas') or die('No se pudo seleccionar la base de datos');


               $sql = " SELECT horaSal FROM Registro_aulas WHERE aula = '4.1.B01' AND horaSal IS NULL";
               $va = mysql_query($sql) or die('Consulta fallida: ' . mysql_error());
               $row = mysql_num_rows($va);

               $sql2 = " SELECT horaSal FROM Registro_aulas WHERE aula = '4.1.B02' AND horaSal IS NULL";
               $va2 = mysql_query($sql2) or die('Consulta fallida: ' . mysql_error());
               $row2 = mysql_num_rows($va2);


               echo '<h3 style="display:inline-block;" > 4.1.B01:';

               if($row == 1){

							 		echo '<a style="display:inline-block;" class = "text-success" > ABIERTA </a>';

							 }else{

               		echo '<a  style="display:inline-block;" class = "text-danger"> CERRADA </a>';

							 }
                echo' </h3>';
               echo '<h3 style="display:inline-block; "> &nbsp;&nbsp;&nbsp;&nbsp 4.1.B02:';

               if($row2 == 1){

							 		echo '<a style="display:inline-block;" class = "text-success" > ABIERTA </a>';

							 }else{

							 		echo '<a style="display:inline-block;" class = "text-danger"> CERRADA </a>';

							 }

							 echo'</h3>';

						?>

						<table style=" border:0 ; margin: 0 auto;" >
               <tr>
                  <td  style="width:350px ;text-align:center;">
                     <br>
                     <div class="ContentForm">
                     <div class="input-group input-group-lg">
                        <span class="input-group-addon" id="sizing-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="text" class="form-control mb-2" id="inlineFormInput" maxlength="7" name="nom" aria-describedby="sizing-addon1" placeholder="CUENTA DE TELEMÁTICA" required />
                     </div>
                     <br>
                     <div class="input-group input-group-lg">
                        <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" name="pass" class="form-control" placeholder="******" aria-describedby="sizing-addon1" required/>
                     </div>
                     </div>
                     </td>
                  <td  style=" width:300px ; text-align:center;">
                     <br><br>
                     <select class="selectpicker show-tick"  data-width="150px"  name=aula>
                        
                        <option value="4.1.B01">4.1.B01</option>
                        
                        <option value="4.1.B02">4.1.B02</option>
                       
                     </select>
                     <br><br>
                     <div id="sizing-addon1" >
                        <select class="selectpicker show-tick" data-width="150px" name=apertura>
                           <option value="1">Abrir aula</option>
                           <option value="2">Cerrar aula</option>
                        </select>
                        <br><br><br>
                     </div>
                  </td>
               </tr>
            </table>
            <br><br>
            <button class="btn btn-lg btn-primary btn-block btn-signin" id="buttonHover" style = "width: 600px;" type="submit">Entrar</button>
      </div>
      </form>
      <script>
         function validar(e) {
         tecla = (document.all) ? e.keyCode : e.which;
         if (tecla==13)
           comprobar();
         }

         function comprobar(){
           var i = document.getElementsByName("nom")[0].value;
           var o = document.getElementsByName("pass")[0].value;
           if((i=="")||(o=="")){
             alert("Falta usuario o contraseña");
             document.getElementById("myForm").reset();
           }else{
             document.getElementById("myForm").submit();
           }
         }
      </script>
      <META HTTP-EQUIV="REFRESH" CONTENT="60;URL=https://registroaulas.lab.it.uc3m.es">

   </body>
</html>

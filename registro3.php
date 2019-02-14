<!DOCTYPE html>
<html>
   <meta charset="utf-8" />
   <link rel="stylesheet" href="style.css" />
   <head>
      <title>Sistema de apertura de aulas</title>


      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <!-- Temas-->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
      <!-- se vincula al hoja de estilo para definir el aspecto del formulario de login-->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/css/bootstrap-select.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/js/bootstrap-select.min.js"></script>
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
      <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script>
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>


   </head>
   </style>
   <body onload="Javascript:history.go(1);" onunload="Javascript:history.go(1);">

      <?php
         include 'functions.php';
         session_start();

         // se comprueba si llega el nombre por POST


         if(isset($_POST['nom'])){
           $_SESSION['user'] = $_POST["nom"];
           $_SESSION['pass'] = $_POST["pass"];
         }

         if(isset($_SESSION['user'])){ // Comprobamos si la variable user esta inicializada.


            list($ds , $ldaprdn , $ldappass) = conect_ldap($_SESSION['user'] , $_SESSION['pass'] , "Adm");
           
            /*Conectarse servidor ldap
           $ds = ldap_connect ("ldaps://repldap.lab.it.uc3m.es",636) or die ("Could not connect to LDAP Server");
           $ldaprdn = "uid=".$_SESSION['user'].",ou=Adm,dc=lab,dc=it,dc=uc3m,dc=es";
           $ldappass = $_SESSION['pass'];
           ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
            */
           if($ds){
             $ldapbind = ldap_bind($ds, $ldaprdn , $ldappass) ;

             if ( $ldapbind) {

                 //No hacemos nada ya que solo queremos auntenticar.


             //$rs = ldap_search ($ds,"dc=lab,dc=it,dc=uc3m,dc=es","uid=$user");
               //$info = ldap_get_entries($ds,$rs);
               //if ($info["count"] == 0 ){
               //	echo "usuario encontrado?
               ldap_close($ds);
             }else{
               // No se encuentra, po lo tanto denegamos el acceso.
               $info = NULL;
               //echo "usuario no encontado?";
               ldap_close($ds);
               echo"<script type=\"text/javascript\">alert('Usuario o contraseña incorrectos'); window.location='index.php';</script>";
             }
           }
         }else{ // Si la variable user no esta definida, tambien denegamos el acceso.
           ldap_close($ds);
           exit ("Acceso Restringuido");
         }

         ?>
      <center>
      <td align=center style='font-size:17px;background-color:#D5F4F3;'>
      </tr></table>
      <nav class="navbar navbar-custom">
         <div class="container-fluid">
            <div class="navbar-header">
               <b><img width=60px src=logoetl.png style=" padding: 3px 0px 0px 8px; "></b>
            </div>
            <ul class="nav navbar-nav" >
               <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" >Cerrar Aula<span class="caret"></span></a>
                  <ul class="dropdown-menu" name = aula>
                     <li><a href="?aula=4.1.B01&mostrar&cerrar">4.1B01</a></li>
                     <li><a href="?aula=4.1.B02&mostrar&cerrar">4.1B02</a></li>
                  </ul>
               </li>
                  
                  <li class="dropdown">
                     <a class="dropdown-toggle" data-toggle="dropdown" >Modificar Aula<span class="caret"></span></a>
                     <ul class="dropdown-menu" name = aula>
                        <li><a href="?aula=4.1.B01&mostrar">4.1B01</a></li>
                        <li><a href="?aula=4.1.B02&mostrar">4.1B02</a></li>
                     </ul>
                  </li>

               <?php
                  if(isset($_GET['aula'])) {
                     
                     $aula = $_GET['aula'];
                     
                     $link = mysql_connect('localhost', 'registroaulas', '4v3ng3rs', 'aulas')
                     or die('No se pudo conectar: ' . mysql_error());
                     mysql_select_db('aulas') or die('No se pudo seleccionar la base de datos');
 
                    $sql2 = " SELECT horaSal FROM Registro_aulas_pruebas WHERE aula= '$aula' AND horaSal IS NULL";
                    $va2 = mysql_query($sql2) or die('Consulta fallida: a' . mysql_error());
                    $row2 = mysql_num_rows($va2);
                  
                    $sql3 = " SELECT nia FROM Registro_aulas_pruebas WHERE aula= '$aula' AND horaSal IS NULL";
                    $va3 = mysql_query($sql3) or die('Consulta fallida:b ' . mysql_error());
                    $row3 = mysql_fetch_row($va3);
                    $user = $row3[0];
                    
                    $paso = " SELECT ID FROM Registro_aulas_pruebas WHERE aula = '$aula' AND horaSal IS NULL";
                    $var = mysql_query($paso) or die('Consulta fallida: ' . mysql_error());
                    $var1 = mysql_fetch_row($var);


                    // En este caso no es necesaria la pass, porque no tenemos que autenticar. 
                    list($ds , $ldaprdn , $ldappass) = conect_ldap($user , "xxx" , "Alum");

                    //$ds = ldap_connect ("ldaps://repldap.lab.it.uc3m.es",636) //Nos conectamos al servidor de ldap
                     // or die ("Could not connect to LDAP Server");
                   // $ldaprdn = "uid=".$user.",ou=Alum,dc=lab,dc=it,dc=uc3m,dc=es";

                    $rs = ldap_search ($ds,"dc=lab,dc=it,dc=uc3m,dc=es","uid=$user");
                    $info = ldap_get_entries($ds,$rs);

                    $mail;
                    $nombre;
                  
                     if ($info["count"] == 0 ){
                         $info =false;
                     }elseif ($info) {
                         $nombre = $info[0]["cn"][0];
                         $mail = $info[0]["mailroutingaddress"][0];
                    }

                     $fech = shell_exec('date "+%d/%m/%Y"');
                     $hore = shell_exec('date "+%H:%M:%S"');
                  
                    if(isset($_GET['cerrar'])){
                     
                     if($row2 == 0){
                         echo "<script type=\"text/javascript\"> alert('El aula esta cerrada.'); window.location='registro3.php?mostrar';</script>";
                     }else{

                      $bool = TRUE;
                      $query = " UPDATE  Registro_aulas_pruebas SET horaSal = '$hore' WHERE ID = '$var1[0]';";
                      $var5 = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
                      $query2 = " UPDATE  Registro_aulas_pruebas SET Baneado = '$bool' WHERE ID = '$var1[0]';";
                      $var5 = mysql_query($query2) or die('Consulta fallida: ' . mysql_error());

                      $consulta_nia = " SELECT NIA FROM Registro_aulas_pruebas WHERE ID = '$var1[0]'";
                      $var = mysql_query($consulta_nia) or die('Consulta fallida: ' . mysql_error());
                      $var6 = mysql_fetch_row($var);

                      $sql4 = "SELECT Veces FROM Historico_Baneados_pruebas WHERE nia = '$var6[0]'";
                      $var4 = mysql_query($sql4) or die('Consulta fallida: No se puede encontrar usuario' . mysql_error());
                      $veces = mysql_fetch_row($var4);

                      if($veces[0] == 0){
                        $query = "  INSERT INTO Baneados_pruebas (`Nombre` , `NIA`, `fecha` , `veces`) VALUES ('$nombre', '$user ','$fech' , 1);";
                        $var8 = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
                      }else{
                        $sql = "  INSERT INTO Baneados_pruebas (`Nombre` , `NIA`, `fecha` , `veces`) VALUES ('$nombre', '$user ','$fech' , $veces[0] +1);";
                        $var = mysql_query($sql) or die('Consulta fallida: ' . mysql_error());
                        $query = " DELETE FROM  Historico_Baneados_pruebas WHERE NIA = '$var6[0]';";
                        $var5 = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
                      }

                      /*		$fp = fopen("correo_baneados.txt", "rb");
                      $datos = fread($fp, filesize("miarchivo.txt"));
                      fclose($fp);*/
                      $txt = "Hola $nombre ,<br>

                      Revisando el registro telemático de los laboratorios del Departamento de Ingeniería Telemática se ha detectado que no ha realizado la confirmación de salida correspondiente al diá $fech.<br>

                      Según las normas de ocupación es necesario que firmes tanto a la entrada como a la salida.<br>

                      En principio, entendemos que esta confirmación no ha sido registrada por desconocimiento o debido a alguna razón puntual. Si bien este es un mensaje informativo, si este hecho se produce de forma reiterada sin justificación, lamentablemente perderías el derecho a solicitar la apertura de las aulas del departamento , según está indicado en las normas de apertura de aulas. En todo caso, ¿podrías informarnos de la razón por la que no firmaste la salida del aula?<br>

                      <br><br><br>
                      Un saludo <br>
                      Equipo de Técnicos de Laboratorios. <br>
                      Departamento de Ingeniería Telemática.";

                      $titulo = "Notificación alumno baneado.";
                      //cabecera
                      $headers = "MIME-Version: 1.0\r\n";
                      $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                      //dirección del remitente
                      $headers .= "From: ETL <staff@adm.it.uc3m.es>\r\n";
                      // $bool = mail("staff@adm.it.uc3m.es" ,$titulo,$txt,$headers);
                     

                    }
                  }else{
                     if($row2 == 0){
                        echo "<script type=\"text/javascript\"> alert('El aula esta cerrada.'); window.location='registro3.php?mostrar';</script>";
                    }else{
                       if($aula == "4.1.B01"){
                        $query = " UPDATE  Registro_aulas_pruebas SET aula ='4.1.B02' WHERE ID = '$var1[0]';";
                        $var5 = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
   
                       }else{
                        $query = " UPDATE  Registro_aulas_pruebas SET aula ='4.1.B01' WHERE ID = '$var1[0]';";
                        $var5 = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
                       }
                  }
               }
            }
                  ?>

               <form class="navbar-form navbar-left" action="?desbanear&baneados"  method=post id=myFor >
                  <div class="form-group">
                     <input type="text" class="form-control" name="alumno"  aria-describedby="sizing-addon1" placeholder="Usuario a desbanear">
                  </div>
                  <button type="submit" class="btn btn-default">Desbanear</button>
               </form>

               <?php
                  if(isset($_GET['desbanear'] )){

                    $alumno = $_POST["alumno"];

                    $link = mysql_connect('localhost', 'registroaulas', '4v3ng3rs', 'aulas')
                    or die('No se pudo conectar: ' . mysql_error());
                    mysql_select_db('aulas') or die('No se pudo seleccionar la base de datos');

                    $paso = " SELECT ID FROM Baneados_pruebas WHERE NIA = '$alumno'";
                    $var = mysql_query($paso) or die('Consulta fallida: Error');
                    $var1 = mysql_fetch_row($var);

                    $sql4 = "SELECT Veces FROM Historico_Baneados_pruebas WHERE nia = '$alumno'";
                    $var4 = mysql_query($sql4) or die('Consulta fallida: No se puede encontrar usuario' . mysql_error());
                    $veces = mysql_num_rows($var);

                    if( $var1 == 0){
                      echo "<script type=\"text/javascript\"> alert('El usuario no esta baneado.'); window.location='?mostrar';</script>";
                    }else{



                      $bool = TRUE;
                      $query1 = "INSERT INTO Historico_Baneados_pruebas SELECT * FROM Baneados_pruebas WHERE ID = '$var1[0]'";
                      $var6 = mysql_query($query1) or die('Consulta fallida: ' . mysql_error());
                      $query = " DELETE FROM  Baneados_pruebas WHERE ID = '$var1[0]';";
                      $var5 = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

                    }
                    mysql_free_result($result);
                    // Cerrar la conexión
                    mysql_close($link);
                  }

                  ?>




            </ul>
            <ul class="nav navbar-nav navbar-right navbar-custom">
               <li><a href="https://registroaulas.lab.it.uc3m.es"><span class="glyphicon glyphicon-log-out"></span>Cerrar Sesion</a></li>
            </ul>
         </div>
      </nav>
      <div>
         <h1>Sistema de apertura de aulas</h1>
      </div>
      <br><br>
      <center>
         <br><br>
         <?php
            if(isset($_GET['mostrar'])){

              ?>
         <ul class="nav nav-tabs">
         <li class="active"><a >Registro de Aulas</a></li>
         <li><a href=?baneados>Baneados</a></li>
         <div class="card">
         <div class="card-body">
         <!--Table-->
         <table id = "example" class="table table-striped table-bordered" style="width:100%">
         <thead>
            <tr>
               <th>ID</th>
               <th>FECHA</th>
               <th>HORA ENTRADA</th>
               <th>AULA</th>
               <th>NOMBRE</th>
               <th>NIA</th>
               <th>HORA SALIDA</th>
               <th>BANEADO</th>

            </tr>
         </thead>
         <tbody>
            <?php

               //echo  var_dump(isset($_SESSION['user'] ));
               //echo  var_dump($info["count"]);

               $link = mysql_connect('localhost', 'registroaulas', '4v3ng3rs', 'aulas')
               or die('No se pudo conectar: ' . mysql_error());
               mysql_select_db('aulas') or die('No se pudo seleccionar la base de datos');

               // Realizar una consulta MySQL
               $query = 'SELECT * FROM Registro_aulas_pruebas ORDER BY `ID` DESC';
               $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

               while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {


                 echo"<tr>";

                 //	echo "\t\t<td><input type='checkbox' name='hobbies[]' /></td>";

                 foreach ($line as $col_value) {
                   echo "\t\t<td>$col_value</td>\n";
                 }
                 echo" </tr>";
               }

               // Liberar resultados
               mysql_free_result($result);
               // Cerrar la conexión
               mysql_close($link);

               }  elseif(isset($_GET['baneados'])){
               ?>
            <ul class="nav nav-tabs">
               <li> <a href=?mostrar>Registro de Aulas</a></li>
               <li class="active"><a>Baneados</a></li>
            </ul>
            <div class="card">
               <div class="card-body">
                  <!--Table-->
                  <table class="table table-hover table-responsive-md table-fixed">
                     <!--Table head-->
                     <thead>
                        <tr>
                           <th>ID</th>
                           <th>NOMBRE</th>
                           <th>NIA</th>
                           <th>FECHA</th>
                           <th>VECES</th>

                        </tr>
                     </thead>
                     <!--Table head-->
                     <!--Table body-->
                     <tbody>
                        <?php
                           $link = mysql_connect('localhost', 'registroaulas', '4v3ng3rs', 'aulas')
                           or die('No se pudo conectar: ' . mysql_error());
                           mysql_select_db('aulas') or die('No se pudo seleccionar la base de datos');

                           // Realizar una consulta MySQL
                           $query = 'SELECT * FROM Baneados_pruebas ORDER BY `ID` DESC';
                           $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());

                           while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {

                             echo"<tr>";
                             foreach ($line as $col_value) {

                               echo "\t\t<td>$col_value</td>\n";
                             }
                             echo" </tr>";
                           }


                           // Liberar resultados
                           mysql_free_result($result);
                           // Cerrar la conexión
                           mysql_close($link);
                           }else{
                           echo "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";
                           }

                           ?>
                     </tbody>
                     <!--Table body-->
                  </table>
                  <!--Table-->
               </div>
            </div>
            <?php
               //                }
               //       }
               //        }else{
               //                echo"<script type=\"text/javascript\">alert('Usuario o contraseña incorrectos'); window.location='index.php';</script>";
               //echo $user;
               //echo "bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb";
               //}
               //return FALSE;
               //}
               ?>
            <script>

              $.extend( $.fn.dataTable.defaults, {
              searching: false,
              ordering:  false
            } );

              $(document).ready(

                function() {
                $('#example').DataTable();
              } );


               function comprobar(){
                 var i = document.getElementsByName("aula").value = "4.1B01";
                 document.getElementById("myForm").submit();

               }
            </script>
      </center>
   </body>
</html>

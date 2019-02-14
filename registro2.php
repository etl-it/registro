<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>LOGIN</title>
<!--	 <link href="CSS/bootstrap.min.css" rel="stylesheet">
	<link href="CSS/bootstrap-theme.min.css" rel="stylesheet">
	<script type="text/javascript" src="JS/bootstrap.min.js"></script>

-->
  <?php

      include 'functions.php';

 ?>  


</head>
<body >


  <?php
  //session_start();
  $user = $_POST["nom"];
  $passwd = $_POST["pass"];
  $aula = $_POST['aula'];
  $apertura =  $_POST['apertura'];
  $estadoB01 = 0;
  $estadoB02 = 0;
  $_SESSION['correcto'] = 1;
  $_SESSION['aula'] = $_POST['aula'];
  $_SESSION['apertura'] = $_POST['apertura'];
  $_SESSION['user'] = $_POST["nom"];
  $_SESSION['pass'] = $_POST["pass"];



    list($ds , $ldaprdn , $ldappass) = conect_ldap($user , $passwd , "Alum");
  
  if ($ds) {
    
    $ldapbind = ldap_bind($ds, $ldaprdn , $ldappass);

    if ($ldapbind) {

      $link = mysql_connect('localhost', 'registroaulas', '4v3ng3rs', 'aulas')
      or die('No se pudo conectar: ' . mysql_error());
      mysql_select_db('aulas') or die('No se pudo seleccionar la base de datos');


      if ($_SESSION['correcto'] == 1){
        //$muid = ($me['emails'][0]['value']);
        $rs = ldap_search ($ds,"dc=lab,dc=it,dc=uc3m,dc=es","uid=$user");
        $info = ldap_get_entries($ds,$rs);
        if ($info["count"] == 0 ){
          $info =false;
        }elseif ($info) {
          $fech = shell_exec('date "+%d/%m/%Y"');
          $hore = shell_exec('date "+%H:%M:%S"');
          $nombre = $info[0]["cn"][0];
	  $mail = $info[0]["mailroutingaddress"][0];

		$paso = " SELECT ID FROM Baneados_pruebas WHERE NIA = '$user'";
               $var = mysql_query($paso) or die('Consulta fallida: ' . mysql_error());
               $var1 = mysql_fetch_row($var);

	  $sql = " SELECT horaSal FROM Registro_aulas_pruebas WHERE nia = '$user' AND horaSal IS NULL";

          $va = mysql_query($sql) or die('Consulta fallida: ' . mysql_error());
          $row = mysql_num_rows($va);

          /* Comprobar si el aula ya esta abierta */

          $sql2 = " SELECT horaSal FROM Registro_aulas_pruebas WHERE aula= '$aula' AND horaSal IS NULL";
          $va2 = mysql_query($sql2) or die('Consulta fallida: ' . mysql_error());
          $row2 = mysql_num_rows($va2);

          $sql3 = " SELECT horaSal FROM Registro_aulas_pruebas WHERE aula= '$aula' AND nia = '$user' AND  horaSal IS NULL";
          $va3 = mysql_query($sql3) or die('Consulta fallida: ' . mysql_error());
          $row3 = mysql_num_rows($va3);



	if($var1 != 0){
		echo"<script type=\"text/javascript\">alert('Usuario baneado.'); window.location='registro.php';</script>";

	// Nos enviamos un correo a nosotros para informarnos de que la persona que quiere abrir el aulano puede porque esta baneada.

		$txt = "El alumno $nombre no tiene permiso para abrir el aula porque está baneado. <br>";		//Titulo
		$titulo = "Notificación alumno baneado.";
		//cabecera
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		//dirección del remitente
		$headers .= "From: ETL <staff@adm.it.uc3m.es>\r\n";
		//$bool = mail("staff@adm.it.uc3m.es" ,$titulo,$txt,$headers);



         }elseif ($apertura == 1 ){

            if($row == 0 && $row2 == 0){

                $query = "  INSERT INTO `Registro_aulas_pruebas` (`ID`, `fecha`, `horaEnt`, `aula`, `nombre`, `nia`, `horaSal`) VALUES ('', '$fech', '$hore', '$aula', '$nombre', '$user ', NULL);";

		$txt = "Hola $nombre , <br>

		Usted ha solicitado la apertura del $aula el día $fech a la hora $hore . <br>
		Le recordamos que según las normas de ocupación es necesario que firmes tanto a la entrada como a la salida, de lo contrario podrías perder el derecho a solicitar la apertura de estas. <br><br><br>

		Un saludo <br>
		Equipo de Técnicos de Laboratorios. <br>
		Departamento de Ingeniería Telemática.";
		//Titulo
		$titulo = "SISTEMA DE APERTURA DE AULAS ETL";
		//cabecera
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		//dirección del remitente
		$headers .= "From: ETL <staff@adm.it.uc3m.es>\r\n";
		//$bool = mail($mail ,$titulo,$txt,$headers);

		// Correo confirmación de apertura de aula que nos llega a nosotros.
		$txt = "El alumno $nombre ha solicitado la apertura del $aula el día $fech a la hora $hore";
		//Titulo
		$titulo = "Notificación apertura de Aula";
		//cabecera
		$headers = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		//dirección del remitente
		$headers .= "From: ETL <staff@adm.it.uc3m.es>\r\n";
		//$bool = mail("staff@adm.it.uc3m.es", $titulo,$txt,$headers);

		 header('Location: http://baqueta.lab.it.uc3m.es/registro/registro/registroact.php');

	    }elseif($row != 0){
              echo"<script type=\"text/javascript\">alert('Usted ya tiene una reserva activa.'); window.location='registro.php';</script>";
	}elseif($row2 != 0){
              echo"<script type=\"text/javascript\">alert('El aula que usted quiere abrir ya esta abierta.'); window.location='registro.php';</script>";
            }
          } else {
              if($row3  == 0){
                echo"<script type=\"text/javascript\">alert('Usted no puede cerrar ese aula.'); window.location='registro.php';</script>";
              }else{

              $paso = " SELECT `ID` FROM `Registro_aulas_pruebas` WHERE `NIA`= '$user' AND `aula` = '$aula' AND `horaSal` IS  NULL; ";
              $var = mysql_query($paso) or die('Consulta fallida: ' . mysql_error());
              $var1 = mysql_fetch_row($var);
              $query = " UPDATE  `aulas`.`Registro_aulas_pruebas` SET  `horaSal` =  '$hore' WHERE  `Registro_aulas_pruebas`.`ID` = '$var1[0]';";

		$txt = "Hola $nombre , <br>

                Usted ha confirmado el cierre del $aula el día $fech a la hora $hore . <br>
             	<br><br><br>

                Un saludo <br>
                Equipo de Técnicos de Laboratorios. <br>
                 Departamento de Ingeniería Telemática.";
                 //Titulo
                 $titulo = "CIERRE DEL AULA: $aula";
                 //cabecera
                 $headers = "MIME-Version: 1.0\r\n";
                 $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                 //dirección del remitente
                 $headers .= "From: ETL <staff@adm.it.uc3m.es>\r\n";
                 //Enviamos el mensaje a tu_dirección_email
                // $bool = mail($mail ,$titulo,$txt,$headers);

		// Correo confirmación de apertura de aula que nos llega a nosotros.
                $txt = "El alumno $nombre ha confirmado el cierre del $aula el día $fech a la hora $hore";
                //Titulo
                $titulo = "Notificación cierre de Aula";
                //cabecera
                $headers = "MIME-Version: 1.0\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                //dirección del remitente
                $headers .= "From: ETL <staff@adm.it.uc3m.es>\r\n";
                //$bool = mail("staff@adm.it.uc3m.es", $titulo,$txt,$headers);

		 header('Location: http://baqueta.lab.it.uc3m.es/registro/registro/registroact.php');
	 }
          }
          $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
        }
         return TRUE;
        }



	} else {
          echo"<script type=\"text/javascript\">alert('Usuario o contraseña incorrectos'); window.location='registro.php';</script>";
      }
        mysql_close($link);
	ldap_close($ds);
        return FALSE;
      }





  ?>
</form>
</center>
</body>
</html>

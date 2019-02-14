<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8" />
	<link rel="stylesheet" href="style.css" />
	<title>Sistema de apertura de aulas</title>

</head>
<body>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<!-- Temas-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<!-- se vincula al hoja de estilo para definir el aspecto del formulario de login-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/css/bootstrap-select.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/js/bootstrap-select.min.js"></script>



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

<center>
	<table  width=100% style='background-color:#D5F4F3;'><tr>
		<td align=center style='font-size:17px;background-color:#D5F4F3;'>
			<a><img width=90px src=logoetl.png style=" padding: 3px 0px 0px 8px;"></a></td>
		</tr></table>

		<header>
			<nav>
				<ul>

					<li><a   style="text-decoration: none;"  data-toggle="modal" data-target="#exampleModal" >Administración</a></lo>

					</ul>
				</nav>
			</header>

			<!-- Modal -->
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel"></h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<form action=registro3.php?mostrar="mostrar" method=post id=myForm1>

								<div class="input-group input-group-lg">
									<span class="input-group-addon" id="sizing-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input type="text" class="form-control mb-2" id="inlineFormInput" name="nom" aria-describedby="sizing-addon1" placeholder="Nombre de Usuario" required />
								</div>
								<br>
								<div class="input-group input-group-lg">
									<span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-lock"></i></span>
									<input type="password" name="pass" class="form-control" placeholder="******" aria-describedby="sizing-addon1" required/>
								</div>

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
								<button  class="btn btn-primary" id="buttonHover" type="submit" onClik=comprobar()>Acceder</button>
								<!--    <button class="btn btn-lg btn-primary btn-block btn-signin" id="buttonHover" style = "width: 600px;" type="submit" onClik=comprobar() >Entrar</button> -->

							</form>
						</div>
					</div>
				</div>
			</div>

			<form action=registro2.php method=post id=myForm>
				<!-- La lógica de la página esta en registro2.php, registro.php es solo la parte con html, que contiene los formularios, donde recogeremos los datos. -->


				<center>
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
						echo '<ah class = "text-success" > ABIERTA </ah>';
					}else{
						echo '<ah class = "text-danger"> CERRADA </ah>';
					}

					echo '<h3 style="display:inline-block; "> &nbsp;&nbsp;&nbsp;&nbsp 4.1.B02:';

					if($row2 == 1){
						echo '<ah class = "text-success" > ABIERTA </ah>';
					}else{
						echo '<ah class = "text-danger"> CERRADA </ah>';
					}
					echo' </h3></h3>';
					?>



					<table border=0 >

						<tr><td width=350px align=center>
							<br>

							<div class="ContentForm">
								<div class="input-group input-group-lg">
									<span class="input-group-addon" id="sizing-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input type="text" class="form-control mb-2" id="inlineFormInput" name="nom" aria-describedby="sizing-addon1" placeholder="NIA SIN LOS 2 DIGITOS INICIALES" required />
								</div>


								<br>
								<div class="input-group input-group-lg">
									<span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-lock"></i></span>
									<input type="password" name="pass" class="form-control" placeholder="******" aria-describedby="sizing-addon1" required/>
								</div>

								<br>


								<td width=300px align=center>
									<br><br>

									<select class="selectpicker show-tick"  data-width="150px"  name=aula>
										echo '<option value="4.1.B01">4.1.B01</option>a';
										echo '<option value="4.1.B02">4.1.B02</option>a';
									</select>

									<br><br>

									<div id="sizing-addon1" >
										<select class="selectpicker show-tick" data-width="150px" name=apertura>
											<option value="1">Abrir aula</option>
											<option value="2">Cerrar aula</option>
										</select>
										<br><br><br>
									</div>

								</td></tr></table>
								<br><br>

								<button class="btn btn-lg btn-primary btn-block btn-signin" id="buttonHover" style = "width: 600px;" type="submit" onClik=comprobar() >Entrar</button>

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


						</center>
					</body></html>

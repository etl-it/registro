<!DOCTYPE html>
<html lang="es">
<head>
	<title>Table V01</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/table/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/table/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/table/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/table/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="CSS/tablecss/util.css">
	<link rel="stylesheet" type="text/css" href="CSS/tablecss/main.css">
<!--===============================================================================================-->

<link rel="icon" type="image/png" href="logoetl.png" sizes="16x16"> <!-- Es el icono que sale en la pestaña -->
<!-- Icons font CSS-->
<link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
<link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
<!-- Font special for pages-->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

<!-- Vendor CSS-->
<link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
<link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

<!-- Main CSS-->
<link href="CSS/main.css" rel="stylesheet" media="all">


</head>
<body>
	<?php
		 session_start();

		 // se comprueba si llega el nombre por POST


		 if(isset($_POST['nom'])){
			 $_SESSION['user'] = $_POST["nom"];
			 $_SESSION['pass'] = $_POST["pass"];
		 }

		 if(isset($_SESSION['user'])){ // Comprobamos si la variable user esta inicializada.

			 //Conectarse servidor ldap
			 $ds = ldap_connect ("ldaps://repldap.lab.it.uc3m.es",636) or die ("Could not connect to LDAP Server");
			 $ldaprdn = "uid=".$_SESSION['user'].",ou=Adm,dc=lab,dc=it,dc=uc3m,dc=es";
			 $ldappass = $_SESSION['pass'];
			 ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);

			 if($ds){
				 $ldapbind = ldap_bind($ds, $ldaprdn , $ldappass) ;

				 if ( $ldapbind) {
						 //No hacemos anda ya que solo queremos auntenticar.
					 ldap_close($ds);
				 }else{
					 // No se encuentra, po lo tanto denegamos el acceso.
					 $info = NULL;
					 ldap_close($ds);
					 echo"<script type=\"text/javascript\">alert('Usuario o contraseña incorrectos'); window.location='index.php';</script>";
				 }
			 }
		 }else{ // Si la variable user no esta definida, tambien denegamos el acceso.
			 ldap_close($ds);
			 exit ("Acceso Restringuido");
		 }
		 ?>
		 <nav class="navbar fixed-top navbar-expand-lg navbar-dark scrolling-navbar">
         <a class="navbar-brand" href="#"><strong>Administración</strong></a>
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <ul class="navbar-nav mr-auto">
			 <li class="nav-item active">
                     <a class="nav-link" href="#">Cerrar Aula <span class="sr-only">(current)</span></a>
                 </li>
                 <li class="nav-item active">
                     <a class="nav-link" href="#">Modificar Aula <span class="sr-only">(current)</span></a>
                 </li>
				 <form class="navbar-form navbar-left" action="?desbanear&baneados"  method=post id=myFor >
                  <div class="form-group">
                     <input type="text" class="form-control" name="alumno"  aria-describedby="sizing-addon1" placeholder="Usuario a desbanear">
                  </div>
                  <button type="submit" class="btn btn-default">Desbanear</button>
               </form>
             </ul>
         </div>
     </nav>
	<div class="limiter">
		<div class="container-table100 bg-gra-01">
			<div class="wrap-table100">
				<div class="table100">
					<table>
						<thead>
							<tr class="table100-head">
								<th class="column1">Date</th>
								<th class="column2">Order ID</th>
								<th class="column3">Name</th>
								<th class="column4">Price</th>
								<th class="column5">Quantity</th>
								<th class="column6">Total</th>
							</tr>
						</thead>
						<tbody>


						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>




<!--===============================================================================================-->
	<script src="vendor/table/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/table/bootstrap/js/popper.js"></script>
	<script src="vendor/table/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/table/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="JS/table/main.js"></script>

	<script src="vendor/jquery/jquery.min.js"></script>
	<!-- Vendor JS-->
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/datepicker/moment.min.js"></script>
	<script src="vendor/datepicker/daterangepicker.js"></script>

	<!-- Main JS-->
	<script src="JS/global.js"></script>

</body>
</html>

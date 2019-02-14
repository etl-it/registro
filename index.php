<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Sistema de Apertura de Aulas</title>
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
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
  <?php
     session_start();
     unset($_SESSION['user']);
     unset($_SESSION['pass']);
     $_SESSION['user'] = "";
     $_SESSION['pass'] = "";
  ?>


    <div class="page-wrapper bg-gra-01 p-t-45 p-b-50">
        <div class="wrapper wrapper--w790">
          <br><br><br><br>
            <div class="card card-5">
                <div class="card-heading">
                    <h2 class="title"><a  class="title" href=index.php>Sistema de Apertura de Aulas</a></h2>
                </div>
                <nav >
                      <ul>
                          <li><a href=?apertura>Apertura de Cuentas</a></li>
                          <li><a href=?admin>Administración</a></li>

                      </ul>
                  </nav>
                <div class="card-body">
                  <?php
                    if(isset($_GET['apertura'])) {

                    ?>
                    <form action=https://www.etl.it.uc3m.es/~etl/cgi-bin/aceptaDatos_v6.cgi method="POST">
                        <div class="form-row  m-l-100 m-b-55">
                            <div class="name">Usuario</div>
                            <div class="value">
                                <div class="row row-space">
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-6" type="text" id="inlineFormInput"
                                                name="nia" id='nia' value="" size=7  maxlength="7" onBlur="validarNIA(this)"
                                                aria-describedby="sizing-addon1" required />
                                            <label class="label--desc">Cuenta de Telemática</label>
                                        </div>
                                        <div class="input-group input-group-lg">
                                          <input type="hidden" NAME="tipo" VALUE="alumno" checked >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row m-l-100 p-t-10">
                          <label class="label label--block"></label>
                          <div class="p-t-15">
                            <label class="radio-container m-r-45">Crear Cuenta
                              <input type="radio" name="acc" value="crear" checked>
                              <span class="checkmark"></span>
                            </label>
                            <label class="radio-container">Cambiar Contraseña
                              <input type="radio" name="acc" value="cambiar">
                              <span class="checkmark"></span>
                            </label>
                          </div>
                        </div>
                        <input name = "idioma" value="es" TYPE="hidden">
                        <input name = "registro" value="registro" type="hidden">
                        <div>
                            <button class="btn btn--radius-2 btn--green" type="submit">Entrar</button>
                        </div>
                    </form>

                    <?php

                    }elseif (isset($_GET['admin'])) {
                      ?>

                      <form action=admin.php?mostrar="mostrar" method="POST">
                          <div class="form-row m-b-55">
                              <div class="name">Usuario y Contraseña</div>
                              <div class="value">
                                  <div class="row row-space">
                                      <div class="col-2">
                                          <div class="input-group-desc">
                                              <input class="input--style-5" type="text" name="nom" aria-describedby="sizing-addon1" required/>
                                              <label class="label--desc">Cuenta de Telemática</label>
                                          </div>
                                      </div>
                                      <div class="col-2">
                                          <div class="input-group-desc">
                                              <input class="input--style-5 " type="password" name="pass"aria-describedby="sizing-addon1" required/>
                                              <label class=" glyphicon glyphicon-lock label--desc">Contraseña</label>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div>
                              <button class="btn btn--radius-2 btn--green" type="submit">Entrar</button>
                          </div>
                      </form>


                      <?php
                      # code...
                    }else{



                   ?>
                    <form method="POST">
                        <div class="form-row m-b-55">
                            <div class="name">Usuario y Contraseña</div>
                            <div class="value">
                                <div class="row row-space">
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="number" name="">
                                            <label class="label--desc">Cuenta de Telemática</label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="input-group-desc">
                                            <input class="input--style-5 " type="password" name="last_name">
                                            <label class=" glyphicon glyphicon-lock label--desc">Contraseña</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Aula</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                        <select name="subject">
                                            <option disabled="disabled" selected="selected">Elegir Aula</option>
                                            <option>4.1.B01</option>
                                            <option>4.1.B02</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row m-l-200 p-t-10">
                          <label class="label label--block"></label>
                          <div class="p-t-15">
                            <label class="radio-container m-r-45">Abrir
                              <input type="radio" checked="checked" name="exist">
                              <span class="checkmark"></span>
                            </label>
                            <label class="radio-container">Cerrar
                              <input type="radio" name="exist">
                              <span class="checkmark"></span>
                            </label>
                          </div>
                        </div>
                        <div>
                            <button class="btn btn--radius-2 btn--green" type="submit">Entrar</button>
                        </div>
                    </form>
                </div>
                <?php
              }
                 ?>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->

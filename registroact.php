<!DOCTYPE html>
<html>

   <head>
      <meta charset="utf-8" />
      <link rel="stylesheet" href="style.css" />
      <title>Sistema de apertura de aulas</title>
   </head>

   <style type="text/css">
      td{
      text-align: center;
      }
      #titulo{
      text-align: center;
      }
   </style>

   <style>
      .loader {
      border: 16px solid #f3f3f3;
      border-radius: 50%;
      border-top: 16px solid #3498db;
      width: 60px;
      height: 60px;
      -webkit-animation: spin 5s linear infinite; /* Safari */
      animation: spin 5s linear infinite;
      }
      @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
      }
   </style>

   <body>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <!-- Temas-->
      <link rel="stylesheet" href="CSS/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
      <!-- se vincula al hoja de estilo para definir el aspecto del formulario de login-->
      <link rel="stylesheet" href="CSS/bootstrap-select.min.css">
      <script src="JS/jquery.min.js"></script>
      <script src="JS/bootstrap.min.js"></script>
      <script src="JS/bootstrap-select.min.js"></script>
      <center>
         <table width=100% style='background-color:#D5F4F3;'>
            <tr>
               <td align=center id=titulo style='font-size:17px;background-color:#D5F4F3;'>
                  <a href=https://registroaulas.lab.it.uc3m.es  onclick=home()><img width=90px src=logoetl.png style=" padding: 3px 0px 0px 8px;"></a>
               </td>
            </tr>
         </table>
         <h1>Sistema de apertura de aulas</h1>

         <br><br><br><br><br><br><br><br><br

				 <table border=1>
            <table >
               <tr>
                  <td width=1000px align=center>
                     <div>
                        <h1  style="color: #05aaa5;">
                           <strong>Acción realizada correctamente</strong>
                           <div class="loader"></div>
                     </div>
                     <br><br>
                     <h2 style="text-align:justify"><p>Le recordamos que según las normas de ocupación es necesario que <strong class="text-danger">firmes tanto a la entrada como a la salida</strong> , de lo contrario podrías perder el derecho a solicitar la apertura de las aulas.
                     </p></h2></h1>
                  </td>
               </tr>
            </table>
         </table>
         <META HTTP-EQUIV="REFRESH" CONTENT="5;URL=https://registroaulas.lab.it.uc3m.es">
      </center>
   </body>
</html>

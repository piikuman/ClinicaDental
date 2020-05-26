<?php
session_start();

require_once("gestionBD.php");
require_once("gestionarCitas.php");
require_once("gestionarPaciente.php");
require_once("gestionarDoctora.php");
require_once("paginacionConsulta.php");

$conexion = crearConexionBD();
$fecha=date("Y-m-d");
$todasCitas = consultarTodasCitasHoy($conexion,$fecha);
cerrarConexionBD($conexion);

if (!isset($_SESSION['login']))
Header("Location: login.php");

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <script type="text/javascript">
  function reloj(){
 
  hoy = new Date();
  dia = hoy.getDate();
  mes = hoy.getMonth()+1;
  ano = hoy.getFullYear();
  hora = hoy.getHours()-1;
  minutos = hoy.getMinutes();
 

  fecha = "Hoy es: " + dia + "/" + mes + "/" + ano + ", " + hora + ":" + minutos;
  document.getElementById('clock').innerHTML = fecha;
 
 
 
  //document.getElementById('clock').innerHTML = new Date();
  }
  </script>
  <link rel="stylesheet" type="text/css" href="css/estilo.css" />
  <title>Inicio</title>
</head>

<body onload="setInterval('reloj()', 200 );">
<?php
include_once("cabecera.php");
include_once("menu.php");
?>
<h1 id="clock"></h1>
<div class="agenda">
<h1 class="agenda" >Agenda para hoy</h1>
<a href="formularioCitas.php" class="add">Añadir Cita</a>
<table class="citas">
 <tr>
   <th>Código</th>
   <th>Hora cita</th>
    <th>Consulta</th>
    <th>Doctora</th>
    <th>Paciente</th>
 </tr>
  <?php
foreach($todasCitas as $citas){
?>
   <tr>
    <form id='formMostrar' method='POST' action='mostrarCitas.php' >
<input type='hidden' name='OID_CITA' value='<?php echo $citas["OID_CITA"]?>'>
   <th><input class="codigo" type='submit' value='<?php echo $citas["OID_CITA"]; ?>'></th>
</form>
       <td><?php echo $citas["HORACITA"]; ?></td>
    <td><?php echo $citas["CONSULTA"]; ?></td>
    <?php $doctora = getInfoDoctora($conexion, $citas["OID_DOCTORA"]);?>
    <td><?php echo $doctora["CODIGODOCTORA"];?></td>
    <?php $paciente = getInfoPaciente($conexion, $citas["OID_PACIENTE"]);?>
    <td><?php echo $paciente["APELLIDOS"];?>, <?php echo $paciente["NOMBRE"];?></td>
 </tr>
 <?php } ?>
</table>
</div>
<div class="recursos">
<h1 class="redes">Redes sociales</h1>
<video class="video" width="400" controls>
  <source src="images/video.mp4" type="video/mp4">
</video>
<br>
<br>
<a class="redes" href="https://www.facebook.com/1845133489066685/videos/2052995018280530/"><img src="images/facebook.png" width="50" height="50"></a>
<a class="redes" href="https://www.instagram.com/isabellledoclinica/?hl=es""><img src="images/instagram.png" width="50" height="50"></a>
<a class="redes" href="https://www.isabellledoclinica.com/"><img src="images/logo.webp" width="50" height="50"></a>
</br>
<p><i>El instagram está en creación.</i></p>
</div>
<?php
include_once("pie.php");
?>
</body>
</html> 

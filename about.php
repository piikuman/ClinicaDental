<?php
	session_start();
	
	if (!isset($_SESSION['login']))
			Header("Location: login.php");
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/estilo.css" />
  <link rel="icon" href="images/logo.webp">
  <title>Sobre nosotros</title>
</head>

<body>
<?php	
	include_once("cabecera.php"); 
	include_once("menu.php");
?>
<main>

<h2>Información de la aplicación</h2>

<p>Esta web está desarrollado por cuatro alumnos de Ingeniería Informática del 
Software para la gestión de la clínica dental Isabel Lledó de Gines, Sevilla.</p>

<h3>Objetivos</h3>

<ul>Los objetivos que nos hemos propuesto llevar a cabo e implementar en un futuro en
nuestra web son los siguientes:
<li><h4>Obj-1.</h4> Gestión y administración de citas de la clínica: Lograr unificar de forma
sencilla y clara todas las citas realizadas. En esta sección, cada cita tendrá
asociada su hora de consulta, la persona que atenderá al paciente y el
tratamiento a realizar. Si a la hora de introducir una cita su hora asociada ya
está ocupada, un mensaje notificará al usuario.</li>
<br/>
<li><h4>Obj-2.</h4> Gestión de pacientes: Crear un registro de pacientes junto con sus
datos, para poder almacenar de manera eficiente y ágil todos los datos de los
pacientes y poder editarlos. Con esta serie de datos podremos crear una visión
general del desarrollo estadístico del negocio que será muy útil para el
propietario.</li>
<br/>
<li><h4>Obj-3.</h4> Contabilidad: Gestión de los pagos de las citas, dependiendo de los
tratamientos que se realicen en esa cita.</li>
<br/>
<li><h4>Obj-4.</h4> Gestión de empleados: Creación de registro de empleados con sus
datos básicos y especialidad facilitando la asignación de los mismos a una cita
dependiendo de los tratamientos que se deban realizar en la misma.</li>
</ul>
<br/>

<p>Para más información de como hemos hecho la aplicación, visitar la <a href="https://rodas5.us.es/items/3596dcbf-8628-40d9-b9af-403962c55488/1/" target="_blank"> página de la asignatura</a></p>
</main>

<?php	
	include_once("pie.php");
?>		
</body>
</html>

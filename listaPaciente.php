<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionarPaciente.php");
	require_once("paginacionConsulta.php");
	
		if (!isset($_SESSION['login']))
			Header("Location: login.php");
		else{
			$conexion = crearConexionBD();
			$pacientes = consultarTodosPacientes($conexion);
			cerrarConexionBD($conexion);
		}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gestión de pacientes: Lista de pacientes</title>
</head>

<body>

<?php
	include_once("cabecera.php");
	include_once("menu.php");
?>

<main>
	<table class="pacientes">
	  <tr>
	    <th scope="row">Código</th>
    	<th>Apellidos</th>
	    <th>Nombre</th>
    	<th>DNI</th>
	  </tr>
  	 <?php
			foreach($pacientes as $paciente){
		?>
  	  <tr>
  	  	<form id='formMostrar' method='POST' action='mostrarPaciente.php' >
			<input type='hidden' name='OID_PACIENTE' value='<?php echo $paciente["OID_PACIENTE"]?>'>
	    <th><input type='submit' value='<?php echo $paciente["OID_PACIENTE"]; ?>'></th>
		</form>
    	    <td><?php echo $paciente["APELLIDOS"]; ?></td>
	    	<td><?php echo $paciente["NOMBRE"]; ?></td>
	    	<td><?php echo $paciente["DNI"]; ?></td>
	  </tr>
	  <?php } ?>	
	</table>
	<a href="formularioPaciente.php">Añadir Paciente</a>
</main>

<?php
	include_once("pie.php");
?>

</body>
</html>
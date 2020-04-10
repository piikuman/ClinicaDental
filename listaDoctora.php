<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionarDoctora.php");
	require_once("paginacionConsulta.php");
	
	$conexion = crearConexionBD();
	$pacientes = consultarTodasDoctoras($conexion); //consultarTodosPacientes---
	cerrarConexionBD($conexion);
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gestión de doctoras: Lista de doctoras</title>
</head>

<body>

<?php
	include_once("cabecera.php");
	include_once("menu.php");
?>

<main>
	<table class="doctoras">
	  <tr>
	    <th scope="row">Código</th>
    	<th>Apellidos</th>
	    <th>Nombre</th>
    	<th>DNI</th>
	  </tr>
  	 <?php
			foreach($doctoras as $doctora){
		?>
  	  <tr>
  	  	<form id='formMostrar' method='POST' action='mostrarDoctora.php' > //---->siguiente
			<input type='hidden' name='OID_DOCTORA' value='<?php echo $doctora["OID_DOCTORA"]?>'>
	    <th><input type='submit' value='<?php echo $paciente["OID_DOCTORA"]; ?>'></th>
		</form>
    	    <td><?php echo $paciente["APELLIDOS"]; ?></td>
	    	<td><?php echo $paciente["NOMBRE"]; ?></td>
	    	<td><?php echo $paciente["DNI"]; ?></td>
	  </tr>
	  <?php } ?>	
	</table>
	<a href="formularioDoctora.php">Añadir Doctora</a>
</main>

<?php
	include_once("pie.php");
?>

</body>
</html>
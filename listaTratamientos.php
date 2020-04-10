<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionarTratamientos.php");
	require_once("paginacionConsulta.php");
	
	$conexion = crearConexionBD();
	$tratamientos = consultarTodosTratamientos($conexion);
	cerrarConexionBD($conexion);
	
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gestión de tratamientos: Lista de tratamientos</title>
</head>

<body>

<?php
	include_once("cabecera.php");
	include_once("menu.php");
?>

<main>
	<table class="tratamiento">
	  <tr>
	    <th scope="row">Código</th>
    	<th>Nombre</th>
	    <th>Coste</th>
	  </tr>
  	 <?php
			foreach($tratamientos as $tratamiento){
		?>
  	  <tr>
  	  	<form id='formMostrar' method='POST' action='mostrarTratamientos.php' >
			<input type='hidden' name='OID_TRATAMIENTO' value='<?php echo $tratamiento["OID_TRATAMEINTO"]?>'>
	    <th><input type='submit' value='<?php echo $tratamiento["OID_TRATAMIENTO"]; ?>'></th>
		</form>
    	    <td><?php echo $citas["nombre"]; ?></td>
	    	<td><?php echo $citas["coste"]; ?></td>
	  </tr>
	  <?php } ?>	
	</table>
	<a href="formularioTratamientos.php">Añadir Tratamiento</a>
</main>

<?php
	include_once("pie.php");
?>

</body>
</html>
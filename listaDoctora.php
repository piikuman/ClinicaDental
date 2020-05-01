<?php
	session_start();
	
	if (!isset($_SESSION['login']))
			Header("Location: login.php");
	
	require_once("gestionBD.php");
	require_once("gestionarDoctora.php");
	require_once("paginacionConsulta.php"); 
	
	$conexion = crearConexionBD();
	$doctoras = consultarTodasDoctoras($conexion); 
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
  	  	<form id='formMostrar' method='POST' action='mostrarDoctora.php' > 
			<input type='hidden' name='codigoDoctora' value='<?php echo $doctora["CODIGODOCTORA"]?>'>
	    <th><input type='submit' value='<?php echo $doctora["CODIGODOCTORA"]; ?>'></th>
		</form>
    	    <td><?php echo $doctora["APELLIDOS"]; ?></td>
	    	<td><?php echo $doctora["NOMBRE"]; ?></td>
	    	<td><?php echo $doctora["DNI"]; ?></td>
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
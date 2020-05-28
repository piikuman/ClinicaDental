<?php
	session_start();
	
	if (!isset($_SESSION['login']))
			Header("Location: login.php");
	
	require_once("gestionBD.php");
	require_once("gestionarEspecialidad.php");
	require_once("paginacionConsulta.php");
	
	$conexion = crearConexionBD();
	$especialidades = consultarTodasEspecialidades($conexion);
	cerrarConexionBD($conexion);

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  	<link rel="stylesheet" type="text/css" href="css/estilo.css" />
  	<link rel="icon" href="images/logo.webp">
  	<title></title>
	<title>Lista Especialidades</title>
 </head>
 
 <body>
 	
 <?php
 	
 	include_once("cabecera.php");
	include_once("menu.php");
	
 ?>
 
 <main>
	<div class="informacion">
	<a href="formularioEspecialidad.php" class="add">Añadir Especialidad</a>
	<br>
 	<div class="espacialidades">
 	<table>
 		<tr>
 			<th scope="row">Código</th>
 			<th>Nombre</th>
 		</tr>
 		  	 <?php
			foreach($especialidades as $especialidad){
		?>
  	  <tr>
  	  	<form id='formMostrarEspecialidad' method='POST' action='mostrarEspecialidad.php' >
			<input type='hidden' name='OID_ESPECIALIDAD' value='<?php echo $especialidad["OID_ESPECIALIDAD"]?>'>
	    <th><input class="codigo" type='submit' value='<?php echo $especialidad["OID_ESPECIALIDAD"]; ?>'></th>
		</form>
    	    <td><?php echo $especialidad["NOMBRE"]; ?></td>
	  </tr>
	  <?php } ?>	
	</table>
	</div>
	</div>   	
</main>

<?php
	include_once("pie.php");
?>
 
 </body>
 </html>
 
 
	
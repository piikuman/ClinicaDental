<?php
	session_start();
	
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
	<title>Gestion de especialidades: Lista de especialidades</title>
 </head>
 
 <body>
 	
 <?php
 	
 	include_once("cabecera.php");
	include_once("menu.php");
	
 ?>
 
 <main>
 	<table class="especialidades">
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
	    <th><input type='submit' value='<?php echo $especialidad["OID_ESPECIALIDAD"]; ?>'></th>
		</form>
    	    <td><?php echo $especialidad["NOMBRE"]; ?></td>
	  </tr>
	  <?php } ?>	
	</table>
	<a href="formularioEspecialidad.php">Añadir Especialidad</a>	    	
</main>

<?php
	include_once("pie.php");
?>
 
 </body>
 </html>
 
 
	
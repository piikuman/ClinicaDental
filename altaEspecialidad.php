<?php
	session_start();
	
	if (!isset($_SESSION['login']))
			Header("Location: login.php");
	
	require_once("gestionBD.php");
	require_once("gestionarEspecialidad.php");
		
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formularioEspecialidad"])) {
		$nuevaEspecialidad = $_SESSION["formularioEspecialidad"];
		$_SESSION["formularioEspecialidad"] = null;
		$_SESSION["errores"] = null;
	}
	else 
		Header("Location: formularioEspecialidad.php");	

	$conexion = crearConexionBD(); 

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gestión de Especialidades: Especialidad apuntada con exito</title>
</head>

<body>
	<?php
		include_once("cabecera.php");
	?>
	<?php
		include_once("menu.php");
	?>

	<main>
		<?php if (altaEspecialidad($conexion, $nuevaEspecialidad)) {  
		?>
				<h1>Especialidad <?php echo $nuevaEspecialidad["nombre"]; ?> registrada correctamente</h1>
				<div >	
			   		Pulsa <a href="listaEspecialidad.php">aquí</a> para acceder a la gestión de biblioteca.
				</div>
		<?php } else { ?>
				<h1>No se pudo añadir la especialidad con exitó.</h1>
				<h3>La especialidad ya está registrada.</h3>
				<div >		
					Pulsa <a href="formularioEspecialidad.php">aquí</a> para volver al formulario.
				</div>
		<?php } ?>

	</main>

	<?php
		include_once("pie.php");
	?>
</body>
</html>
<?php
	cerrarConexionBD($conexion);
?>

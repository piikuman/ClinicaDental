<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionarTratamientos.php");
		
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formulario"])) {
		$nuevaEspecialidad = $_SESSION["formulario"];
		$_SESSION["formulario"] = null;
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

	<main>
		<?php if (altaEspecialidad($conexion, $nuevaEspecialidad)) {  
		?>
				<h1>Especialidad <?php echo $nuevaEspecialidad["nombre"]; ?> registrada correctamente</h1>
				<div >	
			   		Pulsa <a href="listaEspecialidad.php">aquí</a> para acceder a la gestión de biblioteca.
				</div>
		<?php } else { ?>
				<h1>La especialidad ya existe.</h1>
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

<?php
	session_start();
	
	if (!isset($_SESSION['login']))
			Header("Location: login.php");
	
	require_once("gestionBD.php");
	require_once("gestionarTratamientos.php");
	require_once("gestionarEspecialidad.php");
		
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formularioTratamiento"])) {
		$nuevoTratamiento = $_SESSION["formularioTratamiento"];
		$_SESSION["formularioTratamiento"] = null;
		$_SESSION["errores"] = null;
	}
	else 
		Header("Location: formularioTratamientos.php");	

	$conexion = crearConexionBD();
	$especialidad = buscaEspecialidad($conexion, $nuevoTratamiento["especialidad"]); 

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gestión de Tratamientos: Tratamiento apuntado con exito</title>
</head>

<body>
	<?php
		include_once("cabecera.php");
	?>
	<?php
		include_once("menu.php");
	?>

	<main>
		<?php if (altaTratamiento($conexion, $nuevoTratamiento, $especialidad["OID_ESPECIALIDAD"])) {  
		?>
				<h1>Tratamiento <?php echo $nuevoTratamiento["nombre"]; ?> registrado correctamente</h1>
				<div >	
			   		Pulsa <a href="listaTratamientos.php">aquí</a> para acceder a la lista de tratamientos.
				</div>
		<?php } else { ?>
				<h1>No se pudo añadir el tratamiento con exitó.</h1>
				<h3>El tratamiento ya está registrado.</h3>
				<div >		
					Pulsa <a href="formularioTratamientos.php">aquí</a> para volver al formulario.
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

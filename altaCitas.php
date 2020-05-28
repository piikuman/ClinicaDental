<?php
	session_start();
	
	if (!isset($_SESSION['login']))
			Header("Location: login.php");
	
	require_once("gestionBD.php");
	require_once("gestionarCitas.php");
	require_once("gestionarPaciente.php");
	require_once("gestionarTratamientos.php");
	require_once("gestionarDoctora.php");
		
	// Comprobar que hemos llegado a esta página porque se ha rellenado el formulario
	if (isset($_SESSION["formularioCita"])) {
		$nuevaCita = $_SESSION["formularioCita"];
		$_SESSION["formularioCita"] = null;
		$_SESSION["errores"] = null;
	}
	else 
		Header("Location: formularioCitas.php");	

	$conexion = crearConexionBD();
	
	$paciente = buscaPaciente($conexion, $nuevaCita["paciente"]);
	$doctora = buscaDoctora($conexion, $nuevaCita["doctora"]);
	$tratamiento = buscaTratamiento($conexion, $nuevaCita["tratamiento"]);

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/estilo.css" />
  <link rel="icon" href="images/logo.webp">
  <title>Gestión de Citas: Cita apuntada con exito</title>
</head>

<body>
	<?php
		include_once("cabecera.php");
	?>
	<?php
		include_once("menu.php");
	?>

	<main>
		<?php if (altaCita($conexion, $nuevaCita, $paciente["OID_PACIENTE"], $doctora["OID_DOCTORA"], $tratamiento["OID_TRATAMIENTO"])) {  
		?>
				<h1>Cita con fecha  <?php echo $nuevaCita["fechaCita"]; ?> apuntada correctamente.</h1>
				<div >	
			   		Pulsa <a href="listaCitas.php">aquí</a> para acceder a la gestión de citas.
				</div>
		<?php } else { ?>
				<h1>No se pudo añadir la cita con exitó.</h1>
				<h3>Los cita ya está ocupada.</h3>
				<div >	
					Pulsa <a href="formularioCitas.php">aquí</a> para volver al formulario.
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

<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionarDoctora.php");
		
	
	if (isset($_SESSION["formulario"])) {
		$nuevaDoctora = $_SESSION["formulario"];
		$_SESSION["formulario"] = null;
		$_SESSION["errores"] = null;
	}
	else 
		Header("Location: formularioPaciente.php");	

	$conexion = crearConexionBD(); 

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gestión de Doctora: Alta de doctora realizada con éxito</title>
</head>

<body>
	<?php
		include_once("cabecera.php");
	?>

	<main>
		<?php if (altaDoctora($conexion, $nuevaDoctora)) {  
		?>
				<h1>Hola <?php echo $nuevaDoctora["nombre"]; ?>, gracias por registrarte</h1>
				<div >	
			   		Pulsa <a href="verPaciente.php">aquí</a> para acceder a la lista de doctoras.
				</div>
		<?php } else { ?>
				<h1>Esta doctora ya existe en la base de datos.</h1>
				<div >	
					Pulsa <a href="formularioDoctora.php">aquí</a> para volver al formulario.
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

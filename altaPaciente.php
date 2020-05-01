<?php
	session_start();
	
	if (!isset($_SESSION['login']))
			Header("Location: login.php");
	
	require_once("gestionBD.php");
	require_once("gestionarPaciente.php");
		
	if (isset($_SESSION["formularioPaciente"])) {
		$nuevoUsuario = $_SESSION["formularioPaciente"];
		$_SESSION["formularioPaciente"] = null;
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
  <title>Gestión de Pacientes: Alta de paciente realizada con éxito</title>
</head>

<body>
	<?php
		include_once("cabecera.php");
	?>

	<main>
		<?php if (altaPaciente($conexion, $nuevoUsuario)) {  
		?>
				<h1>Hola <?php echo $nuevoUsuario["nombre"]; ?>, gracias por registrarte</h1>
				<div >	
			   		Pulsa <a href="listaPaciente.php">aquí</a> para acceder a la lista de pacientes.
				</div>
		<?php } else { ?>
				<h1>El usuario ya existe en la base de datos.</h1>
				<div >	
					Pulsa <a href="formularioPaciente.php">aquí</a> para volver al formulario.
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

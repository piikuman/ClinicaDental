<?php
	session_start();
	
	if (!isset($_SESSION['login']))
			Header("Location: login.php");
	
	require_once("gestionBD.php");
	require_once("gestionarUsuario.php");
		
	if (isset($_SESSION["formulario"])) {
		$nuevoUsuario = $_SESSION["formulario"];
		$_SESSION["formulario"] = null;
		$_SESSION["errores"] = null;
	}
	else 
		Header("Location: formularioUsuario.php");	

	$conexion = crearConexionBD(); 

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Gestión de Usuarios: Alta de Usuario realizada con éxito</title>
</head>

<body>
	<?php
		include_once("cabecera.php");
	?>
	<?php
		include_once("menu.php");
	?>

	<main>
		<?php if (altaUsuario($conexion, $nuevoUsuario)) {  
		?>
				<h1>Hola <?php echo $nuevoUsuario["correo"]; ?>, gracias por registrarte</h1>
				<div >	
			   		Pulsa <a href="administracion.php">aquí</a> para acceder a la lista de usuarios.
				</div>
		<?php } else { ?>
				<h1>No se pudo añadir el usuario con exitó.</h1>
				<h3>El usuario ya está registrada.</h3>
				<div >		
					Pulsa <a href="formularioUsuario.php">aquí</a> para volver al formulario.
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

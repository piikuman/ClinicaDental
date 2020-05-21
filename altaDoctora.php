<?php
	session_start();
	
	if (!isset($_SESSION['login']))
			Header("Location: login.php");
	
	require_once("gestionBD.php");
	require_once("gestionarDoctora.php");
	require_once("gestionarEspecialidad.php");
		
	
	$conexion = crearConexionBD();
	
	if (isset($_SESSION["formularioDoctora"])) {
		$nuevaDoctora = $_SESSION["formularioDoctora"];
		$especialidad = buscaEspecialidad($conexion, $nuevaDoctora["especialidad"]);
	}
	else 
		Header("Location: formularioDoctora.php");	 

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
	<?php
		include_once("menu.php");
	?>

	<main>
		<?php
			 
			 if (altaDoctora($conexion, $nuevaDoctora, $especialidad["OID_ESPECIALIDAD"])) {
				$_SESSION["formularioDoctora"] = null;
				$_SESSION["errores"] = null;  
		?>
				<h1>Hola <?php echo $nuevaDoctora["nombre"]; ?>, gracias por registrarte</h1>
				<div >	
			   		Pulsa <a href="listaDoctora.php">aquí</a> para acceder a la lista de doctoras.
				</div>
		<?php } else { ?>
				<h1>No se pudo añadir la doctora con exitó.</h1>
				<h3>La doctora ya está registrada.</h3>
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

<?php
session_start();

if (!isset($_SESSION['login']))
			Header("Location: login.php");

require_once ('gestionarEspecialidad.php');
require_once ('gestionBD.php');

if (!isset($_SESSION['login'])){
	Header("Location: login.php");
} else {
	$conexion = crearConexionBD();
	$codigo = $_REQUEST['OID_ESPECIALIDAD'];
	$datos = getInfoEspecialidad($conexion, $codigo);
	cerrarConexionBD($conexion);
}

?>
<!DOCTYPE HTML>
<html lang='es'>
	<head>
		<title>Perfil de la espcialidad</title>
		<meta charset='utf-8' />
	</head>
	<body>
		<?php include_once ('cabecera.php'); ?>
		<?php include_once ('menu.php'); ?>

		<main>
			<article>
				<div>
					<h1><b>Especialidad asociada al código numero <?php echo $codigo?></b></h1>
					<form id='actualizarEspecialidad' method='POST' action='controladorEspecialidad.php'>
					<input id="OID_ESPECIALIDAD" name="OID_ESPECIALIDAD" type="hidden" value="<?php echo $codigo?>"	
						<div>
							<h2><b>Datos especialidad</b></h2>
							<hr></hr>
							<p><b>Nombre:</b> <?php echo $datos["NOMBRE"]; ?> </p>
							<input id="nombre" name="nombre" type="hidden" value="<?php echo $datos["NOMBRE"]; ?>"/>
						</div>
				<button id="actualizar" name="actualizar" type="submit" size="4"><img src="images/botonEditar.png" width="20" height="20"></button>
				<button id="eliminar" name="eliminar" type="submit" size="4"><img src="images/botonEliminar.png" width="20" height="20"></button>
				<button id="cancelar" name="cancelar" type="submit" size="4"><img src="images/returnButton.png" width="20" height="20"></button>
				</form>
			</div>					
			</article>
			<br/>
			<br/>
		</main>
		<?php include_once ('pie.php'); ?>
	</body>
</html>

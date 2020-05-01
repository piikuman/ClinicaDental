<?php
session_start();

require_once ('gestionarTratamientos.php');
require_once ('gestionarEspecialidad.php');
require_once ('gestionBD.php');

if (!isset($_SESSION['login'])){
	Header("Location: login.php");
} else {
	$conexion = crearConexionBD();
	$codigo = $_REQUEST['OID_TRATAMIENTO'];
	$datos = getInfoTratamiento($conexion, $codigo);
	$especialidad = getInfoEspecialidad($conexion, $datos["OID_ESPECIALIDAD"]);
	cerrarConexionBD($conexion);
}

?>

<!DOCTYPE HTML>
<html lang='es'>
	<head>
		<title>Perfil del tratamiento</title>
		<meta charset='utf-8' />
	</head>
	<body>
		<?php include_once ('cabecera.php'); ?>
		<?php include_once ('menu.php'); ?>

		<main>
			<article>
				<div>
					<h1><b>Tratamiento de codigo <?php echo $codigo?></b></h1>
					<form id='actualizarTratameinto' method='POST' action='controladorTratamientos.php'>
					<input id="OID_TRATAMIENTO" name="OID_TRATAMIENTO" type="hidden" value="<?php echo $codigo?>"	
						<div>
							<h2><b>Datos tratamiento</b></h2>
							<hr></hr>
							<p><b>Nombre:</b> <?php echo $datos["NOMBRE"]; ?> </p>
							<input id="nombre" name="nombre" type="hidden" value="<?php echo $datos["NOMBRE"]; ?>"/>
							<p><b>Coste:</b> <?php echo $datos["COSTE"]; ?></p>
							<input id="coste" name="coste" type="hidden" value="<?php echo $datos["COSTE"]; ?>"/>
							<p><b>Especialidad:</b> <?php echo $especialidad["NOMBRE"]; ?></p>
							<input id="especialidad" name="especialidad" type="hidden" value="<?php echo $especialidad["NOMBRE"]; ?>"/>
						</div>
				<button id="actualizar" name="actualizar" type="submit" size="4"><img src="images/botonEditar.png" width="20" height="20"></button>
				<button id="eliminar" name="eliminar" type="submit" size="4"><img src="images/botonEliminar.png" width="20" height="20"></button>
				</form>
			</div>					
			</article>
			<br/>
			<br/>
		</main>
		<?php include_once ('pie.php'); ?>
	</body>
</html>
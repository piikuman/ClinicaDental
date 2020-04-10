<?php
session_start();

require_once ('gestionarPaciente.php');
require_once ('gestionarCitas.php');
require_once ('gestionBD.php');

if (!isset($_SESSION['login'])){
	Header("Location: login.php");
} else {
	$conexion = crearConexionBD();
	$codigo = $_REQUEST['OID_CITA'];
	$codigo2 = $_REQUEST['OID_PACIENTE'];
	$datos = getInfoCita($conexion, $codigo);
	cerrarConexionBD($conexion);
}

?>

<!DOCTYPE HTML>
<html lang='es'>
	<head>
		<title>Perfil de cita</title>
		<meta charset='utf-8' />
	</head>
	<body>
		<?php include_once ('cabecera.php'); ?>
		<?php include_once ('menu.php'); ?>

		<main>
			<article>
				<div>
					<h1><b>Cita del dia <?php echo $datos["fechaCita"]; ?> con hora <?php echo $datos["horaCita"]; ?></b></h1>
					<form id='actualizarCitas' method='POST' action='controladorCitas.php'>
					<input id="OID_CITA" name="OID_CITA" type="hidden" value="<?php echo $codigo?>"	
						<div>
							<h2><b>Datos cita</b></h2>
							<hr></hr>
							<p><b>Codigo paciente:</b> <?php echo $codigo2 ?> </p>
							<input id="OID_PACIENTE" name="OID_PACIENTE" type="hidden" value=" <?php echo $codigo2 ?>"/>
							<p><b>Codigo de la cita:</b> <?php echo $codigo ?> </p>
							<input id="OID_CITA" name="OID_CITA" type="hidden" value=" <?php echo $codigo ?>"/>
							<p><b>Fecha Cita:</b> <?php echo $datos["fechaCita"]; ?> </p>
							<input id="fechaCita" name="fechaCita" type="hidden" value="<?php echo $datos["fechaCita"]; ?>"/>
							<p><b>Hora cita:</b> <?php echo $datos["horaCita"]; ?></p>
							<input id="horaCita" name="horaCita" type="hidden" value="<?php echo $datos["horaCita"]; ?>"/>
							<p><b>Consulta:</b> <?php echo $datos["consulta"]; ?></p>
							<input id="consulta" name="consulta" type="hidden" value="<?php echo $datos["consulta"]; ?>"/>
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
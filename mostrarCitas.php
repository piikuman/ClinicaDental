<?php
session_start();

if (!isset($_SESSION['login']))
			Header("Location: login.php");

require_once ('gestionarPaciente.php');
require_once ('gestionarCitas.php');
require_once ('gestionarDoctora.php');
require_once ('gestionarTratamientos.php');
require_once ('gestionBD.php');

if (!isset($_SESSION['login'])){
	Header("Location: login.php");
} else {
	$conexion = crearConexionBD();
	$codigo = $_REQUEST['OID_CITA'];
	$datos = getInfoCita($conexion, $codigo);
	$paciente = getInfoPaciente($conexion, $datos["OID_PACIENTE"]);
	$doctora = getInfoDoctora($conexion, $datos["OID_DOCTORA"]);
	$tratamiento = getInfoTratamiento($conexion, $datos["OID_TRATAMIENTO"]);
	cerrarConexionBD($conexion);
}

?>

<!DOCTYPE HTML>
<html lang='es'>
	<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/estilo.css" />
  <link rel="icon" href="images/logo.webp">
		<title>Perfil de cita</title>
	</head>
	<body>
		<?php include_once ('cabecera.php'); ?>
		<?php include_once ('menu.php'); ?>

		<main>
			<article>
				<div class="mostrar">
					<div>
					<h1><b>Cita del dia <?php echo $datos["FECHACITA"]; ?> con hora <?php echo $datos["HORACITA"]; ?></b></h1>
					<form id='actualizarCitas' method='POST' action='controladorCitas.php'>
					<input id="OID_CITA" name="OID_CITA" type="hidden" value="<?php echo $codigo?>"	
						<div>
							<h2><b>Datos de la cita</b></h2>
							<hr></hr></br>
							<input id="OID_CITA" name="OID_CITA" type="hidden" value=" <?php echo $codigo ?>"/>
							<p><b>Paciente:</b> <?php echo $paciente["NOMBRE"]; ?> <?php echo $paciente["APELLIDOS"]; ?></p>
							<input id="paciente" name="paciente" type="hidden" value="<?php echo $paciente["DNI"]; ?>"/>
							<p><b>Doctora:</b> <?php echo $doctora["NOMBRE"]; ?> </p>
							<input id="doctora" name="doctora" type="hidden" value="<?php echo $doctora["CODIGODOCTORA"]; ?>"/>
							<p><b>Tratamiento:</b> <?php echo $tratamiento["NOMBRE"]; ?> </p>
							<input id="tratamiento" name="tratamiento" type="hidden" value="<?php echo $tratamiento["NOMBRE"]; ?>"/>
							<p><b>Fecha Cita:</b> <?php echo $datos["FECHACITA"]; ?> </p>
							<input id="fechaCita" name="fechaCita" type="hidden" value="<?php echo $datos["FECHACITA"]; ?>"/>
							<p><b>Hora cita:</b> <?php echo $datos["HORACITA"]; ?></p>
							<input id="horaCita" name="horaCita" type="hidden" value="<?php echo $datos["HORACITA"]; ?>"/>
							<p><b>Consulta:</b> <?php echo $datos["CONSULTA"]; ?></p>
							<input id="consulta" name="consulta" type="hidden" value="<?php echo $datos["CONSULTA"]; ?>"/>
						</div>
				<button id="actualizar" name="actualizar" type="submit" size="4"><img src="images/botonEditar.png" width="20" height="20"></button>
				<button id="eliminar" name="eliminar" type="submit" size="4"><img src="images/botonEliminar.png" width="20" height="20"></button>
				<button id="cancelar" name="cancelar" type="submit" size="4"><img src="images/returnButton.png" width="20" height="20"></button>
				</form>
				</div>
			</div>					
			</article>
			<br/>
			<br/>
		</main>
		<?php include_once ('pie.php'); ?>
	</body>
</html>
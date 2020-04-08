<?php
session_start();

require_once ('gestionarPaciente.php');
require_once ('gestionBD.php');

if (!isset($_REQUEST['OID_PACIENTE'])) {
	header('Location: listaPaciente.php');
} else {
	$codigo = $_REQUEST['OID_PACIENTE'];
}

$conexion = crearConexionBD();

$datos = getInfoPaciente($conexion, $codigo);

cerrarConexionBD($conexion);

?>

<!DOCTYPE HTML>
<html lang='es'>
	<head>
		<title>Perfil de paciente</title>
		<meta charset='utf-8' />
	</head>
	<body>
		<?php include_once ('cabecera.php'); ?>
		<?php include_once ('menu.php'); ?>

		<main>
			<article>
				<div>
					<h1><b>Paciente número <?php echo $codigo ?></b></h1>
					<form id='mostrarPaciente' method='POST' action='formularioPaciente.php' >
						<input type='hidden' name='datos' value='<?php echo $datos ?>'>
					<div>
						<div>
							<h2><b>Datos personales</b></h2>
							<hr></hr>
							<p><b>DNI:</b> <?php echo $datos["DNI"]; ?> </p>
							<p><b>Nombre:</b> <?php echo $datos["NOMBRE"]; ?></p>
							<p><b>Apellidos:</b> <?php echo $datos["APELLIDOS"]; ?></p>
							<p><b>Poblacion:</b> <?php echo $datos["POBLACION"]; ?></p>
							<p><b>Direccion:</b> <?php echo $datos["DIRECCION"]; ?></p>
							<p><b>Fecha de Nacimiento:</b> <?php echo $datos["FECHA_NACIMIENTO"]; ?></p>
							<p><b>Correo:</b> <?php echo $datos["CORREO"]; ?></p>
							
							<br/>
							<h2><b>Datos clínicos</b></h2>
							<hr></hr>
							<p><b>Fecha de alta:</b> <?php echo $datos["FECHAALTA"]; ?></p>
							<?php if(!($datos["SEGURO"]=="" || $datos["SEGURO"]==null)){ ?>
							<p><b>Seguro:</b> <?php echo $datos["SEGURO"]; ?></p>
							<?php } ?>
							
							<br/>
							<?php if(!(($datos["NOMBRE_TUTOR"]=="" || $datos["NOMBRE_TUTOR"]==null) && ($datos["TELEFONO_TUTOR"]=="" && $datos["TELEFONO_TUTOR"]==null))){ ?>
							<h2><b>Datos de contacto</b></h2>
							<hr></hr>								
							<?php } ?>
							<?php if(($datos["NOMBRE_TUTOR"]!="" || $datos["NOMBRE_TUTOR"]!=null)){ ?>
								<p><b>Nombre tutor:</b> <?php echo $datos["NOMBRE_TUTOR"]; ?></p>
							<?php } ?>
							<?php if(($datos["TELEFONO_TUTOR"]!="" || $datos["TELEFONO_TUTOR"]!=null)){ ?>
								<p><b>Telefono tutor:</b> <?php echo $datos["TELEFONO_TUTOR"]; ?></p>
							<?php } ?>
						</div>
					</div>
					<input type='submit' value='Actualizar'>
					</form>
				</div>	
			</article>
			<br/>
			<br/>
		</main>
		<?php include_once ('pie.php'); ?>
	</body>
</html>
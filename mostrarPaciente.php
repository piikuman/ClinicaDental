<?php
session_start();

if (!isset($_SESSION['login']))
			Header("Location: login.php");

require_once ('gestionarPaciente.php');
require_once ('gestionBD.php');

if (!isset($_SESSION['login'])){
	Header("Location: login.php");
} else {
	$conexion = crearConexionBD();
	$codigo = $_REQUEST['OID_PACIENTE'];
	$datos = getInfoPaciente($conexion, $codigo);
	cerrarConexionBD($conexion);
}

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
					<form id='actualizarPaciente' method='POST' action='controladorPaciente.php'>
					<input id="OID_PACIENTE" name="OID_PACIENTE" type="hidden" value="<?php echo $codigo?>"	
						<div>
							<h2><b>Datos personales</b></h2>
							<hr></hr>
							<p><b>DNI:</b> <?php echo $datos["DNI"]; ?> </p>
							<input id="dni" name="dni" type="hidden" value="<?php echo $datos["DNI"]; ?>"/>
							<p><b>Nombre:</b> <?php echo $datos["NOMBRE"]; ?></p>
							<input id="nombre" name="nombre" type="hidden" value="<?php echo $datos["NOMBRE"]; ?>"/>
							<p><b>Apellidos:</b> <?php echo $datos["APELLIDOS"]; ?></p>
							<input id="apellidos" name="apellidos" type="hidden" value="<?php echo $datos["APELLIDOS"]; ?>"/>
							<p><b>Poblacion:</b> <?php echo $datos["POBLACION"]; ?></p>
							<input id="poblacion" name="poblacion" type="hidden" value="<?php echo $datos["POBLACION"]; ?>"/>
							<p><b>Direccion:</b> <?php echo $datos["DIRECCION"]; ?></p>
							<input id="direccion" name="direccion" type="hidden" value="<?php echo $datos["DIRECCION"]; ?>"/>
							<p><b>Fecha de Nacimiento:</b> <?php echo $datos["FECHA_NACIMIENTO"]; ?></p>
							<input id="fechaNacimiento" name="fechaNacimiento" type="hidden" value="<?php echo $datos["FECHA_NACIMIENTO"]; ?>"/>
							<p><b>Correo:</b> <?php echo $datos["CORREO"]; ?></p>
							<input id="correo" name="correo" type="hidden" value="<?php echo $datos["CORREO"]; ?>"/>
							
							<br/>
							<h2><b>Datos clínicos</b></h2>
							<hr></hr>
							<p><b>Fecha de alta:</b> <?php echo $datos["FECHAALTA"]; ?></p>
							<input id="fechaAlta" name="fechaAlta" type="hidden" value="<?php echo $datos["FECHAALTA"]; ?>"/>
							<?php if(!($datos["SEGURO"]=="" || $datos["SEGURO"]==null)){ ?>
							<p><b>Seguro:</b> <?php echo $datos["SEGURO"]; ?></p>
							<input id="seguro" name="seguro" type="hidden" value="<?php echo $datos["SEGURO"]; ?>"/>
							<?php } ?>
							
							<br/>
							<?php if(!(($datos["NOMBRE_TUTOR"]=="" || $datos["NOMBRE_TUTOR"]==null) && ($datos["TELEFONO_TUTOR"]=="" && $datos["TELEFONO_TUTOR"]==null))){ ?>
							<h2><b>Datos de contacto</b></h2>
							<hr></hr>								
							<?php } ?>
							<?php if(($datos["NOMBRE_TUTOR"]!="" || $datos["NOMBRE_TUTOR"]!=null)){ ?>
								<p><b>Nombre tutor:</b> <?php echo $datos["NOMBRE_TUTOR"]; ?></p>
								<input id="nombreTutor" name="nombreTutor" type="hidden" value="<?php echo $datos["NOMBRE_TUTOR"]; ?>"/>
							<?php } ?>
							<?php if(($datos["TELEFONO_TUTOR"]!="" || $datos["TELEFONO_TUTOR"]!=null)){ ?>
								<p><b>Telefono tutor:</b> <?php echo $datos["TELEFONO_TUTOR"]; ?></p>
								<input id="telefonoTutor" name="telefonoTutor" type="hidden" value="<?php echo $datos["TELEFONO_TUTOR"]; ?>"/>
							<?php } ?>
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
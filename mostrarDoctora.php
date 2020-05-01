<?php
session_start();

if (!isset($_SESSION['login']))
			Header("Location: login.php");

require_once ('gestionarDoctora.php');
require_once ('gestionarEspecialidad.php');
require_once ('gestionBD.php');

if (!isset($_SESSION['login'])){
	Header("Location: login.php");
} else {
	$conexion = crearConexionBD();
	$codigo = $_REQUEST['codigoDoctora'];
	$datos = getInfoDoctora($conexion, $codigo);
	$especialidad=getInfoEspecialidad($conexion,$datos["OID_ESPECIALIDAD"]);
	cerrarConexionBD($conexion);
}

?>

<!DOCTYPE HTML>
<html lang='es'>
	<head>
		<title>Perfil de doctora</title>
		<meta charset='utf-8' />
	</head>
	<body>
		<?php include_once ('cabecera.php'); ?>
		<?php include_once ('menu.php'); ?>

		<main>
			<article>
				<div>
					<h1><b>Doctora <?php echo $codigo ?></b></h1>
					<form id='actualizarDoctora' method='POST' action='controladorDoctora.php'>
					<input id="OID_DOCTORA" name="OID_DOCTORA" type="hidden" value="<?php echo $datos["OID_DOCTORA"]?>"
					<input id="codigoDoctora" name="codigoDoctora" type="hidden" value="<?php echo $codigo?>"		
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
							<p><b>Telefono:</b> <?php echo $datos["TELEFONO"]; ?></p>
							<input id="telefono" name="telefono" type="hidden" value="<?php echo $datos["TELEFONO"]; ?>"/>
							
							<br/>
							<h2><b>Datos clínicos</b></h2>
							<hr></hr>
							<p><b>Fecha de alta:</b> <?php echo $datos["FECHAALTA"]; ?></p>
							<input id="fechaAlta" name="fechaAlta" type="hidden" value="<?php echo $datos["FECHAALTA"]; ?>"/>
							<p><b>Sueldo:</b> <?php echo $datos["SUELDO"]; ?></p>
							<input id="sueldo" name="sueldo" type="hidden" value="<?php echo $datos["SUELDO"]; ?>"/>
							<p><b>Especialidad:</b> <?php echo $especialidad["NOMBRE"]; ?></p>
							<input id="sueldo" name="especialidad" type="hidden" value="<?php echo $especialidad["NOMBRE"]; ?>"/>
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
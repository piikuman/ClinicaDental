<?php
session_start();

if (!isset($_SESSION['login']))
			Header("Location: login.php");
else if("admin" != $_SESSION['login']){
		Header("Location: inicio.php");
}

require_once ('gestionarUsuario.php');
require_once ('gestionBD.php');

if (!isset($_SESSION['login'])){
	Header("Location: login.php");
} else {
	$conexion = crearConexionBD();
	$codigo = $_REQUEST['OID_USUARIO'];
	$datos = getInfoUsuario($conexion, $codigo);
	cerrarConexionBD($conexion);
}

?>

<!DOCTYPE HTML>
<html lang='es'>
	<head>
		<title>Perfil de usuario</title>
		<meta charset='utf-8' />
	</head>
	<body>
		<?php include_once ('cabecera.php'); ?>
		<?php include_once ('menu.php'); ?>

		<main>
			<article>
				<div>
					<h1><b>Usuario número <?php echo $codigo ?></b></h1>
					<form id='actualizarUsuario' method='POST' action='controladorUsuario.php'>
					<input id="OID_USUARIO" name="OID_USUARIO" type="hidden" value="<?php echo $codigo?>"	
						<div>
							<h2><b>Datos personales</b></h2>
							<hr></hr>
							<p><b>Correo:</b> <?php echo $datos["CORREO"]; ?></p>
							<input id="correo" name="correo" type="hidden" value="<?php echo $datos["CORREO"]; ?>"/>
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
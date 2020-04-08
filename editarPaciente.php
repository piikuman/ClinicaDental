<?php

session_start();

require_once ('');

if (isset($_REQUEST["OID_PACIENTE"])) {
	$dato["DNI"] = $_REQUEST["DNI"];
	$dato["nombre"] = $_REQUEST["nombre"];
	$dato["apellidos"] = $_REQUEST["apellidos"];
	$dato["fechaNacimiento"] = $_REQUEST["fechaNacimiento"];
	$dato["correo"] = $_REQUEST["correo"];
	$dato["poblacion"] = $_REQUEST["poblacion"];
	$dato["dirrecion"] = $_REQUEST["direccion"];
	$dato["fechaalta"] = $_REQUEST["fechaalta"];
	$dato["seguro"] = $_REQUEST["seguro"];
	$dato["nombreTutor"] = $_REQUEST["nombreTutor"];
	$dato["telefonoTutor"] = $_REQUEST["telefonoTutor"];
	$codigo = $dato["OID_PACIENTE"];
} else {
	header("Location: formularioEditarPaciente.php");
}

$_SESSION["dato"] = $dato;
$conexion = crearConexionBD();

if (count($errores) > 0) {
	$_SESSION['errores'] = $errores;
	header('Location: formularioEditarPaciente.php');
} else {
	unset($_SESSION['errores']);
	header('Location: formularioEditarPaciente.php');
}

cerrarConexionBD($conexion);

?>

<?php

session_start();

require_once ('');

if (isset($_REQUEST["OID_DOCTORA"])) {
	$dato["DNI"] = $_REQUEST["DNI"];
	$dato["nombre"] = $_REQUEST["nombre"];
	$dato["apellidos"] = $_REQUEST["apellidos"];
	$dato["fechaNacimiento"] = $_REQUEST["fechaNacimiento"];
	$dato["poblacion"] = $_REQUEST["poblacion"];
	$dato["dirrecion"] = $_REQUEST["direccion"];
	$dato["fechaAlta"] = $_REQUEST["fechaAlta"];
	$dato["sueldo"] = $_REQUEST["sueldo"];
	$dato["telefono"] = $_REQUEST["telefono"];
	$dato["codigoDoctora"] = $_REQUEST["codigoDoctora"];
	$codigo = $dato["OID_DOCTORA"];
} else {
	header("Location: formularioEditarDoctora.php");
}

$_SESSION["dato"] = $dato;
$conexion = crearConexionBD();

if (count($errores) > 0) {
	$_SESSION['errores'] = $errores;
	header('Location: formularioEditarDoctora.php');
} else {
	unset($_SESSION['errores']);
	header('Location: formularioEditarDoctora.php');
}

cerrarConexionBD($conexion);

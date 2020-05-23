<?php
	session_start();
	
	require_once ('gestionarEspecialidad.php');
	require_once ('gestionBD.php');

	if(isset($_REQUEST['OID_ESPECIALIDAD'])){
		$especialidad["OID_ESPECIALIDAD"] = $_REQUEST["OID_ESPECIALIDAD"];
		$especialidad["nombre"] = $_REQUEST["nombre"];
		$especialidad["act"]= TRUE;
		
		
		$_SESSION["especialidad"] = $especialidad;
		
	}else if (isset($_SESSION["formularioEspecialidad"])) {
		$especialidad["nombre"] = $_REQUEST["nombre"];
		
		$_SESSION["formularioEspecialidad"] = $especialidad;
	
	}
	else Header("Location: formularioEspecialidad.php");

	$errores = validarDatosEspecialidad($especialidad);
	
	if(isset($_REQUEST["cancelarAñadir"])) header("Location: listaEspecialidad.php");
	else{
	if (count($errores)>0) {
		$_SESSION["errores"] = $errores;
		Header('Location: formularioEspecialidad.php');
	} else {
		if (isset($_REQUEST["actualizar"])) Header("Location: actualizarEspecialidad.php");
		else if (isset($_REQUEST["añadir"])) Header('Location: altaEspecialidad.php');
	}
	}
	
	function validarDatosEspecialidad($especialidad){
		$errores=array();
		
		$conexion = crearConexionBD();
		if(!(isset($especialidad["OID_ESPECIALIDAD"]))){
			$oid = -1;
		}else{
			$oid = $especialidad["OID_ESPECIALIDAD"];
		}
		$totalEspecialidadesNombre = validacionNombreEspecialidad($conexion,$especialidad["nombre"],$oid);
		cerrarConexionBD($conexion);
		
		if($especialidad["nombre"]==""){
			$errores[] = "<p>La especialidad no puede estar vacía</p>";
		}else if($totalEspecialidadesNombre != 0){
			$errores[] = "<p>La especialidad introducida ya ha sido registrada</p>";
		}
		
		return $errores;
	}
?>
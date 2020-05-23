<?php
	session_start();
	
	require_once ('gestionarTratamientos.php');
	require_once ('gestionarEspecialidad.php');
	require_once ('gestionBD.php');

	if(isset($_REQUEST['OID_TRATAMIENTO'])){
		$tratamiento["OID_TRATAMIENTO"] = $_REQUEST["OID_TRATAMIENTO"];
		$tratamiento["nombre"] = $_REQUEST["nombre"];
		$tratamiento["coste"] = $_REQUEST["coste"];
		$tratamiento["especialidad"] = $_REQUEST["especialidad"];
		
		$_SESSION["tratamiento"] = $tratamiento;
		
	}else if (isset($_SESSION["formularioTratamiento"])) {
		$tratamiento["nombre"] = $_REQUEST["nombre"];
		$tratamiento["coste"] = $_REQUEST["coste"];
		$tratamiento["especialidad"] = $_REQUEST["especialidad"];

		$_SESSION["formularioTratamiento"] = $tratamiento;
	
	}
	else Header("Location: formularioTratamientos.php");

	$errores = validarDatosTratamiento($tratamiento);
	
	if(isset($_REQUEST["cancelarAñadir"])) header("Location: listaTratamientos.php");
	else{
	if (count($errores)>0) {
		$_SESSION["errores"] = $errores;
		Header('Location: formularioTratamientos.php');
	} else {
		if (isset($_REQUEST["actualizar"])) Header("Location: actualizarTratamientos.php");
		else if (isset($_REQUEST["añadir"])) Header('Location: altaTratamientos.php');
	}
	}
	
	function validarDatosTratamiento($tratamiento){
			
		$errores = array();
		
		$conexion = crearConexionBD();
		if(!(isset($tratamiento["OID_TRATAMIENTO"]))){
			$oid = -1;
		}else{
			$oid = $tratamiento["OID_TRATAMIENTO"];
		}
		$totalTratamientoNombre = validacionNombreTratamiento($conexion, $tratamiento["nombre"], $oid);
		$ExisteEspecialidad = existeEspecialidad($conexion, $tratamiento["especialidad"]);
		cerrarConexionBD($conexion);
		
		if($tratamiento["coste"]==""){
				$errores[] = "<p>El coste no puede estar vacío</p>";
		}	
		
		if($tratamiento["nombre"]==""){
			$errores[] = "<p>El nombre no puede estar vacío</p>";
		}else if($totalTratamientoNombre!=0){
			$errores[] = "<p>El nombre debe ser único por tratamiento</p>";
		}
		
		if($tratamiento["especialidad"]==""){
			$errores[] = "<p>La especialidad no puede estar vacía</p>";
		}else if($ExisteEspecialidad==0){
			$errores[] = "<p>La especialidad introducida no existe</p>";
		}
	
		return $errores;
	}

?>
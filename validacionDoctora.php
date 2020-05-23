<?php
	session_start();
	
	require_once ('gestionarDoctora.php');
	require_once ('gestionarEspecialidad.php');
	require_once ('gestionBD.php');

	if(isset($_REQUEST['OID_DOCTORA'])){
		$doctora["dni"] = $_REQUEST["dni"];
		$doctora["nombre"] = $_REQUEST["nombre"];
		$doctora["apellidos"] = $_REQUEST["apellidos"];
		$doctora["fechaNacimiento"] = $_REQUEST["fechaNacimiento"];
		$doctora["sueldo"] = $_REQUEST["sueldo"];
		$doctora["poblacion"] = $_REQUEST["poblacion"];
		$doctora["direccion"] = $_REQUEST["direccion"];
		$doctora["fechaAlta"] = $_REQUEST["fechaAlta"];
		$doctora["telefono"] = $_REQUEST["telefono"];
		$doctora["especialidad"] = $_REQUEST["especialidad"];
		$doctora["OID_DOCTORA"] = $_REQUEST["OID_DOCTORA"];
		
		$_SESSION["doctora"] = $doctora;
		
	}else if (isset($_SESSION["formularioDoctora"])) {
		$doctora["dni"] = $_REQUEST["dni"];
		$doctora["nombre"] = $_REQUEST["nombre"];
		$doctora["apellidos"] = $_REQUEST["apellidos"];
		$doctora["fechaNacimiento"] = $_REQUEST["fechaNacimiento"];
		$doctora["sueldo"] = $_REQUEST["sueldo"];
		$doctora["poblacion"] = $_REQUEST["poblacion"];
		$doctora["direccion"] = $_REQUEST["direccion"];
		$doctora["fechaAlta"] = $_REQUEST["fechaAlta"];
		$doctora["telefono"] = $_REQUEST["telefono"];
		$doctora["codigoDoctora"] = $_REQUEST["codigoDoctora"];
		$doctora["especialidad"] = $_REQUEST["especialidad"];
		
		$_SESSION["formularioDoctora"] = $doctora;
	
	}
	else Header("Location: formularioDoctora.php");

	$errores = validarDatosDoctora($doctora);
	
	if(isset($_REQUEST["cancelarAñadir"])) header("Location: listaDoctora.php");
	else{
	if (count($errores)>0) {
		$_SESSION["errores"] = $errores;
		Header('Location: formularioDoctora.php');
	} else {
		if (isset($_REQUEST["actualizar"])) Header("Location: actualizarDoctora.php");
		else if (isset($_REQUEST["añadir"])) Header('Location: altaDoctora.php');
	}
	}
	
	function validarDatosDoctora($doctora){
		
		$errores=array();
		
		$conexion = crearConexionBD();
		if(!(isset($doctora["OID_DOCTORA"]))){
			$oid = -1;
		}else{
			$oid = $doctora["OID_DOCTORA"];
		}
		$totalDoctorasDNI = validacionDNIDoctora($conexion,$doctora["dni"],$oid);
		$ExisteEspecialidad = existeEspecialidad($conexion,$doctora["especialidad"]);
		$totalDoctorasCodigo = validacionCodigoDoctora($conexion,$doctora["codigoDoctora"]);
		cerrarConexionBD($conexion);
		$hoy = date("Y-m-d");
		
		if(!(isset($doctora["OID_DOCTORA"]))){
			if($doctora["dni"]==""){
				$errores[] = "<p>El DNI no puede estar vacío</p>";
			}else if(!preg_match("/^[0-9]{8}[A-Z]$/", $doctora["dni"])){
				$errores[] = "<p>El DNI debe contener 8 números y una letra mayúscula: " . $doctora["dni"]. "</p>";
			}else if($totalDoctorasDNI!=0){
				$errores[] = "<p>El DNI introducido ya ha sido registrado</p>";
			}	
		}else{
			if($doctora["dni"]==""){
				$errores[] = "<p>El DNI no puede estar vacío</p>";
			}else if(!preg_match("/^[0-9]{8}[A-Z]$/", $doctora["dni"])){
				$errores[] = "<p>El DNI debe contener 8 números y una letra mayúscula: " . $doctora["dni"]. "</p>";
			}else if($totalDoctorasDNI!=0){
				$errores[] = "<p>El DNI introducido ya ha sido registrado</p>";
			}	
		}
			
		if($doctora["nombre"]=="") 
			$errores[] = "<p>El nombre no puede estar vacío</p>";
			
		if($doctora["apellidos"]=="") 
			$errores[] = "<p>Los apellidos no puede estar vacío</p>";
		
		if(!(isset($doctora["OID_DOCTORA"]))){
			if($doctora["codigoDoctora"]==""){
				$errores[] = "<p>El codigo no puede estar vacío</p>";
			}else if($totalDoctorasCodigo!=0){
				$errores[] = "<p>El codigo debe ser único por doctora</p>";
			}	
		}
		
		if($doctora["fechaNacimiento"]=="") 
			$errores[] = "<p>La fecha de nacimiento no puede estar vacía</p>";
		else if($doctora["fechaNacimiento"]>=$hoy){
			$errores[] = "<p>La fecha de nacimiento debe ser anterior a la actual</p>";
		}
		
		if($doctora["poblacion"]=="") 
			$errores[] = "<p>La población no puede estar vacía</p>";
			
		if($doctora["direccion"]=="") 
			$errores[] = "<p>La dirección no puede estar vacía</p>";
			
		if($doctora["fechaAlta"]=="") 
			$errores[] = "<p>La fecha de alta no puede estar vacía</p>";
		else if($doctora["fechaAlta"]>$hoy){
			$errores[] = "<p>La fecha de alta debe debe de ser la anterior o igual a la actual</p>";
		}
			
		if($doctora["telefono"]=="") 
			$errores[] = "<p>El teléfono no puede estar vacío</p>";
			
		if($doctora["sueldo"]=="") 
			$errores[] = "<p>El sueldo no puede estar vacío</p>";
			
		if($doctora["especialidad"]==""){
			$errores[] = "<p>La especialidad no puede estar vacía</p>";
		}else if($ExisteEspecialidad==0){
			$errores[] = "<p>La especialidad introducida no existe</p>";
		}	
		
	
		return $errores;
	}

?>
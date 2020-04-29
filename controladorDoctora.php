<?php	
	session_start();
	
	if (isset($_REQUEST["CODIGODOCTORA"])) {
		$doctora["dni"] = $_REQUEST["dni"];
		$doctora["nombre"] = $_REQUEST["nombre"];
		$doctora["apellidos"] = $_REQUEST["apellidos"];
		$doctora["fechaNacimiento"] = $_REQUEST["fechaNacimiento"];
		$doctora["poblacion"] = $_REQUEST["poblacion"];
		$doctora["direccion"] = $_REQUEST["direccion"];
		$doctora["fechaAlta"] = $_REQUEST["fechaAlta"];
		$doctora["sueldo"] = $_REQUEST["sueldo"];
		$doctora["telefono"] = $_REQUEST["telefono"];
		$doctora["codigoDoctora"] = $_REQUEST["CODIGODOCTORA"];
		
		$_SESSION["doctora"] = $doctora;
			
		if (isset($_REQUEST["actualizar"])) Header("Location: formularioDoctora.php");
		else if (isset($_REQUEST["eliminar"])) Header("Location: eliminarDoctora.php");
	}
	else 
		Header("Location: mostrarDoctora.php");

?>
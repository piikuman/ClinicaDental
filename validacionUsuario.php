<?php
	session_start();

	if(isset($_REQUEST['OID_USUARIO'])){
		$usuario["OID_USUARIO"] = $_REQUEST["OID_USUARIO"];	
		$usuario["correo"] = $_REQUEST["correo"];
		$usuario["password"] = $_REQUEST["password"];
		$usuario["conpass"] = $_REQUEST["conpass"];
		
		$_SESSION["usuario"] = $usuario;
		
	}else if (isset($_SESSION["formulario"])) {
		$usuario["correo"] = $_REQUEST["correo"];
		$usuario["password"] = $_REQUEST["password"];
		$usuario["conpass"] = $_REQUEST["conpass"];
		
		$_SESSION["formulario"] = $usuario;
	
	}
	else Header("Location: formularioUsuario.php");

	$errores = validarDatosUsuario($usuario);
	
	if (count($errores)>0) {
		$_SESSION["errores"] = $errores;
		Header('Location: formularioUsuario.php');
	} else {
		if (isset($_REQUEST["actualizar"])) Header("Location: actualizarUsuario.php");
		else if (isset($_REQUEST["añadir"])) Header('Location: altaUsuario.php');
	}
	
	function validarDatosUsuario($usuario){
		
		if($usuario["password"]=="") 
			$errores[] = "<p>La contraseña no puede estar vacío</p>";
			
		if($usuario["correo"]=="") 
			$errores[] = "<p>La contraseña no puede estar vacío</p>";	
	
		return $errores;
	}

?>
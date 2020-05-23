<?php
	session_start();
	
	require_once ('gestionarUsuario.php');
	require_once ('gestionBD.php');

	if(isset($_REQUEST['OID_USUARIO'])){
		$usuario["OID_USUARIO"] = $_REQUEST["OID_USUARIO"];	
		$usuario["correo"] = $_REQUEST["correo"];
		$usuario["password"] = $_REQUEST["password"];
		$usuario["conpass"] = $_REQUEST["conpass"];
		$usuario["OID_USUARIO"] = $_REQUEST['OID_USUARIO'];
		
		$_SESSION["usuario"] = $usuario;
		
	}else if (isset($_SESSION["formulario"])) {
		$usuario["correo"] = $_REQUEST["correo"];
		$usuario["password"] = $_REQUEST["password"];
		$usuario["conpass"] = $_REQUEST["conpass"];
		
		$_SESSION["formulario"] = $usuario;
	
	}
	else Header("Location: formularioUsuario.php");

	$errores = validarDatosUsuario($usuario);
	
	if(isset($_REQUEST["cancelarAñadir"])) header("Location: administracion.php");
	else{
	if (count($errores)>0) {
		$_SESSION["errores"] = $errores;
		Header('Location: formularioUsuario.php');
	} else {
		if (isset($_REQUEST["actualizar"])) Header("Location: actualizarUsuario.php");
		else if (isset($_REQUEST["añadir"])) Header('Location: altaUsuario.php');
	}
	}
	
	function validarDatosUsuario($usuario){
		$errores=array();
		
		$conexion = crearConexionBD();
		if(!(isset($usuario["OID_USUARIO"]))){
			$oid = -1;
		}else{
			$oid = $usuario["OID_USUARIO"];
		}
		$totalUsuarioCorreo = validacionCorreoUsuario($conexion,$usuario["correo"],$oid);
		cerrarConexionBD($conexion);
		
		if($usuario["password"]=="") 
			$errores[] = "<p>La contraseña no puede estar vacía</p>";
		
		if($usuario["correo"]==""){
			$errores[] = "<p>La contraseña no puede estar vacío</p>";
		}else if($totalUsuarioCorreo!=0){
			$errores[] = "<p>El correo debe ser único por usuario</p>";
		}	
			
	
		return $errores;
	}

?>
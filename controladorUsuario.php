<?php	
	session_start();
	
	if (isset($_REQUEST["OID_USUARIO"])) {
		$usuario["OID_USUARIO"] = $_REQUEST["OID_USUARIO"];
		$usuario["correo"] = $_REQUEST["correo"];
		$usuario["password"] = $_REQUEST["password"];
		
		$_SESSION["usuario"] = $usuario;
			
		if (isset($_REQUEST["actualizar"])) Header("Location: formularioUsuario.php");
		else if (isset($_REQUEST["eliminar"])) Header("Location: eliminarUsuario.php");
		else {
			header("Location: administracion.php");
		}
	}
	else 
		Header("Location: mostrarUsuario.php");

?>

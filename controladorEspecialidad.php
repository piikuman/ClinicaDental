<?php	
	session_start();
	
	if (isset($_REQUEST["OID_ESPECIALIDAD"])) {
		$especialidad["OID_ESPECIALIDAD"] = $_REQUEST["OID_ESPECIALIDAD"];
		$especialidad["nombre"] = $_REQUEST["nombre"];
		

		$_SESSION["especialidad"] = $especialidad;
			
		if (isset($_REQUEST["actualizar"])) Header("Location: formularioEspecialidad.php");
		else if (isset($_REQUEST["eliminar"])) Header("Location: eliminarEspecialidad.php");
		else {
			header("Location: listaEspecialidad.php");
		}
	}
	else 
		Header("Location: mostrarEspecialidad.php");

?>
<?php	
	session_start();
	
	if (isset($_REQUEST["OID_TRATAMIENTO"])) {
		$tratamiento["OID_TRATAMIENTO"] = $_REQUEST["OID_TRATAMIENTO"];
		$tratamiento["nombre"] = $_REQUEST["nombre"];
		$tratamiento["coste"] = $_REQUEST["coste"];
		$tratamiento["especialidad"] = $_REQUEST["especialidad"];

		$_SESSION["tratamiento"] = $tratamiento;
			
		if (isset($_REQUEST["actualizar"])) Header("Location: formularioTratamientos.php");
		else if (isset($_REQUEST["eliminar"])) Header("Location: eliminarTratamientos.php");
	}
	else 
		Header("Location: mostrarTratamientos.php");

?>

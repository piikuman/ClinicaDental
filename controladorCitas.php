<?php	
	session_start();
	
	if (isset($_REQUEST["OID_CITA"])) {
		$cita["OID_CITA"] = $_REQUEST["OID_CITA"];
		$cita["fechaCita"] = $_REQUEST["fechaCita"];
		$cita["horaCita"] = $_REQUEST["horaCita"];
		$cita["consulta"] = $_REQUEST["consulta"];
		$cita["paciente"] = $_REQUEST["paciente"];
		$cita["doctora"] = $_REQUEST["doctora"];
		$cita["tratamiento"] = $_REQUEST["tratamiento"];
		$_SESSION["cita"] = $cita;
			
		if (isset($_REQUEST["actualizar"])) Header("Location: formularioCitas.php");
		else if (isset($_REQUEST["eliminar"])) Header("Location: eliminarCitas.php");
		else {
			Header("Location: listaCitas.php");
		}
	}
	else 
		Header("Location: mostrarCitas.php");

?>

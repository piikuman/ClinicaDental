<?php	
	session_start();
	
	if (isset($_REQUEST["OID_PACIENTE"])){
		$paciente["OID_Paciente"] = $_REQUEST["OID_Paciente"];
		$paciente["nombre"] = $_REQUEST["nombre"];
		$paciente["apellidos"] = $_REQUEST["apellidos"];
			
		if (isset($_REQUEST["editar"])) Header("Location: listaPaciente.php"); 
	}
	else 
		Header("Location: listaPaciente.php");

?>

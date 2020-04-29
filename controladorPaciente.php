<?php	
	session_start();
	
	if (isset($_REQUEST["OID_PACIENTE"])) {
		$paciente["OID_PACIENTE"] = $_REQUEST["OID_PACIENTE"];
		$paciente["dni"] = $_REQUEST["dni"];
		$paciente["nombre"] = $_REQUEST["nombre"];
		$paciente["apellidos"] = $_REQUEST["apellidos"];
		$paciente["fechaNacimiento"] = $_REQUEST["fechaNacimiento"];
		$paciente["correo"] = $_REQUEST["correo"];
		$paciente["poblacion"] = $_REQUEST["poblacion"];
		$paciente["direccion"] = $_REQUEST["direccion"];
		$paciente["fechaAlta"] = $_REQUEST["fechaAlta"];
		$paciente["seguro"] = $_REQUEST["seguro"];
		if(isset($_REQUEST["nombreTutor"])){
			$paciente["nombreTutor"] = $_REQUEST["nombreTutor"];
		}
		if(isset($_REQUEST["telefonoTutor"])){
			$paciente["telefonoTutor"] = $_REQUEST["telefonoTutor"];
		}
		
		$_SESSION["paciente"] = $paciente;
			
		if (isset($_REQUEST["actualizar"])) Header("Location: formularioPaciente.php");
		else if (isset($_REQUEST["eliminar"])) Header("Location: eliminarPaciente.php");
		else Header("Location: listaPaciente.php");
	}
	else 
		Header("Location: mostrarPaciente.php");

?>

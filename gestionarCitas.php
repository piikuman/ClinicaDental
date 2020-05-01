<?php
  
 function altaCita($conexion,$cita,$paciente,$doctora,$tratamiento) {
		
	$fechaCita = date('d/m/Y', strtotime($cita["fechaCita"]));
	
	try {
		$consulta = 'CALL INSERTAR_CITA(:fecC, :horaC, :cons, :pa, :doc, :tratam)';	
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':fecC',$fechaCita);
		$stmt->bindParam(':horaC',$cita["horaCita"]);
		$stmt->bindParam(':cons',$cita["consulta"]);
		$stmt->bindParam(':pa',$paciente);
		$stmt->bindParam(':doc',$doctora);
		$stmt->bindParam(':tratam',$tratamiento);
		$stmt -> execute();
		return true;
	} catch(PDOException $e) {
		return false;
		header("Location: excepcion.php");
    }	
}
 
 function consultarTodasCitas($conexion) {
	$consulta = "SELECT * FROM CITA"
		. " ORDER BY FECHACITA, HORACITA";
    return $conexion->query($consulta);
}
 
 function getInfoCita($conexion, $OID_CITA) {
	try {
		$stmt = $conexion -> prepare('SELECT FECHACITA, HORACITA, CONSULTA, OID_PACIENTE, OID_DOCTORA, OID_TRATAMIENTO FROM CITA WHERE OID_CITA = :OID_CITA');
		$stmt -> bindParam(":OID_CITA", $OID_CITA);
		$stmt -> execute();
		return $stmt -> fetch();
	} catch(PDOException $e) {
		$_SESSION["excepcion"] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
 }
 
 function actualizarCita($conexion,$cita,$paciente,$doctora,$tratamiento) {
		
	$fechaCita = date('d/m/Y', strtotime($cita["fechaCita"]));
	
	try {
		$consulta = 'CALL ACTUALIZAR_CITA(:Oidcita,:fecC, :horaC, :cons, :pa, :doc, :tratam)';
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':Oidcita',$cita["OID_CITA"]);
		$stmt->bindParam(':fecC',$fechaCita);
		$stmt->bindParam(':horaC',$cita["horaCita"]);
		$stmt->bindParam(':cons',$cita["consulta"]);
		$stmt->bindParam(':pa',$paciente);
		$stmt->bindParam(':doc',$doctora);
		$stmt->bindParam(':tratam',$tratamiento);
		$stmt -> execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
 }
 
 function eliminarCita($conexion,$codigo) {
		
	try {
		$consulta = 'CALL ELIMINAR_CITA(:Oidcita)';
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':Oidcita',$codigo);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
 }
?>
<?php
  
 function altaCita($conexion,$cita) {
		
	$fechaCita = date('d/m/Y', strtotime($cita["fechaCita"]));
	
	try {
		$consulta = 'CALL INSERTAR_CITA(:fecC, :horaC, :cons)';	
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':fecC',$fechaCita);
		$stmt->bindParam(':horaC',$cita["horaCita"]);
		$stmt->bindParam(':cons',$cita["consulta"]);
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
		$stmt = $conexion -> prepare('SELECT FECHACITA, HORACITA, CONSULTA FROM CITA WHERE OID_CITA = :OID_CITA');
		$stmt -> bindParam(":OID_CITA", $OID_CITA);
		$stmt -> execute();
		return $stmt -> fetch();
	} catch(PDOException $e) {
		$_SESSION["excepcion"] = $e -> GetMessage();
		header("Location: excepcion.php");
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
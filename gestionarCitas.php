<?php
  
 function alta_cita($conexion,$cita) {
		
	$fechaCita = date('d/m/Y', strtotime($usuario["fechaCita"]));
	
	try {
		$consulta = 'CALL INSERTAR_PACIENTE(:fecC, :horaC, :cons)';	
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
?>
<?php
  
 function alta_cita($conexion,$cita) {
		
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
?>
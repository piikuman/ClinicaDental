<?php
  
 function alta_cita($conexion,$tratamiento) {
	
	try {
		$consulta = 'CALL INSERTAR_CITA(:nombreT, :costeT)';	
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':nombreT',$tratamiento["nombreT"]);
		$stmt->bindParam(':cons',$tratamiento["costeT"]);
		$stmt -> execute();
		return true;
	} catch(PDOException $e) {
		return false;
		header("Location: excepcion.php");
    }	
}
?>
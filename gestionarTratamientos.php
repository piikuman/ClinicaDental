<?php
  
 function altaTratamiento($conexion,$tratamiento) {
	
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

function consultarTodosPacientes($conexion) {
	$consulta = "SELECT * FROM TRATAMIENTO"
		. " ORDER BY NOMBRE";
    return $conexion->query($consulta);
}

function getInfoTratamiento($conexion, $OID_TRATAMIENTO) {
	try {
		$stmt = $conexion -> prepare('SELECT NOMBRE, COSTE FROM TRATAMIENTO WHERE OID_TRATAMIENTO = :OID_TRATAMIENTO');
		$stmt -> bindParam(":OID_TRATAMIENTO", $OID_TRATAMIENTO);
		$stmt -> execute();
		return $stmt -> fetch();
	} catch(PDOException $e) {
		$_SESSION["excepcion"] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
}
?>


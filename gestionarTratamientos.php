<?php
  
 function altaTratamiento($conexion,$tratamiento,$especialidad) {
	
	try {
		$consulta = 'CALL INSERTAR_TRATAMIENTO(:nombreT, :costeT, :esp)';	
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':nombreT',$tratamiento["nombre"]);
		$stmt->bindParam(':costeT',$tratamiento["coste"]);
		$stmt->bindParam(':esp',$especialidad);
		$stmt -> execute();
		return true;
	} catch(PDOException $e) {
		return false;
		header("Location: excepcion.php");
    }	
}

function consultarTodosTratamientos($conexion) {
	$consulta = "SELECT * FROM TRATAMIENTO"
		. " ORDER BY NOMBRE";
    return $conexion->query($consulta);
}

function getInfoTratamiento($conexion, $codigo) {
	try {
		$stmt = $conexion -> prepare('SELECT NOMBRE, COSTE, OID_ESPECIALIDAD FROM TRATAMIENTO WHERE OID_TRATAMIENTO = :OID');
		$stmt -> bindParam(":OID", $codigo);
		$stmt -> execute();
		return $stmt -> fetch();
	} catch(PDOException $e) {
		$_SESSION["excepcion"] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
}

function actualizarTratamiento($conexion,$tratamiento,$especialidad) {
	
	try {
		$consulta = 'CALL ACTUALIZAR_TRATAMIENTO(:Oidtratamiento,:nombreT, :costeT,:esp)';
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':Oidtratamiento',$tratamiento["OID_TRATAMIENTO"]);
		$stmt->bindParam(':nombreT',$tratamiento["nombre"]);
		$stmt->bindParam(':costeT',$tratamiento["coste"]);
		$stmt->bindParam(':esp',$especialidad);
		$stmt -> execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
 }
 function eliminarTratamiento($conexion,$codigo) {
		
	try {
		$consulta = 'CALL ELIMINAR_TRATAMIENTO(:Oid)';
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':Oid',$codigo);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}
?>


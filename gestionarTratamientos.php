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
 
 function consultarTotalT($conexion) {
 	try {
		$consulta = 'SELECT COUNT(*) AS TOTAL FROM (SELECT * FROM TRATAMIENTO)';
		$stmt=$conexion->prepare($consulta);
		$stmt->execute();
		$result = $stmt->fetch();
		$total = $result['TOTAL'];
		return  $total;
	} catch(PDOException $e) {
		return $e->getMessage();
    }
 }	

function consultarTodosTratamientos($conexion) {
	$consulta = "SELECT * FROM TRATAMIENTO"
		. " ORDER BY NOMBRE";
    return $conexion->query($consulta);
}

function buscaTratamiento($conexion,$nombre) {
		
	try {
		$consulta = 'SELECT OID_TRATAMIENTO FROM TRATAMIENTO WHERE NOMBRE = :NOMBRE';
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':NOMBRE',$nombre);
		$stmt->execute();
		return $stmt -> fetch();
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

function existeTratamiento($conexion,$nombre) {		
	try {
		$consulta = 'SELECT COUNT(*) AS TOTAL FROM (SELECT * FROM TRATAMIENTO WHERE NOMBRE = :NOMBRE)';
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':NOMBRE',$nombre);
		$stmt->execute();
		$result = $stmt->fetch();
		$total = $result['TOTAL'];
		return  $total;
	}
	catch ( PDOException $e ) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}
}

function validacionNombreTratamiento($conexion,$nombre,$OID_TRATAMIENTO) {		
	try {
		$consulta = 'SELECT COUNT(*) AS TOTAL FROM (SELECT * FROM TRATAMIENTO WHERE NOMBRE = :NOMBRE AND OID_TRATAMIENTO != :OID_TRATAMIENTO)';
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':NOMBRE',$nombre);
		$stmt->bindParam(':OID_TRATAMIENTO',$OID_TRATAMIENTO);
		$stmt->execute();
		$result = $stmt->fetch();
		$total = $result['TOTAL'];
		return  $total;
	}
	catch ( PDOException $e ) {
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}
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


<?php
  
 function altaEspecialidad($conexion,$especialidad) {
	
	try {
		$consulta = 'CALL INSERTAR_ESPECIALIDAD(:nombre)';	
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':nombre',$especialidad["nombre"]);
		$stmt -> execute();
		return true;
	} catch(PDOException $e) {
		return false;
		header("Location: excepcion.php");
    }	
}

function consultarTodasEspecialidades($conexion) {
	$consulta = "SELECT * FROM ESPECIALIDAD"
		. " ORDER BY NOMBRE";
    return $conexion->query($consulta);
}

function consultarTotalE($conexion) {
 	try {
		$consulta = 'SELECT COUNT(*) AS TOTAL FROM (SELECT * FROM ESPECIALIDAD)';
		$stmt=$conexion->prepare($consulta);
		$stmt->execute();
		$result = $stmt->fetch();
		$total = $result['TOTAL'];
		return  $total;
	} catch(PDOException $e) {
		return $e->getMessage();
    }
 }

function getInfoEspecialidad($conexion, $OID_ESPECIALIDAD) {
	try {
		$stmt = $conexion -> prepare('SELECT NOMBRE FROM ESPECIALIDAD WHERE OID_ESPECIALIDAD = :OID_ESPECIALIDAD');
		$stmt -> bindParam(":OID_ESPECIALIDAD", $OID_ESPECIALIDAD);
		$stmt -> execute();
		return $stmt -> fetch();
	} catch(PDOException $e) {
		$_SESSION["excepcion"] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
}

function buscaEspecialidad($conexion,$nombre) {
		
	try {
		$consulta = 'SELECT OID_ESPECIALIDAD FROM ESPECIALIDAD WHERE NOMBRE = :NOMBRE';
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':NOMBRE',$nombre);
		$stmt->execute();
		return $stmt -> fetch();
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

function validacionNombreEspecialidad($conexion,$nombre,$oid) {		
	try {
		$consulta = 'SELECT COUNT(*) AS TOTAL FROM (SELECT * FROM ESPECIALIDAD WHERE NOMBRE = :NOMBRE AND OID_ESPECIALIDAD != :OID_ESPECIALIDAD)';
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':NOMBRE',$nombre);
		$stmt->bindParam(':OID_ESPECIALIDAD',$oid);
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

function existeEspecialidad($conexion,$nombre) {		
	try {
		$consulta = 'SELECT COUNT(*) AS TOTAL FROM (SELECT * FROM ESPECIALIDAD WHERE NOMBRE = :NOMBRE)';
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

function actualizarEspecialidad($conexion,$especialidad) {
		
	try {
		$consulta = 'CALL ACTUALIZAR_ESPECIALIDAD(:Oidespecialidad,:nombreEsp)';
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':Oidespecialidad',$especialidad["OID_ESPECIALIDAD"]);
		$stmt->bindParam(':nombreEsp',$especialidad["nombre"]);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

function eliminarEspecialidad($conexion,$codigo) {
		
	try {
		$consulta = 'CALL ELIMINAR_ESPECIALIDAD(:Oidespecialidad)';
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':Oidespecialidad',$codigo);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}
?>
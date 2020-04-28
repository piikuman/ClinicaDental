<?php
  
 function altaEspecialidad($conexion,$especialidad) {
	
	
	try {
		$consulta = 'CALL INSERTAR_ESPECIALIDAD(:nombreEsp)';	
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':nombreEsp',$espcialidad["nombre"]);
		$stmt -> execute();
		return true;
	} catch(PDOException $e) {
		return false;
		header("Location: excepcion.php");
    }	
}

function consultarTodosEspecialidades($conexion) {
	$consulta = "SELECT * FROM ESPECIALIDAD"
		. " ORDER BY NOMBRE";
    return $conexion->query($consulta);
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

function actualizarEspecialidad($conexion,$especialidad) {
		
	try {
		$consulta = 'CALL ACTUALIZAR_ESPECIALIDAD(:Oidespecialidad,:nombreEsp)';
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':Oidpaciente',$especialidad["OID_ESPECIALIDAD"]);
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
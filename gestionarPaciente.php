<?php
  
 function altaPaciente($conexion,$usuario) {
		
	$fechaNacimiento = date('d/m/Y', strtotime($usuario["fechaNacimiento"]));
	$fechaAlta = date('d/m/Y', strtotime($usuario["fechaAlta"]));
	
	try {
		$consulta = 'CALL INSERTAR_PACIENTE(:nombre, :ape, :dni, :fec, :correo, :poblacion, :dir, :fecA, :seguro, :nTutor, :tTutor)';	
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':nombre',$usuario["nombre"]);
		$stmt->bindParam(':ape',$usuario["apellidos"]);
		$stmt->bindParam(':dni',$usuario["dni"]);
		$stmt->bindParam(':fec',$fechaNacimiento);
		$stmt->bindParam(':correo',$usuario["correo"]);
		$stmt->bindParam(':poblacion',$usuario["poblacion"]);
		$stmt->bindParam(':dir',$usuario["direccion"]);
		$stmt->bindParam(':fecA',$fechaAlta);
		$stmt->bindParam(':seguro',$usuario["seguro"]);
		$stmt->bindParam(':nTutor',$usuario["nombreTutor"]);
		$stmt->bindParam(':tTutor',$usuario["telefonoTutor"]);
		$stmt -> execute();
		return true;
	} catch(PDOException $e) {
		return false;
		header("Location: excepcion.php");
    }	
}

function consultarTodosPacientes($conexion) {
	$consulta = "SELECT * FROM PACIENTE"
		. " ORDER BY APELLIDOS, NOMBRE";
    return $conexion->query($consulta);
}

function consultarTotalP($conexion) {
 	try {
		$consulta = 'SELECT COUNT(*) AS TOTAL FROM (SELECT * FROM PACIENTE)';
		$stmt=$conexion->prepare($consulta);
		$stmt->execute();
		$result = $stmt->fetch();
		$total = $result['TOTAL'];
		return  $total;
	} catch(PDOException $e) {
		return $e->getMessage();
    }
 }

function buscaPaciente($conexion,$dni) {		
	try {
		$consulta = 'SELECT OID_PACIENTE FROM PACIENTE WHERE DNI = :DNI';
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':DNI',$dni);
		$stmt->execute();
		return $stmt -> fetch();
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

function existePaciente($conexion,$dni) {		
	try {
		$consulta = 'SELECT COUNT(*) AS TOTAL FROM (SELECT * FROM PACIENTE WHERE DNI = :DNI)';
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':DNI',$dni);
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

function validacionDNIPaciente($conexion,$dni,$oid) {		
	try {
		$consulta = 'SELECT COUNT(*) AS TOTAL FROM (SELECT * FROM PACIENTE WHERE DNI = :DNI AND OID_PACIENTE != :OID_PACIENTE)';
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':DNI',$dni);
		$stmt->bindParam(':OID_PACIENTE',$oid);
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

function validacionCorreoPaciente($conexion,$correo,$oid) {		
	try {
		$consulta = 'SELECT COUNT(*) AS TOTAL FROM (SELECT * FROM PACIENTE WHERE CORREO = :CORREO AND OID_PACIENTE != :OID_PACIENTE)';
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':CORREO',$correo);
		$stmt->bindParam(':OID_PACIENTE',$oid);
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

function getInfoPaciente($conexion, $OID_PACIENTE) {
	try {
		$stmt = $conexion -> prepare('SELECT NOMBRE, APELLIDOS, DNI, FECHA_NACIMIENTO,CORREO,POBLACION,DIRECCION,FECHAALTA,SEGURO,NOMBRE_TUTOR,TELEFONO_TUTOR FROM PACIENTE WHERE OID_PACIENTE = :OID_PACIENTE');
		$stmt -> bindParam(":OID_PACIENTE", $OID_PACIENTE);
		$stmt -> execute();
		return $stmt -> fetch();
	} catch(PDOException $e) {
		$_SESSION["excepcion"] = $e -> GetMessage();
		header("Location: excepcion.php");
	}
}

function actualizarPaciente($conexion,$paciente) {
		
	$fechaNacimiento = date('d/m/Y', strtotime($paciente["fechaNacimiento"]));
	$fechaAlta = date('d/m/Y', strtotime($paciente["fechaAlta"]));
		
	try {
		$consulta = 'CALL ACTUALIZAR_PACIENTE(:Oidpaciente,:nombre, :ape, :dni, :fec, :correo, :poblacion, :dir, :fecA, :seguro, :nTutor, :tTutor)';
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':Oidpaciente',$paciente["OID_PACIENTE"]);
		$stmt->bindParam(':nombre',$paciente["nombre"]);
		$stmt->bindParam(':ape',$paciente["apellidos"]);
		$stmt->bindParam(':dni',$paciente["dni"]);
		$stmt->bindParam(':fec',$fechaNacimiento);
		$stmt->bindParam(':correo',$paciente["correo"]);
		$stmt->bindParam(':poblacion',$paciente["poblacion"]);
		$stmt->bindParam(':dir',$paciente["direccion"]);
		$stmt->bindParam(':fecA',$fechaAlta);
		$stmt->bindParam(':seguro',$paciente["seguro"]);
		$stmt->bindParam(':nTutor',$paciente["nombreTutor"]);
		$stmt->bindParam(':tTutor',$paciente["telefonoTutor"]);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

function eliminarPaciente($conexion,$codigo) {
		
	try {
		$consulta = 'CALL ELIMINAR_PACIENTE(:Oidpaciente)';
		$stmt=$conexion->prepare($consulta);
		$stmt->bindParam(':Oidpaciente',$codigo);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}
?>